<?php 

if( class_exists("Opalmedical_Query") ):
	$medicals = Opalmedical_Query::getCategoryMedicals($limit);

	if(!is_wp_error( $medicals ) && $medicals):
?>
		<div class="widget widget-medical">
			<div class="widget-content">
				<div class="opalmedical-recent-medical opalmedical-rows">
					<?php if($style === 'carousel'): ?>
						<div class="owl-carousel-play">
							<div class="owl-carousel" data-slide="<?php echo esc_attr($column); ?>">
								<?php foreach($medicals as $medical): ?>
									<?php $image_id = get_term_meta ( $medical->term_id, 'category-image-id', true ); ?>
			                        <div class="item">
			                        	<?php if($image_id = get_term_meta ( $medical->term_id, 'category-image-id', true )): ?>
				                        	<div class="image-category">
				                        		<?php echo wp_get_attachment_image ( $image_id, 'full' ); ?>
				                        	</div>
			                        	<?php endif; ?>
			                        	<h4 class="category-title"><a href="<?php echo esc_url(get_term_link($medical)); ?>"><?php echo esc_html($medical->name);?></a></h4>
			                        	
			                        </div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php else: ?>
						<?php $colclass = floor(12/$column); ?>
						<div class="row">
							<?php foreach($medicals as $key=>$medical): ?>
								<?php $image_id = get_term_meta ( $medical->term_id, 'category-image-id', true ); ?>
		                        <div class="col-lg-<?php echo esc_attr($colclass); ?> col-md-<?php echo esc_attr($colclass); ?> col-sm-6 <?php echo ($key%$column==$column-1)? 'first' : ''; ?>">
		                        	<?php if($image_id = get_term_meta ( $medical->term_id, 'category-image-id', true )): ?>
			                        	<div class="image-category">
			                        		<?php echo wp_get_attachment_image ( $image_id, 'full' ); ?>
			                        	</div>
		                        	<?php endif; ?>
		                        	<h4 class="category-title"><a href="<?php echo esc_url(get_term_link($medical)); ?>"><?php echo esc_html($medical->name);?></a></h4>
		                        </div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>	
				</div>
			</div>	
		</div>
	<?php endif; ?>	
<?php endif; ?>
<?php wp_reset_query();