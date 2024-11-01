<?php
/**
* @package wpopalmedical
* @category Plugins
* @author WPOPAL
* |--------------------------------------------------------------------------
* | Plugin Wpopal Medical
* |--------------------------------------------------------------------------
* Plugin Name: Wpopal Medical
* Plugin URI: http://www.wpopal.com/
* Description: Create and maintain modern online menus for almost any kind of medical.
* Version: 1.0.4
* Author: WPOPAL
* Author URI: http://www.wpopal.com
* License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

if (!class_exists("OpalMedical")):
/**
 * Main OpalMedical Class
 * @since 1.0
 */
final class OpalMedical
{
	/**
	 * @var Opalmedical The one true Opalmedical
	 * @since 1.0
	 */
	private static $instance;

	 /**
     * Plugin path
     *
     * @var string
     */
	 protected $_plugin_path = null;

	/**
	 * contructor
	 */
	public function __construct() {
		//add_action('elementor/widgets/widgets_registered', array($this, 'include_widgets'));
	}

	/**
	* Main Opalmedical Instance
	*
	* Insures that only one instance of Opalmedical exists in memory at any one
	* time. Also prevents needing to define globals all over the place.
	*
	* @since     1.0
	* @static
	* @staticvar array $instance
	* @uses      Opalmedical::setup_constants() Setup the constants needed
	* @uses      Opalmedical::includes() Include the required files
	* @uses      Opalmedical::load_textdomain() load the language files
	* @see       Opalmedical()
	* @return    Opalmedical
	*/
	public static function getInstance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof OpalMedical ) ) {
			self::$instance = new OpalMedical;
			self::$instance->setup_constants();

			add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain'));
			add_action( 'elementor/widgets/widgets_registered', array( self::$instance, 'osv_load_elementor_widgets'));
			self::$instance->includes();
			//self::$instance->roles  = new Opalmedical_Roles();
		}
		//update_option( 'opalmedical_setup', '' );
		//add_action("admin_print_footer_scripts", array( self::$instance, 'shortcode_button_script'));
		return self::$instance;
	}

	/**
	* Function Defien
	*/
	public function setup_constants()
	{
		define("OPALMEDICAL_VERSION", "1.0.2");
		define("OPALMEDICAL_MINIMUM_WP_VERSION", "4.0");
		define("OPALMEDICAL_PLUGIN_URL", plugin_dir_url( __FILE__ ));
		define("OPALMEDICAL_PLUGIN_DIR", plugin_dir_path( __FILE__ ));
		define('OPALMEDICAL_MEDIA_URL', plugins_url(plugin_basename(__DIR__) . '/assets/'));
		define('OPALMEDICAL_LANGUAGE_DIR', plugin_dir_path( __FILE__ ) . '/languages/');
		define('OPALMEDICAL_THEMER_TEMPLATES_DIR', get_template_directory().'/' );
		define('OPALMEDICAL_THEMER_TEMPLATES_URL', get_bloginfo('template_url').'/' );

	}

	/**
	* Throw error on object clone
	*
	* The whole idea of the singleton design pattern is that there is a single
	* object, therefore we don't want the object to be cloned.
	*
	* @since  1.0
	* @access protected
	* @return void
	*/
	public function __clone() {
			// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'opal-medical' ), '1.0' );
	}

	/**
     * Include a file
     *
     * @param string
     * @param bool
     * @param array
     */
	function _include( $file, $root = true, $args = array(), $unique = true ){
		if( $root ){
			$file = $this->plugin_path( $file );
		}
		if( is_array( $args ) ){
			extract( $args );
		}

		if( file_exists( $file ) )
		{
			if ( $unique ) {
				require_once $file;
			}
			else {
				require $file;
			}
		}
	}
    /**
    * Get the path of the plugin with sub path
    *
    * @param string $sub
    * @return string
    */
    function plugin_path( $sub = '' ){
    	if( ! $this->_plugin_path ) {
    		$this->_plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
    	}
    	return $this->_plugin_path . '/' . $sub;
    }

    public function includes(){

    	global $opalmedical_options;

    	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		//-- include admin setting
		$this->_include('inc/admin/register-settings.php');
		$opalmedical_options = opalmedical_get_settings();
		//-- include teamplate loader
		$this->_include('inc/class-template-loader.php');
		//--
		$this->_include("inc/mixes-functions.php");
		//--
		$this->_include("inc/ajax-functions.php");

		$this->_include('inc/class-opalmedical-query.php');

		//-- include all file *.php in directories , call function in inc/mixes-functions.php
		opalmedical_includes( OPALMEDICAL_PLUGIN_DIR . 'inc/post-types/*.php' );
		opalmedical_includes( OPALMEDICAL_PLUGIN_DIR . 'inc/taxonomies/*.php' );

		//--
		$this->_include("inc/template-functions.php");
		//--

		//--
		$this->_include("inc/class-opalmedical-medical.php"); //***
		//--
		$this->_include('inc/class-opalmedical-scripts.php');
		//--
		$this->_include("inc/class-opalmedical-shortcodes.php");

		// Customizer
		$this->_include("inc/class-opalmedical-customizer.php");

		// Widgets
		$this->_include("inc/class-opalmedical-widgets.php");


		$this->_include('install.php');
		//--
		if ( get_option( 'opalmedical_setup', false ) != 'installed' ) {
			register_activation_hook( __FILE__, 'opalmedical_install' );
			update_option( 'opalmedical_setup', 'installed' );
		}
		$this->_include('uninstall.php');
		// uninstall
		register_uninstall_hook( __FILE__, 'opalmedical_uninstall' );
		//--
		// // add widgets
		add_action( 'widgets_init', array($this, 'widgets_init') );
	}

	/**
	* this is function Load all Widgets
	*/
	public function widgets_init() {
		opalmedical_includes( OPALMEDICAL_PLUGIN_DIR . 'inc/widgets/*.php' );

	}

	/**
     * Automatic load widget files in elementor folder, show warning if not exists
     *
     * @var Object $widgets_manager
     * @return avoid
     */
    public function osv_load_elementor_widgets( $widgets_manager ) {

		$files = glob( OPALMEDICAL_PLUGIN_DIR ."inc/vendors/elementor/*.php");

		if( $files ){
			foreach ( $files as $file ) {
				$class = "OSV_Elementor_Widget_".ucfirst( basename( str_replace('.php','',$file) ) );
				require_once( $file );
				if( class_exists($class) ){
					$widgets_manager->register( new $class() );
				}else {
					// echo $file.'<missing:<br>' . $class;  die;
				 }


			}
		}
	}


	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since  1.0
	 * @return void
	*/
	public function load_textdomain() {
			// Set filter for Opalmedical's languages directory
		$lang_dir = dirname( plugin_basename( OPALMEDICAL_PLUGIN_DIR ) ) . '/languages/';
		$lang_dir = apply_filters( 'opalmedical_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'opal-medical' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'opal-medical', $locale );

			// Setup paths to current locale file
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/opalmedical/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/opalmedical folder
			load_textdomain( 'opal-medical', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/opalmedical/languages/ folder
			load_textdomain( 'opal-medical', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'opal-medical', false, $lang_dir );
		}
	}

}// end Class Root
endif; // End if class_exists check

/**
 * The main function responsible for returning the one true Opalmedical
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $dpemployee = Opalmedical(); ?>
 *
 * @since 1.0
 * @return object - The one true Opalmedical Instance
 */
function Opalmedical() {
	return OpalMedical::getInstance();
}

// Get Opalmedical Running
Opalmedical();

