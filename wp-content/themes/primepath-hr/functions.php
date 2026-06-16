<?php
/**
 * PrimePath HR Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function pp_theme_enqueue_scripts() {
    // Theme core styles
    wp_enqueue_style( 'pp-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
    
    // Main public styles
    wp_enqueue_style( 'pp-main-style', get_template_directory_uri() . '/assets/css/main.css', array('pp-style'), wp_get_theme()->get('Version') );
    
    // Main public scripts
    wp_enqueue_script( 'pp-main-script', get_template_directory_uri() . '/assets/js/main.js', array(), wp_get_theme()->get('Version'), true );
    
    // Enqueue portal CSS only on specific pages (handled in plugin usually, but we can register here)
    wp_register_style( 'pp-portal-style', get_template_directory_uri() . '/assets/css/portal.css', array('pp-style'), wp_get_theme()->get('Version') );
    wp_register_script( 'pp-portal-script', get_template_directory_uri() . '/assets/js/portal.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'pp_theme_enqueue_scripts' );

function pp_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
    
    // Register Menus
    register_nav_menus( array(
        'primary' => __( 'Primary Nav (Public Site)', 'primepath-hr' ),
        'auth'    => __( 'Auth Nav (Top Right)', 'primepath-hr' ),
        'footer'  => __( 'Footer Nav', 'primepath-hr' ),
    ) );
}
add_action( 'after_setup_theme', 'pp_theme_setup' );
