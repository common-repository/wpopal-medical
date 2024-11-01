<?php
/**
 * Medical Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Select sanitization function
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function opalmedical_theme_slug_sanitize_select( $input, $setting ){

		// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
		$input = sanitize_key( $input );

		// Get the list of possible select options.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                

}
    	
/**
 * Register individual settings through customizer's API.
 *
 * @param WP_Customize_Manager $wp_customize Customizer reference.
 */    	
if ( ! function_exists( 'opalmedical_post_layout_customize_register' ) ) {
	
	function opalmedical_post_layout_customize_register( $wp_customize ) {

		 
		// Theme layout settings.
		$wp_customize->add_section( 'opalmedical_medical_options', array(
			'title'       => esc_html__( 'Medical Settings', 'opal-medical' ),
			'capability'  => 'edit_theme_options',
			'description' => esc_html__( 'Set Medical layout display in varials style and design', 'opal-medical' ),
			'priority'    => 3,
		) );

		// single Medical 
		$wp_customize->add_setting( 'opalmedical_sidebar_archive_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'opalmedical_sidebar_archive_position', array(
					'label'       => esc_html__( 'Archive Sidebar Position', 'opal-medical' ),
					'description' => esc_html__( 'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
					'opal-medical' ),
					'section'     => 'opalmedical_medical_options',
					'settings'    => 'opalmedical_sidebar_archive_position',
					'type'        => 'select',
					'sanitize_callback' => 'opalmedical_theme_slug_sanitize_select',
					'choices'     => array(
						'right' => esc_html__( 'Right sidebar', 'opal-medical' ),
						'left'  => esc_html__( 'Left sidebar', 'opal-medical' ),
						'both'  => esc_html__( 'Left & Right sidebars', 'opal-medical' ),
						'none'  => esc_html__( 'No sidebar', 'opal-medical' ),
					),
					'priority'    => '20',
				)
		) );

		// single Medical 
		$wp_customize->add_setting( 'opalmedical_sidebar_single_position', array(
			'default'           => 'right',
			'type'              => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'opalmedical_sidebar_single_position', array(
					'label'       => esc_html__( 'Single Sidebar Position', 'opal-medical' ),
					'description' => esc_html__( 'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
					'opal-medical' ),
					'section'     => 'opalmedical_medical_options',
					'settings'    => 'opalmedical_sidebar_single_position',
					'type'        => 'select',
					'sanitize_callback' => 'opalmedical_theme_slug_sanitize_select',
					'choices'     => array(
						'right' => esc_html__( 'Right sidebar', 'opal-medical' ),
						'left'  => esc_html__( 'Left sidebar', 'opal-medical' ),
						'both'  => esc_html__( 'Left & Right sidebars', 'opal-medical' ),
						'none'  => esc_html__( 'No sidebar', 'opal-medical' ),
					),
					'priority'    => '20',
				)
		) );

		// single Medical 
		$wp_customize->add_setting( 'opalmedical_departments_notice', array(
			'type'              => 'theme_mod',
			'sanitize_callback' => 'wp_kses_post',
			'capability'        => 'edit_theme_options',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'opalmedical_departments_notice', array(
					'label'       => esc_html__( 'Departments notice', 'opal-medical' ),
					'description' => '',
					'section'     => 'opalmedical_medical_options',
					'settings'    => 'opalmedical_departments_notice',
					'type'        => 'textarea',
					'priority'    => '20',
				)
		) );

		/// enable or disable preloader 
	}
} // endif function_exists( 'opalmedical_theme_customize_register' ).
add_action( 'customize_register', 'opalmedical_post_layout_customize_register' );

/**
 * Automatic set default values for postion and style, containner width after active the theme.
 */
add_action( 'after_setup_theme', 'opalmedical_setup_theme_default_settings' );
if ( ! function_exists ( 'opalmedical_setup_theme_default_settings' ) ) {
	function opalmedical_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Sidebar position.
		$opalmedical_sidebar_archive_position = get_theme_mod( 'opalmedical_sidebar_archive_position' );
		if ( '' == $opalmedical_sidebar_archive_position ) {
			set_theme_mod( 'opalmedical_sidebar_archive_position', 'none' );
		}

		// Container width.
		$opalmedical_sidebar_single_position = get_theme_mod( 'opalmedical_sidebar_single_position' );
		if ( '' == $opalmedical_sidebar_single_position ) {
			set_theme_mod( 'opalmedical_sidebar_single_position', 'none' );
		}

		
	}
}
?>