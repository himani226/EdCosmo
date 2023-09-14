<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.10
 */

// Logo
if ( yolox_is_on( yolox_get_theme_option( 'logo_in_footer' ) ) ) {
	$yolox_logo_image = yolox_get_logo_image( 'footer' );
	$yolox_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $yolox_logo_image ) || ! empty( $yolox_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $yolox_logo_image ) ) {
					$yolox_attr = yolox_getimagesize( $yolox_logo_image );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $yolox_logo_image ) . '"'
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'yolox' ) . '"'
								. ( ! empty( $yolox_attr[3] ) ? ' ' . wp_kses_data( $yolox_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $yolox_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $yolox_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
