<?php
/**
 * Skins support: Main skin file for the skin 'Default'
 *
 * Setup skin-dependent fonts and colors, load scripts and styles,
 * and other operations that affect the appearance and behavior of the theme
 * when the skin is activated
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.46
 */


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'yolox_skin_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'yolox_skin_theme_setup3', 3 );
	function yolox_skin_theme_setup3() {
		// ToDo: Add / Modify theme options, required plugins, etc.
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'yolox_skin_tgmpa_required_plugins' ) ) {
	add_filter( 'yolox_filter_tgmpa_required_plugins', 'yolox_skin_tgmpa_required_plugins' );
	function yolox_skin_tgmpa_required_plugins( $list = array() ) {
		// ToDo: Check if plugin is in the 'required_plugins' and add his parameters to the TGMPA-list
		//       Replace 'skin-specific-plugin-slug' to the real slug of the plugin
		if ( yolox_storage_isset( 'required_plugins', 'skin-specific-plugin-slug' ) ) {
			$list[] = array(
				'name'     => yolox_storage_get_array( 'required_plugins', 'skin-specific-plugin-slug' ),
				'slug'     => 'skin-specific-plugin-slug',
				'required' => false,
			);
		}
		return $list;
	}
}

// Enqueue skin-specific styles and scripts
// Priority 1150 - after plugins-specific (1100), but before child theme (1200)
if ( ! function_exists( 'yolox_skin_frontend_scripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'yolox_skin_frontend_scripts', 1150 );
	function yolox_skin_frontend_scripts() {
		$yolox_url = yolox_get_file_url( YOLOX_SKIN_DIR . 'skin.css' );
		if ( '' != $yolox_url ) {
			wp_enqueue_style( 'yolox-skin-' . esc_attr( YOLOX_SKIN_NAME ), $yolox_url, array(), null );
		}
	}
}

// Enqueue skin-specific responsive styles
// Priority 2050 - after theme responsive 2000
if ( ! function_exists( 'yolox_skin_styles_responsive' ) ) {
	add_action( 'wp_enqueue_scripts', 'yolox_skin_styles_responsive', 2050 );
	function yolox_skin_styles_responsive() {
		$yolox_url = yolox_get_file_url( YOLOX_SKIN_DIR . 'skin-responsive.css' );
		if ( '' != $yolox_url ) {
			wp_enqueue_style( 'yolox-skin-' . esc_attr( YOLOX_SKIN_NAME ) . '-responsive', $yolox_url, array(), null );
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'yolox_skin_merge_scripts' ) ) {
	add_filter( 'yolox_filter_merge_scripts', 'yolox_skin_merge_scripts' );
	function yolox_skin_merge_scripts( $list ) {
		if ( yolox_get_file_dir( YOLOX_SKIN_DIR . 'skin.js' ) != '' ) {
			$list[] = YOLOX_SKIN_DIR . 'skin.js';
		}
		return $list;
	}
}


// Add slin-specific colors and fonts to the custom CSS
require_once YOLOX_THEME_DIR . YOLOX_SKIN_DIR . 'skin-styles.php';

