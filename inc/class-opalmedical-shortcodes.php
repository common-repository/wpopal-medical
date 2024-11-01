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
class Opalmedical_Shortcodes{
	
	/**
	 *
	 */
	static $shortcodes; 

	/**
	 *
	 */
	public static function init(){
	 	
	 	self::$shortcodes = array(
	 		'carousel_medical' => array( 'code' => 'carousel_medical', 'label' => esc_html__('Carousel Medical', 'opal-medical') ),
	 		'list_medicals' => array( 'code' => 'list_medicals', 'label' => esc_html__('List Medical', 'opal-medical') ),
	 		'tabs_medicals' => array( 'code' => 'tabs_medicals', 'label' => esc_html__('Tabs Medical', 'opal-medical') ),
	 		'categories_medicals' => array( 'code' => 'categories_medicals', 'label' => esc_html__('Categories Medical', 'opal-medical') ),
	 	);

	 	foreach( self::$shortcodes as $shortcode ){
	 		add_shortcode( 'opalmedical_'.$shortcode['code'] , array( __CLASS__, $shortcode['code'] ) );
	 	}

	}

	/**
	* the listing medical
	*/
	public static function list_medicals($args, $content){
		return Opalmedical_Template_Loader::get_template_part( 'shortcodes/list-medical',$args);
	}

	/**
	* the listing medical
	*/
	public static function tabs_medicals($args, $content){
		return Opalmedical_Template_Loader::get_template_part( 'shortcodes/tabs-medical',$args);
	}

	/**
	* the carousel medical
	*/
	public static function carousel_medical($args, $content){
		return Opalmedical_Template_Loader::get_template_part( 'shortcodes/carousel-medical',$args);
	}


	public static function categories_medicals($args, $content){
		return Opalmedical_Template_Loader::get_template_part( 'shortcodes/categories-medical',$args);
	}


}

Opalmedical_Shortcodes::init();