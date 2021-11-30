<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Merlin
 */


// Load Customizer Helper Functions
require( get_template_directory() . '/include/customizer/functions/custom-controls.php' );
require( get_template_directory() . '/include/customizer/functions/sanitize-functions.php' );
require( get_template_directory() . '/include/customizer/functions/callback-functions.php' );

// Load Customizer Section Files
require( get_template_directory() . '/include/customizer/sections/customizer-general.php' );
require( get_template_directory() . '/include/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/include/customizer/sections/customizer-postmeta.php' );
require( get_template_directory() . '/include/customizer/sections/customizer-images.php' );
require( get_template_directory() . '/include/customizer/sections/customizer-slider.php' );
require( get_template_directory() . '/include/customizer/sections/customizer-upgrade.php' );


/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 */
function merlin_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel
	$wp_customize->add_panel( 'merlin_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'merlin' ),
		'description'    => merlin_customize_theme_links(),
	) );

	// Change default background section
	$wp_customize->get_control( 'background_color' )->section   = 'background_image';
	$wp_customize->get_section( 'background_image' )->title     = esc_html__( 'Background', 'merlin' );

	// Add postMessage support for site title and description.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Add selective refresh for site title and description.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'merlin_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'merlin_customize_partial_blogdescription',
	) );

	// Add Display Site Title Setting.
	$wp_customize->add_setting( 'merlin_theme_options[site_title]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'merlin_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'merlin_theme_options[site_title]', array(
		'label'    => esc_html__( 'Display Site Title', 'merlin' ),
		'section'  => 'title_tagline',
		'settings' => 'merlin_theme_options[site_title]',
		'type'     => 'checkbox',
		'priority' => 10,
		)
	);

	// Add Display Tagline Setting.
	$wp_customize->add_setting( 'merlin_theme_options[site_description]', array(
		'default'           => false,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'merlin_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'merlin_theme_options[site_description]', array(
		'label'    => esc_html__( 'Display Tagline', 'merlin' ),
		'section'  => 'title_tagline',
		'settings' => 'merlin_theme_options[site_description]',
		'type'     => 'checkbox',
		'priority' => 11,
		)
	);

	// Add Header Image Link
	$wp_customize->add_setting( 'merlin_theme_options[custom_header_link]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url',
		)
	);
	$wp_customize->add_control( 'merlin_control_custom_header_link', array(
		'label'    => esc_html__( 'Header Image Link', 'merlin' ),
		'section'  => 'header_image',
		'settings' => 'merlin_theme_options[custom_header_link]',
		'type'     => 'url',
		'priority' => 10,
		)
	);

	// Add Custom Header Hide Checkbox
	$wp_customize->add_setting( 'merlin_theme_options[custom_header_hide]', array(
		'default'           => false,
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'merlin_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'merlin_control_custom_header_hide', array(
		'label'    => esc_html__( 'Hide header image on front page', 'merlin' ),
		'section'  => 'header_image',
		'settings' => 'merlin_theme_options[custom_header_hide]',
		'type'     => 'checkbox',
		'priority' => 15,
		)
	);

} // merlin_customize_register_options()
add_action( 'customize_register', 'merlin_customize_register_options' );


/**
 * Render the site title for the selective refresh partial.
 */
function merlin_customize_partial_blogname() {
	bloginfo( 'name' );
}


/**
 * Render the site tagline for the selective refresh partial.
 */
function merlin_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 *
 */
function merlin_customize_preview_js() {
	wp_enqueue_script( 'merlin-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20161214', true );
}
add_action( 'customize_preview_init', 'merlin_customize_preview_js' );


/**
 * Embed CSS styles for the theme options in the Customizer
 *
 */
function merlin_customize_preview_css() {
	wp_enqueue_style( 'merlin-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), '20161214' );
}
add_action( 'customize_controls_print_styles', 'merlin_customize_preview_css' );

/**
 * Returns Theme Links
 */
function merlin_customize_theme_links() {

	ob_start();
	?>

		<div class="theme-links">

			<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'merlin' ); ?></span>

			<p>
				<a href="<?php echo esc_url( __( 'https://themezee.com/themes/merlin/', 'merlin' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=merlin&utm_content=theme-page" target="_blank">
					<?php esc_html_e( 'Theme Page', 'merlin' ); ?>
				</a>
			</p>

			<p>
				<a href="http://preview.themezee.com/?demo=merlin&utm_source=customizer&utm_campaign=merlin" target="_blank">
					<?php esc_html_e( 'Theme Demo', 'merlin' ); ?>
				</a>
			</p>

			<p>
				<a href="<?php echo esc_url( __( 'https://themezee.com/docs/merlin-documentation/', 'merlin' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=merlin&utm_content=documentation" target="_blank">
					<?php esc_html_e( 'Theme Documentation', 'merlin' ); ?>
				</a>
			</p>

			<p>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/merlin/reviews/?filter=5', 'merlin' ) ); ?>" target="_blank">
					<?php esc_html_e( 'Rate this theme', 'merlin' ); ?>
				</a>
			</p>

		</div>

	<?php
	$theme_links = ob_get_contents();
	ob_end_clean();

	return $theme_links;
}
