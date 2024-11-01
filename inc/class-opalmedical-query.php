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
class Opalmedical_Query {


	public static function getMedicalQuery( $args=array() ){
		$default = array(
			'post_type'         => 'opal_doctor',
		);

		$args = array_merge( $default, $args );
		return new WP_Query( $args );
	}

	public static function getMedicalId($post_id = 0){
		$post_ids = array();
		$array 	= array(
			'post__not_in'			=> array($post_id),
			);
		$sevices = self::getMedicalQuery($array);
		while ($sevices->have_posts()) { $sevices->the_post();
			$post_ids[] = get_the_ID();
		}
		wp_reset_postdata();
		return $post_ids;
	}

	/**
	* @param $term_id is term_id in taxonomy
	* @param $post is name post type
	* @param taxonomy  is name taxonomy
	*/
	public static function get_medical_by_term_id($term_id,$per_page = -1){
		wp_reset_query();
		$args = array();
		if($term_id == 0 || empty($term_id)){
			$args = array(
				'posts_per_page' => $per_page,
				'post_type' => "opal_doctor",
			);
		}else{
			$args = array(
				'posts_per_page' => $per_page,
				'post_type' => "opal_doctor",
				'tax_query' => array(
					array(
						'taxonomy' => "opalmedical_category_doctor",
						'field' => 'term_id',
						'terms' => $term_id,
						'operator' => 'IN'
						)
					)
				);
		}
		return new WP_Query( $args );
	}

	/**
	* @param $term_id is term_id in taxonomy
	* @param $post is name post type
	* @param taxonomy  is name taxonomy
	*/
	public static function get_medical_by_term_slug($term_slug,$per_page = -1){
		wp_reset_query();
		$args = array();
		if($term_slug == 0 || empty($term_slug)){
			$args = array(
				'posts_per_page' => $per_page,
				'post_type' => "opal_doctor",
			);
		}else{
			$args = array(
				'posts_per_page' => $per_page,
				'post_type' => "opal_doctor",
				'tax_query' => array(
					array(
						'taxonomy' => "opalmedical_category_doctor",
						'field' => 'slug',
						'terms' => $term_slug,
						'operator' => 'IN'
						)
					)
				);
		}
		return new WP_Query( $args );
	}

	/**
	* 
	* @param $post is name post type
	* @param taxonomy  is name taxonomy
	*/
	public static function get_the_term_filter_name($post,$taxonomy_name){
		$terms = wp_get_post_terms( $post->ID, $taxonomy_name ,array("fields" => "names") );
		return $terms; 
	}
	/**
	* Get All Categories 
	* @param $args
	*/
	public static function getCategoryMedicals($per_page = 0){
		$args = array(
				  'hide_empty' => false,
				  'orderby' => 'name',
				  'order' => 'ASC',
				  'number' => $per_page,
				);
		$terms = get_terms('opalmedical_category_doctor',$args);
		return $terms;
	}

	/**
	* @param $term_id is term_id in taxonomy
	* @param $post_id is id post type
	*/
	public static function check_active_category_by_post_id($term_id,$post_id){
		$termid = array(); 
		$terms = wp_get_post_terms( $post_id, 'opalmedical_category_doctor');
		foreach ($terms as $term) {
			$termid[] = $term->term_id;
		}
		if(in_array($term_id,$termid)){
			return true;
		}
		return false;
	}


}