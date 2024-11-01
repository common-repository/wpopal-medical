	<?php
/**
 * The template for displaying Category pages
 *
 * @link http://www.wpopal.com/theme/crewtransport/
 *
 * @package WpOpal
 * @subpackage Crewmedical
 * @since Crewmedical 1.0
 */

get_header();


$column = opalmedical_get_option('column_medical') ? opalmedical_get_option('column_medical') : 3;
$colclass = floor(12/$column); 
$showmode = opalmedical_get_option('medical_view') ? opalmedical_get_option('medical_view') : "grid"; 
//test

?>
<section id="main-container" class="container">
	<div class="row">
		<?php echo Opalmedical_Template_Loader::get_template_part( 'sidebar/left-sidebar-check'); ?>
			<div id="content" class="site-content" role="main">
				<?php if ( have_posts() ) : ?>
					<div class="medical-archive-medicals">
						<div class="row">
							<?php $cnt=0; while ( have_posts() ) : the_post();
							$cls = '';

							if( $cnt++%$column==0 ){
								$cls .= ' first-child';
							} ?>
							<div class="wp-col-lg-<?php echo esc_attr($colclass); ?> wp-col-md-6 wp-col-sm-12 <?php echo esc_attr($cls); ?>">
								<?php echo Opalmedical_Template_Loader::get_template_part( 'content-medical-grid', array('number' => $cnt) ); ?>
							</div>
							
							<?php endwhile; ?>
						</div>
					</div>
			<?php  opalmedical_pagination(); ?>
			<?php else : ?>
				<?php echo Opalmedical_Template_Loader::get_template_part( 'content-data-none' ); ?>
			<?php endif; ?>

			</div><!-- #content -->
		<?php echo Opalmedical_Template_Loader::get_template_part( 'sidebar/right-sidebar-check'); ?>
	</div>
<?php get_sidebar( 'content' ); ?>
</section>
<?php
get_footer();

