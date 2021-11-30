<?php
/**
 * General Settings
 *
 * Register General section, settings and controls for Theme Customizer
 *
 * @package Merlin
 */


/**
 * Adds all general settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object
 */
function merlin_customize_register_general_settings( $wp_customize ) {

	// Add Section for Theme Options
	$wp_customize->add_section( 'merlin_section_general', array(
        'title'    => esc_html__( 'General Settings', 'merlin' ),
        'priority' => 10,
		'panel' => 'merlin_options_panel' 
		)
	);
	
	// Add Settings and Controls for Layout
	$wp_customize->add_setting( 'merlin_theme_options[layout]', array(
        'default'           => 'right-sidebar',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_select'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[layout]', array(
        'label'    => esc_html__( 'Theme Layout', 'merlin' ),
        'section'  => 'merlin_section_general',
        'settings' => 'merlin_theme_options[layout]',
        'type'     => 'radio',
		'priority' => 1,
        'choices'  => array(
            'left-sidebar' => esc_html__( 'Left Sidebar', 'merlin' ),
            'right-sidebar' => esc_html__( 'Right Sidebar', 'merlin' )
			)
		)
	);
	
	// Add Sticky Navigation Setting
	$wp_customize->add_setting( 'merlin_theme_options[sticky_nav_headline]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Header_Control(
        $wp_customize, 'merlin_theme_options[sticky_nav_headline]', array(
            'label' => esc_html__( 'Sticky Navigation', 'merlin' ),
            'section' => 'merlin_section_general',
            'settings' => 'merlin_theme_options[sticky_nav_headline]',
            'priority' => 2
            )
        )
    );
	$wp_customize->add_setting( 'merlin_theme_options[sticky_nav]', array(
        'default'           => false,
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'merlin_sanitize_checkbox'
		)
	);
    $wp_customize->add_control( 'merlin_theme_options[sticky_nav]', array(
        'label'    => esc_html__( 'Enable sticky menu on large screens', 'merlin' ),
        'section'  => 'merlin_section_general',
        'settings' => 'merlin_theme_options[sticky_nav]',
        'type'     => 'checkbox',
		'priority' => 3
		)
	);

	
}
add_action( 'customize_register', 'merlin_customize_register_general_settings' );