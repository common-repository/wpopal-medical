<?php
/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalmedical
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2016 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Opalmedical_PostType_Medical{

	/**
	 * init action and filter data to define medical post type
	 */
	public static function init(){ 
		
		add_action( 'init', array( __CLASS__, 'definition' ) );
		//-- custom add column to list post
		add_filter( 'manage_opal_medical_posts_columns',array(__CLASS__,'init_medical_columns'),10);
		add_action("manage_opal_medical_posts_custom_column", array(__CLASS__, "show_medical_columns"), 10, 2);
		// /End
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'metaboxes' ) );
		//
		define( 'OPALMEDICAL_MEDICAL_PREFIX', 'opal_medical_' );

	}

	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
			'name'                  => esc_html__( 'Doctor', 'opal-medical' ),
			'singular_name'         => esc_html__( 'Doctors', 'opal-medical' ),
			'add_new'               => esc_html__( 'Add Doctor', 'opal-medical' ),
			'add_new_item'          => esc_html__( 'Add New Doctor', 'opal-medical' ),
			'edit_item'             => esc_html__( 'Edit Doctor', 'opal-medical' ),
			'new_item'              => esc_html__( 'New Doctor', 'opal-medical' ),
			'all_items'             => esc_html__( 'Doctors', 'opal-medical' ),
			'view_item'             => esc_html__( 'View Doctor', 'opal-medical' ),
			'search_items'          => esc_html__( 'Search Doctor', 'opal-medical' ),
			'not_found'             => esc_html__( 'No Doctor found', 'opal-medical' ),
			'not_found_in_trash'    => esc_html__( 'No Doctor found in Trash', 'opal-medical' ),
			'parent_item_colon'     => '',
			'menu_name'      		=> esc_html__( 'Opal Medicals', 'opal-medical' ),
		);

		$labels = apply_filters( 'opalmedical_postype_medical_labels' , $labels );
		$slug_field = opalmedical_get_option( 'slug_doctor' );
		$slug = isset($slug_field) ? $slug_field : "doctor";
		register_post_type( 'opal_doctor',
			array(
				'labels'            		=> $labels,
				'supports'          		=> array('title', 'editor','excerpt','thumbnail' ),
				'public'            		=> true,
				'has_archive'       		=> true,
				'rewrite'           		=> array( 'slug' => $slug ),
				'menu_position'   			=> 6,
				'categories'        		=> array(),
				'menu_icon'       			=> 'dashicons-admin-home',
			)
		);
	}

		/**
	 * Add custom taxonomy columns
	 *
	 * @param $columns
	 *
	 * @return array
	 */
	public static function init_medical_columns($columns) {
		$columns = array_slice($columns, 0, 1, true) + array(OPALMEDICAL_MEDICAL_PREFIX .'thumb' => esc_html__("Image", 'opal-medical')) + array_slice($columns, 1, count($columns) - 1, true);		
		return $columns;
	}

	/**
	 * Add content to custom column
	 *
	 * @param $column
	 */
	public static function show_medical_columns($column, $post_ID) {

		global $post;
		switch ($column) {
			case OPALMEDICAL_MEDICAL_PREFIX .'thumb':
				echo '<a href="' . get_edit_post_link($post->ID) . '">' . get_the_post_thumbnail($post_ID,array( 100, 100)) . '</a>';
				break;
		}
	}



	/**
	 *
	 */
	public static function metaboxes( array $metaboxes ) {
		$prefix = OPALMEDICAL_MEDICAL_PREFIX; 		
		//$metaboxes = array();
		$metaboxes[ $prefix . 'personal_info' ] = array(
			'id'                        => $prefix . 'personal_info',
			'title'                     => esc_html__( 'Personal info', 'opal-medical' ),
			'object_types'              => array( 'opal_doctor' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => self::metaboxes_management_fields()
		);

		$metaboxes[ $prefix . 'social_info' ] = array(
			'id'                        => $prefix . 'social_info',
			'title'                     => esc_html__( 'Social info', 'opal-medical' ),
			'object_types'              => array( 'opal_doctor' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => self::metaboxes_social_info_fields()
		);

		return $metaboxes;
	}

	/**
	 *
	 */	
	public static function metaboxes_management_fields(){
		$prefix = OPALMEDICAL_MEDICAL_PREFIX;
		$fields = array(
			array(
				'name'       => esc_html__( 'Phone', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'phone',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Office', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'office',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Email', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'email',
				'type'       => 'text_email',
			)
		);

		return apply_filters( 'opalmedical_postype_medical_metaboxes_fields_managements' , $fields );
	}

	/**
	 *
	 */	
	public static function metaboxes_social_info_fields(){
		$prefix = OPALMEDICAL_MEDICAL_PREFIX;
		$fields = array(
			array(
				'name'       => esc_html__( 'Facebook', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'facebook',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Twitter', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'twitter',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Google Plus', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'google',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Skype', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'skype',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Linkedin', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'linkedin',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Pinterest', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'pinterest',
				'type'       => 'text',
			),
			array(
				'name'       => esc_html__( 'Youtube', 'opal-medical' ),
				'desc'       => '',
				'id'         => $prefix . 'youtube',
				'type'       => 'text',
			),
		);

		return apply_filters( 'opalmedical_postype_doctor_metaboxes_fields_socials' , $fields );
	}

}// end class

Opalmedical_PostType_Medical::init();
