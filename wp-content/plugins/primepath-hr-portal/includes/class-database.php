<?php
/**
 * Database setup and management
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class PP_Database {

    /**
     * Create custom tables on plugin activation
     */
    public static function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        // 1. Jobs Table
        $table_jobs = $wpdb->prefix . 'pp_jobs';
        $sql_jobs = "CREATE TABLE $table_jobs (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            employer_id bigint(20) unsigned NOT NULL,
            title varchar(255) NOT NULL,
            company varchar(255) NOT NULL,
            location varchar(255) NOT NULL,
            type enum('full-time','part-time','contract') NOT NULL,
            category varchar(100) NOT NULL,
            salary varchar(100),
            description longtext NOT NULL,
            requirements text,
            status enum('pending','published','closed','rejected') DEFAULT 'pending',
            deadline date,
            posted_date datetime DEFAULT CURRENT_TIMESTAMP,
            views int(11) DEFAULT 0,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql_jobs );

        // 2. Applications Table
        $table_apps = $wpdb->prefix . 'pp_applications';
        $sql_apps = "CREATE TABLE $table_apps (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            job_id bigint(20) unsigned NOT NULL,
            candidate_id bigint(20) unsigned NOT NULL,
            candidate_name varchar(255) NOT NULL,
            candidate_email varchar(255) NOT NULL,
            candidate_phone varchar(50),
            experience varchar(100),
            cover_letter text,
            cv_url varchar(500),
            status enum('applied','under_review','shortlisted','rejected') DEFAULT 'applied',
            applied_on datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql_apps );

        // 3. Inquiries Table
        $table_inquiries = $wpdb->prefix . 'pp_inquiries';
        $sql_inquiries = "CREATE TABLE $table_inquiries (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone varchar(50),
            type enum('employer','candidate','general') NOT NULL,
            subject varchar(255) NOT NULL,
            message text NOT NULL,
            status enum('new','in_progress','replied') DEFAULT 'new',
            received_on datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql_inquiries );

        // 4. Saved Jobs Table
        $table_saved = $wpdb->prefix . 'pp_saved_jobs';
        $sql_saved = "CREATE TABLE $table_saved (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            candidate_id bigint(20) unsigned NOT NULL,
            job_id bigint(20) unsigned NOT NULL,
            saved_on datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        dbDelta( $sql_saved );
    }

    /**
     * Drop custom tables on uninstall (Optional - usually bad practice to delete data on plugin deactivation, handled in uninstall.php)
     */
    public static function drop_tables() {
        global $wpdb;
        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}pp_jobs" );
        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}pp_applications" );
        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}pp_inquiries" );
        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}pp_saved_jobs" );
    }
}
