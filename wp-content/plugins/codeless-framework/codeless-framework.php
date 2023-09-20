<?php
/**
 * Plugin Name: Codeless Framework
 * Plugin URI: http://codeless.co
 * Description: Codeless Framework Tools and Header Builder
 * Version: 1.0
 * Author: Codeless
 * Author URI: http://codeless.co
 * License: GPL2
 */
 
 // don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Current version
 */
if ( ! defined( 'CL_FRAMEWORK_VERSION' ) ) {

	define( 'CL_FRAMEWORK_VERSION', '1.0' );
}




class Cl_Framework_Manager{
    
    private $paths;
    
    private $factory = array();

	private $plugin_name;
	
	private $custom_user_templates_dir = false;
    
    private static $_instance;
    
    public function __construct(){
        
        $dir = dirname( __FILE__ );

        
		
		/**
		 * Define path settings for visual composer.
		 *
		 * APP_ROOT        - plugin directory.
		 * WP_ROOT         - WP application root directory.
		 * APP_DIR         - plugin directory name.
		 * CONFIG_DIR      - configuration directory.
		 * ASSETS_DIR      - asset directory full path.
		 * ASSETS_DIR_NAME - directory name for assets. Used from urls creating.
		 * CORE_DIR        - classes directory for core vc files.
		 * HELPERS_DIR     - directory with helpers functions files.
		 * SHORTCODES_DIR  - shortcodes classes.
		 * SETTINGS_DIR    - main dashboard settings classes.
		 * TEMPLATES_DIR   - directory where all html templates are hold.
		 * EDITORS_DIR     - editors for the post contents
		 * PARAMS_DIR      - complex params for shortcodes editor form.
		 * UPDATERS_DIR    - automatic notifications and updating classes.
		 */
		$this->setPaths( array(
			'APP_ROOT' => $dir,
			'WP_ROOT' => preg_replace( '/$\//', '', ABSPATH ),
			'APP_DIR' => basename( $dir ),
			'THEME_CODELESS_DIR' => get_template_directory().'/includes/codeless_builder',
			'THEME_CODELESS_CONFIG' => get_template_directory().'/includes/codeless_builder/config',
			'THEME_CODELESS_HEADER' => get_template_directory().'/includes/codeless_builder/header-elements',
			'THEME_CODELESS_SHORTCODES' => get_template_directory().'/includes/codeless_builder/shortcodes',
			'CONFIG_DIR' => $dir . '/config',
			'ASSETS_DIR' => $dir . '/assets',
			'ASSETS_DIR_NAME' => 'assets',
			'CORE_DIR' => $dir . '/include/core',
			'HELPERS_DIR' => $dir . '/include/helpers',
			'TEMPLATES_DIR' => $dir . '/include/templates',
			'SHORTCODES_DIR' => $dir . '/include/core/shortcodes'

		) );
		// Load API
		require_once $this->path( 'HELPERS_DIR', 'helpers.php' );
		require_once $this->path( 'CORE_DIR', 'cl-builder-mapper.php' );
		require_once $this->path( 'CORE_DIR', 'cl-register-post-type.php' );
		require_once $this->path( 'CORE_DIR', 'cl-register-post-types.php' );
		require_once $this->path( 'SHORTCODES_DIR', 'cl-shortcode.php' );
		require_once $this->path( 'SHORTCODES_DIR', 'cl-shortcode-manager.php' );
		require_once $this->path( 'SHORTCODES_DIR', 'cl-shortcode-container.php' );
		require_once $this->path( 'SHORTCODES_DIR', 'cl-shortcode-simple.php' );
		require_once $this->path( 'CORE_DIR', 'cl-post-like.php' );
		// Add hooks
		
		add_action( 'plugins_loaded', array( &$this, 'pluginsLoaded' ), 9 );
		
		add_action( 'init', array( &$this, 'init' ), 999 );


		$this->setPluginName( $this->path( 'APP_DIR', 'codeless-framework.php' ) );
    }
    
    
    public static function getInstance() {
		if ( ! ( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
    
    public function init() {

    	if( ! function_exists( 'codeless_setup' ) )
    		return;
    	
		/**
		 * Set version if required.
		 */
		$this->setVersion();


		/**
		 * Init default functions of plugin
		 */
		$this->cl_base()->init();
		
		/**
		 * Init Header Builder functionality
		 */
		$this->header_builder()->init();
		
		
	}
	
    
    protected function setPaths( $paths ) {
		$this->paths = $paths;
	}
	
	
	public function path( $name, $file = '' ) {
		$path = $this->paths[ $name ] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );
		return $path;
	}
	
	
	public function pluginsLoaded() {


		// Setup locale
		load_plugin_textdomain( 'cl_builder', false, $this->path( 'APP_DIR', 'locale' ) );
	

		
	}
	
	
	protected function setVersion() {
		$version = get_option( 'cl_framework_version' );
		if ( ! is_string( $version ) || version_compare( $version, CL_FRAMEWORK_VERSION ) !== 0 ) {
			update_option( 'cl_framework_version', CL_FRAMEWORK_VERSION );
		}
	}
	
	public function setPluginName( $name ) {
		$this->plugin_name = $name;
	}
	
	
	public function cl_base() {
		if ( ! isset( $this->factory['cl_base'] ) ) {
		
			require_once $this->path( 'CORE_DIR', 'cl-framework-base.php' );
			$cl_base = new Cl_Framework_Base();
			
			$this->factory['cl_base'] = $cl_base;
		}

		return $this->factory['cl_base'];
	}
	
	
	public function header_builder() {
		if ( ! isset( $this->factory['cl_header_builder'] ) ) {
		
			require_once $this->path( 'CORE_DIR', 'cl-header-builder.php' );
			$cl_header_builder = new Cl_Header_Builder();
			
			$this->factory['cl_header_builder'] = $cl_header_builder;
		}

		return $this->factory['cl_header_builder'];
	}
	
	
	public function pluginUrl( $file ) {
		return preg_replace( '/\s/', '%20', plugins_url( $file , __FILE__ ) );
	}
	
	public function assetUrl( $file ) {
		return preg_replace( '/\s/', '%20', plugins_url( $this->path( 'ASSETS_DIR_NAME', $file ), __FILE__ ) );
	}
	
	public function getShortcodesTemplateDir( $template ) {
		return false !== $this->custom_user_templates_dir ? $this->custom_user_templates_dir . '/' . $template : locate_template( 'includes/codeless_builder/shortcodes' . '/' . $template );
	}
	
	public function getDefaultShortcodesTemplatesDir() {
		return cl_path_dir( 'TEMPLATES_DIR', 'shortcodes' );
	}

	public function getDefaultHeaderTemplatesDir() {
		return cl_path_dir( 'TEMPLATES_DIR', 'header-elements' );
	}  
}


global $cl_builder;
if ( ! $cl_builder ) {
	$cl_builder = Cl_Framework_Manager::getInstance();
}


 
 
 ?>