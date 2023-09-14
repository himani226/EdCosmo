<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

if ( yolox_sidebar_present() ) {
	ob_start();
	$yolox_sidebar_name = yolox_get_theme_option( 'sidebar_widgets' );
	yolox_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $yolox_sidebar_name ) ) {
		dynamic_sidebar( $yolox_sidebar_name );
	}
	$yolox_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $yolox_out ) ) {
		$yolox_sidebar_position = yolox_get_theme_option( 'sidebar_position' );
		?>
		<div class="sidebar widget_area
			<?php
			echo esc_attr( $yolox_sidebar_position );
			if ( ! yolox_is_inherit( yolox_get_theme_option( 'sidebar_scheme' ) ) ) {
				echo ' scheme_' . esc_attr( yolox_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
		<?php
			// Single posts banner before sidebar
			yolox_show_post_banner( 'sidebar' ); ?>
			<div class="sidebar_inner">
				<?php
				do_action( 'yolox_action_before_sidebar' );
				yolox_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $yolox_out ) );
				do_action( 'yolox_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
