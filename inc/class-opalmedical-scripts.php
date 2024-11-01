<?php
/**
 * $Desc$
 *
 * @version    $Id$
 * @package    opalmedical
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2016 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Opalmedical_Scripts{

	/**
	 * Init
	 */
	public static function init(){
		add_action( 'wp_head', array( __CLASS__, 'initAjaxUrl' ), 15 );
	
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'loadScripts' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'loadAdminStyles')  );
		add_action('init', array( __CLASS__, 'regeister_scripts_frontend')  );
 
	}

	/**
     *  Enqueue Script úing for admin editor
     *
     * @var avoid
     * @return avoid 
     */
    public static function regeister_scripts_frontend() { 

        wp_register_script(
            'jquery-slick',
            trailingslashit( OPALMEDICAL_PLUGIN_URL ). 'assets/js/libs/slick.js',
            [
                'jquery',
            ],
            '1.8.1',
            true
        );


        
    }
	/**
	 * load script file in backend
	 */
	public static function loadScripts(){
 	
		wp_enqueue_style( 'opalmedical-frontend-css', OPALMEDICAL_PLUGIN_URL . 'assets/css/style.css', null, '1.0');
		wp_enqueue_style( 'bootstrap-vertical-tabs-min-css', OPALMEDICAL_PLUGIN_URL . 'assets/css/bootstrap.vertical-tabs.min.css', null, '1.2.2');
		wp_enqueue_script("opalmedical-scripts", OPALMEDICAL_PLUGIN_URL . 'assets/js/script.js', array( 'jquery' ), "1.0.0", true);
	}

	/**
	 * load script file in backend
	 */
	public static function loadAdminStyles(){
 		//----------------------
 		wp_enqueue_style( 'opalmedical-backend-css', OPALMEDICAL_PLUGIN_URL . 'assets/css/admin-styles.css', null, '1.0');
		wp_enqueue_script("opalmedical-scripts", OPALMEDICAL_PLUGIN_URL . 'assets/js/opalmedical.js', array( 'jquery' ), "1.0.0", true);
	}
 
    /**
     * add ajax url
     */
	public static function initAjaxUrl() {
		?>
		<script type="text/javascript">
			var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
			var opalsiteurl = '<?php echo get_template_directory_uri(); ?>';
		</script>
		<?php
	}
}

Opalmedical_Scripts::init();