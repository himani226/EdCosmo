<?php
/**
 * Plugin support: Elementor
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

define( 'ELEMENTOR_GO_PRO_REF', '2496' );

// Check if plugin 'Elementor' is installed and activated
// Attention! This function is used in many files and was moved to the api.php
/*
if ( !function_exists( 'trx_addons_exists_elementor' ) ) {
	function trx_addons_exists_elementor() {
		return class_exists('Elementor\Plugin');
	}
}
*/
// Return true if Elementor exists and current mode is preview
if ( !function_exists( 'trx_addons_elm_is_preview' ) ) {
	function trx_addons_elm_is_preview() {
		static $is_preview = -1;
		if ( $is_preview === -1 ) {
			if ( trx_addons_exists_elementor() ) {
				$elementor = \Elementor\Plugin::instance();
				$is_preview = is_object( $elementor )
								&& ! empty( $elementor->preview )
								&& is_object( $elementor->preview )
								&& ( $elementor->preview->is_preview_mode()
									|| trx_addons_get_value_gp( 'elementor-preview' ) > 0
									|| (trx_addons_get_value_gp( 'post' ) > 0
										&& trx_addons_get_value_gp( 'action' ) == 'elementor'
										)
									|| ( is_admin()
										&& in_array( trx_addons_get_value_gp( 'action' ), array( 'elementor', 'elementor_ajax', 'wp_ajax_elementor_ajax' ) )
										)
									);
			} else {
				$is_preview = false;
			}
		}
		return $is_preview;
	}
}

// Return true if specified post/page is built with Elementor
if ( !function_exists( 'trx_addons_is_built_with_elementor' ) ) {
	function trx_addons_is_built_with_elementor( $post_id ) {
		// Elementor\DB::is_built_with_elementor` is soft deprecated since 3.2.0
		// Use `Plugin::$instance->documents->get( $post_id )->is_built_with_elementor()` instead
		// return trx_addons_exists_elementor() && \Elementor\Plugin::instance()->db->is_built_with_elementor( $post_id );
		$rez = false;
		if ( trx_addons_exists_elementor() && ! empty( $post_id ) ) {
			$document = \Elementor\Plugin::instance()->documents->get( $post_id );
			if ( is_object( $document ) ) {
				$rez = $document->is_built_with_elementor();
			}
		}
		return $rez;
	}
}

// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_elm_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_elm_load_scripts_front', 11);
	function trx_addons_elm_load_scripts_front() {
		if ( trx_addons_exists_elementor() && trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_style( 'trx_addons-elementor', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'elementor/elementor.css'), array(), null );
		}
	}
}

// Load responsive styles for the frontend
if ( !function_exists( 'trx_addons_elm_load_responsive_styles' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_elm_load_responsive_styles', 2000);
	function trx_addons_elm_load_responsive_styles() {
		if ( trx_addons_exists_elementor() && trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_style( 'trx_addons-elementor-responsive', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'elementor/elementor.responsive.css'), array(), null );
		}
	}
}

// Merge specific styles into single stylesheet
if ( !function_exists( 'trx_addons_elm_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_elm_merge_styles');
	function trx_addons_elm_merge_styles($list) {
		if (trx_addons_exists_elementor()) {
			$list[] = TRX_ADDONS_PLUGIN_API . 'elementor/elementor.css';
		}
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_elm_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_elm_merge_styles_responsive');
	function trx_addons_elm_merge_styles_responsive($list) {
		if (trx_addons_exists_elementor()) {
			$list[] = TRX_ADDONS_PLUGIN_API . 'elementor/elementor.responsive.css';
		}
		return $list;
	}
}

	
// Merge plugin's specific scripts to the single file
if ( !function_exists( 'trx_addons_elm_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_elm_merge_scripts');
	function trx_addons_elm_merge_scripts($list) {
		if (trx_addons_exists_elementor()) {
			$list[] = TRX_ADDONS_PLUGIN_API . 'elementor/elementor.js';
			$list[] = TRX_ADDONS_PLUGIN_API . 'elementor/elementor-parallax.js';
		}
		return $list;
	}
}

	
// Add plugin-specific slugs to the list of the scripts, that don't move to the footer and don't add 'defer' param
if ( !function_exists( 'trx_addons_elm_not_defer_scripts' ) ) {
	add_filter("trx_addons_filter_skip_move_scripts_down", 'trx_addons_elm_not_defer_scripts');
	add_filter("trx_addons_filter_skip_async_scripts_load", 'trx_addons_elm_not_defer_scripts');
	function trx_addons_elm_not_defer_scripts($list) {
		$list[] = 'elementor';
		$list[] = 'backbone';
		$list[] = 'underscore';
		return $list;
	}
}

// Add responsive sizes
if ( !function_exists( 'trx_addons_elm_sass_responsive' ) ) {
	add_filter("trx_addons_filter_responsive_sizes", 'trx_addons_elm_sass_responsive', 11);
	function trx_addons_elm_sass_responsive($list) {
		if (!isset($list['md_lg']))
			$list['md_lg'] = array(
									'min' => $list['sm']['max']+1,
									'max' => $list['lg']['max']
									);
		return $list;
	}
}

// Load required styles and scripts for Elementor Editor mode
if ( !function_exists( 'trx_addons_elm_editor_load_scripts' ) ) {
	add_action("elementor/editor/before_enqueue_scripts", 'trx_addons_elm_editor_load_scripts');
	function trx_addons_elm_editor_load_scripts() {
		trx_addons_load_scripts_admin(true);
		trx_addons_localize_scripts_admin();
		wp_enqueue_style(  'trx_addons-elementor-editor', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'elementor/elementor.editor.css'), array(), null );
		wp_enqueue_script( 'trx_addons-elementor-editor', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'elementor/elementor.editor.js'), array('jquery'), null, true );
		do_action('trx_addons_action_pagebuilder_admin_scripts');
	}
}

// Add vars to the Elementors editor
if ( !function_exists( 'trx_addons_elm_localize_admin_scripts' ) ) {
	add_filter( 'trx_addons_filter_localize_script_admin',	'trx_addons_elm_localize_admin_scripts');
	function trx_addons_elm_localize_admin_scripts($vars = array()) {
		$vars['add_hide_on_xxx'] = trx_addons_get_setting('add_hide_on_xxx');
		return $vars;
	}
}

// Load required scripts for Elementor Preview mode
if ( !function_exists( 'trx_addons_elm_preview_load_scripts' ) ) {
	add_action("elementor/frontend/after_enqueue_scripts", 'trx_addons_elm_preview_load_scripts');
	function trx_addons_elm_preview_load_scripts() {
		if ( trx_addons_is_on(trx_addons_get_option('debug_mode')) ) {
			wp_enqueue_script( 'trx_addons-elementor-preview', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'elementor/elementor.js'), array('jquery'), null, true );
			wp_enqueue_script( 'trx_addons-elementor-parallax', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_API . 'elementor/elementor-parallax.js'), array('jquery'), null, true );
		}
		wp_enqueue_script( 'tweenmax', trx_addons_get_file_url('js/tweenmax/tweenmax.min.js'), array(), null, true );
		if ( trx_addons_elm_is_preview() ) {
			do_action('trx_addons_action_pagebuilder_preview_scripts', 'elementor');
		}
	}
}

// Add shortcode's specific vars into JS storage
if ( !function_exists( 'trx_addons_elm_localize_script' ) ) {
	add_filter("trx_addons_filter_localize_script", 'trx_addons_elm_localize_script');
	function trx_addons_elm_localize_script($vars) {
		$vars['elementor_stretched_section_container'] = get_option('elementor_stretched_section_container');
		$vars['pagebuilder_preview_mode'] = ! empty( $vars['pagebuilder_preview_mode'] ) || trx_addons_elm_is_preview();
		return $vars;
	}
}

// Return url with post edit link
if ( !function_exists( 'trx_addons_elm_post_edit_link' ) ) {
	add_filter( 'trx_addons_filter_post_edit_link', 'trx_addons_elm_post_edit_link', 10, 2 );
	function trx_addons_elm_post_edit_link( $link, $post_id ) {
		if ( trx_addons_is_built_with_elementor( $post_id ) ) {
			$link = str_replace( 'action=edit', 'action=elementor', $link );
		}
		return $link;
	}
}

// Prepare group atts for the new Elementor version: make associative array from list by key 'name'
if ( !function_exists( 'trx_addons_elm_prepare_group_params' ) ) {
	add_filter( 'trx_addons_sc_param_group_params', 'trx_addons_elm_prepare_group_params', 999 );
	function trx_addons_elm_prepare_group_params( $args ) {
		if ( is_array( $args ) && ! empty( $args[0]['name'] ) ) {
			$new = array();
			foreach( $args as $item ) {
				if ( isset( $item['name'] ) ) {
					$new[ $item['name'] ] = $item;
				}
			}
			$args = $new;
		}
		return $args;
	}
}

// Change "Go Pro" links
//----------------------------------------------
if (!function_exists('trx_addons_elm_change_gopro_plugins') && defined('ELEMENTOR_PLUGIN_BASE')) {
	add_filter( 'plugin_action_links_' . ELEMENTOR_PLUGIN_BASE, 'trx_addons_elm_change_gopro_plugins', 11 );
	function trx_addons_elm_change_gopro_plugins($links) {
		if (!empty($links['go_pro']) && preg_match('/href="([^"]*)"/', $links['go_pro'], $matches) && !empty($matches[1])) {
			$links['go_pro'] = str_replace($matches[1], trx_addons_add_to_url($matches[1], array('ref' => ELEMENTOR_GO_PRO_REF)), $links['go_pro']);
		}
		return $links;
	}
}
if (!function_exists('trx_addons_elm_change_gopro_dashboard')) {
	add_filter( 'elementor/admin/dashboard_overview_widget/footer_actions', 'trx_addons_elm_change_gopro_dashboard', 11 );
	function trx_addons_elm_change_gopro_dashboard($actions) {
		if (!empty($actions['go-pro']['link'])) {
			$actions['go-pro']['link'] = trx_addons_add_to_url($actions['go-pro']['link'], array('ref' => ELEMENTOR_GO_PRO_REF));
		}
		return $actions;
	}
}
if (!function_exists('trx_addons_elm_change_gopro_menu')) {
	add_filter( 'wp_redirect', 'trx_addons_elm_change_gopro_menu', 11, 2 );
	function trx_addons_elm_change_gopro_menu($link, $status=0) {
		if (strpos($link, '//elementor.com/pro/') !== false) {
			$link = trx_addons_add_to_url($link, array('ref' => ELEMENTOR_GO_PRO_REF));
		}
		return $link;
	}
}
if (!function_exists('trx_addons_elm_change_gopro_control')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_change_gopro_control', 10, 3 );
	function trx_addons_elm_change_gopro_control($element, $section_id, $args) {
		if (!is_object($element)) return;
		$el_name = $element->get_name();
		if ( $section_id == 'section_custom_css_pro') {
			$control = $element->get_controls( 'custom_css_pro' );
			if (!empty($control['raw']) && strpos($control['raw'], '//elementor.com/pro/') !== false) {
				$control['raw'] = preg_replace_callback(
					'~href="([^"]*)"~',
					function($matches) {
						if (!empty($matches[0]) && !empty($matches[1])) {
						}
						return 'href="' . trx_addons_add_to_url( $matches[1], array('ref' => ELEMENTOR_GO_PRO_REF) ) . '"';
					},
					$control['raw']
				);
				$element->update_control( 'custom_css_pro', array(
									'raw' => $control['raw']
								) );
			}
		}
	}
}



// Disable menu cache on the Elementor's preview screen
//-------------------------------------------------------------------------------------------------------
if (!function_exists('trx_addons_elm_use_menu_cache')) {
	add_filter('trx_addons_add_menu_cache', 'trx_addons_elm_use_menu_cache');
	function trx_addons_elm_use_menu_cache($use, $args=array()) {
		if ( trx_addons_elm_is_preview() ) {
			$use = false;
		}
		return $use;
	}
}


// Add Elementor's filter 'the_content' to the posts inside shortcodes (like "Blogger", "Services", etc)
//-------------------------------------------------------------------------------------------------------

// Add handler
if ( ! function_exists( 'trx_addons_elm_before_full_post_content' ) ) {
	add_action( 'trx_addons_action_before_full_post_content', 'trx_addons_elm_before_full_post_content' );
	function trx_addons_elm_before_full_post_content() {
		if ( trx_addons_is_built_with_elementor( get_the_ID() ) && ! has_filter( 'the_content', array( \Elementor\Plugin::instance()->frontend, 'apply_builder_in_content' ) ) ) {
			set_query_var( 'trx_addons_elm_set_the_content_handler', 1 );
			add_filter( 'the_content', array( \Elementor\Plugin::instance()->frontend, 'apply_builder_in_content' ), \Elementor\Plugin::instance()->frontend->THE_CONTENT_FILTER_PRIORITY );
		}
	}
}

// Remove handler
if ( ! function_exists( 'trx_addons_elm_after_full_post_content' ) ) {
	add_action( 'trx_addons_action_after_full_post_content', 'trx_addons_elm_after_full_post_content' );
	function trx_addons_elm_after_full_post_content() {
		if ( trx_addons_exists_elementor() && get_query_var( 'trx_addons_elm_set_the_content_handler' ) == 1 ) {
			remove_filter( 'the_content', array( \Elementor\Plugin::instance()->frontend, 'apply_builder_in_content' ), \Elementor\Plugin::instance()->frontend->THE_CONTENT_FILTER_PRIORITY );
		}
	}
}


// Init Elementor's support
//--------------------------------------------------------

// Set Elementor's options at once
if (!function_exists('trx_addons_elm_init_once')) {
	add_action( 'init', 'trx_addons_elm_init_once', 2 );
	function trx_addons_elm_init_once() {
		if (trx_addons_exists_elementor() && !get_option('trx_addons_setup_elementor_options', false)) {
			// Set components specific values to the Elementor's options
			do_action('trx_addons_action_set_elementor_options');
			// Set flag to prevent change Elementor's options again
			update_option('trx_addons_setup_elementor_options', 1);
		}
	}
}

// Add categories for widgets, shortcodes, etc.
if (!function_exists('trx_addons_elm_add_categories')) {
	add_action( 'elementor/elements/categories_registered', 'trx_addons_elm_add_categories' );
	function trx_addons_elm_add_categories($mgr = null) {

		static $added = false;

		if (!$added) {

			if ($mgr == null) $mgr = \Elementor\Plugin::instance()->elements_manager;
			
			// Add a custom category for ThemeREX Addons Shortcodes
			$mgr->add_category( 
				'trx_addons-elements',
				array(
					'title' => __( 'ThemeREX Addons Elements', 'trx_addons' ),
					'icon' => 'eicon-apps', //default icon
					'active' => true,
				)
			);

			// Add a custom category for ThemeREX Addons Widgets
			$mgr->add_category( 
				'trx_addons-widgets',
				array(
					'title' => __( 'ThemeREX Addons Widgets', 'trx_addons' ),
					'icon' => 'eicon-gallery-grid', //default icon
					'active' => false,
				)
			);

			// Add a custom category for ThemeREX Addons CPT
			$mgr->add_category( 
				'trx_addons-cpt',
				array(
					'title' => __( 'ThemeREX Addons Extensions', 'trx_addons' ),
					'icon' => 'eicon-gallery-grid', //default icon
					'active' => false,
				)
			);

			// Add a custom category for third-party shortcodes
			$mgr->add_category( 
				'trx_addons-support',
				array(
					'title' => __( 'ThemeREX Addons Support', 'trx_addons' ),
					'icon' => 'eicon-woocommerce', //default icon
					'active' => false,
				)
			);

			$added = true;
		}
	}
}

// Template to create our classes with widgets
//---------------------------------------------
if (!function_exists('trx_addons_elm_init')) {
	add_action( 'elementor/init', 'trx_addons_elm_init' );
	function trx_addons_elm_init() {

		// Add categories (for old Elementor)
		trx_addons_elm_add_categories();

		// Define class for our shortcodes and widgets
		if (class_exists('\Elementor\Widget_Base') && !class_exists('TRX_Addons_Elementor_Widget')) {
			abstract class TRX_Addons_Elementor_Widget extends \Elementor\Widget_Base {

				// List of shortcodes params,
				// that must be plain and get its value from the elementor's array
				// 'param_name' => [ 'array_key' ]
				private $plain_params = array(
					'url' => 'url',
					'link' => 'url',
					'image' => 'url',
					'bg_image' => 'url',
					'link_image' => 'url',					
					'columns' => 'size',
					'columns_tablet' => 'size',
					'columns_mobile' => 'size',
					'count' => 'size',
					'offset' => 'size',
					'slides_space' => 'size',
					'gradient_direction' => 'size',
					'typed_speed' => 'size',
					'typed_delay' => 'size',
				);
				
				// Set shortcode-specific list of params,
				// that must bubble up to the plain value
				protected function set_plain_params($list) {
					$this->plain_params = $list;
				}
				
				// Add shortcode-specific list of params,
				// that must bubble up to the plain value
				protected function add_plain_params($list) {
					$this->plain_params = array_merge($this->plain_params, $list);
				}

				// Return string with default subtitle
				protected function get_default_subtitle() {
					return __('Subtitle', 'trx_addons');
				}

				// Return string with default description
				protected function get_default_description() {
					return __('Some description text for this item', 'trx_addons');
				}

				/**
				 * Retrieve the list of scripts the widget depended on.
				 *
				 * Used to set scripts dependencies required to run the widget.
				 *
				 * @since 1.6.41
				 *
				 * @access public
				 *
				 * @return array Widget scripts dependencies.
				 */
				public function get_script_depends() {
					return array( 'trx_addons-elementor-preview' );
				}
				
				// Get all elements from specified post
				protected function get_post_elements($post_id = 0) {
					$meta = array();
					if ($post_id == 0 && trx_addons_get_value_gp('action')=='elementor')
						$post_id = trx_addons_get_value_gp('post');
					if ($post_id > 0) {
						$meta = get_post_meta( $post_id, '_elementor_data', true );
						if (substr($meta, 0, 1) == '[')
							$meta = json_decode( $meta, true );
					}
					return $meta;
				}
				
				// Get sc params from the current post or from the specified _elementor_data (2-nd parameter)
				protected function get_sc_params($sc='', $meta=false) {
					if ($meta === false)
						$meta = $this->get_post_elements();
					if (empty($sc))
						$sc = $this->get_name();
					$params = false;
					if (is_array($meta)) {
						foreach($meta as $v) {
							if (!empty($v['widgetType']) && $v['widgetType'] == $sc) {
								$params = $v['settings'];
								break;
							} else if (!empty($v['elements']) && count($v['elements']) > 0) {
								$params = $this->get_sc_params($sc, $v['elements']);
								if ($params !== false)
									break;
							}
						}
					}
					return $params;
				}

				// Return shortcode's name
				function get_sc_name() {
					return $this->get_name();
				}

				// Return shortcode function's name
				function get_sc_function() {
					return sprintf("trx_addons_%s", str_replace(array('trx_sc_', 'trx_widget_'), array('sc_', 'sc_widget_'), $this->get_sc_name()));
				}

				
				// ADD CONTROLS FOR COMMON PARAMETERS
				// Attention! You can use next tabs to create sections inside:
				// TAB_CONTENT | TAB_STYLE | TAB_ADVANCED | TAB_RESPONSIVE | TAB_LAYOUT | TAB_SETTINGS
				//------------------------------------------------------------

				// Create section with controls from params array
				protected function add_common_controls($group, $params, $add_params) {
					if (!empty($group['label'])) {
						$this->start_controls_section(
							'section_'.$group['section'].'_params',
							array(
								'label' => $group['label'],
								'tab' => empty($group['tab']) 
											? \Elementor\Controls_Manager::TAB_CONTENT 
											: $group['tab']
							)
						);
					}
					foreach ($params as $param) {
						if (isset($add_params[$param['name']])) {
							if (empty($add_params[$param['name']]))
								continue;
							else
								$param = array_merge($param, $add_params[$param['name']]);
							unset($add_params[$param['name']]);
						}
						if (!empty($param['responsive'])) {
							$this->add_responsive_control($param['name'], $param);
						} else {
							$this->add_control($param['name'], $param);
						}
					}
					if (count($add_params) > 0) {
						foreach ($add_params as $k => $v) {
							if (!empty($v) && is_array($v))
								$this->add_control($k, $v);
						}
					}
					if (!empty($group['label'])) {
						$this->end_controls_section();
					}
				}
				
				// Return parameters of the control with icons selector
				protected function get_icon_param($only_socials=false, $style='') {
					if (trx_addons_get_setting('icons_selector') == 'vc') {
						$params = array(
										array(
											'name' => 'icon',
											'type' => \Elementor\Controls_Manager::ICON,
											'label' => __( 'Icon', 'trx_addons' ),
											'label_block' => false,
											'default' => '',
										)
									);
					} else {
						if (empty($style)) {
							$style = $only_socials ? trx_addons_get_setting('socials_type') : trx_addons_get_setting('icons_type');
						}
						$params = array(
										array(
											'name' => 'icon',
											'type' => 'trx_icons',
											'label' => __( 'Icon', 'trx_addons' ),
											'label_block' => false,
											'default' => '',
											'options' => trx_addons_get_list_icons($style),
											'style' => $style
										)
									);
					}
					return apply_filters('trx_addons_filter_elementor_add_icon_param', $params, $only_socials, $style);
				}

				// Create control with icons selector
				protected function add_icon_param($group='', $add_params=array(), $style='') {
					$this->add_common_controls(
						array(
							'label' => $group===false ? __('Icon', 'trx_addons') : $group,
							'section' => 'icon'
						),
						$this->get_icon_param(!empty($add_params['only_socials']), $style),
						$add_params
					);
				}

				// Return 'Slider' parameters
				protected function get_slider_param() {
					$params = array(
						array(
							"name" => "slider",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Slider", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						),
						array(
							"name" => "slides_space",
							'type' => \Elementor\Controls_Manager::SLIDER,
							"label" => __('Space', 'trx_addons'),
							"description" => wp_kses_data( __('Space between slides', 'trx_addons') ),
							'condition' => array(
								'slider' => '1',
							),
							'default' => array(
								'size' => 0
							),
							'range' => array(
								'px' => array(
									'min' => 0,
									'max' => 100
								)
							)
						),
						array(
							'name' => 'slider_controls',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Slider controls', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_slider_controls(),
							'condition' => array(
								'slider' => '1',
							),
							'default' => 'none',
						),
						array(
							'name' => 'slider_pagination',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Slider pagination', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_slider_paginations(),
							'condition' => array(
								'slider' => '1',
							),
							'default' => 'none',
						),
						array(
							'name' => 'slider_pagination_type',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Slider pagination type', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_slider_paginations_types(),
							'condition' => array(
								'slider' => '1',
								'slider_pagination!' => 'none'
							),
							'default' => 'bullets',
						),
						array(
							"name" => "slides_centered",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Slides centered", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1',
							'condition' => array(
								'slider' => '1',
							),
						),
						array(
							"name" => "slides_overflow",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Slides overflow visible", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1',
							'condition' => array(
								'slider' => '1',
							),
						),
						array(
							"name" => "slider_mouse_wheel",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Mouse wheel enabled", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1',
							'condition' => array(
								'slider' => '1',
							),
						),
						array(
							"name" => "slider_autoplay",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Enable autoplay", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'default' => '1',
							'return_value' => '1',
							'condition' => array(
								'slider' => '1',
							),
						),
					);
					return apply_filters('trx_addons_filter_elementor_add_slider_param', $params);
				}
				
				// Create controls with 'Slider' params
				protected function add_slider_param($group=false, $add_params=array()) {
					$this->add_common_controls(
						array(
							'label' => $group===false ? __('Slider', 'trx_addons') : $group,
							'section' => 'slider',
							'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
						),
						$this->get_slider_param(),
						$add_params
					);
				}

				// Return 'Title' parameters
				protected function get_title_param($button=true) {
					$params = array(
						array(
							'name' => 'title_style',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Title style', 'trx_addons' ),
							'label_block' => false,
							'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'title'), 'trx_sc_title'),
							'default' => 'default',
						),
						array(
							'name' => 'title_tag',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Title tag', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_title_tags(),
							'default' => 'none',
						),
						array(
							'name' => 'title_align',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Title alignment', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_aligns(),
							'default' => 'none',
						),
						array(
							'name' => 'text_position',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Text position', 'trx_addons' ),
							'label_block' => false,
							'options' => array(
								'horizontal' => esc_html__('Horizontal', 'trx_addons'),
								'vertical' => esc_html__('Vertical', 'trx_addons'),
							),
							'default' => 'horizontal',
						),
						array(
							'name' => 'title_color',
							'label' => __( 'Title color', 'trx_addons' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'description' => '',
						),
						array(
							'name' => 'title_color2',
							'label' => __( 'Title color 2', 'trx_addons' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'description' => '',
							'condition' => array(
								'title_style' => 'gradient'
							),
						),
						array(
							'name' => 'gradient_direction',
							'label' => __( 'Gradient direction', 'trx_addons' ),
							'type' => \Elementor\Controls_Manager::SLIDER,
							'default' => array(
								'size' => 0,
								'unit' => 'px'
							),
							'size_units' => array( 'px' ),
							'range' => array(
								'px' => array(
									'min' => 0,
									'max' => 360
								)
							),
							'condition' => array(
								'title_style' => 'gradient'
							),
						),
						array(
							'name' => 'title',
							'type' => \Elementor\Controls_Manager::TEXT,
							'label' => __( "Title", 'trx_addons' ),
							"description" => wp_kses_data( __("Title of the block. Enclose any words in {{ and }} to make them italic or in (( and )) to make them bold. If title style is 'accent' - bolded element styled as shadow, italic - as a filled circle", 'trx_addons') ),
							'placeholder' => __( "Title", 'trx_addons' ),
							'separator' => 'before',
							'default' => ''
						),
						array(
							"name" => "typed",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Use autotype", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1',
							'condition' => array(
								'title!' => '',
							),
						),
						array(
							"name" => "typed_loop",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Autotype loop", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1',
							'default' => '1',
							'condition' => array(
								'typed' => '1',
							),
						),
						array(
							"name" => "typed_cursor",
							'type' => \Elementor\Controls_Manager::SWITCHER,
							"label" => __("Autotype cursor", 'trx_addons'),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1',
							'default' => '1',
							'condition' => array(
								'typed' => '1',
							),
						),
						array(
							'name' => 'typed_strings',
							'type' => \Elementor\Controls_Manager::TEXTAREA,
							'label' => __( 'Alternative strings', 'trx_addons' ),
							'label_block' => true,
							'description' => __( "Alternative strings to type. Attention! First string must be equal of the part of the title.", 'trx_addons' ),
							'default' => '',
							'separator' => 'none',
							'rows' => 5,
							'show_label' => true,
							'condition' => array(
								'typed' => '1',
							),
						),
						array(
							'name' => 'typed_color',
							'label' => __( 'Autotype color', 'trx_addons' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'default' => '',
							'description' => '',
							'condition' => array(
								'typed' => '1',
							),
						),
						array(
							"name" => "typed_speed",
							'type' => \Elementor\Controls_Manager::SLIDER,
							"label" => __('Autotype speed', 'trx_addons'),
							'condition' => array(
								'typed' => '1',
							),
							'default' => array(
								'size' => 6
							),
							'step' => 0.5,
							'range' => array(
								'px' => array(
									'min' => 1,
									'max' => 10
								)
							)
						),
						array(
							"name" => "typed_delay",
							'type' => \Elementor\Controls_Manager::SLIDER,
							"label" => __('Autotype delay (in sec.)', 'trx_addons'),
							'separator' => 'after',
							'condition' => array(
								'typed' => '1',
							),
							'default' => array(
								'size' => 1
							),
							'step' => 0.5,
							'range' => array(
								'px' => array(
									'min' => 0,
									'max' => 10
								)
							)
						),
						array(
							'name' => 'subtitle',
							'type' => \Elementor\Controls_Manager::TEXT,
							'label' => __( "Subtitle", 'trx_addons' ),
							'placeholder' => __( "Title text", 'trx_addons' ),
							'default' => ''
						),
						array(
							'name' => 'subtitle_align',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Subtitle alignment', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_aligns(),
							'default' => 'none',
						),
						array(
							'name' => 'description',
							'type' => \Elementor\Controls_Manager::TEXTAREA,
							'label' => __( 'Description', 'trx_addons' ),
							'label_block' => true,
							'placeholder' => __( "Short description of this block", 'trx_addons' ),
							'default' => '',
							'separator' => 'none',
							'rows' => 10,
							'show_label' => false,
						)
					);
					// Add button's params
					if ($button) {
						$params[] = array(
										'name' => 'link',
										'type' => \Elementor\Controls_Manager::URL,
										'label' => __( "Button's Link", 'trx_addons' ),
										'label_block' => false,
										'placeholder' => __( '//your-link.com', 'trx_addons' ),
									);
						$params[] = array(
										'name' => 'link_text',
										'type' => \Elementor\Controls_Manager::TEXT,
										'label' => __( "Button's text", 'trx_addons' ),
										'label_block' => false,
										'placeholder' => __( "Link's text", 'trx_addons' ),
										'default' => ''
									);
						$params[] = array(
										'name' => 'link_style',
										'type' => \Elementor\Controls_Manager::SELECT,
										'label' => __( "Button's style", 'trx_addons' ),
										'label_block' => false,
										'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'button'), 'trx_sc_button'),
										'default' => 'default',
									);
						$params[] = array(
										'name' => 'link_image',
										'type' => \Elementor\Controls_Manager::MEDIA,
										'label' => __( "Button's image", 'trx_addons' ),
										'default' => array(
											'url' => '',
										),
									);
					}
					return apply_filters('trx_addons_filter_elementor_add_title_param', $params);
				}
				
				// Create controls with 'Title' params
				protected function add_title_param($group=false, $add_params=array()) {
					$this->add_common_controls(
						array(
							'label' => $group===false ? __('Title, Description & Button', 'trx_addons') : $group,
							'section' => 'title',
							'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
						),
						$this->get_title_param(!isset($add_params['button']) || $add_params['button']),
						$add_params
					);
				}

				// Return 'Query' parameters
				protected function get_query_param() {
					$params = array(
						array(
							'name' => 'ids',
							'type' => \Elementor\Controls_Manager::TEXT,
							'label' => __( "IDs to show", 'trx_addons' ),
							"description" => wp_kses_data( __("Comma separated list of IDs to display. If not empty, parameters 'cat', 'offset' and 'count' are ignored!", 'trx_addons') ),
							'placeholder' => __( "IDs list", 'trx_addons' ),
							'default' => ''
						),
						array(
							"name" => "count",
							'type' => \Elementor\Controls_Manager::SLIDER,
							"label" => __('Count', 'trx_addons'),
							"description" => wp_kses_data( __("The number of displayed posts. If IDs are used, this parameter is ignored.", 'trx_addons') ),
							'condition' => array(
								'ids' => '',
							),
							'default' => array(
								'size' => 3
							),
							'range' => array(
								'px' => array(
									'min' => 1,
									'max' => 100
								)
							)
						),
						array(
							"name" => "columns",
							'type' => \Elementor\Controls_Manager::SLIDER,
							'responsive' => true,
							"label" => __('Columns', 'trx_addons'),
							"description" => wp_kses_data( __("Specify the number of columns. If left empty or assigned the value '0' - auto detect by the number of items.", 'trx_addons') ),
							'default' => array(
								'size' => 0
							),
							'range' => array(
								'px' => array(
									'min' => 0,
									'max' => 12
								)
							)
						),
						array(
							"name" => "offset",
							'type' => \Elementor\Controls_Manager::SLIDER,
							"label" => __('Offset', 'trx_addons'),
							"description" => wp_kses_data( __("Specify the number of items to be skipped before the displayed items.", 'trx_addons') ),
							'condition' => array(
								'ids' => '',
							),
							'default' => array(
								'size' => 0
							),
							'range' => array(
								'px' => array(
									'min' => 0,
									'max' => 100
								)
							)
						),
						array(
							'name' => 'orderby',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Order by', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_query_orderby(),
							'default' => 'none',
						),
						array(
							'name' => 'order',
							'type' => \Elementor\Controls_Manager::SELECT,
							'label' => __( 'Order', 'trx_addons' ),
							'label_block' => false,
							'options' => trx_addons_get_list_sc_query_orders(),
							'default' => 'asc',
						)
					);
					return apply_filters('trx_addons_filter_elementor_add_query_param', $params);
				}
				
				// Create controls with 'Query' params
				protected function add_query_param($group=false, $add_params=array()) {
					$this->add_common_controls(
						array(
							'label' => $group===false ? __('Query', 'trx_addons') : $group,
							'section' => 'query'
						),
						$this->get_query_param(),
						$add_params
					);
				}

				// Return 'Hide' parameters
				static function get_hide_param($hide_on_frontpage=false) {
					$params = array(
						array(
							'name' => 'hide_on_wide',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on wide screens', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						),
						array(
							'name' => 'hide_on_desktop',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on desktops', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						),
						array(
							'name' => 'hide_on_notebook',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on notebooks', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						),
						array(
							'name' => 'hide_on_tablet',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on tablets', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						),
						array(
							'name' => 'hide_on_mobile',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on mobile devices', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						)
					);
					if ($hide_on_frontpage) {
						$params[] = array(
							'name' => 'hide_on_frontpage',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on Frontpage', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						);
						$params[] = array(
							'name' => 'hide_on_singular',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on single posts', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						);
						$params[] = array(
							'name' => 'hide_on_other',
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'label' => __( 'Hide on other pages', 'trx_addons' ),
							'label_off' => __( 'Off', 'trx_addons' ),
							'label_on' => __( 'On', 'trx_addons' ),
							'return_value' => '1'
						);
					}
					return apply_filters('trx_addons_filter_elementor_add_hide_param', $params);
				}
				
				// Create controls with 'Hide' params
				protected function add_hide_param($group=false, $add_params=array()) {
					$this->add_common_controls(
						array(
							'label' => $group===false ? __('Hide', 'trx_addons') : $group,
							'section' => 'hide',
							'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
						),
						$this->get_hide_param(!empty($add_params['hide_on_frontpage'])),
						$add_params
					);
				}

				
				// RENDER SHORTCODE'S CONTENT
				//------------------------------------------------------------

				// Return widget's layout
				public function render() {
					$sc_func = $this->get_sc_function();
					if (function_exists($sc_func)) {
						trx_addons_sc_stack_push('trx_sc_layouts');		// To prevent wrap shortcodes output to the '<div class="sc_layouts_item"></div>'
						$output = call_user_func($sc_func, $this->sc_prepare_atts($this->get_settings(), $this->get_sc_name()));
						trx_addons_sc_stack_pop();
						trx_addons_show_layout($output);
					}
				}

				// Show message (placeholder) about not existing shortcode
				public function shortcode_not_exists($sc, $plugin) {
					?><div class="trx_addons_sc_not_exists">
						<h5 class="trx_addons_sc_not_exists_title"><?php echo esc_html(sprintf(__('Shortcode %s is not available!', 'trx_addons'), $sc)); ?></h5>
						<div class="trx_addons_sc_not_exists_description">
							<p><?php echo esc_html(sprintf(__('Shortcode "%1$s" from plugin "%2$s" is not available in Elementor Editor!', 'trx_addons'), $sc, $plugin)); ?></p>
							<p><?php esc_html_e('Possible causes:', 'trx_addons'); ?></p>
							<ol class="trx_addons_sc_not_exists_causes">
								<li><?php echo esc_html(sprintf(__('Plugin "%s" is not installed or not active', 'trx_addons'), $plugin)); ?></li>
								<li><?php esc_html_e('The plugin registers a shortcode later than it asks for Elementor Editor', 'trx_addons'); ?></li>
							</ol>
							<p><?php esc_html_e("So in the editor instead of the shortcode you see this message. To see the real shortcode's output - save the changes and open this page in Frontend", 'trx_addons'); ?></p>
						</div>
					</div><?php
				}

				// Prepare params for our shortcodes
				protected function sc_prepare_atts($atts, $sc='', $level=0) {
					if (is_array($atts)) {
						foreach($atts as $k=>$v) {
							// If current element is group (repeater)
							if (is_array($v) && isset($v[0]) && is_array($v[0])) {
								foreach ($v as $k1=>$v1) {
									$atts[$k][$k1] = $this->sc_prepare_atts($v1, $sc, $level+1);
								}

							// Current element is single control
							} else {
								// Make 'xxx' as plain string
								// and add 'xxx_extra' for each plain param
								if (in_array($k, array_keys($this->plain_params))) {
									$prm = explode('+', $this->plain_params[$k]);
									$atts["{$k}_extra"] = $v;
									if (isset($v[$prm[0]])) {
										$atts[$k] = $v = $v[$prm[0]] . (!empty($v[$prm[0]]) && !empty($prm[1]) && isset($v[$prm[1]]) ? $v[$prm[1]] : '');
									}
								}
								// Sinchronize 'id' and '_element_id'
								if ($k == '_element_id') {
									if (empty($atts['id'])) {
										$atts['id'] = !empty($v) 
														? $v . '_sc' // original '_element_id' is already applied to element's wrapper
														: $this->get_sc_name() . '_' . str_replace('.', '', mt_rand());
									}
/*
								// Sinchronize 'class' and '_css_classes'
								// Not used, because 'class' is already applied to element's wrapper
								} else if ($k == '_css_classes') {
									if (empty($atts['class'])) $atts['class'] = $v;
*/
								// Add icon_type='elementor' if attr 'icon' is present and equal to the 'fa fa-xxx'
                                // After update Elementor 2.6.0 'icon' is array (was a string in the previous versions) - convert it to string again
							} else if ($k == 'icon') {
								if ( is_array( $v ) ) {
									$atts['icon_extra'] = $v;
									$atts['icon'] = $v = ! empty( $v['icon'] ) ? $v['icon'] : '';
								}
								if (trx_addons_is_elementor_icon($v)) {
									$atts['icon_type'] = 'elementor';
								}
							}
							}
						}
					}
					return $level == 0 ? apply_filters('trx_addons_filter_elementor_sc_prepare_atts', $atts, $sc) : $atts;
				}

				
				// DISPLAY TEMPLATE'S PARTS
				//------------------------------------------------------------
				
				// Display title, subtitle and description for some shortcodes
				public function sc_show_titles($sc, $size='') {
					trx_addons_get_template_part('templates/tpe.sc_titles.php',
											'trx_addons_args_sc_show_titles',
											array('sc' => $sc, 'size' => $size, 'element' => $this)
										);
					
				}

				// Display link button or image for some shortcodes
				public function sc_show_links($sc) {
					trx_addons_get_template_part('templates/tpe.sc_links.php',
											'trx_addons_args_sc_show_links',
											array('sc' => $sc, 'element' => $this)
										);
				}

				// Display template from the shortcode 'Button'
				public function sc_show_button($sc) {
					?><# 
					var settings_sc_button_old = settings;
					settings = {
						'title': settings.link_text,
						'link': settings.link,
						'type': settings.link_style,
						'class': 'sc_item_button sc_item_button_'+settings.link_style+' <?php echo esc_attr($sc); ?>_button',
						'align': settings.title_align ? settings.title_align : 'none'
					};
					#><?php
					trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . 'button/tpe.button.php',
											'trx_addons_args_sc_show_button',
											array('sc' => $sc, 'element' => $this)
										);
					?><#
					settings = settings_sc_button_old;
					#><?php
				}

				// Display begin of the slider layout for some shortcodes
				public function sc_show_slider_wrap_start($sc) {
					trx_addons_get_template_part('templates/tpe.sc_slider_start.php',
											'trx_addons_args_sc_show_slider_wrap',
											apply_filters('trx_addons_filter_sc_show_slider_args', array('sc' => $sc, 'element' => $this))
										);
				}

				// Display end of the slider layout for some shortcodes
				public function sc_show_slider_wrap_end($sc) {
					trx_addons_get_template_part('templates/tpe.sc_slider_end.php',
											'trx_addons_args_sc_show_slider_wrap',
											apply_filters('trx_addons_filter_sc_show_slider_args', array('sc' => $sc, 'element' => $this))
										);
				}
			}
		}
	}
}


// Check if icon name is from the Elementor icons
if ( !function_exists( 'trx_addons_is_elementor_icon' ) ) {
	function trx_addons_is_elementor_icon($icon) {
		return !empty($icon) && strpos($icon, 'fa ') !== false;
	}
}



// Output inline CSS
// if current action is 'wp_ajax_elementor_render_widget' or 'admin_action_elementor' (old Elementor) or 'elementor_ajax' (new Elementor)
// (called from Elementor Editor via AJAX or first load page content to the Editor)
//---------------------------------------------------------------------------------------
if (!function_exists('trx_addons_elm_print_inline_css')) {
	add_filter( 'elementor/widget/render_content', 'trx_addons_elm_print_inline_css', 10, 2 );
	function trx_addons_elm_print_inline_css($content, $widget=null) {
		if (doing_action('wp_ajax_elementor_render_widget') || doing_action('admin_action_elementor') || doing_action('elementor_ajax') || doing_action('wp_ajax_elementor_ajax')) {
			$css = trx_addons_get_inline_css(true);
			if (!empty($css)) {
				$content .= sprintf('<style type="text/css">%s</style>', $css);
			}
		}
		return $content;
	}
}



// Register custom controls for Elementor
//------------------------------------------------------------------------
if (!function_exists('trx_addons_elm_register_custom_controls')) {
	add_action( 'elementor/controls/controls_registered', 'trx_addons_elm_register_custom_controls' );
	function trx_addons_elm_register_custom_controls( $controls_manager ) {
		$controls = array('trx_icons');
		foreach ( $controls as $control_id ) {
			$control_filename = str_replace('_', '-', $control_id);
			require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . "elementor/params/{$control_filename}/{$control_filename}.php";
			$class_name = 'Trx_Addons_Elementor_Control_' . ucwords( $control_id );
			if ( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, '3.5.0', '>=' ) ) {
				$controls_manager->register( new $class_name() );	
			} else {
				$controls_manager->register_control( $control_id, new $class_name() );
			}
		}
	}
}


// Add/Modify/Remove standard Elementor's shortcodes params
//------------------------------------------------------------------------

// Add/Remove params to the existings sections: stack section
if (!function_exists('trx_addons_elm_add_params_stack_section')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_stack_section', 10, 3 );
	function trx_addons_elm_add_params_stack_section($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Stack section' to the sections
		if ( $el_name == 'section' && $section_id == 'section_advanced' ) {
			$element->add_control( 'stack_section', array(
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => __("Stack section", 'trx_addons'),
									'label_on' => __( 'On', 'trx_addons' ),
									'label_off' => __( 'Off', 'trx_addons' ),
									'return_value' => 'on',
									'prefix_class' => 'sc_stack_section_',
								) );
		}
	}
}

// Add/Remove params to the existings sections: content width and alignment
if (!function_exists('trx_addons_elm_add_params_content_width_and_align')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_content_width_and_align', 10, 3 );
	function trx_addons_elm_add_params_content_width_and_align($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Content width' and 'Content alignment' to the columns
		// to enable align columns in the stretched rows on the page content area
		if ( $el_name == 'column' && $section_id == 'layout' ) {
			$element->add_responsive_control( 'content_width', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Content width", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_widths('none', false),
									'default' => 'none',
									'prefix_class' => 'sc%s_inner_width_',
								) );
			$element->add_responsive_control( 'content_align', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Content alignment", 'trx_addons'),
									'options' => array(
										'inherit' => __("Default", 'trx_addons'),
										'left'    => __("Left", 'trx_addons'),
										'center'  => __("Center", 'trx_addons'),
										'right'   => __("Right", 'trx_addons'),
									),
									'default' => 'inherit',
									'prefix_class' => 'sc%s_content_align_',
								) );
		}
	}
}


// Add/Remove params to the existings sections: gradient animation for sections and columns
if (!function_exists('trx_addons_elm_add_params_gradient_animation')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_gradient_animation', 10, 3 );
	function trx_addons_elm_add_params_gradient_animation($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Gradient animation'
		if ( ($el_name == 'section' && $section_id == 'section_background')
			|| ($el_name == 'column' && $section_id == 'section_style')
			) {

			$element->add_control( 'gradient_animation', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Gradient animation", 'trx_addons'),
									'options' => array(
										'none'       => __("None", 'trx_addons'),
										'horizontal' => __("Horizontal", 'trx_addons'),
										'vertical'   => __("Vertical", 'trx_addons'),
										'diagonal'   => __("Diagonal", 'trx_addons'),
									),
									'default' => 'none',
									'condition' => array(
										'background_background' => array( 'gradient' ),
									),
									'prefix_class' => 'sc_gradient_animation_',
								) );

			$element->add_control( 'gradient_animation_speed', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Animation speed", 'trx_addons'),
									'options' => array(
										'slow'   => __("Slow", 'trx_addons'),
										'normal' => __("Normal", 'trx_addons'),
										'fast'   => __("Fast", 'trx_addons'),
									),
									'default' => 'normal',
									'condition' => array(
										'background_background' => array( 'gradient' ),
										'gradient_animation!' => array( 'none' ),
									),
									'prefix_class' => 'sc_gradient_speed_',
								) );
		}
	}
}


// Add/Remove params to the existings sections: gradient animation for all other blocks
if (!function_exists('trx_addons_elm_add_params_gradient_animation_common')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_gradient_animation_common', 10, 3 );
	function trx_addons_elm_add_params_gradient_animation_common($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Gradient animation'
		if ( $el_name == 'common' && $section_id == '_section_background' ) {

			$element->add_control( 'gradient_animation', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Gradient animation", 'trx_addons'),
									'options' => array(
										'none'       => __("None", 'trx_addons'),
										'horizontal' => __("Horizontal", 'trx_addons'),
										'vertical'   => __("Vertical", 'trx_addons'),
										'diagonal'   => __("Diagonal", 'trx_addons'),
									),
									'default' => 'none',
									'condition' => array(
										'_background_background' => array( 'gradient' ),
									),
									'prefix_class' => 'sc_gradient_animation_',
								) );

			$element->add_control( 'gradient_animation_speed', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Animation speed", 'trx_addons'),
									'options' => array(
										'slow'   => __("Slow", 'trx_addons'),
										'normal' => __("Normal", 'trx_addons'),
										'fast'   => __("Fast", 'trx_addons'),
									),
									'default' => 'normal',
									'condition' => array(
										'_background_background' => array( 'gradient' ),
										'gradient_animation!' => array( 'none' ),
									),
									'prefix_class' => 'sc_gradient_speed_',
								) );
		}
	}
}


// Add/Remove params to the existings sections: hide bg image
if (!function_exists('trx_addons_elm_add_params_hide_bg_image')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_hide_bg_image', 10, 3 );
	function trx_addons_elm_add_params_hide_bg_image($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Hide bg image on XXX' to the rows
		if ( ($el_name == 'section' && $section_id == 'section_background')
			|| ($el_name == 'column' && $section_id == 'section_style')
			) {

			$element->add_control( 'hide_bg_image_on_desktop', array(
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => __( 'Hide bg image on the desktop', 'trx_addons' ),
									'label_on' => __( 'Hide', 'trx_addons' ),
									'label_off' => __( 'Show', 'trx_addons' ),
									'return_value' => 'desktop',
									'prefix_class' => 'hide_bg_image_on_',
								) );
			$element->add_control( 'hide_bg_image_on_tablet', array(
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => __( 'Hide bg image on the tablet', 'trx_addons' ),
									'label_on' => __( 'Hide', 'trx_addons' ),
									'label_off' => __( 'Show', 'trx_addons' ),
									'return_value' => 'tablet',
									'prefix_class' => 'hide_bg_image_on_',
								) );
			$element->add_control( 'hide_bg_image_on_mobile', array(
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => __( 'Hide bg image on the mobile', 'trx_addons' ),
									'label_on' => __( 'Hide', 'trx_addons' ),
									'label_off' => __( 'Show', 'trx_addons' ),
									'return_value' => 'mobile',
									'prefix_class' => 'hide_bg_image_on_',
								) );
		}
	}
}


// Add/Remove params to the existings sections: hide on XXX
if (!function_exists('trx_addons_elm_add_params_hide_on_xxx')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_hide_on_xxx', 10, 3 );
	function trx_addons_elm_add_params_hide_on_xxx($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Hide on XXX' to the any elements
		$add_hide_on_xxx = trx_addons_get_setting('add_hide_on_xxx');
		if ( ! trx_addons_is_off($add_hide_on_xxx) && class_exists( 'TRX_Addons_Elementor_Widget' ) ) {
			if ($section_id == '_section_responsive') { // && $el_name == 'section'
				$params = TRX_Addons_Elementor_Widget::get_hide_param(false);
				if (is_array($params)) {
					if ($add_hide_on_xxx == 'add') {
						$element->add_control(
							'trx_addons_responsive_heading',
							array(
								'label' => __( 'Theme-specific params', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::HEADING,
								'separator' => 'before',
							)
						);
						$element->add_control(
							'trx_addons_responsive_description',
							array(
								'raw' => __( "Theme-specific parameters - you can use them instead of the Elementor's parameters above.", 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::RAW_HTML,
								'content_classes' => 'elementor-descriptor',
							)
						);
					}
					foreach ($params as $p) {
						$element->add_control( $p['name'], array_merge($p, array(
																				'return_value' => $p['name'],
																				'prefix_class' => 'sc_layouts_',
																				))
											);
					}
				}
			}
		}
	}
}


// Add/Remove params to the existings sections: extend background
if (!function_exists('trx_addons_elm_add_params_extend_bg')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_extend_bg', 10, 3 );
	function trx_addons_elm_add_params_extend_bg($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Extend background' and 'Background mask' to the rows, columns and text-editor
		if ( ($el_name == 'section' && $section_id == 'section_background')
			|| ($el_name == 'column' && $section_id == 'section_style')
			|| ($el_name == 'text-editor' && $section_id == 'section_background')
			) {
			$element->add_control( 'extra_bg', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Extend background", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_extra_bg(''),
									'default' => '',
									'prefix_class' => 'sc_extra_bg_'
									) );
			$element->add_control( 'extra_bg_mask', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Background mask", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_extra_bg_mask(''),
									'default' => '',
									'prefix_class' => 'sc_bg_mask_'
									) );
		}
	}
}


// Add/Remove params to the existings sections: alter height to the spacer and divider
if (!function_exists('trx_addons_elm_add_params_alter_height')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_alter_height', 10, 3 );
	function trx_addons_elm_add_params_alter_height($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();

		// Add 'Alter height/gap' to the spacer and divider
		if ( ($el_name == 'spacer' && $section_id == 'section_spacer')
				  || ($el_name == 'divider' && $section_id == 'section_divider')) {
			$element->add_control( 'alter_height', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => $el_name == 'divider' ? __("Alter gap", 'trx_addons') : __("Alter height", 'trx_addons'),
									'label_block' => true,
									'options' => trx_addons_get_list_sc_empty_space_heights(''),
									'default' => '',
									'prefix_class' => 'sc_height_'
									) );
		}
	}
}


// Add/Remove params to the existings sections: add new shape dividers
if (!function_exists('trx_addons_elm_add_params_shape_dividers')) {
	add_action( 'elementor/element/before_section_end', 'trx_addons_elm_add_params_shape_dividers', 10, 3 );
	function trx_addons_elm_add_params_shape_dividers($element, $section_id, $args) {

		if (!is_object($element)) return;
		
		$el_name = $element->get_name();
		
		// Add new shapes to the 'Shape dividers' in the section
		global $TRX_ADDONS_STORAGE;
		if ( $el_name == 'section' && $section_id == 'section_shape_divider' && !empty($TRX_ADDONS_STORAGE['shapes_list'])) {
			$sides = array('top', 'bottom');
			$options = $conditions = false;
			$prefix = 'trx_addons';
			foreach ($sides as $side) {
				// Add shapes to the shapes list
				$control_id = "shape_divider_{$side}";
				if ($options === false) {
					$control = $element->get_controls( $control_id );
					$options = $control['options'];
					foreach($TRX_ADDONS_STORAGE['shapes_list'] as $shape) {
						$shape_name = pathinfo($shape, PATHINFO_FILENAME);
						$options["{$prefix}_{$shape_name}"] = ucfirst(str_replace('_', ' ', $shape_name));
					}
				}
				$element->update_control( $control_id, array(
									'options' => $options
								) );

				// Add shapes to the condition for the 'Flip' and 'Width' controls
				$controls = array("flip", "width");
				$conditions = array();
				foreach ($controls as $control_name) {
					$control_id = "shape_divider_{$side}_{$control_name}";
					$control = $element->get_controls( $control_id );
					$conditions[$control_name] = isset($control['condition']) ? $control['condition'] : false;
					if (is_array($conditions[$control_name])) {
						foreach($TRX_ADDONS_STORAGE['shapes_list'] as $shape) {
							$shape_name = pathinfo($shape, PATHINFO_FILENAME);
							foreach ($conditions[$control_name] as $k=>$v) {
								if (is_array($v) && strpos($k, 'shape_divider_')!==false) {
									$v[] = "{$prefix}_{$shape_name}";
									$conditions[$control_name][$k] = $v;
								}
							}
						}
					}
				}
				foreach ($controls as $control_name) {
					$control_id = "shape_divider_{$side}_{$control_name}";
					if ($conditions[$control_name] !== false) {
						$element->update_control( $control_id, array(
										'condition' => $conditions[$control_name]
									) );
					}
				}
			}
		}
	}
}


// Substitute shapes in the sections
if (!function_exists('trx_addons_elm_before_render')) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/before_render', 'trx_addons_elm_before_render', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/section/before_render', 'trx_addons_elm_before_render', 10, 1 );
	function trx_addons_elm_before_render($element) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			if ( $el_name == 'section' ) {
				$settings = $element->get_settings();
				$sides = array('top', 'bottom');
				$capture = false;
				$prefix = 'trx_addons';
				foreach ($sides as $side) {
					$base_setting_key = "shape_divider_{$side}";
					$shape = $settings[ $base_setting_key ];
					if (strpos($shape, "{$prefix}_") === 0) {
						$capture = true;
						$shapes = \Elementor\Shapes::get_shapes();
						if (!is_array($shapes)) $shapes = array('mountains'=>'');
						$element->set_settings("{$base_setting_key}_{$prefix}", str_replace("{$prefix}_", '', $shape));
						$element->set_settings($base_setting_key, trx_addons_array_get_first($shapes));
						if (!empty($element->active_settings[$base_setting_key])) {
							$element->active_settings[$base_setting_key] = trx_addons_array_get_first($shapes);
						}
					}
				}
				if ($capture) {
					ob_start();
				}
			}
		}
	}
}

if (!function_exists('trx_addons_elm_after_render')) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/after_render', 'trx_addons_elm_after_render', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/section/after_render', 'trx_addons_elm_after_render', 10, 1 );
	function trx_addons_elm_after_render($element) {
		if ( is_object($element) ) {
			$el_name = $element->get_name();
			if ( $el_name == 'section' ) {
				$settings = $element->get_settings();
				$sides = array('top', 'bottom');
				$replace = array();
				$prefix = 'trx_addons';
				foreach ($sides as $side) {
					$base_setting_key = "shape_divider_{$side}";
					if (!empty($settings[ "{$base_setting_key}_{$prefix}" ])) {
						$replace["elementor-shape-{$side}"] = $settings[ "{$base_setting_key}_{$prefix}" ];
					}
				}
				if (count($replace) > 0) {
					$html = ob_get_contents();
					ob_end_clean();
					foreach ($replace as $class=>$shape) {
						$shape_dir = trx_addons_get_file_dir("css/shapes/{$shape}.svg");
						if (!empty($shape_dir)) {
							$html = preg_replace('~(<div[\s]*class="elementor-shape[\s]+'.$class.'".*>)([\s\S]*)(</div>)~U',
												'$1' . strip_tags(trx_addons_fgc($shape_dir), '<svg><path>') . '$3',
												$html);
						}
					}
					trx_addons_show_layout($html);
				}
			}
		}
	}
}


// Add/Remove params to the new section: shift and push
if (!function_exists('trx_addons_elm_add_columns_position')) {
	add_action( 'elementor/element/before_section_start', 'trx_addons_elm_add_columns_position', 10, 3 );
	function trx_addons_elm_add_columns_position($element, $section_id, $args) {

		if ( !is_object($element) ) return;
		
		if ( in_array( $element->get_name(), array( 'section', 'column' ) ) && $section_id == '_section_responsive' ) {
			
			$element->start_controls_section( 'section_trx_layout',	array(
																		'tab' => !empty($args['tab']) ? $args['tab'] : \Elementor\Controls_Manager::TAB_ADVANCED,
																		'label' => __( 'Position', 'trx_addons' )
																	) );
			// Add 'Fix column' to the columns
			if ($element->get_name() == 'column') {
				$element->add_control( 'fix_column', array(
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => __( 'Fix column', 'trx_addons' ),
									'description' => wp_kses_data( __("Fix this column when page scrolling. Attention! At least one column in the row must have a greater height than this column", 'trx_addons') ),
									'label_on' => __( 'Fix', 'trx_addons' ),
									'label_off' => __( 'No', 'trx_addons' ),
									'return_value' => 'fixed',
									'prefix_class' => 'sc_column_',
									) );
			}
			$element->add_control( 'shift_x', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Shift block along the X-axis", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_shift(''),
									'default' => '',
									'prefix_class' => 'sc_shift_x_'
									) );
			$element->add_control( 'shift_y', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Shift block along the Y-axis", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_shift(''),
									'default' => '',
									'prefix_class' => 'sc_shift_y_'
									) );
			
			$element->add_control( 'push_x', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Push block along the X-axis", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_shift(''),
									'default' => '',
									'prefix_class' => 'sc_push_x_'
									) );
			$element->add_control( 'push_y', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Push block along the Y-axis", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_shift(''),
									'default' => '',
									'prefix_class' => 'sc_push_y_'
									) );
			
			$element->add_control( 'pull_x', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Pull next block along the X-axis", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_shift(''),
									'default' => '',
									'prefix_class' => 'sc_pull_x_'
									) );
			$element->add_control( 'pull_y', array(
									'type' => \Elementor\Controls_Manager::SELECT,
									'label' => __("Pull next block along the Y-axis", 'trx_addons'),
									'options' => trx_addons_get_list_sc_content_shift(''),
									'default' => '',
									'prefix_class' => 'sc_pull_y_'
									) );

			$element->end_controls_section();
		}
	}
}


// Add "Fly" params to the new section to widgets
if (!function_exists('trx_addons_elm_add_params_fly')) {
	add_action( 'elementor/element/before_section_start', 'trx_addons_elm_add_params_fly', 10, 3 );
	add_action( 'elementor/widget/before_section_start', 'trx_addons_elm_add_params_fly', 10, 3 );
	function trx_addons_elm_add_params_fly($element, $section_id, $args) {

		if ( !is_object($element) ) return;

		if ( $element->get_name() == 'common' && $section_id == '_section_responsive' ) {
			
			$element->start_controls_section( 'section_trx_fly', array(
																		'tab' => !empty($args['tab']) ? $args['tab'] : \Elementor\Controls_Manager::TAB_ADVANCED,
																		'label' => __( 'Fly', 'trx_addons' )
																	) );
			$element->add_control(
				'fly',
				array(
					'label' => __( 'Fly', 'trx_addons' ),
					'label_block' => false,
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => array_merge(
									array('static' => __('Static', 'trx_addons')),
									array('custom' => __('Custom', 'trx_addons')),
									trx_addons_get_list_sc_positions()
								),
					'default' => 'static',
					'prefix_class' => 'sc_fly_',
				)
			);
			$coord = array(
							'label' => __( 'Left', 'trx_addons' ),
							'type' => \Elementor\Controls_Manager::SLIDER,
							'default' => array(
								'size' => '',
								'unit' => 'px'
							),
							'size_units' => array( 'px', 'em', '%' ),
							'range' => array(
								'px' => array(
									'min' => -500,
									'max' => 500
								),
								'em' => array(
									'min' => -50,
									'max' => 50
								),
								'%' => array(
									'min' => -100,
									'max' => 100
								)
							),
							'condition' => array(
								'fly' => array( 'custom', 'tl', 'tr', 'bl', 'br' )
							),
							'selectors' => array(
								'{{WRAPPER}}' => 'left: {{SIZE}}{{UNIT}};'
							),
						);
			$element->add_responsive_control( 'fly_left', $coord );
			$coord['label'] = __( 'Right', 'trx_addons' );
			$coord['selectors'] = array( '{{WRAPPER}}' => 'right: {{SIZE}}{{UNIT}};' );
			$element->add_responsive_control( 'fly_right', $coord );
			$coord['label'] = __( 'Top', 'trx_addons' );
			$coord['selectors'] = array( '{{WRAPPER}}' => 'top: {{SIZE}}{{UNIT}};' );
			$element->add_responsive_control( 'fly_top', $coord );
			$coord['label'] = __( 'Bottom', 'trx_addons' );
			$coord['selectors'] = array( '{{WRAPPER}}' => 'bottom: {{SIZE}}{{UNIT}};' );
			$element->add_responsive_control( 'fly_bottom', $coord );

			$element->add_responsive_control( 'fly_scale', array(
													'label' => __( 'Scale', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => '',
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => 0,
															'max' => 10,
															'step' => 0.1
														)
													),
													'selectors' => array(
														'{{WRAPPER}} .elementor-widget-container' => 'transform: scale({{SIZE}}, {{SIZE}});'
													),
									) );

			$element->add_responsive_control( 'fly_rotate', array(
													'label' => __( 'Rotation (in deg)', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => '',
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => -360,
															'max' => 360,
															'step' => 1
														)
													),
													'selectors' => array(
														'{{WRAPPER}} .elementor-widget-container' => 'transform: rotate({{SIZE}}deg);'
													),
									) );

			$element->end_controls_section();
		}
	}
}

// Add class "sc_fly" to the wrapper of widgets
if ( !function_exists( 'trx_addons_elm_render_fly' ) ) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/before_render',  'trx_addons_elm_render_fly', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/section/before_render', 'trx_addons_elm_render_fly', 10, 1 );
	add_action( 'elementor/frontend/column/before_render',  'trx_addons_elm_render_fly', 10, 1 );
	add_action( 'elementor/frontend/widget/before_render',  'trx_addons_elm_render_fly', 10, 1 );
	function trx_addons_elm_render_fly($element) {
		$settings = $element->get_settings();
		if (!empty($settings['fly'])) {
			//$element->add_render_attribute( '_wrapper', 'class', 'sc_fly');
		}
	}
}


// Add "Parallax" params to the new section to rows and columns
if (!function_exists('trx_addons_elm_add_parallax_blocks')) {
	add_action( 'elementor/element/before_section_start', 'trx_addons_elm_add_parallax_blocks', 10, 3 );
	function trx_addons_elm_add_parallax_blocks($element, $section_id, $args) {

		if ( !is_object($element) ) return;

		if ( in_array( $element->get_name(), array( 'section', 'column' ) ) && $section_id == '_section_responsive' ) {

			$element->start_controls_section( 'section_trx_parallax',	array(
																		'tab' => !empty($args['tab']) ? $args['tab'] : \Elementor\Controls_Manager::TAB_ADVANCED,
																		'label' => __( 'Parallax', 'trx_addons' )
																	) );

			$element->add_control(
				'parallax_blocks',
				array(
					'label' => __( 'Parallax blocks', 'trx_addons' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => apply_filters('trx_addons_sc_param_group_params',
						array(
							array(
								'name' => 'type',
								'label' => __( 'Block handle', 'trx_addons' ),
								'label_block' => false,
								'type' => \Elementor\Controls_Manager::SELECT,
								'options' => array(
									'none'   => __('None', 'trx_addons'),
									'mouse'  => __('Mouse events', 'trx_addons'),
									'scroll' => __('Scroll events', 'trx_addons'),
									'motion' => __('Permanent motion', 'trx_addons'),
								),
								'default' => 'none',
							),
							array(
								'name' => 'animation_prop',
								'label' => __( 'Animation', 'trx_addons' ),
								'label_block' => false,
								'type' => \Elementor\Controls_Manager::SELECT,
								'options' => array(
									'background'  => __('Background', 'trx_addons'),
									'transform'   => __('Transform', 'trx_addons'),
									'transform3d' => __('Transform3D', 'trx_addons'),
								),
								'default' => 'background',
							),
							array(
								'name' => 'image',
								'label' => __( 'Background image', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::MEDIA,
								'default' => array(
									'url' => '',
								),
							),
							array(
								'name' => 'bg_size',
								'label' => __( 'Background size', 'trx_addons' ),
								'label_block' => false,
								'type' => \Elementor\Controls_Manager::SELECT,
								'options' => array(
									'auto'    => __('Auto', 'trx_addons'),
									'cover'   => __('Cover', 'trx_addons'),
									'contain' => __('Contain', 'trx_addons'),
								),
								'default' => 'cover',
							),
							array(
								'name' => 'left',
								'label' => __( 'Left position (in %)', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::SLIDER,
								'default' => array(
									'size' => 0,
									'unit' => 'px'
								),
								'range' => array(
									'px' => array(
										'min' => 0,
										'max' => 100
									),
								),
								'size_units' => array( 'px' )
							),
							array(
								'name' => 'top',
								'label' => __( 'Top position (in %)', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::SLIDER,
								'default' => array(
									'size' => 0,
									'unit' => 'px'
								),
								'range' => array(
									'px' => array(
										'min' => 0,
										'max' => 100
									),
								),
								'size_units' => array( 'px' ),
							),
							array(
								'name' => 'speed',
								'label' => __( 'Shift speed', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::SLIDER,
								'default' => array(
									'size' => 50,
									'unit' => 'px'
								),
								'range' => array(
									'px' => array(
										'min' => -100,
										'max' => 100
									),
								),
								'size_units' => array( 'px' ),
							),
							array(
								'name' => 'z_index',
								'label' => __( 'Z-index', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::SLIDER,
								'default' => array(
									'size' => '',
									'unit' => 'px'
								),
								'range' => array(
									'px' => array(
										'min' => -1,
										'max' => 100
									),
								),
								'size_units' => array( 'px' ),
							),
							array(
								'name' => 'motion_dir',
								'type' => \Elementor\Controls_Manager::SELECT,
								'label' => __( 'Motion direction', 'trx_addons' ),
								'label_block' => false,
								'options' => array(
									'vertical' => __( 'Vertical', 'trx_addons'),
									'horizontal' => __( 'Horizontal', 'trx_addons'),
									'round' => __( 'Round', 'trx_addons'),
									'random' => __( 'Random', 'trx_addons'),
								),
								'default' => 'round',
								'condition' => array(
									'type' => 'motion'
								),
							),
							array(
								'name' => 'motion_time',
								'label' => __( 'Motion time', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::SLIDER,
								'default' => array(
									'size' => 5,
									'unit' => 'px'
								),
								'size_units' => array( 'px' ),
								'range' => array(
									'px' => array(
										'min' => 0.1,
										'max' => 20,
										'step' => 0.1
									)
								),
								'condition' => array(
									'type' => 'motion'
								),
							),
							array(
								'name' => 'class',
								'label' => __( 'CSS class', 'trx_addons' ),
								'description' => __( 'Class name to assign additional rules to this block. For example: "hide_on_notebook", "hide_on_tablet", "hide_on_mobile" to hide block on the relative device', 'trx_addons' ),
								'type' => \Elementor\Controls_Manager::TEXT,
								'default' => '',
							),
						),
						'trx_sc_parallax_row'),
					'title_field' => '{{{ left.size }}}x{{{ top.size }}} / {{{ type }}} / {{{ animation_prop }}}',
				)
			);

			$element->end_controls_section();
		}
	}
}

// Add "data-parallax-params" to the wrapper of the row
if ( !function_exists( 'trx_addons_elm_add_parallax_blocks_data' ) ) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/before_render',  'trx_addons_elm_add_parallax_blocks_data', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/section/before_render', 'trx_addons_elm_add_parallax_blocks_data', 10, 1 );
	add_action( 'elementor/frontend/column/before_render', 'trx_addons_elm_add_parallax_blocks_data', 10, 1 );
	function trx_addons_elm_add_parallax_blocks_data($element) {
		if ( is_object($element) && in_array( $element->get_name(), array( 'section', 'column' ) ) ) {
			$settings = $element->get_settings();
			if (!empty($settings['parallax_blocks']) && is_array($settings['parallax_blocks']) && count($settings['parallax_blocks']) > 0) {
				$element->add_render_attribute( '_wrapper', 'class', 'sc_parallax' );
				$element->add_render_attribute( '_wrapper', 'data-parallax-blocks', json_encode($settings['parallax_blocks']) );
			}
		}
	}
}


// Add "Parallax" params to the new section to widgets
if (!function_exists('trx_addons_elm_add_parallax_params_to_widgets')) {
	add_action( 'elementor/element/before_section_start', 'trx_addons_elm_add_parallax_params_to_widgets', 10, 3 );
	add_action( 'elementor/widget/before_section_start', 'trx_addons_elm_add_parallax_params_to_widgets', 10, 3 );
	function trx_addons_elm_add_parallax_params_to_widgets($element, $section_id, $args) {

		if ( !is_object($element) ) return;

		if ( in_array( $element->get_name(), array( 'section', 'column', 'common' ) ) && $section_id == '_section_responsive' ) {
			
			$element->start_controls_section( 'section_trx_entrance', array(
																		'tab' => !empty($args['tab']) ? $args['tab'] : \Elementor\Controls_Manager::TAB_ADVANCED,
																		'label' => __( 'Parallax or Entrance', 'trx_addons' )
																	) );
			$element->add_control( 'parallax', array(
													'type' => \Elementor\Controls_Manager::SWITCHER,
													'label' => __( 'Parallax', 'trx_addons' ),
													'label_on' => __( 'On', 'trx_addons' ),
													'label_off' => __( 'Off', 'trx_addons' ),
													'return_value' => 'parallax',
													'prefix_class' => 'sc_',
									) );
			$element->add_control( 'parallax_entrance', array(
													'type' => \Elementor\Controls_Manager::SWITCHER,
													'label' => __( 'Entrance', 'trx_addons' ),
													'label_on' => __( 'On', 'trx_addons' ),
													'label_off' => __( 'Off', 'trx_addons' ),
													'return_value' => 'entrance',
													'prefix_class' => 'sc_parallax_',
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );
			$element->add_control( 'parallax_start', array(
													'type' => \Elementor\Controls_Manager::SWITCHER,
													'label' => __( 'Values below are', 'trx_addons' ),
													'label_on' => __( 'Start', 'trx_addons' ),
													'label_off' => __( 'End', 'trx_addons' ),
													'return_value' => 'start',
													'prefix_class' => 'sc_parallax_',
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );
			
			$element->add_control( 'parallax_text', array(
													'type' => \Elementor\Controls_Manager::SELECT,
													'label' => __( 'Text animation', 'trx_addons' ),
													'label_block' => false,
													'options' => array(
														'block' => __( 'Whole block', 'trx_addons'),
														'words' => __( 'Word by word', 'trx_addons'),
														'chars' => __( 'Char by char', 'trx_addons'),
													),
													'default' => 'block',
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );
			$element->add_control( 'parallax_x', array(
													'label' => __( 'The shift along the X-axis (in px)', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 0,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => -500,
															'max' => 500
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );
			$element->add_control( 'parallax_y', array(
													'label' => __( 'The shift along the Y-axis (in px)', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 0,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => -500,
															'max' => 500
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );

			$element->add_control( 'parallax_opacity', array(
													'label' => __( 'Change the opacity', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 0,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => -1,
															'max' => 0,
															'step' => 0.05
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );

			$element->add_control( 'parallax_scale', array(
													'label' => __( 'Change the scale (in %)', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 0,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => -100,
															'max' => 1000,
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );

			$element->add_control( 'parallax_rotate', array(
													'label' => __( 'Change the rotation (in deg)', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 0,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => -360,
															'max' => 360,
															'step' => 1
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );

			$element->add_control( 'parallax_duration', array(
													'label' => __( 'Duration (in sec)', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 1,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => 0.1,
															'max' => 10,
															'step' => 0.1
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );

			$element->add_control( 'parallax_amplitude', array(
													'label' => __( 'Amplitude', 'trx_addons' ),
													'type' => \Elementor\Controls_Manager::SLIDER,
													'default' => array(
														'size' => 40,
														'unit' => 'px'
													),
													'size_units' => array( 'px' ),
													'range' => array(
														'px' => array(
															'min' => 1,
															'max' => 100,
															'step' => 1
														)
													),
													'condition' => array(
														'parallax' => 'parallax'
													),
									) );

			$element->end_controls_section();
		}
	}
}

// Add "data-parallax-params" to the wrapper of the widget
if ( !function_exists( 'trx_addons_elm_add_parallax_data_to_widgets' ) ) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/before_render',  'trx_addons_elm_add_parallax_data_to_widgets', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/column/before_render',  'trx_addons_elm_add_parallax_data_to_widgets', 10, 1 );
	add_action( 'elementor/frontend/widget/before_render',  'trx_addons_elm_add_parallax_data_to_widgets', 10, 1 );
	function trx_addons_elm_add_parallax_data_to_widgets($element) {
		$settings = $element->get_settings();
		if ( ! empty($settings['parallax']) ) {
			$element->add_render_attribute( '_wrapper', 'data-parallax-params', json_encode(array(
				'x' => !empty($settings['parallax_x']) ? $settings['parallax_x']['size'] : 0,
				'y' => !empty($settings['parallax_y']) ? $settings['parallax_y']['size'] : 0,
				'scale' => !empty($settings['parallax_scale']) ? $settings['parallax_scale']['size'] : 0,
				'rotate' => !empty($settings['parallax_rotate']) ? $settings['parallax_rotate']['size'] : 0,
				'opacity' => !empty($settings['parallax_opacity']) ? $settings['parallax_opacity']['size'] : 0,
				'duration' => !empty($settings['parallax_duration']) ? $settings['parallax_duration']['size'] : 1,
				'amplitude' => !empty($settings['parallax_amplitude']) ? $settings['parallax_amplitude']['size'] : 40,
				'text' => !empty($settings['parallax_text']) ? $settings['parallax_text'] : 'block',
				'ease' => !empty($settings['parallax_ease']) ? $settings['parallax_ease'] : 'power2',
			)) );
		}
	}
}


// Replace widget's args with theme-specific args
if ( !function_exists( 'trx_addons_elm_wordpress_widget_args' ) ) {
	add_filter( 'elementor/widgets/wordpress/widget_args', 'trx_addons_elm_wordpress_widget_args', 10, 2 );
	function trx_addons_elm_wordpress_widget_args($widget_args, $widget) {
		return trx_addons_prepare_widgets_args($widget->get_name(), $widget->get_name(), $widget_args);
	}
}

// Move paddings from .elementor-element-wrap to .elementor-column-wrap
// to compatibility with old themes
if ( ! function_exists( 'trx_addons_elm_move_paddings_to_column_wrap' ) ) {
    add_action( 'elementor/element/before_section_end', 'trx_addons_elm_move_paddings_to_column_wrap', 10, 3 );
    function trx_addons_elm_move_paddings_to_column_wrap( $element, $section_id, $args ) {
        if ( is_object( $element ) ) {
            $el_name = $element->get_name();
            // Add one more classname to the selector for paddings of columns
            // to override theme-specific rules
            if ( 'column' == $el_name && 'section_advanced' == $section_id ) {
                $element->update_responsive_control( 'padding', array(
                    'selectors' => array(
                        '{{WRAPPER}} > .elementor-element-populated.elementor-column-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',    // Elm 2.9- (or DOM Optimization == Inactive)
                        '{{WRAPPER}} > .elementor-element-populated.elementor-widget-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',    // Elm 3.0+
                    )
                ) );
            }
        }
    }
}


// Demo data install
//----------------------------------------------------------------------------

// One-click import support
if ( is_admin() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . 'elementor/elementor-demo-importer.php';
}

// OCDI support
if ( is_admin() && trx_addons_exists_elementor() && trx_addons_exists_ocdi() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . 'elementor/elementor-demo-ocdi.php';
}
