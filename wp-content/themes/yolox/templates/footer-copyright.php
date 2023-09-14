<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
if ( ! yolox_is_inherit( yolox_get_theme_option( 'copyright_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( yolox_get_theme_option( 'copyright_scheme' ) );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$yolox_copyright = yolox_get_theme_option( 'copyright' );
			if ( ! empty( $yolox_copyright ) ) {
				$yolox_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $yolox_copyright );
				$yolox_copyright = yolox_prepare_macros( $yolox_copyright );
				// Display copyright
				echo wp_kses( nl2br( $yolox_copyright ), 'yolox_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
