<?php
/**
 * The template for homepage posts with custom style
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.50
 */

yolox_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	$yolox_blog_style = yolox_get_theme_option( 'blog_style' );
	$yolox_parts      = explode( '_', $yolox_blog_style );
	$yolox_columns    = ! empty( $yolox_parts[1] ) ? max( 1, min( 6, (int) $yolox_parts[1] ) ) : 1;
	$yolox_blog_id    = yolox_get_custom_blog_id( $yolox_blog_style );
	$yolox_blog_meta  = yolox_get_custom_layout_meta( $yolox_blog_id );
	if ( ! empty( $yolox_blog_meta['margin'] ) ) {
		yolox_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( yolox_prepare_css_value( $yolox_blog_meta['margin'] ) ) ) );
	}
	$yolox_custom_style = ! empty( $yolox_blog_meta['scripts_required'] ) ? $yolox_blog_meta['scripts_required'] : 'none';

	yolox_blog_archive_start();

	$yolox_classes    = 'posts_container blog_custom_wrap' 
							. ( ! yolox_is_off( $yolox_custom_style )
								? sprintf( ' %s_wrap', $yolox_custom_style )
								: ( $yolox_columns > 1 
									? ' columns_wrap columns_padding_bottom' 
									: ''
									)
								);
	$yolox_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$yolox_sticky_out = yolox_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $yolox_stickies ) && count( $yolox_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $yolox_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $yolox_sticky_out ) {
		if ( yolox_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( yolox_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}
		?>
		<div class="<?php echo esc_attr( $yolox_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $yolox_sticky_out && ! is_sticky() ) {
			$yolox_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $yolox_classes ); ?>">
			<?php
		}
		$yolox_part = $yolox_sticky_out && is_sticky() ? 'sticky' : 'custom';
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', $yolox_part ), $yolox_part );
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
