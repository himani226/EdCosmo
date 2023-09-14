<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.10
 */

// Footer sidebar
$yolox_footer_name    = yolox_get_theme_option( 'footer_widgets' );
$yolox_footer_present = ! yolox_is_off( $yolox_footer_name ) && is_active_sidebar( $yolox_footer_name );
if ( $yolox_footer_present ) {
	yolox_storage_set( 'current_sidebar', 'footer' );
	$yolox_footer_wide = yolox_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $yolox_footer_name ) ) {
		dynamic_sidebar( $yolox_footer_name );
	}
	$yolox_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $yolox_out ) ) {
		$yolox_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $yolox_out );
		$yolox_need_columns = true;  
		if ( $yolox_need_columns ) {
			$yolox_columns = max( 0, (int) yolox_get_theme_option( 'footer_columns' ) );
			if ( 0 == $yolox_columns ) {
				$yolox_columns = min( 4, max( 1, substr_count( $yolox_out, '<aside ' ) ) );
			}
			if ( $yolox_columns > 1 ) {
				$yolox_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $yolox_columns ) . ' widget', $yolox_out );
			} else {
				$yolox_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $yolox_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $yolox_footer_wide ) {
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
				yolox_show_layout( $yolox_out );
				do_action( 'yolox_action_after_sidebar' );
				if ( $yolox_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $yolox_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
