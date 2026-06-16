<?php
/**
 * AJAX Handlers
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class PP_AJAX {

    public static function init() {
        // Auth
        add_action('wp_ajax_nopriv_pp_login_user', array(__CLASS__, 'login_user'));
        add_action('wp_ajax_nopriv_pp_register_user', array(__CLASS__, 'register_user'));
        
        // Contact
        add_action('wp_ajax_nopriv_pp_contact_form', array(__CLASS__, 'contact_form'));
        add_action('wp_ajax_pp_contact_form', array(__CLASS__, 'contact_form'));
        
        // Job Board
        add_action('wp_ajax_nopriv_pp_filter_jobs', array(__CLASS__, 'filter_jobs'));
        add_action('wp_ajax_pp_filter_jobs', array(__CLASS__, 'filter_jobs'));
        add_action('wp_ajax_pp_submit_application', array(__CLASS__, 'submit_application'));

        // Candidate Portal
        add_action('wp_ajax_pp_save_job', array(__CLASS__, 'save_job'));
        add_action('wp_ajax_pp_unsave_job', array(__CLASS__, 'unsave_job'));
        add_action('wp_ajax_pp_update_profile', array(__CLASS__, 'update_profile'));

        // Employer Portal
        add_action('wp_ajax_pp_post_job', array(__CLASS__, 'post_job'));
        add_action('wp_ajax_pp_update_job', array(__CLASS__, 'update_job'));
        add_action('wp_ajax_pp_close_job', array(__CLASS__, 'close_job'));
        add_action('wp_ajax_pp_update_app_status', array(__CLASS__, 'update_app_status'));
        add_action('wp_ajax_pp_update_company_profile', array(__CLASS__, 'update_company_profile'));

        // Admin
        add_action('wp_ajax_pp_admin_update_job_status', array(__CLASS__, 'admin_update_job_status'));
        add_action('wp_ajax_pp_admin_delete_inquiry', array(__CLASS__, 'admin_delete_inquiry'));
    }

    /**
     * Login User
     */
    public static function login_user() {
        PP_Security::verify_ajax_nonce();

        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $remember = isset($_POST['remember']) ? true : false;

        $user = wp_authenticate($email, $password);

        if ( is_wp_error($user) ) {
            wp_send_json_error('Invalid email or password.');
        }

        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, $remember);

        $redirect = home_url('/candidate-portal');
        if ( in_array('manage_options', (array) $user->roles) ) {
            $redirect = admin_url();
        } elseif ( in_array('pp_employer', (array) $user->roles) ) {
            $redirect = home_url('/employer-portal');
        }

        wp_send_json_success(array('redirect' => $redirect));
    }

    /**
     * Register User
     */
    public static function register_user() {
        PP_Security::verify_ajax_nonce();

        $role = sanitize_text_field($_POST['role']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];
        $full_name = sanitize_text_field($_POST['full_name']);
        $phone = sanitize_text_field($_POST['phone']);

        if ( email_exists($email) ) {
            wp_send_json_error('Email is already registered.');
        }

        $user_id = wp_create_user($email, $password, $email);

        if ( is_wp_error($user_id) ) {
            wp_send_json_error($user_id->get_error_message());
        }

        $wp_user = new WP_User($user_id);
        $wp_user->set_role( $role === 'employer' ? 'pp_employer' : 'pp_candidate' );

        // Basic Profile Info
        update_user_meta($user_id, 'first_name', $full_name);
        update_user_meta($user_id, 'pp_phone', $phone);

        if ( $role === 'employer' ) {
            $company_name = sanitize_text_field($_POST['company_name']);
            update_user_meta($user_id, 'pp_company_name', $company_name);
            
            // Notify Admin
            if(class_exists('PP_Email')) PP_Email::notify_admin_new_employer($company_name, $email);
        } else {
            $job_title = sanitize_text_field($_POST['job_title']);
            $experience = sanitize_text_field($_POST['experience']);
            update_user_meta($user_id, 'pp_job_title', $job_title);
            update_user_meta($user_id, 'pp_experience', $experience);
            
            // Notify Admin
            if(class_exists('PP_Email')) PP_Email::notify_admin_new_candidate($full_name, $email);
        }

        // Auto Login
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id, true);

        wp_send_json_success(array(
            'redirect' => home_url( $role === 'employer' ? '/employer-portal' : '/candidate-portal' )
        ));
    }

    /**
     * Filter Jobs
     */
    public static function filter_jobs() {
        PP_Security::verify_ajax_nonce();
        global $wpdb;
        
        $where = array("status = 'published'");
        
        if(!empty($_POST['category'])) {
            $cat = sanitize_text_field($_POST['category']);
            $where[] = $wpdb->prepare("category = %s", $cat);
        }
        if(!empty($_POST['type'])) {
            $type = sanitize_text_field($_POST['type']);
            $where[] = $wpdb->prepare("type = %s", $type);
        }
        if(!empty($_POST['keyword'])) {
            $kw = '%' . $wpdb->esc_like(sanitize_text_field($_POST['keyword'])) . '%';
            $where[] = $wpdb->prepare("(title LIKE %s OR company LIKE %s)", $kw, $kw);
        }
        
        $where_clause = implode(' AND ', $where);
        $jobs = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pp_jobs WHERE $where_clause ORDER BY posted_date DESC");
        
        ob_start();
        if($jobs) {
            foreach($jobs as $job) {
                // We'll pass the job variable to the template part
                set_query_var('pp_job', $job);
                get_template_part('template-parts/job', 'card');
            }
        } else {
            echo '<p>No jobs found matching your criteria.</p>';
        }
        $html = ob_get_clean();
        
        wp_send_json_success(array('html' => $html, 'count' => count($jobs)));
    }

    /**
     * Submit Application
     */
    public static function submit_application() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_candidate();

        global $wpdb;
        $job_id = absint($_POST['job_id']);
        $user_id = get_current_user_id();
        $user = wp_get_current_user();

        // Check if already applied
        $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$wpdb->prefix}pp_applications WHERE job_id = %d AND candidate_id = %d", $job_id, $user_id));
        if($exists) {
            wp_send_json_error('You have already applied for this job.');
        }

        // Handle CV
        $cv_url = get_user_meta($user_id, 'pp_cv_url', true);
        if(!empty($_FILES['cv']['name'])) {
            $upload = PP_Upload::handle_cv_upload($_FILES['cv']);
            if(is_wp_error($upload)) {
                wp_send_json_error($upload->get_error_message());
            }
            $cv_url = $upload;
            update_user_meta($user_id, 'pp_cv_url', $cv_url); // Save for future
        }

        if(empty($cv_url)) {
            wp_send_json_error('Please upload a CV.');
        }

        $data = array(
            'job_id'          => $job_id,
            'candidate_id'    => $user_id,
            'candidate_name'  => $user->first_name ?: $user->display_name,
            'candidate_email' => $user->user_email,
            'candidate_phone' => sanitize_text_field($_POST['phone']),
            'experience'      => sanitize_text_field($_POST['experience']),
            'cover_letter'    => sanitize_textarea_field($_POST['cover_letter']),
            'cv_url'          => $cv_url,
            'status'          => 'applied'
        );

        $inserted = $wpdb->insert($wpdb->prefix . 'pp_applications', $data);

        if($inserted) {
            // Get job title for email
            $job_title = $wpdb->get_var($wpdb->prepare("SELECT title FROM {$wpdb->prefix}pp_jobs WHERE id = %d", $job_id));
            if(class_exists('PP_Email')) PP_Email::notify_employer_new_application($job_id, $job_title);
            wp_send_json_success();
        } else {
            wp_send_json_error('Failed to submit application.');
        }
    }

    /**
     * Save Job
     */
    public static function save_job() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_candidate();
        global $wpdb;
        $job_id = absint($_POST['job_id']);
        $user_id = get_current_user_id();
        $wpdb->insert($wpdb->prefix . 'pp_saved_jobs', array('candidate_id' => $user_id, 'job_id' => $job_id));
        wp_send_json_success();
    }

    /**
     * Unsave Job
     */
    public static function unsave_job() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_candidate();
        global $wpdb;
        $job_id = absint($_POST['job_id']);
        $user_id = get_current_user_id();
        $wpdb->delete($wpdb->prefix . 'pp_saved_jobs', array('candidate_id' => $user_id, 'job_id' => $job_id));
        wp_send_json_success();
    }

    /**
     * Update Profile
     */
    public static function update_profile() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_candidate();
        $user_id = get_current_user_id();
        
        if(isset($_POST['full_name'])) update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['full_name']));
        if(isset($_POST['phone'])) update_user_meta($user_id, 'pp_phone', sanitize_text_field($_POST['phone']));
        if(isset($_POST['location'])) update_user_meta($user_id, 'pp_location', sanitize_text_field($_POST['location']));
        if(isset($_POST['nationality'])) update_user_meta($user_id, 'pp_nationality', sanitize_text_field($_POST['nationality']));
        if(isset($_POST['job_title'])) update_user_meta($user_id, 'pp_job_title', sanitize_text_field($_POST['job_title']));
        if(isset($_POST['experience'])) update_user_meta($user_id, 'pp_experience', sanitize_text_field($_POST['experience']));
        if(isset($_POST['skills'])) update_user_meta($user_id, 'pp_skills', sanitize_text_field($_POST['skills']));

        if(!empty($_FILES['cv']['name'])) {
            $upload = PP_Upload::handle_cv_upload($_FILES['cv']);
            if(is_wp_error($upload)) {
                wp_send_json_error($upload->get_error_message());
            }
            update_user_meta($user_id, 'pp_cv_url', $upload);
        }

        wp_send_json_success('Profile updated.');
    }

    /**
     * Post Job
     */
    public static function post_job() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_employer();
        global $wpdb;

        $employer_id = get_current_user_id();
        $company = get_user_meta($employer_id, 'pp_company_name', true) ?: 'Unknown Company';

        $data = array(
            'employer_id'  => $employer_id,
            'title'        => sanitize_text_field($_POST['title']),
            'company'      => $company,
            'location'     => sanitize_text_field($_POST['location']),
            'type'         => sanitize_text_field($_POST['type']),
            'category'     => sanitize_text_field($_POST['category']),
            'salary'       => sanitize_text_field($_POST['salary']),
            'deadline'     => sanitize_text_field($_POST['deadline']),
            'description'  => wp_kses_post($_POST['description']),
            'requirements' => sanitize_textarea_field($_POST['requirements']),
            'status'       => 'pending'
        );

        $inserted = $wpdb->insert($wpdb->prefix . 'pp_jobs', $data);

        if($inserted) {
            // Notify Admin
            if(class_exists('PP_Email')) PP_Email::notify_admin_new_job($data);
            wp_send_json_success();
        } else {
            wp_send_json_error('Failed to post job.');
        }
    }

    /**
     * Update Job
     */
    public static function update_job() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_employer();
        global $wpdb;

        $job_id = absint($_POST['job_id']);
        $employer_id = get_current_user_id();

        // Verify ownership
        $job = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}pp_jobs WHERE id = %d AND employer_id = %d", $job_id, $employer_id));
        if(!$job || in_array($job->status, ['closed', 'rejected'])) {
            wp_send_json_error('Cannot edit this job.');
        }

        $data = array(
            'title'        => sanitize_text_field($_POST['title']),
            'location'     => sanitize_text_field($_POST['location']),
            'type'         => sanitize_text_field($_POST['type']),
            'category'     => sanitize_text_field($_POST['category']),
            'salary'       => sanitize_text_field($_POST['salary']),
            'deadline'     => sanitize_text_field($_POST['deadline']),
            'description'  => wp_kses_post($_POST['description']),
            'requirements' => sanitize_textarea_field($_POST['requirements']),
            'status'       => 'pending' // Re-submit for approval
        );

        $wpdb->update($wpdb->prefix . 'pp_jobs', $data, array('id' => $job_id));
        wp_send_json_success();
    }

    /**
     * Close Job
     */
    public static function close_job() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_employer();
        global $wpdb;

        $job_id = absint($_POST['job_id']);
        $employer_id = get_current_user_id();

        $updated = $wpdb->update($wpdb->prefix . 'pp_jobs', array('status' => 'closed'), array('id' => $job_id, 'employer_id' => $employer_id));
        if($updated) {
            wp_send_json_success();
        } else {
            wp_send_json_error('Could not close job.');
        }
    }

    /**
     * Update Application Status
     */
    public static function update_app_status() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_employer();
        global $wpdb;

        $app_id = absint($_POST['app_id']);
        $status = sanitize_text_field($_POST['status']);
        $employer_id = get_current_user_id();

        // Verify the application belongs to a job owned by this employer
        $app = $wpdb->get_row($wpdb->prepare("
            SELECT a.*, j.title, j.employer_id 
            FROM {$wpdb->prefix}pp_applications a 
            JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id 
            WHERE a.id = %d
        ", $app_id));

        if(!$app || $app->employer_id != $employer_id) {
            wp_send_json_error('Access denied.');
        }

        $wpdb->update($wpdb->prefix . 'pp_applications', array('status' => $status), array('id' => $app_id));

        // Notify Candidate
        if(class_exists('PP_Email')) PP_Email::notify_candidate_status_change($app->candidate_email, $app->title, $status);

        wp_send_json_success();
    }

    /**
     * Update Company Profile
     */
    public static function update_company_profile() {
        PP_Security::verify_ajax_nonce();
        PP_Security::check_employer();
        
        $user_id = get_current_user_id();
        
        if(isset($_POST['company_name'])) update_user_meta($user_id, 'pp_company_name', sanitize_text_field($_POST['company_name']));
        if(isset($_POST['industry'])) update_user_meta($user_id, 'pp_industry', sanitize_text_field($_POST['industry']));
        if(isset($_POST['size'])) update_user_meta($user_id, 'pp_size', sanitize_text_field($_POST['size']));
        if(isset($_POST['website'])) update_user_meta($user_id, 'pp_website', esc_url_raw($_POST['website']));
        if(isset($_POST['address'])) update_user_meta($user_id, 'pp_address', sanitize_text_field($_POST['address']));
        if(isset($_POST['description'])) update_user_meta($user_id, 'pp_description', wp_kses_post($_POST['description']));

        wp_send_json_success('Profile updated.');
    }

    /**
     * Admin: Update Job Status
     */
    public static function admin_update_job_status() {
        PP_Security::verify_ajax_nonce('pp_admin_action');
        if(!current_user_can('manage_options')) wp_send_json_error('Access denied');
        
        global $wpdb;
        $job_id = absint($_POST['job_id']);
        $status = sanitize_text_field($_POST['status']);
        
        $wpdb->update($wpdb->prefix . 'pp_jobs', array('status' => $status), array('id' => $job_id));
        
        if($status === 'published' && class_exists('PP_Email')) {
            $employer_id = $wpdb->get_var($wpdb->prepare("SELECT employer_id FROM {$wpdb->prefix}pp_jobs WHERE id = %d", $job_id));
            $user = get_userdata($employer_id);
            if($user) {
                PP_Email::notify_employer_job_published($user->user_email, $job_id);
            }
        }
        
        wp_send_json_success();
    }

    /**
     * Admin: Delete Inquiry
     */
    public static function admin_delete_inquiry() {
        PP_Security::verify_ajax_nonce('pp_admin_action');
        if(!current_user_can('manage_options')) wp_send_json_error('Access denied');
        
        global $wpdb;
        $id = absint($_POST['id']);
        $wpdb->delete($wpdb->prefix . 'pp_inquiries', array('id' => $id));
        wp_send_json_success();
    }

    /**
     * Contact Form
     */
    public static function contact_form() {
        PP_Security::verify_ajax_nonce();

        global $wpdb;
        $table = $wpdb->prefix . 'pp_inquiries';

        $data = array(
            'name'    => sanitize_text_field($_POST['name']),
            'email'   => sanitize_email($_POST['email']),
            'phone'   => sanitize_text_field($_POST['phone']),
            'type'    => sanitize_text_field($_POST['type']),
            'subject' => sanitize_text_field($_POST['subject']),
            'message' => sanitize_textarea_field($_POST['message'])
        );

        $inserted = $wpdb->insert($table, $data);

        if ( $inserted ) {
            if(class_exists('PP_Email')) PP_Email::notify_admin_new_inquiry($data);
            wp_send_json_success();
        } else {
            wp_send_json_error('Could not save inquiry.');
        }
    }
}

PP_AJAX::init();
