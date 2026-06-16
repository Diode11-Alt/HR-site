<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$employers = get_users(array('role' => 'pp_employer', 'orderby' => 'registered', 'order' => 'DESC'));
?>
<div class="wrap pp-admin-wrap">
    <h1>Employers</h1>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Industry</th>
                <th>Size</th>
                <th>Website</th>
                <th>Registered</th>
            </tr>
        </thead>
        <tbody>
            <?php if($employers): foreach($employers as $e): ?>
                <tr>
                    <td><strong><?php echo esc_html(get_user_meta($e->ID, 'pp_company_name', true) ?: 'N/A'); ?></strong></td>
                    <td><?php echo esc_html($e->first_name ?: $e->display_name); ?></td>
                    <td><?php echo esc_html($e->user_email); ?></td>
                    <td><?php echo esc_html(get_user_meta($e->ID, 'pp_industry', true)); ?></td>
                    <td><?php echo esc_html(get_user_meta($e->ID, 'pp_size', true)); ?></td>
                    <td>
                        <?php $web = get_user_meta($e->ID, 'pp_website', true); if($web): ?>
                            <a href="<?php echo esc_url($web); ?>" target="_blank">Website</a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('M d, Y', strtotime($e->user_registered)); ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="7">No employers found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
