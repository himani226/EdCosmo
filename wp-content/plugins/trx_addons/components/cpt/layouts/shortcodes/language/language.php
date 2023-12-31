<?php
/**
 * Shortcode: Display WPML Language Selector
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.18
 */

	
// Merge shortcode specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_layouts_language_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_layouts_language_merge_styles');
	add_filter("trx_addons_filter_merge_styles_layouts", 'trx_addons_sc_layouts_language_merge_styles');
	function trx_addons_sc_layouts_language_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/_language.scss';
		return $list;
	}
}


// Load shortcode's specific scripts if current mode is Preview in the PageBuilder
if ( !function_exists( 'trx_addons_sc_layouts_language_load_scripts' ) ) {
	add_action("trx_addons_action_pagebuilder_preview_scripts", 'trx_addons_sc_layouts_language_load_scripts', 10, 1);
	function trx_addons_sc_layouts_language_load_scripts($editor='') {
		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/superfish.js'), array('jquery'), null, true );
		// Menu support
		if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $editor!='gutenberg') {
			wp_enqueue_script( 'trx_addons-sc_layouts_menu', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu.js'), array('jquery'), null, true );
		}
	}
}

	

// trx_sc_layouts_language
//-------------------------------------------------------------
/*
[trx_sc_layouts_language id="unique_id"]
*/
if ( !function_exists( 'trx_addons_sc_layouts_language' ) ) {
	function trx_addons_sc_layouts_language($atts, $content=null){	
		$atts = trx_addons_sc_prepare_atts('trx_sc_layouts_language', $atts, array(
			// Individual params
			"type" => "default",
			"flag" => "both",
			"title_link" => "name",
			"title_menu" => "name",
			"hide_on_wide" => "0",
			"hide_on_desktop" => "0",
			"hide_on_notebook" => "0",
			"hide_on_tablet" => "0",
			"hide_on_mobile" => "0",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
			)
		);

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/superfish.js'), array('jquery'), null, true );
		// Menu support
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_script( 'trx_addons-sc_layouts_menu', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu.js'), array('jquery'), null, true );
		}

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/tpl.default.php'
										),
										'trx_addons_args_sc_layouts_language',
										$atts
									);
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_layouts_language', $atts, $content);
	}
}


// Add [trx_sc_layouts_language] in the VC shortcodes list
if (!function_exists('trx_addons_sc_layouts_language_add_in_vc')) {
	function trx_addons_sc_layouts_language_add_in_vc() {
		
		if (!trx_addons_cpt_layouts_sc_required()) return;

		add_shortcode("trx_sc_layouts_language", "trx_addons_sc_layouts_language");

		if (!trx_addons_exists_vc()) return;

		vc_lean_map("trx_sc_layouts_language", 'trx_addons_sc_layouts_language_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Layouts_Language extends WPBakeryShortCode {}
	}

	add_action('init', 'trx_addons_sc_layouts_language_add_in_vc', 15);
}

// Return params
if (!function_exists('trx_addons_sc_layouts_language_add_in_vc_params')) {
	function trx_addons_sc_layouts_language_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_layouts_language",
				"name" => esc_html__("Layouts: Language", 'trx_addons'),
				"description" => wp_kses_data( __("Insert WPML Language Selector", 'trx_addons') ),
				"category" => esc_html__('Layouts', 'trx_addons'),
				"icon" => 'icon_trx_sc_layouts_language',
				"class" => "trx_sc_layouts_language",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
							"std" => "default",
							"value" => array_flip(apply_filters('trx_addons_sc_type', array(
								'default' => esc_html__('Default', 'trx_addons'),
							), 'trx_sc_layouts_language')),
							"type" => "dropdown"
						),
						array(
							"param_name" => "flag",
							"heading" => esc_html__("Show flag", 'trx_addons'),
							"description" => wp_kses_data( __("Where do you want to show flag?", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
					        'save_always' => true,
							"std" => "both",
							"value" => array_flip(trx_addons_get_list_sc_layouts_language_positions()),
							"type" => "dropdown"
						),
						array(
							"param_name" => "title_link",
							"heading" => esc_html__("Show link's title", 'trx_addons'),
							"description" => wp_kses_data( __("Select link's title type", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => "name",
							"value" => array_flip(trx_addons_get_list_sc_layouts_language_parts()),
							"type" => "dropdown"
						),
						array(
							"param_name" => "title_menu",
							"heading" => esc_html__("Show menu item's title", 'trx_addons'),
							"description" => wp_kses_data( __("Select menu item's title type", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => "name",
							"value" => array_flip(trx_addons_get_list_sc_layouts_language_parts()),
							"type" => "dropdown"
						),
					),
					trx_addons_vc_add_hide_param(),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_layouts_language');
	}
}




// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_layouts_language_add_in_elementor')) {
	add_action( 'elementor/widgets/widgets_registered', 'trx_addons_sc_layouts_language_add_in_elementor' );
	function trx_addons_sc_layouts_language_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Layouts_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Layouts_Language extends TRX_Addons_Elementor_Layouts_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_layouts_language';
			}

			/**
			 * Retrieve widget title.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget title.
			 */
			public function get_title() {
				return __( 'Layouts: Language', 'trx_addons' );
			}

			/**
			 * Retrieve widget icon.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget icon.
			 */
			public function get_icon() {
				return 'eicon-typography';
			}

			/**
			 * Retrieve the list of categories the widget belongs to.
			 *
			 * Used to determine where to display the widget in the editor.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return array Widget categories.
			 */
			public function get_categories() {
				return ['trx_addons-layouts'];
			}

			/**
			 * Register widget controls.
			 *
			 * Adds different input fields to allow the user to change and customize the widget settings.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function register_controls() {
				$this->start_controls_section(
					'section_sc_layouts_Language',
					[
						'label' => __( 'Layouts: Language', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', array(
								'default' => esc_html__('Default', 'trx_addons'),
							), 'trx_sc_layouts_language'),
						'default' => 'default'
					]
				);

				$this->add_control(
					'flag', 
					[
						'label' => __("Show flag", 'trx_addons'),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_layouts_language_positions(),
						'default' => 'both'
					]
				);

				$this->add_control(
					'title_link', 
					[
						'label' => __("Show link's title", 'trx_addons'),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_layouts_language_parts(),
						'default' => 'name'
					]
				);

				$this->add_control(
					'title_menu', 
					[
						'label' => __("Show menu item's title", 'trx_addons'),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => trx_addons_get_list_sc_layouts_language_parts(),
						'default' => 'name'
					]
				);

				$this->end_controls_section();
			}

			/**
			 * Render widget's template for the editor.
			 *
			 * Written as a Backbone JavaScript template and used to generate the live preview.
			 *
			 * @since 1.6.41
			 * @access protected
			 */
			protected function content_template() {
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . "language/tpe.language.php",
										'trx_addons_args_sc_layouts_language',
										array('element' => $this)
									);
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Layouts_Language() );
	}
}

// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_layouts_language_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_layouts_language_black_list' );
	function trx_addons_sc_layouts_language_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Layouts_Language';
		return $list;
	}
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')
	//&& function_exists('trx_addons_exists_wpml') && trx_addons_exists_wpml()
	) {
		
	class TRX_Addons_SOW_Widget_Layouts_Language extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_language',
				esc_html__('ThemeREX Layouts: Language', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_language',
					'description' => __('Insert WPML Language Selector', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}

		// Return array with all widget's fields
		function get_widget_form() {
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's type", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', array(
							'default' => esc_html__('Default', 'trx_addons')
						), $this->get_sc_name()),
						'type' => 'select'
					),
					"flag" => array(
						"label" => esc_html__("Show flag", 'trx_addons'),
						"description" => wp_kses_data( __("Where do you want to show flag?", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_language_positions(),
						"default" => "both",
						"type" => "select"
					),
					"title_link" => array(
						"label" => esc_html__("Show link's title", 'trx_addons'),
						"description" => wp_kses_data( __("Select link's title type", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_language_parts(),
						"default" => "name",
						"type" => "select"
					),
					"title_menu" => array(
						"label" => esc_html__("Show menu item's title", 'trx_addons'),
						"description" => wp_kses_data( __("Select menu item's title type", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_language_parts(),
						"default" => "name",
						"type" => "select"
					)
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_language', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Language');
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_language_editor_assets' );
	function trx_addons_gutenberg_sc_language_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( trx_addons_exists_wpml() && function_exists( 'icl_get_languages' ) ) {
				wp_enqueue_script(
					'trx-addons-gutenberg-editor-block-language',
					trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/gutenberg/language.gutenberg-editor.js' ),
					trx_addons_block_editor_dependencis(),
					filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/gutenberg/language.gutenberg-editor.js' ) ),
					true
				);
			}
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_language_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_language_add_in_gutenberg' );
	function trx_addons_sc_language_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( trx_addons_exists_wpml() && function_exists( 'icl_get_languages' ) ) {
				register_block_type(
					'trx-addons/layouts-language', array(
						'attributes'      => array(
							'type'             => array(
								'type'    => 'string',
								'default' => 'default',
							),
							'flag'             => array(
								'type'    => 'title',
								'default' => '',
							),
							'title_link'       => array(
								'type'    => 'string',
								'default' => 'name',
							),
							'title_menu'       => array(
								'type'    => 'string',
								'default' => 'name',
							),
							// Hide on devices attributes
							'hide_on_wide'     => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_desktop'  => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_notebook' => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_tablet'   => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_mobile'   => array(
								'type'    => 'boolean',
								'default' => false,
							),
							// ID, Class, CSS attributes
							'id'               => array(
								'type'    => 'string',
								'default' => '',
							),
							'class'            => array(
								'type'    => 'string',
								'default' => '',
							),
							'css'              => array(
								'type'    => 'string',
								'default' => '',
							),
						),
						'render_callback' => 'trx_addons_gutenberg_sc_language_render_block',
					)
				);
			}
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_render_block' ) ) {
	function trx_addons_gutenberg_sc_language_render_block( $attributes = array() ) {
		$output = trx_addons_sc_layouts_language( $attributes );
		if ( ! empty( $output ) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_language_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_language_get_layouts( $array = array() ) {
		$array['sc_language'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_layouts_language'
		);
		return $array;
	}
}

// Add shortcode's specific vars to the JS storage
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_gutenberg_sc_language_params' );
	function trx_addons_gutenberg_sc_language_params( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Language positions
			$vars['sc_layouts_language_positions'] = trx_addons_get_list_sc_layouts_language_positions();

			// Language parts
			$vars['sc_layouts_language_parts'] = trx_addons_get_list_sc_layouts_language_parts();

			return $vars;
		}
	}
}