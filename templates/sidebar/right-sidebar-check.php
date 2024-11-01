<?php
/**
 * Right sidebar check.
 *
 * @package wpopalbootstrap
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

</div><!-- #closing the primary container from /global-templates/left-sidebar-check.php -->

<?php if ( 'right' === $sidebar_pos ) {  ?>
	<div class="wp-col-md-4 widget-area column-sidebar" id="sidebar-right-medical" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</div>
<?php } elseif ( 'both' === $sidebar_pos ) { ?>

	<div class="wp-col-md-3 widget-area column-sidebar" id="sidebar-right-medical" role="complementary">
		<?php dynamic_sidebar( $right_sidebar ); ?>
	</div>

<?php } ?>
