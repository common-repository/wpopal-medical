<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header(); ?>
<section id="main-container" class="site-main container" role="main">
	<?php if ( have_posts() ) : ?>
		<div class="single-opalmedical-container">
			<?php while ( have_posts() ) : the_post(); ?>
                <?php echo Opalmedical_Template_Loader::get_template_part( 'content-single-medical' ); ?>
			<?php endwhile; ?>
		</div>
		<?php
			/**
			 * opalmedical_after_single_medical_summary hook
			 *
			 * @hooked opalmedical_output_product_data_tabs - 10
			 * @hooked opalmedical_upsell_display - 15
			 * @hooked opalmedical_output_related_products - 20
			 */
			do_action( 'opalmedical_after_single_medical_summary' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
								
		?>
	<?php else : ?>
		<?php echo Opalmedical_Template_Loader::get_template_part( 'content-data-none' ); ?>
	<?php endif; ?>
</section><!-- .content-area -->

<?php get_footer(); ?>
