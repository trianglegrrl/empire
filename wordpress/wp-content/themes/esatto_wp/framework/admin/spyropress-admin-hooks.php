<?php

/**
 * SpyroPress Admin Hooks
 *
 * Action/filter hooks used for SpyroPress functions
 *
 * @author 		SpyroSol
 * @category 	Admin
 * @package 	Spyropress
 *
 */
global $spyropress;

/** Email From and Name Filter ********************************************/
add_filter( 'wp_mail_from', 'spyropress_mail_from' );
add_filter( 'wp_mail_from_name', 'spyropress_mail_from_name' );

/** Hooks/Events **********************************************************/

// remove admin dashboard widgets
add_action( 'admin_init', 'spyropress_remove_dashboard_widgets' );

// make custom fields and excerpt meta boxes show by default
add_filter( 'default_hidden_meta_boxes', 'spyropress_remove_default_metaboxes', 10, 2 );

// Media Uploader
add_filter( 'get_media_item_args', 'allow_img_insertion' );

// Add Wp-Editor to Widget Page
add_action( 'sidebar_admin_page', 'dummy_editor' );

// Setup Theme Options
add_action( 'spyropress_theme_activated', 'spyropress_setup_options', 5 );
add_action( 'spyropress_after_options_saved', 'spyropress_save_css', 10, 2 );

/** tiny_mce Options *****************************************************/

add_filter( 'tiny_mce_before_init', 'spyropress_change_mce_options' );
add_filter( 'mce_buttons_2', 'spyropress_enable_more_buttons' );

/** Shortcode Generator Buttons *****************************************/

add_action( 'init', 'spyropress_add_shortcode_button' );
add_filter( 'tiny_mce_version', 'spyropress_refresh_mce' );

/** Custom Post Type Hooks *****************************************/

add_action( 'right_now_content_table_end', 'spyropress_right_now_content', 10 );

?>