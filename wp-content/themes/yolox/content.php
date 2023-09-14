<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_seo = yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) );
?>
<article id="post-<?php the_ID(); ?>"
	<?php
	post_class('post_item_single post_type_' . esc_attr( get_post_type() )
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	if ( $yolox_seo ) {
		?>
		itemscope="itemscope"
		itemprop="articleBody"
		itemtype="//schema.org/<?php echo esc_attr( yolox_get_markup_schema() ); ?>"
		itemid="<?php echo esc_url( get_the_permalink() ); ?>"
		content="<?php the_title_attribute(); ?>"
		<?php
	}
	?>
>
<?php

	do_action( 'yolox_action_before_post_data' );

	// Structured data snippets
	if ( $yolox_seo ) {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/seo' ) );
	}

    if ( is_singular( 'post' ) ) {
        $yolox_post_thumbnail_type  = yolox_get_theme_option( 'post_thumbnail_type' );
        $yolox_post_header_position = yolox_get_theme_option( 'post_header_position' );
        $yolox_post_header_align    = yolox_get_theme_option( 'post_header_align' );

        if ( 'default' === $yolox_post_thumbnail_type ) {
            ?>
            <div class="header_content_wrap header_align_<?php echo esc_attr( $yolox_post_header_align ); ?>">
                <?php

                // Post title and meta
                if ( 'under' !== $yolox_post_header_position ) {
                    yolox_show_post_title_and_meta_custom();
                }

                // Featured image
                if ( 'under' === $yolox_post_header_position ) {
                    yolox_show_post_featured_image();
                }
                // Post title and meta
                if ( 'under' === $yolox_post_header_position ) {
                    yolox_show_post_title_and_meta_custom();
                    yolox_show_post_socials_custom();
                }

                if ( 'above' === $yolox_post_header_position ) {
                    yolox_show_post_featured_image();
                }
                // Post socials
                if ( 'above' === $yolox_post_header_position  ) {
                    yolox_show_post_socials_custom();
                }
                // Post socials
                if ( 'default' === $yolox_post_header_position  ) {
                    yolox_show_post_socials_custom();
                }

                ?>
            </div>
            <?php
        } elseif ( 'fullwidth' === $yolox_post_thumbnail_type ) {
            // Post title and meta
            if ( 'above' !== $yolox_post_header_position  ) {
                yolox_show_post_title_and_meta_custom();
                yolox_show_post_socials_custom();
            }
        }elseif ( 'boxed' === $yolox_post_thumbnail_type ) {
            // Share
            if ( 'under' !== $yolox_post_header_position  ) {
                if (yolox_is_on(yolox_get_theme_option('show_share_links'))) { ?>
                    <?php
                    yolox_show_post_socials_custom();
                    ?>
                    <?php
                }
            } elseif ( 'under' === $yolox_post_header_position  ) {
                if (yolox_is_on(yolox_get_theme_option('show_share_links'))) { ?>
                    <?php
                    yolox_show_post_title_and_meta_custom();
                    yolox_show_post_socials_custom();
                    ?>
                    <?php
                }
            }
        }


    }

	do_action( 'yolox_action_before_post_content' );

	// Post content
	?>
	<div class="post_content post_content_single entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content();

		do_action( 'yolox_action_before_post_pagination' );

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

		// Taxonomies and share
		if ( is_single() && ! is_attachment() ) {

			do_action( 'yolox_action_before_post_meta' );

			// Post rating
			do_action(
				'trx_addons_action_post_rating', array(
					'class'                => 'single_post_rating',
					'rating_text_template' => esc_html__( 'Post rating: {{X}} from {{Y}} (according {{V}})', 'yolox' ),
				)
			);

			?>
			<div class="post_meta post_meta_single">
               <?php the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">' . esc_html__( 'Tags:', 'yolox' ) . '</span> ', ' ', '</span>' ); ?>
				<?php
                if ( is_singular( 'post' ) ) {
                    $yolox_post_thumbnail_type  = yolox_get_theme_option( 'post_thumbnail_type' );
                    $yolox_post_header_position = yolox_get_theme_option( 'post_header_position' );
                    $yolox_post_header_align    = yolox_get_theme_option( 'post_header_align' );

                    if ( 'default' === $yolox_post_thumbnail_type ) {
                        ?>
                            <?php
                            // Post title and meta
                        if ( yolox_is_on( yolox_get_theme_option( 'show_share_links' ) ) ) {?>
                            <?php
                            yolox_show_post_socials_custom();
                            ?>
                            <?php
                        }
                            ?>

                        <?php
                    } elseif ( 'fullwidth' === $yolox_post_thumbnail_type ) {
                        // Share
                        if ( yolox_is_on( yolox_get_theme_option( 'show_share_links' ) ) ) {?>
                                <?php
                                yolox_show_post_socials_custom();
                                ?>
                            <?php
                        }
                    }
                    elseif ( 'boxed' === $yolox_post_thumbnail_type ) {
                        // Share
                        if ( yolox_is_on( yolox_get_theme_option( 'show_share_links' ) ) ) {?>
                                <?php
                                yolox_show_post_socials_custom();
                                ?>
                            <?php
                        }
                    }
                }

			do_action( 'yolox_action_after_post_meta' );
		}
		?>
	</div><!-- .entry-content -->


	<?php
	do_action( 'yolox_action_after_post_content' );

	// Author bio
	if ( yolox_get_theme_option( 'show_author_info' ) == 1 && is_single() && ! is_attachment() && get_the_author_meta( 'description' ) ) { 		do_action( 'yolox_action_before_post_author' );
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'yolox_action_after_post_author' );
	}

	do_action( 'yolox_action_after_post_data' );
	?>
</article>
