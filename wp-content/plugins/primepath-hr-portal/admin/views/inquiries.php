<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;

$inquiries = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}pp_inquiries ORDER BY created_at DESC");
?>
<div class="wrap pp-admin-wrap">
    <h1>Contact Inquiries</h1>
    
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($inquiries): foreach($inquiries as $inq): ?>
                <tr style="<?php echo $inq->status === 'unread' ? 'background:#fffbeb; border-left:3px solid var(--gold);' : ''; ?>">
                    <td><?php echo date('M d, Y H:i', strtotime($inq->created_at)); ?></td>
                    <td><strong><?php echo esc_html($inq->name); ?></strong></td>
                    <td><a href="mailto:<?php echo esc_attr($inq->email); ?>"><?php echo esc_html($inq->email); ?></a></td>
                    <td><?php echo esc_html($inq->phone); ?></td>
                    <td><span class="pp-badge pp-badge-<?php echo esc_attr($inq->status); ?>"><?php echo esc_html($inq->type); ?></span></td>
                    <td><?php echo esc_html($inq->subject); ?></td>
                    <td style="max-width:300px;"><div style="max-height:80px; overflow-y:auto;"><?php echo nl2br(esc_html($inq->message)); ?></div></td>
                    <td>
                        <button class="button button-link-delete pp-delete-inquiry" data-id="<?php echo esc_attr($inq->id); ?>" style="color:#dc2626;">Delete</button>
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="8">No inquiries found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
