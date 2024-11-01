
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $medical, $post;
$medical = new Opalmedical_Medical( get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Property" <?php post_class(); ?>>
	<div class="row">
		<div class="col-lg-12">
			<?php
				/**
				 * opalmedical_single_medical_preview hook by template-functions.php
				 * @hooked opalmedical_show_product_images - 10
				 * @hooked opalmedical_show_product_images - 15
				 * @hooked opalmedical_show_content - 20
				 */
				do_action( 'opalmedical_single_medical_content' );
			?>
		</div>
		 
	</div> <!-- //.row -->
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</article><!-- #post-## -->

