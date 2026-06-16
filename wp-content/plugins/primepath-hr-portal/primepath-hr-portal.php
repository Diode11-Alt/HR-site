<?php
/**
 * Plugin Name: PrimePath HR Portal
 * Plugin URI: https://primepathuae.com
 * Description: The complete bespoke HR Portal system for PrimePath UAE. Includes Job Board, Employer Portals, Candidate Portals, and Admin Dashboard.
 * Version: 2.0.0
 * Author: Antigravity IDE
 * Author URI: https://primepathuae.com
 * Text Domain: primepath-hr
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define Plugin Constants
define( 'PP_HR_VERSION', '2.0.0' );
define( 'PP_HR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PP_HR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * PrimePath HR Main Core Class
 */
final class PrimePath_HR_Portal {

    private static $instance = null;

    /**
     * Get singleton instance
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    private function __construct() {
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Include required files
     */
    private function includes() {
        // Foundation / Security
        require_once PP_HR_PLUGIN_DIR . 'includes/class-security.php';
        require_once PP_HR_PLUGIN_DIR . 'includes/class-database.php';
        require_once PP_HR_PLUGIN_DIR . 'includes/class-roles.php';
        require_once PP_HR_PLUGIN_DIR . 'includes/class-upload.php';
        require_once PP_HR_PLUGIN_DIR . 'includes/class-email.php';
        require_once PP_HR_PLUGIN_DIR . 'includes/class-ajax.php';
        
        // Shortcodes
        require_once PP_HR_PLUGIN_DIR . 'shortcodes/job-board.php';
        require_once PP_HR_PLUGIN_DIR . 'shortcodes/employer-portal.php';
        require_once PP_HR_PLUGIN_DIR . 'shortcodes/candidate-portal.php';
        require_once PP_HR_PLUGIN_DIR . 'shortcodes/login-form.php';
        require_once PP_HR_PLUGIN_DIR . 'shortcodes/register-form.php';

        // Admin
        if ( is_admin() ) {
            require_once PP_HR_PLUGIN_DIR . 'admin/class-admin-menu.php';
        }
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Activation & Deactivation hooks are registered outside the class for reliability
    }
}

/**
 * Initialize the plugin
 */
function pp_hr_init() {
    PrimePath_HR_Portal::get_instance();
}
add_action( 'plugins_loaded', 'pp_hr_init' );

/**
 * Plugin Activation Hook
 */
function pp_hr_activate() {
    require_once PP_HR_PLUGIN_DIR . 'includes/class-database.php';
    require_once PP_HR_PLUGIN_DIR . 'includes/class-roles.php';
    
    // Run activation tasks
    if ( class_exists( 'PP_Database' ) ) {
        PP_Database::create_tables();
    }
    if ( class_exists( 'PP_Roles' ) ) {
        PP_Roles::register_roles();
    }
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pp_hr_activate' );
