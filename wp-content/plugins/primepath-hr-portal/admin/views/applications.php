<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;

$apps = $wpdb->get_results("SELECT a.*, j.title, j.company FROM {$wpdb->prefix}pp_applications a JOIN {$wpdb->prefix}pp_jobs j ON a.job_id = j.id ORDER BY a.applied_on DESC");
?>
<div class="wrap pp-admin-wrap">
    <h1>All Applications</h1>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Candidate</th>
                <th>Job</th>
                <th>Company</th>
                <th>Experience</th>
                <th>Applied On</th>
                <th>Status</th>
                <th>CV</th>
            </tr>
        </thead>
        <tbody>
            <?php if($apps): foreach($apps as $app): ?>
                <tr>
                    <td>
                        <strong><?php echo esc_html($app->candidate_name); ?></strong><br>
                        <small><?php echo esc_html($app->candidate_email); ?></small>
                    </td>
                    <td><?php echo esc_html($app->title); ?></td>
                    <td><?php echo esc_html($app->company); ?></td>
                    <td><?php echo esc_html($app->experience); ?> yrs</td>
                    <td><?php echo date('M d, Y', strtotime($app->applied_on)); ?></td>
                    <td><?php echo esc_html(ucwords(str_replace('_',' ',$app->status))); ?></td>
                    <td>
                        <?php if($app->cv_url): ?>
                            <a href="<?php echo esc_url($app->cv_url); ?>" target="_blank" class="button">View CV</a>
                        <?php else: ?>
                            No CV
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7">No applications found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
