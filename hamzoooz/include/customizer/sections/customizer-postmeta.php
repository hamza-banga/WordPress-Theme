<?php
/**
 * Post Meta Settings
 *
 * Register postmeta section, settings and controls for Theme Customizer
 *
 * @package Merlin
 */


/**
 * Adds postmeta settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function merlin_customize_register_postmeta_settings( $wp_customize ) {

	// Add Sections for Post Meta
	$wp_customize->add_section( 'merlin_section_postmeta', array(
        'title'    => esc_html__( 'Post Meta', 'merlin' ),
        'priority' => 40,
		'panel' => 'merlin_options_panel' 
		)
	);
	
	// Add Post Meta Settings
	$wp_customize->add_setting( 'merlin_theme_options[postmeta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_theme_options[postmeta_headline]', array(
            'label' => esc_html__( 'Post Meta', 'merlin' ),
            'section' => 'merlin_section_postmeta',
            'settings' => 'merlin_theme_options[postmeta_headline]',
            'priority' => 1
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[meta_date]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[meta_date]', array(
        'label'    => esc_html__( 'Display post date', 'merlin' ),
        'section'  => 'merlin_section_postmeta',
        'settings' => 'merlin_theme_options[meta_date]',
        'type'     => 'checkbox',
		'priority' => 2
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[meta_author]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[meta_author]', array(
        'label'    => esc_html__( 'Display post author', 'merlin' ),
        'section'  => 'merlin_section_postmeta',
        'settings' => 'merlin_theme_options[meta_author]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);
	
	// Add Footer Meta Settings
	$wp_customize->add_setting( 'merlin_theme_options[footermeta_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_theme_options[footermeta_headline]', array(
            'label' => esc_html__( 'Post Footer', 'merlin' ),
            'section' => 'merlin_section_postmeta',
            'settings' => 'merlin_theme_options[footermeta_headline]',
            'priority' => 4
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[footer_meta_archives]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[footer_meta_archives]', array(
        'label'    => esc_html__( 'Display post categories and comments on archive pages', 'merlin' ),
        'section'  => 'merlin_section_postmeta',
        'settings' => 'merlin_theme_options[footer_meta_archives]',
        'type'     => 'checkbox',
		'priority' => 5
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[footer_meta_single]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[footer_meta_single]', array(
        'label'    => esc_html__( 'Display post categories and comments on single posts', 'merlin' ),
        'section'  => 'merlin_section_postmeta',
        'settings' => 'merlin_theme_options[footer_meta_single]',
        'type'     => 'checkbox',
		'priority' => 6
		)
	);
	$wp_customize->add_setting( 'merlin_theme_options[meta_tags]', array(
        'default'           => true,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[meta_tags]', array(
        'label'    => esc_html__( 'Display post tags on single posts', 'merlin' ),
        'section'  => 'merlin_section_postmeta',
        'settings' => 'merlin_theme_options[meta_tags]',
        'type'     => 'checkbox',
		'priority' => 7
		)
	);

}
add_action( 'customize_register', 'merlin_customize_register_postmeta_settings' );