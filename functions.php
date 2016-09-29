<?php

require_once ( 'classes/SpokaneFoodPolicy/Controller.php' );
require_once ( 'classes/SpokaneFoodPolicy/MenuItem.php' );

$sfp_controller = new \SpokaneFoodPolicy\Controller;

add_action ( 'init', array( $sfp_controller, 'form_capture' ) );
add_action( 'after_setup_theme', array( $sfp_controller, 'theme_setup' ) );
add_action( 'wp_enqueue_scripts', array( $sfp_controller, 'enqueue_styles_and_scripts' ) );
add_action( 'admin_init', array( $sfp_controller, 'editor_styles' ) );
add_action( 'widgets_init', array( $sfp_controller, 'widgets_init' ) );
add_action( 'login_head', array( $sfp_controller, 'add_favicon' ) );
add_action( 'admin_head', array( $sfp_controller, 'add_favicon' ) );

if ( is_admin() )
{
	add_action( 'admin_enqueue_scripts',  array( $sfp_controller, 'enqueue_admin_styles_and_scripts' ) );
	add_action( 'admin_init', array( $sfp_controller, 'register_settings' ) );
	add_action( 'add_meta_boxes', array( $sfp_controller, 'page_layout_box' ) );
	add_action( 'admin_menu', array( $sfp_controller, 'admin_menus') );
}