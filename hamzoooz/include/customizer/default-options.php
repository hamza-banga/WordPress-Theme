<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package Merlin
 */


/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function merlin_theme_options() {

	// Merge Theme Options Array from Database with Default Options Array
	$theme_options = wp_parse_args(

		// Get saved theme options from WP database
		get_option( 'merlin_theme_options', array() ),

		// Merge with Default Options if setting was not saved yet
		merlin_default_options()

	);

	// Return theme options
	return $theme_options;

}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function merlin_default_options() {

	$default_options = array(
		'site_title'						=> true,
        'site_description'					=> false,
		'custom_header_link'				=> '',
		'custom_header_hide'				=> false,
		'layout' 							=> 'right-sidebar',
		'sticky_nav'						=> false,
		'latest_posts_title'				=> esc_html__( 'Latest Posts', 'merlin' ),
		'post_content' 						=> 'excerpt',
		'excerpt_length' 					=> 30,
		'meta_date'							=> true,
		'meta_author'						=> true,
		'footer_meta_archives'				=> true,
		'footer_meta_single'				=> true,
		'meta_tags'							=> true,
		'post_layout_archives'				=> 'left',
		'post_image_single' 				=> true,
		'post_navigation'					=> true,
		'slider_magazine' 					=> false,
		'slider_blog' 						=> false,
		'slider_category' 					=> 0,
		'slider_limit' 						=> 8,
		'slider_animation' 					=> 'slide',
		'slider_speed' 						=> 7000,
	);

	return $default_options;
}
