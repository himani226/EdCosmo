<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );
$yolox_animation   = yolox_get_theme_option( 'blog_animation' );

?><div class="column-1_<?php echo esc_attr( $yolox_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $yolox_post_format ) ); ?>
	<?php echo ( ! yolox_is_off( $yolox_animation ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' ); ?>
	>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	yolox_show_post_featured(
		array(
			'thumb_size' => yolox_get_thumb_size( 1 == $yolox_columns ? 'big' : ( 2 == $yolox_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			yolox_show_post_meta( apply_filters( 'yolox_filter_post_meta_args', array(), 'sticky', $yolox_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
