<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class PP_Admin_Menu {
    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'register_menus'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_assets'));
    }

    public static function enqueue_assets($hook) {
        if(strpos($hook, 'primepath') !== false) {
            wp_enqueue_style('pp-admin-css', PP_HR_PLUGIN_URL . 'admin/assets/admin-style.css');
            wp_enqueue_script('pp-admin-js', PP_HR_PLUGIN_URL . 'admin/assets/admin-script.js', array(), '1.0', true);
            wp_localize_script('pp-admin-js', 'pp_ajax', array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('pp_admin_action')
            ));
        }
    }

    public static function register_menus() {
        add_menu_page(
            'PrimePath HR',
            'PrimePath HR',
            'manage_options',
            'primepath-dashboard',
            array(__CLASS__, 'render_dashboard'),
            'dashicons-businessman',
            25
        );

        add_submenu_page('primepath-dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'primepath-dashboard', array(__CLASS__, 'render_dashboard'));
        add_submenu_page('primepath-dashboard', 'Manage Jobs', 'Jobs', 'manage_options', 'primepath-jobs', array(__CLASS__, 'render_jobs'));
        add_submenu_page('primepath-dashboard', 'Applications', 'Applications', 'manage_options', 'primepath-applications', array(__CLASS__, 'render_applications'));
        add_submenu_page('primepath-dashboard', 'Candidates', 'Candidates', 'manage_options', 'primepath-candidates', array(__CLASS__, 'render_candidates'));
        add_submenu_page('primepath-dashboard', 'Employers', 'Employers', 'manage_options', 'primepath-employers', array(__CLASS__, 'render_employers'));
        add_submenu_page('primepath-dashboard', 'Inquiries', 'Inquiries', 'manage_options', 'primepath-inquiries', array(__CLASS__, 'render_inquiries'));
        add_submenu_page('primepath-dashboard', 'Settings', 'Settings', 'manage_options', 'primepath-settings', array(__CLASS__, 'render_settings'));
    }

    public static function render_dashboard() { include PP_HR_PLUGIN_DIR . 'admin/views/dashboard.php'; }
    public static function render_jobs() { include PP_HR_PLUGIN_DIR . 'admin/views/jobs.php'; }
    public static function render_applications() { include PP_HR_PLUGIN_DIR . 'admin/views/applications.php'; }
    public static function render_candidates() { include PP_HR_PLUGIN_DIR . 'admin/views/candidates.php'; }
    public static function render_employers() { include PP_HR_PLUGIN_DIR . 'admin/views/employers.php'; }
    public static function render_inquiries() { include PP_HR_PLUGIN_DIR . 'admin/views/inquiries.php'; }
    public static function render_settings() { include PP_HR_PLUGIN_DIR . 'admin/views/settings.php'; }
}

PP_Admin_Menu::init();
