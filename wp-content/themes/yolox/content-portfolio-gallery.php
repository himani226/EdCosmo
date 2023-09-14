<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_template_args = get_query_var( 'yolox_template_args' );
if ( is_array( $yolox_template_args ) ) {
	$yolox_columns    = empty( $yolox_template_args['columns'] ) ? 2 : max( 1, $yolox_template_args['columns'] );
	$yolox_blog_style = array( $yolox_template_args['type'], $yolox_columns );
} else {
	$yolox_blog_style = explode( '_', yolox_get_theme_option( 'blog_style' ) );
	$yolox_columns    = empty( $yolox_blog_style[1] ) ? 2 : max( 1, $yolox_blog_style[1] );
}
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );
$yolox_animation   = yolox_get_theme_option( 'blog_animation' );
$yolox_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><div class="
<?php
if ( ! empty( $yolox_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo 'masonry_item masonry_item-1_' . esc_attr( $yolox_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_format_' . esc_attr( $yolox_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $yolox_columns )
		. ' post_layout_gallery'
		. ' post_layout_gallery_' . esc_attr( $yolox_columns )
	);
	echo ( ! yolox_is_off( $yolox_animation ) && empty( $yolox_template_args['slider'] ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' );
	?>
	data-size="
		<?php
		if ( ! empty( $yolox_image[1] ) && ! empty( $yolox_image[2] ) ) {
			echo intval( $yolox_image[1] ) . 'x' . intval( $yolox_image[2] );}
		?>
	"
	data-src="
		<?php
		if ( ! empty( $yolox_image[0] ) ) {
			echo esc_url( $yolox_image[0] );}
		?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$yolox_image_hover = 'icon';  if ( in_array( $yolox_image_hover, array( 'icons', 'zoom' ) ) ) {
	$yolox_image_hover = 'dots';
}
$yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
$yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );
yolox_show_post_featured(
	array(
		'hover'         => $yolox_image_hover,
		'singular'      => false,
		'no_links'      => ! empty( $yolox_template_args['no_links'] ),
		'thumb_size'    => yolox_get_thumb_size( strpos( yolox_get_theme_option( 'body_style' ), 'full' ) !== false || $yolox_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $yolox_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $yolox_components )
								? yolox_show_post_meta(
									apply_filters(
										'yolox_filter_post_meta_args', array(
											'components' => $yolox_components,
											'counters' => $yolox_counters,
											'seo'      => false,
											'echo'     => false,
										), $yolox_blog_style[0], $yolox_columns
									)
								)
								: ''
								)
							. ( empty( $yolox_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $yolox_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'yolox' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
