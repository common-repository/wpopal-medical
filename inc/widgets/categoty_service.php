<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author      Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2015  prestabrain.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

class Opalmedical_Category_Medical_Widget extends WP_Widget{

    public function __construct() {
         parent::__construct(
            // Base ID of your widget
            'opalmedical_category_doctor_widget',
            // Widget name will appear in UI
            esc_html__('Opal Category Medicals', 'opal-medical'),
            // Widget description
            array( 'description' => esc_html__( 'Category Medicals widget.', 'opal-medical' ), )
        );
    }

    public function widget( $args, $instance ) {

        
        extract( $args );
	    extract( $instance );
        //Our variables from the widget settings.
        $title  = apply_filters('widget_title', esc_attr($instance['title']));


        //Check

        $tpl = OPALMEDICAL_THEMER_TEMPLATES_DIR .'widgets/category_medical/default.php'; 
        $tpl_default = OPALMEDICAL_PLUGIN_DIR .'templates/widgets/category_medical/default.php';
  
        if(  is_file($tpl) ) { 
            $tpl_default = $tpl;
        }
        require $tpl_default;
    }


    // Form

    public function form( $instance ) {
        //Set up some default widget settings.
        $defaults = array( 
            'title' => esc_html__('Category Medicals', 'opal-medical'),
            'num' => '5',
        );              
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'opal-medical'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num')); ?>"><?php esc_html_e('Limit:', 'opal-medical'); ?></label>
            <br>
            <input id="<?php echo esc_attr($this->get_field_id('num')); ?>" name="<?php echo esc_attr($this->get_field_name('num')); ?>" type="text" value="<?php echo esc_attr( $instance['num'] ); ?>" />
        </p>
    <?php
    }

    //Update the widget

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        //Strip tags from title and name to remove HTML
        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['num']                = $new_instance['num'];
        return $instance;
    }
    
}

register_widget( 'Opalmedical_Category_Medical_Widget' );

?>