<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function pp_candidate_portal_shortcode() {
    if ( ! is_user_logged_in() || ! current_user_can('pp_apply_jobs') ) {
        wp_redirect(home_url('/login'));
        exit;
    }

    $user_id = get_current_user_id();
    $user = wp_get_current_user();
    global $wpdb;

    // Stats
    $applied = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}pp_applications WHERE candidate_id = %d", $user_id));
    $under_review = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}pp_applications WHERE candidate_id = %d AND status = 'under_review'", $user_id));
    $shortlisted = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}pp_applications WHERE candidate_id = %d AND status = 'shortlisted'", $user_id));
    $saved = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}pp_saved_jobs WHERE candidate_id = %d", $user_id));

    // Recent Apps
    $recent_apps = $wpdb->get_results($wpdb->prepare("
        SELECT a.*, j.title, j.company 
        FROM {$wpdb->prefix}pp_applications a 
        JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id 
        WHERE a.candidate_id = %d 
        ORDER BY a.applied_on DESC LIMIT 5", $user_id));

    ob_start();
    ?>
    <div class="portal-layout">
        <!-- Sidebar -->
        <aside class="portal-sidebar">
            <div class="portal-logo">Candidate Portal</div>
            <ul class="portal-nav">
                <li><a href="#dashboard" class="active" data-tab="dashboard">Dashboard</a></li>
                <li><a href="#browse" data-tab="browse">Browse Jobs</a></li>
                <li><a href="#applications" data-tab="applications">My Applications</a></li>
                <li><a href="#profile" data-tab="profile">My Profile</a></li>
                <li><a href="#saved" data-tab="saved">Saved Jobs</a></li>
                <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="portal-main">
            <header class="portal-topbar">
                <h2>Welcome back, <?php echo esc_html($user->first_name ?: $user->display_name); ?></h2>
            </header>

            <div class="portal-content">
                
                <!-- Tab: Dashboard -->
                <div id="tab-dashboard" class="portal-tab active">
                    <div class="portal-stats">
                        <div class="stat-card">
                            <h3><?php echo intval($applied); ?></h3>
                            <p>Jobs Applied</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo intval($under_review); ?></h3>
                            <p>Under Review</p>
                        </div>
                        <div class="stat-card">
                            <h3 style="color: var(--success);"><?php echo intval($shortlisted); ?></h3>
                            <p>Shortlisted</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo intval($saved); ?></h3>
                            <p>Saved Jobs</p>
                        </div>
                    </div>

                    <div class="portal-panel" style="margin-top: 30px;">
                        <h3>Recent Applications</h3>
                        <table class="portal-table">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <th>Applied On</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($recent_apps): foreach($recent_apps as $app): ?>
                                    <tr class="<?php echo $app->status === 'shortlisted' ? 'highlight-row' : ''; ?>">
                                        <td><?php echo esc_html($app->title); ?></td>
                                        <td><?php echo esc_html($app->company); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($app->applied_on)); ?></td>
                                        <td><span class="badge badge-<?php echo esc_attr($app->status); ?>"><?php echo esc_html(ucwords(str_replace('_', ' ', $app->status))); ?></span></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="4">No applications yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Browse -->
                <div id="tab-browse" class="portal-tab">
                    <?php echo do_shortcode('[pp_job_board]'); ?>
                </div>

                <!-- Tab: Applications -->
                <div id="tab-applications" class="portal-tab">
                    <div class="portal-panel">
                        <h3>All Applications</h3>
                        <table class="portal-table">
                            <thead>
                                <tr>
                                    <th>Job Title</th>
                                    <th>Company</th>
                                    <th>Applied On</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $all_apps = $wpdb->get_results($wpdb->prepare("SELECT a.*, j.title, j.company FROM {$wpdb->prefix}pp_applications a JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id WHERE a.candidate_id = %d ORDER BY a.applied_on DESC", $user_id));
                                if($all_apps): foreach($all_apps as $app): 
                                ?>
                                    <tr class="<?php echo $app->status === 'shortlisted' ? 'highlight-row' : ''; ?>">
                                        <td><?php echo esc_html($app->title); ?></td>
                                        <td><?php echo esc_html($app->company); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($app->applied_on)); ?></td>
                                        <td><span class="badge badge-<?php echo esc_attr($app->status); ?>"><?php echo esc_html(ucwords(str_replace('_', ' ', $app->status))); ?></span></td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="4">No applications found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Profile -->
                <div id="tab-profile" class="portal-tab">
                    <div class="portal-panel">
                        <h3>My Profile</h3>
                        <form id="pp-profile-form">
                            <?php wp_nonce_field('pp_action', 'pp_nonce'); ?>
                            <input type="hidden" name="action" value="pp_update_profile">
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                <div>
                                    <label>Full Name</label>
                                    <input type="text" name="full_name" value="<?php echo esc_attr($user->first_name ?: $user->display_name); ?>" required class="portal-input">
                                </div>
                                <div>
                                    <label>Email (Read-only)</label>
                                    <input type="email" value="<?php echo esc_attr($user->user_email); ?>" readonly class="portal-input" style="background:#eee;">
                                </div>
                                <div>
                                    <label>Phone Number</label>
                                    <input type="text" name="phone" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_phone', true)); ?>" class="portal-input">
                                </div>
                                <div>
                                    <label>Location (City/Country)</label>
                                    <input type="text" name="location" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_location', true)); ?>" class="portal-input">
                                </div>
                                <div>
                                    <label>Nationality</label>
                                    <input type="text" name="nationality" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_nationality', true)); ?>" class="portal-input">
                                </div>
                                <div>
                                    <label>Current Job Title</label>
                                    <input type="text" name="job_title" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_job_title', true)); ?>" class="portal-input">
                                </div>
                                <div>
                                    <label>Years of Experience</label>
                                    <input type="number" name="experience" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_experience', true)); ?>" class="portal-input">
                                </div>
                                <div>
                                    <label>Skills (comma separated)</label>
                                    <input type="text" name="skills" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_skills', true)); ?>" class="portal-input">
                                </div>
                            </div>
                            
                            <div style="background: var(--white-dim); padding: 15px; border-radius: var(--radius); margin-bottom: 15px;">
                                <label>Upload New CV (PDF/DOCX) - Replaces current</label>
                                <?php $cv = get_user_meta($user_id, 'pp_cv_url', true); if($cv): ?>
                                    <p style="font-size:0.85rem; margin-bottom:10px;">Current CV: <a href="<?php echo esc_url($cv); ?>" target="_blank">View Document</a></p>
                                <?php endif; ?>
                                <input type="file" name="cv" accept=".pdf,.doc,.docx" class="portal-input">
                            </div>
                            
                            <div id="profile-msg" style="display: none; padding: 10px; margin-bottom: 10px; border-radius: var(--radius);"></div>
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </form>
                    </div>
                </div>

                <!-- Tab: Saved -->
                <div id="tab-saved" class="portal-tab">
                    <div class="portal-panel">
                        <h3>Saved Jobs</h3>
                        <?php
                        $saved_jobs = $wpdb->get_results($wpdb->prepare("SELECT j.* FROM {$wpdb->prefix}pp_saved_jobs s JOIN {$wpdb->prefix}pp_jobs j ON s.job_id = j.id WHERE s.candidate_id = %d", $user_id));
                        if($saved_jobs):
                            echo '<div style="display:flex; flex-direction:column; gap:15px;">';
                            foreach($saved_jobs as $job):
                                set_query_var('pp_job', $job);
                                get_template_part('template-parts/job', 'card');
                                // Could add an 'unsave' button logic here if desired
                            endforeach;
                            echo '</div>';
                        else:
                            echo '<p>No saved jobs yet.</p>';
                        endif;
                        ?>
                    </div>
                </div>

            </div>
        </main>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('pp_candidate_portal', 'pp_candidate_portal_shortcode');
