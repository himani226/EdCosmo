<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_header_css   = '';
$yolox_header_image = get_header_image();
$yolox_header_video = yolox_get_header_video();
if ( ! empty( $yolox_header_image ) && yolox_trx_addons_featured_image_override( is_singular() || yolox_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$yolox_header_image = yolox_get_current_mode_image( $yolox_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $yolox_header_image ) || ! empty( $yolox_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $yolox_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $yolox_header_image ) {
		echo ' ' . esc_attr( yolox_add_inline_css_class( 'background-image: url(' . esc_url( $yolox_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( yolox_is_on( yolox_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight yolox-full-height';
	}
	if ( ! yolox_is_inherit( yolox_get_theme_option( 'header_scheme' ) ) ) {
		echo ' scheme_' . esc_attr( yolox_get_theme_option( 'header_scheme' ) );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $yolox_header_video ) ) {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	if ( yolox_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( yolox_is_on( yolox_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-title' ) );

	// Header widgets area
	get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-widgets' ) );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-single' ) );

	?>
</header>
