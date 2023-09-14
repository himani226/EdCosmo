<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0.22
 */

// If this theme is a free version of premium theme
if ( ! defined( 'YOLOX_THEME_FREE' ) ) {
	define( 'YOLOX_THEME_FREE', false );
}
if ( ! defined( 'YOLOX_THEME_FREE_WP' ) ) {
	define( 'YOLOX_THEME_FREE_WP', false );
}

// If this theme uses multiple skins
if ( ! defined( 'YOLOX_ALLOW_SKINS' ) ) {
	define( 'YOLOX_ALLOW_SKINS', true );
}
if ( ! defined( 'YOLOX_DEFAULT_SKIN' ) ) {
	define( 'YOLOX_DEFAULT_SKIN', 'default' );
}

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['YOLOX_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins'   => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'         => esc_html__( 'ThemeREX Addons', 'yolox' ),

			// If theme use OCDI instead (or both) ThemeREX Addons Installer
			// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'elementor'          => esc_html__( 'Elementor', 'yolox' ),
			'contact-form-7'     => esc_html__( 'Contact Form 7', 'yolox' ),
			'mailchimp-for-wp'   => esc_html__( 'MailChimp for WP', 'yolox' ),
            'instagram-feed'     => esc_html__( 'Instagram Feed', 'yolox' ),
            'the-events-calendar' => esc_html__( 'The Events Calendar', 'yolox' ),
            'trx_updater'		 => esc_html__( 'TRX Updater', 'yolox' ),
			// GDPR Support: uncomment only one of two following plugins
			'wp-gdpr-compliance' => esc_html__( 'Cookie Information', 'yolox' ),
            'social-pug'        => esc_html__( 'Social Sharing WordPress Plugin – Social Pug', 'yolox' ),
		),
		// List of plugins for the FREE version only
		//-----------------------------------------------------
		YOLOX_THEME_FREE
			? array(
				// Recommended (supported) plugins for the FREE (lite) version
				'siteorigin-panels' => esc_html__( 'SiteOrigin Panels', 'yolox' ),
			)

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array()
	),

	// Theme-specific blog layouts
	'blog_styles'        => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt' => array(
				'title'   => esc_html__( 'Standard', 'yolox' ),
				'archive' => 'index-excerpt',
				'item'    => 'content-excerpt',
				'styles'  => 'excerpt',
			),
			'classic' => array(
				'title'   => esc_html__( 'Classic', 'yolox' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'classic',
			),
		),
		// Layouts for the FREE version only
		//-----------------------------------------------------
		YOLOX_THEME_FREE
		? array()

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'masonry'   => array(
				'title'   => esc_html__( 'Masonry', 'yolox' ),
				'archive' => 'index-classic',
				'item'    => 'content-classic',
				'columns' => array( 2, 3 ),
				'styles'  => 'masonry',
			),
			'portfolio' => array(
				'title'   => esc_html__( 'Portfolio', 'yolox' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio',
				'columns' => array( 2, 3, 4 ),
				'styles'  => 'portfolio',
			),
			'gallery'   => array(
				'title'   => esc_html__( 'Gallery', 'yolox' ),
				'archive' => 'index-portfolio',
				'item'    => 'content-portfolio-gallery',
				'columns' => array( 2, 3, 4 ),
				'styles'  => array( 'portfolio', 'gallery' ),
			),
			'chess'     => array(
				'title'   => esc_html__( 'Chess', 'yolox' ),
				'archive' => 'index-chess',
				'item'    => 'content-chess',
				'columns' => array( 1, 2, 3 ),
				'styles'  => 'chess',
			),
		)
	),

	// Key validator: market[env|loc]-vendor[|ancora|]
	'theme_pro_key'      => 'env-ancora',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'     => '//yolox.ancorathemes.com',
	'theme_doc_url'      => '//yolox.ancorathemes.com/doc',
	'theme_download_url' => '//themeforest.net/item/yolox-modern-wordpress-blog-theme-for-business-startup/23702588',

	'theme_support_url'  => '//themerex.net/support/',                    

	'theme_video_url'    => '//www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',  

	'theme_privacy_url'  => '//ancorathemes.com/privacy-policy/',                   


	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'   => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'         => array(
		// By device
		'wide'     => array(
			'min' => 2160
		),
		'desktop'  => array(
			'min' => 1680,
			'max' => 2159,
		),
		'notebook' => array(
			'min' => 1280,
			'max' => 1679,
		),
		'tablet'   => array(
			'min' => 768,
			'max' => 1279,
		),
		'mobile'   => array( 'max' => 767 ),
		// By size
		'xxl'      => array( 'max' => 1679 ),
		'xl'       => array( 'max' => 1439 ),
		'lg'       => array( 'max' => 1279 ),
		'md'       => array( 'max' => 1023 ),
		'sm'       => array( 'max' => 767 ),
		'sm_wp'    => array( 'max' => 600 ),
		'xs'       => array( 'max' => 479 ),
	),
);

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

if ( ! function_exists( 'yolox_customizer_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'yolox_customizer_theme_setup1', 1 );
	function yolox_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		yolox_storage_set(
			'settings', array(

				'duplicate_options'      => 'child',            // none  - use separate options for the main and the child-theme
																// child - duplicate theme options from the main theme to the child-theme only
																// both  - sinchronize changes in the theme options between main and child themes

				'customize_refresh'      => 'auto',             // Refresh method for preview area in the Appearance - Customize:
																// auto - refresh preview area on change each field with Theme Options
																// manual - refresh only obn press button 'Refresh' at the top of Customize frame

				'max_load_fonts'         => 5,                  // Max fonts number to load from Google fonts or from uploaded fonts

				'comment_after_name'     => true,               // Place 'comment' field after the 'name' and 'email'

				'icons_selector'         => 'internal',         // Icons selector in the shortcodes:
																// standard VC (very slow) or Elementor's icons selector (not support images and svg)
																// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

				'icons_type'             => 'icons',            // Type of icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present icons
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'socials_type'           => 'icons',            // Type of socials icons (if 'icons_selector' is 'internal'):
																// icons  - use font icons to present social networks
																// images - use images from theme's folder trx_addons/css/icons.png
																// svg    - use svg from theme's folder trx_addons/css/icons.svg

				'check_min_version'      => true,               // Check if exists a .min version of .css and .js and return path to it
																// instead the path to the original file
																// (if debug_mode is off and modification time of the original file < time of the .min file)

				'autoselect_menu'        => false,              // Show any menu if no menu selected in the location 'main_menu'
																// (for example, the theme is just activated)

				'disable_jquery_ui'      => false,              // Prevent loading custom jQuery UI libraries in the third-party plugins

				'use_mediaelements'      => true,               // Load script "Media Elements" to play video and audio

				'tgmpa_upload'           => false,              // Allow upload not pre-packaged plugins via TGMPA

				'allow_no_image'         => false,              // Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

				'separate_schemes'       => true,               // Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

				'allow_fullscreen'       => false,              // Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
																// In the Page Options this styles are present always
																// (can be removed if filter 'yolox_filter_allow_fullscreen' return false)

				'attachments_navigation' => false,              // Add arrows on the single attachment page to navigate to the prev/next attachment
				
				'gutenberg_safe_mode'    => array(),            // 'vc', 'elementor' - Prevent simultaneous editing of posts for Gutenberg and other PageBuilders (VC, Elementor)

				'allow_gutenberg_blocks' => true,               // Allow our shortcodes and widgets as blocks in the Gutenberg (not ready yet - in the development now)

				'subtitle_above_title'   => true,               // Put subtitle above the title in the shortcodes

				'add_hide_on_xxx' => 'replace',                 // Add our breakpoints to the Responsive section of each element
																// 'add' - add our breakpoints after Elementor's
																// 'replace' - add our breakpoints instead Elementor's
																// 'none' - don't add our breakpoints (using only Elementor's)
			)
		);

		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------

		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
				yolox_storage_set(
			'load_fonts', array(

                // Google font
                array(
                    'name'   => 'Roboto',
                    'family' => 'sans-serif',
                    'styles' => '300,400,500,700',     // Parameter 'style' used only for the Google fonts
                ),
                array(
                    'name'   => 'Quicksand',
                    'family' => 'sans-serif',
                    'styles' => '400,500,700',     // Parameter 'style' used only for the Google fonts
                ),
                array(
                    'name'   => 'Open Sans',
                    'family' => 'sans-serif',
                    'styles' => '400,400i,600,600i',     // Parameter 'style' used only for the Google fonts
                ),
                array(
                    'name'   => 'Jost',
                    'family' => 'sans-serif',
                ),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		yolox_storage_set( 'load_fonts_subset', 'latin,latin-ext' );


		yolox_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'yolox' ),
					'description'     => esc_html__( 'Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'yolox' ),
					'font-family'     => '"Open Sans",sans-serif',
					'font-size'       => '1em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.563em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.5px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.9em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'yolox' ),
					'font-family'     => '"Jost",sans-serif',
					'font-size'       => '2.250em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-1.5px',
					'margin-top'      => '1.6em',
					'margin-bottom'   => '0.8em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '1.813em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.0952em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.8px',
					'margin-top'      => '1.8em',
					'margin-bottom'   => '0.7em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '1.688em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.1515em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.3px',
					'margin-top'      => '1.9em',
					'margin-bottom'   => '0.65em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '1.438em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.2em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.5px',
					'margin-top'      => '1.9em',
					'margin-bottom'   => '0.85em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '1.250em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.2em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.5px',
					'margin-top'      => '1.8em',
					'margin-bottom'   => '0.9em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '1.125em',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.2em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.5px',
					'margin-top'      => '2.2em',
					'margin-bottom'   => '1em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'yolox' ),
					'description'     => esc_html__( 'Font settings of the text case of the logo', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '1.8em',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'uppercase',
					'letter-spacing'  => '1px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'yolox' ),
                    'font-family'     => '"Jost",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '16px',
					'text-decoration' => 'none',
					'text-transform'  => 'capitalize',
					'letter-spacing'  => '0',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'yolox' ),
					'description'     => esc_html__( 'Font settings of the input fields, dropdowns and textareas', 'yolox' ),
					'font-family'     => 'inherit',
					'font-size'       => '13px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em', // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'yolox' ),
					'description'     => esc_html__( 'Font settings of the post meta: date, counters, share, etc.', 'yolox' ),
					'font-family'     => 'inherit',
					'font-size'       => '14px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'yolox' ),
					'description'     => esc_html__( 'Font settings of the main menu items', 'yolox' ),
					'font-family'     => '"Quicksand",sans-serif',
					'font-size'       => '18px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'yolox' ),
					'description'     => esc_html__( 'Font settings of the dropdown menu items', 'yolox' ),
					'font-family'     => '"Quicksand",sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
			)
		);

		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		yolox_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'yolox' ),
					'description' => esc_html__( 'Colors of the main content area', 'yolox' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'yolox' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'yolox' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'yolox' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'yolox' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'yolox' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'yolox' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'yolox' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'yolox' ),
				),
			)
		);
		yolox_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'yolox' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'yolox' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'yolox' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'yolox' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'yolox' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'yolox' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'yolox' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'yolox' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'yolox' ),
					'description' => esc_html__( 'Color of the plain text inside this block', 'yolox' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'yolox' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'yolox' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'yolox' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'yolox' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'yolox' ),
					'description' => esc_html__( 'Color of the links inside this block', 'yolox' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'yolox' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'yolox' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Link 2', 'yolox' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'yolox' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Link 2 hover', 'yolox' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'yolox' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Link 3', 'yolox' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'yolox' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Link 3 hover', 'yolox' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'yolox' ),
				),
			)
		);
		yolox_storage_set(
			'schemes', array(

				// Color scheme: 'default'
				'default' => array(
					'title'    => esc_html__( 'Default', 'yolox' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#edf3f5',
						'bd_color'         => '#e0e0e0',

						// Text and links colors
						'text'             => '#4c5560',
						'text_light'       => '#888f96',
						'text_dark'        => '#29313a',
						'text_link'        => '#f25035',
						'text_hover'       => '#ea3e21',
						'text_link2'       => '#4353ff',
						'text_hover2'      => '#3040ee',
						'text_link3'       => '#57af3a',
						'text_hover3'      => '#469b2a',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#ffffff',
						'alter_bg_hover'   => '#f2f7f8',
						'alter_bd_color'   => '#ebebeb',
						'alter_bd_hover'   => '#dae2e5',
						'alter_text'       => '#4c5560',
						'alter_light'      => '#888f96',
						'alter_dark'       => '#29313a',
						'alter_link'       => '#f25035',
						'alter_hover'      => '#ea3e21',
						'alter_link2'      => '#4353ff',
						'alter_hover2'     => '#3040ee',
						'alter_link3'      => '#57af3a',
						'alter_hover3'     => '#469b2a',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#141e29',
						'extra_bg_hover'   => '#28272e',
						'extra_bd_color'   => '#26323f',
						'extra_bd_hover'   => '#ededed',
						'extra_text'       => '#b4c2d1',
						'extra_light'      => '#888f96',
						'extra_dark'       => '#b4c2d1',
						'extra_link'       => '#f25035',
						'extra_hover'      => '#888f96',
						'extra_link2'      => '#141e29',
						'extra_hover2'     => '#141e29',
						'extra_link3'      => '#a1a9ff',
						'extra_hover3'     => '#141e29',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#ffffff',
						'input_bg_hover'   => '#ffffff',
						'input_bd_color'   => '#e7eaed',
						'input_bd_hover'   => '#d9d9d9',
						'input_text'       => '#888f96',
						'input_light'      => '#a7a7a7',
						'input_dark'       => '#4c5560',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#67bcc1',
						'inverse_bd_hover' => '#5aa4a9',
						'inverse_text'     => '#ffffff',
						'inverse_light'    => '#333333',
						'inverse_dark'     => '#29313a',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#ffffff',
					),
				),

				// Color scheme: 'dark'
				'dark'    => array(
					'title'    => esc_html__( 'Dark', 'yolox' ),
					'internal' => true,
					'colors'   => array(

						// Whole block border and background
						'bg_color'         => '#141e29',
						'bd_color'         => '#26323f',

						// Text and links colors
						'text'             => '#b4c2d1',
						'text_light'       => '#9ca9b6',
						'text_dark'        => '#ffffff',
						'text_link'        => '#f25035',
						'text_hover'       => '#ea3e21',
						'text_link2'       => '#4353ff',
						'text_hover2'      => '#3040ee',
						'text_link3'       => '#57af3a',
						'text_hover3'      => '#469b2a',

						// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
						'alter_bg_color'   => '#0e161f',
						'alter_bg_hover'   => '#18232f',
						'alter_bd_color'   => '#1e2832',
						'alter_bd_hover'   => '#4a4a4a',
						'alter_text'       => '#b4c2d1',
						'alter_light'      => '#9ca9b6',
						'alter_dark'       => '#ffffff',
						'alter_link'       => '#f25035',
						'alter_hover'      => '#ea3e21',
						'alter_link2'      => '#4353ff',
						'alter_hover2'     => '#3040ee',
						'alter_link3'      => '#57af3a',
						'alter_hover3'     => '#469b2a',

						// Extra blocks (submenu, tabs, color blocks, etc.)
						'extra_bg_color'   => '#ffffff',
						'extra_bg_hover'   => '#f3f5f7',
						'extra_bd_color'   => '#ebebeb',
						'extra_bd_hover'   => '#ededed',
						'extra_text'       => '#4c5560',
						'extra_light'      => '#d0d3da',
						'extra_dark'       => '#4c5560',
						'extra_link'       => '#f25035',
						'extra_hover'      => '#ffffff',
						'extra_link2'      => '#b4c2d1',
						'extra_hover2'     => '#1e2a36',
						'extra_link3'      => '#ddb837',
						'extra_hover3'     => '#141e29',

						// Input fields (form's fields and textarea)
						'input_bg_color'   => '#141e29',
						'input_bg_hover'   => '#121c26',
						'input_bd_color'   => '#1d2733',
						'input_bd_hover'   => '#29333e',
						'input_text'       => '#b4c2d1',
						'input_light'      => '#6f6f6f',
						'input_dark'       => '#ffffff',

						// Inverse blocks (text and links on the 'text_link' background)
						'inverse_bd_color' => '#e36650',
						'inverse_bd_hover' => '#cb5b47',
						'inverse_text'     => '#f4f4f4',
						'inverse_light'    => '#6f6f6f',
						'inverse_dark'     => '#2b2b2d',
						'inverse_link'     => '#ffffff',
						'inverse_hover'    => '#ffffff',
					),
				),

			)
		);
        yolox_storage_set( 'schemes_original', yolox_storage_get( 'schemes' ) );
		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		yolox_storage_set(
			'schemes_simple', array(
				'text_link'        => array(
					'alter_hover'      => 1,
					'extra_link'       => 1,
					'inverse_bd_color' => 0.85,
					'inverse_bd_hover' => 0.7,
				),
				'text_hover'       => array(
					'alter_link'  => 1,
					'extra_hover' => 1,
				),
				'text_link2'       => array(
					'alter_hover2' => 1,
					'extra_link2'  => 1,
				),
				'text_hover2'      => array(
					'alter_link2'  => 1,
					'extra_hover2' => 1,
				),
				'text_link3'       => array(
					'alter_hover3' => 1,
					'extra_link3'  => 1,
				),
				'text_hover3'      => array(
					'alter_link3'  => 1,
					'extra_hover3' => 1,
				),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
				'inverse_bd_color' => array(),
				'inverse_bd_hover' => array(),
			)
		);

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		yolox_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
				'text_link_03'      => array(
					'color' => 'text_link2',
					'alpha' => 0.3,
				),
				'text_link_05'      => array(
					'color' => 'text_link2',
					'alpha' => 0.5,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'inverse_link_02'      => array(
					'color' => 'inverse_link',
					'alpha' => 0.2,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Parameters to set order of schemes in the css
		yolox_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		yolox_storage_set(
			'theme_thumbs', apply_filters(
				'yolox_filter_add_thumb_sizes', array(
					// Width of the image is equal to the content area width (without sidebar)
					// Height is fixed
					'yolox-thumb-huge'        => array(
						'size'  => array( 1170, 658, true ),
						'title' => esc_html__( 'Huge image', 'yolox' ),
						'subst' => 'trx_addons-thumb-huge',
					),
					// Width of the image is equal to the content area width (with sidebar)
					// Height is fixed
					'yolox-thumb-big'         => array(
						'size'  => array( 770, 452, true ),
						'title' => esc_html__( 'Large image', 'yolox' ),
						'subst' => 'trx_addons-thumb-big',
					),

					// Width of the image is equal to the 1/3 of the content area width (without sidebar)
					// Height is fixed
					'yolox-thumb-med'         => array(
						'size'  => array( 370, 208, true ),
						'title' => esc_html__( 'Medium image', 'yolox' ),
						'subst' => 'trx_addons-thumb-medium',
					),

					// Small square image (for avatars in comments, etc.)
					'yolox-thumb-tiny'        => array(
						'size'  => array( 90, 90, true ),
						'title' => esc_html__( 'Small square avatar', 'yolox' ),
						'subst' => 'trx_addons-thumb-tiny',
					),

					// Width of the image is equal to the content area width (with sidebar)
					// Height is proportional (only downscale, not crop)
					'yolox-thumb-masonry-big' => array(
						'size'  => array( 760, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry Large (scaled)', 'yolox' ),
						'subst' => 'trx_addons-thumb-masonry-big',
					),

					// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
					// Height is proportional (only downscale, not crop)
					'yolox-thumb-masonry'     => array(
						'size'  => array( 370, 0, false ),     // Only downscale, not crop
						'title' => esc_html__( 'Masonry (scaled)', 'yolox' ),
						'subst' => 'trx_addons-thumb-masonry',
					),
                    // Small square image (for avatars in comments, etc.)
                    'yolox-thumb-sidebar'        => array(
                        'size'  => array( 202, 151, true ),
                        'title' => esc_html__( 'Small square avatar for sidebar', 'yolox' ),
                        'subst' => 'trx_addons-thumb-sidebar',
                    ),
                    // Small square image (for avatars in related posts, etc.)
                    'yolox-thumb-related'        => array(
                        'size'  => array( 350, 288, true ),
                        'title' => esc_html__( 'Small square avatar for related posts', 'yolox' ),
                        'subst' => 'trx_addons-thumb-related',
                    ),
                    // Big square image (for blogger default, etc.)
                    'yolox-thumb-blogger-big'        => array(
                        'size'  => array( 570, 396, true ),
                        'title' => esc_html__( 'Big square image for blogger', 'yolox' ),
                        'subst' => 'trx_addons-thumb-blogger-big',
                    ),
                    // Big square image (for blogger default, etc.)
                    'yolox-thumb-blogger-med'        => array(
                        'size'  => array( 390, 260, true ),
                        'title' => esc_html__( 'Medium square image for blogger', 'yolox' ),
                        'subst' => 'trx_addons-thumb-blogger-med',
                    ),
                    // Big square image (for blogger default, etc.)
                    'yolox-thumb-blogger-small'        => array(
                        'size'  => array( 270, 220, true ),
                        'title' => esc_html__( 'Small square image for blogger', 'yolox' ),
                        'subst' => 'trx_addons-thumb-blogger-small',
                    ),
                    // Team short square image (for blogger default, etc.)
                    'yolox-thumb-team-short'        => array(
                        'size'  => array( 260, 306, true ),
                        'title' => esc_html__( 'Medium square image for team', 'yolox' ),
                        'subst' => 'trx_addons-thumb-team-short',
                    ),
                    // Team short square image (for blogger default, etc.)
                    'yolox-thumb-cat-list'        => array(
                        'size'  => array( 270, 307, true ),
                        'title' => esc_html__( 'Medium square image for team', 'yolox' ),
                        'subst' => 'trx_addons-thumb-cat-list',
                    ),
                    // Team short square image (for blogger default, etc.)
                    'yolox-thumb-news-excerpt'        => array(
                        'size'  => array( 300, 276, true ),
                        'title' => esc_html__( 'Medium square image for news Excerpt', 'yolox' ),
                        'subst' => 'trx_addons-thumb-news-excerpt',
                    ),
                    // Big square image (for blogger absolute, etc.)
                    'yolox-thumb-blogger-absolute-med'        => array(
                        'size'  => array( 554, 397, true ),
                        'title' => esc_html__( 'Med square image for blogger', 'yolox' ),
                        'subst' => 'trx_addons-thumb-blogger-absolute-med',
                    ),
                    // Big square image (for blogger absolute, etc.)
                    'yolox-thumb-blogger-absolute-big'        => array(
                        'size'  => array( 770, 395, true ),
                        'title' => esc_html__( 'Big square image for blogger', 'yolox' ),
                        'subst' => 'trx_addons-thumb-blogger-absolute-big',
                    ),
                    // Big square image (for blogger absolute, etc.)
                    'yolox-thumb-team-single'        => array(
                        'size'  => array( 359, 395, true ),
                        'title' => esc_html__( 'Big square image for single team', 'yolox' ),
                        'subst' => 'trx_addons-thumb-team-single',
                    ),
				)
			)
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( ! function_exists( 'yolox_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'yolox_importer_set_options', 9 );
	function yolox_importer_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url( yolox_get_protocol() . '://demofiles.ancorathemes.com/yolox/' );
			// Required plugins
			$options['required_plugins'] = array_keys( yolox_storage_get( 'required_plugins' ) );
			// Set number of thumbnails (usually 3 - 5) to regenerate at once when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 1;
			// Default demo
			$options['files']['default']['title']       = esc_html__( 'Yolox Demo', 'yolox' );
			$options['files']['default']['domain_dev']  = '';       // Developers domain
			$options['files']['default']['domain_demo'] = esc_url( yolox_get_protocol() . '://yolox.ancorathemes.com' );       // Demo-site domain

			$options['banners'] = array(
				array(
					'image'        => yolox_get_file_url( 'theme-specific/theme-about/images/frontpage.png' ),
					'title'        => esc_html__( 'Front Page Builder', 'yolox' ),
					'content'      => wp_kses( __( "Create your front page right in the WordPress Customizer. There's no need in any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'yolox' ), 'yolox_kses_content' ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=oVPNrwSJGhs' ),
					'link_caption' => esc_html__( 'Watch Video Introduction', 'yolox' ),
					'duration'     => 20,
				),
				array(
					'image'        => yolox_get_file_url( 'theme-specific/theme-about/images/layouts.png' ),
					'title'        => esc_html__( 'Layouts Builder', 'yolox' ),
					'content'      => wp_kses( __( 'Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'yolox' ), 'yolox_kses_content' ),
					'link_url'     => esc_url( '//www.youtube.com/watch?v=wZIfqi8wTWo' ),
					'link_caption' => esc_html__( 'Learn More', 'yolox' ),
					'duration'     => 20,
				),
				array(
					'image'        => yolox_get_file_url( 'theme-specific/theme-about/images/documentation.png' ),
					'title'        => esc_html__( 'Read Full Documentation', 'yolox' ),
					'content'      => wp_kses( __( 'Need more details? Please check our full online documentation for detailed information on how to use Yolox.', 'yolox' ), 'yolox_kses_content' ),
					'link_url'     => esc_url( yolox_storage_get( 'theme_doc_url' ) ),
					'link_caption' => esc_html__( 'Online Documentation', 'yolox' ),
					'duration'     => 15,
				),
				array(
					'image'        => yolox_get_file_url( 'theme-specific/theme-about/images/video-tutorials.png' ),
					'title'        => esc_html__( 'Video Tutorials', 'yolox' ),
					'content'      => wp_kses( __( 'No time for reading documentation? Check out our video tutorials and learn how to customize Yolox in detail.', 'yolox' ), 'yolox_kses_content' ),
					'link_url'     => esc_url( yolox_storage_get( 'theme_video_url' ) ),
					'link_caption' => esc_html__( 'Video Tutorials', 'yolox' ),
					'duration'     => 15,
				),
				array(
					'image'        => yolox_get_file_url( 'theme-specific/theme-about/images/studio.png' ),
					'title'        => esc_html__( 'Website Customization', 'yolox' ),
					'content'      => wp_kses( __( "Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'yolox' ), 'yolox_kses_content' ),
					'link_url'     => esc_url( '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themedash' ),
					'link_caption' => esc_html__( 'Contact Us', 'yolox' ),
					'duration'     => 25,
				),
			);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( ! function_exists( 'yolox_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'yolox_ocdi_set_options', 9 );
	function yolox_ocdi_set_options( $options = array() ) {
		if ( is_array( $options ) ) {
			// Prepare demo data
			$options['demo_url'] = esc_url( yolox_get_protocol() . '://demofiles.ancorathemes.com/yolox/' );
			// Required plugins
			$options['required_plugins'] = array_keys( yolox_storage_get( 'required_plugins' ) );
			// Demo-site domain
			$options['files']['ocdi']['title']       = esc_html__( 'Yolox OCDI Demo', 'yolox' );
			$options['files']['ocdi']['domain_demo'] = esc_url( 'http://yolox.ancorathemes.com' );
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if ( ! function_exists( 'yolox_create_theme_options' ) ) {

	function yolox_create_theme_options() {

		// Message about options override.
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = wp_kses_data( __( 'Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages. If you changed such parameter and nothing happened on the page, this option may be overridden in the corresponding section or in the Page Options of this page. These options are marked with an asterisk (*) in the title.', 'yolox' ));

		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count( yolox_storage_get( 'schemes' ) ) < 2;

		yolox_storage_set(
			'options', array(

				// 'Logo & Site Identity'
				'title_tagline'                 => array(
					'title'    => esc_html__( 'Logo & Site Identity', 'yolox' ),
					'desc'     => '',
					'priority' => 10,
					'type'     => 'section',
				),
				'logo_info'                     => array(
					'title'    => esc_html__( 'Logo Settings', 'yolox' ),
					'desc'     => '',
					'priority' => 20,
					'qsetup'   => esc_html__( 'General', 'yolox' ),
					'type'     => 'info',
				),
				'logo_text'                     => array(
					'title'    => esc_html__( 'Use Site Name as Logo', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Use the site title and tagline as a text logo if no image is selected', 'yolox' ) ),
					'class'    => 'yolox_column-1_2 yolox_new_row',
					'priority' => 30,
					'std'      => 1,
					'qsetup'   => esc_html__( 'General', 'yolox' ),
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_retina_enabled'           => array(
					'title'    => esc_html__( 'Allow retina display logo', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Show fields to select logo images for Retina display', 'yolox' ) ),
					'class'    => 'yolox_column-1_2',
					'priority' => 40,
					'refresh'  => false,
					'std'      => 0,
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'logo_zoom'                     => array(
					'title'   => esc_html__( 'Logo zoom', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Zoom the logo. 1 - original size. Maximum size of logo depends on the actual size of the picture', 'yolox' ) ),
					'std'     => 1,
					'min'     => 0.2,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'slider',
				),
				// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
				'logo_retina'                   => array(
					'title'      => esc_html__( 'Logo for Retina', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'yolox' ) ),
					'class'      => 'yolox_column-1_2',
					'priority'   => 70,
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile_header'            => array(
					'title' => esc_html__( 'Logo for the mobile header', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'yolox' ) ),
					'class' => 'yolox_column-1_2 yolox_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_header_retina'     => array(
					'title'      => esc_html__( 'Logo for the mobile header on Retina', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'yolox' ) ),
					'class'      => 'yolox_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_mobile'                   => array(
					'title' => esc_html__( 'Logo for the mobile menu', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo to display it in the mobile menu', 'yolox' ) ),
					'class' => 'yolox_column-1_2 yolox_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_mobile_retina'            => array(
					'title'      => esc_html__( 'Logo mobile on Retina', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'yolox' ) ),
					'class'      => 'yolox_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'image',
				),
				'logo_side'                     => array(
					'title' => esc_html__( 'Logo for the side menu', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu', 'yolox' ) ),
					'class' => 'yolox_column-1_2 yolox_new_row',
					'std'   => '',
					'type'  => 'image',
				),
				'logo_side_retina'              => array(
					'title'      => esc_html__( 'Logo for the side menu on Retina', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'yolox' ) ),
					'class'      => 'yolox_column-1_2',
					'dependency' => array(
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'image',
				),

				// 'General settings'
				'general'                       => array(
					'title'    => esc_html__( 'General Settings', 'yolox' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 20,
					'type'     => 'section',
				),

				'general_layout_info'           => array(
					'title'  => esc_html__( 'Layout', 'yolox' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'yolox' ),
					'type'   => 'info',
				),
				'body_style'                    => array(
					'title'    => esc_html__( 'Body style', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select width of the body content', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'qsetup'   => esc_html__( 'General', 'yolox' ),
					'refresh'  => false,
					'std'      => 'wide',
					'options'  => yolox_get_list_body_styles( false ),
					'type'     => 'select',
				),
				'page_width'                    => array(
					'title'      => esc_html__( 'Page width', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Total width of the site content and sidebar (in pixels). If empty - use default width', 'yolox' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed', 'wide' ),
					),
					'std'        => 1170,
					'min'        => 1000,
					'max'        => 1400,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'page',         // SASS variable's name to preview changes 'on fly'
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'slider',
				),
				'boxed_bg_image'                => array(
					'title'      => esc_html__( 'Boxed bg image', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload image, used as background in the boxed body', 'yolox' ) ),
					'dependency' => array(
						'body_style' => array( 'boxed' ),
					),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'std'        => '',
					'qsetup'     => esc_html__( 'General', 'yolox' ),
										'type'       => 'image',
				),
				'remove_margins'                => array(
					'title'    => esc_html__( 'Remove margins', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Remove margins above and below the content area', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'refresh'  => false,
					'std'      => 0,
					'type'     => 'checkbox',
				),

				'general_sidebar_info'          => array(
					'title' => esc_html__( 'Sidebar', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position'              => array(
					'title'    => esc_html__( 'Sidebar position', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select position to show sidebar', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,post,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'yolox' ),
					),
					'std'      => 'right',
					'qsetup'   => esc_html__( 'General', 'yolox' ),
					'options'  => array(),
					'type'     => 'switch',
				),
				'sidebar_widgets'               => array(
					'title'      => esc_html__( 'Sidebar widgets', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'yolox' ),
					),
					'dependency' => array(
						'sidebar_position' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'yolox' ),
					'type'       => 'select',
				),
				'sidebar_width'                 => array(
					'title'      => esc_html__( 'Sidebar width', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Width of the sidebar (in pixels). If empty - use default width', 'yolox' ) ),
					'std'        => 370,
					'min'        => 150,
					'max'        => 500,
					'step'       => 10,
					'refresh'    => false,
					'customizer' => 'sidebar',      // SASS variable's name to preview changes 'on fly'
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'slider',
				),
				'sidebar_gap'                   => array(
					'title'      => esc_html__( 'Sidebar gap', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Gap between content and sidebar (in pixels). If empty - use default gap', 'yolox' ) ),
					'std'        => 30,
					'min'        => 0,
					'max'        => 100,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'gap',          // SASS variable's name to preview changes 'on fly'
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'slider',
				),
				'expand_content'                => array(
					'title'   => esc_html__( 'Expand content', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'yolox' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'general_widgets_info'          => array(
					'title' => esc_html__( 'Additional widgets', 'yolox' ),
					'desc'  => '',
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_above_page'            => array(
					'title'    => esc_html__( 'Widgets at the top of the page', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'yolox' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_above_content'         => array(
					'title'    => esc_html__( 'Widgets above the content', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'yolox' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_below_content'         => array(
					'title'    => esc_html__( 'Widgets below the content', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'yolox' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_below_page'            => array(
					'title'    => esc_html__( 'Widgets at the bottom of the page', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Widgets', 'yolox' ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),

				'general_effects_info'          => array(
					'title' => esc_html__( 'Design & Effects', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'border_radius'                 => array(
					'title'      => esc_html__( 'Border radius', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Specify the border radius of the form fields and buttons in pixels', 'yolox' ) ),
					'std'        => 50,
					'min'        => 0,
					'max'        => 50,
					'step'       => 1,
					'refresh'    => false,
					'customizer' => 'rad',      // SASS name to preview changes 'on fly'
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'slider',
				),

				'general_misc_info'             => array(
					'title' => esc_html__( 'Miscellaneous', 'yolox' ),
					'desc'  => '',
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'info',
				),
				'seo_snippets'                  => array(
					'title' => esc_html__( 'SEO snippets', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Add structured data markup to the single posts and pages', 'yolox' ) ),
					'std'   => 0,
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'privacy_text' => array(
                    "title" => esc_html__("Text with Privacy Policy link", 'yolox'),
                    "desc"  => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'yolox') ),
                    "std"   => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'yolox') ),
                    "type"  => "text"
                ),

				// 'Header'
				'header'                        => array(
					'title'    => esc_html__( 'Header', 'yolox' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 30,
					'type'     => 'section',
				),

				'header_style_info'             => array(
					'title' => esc_html__( 'Header style', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'header_type'                   => array(
					'title'    => esc_html__( 'Header style', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'std'      => 'default',
					'options'  => yolox_get_list_header_footer_types(),
					'type'     => YOLOX_THEME_FREE || ! yolox_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'header_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'yolox' ),
					'desc'       => wp_kses( __( 'Select custom header from Layouts Builder', 'yolox' ), 'yolox_kses_content' ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'dependency' => array(
						'header_type' => array( 'custom' ),
					),
					'std'        => YOLOX_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'header_position'               => array(
					'title'    => esc_html__( 'Header position', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select position to display the site header', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'switch',
				),
				'header_fullheight'             => array(
					'title'    => esc_html__( 'Header fullheight', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Enlarge header area to fill whole screen. Used only if header have a background image', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'std'      => 0,
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_zoom'                   => array(
					'title'   => esc_html__( 'Header zoom', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Zoom the header title. 1 - original size', 'yolox' ) ),
					'std'     => 1,
					'min'     => 0.3,
					'max'     => 2,
					'step'    => 0.1,
					'refresh' => false,
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'slider',
				),
				'header_wide'                   => array(
					'title'      => esc_html__( 'Header fullwidth', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the header widgets area to the entire window width?', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 1,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_widgets_info'           => array(
					'title' => esc_html__( 'Header widgets', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Here you can place a widget slider, advertising banners, etc.', 'yolox' ) ),
					'type'  => 'info',
				),
				'header_widgets'                => array(
					'title'    => esc_html__( 'Header widgets', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select set of widgets to show in the header on each page', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
						'desc'    => wp_kses_data( __( 'Select set of widgets to show in the header on this page', 'yolox' ) ),
					),
					'std'      => 'hide',
					'options'  => array(),
					'type'     => 'select',
				),
				'header_columns'                => array(
					'title'      => esc_html__( 'Header columns', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'dependency' => array(
						'header_type'    => array( 'default' ),
						'header_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => yolox_get_list_range( 0, 6 ),
					'type'       => 'select',
				),

				'menu_info'                     => array(
					'title' => esc_html__( 'Main menu', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Select main menu style, position and other parameters', 'yolox' ) ),
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'info',
				),
				'menu_style'                    => array(
					'title'    => esc_html__( 'Menu position', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select position of the main menu', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'std'      => 'top',
					'options'  => array(
						'top'   => esc_html__( 'Top', 'yolox' ),
						'left'  => esc_html__( 'Left', 'yolox' ),
					),
					'type'     => YOLOX_THEME_FREE || ! yolox_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'menu_side_stretch'             => array(
					'title'      => esc_html__( 'Stretch sidemenu', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Stretch sidemenu to window height (if menu items number >= 5)', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left' ),
					),
					'std'        => 0,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_side_icons'               => array(
					'title'      => esc_html__( 'Iconed sidemenu', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'dependency' => array(
						'menu_style' => array( 'left', 'right' ),
					),
					'std'        => 1,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'menu_mobile_fullscreen'        => array(
					'title' => esc_html__( 'Mobile menu fullscreen', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'yolox' ) ),
					'std'   => 0,
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_image_info'             => array(
					'title' => esc_html__( 'Header image', 'yolox' ),
					'desc'  => '',
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'info',
				),
				'header_image_override'         => array(
					'title'    => esc_html__( 'Header image override', 'yolox' ),
					'desc'     => wp_kses_data( __( "Allow override the header image with the page's/post's/product's/etc. featured image", 'yolox' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'std'      => 0,
					'type'     => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'header_mobile_info'            => array(
					'title'      => esc_html__( 'Mobile header', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Configure the mobile version of the header', 'yolox' ) ),
					'priority'   => 500,
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'info',
				),
				'header_mobile_enabled'         => array(
					'title'      => esc_html__( 'Enable the mobile header', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Use the mobile version of the header (if checked) or relayout the current header on mobile devices', 'yolox' ) ),
					'dependency' => array(
						'header_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_additional_info' => array(
					'title'      => esc_html__( 'Additional info', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Additional info to show at the top of the mobile header', 'yolox' ) ),
					'std'        => '',
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'refresh'    => false,
					'teeny'      => false,
					'rows'       => 20,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'text_editor',
				),
				'header_mobile_hide_info'       => array(
					'title'      => esc_html__( 'Hide additional info', 'yolox' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_logo'       => array(
					'title'      => esc_html__( 'Hide logo', 'yolox' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_login'      => array(
					'title'      => esc_html__( 'Hide login/logout', 'yolox' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_search'     => array(
					'title'      => esc_html__( 'Hide search', 'yolox' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'header_mobile_hide_cart'       => array(
					'title'      => esc_html__( 'Hide cart', 'yolox' ),
					'std'        => 0,
					'dependency' => array(
						'header_type'           => array( 'default' ),
						'header_mobile_enabled' => array( 1 ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),

				// 'Footer'
				'footer'                        => array(
					'title'    => esc_html__( 'Footer', 'yolox' ),
					'desc'     => wp_kses_data( $msg_override ),
					'priority' => 50,
					'type'     => 'section',
				),
				'footer_type'                   => array(
					'title'    => esc_html__( 'Footer style', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'yolox' ),
					),
					'std'      => 'default',
					'options'  => yolox_get_list_header_footer_types(),
					'type'     => YOLOX_THEME_FREE || ! yolox_exists_trx_addons() ? 'hidden' : 'switch',
				),
				'footer_style'                  => array(
					'title'      => esc_html__( 'Select custom layout', 'yolox' ),
					'desc'       => wp_kses( __( 'Select custom footer from Layouts Builder', 'yolox' ), 'yolox_kses_content' ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'yolox' ),
					),
					'dependency' => array(
						'footer_type' => array( 'custom' ),
					),
					'std'        => YOLOX_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_widgets'                => array(
					'title'      => esc_html__( 'Footer widgets', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'yolox' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 'footer_widgets',
					'options'    => array(),
					'type'       => 'select',
				),
				'footer_columns'                => array(
					'title'      => esc_html__( 'Footer columns', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'yolox' ),
					),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'footer_widgets' => array( '^hide' ),
					),
					'std'        => 0,
					'options'    => yolox_get_list_range( 0, 6 ),
					'type'       => 'select',
				),
				'footer_wide'                   => array(
					'title'      => esc_html__( 'Footer fullwidth', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Footer', 'yolox' ),
					),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_in_footer'                => array(
					'title'      => esc_html__( 'Show logo', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show logo in the footer', 'yolox' ) ),
					'refresh'    => false,
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'logo_footer'                   => array(
					'title'      => esc_html__( 'Logo for footer', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload site logo to display it in the footer', 'yolox' ) ),
					'dependency' => array(
						'footer_type'    => array( 'default' ),
						'logo_in_footer' => array( 1 ),
					),
					'std'        => '',
					'type'       => 'image',
				),
				'logo_footer_retina'            => array(
					'title'      => esc_html__( 'Logo for footer (Retina)', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'yolox' ) ),
					'dependency' => array(
						'footer_type'         => array( 'default' ),
						'logo_in_footer'      => array( 1 ),
						'logo_retina_enabled' => array( 1 ),
					),
					'std'        => '',
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'image',
				),
				'socials_in_footer'             => array(
					'title'      => esc_html__( 'Show social icons', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show social icons in the footer (under logo or footer widgets)', 'yolox' ) ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'std'        => 0,
					'type'       => ! yolox_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'copyright'                     => array(
					'title'      => esc_html__( 'Copyright', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'yolox' ) ),
					'translate'  => true,
					'std'        => esc_html__( 'Copyright &copy; {Y} by AncoraThemes. All rights reserved.', 'yolox' ),
					'dependency' => array(
						'footer_type' => array( 'default' ),
					),
					'refresh'    => false,
					'type'       => 'textarea',
				),

				// 'Blog'
				'blog'                          => array(
					'title'    => esc_html__( 'Blog', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Options of the the blog archive', 'yolox' ) ),
					'priority' => 70,
					'type'     => 'panel',
				),

				// Blog - Posts page
				'blog_general'                  => array(
					'title' => esc_html__( 'Posts page', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Style and components of the blog archive', 'yolox' ) ),
					'type'  => 'section',
				),
				'blog_general_info'             => array(
					'title'  => esc_html__( 'Posts page settings', 'yolox' ),
					'desc'   => '',
					'qsetup' => esc_html__( 'General', 'yolox' ),
					'type'   => 'info',
				),
				'blog_style'                    => array(
					'title'      => esc_html__( 'Blog style', 'yolox' ),
					'desc'       => '',
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'excerpt',
					'qsetup'     => esc_html__( 'General', 'yolox' ),
					'options'    => array(),
					'type'       => 'select',
				),
				'first_post_large'              => array(
					'title'      => esc_html__( 'First post large', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Make your first post stand out by making it bigger', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style' => array( 'classic', 'masonry' ),
					),
					'std'        => 0,
					'type'       => 'checkbox',
				),
				'blog_content'                  => array(
					'title'      => esc_html__( 'Posts content', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Display either post excerpts or the full post content', 'yolox' ) ),
					'std'        => 'excerpt',
					'dependency' => array(
						'blog_style' => array( 'excerpt' ),
					),
					'options'    => array(
						'excerpt'  => esc_html__( 'Excerpt', 'yolox' ),
						'fullpost' => esc_html__( 'Full post', 'yolox' ),
					),
					'type'       => 'switch',
				),
				'excerpt_length'                => array(
					'title'      => esc_html__( 'Excerpt length', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged', 'yolox' ) ),
					'dependency' => array(
						'blog_style'   => array( 'excerpt' ),
						'blog_content' => array( 'excerpt' ),
					),
					'std'        => 22,
					'type'       => 'text',
				),
				'blog_columns'                  => array(
					'title'   => esc_html__( 'Blog columns', 'yolox' ),
					'desc'    => wp_kses_data( __( 'How many columns should be used in the blog archive (from 2 to 4)?', 'yolox' ) ),
					'std'     => 2,
					'options' => yolox_get_list_range( 2, 4 ),
					'type'    => 'hidden',      // This options is available and must be overriden only for some modes (for example, 'shop')
				),
				'post_type'                     => array(
					'title'      => esc_html__( 'Post type', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select post type to show in the blog archive', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'linked'     => 'parent_cat',
					'refresh'    => false,
					'hidden'     => true,
					'std'        => 'post',
					'options'    => array(),
					'type'       => 'select',
				),
				'parent_cat'                    => array(
					'title'      => esc_html__( 'Category to show', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select category to show in the blog archive', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'refresh'    => false,
					'hidden'     => true,
					'std'        => '0',
					'options'    => array(),
					'type'       => 'select',
				),
				'posts_per_page'                => array(
					'title'      => esc_html__( 'Posts per page', 'yolox' ),
					'desc'       => wp_kses_data( __( 'How many posts will be displayed on this page', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'hidden'     => true,
					'std'        => '',
					'type'       => 'text',
				),
				'blog_pagination'               => array(
					'title'      => esc_html__( 'Pagination style', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show Older/Newest posts or Page numbers below the posts list', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'std'        => 'pages',
					'qsetup'     => esc_html__( 'General', 'yolox' ),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'options'    => array(
						'pages'    => esc_html__( 'Page numbers', 'yolox' ),
						'links'    => esc_html__( 'Older/Newest', 'yolox' ),
						'more'     => esc_html__( 'Load more', 'yolox' ),
						'infinite' => esc_html__( 'Infinite scroll', 'yolox' ),
					),
					'type'       => 'select',
				),
				'blog_animation'                => array(
					'title'      => esc_html__( 'Animation for the posts', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'std'        => 'none',
					'options'    => array(),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'show_filters'                  => array(
					'title'      => esc_html__( 'Show filters', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show categories as tabs to filter posts', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
						'blog_style'     => array( 'portfolio', 'gallery' ),
					),
					'hidden'     => true,
					'std'        => 0,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),

				'blog_sidebar_info'             => array(
					'title' => esc_html__( 'Sidebar', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'sidebar_position_blog'         => array(
					'title'   => esc_html__( 'Sidebar position', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Select position to show sidebar', 'yolox' ) ),
					'std'     => 'right',
					'options' => array(),
					'qsetup'     => esc_html__( 'General', 'yolox' ),
					'type'    => 'switch',
				),
				'sidebar_widgets_blog'          => array(
					'title'      => esc_html__( 'Sidebar widgets', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select default widgets to show in the sidebar', 'yolox' ) ),
					'dependency' => array(
						'sidebar_position_blog' => array( 'left', 'right' ),
					),
					'std'        => 'sidebar_widgets',
					'options'    => array(),
					'qsetup'     => esc_html__( 'General', 'yolox' ),
					'type'       => 'select',
				),
				'expand_content_blog'           => array(
					'title'   => esc_html__( 'Expand content', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'yolox' ) ),
					'refresh' => false,
					'std'     => 1,
					'type'    => 'checkbox',
				),

				'blog_widgets_info'             => array(
					'title' => esc_html__( 'Additional widgets', 'yolox' ),
					'desc'  => '',
					'type'  => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_above_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the top of the page', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'yolox' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_above_content_blog'    => array(
					'title'   => esc_html__( 'Widgets above the content', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'yolox' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_below_content_blog'    => array(
					'title'   => esc_html__( 'Widgets below the content', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'yolox' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'widgets_below_page_blog'       => array(
					'title'   => esc_html__( 'Widgets at the bottom of the page', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'yolox' ) ),
					'std'     => 'hide',
					'options' => array(),
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),

				'blog_advanced_info'            => array(
					'title' => esc_html__( 'Advanced settings', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'no_image'                      => array(
					'title' => esc_html__( 'Image placeholder', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Select or upload an image used as placeholder for posts without a featured image', 'yolox' ) ),
					'std'   => '',
					'type'  => 'image',
				),
				'time_diff_before'              => array(
					'title' => esc_html__( 'Easy Readable Date Format', 'yolox' ),
					'desc'  => wp_kses_data( __( "For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'yolox' ) ),
					'std'   => 5,
					'type'  => 'text',
				),
				'sticky_style'                  => array(
					'title'   => esc_html__( 'Sticky posts style', 'yolox' ),
					'desc'    => wp_kses_data( __( 'Select style of the sticky posts output', 'yolox' ) ),
					'std'     => 'inherit',
					'options' => array(
						'inherit' => esc_html__( 'Decorated posts', 'yolox' ),
						'columns' => esc_html__( 'Mini-cards', 'yolox' ),
					),
					'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'meta_parts'                    => array(
					'title'      => esc_html__( 'Post meta', 'yolox' ),
					'desc'       => wp_kses_data( __( "If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'yolox' ) )
								. '<br>'
								. wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'categories=0|date=1|counters=1|author=0|share=0|edit=0',
					'options'    => yolox_get_list_meta_parts(),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checklist',
				),
				'counters'                      => array(
					'title'      => esc_html__( 'Post counters', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active', 'yolox' ) ),
					'override'   => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'compare' => 'or',
						'#page_template' => array( 'blog.php' ),
						'.editor-page-attributes__template select' => array( 'blog.php' ),
					),
					'dir'        => 'vertical',
					'sortable'   => true,
					'std'        => 'comments=1|likes=0|views=1',
					'options'    => yolox_get_list_counters(),
					'type'       => YOLOX_THEME_FREE || ! yolox_exists_trx_addons() ? 'hidden' : 'checklist',
				),

				// Blog - Single posts
				'blog_single'                   => array(
					'title' => esc_html__( 'Single posts', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Settings of the single post', 'yolox' ) ),
					'type'  => 'section',
				),


                'header_type_post'                   => array(
                    'title'    => esc_html__( 'Header style on the single post', 'yolox' ),
                    'desc'     => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'yolox' ) ),
                    'std'      => 'default',
                    'options'  => yolox_get_list_header_footer_types(),
                    'type'     => YOLOX_THEME_FREE || ! yolox_exists_trx_addons() ? 'hidden' : 'switch',
                ),
                'header_style_post'                  => array(
                    'title'      => esc_html__( 'Select custom layout', 'yolox' ),
                    'desc'       => wp_kses( __( 'Select custom header from Layouts Builder on the single post', 'yolox' ), 'yolox_kses_content' ),
                    'dependency' => array(
                        'header_type_post' => array( 'custom' ),
                    ),
                    'std'        => YOLOX_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
                    'options'    => array(),
                    'type'       => 'select',
                ),

				'hide_featured_on_single'       => array(
					'title'    => esc_html__( 'Hide featured image on the single post', 'yolox' ),
					'desc'     => wp_kses_data( __( "Hide featured image on the single post's pages", 'yolox' ) ),
					'override' => array(
						'mode'    => 'page,post',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'std'      => 0,
					'type'     => 'checkbox',
				),
				'post_thumbnail_type'      => array(
					'title'      => esc_html__( 'Type of post thumbnail', 'yolox' ),
					'desc'       => wp_kses_data( __( "Select type of post thumbnail on the single post's pages", 'yolox' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
                    'dependency' => array(
                        'hide_featured_on_single' => array( 'is_empty', 0 ),
                    ),
					'std'        => 'default',
					'options'    => array(
						'fullwidth'   => esc_html__( 'Fullwidth', 'yolox' ),
						'boxed'       => esc_html__( 'Boxed', 'yolox' ),
						'default'     => esc_html__( 'Default', 'yolox' ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_position'          => array(
					'title'      => esc_html__( 'Post header position', 'yolox' ),
					'desc'       => wp_kses_data( __( "Select post header position on the single post's pages", 'yolox' ) ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
                    'dependency' => array(
                        'hide_featured_on_single' => array( 'is_empty', 0 )
                    ),
					'std'        => 'above',
					'options'    => array(
						'above'      => esc_html__( 'Above the post thumbnail', 'yolox' ),
						'under'      => esc_html__( 'Under the post thumbnail', 'yolox' ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
				),
				'post_header_align'             => array(
					'title'      => esc_html__( 'Align of the post header', 'yolox' ),
					'override'   => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'post_header_position' => array( 'on_thumb' ),
					),
					'std'        => 'mc',
					'options'    => array(
						'ts' => esc_html__('Top Stick Out', 'yolox'),
						'tl' => esc_html__('Top Left', 'yolox'),
						'tc' => esc_html__('Top Center', 'yolox'),
						'tr' => esc_html__('Top Right', 'yolox'),
						'ml' => esc_html__('Middle Left', 'yolox'),
						'mc' => esc_html__('Middle Center', 'yolox'),
						'mr' => esc_html__('Middle Right', 'yolox'),
						'bl' => esc_html__('Bottom Left', 'yolox'),
						'bc' => esc_html__('Bottom Center', 'yolox'),
						'br' => esc_html__('Bottom Right', 'yolox'),
						'bs' => esc_html__('Bottom Stick Out', 'yolox'),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
				),
                'expand_content_post'                => array(
                    'title'   => esc_html__( 'Expand content', 'yolox' ),
                    'desc'    => wp_kses_data( __( 'Expand the content width if the sidebar is hidden', 'yolox' ) ),
                    'refresh' => false,
                    'std'     => 0,
                    'type'    => 'checkbox',
                ),
				'hide_sidebar_on_single'        => array(
					'title' => esc_html__( 'Hide sidebar on the single post', 'yolox' ),
					'desc'  => wp_kses_data( __( "Hide sidebar on the single post's pages", 'yolox' ) ),
					'std'   => 0,
					'type'  => 'checkbox',
				),
				'show_post_excerpt'              => array(
					'title' => esc_html__( 'Show post excerpt', 'yolox' ),
					'desc'  => wp_kses_data( __( "Display post excerpt under post title.", 'yolox' ) ),
					'override' => array(
						'mode'    => 'post',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'dependency' => array(
						'hide_featured_on_single' => array( 0 ),
					),
					'std'   => 0,
					'type'  => 'checkbox',
				),
                'show_post_meta'                => array(
                    'title' => esc_html__( 'Show post meta', 'yolox' ),
                    'desc'  => wp_kses_data( __( "Display block with post's meta: date, categories, counters, etc.", 'yolox' ) ),
                    'std'   => 1,
                    'type'  => 'checkbox',
                ),
                'meta_parts_post'               => array(
                    'title'      => esc_html__( 'Post meta', 'yolox' ),
                    'desc'       => wp_kses_data( __( 'Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active', 'yolox' ) )
                        . '<br>'
                        . wp_kses_data( __( '<b>Tip:</b> Drag items to change their order.', 'yolox' ) ),
                    'dependency' => array(
                        'show_post_meta' => array( 1 ),
                    ),
                    'dir'        => 'vertical',
                    'sortable'   => true,
                    'std'        => 'categories=1|date=1|counters=1|author=1|share=1|edit=0',
                    'options'    => yolox_get_list_meta_parts(),
                    'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checklist',
                ),

                'counters_post'                 => array(
                    'title'      => esc_html__( 'Post counters', 'yolox' ),
                    'desc'       => wp_kses_data( __( 'Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active', 'yolox' ) ),
                    'dependency' => array(
                        'show_post_meta' => array( 1 ),
                    ),
                    'dir'        => 'vertical',
                    'sortable'   => true,
                    'std'        => 'comments=1|likes=0|views=1',
                    'options'    => yolox_get_list_counters(),
                    'type'       => YOLOX_THEME_FREE || ! yolox_exists_trx_addons() ? 'hidden' : 'checklist',
                ),
				'show_share_links'              => array(
					'title' => esc_html__( 'Show share links', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Display share links on the single post', 'yolox' ) ),
					'std'   => 1,
					'type'  => ! yolox_exists_trx_addons() ? 'hidden' : 'checkbox',
				),
				'show_author_info'              => array(
					'title' => esc_html__( 'Show author info', 'yolox' ),
					'desc'  => wp_kses_data( __( "Display block with information about post's author", 'yolox' ) ),
					'std'   => 1,
					'type'  => 'checkbox',
				),
				'blog_single_related_info'      => array(
					'title' => esc_html__( 'Related posts', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),

				'show_related_posts'            => array(
					'title'    => esc_html__( 'Show related posts', 'yolox' ),
					'desc'     => wp_kses_data( __( "Show section 'Related posts' on the single post's pages", 'yolox' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Content', 'yolox' ),
					),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'related_posts'                 => array(
					'title'      => esc_html__( 'Related posts', 'yolox' ),
					'desc'       => wp_kses_data( __( 'How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 3,
					'options'    => yolox_get_list_range( 1, 9 ),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
				),
				'related_columns'               => array(
					'title'      => esc_html__( 'Related columns', 'yolox' ),
					'desc'       => wp_kses_data( __( 'How many columns should be used to output related posts in the single page (from 2 to 4)?', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 3,
					'options'    => yolox_get_list_range( 1, 4 ),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_style'                 => array(
					'title'      => esc_html__( 'Related posts style', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select style of the related posts output', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 2,
					'options'    => yolox_get_list_styles( 1, 3 ),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
				),
				'related_slider'                => array(
					'title'      => esc_html__( 'Use slider layout', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Use slider layout in case related posts count is more than columns count', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
					),
					'std'        => 0,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'checkbox',
				),
				'related_slider_controls'       => array(
					'title'      => esc_html__( 'Slider controls', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show arrows in the slider', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'none',
					'options'    => array(
						'none'    => esc_html__('None', 'yolox'),
						'side'    => esc_html__('Side', 'yolox'),
						'outside' => esc_html__('Outside', 'yolox'),
						'top'     => esc_html__('Top', 'yolox'),
						'bottom'  => esc_html__('Bottom', 'yolox')
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
				),
				'related_slider_pagination'       => array(
					'title'      => esc_html__( 'Slider pagination', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Show bullets after the slider', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 'bottom',
					'options'    => array(
						'none'    => esc_html__('None', 'yolox'),
						'bottom'  => esc_html__('Bottom', 'yolox')
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'switch',
				),
				'related_slider_space'          => array(
					'title'      => esc_html__( 'Space', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Space between slides', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 1 ),
						'related_slider' => array( 1 ),
					),
					'std'        => 30,
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'text',
				),
				'related_position'              => array(
					'title'      => esc_html__( 'Related posts position', 'yolox' ),
					'desc'       => wp_kses_data( __( 'Select position to display the related posts', 'yolox' ) ),
					'dependency' => array(
						'show_related_posts' => array( 0 ),
					),
					'std'        => 'below_page',
					'options'    => array (

						'below_page'    => esc_html__( 'After content & sidebar', 'yolox' ),
					),
					'type'       => YOLOX_THEME_FREE ? 'hidden' : 'switch',
				),
				'posts_navigation_info'      => array(
					'title' => esc_html__( 'Posts navigation', 'yolox' ),
					'desc'  => '',
					'type'  => 'info',
				),
				'show_posts_navigation'		=> array(
					'title'    => esc_html__( 'Show posts navigation', 'yolox' ),
					'desc'     => wp_kses_data( __( "Show posts navigation on the single post's pages", 'yolox' ) ),
					'std'      => 1,
					'type'     => 'checkbox',
				),
				'fixed_posts_navigation'		=> array(
					'title'    => esc_html__( 'Fixed posts navigation', 'yolox' ),
					'desc'     => wp_kses_data( __( "Make posts navigation fixed position. Display them at the bottom of the window.", 'yolox' ) ),
					'dependency' => array(
						'show_posts_navigation' => array( 1 ),
					),
					'std'      => 0,
					'type'     => 'hidden',
				),
				'blog_end'                      => array(
					'type' => 'panel_end',
				),

				// 'Colors'
				'panel_colors'                  => array(
					'title'    => esc_html__( 'Colors', 'yolox' ),
					'desc'     => '',
					'priority' => 300,
					'type'     => 'section',
				),

				'color_schemes_info'            => array(
					'title'  => esc_html__( 'Color schemes', 'yolox' ),
					'desc'   => wp_kses_data( __( 'Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'yolox' ) ),
					'hidden' => $hide_schemes,
					'type'   => 'info',
				),
				'color_scheme'                  => array(
					'title'    => esc_html__( 'Site Color Scheme', 'yolox' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'yolox' ),
					),
					'std'      => 'default',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'header_scheme'                 => array(
					'title'    => esc_html__( 'Header Color Scheme', 'yolox' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'yolox' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'menu_scheme'                   => array(
					'title'    => esc_html__( 'Sidemenu Color Scheme', 'yolox' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'yolox' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes || YOLOX_THEME_FREE ? 'hidden' : 'switch',
				),
				'sidebar_scheme'                => array(
					'title'    => esc_html__( 'Sidebar Color Scheme', 'yolox' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'yolox' ),
					),
					'std'      => 'inherit',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),
				'footer_scheme'                 => array(
					'title'    => esc_html__( 'Footer Color Scheme', 'yolox' ),
					'desc'     => '',
					'override' => array(
						'mode'    => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
						'section' => esc_html__( 'Colors', 'yolox' ),
					),
					'std'      => 'dark',
					'options'  => array(),
					'refresh'  => false,
					'type'     => $hide_schemes ? 'hidden' : 'switch',
				),

				'color_scheme_editor_info'      => array(
					'title' => esc_html__( 'Color scheme editor', 'yolox' ),
					'desc'  => wp_kses_data( __( 'Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'yolox' ) ),
					'type'  => 'info',
				),
				'scheme_storage'                => array(
					'title'       => esc_html__( 'Color scheme editor', 'yolox' ),
					'desc'        => '',
					'std'         => '$yolox_get_scheme_storage',
					'refresh'     => false,
					'colorpicker' => 'tiny',
					'type'        => 'scheme_editor',
				),

				// Internal options.
				// Attention! Don't change any options in the section below!
				// Use huge priority to call render this elements after all options!
				'reset_options'                 => array(
					'title'    => '',
					'desc'     => '',
					'std'      => '0',
					'priority' => 10000,
					'type'     => 'hidden',
				),

				'last_option'                   => array(     // Need to manually call action to include Tiny MCE scripts
					'title' => '',
					'desc'  => '',
					'std'   => 1,
					'type'  => 'hidden',
				),

			)
		);

		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(

			// 'Fonts'
			'fonts'             => array(
				'title'    => esc_html__( 'Typography', 'yolox' ),
				'desc'     => '',
				'priority' => 200,
				'type'     => 'panel',
			),

			// Fonts - Load_fonts
			'load_fonts'        => array(
				'title' => esc_html__( 'Load fonts', 'yolox' ),
				'desc'  => wp_kses_data( __( 'Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'yolox' ) )
						. '<br>'
						. wp_kses_data( __( 'Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'yolox' ) ),
				'type'  => 'section',
			),
			'load_fonts_subset' => array(
				'title'   => esc_html__( 'Google fonts subsets', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Specify comma separated list of the subsets which will be load from Google fonts', 'yolox' ) )
						. '<br>'
						. wp_kses_data( __( 'Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'yolox' ) ),
				'class'   => 'yolox_column-1_3 yolox_new_row',
				'refresh' => false,
				'std'     => '$yolox_get_load_fonts_subset',
				'type'    => 'text',
			),
		);

		for ( $i = 1; $i <= yolox_get_theme_setting( 'max_load_fonts' ); $i++ ) {
			if ( yolox_get_value_gp( 'page' ) != 'theme_options' ) {
				$fonts[ "load_fonts-{$i}-info" ] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					'title' => esc_html( sprintf( __( 'Font %s', 'yolox' ), $i ) ),
					'desc'  => '',
					'type'  => 'info',
				);
			}
			$fonts[ "load_fonts-{$i}-name" ]   = array(
				'title'   => esc_html__( 'Font name', 'yolox' ),
				'desc'    => '',
				'class'   => 'yolox_column-1_3 yolox_new_row',
				'refresh' => false,
				'std'     => '$yolox_get_load_fonts_option',
				'type'    => 'text',
			);
			$fonts[ "load_fonts-{$i}-family" ] = array(
				'title'   => esc_html__( 'Font family', 'yolox' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Select font family to use it if font above is not available', 'yolox' ) )
							: '',
				'class'   => 'yolox_column-1_3',
				'refresh' => false,
				'std'     => '$yolox_get_load_fonts_option',
				'options' => array(
					'inherit'    => esc_html__( 'Inherit', 'yolox' ),
					'serif'      => esc_html__( 'serif', 'yolox' ),
					'sans-serif' => esc_html__( 'sans-serif', 'yolox' ),
					'monospace'  => esc_html__( 'monospace', 'yolox' ),
					'cursive'    => esc_html__( 'cursive', 'yolox' ),
					'fantasy'    => esc_html__( 'fantasy', 'yolox' ),
				),
				'type'    => 'select',
			);
			$fonts[ "load_fonts-{$i}-styles" ] = array(
				'title'   => esc_html__( 'Font styles', 'yolox' ),
				'desc'    => 1 == $i
							? wp_kses_data( __( 'Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'yolox' ) )
								. '<br>'
								. wp_kses_data( __( 'Attention! Each weight and style increase download size! Specify only used weights and styles.', 'yolox' ) )
							: '',
				'class'   => 'yolox_column-1_3',
				'refresh' => false,
				'std'     => '$yolox_get_load_fonts_option',
				'type'    => 'text',
			);
		}
		$fonts['load_fonts_end'] = array(
			'type' => 'section_end',
		);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = yolox_get_theme_fonts();
		foreach ( $theme_fonts as $tag => $v ) {
			$fonts[ "{$tag}_section" ] = array(
				'title' => ! empty( $v['title'] )
								? $v['title']
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html( sprintf( __( '%s settings', 'yolox' ), $tag ) ),
				'desc'  => ! empty( $v['description'] )
								? $v['description']
								// Translators: Add tag's name to make description
								: wp_kses( sprintf( __( 'Font settings of the "%s" tag.', 'yolox' ), $tag ), 'yolox_kses_content' ),
				'type'  => 'section',
			);

			foreach ( $v as $css_prop => $css_value ) {
				if ( in_array( $css_prop, array( 'title', 'description' ) ) ) {
					continue;
				}
				$options    = '';
				$type       = 'text';
				$load_order = 1;
				$title      = ucfirst( str_replace( '-', ' ', $css_prop ) );
				if ( 'font-family' == $css_prop ) {
					$type       = 'select';
					$options    = array();
					$load_order = 2;        // Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} elseif ( 'font-weight' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'yolox' ),
						'100'     => esc_html__( '100 (Light)', 'yolox' ),
						'200'     => esc_html__( '200 (Light)', 'yolox' ),
						'300'     => esc_html__( '300 (Thin)', 'yolox' ),
						'400'     => esc_html__( '400 (Normal)', 'yolox' ),
						'500'     => esc_html__( '500 (Semibold)', 'yolox' ),
						'600'     => esc_html__( '600 (Semibold)', 'yolox' ),
						'700'     => esc_html__( '700 (Bold)', 'yolox' ),
						'800'     => esc_html__( '800 (Black)', 'yolox' ),
						'900'     => esc_html__( '900 (Black)', 'yolox' ),
					);
				} elseif ( 'font-style' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit' => esc_html__( 'Inherit', 'yolox' ),
						'normal'  => esc_html__( 'Normal', 'yolox' ),
						'italic'  => esc_html__( 'Italic', 'yolox' ),
					);
				} elseif ( 'text-decoration' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'      => esc_html__( 'Inherit', 'yolox' ),
						'none'         => esc_html__( 'None', 'yolox' ),
						'underline'    => esc_html__( 'Underline', 'yolox' ),
						'overline'     => esc_html__( 'Overline', 'yolox' ),
						'line-through' => esc_html__( 'Line-through', 'yolox' ),
					);
				} elseif ( 'text-transform' == $css_prop ) {
					$type    = 'select';
					$options = array(
						'inherit'    => esc_html__( 'Inherit', 'yolox' ),
						'none'       => esc_html__( 'None', 'yolox' ),
						'uppercase'  => esc_html__( 'Uppercase', 'yolox' ),
						'lowercase'  => esc_html__( 'Lowercase', 'yolox' ),
						'capitalize' => esc_html__( 'Capitalize', 'yolox' ),
					);
				}
				$fonts[ "{$tag}_{$css_prop}" ] = array(
					'title'      => $title,
					'desc'       => '',
					'class'      => 'yolox_column-1_5',
					'refresh'    => false,
					'load_order' => $load_order,
					'std'        => '$yolox_get_theme_fonts_option',
					'options'    => $options,
					'type'       => $type,
				);
			}

			$fonts[ "{$tag}_section_end" ] = array(
				'type' => 'section_end',
			);
		}

		$fonts['fonts_end'] = array(
			'type' => 'panel_end',
		);

		// Add fonts parameters to Theme Options
		yolox_storage_set_array_before( 'options', 'panel_colors', $fonts );

		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if ( ! function_exists( 'get_header_video_url' ) ) {
			yolox_storage_set_array_after(
				'options', 'header_image_override', 'header_video', array(
					'title'    => esc_html__( 'Header video', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select video to use it as background for the header', 'yolox' ) ),
					'override' => array(
						'mode'    => 'page',
						'section' => esc_html__( 'Header', 'yolox' ),
					),
					'std'      => '',
					'type'     => 'video',
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is not 'Customize'
		// ------------------------------------------------------
		if ( ! function_exists( 'the_custom_logo' ) || ! yolox_check_current_url( 'customize.php' ) ) {
			yolox_storage_set_array_before(
				'options', 'logo_retina', function_exists( 'the_custom_logo' ) ? 'custom_logo' : 'logo', array(
					'title'    => esc_html__( 'Logo', 'yolox' ),
					'desc'     => wp_kses_data( __( 'Select or upload the site logo', 'yolox' ) ),
					'class'    => 'yolox_column-1_2 yolox_new_row',
					'priority' => 60,
					'std'      => '',
					'qsetup'   => esc_html__( 'General', 'yolox' ),
					'type'     => 'image',
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if ( ! function_exists( 'yolox_options_get_list_cpt_options' ) ) {
	function yolox_options_get_list_cpt_options( $cpt, $title = '' ) {
		if ( empty( $title ) ) {
			$title = ucfirst( $cpt );
		}
		return array(
			"header_info_{$cpt}"            => array(
				'title' => esc_html__( 'Header', 'yolox' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"header_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Header style', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'yolox' ) ),
				'std'     => 'inherit',
				'options' => yolox_get_list_header_footer_types( true ),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'yolox' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select custom layout to display the site header on the %s pages', 'yolox' ), $title ) ),
				'dependency' => array(
					"header_type_{$cpt}" => array( 'custom' ),
				),
				'std'        => 'inherit',
				'options'    => array(),
				'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
			),
			"header_position_{$cpt}"        => array(
				'title'   => esc_html__( 'Header position', 'yolox' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to display the site header on the %s pages', 'yolox' ), $title ) ),
				'std'     => 'inherit',
				'options' => array(),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_image_override_{$cpt}"  => array(
				'title'   => esc_html__( 'Header image override', 'yolox' ),
				'desc'    => wp_kses_data( __( "Allow override the header image with the post's featured image", 'yolox' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'yolox' ),
					1         => esc_html__( 'Yes', 'yolox' ),
					0         => esc_html__( 'No', 'yolox' ),
				),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'switch',
			),
			"header_widgets_{$cpt}"         => array(
				'title'   => esc_html__( 'Header widgets', 'yolox' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select set of widgets to show in the header on the %s pages', 'yolox' ), $title ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => 'select',
			),

			"sidebar_info_{$cpt}"           => array(
				'title' => esc_html__( 'Sidebar', 'yolox' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"sidebar_position_{$cpt}"       => array(
				'title'   => esc_html__( 'Sidebar position', 'yolox' ),
				// Translators: Add CPT name to the description
				'desc'    => wp_kses_data( sprintf( __( 'Select position to show sidebar on the %s pages', 'yolox' ), $title ) ),
				'std'     => 'left',
				'options' => array(),
				'type'    => 'switch',
			),
			"sidebar_widgets_{$cpt}"        => array(
				'title'      => esc_html__( 'Sidebar widgets', 'yolox' ),
				// Translators: Add CPT name to the description
				'desc'       => wp_kses_data( sprintf( __( 'Select sidebar to show on the %s pages', 'yolox' ), $title ) ),
				'dependency' => array(
					"sidebar_position_{$cpt}" => array( 'left', 'right' ),
				),
				'std'        => 'hide',
				'options'    => array(),
				'type'       => 'select',
			),
			"hide_sidebar_on_single_{$cpt}" => array(
				'title'   => esc_html__( 'Hide sidebar on the single pages', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Hide sidebar on the single page', 'yolox' ) ),
				'std'     => 'inherit',
				'options' => array(
					'inherit' => esc_html__( 'Inherit', 'yolox' ),
					1         => esc_html__( 'Hide', 'yolox' ),
					0         => esc_html__( 'Show', 'yolox' ),
				),
				'type'    => 'switch',
			),

			"footer_info_{$cpt}"            => array(
				'title' => esc_html__( 'Footer', 'yolox' ),
				'desc'  => '',
				'type'  => 'info',
			),
			"footer_type_{$cpt}"            => array(
				'title'   => esc_html__( 'Footer style', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'yolox' ) ),
				'std'     => 'inherit',
				'options' => yolox_get_list_header_footer_types( true ),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'switch',
			),
			"footer_style_{$cpt}"           => array(
				'title'      => esc_html__( 'Select custom layout', 'yolox' ),
				'desc'       => wp_kses_data( __( 'Select custom layout to display the site footer', 'yolox' ) ),
				'std'        => 'inherit',
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'custom' ),
				),
				'options'    => array(),
				'type'       => YOLOX_THEME_FREE ? 'hidden' : 'select',
			),
			"footer_widgets_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer widgets', 'yolox' ),
				'desc'       => wp_kses_data( __( 'Select set of widgets to show in the footer', 'yolox' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 'footer_widgets',
				'options'    => array(),
				'type'       => 'select',
			),
			"footer_columns_{$cpt}"         => array(
				'title'      => esc_html__( 'Footer columns', 'yolox' ),
				'desc'       => wp_kses_data( __( 'Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'yolox' ) ),
				'dependency' => array(
					"footer_type_{$cpt}"    => array( 'default' ),
					"footer_widgets_{$cpt}" => array( '^hide' ),
				),
				'std'        => 0,
				'options'    => yolox_get_list_range( 0, 6 ),
				'type'       => 'select',
			),
			"footer_wide_{$cpt}"            => array(
				'title'      => esc_html__( 'Footer fullwidth', 'yolox' ),
				'desc'       => wp_kses_data( __( 'Do you want to stretch the footer to the entire window width?', 'yolox' ) ),
				'dependency' => array(
					"footer_type_{$cpt}" => array( 'default' ),
				),
				'std'        => 0,
				'type'       => 'checkbox',
			),

			"widgets_info_{$cpt}"           => array(
				'title' => esc_html__( 'Additional panels', 'yolox' ),
				'desc'  => '',
				'type'  => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
			),
			"widgets_above_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the top of the page', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the top of the page (above content and sidebar)', 'yolox' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
			),
			"widgets_above_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets above the content', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the beginning of the content area', 'yolox' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
			),
			"widgets_below_content_{$cpt}"  => array(
				'title'   => esc_html__( 'Widgets below the content', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the ending of the content area', 'yolox' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
			),
			"widgets_below_page_{$cpt}"     => array(
				'title'   => esc_html__( 'Widgets at the bottom of the page', 'yolox' ),
				'desc'    => wp_kses_data( __( 'Select widgets to show at the bottom of the page (below content and sidebar)', 'yolox' ) ),
				'std'     => 'hide',
				'options' => array(),
				'type'    => YOLOX_THEME_FREE ? 'hidden' : 'hidden',
			),
		);
	}
}


// Return lists with choises when its need in the admin mode
if ( ! function_exists( 'yolox_options_get_list_choises' ) ) {
	add_filter( 'yolox_filter_options_get_list_choises', 'yolox_options_get_list_choises', 10, 2 );
	function yolox_options_get_list_choises( $list, $id ) {
		if ( is_array( $list ) && count( $list ) == 0 ) {
			if ( strpos( $id, 'header_style' ) === 0 ) {
				$list = yolox_get_list_header_styles( strpos( $id, 'header_style_' ) === 0 );
			} elseif ( strpos( $id, 'header_position' ) === 0 ) {
				$list = yolox_get_list_header_positions( strpos( $id, 'header_position_' ) === 0 );
			} elseif ( strpos( $id, 'header_widgets' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'header_widgets_' ) === 0, true );
			} elseif ( strpos( $id, '_scheme' ) > 0 ) {
				$list = yolox_get_list_schemes( 'color_scheme' != $id );
			} elseif ( strpos( $id, 'sidebar_widgets' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'sidebar_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'sidebar_position' ) === 0 ) {
				$list = yolox_get_list_sidebars_positions( strpos( $id, 'sidebar_position_' ) === 0 );
			} elseif ( strpos( $id, 'widgets_above_page' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'widgets_above_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_above_content' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'widgets_above_content_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_page' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'widgets_below_page_' ) === 0, true );
			} elseif ( strpos( $id, 'widgets_below_content' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'widgets_below_content_' ) === 0, true );
			} elseif ( strpos( $id, 'footer_style' ) === 0 ) {
				$list = yolox_get_list_footer_styles( strpos( $id, 'footer_style_' ) === 0 );
			} elseif ( strpos( $id, 'footer_widgets' ) === 0 ) {
				$list = yolox_get_list_sidebars( strpos( $id, 'footer_widgets_' ) === 0, true );
			} elseif ( strpos( $id, 'blog_style' ) === 0 ) {
				$list = yolox_get_list_blog_styles( strpos( $id, 'blog_style_' ) === 0 );
			} elseif ( strpos( $id, 'post_type' ) === 0 ) {
				$list = yolox_get_list_posts_types();
			} elseif ( strpos( $id, 'parent_cat' ) === 0 ) {
				$list = yolox_array_merge( array( 0 => esc_html__( '- Select category -', 'yolox' ) ), yolox_get_list_categories() );
			} elseif ( strpos( $id, 'blog_animation' ) === 0 ) {
				$list = yolox_get_list_animations_in();
			} elseif ( 'color_scheme_editor' == $id ) {
				$list = yolox_get_list_schemes();
			} elseif ( strpos( $id, '_font-family' ) > 0 ) {
				$list = yolox_get_list_load_fonts( true );
			}
		}
		return $list;
	}
}
