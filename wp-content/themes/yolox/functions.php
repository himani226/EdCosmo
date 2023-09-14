<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

if ( ! defined( 'YOLOX_THEME_DIR' ) ) {
	define( 'YOLOX_THEME_DIR', trailingslashit( get_template_directory() ) );
}
if ( ! defined( 'YOLOX_THEME_URL' ) ) {
	define( 'YOLOX_THEME_URL', trailingslashit( get_template_directory_uri() ) );
}
if ( ! defined( 'YOLOX_CHILD_DIR' ) ) {
	define( 'YOLOX_CHILD_DIR', trailingslashit( get_stylesheet_directory() ) );
}
if ( ! defined( 'YOLOX_CHILD_URL' ) ) {
	define( 'YOLOX_CHILD_URL', trailingslashit( get_stylesheet_directory_uri() ) );
}

//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( ! function_exists( 'yolox_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'yolox_theme_setup1', 1 );
	function yolox_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'yolox', YOLOX_THEME_DIR . 'languages' );
	}
}

if ( ! function_exists( 'yolox_theme_setup' ) ) {
	add_action( 'after_setup_theme', 'yolox_theme_setup' );
	function yolox_theme_setup() {

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'yolox_filter_content_width', yolox_get_theme_option( 'page_width' ) );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// Custom header setup
		add_theme_support(
			'custom-header', array(
				'header-text' => false,
				'video'       => true,
			)
		);

		// Custom logo
		add_theme_support(
			'custom-logo', array(
				'width'       => 250,
				'height'      => 60,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		// Custom backgrounds setup
		add_theme_support( 'custom-background', array() );

		// Partial refresh support in the Customize
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Supported posts formats
		add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat' ) );

		// Autogenerate title tag
		add_theme_support( 'title-tag' );

		// Add theme menus
		add_theme_support( 'nav-menus' );

		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

		// Editor custom stylesheet - for user
		add_editor_style(
			array_merge(
				array(
					'css/editor-style.css',
					yolox_get_file_url( 'css/font-icons/css/fontello-embedded.css' ),
				),
				yolox_theme_fonts_for_editor()
			)
		);

		// Gutenberg support
		//---------------------------------
		// Add wide and full blocks support
		add_theme_support( 'align-wide' );
		// Uncomment next row if you want to add editor styles to the frontend
		
		// Register navigation menu
		register_nav_menus(
			array(
				'menu_main'   => esc_html__( 'Main Menu', 'yolox' ),
				'menu_mobile' => esc_html__( 'Mobile Menu', 'yolox' ),

			)
		);

		// Register theme-specific thumb sizes
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 370, 0, false );
		$thumb_sizes = yolox_storage_get( 'theme_thumbs' );
		$mult        = yolox_get_theme_option( 'retina_ready', 1 );
		if ( $mult > 1 ) {
			$GLOBALS['content_width'] = apply_filters( 'yolox_filter_content_width', 1170 * $mult );
		}
		foreach ( $thumb_sizes as $k => $v ) {
			add_image_size( $k, $v['size'][0], $v['size'][1], $v['size'][2] );
			if ( $mult > 1 ) {
				add_image_size( $k . '-@retina', $v['size'][0] * $mult, $v['size'][1] * $mult, $v['size'][2] );
			}
		}
		// Add new thumb names
		add_filter( 'image_size_names_choose', 'yolox_theme_thumbs_sizes' );

		// Excerpt filters
		add_filter( 'excerpt_length', 'yolox_excerpt_length' );
		add_filter( 'excerpt_more', 'yolox_excerpt_more' );

		// Comment form
		add_filter( 'comment_form_fields', 'yolox_comment_form_fields' );
		add_filter( 'comment_form_fields', 'yolox_comment_form_agree', 11 );

		// Add required meta tags in the head
		add_action( 'wp_head', 'yolox_wp_head', 0 );

		// Load current page/post customization (if present)
		add_action( 'wp_footer', 'yolox_wp_footer' );
		add_action( 'admin_footer', 'yolox_wp_footer' );

		// Enqueue scripts and styles for frontend
		add_action( 'wp_enqueue_scripts', 'yolox_wp_scripts', 1000 );             // priority 1000 - load styles
																						// before the plugin's support custom styles
																						// (with priority 1100)
																						// and child-theme styles
																						// (with priority 1200)
		add_action( 'wp_enqueue_scripts', 'yolox_wp_styles_child', 1200 );        // priority 1200 - load styles
																						// after the plugin's support custom styles
																						// (with priority 1100)
		add_action( 'wp_enqueue_scripts', 'yolox_wp_styles_responsive', 2000 );   // priority 2000 - load responsive
																						// after all other styles
		add_action( 'wp_footer', 'yolox_localize_scripts' );

		// Add body classes
		add_filter( 'body_class', 'yolox_add_body_classes' );

		// Register sidebars
		add_action( 'widgets_init', 'yolox_register_sidebars' );
	}
}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( ! function_exists( 'yolox_wp_scripts' ) ) {
		function yolox_wp_scripts() {

		// Enqueue styles
		//------------------------

		// Links to selected fonts
		$links = yolox_theme_fonts_links();
		if ( count( $links ) > 0 ) {
			foreach ( $links as $slug => $link ) {
				wp_enqueue_style( sprintf( 'yolox-font-%s', $slug ), $link, array(), null );
			}
		}

		// Font icons styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello-icons', yolox_get_file_url( 'css/font-icons/css/fontello-embedded.css' ), array(), null );

		// Load main stylesheet
		$main_stylesheet = YOLOX_THEME_URL . 'style.css';
		wp_enqueue_style( 'yolox-main', $main_stylesheet, array(), null );

		// Add custom bg image
		$bg_image = yolox_remove_protocol_from_url( yolox_get_theme_option( 'front_page_bg_image' ), false );
		if ( is_front_page() && ! empty( $bg_image ) && yolox_is_on( yolox_get_theme_option( 'front_page_enabled' ) ) ) {
			// Add custom bg image for the Front page
			wp_add_inline_style( 'yolox-main', 'body.frontpage, body.home-page { background-image:url(' . esc_url( $bg_image ) . ') !important }' );
		} else {
			// Add custom bg image for the body_style == 'boxed'
			$bg_image = yolox_get_theme_option( 'boxed_bg_image' );
			if ( yolox_get_theme_option( 'body_style' ) == 'boxed' && ! empty( $bg_image ) ) {
				wp_add_inline_style( 'yolox-main', '.body_style_boxed { background-image:url(' . esc_url( $bg_image ) . ') !important }' );
			}
		}

		// Custom colors, fonts and other rules
		if ( ! is_customize_preview() && ! isset( $_GET['color_scheme'] ) && yolox_is_off( yolox_get_theme_option( 'debug_mode' ) ) ) {
			wp_enqueue_style( 'yolox-custom', yolox_get_file_url( 'css/__custom.css' ), array(), null );
			if ( yolox_get_theme_setting( 'separate_schemes' ) ) {
				$schemes = yolox_get_sorted_schemes();
				if ( is_array( $schemes ) ) {
					foreach ( $schemes as $scheme => $data ) {
						wp_enqueue_style( "yolox-color-{$scheme}", yolox_get_file_url( "css/__colors_{$scheme}.css" ), array(), null );
					}
				}
			}
		} else {
			wp_add_inline_style( 'yolox-main', yolox_customizer_get_css() );
		}

		// Add post nav background
		yolox_add_bg_in_post_nav();

		// Enqueue scripts
		//------------------------

		// Modernizr will load in head before other scripts and styles
		$blog_archive = yolox_storage_get( 'blog_archive' ) === true;
		$blog_style   = yolox_get_theme_option( 'blog_style' );
		if ( strpos( $blog_style, 'blog-custom-' ) === 0 ) {
			$blog_id   = yolox_get_custom_blog_id( $blog_style );
			$blog_meta = yolox_get_custom_layout_meta( $blog_id );
			if ( ! empty( $blog_meta['scripts_required'] ) && ! yolox_is_off( $blog_meta['scripts_required'] ) ) {
				$blog_style = $blog_meta['scripts_required'];
			}
		}
		$need_masonry = ( $blog_archive 
							&& in_array( substr( $blog_style, 0, 7 ), array( 'gallery', 'portfol', 'masonry' ) ) )
						|| ( is_single()
							&& str_replace( 'post-format-', '', get_post_format() ) == 'gallery' );
		if ( $need_masonry ) {
			wp_enqueue_script( 'modernizr', yolox_get_file_url( 'js/theme-gallery/modernizr.min.js' ), array(), null, false );
		}

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', yolox_get_file_url( 'js/superfish/superfish.min.js' ), array( 'jquery' ), null, true );

		// Merged scripts
		if ( yolox_is_off( yolox_get_theme_option( 'debug_mode' ) ) ) {
			wp_enqueue_script( 'yolox-init', yolox_get_file_url( 'js/__scripts.js' ), array( 'jquery' ), null, true );
		} else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', yolox_get_file_url( 'js/skip-link-focus-fix.js' ), null, true );
			// Background video
			$header_video = yolox_get_header_video();
			if ( ! empty( $header_video ) && ! yolox_is_inherit( $header_video ) ) {
				if ( yolox_is_youtube_url( $header_video ) ) {
					wp_enqueue_script( 'tubular', yolox_get_file_url( 'js/jquery.tubular.js' ), array( 'jquery' ), null, true );
				} else {
					wp_enqueue_script( 'bideo', yolox_get_file_url( 'js/bideo.js' ), array(), null, true );
				}
			}
			// Theme scripts
			wp_enqueue_script( 'yolox-utils', yolox_get_file_url( 'js/theme-utils.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( 'yolox-init', yolox_get_file_url( 'js/theme-init.js' ), array( 'jquery' ), null, true );
		}
		// Load scripts for 'Masonry' layout
		if ( $need_masonry ) {
			yolox_load_masonry_scripts();
		}
		// Load scripts for 'Portfolio' layout
		if ( $blog_archive
				&& in_array( substr( $blog_style, 0, 7 ), array( 'gallery', 'portfol' ) )
				&& ! is_customize_preview() ) {
			wp_enqueue_script( 'jquery-ui-tabs', false, array( 'jquery', 'jquery-ui-core' ), null, true );
		}

		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library
		if ( yolox_get_theme_setting( 'use_mediaelements' ) ) {
			wp_enqueue_style( 'mediaelement' );
			wp_enqueue_style( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Add variables to the scripts in the frontend
if ( ! function_exists( 'yolox_localize_scripts' ) ) {
		function yolox_localize_scripts() {

		$video = yolox_get_header_video();

		wp_localize_script(
			'yolox-init', 'YOLOX_STORAGE', apply_filters(
				'yolox_filter_localize_script', array(
					// AJAX parameters
					'ajax_url'            => esc_url( admin_url( 'admin-ajax.php' ) ),
					'ajax_nonce'          => esc_attr( wp_create_nonce( admin_url( 'admin-ajax.php' ) ) ),

					// Site base url
					'site_url'            => get_home_url(),
					'theme_url'           => YOLOX_THEME_URL,

					// Site color scheme
					'site_scheme'         => sprintf( 'scheme_%s', yolox_get_theme_option( 'color_scheme' ) ),

					// User logged in
					'user_logged_in'      => is_user_logged_in() ? true : false,

					// Window width to switch the site header to the mobile layout
					'mobile_layout_width' => 767,
					'mobile_device'       => wp_is_mobile(),

					// Sidemenu options
					'menu_side_stretch'   => yolox_get_theme_option( 'menu_side_stretch' ) > 0 ? true : false,
					'menu_side_icons'     => yolox_get_theme_option( 'menu_side_icons' ) > 0 ? true : false,

					// Video background
					'background_video'    => yolox_is_from_uploads( $video ) ? $video : '',

					// Video and Audio tag wrapper
					'use_mediaelements'   => yolox_get_theme_setting( 'use_mediaelements' ) ? true : false,

					// Current mode
					'admin_mode'          => false,

					// Strings for translation
					'msg_ajax_error'      => esc_html__( 'Invalid server answer!', 'yolox' ),
				)
			)
		);
	}
}

// Enqueue masonry, portfolio and gallery-specific scripts
if ( ! function_exists( 'yolox_load_masonry_scripts' ) ) {
	function yolox_load_masonry_scripts() {
		wp_enqueue_script( 'modernizr', yolox_get_file_url( 'js/theme-gallery/modernizr.min.js' ), array(), null, false );
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'classie', yolox_get_file_url( 'js/theme-gallery/classie.min.js' ), array(), null, true );
		wp_enqueue_script( 'yolox-gallery-script', yolox_get_file_url( 'js/theme-gallery/theme-gallery.js' ), array(), null, true );
	}
}

// Load child-theme stylesheet (if different) after all styles (with priorities 1000 and 1100)
if ( ! function_exists( 'yolox_wp_styles_child' ) ) {
		function yolox_wp_styles_child() {
		$main_stylesheet  = YOLOX_THEME_URL . 'style.css';
		$child_stylesheet = YOLOX_CHILD_URL . 'style.css';
		if ( $child_stylesheet != $main_stylesheet ) {
			wp_enqueue_style( 'yolox-child', $child_stylesheet, array( 'yolox-main' ), null );
		}
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( ! function_exists( 'yolox_wp_styles_responsive' ) ) {
		function yolox_wp_styles_responsive() {
		wp_enqueue_style( 'yolox-responsive', yolox_get_file_url( 'css/responsive.css' ), array(), null );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if ( ! function_exists( 'yolox_wp_head' ) ) {
		function yolox_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="//gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( ! function_exists( 'yolox_add_body_classes' ) ) {
		function yolox_add_body_classes( $classes ) {
		$classes[] = 'body_tag';    // Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr( yolox_get_theme_option( 'color_scheme' ) );

		$blog_mode = yolox_storage_get( 'blog_mode' );
		$classes[] = 'blog_mode_' . esc_attr( $blog_mode );
		$classes[] = 'body_style_' . esc_attr( yolox_get_theme_option( 'body_style' ) );

		if ( in_array( $blog_mode, array( 'post', 'page' ) ) ) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_' . esc_attr( yolox_get_theme_option( 'blog_style' ) );
			if ( yolox_storage_get( 'blog_template' ) > 0 ) {
				$classes[] = 'blog_template';
			}
		}

		if ( yolox_sidebar_present() ) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr( yolox_get_theme_option( 'sidebar_position' ) );
		} else {
			$classes[] = 'sidebar_hide';
			if ( yolox_is_on( yolox_get_theme_option( 'expand_content' ) ) ) {
				$classes[] = 'expand_content';
			}
		}

		if ( yolox_is_on( yolox_get_theme_option( 'remove_margins' ) ) ) {
			$classes[] = 'remove_margins';
		}

		$bg_image = yolox_get_theme_option( 'front_page_bg_image' );
		if ( is_front_page() && yolox_is_on( yolox_get_theme_option( 'front_page_enabled' ) ) && ! empty( $bg_image ) ) {
			$classes[] = 'with_bg_image';
		}

		$classes[] = 'trx_addons_' . esc_attr( yolox_exists_trx_addons() ? 'present' : 'absent' );

		$classes[] = 'header_type_' . esc_attr( yolox_get_theme_option( 'header_type' ) );
		$classes[] = 'header_style_' . esc_attr( 'default' == yolox_get_theme_option( 'header_type' ) ? 'header-default' : yolox_get_theme_option( 'header_style' ) );
		$classes[] = 'header_position_' . esc_attr( yolox_get_theme_option( 'header_position' ) );

		$menu_style = yolox_get_theme_option( 'menu_style' );
		$classes[]  = 'menu_style_' . esc_attr( $menu_style ) . ( in_array( $menu_style, array( 'left', 'right' ) ) ? ' menu_style_side' : '' );
		$classes[]  = 'no_layout';

		if ( is_singular( 'post' ) ) {
			$classes[]  = 'thumbnail_type_' . esc_attr(yolox_get_theme_option( 'post_thumbnail_type' )) . ' post_header_position_' . esc_attr(yolox_get_theme_option( 'post_header_position' ));
		}

		return $classes;
	}
}

// Load current page/post customization (if present)
if ( ! function_exists( 'yolox_wp_footer' ) ) {
		//and add_action('admin_footer', 'yolox_wp_footer');
	function yolox_wp_footer() {
		// Add header zoom
		$header_zoom = max( 0.3, min( 2, (float) yolox_get_theme_option( 'header_zoom' ) ) );
		if ( 1 != $header_zoom ) {
			yolox_add_inline_css( ".sc_layouts_title_title{font-size:{$header_zoom}em}" );
		}
		// Add logo zoom
		$logo_zoom = max( 0.3, min( 2, (float) yolox_get_theme_option( 'logo_zoom' ) ) );
		if ( 1 != $logo_zoom ) {
			yolox_add_inline_css( ".custom-logo-link,.sc_layouts_logo{font-size:{$logo_zoom}em}" );
		}
		// Put inline styles to the output
		$css = yolox_get_inline_css();
		if ( ! empty( $css ) ) {
			wp_enqueue_style( 'yolox-inline-styles', yolox_get_file_url( 'css/__inline.css' ), array(), null );
			wp_add_inline_style( 'yolox-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( ! function_exists( 'yolox_register_sidebars' ) ) {
		function yolox_register_sidebars() {
		$sidebars = yolox_get_sidebars();
		if ( is_array( $sidebars ) && count( $sidebars ) > 0 ) {
			$cnt = 0;
			foreach ( $sidebars as $id => $sb ) {
				$cnt++;
				register_sidebar(
					apply_filters( 'yolox_filter_register_sidebar',
						array(
							'name'          => $sb['name'],
							'description'   => $sb['description'],
							// Translators: Add the sidebar number to the id
							'id'            => ! empty( $id ) ? $id : sprintf( 'theme_sidebar_%d', $cnt),
							'before_widget' => '<aside id="%1$s" class="widget %2$s">',
							'after_widget'  => '</aside>',
							'before_title'  => '<h5 class="widget_title">',
							'after_title'   => '</h5>',
						)
					)
				);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( ! function_exists( 'yolox_get_sidebars' ) ) {
	function yolox_get_sidebars() {
		$list = apply_filters(
			'yolox_filter_list_sidebars', array(
				'sidebar_widgets'       => array(
					'name'        => esc_html__( 'Sidebar Widgets', 'yolox' ),
					'description' => esc_html__( 'Widgets to be shown on the main sidebar', 'yolox' ),
				),
				'header_widgets'        => array(
					'name'        => esc_html__( 'Header Widgets', 'yolox' ),
					'description' => esc_html__( 'Widgets to be shown at the top of the page (in the page header area)', 'yolox' ),
				),
				'footer_widgets'        => array(
					'name'        => esc_html__( 'Footer Widgets', 'yolox' ),
					'description' => esc_html__( 'Widgets to be shown at the bottom of the page (in the page footer area)', 'yolox' ),
				),
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( ! function_exists( 'yolox_theme_fonts_links' ) ) {
	function yolox_theme_fonts_links() {
		$links = array();

		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x ( 'on', 'Google fonts: on or off', 'yolox' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x ( 'on', 'Custom fonts (included in the theme): on or off', 'yolox' ) );

		if ( ( $google_fonts_enabled || $custom_fonts_enabled ) && ! yolox_storage_empty( 'load_fonts' ) ) {
			$load_fonts = yolox_storage_get( 'load_fonts' );
			if ( count( $load_fonts ) > 0 ) {
				$google_fonts = '';
				foreach ( $load_fonts as $font ) {
					$url = '';
					if ( $custom_fonts_enabled && empty( $font['styles'] ) ) {
						$slug = yolox_get_load_fonts_slug( $font['name'] );
						$url  = yolox_get_file_url( sprintf( 'css/font-face/%s/stylesheet.css', $slug ) );
						if ( ! empty( $url ) ) {
							$links[ $slug ] = $url;
						}
					}
					if ( $google_fonts_enabled && empty( $url ) ) {
						// Attention! Using '%7C' instead '|' damage loading second+ fonts
                        $google_fonts .= ( $google_fonts ? '%7C' : '' )
										. str_replace( ' ', '+', $font['name'] )
										. ':'
										. ( empty( $font['styles'] ) ? '400,400italic,700,700italic' : $font['styles'] );
					}
				}
				if ( $google_fonts && $google_fonts_enabled ) {
					$links['google_fonts'] = sprintf( '%s://fonts.googleapis.com/css?family=%s&subset=%s', yolox_get_protocol(), $google_fonts, yolox_get_theme_option( 'load_fonts_subset' ) );
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( ! function_exists( 'yolox_theme_fonts_for_editor' ) ) {
	function yolox_theme_fonts_for_editor() {
		$links = array_values( yolox_theme_fonts_links() );
		if ( is_array( $links ) && count( $links ) > 0 ) {
			for ( $i = 0; $i < count( $links ); $i++ ) {
				$links[ $i ] = str_replace( ',', '%2C', $links[ $i ] );
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( ! function_exists( 'yolox_excerpt_length' ) ) {
	function yolox_excerpt_length( $length ) {
		return max( 1, yolox_get_theme_option( 'excerpt_length' ) );
	}
}

if ( ! function_exists( 'yolox_excerpt_more' ) ) {
	function yolox_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//-------------------------------------------------------
//-- Comments
//-------------------------------------------------------

// Comment form fields order
if ( ! function_exists( 'yolox_comment_form_fields' ) ) {
		function yolox_comment_form_fields( $comment_fields ) {
		if ( yolox_get_theme_setting( 'comment_after_name' ) ) {
			$keys = array_keys( $comment_fields );
			if ( 'comment' == $keys[0] ) {
				$comment_fields['comment'] = array_shift( $comment_fields );
			}
		}
		return $comment_fields;
	}
}

// Add checkbox with "I agree ..."
if ( ! function_exists( 'yolox_comment_form_agree' ) ) {
	
	function yolox_comment_form_agree( $comment_fields ) {
		$privacy_text = yolox_get_privacy_text();
		if ( ! empty( $privacy_text )
			&& ( ! function_exists( 'yolox_exists_gdpr_framework' ) || ! yolox_exists_gdpr_framework() )
			&& ( ! function_exists( 'yolox_exists_wp_gdpr_compliance' ) || ! yolox_exists_wp_gdpr_compliance() )
		) {
			$comment_fields['i_agree_privacy_policy'] = yolox_single_comments_field(
				array(
					'form_style'        => 'default',
					'field_type'        => 'checkbox',
					'field_req'         => '',
					'field_icon'        => '',
					'field_value'       => '1',
					'field_name'        => 'i_agree_privacy_policy',
					'field_title'       => $privacy_text,
				)
			);
		}
		return $comment_fields;
	}
}



//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------
if ( ! function_exists( 'yolox_theme_thumbs_sizes' ) ) {
		function yolox_theme_thumbs_sizes( $sizes ) {
		$thumb_sizes = yolox_storage_get( 'theme_thumbs' );
		$mult        = yolox_get_theme_option( 'retina_ready', 1 );
		foreach ( $thumb_sizes as $k => $v ) {
			$sizes[ $k ] = $v['title'];
			if ( $mult > 1 ) {
				$sizes[ $k . '-@retina' ] = $v['title'] . ' ' . esc_html__( '@2x', 'yolox' );
			}
		}
		return $sizes;
	}
}

/**
* Fire the wp_body_open action.
*
* Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
if ( ! function_exists( 'wp_body_open' ) ) {
  function wp_body_open() {
     /**
      * Triggered after the opening <body> tag.
      */
     do_action('wp_body_open');
  }
}
  



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once YOLOX_THEME_DIR . 'includes/utils.php';
require_once YOLOX_THEME_DIR . 'includes/storage.php';

require_once YOLOX_THEME_DIR . 'includes/lists.php';
require_once YOLOX_THEME_DIR . 'includes/wp.php';

if ( is_admin() ) {
	require_once YOLOX_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once YOLOX_THEME_DIR . 'includes/admin.php';
}

require_once YOLOX_THEME_DIR . 'theme-options/theme-customizer.php';

require_once YOLOX_THEME_DIR . 'front-page/front-page-options.php';

require_once YOLOX_THEME_DIR . 'theme-specific/theme-tags.php';
require_once YOLOX_THEME_DIR . 'theme-specific/theme-hovers/theme-hovers.php';
require_once YOLOX_THEME_DIR . 'theme-specific/theme-about/theme-about.php';

// Free themes support
if ( YOLOX_THEME_FREE ) {
	require_once YOLOX_THEME_DIR . 'theme-specific/theme-about/theme-upgrade.php';
}

// Plugins support
$yolox_required_plugins = yolox_storage_get( 'required_plugins' );
if ( is_array( $yolox_required_plugins ) ) {
	foreach ( $yolox_required_plugins as $plugin_slug => $plugin_name ) {
		$plugin_slug = yolox_esc( $plugin_slug );
		$plugin_path = YOLOX_THEME_DIR . sprintf( 'plugins/%s/%s.php', $plugin_slug, $plugin_slug );
		if ( file_exists( $plugin_path ) ) {
			require_once $plugin_path; }
	}
}

// Theme skins support
if ( defined( 'YOLOX_ALLOW_SKINS' ) && YOLOX_ALLOW_SKINS && file_exists( YOLOX_THEME_DIR . 'skins/skins.php' ) ) {
	require_once YOLOX_THEME_DIR . 'skins/skins.php';
}
