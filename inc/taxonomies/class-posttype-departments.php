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
class Opalmedical_PostType_Department{

	/**
	 * init action and filter data to define department post type
	 */
	public static function init(){ 
		
		add_action( 'init', array( __CLASS__, 'definition' ) );
		//
	}

	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
			'name'                  => esc_html__( 'Departments', 'opal-medical' ),
			'singular_name'         => esc_html__( 'Departments', 'opal-medical' ),
			'add_new'               => esc_html__( 'Add Department', 'opal-medical' ),
			'add_new_item'          => esc_html__( 'Add New Department', 'opal-medical' ),
			'edit_item'             => esc_html__( 'Edit Department', 'opal-medical' ),
			'new_item'              => esc_html__( 'New Department', 'opal-medical' ),
			'all_items'             => esc_html__( 'Departments', 'opal-medical' ),
			'view_item'             => esc_html__( 'View Department', 'opal-medical' ),
			'search_items'          => esc_html__( 'Search Department', 'opal-medical' ),
			'not_found'             => esc_html__( 'No Department found', 'opal-medical' ),
			'not_found_in_trash'    => esc_html__( 'No Department found in Trash', 'opal-medical' ),
			'parent_item_colon'     => '',
			'menu_name'      		=> esc_html__( 'Medical Departments', 'opal-medical' ),
        );
        
        $slug_field = opalmedical_get_option( 'slug_department_doctor' );
        $slug = isset($slug_field) ? $slug_field : "department-doctor";

        register_taxonomy( 'opalmedical_department_doctor', 'opal_doctor', array(
			'labels' => array(
            'name'              => esc_html__('Departments','opal-medical'),
            'all_items'         => esc_html__( 'Departments', 'opal-medical' ),
            'add_new_item'      => esc_html__('Add New Departments','opal-medical'),
            'new_item_name'     => esc_html__('New Departments','opal-medical')
        ),

        'hierarchical'  		=> true,
        'query_var'            => true,
        'show_ui'              => true,
        'show_admin_column'    => true,
        'rewrite'       		=> array('slug' => $slug),

        ) );
        
		
	} 

}// end class

Opalmedical_PostType_Department::init();
