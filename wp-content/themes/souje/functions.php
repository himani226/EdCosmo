<?php

if ( !isset( $content_width ) ) {
	$content_width = 2560;
}

/* Include Customizer */
include( get_template_directory() . '/customizer.php' );
/* */

/* Load Widgets Filter */
if ( !function_exists( 'souje_load_widgets' ) ) {
	function souje_load_widgets() {

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'underscore' );

	}
}
add_action( 'load-widgets.php', 'souje_load_widgets' );
/* */

/* Google Fonts */
include( get_template_directory() . '/lib/google-fonts.php' );

if ( !function_exists( 'souje_fonts_url' ) ) {
	function souje_fonts_url() {

		$font_customizer_names = array();

		foreach ( souje_font_labels() as $key => $val ) {

			$add_underscore = str_replace( ' ', '_', $key );
			$font_customizer_names[ $add_underscore ] = $key . ':300,300i,400,400i,700,700i';

		}

		if ( !get_theme_mod( 'souje_logo_image' ) ) { $souje_font_logotype =  get_theme_mod( 'souje_font_logotype', 'Montserrat_Alternates' ); } else { $souje_font_logotype = ''; }

		$font_holders = array(
			get_theme_mod( 'souje_font_primary', 'Poppins' ),
			get_theme_mod( 'souje_font_secondary', 'PT_Serif' ),
			$souje_font_logotype
		);

		$font_families = array();

		foreach ( $font_customizer_names as $n => $g ) {
			foreach ( $font_holders as $fh ) {
				if( $n == $fh ) {
					if ( !in_array( $g, $font_families ) ) {
						$font_families[] = $g;
					}
				}
			}
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		return esc_url_raw( $fonts_url );

	}
}
/* */

/* Embed Resources */
if ( !function_exists( 'souje_embed_resources' ) ) {
	function souje_embed_resources() {

		/* Fonts */
		wp_enqueue_style( 'souje-fonts', souje_fonts_url(), array(), null );
		/* */

		wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array( 'souje-fonts' ) );
		wp_enqueue_style( 'souje-style', get_stylesheet_uri() );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( 'souje-style' ), '4.7.0', 'all' );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '', 'all' );
		wp_enqueue_style( 'souje-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '', 'all' );
		wp_enqueue_style( 'slicknav', get_template_directory_uri() . '/css/slicknav.css', array(), '', 'all' );

		wp_add_inline_style( 'slicknav', souje_rewrite_css() );

		/* */

		wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'souje-burnhambox', get_template_directory_uri() . '/js/burnhambox.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'slicknav', get_template_directory_uri() . '/js/jquery.slicknav.min.js', array( 'jquery' ), '', true );

		if ( is_page() && get_theme_mod( 'souje_map_page_id' ) == get_the_ID() ) {

			$map_api = get_theme_mod( 'souje_map_api', '' );
			if ( $map_api ) { $map_key = '?key=' . esc_attr( $map_api ); } else { $map_key = ''; }

			wp_enqueue_script( 'souje-google-maps-api', '//maps.googleapis.com/maps/api/js' . esc_attr( $map_key ), array(), '', false );
			wp_enqueue_script( 'souje-google-maps', get_template_directory_uri() . '/js/maps.js', array( 'jquery' ), '', true );

		}

	}
}
add_action( 'wp_enqueue_scripts', 'souje_embed_resources' );
/* */

/* Theme setup */
if ( !function_exists( 'souje_theme_setup' ) ) {
	function souje_theme_setup() {

		// Navigation Menu
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'souje' ),
		) );

		$souje_featured_image_width = get_theme_mod( 'souje_featured_image_width', 1140 );
		$souje_featured_image_height = get_theme_mod( 'souje_featured_image_height', 760 );
		$souje_thumbnail_image_width = get_theme_mod( 'souje_thumbnail_image_width', 600 );
		$souje_thumbnail_image_height = get_theme_mod( 'souje_thumbnail_image_height', 400 );
		$souje_slider_image_width = get_theme_mod( 'souje_slider_image_width', 1140 );
		$souje_slider_image_height = get_theme_mod( 'souje_slider_image_height', 570 );

		// Add featured image support. Works for only new added images.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( esc_attr( $souje_featured_image_width ), esc_attr( $souje_featured_image_height ), true ); // Featured Image
		add_image_size( 'souje-slider-image', esc_attr( $souje_slider_image_width ), esc_attr( $souje_slider_image_height ), array( 'center', 'top' ) ); // Slider Images
		add_image_size( 'souje-small-thumbnail-image', 150, 100, array( 'center', 'top' ) ); // Small Thumbnail Image
		add_image_size( 'souje-thumbnail-image', esc_attr( $souje_thumbnail_image_width ), esc_attr( $souje_thumbnail_image_height ), array( 'center', 'top' ) ); // Thumbnail Image

		// Add post type support
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'aside' ) );

		// Add automatic feed links support
		add_theme_support( 'automatic-feed-links' );

		// Add title-tag support
		add_theme_support( 'title-tag' );

		// Add text-domain
		load_theme_textdomain( 'souje', get_template_directory() . '/languages ');

		// Add WooCommerce support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add wide images support for Gutenberg
		add_theme_support( 'align-wide' );

	}
}
add_action( 'after_setup_theme', 'souje_theme_setup' );
/* */

/* Find all galleries and make them slider. */
if ( !function_exists( 'souje_check_gutenberg_gallery' ) ) {
	function souje_check_gutenberg_gallery() {

		global $post, $gutenberg_first_image;

		$image_list = '';

		$doc = new DOMDocument();
		libxml_use_internal_errors( true );
		$doc->loadHTML( $post->post_content );
		$xpath = new DOMXPath( $doc );

		$first = true;
		foreach ( $xpath->query('//li[@class="blocks-gallery-item"]/figure/img/@src') as $attr ) {

		  $src = $attr->value;

			if ( $first ) {
				$gutenberg_first_image = $src;
				$first = false;
			}

			$image_list .= '<img alt="theme-img-alt" src="' . esc_url( $src ) . '">';

		}

		if ( $image_list ) {

			$image_list = '<div class="owl-carousel">' . $image_list;
			$image_list .= '</div>';

		}

		return $image_list;

	}
}

if ( !function_exists( 'souje_gallery_to_slider' ) ) {
	function souje_gallery_to_slider( $content ) {

		global $post;

		if ( get_post_format() == 'gallery' ) {

			if ( !has_shortcode( $post->post_content, 'gallery' ) ) {

				if ( souje_check_gutenberg_gallery() ) {

					echo souje_check_gutenberg_gallery();

				} else {

					return $content;

				}

			} else {

				$galleries = get_post_galleries_images( $post );
				$image_list = '<div class="owl-carousel">';
				foreach( $galleries as $gallery ) {
					foreach( $gallery as $image_url ) {
						$image_list .= '<img alt="theme-img-alt" src="' . esc_url( $image_url ) . '">';
					}
				}
				$image_list .= '</div>';
				$content = $image_list;

			}

		}

		return $content;

	}
}
/* */

/* Get the first image of the post/gallery */
if ( !function_exists( 'souje_get_the_first_image' ) ) {
	function souje_get_the_first_image() {

		global $post;
		$first_img = '';

		$galleries = get_post_galleries_images( $post );

		if ( $galleries ) {

			foreach( $galleries as $gallery ) {
				$first_img = $gallery[0];
				break;
			}

		} else {

			$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
			if ( $output ) { $first_img = $matches[1][0]; }

		}

		return $first_img;

	}
}
/* */

/* Clear White Space */
if ( !function_exists( 'souje_compress' ) ) {
	function souje_compress( $buffer ) {

		$buffer = preg_replace( '~>\s+<~', '><', $buffer );
		return $buffer;

	}
}
/* */

/* Add responsive container to embeds for wordpress.tv */
if ( !function_exists( 'souje_embed_html' ) ) {
	function souje_embed_html( $html ) {

		$html = preg_replace(
			array(
				'{<embed src="//v.wordpress}',
				'{wmode="transparent">}'
			),
			array(
				'<div class="video-container"><embed src="//v.wordpress',
				'wmode="transparent"></div>'
			), $html
		);

		return $html;

	}
}
add_filter( 'embed_oembed_html', 'souje_embed_html', 10, 3 );
/* */

/* Content Filter */
if ( !function_exists( 'souje_filter_content' ) ) {
	function souje_filter_content( $content ) {

		// Add "to_fit_vids class" to iframes to make the videos responsive in posts
		// Convert self hosted videos to HTML5
		$content = preg_replace(
			array(
				'{<iframe}',
				'{</iframe>}',
				'/\[video(.+?(?=http))/',
				'/\]\[\/video]/',
			),
			array(
				'<div class="to_fit_vids"><iframe',
				'</iframe></div>',
				'<div class="to_fit_vids"><video controls><source src="',
				' type="video/mp4"></video></div>',
			),
			$content
		);

		return $content;

	}
}
add_filter( 'the_content', 'souje_filter_content' );
/* */

/* Find the first video of the post and display it instead of the featured image */
if ( !function_exists( 'souje_featured_video' ) ) {
	function souje_featured_video() {

		global $post;

		$result = '';
		ob_start();
		ob_end_clean();
		$output = preg_match( '/\[embed(.*)](.*)\[\/embed]/', $post->post_content, $matches );
		$output_gutenberg = preg_match( "'<figure class=\"(.*?)is-type-video(.*?)\">(.*?)</figure>'si", $post->post_content, $matches_gutenberg );

		if ( $output || $output_gutenberg ) {

			$result = '<div class="article-featured-video to_fit_vids">';

		}

		if ( $output ) {

			// Replace/remove/add necessary things for Vimeo and YouTube
			$result .= preg_replace( array( '/\[embed]/', '/\[\/embed]/', '{https://vimeo.com}', '{watch?.*?v=}', '/&#.*? /' ), array( '<iframe style="border: none;" src="', ' " width="500" height="281" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', '//player.vimeo.com/video', 'embed/', '?enablejsapi=1' ), esc_attr( $matches[0] ) );

		} else if ( $output_gutenberg ) {

			// Replace/remove/add necessary things for Vimeo and YouTube
			$result .= preg_replace( array( '/&lt;figure class=&quot;(.*?)is-type-video(.*?)&quot;&gt;/', '/&lt;div class=&quot;(.*?)wp-block-embed__wrapper(.*?)&quot;&gt;/', '/&lt;\/div&gt;/', '/&lt;\/figure&gt;/', '{https://vimeo.com}', '{watch?.*?v=}', '/&#.*? /' ), array( '<iframe style="border: none;" src="', '', '', ' " width="500" height="281" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>', '//player.vimeo.com/video', 'embed/', '?enablejsapi=1' ), esc_attr( $matches_gutenberg[0] ) );

		}

		if ( $output || $output_gutenberg ) {

			$result .= '</div>';

		}

		return $result;

	}
}
/* */

/* Remove the first video from the content */
if ( !function_exists( 'souje_remove_featured_video' ) ) {
	function souje_remove_featured_video() {

		$result = preg_replace( '/\<div class="to_fit_vids"(.*)\<\/div>/', '', souje_format_get_the_content(), 1 );
		return $result;

	}
}
/* */

/* Formatting the content like "the_content" while using "get_the_content" */
if ( !function_exists( 'souje_format_get_the_content' ) ) {
	function souje_format_get_the_content( $more_link_text = null, $stripteaser = false ) {

		$content = get_the_content( $more_link_text, $stripteaser );
		$content = apply_filters( 'the_content', $content );
		return $content;

	}
}
/* */

/* Combine Listing Styles */
if ( !function_exists( 'souje_call_post_order' ) ) {
	function souje_call_post_order() {

		//Call the post order in the loop
		global $souje_counter;
		return $souje_counter;

	}
}

if ( !function_exists( 'souje_check_style_z' ) ) {
	function souje_check_style_z() {

		$souje_postPerPage = get_option( 'posts_per_page' );

		if ( is_archive() ) {
			$souje_z_count = get_theme_mod( 'souje_z_count_archive', 0 );
		} else {
			$souje_z_count = get_theme_mod( 'souje_z_count', 0 );
		}

		if ( $souje_z_count > $souje_postPerPage ) {
			$souje_z_count = 0;
		}

		$souje_postOrder = souje_call_post_order();
		$souje_postOrder ++;
		$souje_styleZ_boo = false;

		if ( $souje_z_count == 0 || is_single() ) {
			$souje_styleZ_boo = false;
		} else {
			if ( $souje_postOrder > $souje_postPerPage - $souje_z_count ) {
				$souje_styleZ_boo = true;
			}
		}

		if ( is_search() ) {
			$souje_styleZ_boo = true;
		}

		return $souje_styleZ_boo;

	}
}
/* */

/* Set "Read More" button */
if ( !function_exists( 'souje_set_more_button' ) ) {
	function souje_set_more_button() {

		global $post;

		$souje_readMore_1 = '<a class="btnReadMore" href="';
		$souje_readMore_2 = esc_attr( souje_translation( '_ReadMore' ) ) . '<i class="fa fa-long-arrow-right"></i></a>';

		if ( get_theme_mod( 'souje_show_read_more', 1 ) && !is_single() ) {

			if( !strstr( $post->post_content, '<!--more-->' ) ) { return '...' . $souje_readMore_1 . esc_url( get_permalink() ) . '">' . $souje_readMore_2; }

		}

	}
}
add_filter( 'excerpt_more', 'souje_set_more_button' );
/* */

/* Append "Read More" button */
if ( !function_exists( 'souje_append_excerpt' ) ) {
	function souje_append_excerpt() {

		global $post;

		$souje_readMore_1 = '<a class="btnReadMore" href="';
		$souje_readMore_2 = esc_attr( souje_translation( '_ReadMore' ) ) . '<i class="fa fa-long-arrow-right"></i></a>';

		if ( get_theme_mod( 'souje_show_excerpt_indexed', 1 ) ) {

			echo '<div class="article-pure-content clearfix">';

			if( strstr( $post->post_content, '<!--more-->' ) ) {

				$excerpt = get_the_excerpt();

				if ( get_theme_mod( 'souje_show_read_more', 1 ) ) {

					echo wp_kses_post( $excerpt ) . $souje_readMore_1 . esc_url( get_permalink() ) . '">' . $souje_readMore_2 . '</div>';

				}

			} else {

				if ( $post->post_excerpt ) {

					$excerpt = get_the_excerpt();

					if ( get_theme_mod( 'souje_show_read_more', 1 ) ) {

						echo wp_kses_post( $excerpt ) . $souje_readMore_1 . esc_url( get_permalink() ) . '">' . $souje_readMore_2 . '</div>';

					} else {

						echo wp_kses_post( $excerpt ) . '</div>';

					}

				} else {

					echo get_the_excerpt();
					echo '</div>';

				}

			}

		}

	}
}
/* */

/* Apply layout options */
if ( !function_exists( 'souje_apply_layout' ) ) {
	function souje_apply_layout() {

		/* Radio Default Values */
		$souje_layout_style = get_theme_mod( 'souje_layout_style', '1col_sidebar' );
		$souje_layout_style_archive = get_theme_mod( 'souje_layout_style_archive', '1col_sidebar' );
		/* */

		$meta_sidebar = get_post_meta( get_the_ID(), 'souje-sidebar-meta-box-checkbox', true );
		$layout = '';

		if ( is_single() ) {

			if ( !is_attachment() ) {

				if ( ( get_post_format() == '' || get_post_format() == 'aside' ) && get_theme_mod( 'souje_show_sidebar_standard', 1 ) && !$meta_sidebar ) {

					// Show sidebar on standard posts
					$layout = '-sidebar';

				} else if ( get_post_format() == 'gallery' && get_theme_mod( 'souje_show_sidebar_gallery', 1 ) && !$meta_sidebar ) {

					// Show sidebar on gallery posts
					$layout = '-sidebar';

				} else if ( get_post_format() == 'video' && get_theme_mod( 'souje_show_sidebar_video', 1 ) && !$meta_sidebar ) {

					// Show sidebar on video posts
					$layout = '-sidebar';

				}

			}

		} else if ( is_category() || is_author() || is_tag() || is_archive() || is_search() ) {

			if ( $souje_layout_style_archive == '1col' ) {

				// No sidebar
				$layout = '';

			} else if ( $souje_layout_style_archive == '2col' ) {

				// 2 columns //-c(olumn)c(ount)2
				$layout = '-cc2';

			} else if ( $souje_layout_style_archive == '3col' || $souje_layout_style_archive == '2_3col' ) {

				// 3 columns //-c(olumn)c(ount)3
				$layout = '-cc3';

			} else if ( $souje_layout_style_archive == '1col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar';

			} else if ( $souje_layout_style_archive == '2col_sidebar' || $souje_layout_style_archive == '1_2col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar-cc2';

			}

		} else if ( is_page() ) {

			if ( is_front_page() ) {

				if ( get_theme_mod( 'souje_show_sidebar_static', 1 ) && !$meta_sidebar ) {

					// Show sidebar on inner pages
					$layout = '-sidebar';

				}

			} else {

				if ( get_theme_mod( 'souje_show_sidebar_page', 1 ) && !$meta_sidebar ) {

					// Show sidebar on inner pages
					$layout = '-sidebar';

				}

			}

			if ( function_exists( 'WC' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {
					// Hide sidebar on inner pages
					$layout = '';
			}

		} else if ( is_404() ) {

			$layout = '';

		} else {

			if ( $souje_layout_style == '1col' ) {

				// No sidebar
				$layout = '';

			} else if ( $souje_layout_style == '2col' ) {

				// 2 columns //-c(olumn)c(ount)2
				$layout = '-cc2';

			} else if ( $souje_layout_style == '3col' || $souje_layout_style == '2_3col' ) {

				// 3 columns //-c(olumn)c(ount)3
				$layout = '-cc3';

			} else if ( $souje_layout_style == '1col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar';

			} else if ( $souje_layout_style == '2col_sidebar' || $souje_layout_style == '1_2col_sidebar' ) {

				// Columns + Sidebar
				$layout = '-sidebar-cc2';

			}

		}

		return $layout;

	}
}
/* */

/* Apply column options */
if ( !function_exists( 'souje_apply_columns' ) ) {
	function souje_apply_columns() {

		/* Radio Default Values */
		$souje_layout_style = get_theme_mod( 'souje_layout_style', '1col_sidebar' );
		$souje_layout_style_archive = get_theme_mod( 'souje_layout_style_archive', '1col_sidebar' );
		/* */

		$column = '';

		if ( is_category() || is_author() || is_tag() || is_archive() || is_search() ) {

			if ( $souje_layout_style_archive == '1col' ) {

				// No sidebar
				$column = '';

			} else if ( $souje_layout_style_archive == '2col' ) {

				// 2 Columns (No sidebar)
				$column = 'col-1-2';

			} else if ( $souje_layout_style_archive == '3col' || $souje_layout_style_archive == '2_3col' ) {

				// 3 Columns (No sidebar)
				$column = 'col-1-3';

			} else if ( $souje_layout_style_archive == '1col_sidebar' ) {

				// 1 Column + Sidebar
				$column = '';

			} else if ( $souje_layout_style_archive == '2col_sidebar' || $souje_layout_style_archive == '1_2col_sidebar' ) {

				// 2 Columns + Sidebar
				$column = 'col-1-2-sidebar';

			}

		} else {

			if ( $souje_layout_style == '1col' ) {

				// No sidebar
				$column = '';

			} else if ( $souje_layout_style == '2col' ) {

				// 2 Columns (No sidebar)
				$column = 'col-1-2';

			} else if ( $souje_layout_style == '3col' || $souje_layout_style == '2_3col' ) {

				// 3 Columns (No sidebar)
				$column = 'col-1-3';

			} else if ( $souje_layout_style == '1col_sidebar' ) {

				// 1 Column + Sidebar
				$column = '';

			} else if ( $souje_layout_style == '2col_sidebar' || $souje_layout_style == '1_2col_sidebar' ) {

				// 2 Columns + Sidebar
				$column = 'col-1-2-sidebar';

			}

		}

		return $column;

	}
}
/* */

/* Pagination */
if ( !function_exists( 'souje_page_navigation' ) ) {
	function souje_page_navigation() {

		global $wp_query, $indexPosts;

		$souje_big = 999999999; // need an unlikely integer

		if ( get_theme_mod( 'souje_slider_exclude_posts', 0 ) ) {

			if ( is_home() ) {

				$souje_current_query_mnp = $indexPosts->max_num_pages;

			} else {

				$souje_current_query_mnp = $wp_query->max_num_pages;

			}

		} else {

			$souje_current_query_mnp = $wp_query->max_num_pages;

		}

		$souje_paginate_links = paginate_links( array(

			'base' => str_replace( $souje_big, '%#%', esc_url( get_pagenum_link( $souje_big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var( 'paged' ) ),
			'total' => $souje_current_query_mnp,
			'prev_text' => '<i class="fa fa-chevron-left"></i>' . esc_attr( souje_translation( '_Newer' ) ),
			'next_text' => esc_attr( souje_translation( '_Older' ) ) . '<i class="fa fa-chevron-right"></i>',
			'end_size' => 1,
			'mid_size' => 1

		) );

		if ( $souje_paginate_links ) {

			echo '<div class="pagenavi clearfix';

			if ( get_query_var( 'paged' ) <= 1 ) {

				echo ' pagenavi-fp';

			} else if ( get_query_var( 'paged' ) == $souje_current_query_mnp ) {

				echo ' pagenavi-lp';

			} else {

				echo ' pagenavi-cp';

			}

			echo '">';
			echo wp_kses_post( $souje_paginate_links );
			echo '</div>';

		}

	}
}

if ( !function_exists( 'souje_post_navigation' ) ) {
	function souje_post_navigation( $direction, $posting, $term ) {

		$post_navigation = '';

		if( $posting ) {

			$post_navigation .= '<a class="post-navi-' . esc_attr( $direction ) . ' clearfix" href="' . get_permalink( $posting->ID ) . '">' .
									'<div class="post-navi-inner">';
										if ( has_post_thumbnail( $posting->ID ) ) { $post_navigation .= get_the_post_thumbnail( $posting->ID, 'souje-small-thumbnail-image' ); }
										$post_navigation .= '<div class="post-navi-' . esc_attr( $direction ) . '-info">' .
											'<div class="table-cell-middle">' .
												'<div class="post-navi-label">' . esc_attr( $term ) . '</div>' .
												'<div class="post-navi-title">' . get_the_title( $posting->ID ) . '</div>' .
											'</div>' .
										'</div>' .
									'</div>' .
								'</a>';

		}

		return $post_navigation;

	}
}
/* */

/* Social Icons */
if ( !function_exists( 'souje_social_labels' ) ) {
	function souje_social_labels() {

		$labels = array(
			esc_html__( 'Facebook', 'souje' ),
			esc_html__( 'Twitter', 'souje' ),
			esc_html__( 'Instagram', 'souje' ),
			esc_html__( 'Pinterest', 'souje' ),
			esc_html__( 'Google+', 'souje' ),
			esc_html__( 'Tumblr', 'souje' ),
			esc_html__( 'Flickr', 'souje' ),
			esc_html__( 'Digg', 'souje' ),
			esc_html__( 'LinkedIn', 'souje' ),
			esc_html__( 'Vimeo', 'souje' ),
			esc_html__( 'YouTube', 'souje' ),
			esc_html__( 'Behance', 'souje' ),
			esc_html__( 'Dribbble', 'souje' ),
			esc_html__( 'DeviantArt', 'souje' ),
			esc_html__( 'Github', 'souje' ),
			esc_html__( 'Bloglovin', 'souje' ),
			esc_html__( 'Lastfm', 'souje' ),
			esc_html__( 'SoundCloud', 'souje' ),
			esc_html__( 'VK', 'souje' )
		);

		return $labels;

	}
}

if ( !function_exists( 'souje_social_icons' ) ) {
	function souje_social_icons() {

		$icons = array(
			'fa-facebook',
			'fa-twitter',
			'fa-instagram',
			'fa-pinterest-p',
			'fa-google-plus',
			'fa-tumblr',
			'fa-flickr',
			'fa-digg',
			'fa-linkedin',
			'fa-vimeo',
			'fa-youtube',
			'fa-behance',
			'fa-dribbble',
			'fa-deviantart',
			'fa-github',
			'fa-heart',
			'fa-lastfm',
			'fa-soundcloud',
			'fa-vk'
		);

		return $icons;

	}
}

if ( !function_exists( 'souje_social_names' ) ) {
	function souje_social_names() {

		$account_names = array(
			'facebook',
			'twitter',
			'instagram',
			'pinterest',
			'google',
			'tumblr',
			'flickr',
			'digg',
			'linkedin',
			'vimeo',
			'youtube',
			'behance',
			'dribbble',
			'deviantart',
			'github',
			'bloglovin',
			'lastfm',
			'soundcloud',
			'vk'
		);

		return $account_names;

	}
}

if ( !function_exists( 'souje_insert_social_icons' ) ) {
	function souje_insert_social_icons( $location ) {

		$souje_social_accounts = array();

		foreach ( souje_social_labels() as $val ) {

			array_push( $souje_social_accounts, get_theme_mod( 'souje_social_' . esc_attr( $val ) ) );

		}

		$souje_social_faIcons = souje_social_icons();
		global $souje_social_show;
		$souje_social_show = false;
		$souje_social_html = '<div class="' . esc_attr( $location ) . '">';

		foreach ( $souje_social_accounts as $key => $sa ) {

			if ( $sa != 'http://' && $sa != '' ) {

				$souje_social_show = true;
				$souje_social_html .= '<a class="social-menu-item" href="' . esc_url( $sa ) . '" target="_blank"><i class="fa ' . esc_attr( $souje_social_faIcons[ $key ] ) . '"></i></a>';

			}

		}

		$souje_social_html .= '</div>';

		if ( $location == 'footer-social' && ( !$souje_social_show || !get_theme_mod( 'souje_show_footer_social', 1 ) ) ) {

			if ( get_theme_mod( 'souje_show_to_top', 1 ) && get_theme_mod( 'souje_copyright_text', '2019 Souje. All rights reserved.' ) ) {

				$souje_social_html = '<div class="' . esc_attr( $location ) . '"><a href="javascript:void(0);" class="btn-to-top"><i class="fa fa-chevron-up"></i></a></div>';

			} else {

				$souje_social_html = '<div class="' . esc_attr( $location ) . ' fs10"></div>';

			}

		}

		return $souje_social_html;

	}
}
/* */

/* Place Slider */
if ( !function_exists( 'souje_insert_slider' ) ) {
	function souje_insert_slider() {

		$sliderShortcode = get_theme_mod( 'souje_slider_shortcode', '' );

		if ( $sliderShortcode ) {

			if ( is_home() ) {

				if ( get_theme_mod( 'souje_slider_during_pagination', 0 ) ) {

					echo do_shortcode( esc_attr( $sliderShortcode ) );

				} else if ( get_query_var( 'paged' ) <= 1 ) {

					echo do_shortcode( esc_attr( $sliderShortcode ) );

				}

			}

			if ( is_archive() && get_theme_mod( 'souje_slider_archive', 0 ) ) {

				echo do_shortcode( esc_attr( $sliderShortcode ) );

			}

			if ( is_single() && get_theme_mod( 'souje_slider_post', 0 ) ) {

				echo do_shortcode( esc_attr( $sliderShortcode ) );

			}

		}

	}
}
/* */

/* "Show Blog Posts" Feature for Slider */
if ( !function_exists( 'souje_posts_to_slider' ) ) {
	function souje_posts_to_slider() {

		$showposts = get_theme_mod( 'souje_slider_posts_number', 5 );
		$category = get_theme_mod( 'souje_slider_categories', '' );

		if ( $category ) {

			$loop_args = array(

				'showposts' => $showposts,
				'category_name' => $category,
				'ignore_sticky_posts' => 1

			);

		} else {

			$loop_args = array(

				'showposts' => $showposts,
				'ignore_sticky_posts' => 1

			);

		}

		$wp_query = new WP_Query( $loop_args );
		$slides = array();

		if ( $wp_query->have_posts() ) {

			while ( $wp_query->have_posts() ) {

				$wp_query->the_post();
				$slide_image = '<div class="null_slide_image"></div>';
				$slide_image_thumbnail = '<img alt="theme-img-alt" class="null_slide_image_thumbnail">';
				$slide_image_path = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'souje-slider-image' );
				$slide_image_thumbnail_path = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'souje-thumbnail-image' );

				if ( $slide_image_path ) {

					$slide_image = '<img class="slide-image" alt="theme-img-alt" src="' . esc_url( $slide_image_path[0] ) . '">';
					$slide_image_thumbnail = '<img alt="theme-img-alt" src="' . esc_url( $slide_image_thumbnail_path[0] ) . '">';

				}

				$slides[] = '<a href="' . esc_url( get_the_permalink() ) . '">' . $slide_image . '<div class="slide-lens"></div><div class="slide-thumbnail-container clearfix">' . $slide_image_thumbnail . '<div class="slide-thumbnail-inner fading"><div class="table-cell-middle"><div class="slide-title">' . get_the_title() . '</div></div></div></div></a>';

			}

		}

		wp_reset_postdata();

		$bpts = '<div class="souje-slider-container"><div class="owl-carousel">' . implode( '', $slides ) . '</div></div>';

		if ( get_theme_mod( 'souje_slider_posts', 0 ) ) {

			if ( is_home() ) {

				if ( get_theme_mod( 'souje_slider_during_pagination', 0 ) ) {

					echo wp_kses_post( $bpts );

				} else if ( get_query_var( 'paged' ) <= 1 ) {

					echo wp_kses_post( $bpts );

				}

			}

			if ( is_archive() && get_theme_mod( 'souje_slider_archive', 0 ) ) {

				echo wp_kses_post( $bpts );

			}

			if ( is_single() && get_theme_mod( 'souje_slider_post', 0 ) ) {

				echo wp_kses_post( $bpts );

			}

		}

	}
}
/* */

/* Exclude posts used in the slider */
if ( !function_exists( 'souje_exclude_posts_from_slider' ) ) {
	function souje_exclude_posts_from_slider() {

		$excludePostIDs = array();

		if ( get_theme_mod( 'souje_slider_posts', 0 ) ) {

			$showposts = get_theme_mod( 'souje_slider_posts_number', 5 );
			$category = get_theme_mod( 'souje_slider_categories', '' );

			if ( $category ) {

				$loop_args = array(

					'showposts' => $showposts,
					'category_name' => $category,
					'ignore_sticky_posts' => 1

				);

			} else {

				$loop_args = array(

					'showposts' => $showposts,
					'ignore_sticky_posts' => 1

				);

			}

			$wp_query = new WP_Query( $loop_args );

			if ( $wp_query->have_posts() ) {

				while ( $wp_query->have_posts() ) {

					$wp_query->the_post();
					array_push( $excludePostIDs, get_the_ID() );

				}

			}

			wp_reset_postdata();

		} else {

			$loop_args = array(

					'post_type' => 'slider',
					'ignore_sticky_posts' => 1

				);

			$wp_query = new WP_Query( $loop_args );

			if ( $wp_query->have_posts() ) {

				while ( $wp_query->have_posts() ) {

					$wp_query->the_post();
					array_push( $excludePostIDs, get_post_meta( get_the_ID(), 'souje-slide-to-post', true ) );

				}

			}

			wp_reset_postdata();

		}

		return $excludePostIDs;

	}
}
/* */

if ( !function_exists( 'souje_widgets_init' ) ) {
	function souje_widgets_init() {

		$fw_col_number = '';

		if ( get_theme_mod( 'souje_footer_widgets_column', '3col' ) == '2col' ) {

			$fw_col_number = '-col2';

		} else if ( get_theme_mod( 'souje_footer_widgets_column', '3col' ) == '4col' ) {

			$fw_col_number = '-col4';

		}

		$souje_widget_before_widget = '<div id="%1$s" class="widget-item clearfix %2$s">';
		$souje_widget_before_title = '<h2>';
		$souje_widget_after_title = '</h2>';
		$souje_widget_after_widget = '</div>';

		// Add Widget Areas
		register_sidebar( array(
			'name' => esc_html__( 'Sidebar - Default', 'souje' ),
			'id' => 'souje_sidebar_home',
			'before_widget' => $souje_widget_before_widget,
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Sidebar - Post', 'souje' ),
			'id' => 'souje_sidebar_post',
			'before_widget' => $souje_widget_before_widget,
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Sidebar - Page', 'souje' ),
			'id' => 'souje_sidebar_page',
			'before_widget' => $souje_widget_before_widget,
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Sidebar - Static Front Page', 'souje' ),
			'id' => 'souje_sidebar_static',
			'before_widget' => $souje_widget_before_widget,
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Sidebar - Archive', 'souje' ),
			'id' => 'souje_sidebar_archive',
			'before_widget' => $souje_widget_before_widget,
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Sidebar - WooCommerce', 'souje' ),
			'id' => 'souje_sidebar_woo',
			'before_widget' => $souje_widget_before_widget,
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

		register_sidebar( array(
			'name' => esc_html__( 'Footer Widgets', 'souje' ),
			'id' => 'souje_footer_widgets',
			'before_widget' => '<div id="%1$s" class="widget-item-footer fw-columns' . esc_attr( $fw_col_number ) . ' clearfix %2$s">',
			'before_title' => $souje_widget_before_title,
			'after_title' => $souje_widget_after_title,
			'after_widget' => $souje_widget_after_widget,
		) );

	}
}
add_action( 'widgets_init', 'souje_widgets_init' );

/* HEX to RGB */
if ( !function_exists( 'souje_hex2rgb' ) ) {
	function souje_hex2rgb( $hex ) {

		$hex = str_replace( '#', '', $hex );

		if ( strlen( $hex ) == 3 ) {

			$r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1).substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1).substr( $hex, 2, 1 ) );

		} else {

			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );

		}

		$rgb = array( $r, $g, $b );
		return implode( ',', $rgb );

	}
}
/* */

/* Nothing Found */
if ( !function_exists( 'souje_nothing_found' ) ) {
	function souje_nothing_found() {

		$template = '<div class="nothing-found"><i class="fa fa-ban"></i>' . esc_attr( souje_translation( '_NothingFound' ) ) . '</div>';
		return $template;

	}
}
/* */

/* Translation */
if ( !function_exists( 'souje_get_terms' ) ) {
	function souje_get_terms() {

		$terms = array(
			'_Language' => get_bloginfo( 'language' ),
			'_ReadMore' => esc_html__( 'Read More', 'souje' ),
			'_Older' => esc_html__( 'OLDER', 'souje' ),
			'_Newer' => esc_html__( 'NEWER', 'souje' ),
			'_PrevPost' => esc_html__( 'Previous Post', 'souje' ),
			'_NextPost' => esc_html__( 'Next Post', 'souje' ),
			'_Keyword' => esc_html__( 'Type keyword to search', 'souje' ),
			'_Sticky' => esc_html__( 'Sticky', 'souje' ),
			'_AllByAuthor' => esc_html__( 'View All Posts by Author', 'souje' ),
			'_AuthorWebsite' => esc_html__( 'Visit Author Website', 'souje' ),
			'_By' => esc_html__( 'by', 'souje' ),
			'_RelatedPosts' => esc_html__( 'Related Posts', 'souje' ),
			'_Page' => esc_html__( 'Page', 'souje' ),
			'_404' => esc_html__( 'PAGE NOT FOUND.', 'souje' ),
			'_404Warning' => esc_html__( 'The page you are looking for has been either removed or never existed.', 'souje' ),
			'_NothingFound' => esc_html__( 'NOTHING FOUND.', 'souje' ),
			'_SearchResults' => esc_html__( 'Search Results', 'souje' ),
			'_Tag' => esc_html__( 'Tag', 'souje' ),
			'_Category' => esc_html__( 'Category', 'souje' ),
			'_Author' => esc_html__( 'Author', 'souje' ),
			'_Archives' => esc_html__( 'Archives', 'souje' ),
			'_Comment' => esc_html__( 'Comment', 'souje' ),
			'_Comments' => esc_html__( 'Comments', 'souje' ),
			'_Name' => esc_html__( 'Name', 'souje' ),
			'_Email' => esc_html__( 'E-mail', 'souje' ),
			'_MustBeLogged' => esc_html__( 'You must be logged in to post a comment.', 'souje' ),
			'_LoginToReply' => esc_html__( 'Log in to Reply', 'souje' ),
			'_Logged' => esc_html__( 'Logged In', 'souje' ),
			'_LogOut' => esc_html__( 'Log Out', 'souje' ),
			'_LeaveReply' => esc_html__( 'Leave a Reply', 'souje' ),
			'_CancelReply' => esc_html__( 'Cancel Reply', 'souje' ),
			'_PostComment' => esc_html__( 'Post Comment', 'souje' ),
			'_At' => esc_html__( 'at', 'souje' ),
			'_Reply' => esc_html__( 'Reply', 'souje' ),
			'_Edit' => esc_html__( 'Edit', 'souje' ),
			'_Awaiting' => esc_html__( 'Comment awaiting approval.', 'souje' ),
		);

		return $terms;

	}
}

if ( !function_exists( 'souje_translation' ) ) {
	function souje_translation( $term ) {

		$the_term = 'souje_translate' . esc_attr( $term );

		foreach ( souje_get_terms() as $key => $val ) {
			if ( $key == $term ) {
				if ( get_theme_mod( 'souje_ignore_pot', 1 ) ) {
					$$the_term = get_theme_mod( $the_term, $val );
				} else {
					$$the_term = esc_attr( $val );
				}
				break;
			}
		}

		return $$the_term;

	}
}
/* */

/* Customize Default Tag Cloud Widget */
if ( !function_exists( 'souje_tag_cloud_args' ) ) {
	function souje_tag_cloud_args( $args ) {

		$args['format'] = 'flat';
		$args['separator'] = ', ';
		return $args;

	}
}
add_filter( 'widget_tag_cloud_args', 'souje_tag_cloud_args' );
/* */

/* Footer Widgets Outer */
if ( !function_exists( 'souje_footer_widgets_outer' ) ) {
	function souje_footer_widgets_outer( $id ) {

		$fw_class = '';

		if ( $id == 'souje_footer_widgets' ) {

			$fw_col_number = '';
			if ( get_theme_mod( 'souje_footer_widgets_column', '3col' ) == '2col' ) { $fw_col_number = '-col2'; } else if ( get_theme_mod( 'souje_footer_widgets_column', '3col' ) == '4col' ) { $fw_col_number = '-col4'; }
			$fw_class = 'widget-item-footer fw-columns' . esc_attr( $fw_col_number ) . ' ';

		}

		echo esc_attr( $fw_class );

	}
}
/* */

/* Sidebars */
if ( !function_exists( 'souje_insert_sidebar' ) ) {
	function souje_insert_sidebar( $where ) {

		echo '<div class="sidebar sidebar-' . esc_attr( $where ) . ' clearfix">';
		dynamic_sidebar( 'souje_sidebar_' . esc_attr( $where ) );
		echo '</div>';

	}
}
/* */

/* Author Box */
if ( !function_exists( 'souje_author_box' ) ) {
	function souje_author_box() {

		if ( get_theme_mod( 'souje_show_author_box', 1 ) ) {

			global $post;

			if ( is_single() && isset( $post->post_author ) ) {

				$user_description = get_the_author_meta( 'user_description', $post->post_author );

				if ( $user_description ) {

					$display_name = get_the_author_meta( 'display_name', $post->post_author );

					if ( !$display_name ) {
						$display_name = get_the_author_meta( 'nickname', $post->post_author );
					}

					$user_website = get_the_author_meta( 'url', $post->post_author );
					$user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author ) );

					$author_details = get_avatar( get_the_author_meta( 'user_email' ) , 40 ) . '<div class="author-box-name clearfix">' . esc_html( $display_name ) . '</div>';

					$author_details .= '<p>' . wp_kses_post( $user_description ) . '</p>';
					$author_details .= '<div class="author-box-links"><a href="'. esc_url( $user_posts ) .'">' . esc_attr( souje_translation( '_AllByAuthor' ) ) . '</a>';

					if ( $user_website ) {
						$author_details .= '<a href="' . esc_url( $user_website ) .'" target="_blank" rel="nofollow">' . esc_attr( souje_translation( '_AuthorWebsite' ) ) . '</a>';
					}

					$author_details .= '</div>';

					$content = '<div class="author-box clearfix"><div class="author-box-inner' . souje_apply_layout() . '">' . wp_kses_post( $author_details ) . '</div></div>';

					return $content;

				}

			}

		}

	}
}

/* Assign Menu Warnings */
function souje_assign_primary_menu() {
	echo '<div class="assign-menu">' . esc_html__( 'Please assign a Primary Menu.', 'souje' ) . '</div>';
}
/* */

/* WooCommerce - Related Products Count */
if ( !function_exists( 'souje_related_products_args' ) ) {
	function souje_related_products_args( $args ) {

		$args['posts_per_page'] = 2;
		$args['columns'] = 2;
		return $args;

	}
}
add_filter( 'woocommerce_output_related_products_args', 'souje_related_products_args' );
/* */

/* WooCommerce - Change number of products displayed per page */
if ( !function_exists( 'souje_set_products_per_page' ) ) {
	function souje_set_products_per_page() {

		$product_count = esc_attr( get_theme_mod( 'souje_product_per_page', '10' ) );
		return $product_count;

	}
}
add_filter( 'loop_shop_per_page', 'souje_set_products_per_page', 20 );
/* */

/* WooCommerce - Change number or products per row */
if ( !function_exists( 'souje_loop_columns' ) ) {
	function souje_loop_columns() {

		$layout = get_theme_mod( 'souje_woo_layout', '2col_sidebar' );
		if ( $layout == '2col' || $layout == '2col_sidebar' ) { return 2; } else if ( $layout == '3col' ) { return 3; }

	}
}
add_filter( 'loop_shop_columns', 'souje_loop_columns' );
/* */

/* Enqueue Gutenberg editor styles */
if ( !function_exists( 'souje_gutenberg_styles' ) ) {
	function souje_gutenberg_styles() {

		wp_enqueue_style( 'souje-fonts', souje_fonts_url(), array(), null );
		wp_enqueue_style( 'souje-gutenberg', get_template_directory_uri() . '/css/gutenberg-editor.css', false, '@@pkg.version', 'all' );
		wp_add_inline_style( 'souje-gutenberg', souje_rewrite_gutenberg_editor_css() );

	}
}
add_action( 'enqueue_block_editor_assets', 'souje_gutenberg_styles' );
/* */

/* Include the TGM_Plugin_Activation class. */
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

if ( !function_exists( 'souje_register_plugins' ) ) {
	function souje_register_plugins() {

		$plugins = array(

			/*
			Contact Form 7
			Instagram Feed
			Regenerate Thumbnails
			Reveal IDs
			Q2W3 Fixed Widget
			Souje Components
			Souje Slider
			Widget Importer & Exporter
			*/

			array(
				'name' => 'Widget Importer & Exporter',
				'slug' => 'widget-importer-exporter',
				'required' => false
			),

			array(
				'name' => 'Contact Form 7',
				'slug' => 'contact-form-7',
				'required' => false
			),

			array(
				'name' => 'Instagram Feed',
				'slug' => 'instagram-feed',
				'required' => false
			),

			array(
				'name' => 'Regenerate Thumbnails',
				'slug' => 'regenerate-thumbnails',
				'required' => false
			),

			array(
				'name' => 'Reveal IDs',
				'slug' => 'reveal-ids-for-wp-admin-25',
				'required' => false
			),

			array(
				'name' => 'Q2W3 Fixed Widget',
				'slug' => 'q2w3-fixed-widget',
				'required' => false
			),

			array(
				'name' => 'Souje Components',
				'slug' => 'souje-components',
				'source' => get_template_directory() . '/lib/plugins/souje-components.zip',
				'required' => false,
			),

			array(
				'name' => 'Souje Slider',
				'slug' => 'souje-slider',
				'source' => get_template_directory() . '/lib/plugins/souje-slider.zip',
				'required' => false,
			),

		);

		$config = array(
			'id'           => 'souje',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',

		);

		tgmpa( $plugins, $config );

	}
}
add_action( 'tgmpa_register', 'souje_register_plugins' );
/* */

/* Colors */
if ( !function_exists( 'souje_get_colors' ) ) {
	function souje_get_colors() {

		$colors = array(
			'_background' => '#e9e9e9',
			'_assistant_one' => '#e781a5',
			'_assistant_two' => '#FFF',
			'_assistant_three' => '#000',
			'_logo_text' => '#FFF',
			'_logo_background' => '#5f406d',
			'_menu_background' => '#000',
			'_menu_link' => '#FFF',
			'_menu_link_hover' => '#e781a5',
			'_slider_primary' => '#000',
			'_slider_secondary' => '#FFF',
			'_slider_tertiary' => '#e781a5',
			'_post_background' => '#FFF',
			'_post_date' => '#999',
			'_post_title' => '#000',
			'_post_content' => '#333',
			'_post_link' => '#9e5fce',
			'_post_link_hover' => '#e781a5',
			'_widget_background' => '#FFF',
			'_widget_title' => '#000',
			'_widget_content' => '#999',
			'_widget_link' => '#333',
			'_widget_link_hover' => '#e781a5',
			'_footer_background' => '#000',
			'_footer_widget_title' => '#444',
			'_footer_content' => '#666',
			'_footer_link' => '#999',
			'_footer_link_hover' => '#e781a5',
		);

		return $colors;

	}
}

if ( !function_exists( 'souje_color' ) ) {
	function souje_color( $color ) {

		$the_color = 'souje_color' . esc_attr( $color );

		foreach ( souje_get_colors() as $key => $val ) {
			if ( $key == $color ) {
				$$the_color = get_theme_mod( $the_color, $val );
				break;
			}
		}

		return $$the_color;

	}
}
/* */

/* Output Customize CSS */
if ( !function_exists( 'souje_rewrite_css' ) ) {
	function souje_rewrite_css() {

		$souje_font_primary = get_theme_mod( 'souje_font_primary', 'Poppins' );
		$souje_font_secondary = get_theme_mod( 'souje_font_secondary', 'PT_Serif' );
		$souje_font_logotype = '';
		if ( !get_theme_mod( 'souje_logo_image' ) ) { $souje_font_logotype =  get_theme_mod( 'souje_font_logotype', 'Montserrat_Alternates' ); }

		$souje_font_size_menu_item = get_theme_mod( 'souje_font_size_menu_item', 14 );
		$souje_font_size_post_title = get_theme_mod( 'souje_font_size_post_title', 60 );
		$souje_font_size_post_title_mobile = get_theme_mod( 'souje_font_size_post_title_mobile', 40 );
		$souje_font_size_post_content = get_theme_mod( 'souje_font_size_post_content', 16 );
		$souje_font_size_widget_title = get_theme_mod( 'souje_font_size_widget_title', 30 );
		$souje_font_size_widget_post_title = get_theme_mod( 'souje_font_size_widget_post_title', 13 );

		/* */

		$menuContainerHeight = get_theme_mod( 'souje_menu_container_height', 80 );
		$maxLogoHeight = get_theme_mod( 'souje_max_logo_height', 40 );
		if ( $menuContainerHeight < 70 ) { $menuContainerHeight = 70; }

		$souje_header_style = get_theme_mod( 'souje_header_style', 'lefted_mright_fboxed' );
		$souje_opt_LogoPos = substr( $souje_header_style, 0, 6 );
		$souje_opt_MenuPos = substr( $souje_header_style, 7, 6 );
		$souje_opt_MenuWidth = substr( $souje_header_style, 14, 6 );

		if ( $souje_opt_LogoPos == 'lefted' && $maxLogoHeight > $menuContainerHeight ) { $maxLogoHeight = $menuContainerHeight; }

		/* */

		$souje_color_logo_background = souje_color( '_logo_background' );
		if ( get_theme_mod( 'souje_ignore_logo_background', 1 ) ) { $souje_color_logo_background = souje_color( '_background' ); }

		/* General */
		$css = '
			body { background-color: ' . esc_attr( souje_color( '_background' ) ) . '; color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			a,
			a:visited { color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }
			a:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			input,
			textarea,
			select { background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_post_content' ) ) ) . ', 0.1); color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			input[type="submit"] { color: ' . esc_attr( souje_color( '_post_background' ) ) . '; background-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
			input[type="submit"]:hover { color: ' . esc_attr( souje_color( '_post_background' ) ) . '; background-color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }
			table, th, td, hr { border-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_post_content' ) ) ) . ', 0.1); }

			blockquote { border-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
		';

		/* Misc */
		$css .= '
			.nothing-found,
			.page-404 { background-color: ' . esc_attr( souje_color( '_assistant_three' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_two' ) ) . '; }
			.filter-bar-inner { background-color: ' . esc_attr( souje_color( '_background' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_three' ) ) . '; }

			#googleMap { height: ' . esc_attr( get_theme_mod( 'souje_map_height', 500 ) ) . 'px; }
		';

		/* Post Formats */
		if ( get_theme_mod( 'souje_gallery_position', 'content' ) == 'iof' && has_post_format( 'gallery' ) ) {
			$css .= '
               	.gallery,
				.tiled-gallery { display: none; }
            ';
		}

		/* Article */
		$css .= '
			article { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }

			.article-content-outer,
			.article-content-outer-sidebar,
			.article-content-outer-cc2,
			.article-content-outer-sidebar-cc2,
			.article-content-outer-cc3 { border-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			.article-date,
			.article-date:visited { color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }
			a.article-date:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			.article-title,
			.article-title a,
			.article-title a:visited,
			.woocommerce-page h1.page-title { color: ' . esc_attr( souje_color( '_post_title' ) ) . '; }
			.article-title a:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			.article-comments-outer .article-comments-icon { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
			.article-comments-outer .article-comments-number { color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }
			.article-comments-outer:hover .article-comments-icon,
			.article-comments-outer:hover .article-comments-number { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			a.article-author-outer,
			a.article-author-outer:visited { color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }
			a.article-author-outer:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			.btnReadMore,
			.btnReadMore:visited { color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			.btnReadMore:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

			.sticky-icon { background-color: ' . esc_attr( souje_color( '_post_link' ) ) . '; color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }

			.post-styleZ,
			.post-styleZ:visited { background-color: ' . esc_attr( souje_color( '_assistant_one' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_two' ) ) . '; }
			.post-styleZ img { border-color: ' . esc_attr( souje_color( '_assistant_one' ) ) . ' !important; }
			.post-styleZ:hover,
			.post-styleZ:hover { background-color: ' . esc_attr( souje_color( '_assistant_three' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_two' ) ) . '; }
			.post-styleZ:hover img { border-color: ' . esc_attr( souje_color( '_assistant_three' ) ) . ' !important; }

			.author-box { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }

			article .wp-caption p.wp-caption-text,
			.wp-block-latest-comments time,
			.wp-block-latest-comments footer { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }

			.category-bar a,
			.category-bar a:visited { color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			.category-bar a:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
		';

		if ( !get_theme_mod( 'souje_show_excerpt_indexed', 1 ) && !get_theme_mod( 'souje_show_categories_indexed', 1 ) ) {
			$css .= '
				.posts-wrapper .article-content-outer,
				.posts-wrapper .article-content-outer-sidebar,
				.posts-wrapper .article-content-outer-cc2,
				.posts-wrapper .article-content-outer-sidebar-cc2,
				.posts-wrapper .article-content-outer-cc3 {
					padding: 0;
					border: none;
				}
			';
		}

		/* Related Posts */
		$css .= '
			.related-posts-row:nth-child(2),
			.related-posts-row-sidebar:nth-child(2) { border-color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; }
			.related-posts h2 { color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; }
		';

		/* Post Comments */
		$css .= '
			.comments-container { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; border-color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; }
			h2.comments-title { color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; }
			.commenter-name,
			.commenter-name a,
			.commenter-name a:visited { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
			.comment-date { color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }
		';

		/* Post Navigation */
		$css .= '
			.post-navi a .post-navi-inner { background-color: ' . esc_attr( souje_color( '_assistant_one' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_two' ) ) . '; }
			.post-navi a:hover .post-navi-inner { background-color: ' . esc_attr( souje_color( '_assistant_three' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_two' ) ) . '; }
		';

		/* Page Navigation */
		$css .= '
			.page-numbers.dots,
			a.page-numbers,
			a.page-numbers:visited { color: ' . esc_attr( souje_color( '_assistant_three' ) ) . '; }
			a.page-numbers:hover { color: ' . esc_attr( souje_color( '_assistant_one' ) ) . '; }
			.page-numbers.current { background-color: ' . esc_attr( souje_color( '_assistant_two' ) ) . '; color: ' . esc_attr( souje_color( '_assistant_one' ) ) . '; }
		';

		/* Menu & Header */
		$css .= '
			.mobile-header,
			#sticky-menu-container { background-color: ' . esc_attr( souje_color( '_menu_background' ) ) . '; }
			.mobile-menu-button,
			.slicknav_menu a,
			.slicknav_menu a:visited,
			.site-menu-outer .assign-menu { color: ' . esc_attr( souje_color( '_menu_link' ) ) . '; }
			.slicknav_menu a:hover { color: ' . esc_attr( souje_color( '_menu_link_hover' ) ) . '; }

			.logo-text a,
			.logo-text a:visited,
			.logo-text a:hover { color: ' . esc_attr( souje_color( '_logo_text' ) ) . '; }
			.sticky-logo-container .logo-text a,
			.sticky-logo-container .logo-text a:visited,
			.sticky-logo-container .logo-text a:hover,
			.mobile-logo-container .logo-text a,
			.mobile-logo-container .logo-text a:visited,
			.mobile-logo-container .logo-text a:hover { color: ' . esc_attr( souje_color( '_menu_link' ) ) . '; }
			h1.logo-text { font-size: ' . esc_attr( get_theme_mod( 'souje_font_size_logo', 30 ) ) . 'px; }
			.mobile-header h1.logo-text,
			#sticky-menu h1.logo-text { font-size: 25px; }
		';

		if ( !get_theme_mod( 'souje_show_sticky_logo', 1 ) ) { $css .= '.sticky-logo-outer { margin: 0; }'; }

		$css .= '
			.site-nav a,
			.site-nav a:visited,
			.header-social .social-menu-item,
			.top-search-button,
			.top-search-touch input,
			.top-search-touch i,
			.top-extra-inner .btn-to-top { color: ' . esc_attr( souje_color( '_menu_link' ) ) . '; }
			.site-nav a:hover,
			.header-social .social-menu-item:hover,
			.top-search-button:hover,
			.top-extra-inner .btn-to-top:hover { opacity: 1; color: ' . esc_attr( souje_color( '_menu_link_hover' ) ) . '; }
			.site-nav li ul { background-color: ' . esc_attr( souje_color( '_menu_background' ) ) . '; border-color: ' . esc_attr( souje_color( '_menu_link_hover' ) ) . '; }

			.site-top-container,
			.menu-sticky,
			.top-search-touch input { background-color: ' . esc_attr( souje_color( '_menu_background' ) ) . '; }
			.top-search input { background-color: ' . esc_attr( souje_color( '_menu_link' ) ) . '; color: ' . esc_attr( souje_color( '_menu_background' ) ) . '; width: ' . esc_attr( get_theme_mod( 'souje_top_search_width', 240 ) ) . 'px; }
		';

		if ( $souje_opt_MenuPos == 'lefted' ) {
			/* Default */
		} else if ( $souje_opt_MenuPos == 'center' ) {
			$css .= '
				.site-top-container { text-align: center; }
				.site-top-container .top-extra-outer { float: none; display: inline-block; margin-left: 40px; }
			';
		} else if ( $souje_opt_MenuPos == 'mright' ) {
			$css .= '
				.site-top-container { text-align: right; }
				.site-top-container .top-extra-outer { margin-left: 40px; }
			';
			if ( $souje_opt_LogoPos == 'lefted' ) {
				$css .= '
					.site-top-container { position: relative; }
					.site-logo-outer { position: absolute; left: 20px; }
				';
			}
		}

		if ( $souje_opt_LogoPos == 'topped' || $souje_opt_LogoPos == 'bottom' ) {

			if ( $souje_opt_LogoPos == 'topped' || ( $souje_opt_LogoPos == 'bottom' && ( !get_theme_mod( 'souje_ignore_logo_background', 1 ) || $souje_color_logo_background != souje_color( '_background' ) ) ) ) { $css .= '.site-top { margin-bottom: 40px; }'; }

			$css .= '
				.site-logo-outer { display: block; text-align: center; padding: 40px 0 40px 0; background-color: ' . esc_attr( $souje_color_logo_background ) . '; }
				.site-logo-container { display: inline-block; }

				.site-logo-container img { height: auto; }

				.site-logo-left-handler { display: inline-table; vertical-align: middle; margin: 0; }

				.site-logo-left-handler,
				.top-extra { height: ' . esc_attr( $menuContainerHeight ) . 'px; }
				.site-logo-container img { max-height: ' . esc_attr( $maxLogoHeight ) . 'px; }
			';

		} else if ( $souje_opt_LogoPos == 'lefted' ) {
			$css .= '
				.site-top { margin-bottom: 40px; }
				.site-logo-outer,
				.site-logo-outer-handler { display: inline-table; vertical-align: middle; margin: 0 40px 0 0; text-align: left; }
				.site-logo-container { display: table-cell; vertical-align: middle; }
				.site-logo-container img { height: auto; }

				.site-logo-outer,
				.site-logo-outer-handler,
				.top-extra { height: ' . esc_attr( $menuContainerHeight ) . 'px; }
				.site-logo-container img { max-height: ' . esc_attr( $maxLogoHeight ) . 'px; }
			';
		}

		$css .= '
			.sticky-logo-outer,
			#sticky-menu .top-extra { height: 50px; }

			.site-top-container { padding-left: 40px; padding-right: 40px; }
		';

		if ( $souje_opt_MenuWidth == 'bboxed' ) {
			$css .= '.site-top { max-width: 1180px; padding: 0 20px 0 20px; }';
		} else if ( $souje_opt_MenuWidth == 'fulled' ) {
			$css .= '.site-top { max-width: 100%; padding: 0; }';
		} else if ( $souje_opt_MenuWidth == 'fboxed' ) {
			$css .= '
				.site-top { max-width: 100%; padding: 0; }

				.site-top-container { max-width: 1180px; margin: auto; padding-left: 20px; padding-right: 20px; }
				.site-top-container-outer { background-color: ' . esc_attr( souje_color( '_menu_background' ) ) . '; }
			';
		}

		/* Trigger Slicknav Menu */
		$css .= '
			@media all and (min-width: ' . esc_attr( get_theme_mod( 'souje_trigger_slick_nav', 960 ) ) . 'px) {

				body { margin-top: 0; }
				#site-menu,
				#site-menu-sticky,
				#sticky-menu { display: block; }
				.mobile-header { display: none; }
				.site-top { margin-top: 0; display: block; }

			}
		';

		/* Slider */
		$css .= '
			.owl-prev,
			.owl-next { color: ' . esc_attr( souje_color( '_slider_secondary' ) ) . '; }
			.owl-dot { background-color: ' . esc_attr( souje_color( '_slider_secondary' ) ) . '; }
			.owl-dot.active { background-color: ' . esc_attr( souje_color( '_slider_tertiary' ) ) . '; }
			.owl-prev:hover,
			.owl-next:hover { color: ' . esc_attr( souje_color( '_slider_tertiary' ) ) . '; }
			.owl-dot:hover { background-color: ' . esc_attr( souje_color( '_slider_tertiary' ) ) . '; }
		';

		if ( !get_theme_mod( 'souje_slider_dots', 0 ) ) {
			$css .= '
				.owl-dots { display: none; }
				@media all and (min-width: 860px) { .souje-slider-container .owl-dots { display: none; } }
			';
		}

		$css .= '
			.slide-lens { background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_slider_primary' ) ) ) . ', 0.6); }
			.owl-item a .slide-thumbnail-inner,
			.slide-thumbnail-inner { background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_slider_primary' ) ) ) . ', 1); color: ' . esc_attr( souje_color( '_slider_secondary' ) ) . '; }
			.owl-item a:hover .slide-thumbnail-inner { color: ' . esc_attr( souje_color( '_slider_primary' ) ) . '; background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_slider_secondary' ) ) ) . ', 1); }
			@media all and (min-width: 860px) {
				.owl-item a .slide-thumbnail-inner,
				.slide-thumbnail-inner { background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_slider_primary' ) ) ) . ', 0); }
				.owl-item a:hover .slide-thumbnail-inner { color: ' . esc_attr( souje_color( '_slider_tertiary' ) ) . '; background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_slider_secondary' ) ) ) . ', 0); }
			}
		';

		/* Sidebar Widgets */
		$css .= '
			.widget-item { color: ' . esc_attr( souje_color( '_widget_content' ) ) . '; background-color: ' . esc_attr( souje_color( '_widget_background' ) ) . '; }
			.widget-item a,
			.widget-item a:visited { color: ' . esc_attr( souje_color( '_widget_link' ) ) . '; }
			.widget-item a .posts-widget-date { color: ' . esc_attr( souje_color( '_widget_content' ) ) . '; }
			.widget-item a:hover { color: ' . esc_attr( souje_color( '_widget_link_hover' ) ) . '; }

			.widget-item h2 { color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; background-color: ' . esc_attr( souje_color( '_background' ) ) . '; }
			.post-widget-container { color: ' . esc_attr( souje_color( '_widget_background' ) ) . '; background-color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; }
			a:hover .post-widget-container { color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; background-color: ' . esc_attr( souje_color( '_widget_background' ) ) . '; }

			h2 a.rsswidget,
			h2 a.rsswidget:visited,
			h2 a.rsswidget:hover { color: ' . esc_attr( souje_color( '_widget_title' ) ) . '; }

			.instagram-label { background-color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; color: ' . esc_attr( souje_color( '_footer_link_hover' ) ) . '; }

			.search-widget-input,
			.search-widget-icon,
			.search-widget-s-pro-icon { background-color: ' . esc_attr( souje_color( '_widget_link_hover' ) ) . '; color: ' . esc_attr( souje_color( '_widget_background' ) ) . '; }
		';

		/* Footer & Footer Widgets */
		$css .= '
			footer { color: ' . esc_attr( souje_color( '_footer_content' ) ) . '; background-color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; }
			footer a,
			footer a:visited { color: ' . esc_attr( souje_color( '_footer_link' ) ) . '; }
			footer a:hover { color: ' . esc_attr( souje_color( '_footer_link_hover' ) ) . '; }

			.widget-item-footer input,
			.widget-item-footer textarea,
			.widget-item-footer select { background-color: ' . esc_attr( souje_color( '_footer_link' ) ) . '; color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; }
			.widget-item-footer input[type="submit"] { background-color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; color: ' . esc_attr( souje_color( '_footer_link' ) ) . '; }
			.widget-item-footer input[type="submit"]:hover { color: ' . esc_attr( souje_color( '_footer_link_hover' ) ) . '; }
			.widget-item-footer table, .widget-item-footer th, .widget-item-footer td, .widget-item-footer hr { border-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_footer_content' ) ) ) . ', 0.1); }

			.widget-item-footer h2 { color: ' . esc_attr( souje_color( '_footer_widget_title' ) ) . '; background-color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; }

			.widget-item-footer a .posts-widget-date { color: ' . esc_attr( souje_color( '_footer_content' ) ) . '; }

			.widget-item-footer .post-widget-container { color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; background-color: ' . esc_attr( souje_color( '_footer_widget_title' ) ) . '; }
			.widget-item-footer a:hover .post-widget-container { color: ' . esc_attr( souje_color( '_footer_widget_title' ) ) . '; background-color: ' . esc_attr( souje_color( '_footer_background' ) ) . '; }

			.widget-item-footer h2 a.rsswidget,
			.widget-item-footer h2 a.rsswidget:visited,
			.widget-item-footer h2 a.rsswidget:hover { color: ' . esc_attr( souje_color( '_footer_widget_title' ) ) . '; }

			.widget-item-footer .search-widget-input,
			.widget-item-footer .search-widget-icon,
			.widget-item-footer .search-widget-s-pro-icon { background-color: ' . esc_attr( souje_color( '_footer_widget_title' ) ) . '; color: ' . esc_attr( souje_color( '_footer_link' ) ) . '; }

		';

		/* Fonts */
		foreach ( souje_font_labels() as $key => $val ) {
			$add_underscore = str_replace( ' ', '_', $key );
			if ( $add_underscore == $souje_font_primary ) { $font_primary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
			if ( $add_underscore == $souje_font_secondary ) { $font_secondary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
			if ( $add_underscore == $souje_font_logotype ) { $font_logotype = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
		}

		$css .= '
			.souje-font-1,
			body,
			input,
			textarea {
				' . wp_kses_post( $font_primary ) . '
			}

			.souje-font-2,
			blockquote,
			.article-date-outer,
			.article-author-outer,
			.article-comments-outer,
			.category-bar,
			.tagcloud,
			.posts-widget-date,
			.post-widget-date,
			.search-widget-input,
			.post-navi-label,
			.comment-date,
			.comment-reply-link,
			.comment-edit-link,
			form label,
			.logged-in-as,
			.author-box-links,
			.sticky-icon,
			.footer-text {
				' . wp_kses_post( $font_secondary ) . '
			}
		';

		if ( $souje_font_logotype ) { $css .= '.logo-text { ' . wp_kses_post( $font_logotype ) . ' }'; }

		$css .= '
			.site-nav { font-size: ' . esc_attr( $souje_font_size_menu_item ) . 'px; }
			.article-title,
			.woocommerce-page h1.page-title { font-size: ' . esc_attr( $souje_font_size_post_title_mobile ) . 'px; }
			@media all and (min-width: 960px) { .main-container .article-title, .woocommerce-page .main-container h1.page-title { font-size: ' . esc_attr( $souje_font_size_post_title ) . 'px; } }
			@media all and (min-width: 1160px) { .main-container-sidebar .article-title, .woocommerce-page .main-container-sidebar h1.page-title { font-size: ' . esc_attr( $souje_font_size_post_title ) . 'px; } }
			.article-pure-content,
			.wp-block-latest-comments footer { font-size: ' . esc_attr( $souje_font_size_post_content ) . 'px; }
			.widget-item h2,
			.widget-item-footer h2,
			.image-widget-title { font-size: ' . esc_attr( $souje_font_size_widget_title ) . 'px; }
			.posts-widget-title,
			.widget_categories,
			.widget_archive,
			.widget_nav_menu,
			.widget_meta,
			.widget_pages,
			.widget_recent_comments,
			.widget_recent_entries { font-size: ' . esc_attr( $souje_font_size_widget_post_title ) . 'px; }
		';

		/* WooCommerce */
		if ( function_exists( 'WC' ) ) {

			$souje_woo_layout = get_theme_mod( 'souje_woo_layout', '2col_sidebar' );

			if ( $souje_woo_layout == '3col' ) {
				$css .= '@media all and (min-width: 860px) { ul.products li.product {	width: 33.3% !important; padding: 0 5px 0 5px !important; } ul.products li.first {	padding: 0 10px 0 0 !important; } ul.products li.last {	padding: 0 0 0 10px !important; } }';
			}

			$css .= '
				.widget-item.woocommerce,
				.widget-item-footer.woocommerce { font-size: ' . esc_attr( $souje_font_size_widget_post_title ) . 'px; }

				p.stars span a,
				.amount,
				.price ins,
				.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong[itemprop="author"] { color: ' . esc_attr( souje_color( '_post_title' ) ) . '; }

				.products li a h1,
				.products li a h2,
				.products li a h3 {	color: ' . esc_attr( souje_color( '_post_title' ) ) . '; }

				.button.add_to_cart_button.product_type_variable,
				.button.add_to_cart_button.product_type_simple,
				button.single_add_to_cart_button.button.alt,
				.woocommerce #review_form #respond .form-submit input.submit,
				ul.products li a.added_to_cart.wc-forward,
				.woocommerce #respond input#submit,
				.woocommerce a.button,
				.woocommerce button.button,
				.woocommerce input.button {	background-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . ' !important; color: ' . esc_attr( souje_color( '_post_background' ) ) . '!important; }

				.button.add_to_cart_button.product_type_variable:hover,
				.button.add_to_cart_button.product_type_simple:hover,
				button.single_add_to_cart_button.button.alt:hover,
				.woocommerce #review_form #respond .form-submit input.submit:hover,
				ul.products li a.added_to_cart.wc-forward:hover,
				.woocommerce #respond input#submit:hover,
				.woocommerce a.button:hover,
				.woocommerce button.button:hover,
				.woocommerce input.button:hover { background-color: ' . esc_attr( souje_color( '_post_link' ) ) . ' !important; color: ' . esc_attr( souje_color( '_post_background' ) ) . '!important; opacity: 1;	}

				.woocommerce .woocommerce-message a.button,
				.woocommerce .woocommerce-message a.button:visited { background: transparent !important; color: ' . esc_attr( souje_color( '_post_title' ) ) . '!important; }
				.woocommerce .woocommerce-message a.button:hover { background: transparent !important; color: ' . esc_attr( souje_color( '_post_link' ) ) . '!important; }

				.woocommerce span.onsale { background-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }

				.woocommerce div.product .woocommerce-tabs ul.tabs li,
				.woocommerce div.product .woocommerce-tabs ul.tabs li a,
				.woocommerce div.product .woocommerce-tabs ul.tabs li a:visited { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; color: ' . esc_attr( souje_color( '_post_date' ) ) . '; border-color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }

				.woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
				.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; color: ' . esc_attr( souje_color( '_post_link' ) ) . '; border-color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }

				.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
				.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; border-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle { background-color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range {	background-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
				.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content { background-color: ' . esc_attr( souje_color( '_background' ) ) . ';	}

				.woocommerce nav.woocommerce-pagination span.page-numbers.current { background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_post_date' ) ) ) . ', 0.1);	}

				nav.woocommerce-MyAccount-navigation ul li { border-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_post_date' ) ) ) . ', 0.3) !important; }
				nav.woocommerce-MyAccount-navigation ul li a { color: ' . esc_attr( souje_color( '_post_title' ) ) . '; }
				nav.woocommerce-MyAccount-navigation ul li a:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
			';

		}

		/* User Logged In */
		if ( is_admin_bar_showing() ) {
			$css .= '
				.menu-sticky { margin-top: 432px; }
				.mobile-header { top: 45px; }
				@media all and (min-width: 783px) { .mobile-header { top: 32px; } }
			';
		}

		/* Gutenberg */
		if ( get_theme_mod( 'souje_gallery_position', 'content' ) == 'iof' && has_post_format( 'gallery' ) ) {

			$css .= '
				.wp-block-gallery { display: none; }
			';

		}

		$css .= '
			.wp-block-quote cite,
			.wp-block-pullquote cite,
			.wp-block-verse {
				' . wp_kses_post( $font_secondary ) . '
			}
		';

		$css .= '
			.wp-block-cover .wp-block-cover-text,
			.wp-block-media-text,
			.wp-block-archives select,
			.wp-block-categories select {
				' . wp_kses_post( $font_primary ) . '
			}
		';

		$css .= '
			.wp-block-image figcaption,
			.wp-block-embed figcaption,
			.wp-block-audio figcaption,
			.wp-block-video figcaption,
			.wp-block-latest-posts time { color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }

			.wp-block-table td,
			.wp-block-separator { border-color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }
		';

		/* */

		return $css;

	}
}
/* */

/* Output Gutenberg Editor Inline Styles */
if ( !function_exists( 'souje_rewrite_gutenberg_editor_css' ) ) {
	function souje_rewrite_gutenberg_editor_css() {

		$souje_font_primary = get_theme_mod( 'souje_font_primary', 'Poppins' );
		$souje_font_secondary = get_theme_mod( 'souje_font_secondary', 'PT_Serif' );

		foreach ( souje_font_labels() as $key => $val ) {
			$add_underscore = str_replace( ' ', '_', $key );
			if ( $add_underscore == $souje_font_primary ) { $font_primary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
			if ( $add_underscore == $souje_font_secondary ) { $font_secondary = 'font-family: "' . wp_kses_post( $key ) . '", ' . wp_kses_post( $val ) . ';'; }
		}

		$gutenberg_editor_css = '

			.editor-writing-flow,
			.editor-writing-flow .editor-post-title__input,
			.editor-writing-flow textarea,
			.editor-writing-flow select,
			.editor-writing-flow input[type="text"] {
				' . wp_kses_post( $font_primary ) . '
			}

			.editor-writing-flow .wp-block-verse pre,
			.editor-writing-flow .wp-block-quote,
			.editor-writing-flow .wp-block-pullquote {
				' . wp_kses_post( $font_secondary ) . '
			}

			.edit-post-visual-editor { background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }
			.editor-writing-flow,
			.editor-writing-flow .wp-block-verse pre { color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			.editor-writing-flow .editor-post-title__input { color: ' . esc_attr( souje_color( '_post_title' ) ) . '; }
			.editor-writing-flow .wp-block-image figcaption,
			.editor-writing-flow .wp-block-embed figcaption,
			.editor-writing-flow .wp-block-audio figcaption,
			.editor-writing-flow .wp-block-video figcaption,
			.editor-writing-flow .wp-block-latest-posts time,
			.editor-writing-flow .wp-block-latest-comments time { color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }
			.editor-writing-flow .wp-block-quote,
			.editor-writing-flow .wp-block-quote .wp-block-quote__citation,
			.editor-writing-flow .wp-block-pullquote { color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			.editor-writing-flow .wp-block-quote.is-style-default { border-color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }
			.editor-writing-flow .wp-block-table td,
			.editor-writing-flow .wp-block-separator { border-color: ' . esc_attr( souje_color( '_post_date' ) ) . '; }
			.editor-writing-flow .wp-block-code textarea { color: ' . esc_attr( souje_color( '_post_content' ) ) . '; background-color: ' . esc_attr( souje_color( '_post_background' ) ) . '; }
			.editor-writing-flow .wp-block-archives select,
			.editor-writing-flow .wp-block-categories select { background-color: rgba(' . esc_attr( souje_hex2rgb( souje_color( '_post_content' ) ) ) . ', 0.1 ); color: ' . esc_attr( souje_color( '_post_content' ) ) . '; }
			.editor-writing-flow a { color: ' . esc_attr( souje_color( '_post_link' ) ) . '; }
			.editor-writing-flow a:hover { color: ' . esc_attr( souje_color( '_post_link_hover' ) ) . '; }

		';

		return $gutenberg_editor_css;

	}
}
/* */
