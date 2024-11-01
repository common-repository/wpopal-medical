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
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function opalmedical_includes( $path, $ifiles=array() ){

    if( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    }else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

/**
* Get data from config files
*
* @param $name
*
* @return mixed
*/
if(!function_exists('get_config')){
    function get_config($name) {
        if (!empty($name)) {
            return require(OPALMEDICAL_LANGUAGE_DIR . "{$name}.php");
        }
    }

}

/**
 *
 */
function opalmedical_menu( $id ){
    global $menu; 

    $menu = new Opalmedical_Menu( $id );

    return $menu; 
}



function opalmedical_options( $key, $default = '' ){
    
    global $opalmedical_options; 
    
    $value =  isset($opalmedical_options[ $key ]) ? $opalmedical_options[ $key ] : $default;
    $value = apply_filters( 'opalmedical_option_', $value, $key, $default );
  
    return apply_filters( 'opalmedical_option_' . $key, $value, $key, $default );
}

/**
 * @return integer
 */
if(!function_exists('convert_integer')){
    function convert_integer( $key, $default = '' ){
        $convert = $key ? $key : $default;
        return (int)$convert;
    }
}
/**
 * @return string boolean
 */
if(!function_exists('convert_boolean')){
    function convert_boolean( $key ){
        if($key == "1"){
           return "true";
        }
        return "false";
    }
}
/**
 *
 *  Applyer function to show unit for menu
 */

function opalmedical_areasize_unit_format( $value='' ){
    return  $value . ' ' . '<span>'.'m2'.'</span>';
}

add_filter( 'opalmedical_areasize_unit_format', 'opalmedical_areasize_unit_format' );

/**
 *
 *  Applyer function to show unit for title
 */
if(!function_exists('opalmedical_fnc_title')){
    //Custom Excerpt Function
    function opalmedical_fnc_title($limit=2,$afterlimit=null) {
        $excerpt = get_the_title();
        if( $excerpt != ''){
           $excerpt = @explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = @explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            @array_pop($excerpt);
            $excerpt = @implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = @implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
} 

/**
 *
 *  Applyer function to show unit for excerpt
 */
if(!function_exists('opalmedical_fnc_excerpt')){
    //Custom Excerpt Function
    function opalmedical_fnc_excerpt($limit,$afterlimit='[...]') {
        $excerpt = get_the_excerpt();
        $limit = empty($limit) ? 20 : $limit;
        if( $excerpt != ''){
           $excerpt = @explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = @explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            @array_pop($excerpt);
            $excerpt = @implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = @implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}

/**
 *
 *  Applyer function to show unit for description 
 */
if(!function_exists('opalmedical_fnc_description')){
    //Custom Excerpt Function
    function opalmedical_fnc_description($limit,$afterlimit='[...]') {
        $excerpt = get_the_content();
        if( $excerpt != ''){
           $excerpt = @explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = @explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            @array_pop($excerpt);
            $excerpt = @implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = @implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}

/**
* Function pagination for plugin
* @param $pages 
* @param $$range
*/
function opalmedical_pagination($pages = '', $range = 2 ) {
    global $paged;

    if(empty($paged))$paged = 1;

    $prev = $paged - 1;
    $next = $paged + 1;
    $showitems = ( $range * 2 )+1;
    $range = 2; // change it to show more links

    if( $pages == '' ){
        global $wp_query;

        $pages = $wp_query->max_num_pages;
        if( !$pages ){
            $pages = 1;
        }
    }

    if( 1 != $pages ){

        echo '<div class="pagination-main">';
            echo '<ul class="pagination">';
                echo ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) ? '<li><a aria-label="First" href="'.get_pagenum_link(1).'"><span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span></a></li>' : '';
                echo ( $paged > 1 ) ? '<li class="page-item"><a class="prev page-link " aria-label="Previous" href="'.get_pagenum_link($prev).'"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>' : '<li class="disabled"><a aria-label="Previous"><span aria-hidden="true"><i class="fa fa-angle-left"></i></span></a></li>';
                for ( $i = 1; $i <= $pages; $i++ ) {
                    if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range-1 ) || $pages <= $showitems ) )
                    {
                        if ( $paged == $i ){
                            echo '<li class="page-item active"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.' <span class="sr-only"></span></a></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                        }
                    }
                }
                echo ( $paged < $pages ) ? '<li class="page-item"><a class="page-link next" aria-label="Next" href="'.get_pagenum_link($next).'"><span aria-hidden="true"><i class="fa fa-angle-right"></i></span></a></li>' : '';
                echo ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) ? '<li><a aria-label="Last" href="'.get_pagenum_link( $pages ).'"><span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span></a></li>' : '';
            echo '</ul>';
        echo '</div>';

    }
}

function medical_add_cpt_support() {
    
    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );
    
    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'opal_medical' ]; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }
    
    //if it DOES exist, but opal_medical is NOT defined
    else if( ! in_array( 'opal_medical', $cpt_support ) ) {
        $cpt_support[] = 'opal_medical'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    //otherwise do nothing, opal_medical already exists in elementor_cpt_support option
}
add_action( 'after_switch_theme', 'medical_add_cpt_support' );

/**
 * Get Settings
 *
 * Portfolio navigation
 *
 * @since 1.0
 * @return array portfolio settings
 */
if( !function_exists("opalmedical_single_navigation") ){
    function opalmedical_single_navigation() { 
        ?>
        <div class="opalmedical-nav-links">
            <div class="nav-list">
                <div class="nav-item prev">
            <?php
            $prev_post = get_previous_post();
            if($prev_post){
            $id = $prev_post->ID ;
            $prev_permalink = get_permalink( $id ); ?>
                    <div class="inner">
                        <a href="<?php echo esc_url($prev_permalink);?> ">
                            <div class="pull-left">
                                <span><?php echo  esc_html('Prev', 'opal-medical' );?></span>
                                <h6><?php echo esc_attr($prev_post->post_title); ?></h6>
                            </div>

                        </a>
                    </div>
            <?php
            }
            ?>
                </div>
                <div class="nav-item next">
            <?php
            $next_post = get_next_post();
            if($next_post){
            $nid = $next_post->ID ;
            $next_permalink = get_permalink($nid); ?>
                    <div class="inner">
                        <a href="<?php echo esc_url($next_permalink);?> ">
                            <div class="pull-right">
                                <span><?php echo  esc_html('Next', 'opal-medical' );?></span>
                                <h6><?php echo esc_attr($next_post->post_title); ?></h6>
                            </div>
                        </a>
                    </div>
            <?php
            } ?>
                </div>
            </div>
        </div>
        <?php
    }
}