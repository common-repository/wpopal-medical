
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $medical, $post;

$medical = new Opalmedical_Medical( get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Medical" <?php post_class(); ?>>
	<div class="row">
		<?php echo Opalmedical_Template_Loader::get_template_part( 'sidebar/left-sidebar-check'); ?>
		
		<?php
			/**
			 * opalmedical_single_medical_preview hook by template-functions.php
			 * @hooked opalmedical_show_product_images - 10
			 * @hooked opalmedical_show_product_images - 15
			 * @hooked opalmedical_show_content - 20
			 */
			do_action( 'opalmedical_single_medical_content' );

			opalmedical_single_navigation();
		?>

		<?php echo Opalmedical_Template_Loader::get_template_part( 'sidebar/right-sidebar-check'); ?>

		

	</div> <!-- //.row -->
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</article><!-- #post-## -->

