<?php
if(!empty($category)){
    $categorys = explode(',', $category);
}else{
    $categorys = '';
}

$id = rand(time(),888);
if( class_exists("Opalmedical_Query") ):
$query = Opalmedical_Query::get_medical_by_term_slug( $categorys, $limit );
echo '<pre>'.print_r($query, 1).'</pre>';
$args_template = array(
					'show_readmore'		=>$show_readmore,
					'max_char'			=>$max_char,
					'image_size'		=>$image_size,
					'other_size'		=>$other_size,
					'query'				=>$query,
					'layout'			=>$layout,
					'title'				=>$title,
					);
?>
<div class="widget widget-medical">
	<div class="opalmedical-recent-medical opalmedical-rows medical-tabs medical-<?php echo esc_attr( $layout ); ?> medical-<?php echo esc_attr($style); ?>">
		
		<?php if( $query->have_posts() ): ?> 
			<?php if($layout == "tabs_v1"): ?>
			<div class="row">
			<div class="col-md-6 col-sm-12 block-left"> <!-- required for floating -->
			<?php endif; ?>
			    <!-- Nav tabs -->
			    <ul class="nav nav-tabs <?php if($layout == "tabs_v1"){ ?> <?php } ?>">
			    <?php $i = 0; while ( $query->have_posts() ) : $query->the_post(); 
			    $medical = new Opalmedical_Medical( get_the_ID() );
			    $icon = $medical->getIcon();
				$iconpicker = $medical->getIconPicker();
			    ?>
			
			      <li class="<?php if ( $i == 0 ){ echo "active"; } ?> ">
			      	<a href="#medical-<?php echo get_the_ID().$id; ?>" data-toggle="tab"> 
				      	<?php if(!empty($icon)): ?>
				         	<img src="<?php echo esc_url_raw( $icon ); ?>" alt="icon"><span><?php echo opalmedical_fnc_title(3);?></span>
					    <?php else: ?>
					        <i class="fa <?php echo esc_attr( $iconpicker ); ?>"></i><span><?php echo opalmedical_fnc_title(3);?></span>
					    <?php endif; ?>
			      	</a>
			      </li>
			    <?php $i++; endwhile; ?>
			    </ul>
			<?php if($layout == "tabs_v1"): ?>
			</div>
			<?php endif; ?>
			<?php if($layout == "tabs_v1"): ?>
			<div class="col-md-6 col-sm-12 block-right">
			<?php endif; ?>
			    <!-- Tab panes -->
			    <div class="tab-content">
			    <?php $i = 0; while ( $query->have_posts() ) : $query->the_post(); ?>
			      	<div class="tab-pane <?php if ( $i == 0 ){ echo "active"; } ?>" id="medical-<?php echo get_the_ID().$id; ?>">
			      		<?php echo Opalmedical_Template_Loader::get_template_part( 'content-medical-tabs',$args_template ); ?>
			      	</div>
			     <?php $i++; endwhile; ?>
			    </div>
			<?php if($layout == "tabs_v1"): ?>
			</div>
			</div>
			<?php endif; ?>
		<?php endif; //have_posts?>
		
	</div>	
</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>