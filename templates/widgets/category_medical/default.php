<?php 
$limit  	= isset($num) ? $num : 4;
$categories = Opalmedical_Query::getCategoryMedicals($limit);
?>
<div class="opalmedical-categories widget">
	<h3 class="widget-title"><span><span><?php echo esc_html( $title ); ?></span></span></h3>
	<?php if($categories): ?>
	<ul class="medical-categories">
		<?php foreach( $categories as $categorie ) :
			//echo get_the_ID();
			$checkactive = Opalmedical_Query::check_active_category_by_post_id($categorie->term_id,get_the_ID());
			if ($checkactive): ?>
				<li class="cat-item <?php echo "active" ;?>"> 
					<a href="<?php echo esc_url( get_term_link($categorie->term_id, 'opalmedical_category_doctor') );?>" class="categories-link"><span><?php echo trim( $categorie->name ); ?></span></a>
				</li> 
			<?php else: ?>
				<li class="cat-item"> 
					<a href="<?php echo esc_url( get_term_link($categorie->term_id, 'opalmedical_category_doctor') );?>" class="categories-link"><span><?php echo trim( $categorie->name ); ?></span></a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>