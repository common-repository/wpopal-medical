<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

/**
 * Class OSF_Elementor_Blog
 */
class OSV_Elementor_Widget_Medicalcarousel extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-medicalcarousel';
    }

    public function get_title() {
        return esc_html__('Opal Medical Carousel', 'opalelementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
    }
    
    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'jquery-slick' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__('Query', 'opalelementor'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__('Posts Per Page', 'opalelementor'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'     => esc_html__('Columns', 'opalelementor'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 3,
                'options' => [
                    '0' => 'Auto',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'    => esc_html__('Categories', 'opalelementor'),
                'type'     => Controls_Manager::SELECT2,
                'options'  => $this->get_post_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'display_autoplay',
            [
                'label'       => esc_html__('Autoplay', 'opalelementor'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'no',
            ]
        );
        $this->add_control(
            'speed',
            [
                'label'   => esc_html__('Speed', 'opalelementor'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
                'condition' => [
                    'display_autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'other_size',
            [
                'label'     => esc_html__('Other Image Size', 'opalelementor'),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => '350x350',
                'condition' => [
                    'image_size' => 'other'
                ],
            ]
        );

        $this->add_control(
            'display_heading',
            [
                'label' => esc_html__('Display', 'opalelementor'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'display_thumbnail',
            [
                'label'       => esc_html__('Show Thumbnail', 'opalelementor'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label'     => esc_html__('Image Size', 'opalelementor'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'large',
                'options'   =>  [
                    'thumbnail'         => 'Thumbnail',
                    'medium'            => 'Medium',
                    'large'             => 'Large',
                    'full'              => 'Full',
                    'other'             => 'Other size',
                ],
                'condition' => [
                    'display_thumbnail' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'display_category',
            [
                'label'       => esc_html__('Show Category', 'opalelementor'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );


        $this->add_control(
            'display_description',
            [
                'label'       => esc_html__('Show Description', 'opalelementor'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );
        $this->add_control(
            'max_char',
            [
                'label'       => esc_html__('Description Max Chars', 'opalelementor'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 10,
                'condition' => [
                    'display_description' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'display_readmore',
            [
                'label'       => esc_html__('Show Readmore', 'opalelementor'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );

        $this->add_control(
            'display_pagination',
            [
                'label'       => esc_html__('Show Pagination', 'opalelementor'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'opalelementor' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'left',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'opalelementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'opalelementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'opalelementor' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} article, {{WRAPPER}} .entry-content' => 'text-align: {{VALUE}}',
                ],
                'prefix_class' => 'layout-icon-',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_box',
            [
                'label'     => esc_html__('General', 'opalelementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'box_background',
            [
                'label'     => esc_html__('Background', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-medical article' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .widget-medical article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box_margin',
            [
                'label' => esc_html__( 'Margin', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'default'    => [
                    'top'    => 0,
                    'right'  => 10,
                    'bottom' => 0,
                    'left'   => 10,
                    'unit '  => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .widget-medical article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_content_padding',
            [
                'label' => esc_html__( 'Content padding', 'opalelementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'box_content_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .entry-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label'     => esc_html__('Icon', 'opalelementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .medical-box-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .medical-box-icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article:hover .medical-box-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} article:hover .medical-box-icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
	        'icon_size',
	        [
	            'label' => esc_html__( 'Icon Size', 'opalelementor' ),
	            'type' => Controls_Manager::SLIDER,
	            'default' => [
	                'size' => 50,
	            ],
	            'range' => [
	                'px' => [
	                    'min' => 6,
	                ],
	            ],
	            'selectors' => [
	                '{{WRAPPER}} .medical-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
	                '{{WRAPPER}} .medical-box-icon .icon-image' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
	            ],
	        ]
        );
        
        $this->add_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .medical-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margin', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .medical-box-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();  

        $this->start_controls_section(
            'section_image',
            [
                'label'     => esc_html__('Image', 'opalelementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .medical-box-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_margin',
            [
                'label' => esc_html__( 'Margin', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .medical-box-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'opalelementor'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .medical-box-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();  

        $this->start_controls_section(
            'section_title',
            [
                'label'     => esc_html__('Title', 'opalelementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .entry-content .medical-title a',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article .medical-title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Color hover', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article .medical-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} article .medical-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} article .medical-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();   

        $this->start_controls_section(
            'section_description',
            [
                'label'     => esc_html__('Description', 'opalelementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} article .medical-description, {{WRAPPER}} article .medical-description p',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article .medical-description, {{WRAPPER}} article .medical-description p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} article .medical-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__( 'Margin', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} article .medical-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();   

        $this->start_controls_section(
            'section_button',
            [
                'label'     => esc_html__('Button', 'opalelementor'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} article .medical-readmore a',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__('Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article .medical-readmore a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__('Color hover', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article .medical-readmore a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} article .medical-readmore a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} article .medical-readmore a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->end_controls_section();   
    }

    protected function get_post_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'opalmedical_category_doctor',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }



    
    public function get_posts_nav_link($page_limit = null) {
        if (!$page_limit) {
            $page_limit = $this->query_posts()->max_num_pages;
        }

        $return = [];

        $paged = $this->get_current_page();

        $link_template     = '<a class="page-numbers %s" href="%s">%s</a>';
        $disabled_template = '<span class="page-numbers %s">%s</span>';

        if ($paged > 1) {
            $next_page = intval($paged) - 1;
            if ($next_page < 1) {
                $next_page = 1;
            }

            $return['prev'] = sprintf($link_template, 'prev', get_pagenum_link($next_page), $this->get_settings('pagination_prev_label'));
        } else {
            $return['prev'] = sprintf($disabled_template, 'prev', $this->get_settings('pagination_prev_label'));
        }

        $next_page = intval($paged) + 1;

        if ($next_page <= $page_limit) {
            $return['next'] = sprintf($link_template, 'next', get_pagenum_link($next_page), $this->get_settings('pagination_next_label'));
        } else {
            $return['next'] = sprintf($disabled_template, 'next', $this->get_settings('pagination_next_label'));
        }

        return $return;
    }
    


    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if(!empty( $settings['categories'])){
            $categories = array();
            foreach($settings['categories'] as $category){
                $cat = get_term_by('slug', $category, 'opalmedical_category_doctor');
                if(!is_wp_error($cat) && is_object($cat)){
                    $categories[] = $cat->slug;
                }
            }
            
            $category = esc_attr( implode( ',', $categories ) ) ;
        } else {
            $category = '';
        }
        
        $limit              = $settings[ 'posts_per_page' ];
        $column             = $settings[ 'column'];
        $table_column       = $settings[ 'column_tablet'] ? $settings[ 'column_tablet'] : 2;
        $mobile_column      = $settings[ 'column_mobile'] ? $settings[ 'column_mobile'] : 1;
        $show_category      = $settings[ 'display_category'];
        $show_readmore      = $settings[ 'display_readmore'];
        $show_description   = $settings[ 'display_description'];
        $show_thumbnail     = $settings[ 'display_thumbnail'];
        $max_char           = $settings[ 'max_char'];
        $image_size         = $settings[ 'image_size'];
        $other_size         = $settings[ 'other_size'];
        $show_pagination    = $settings[ 'display_pagination'];
        $speed              = $settings[ 'speed'];
        $autoplay           = $settings[ 'display_autoplay' ];

            echo do_shortcode( '[opalmedical_carousel_medical
                category="'.$category.'" 
                limit="'.$limit.'" 
                column="'.$column.'" 
                table_column="'.$table_column.'" 
                mobile_column="'.$mobile_column.'" 
                title="" 
                image_size="'.$image_size.'" 
                other_size="'.$other_size.'" 
                max_char="'.$max_char.'" 
                description="" 
                show_description="'.$show_description.'" 
                show_category="'.$show_category.'" 
                show_thumbnail="'.$show_thumbnail.'" 
                speed="'.$speed.'" 
                autoplay="'.$autoplay.'" 
                show_readmore="'.$show_readmore.'" 
                enable_pagination="'.$show_pagination.'"
            ]' );
             
        wp_reset_postdata();
    }

}