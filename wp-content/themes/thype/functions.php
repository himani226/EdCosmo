<?php

/**
 * Thype functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Thype
 * @subpackage Functions
 * @since 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 1070;

// Load Codeless Framework Constants
require_once( get_template_directory() . '/includes/core/codeless_constants.php' );

// Load core functions
require_once( get_template_directory().'/includes/codeless_functions_core.php' );

// Load Required Plugins Tool
require_once( get_template_directory().'/includes/core/codeless_required_plugins.php' );

require_once( get_template_directory().'/includes/codeless_theme_panel/codeless_backpanel.php' );

//Demo Importer
require_once( get_template_directory().'/includes/codeless_theme_panel/importer/codeless_importer.php' );

// Load & Register Post Meta Functionality
require_once( get_template_directory().'/includes/core/codeless_post_meta_container.php' );

/**
 * Add Meta in page Metabox plugin
 * 
 * @since 1.0.0
 */
require_once( get_template_directory(). '/includes/core/metabox-conditional/meta-box-conditional-logic.php' );
require_once( get_template_directory().'/includes/register/register_post_meta.php' );
add_filter( 'rwmb_meta_boxes', array( 'Cl_Post_Meta', 'register_meta_boxes_inpage' ) );

/**
 * All Start here...
 * 
 * @since 1.0.0
 */
function codeless_setup(){

    // Register Nav Menus Locations to use
    codeless_navigation_menus();
    // Load Codeless Customizer files and Options
    codeless_load_customizer();
    // Load All Codeless Framework Files
    codeless_load_framework();
    // Load Codeless Modules
    codeless_load_modules();

    // Language and text-domain setup
    add_action('init', 'codeless_language_setup');
    add_action( 'init', 'codeless_load_visual_elements', 5 );

    // Register Scripts and Styles
    add_action('wp_enqueue_scripts', 'codeless_register_global_styles');
    add_action('wp_enqueue_scripts', 'codeless_register_global_scripts');


    // Https filters
    add_filter( 'https_ssl_verify', '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );

    // WP features that this theme supports
    codeless_theme_support();
    if ( class_exists( 'WPBakeryShortCode' ) )
        require_once( get_template_directory().'/includes/codeless_functions_vc.php' );

    // Widgets
    codeless_load_widgets();
    codeless_register_widgets();  

    if( function_exists( 'codeless_load_post_types' ) )
        codeless_load_post_types( array( 'codeless_slider' ) );

    // Megamenu Create
    new codeless_custom_menu();
}

add_action( 'after_setup_theme', 'codeless_setup' );


/**
 * After theme activation
 * 
 * @since 1.0.0
 */
function codeless_after_switch_theme(){
    wp_redirect('admin.php?page=codeless-panel');
}

add_action( 'after_switch_theme', 'codeless_after_switch_theme' );


/**
 * Gutenberg Editor CSS
 * 
 * @since 1.0.0
 */

add_action( 'enqueue_block_editor_assets', 'codeless_gutenberg_css', 999 );
function codeless_gutenberg_css(){
    wp_enqueue_style(
		'codeless-guten-css', // Handle.
		get_template_directory_uri() . '/css/gutenberg-editor.css', // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
    );

    $body_type = codeless_get_mod( 'body_typo', array( 'font-family' => 'Noto Sans') );
    $blog_text_size = codeless_get_mod( 'blog_text_size', array( 'line-height' => '1.75', 'font-size' => '18px') );
    $custom_font_link = add_query_arg( array(
		'family' => str_replace( '%2B', '+', urlencode( implode( '|', array( $body_type['font-family'] ) ) . ':400,500,700'  ) )
	), 'https://fonts.googleapis.com/css' );

	wp_enqueue_style( 'codeless-guten-'.$body_type['font-family'], $custom_font_link  );
    
    $dynamic_styles = '.editor-post-title__block .editor-post-title__input { font-size:60px; font-weight: 700;letter-spacing: 0px; line-height: 1.2; }';
    //$dynamic_styles .= '.editor-styles-wrapper .wp-block-quote div p{ font-size:'.codeless_get_mod( 'blockquote_typo', array( 'font-size' => '26px' ) )['font-size'].' !important; font-weight:'.codeless_get_mod( 'blockquote_typo', array( 'font-weight' => '700' ) )['font-weight'].'; line-height:1.5; }';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-quote__citation{ font-weight: 500; font-style: normal; font-size:16px; }';

    $dynamic_styles .= '.editor-styles-wrapper{ font-family: '.$body_type['font-family'].' !important; line-height:'.$blog_text_size['line-height'].' !important; -webkit-font-smoothing: antialiased !important; }';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-paragraph:not(.has-small-font-size):not(.has-large-font-size):not(.has-larger-font-size), .editor-styles-wrapper li{ font-size:'.$blog_text_size['font-size'].' !important;  }';
    $dynamic_styles .= '.editor-styles-wrapper p.has-drop-cap:not(:focus):first-letter { color: '.codeless_get_mod( 'primary_color', '#e94828' ).'; } ';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-quote__citation { color:'.codeless_get_mod( 'text_color', '#626264' ).'; }'; 
    $dynamic_styles .= '.editor-styles-wrapper .wp-block-pullquote blockquote>.block-editor-rich-text p{ font-family: \'Noto Serif\'; font-weight:700 }';
    $dynamic_styles .= '.editor-styles-wrapper .wp-block[data-type="core/cover"] .wp-block[data-type="core/paragraph"] p{ color:#fff !important; }';
    $dynamic_styles .= '.editor-styles-wrapper h1, .editor-styles-wrapper h2, .editor-styles-wrapper h3, .editor-styles-wrapper h4, .editor-styles-wrapper h5, .editor-styles-wrapper h6, .editor-styles-wrapper .wp-block-quote p{ font-family:\'Noto Serif\';}';
    $dynamic_styles .= '.editor-styles-wrapper h1{ font-size:'.codeless_get_mod( 'h1_typo', array( 'font-size' => '60px' ) )['font-size'].'; }';
    $dynamic_styles .= '.editor-styles-wrapper h2{ font-size:'.codeless_get_mod( 'h2_typo', array( 'font-size' => '42px' ) )['font-size'].'; }';
    $dynamic_styles .= '.editor-styles-wrapper h3{ font-size:'.codeless_get_mod( 'h3_typo', array( 'font-size' => '26px' ) )['font-size'].'; }';
    $dynamic_styles .= '.editor-styles-wrapper h4{ font-size:'.codeless_get_mod( 'h4_typo', array( 'font-size' => '20px' ) )['font-size'].'; }';
    $dynamic_styles .= '.editor-styles-wrapper h5{ font-size:'.codeless_get_mod( 'h5_typo', array( 'font-size' => '16px' ) )['font-size'].'; }';
    $dynamic_styles .= '.editor-styles-wrapper h6{ font-size:'.codeless_get_mod( 'h6_typo', array( 'font-size' => '12px' ) )['font-size'].'; }';

    

    wp_add_inline_style( 'codeless-guten-css', $dynamic_styles );
}

/**
 * Load Customizer Related Options and Customizer Cotrols Classes
 * 
 * @since 1.0.0
 */
function codeless_load_customizer() {

    // Load and Initialize Codeless Customizer
    include_once( get_template_directory() . '/includes/codeless_customizer/codeless_customizer_config.php' );
}

/**
 * Load Visual Elements
 * 
 * @since 1.0.0
 */
function codeless_load_visual_elements(){
    if ( class_exists( 'WPBakeryShortCode' ) )
        require_once( get_template_directory().'/includes/codeless_functions_vc.php' );
}


/**
 * Load all Codeless Framework Files
 * 
 * @since 1.0.0
 */
function codeless_load_framework() {

    // Register all Theme Hooks (add_action, add_filter)
    require_once( get_template_directory() . '/includes/codeless_hooks.php' );

    // Codeless Routing Templates and Custom Type Queries
    require_once( get_template_directory().'/includes/core/codeless_routing.php' );
    
    
    
    // Register all theme related sidebars
    require_once( get_template_directory().'/includes/register/register_sidebars.php' );

    // Register Custom Post Types
    // Works with Codeless Builder activated
    // Plugin Territory
    require_once( get_template_directory().'/includes/register/register_custom_types.php' );

    // Load Megamenu
    require_once( get_template_directory().'/includes/core/codeless_megamenu.php' );

    // Load all functions that are responsable for Extra Classes and Extra Attrs
    require_once( get_template_directory().'/includes/codeless_html_attrs.php' );

    // Load all blog related functions
    require_once( get_template_directory().'/includes/codeless_functions_blog.php' );

    // Load all portfolio related functions
    require_once( get_template_directory().'/includes/codeless_functions_portfolio.php' );


    // Load Theme Panels
   
    require_once( get_template_directory().'/includes/codeless_theme_panel/codeless_theme_panel.php' );
    require_once( get_template_directory().'/includes/codeless_theme_panel/codeless_image_sizes.php' );
    require_once( get_template_directory().'/includes/codeless_theme_panel/codeless_modules.php' ); 
    require_once( get_template_directory().'/includes/codeless_theme_panel/codeless_custom_sidebars.php' ); 
    require_once( get_template_directory().'/includes/codeless_theme_panel/codeless_system_status.php' );
    
    // Image Resize - Module - Resize image only when needed
    require_once( get_template_directory().'/includes/core/codeless_image_resize.php' );

    // Load Comment Walker
    require_once( get_template_directory().'/includes/core/codeless_comment_walker.php' );
    
    // Codeless Icons List
    require_once( get_template_directory().'/includes/core/codeless_icons.php' );

    // Fallback Class for Header when Codeless Builder Plugin is not active
    require_once( get_template_directory().'/includes/core/codeless_header_fallback.php' );

   
}


/**
 * Load All Modules
 * 
 * @since 1.0.0
 */
function codeless_load_modules(){
   require_once( get_template_directory().'/includes/codeless_modules/custom_portfolio_overlay_color.php' );
   require_once( get_template_directory().'/includes/codeless_modules/header_boxed_per_page.php' );
   require_once( get_template_directory().'/includes/codeless_modules/custom_header_background_per_page.php' );    
}


/**
 * Load Codeless Custom Widgets
 * 
 * @since 1.0.0
 */
function codeless_load_widgets() {
    require_once get_template_directory().'/includes/widgets/codeless_flickr.php';
    require_once get_template_directory().'/includes/widgets/codeless_mostpopular.php';
    require_once get_template_directory().'/includes/widgets/codeless_headlines.php';
    require_once get_template_directory().'/includes/widgets/codeless_shortcodewidget.php';
    require_once get_template_directory().'/includes/widgets/codeless_socialwidget.php';
    require_once get_template_directory().'/includes/widgets/codeless_twitter.php';
    require_once get_template_directory().'/includes/widgets/codeless_ads.php';
    require_once get_template_directory().'/includes/widgets/codeless_instagram.php';
    require_once get_template_directory().'/includes/widgets/codeless_divider.php';
    require_once get_template_directory().'/includes/widgets/codeless_date.php';
    require_once get_template_directory().'/includes/widgets/codeless_about.php';
    require_once get_template_directory().'/includes/widgets/codeless_contactinfo.php';
}


/**
 * Setup Language Directory and theme text domain
 * 
 * @since 1.0.0
 */
function codeless_language_setup() {
    $lang_dir = get_template_directory() . '/lang';
    load_theme_textdomain('thype', $lang_dir);
} 


/**
 * Add Theme Supports
 * 
 * @since 1.0.0
 */
function codeless_theme_support(){
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-slider' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support('nav_menus');
    add_theme_support( 'post-formats', array( 'quote', 'gallery','video', 'audio', 'link', 'image' ) ); 
    add_theme_support( "title-tag" );
    add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
    add_theme_support( 'align-wide' );
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
    
    add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Primary Accent Color', 'thype' ),
				'slug' => 'primary-accent',
				'color' => codeless_get_mod( 'primary_color' ),
            ),
            array(
				'name'  => esc_html__( 'Labels Color', 'thype' ),
				'slug' => 'labels',
				'color' => codeless_get_mod( 'labels_color' ),
            ),
            array(
				'name'  => esc_html__( 'Heading Color', 'thype' ),
				'slug' => 'heading',
				'color' => codeless_get_mod( 'heading_color' ),
			),
		)
    );

    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => esc_attr__( 'Small', 'thype' ),
            'shortName' => esc_attr__( 'S', 'thype' ),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_attr__( 'Normal', 'thype' ),
            'shortName' => esc_attr__( 'M', 'thype' ),
            'size' => 18,
            'slug' => 'normal'
        ),
        array(
            'name' => esc_attr__( 'Large', 'thype' ),
            'shortName' => esc_attr__( 'L', 'thype' ),
            'size' => 20,
            'slug' => 'large'
        ),
        array(
            'name' => esc_attr__( 'Huge', 'thype' ),
            'shortName' => esc_attr__( 'XL', 'thype' ),
            'size' => 36,
            'slug' => 'larger'
        )
    ) );
}


/**
 * Register Navigation Menus
 * 
 * @since 1.0.0
 */
function codeless_navigation_menus(){
    $navigations = array('main' => esc_attr('Main Navigation', 'thype') );

    foreach($navigations as $id => $name){ 
    	register_nav_menu($id, CODELESS_THEMETITLE.' '.$name); 
    }
}


/**
 * Regster Loaded Widgets
 * 
 * @since 1.0.0
 */
function codeless_register_widgets(){
    if( ! function_exists( 'codeless_widget_register' ) )
        return;

	codeless_widget_register( 'CodelessTwitter' );
    codeless_widget_register( 'CodelessSocialWidget' );
    codeless_widget_register( 'CodelessFlickrWidget' );
    codeless_widget_register( 'CodelessShortcodeWidget' );
    codeless_widget_register( 'CodelessMostPopularWidget');
    codeless_widget_register( 'CodelessHeadlinesWidget');
    codeless_widget_register( 'CodelessAdsWidget');
    codeless_widget_register( 'CodelessAboutMe');
    codeless_widget_register( 'CodelessInstagram' );
    codeless_widget_register( 'CodelessDividerWidget');
    codeless_widget_register( 'CodelessDateWidget');
    codeless_widget_register( 'CodelessContactInfo');
}


/**
 * Enqueue all needed styles
 * 
 * @since 1.0.0
 */
function codeless_register_global_styles(){ 

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
    wp_enqueue_style('codeless-theme-style', get_template_directory_uri() . '/css/theme.css');
    wp_enqueue_style('codeless-style', get_stylesheet_uri());

    if( !class_exists( 'Kirki' ) )
        wp_enqueue_style('codeless-default', get_template_directory_uri() . '/css/codeless-default.css' );

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
    
    if( codeless_get_mod( 'codeless_page_transition', false )) 
        wp_enqueue_style('animsition', get_template_directory_uri(). '/css/animsition.min.css'); 
    
    if( codeless_get_mod( 'blog_image_filter', 'normal' ) != 'normal' )
        wp_enqueue_style('codeless-image-filters', get_template_directory_uri() . '/css/codeless-image-filters.css');

    wp_enqueue_style('ilightbox-skin', CODELESS_BASE_URL . 'css/ilightbox/'.codeless_get_mod( 'lightbox_skin', 'dark' ).'-skin/skin.css' );
    wp_enqueue_style('ilightbox', CODELESS_BASE_URL.'css/ilightbox/css/ilightbox.css' );
    
    // Create Dynamic Styles
    $deps = array();
    if( wp_style_is( 'js_composer_front', 'registered' ) )
        $deps = array( 'js_composer_front' );

    wp_enqueue_style( 'codeless-dynamic', get_template_directory_uri() . '/css/codeless-dynamic.css', $deps );
    
    /* Load Custom Dynamic Style and enqueue them with wp_add_inline_style */
    ob_start();
    codeless_custom_dynamic_style();
    $styles = ob_get_clean();

    wp_add_inline_style( 'codeless-dynamic', apply_filters( 'codeless_register_styles', $styles ) );    
}


/**
 * Enqueue all global scripts
 * 
 * @since 1.0.0
 * @version 2.1
 */
function codeless_register_global_scripts(){
    
    wp_enqueue_script( 'codeless-main', get_template_directory_uri() . '/js/codeless-main.js', array( 'jquery', 'imagesloaded' ) );
    wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'bowser', get_template_directory_uri() . '/js/bowser.min.js' );

    wp_enqueue_script( 'nanoscroller', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js' );

   if( codeless_get_mod( 'codeless_page_transition', false )) 
        wp_enqueue_script('animation', get_template_directory_uri(). '/js/animsition.min.js'); 

    if( codeless_get_mod( 'nicescroll' ) )
        wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js' ); 

    if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
        // Load comment-reply.js
        wp_enqueue_script( 'comment-reply' );
    }

    wp_localize_script(
        'codeless-main',
        'codeless_global',
        array(
            'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
            'FRONT_LIB_JS' => esc_url( get_template_directory_uri() . '/js/' ),
            'FRONT_LIB_CSS' => esc_url( get_template_directory_uri() . '/css/' ),
            'postSwiperOptions' => codeless_get_post_slider_options(),
            'cl_btn_classes' => esc_attr( codeless_button_classes() ),
            'lightbox' => array(

                'skin' => esc_attr( codeless_get_mod( 'lightbox_skin', 'dark' ) ),
                'path' => esc_attr( codeless_get_mod( 'lightbox_path', 'vertical' ) ),
                'mousewheel' => esc_attr( codeless_get_mod( 'lightbox_mousewheel', true ) ),
                'toolbar' => esc_attr( codeless_get_mod( 'lightbox_toolbar', true ) ),
                'arrows' => esc_attr( codeless_get_mod( 'lightbox_arrows', false ) ),
                'slideshow' => esc_attr( codeless_get_mod( 'lightbox_slideshow', false ) ),
                'fullscreen' => esc_attr( codeless_get_mod( 'lightbox_fullscreen', false ) ),
                'thumbnail' => esc_attr( codeless_get_mod( 'lightbox_thumbnail', true ) ),
                'swipe' => esc_attr( codeless_get_mod( 'lightbox_swipe', true ) ),
                'contextmenu' => esc_attr( codeless_get_mod( 'lightbox_contextmenu', true ) ),
            )
            // Blog Slider Data
            
        )
    );
}


/**
 * Check if is neccesary to add extra HTML for container and inner row (make an inner container)
 * @since 1.0.0
 */
function codeless_is_inner_content(){
    $condition = false;

    // Condition to test if query is a blog
    if( ! codeless_is_blog_query() )
        $condition = true;


    if( ( ( codeless_get_page_layout() != 'fullwidth' 
                && codeless_get_page_layout() != '' 
                && codeless_get_page_layout() != 'default' ) || 
            ( is_single() 
                && get_post_type() == 'post' 
                && codeless_get_post_style() != 'custom'  ) 
        )
        && $condition )

        return true;

    return false;
}


/**
 * Check if is modern layout
 * @since 1.0.0
 */
function codeless_is_layout_modern(){
    $layout_modern = codeless_get_mod( 'layout_modern', false );

    if( codeless_get_meta( 'layout_modern', false ) != 'default' &&  codeless_get_meta( 'layout_modern', false ) != '' ){
        $layout_modern = codeless_get_meta( 'layout_modern', false );
    }

    return $layout_modern;
}


/**
 * Select and output sidebar for current page
 * @since 1.0.0
 */
function codeless_get_sidebar(){
    
    // Get current page layout
    $layout = codeless_get_page_layout();
  
    // No sidebar if fullwidth layout
    if( $layout == 'fullwidth' )
        return;
    
    // Load custom sidebar template for dual
    if( $layout == 'dual_sidebar' ){
        get_sidebar( 'dual' );
        return;
    }
    
    // For left/right sidebar layouts get default sidebar template
    get_sidebar();
    
}


/**
 * Two functions used for creating a wrapper for sticky sidebar
 * @since 1.0.0
 */
function codeless_sticky_sidebar_wrapper(){
    echo '<div class="cl-sticky-wrapper">';
}
function codeless_sticky_sidebar_wrapper_end(){
    echo '</div><!-- .cl-sticky-wrapper -->';
}


/**
 * Determine if page uses a left/right sidebar or a fullwidth layout
 * @since 1.0.0 
 */
function codeless_get_page_layout(){
    
    global $codeless_page_layout;

    // Make a test and save at the global variable to make the function works faster
    if(!isset($codeless_page_layout) || empty($codeless_page_layout) || (isset($codeless_page_layout) && !$codeless_page_layout) || is_customize_preview() ){
    
        // Default 
        $codeless_page_layout = codeless_get_layout_option( 'layout', 'fullwidth' );
        
        

        // if no sidebar is active return 'fullwidth'
        if( ! codeless_is_active_sidebar() )
            $codeless_page_layout = 'fullwidth';

        // Apply filter and return
        $codeless_page_layout = apply_filters( 'codeless_page_layout', $codeless_page_layout );

    }
    return $codeless_page_layout;
}



/**
 * Generate Content Column HTML class based on layout type
 * @since 1.0.0
 */
function codeless_content_column_class(){
    
    // Get page layout
    $layout = codeless_get_page_layout();
    
    // First part of class "col-sm-"
    $col_class = codeless_cols_prepend();
    
    if( $layout == 'fullwidth' )
        $col_class .= '12';
    elseif( $layout == 'dual_sidebar' )
        $col_class .= '6';
    else
        $col_class .= '8';
    
    return $col_class;
    
}


/**
 * HTML / CSS Column Class Prepend
 * @since 1.0.0
 */
function codeless_cols_prepend(){
    return apply_filters( 'codeless_cols_prepend', 'col-md-' );
}


/**
 * Buttons Style (Classes)
 * @since 1.0.0
 * @version 1.0.3
 */
function codeless_button_classes( $classes = array(), $overwrite = false, $postID = false ){
    
    if( !is_array( $classes ) )
        $classes = array();

    if( ! $overwrite ){
        $classes[] = 'cl-btn';

        $btn_color = codeless_get_mod( 'button_color', 'normal' );
        $btn_size = codeless_get_mod( 'button_size', 'medium' );
        $btn_style = codeless_get_mod( 'button_style', 'square' );


        $classes[] = 'cl-btn--color-' . $btn_color;
        $classes[] = 'cl-btn--size-' . $btn_size;
        $classes[] = 'cl-btn--style-' . $btn_style;
    }

    $classes = apply_filters( 'codeless_button_classes', $classes );
    
    return (!empty($classes) ? implode(" ", $classes) : '');
}


/**
 * Conditionals for showing footer and copyright
 * @since 1.0.0
 */
function codeless_show_footer(){  

    if( codeless_get_meta( 'page_show_footer', 'yes') == 'no' )
        return;

    $cols = codeless_layout_to_array( codeless_get_mod( 'footer_layout', '14_14_14_14' ) );
    $main_footer_bool = $top_footer_bool = $copyright_bool = false;

    for( $i = 1; $i <= count( $cols ); $i++ ) {

        if( is_active_sidebar('footer-column-' . $i) ){
            $main_footer_bool = true;
            break;
        }

    }

    if( is_active_sidebar('copyright-left') || is_active_sidebar('copyright-right') ){
        $copyright_bool = true;
    }


    if( ! $main_footer_bool  && !$copyright_bool )
        return;

    ?>

    <footer id="colophon" class="cl-footer <?php echo esc_attr( codeless_extra_classes( 'footer' ) ) ?>">  
        <?php

            if( codeless_get_mod( 'topfooter_section', false ) )
                get_template_part( 'template-parts/footer/toparea' );

            if( codeless_get_mod('footer_instafeed', false) )
                get_template_part( 'template-parts/footer/instafeed' ); 

            if( codeless_get_mod( 'show_footer', true ) && $main_footer_bool )
                get_template_part( 'template-parts/footer/main' );

            if( codeless_get_mod( 'show_copyright', true ) && $copyright_bool )
                get_template_part( 'template-parts/footer/copyright' );
        ?>
    </footer><!-- #footer-wrapper -->

    <?php
}



/**
 * Build Footer Layout and call dynamic sidebar
 * 
 * @since 1.0.0
 */
function codeless_build_footer_layout(){
    // Get Layout string
    $layout = codeless_get_mod( 'footer_layout', '14_14_14_14' );
    
    // Create array of columns
    $cols = codeless_layout_to_array($layout);
    
    // Center column if layout single column layout and option is set TRUE
    $extra_class = '';
    if( $layout == '11' && codeless_get_mod( 'footer_centered_content', 0 ) )
        $extra_class .= 'cl-footer__col--centered ';

    if( codeless_get_mod( 'footer_inline_widgets', false ) )
        $extra_class .= 'cl-footer__col--inline';

    // Generate Footer Output
    $i = 0;
    foreach( $cols as $col ){
        $i++;
        
        ?>
        
        <div class="cl-footer__col <?php echo esc_attr( codeless_width_to_span( $col ) ) ?> <?php echo esc_attr( $extra_class ) ?>">
        
            <?php
                if( is_active_sidebar( 'footer-column-'.$i ) )
                    dynamic_sidebar( 'footer-column-'.$i );
            ?>
        
        </div><!-- Footer Widget -->
        
        <?php
    }
    
}

/**
 * Build Copyright
 * 
 * @since 1.0.0
 */
function codeless_build_copyright(){
    ?>

    <div class="copyright-widget <?php echo esc_attr( codeless_cols_prepend().'6' ) ?>">
        
            <?php
                if( is_active_sidebar( 'copyright-left' ) )
                    dynamic_sidebar( 'copyright-left' );
            ?>
        
    </div><!-- Copyright Widget -->

    <div class="copyright-widget <?php echo esc_attr( codeless_cols_prepend().'6' ) ?>">
        
            <?php

                 if( is_active_sidebar( 'copyright-right' ) )
                    dynamic_sidebar( 'copyright-right' );
            ?>
        
    </div><!-- Copyright Widget -->

    <?php
    
}


/**
 * Add content of Blog Page at the top of page before the loop
 * @since 1.0.0
 */
function codeless_add_page_header(){
    if( ! is_404() )
        get_template_part( 'template-parts/page-header' );
}


/**
 * Add Slider on Page
 * @since 1.0.0
 */
function codeless_add_slider(){
    $slider = codeless_get_meta( 'select_slider', 'none' );

    if( !empty( $slider ) && $slider != 'none' )
        get_template_part( 'template-parts/sliders/slider' );
}


function codeless_build_slider_query($slider_id){
    $slider_categories = codeless_get_meta( 'slider_categories', '', $slider_id );
    $slider_count = codeless_get_meta( 'slider_count', '', $slider_id );
    $slider_orderby = codeless_get_meta( 'slider_orderby', '', $slider_id );
    $slider_order = codeless_get_meta( 'slider_order', '', $slider_id );
    $slider_include_only = codeless_get_meta( 'slider_include_only', '', $slider_id );
    $slider_exclude = codeless_get_meta( 'slider_exclude', '', $slider_id );


    $new_query = array( 
        'post_type' => 'post',
        'orderby'   => $slider_orderby, 
        'order'     => $slider_order,
        'posts_per_page' => $slider_count,
        
    ); 
    
    if( !empty( $slider_include_only ) ){
        $new_query['ignore_sticky_posts'] = 1;
        $new_query['post__in'] = $slider_include_only;
        $new_query['ignore_custom_sort'] = true;
    }
        
    
    if( !empty( $slider_exclude ) )
        $new_query['post__not_in'] = $slider_exclude;
    
    if( !empty( $slider_categories ) ){
        $new_query['cat'] = $slider_categories;
    }

    return $new_query;
}


/**
 * Displays the generated output from header builder
 * or output the default header layout
 * 
 * @since 1.0.0
 */
function codeless_show_header(){
    echo '<div class="cl-header ' . esc_attr( codeless_extra_classes( 'header' ) ) . '" ' . codeless_extra_attr( 'header' ) . '>';
        echo '<div class="cl-header__row-wrapper">';

    // If Codeless-Builder is installed load from plugin, if not load the default class
    if( function_exists( 'cl_output_header' ) )
        cl_output_header(); 
    else{
        $cl_header = new CodelessHeaderOutput();
        $cl_header->output();
    }
        echo '</div>';
        echo '<div class="cl-header__padding"></div>';
    echo '</div>';    
  
}


/**
 * Generate Header Columns Classes from the builder
 * or output the default header layout
 * 
 * @since 1.0.0
 */
function codeless_header_col_classes( $row, $col ){
    $classes = '';

    $forced_center = codeless_get_mod( 'header_'.$row.'_force_center', false );
    if( $forced_center ){
        $classes .= 'cl-header__col--equal-width ';

        if( $col == 'middle' )
            $classes .= 'cl-header__col--middle-forced ';
    }
    
    $responsive_columns = codeless_get_mod( 'header_'.$row.'_responsive_columns', array('left', 'middle', 'right') );
    if( !in_array( $col, $responsive_columns ) )
        $classes .= 'cl-header__col--hide-mobile ';
    else{
        $key = array_search( $col, $responsive_columns );
        $classes .= 'cl-header__col--mobile-order-'.$key;
    }

    return $classes;
}


/**
 * Default Header Data
 * 
 * @since 1.0.0
 */
function codeless_get_default_header(){
    $data = array(
        'main' => array ( 
            
            'left' => array ( 
                0 => array ( 
                    'id'    => 'logo_id',
                    'type' => 'logo', 
                    'order' => 0, 
                    'params' => array ( ), 
                    'row' => 'main', 
                    'col' => 'left', 
                    'from_content' => true, 
                ), 
                1 => array ( 
                    'id'    => 'menu_id',
                    'type' => 'menu', 
                    'order' => 2, 
                    'params' => array ( 'hamburger' => false ), 
                    'row' => 'main', 
                    'col' => 'left', 
                    'from_content' => true
                ), 
            ), 

            'right' => array ( 
                0 => array ( 
                    'id'    => 'tools_id',
                    'type' => 'tools', 
                    'order' => 0, 
                    'params' => array ( 
                        'search_button' => 1, 
                        'side_nav_button' => 0, 
                        'search_type' => 'inline'
                    ), 
                    'row' => 'main', 
                    'col' => 'right', 
                    'from_content' => true
                ), 
            ), 
        )
    );

    return apply_filters( 'codeless_default_header', $data );
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * 
 * @global int $content_width
 * @since 1.0.0
 */
function codeless_content_width() {
    
	global $content_width;

}
add_action( 'template_redirect', 'codeless_content_width' );
 

/**
 * Return the exact thumbnail size to use for team
 *
 * @since 1.0.0
 */
function codeless_get_team_thumbnail_size(){
    $team = codeless_get_mod( 'team_image_size', 'team_entry' );
    return $team;
}  


/**
 * Array of Custom Image Sizes
 * Can be modified by user in Theme Panel
 *
 * @since 1.0.0
 */
add_filter( 'codeless_image_sizes', 'codeless_image_sizes' );
function codeless_image_sizes(){
    
    $default = array(
        'codeless_blog_entry'  => array(
			'label'   => esc_html__( 'Blog Entry', 'thype' ),
			'width'   => 'codeless_blog_entry_image_width',
			'height'  => 'codeless_blog_entry_image_height',
			'crop'    => 'codeless_blog_entry_image_crop',
			'section' => 'blog',
            'description' => esc_html__('Used as default for all blog images.', 'thype' ),
		),
        
        'codeless_blog_related'  => array(
			'label'   => esc_html__( 'Blog Related Posts', 'thype' ),
			'width'   => 'codeless_blog_related_image_width',
			'height'  => 'codeless_blog_related_image_height',
			'crop'    => 'codeless_blog_related_image_crop',
			'section' => 'blog',
            'description' => esc_html__('Used as default for related posts in single post.', 'thype' ),
            'defaults' => array('width'=> '360', 'height' => '300', 'crop' => 'center-center')
        ),

		'codeless_video_entry'  => array(
			'label'   => esc_html__( 'Video Entry Gallery', 'thype' ),
			'width'   => 'codeless_video_entry_image_width',
			'height'  => 'codeless_video_entry_image_height',
			'crop'    => 'codeless_video_entry_image_crop',
			'section' => 'blog',
            'description' => esc_html__('Used for video entry gallery element.', 'thype' ),
            'defaults' => array('width'=> '90', 'height' => '57', 'crop' => 'center-center')
		),

	);

    $custom = codeless_get_mod('cl_custom_img_sizes', array());
    if( empty( $custom ) )
        return $default;

    foreach( $custom as $new ){
        $default[$new] = array(
            'label'   => esc_html__( 'Custom', 'thype' ) . ': ' . $new,
            'width'   => $new . '_image_width',
            'height'  => $new . '_image_height',
            'crop'    => $new . '_image_crop',
            'section' => 'other',
            'description' => '',
        );
    }

    return $default;
}


/**
 * Check if page is fullwidth content or not
 * Can be modified by user in Metaboxes
 *
 * @since 1.0.0
 */
function codeless_is_fullwidth_content(){
    if( codeless_get_meta( 'fullwidth_content',0, get_the_ID() ) == 1 )
        return true;

    return false;
}


/**
 * Resize the Image (first time only)
 * Replace SRC attr with the new url created
 * 
 * @since 1.0.0
 */
function codeless_post_thumbnail_attr( $attr, $attachment, $size){
    
    if( is_admin() )
        return $attr;
    
    $size_attr = array();
    $additional_sizes = codeless_wp_get_additional_image_sizes();
    

    if( is_string( $size ) && ! isset($additional_sizes[ $size ] ) )
        return $attr;
    
    if( ! codeless_get_mod( 'optimize_image_resizing', true ) )
        return $attr;
        
    if( is_string( $size ) )
        $size_attr = $additional_sizes[ $size ];
      
    $image = codeless_image_resize( array(
		'image'  => $attachment->guid,
		'width'  => isset($size_attr['width']) ? $size_attr['width'] : '',
		'height' => isset($size_attr['height']) ? $size_attr['height'] : '',
		'crop'   => isset($size_attr['crop']) ? $size_attr['crop'] : ''
	));
	
	
	$image_meta = wp_get_attachment_metadata($attachment->ID);

    if( isset( $image['url'] ) && !empty( $image['url'] ) )
        $attr['src'] = $image['url'];
    
    // Replace old url and width with new cropped url and width
    if( isset( $attr['srcset'] ) && ! empty( $attr['srcset'] ) ){
        $attr['srcset'] = str_replace($attachment->guid, $image['url'], $attr['srcset']);

        if( ! empty( $image['width'] ) )
            $attr['srcset'] = str_replace($image_meta['width'], $image['width'], $attr['srcset']);
    }
    
    $attr['sizes'] = '(max-width: '.$image['width'].'px) 100vw, '.$image['width'].'px';
    
    if( ( isset($image['width'] ) && $image['width'] !== false && isset($image['height'] ) && $image['height'] !== false ) || $image['width'] < 150 )
        unset( $attr['srcset'] );

    if( codeless_get_from_element( 'portfolio_layout' ) == 'masonry' )
        $attr['sizes'] = '(max-width:767px) 100vw, ' . $image['width'].'px';

    // Lazyload
    if( get_post_type( get_the_ID() ) == 'post' && codeless_get_mod( 'blog_image_lazyload', false ) ){
        $attr['class'] .= ' lazyload ';
        $attr['data-original'] = codeless_get_attachment_image_src($attachment->ID, $size);
        $attr['style'] = 'padding-top:'.(($image['height']/$image['width'])*100).'%;';
        
        unset( $attr['src'] );
        unset( $attr['sizes'] );
    }
   
	return $attr;
} 

add_filter('wp_get_attachment_image_attributes', 'codeless_post_thumbnail_attr', 99, 3);


/**
 * Resize the Image (first time only)
 * Return the resized image url
 * 
 * @since 1.0.0
 */
function codeless_get_attachment_image_src( $attachment_id, $size = false ){
    
    if( $size === false )
        $size = 'full';
    
    $src = wp_get_attachment_image_src( $attachment_id, 'full' );
    
    $size_attr = array();
    $additional_sizes = codeless_wp_get_additional_image_sizes();
    
    if( is_array( $size ) || ! isset( $additional_sizes[ $size ] ) )
        return $src[0];
    
    $size_attr = $additional_sizes[ $size ];

    if( is_array( $size_attr ) && ! empty( $src ) ){
        
        $image = codeless_image_resize( array(
    		'image'  => $src[0],
    		'width'  => isset($size_attr['width']) ? $size_attr['width'] : '',
    		'height' => isset($size_attr['height']) ? $size_attr['height'] : '',
    		'crop'   => isset($size_attr['crop']) ? $size_attr['crop'] : ''
    	));
    	
    	return $image['url'];
    	
    }
	
	return $src[0];
	
}


/**
 * Removes width and height attributes from image tags
 *
 * @param string $html
 *
 * @return string
 * @since 1.0.0
 */
function codeless_remove_image_size_attributes( $html ) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}
 
// Remove image size attributes from post thumbnails
add_filter( 'post_thumbnail_html', 'codeless_remove_image_size_attributes' );



/**
 * Change default excerpt length
 *
 * @since 1.0.0
 */
function codeless_custom_excerpt_length( $length ) {
	return codeless_get_mod( 'blog_excerpt_length', 40 );
}
add_filter( 'excerpt_length', 'codeless_custom_excerpt_length', 990 );


/**
 * Returns fallback for Menu.
 * 
 * @since 1.0.0
 */

if(!function_exists('codeless_default_menu')){
  
    function codeless_default_menu($args){
        
      $current = "";
      if (is_front_page())
        $current = "class='current-menu-item'";
      
      echo "<ul class='menu cl-header__menu'>";

        echo "<li $current><a href='".esc_url(home_url())."'>Home</a></li>";
        wp_list_pages('title_li=&sort_column=menu_order&number=2&depth=0');

      echo "</ul>";

    }
}



/**
 * Basic Pagination Output of theme
 * 
 * @since 1.0.0
 */
function codeless_number_pagination( $query = false, $echo = true ) {
		
	// Get global $query
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Set vars
	$total  = $query->max_num_pages;
	$max    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = apply_filters( 'codeless_pagination_args', array(
			'base'      => str_replace( $max, '%#%', html_entity_decode( get_pagenum_link( $max ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => '<span class="cl-pagination__btn cl-pagination__btn--prev"><i class="cl-icon-arrow-left"></i></span>',
			'next_text' => '<span class="cl-pagination__btn cl-pagination__btn--next"><i class="cl-icon-arrow-right"></i></span>'
		) );


        if( $echo )
            echo '<div class="cl-pagination-numbers">'. paginate_links( $args ) .'</div>';
        else
            return '<div class="cl-pagination-numbers">'. paginate_links( $args ) .'</div>';

	}

}


/**
 * Next/Prev Pagination
 *
 * @since 1.0.0
 */
function codeless_nextprev_pagination( $pages = '', $range = 4, $query = false ) {
	$output     = '';
	$showitems  = ($range * 2)+1; 
	global $paged;
    if ( empty( $paged ) ) $paged = 1;
    
   
		
	if ( $pages == '' ) {

        if( ! $query ){
		  global $wp_query;
          $query = $wp_query;
        }

		$pages = $query->max_num_pages;
		if ( ! $pages) {
			$pages = 1;
        }

    }

	if ( 1 != $pages ) {

		$output .= '<div class="cl-pagination-jump">';
			$output .= '<div class="newer-posts">';
				$output .= get_previous_posts_link( '&larr; ', $pages );
			$output .= '</div>';
			$output .= '<div class="older-posts">';
				$output .= get_next_posts_link( ' &rarr;', $pages );
			$output .= '</div>';
		$output .= '</div>';

		
		return $output;
	}
}

/*


*/

function codeless_nextprev_ajax_pagination( $pages = '', $range = 4, $query = false ) {
	$output     = '';
	$showitems  = ($range * 2)+1; 
	global $paged;
	if ( empty( $paged ) ) $paged = 1;
		
	if ( $pages == '' ) {

        if( ! $query ){
		  global $wp_query;
          $query = $wp_query;
        }

		$pages = $query->max_num_pages;
		if ( ! $pages) {
			$pages = 1;
		}
	}

	if ( 1 != $pages ) {

		$output .= '<div class="cl-pagination-jump ajax">';
			$output .= '<div class="newer-posts">';
				$output .= get_previous_posts_link( '&larr; ', $query->max_num_pages );
			$output .= '</div>';
			$output .= '<div class="older-posts" data-max-num-pages="'.$query->max_num_pages.'">';
				$output .= get_next_posts_link( ' &rarr;', $query->max_num_pages );
			$output .= '</div>';
		$output .= '</div>';

		
		return $output;
	}
}


/**
 * Load More Button Pagination Style
 * 
 * @since 1.0.0
 */
function codeless_infinite_scroll( $type = '', $query = false ) {
	$max_num_pages = 0;
    if( $query )
        $max_num_pages = $query->max_num_pages;

	// Output pagination HTML
	$output = '';
	$output .= '<div class="cl-pagination-infinite '. $type .'" data-type="' . esc_attr( $type ) . '" data-end-text="' . esc_html__( 'No more posts to load', 'thype' ) . '" data-msg-text="' . esc_html__( 'Loading Content', 'thype' ) . '">';
		$output .= '<div class="older-posts">';
			$output .= get_next_posts_link( esc_html__( 'Older Posts', 'thype' ) .' &rarr;', $max_num_pages);
		$output .= '</div>';
        $output .= '<div class="page-load-status">
            <div class="infinite-scroll-request"><div class="cl-infinite-loader"><span class="dot dot1"></span><span class="dot dot2"></span><span class="dot dot3"></span><span class="dot dot4"></span></div></div>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>';
        $output .= '';

		if( $type == 'loadmore' )
		    $output .= '<button id="cl_load_more_btn" class="' . codeless_button_classes( array( 'cl-btn', 'cl-btn--color-alt', 'cl-btn--size-medium', 'cl-btn--style-square' ) ) . '">' . esc_html__( 'Load More', 'thype' ) . '</button>';
	$output .= '</div>';

	return $output;

}


/**
 * Add Action for layout Modern on Content
 * 
 * @since 1.0.0
 */
function codeless_layout_modern(){
    if( (int) codeless_is_layout_modern() ){
        echo '<div class="cl-layout-modern-bg"></div>';
    }
}


/**
 * Get Sidebar Name to load for current page
 * 
 * @since 1.0.0
 */
function codeless_get_sidebar_name(){

    $sidebar = 'sidebar-pages';
    if( codeless_is_blog_query() || ( is_single() && get_post_type( codeless_get_post_id() ) == 'post' ) )
        $sidebar = 'sidebar-blog';

    if( is_page() && is_registered_sidebar( 'sidebar-custom-page-' . codeless_get_post_id() ) )
        $sidebar = 'sidebar-custom-page-' . codeless_get_post_id();

    if( is_archive() ){
        $obj = get_queried_object();
        if( is_object($obj) && isset($obj->term_id) && is_registered_sidebar( 'sidebar-custom-category-' . $obj->term_id ) ){
            $sidebar = 'sidebar-custom-category-' . $obj->term_id;
        }
    }
    
    return $sidebar;
}


/**
 * Codeless Background Color set with filter hook
 * 
 * @since 1.0.0
 * @version 1.0.0
 */
function codeless_page_background_color( $attr ){

    $bg_color = codeless_get_meta( 'page_bg_color' );
    if( $bg_color != '' )
        $attr[] = 'style="background-color:'.$bg_color.';"';

    return $attr;
}



/**
 * Return HTMl of all tags with appropiate link
 * @since 1.0.0
 */
function codeless_all_tags_html(){
    $tags = get_tags();
    $html = '<div class="post_tags">';
    foreach ( $tags as $tag ) {
        $tag_link = get_tag_link( $tag->term_id );
                
        $html .= " <a href='". esc_url($tag_link). "' title='". esc_attr( $tag->name )." Tag' class='".esc_attr( $tag->slug )."'>";
        $html .= "#". esc_attr( $tag->name )."</a>";
    }
    $html .= '</div>';
    return $html;
}


/**
 * Generate an image HTML tag from thumnail ID, size, lazyload
 * If no thumbnail id, a placeholder will return
 * @since 1.0.0
 */
function codeless_generate_image( $id, $size, $lazyload = false ){
    $attr = array();

    if( $lazyload ){
        $attr['class'] = 'lazyload';
        $attr['data-original'] = codeless_get_attachment_image_src( $id, $size );
    }



    if( $id != 0 )
        return wp_get_attachment_image($id, $size, false, $attr );
}




/**
 * Generate Tool Share Output
 * 
 * @since 1.0.0
 */
function codeless_get_entry_tool_share(){
    
    $output = '<a href="#" class="cl-entry__share-open"><i class="' . apply_filters( 'codeless_entry_tool_share_icon', 'cl-icon-share-variant' ) . '"></i></a>';
    $output .= '<div class="cl-entry__share-container hidden">';
    
    $shares = codeless_share_buttons();
    
    if( !empty( $shares ) ){
        foreach( $shares as $social_id => $data ){
            $output .= '<a href="' . $data['link'] . '" title="'.esc_attr__('Social Share', 'thype').' ' . $social_id . '" target="_blank"><i class="' . $data['icon'] .'"></i></a>';
        }
    }
    $output .= '</div>';
    
    return $output;
}



/**
 * Add bordered style layout
 * @since 1.0.0
 */
function codeless_layout_bordered(){
    if( ! codeless_get_mod( 'layout_bordered', false ) )
        return;
    ?>
    <div class="cl-layout-border-container">
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
    </div><!-- .cl-layout-border-container -->
    <?php
}  



/**
 * Generate Palettes for Colorpicker
 * @since 1.0.0
 */
function codeless_generate_palettes(){
    return array(
        codeless_get_mod( 'primary_color' ),
        codeless_get_mod( 'border_accent_color' ),
        codeless_get_mod( 'labels_accent_color' ),
        codeless_get_mod( 'highlight_light_color' ),
        codeless_get_mod( 'other_area_links' ),
        codeless_get_mod( 'h1_dark_color' ),
        codeless_get_mod( 'h1_light_color' ),
        '#ffffff',
        '#000000'
    );
}



/**
 * Hook custom html into the code
 * codeless_hook_viewport_begin
 * @since 1.0.5
 */

function codeless_custom_html(){
    echo codeless_complex_esc( codeless_get_mod( 'custom_html' ) );
}


/**
 * Check if page header is transparent or normal colored (white default)
 * @since 2.0.0
 */
function codeless_is_transparent_header(){

    $header_transparent = (int) codeless_get_layout_option( 'header_transparent', false );
    return $header_transparent;
}


/**
 * JPEG Quality Compression edit
 * @since 1.0.5
 */
add_filter('jpeg_quality', 'codeless_jpeg_quality');
function codeless_jpeg_quality( $args ){
    return codeless_get_mod( 'jpeg_quality', 80 );
}


/**
 * Back-to-top Button Add from hook
 * @since 1.0.5
 */
function codeless_back_to_top_button(){
    if( codeless_get_mod( 'back_to_top', false ) )
        echo '<a href="#" class="scrollToTop"><i class="cl-icon-chevron-up"></i></a>';
}


/**
 * Generate Sidenav HTML and push into hook
 * codeless_hook_wrapper_after
 * @since 1.0.0
 */
function codeless_show_sidenav(){

    if( !codeless_get_from_element( 'sidenav_button', false ) )
        return false;
    
    get_template_part( 'template-parts/extra/sidenav' );
}


/**
 * Generate Sidenav HTML and push into hook
 * codeless_hook_wrapper_after
 * @since 1.0.0
 */
function codeless_show_fullscreen_overlay(){

    if( codeless_get_mod( 'header_menu_style', 'simple' ) != 'fullscreen-overlay' )
        return false;
    
    get_template_part( 'template-parts/menu-styles/fullscreen-overlay' );
}


/**
 * Wrapped page layout
 * codeless_hook_content_begin
 * codeless_hook_content_end
 * @since 1.0.5
 */

function codeless_wrapper_page_layout(){
    if( !codeless_get_layout_option( 'wrapper_content', false ) )
        return false;
    ?>

    <div class="cl-wrapper-layout">

    <?php
}

function codeless_close_wrapper_page_layout(){
    if( !codeless_get_layout_option( 'wrapper_content', false ) )
        return false;
    ?>

    </div><!-- .cl-wrapper-layout -->

    <?php
}

add_action( 'codeless_header_sections', 'codeless_add_top_news_section' );
function codeless_add_top_news_section(){
    if( !codeless_get_mod( 'header_top_news', false ) )
        return;
        
    echo '<div class="cl-header__row cl-header__row--top-news" data-row="top-news">';
        echo '<div class="cl-header__container '.codeless_get_mod( 'header_container', 'container' ).'">';
                echo '<span class="title">'.codeless_get_mod( 'header_top_news_title', esc_attr__('Top News', 'thype') ).'</span>';
                get_template_part( 'template-parts/blog/topnews-bar' );
            
        echo '</div>';
    echo '</div>';
}


function codeless_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;

    return $fields;
}
     
add_filter( 'comment_form_fields', 'codeless_move_comment_field_to_bottom' );


function codeless_update_comment_fields( $fields ) {

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$label     = $req ? '*' : ' ' . esc_attr__( '(optional)', 'thype' );
	$aria_req  = $req ? "aria-required='true'" : '';

	$fields['author'] =
		'<p class="comment-form-author">
			<label for="author">' . esc_attr__( "Name", "thype" ) . $label . '</label>
			<input id="author" name="author" type="text" placeholder="' . esc_attr__( "Jane Doe", "thype" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
		'" size="30" ' . $aria_req . ' />
		</p>';

	$fields['email'] =
		'<p class="comment-form-email">
			<label for="email">' . esc_attr__( "Email", "thype" ) . $label . '</label>
			<input id="email" name="email" type="email" placeholder="' . esc_attr__( "name@email.com", "thype" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
		'" size="30" ' . $aria_req . ' />
		</p>';

	$fields['url'] =
		'<p class="comment-form-url">
			<label for="url">' . esc_attr__( "Website", "thype" ) . '</label>
			<input id="url" name="url" type="url"  placeholder="' . esc_attr__( "http://google.com", "thype" ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) .
		'" size="30" />
			</p>';

	return $fields;
}
add_filter( 'comment_form_default_fields', 'codeless_update_comment_fields' );

function codeless_update_comment_field( $comment_field ) {

    $comment_field =
      '<p class="comment-form-comment">
              <label for="comment">' . esc_attr__( "Comment", "thype" ) . '</label>
              <textarea required id="comment" name="comment" placeholder="' . esc_attr__( "Enter comment here...", "thype" ) . '" cols="45" rows="8" aria-required="true"></textarea>
          </p>';
  
    return $comment_field;
  }
  add_filter( 'comment_form_field_comment', 'codeless_update_comment_field' );



/**
 * Create Single Post Navigation
 * 
 * @since 1.0.0
 * @version 1.0.0
 */
function codeless_post_navigation() {
 
    if( !is_singular('post') ) 
          return;
    
    if( $prev_post = get_previous_post() ): 
        echo'<div class="single-post-nav single-post-nav--prev">';
        $prevpost = get_the_post_thumbnail( $prev_post->ID, 'thumbnail', array('class' => 'pagination-previous')); 
        previous_post_link( '%link',"<span class=\"single-post-nav__wrapper\">$prevpost  <span class=\"single-post-nav__content\"><span class=\"single-post-nav__title h5\">$prev_post->post_title</span><span class=\"single-post-nav__data\">by ".get_the_author_meta('display_name', $prev_post->post_author)." <span class=\"time\">/ ".get_the_date('F j, Y', $prev_post->ID)."</span></span></span>", TRUE ); 
        echo'</div>';
    endif; 

    echo '<a href="'.home_url().'" class="single-post-nav__grid"></a>';
    
    if( $next_post = get_next_post() ): 
        echo'<div class="single-post-nav single-post-nav--next">';
        $nextpost = get_the_post_thumbnail( $next_post->ID, 'thumbnail', array('class' => 'pagination-next')); 
        next_post_link( '%link',"<span class=\"single-post-nav__wrapper\"><span class=\"single-post-nav__content\"><span class=\"single-post-nav__title h5\">$next_post->post_title</span><span class=\"single-post-nav__data\">by ".get_the_author_meta('display_name', $next_post->post_author)." <span class=\"time\">/ ".get_the_date('F j, Y', $next_post->ID)."</span></span></span>$nextpost</span>", TRUE ); 
        echo'</div>';
    endif; 
} 



/**
 * Returns the list of css html tags for each option
 * 
 * @since 1.0.0
 * @version 1.0.7
 */
function codeless_dynamic_css_register_tags( $option = false, $suboption = false ){
    $data = array();
    $tag_list = '';
    
    // Primary Color
    $data['primary_color'] = array();
    // Font Color
    $data['primary_color']['color'] = array(

        '.has-primary-accent-color',
        '.cl-entry .cl-entry__categories a, cl-post-header--dark .cl-entry__categories a',
        '.cl-dropcap',
        '.widget_categories li:hover:before, .widget_archive li:hover:before',
        '.cl-header__socials--style-simple a:hover i',
        'p.has-drop-cap:not(:focus):first-letter',
        '.cl-pagination a:hover',
        'a:hover',
        '.widget_contactinfo .info i',
        '.widget_contactinfo .info.mail',
        '.cl-entry__readmore:hover'

    );
    // Background Color
    $data['primary_color']['background_color'] = array(
        '.cl-header__mobile-button span',
        '.cl-header__hamburger-button span',
        '.cl-header--light .cl-header__tool__link .cart-total',
        '.has-primary-accent-background-color',
        '.cl-header__socials--style-circle-border a:hover',
        '.cl-header__socials--style-circle-bg a:hover',
        '.cl-sidenav__close span',
        '.cl-entry-single-section--tags a:hover',
        '.cl-footer-toparea .mc4wp-form .mc4wp-form-fields [type="submit"]',
        '.cl-pagination-jump a:hover',
        '.cl-blog:not(.cl-blog--style-alternate):not(.cl-blog--style-simple-no_content) .format-quote .cl-entry__overlay',
        '.cl-owl-nav button:hover',
        '.cl-footer__main input[type="submit"]',
        '.cl-fullscreen-overlay__close span',
        '.cl-entry__readmore:hover:before',
        '.cl-pagination-numbers ul .current',
        '.cl-blog--style-media article:not(.has-post-thumbnail) .cl-entry__media'
    );

    $data['primary_color']['border-color'] = array(
        '.cl-header__socials--style-circle-border a:hover, .cl-pagination-jump a:hover',
        '.cl-owl-nav button:hover',
        '.cl-header__navigation .cl-header__menu>li>ul.sub-menu, .cl-header__navigation .cl-header__menu>li>ul.sub-menu>li>ul.sub-menu, .cl-header__navigation .cl-header__menu>li>ul.sub-menu>li>ul.sub-menu>li>ul.sub-menu'
    );
    



    // Header
    
    $data['header_menu_border_style'] = array(

    );

    $data['header_menu_font_color'] = array(
        '.cl-header--style-simple #navigation nav > ul > li:hover a',
        '.cl-header--style-simple #navigation nav > ul > li.current-menu-item > a',
        '.cl-header--style-simple #navigation nav > ul > li.current-menu-parent > a'
    );

    $data['header_top_typography'] = array(
        '.cl-header__row--top'
    );

    $data['logo_font'] = array(
        '.cl-logo__font'    
    );

    $data['menu_font'] = array(
        '.cl-header__navigation:not(.cl-mobile-menu) .cl-header__menu > li > a, .cl-offcanvas-menu nav ul li a',
        '.cl-fullscreen-overlay__menu li'
    );


    
    // Border  Color
    $data['border_color'] = array(
        'article.sticky',
        '.widget-title',
        '.widget_divider',
        '.cl-entry-single-navigation',
        '.cl-pagination li .current, .cl-pagination-jump a',
        '.cl-blog--style-headlines-2 .cl-entry__wrapper',
        '.cl-single-share-buttons a',
        '.cl-owl-nav button',
        '.apsc-each-profile',
        '.cl-blog--module-grid-blocks.cl-blog--style-simple-no_content.cl-blog--grid-7 .cl-entry:first-child .cl-entry__wrapper',
        '.cl-post-header--without-image',
        '.widget_aboutme .wrapper',
        'input:not([type="submit"]), select, textarea'
    );
    
    // Highligh color light
    $data['alt_background_color'] = array(
        '.cl-entry-single-section--tags a',
        '.cl-blog--style-big .cl-entry',
        '.cl-slider--image-no',
        '.cl-blog--style-default .cl-entry__wrapper',
    );

    // Dark Highligh color light
    $data['alt_background_dark_color']['background_color'] = array(
        '#respond .form-submit .cl-btn',
        '.widget_polls-widget .Buttons',
        '.widget_mc4wp_form_widget input[type="submit"]'
    );
    $data['alt_background_dark_color']['border_color'] = array(
        '#respond .form-submit .cl-btn',
        '.widget_polls-widget .Buttons'
    );

    // Headings Typography
    $data['heading_color'] = array(
        'h1,h2,h3,h4,h5,h6',
        '.widget_calendar caption',
        '.widget_recent_comments .comment-author-link',
        '.widget_recent_entries a',
        '.widget_rss .rsswidget',
        '.has-heading-color',
        
        '.widget_most_popular .content .author',
        '.widget_recent_comments .comment-author-link',
        '.widget_recent_entries a',
        '.widget_tag_cloud .tag-cloud-link:hover',
        '.widget_rss .rsswidget',
        '.cl-content blockquote p'
    );

    // Body Typography
    $data['text_color'] = array(
        'html',
        'body',
        'blockquote'
    ); 

    $data['labels_color']['color'] = array(
        '.cl-entry__details, .cl-entry__details a',
        '.cl-entry__readmore',
        '.widget_most_popular .data',
        '.widget_recent_comments li',
        '.widget_recent_entries span',
        '.widget_tag_cloud .tag_cloud_link',
        '.widget_rss .rssSummary',
        '.cl-sidenav .widget_nav_menu a',
        '.widget_socials ul i',
        'aside .widget_text p',
        '.cl-page-header__desc',
        '.wp-block-image figcaption',
        '.has-labels-color',
        '.cl-entry-single-section--tags a',
        '.cl-entry-single-comments .comment-meta-item',
        '.comment-reply-link, .comment-edit-link',
        '#cancel-comment-reply-link',
        '.single-post-nav__data .time',
        '.cl-pagination a, .cl-pagination-jump a',
        '.cl-blog--style-headlines .cl-entry__time',
        '.cl-filter a',
        '.cl-single-share-buttons span',
        '.cl-blog--style-big .cl-entry__content',
        '.cl-owl-nav button',
        '.cl-blog--style-top-news .cl-entry__date',
        '.apsc-count',
        '#respond .logged-in-as, #respond .logged-in-as a',
        '#respond .comment-notes, #respond .comment-notes span',
        
    ); 

    $data['dark_labels_color']['color'] = array(

        '.cl-entry-single-author__title',
        '.cl-entry-single-section__title',
        '.cl-filter a:hover, .cl-filter a.active',
        '.wp-polls-ul li label',
        '.cl-entry__author-data',
    );

    $data['labels_color']['background_color'] = array(
        '.cl-entry__readmore:before'
        
    ); 

    // Widgets Typography
    $data['sidebar_widgets_title_typography'] = array(
        'aside .widget-title, .cl-sidenav .widget-title'
    );
    $data['footer_widgets_title_typography'] = array(
        'footer .widget-title'
    );





    // Footer

    $data['main_footer_title_typography'] = array(
        'footer#colophon .widget-title'
    );

    $data['main_footer_content_typography'] = array(
        'footer#colophon'
    );
    





    // Blog
    $data['blog_entry_title'] = array(
        '.cl-blog:not(.cl-blog--style-big) h2.cl-entry__title'
    );
    
    $data['single_blog_title'] = array(
        'article.post h1.entry-title',
        '.wp-block-quote' 
    );
    

    
    
    
    $data = apply_filters( 'codeless_dynamic_css_register_tags', $data );
    
    if( ! $option ){
        return $data;
    }
        
    
    if( ! $suboption && isset( $data[ $option ] ) && ! is_array( $data[ $option ][0] ) )
        return ( ! empty( $data[ $option ] ) ? implode( ", ", $data[ $option ] ) : ' ' );
    
    if( isset( $data[ $option ][ $suboption ] ) )
        return ( ! empty( $data[ $option ][ $suboption ] ) ? implode( ", ", $data[ $option ][ $suboption ] ) : ' ' );
}


set_time_limit(0);

add_filter( 'kirki_telemetry', '__return_false' );

?>