<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.10
 */


// Socials
if ( yolox_is_on( yolox_get_theme_option( 'socials_in_footer' ) ) ) {
	$yolox_output = yolox_get_socials_links();
	if ( '' != $yolox_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php yolox_show_layout( $yolox_output ); ?>
			</div>
		</div>
		<?php
	}
}
