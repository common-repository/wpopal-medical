<?php 

if( $limit < $column){
	$limit = $column;
}
if(empty($category)){
	$categorys = '';
}else{
	$categorys = explode(',', $category);
}

if( class_exists("Opalmedical_Query") ):
	$query = Opalmedical_Query::get_medical_by_term_slug( $categorys, $limit );
	$colclass = floor(12/$column);  
	$args_template = array(
		'show_category'		=> $show_category,
		'show_description'	=> $show_description,
		'show_thumbnail'	=> $show_thumbnail,
		'show_readmore'		=> $show_readmore,
		'max_char'			=> $max_char,
		'image_size'		=> $image_size,
		'other_size'		=> $other_size,
		'query'				=> $query,
		'title'				=> $title,
		'description'		=> $description,
	);
	?>
	<div class="widget widget-medical">
		<div class="opalmedical-recent-medical opalmedical-rows">
		<?php if( $query->have_posts() ): ?> 
				<div class="elementor-grid elementor-items-container">
					<?php $cnt=0; while ( $query->have_posts() ) : $query->the_post(); 
						$cls = '';
						if( $cnt++%$column==0 ){
							$cls .= ' first-child';
						}
						$args_template['number'] = $cnt;
						?>
						<div class="column-item <?php echo esc_attr($cls); ?>">
							<?php echo Opalmedical_Template_Loader::get_template_part( 'content-medical-grid',$args_template ); ?>	
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; //have_posts?>
		</div>	
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>