<?php
/**
 * The Classic template to display the content
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
$yolox_expanded   = ! yolox_sidebar_present() && yolox_is_on( yolox_get_theme_option( 'expand_content' ) );
$yolox_animation  = yolox_get_theme_option( 'blog_animation' );
$yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
$yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );

$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );

?><div class="
<?php
if ( ! empty( $yolox_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $yolox_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $yolox_columns );
}
?>
"><article id="post-<?php the_ID(); ?>"
	<?php
		post_class(
			'post_item post_format_' . esc_attr( $yolox_post_format )
					. ' post_layout_classic post_layout_classic_' . esc_attr( $yolox_columns )
					. ' post_layout_' . esc_attr( $yolox_blog_style[0] )
					. ' post_layout_' . esc_attr( $yolox_blog_style[0] ) . '_' . esc_attr( $yolox_columns )
		);
		echo ( ! yolox_is_off( $yolox_animation ) && empty( $yolox_template_args['slider'] ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' );
		?>
	>
	<?php

    if ( get_the_title() != '' && in_array( $yolox_post_format, array( 'audio' ) ) ) {?>
        <div class="media-block">
            <?php
            // Post title
                if ( empty( $yolox_template_args['no_links'] )  ) {
                    the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                } else {
                    the_title( '<h2 class="post_title entry-title">', '</h2>' );

            }?>
        </div>
        <?php
    }

	// Featured image
	$yolox_hover = ! empty( $yolox_template_args['hover'] ) && ! yolox_is_inherit( $yolox_template_args['hover'] )
						? $yolox_template_args['hover']
						: yolox_get_theme_option( 'image_hover' );
	yolox_show_post_featured(
		array(
			'thumb_size' => yolox_get_thumb_size(
				'classic' == $yolox_blog_style[0]
						? ( strpos( yolox_get_theme_option( 'body_style' ), 'blogger-big' ) !== false
								? ( $yolox_columns > 2 ? 'big' : 'huge' )
								: ( $yolox_columns > 2
									? ( $yolox_expanded ? 'med' : 'small' )
									: ( $yolox_expanded ? 'big' : 'blogger-big' )
									)
							)
						: ( strpos( yolox_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $yolox_columns > 2 ? 'masonry-big' : 'full' )
								: ( $yolox_columns <= 2 && $yolox_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $yolox_hover,
			'no_links'   => ! empty( $yolox_template_args['no_links'] ),
			'singular'   => false,
		)
	);

    // Title and post meta

    ?>
        <div class="post_header entry-header">
            <?php
            do_action( 'yolox_action_before_post_title' );

            if ( get_the_title() != '' ) {
                // Post title
                if ( ! in_array( $yolox_post_format, array( 'audio' ) )) {
                    if ( empty( $yolox_template_args['no_links'] )  ) {
                        the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                    } else {
                        the_title( '<h2 class="post_title entry-title">', '</h2>' );
                    }
                }
            }

            do_action( 'yolox_action_before_post_meta' );
            // Post meta
            $yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
            $yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );

            if ( ! empty( $yolox_components ) && ! in_array( $yolox_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                yolox_show_post_meta(
                    apply_filters(
                        'yolox_filter_post_meta_args', array(
                        'components' => $yolox_components,
                        'counters'   => $yolox_counters,
                        'seo'        => false,
                    ), 'excerpt', 1
                    )
                );
            }

            ?>
        </div><!-- .post_header -->
        <?php
	?>

	<div class="post_content entry-content">
	<?php
	if ( empty( $yolox_template_args['hide_excerpt'] ) ) {
		?>
			<div class="post_content_inner">
			<?php
			if ( has_excerpt() ) {
				the_excerpt();
			} elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
				the_content( '' );
			} elseif ( in_array( $yolox_post_format, array( 'link', 'aside', 'status' ) ) ) {
				the_content();
			} elseif ( 'quote' == $yolox_post_format ) {
				$quote = yolox_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
				if ( ! empty( $quote ) ) {
					yolox_show_layout( wpautop( $quote ) );
				} else {
					the_excerpt();
				}
			} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
				the_excerpt();
			}
			?>
			</div>
			<?php
	}
		// Post meta
	if ( in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		if ( ! empty( $yolox_components ) ) {
			yolox_show_post_meta(
				apply_filters(
					'yolox_filter_post_meta_args', array(
						'components' => $yolox_components,
						'counters'   => $yolox_counters,
					), $yolox_blog_style[0], $yolox_columns
				)
			);
		}
	}

	?>
	</div><!-- .entry-content -->

     <?php
     // More button
	if ( false && empty( $yolox_template_args['no_links'] ) && ! in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
			<a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'yolox' ); ?></a>
			<?php
	}

     if (! in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
         ?>
         <a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'yolox' ); ?></a>
         <?php
     }
    ?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
