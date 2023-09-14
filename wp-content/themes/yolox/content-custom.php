<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.50
 */

$yolox_template_args = get_query_var( 'yolox_template_args' );
if ( is_array( $yolox_template_args ) ) {
	$yolox_columns    = empty( $yolox_template_args['columns'] ) ? 2 : max( 1, $yolox_template_args['columns'] );
	$yolox_blog_style = array( $yolox_template_args['type'], $yolox_columns );
} else {
	$yolox_blog_style = explode( '_', yolox_get_theme_option( 'blog_style' ) );
	$yolox_columns    = empty( $yolox_blog_style[1] ) ? 2 : max( 1, $yolox_blog_style[1] );
}
$yolox_blog_id       = yolox_get_custom_blog_id( join( '_', $yolox_blog_style ) );
$yolox_blog_style[0] = str_replace( 'blog-custom-', '', $yolox_blog_style[0] );
$yolox_expanded      = ! yolox_sidebar_present() && yolox_is_on( yolox_get_theme_option( 'expand_content' ) );
$yolox_animation     = yolox_get_theme_option( 'blog_animation' );
$yolox_components    = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
$yolox_counters      = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );

$yolox_post_format   = get_post_format();
$yolox_post_format   = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );

$yolox_blog_meta     = yolox_get_custom_layout_meta( $yolox_blog_id );
$yolox_custom_style  = ! empty( $yolox_blog_meta['scripts_required'] ) ? $yolox_blog_meta['scripts_required'] : 'none';

if ( ! empty( $yolox_template_args['slider'] ) || $yolox_columns > 1 || ! yolox_is_off( $yolox_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $yolox_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo ( yolox_is_off( $yolox_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $yolox_custom_style ) ) . '-1_' . esc_attr( $yolox_columns );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" 
<?php
	post_class(
			'post_item post_format_' . esc_attr( $yolox_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $yolox_columns )
					. ' post_layout_' . esc_attr( $yolox_blog_style[0] )
					. ' post_layout_' . esc_attr( $yolox_blog_style[0] ) . '_' . esc_attr( $yolox_columns )
					. ( ! yolox_is_off( $yolox_custom_style )
						? ' post_layout_' . esc_attr( $yolox_custom_style )
							. ' post_layout_' . esc_attr( $yolox_custom_style ) . '_' . esc_attr( $yolox_columns )
						: ''
						)
		);
	echo ( ! yolox_is_off( $yolox_animation ) && empty( $yolox_template_args['slider'] ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' );
?>
>
	<?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}
	// Custom header's layout
	do_action( 'yolox_action_show_layout', $yolox_blog_id );
	?>
</article><?php
if ( ! empty( $yolox_template_args['slider'] ) || $yolox_columns > 1 || ! yolox_is_off( $yolox_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
