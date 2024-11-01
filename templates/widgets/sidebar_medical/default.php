<?php 
global $medical; 

$limit  	= isset($num) ? $num : 4;
$parent_id = get_the_ID();
$post_ids = Opalmedical_Query::getMedicalId(get_the_ID());
$currentids =  array_merge(array(get_the_ID()),$post_ids);
$array 	= array(
			'posts_per_page' 	=> $limit,
			'post__in'			=> $currentids, 
			'orderby' 			=> 'post__in'
			);
$medicals = Opalmedical_Query::getMedicalQuery($array);
?>
<div class="opalmedical-categories widget">
	<?php if(!empty($title)): ?>
	<h3 class="widget-title"><span><span><?php echo esc_html( $title ); ?></span></span></h3>
	<?php endif; ?>

	<ul class="sidebar-medical">
		<?php if( $medicals->have_posts() ): ?>
			<?php while($medicals->have_posts()) : $medicals->the_post() ?>
				<li class="medical-item <?php if($parent_id == get_the_ID()) { echo "active" ; }?>">
					<h4 class="title">
						<a href="<?php the_permalink(); ?>" class="medical-link"><span><?php the_title(); ?></span></a>
					</h4>
				</li> 
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		
	</ul>
</div>
