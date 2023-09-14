<?php
/* Instagram Feed support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'yolox_instagram_feed_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'yolox_instagram_feed_theme_setup9', 9 );
	function yolox_instagram_feed_theme_setup9() {

		add_filter( 'yolox_filter_merge_styles_responsive', 'yolox_instagram_merge_styles_responsive' );

		if ( is_admin() ) {
			add_filter( 'yolox_filter_tgmpa_required_plugins', 'yolox_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'yolox_instagram_feed_tgmpa_required_plugins' ) ) {
		function yolox_instagram_feed_tgmpa_required_plugins( $list = array() ) {
		if ( yolox_storage_isset( 'required_plugins', 'instagram-feed' ) ) {
			$list[] = array(
				'name'     => yolox_storage_get_array( 'required_plugins', 'instagram-feed' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if Instagram Feed installed and activated
if ( ! function_exists( 'yolox_exists_instagram_feed' ) ) {
	function yolox_exists_instagram_feed() {
		return defined( 'SBIVER' );
	}
}


// Merge responsive styles
if ( ! function_exists( 'yolox_instagram_merge_styles_responsive' ) ) {
		function yolox_instagram_merge_styles_responsive( $list ) {
		if ( yolox_exists_instagram_feed() ) {
			$list[] = 'plugins/instagram/_instagram-responsive.scss';
		}
		return $list;
	}
}

