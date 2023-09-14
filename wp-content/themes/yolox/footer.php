<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

						// Widgets area inside page content
						yolox_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$yolox_body_style = yolox_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $yolox_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$yolox_widgets_name = yolox_get_theme_option( 'widgets_below_page' );
					$yolox_show_widgets = ! yolox_is_off( $yolox_widgets_name ) && is_active_sidebar( $yolox_widgets_name );
					$yolox_show_related = is_single() && yolox_get_theme_option( 'related_position' ) == 'below_page';
					if ( $yolox_show_widgets || $yolox_show_related ) {
						if ( 'fullscreen' != $yolox_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $yolox_show_related ) {
						    if(function_exists('yolox_is_tribe_events_page') && yolox_is_tribe_events_page()) {

                            } else {
                                do_action('yolox_action_related_posts');
                            }
						}

						// Widgets area below page content
						if ( $yolox_show_widgets ) {
							yolox_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $yolox_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				yolox_show_post_banner('footer');
			}
			// Footer
			$yolox_footer_type = yolox_get_theme_option( 'footer_type' );
			if ( 'custom' == $yolox_footer_type && ! yolox_is_layouts_available() ) {
				$yolox_footer_type = 'default';
			}
			get_template_part( apply_filters( 'yolox_filter_get_template_part', "templates/footer-{$yolox_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>