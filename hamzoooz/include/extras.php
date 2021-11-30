<?php
/**
 * Custom functions that are not template related
 *
 * @package Merlin
 */


if ( ! function_exists( 'merlin_default_menu' ) ) :
	/**
 * Display default page as navigation if no custom menu was set
 *
 */
	function merlin_default_menu() {

		echo '<ul id="menu-main-navigation" class="main-navigation-menu menu">' . wp_list_pages( 'title_li=&echo=0' ) . '</ul>';

	}
endif;


/**
 * Adds custom theme layout and sticky navigation class to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function merlin_body_classes( $classes ) {

	// Get Theme Options from Database
	$theme_options = merlin_theme_options();

	// Switch Sidebar Layout to left
	if ( 'left-sidebar' == $theme_options['layout'] ) :
		$classes[] = 'sidebar-left';
	endif;

	// Add Sticky Navigation class
	if ( true == $theme_options['sticky_nav'] ) :
		$classes[] = 'sticky-navigation';
	endif;

	return $classes;
}
add_filter( 'body_class', 'merlin_body_classes' );


/**
 * Hide Elements with CSS.
 *
 * @return void
 */
function merlin_hide_elements() {

	// Get theme options from database.
	$theme_options = merlin_theme_options();

	$elements = array();

	// Hide Site Title?
	if ( false == $theme_options['site_title'] ) {
		$elements[] = '.site-title';
	}

	// Hide Site Description?
	if ( false == $theme_options['site_description'] ) {
		$elements[] = '.site-description';
	}

	// Return early if no elements are hidden.
	if ( empty( $elements ) ) {
		return;
	}

	// Create CSS.
	$classes = implode( ', ', $elements );
	$custom_css = $classes . ' {
	position: absolute;
	clip: rect(1px, 1px, 1px, 1px);
}';

	// Add Custom CSS.
	wp_add_inline_style( 'merlin-stylesheet', $custom_css );
}
add_filter( 'wp_enqueue_scripts', 'merlin_hide_elements', 11 );


/**
 * Change excerpt length for default posts
 *
 * @param int $length Length of excerpt in number of words
 * @return int
 */
function merlin_excerpt_length( $length ) {

	// Get Theme Options from Database
	$theme_options = merlin_theme_options();

	// Return Excerpt Text
	if ( isset( $theme_options['excerpt_length'] ) and $theme_options['excerpt_length'] >= 0 ) :
		return absint( $theme_options['excerpt_length'] );
	else :
		return 30; // number of words
	endif;
}
add_filter( 'excerpt_length', 'merlin_excerpt_length' );


/**
 * Function to change excerpt length for posts in category posts widgets
 *
 * @param int $length Length of excerpt in number of words
 * @return int
 */
function merlin_category_posts_excerpt_length( $length ) {
	return 15;
}


/**
 * Set wrapper start for wooCommerce
 *
 */
function merlin_wrapper_start() {
	echo '<section id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'merlin_wrapper_start', 10 );


/**
 * Set wrapper end for wooCommerce
 *
 */
function merlin_wrapper_end() {
	echo '</main><!-- #main -->';
	echo '</section><!-- #primary -->';
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'merlin_wrapper_end', 10 );
