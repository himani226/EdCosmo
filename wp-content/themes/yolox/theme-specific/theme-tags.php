<?php
/**
 * Theme tags
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */


//----------------------------------------------------------------------
//-- Common tags
//----------------------------------------------------------------------

// Return true if current page need title
if ( ! function_exists( 'yolox_need_page_title' ) ) {
	function yolox_need_page_title() {
		return ! is_front_page() && apply_filters( 'yolox_filter_need_page_title', true );
	}
}

// Output string with the html layout (if not empty)
// (put it between 'before' and 'after' tags)
// Attention! This string may contain layout formed in any plugin (widgets or shortcodes output) and not require escaping to prevent damage!
if ( ! function_exists( 'yolox_show_layout' ) ) {
	function yolox_show_layout( $str, $before = '', $after = '' ) {
		if ( trim( $str ) != '' ) {
			printf( '%s%s%s', $before, $str, $after );
		}
	}
}

// Return logo images (if set)
if ( ! function_exists( 'yolox_get_logo_image' ) ) {
	function yolox_get_logo_image( $type = '' ) {
		$logo_image  = '';
		if ( empty( $type ) && function_exists( 'the_custom_logo' ) ) {
			$logo_image = yolox_get_theme_option( 'custom_logo' );
			if ( empty( $logo_image ) ) {
				$logo_image = get_theme_mod( 'custom_logo' );
			}
			if ( is_numeric( $logo_image ) && (int) $logo_image > 0 ) {
				$image      = wp_get_attachment_image_src( $logo_image, 'full' );
				$logo_image = $image[0];
			}
		} else {
			$logo_image = yolox_get_theme_option( 'logo' . ( ! empty( $type ) ? '_' . trim( $type ) : '' ) );
		}
		$logo_retina = yolox_is_on( yolox_get_theme_option( 'logo_retina_enabled' ) )
						? yolox_get_theme_option( 'logo' . ( ! empty( $type ) ? '_' . trim( $type ) : '' ) . '_retina' )
						: '';
		return array(
					'logo'        => ! empty( $logo_image ) ? yolox_remove_protocol_from_url( $logo_image, false ) : '',
					'logo_retina' => ! empty( $logo_retina ) ? yolox_remove_protocol_from_url( $logo_retina, false ) : ''
				);
	}
}

// Return header video (if set)
if ( ! function_exists( 'yolox_get_header_video' ) ) {
	function yolox_get_header_video() {
		$video = '';
		if ( apply_filters( 'yolox_header_video_enable', ! wp_is_mobile() && is_front_page() ) ) {
			if ( yolox_check_theme_option( 'header_video' ) ) {
				$video = yolox_get_theme_option( 'header_video' );
				if ( is_numeric( $video ) && (int) $video > 0 ) {
					$video = wp_get_attachment_url( $video );
				}
			} elseif ( function_exists( 'get_header_video_url' ) ) {
				$video = get_header_video_url();
			}
		}
		return $video;
	}
}


//----------------------------------------------------------------------
//-- Post parts
//----------------------------------------------------------------------

// Show post banner
if ( ! function_exists( 'yolox_show_post_banner' ) ) {
	function yolox_show_post_banner( $banner_pos = '') {
		if ( is_singular( 'post' ) && '' !== $banner_pos ){
			$banner_code = yolox_get_theme_option( $banner_pos . '_banner_code' );
			$banner_img = yolox_get_theme_option( $banner_pos . '_banner_img' );
			$banner_class = !empty( $banner_img )
								? ( 'background' == $banner_pos ? '' : 'banner_with_image ' ) . yolox_add_inline_css_class( 'background-image:url(' . esc_url( $banner_img ) . ')' )
								: '';
			$banner_link = yolox_get_theme_option( $banner_pos . '_banner_link' );
			if ( ! empty( $banner_code ) || ! empty( $banner_img ) ) {
				$banner_pos = 'background' == $banner_pos ? 'page' : $banner_pos;
				echo '<div class="' . esc_attr( $banner_pos ) . '_banner_wrap ' . esc_attr( $banner_class ) . '">';
				yolox_show_layout( wp_kses( $banner_code ), 'yolox_kses_content' );
				if ( ! empty( $banner_link ) ) {
					echo '<a href="' . esc_url( $banner_link ) . '" class="banner_link"></a>';
				}
				echo '</div>';
			}
		}	
	}
}


// Show post featured image
if ( ! function_exists( 'yolox_show_post_featured_image' ) ) {
	function yolox_show_post_featured_image() {
		$seo = yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) );
		// Featured image
		if ( yolox_is_off( yolox_get_theme_option( 'hide_featured_on_single' ) )
					&& ! yolox_sc_layouts_showed( 'featured' ) ) {
			do_action( 'yolox_action_before_post_featured' );
			yolox_show_post_featured( array( 'thumb_bg' => yolox_get_theme_option( 'post_thumbnail_type' ) == 'fullwidth' ) );
			do_action( 'yolox_action_after_post_featured' );
		} elseif ( $seo && has_post_thumbnail() ) {
			?>
			<meta itemprop="image" itemtype="//schema.org/ImageObject" content="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>">
			<?php
		}
	}
}

// Show post title and meta
if ( ! function_exists( 'yolox_show_post_title_and_meta' ) ) {
	function yolox_show_post_title_and_meta() {

		$seo = yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) );

		// Title and post meta
		if ( ( ! yolox_sc_layouts_showed( 'title' ) || ! yolox_sc_layouts_showed( 'postmeta' ) ) && ! in_array( get_post_format(), array( 'link', 'aside', 'status', 'quote' ) ) ) {
			do_action( 'yolox_action_before_post_title' );
			$need_content_wrap = yolox_get_theme_option( 'post_thumbnail_type' ) == 'fullwidth' && yolox_get_theme_option( 'post_header_position' ) !== 'on_thumb';
			?>
			<div class="post_header post_header_single entry-header">
				<?php
				if ( $need_content_wrap ) {
					?>
					<div class="content_wrap">
					<?php
				}
				// Post title
				if ( ! yolox_sc_layouts_showed( 'title' ) ) {
					the_title( '<h1 class="post_title entry-title"' . ( $seo ? ' itemprop="headline"' : '' ) . '>', '</h1>' );
				}
				// Post meta
				if ( ! yolox_sc_layouts_showed( 'postmeta' ) && yolox_is_on( yolox_get_theme_option( 'show_post_meta' ) ) ) {
					yolox_show_post_meta(
						apply_filters(
							'yolox_filter_post_meta_args',
							array(
								'components' => yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) ),
								'counters'   => yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) ),
								'seo'        => $seo,
							),
							'single',
							1
						)
					);
				}
				// Post excerpt
				if ( yolox_is_on( yolox_get_theme_option( 'show_post_excerpt' ) ) && has_excerpt() ) {
					?>
					<div class="post_excerpt">
						<?php the_excerpt(); ?>
					</div>
					<?php
				}
				if ( $need_content_wrap ) {
					?>
					</div>
					<?php
				}
				?>
			</div><!-- .post_header -->
			<?php
			do_action( 'yolox_action_after_post_title' );
		}
	}
}



// Show post meta block: post date, author, categories, counters, etc.
if ( ! function_exists( 'yolox_show_post_meta' ) ) {
	function yolox_show_post_meta( $args = array() ) {
		if ( is_single() && yolox_is_off( yolox_get_theme_option( 'show_post_meta' ) ) ) {
			return ' ';  // Space is need!
		}
		$args = array_merge(
			array(
				'components' => 'categories,date,author,counters,share,edit',
				'counters'   => 'comments',  
				'seo'        => false,
				'class'      => '',
				'echo'       => true,
			),
			$args
		);
		if ( ! $args['echo'] ) {
			ob_start();
		}
		?>
		<div class="post_meta<?php echo ! empty( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : ''; ?>">
			<?php
			$components = explode( ',', $args['components'] );
			foreach ( $components as $comp ) {
				$comp = trim( $comp );
				if ( 'categories' == $comp ) {
					// Post categories
					$cats = get_post_type() == 'post' ? get_the_category_list( ' ' ) : apply_filters( 'yolox_filter_get_post_categories', '' );
					if ( ! empty( $cats ) ) {
						?>
						<span class="post_meta_item post_categories"><?php yolox_show_layout( $cats ); ?></span>
						<?php
					}
				} elseif ( 'date' == $comp ) {
					// Post date
					$dt = apply_filters( 'yolox_filter_get_post_date', yolox_get_date() );
					if ( ! empty( $dt ) ) {
						?>
						<span class="post_meta_item post_date
							<?php if ( ! empty( $args['seo'] ) ) { echo ' date updated'; } ?>
							"
							<?php if ( ! empty( $args['seo'] ) ) { echo ' itemprop="datePublished"'; } ?>
						>
							<?php
							if ( ! is_singular() ) {
								?>
								<a href="<?php the_permalink(); ?>">
								<?php
							}
							echo wp_kses_data( $dt );
							if ( ! is_singular() ) {
								?>
								</a>
								<?php
							}
							?>
						</span>
						<?php
					}
				} elseif ( 'author' == $comp ) {
					// Post author
					$author_id = get_the_author_meta( 'ID' );

					if ( empty( $author_id ) && ! empty( $GLOBALS['post']->post_author ) ) {
						$author_id = $GLOBALS['post']->post_author;
					}
					if ( $author_id > 0 ) {
						$author_link = get_author_posts_url( $author_id );
						$author_name = get_the_author_meta( 'display_name', $author_id );
						?>
							<span class="post_meta_item post_author">
                                <span class="author_avatar_meta">
                                    <a rel="author" href="<?php echo esc_url( $author_link ); ?>"><?php
                                    $yolox_mult = yolox_get_retina_multiplier();
                                    echo get_avatar( get_the_author_meta( 'user_email', $author_id ), 35 * $yolox_mult );
                                    ?></a>
                                </span><!-- .author_avatar --> <span class="author_name"><?php esc_html_e('By ', 'yolox'); ?>    <a rel="author" href="<?php echo esc_url( $author_link ); ?>"><?php echo esc_html( $author_name ); ?></a></span>
							</span>
							<?php
					}
				} elseif ( 'counters' == $comp ) {
					// Post counters
					$output = yolox_get_post_counters( $args['counters'] );
					if ( '' != $output ) {
						yolox_show_layout( $output );
					} elseif ( ! yolox_exists_trx_addons() ) {
						if ( ! is_singular() || have_comments() || comments_open() ) {
							$post_comments = get_comments_number();
							?>
								<a href="<?php comments_link(); ?>" class="post_meta_item post_counters_item post_counters_comments icon-comment-light"><span class="post_counters_number">
									<?php
									echo esc_html( $post_comments );
									?>
									</span><span class="post_counters_label">
									<?php
									echo esc_html( _n( 'Comment', 'Comments', $post_comments, 'yolox' ) );
									?>
									</span>
								</a>
							<?php
						}
					}
				} elseif ( 'share' == $comp ) {
					// Socials share
					yolox_show_share_links(
						array(
							'type'    => 'drop',
							'caption' => esc_html__( 'Share', 'yolox' ),
							'before'  => '<div class="post_meta_item post_share">',
							'after'   => '</div>',
						)
					);
				} elseif ( 'edit' == $comp ) {
					// Edit page link
					edit_post_link( esc_html__( 'Edit', 'yolox' ), '', '', 0, 'post_meta_item post_edit icon-pencil' );
				} else {
					// Custom counter
					do_action( 'yolox_action_show_post_counter', $comp, get_the_ID() );
				}
			}
			?>
		</div><!-- .post_meta -->
		<?php
		if ( ! $args['echo'] ) {
			$rez = ob_get_contents();
			ob_end_clean();
			return $rez;
		} else {
			return '';
		}
	}
}



// Show post title and meta
if ( ! function_exists( 'yolox_show_post_title_and_meta_custom' ) ) {
	function yolox_show_post_title_and_meta_custom() {

		$seo = yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) );
        // Post meta
        $yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
        $yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );
$yolox_hover = ! empty( $yolox_template_args['hover'] ) && ! yolox_is_inherit( $yolox_template_args['hover'] )
						? $yolox_template_args['hover']
						: yolox_get_theme_option( 'image_hover' );
		// Title and post meta
		if ( ( ! yolox_sc_layouts_showed( 'title' ) || ! yolox_sc_layouts_showed( 'postmeta' ) ) ) {
			do_action( 'yolox_action_before_post_title' );
			$need_content_wrap = yolox_get_theme_option( 'post_thumbnail_type' ) == 'fullwidth' && yolox_get_theme_option( 'post_header_position' ) !== 'on_thumb';
			?>
			<div class="post_header post_header_single entry-header">
				<?php
				if ( $need_content_wrap ) {
					?>
					<div class="content_wrapper">
					<?php
				}
				if ( is_single() && ! is_attachment() ) {
                    // Post title
                    if ( ! yolox_sc_layouts_showed( 'postmeta' ) && yolox_is_on( yolox_get_theme_option( 'show_post_meta' ) ) ) {?>
                        <div class="post_meta_wrap">
                            <?php
                            if ( !empty($yolox_counters) && stristr($yolox_components,'categories') && ! empty( $yolox_components ) && ! in_array( $yolox_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                                yolox_show_post_meta(
                                    apply_filters(
                                        'yolox_filter_post_meta_args', array(
                                        'components' => 'categories',
                                        'counters'   => '',
                                        'categories' => '',
                                        'seo'        => false,
                                    ), 'excerpt', 1
                                    )
                                );
                            }
                    }
                     if ( ! yolox_sc_layouts_showed( 'title' ) ) {
                          the_title( '<h1 class="post_title entry-title"' . ( $seo ? ' itemprop="headline"' : '' ) . '>', '</h1>' );
                     }
                    if ( ! yolox_sc_layouts_showed( 'postmeta' ) && yolox_is_on( yolox_get_theme_option( 'show_post_meta' ) ) ) {
                            if ( ! yolox_sc_layouts_showed( 'postmeta' ) && yolox_is_on( yolox_get_theme_option( 'show_post_meta' ) ) ) {?>
                             <?php  if ( !empty($yolox_counters) && stristr($yolox_components,'author') && ! empty( $yolox_components ) && ! in_array( $yolox_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                                    ?>
                                    <div class="meta_author_atts">
                                        <?php
                                        yolox_show_post_meta(
                                            apply_filters(
                                                'yolox_filter_post_meta_args', array(
                                                'components' => 'author,date',
                                                'counters'   => '',
                                                'categories' => '',
                                                'seo'        => false,
                                            ), 'excerpt', 1
                                            )
                                        );?>
                                    </div>
                                    <?php
                                }

                             }
                                ?>

                    </div>
                   <?php }


				} else {
				     // Post title
                    if ( ! yolox_sc_layouts_showed( 'title' ) ) {
                        the_title( '<h1 class="post_title entry-title"' . ( $seo ? ' itemprop="headline"' : '' ) . '>', '</h1>' );
                    }
                    // Post meta

                    if ( ! yolox_sc_layouts_showed( 'postmeta' ) && yolox_is_on( yolox_get_theme_option( 'show_post_meta' ) ) ) {
                        yolox_show_post_meta(
                            apply_filters(
                                'yolox_filter_post_meta_args',
                                array(
                                    'components' => yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) ),
                                    'counters'   => yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) ),
                                    'seo'        => $seo,
                                ),
                                'single',
                                1
                            )
                        );
                    }
				}
				// Post excerpt
				if ( yolox_is_on( yolox_get_theme_option( 'show_post_excerpt' ) ) && has_excerpt() ) {
					?>
					<div class="post_excerpt">
						<?php the_excerpt(); ?>
					</div>
					<?php
				}
				if ( $need_content_wrap ) {
					?>
					</div>
					<?php
				}
				?>
			</div><!-- .post_header -->
			<?php
			do_action( 'yolox_action_after_post_title' );
		}
	}
}

// Show post title and meta
if ( ! function_exists( 'yolox_show_post_socials_custom' ) ) {
	function yolox_show_post_socials_custom() {

		$seo = yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) );
        // Post meta
        $yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
        $yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );
$yolox_hover = ! empty( $yolox_template_args['hover'] ) && ! yolox_is_inherit( $yolox_template_args['hover'] )
						? $yolox_template_args['hover']
						: yolox_get_theme_option( 'image_hover' ); ?>
						<?php ?>

						    <?php  if (  function_exists( 'trx_addons_activate' ) ) { ?>
                                <div class="secondary_meta_wrap">

                                    <?php  if ( !empty($yolox_counters) && stristr($yolox_components,'share') && ! empty( $yolox_components ) && ! in_array( $yolox_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                                        ?>
                                        <div class="single_share">
                                            <?php
                                            yolox_show_post_meta(
                                                apply_filters(
                                                    'yolox_filter_post_meta_args', array(
                                                    'components' => 'share',
                                                    'counters'   => '',
                                                    'categories' => '',
                                                    'seo'        => false,
                                                ), 'excerpt', 1
                                                )
                                            );


                                            ?>

                                        </div>
                                        <?php

                                    if ( !empty($yolox_counters) && stristr($yolox_components,'counters') && ! empty( $yolox_components ) && ! in_array( $yolox_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
                                        ?>
                                        <div class="counters_wrap">
                                            <?php
                                            yolox_show_post_meta(
                                                apply_filters(
                                                    'yolox_filter_post_meta_args', array(
                                                    'components' => 'counters',
                                                    'counters'   => $yolox_counters,
                                                    'categories' => '',
                                                    'seo'        => false,
                                                ), 'excerpt', 1
                                                )
                                            );?>
                                        </div>
                                        <?php
                                    }
                                 }

                                    ?>
                                </div>
                             <?php
                             }
                             	do_action( 'yolox_action_after_post_meta' );
                         }
}



// Show post featured block: image, video, audio, etc.
if ( ! function_exists( 'yolox_show_post_featured' ) ) {
	function yolox_show_post_featured( $args = array() ) {
		$args = array_merge(
			array(
				'hover'         => yolox_get_theme_option( 'image_hover' ), // Hover effect
				'no_links'      => false,                       // Disable links
				'link'          => '',                          // Alternative (external) link
				'class'         => '',                          // Additional Class for featured block
				'post_info'     => '',                          // Additional layout after hover
				'thumb_bg'      => false,                       // Put thumb image as block background or as separate tag
				'thumb_size'    => '',                          // Image size
				'thumb_ratio'   => '',                          // Image's ratio for the slider
				'thumb_only'    => false,                       // Display only thumb (without post formats)
				'show_no_image' => false,                       // Display 'no-image.jpg' if post haven't thumbnail
				'seo'           => yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) ),
				'singular'      => is_singular(),               // Current page is singular (true) or blog/shortcode (false)
			), $args
		);

		if ( post_password_required() ) {
			return;
		}

		$thumb_size  = ! empty( $args['thumb_size'] )
						? $args['thumb_size']
						: yolox_get_thumb_size( is_attachment() || is_single() ? 'full' : 'big' );
		$post_format = str_replace( 'post-format-', '', get_post_format() );
		$no_image    = ! empty( $args['show_no_image'] ) ? yolox_get_no_image() : '';
		if ( $args['thumb_bg'] ) {
			if ( has_post_thumbnail() ) {
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
				$image = $image[0];
			} elseif ( 'image' == $post_format ) {
				$image = yolox_get_post_image();
				if ( ! empty( $image ) ) {
					$image = yolox_add_thumb_size( $image, $thumb_size );
				}
			}
			if ( empty( $image ) ) {
				$image = $no_image;
			}
			if ( ! empty( $image ) ) {
				$args['class'] .= ( $args['class'] ? ' ' : '' ) . 'post_featured_bg' . ' ' . yolox_add_inline_css_class( 'background-image: url(' . esc_url( $image ) . ');' );
			}
		}

		if ( $args['singular'] ) {

			if ( is_attachment() ) {
				?>
				<div class="post_featured post_attachment
				<?php
				if ( $args['class'] ) {
					echo ' ' . esc_attr( $args['class'] );
				}
				?>
				">
				<?php
				if ( ! $args['thumb_bg'] ) {
					echo wp_get_attachment_image(
						get_the_ID(), $thumb_size, false,
						yolox_is_on( yolox_get_theme_option( 'seo_snippets' ) )
													? array( 'itemprop' => 'image' )
						: ''
					);
				}
				if ( yolox_get_theme_setting( 'attachments_navigation' ) ) {
					?>
						<nav id="image-navigation" class="navigation image-navigation">
							<div class="nav-previous"><?php previous_image_link( false, '' ); ?></div>
							<div class="nav-next"><?php next_image_link( false, '' ); ?></div>
						</nav><!-- .image-navigation -->
						<?php
				}
				?>
				</div><!-- .post_featured -->
				<?php
				if ( has_excerpt() ) {
					?>
					<div class="entry-caption"><?php the_excerpt(); ?></div><!-- .entry-caption -->
					<?php
				}
			} elseif ( has_post_thumbnail() || ! empty( $args['show_no_image'] ) ) {
				echo '<div class="post_featured' . ( $args['class'] ? ' ' . esc_attr( $args['class'] ) : '' ) . '"'
					. ( $args['seo'] ? ' itemscope itemprop="image" itemtype="//schema.org/ImageObject"' : '')
					. '>';
				if ( has_post_thumbnail() && $args['seo'] ) {
					$yolox_attr = yolox_getimagesize( wp_get_attachment_url( get_post_thumbnail_id() ) );
					?>
						<meta itemprop="width" content="<?php echo esc_attr( $yolox_attr[0] ); ?>">
						<meta itemprop="height" content="<?php echo esc_attr( $yolox_attr[1] ); ?>">
						<?php
				}
				if ( ! $args['thumb_bg'] ) {
					if ( has_post_thumbnail() ) {
							the_post_thumbnail(
								$thumb_size, array(
																		'itemprop' => 'url',
								)
							);
					} elseif ( ! empty( $no_image ) ) {
						?>
						<img
							<?php
							if ( $args['seo'] ) {
								echo ' itemprop="url"';
							}
							?>
							src="<?php echo esc_url( $no_image ); ?>" alt="<?php the_title_attribute(); ?>">
						<?php
					}
				}
				echo '</div><!-- .post_featured -->';
			}
		} else {
			if ( empty( $post_format ) ) {
				$post_format = 'standard';
			}
			$has_thumb = has_post_thumbnail();
			$post_info = ! empty( $args['post_info'] ) ? $args['post_info'] : '';

			if ( $has_thumb	|| ! empty( $args['show_no_image'] )
				|| ( ! $args['thumb_only'] && in_array( $post_format, array( 'gallery', 'image', 'audio', 'video' ) ) ) ) {
				echo '<div class="post_featured '
					. ( ! empty( $has_thumb ) || 'image' == $post_format || ! empty( $args['show_no_image'] )
						? ( 'with_thumb' . ( $args['thumb_only']
												|| ! in_array( $post_format, array( 'audio', 'video', 'gallery' ) )
												|| ( 'gallery' == $post_format && ( $has_thumb || $args['thumb_bg'] ) )
													? ' hover_' . esc_attr( $args['hover'] )
													: ( in_array( $post_format, array( 'video' ) ) ? ' hover_play' : '' )
											)
							)
						: 'without_thumb' )
					. ( ! empty( $args['class'] ) ? ' ' . esc_attr( $args['class'] ) : '' )
					. '">';
				// Put the thumb or gallery or image or video from the post
				if ( $args['thumb_bg'] ) {
					if ( ! empty( $args['hover'] ) ) {
						?>
						<div class="mask"></div>
						<?php
					}
					if ( ! in_array( $post_format, array( 'audio', 'video', 'gallery' ) ) ) {
						yolox_hovers_add_icons(
							$args['hover'],
							array(
								'no_links' => $args['no_links'],
								'link'     => $args['link'],
							)
						);
					}
				} elseif ( $has_thumb ) {
					the_post_thumbnail(
						$thumb_size, array(
													)
					);
					if ( ! empty( $args['hover'] ) ) {
						?>
						<div class="mask"></div>
						<?php
					}
					if ( $args['thumb_only'] || ! in_array( $post_format, array( 'audio', 'video', 'gallery' ) ) ) {
						yolox_hovers_add_icons(
							$args['hover'],
							array(
								'no_links' => $args['no_links'],
								'link'     => $args['link'],
							)
						);
					}
				} elseif ( false && 'gallery' == $post_format && ! $args['thumb_only'] ) {
					//------- ^^ Start: Moved down --------
					$slider_args = array(
						'thumb_size' => $thumb_size,
						'controls'   => 'yes',
						'pagination' => 'yes',
					);
					if ( isset( $args['thumb_ratio'] ) ) {
						$slider_args['slides_ratio'] = $args['thumb_ratio'];
					}
					$output = yolox_get_slider_layout( $slider_args );
					if ( '' != $output ) {
						yolox_show_layout( $output );
					}
					//------- End: Moved down --------
				} elseif ( 'image' == $post_format ) {
					$image = yolox_get_post_image();
					if ( ! empty( $image ) ) {
						$image = yolox_add_thumb_size( $image, $thumb_size );
						?>
						<img src="<?php echo esc_url( $image ); ?>" alt="<?php the_title_attribute(); ?>">
						<?php
						if ( ! empty( $args['hover'] ) ) {
							?>
							<div class="mask"></div>
							<?php
						}
						yolox_hovers_add_icons(
							$args['hover'],
							array(
								'no_links' => $args['no_links'],
								'link'     => $args['link'],
								'image'    => $image,
							)
						);
					}
				} elseif ( ! empty( $args['show_no_image'] ) && ! empty( $no_image ) ) {
					?>
					<img src="<?php echo esc_url( $no_image ); ?>" alt="<?php the_title_attribute(); ?>">
					<?php
					if ( ! empty( $args['hover'] ) ) {
						?>
						<div class="mask"></div>
						<?php
					}
					yolox_hovers_add_icons(
						$args['hover'],
						array(
							'no_links' => $args['no_links'],
							'link'     => $args['link'],
						)
					);
				}
				// Add audio and video
				if ( ! $args['thumb_only'] && ( in_array( $post_format, array( 'video', 'audio', 'gallery' ) ) ) ) {
					$post_content = yolox_get_post_content();
					$post_content_parsed = $post_content;
					// Put video under the thumb
					if ( 'video' == $post_format ) {
						$video = yolox_get_post_video( $post_content, false );
						if ( empty( $video ) ) {
							$video = yolox_get_post_iframe( $post_content, false );
						}
						if ( empty( $video ) ) {
							// Only get video from the content if a playlist isn't present.
							$post_content_parsed = yolox_filter_post_content( $post_content );
							if ( false === strpos( $post_content_parsed, 'wp-playlist-script' ) ) {
								$videos = get_media_embedded_in_content( $post_content_parsed, array( 'video', 'object', 'embed', 'iframe' ) );
								if ( ! empty( $videos ) && is_array( $videos ) ) {
									$video = yolox_array_get_first( $videos, false );
								}
							}
						}
						if ( ! empty( $video ) ) {
							if ( $has_thumb ) {
								$video = yolox_make_video_autoplay( $video );
								?>
								<div class="post_video_hover" data-video="<?php echo esc_attr( $video ); ?>"></div>
								<?php
							}
							?>
							<div class="post_video video_frame">
								<?php
								if ( ! $has_thumb ) {
									yolox_show_layout( $video );
								}
								?>
							</div>
							<?php
						}
					} elseif ( 'audio' == $post_format ) {
						// Put audio over the thumb
						$audio = yolox_get_post_audio( $post_content, false );
						if ( empty( $audio ) ) {
							$audio = yolox_get_post_iframe( $post_content, false );
						}
						// Apply filters to get audio, title and author
						$post_content_parsed = yolox_filter_post_content( $post_content );
						if ( empty( $audio ) ) {
							// Only get audio from the content if a playlist isn't present.
							if ( false === strpos( $post_content_parsed, 'wp-playlist-script' ) ) {
								$audios = get_media_embedded_in_content( $post_content_parsed, array( 'audio' ) );
								if ( ! empty( $audios ) && is_array( $audios ) ) {
									$audio = yolox_array_get_first( $audios, false );
								}
							}
						}
						if ( ! empty( $audio ) ) {
							?>
							<div class="post_audio
								<?php
								if ( strpos( $audio, 'soundcloud' ) !== false ) {
									echo ' with_iframe';
								}
								?>
							">
								<?php
								// Get author and audio title
								$media = urldecode( yolox_get_tag_attrib( $post_content, '[trx_widget_audio]', 'media' ) );
								$media_author = '';
								$media_title  = '';
								if ( ! empty( $media ) ) {
									// Shortcode found in the content
								 	if ( '[{' == substr( $media, 0, 2 ) ) {
										$media = json_decode( $media, true );
										if ( is_array( $media ) ) {
											if ( !empty( $media[0]['author'] ) ) {
												$media_author = $media[0]['author'];
											}
											if ( !empty( $media[0]['caption'] ) ) {
												$media_title = $media[0]['caption'];
											}
										}
									}
								} else {
									// Parse tag params
									$media_author = strip_tags( yolox_get_tag( $post_content_parsed, '<h6 class="audio_author">', '</h6>' ) );
									$media_title  = strip_tags( yolox_get_tag( $post_content_parsed, '<h5 class="audio_caption">', '</h5>' ) );

								}
								if ( ! empty( $media_author ) ) {
									?>
									<div class="post_audio_author"><?php yolox_show_layout( $media_author ); ?></div>
									<?php
								}
								if ( ! empty( $media_title ) ) {
									?>
									<h5 class="post_audio_title"><?php yolox_show_layout( $media_title ); ?></h5>
									<?php
								}
								// Display audio
								yolox_show_layout( $audio );
								?>
							</div>
							<?php
						}
					} elseif ( 'gallery' == $post_format ) {
						$slider_args = array(
							'thumb_size' => $thumb_size,
							'controls'   => 'yes',
							'pagination' => 'yes',
						);
						if ( !empty( $args['thumb_ratio'] ) ) {
							$slider_args['slides_ratio'] = $args['thumb_ratio'];
						}
						$output = yolox_get_slider_layout( $slider_args );
						if ( '' != $output ) {
							yolox_show_layout( $output );
						}
					}
				}
				// Put optional info block over the thumb
				yolox_show_layout( $post_info );
				// Close div.post_featured
				echo '</div>';

			} else {
				// Put optional info block over the thumb
				yolox_show_layout( $post_info );
			}
		}
	}
}


// Return path to the 'no-image'
if ( ! function_exists( 'yolox_get_no_image' ) ) {
	function yolox_get_no_image( $no_image = '' ) {
		static $img = '';
		if ( empty( $img ) ) {
			$img = yolox_get_theme_option( 'no_image' );
			if ( empty( $img ) ) {
				$img = yolox_get_file_url( 'images/no-image.jpg' );
			}
		}
		if ( ! empty( $img ) ) {
			$no_image = $img;
		}
		return $no_image;
	}
}


// Add featured image as background image to post navigation elements.
if ( ! function_exists( 'yolox_add_bg_in_post_nav' ) ) {
	function yolox_add_bg_in_post_nav() {
		if ( ! is_single() ) {
			return;
		}

		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		$css      = '';
		$noimg    = yolox_get_no_image();

		if ( is_attachment() && 'attachment' == $previous->post_type ) {
			return;
		}

		if ( $previous ) {
			$img = '';
			if ( has_post_thumbnail( $previous->ID ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), yolox_get_thumb_size( 'med' ) );
				$img = $img[0];
			} elseif ( yolox_get_theme_setting( 'allow_no_image' ) ) {
				$img = $noimg;
			}
			if ( ! empty( $img ) ) {
				$css .= '.post-navigation .nav-previous a .nav-arrow ';
			} else {
				$css .= '.post-navigation .nav-previous a .nav-arrow '
					. '.post-navigation .nav-previous a .nav-arrow:after ';
			}
		}
		if ( $next ) {
			$img = '';
			if ( has_post_thumbnail( $next->ID ) ) {
				$img = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), yolox_get_thumb_size( 'med' ) );
				$img = $img[0];
			} elseif ( yolox_get_theme_setting( 'allow_no_image' ) ) {
				$img = $noimg;
			}
			if ( ! empty( $img ) ) {
				$css .= '.post-navigation .nav-next a .nav-arrow ';
			} else {
				$css .= '.post-navigation .nav-next a .nav-arrow '
					. '.post-navigation .nav-next a .nav-arrow:after ';
			}
		}

		wp_add_inline_style( 'yolox-main', $css );
	}
}

// Show related posts
if ( ! function_exists( 'yolox_show_related_posts' ) ) {
	function yolox_show_related_posts( $args = array(), $style = 1, $title = '' ) {
		$args = array_merge(
			array(
				//  Attention! Parameter 'suppress_filters' is damage WPML-queries!
				'ignore_sticky_posts' => true,
				'posts_per_page'      => 2,
				'columns'             => 0,
				'orderby'             => 'rand',
				'order'               => 'DESC',
				'post_type'           => '',
				'post_status'         => 'publish',
				'post__not_in'        => array(),
				'category__in'        => array(),
			), $args
		);

		if ( empty( $args['post_type'] ) ) {
			$args['post_type'] = get_post_type();
		}

		$taxonomy = 'post' == $args['post_type'] ? 'category' : yolox_get_post_type_taxonomy();

		$args['post__not_in'][] = get_the_ID();

		if ( empty( $args['columns'] ) ) {
			$args['columns'] = $args['posts_per_page'];
		}

		if ( empty( $args['category__in'] ) || is_array( $args['category__in'] ) && count( $args['category__in'] ) == 0 ) {
			$post_categories_ids = array();
			$post_cats           = get_the_terms( get_the_ID(), $taxonomy );
			if ( is_array( $post_cats ) && ! empty( $post_cats ) ) {
				foreach ( $post_cats as $cat ) {
					$post_categories_ids[] = $cat->term_id;
				}
			}
			$args['category__in'] = $post_categories_ids;
		}

		if ( 'post' != $args['post_type'] && count( $args['category__in'] ) > 0 ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_taxonomy_id',
					'terms'    => $args['category__in'],
				),
			);
			unset( $args['category__in'] );
		}

		$query = new WP_Query( $args );
		if ( $query->found_posts > 0 ) {
			$slider_args = array();
			$columns = intval( max( 1, min( 4, $args['columns'] ) ) );
			$args['slider'] = (int) yolox_get_theme_option( 'related_slider' ) && min( $args['posts_per_page'], $query->found_posts) > $columns;
			?>
			<section class="related_wrap">
				<h2 class="section_title related_wrap_title h2_cust"><?php
				if ( ! empty( $title ) ) {
					echo esc_html( $title );
				} else {
					esc_html_e( 'You May Also Like', 'yolox' );
				}
				?></h2><?php
				if ( $args['slider'] ) {
					$slider_args                      = $args;
					$slider_args['count']             = max(1, $query->found_posts);
					$slider_args['slides_min_width']  = 250;
					$slider_args['slides_space']      = yolox_get_theme_option( 'related_slider_space' );
					$slider_args['slider_controls']   = yolox_get_theme_option( 'related_slider_controls' );
					$slider_args['slider_pagination'] = yolox_get_theme_option( 'related_slider_pagination' );
					$slider_args                      = apply_filters( 'yolox_related_posts_slider_args', $slider_args, $query );
					?><div class="related_wrap_slider"><?php
					yolox_get_slider_wrap_start('related_posts_wrap', $slider_args);
				} else {
					?><div class="columns_wrap posts_container columns_padding_bottom"><?php
				}
					while ( $query->have_posts() ) {
						$query->the_post();
						if ($args['slider']) {
							?><div class="slider-slide swiper-slide"><?php
						} else {
							?><div class="column-1_<?php echo intval( max( 1, min( 4, $columns ) ) ); ?>"><?php
						}
						get_template_part( apply_filters( 'yolox_filter_get_template_part', 'templates/related-posts', $style ), $style );
						?></div><?php
					}
				?></div><?php						if ( $args['slider'] ) {
					yolox_get_slider_wrap_end('related_posts_wrap', $slider_args);
					?></div><!-- /.related_wrap_slider --><?php
				}
				wp_reset_postdata();
				?>
			</section><!-- </.related_wrap> -->
			<?php
		}
	}
}

// Callback for action 'Related posts'
if ( ! function_exists( 'yolox_show_related_posts_callback' ) ) {
	add_action( 'yolox_action_related_posts', 'yolox_show_related_posts_callback' );
	function yolox_show_related_posts_callback() {
		if ( is_single() && ! apply_filters( 'yolox_filter_show_related_posts', false ) ) {
			$yolox_related_posts    = (int) yolox_get_theme_option( 'related_posts' );
			if ( (int) yolox_get_theme_option( 'show_related_posts' ) && $yolox_related_posts > 0 ) {
				yolox_show_related_posts(
					array(
						'orderby'        => 'rand',
						'posts_per_page' => max( 1, min( 9, $yolox_related_posts ) ),
						'columns'        => max( 1, min( 4, yolox_get_theme_option( 'related_columns' ) ) ),
					),
					yolox_get_theme_option( 'related_style' )
				);
			}
		}
	}
}


// Show portfolio posts
if ( ! function_exists( 'yolox_show_portfolio_posts' ) ) {
	function yolox_show_portfolio_posts( $args = array() ) {
		$args = array_merge(
			array(
				'cat'        => 0,
				'parent_cat' => 0,
				'taxonomy'   => 'category',
				'post_type'  => 'post',
				'page'       => 1,
				'sticky'     => false,
				'blog_style' => '',
				'echo'       => true,
			), $args
		);

		$blog_style = explode( '_', empty( $args['blog_style'] ) ? yolox_get_theme_option( 'blog_style' ) : $args['blog_style'] );
		$style      = $blog_style[0];
		$columns    = empty( $blog_style[1] ) ? 2 : max( 2, $blog_style[1] );

		if ( ! $args['echo'] ) {
			ob_start();

			$q_args = array(
				'post_status' => current_user_can( 'read_private_pages' ) && current_user_can( 'read_private_posts' )
										? array( 'publish', 'private' )
										: 'publish',
			);
			$q_args = yolox_query_add_posts_and_cats( $q_args, '', $args['post_type'], $args['cat'], $args['taxonomy'] );
			if ( $args['page'] > 1 ) {
				$q_args['paged']               = $args['page'];
				$q_args['ignore_sticky_posts'] = true;
			}
			$ppp = yolox_get_theme_option( 'posts_per_page' );
			if ( 0 != (int) $ppp ) {
				$q_args['posts_per_page'] = (int) $ppp;
			}

			// Make a new query
			$q             = 'wp_query';
			$GLOBALS[ $q ] = new WP_Query( $q_args );
		}

		// Show posts
		$class = sprintf( 'masonry_wrap masonry_%1$d portfolio_wrap posts_container portfolio_%1$d', $columns )
				. ( 'portfolio' != $style ? sprintf( ' %1$s_wrap %1$s_%2$d', $style, $columns ) : '' );
		if ( $args['sticky'] ) {
			?>
			<div class="columns_wrap sticky_wrap">
			<?php
		} else {
			?>
			<div class="<?php echo esc_attr( $class ); ?>">
			<?php
		}

		while ( have_posts() ) {
			the_post();
			if ( $args['sticky'] && ! is_sticky() ) {
				$args['sticky'] = false;
				?>
				</div><div class="<?php echo esc_attr( $class ); ?>">
				<?php
			}
			$yolox_part = $args['sticky'] && is_sticky() ? 'sticky' : ( 'gallery' == $style ? 'portfolio-gallery' : $style );
			get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', $yolox_part ), $yolox_part );
		}

		?>
		</div>
		<?php

		yolox_show_pagination();

		if ( ! $args['echo'] ) {
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
}

// AJAX handler for the yolox_ajax_get_posts action
if ( ! function_exists( 'yolox_ajax_get_posts_callback' ) ) {
	add_action( 'wp_ajax_yolox_ajax_get_posts', 'yolox_ajax_get_posts_callback' );
	add_action( 'wp_ajax_nopriv_yolox_ajax_get_posts', 'yolox_ajax_get_posts_callback' );
	function yolox_ajax_get_posts_callback() {
		if ( ! wp_verify_nonce( yolox_get_value_gp( 'nonce' ), admin_url( 'admin-ajax.php' ) ) ) {
			wp_die();
		}

		$id = ! empty( $_REQUEST['blog_template'] ) ? wp_kses_data( wp_unslash( $_REQUEST['blog_template'] ) ) : 0;
		if ( (int) $id > 0 ) {
			yolox_storage_set( 'blog_archive', true );
			yolox_storage_set( 'blog_mode', 'blog' );
			yolox_storage_set( 'options_meta', get_post_meta( $id, 'yolox_options', true ) );
		}

		$response = array(
			'error' => '',
			'data'  => yolox_show_portfolio_posts(
				array(
					'cat'        => intval( wp_unslash( yolox_get_value_gpc('cat') ) ),
					'parent_cat' => intval( wp_unslash( yolox_get_value_gpc('parent_cat') ) ),
					'page'       => intval( wp_unslash( yolox_get_value_gpc('page') ) ),
					'post_type'  => trim( wp_unslash( yolox_get_value_gpc('post_type') ) ),
					'taxonomy'   => trim( wp_unslash( yolox_get_value_gpc('taxonomy') ) ),
					'blog_style' => trim( wp_unslash( yolox_get_value_gpc('blog_style') ) ),
					'echo'       => false,
				)
			),
		);

		if ( empty( $response['data'] ) ) {
			$response['error'] = esc_html__( 'Sorry, but nothing matched your search criteria.', 'yolox' );
		}
		echo json_encode( $response );
		wp_die();
	}
}


// Show pagination
if ( ! function_exists( 'yolox_show_pagination' ) ) {
	function yolox_show_pagination() {
		global $wp_query;
		// Pagination
		$pagination = yolox_get_theme_option( 'blog_pagination' );
		if ( 'pages' == $pagination ) {
			the_posts_pagination(
				array(
					'mid_size'           => 2,
					'prev_text'          => esc_html__( '<', 'yolox' ),
					'next_text'          => esc_html__( '>', 'yolox' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'yolox' ) . ' </span>',
				)
			);
		} elseif ( 'more' == $pagination || 'infinite' == $pagination ) {
			$page_number = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );
			if ( $page_number < $wp_query->max_num_pages ) {
				?>
				<div class="nav-links-more
					<?php
					if ( 'infinite' == $pagination ) {
						echo ' nav-links-infinite';}
					?>
				">
					<a class="nav-load-more" href="#" 
						data-page="<?php echo esc_attr( $page_number ); ?>" 
						data-max-page="<?php echo esc_attr( $wp_query->max_num_pages ); ?>"
						><span><?php esc_html_e( 'Load more', 'yolox' ); ?></span></a>
				</div>
				<?php
			}
		} elseif ( 'links' == $pagination ) {
			?>
			<div class="nav-links-old">
				<span class="nav-prev"><?php previous_posts_link( is_search() ? esc_html__( 'Previous posts', 'yolox' ) : esc_html__( 'Newest posts', 'yolox' ) ); ?></span>
				<span class="nav-next"><?php next_posts_link( is_search() ? esc_html__( 'Next posts', 'yolox' ) : esc_html__( 'Older posts', 'yolox' ), $wp_query->max_num_pages ); ?></span>
			</div>
			<?php
		}
	}
}



// Return template for the single field in the comments
if ( ! function_exists( 'yolox_single_comments_field' ) ) {
    function yolox_single_comments_field( $args ) {
        $path_height = 'path' == $args['form_style']
                            ? ( 'text' == $args['field_type'] ? 75 : 190 )
                            : 0;
        $html = '<div class="comments_field comments_' . esc_attr( $args['field_name'] ) . '">'
                    . ( 'default' == $args['form_style'] && 'checkbox' != $args['field_type']
                        ? '<label for="' . esc_attr( $args['field_name'] ) . '" class="' . esc_attr( $args['field_req'] ? 'required' : 'optional' ) . '">' . esc_html( $args['field_title'] ) . '</label>'
                        : ''
                        )
                    . '<span class="sc_form_field_wrap">';
        if ( 'text' == $args['field_type'] ) {
            $html .= '<input id="' . esc_attr( $args['field_name'] ) . '" name="' . esc_attr( $args['field_name'] ) . '" type="text"' . ( 'default' == $args['form_style'] ? ' placeholder="' . esc_attr( $args['field_placeholder'] ) . ( $args['field_req'] ? ' *' : '' ) . '"' : '' ) . ' value="' . esc_attr( $args['field_value'] ) . '"' . ( $args['field_req'] ? ' aria-required="true"' : '' ) . ' />';
        } elseif ( 'checkbox' == $args['field_type'] ) {
            $html .= '<input id="' . esc_attr( $args['field_name'] ) . '" name="' . esc_attr( $args['field_name'] ) . '" type="checkbox" value="' . esc_attr( $args['field_value'] ) . '"' . ( $args['field_req'] ? ' aria-required="true"' : '' ) . ' />'
                    . ' <label for="' . esc_attr( $args['field_name'] ) . '" class="' . esc_attr( $args['field_req'] ? 'required' : 'optional' ) . '">' . wp_kses_post( $args['field_title'] ) . '</label>';
        } else {
            $html .= '<textarea id="' . esc_attr( $args['field_name'] ) . '" name="' . esc_attr( $args['field_name'] ) . '"' . ( 'default' == $args['form_style'] ? ' placeholder="' . esc_attr( $args['field_placeholder'] ) . ( $args['field_req'] ? ' *' : '' ) . '"' : '' ) . ( $args['field_req'] ? ' aria-required="true"' : '' ) . '></textarea>';
        }
        if ( 'default' != $args['form_style'] ) {
            $html .= '<span class="sc_form_field_hover">'
                        . ( 'path' == $args['form_style']
                            ? '<svg class="sc_form_field_graphic" preserveAspectRatio="none" viewBox="0 0 520 ' . intval( $path_height ) . '" height="100%" width="100%"><path d="m0,0l520,0l0,' . intval( $path_height ) . 'l-520,0l0,-' . intval( $path_height ) . 'z"></svg>'
                            : ''
                            )
                        . ( 'iconed' == $args['form_style']
                            ? '<i class="sc_form_field_icon ' . esc_attr( $args['field_icon'] ) . '"></i>'
                            : ''
                            )
                        . '<span class="sc_form_field_content" data-content="' . esc_attr( $args['field_title'] ) . '">' . wp_kses_post( $args['field_title'] ) . '</span>'
                    . '</span>';
        }
        $html .= '</span></div>';
        return $html;
    }
}
