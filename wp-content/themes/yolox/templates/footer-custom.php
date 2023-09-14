<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.10
 */

$yolox_footer_id = yolox_get_custom_footer_id();
$yolox_footer_meta = get_post_meta( $yolox_footer_id, 'trx_addons_options', true );
if ( ! empty( $yolox_footer_meta['margin'] ) ) {
	yolox_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( yolox_prepare_css_value( $yolox_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $yolox_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $yolox_footer_id ) ) ); ?>
						<?php
						if ( ! yolox_is_inherit( yolox_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( yolox_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'yolox_action_show_layout', $yolox_footer_id );
	?>
</footer><!-- /.footer_wrap -->
