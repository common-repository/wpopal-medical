<?php
/**
 * Left sidebar check.
 *
 * @package opalmedical
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if( is_singular('opal_doctor') ){

	$left_sidebar  = apply_filters( "opalmedical_left_sidebar"     , 'left-sidebar-medical' );
	$right_sidebar = apply_filters( "opalmedical_right_sidebar"    , 'right-sidebar-medical' ); 
	$sidebar_pos   = apply_filters( "opalmedical_sidebar_archive_position" , get_theme_mod( 'opalmedical_sidebar_single_position' ) ); 

}else {
	$left_sidebar  = apply_filters( "opalmedical_left_sidebar"     , 'left-sidebar-medical' );
	$right_sidebar = apply_filters( "opalmedical_right_sidebar"    , 'right-sidebar-medical' ); 
	$sidebar_pos   = apply_filters( "opalmedical_sidebar_archive_position" , get_theme_mod( 'opalmedical_sidebar_archive_position' ) ); 
}

?>
<?php if ( 'left' === $sidebar_pos ) {  ?>
	<div class="wp-col-md-4 widget-area column-sidebar" id="sidebar-left-medical" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</div>
<?php } elseif ( 'both' === $sidebar_pos ) { ?>

	<div class="wp-col-md-3 widget-area column-sidebar" id="sidebar-left-medical" role="complementary">
		<?php dynamic_sidebar( $left_sidebar ); ?>
	</div>

<?php } ?>

<?php
	$html = '';
	if ( 'right' === $sidebar_pos || 'left' === $sidebar_pos ) {
		$html = '<div class="';
		if ( ( is_active_sidebar( $right_sidebar ) && 'right' === $sidebar_pos ) || ( is_active_sidebar( $left_sidebar ) && 'left' === $sidebar_pos ) ) {
			$html .= 'wp-col-md-8 content-area" id="primary">';
		} else {
			$html .= 'wp-col-md-12 content-area" id="primary">';
		}

		echo trim( $html ); // WPCS: XSS OK.
	} elseif ( 'both' === $sidebar_pos ) {
		$html = '<div class="';
		if ( is_active_sidebar( $right_sidebar ) && is_active_sidebar( $left_sidebar ) ) {
			$html .= 'wp-col-md-6 content-area" id="primary">';
		} elseif ( is_active_sidebar( $right_sidebar ) || is_active_sidebar( $left_sidebar ) ) {
			$html .= 'wp-col-md-8 content-area" id="primary">';
		} else {
			$html .= 'wp-col-md-12 content-area" id="primary">';
		}

		echo trim( $html ); // WPCS: XSS OK.
 
	} else {
	    echo '<div class="wp-col-md-12 content-area" id="primary">';
	}
