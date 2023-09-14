<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

// Header sidebar
$yolox_header_name    = yolox_get_theme_option( 'header_widgets' );
$yolox_header_present = ! yolox_is_off( $yolox_header_name ) && is_active_sidebar( $yolox_header_name );
if ( $yolox_header_present ) {
	yolox_storage_set( 'current_sidebar', 'header' );
	$yolox_header_wide = yolox_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $yolox_header_name ) ) {
		dynamic_sidebar( $yolox_header_name );
	}
	$yolox_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $yolox_widgets_output ) ) {
		$yolox_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $yolox_widgets_output );
		$yolox_need_columns   = strpos( $yolox_widgets_output, 'columns_wrap' ) === false;
		if ( $yolox_need_columns ) {
			$yolox_columns = max( 0, (int) yolox_get_theme_option( 'header_columns' ) );
			if ( 0 == $yolox_columns ) {
				$yolox_columns = min( 6, max( 1, substr_count( $yolox_widgets_output, '<aside ' ) ) );
			}
			if ( $yolox_columns > 1 ) {
				$yolox_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $yolox_columns ) . ' widget', $yolox_widgets_output );
			} else {
				$yolox_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $yolox_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $yolox_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $yolox_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'yolox_action_before_sidebar' );
				yolox_show_layout( $yolox_widgets_output );
				do_action( 'yolox_action_after_sidebar' );
				if ( $yolox_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $yolox_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
