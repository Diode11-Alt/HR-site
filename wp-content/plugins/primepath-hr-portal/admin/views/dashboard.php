<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;

// Stats
$total_jobs = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}pp_jobs");
$pending_jobs = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}pp_jobs WHERE status = 'pending'");
$total_apps = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}pp_applications");
$candidates = count(get_users(array('role' => 'pp_candidate')));
$employers = count(get_users(array('role' => 'pp_employer')));
$inquiries = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}pp_inquiries WHERE status = 'unread'");
?>
<div class="wrap pp-admin-wrap">
    <h1>PrimePath HR Dashboard</h1>

    <div class="pp-stats-grid">
        <div class="pp-stat-card">
            <h3><?php echo intval($total_jobs); ?></h3>
            <p>Total Jobs</p>
        </div>
        <div class="pp-stat-card" style="border-left-color: #f59e0b;">
            <h3><?php echo intval($pending_jobs); ?></h3>
            <p>Pending Jobs</p>
        </div>
        <div class="pp-stat-card" style="border-left-color: #10b981;">
            <h3><?php echo intval($total_apps); ?></h3>
            <p>Applications</p>
        </div>
        <div class="pp-stat-card">
            <h3><?php echo intval($candidates); ?></h3>
            <p>Candidates</p>
        </div>
        <div class="pp-stat-card">
            <h3><?php echo intval($employers); ?></h3>
            <p>Employers</p>
        </div>
        <div class="pp-stat-card" style="border-left-color: #ef4444;">
            <h3><?php echo intval($inquiries); ?></h3>
            <p>Unread Inquiries</p>
        </div>
    </div>
</div>
