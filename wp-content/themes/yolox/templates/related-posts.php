<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_link        = get_permalink();
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item related_item_style_1 post_format_' . esc_attr( $yolox_post_format ) ); ?>>
	<?php
	yolox_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'yolox_filter_related_thumb_size', yolox_get_thumb_size( (int) yolox_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
			'show_no_image' => yolox_get_theme_setting( 'allow_no_image' ),
			'singular'      => false,
			'post_info'     => '<div class="post_header entry-header">'
						. '<div class="post_categories">' . wp_kses( yolox_get_post_categories( '' ), 'yolox_kses_content' ) . '</div>'
						. '<h6 class="post_title entry-title"><a href="' . esc_url( $yolox_link ) . '">' . wp_kses_data( get_the_title() ) . '</a></h6>'
						. ( in_array( get_post_type(), array( 'post', 'attachment' ) )
								? '<span class="post_date"><a href="' . esc_url( $yolox_link ) . '">' . wp_kses_data( yolox_get_date() ) . '</a></span>'
								: '' )
					. '</div>',
		)
	);
	?>
</div>
