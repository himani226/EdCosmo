<?php
/**
 * The Portfolio template to display the content
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
		. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
	);
	echo ( ! yolox_is_off( $yolox_animation ) && empty( $yolox_template_args['slider'] ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' );
	?>
>
<?php

// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>

		<?php
}

	$yolox_image_hover = ! empty( $yolox_template_args['hover'] ) && ! yolox_is_inherit( $yolox_template_args['hover'] )
								? $yolox_template_args['hover']
								: yolox_get_theme_option( 'image_hover' );
	// Featured image
	yolox_show_post_featured(
		array(
			'singular'      => false,
			'hover'         => $yolox_image_hover,
			'no_links'      => ! empty( $yolox_template_args['no_links'] ),
			'thumb_size'    => yolox_get_thumb_size(
				strpos( yolox_get_theme_option( 'body_style' ), 'full' ) !== false || $yolox_columns < 3
								? 'masonry-big'
				: 'masonry'
			),
			'show_no_image' => true,
			'class'         => 'dots' == $yolox_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $yolox_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!