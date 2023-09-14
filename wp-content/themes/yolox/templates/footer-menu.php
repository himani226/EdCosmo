<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.10
 */

// Footer menu
$yolox_menu_footer = yolox_get_nav_menu(
	array(
		'location' => 'menu_footer',
		'class'    => 'sc_layouts_menu sc_layouts_menu_default',
	)
);
if ( ! empty( $yolox_menu_footer ) ) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php yolox_show_layout( $yolox_menu_footer ); ?>
		</div>
	</div>
	<?php
}
