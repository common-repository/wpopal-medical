<?php 
if( $limit < $column){
	$limit = $column;
}
$_id = wp_generate_uuid4();

if ($category && !empty($category)) {
	$categories = explode(',', $category);
}else{
	$categories = '';
}

if( class_exists("Opalmedical_Query") ):
    $query = Opalmedical_Query::get_medical_by_term_slug( $categories, $limit );
    $args_template = array(
        'show_category'      => $show_category,
        'show_thumbnail'     => $show_thumbnail,
        'show_description'   => $show_description,
        'max_char'           => $max_char,
        'image_size'         => $image_size,
        'other_size'         => $other_size,
        'show_readmore'      => $show_readmore,
        'title'              => $title,
        'description'        => $description,
        'column'             => $column,
        'table_column'       => $table_column,
        'mobile_column'      => $mobile_column, 
        'enable_pagination'  => $enable_pagination,
        'speed'              => $speed,
        'autoplay'           => $autoplay,
    );
?>
<div class="widget widget-medical">
    <div class="opalmedical-carousel opalmedical-rows">
        <?php if( $query->have_posts() ): ?>
        
            <div class="elementor-slick-slider elementor-medical-slick-slider" data-slides-show="<?php echo esc_attr($column); ?>" data-table-columns="<?php echo esc_attr($table_column); ?>" data-mobile-columns="<?php echo esc_attr($mobile_column); ?>"  data-pagination="<?php echo esc_attr($enable_pagination); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-speed="<?php echo esc_attr($speed); ?>" >
               
                <?php $cnt=0; while ( $query->have_posts() ) : $query->the_post(); 
                    $cls = '';
                    if( $cnt++%$column==0 ){
                        $cls .= ' first-child';
                    }
                    $args_template['number'] = $cnt;
                    ?>
                    <div class="slick-slide">
                            <?php echo Opalmedical_Template_Loader::get_template_part( 'content-medical-grid',$args_template ); ?>  
                    </div>
                <?php endwhile; ?>
               
            </div>
            <div class="slick-pagination-custom">
                <div class="progressbar">
                    <div class="filled"></div>
                </div>
            </div>
        <?php else: ?>
            <?php echo Opalmedical_Template_Loader::get_template_part( 'content-data-none' ); ?>
        <?php endif; ?>
    </div>
</div>	
<?php endif; ?>
<?php wp_reset_query(); ?>