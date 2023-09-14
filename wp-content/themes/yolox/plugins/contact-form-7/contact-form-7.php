<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'yolox_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'yolox_cf7_theme_setup9', 9 );
	function yolox_cf7_theme_setup9() {

		add_filter( 'yolox_filter_merge_scripts', 'yolox_cf7_merge_scripts' );
		add_filter( 'yolox_filter_merge_styles', 'yolox_cf7_merge_styles' );

		if ( yolox_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'yolox_cf7_frontend_scripts', 1100 );
		}

		if ( is_admin() ) {
			add_filter( 'yolox_filter_tgmpa_required_plugins', 'yolox_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'yolox_cf7_tgmpa_required_plugins' ) ) {
		function yolox_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( yolox_storage_isset( 'required_plugins', 'contact-form-7' ) ) {
			// CF7 plugin
			$list[] = array(
				'name'     => yolox_storage_get_array( 'required_plugins', 'contact-form-7' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);

		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'yolox_exists_cf7' ) ) {
	function yolox_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'yolox_cf7_frontend_scripts' ) ) {
		function yolox_cf7_frontend_scripts() {
		if ( yolox_exists_cf7() ) {
			if ( yolox_is_on( yolox_get_theme_option( 'debug_mode' ) ) ) {
				$yolox_url = yolox_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
				if ( '' != $yolox_url ) {
					wp_enqueue_script( 'yolox-cf7', $yolox_url, array( 'jquery' ), null, true );
				}
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'yolox_cf7_merge_scripts' ) ) {
		function yolox_cf7_merge_scripts( $list ) {
		if ( yolox_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'yolox_cf7_merge_styles' ) ) {
		function yolox_cf7_merge_styles( $list ) {
		if ( yolox_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}

