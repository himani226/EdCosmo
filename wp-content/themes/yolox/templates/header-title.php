<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

// Page (category, tag, archive, author) title

if ( yolox_need_page_title() && !is_single() ) {
	yolox_sc_layouts_showed( 'title', true );
	yolox_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								yolox_show_post_meta(
									apply_filters(
										'yolox_filter_post_meta_args', array(
											'components' => yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) ),
											'counters'   => yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) ),
											'seo'        => yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$yolox_blog_title           = yolox_get_blog_title();
							$yolox_blog_title_text      = '';
							$yolox_blog_title_class     = '';
							$yolox_blog_title_link      = '';
							$yolox_blog_title_link_text = '';
							if ( is_array( $yolox_blog_title ) ) {
								$yolox_blog_title_text      = $yolox_blog_title['text'];
								$yolox_blog_title_class     = ! empty( $yolox_blog_title['class'] ) ? ' ' . $yolox_blog_title['class'] : '';
								$yolox_blog_title_link      = ! empty( $yolox_blog_title['link'] ) ? $yolox_blog_title['link'] : '';
								$yolox_blog_title_link_text = ! empty( $yolox_blog_title['link_text'] ) ? $yolox_blog_title['link_text'] : '';
							} else {
								$yolox_blog_title_text = $yolox_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $yolox_blog_title_class ); ?>">
								<?php
								$yolox_top_icon = yolox_get_category_icon();
								if ( ! empty( $yolox_top_icon ) ) {
									$yolox_attr = yolox_getimagesize( $yolox_top_icon );
									?>
									<img src="<?php echo esc_url( $yolox_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'yolox' ); ?>"
										<?php
										if ( ! empty( $yolox_attr[3] ) ) {
											yolox_show_layout( $yolox_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $yolox_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $yolox_blog_title_link ) && ! empty( $yolox_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $yolox_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $yolox_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						?>
						<div class="sc_layouts_title_breadcrumbs">
							<?php
							do_action( 'yolox_action_breadcrumbs' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
