<?php


class CodelessHeaderImporter{

	var $process_list = array( 'install_header', 'install_footer' );

	public function __construct(){

		$current_theme = wp_get_theme();
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#','',$current_theme->get( 'Name' ) ) );

		add_action('wp_ajax_cl_import_header_data', array(&$this, 'ajax_handler'));
		add_action('wp_ajax_cl_import_footer_data', array(&$this, 'ajax_handler'));
	}

	public function ajax_handler(){
		check_ajax_referer('codeless_import_header_nonce');

		$process = isset( $_POST['process']) ? esc_attr( $_POST['process'] ) : 0;
		
		if( esc_attr( $_POST['action'] ) == 'cl_import_header_data' )
			$this->process_install_header();

		if( esc_attr( $_POST['action'] ) == 'cl_import_footer_data' )
			$this->process_install_footer();
	}

	public function process_install_header(){
		$dir = esc_attr( $_POST['demo'] );
		$file = 'data.txt';
		$theme_mods = $this->read_file_header($file, $dir);



		codeless_helper_import_header( $theme_mods );

		wp_send_json_success( array('message' => esc_html__('Header Successfully imported', 'thype')) );
	}

	public function process_install_footer(){
		$dir = esc_attr( $_POST['demo'] );
		$file = 'data.txt';

		$data = $this->read_file_footer($file, $dir);

		codeless_helper_import_footer( $data );
		
	}

	// Read the file that will be written
		public function read_file_header($file, $dir){
			$content = "";
			
			$file = get_template_directory() . '/includes/codeless_header_predefined/'.$dir.'/'. $file;
			
			if ( file_exists($file) ) {
				
				$content = $this->get_content($file);
				
			} else {
				$this->message = esc_html__("File doesn't exist", "thype");
			}
			
			if ($content) {

				if( ! empty( $content ) ){
					$unserialized_content = unserialize(codeless_decode_content($content));

					if ($unserialized_content) {

						return $unserialized_content;
					}
				}else{
					return '';
				}
			}
			return false;
		}

		public function read_file_footer($file, $dir){
			$content = "";
			
			$file = get_template_directory() . '/includes/codeless_footer_predefined/'.$dir.'/'. $file;
			
			if ( file_exists($file) ) {
				
				$content = $this->get_content($file);
				
			} else {
				$this->message = esc_html__("File doesn't exist", "thype");
			}
			
			if ($content) {

				if( ! empty( $content ) ){
					$unserialized_content = unserialize(codeless_decode_content($content));

					if ($unserialized_content) {

						return $unserialized_content;
					}
				}else{
					return '';
				}
			}
			return false;
		}

		function get_content( $file ) {
			return codeless_generic_get_content($file);
		}
}



class CodelessImporter{

	protected $tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	protected $tgmpa_instance;
	protected $tgmpa_menu_slug = 'tgmpa-install-plugins';
	protected $theme_name;

	var $process_list = array( 'install_plugins', 'import_content', 'import_options', 'import_menus', 'import_widgets', 'import_extra' );

	public function __construct(){

		$current_theme = wp_get_theme();
		$this->theme_name = strtolower( preg_replace( '#[^a-zA-Z]#','',$current_theme->get( 'Name' ) ) );

		add_action('wp_ajax_cl_import_demo_data', array(&$this, 'ajax_handler'));
		add_action('tgmpa_load', array( &$this, 'tgmpa_load' ));

		if(class_exists( 'TGM_Plugin_Activation' ) && isset($GLOBALS['tgmpa'])) {
			add_action( 'init', array( &$this, 'get_tgmpa_instanse' ), 30 );
			add_action( 'init', array( &$this, 'set_tgmpa_url' ), 40 );
		}

		if( class_exists('WC_Admin_Notices') ){
			WC_Admin_Notices::remove_notice('install');
		}

	}

	public function ajax_handler(){
		check_ajax_referer('codeless_import_demo_nonce');

		$process = isset( $_POST['process'] ) ? esc_attr( $_POST['process'] ) : 0;
		
		$process_function = $this->process_list[ esc_attr( $_POST['process'] ) ];
		$this->{'process_' . $process_function }();
	}

	public function process_install_plugins(){
		
		$response['message'] = 'process_install_plugins';

		$this->ajax_plugins();
	}

	public function process_import_extra(){
		$header = esc_attr( $_POST['header'] );
		$footer = esc_attr( $_POST['footer'] );

		if( !empty( $header ) ){
			$theme_mods = codeless_helper_read_file( 'data.txt', $header, 'header' );
			codeless_helper_import_header($theme_mods);
		}

		if( !empty( $footer ) ){
			$data = codeless_helper_read_file( 'data.txt', $footer, 'footer' );
			codeless_helper_import_footer($data);
		}
		$current_demo = array();
		$all_demos = cl_backpanel::get_demos();
		if( is_array() && !empty( $all_demos ) ){
			foreach( $all_demos as $demo ){
				if( $demo['id'] == $_POST['demo'] )
					$current_demo = $demo;
			}
		}

		if( isset( $current_demo['extra_options'] ) && is_array( $current_demo['extra_options'] ) && !empty( $current_demo['extra_options'] ) ){
			foreach( $current_demo['extra_options'] as $key => $value ){
				set_theme_mod( $key, $value );
			}
		}

		wp_send_json_success( array('message' => esc_html__('Extra successfully imported', 'thype')) );
	}

	public function process_import_widgets(){
		$dir = esc_attr( $_POST['demo'] );
		$file = 'sidebar_widgets.txt';
		$options = $this->read_file($file, $dir);

		if($options){

			foreach ((array) $options['final_widget'] as $widget => $widget_params) {

				if( $widget == 'nav_menu' ){
					foreach ($widget_params as $id => $value) {
						$name = $value['title'];
						$menu = wp_get_nav_menu_object( $name );

						if( $menu !== false ){
							$new_id = $menu->term_id;
							$widget_params[$id]['nav_menu'] = $new_id;
						}
						
					}
				}


				update_option( 'widget_' . $widget, $widget_params );
			}

			$this->import_sidebars_widgets($file, $dir);
			wp_send_json_success( array('message' => esc_html__('Widgets Successfully imported', 'thype')) );
			
		}else{
			wp_send_json_error( array('message' => esc_html__('Demo doesnt contain sidebar_widgets.txt file.', 'thype')) );
		}
		
	}

	public function process_import_options(){
		$dir = $_POST['demo'];
		$file = 'customizer.txt';

		$theme_mods = $this->read_file($file, $dir);

		if( $theme_mods && ! empty( $theme_mods ) ){
			foreach ((array) $theme_mods as $key => $val) {
				set_theme_mod( $key, $val );
			}

			$file = 'options.txt';
			$options = $this->read_file($file, $dir);

			if( $options ){
				foreach ((array) $options as $key => $val) {
					
					update_option( $key, $val );
				}
				$home_slug = 'home';

				if( isset( $_POST['home_slug'] ) && !empty( $home_slug ) )
					$home_slug = $_POST['home_slug'];

				$new_ = get_page_by_path( $home_slug, ARRAY_A );
						
				if( is_array( $new_ ) && isset( $new_['ID'] ) )
					update_option( 'page_on_front', $new_['ID'] );

				update_option( 'show_on_front', 'page' );

			}else{
				wp_send_json_error( array('message' => esc_html__('Options not loaded or files missed.', 'thype'). $val) );
			}
		}

		wp_send_json_success( array('Success'. $val) );
	}

	public function process_import_content(){
		$dir = esc_attr( $_POST['demo'] );
		$current_part = esc_attr( $_POST['current_part'] );
	    $attachments = true;

	    ob_start();

	    define('WP_LOAD_IMPORTERS', true);

	    
		require_once( get_template_directory() . '/includes/codeless_theme_panel/importer/wordpress-importer.php');
		
		wp_delete_post(1);			
		$wp_import = new WP_Import();
		set_time_limit(0);
		$file = 'content_' . $current_part . '.xml';
		$path = get_template_directory() . '/includes/codeless_demos_content/'.$dir.'/'. $file;
                
		$wp_import->fetch_attachments = $attachments;
		$value = $wp_import->import($path);
		
		ob_get_clean();
		if(is_wp_error($value)){
			$msg = $result->get_error_message();
			wp_send_json_error( array('message' => esc_html__('Error. Content can\'t be installed.', 'thype') . $msg ) );
		}
		else {
			wp_send_json_success( array('message' => esc_html__('Content Successfully Installed', 'thype')) );
		}
	}

	public function process_import_menus(){
		global $wpdb;
		$dir = esc_attr( $_POST['demo'] );
		$terms = $wpdb->prefix . "terms";
		$menus_data = $this->read_file('menu.txt', $dir);
			
		if($menus_data){
			$menu_array = array();
			if(is_array($menus_data) && !empty($menus_data)){
				foreach ($menus_data as $registered_menu => $menu_slug) {
					$term_rows = $wpdb->get_results($wpdb->prepare(
					  "SELECT * FROM $wpdb->terms where slug = '%s' ",
					  $menu_slug
					), ARRAY_A);
					
					if(isset($term_rows[0]['term_id'])) {
						$term_id_by_slug = $term_rows[0]['term_id'];
					} else {
						$term_id_by_slug = null; 
					}
					$menu_array[$registered_menu] = $term_id_by_slug;
					
				}
			}
				
			set_theme_mod('nav_menu_locations', array_map('absint', $menu_array ) );
			wp_send_json_success( array('message' => esc_html__('Menu Successfully Installed', 'thype')) );

		}else{
			wp_send_json_error( array('message' => esc_html__('Error. Menu can\'t installed.', 'thype') ) );
		}
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	private function _get_plugins() {
			$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
			$plugins = array(
				'all'      => array(), // Meaning: all plugins which still have open actions.
				'install'  => array(),
				'update'   => array(),
				'activate' => array(),
			);
			
			foreach ( $instance->plugins as $slug => $plugin ) {
				if ( $instance->is_tgm_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
					// No need to display plugins if they are installed, up-to-date and active.
					continue;
				} else {
					$plugins['all'][ $slug ] = $plugin;

					if ( ! $instance->is_plugin_installed( $slug ) ) {
						$plugins['install'][ $slug ] = $plugin;
					} else {

						if ( $instance->can_plugin_activate( $slug ) ) {
							$plugins['activate'][ $slug ] = $plugin;
						}
					}
				}
			}
			return $plugins;
	}

	public function ajax_plugins() {

			$json = array();
			// send back some json we use to hit up TGM
			$plugins = $this->_get_plugins();

			$json['active'] = array(
						'url' => admin_url( $this->tgmpa_url ),
						'plugin' => array( ),
						'tgmpa-page' => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce' => wp_create_nonce( 'bulk-plugins' ),
						'action' => 'tgmpa-bulk-activate',
						'action2' => -1,
						'message' => esc_html__( 'Activating Plugin','thype' ),
			);

			$json['install'] = array(
						'url' => admin_url( $this->tgmpa_url ),
						'plugin' => array( ),
						'tgmpa-page' => $this->tgmpa_menu_slug,
						'plugin_status' => 'all',
						'_wpnonce' => wp_create_nonce( 'bulk-plugins' ),
						'action' => 'tgmpa-bulk-install',
						'action2' => -1,
						'message' => esc_html__( 'Installing Plugin','thype' ),
			);


			// what are we doing with this plugin?
			foreach ( $plugins['activate'] as $slug => $plugin ) {
				
				$json['active']['plugin'][] = $slug;
				
			}
			
			foreach ( $plugins['install'] as $slug => $plugin ) {
				
				$json['install']['plugin'][] = $slug;
				$json['active']['plugin'][] = $slug;
			}

			if ( $json && ( !empty($json['active']['plugin']) || !empty($json['install']['plugin']) ) ) {
			
				wp_send_json_success( array( 'plugins' => $json ) );
			} else {
				wp_send_json_success( array( 'message' => esc_html__( 'No plugins to install or activate', 'thype' ) ) );
			}
			exit;

	}

		/**
		 * Get configured TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function get_tgmpa_instanse(){
			$this->tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		}

		/**
		 * Update $tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
		 *
		 * @access public
		 * @since 1.1.2
		 */
		public function set_tgmpa_url(){

			$this->tgmpa_menu_slug = ( property_exists($this->tgmpa_instance, 'menu') ) ? $this->tgmpa_instance->menu : $this->tgmpa_menu_slug;
			$this->tgmpa_menu_slug = apply_filters($this->theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->tgmpa_menu_slug);

			$tgmpa_parent_slug = ( property_exists($this->tgmpa_instance, 'parent_slug') && $this->tgmpa_instance->parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';

			$this->tgmpa_url = apply_filters($this->theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug.'?page='.$this->tgmpa_menu_slug);

		}
        


		function import_sidebars_widgets($file, $dir){
			$widgets = get_option("sidebars_widgets");

			unset($widgets['array_version']);

			$data = $this->read_file($file, $dir);

			if ( is_array($data['sidebars']) ) {
			
				$widgets = array_merge( (array) $widgets, (array) $data['sidebars'] );
				
				unset($widgets['wp_inactive_widgets']);
				
				$widgets = array_merge(array('wp_inactive_widgets' => array()), $widgets);
				$widgets['array_version'] = 3;
				
				update_option('sidebars_widgets', $widgets);
			}
		}

		// Read the file that will be written
		public function read_file($file, $dir){
			$content = "";
			
			$file = get_template_directory() . '/includes/codeless_demos_content/'.$dir.'/'. $file;
			
			if ( file_exists($file) ) {
				
				$content = $this->get_content($file);
				
			} else {
				$this->message = esc_html__("File doesn't exist", "thype");
			}
			
			if ($content) {

				if( ! empty( $content ) ){
					$unserialized_content = unserialize(codeless_decode_content($content));

					if ($unserialized_content) {

						return $unserialized_content;
					}
				}else{
					return '';
				}
			}
			return false;
		}

		function get_content( $file ) {
			return codeless_generic_get_content($file);
		}

}


function codeless_helper_import_footer( $data ){

	if( $data && ! empty( $data ) ){
		$theme_mods = $data['options'];

		$sections = array( 'cl_footer_main', 'cl_footer_extra', 'cl_footer_copyright', 'cl_colors_footer', 'cl_colors_copyright', 'cl_typography_footer' );

		foreach( Kirki::$fields as $field ){
			if( in_array( $field['section'], $sections ) ){
				$new_val = isset( $theme_mods[$field['id']] ) ? $theme_mods[$field['id']] : $field['default'];
				set_theme_mod( $field['id'], $new_val );
			}
		}

		$sidebars = $data['sidebars'];
		$final_widgets = $data['final_widget'];


		$widgets = get_option("sidebars_widgets");

		unset($widgets['array_version']);

		if ( is_array($sidebars) ) {
		
			$widgets = array_merge( (array) $widgets, (array) $sidebars );
			
			unset($widgets['wp_inactive_widgets']);
			
			$widgets = array_merge(array('wp_inactive_widgets' => array()), $widgets);
			$widgets['array_version'] = 3;
			
			update_option('sidebars_widgets', $widgets);

			foreach ((array) $final_widgets as $widget => $widget_params) {

				if( $widget == 'nav_menu' ){
					foreach ($widget_params as $id => $value) {
						$name = $value['title'];
						$menu = wp_get_nav_menu_object( $name );

						if( $menu !== false ){
							$new_id = $menu->term_id;
							$widget_params[$id]['nav_menu'] = $new_id;
						}
						
					}
				}
			
				update_option( 'widget_' . $widget, $widget_params );
			}
		}

	}else{
		wp_send_json_error( array('message' => esc_html__('Options not loaded or files missed.', 'thype')) );
	}

	wp_send_json_success( array('message' => esc_html__('Footer Successfully imported', 'thype')) );	
}


function codeless_helper_import_header( $theme_mods ){
	if( $theme_mods && ! empty( $theme_mods ) ){

		$sections = array( 'cl_header_general', 'cl_header_logo', 'cl_header_menu', 'cl_header_main', 'cl_header_top_row', 'cl_header_extra_row', 'cl_header_sticky', 'cl_header_top_news', 'cl_colors_header', 'cl_typography_header' );
	
		foreach( Kirki::$fields as $field ){
			if( in_array( $field['section'], $sections ) ){
				$new_val = isset( $theme_mods[$field['id']] ) ? $theme_mods[$field['id']] : $field['default'];
			
				set_theme_mod( $field['id'], $new_val );
			}
		}

		set_theme_mod( 'cl_header_builder', $theme_mods['cl_header_builder'] );

	}else{
		wp_send_json_error( array('message' => esc_html__('Options not loaded or files missed.', 'thype')) );
	}
}



function codeless_helper_read_file($file, $dir, $type){
	$content = "";
			
	$file = get_template_directory() . '/includes/codeless_'.$type.'_predefined/'.$dir.'/'. $file;
	
	if ( file_exists($file) ) {
		
		$content = codeless_generic_get_content($file);
		
	}
	
	if ($content) {

		if( ! empty( $content ) ){
			$unserialized_content = unserialize(codeless_decode_content($content));

			if ($unserialized_content) {

				return $unserialized_content;
			}
		}else{
			return '';
		}
	}
	return false;	
}



if( is_admin() )
	new CodelessImporter();

if( is_admin() )
	new CodelessHeaderImporter();

?>