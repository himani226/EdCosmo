<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

yolox_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	yolox_blog_archive_start();

	?><div class="posts_container">
		<?php

		$yolox_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
		$yolox_sticky_out = yolox_get_theme_option( 'sticky_style' ) == 'columns'
								&& is_array( $yolox_stickies ) && count( $yolox_stickies ) > 0 && get_query_var( 'paged' ) < 1;
		if ( $yolox_sticky_out ) {
			?>
			<div class="sticky_wrap columns_wrap">
			<?php
		}
		while ( have_posts() ) {
			the_post();
			if ( $yolox_sticky_out && ! is_sticky() ) {
				$yolox_sticky_out = false;
				?>
				</div>
				<?php
			}
			$yolox_part = $yolox_sticky_out && is_sticky() ? 'sticky' : 'excerpt';
			get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', $yolox_part ), $yolox_part );
		}
		if ( $yolox_sticky_out ) {
			$yolox_sticky_out = false;
			?>
			</div>
			<?php
		}

		?>
	</div>
	<?php

	yolox_show_pagination();

	yolox_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
