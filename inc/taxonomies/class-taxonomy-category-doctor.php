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
class Opalmedical_Taxonomy_Category_Medical{

	/**
	 *
	 */
	public static function init(){
		add_action( 'init', array( __CLASS__, 'definition' ) );
	}

	/**
	 *
	 */
	public static function definition(){
		
		$labels = array(
        'name'              => esc_html__( 'Doctor Categories', "opalmedical" ),
        'singular_name'     => esc_html__( 'Doctor Category', "opalmedical" ),
        'search_items'      => esc_html__( 'Search Category Doctor', "opalmedical" ),
        'all_items'         => esc_html__( 'Doctor Categories', "opalmedical" ),
        'parent_item'       => esc_html__( 'Parent Doctor Category', "opalmedical" ),
        'parent_item_colon' => esc_html__( 'Parent Doctor Category:', "opalmedical" ),
        'edit_item'         => esc_html__( 'Edit Doctor Category', "opalmedical" ),
        'update_item'       => esc_html__( 'Update Doctor Category', "opalmedical" ),
        'add_new_item'      => esc_html__( 'Add New Doctor', "opalmedical" ),
        'new_item_name'     => esc_html__( 'New Doctor Category Name', "opalmedical" ),
        'menu_name'         => esc_html__( 'Doctor Categories', "opalmedical" ),
        );
		
        $slug_field = opalmedical_get_option( 'slug_category_doctor' );
        $slug = isset($slug_field) ? $slug_field : "category-doctor";
		register_taxonomy( 'opalmedical_category_doctor', 'opal_doctor', array(
			'labels' => array(
            'name'              => esc_html__('Categories','opal-medical'),
            'all_items'         => esc_html__( 'Doctor Categories', 'opal-medical' ),
            'add_new_item'      => esc_html__('Add New Doctor Category','opal-medical'),
            'new_item_name'     => esc_html__('New Doctor Category','opal-medical')
        ),
        'hierarchical'  		=> true,
        'query_var'            => true,
        'show_ui'              => true,
        'show_admin_column'    => true,
        'rewrite'       		=> array('slug' => $slug),
		) );
	}



}

Opalmedical_Taxonomy_Category_Medical::init();