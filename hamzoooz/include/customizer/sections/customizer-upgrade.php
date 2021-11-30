<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package Merlin
 */


/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object
 */
function merlin_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section
	$wp_customize->add_section( 'merlin_section_upgrade', array(
        'title'    => esc_html__( 'More Features', 'merlin' ),
        'priority' => 70,
		'panel' => 'merlin_options_panel' 
		)
	);
	
	// Add custom Upgrade Content control
	$wp_customize->add_setting( 'merlin_theme_options[upgrade]', array(
        'default'           => '',
		'type'           	=> 'option',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( new Merlin_Customize_Upgrade_Control(
        $wp_customize, 'merlin_theme_options[upgrade]', array(
            'section' => 'merlin_section_upgrade',
            'settings' => 'merlin_theme_options[upgrade]',
            'priority' => 1
            )
        )
    );

}
add_action( 'customize_register', 'merlin_customize_register_upgrade_settings' );