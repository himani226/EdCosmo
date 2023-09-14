<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.06
 */

$yolox_header_css   = '';
$yolox_header_image = get_header_image();
$yolox_header_video = yolox_get_header_video();
if ( ! empty( $yolox_header_image ) && yolox_trx_addons_featured_image_override( is_singular() || yolox_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$yolox_header_image = yolox_get_current_mode_image( $yolox_header_image );
}

$yolox_header_id = yolox_get_custom_header_id();
$yolox_header_meta = get_post_meta( $yolox_header_id, 'trx_addons_options', true );
if ( ! empty( $yolox_header_meta['margin'] ) ) {
	yolox_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( yolox_prepare_css_value( $yolox_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $yolox_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $yolox_header_id ) ) ); ?>
				<?php
				echo ! empty( $yolox_header_image ) || ! empty( $yolox_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
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

	// Custom header's layout
	do_action( 'yolox_action_show_layout', $yolox_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
