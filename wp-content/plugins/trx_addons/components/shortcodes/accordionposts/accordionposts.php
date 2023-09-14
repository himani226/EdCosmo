<?php
/**
 * Shortcode: Accordion posts
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Merge shortcode's specific styles to the single stylesheet
if ( !function_exists( 'trx_addons_sc_accordionposts_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_accordionposts_merge_styles');
	function trx_addons_sc_accordionposts_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/_accordionposts.scss';
		return $list;
	}
}

// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_sc_accordionposts_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_sc_accordionposts_merge_styles_responsive');
	function trx_addons_sc_accordionposts_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/_accordionposts.responsive.scss';
		return $list;
	}
}


// Merge shortcode's specific scripts into single file
if ( !function_exists( 'trx_addons_sc_accordionposts_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_sc_accordionposts_merge_scripts');
	function trx_addons_sc_accordionposts_merge_scripts($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/accordionposts.js';
		return $list;
	}
}

// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_sc_accordionposts_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_sc_accordionposts_load_scripts_front');
	function trx_addons_sc_accordionposts_load_scripts_front() {
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))){
			wp_enqueue_script( 'trx_addons-sc_accordionposts', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/accordionposts.js'), array('jquery'), null, true );
		}
	}
}


// trx_sc_accordionposts
//-------------------------------------------------------------
/*
[trx_sc_accordionposts id="unique_id" values="encoded_json_data"]
*/
if ( !function_exists( 'trx_addons_sc_accordionposts' ) ) {
	function trx_addons_sc_accordionposts($atts, $content=null) {
		$atts = trx_addons_sc_prepare_atts('trx_sc_accordionposts', $atts, array(
				// Individual params
				"type" => "default",
				"accordions" => "",
				// Common params
				"id" => "",
				"class" => "",
				"css" => ""
			)
		);
		if (function_exists('vc_param_group_parse_atts') && !is_array($atts['accordions']))
			$atts['accordions'] = (array) vc_param_group_parse_atts( $atts['accordions'] );
		$output = '';
		if (is_array($atts['accordions']) && count($atts['accordions']) > 0) {
			$output = trx_addons_get_template_part_as_string(array(
				TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/tpl.'.trx_addons_esc($atts['type']).'.php',
				TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/tpl.default.php'
			),
				'trx_addons_args_sc_accordionposts',
				$atts
			);
		}
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_accordionposts', $atts, $content);
	}
}


// Elementor Widget
//------------------------------------------------------

if (!function_exists('trx_addons_sc_accordionposts_add_in_elementor')) {
	add_action( 'elementor/widgets/widgets_registered', 'trx_addons_sc_accordionposts_add_in_elementor' );
	function trx_addons_sc_accordionposts_add_in_elementor() {

		if (!class_exists('TRX_Addons_Elementor_Widget')) return;

		class TRX_Addons_Elementor_Widget_Accordionposts extends TRX_Addons_Elementor_Widget {

			/**
			 * Widget base constructor.
			 *
			 * Initializing the widget base class.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @param array			$data Widget data. Default is an empty array.
			 * @param array|null	$args Optional. Widget default arguments. Default is null.
			 */
			public function __construct( $data = [], $args = null ) {
				parent::__construct( $data, $args );
				$this->add_plain_params([
					'height' => 'size+unit'
				]);
			}

			/**
			 * Retrieve widget name.
			 *
			 * @since 1.6.41
			 * @access public
			 *
			 * @return string Widget name.
			 */
			public function get_name() {
				return 'trx_sc_accordionposts';
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
				return __( 'Accordion of posts', 'trx_addons' );
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
				return 'eicon-call-to-action';
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
				// If open params in Elementor Editor
				$params = $this->get_sc_params();

				// Prepare list of pages
				$posts = trx_addons_get_list_posts(false, array(
						'post_type' => 'page',
						'not_selected' => false
					)
				);
				$default = trx_addons_array_get_first($posts);
				$post = !empty($params['post_id']) ? $params['post_id'] : $default;

				// Prepare list of layouts
				$layouts = trx_addons_get_list_posts(false, array(
						'post_type' => TRX_ADDONS_CPT_LAYOUTS_PT,
						'meta_key' => 'trx_addons_layout_type',
						'meta_value' => 'custom',
						'not_selected' => false
					)
				);
				$default = trx_addons_array_get_first($layouts);
				$layout = !empty($params['layout_id']) ? $params['layout_id'] : $default;

				unset($posts[ get_the_ID() ]); // To avoid recursion, we prevent adding $current page in accordion

				$this->start_controls_section(
					'section_sc_accordionposts',
					[
						'label' => __( 'Accordion posts', 'trx_addons' ),
					]
				);

				$this->add_control(
					'type',
					[
						'label' => __( 'Layout', 'trx_addons' ),
						'label_block' => false,
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'accordionposts'), 'trx_sc_accordionposts'),
						'default' => 'default'
					]
				);

				$this->add_control(
					'accordions',
					[
						'label' => '',
						'type' => \Elementor\Controls_Manager::REPEATER,
						'default' => apply_filters('trx_addons_sc_param_group_value', [
							[
								'title' => esc_html__( 'First accordions post', 'trx_addons' ),
								'subtitle' => esc_html__( 'Network', 'trx_addons' ),
								'post_id' => '0',
								'advanced_rolled_content' => 0,
								'icon' => 'icon-users-group',
								'color' => '#ffffff',
								'bg_color' => '#aa0000',
							],
							[
								'title' => esc_html__( 'Second accordion post', 'trx_addons' ),
								'subtitle' => esc_html__( 'Study', 'trx_addons' ),
								'post_id' => '0',
								'advanced_rolled_content' => 0,
								'icon' => 'icon-graduation-light',
								'color' => '#ffffff',
								'bg_color' => '#00aa00',
							],
							[
								'title' => esc_html__( 'Third accordion post', 'trx_addons' ),
								'subtitle' => esc_html__( 'Time', 'trx_addons' ),
								'post_id' => '0',
								'advanced_rolled_content' => 0,
								'icon' => 'icon-clock-empty',
								'color' => '#ffffff',
								'bg_color' => '#0000aa',
							]
						], 'trx_sc_accordionposts'),
						'fields' => apply_filters('trx_addons_sc_param_group_params', array_merge(
							[
								[
									'name' => 'title',
									'label' => __( 'Title', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => __( "Item's title", 'trx_addons' ),
									'default' => ''
								],
								[
									'name' => 'subtitle',
									'label' => __( 'Subtitle', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::TEXT,
									'placeholder' => $this->get_default_subtitle(),
									'default' =>  __( 'Description', 'trx_addons' )
								],
								[
									'name' => 'icon',
									'type' => 'trx_icons',
									'label' => __( 'Icon', 'trx_addons' ),
									'label_block' => false,
									'default' => '',
									'options' => trx_addons_get_list_icons( trx_addons_get_setting('icons_type')),
									'style' =>  trx_addons_get_setting('icons_type')
								],
								[
									'name' => 'color',
									'label' => __( 'Icon Color', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::COLOR,
									'default' => '',
									'description' => wp_kses_post( __("Selected color will also be applied to the subtitle. ", 'trx_addons')),
								],
								[
									'name' => 'bg_color',
									'label' => __( 'Icon Background Color', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::COLOR,
									'default' => '',
									'description' => wp_kses_post( __("Selected color will also be applied to the subtitle. ", 'trx_addons')),
								],

								[
									'name' => 'content_source',
									'label' => __( 'Select content source', 'trx_addons' ),
									'type' => \Elementor\Controls_Manager::SELECT,
									'options' =>  [
										'text' => __( 'Use content', 'trx_addons' ),
										'page' => __( 'Pages', 'trx_addons' ),
										'layout' => __( 'Layouts', 'trx_addons' ),
									],
									'default' => 'text'
								],

								[
									'name' => 'post_id',
									'label' => __( 'Page ID', 'trx_addons' ),
									'description' => wp_kses_post( __("'Use Content' option allows you to create custom content for the selected content area, otherwise you will be prompted to choose an existing page to import content from it. ", 'trx_addons')
										. '<br>'
										. sprintf('<a href="%1$s" class="trx_addons_post_editor" target="_blank">%2$s</a>',
											admin_url( sprintf( "post.php?post=%d&amp;action=elementor", $post ) ),
											__("Open selected layout in a new tab to edit", 'trx_addons')
										)
									),
									'type' => \Elementor\Controls_Manager::SELECT,
									'options' => $posts,
									'default' => $post,
									'condition' => ['content_source' => 'page']
								],

								[
									'name' => 'layout_id',
									'label' => __( 'Layout ID', 'trx_addons' ),
									'description' => wp_kses_post( __("'Use Content' option allows you to create custom content for the selected content area, otherwise you will be prompted to choose an existing page to import content from it. ", 'trx_addons')
										. '<br>'
										. sprintf('<a href="%1$s" class="trx_addons_post_editor" target="_blank">%2$s</a>',
											admin_url( sprintf( "post.php?post=%d&amp;action=elementor", $layout ) ),
											__("Open selected layout in a new tab to edit", 'trx_addons')
										)
									),
									'type' => \Elementor\Controls_Manager::SELECT,
									'options' => $layouts,
									'default' => $layout,
									'condition' => ['content_source' => 'layout']
								],
								[
									'name' => 'inner_content',
									'label' => __( 'Inner content', 'trx_addons' ),
									'default' => '',
									'placeholder' =>  '',
									'type' => \Elementor\Controls_Manager::WYSIWYG,
									'show_label' => true,
									'condition' => ['content_source' => 'text']
								],
								[
									"name" => "advanced_rolled_content",
									'label' => __( 'Advanced Header Options', 'trx_addons' ),
									'label_block' => false,
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label_off' => __( 'Off', 'trx_addons' ),
									'label_on' => __( 'On', 'trx_addons' ),
									'default' => '',
									'return_value' => '1'
								],
								[
									'name' => 'rolled_content',
									'label' => '',
									'default' => '',
									'placeholder' =>  $this->get_default_subtitle(),
									'type' => \Elementor\Controls_Manager::WYSIWYG,
									'show_label' => true,
									'condition' => ['advanced_rolled_content' => '1']
								],
							]),
							'trx_sc_accordionposts'),
						'title_field' => '{{{ title }}}',
					]
				);

				$this->end_controls_section();
			}

		}

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new TRX_Addons_Elementor_Widget_Accordionposts() );
	}
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_accordionposts_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_accordionposts_editor_assets' );
	function trx_addons_gutenberg_sc_accordionposts_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-accordionposts',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/gutenberg/accordionposts.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/gutenberg/accordionposts.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_accordionposts_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_accordionposts_add_in_gutenberg' );
	function trx_addons_sc_accordionposts_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/accordionposts', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'accordions'		=> array(
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
						// Rerender
						'reload'             => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_accordionposts_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_accordionposts_render_block' ) ) {
	function trx_addons_gutenberg_sc_accordionposts_render_block( $attributes = array() ) {
		if ( ! empty( $attributes['accordions'] ) ) {
			$attributes['accordions'] = json_decode( $attributes['accordions'], true );
			return trx_addons_sc_accordionposts( $attributes );
		} else {
			return esc_html__( 'Add at least one item', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_accordionposts_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_accordionposts_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_accordionposts_get_layouts( $array = array() ) {
		$array['sc_accordionposts'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'sc', 'accordionposts' ), 'trx_sc_accordionposts' );
		return $array;
	}
}
