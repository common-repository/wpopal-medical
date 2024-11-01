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

/**
 *
 */
function opalmedical_template_init(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'opalmedical_displaymode', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['opalmedical_displaymode'] = trim($_GET['display']);
	}
}

add_action( 'init', 'opalmedical_template_init' );

function opalmedical_get_current_url(){

	global $wp;
	$current_url = home_url(add_query_arg(array(),$wp->request));
 	
 	return $current_url;
}

/**
* |----------------------------------------
* | Single Medical
* |----------------------------------------
*/ 

/**
 * single content
 */
function opal_medical_content(){
	echo Opalmedical_Template_Loader::get_template_part( 'single-medical/content' );
}
/**
 * single price list
 */
function opal_medical_other_medical(){
	echo Opalmedical_Template_Loader::get_template_part( 'single-medical/other-medical' );
}

/**
 * single contact
 */
function opal_medical_contact(){
	echo Opalmedical_Template_Loader::get_template_part( 'single-medical/contacts' );
}

//--
add_action( 'opalmedical_single_medical_content', 'opal_medical_content', 10 );
//--

//add_action( 'opalmedical_after_single_medical_summary', 'opal_medical_tags', 35 );

/**
 * Set sidebar position
 */
function opalmedical_sidebar_archive_position( $pos ){
    if( is_single() && get_post_type() == 'opal_medical' ){
        return get_theme_mod( 'opalmedical_sidebar_single_position' );
    }
    return $pos; 
}
add_filter( 'opalmedical_sidebar_archive_position', 'opalmedical_sidebar_archive_position' );


function medical_loop_layouts(){
	return apply_filters(
		'medical_loop_layouts', array(
		    'grid_v1'       => 'Grid',
            'list_v1'       => 'List',
		)
	);
}
