<?php
if ( ! defined( 'ABSPATH' ) ) exit;

function pp_employer_portal_shortcode() {
    if ( ! is_user_logged_in() || ! current_user_can('pp_post_jobs') ) {
        wp_redirect(home_url('/login'));
        exit;
    }

    $user_id = get_current_user_id();
    global $wpdb;

    $company_name = get_user_meta($user_id, 'pp_company_name', true) ?: 'Your Company';

    // Stats
    $active_jobs = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}pp_jobs WHERE employer_id = %d AND status = 'published'", $user_id));
    
    // Count total applications for this employer's jobs
    $total_apps = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(a.id) FROM {$wpdb->prefix}pp_applications a 
        JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id 
        WHERE j.employer_id = %d", $user_id));
        
    $shortlisted = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(a.id) FROM {$wpdb->prefix}pp_applications a 
        JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id 
        WHERE j.employer_id = %d AND a.status = 'shortlisted'", $user_id));
        
    $pending_jobs = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}pp_jobs WHERE employer_id = %d AND status = 'pending'", $user_id));

    // Recent Jobs
    $recent_jobs = $wpdb->get_results($wpdb->prepare("
        SELECT j.*, (SELECT COUNT(*) FROM {$wpdb->prefix}pp_applications WHERE job_id = j.id) as app_count 
        FROM {$wpdb->prefix}pp_jobs j 
        WHERE j.employer_id = %d 
        ORDER BY j.posted_date DESC LIMIT 5", $user_id));

    // Recent Apps
    $recent_apps = $wpdb->get_results($wpdb->prepare("
        SELECT a.*, j.title 
        FROM {$wpdb->prefix}pp_applications a 
        JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id 
        WHERE j.employer_id = %d 
        ORDER BY a.applied_on DESC LIMIT 5", $user_id));

    ob_start();
    ?>
    <div class="portal-layout">
        <aside class="portal-sidebar">
            <div class="portal-logo">Employer Portal</div>
            <ul class="portal-nav">
                <li><a href="#dashboard" class="active" data-tab="dashboard">Dashboard</a></li>
                <li><a href="#post-job" data-tab="post-job">Post a Job</a></li>
                <li><a href="#my-jobs" data-tab="my-jobs">My Jobs</a></li>
                <li><a href="#applications" data-tab="applications">Applications</a></li>
                <li><a href="#profile" data-tab="profile">Company Profile</a></li>
                <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a></li>
            </ul>
        </aside>

        <main class="portal-main">
            <header class="portal-topbar">
                <h2>Welcome, <?php echo esc_html($company_name); ?></h2>
            </header>

            <div class="portal-content">
                
                <!-- Tab: Dashboard -->
                <div id="tab-dashboard" class="portal-tab active">
                    <div class="portal-stats">
                        <div class="stat-card">
                            <h3 style="color: var(--success);"><?php echo intval($active_jobs); ?></h3>
                            <p>Active Jobs</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo intval($total_apps); ?></h3>
                            <p>Total Applications</p>
                        </div>
                        <div class="stat-card">
                            <h3><?php echo intval($shortlisted); ?></h3>
                            <p>Shortlisted</p>
                        </div>
                        <div class="stat-card">
                            <h3 style="color: var(--warning);"><?php echo intval($pending_jobs); ?></h3>
                            <p>Pending Approval</p>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-top: 30px;" class="jb-grid">
                        <div class="portal-panel">
                            <h3>Recent Jobs</h3>
                            <table class="portal-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Apps</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($recent_jobs): foreach($recent_jobs as $job): ?>
                                        <tr>
                                            <td><?php echo esc_html($job->title); ?></td>
                                            <td><span class="badge badge-<?php echo esc_attr($job->status); ?>"><?php echo esc_html(ucfirst($job->status)); ?></span></td>
                                            <td><?php echo intval($job->app_count); ?></td>
                                        </tr>
                                    <?php endforeach; else: ?>
                                        <tr><td colspan="3">No jobs posted yet.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="portal-panel">
                            <h3>Recent Applications</h3>
                            <table class="portal-table">
                                <thead>
                                    <tr>
                                        <th>Candidate</th>
                                        <th>Job</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($recent_apps): foreach($recent_apps as $app): ?>
                                        <tr>
                                            <td><?php echo esc_html($app->candidate_name); ?></td>
                                            <td><?php echo esc_html($app->title); ?></td>
                                            <td><span class="badge badge-<?php echo esc_attr($app->status); ?>"><?php echo esc_html(ucfirst(str_replace('_',' ',$app->status))); ?></span></td>
                                        </tr>
                                    <?php endforeach; else: ?>
                                        <tr><td colspan="3">No applications yet.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tab: Post Job -->
                <div id="tab-post-job" class="portal-tab">
                    <div class="portal-panel" style="max-width: 800px;">
                        <h3>Post a New Job</h3>
                        <form id="pp-post-job-form">
                            <?php wp_nonce_field('pp_action', 'pp_nonce'); ?>
                            <input type="hidden" name="action" value="pp_post_job">
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                                <div style="grid-column: 1 / -1;">
                                    <label>Job Title *</label>
                                    <input type="text" name="title" required class="portal-input">
                                </div>
                                <div>
                                    <label>Location *</label>
                                    <input type="text" name="location" required class="portal-input" placeholder="e.g. Dubai, UAE">
                                </div>
                                <div>
                                    <label>Job Type *</label>
                                    <select name="type" required class="portal-input">
                                        <option value="full-time">Full Time</option>
                                        <option value="part-time">Part Time</option>
                                        <option value="contract">Contract</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Category *</label>
                                    <select name="category" required class="portal-input">
                                        <option value="Engineering">Engineering</option>
                                        <option value="Finance">Finance</option>
                                        <option value="HR">HR</option>
                                        <option value="Logistics">Logistics</option>
                                        <option value="IT">IT</option>
                                        <option value="HSE">HSE</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Healthcare">Healthcare</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Salary Range</label>
                                    <input type="text" name="salary" class="portal-input" placeholder="e.g. 10,000 - 15,000 AED">
                                </div>
                                <div>
                                    <label>Application Deadline *</label>
                                    <input type="date" name="deadline" required class="portal-input">
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label>Job Description *</label>
                                <textarea name="description" rows="6" required class="portal-input"></textarea>
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label>Requirements *</label>
                                <textarea name="requirements" rows="4" required class="portal-input" placeholder="One requirement per line"></textarea>
                            </div>
                            
                            <div id="post-job-msg" style="display: none; padding: 10px; margin-bottom: 10px; border-radius: var(--radius);"></div>
                            <button type="submit" class="btn btn-primary">Submit for Approval</button>
                        </form>
                    </div>
                </div>

                <!-- Tab: My Jobs -->
                <div id="tab-my-jobs" class="portal-tab">
                    <div class="portal-panel">
                        <h3>My Jobs</h3>
                        <table class="portal-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Apps</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $all_jobs = $wpdb->get_results($wpdb->prepare("SELECT j.*, (SELECT COUNT(*) FROM {$wpdb->prefix}pp_applications WHERE job_id = j.id) as app_count FROM {$wpdb->prefix}pp_jobs j WHERE j.employer_id = %d ORDER BY j.posted_date DESC", $user_id));
                                if($all_jobs): foreach($all_jobs as $job): 
                                ?>
                                    <tr>
                                        <td><?php echo esc_html($job->title); ?></td>
                                        <td><?php echo esc_html($job->category); ?></td>
                                        <td><?php echo esc_html(ucfirst(str_replace('-',' ',$job->type))); ?></td>
                                        <td><span class="badge badge-<?php echo esc_attr($job->status); ?>"><?php echo esc_html(ucfirst($job->status)); ?></span></td>
                                        <td><?php echo intval($job->app_count); ?></td>
                                        <td>
                                            <?php if(in_array($job->status, ['pending', 'published'])): ?>
                                                <button class="btn-close-job" data-id="<?php echo esc_attr($job->id); ?>" style="background:none; border:none; color:var(--danger); cursor:pointer; font-size:0.85rem; font-weight:600;">Close Job</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="6">No jobs found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Applications -->
                <div id="tab-applications" class="portal-tab">
                    <div class="portal-panel">
                        <h3>Candidate Applications</h3>
                        <table class="portal-table">
                            <thead>
                                <tr>
                                    <th>Candidate</th>
                                    <th>Job</th>
                                    <th>Experience</th>
                                    <th>Applied On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $all_apps = $wpdb->get_results($wpdb->prepare("SELECT a.*, j.title FROM {$wpdb->prefix}pp_applications a JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id WHERE j.employer_id = %d ORDER BY a.applied_on DESC", $user_id));
                                if($all_apps): foreach($all_apps as $app): 
                                ?>
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;"><?php echo esc_html($app->candidate_name); ?></div>
                                            <div style="font-size:0.8rem; color:var(--gray-dark);"><?php echo esc_html($app->candidate_email); ?></div>
                                        </td>
                                        <td><?php echo esc_html($app->title); ?></td>
                                        <td><?php echo esc_html($app->experience); ?> yrs</td>
                                        <td><?php echo date('M d, Y', strtotime($app->applied_on)); ?></td>
                                        <td>
                                            <select class="app-status-select portal-input" data-id="<?php echo esc_attr($app->id); ?>" style="padding: 5px; width: auto;">
                                                <option value="applied" <?php selected($app->status, 'applied'); ?>>Applied</option>
                                                <option value="under_review" <?php selected($app->status, 'under_review'); ?>>Under Review</option>
                                                <option value="shortlisted" <?php selected($app->status, 'shortlisted'); ?>>Shortlisted</option>
                                                <option value="rejected" <?php selected($app->status, 'rejected'); ?>>Rejected</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php if($app->cv_url): ?>
                                                <a href="<?php echo esc_url($app->cv_url); ?>" target="_blank" style="font-size:0.85rem; font-weight:600;">View CV</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="6">No applications received yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab: Profile -->
                <div id="tab-profile" class="portal-tab">
                    <div class="portal-panel" style="max-width: 600px;">
                        <h3>Company Profile</h3>
                        <form id="pp-company-profile-form">
                            <?php wp_nonce_field('pp_action', 'pp_nonce'); ?>
                            <input type="hidden" name="action" value="pp_update_company_profile">
                            
                            <div style="margin-bottom: 15px;">
                                <label>Company Name</label>
                                <input type="text" name="company_name" value="<?php echo esc_attr($company_name); ?>" required class="portal-input">
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label>Industry</label>
                                <input type="text" name="industry" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_industry', true)); ?>" class="portal-input">
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label>Company Size (e.g. 50-200)</label>
                                <input type="text" name="size" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_size', true)); ?>" class="portal-input">
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label>Website URL</label>
                                <input type="url" name="website" value="<?php echo esc_url(get_user_meta($user_id, 'pp_website', true)); ?>" class="portal-input">
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label>Office Address</label>
                                <input type="text" name="address" value="<?php echo esc_attr(get_user_meta($user_id, 'pp_address', true)); ?>" class="portal-input">
                            </div>
                            <div style="margin-bottom: 15px;">
                                <label>Company Description</label>
                                <textarea name="description" rows="5" class="portal-input"><?php echo esc_textarea(get_user_meta($user_id, 'pp_description', true)); ?></textarea>
                            </div>
                            
                            <div id="company-profile-msg" style="display: none; padding: 10px; margin-bottom: 10px; border-radius: var(--radius);"></div>
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        
        // Post Job Form
        const postJobForm = document.getElementById('pp-post-job-form');
        if(postJobForm) {
            postJobForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btn = postJobForm.querySelector('button');
                const msg = document.getElementById('post-job-msg');
                btn.disabled = true;
                btn.textContent = 'Submitting...';
                
                try {
                    const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        body: new FormData(postJobForm)
                    });
                    const data = await res.json();
                    msg.style.display = 'block';
                    if(data.success) {
                        msg.style.backgroundColor = 'var(--success)';
                        msg.style.color = 'white';
                        msg.textContent = 'Job submitted! Admin will review and publish it shortly.';
                        postJobForm.reset();
                    } else {
                        msg.style.backgroundColor = 'var(--danger)';
                        msg.style.color = 'white';
                        msg.textContent = data.data || 'Failed to post job.';
                    }
                } catch (err) {
                    msg.style.display = 'block';
                    msg.style.backgroundColor = 'var(--danger)';
                    msg.style.color = 'white';
                    msg.textContent = 'Network error.';
                }
                btn.disabled = false;
                btn.textContent = 'Submit for Approval';
            });
        }

        // Update Company Profile Form
        const companyProfileForm = document.getElementById('pp-company-profile-form');
        if(companyProfileForm) {
            companyProfileForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btn = companyProfileForm.querySelector('button');
                const msg = document.getElementById('company-profile-msg');
                btn.disabled = true;
                btn.textContent = 'Saving...';
                
                try {
                    const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        body: new FormData(companyProfileForm)
                    });
                    const data = await res.json();
                    msg.style.display = 'block';
                    if(data.success) {
                        msg.style.backgroundColor = 'var(--success)';
                        msg.style.color = 'white';
                        msg.textContent = 'Profile updated successfully!';
                    } else {
                        msg.style.backgroundColor = 'var(--danger)';
                        msg.style.color = 'white';
                        msg.textContent = data.data || 'Failed to update profile.';
                    }
                } catch (err) {
                    msg.style.display = 'block';
                    msg.style.backgroundColor = 'var(--danger)';
                    msg.style.color = 'white';
                    msg.textContent = 'Network error.';
                }
                btn.disabled = false;
                btn.textContent = 'Save Profile';
                setTimeout(() => { msg.style.display = 'none'; }, 3000);
            });
        }

        // Close Job
        document.querySelectorAll('.btn-close-job').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                if(!confirm('Are you sure you want to close this job?')) return;
                
                const jobId = e.target.getAttribute('data-id');
                const formData = new FormData();
                formData.append('action', 'pp_close_job');
                formData.append('pp_nonce', '<?php echo wp_create_nonce('pp_action'); ?>');
                formData.append('job_id', jobId);
                
                try {
                    const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await res.json();
                    if(data.success) {
                        window.location.reload();
                    } else {
                        alert(data.data || 'Failed to close job.');
                    }
                } catch (err) {
                    alert('Network error.');
                }
            });
        });

        // Application Status Change
        document.querySelectorAll('.app-status-select').forEach(select => {
            select.addEventListener('change', async (e) => {
                const appId = e.target.getAttribute('data-id');
                const status = e.target.value;
                
                const formData = new FormData();
                formData.append('action', 'pp_update_app_status');
                formData.append('pp_nonce', '<?php echo wp_create_nonce('pp_action'); ?>');
                formData.append('app_id', appId);
                formData.append('status', status);
                
                try {
                    const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await res.json();
                    if(data.success) {
                        // Optional: show a small toast notification here
                    } else {
                        alert(data.data || 'Failed to update status.');
                        window.location.reload();
                    }
                } catch (err) {
                    alert('Network error.');
                }
            });
        });

    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('pp_employer_portal', 'pp_employer_portal_shortcode');
