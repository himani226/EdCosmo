<?php
/**
 * Shortcode: Container for other shortcodes
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.28
 */


// trx_sc_layouts_container
//-------------------------------------------------------------
/*
[trx_sc_layouts_container id="unique_id"]
*/
if ( !function_exists( 'trx_addons_sc_layouts_container' ) ) {
	function trx_addons_sc_layouts_container($atts, $content=null){	
		$atts = trx_addons_sc_prepare_atts('trx_sc_layouts_container', $atts, array(
			// Individual params
			"type" => "default",
			"align" => '',
			"hide_on_wide" => "0",
			"hide_on_desktop" => "0",
			"hide_on_notebook" => "0",
			"hide_on_tablet" => "0",
			"hide_on_mobile" => "0",
			"hide_on_frontpage" => "0",
			"hide_on_singular" => "0",
			"hide_on_other" => "0",
			// Common params
			"id" => "",
			"class" => "",
			"css" => ""
			)
		);

		$atts['content'] = do_shortcode($content);

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'container/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'container/tpl.default.php'
										),
										'trx_addons_args_sc_layouts_container',
										$atts
									);
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_layouts_container', $atts, $content);
	}
}


// Add [trx_sc_layouts_container] in the VC shortcodes list
if (!function_exists('trx_addons_sc_layouts_container_add_in_vc')) {
	function trx_addons_sc_layouts_container_add_in_vc() {
		
		if (!trx_addons_cpt_layouts_sc_required()) return;

		add_shortcode("trx_sc_layouts_container", "trx_addons_sc_layouts_container");

		if (!trx_addons_exists_vc()) return;

		vc_lean_map("trx_sc_layouts_container", 'trx_addons_sc_layouts_container_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Layouts_Container extends WPBakeryShortCodesContainer {}

	}
	add_action('init', 'trx_addons_sc_layouts_container_add_in_vc', 15);
}

// Return params
if (!function_exists('trx_addons_sc_layouts_container_add_in_vc_params')) {
	function trx_addons_sc_layouts_container_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_layouts_container",
				"name" => esc_html__("Layouts: Container", 'trx_addons'),
				"description" => wp_kses_data( __("Container for other shortcodes", 'trx_addons') ),
				"category" => esc_html__('Layouts', 'trx_addons'),
				"icon" => 'icon_trx_sc_layouts_container',
				"class" => "trx_sc_layouts_container",
				"content_element" => true,
				'is_container' => true,
				'as_child' => array('except' => 'trx_sc_layouts_container'),
				"js_view" => 'VcTrxAddonsContainerView',	//'VcColumnView',
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
							), 'trx_sc_layouts_container')),
							"type" => "dropdown"
						),
						array(
							"param_name" => "align",
							"heading" => esc_html__("Content alignment", 'trx_addons'),
							"description" => wp_kses_data( __("Select alignment of the inner content in this block", 'trx_addons') ),
							"admin_label" => true,
							"value" => array(
								esc_html__('Inherit', 'trx_addons') => 'inherit',
								esc_html__('Left', 'trx_addons') => 'left',
								esc_html__('Center', 'trx_addons') => 'center',
								esc_html__('Right', 'trx_addons') => 'right'
							),
							"std" => "inherit",
							"type" => "dropdown"
						)
					),
					trx_addons_vc_add_hide_param(false, true),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_layouts_container');
	}
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_container_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_container_editor_assets' );
	function trx_addons_gutenberg_sc_container_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-container',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'container/gutenberg/container.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'container/gutenberg/container.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_container_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_container_add_in_gutenberg' );
	function trx_addons_sc_container_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/layouts-container', array(
					'attributes'      => array(
						'type'              => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'align'             => array(
							'type'    => 'title',
							'default' => '',
						),
						'content'       => array(
							'type'    => 'string',
							'default' => ''
						),
						// Hide on devices attributes
						'hide_on_wide'      => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_desktop'      => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_notebook'  => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_tablet'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_mobile'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_frontpage' => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_singular'  => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'hide_on_other'     => array(
							'type'    => 'boolean',
							'default' => false,
						),
						// ID, Class, CSS attributes
						'id'                => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'             => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'               => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_container_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_container_render_block' ) ) {
	function trx_addons_gutenberg_sc_container_render_block( $attributes = array() ) {
		$blocks_output = '';
		$arr =  json_decode( $attributes['content'], true ); 
		if(!empty($arr) && is_array($arr)) {
			foreach ( $arr as $block_name => $block_value ) {
				if ( 'trx-addons' === substr( $block_name, 0, 10 ) ) {
					$block_name = str_replace( array( 'trx-addons/layouts-', 'trx-addons/'), '', $block_name );
					// Get block render
					$blocks_output .= call_user_func_array( 'trx_addons_gutenberg_sc_' . $block_name . '_render_block', array( &$block_value ) );
				}
			}
		}
		$output = trx_addons_sc_layouts_container( $attributes, $blocks_output );
		if ( !empty($output) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_container_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_container_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_container_get_layouts( $array = array() ) {
		$array['sc_container'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_layouts_container'
		);
		return $array;
	}
}