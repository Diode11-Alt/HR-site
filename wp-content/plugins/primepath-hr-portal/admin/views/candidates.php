<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$candidates = get_users(array('role' => 'pp_candidate', 'orderby' => 'registered', 'order' => 'DESC'));
?>
<div class="wrap pp-admin-wrap">
    <h1>Candidates</h1>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Location</th>
                <th>Job Title</th>
                <th>Experience</th>
                <th>CV</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            <?php if($candidates): foreach($candidates as $c): ?>
                <tr>
                    <td><strong><?php echo esc_html($c->first_name ?: $c->display_name); ?></strong></td>
                    <td><?php echo esc_html($c->user_email); ?></td>
                    <td><?php echo esc_html(get_user_meta($c->ID, 'pp_phone', true)); ?></td>
                    <td><?php echo esc_html(get_user_meta($c->ID, 'pp_location', true)); ?></td>
                    <td><?php echo esc_html(get_user_meta($c->ID, 'pp_job_title', true)); ?></td>
                    <td><?php echo esc_html(get_user_meta($c->ID, 'pp_experience', true)); ?> yrs</td>
                    <td>
                        <?php $cv = get_user_meta($c->ID, 'pp_cv_url', true); if($cv): ?>
                            <a href="<?php echo esc_url($cv); ?>" target="_blank">View CV</a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('M d, Y', strtotime($c->user_registered)); ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="8">No candidates found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
