<?php

require_once ( 'classes/OnaWhiteAngus/Controller.php' );
require_once ( 'classes/OnaWhiteAngus/MenuItem.php' );
require_once ( 'classes/OnaWhiteAngus/HoverCow.php' );
require_once ( 'classes/OnaWhiteAngus/HomepageBox.php' );
require_once ( 'classes/OnaWhiteAngus/Member.php' );
require_once ( 'classes/OnaWhiteAngus/MemberTable.php' );
require_once ( 'classes/OnaWhiteAngus/Payment.php' );

$ona_controller = new \OnaWhiteAngus\Controller;

add_action ( 'init', array( $ona_controller, 'form_capture' ) );
add_action( 'after_setup_theme', array( $ona_controller, 'theme_setup' ) );
add_action( 'wp_enqueue_scripts', array( $ona_controller, 'enqueue_styles_and_scripts' ) );
add_action( 'admin_init', array( $ona_controller, 'editor_styles' ) );
add_action( 'widgets_init', array( $ona_controller, 'widgets_init' ) );
add_action( 'customize_register', array( $ona_controller, 'customizer' ) );
add_action( 'pre_post_update', array( $ona_controller, 'save_custom_page_meta' ) );
add_shortcode ( 'ona_white_angus', array( $ona_controller, 'short_code' ) );
add_action( 'login_head', array( $ona_controller, 'add_favicon' ) );
add_action( 'admin_head', array( $ona_controller, 'add_favicon' ) );

if ( is_admin() )
{
	add_action( 'admin_enqueue_scripts',  array( $ona_controller, 'enqueue_admin_styles_and_scripts' ) );
	add_action( 'admin_init', array( $ona_controller, 'register_settings' ) );
	add_action( 'add_meta_boxes', array( $ona_controller, 'page_layout_box' ) );
	add_action( 'admin_menu', array( $ona_controller, 'admin_menus') );
}