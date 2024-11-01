<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
/**
 * Class OSF_Elementor_Blog
 */
class OSV_Elementor_Widget_Medical extends Elementor\Widget_Base {

    public function get_name() {
        return 'opal-medical';
    }

    public function get_title() {
        return esc_html__('Opal Medical', 'opalelementor');
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
        return 'eicon-posts-grid';
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
                'prefix_class' => 'elementor-grid%s-',
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

        $this->add_responsive_control(
            'columns-gap',
            [
                'label' => esc_html__( 'Columns Gap', 'opalelementor' ),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .elementor-items-container' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
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
       
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'display_category',
            [
                'label'       => esc_html__('Show Department', 'opalelementor'),
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
                    '{{WRAPPER}} .column-item, {{WRAPPER}} .entry-content' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .column-item article' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .column-item article',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'opalelementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .column-item article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .column-item article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_content_padding',
            [
                'label' => esc_html__( 'Content', 'opalelementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .column-item .entry-content',
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
                'selector' => '{{WRAPPER}} article .medical-title a',
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
                'selector' => '{{WRAPPER}} article .medical-description, {{WRAPPER}} .entry-content .medical-description p',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color', 'opalelementor'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} article .medical-description, {{WRAPPER}} .entry-content .medical-description p' => 'color: {{VALUE}};',
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
        $show_category      = $settings[ 'display_category'];
        $show_readmore      = $settings[ 'display_readmore'];
        $show_description   = $settings[ 'display_description'];
        $show_thumbnail     = $settings[ 'display_thumbnail'];
        $max_char           = $settings[ 'max_char'];
        $image_size         = $settings[ 'thumbnail_size'];
        $other_size         = $settings[ 'thumbnail_custom_dimension'];
        
            echo do_shortcode( '[opalmedical_list_medicals category="'.$category.'" limit="'.$limit.'" column="'.$column.'" title="" description="" max_char="'.$max_char.'" show_category="'.$show_category.'" show_readmore="'.$show_readmore.'" show_description="'.$show_description.'"  show_thumbnail="'.$show_thumbnail.'" image_size="'.$image_size.'" other_size="'.$other_size.'"]' ); 
 
        wp_reset_postdata();
    }

}