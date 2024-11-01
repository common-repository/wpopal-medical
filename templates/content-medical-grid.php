<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $medical, $post; 
$medical = new Opalmedical_Medical( get_the_ID() );
$categories = $medical->getCategoryTax();
$departments = $medical->getDepartmentTax();
//---
$show_thumbnail_option = opalmedical_get_option('medical_show_thumbnail');
$show_thumbnail_option = ($show_thumbnail_option == true) ? $show_thumbnail_option : 0;
$show_thumbnail = isset($show_thumbnail) ? $show_thumbnail : $show_thumbnail_option; // check exists kingc
//---
$show_category_option = opalmedical_get_option('medical_show_category');
$show_category_option = ($show_category_option == true) ? $show_category_option : 0;
$show_category = isset($show_category) ? $show_category : $show_category_option; // check exists kingc
//---
$show_description_option = opalmedical_get_option('medical_show_description');
$show_description_option = ($show_description_option == true) ? $show_description_option : 0;
$show_description = isset($show_description) ? $show_description : $show_description_option; // check exists kingc
//---
$show_readmore_option = opalmedical_get_option('medical_show_readmore');
$show_readmore_option = ($show_readmore_option == true) ? $show_readmore_option : 0;
$show_readmore = isset($show_readmore) ? $show_readmore : $show_readmore_option; // check exists kingc
//---
$max_char_option = opalmedical_get_option('medical_max_char');
$max_char_option = ($max_char_option == true) ? $max_char_option : 15;
$max_char = isset($max_char) ? $max_char : $max_char_option;// check exists kingc
//---
$image_size_option = opalmedical_get_option('medical_image_size');
$image_size_option = ($image_size_option == true) ? $image_size_option :'large';
$image_size = isset($image_size) ? $image_size : $image_size_option;// check exists kingc

$other_size_option = opalmedical_get_option('medical_other_size');
$other_size_option = ($other_size_option == true) ? $other_size_option :'279x230';
$other_size = isset($other_size) ? $other_size : $other_size_option;// check exists kingc


$imgresizes = "";
if($image_size == 'other'){
	$imgtemp = explode('x', $other_size);
	$imgresizes = array((int)$imgtemp[0],(int)$imgtemp[1]);
}else{
	$imgresizes = $image_size;
}
$thumb = array();
if($show_thumbnail && has_post_thumbnail()){
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $imgresizes );
}

$layout = isset($layout) ? $layout : "";
?>
<article itemscope itemtype="http://schema.org/Medical" <?php post_class('page'); ?>>
	<?php do_action( 'opalmedical_before_medical_loop_item' ); ?>
	<div class="medical-wrapper">
	 	<?php if($show_thumbnail): ?>
			<header>			
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="medical-box-image">
				        <a href="<?php the_permalink(); ?>" class="medical-box-image-inner ">	
				         	<?php the_post_thumbnail( $imgresizes ); ?>
				        </a>
					</div>
				<?php endif; ?>
			</header>
	 	<?php endif; ?>
		<div class="entry-content">
			<?php the_title( '<h4 class="medical-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
			<?php if($show_category): ?>
		     <div class="medical-categories info">
		     <?php foreach( $departments as $department ) :
		     			$namect = $department->name.',';
			     		if ($department === end($departments) || count($departments) == 1){
			     			$namect = $department->name;
			     		}?>
			     	<a href="<?php echo esc_url( get_term_link($department->term_id, 'opalmedical_department_doctor') );?>" class="departments-link"><span><?php echo trim( $namect ); ?></span> </a>
				<?php endforeach; ?>
		     </div>
			<?php endif; ?>
			<div class="medical-content">
				<?php if($show_description): ?>
					<div class="medical-description">
						<?php echo opalmedical_fnc_excerpt($max_char,'...'); ?>
					</div>
				<?php endif?>
				<?php if($show_readmore): ?>
				<div class="medical-readmore">
					<a href="<?php echo esc_url( get_permalink() );?>">Read More <i class="fa fa-angle-right"></i> </a>
				</div>
				<?php endif?>
			</div>
			<?php echo Opalmedical_Template_Loader::get_template_part('single-medical/social'); ?>	
		</div><!-- .entry-content -->
	</div>
	<?php do_action( 'opalmedical_after_medical_loop_item' ); ?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</article><!-- #post-## -->
