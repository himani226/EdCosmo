<?php
/**
 * The default template to display the content
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
	if ( ! empty( $yolox_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $yolox_columns > 1 ) {
		?>
		<div class="column-1_<?php echo esc_attr( $yolox_columns ); ?>">
		<?php
	}
}
$yolox_expanded    = ! yolox_sidebar_present() && yolox_is_on( yolox_get_theme_option( 'expand_content' ) );
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );
$yolox_animation   = yolox_get_theme_option( 'blog_animation' );

?>
<article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_' . esc_attr( $yolox_post_format ) ); ?>
	<?php echo ( ! yolox_is_off( $yolox_animation ) && empty( $yolox_template_args['slider'] ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' ); ?>
	>
	<?php
 if ( in_array( $yolox_post_format, array( 'quote' ) )) {?>
    <div class="quote-wrapper">
    <?php
 }
 ?>
 <?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}
	if ( get_the_title() != '' ) {?>

	    <?php
          // Post title
          if ( in_array( $yolox_post_format, array( 'audio' ) )) {?>
            <div class="media-block">
            <?php
              if ( empty( $yolox_template_args['no_links'] )  ) {
                  the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
              } else {
                        the_title( '<h2 class="post_title entry-title">', '</h2>' );
                    }?>
            </div>
           <?php
          }?>
         <?php
	}

	// Featured image
	$yolox_hover = ! empty( $yolox_template_args['hover'] ) && ! yolox_is_inherit( $yolox_template_args['hover'] )
						? $yolox_template_args['hover']
						: yolox_get_theme_option( 'image_hover' );
	yolox_show_post_featured(
		array(
			'singular'   => false,
			'no_links'   => ! empty( $yolox_template_args['no_links'] ),
			'hover'      => $yolox_hover,
			'thumb_size' => yolox_get_thumb_size( strpos( yolox_get_theme_option( 'body_style' ), 'full' ) !== false ? 'full' : ( $yolox_expanded ? 'huge' : 'big' ) ),
		)
	);

	// Title and post meta


		?>
		<?php if ( ! in_array( $yolox_post_format, array( 'quote' ) )) {?>
		<div class="post_header entry-header">
			<?php
			do_action( 'yolox_action_before_post_title' );

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

            if ( get_the_title() != '' ) {
                // Post title
                if ( ! in_array( $yolox_post_format, array( 'audio', 'quote' ) )) {
                    if ( empty( $yolox_template_args['no_links'] )  ) {
                        the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                    } else {
                        the_title( '<h2 class="post_title entry-title">', '</h2>' );
                    }
                }
			}

			do_action( 'yolox_action_before_post_meta' );

			?>
		</div><!-- .post_header -->
		<?php
        }

	// Post content
	if ( empty( $yolox_template_args['hide_excerpt'] ) && ! in_array( $yolox_post_format, array( 'audio' ) )) {

		?>
		<div class="post_content entry-content">
		<?php
		if ( yolox_get_theme_option( 'blog_content' ) == 'fullpost' ) {
			// Post content area
			?>
				<div class="post_content_inner">
				<?php
				the_content( '' );
				?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'yolox' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'yolox' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
		} else {
			// Post content area
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
		?>
		</div><!-- .entry-content -->
<?php
 if ( in_array( $yolox_post_format, array( 'quote' ) )) {?>
    </div>
    <?php
 }
 ?>
		<?php
        	if ( in_array( $yolox_post_format, array( 'quote' ) )) {
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
			}

		if ( !is_sticky() ) {
				// More button
				if ( empty( $yolox_template_args['no_links'] ) && ! in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote', 'audio' ) ) ) {
					?>
					<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'yolox' ); ?></a></p>
					<?php
				}
		}
		?>
		<?php
	}
	?>
	</article>
<?php

if ( is_array( $yolox_template_args ) ) {
	if ( ! empty( $yolox_template_args['slider'] ) || $yolox_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
