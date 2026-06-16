<?php
/**
 * Security Helpers
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PP_Security {

    /**
     * Verify Nonce for AJAX
     */
    public static function verify_ajax_nonce() {
        if ( ! isset( $_POST['pp_nonce'] ) || ! wp_verify_nonce( $_POST['pp_nonce'], 'pp_action' ) ) {
            wp_send_json_error( 'Security check failed. Please refresh the page and try again.' );
            wp_die();
        }
    }

    /**
     * Check Employer Access
     */
    public static function check_employer() {
        if ( ! is_user_logged_in() || ! current_user_can( 'pp_post_jobs' ) ) {
            wp_send_json_error( 'Access denied. Employers only.' );
            wp_die();
        }
    }

    /**
     * Check Candidate Access
     */
    public static function check_candidate() {
        if ( ! is_user_logged_in() || ! current_user_can( 'pp_apply_jobs' ) ) {
            wp_send_json_error( 'Access denied. Candidates only.' );
            wp_die();
        }
    }

    /**
     * Check Admin Access
     */
    public static function check_admin() {
        if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( 'Access denied. Administrators only.' );
            wp_die();
        }
    }
}
