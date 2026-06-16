<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;

$jobs = $wpdb->get_results("SELECT j.*, u.display_name as employer_name FROM {$wpdb->prefix}pp_jobs j JOIN {$wpdb->prefix}users u ON j.employer_id = u.ID ORDER BY j.posted_date DESC");
?>
<div class="wrap pp-admin-wrap">
    <h1>Manage Jobs</h1>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Employer</th>
                <th>Posted Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($jobs): foreach($jobs as $job): ?>
                <tr>
                    <td><strong><?php echo esc_html($job->title); ?></strong></td>
                    <td><?php echo esc_html($job->company); ?></td>
                    <td><?php echo esc_html($job->employer_name); ?></td>
                    <td><?php echo date('M d, Y', strtotime($job->posted_date)); ?></td>
                    <td>
                        <span class="pp-badge pp-badge-<?php echo esc_attr($job->status); ?>">
                            <?php echo esc_html(ucfirst($job->status)); ?>
                        </span>
                    </td>
                    <td>
                        <select class="pp-job-status-select" data-id="<?php echo esc_attr($job->id); ?>">
                            <option value="pending" <?php selected($job->status, 'pending'); ?>>Pending</option>
                            <option value="published" <?php selected($job->status, 'published'); ?>>Published</option>
                            <option value="rejected" <?php selected($job->status, 'rejected'); ?>>Rejected</option>
                            <option value="closed" <?php selected($job->status, 'closed'); ?>>Closed</option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="6">No jobs found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
