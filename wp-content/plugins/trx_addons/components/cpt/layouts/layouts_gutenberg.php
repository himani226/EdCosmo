<?php
/**
 * ThemeREX Addons Layouts: Gutenberg utilities
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.51
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Add shortcode's specific lists to the JS storage
if ( ! function_exists( 'trx_addons_layouts_gutenberg_sc_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_layouts_gutenberg_sc_params' );
	function trx_addons_layouts_gutenberg_sc_params( $vars = array() ) {

		// Return list of allowed layouts
		$vars['sc_layouts'] = apply_filters( 'trx_addons_filter_gutenberg_sc_layouts', array() );

		// Prepare list of layouts
		$vars['list_layouts'] = trx_addons_get_list_posts(
			false, array(
				'post_type'    => TRX_ADDONS_CPT_LAYOUTS_PT,
				'meta_key'     => 'trx_addons_layout_type',
				'meta_value'   => 'custom',
				'not_selected' => false,
			)
		);

		return $vars;
	}
}
