<?php
/**
 * Shortcode: Content container
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

	
// Merge shortcode's specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_title_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_title_merge_styles');
	function trx_addons_sc_title_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'title/_title.scss';
		return $list;
	}
}


// trx_sc_title
//-------------------------------------------------------------
/*
[trx_sc_title id="unique_id" title="" subtitle="" description=""]
*/
if ( !function_exists( 'trx_addons_sc_title' ) ) {
	function trx_addons_sc_title($atts, $content=null){	
		$atts = trx_addons_sc_prepare_atts('trx_sc_title', $atts, array(
			// Individual params
			'type' => '',
			"title" => "",
			"subtitle" => "",
			"description" => "",
			"link" => '',
			"link_style" => 'default',
			"link_image" => '',
			"link_text" => esc_html__('Learn more', 'trx_addons'),
			"title_align" => "left",
			"title_style" => "default",
			"title_tag" => '',
			"title_color" => '',
			"title_color2" => '',
			"gradient_direction" => '',
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
			)
		);
		
		$output = '';

		if (empty($atts['type'])) $atts['type'] = $atts['title_style'];
		else $atts['title_style'] = $atts['type'];
		
		if (!empty($atts['title']) || !empty($atts['subtitle']) || !empty($atts['description'])) {

			ob_start();
			trx_addons_get_template_part(array(
											TRX_ADDONS_PLUGIN_SHORTCODES . 'title/tpl.'.trx_addons_esc($atts['type']).'.php',
											TRX_ADDONS_PLUGIN_SHORTCODES . 'title/tpl.default.php'
											),
                                            'trx_addons_args_sc_title',
                                            $atts
                                        );
			$output = ob_get_contents();
			ob_end_clean();

		}
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_title', $atts, $content);
	}
}


// Add [trx_sc_content] in the VC shortcodes list
if (!function_exists('trx_addons_sc_title_add_in_vc')) {
	function trx_addons_sc_title_add_in_vc() {
		
		add_shortcode("trx_sc_title", "trx_addons_sc_title");
		
		if (!trx_addons_exists_vc()) return;
		
		vc_lean_map("trx_sc_title", 'trx_addons_sc_title_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Title extends WPBakeryShortCode {}
	}
	add_action('init', 'trx_addons_sc_title_add_in_vc', 20);
}

// Return params
if (!function_exists('trx_addons_sc_title_add_in_vc_params')) {
	function trx_addons_sc_title_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_title",
				"name" => esc_html__("Title", 'trx_addons'),
				"description" => wp_kses_data( __("Add title, subtitle and description", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_title',
				"class" => "trx_sc_title",
				'content_element' => true,
				'is_container' => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					trx_addons_vc_add_title_param(''),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_title' );
	}
}




// Elementor Widget
//------------------------------------------------------
if (!function_exists('trx_addons_sc_title_add_in_elementor')) {
	add_action( 'elementor/widgets/widgets_registered', 'trx_addons_sc_title_add_in_elementor' );
	function trx_addons_sc_title_add_in_elementor() {
		
		if (!class_exists('TRX_Addons_Elementor_Widget')) return;	

		class TRX_Addons_Elementor_Widget_Title extends TRX_Addons_Elementor_Widget {

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_title';
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
				return __( 'Title', 'trx_addons' );
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
				return 'eicon-t-letter';
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
				return ['trx_addons-elements'];
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
					'section_sc_title',
					[
						'label' => __( 'Title', 'trx_addons' ),
					]
				);

				$this->add_title_param('', !trx_addons_elm_is_preview() ? [] : [
//					'title_align' => ['default' => 'center'],
					'title' => ['default' => __('Title of the block', 'trx_addons')],
					'subtitle' => ['default' => $this->get_default_subtitle()],
					'description' => ['default' => $this->get_default_description()],
				]);

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
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_SHORTCODES . "title/tpe.title.php",
										'trx_addons_args_sc_title',
										array('element' => $this)
									);
			}
		}
		
		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Title() );
	}
}


// Disable our widgets (shortcodes) to use in Elementor
// because we create special Elementor's widgets instead
if (!function_exists('trx_addons_sc_title_black_list')) {
	add_action( 'elementor/widgets/black_list', 'trx_addons_sc_title_black_list' );
	function trx_addons_sc_title_black_list($list) {
		$list[] = 'TRX_Addons_SOW_Widget_Title';
		return $list;
	}
}




// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Title extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_title',
				esc_html__('ThemeREX Title', 'trx_addons'),
				array(
					'classname' => 'widget_title',
					'description' => __('Display title', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			return apply_filters('trx_addons_sow_map', array_merge(
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_title', __FILE__, 'TRX_Addons_SOW_Widget_Title');
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_title_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_title_editor_assets' );
	function trx_addons_gutenberg_sc_title_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-title',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_SHORTCODES . 'title/gutenberg/title.gutenberg-editor.js' ),
				 trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_SHORTCODES . 'title/gutenberg/title.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_title_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_title_add_in_gutenberg' );
	function trx_addons_sc_title_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/title', array(
					'attributes'      => array(
						// Title attributes
						'title_style'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_tag'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_align'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color2'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'gradient_direction' => array(
							'type'    => 'string',
							'default' => '0',
						),
						'title'              => array(
							'type'    => 'string',
							'default' => __( 'Title', 'trx_addons' ),
						),
						'subtitle'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'description'        => array(
							'type'    => 'string',
							'default' => '',
						),
						// Button attributes
						'link'               => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_text'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_style'         => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_image'         => array(
							'type'    => 'number',
							'default' => 0,
						),
						'link_image_url'     => array(
							'type'    => 'string',
							'default' => '',
						),
						// ID, Class, CSS attributes
						'id'                 => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'                => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_title_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_title_render_block' ) ) {
	function trx_addons_gutenberg_sc_title_render_block( $attributes = array() ) {
		return trx_addons_sc_title( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_title_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_title_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_title_get_layouts( $array = array() ) {
		$array['sc_title'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'sc', 'title' ), 'trx_sc_title' );
		return $array;
	}
}


// Add shortcode's specific lists to the JS storage
if ( ! function_exists( 'trx_addons_sc_title_gutenberg_sc_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_sc_title_gutenberg_sc_params' );
	function trx_addons_sc_title_gutenberg_sc_params( $vars = array() ) {
		
		// Return list of the title tags
		$vars['sc_title_tags'] = trx_addons_get_list_sc_title_tags( '', true );

		return $vars;
	}
}
