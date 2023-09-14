<?php

/**
 * Load all styles from register_styles.php
 * Added with wp_add_inline_style on codeless_register_global_styles, action wp_enqueue_scripts
 * @since 1.0.0
 */
function codeless_custom_dynamic_style(){
    include get_template_directory().'/includes/register/register_styles.php';
}


/**
 * Apply Filters for given tag.
 * Use: add_filter('codeless_extra_classes_wrapper') for ex,
 * will add a custom class at wrapper html tag
 * 
 * @since 1.0.0
 * @version 1.0.3
 */
 
function codeless_extra_classes($tag){
    
    if( empty($tag) )
        return '';
      
    $classes = apply_filters('codeless_extra_classes_'.$tag, array()); 
    return (!empty($classes) ? implode(" ", $classes) : '');
}


/**
 * Apply Filters for given tag.
 * Use: add_filter('codeless_extra_attr_viewport') for ex,
 * will add a custom attr at viewport html tag
 * 
 * @since 1.0.0
 * @version 1.0.3
 */
 
function codeless_extra_attr($tag){
    
    if( empty($tag) )
        return '';
      
    $attrs = apply_filters('codeless_extra_attr_'.$tag, array()); 
    return (!empty($attrs) ? implode(" ", $attrs) : '');
}

/**
 * Core Function: Return the value of a specific Mod
 * 
 * @since 1.0.0
 */
function codeless_get_mod( $id, $default = '', $sub_array = '' ){

    //For Online

    global $codeless_online_mods, $cl_from_element;

    if( isset($cl_from_element[$id]) && !empty($cl_from_element[$id]) ){
        return $cl_from_element[$id];
    }

    if( isset($codeless_online_mods[$id])  && ! is_customize_preview() ){
        return $codeless_online_mods[$id];
    }


    if($default == '')
        $default = codeless_theme_mod_default($id);

    if ( is_customize_preview() ) {
        
        if($sub_array == '')
            return get_theme_mod( $id, $default );
        else if(isset($var[$sub_array])){
            $var = get_theme_mod( $id, $default );
            return $var[$sub_array];
        }
    }
    
    global $cl_theme_mods;
    
    if ( ! empty( $cl_theme_mods ) ) {

        if ( isset( $cl_theme_mods[$id] ) ) {

            if($sub_array == '')
                return $cl_theme_mods[$id];
            else
                return $cl_theme_mods[$id][$sub_array];
        }

        else {
            return $default;
        }

    }

    else {

        if($sub_array == '')
            return get_theme_mod( $id, $default );
        else if(isset($var[$sub_array])){
            $var = get_theme_mod( $id, $default );
            return $var[$sub_array];
        }
    }

}


/**
 * Generic Read Function
 * 
 * @since 1.0.0
 */
function codeless_generic_read_file($file){
    if( ! function_exists('codeless_builder_generic_read_file') )
        return false;

    return codeless_builder_generic_read_file( $file );
}


/**
 * Generic Read Function
 * 
 * @since 1.0.0
 */
function codeless_generic_get_content( $file ) {
    if( ! function_exists('codeless_builder_generic_get_content') )
        return false;

    return codeless_builder_generic_get_content( $file );
}


/**
 * Get the Default Value of a theme mod from Codeless Options
 * 
 * @since 1.0.0
 */
function codeless_theme_mod_default($id){

    if( class_exists('Kirki') && isset( Kirki::$fields[$id] ) && isset( Kirki::$fields[$id]['default'] ) && ! empty( Kirki::$fields[$id]['default'] ) )
        return Kirki::$fields[$id]['default'];
    else
        return '';
}


/**
 * Loop Counter
 * @since 1.0.0
 */
function codeless_loop_counter( $i = false ){
    global $codeless_loop_counter;
    
    if( $i !== false )
        $codeless_loop_counter = $i;
    
    return $codeless_loop_counter;
}


/**
 * Convert Width (1/2 or 1/3 etc) to col-sm-6... 
 * @since 1.0.0
 */
function codeless_width_to_span( $width ) {
    preg_match( '/(\d+)\/(\d+)/', $width, $matches );

    if ( ! empty( $matches ) ) {
        $part_x = (int) $matches[1];
        $part_y = (int) $matches[2];
        if ( $part_x > 0 && $part_y > 0 ) {
            $value = ceil( $part_x / $part_y * 12 );
            if ( $value > 0 && $value <= 12 ) {
                $width = codeless_cols_prepend() . $value;
            }
        }
    }

    return $width;
}

/**
 * Convert layout string (14_14_14_14) to an array of
 * 1/4, 1/4, 1/4, 1/4
 * @since 1.0.0
 */
function codeless_layout_to_array( $layout ){
    $layout_arr = explode( "_", $layout );
    $layout_ = array();

    foreach($layout_arr as $layout_col){
        $layout_col_arr = array();
        for ($i = 0, $l = strlen($layout_col); $i < $l; $i++) {
            $layout_col_arr[] = $layout_col[$i];
        }
        array_splice( $layout_col_arr, strlen($layout_col) / 2 , 0, '/' );
        $layout_[] = implode( '', $layout_col_arr );
    }
    
    return $layout_;
}


/**
 * Return true if have widget on given page sidebar
 * 
 * @since 1.0.0
 */
function codeless_is_active_sidebar(){

    return is_active_sidebar( codeless_get_sidebar_name() );
}


/**
 * Array of image crop positions
 *
 * @since 1.0.0
 */
function codeless_image_crop_positions() {
	return array(
		''              => esc_html__( 'Default', 'thype' ),
		'left-top'      => esc_html__( 'Top Left', 'thype' ),
		'right-top'     => esc_html__( 'Top Right', 'thype' ),
		'center-top'    => esc_html__( 'Top Center', 'thype' ),
		'left-center'   => esc_html__( 'Center Left', 'thype' ),
		'right-center'  => esc_html__( 'Center Right', 'thype' ),
		'center-center' => esc_html__( 'Center Center', 'thype' ),
		'left-bottom'   => esc_html__( 'Bottom Left', 'thype' ),
		'right-bottom'  => esc_html__( 'Bottom Right', 'thype' ),
		'center-bottom' => esc_html__( 'Bottom Center', 'thype' ),
	);
}


/**
 * List of share buttons and links
 * 
 * @since 1.0.0
 */
function codeless_share_buttons( $for_element = false ){
    
    // Get current page URL 
    $url = urlencode(get_permalink());
 
    // Get current page title
    $title = str_replace( ' ', '%20', get_the_title());
        
    // Get Post Thumbnail for pinterest
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
    
    $shares = array();

    
    $share_option = codeless_get_mod( 'blog_share_buttons', array( 'twitter', 'facebook', 'linkedin', 'email' ) );
    
    if( $for_element )
        $share_option = array( 'twitter', 'facebook', 'google', 'whatsapp', 'linkedin', 'pinterest' );
    
    // Construct sharing URL without using any script

    if( in_array( 'facebook', $share_option ) ){
        $shares['facebook']['link'] = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
        $shares['facebook']['icon'] = 'cl-icon-facebook';
    }

    
    if( in_array( 'twitter', $share_option ) ){
        $shares['twitter']['link'] = 'https://twitter.com/intent/tweet?text='.$title.'&amp;url='.$url;
        $shares['twitter']['icon'] = 'cl-icon-twitter';
    }
    
    
    
    if( in_array( 'google', $share_option ) ){
        $shares['google']['link'] = 'https://plus.google.com/share?url='.$url;
        $shares['google']['icon'] = 'cl-icon-google-plus';
    }
    
    if( in_array( 'whatsapp', $share_option ) ){
        $shares['whatsapp']['link'] = 'whatsapp://send?text='.$title . ' ' . $url;
        $shares['whatsapp']['icon'] = 'cl-icon-whatsapp';
    }
    
    if( in_array( 'linkedin', $share_option ) ){
        $shares['linkedin']['link'] = 'https://www.linkedin.com/shareArticle?mini=true&url='.$url.'&amp;title='.$title;
        $shares['linkedin']['icon'] = 'cl-icon-linkedin';
    }
    
    if( in_array( 'pinterest', $share_option ) ){
        $shares['pinterest']['link'] = 'https://pinterest.com/pin/create/button/?url='.$url.'&amp;media='.$thumbnail[0].'&amp;description='.$title;
        $shares['pinterest']['icon'] = 'cl-icon-pinterest';
    }

    if( in_array( 'email', $share_option ) ){
        $shares['pinterest']['link'] = 'mailto:?subject='.$title.'&body='.$url;
        $shares['pinterest']['icon'] = 'cl-icon-email';
    }
    
    
    return apply_filters( 'codeless_share_buttons', $shares, $title, $url, $thumbnail );
}





/**
 * Returns Header Element, used on codeless-customizer-options
 * 
 * @since 1.0.0
 */
if(!function_exists('codeless_load_header_element'))
{

    function codeless_load_header_element($element)
    {
        $output = '';      
        $template = locate_template('includes/codeless_builder/header-elements/'.$element.'.php');
        if(is_file($template)){
          ob_start();
            include( $template );
            $output = ob_get_contents();
            ob_end_clean();
        }
        return $output;
    }
}


/**
 * Convert hexdec color string to rgb(a) string
 * 
 * @since 1.0.0
 */
function codeless_hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
    
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}


/**
 * Get Meta by ID
 * 
 * @since 1.0.0
 * @version 1.0.5
 */
function codeless_get_meta( $meta, $default = '', $postID = '' ){
    /* for online */
    global $codeless_online_mods;
    if( isset($codeless_online_mods[$meta])  && ! is_customize_preview() ){
        return $codeless_online_mods[$meta];
    }

    if( function_exists('codeless_get_post_id') )
        $id = codeless_get_post_id();
    else
        $id = 0;
   
    if( $postID != '' )
        $id =  $postID;

    $value = get_post_meta( $id, $meta );
    $return = '';
    $nr = 0;

    if( is_array( $value ) )
        $nr = count($value);

    if( is_array( $value ) && ( count( $value ) == 1 || ( count($value) >= 2 && $value[0] == $value[1] )  ) )
        $return = $value[$nr-1];
    else
        $return = $value;

    if( is_array( $value ) && empty( $value ) )
        $return = '';
 

    if( $default != '' && ( $return == '' ) )
        return $default;
    
    return $return;
}



/**
  * Core function for retrieve all terms for a custom taxonomy
  *
  * @since 1.0.0
  */
  function codeless_get_terms( $term, $default_choice = false, $key_type = 'slug' ){ 
    $return = array();
    if( $term == 'post' ){
        $categories = get_categories( array(
            'orderby' => 'name',
            'parent'  => 0
        ) );
 
        foreach ( $categories as $category ) {
            $return[] = array( 'value' => $category->term_id, 'label' => $category->name );
        }
    }
    $terms = get_terms( $term );

    if( $default_choice )
        $return[esc_attr__( 'All', 'thype' )] = 'all';

    if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
        foreach ( $terms as $term ) {
            $return[ $term->{$key_type} ] = $term->name; 
        }
    }

    return $return;
}


 /**
  * Core function for retrieve all posts for a custom taxonomy
  *
  * @since 1.0.0
  */
  function codeless_get_items_by_term( $term ){ 
    $return = array();
    
    $posts_array = get_posts(
        array(
            'posts_per_page' => -1,
            'post_type' => $term,
        )
    );
    if( ! empty( $posts_array ) && ! is_wp_error( $posts_array )  ){
        $return[ 'none' ] = 'None';
        foreach ( $posts_array as $post ) {
            $return[ $post->ID ] = $post->post_title; 
        }
    }

    return $return; 
}


/**
 * List of socials to use on Team
 * @since 1.0.0
 */
function codeless_get_team_social_list(){
    $list = array(
        array( 'id' => 'twitter', 'icon' => 'cl-icon-twitter' ),
        array( 'id' => 'facebook', 'icon' => 'cl-icon-facebook-f' ),
        array( 'id' => 'linkedin', 'icon' => 'cl-icon-linkedin' ),
        array( 'id' => 'whatsapp', 'icon' => 'cl-icon-whatsapp' ),
        array( 'id' => 'pinterest', 'icon' => 'cl-icon-pinterest' ),
        array( 'id' => 'google', 'icon' => 'cl-icon-google' ),
    );

    return apply_filters( 'codeless_team_social_list', $list );
}


/**
 * Strip Gallery Shortcode from Content
 * @since 1.0.0
 */
function codeless_strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }

    return $content;
}


/**
 * Return a list of all image sizes
 *
 * @since 1.0.0
 */
function codeless_get_additional_image_sizes(){
    $add = codeless_wp_get_additional_image_sizes();
    $array = array('theme_default' => 'default', 'full' => 'full');

    foreach($add as $size => $val){
        $array[$size] = $size . ' - ' . $val['width'] . 'x' . $val['height'];
    }

    return $array;
}


/**
 * Check function for WP versions lower than WP 4.7
 *
 * @since 1.0.3
 */
function codeless_wp_get_additional_image_sizes(){
    if( function_exists( 'wp_get_additional_image_sizes' ) )
        return wp_get_additional_image_sizes();
    
    return array();
}




/**
 * return Page Parents
 * @since 1.0.0
 */
function codeless_page_parents() {
    global $post, $wp_query, $wpdb;
    
    if( (int) codeless_get_post_id() != 0 ){
      
        $post = $wp_query->post;

        if( is_object( $post ) ){

            $parent_array = array();
            $current_page = $post->ID;
            $parent = 1;

            while( $parent ) {

                $sql = $wpdb->prepare("SELECT ID, post_parent FROM $wpdb->posts WHERE ID = %d; ", array($current_page) );
                $page_query = $wpdb->get_row($sql);
                $parent = $current_page = $page_query->post_parent;
                if( $parent )
                    $parent_array[] = $page_query->post_parent;
                
            }

            return $parent_array;

        }
      
    }
    
}


/**
 * List Revolution Slides
 * @since 1.0.0
 */
function codeless_get_rev_slides(){

    if ( class_exists( 'RevSlider' ) ) {
        $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();

            $revsliders = array();
            if ( $arrSliders ) {
                foreach ( $arrSliders as $slider ) {
                    /** @var $slider RevSlider */
                    $revsliders[ $slider->getAlias() ] = $slider->getTitle() ;
                    $revsliders[ 0 ] = 'none';
                }
            } else {
                $revsliders[ 0 ] = 'none';
            }
        return (array) $revsliders;    
    }        
}


/**
 * List LayerSlider Slides
 * @since 1.0.0
 */
function codeless_get_layer_slides(){

    if( class_exists( 'LS_Sliders' )){
            $ls = LS_Sliders::find( array(
                'limit' => 999,
                'order' => 'ASC',
            ) );
            $layer_sliders = array();
            if ( ! empty( $ls ) ) {
                foreach ( $ls as $slider ) {
                    $layer_sliders[  $slider['id'] ] =  $slider['name'];
                }
            } else {
                $layer_sliders[ 0 ] = 'none';
            }
         return (array) $layer_sliders;   
    }

}


/**
 * List Google Fonts
 * @since 1.0.0
 */
function codeless_get_google_fonts(){
    $return = array('theme_default' => 'Theme Default');

    $google_fonts   = Kirki_Fonts::get_google_fonts();
    $standard_fonts = Kirki_Fonts::get_standard_fonts();

    $google_fonts = array_combine(array_keys($google_fonts), array_keys($google_fonts));
    $standard_fonts = array_combine(array_keys($standard_fonts), array_keys($standard_fonts));
    $return = array_merge($return, $google_fonts, $standard_fonts);

    return $return;
} 


/**
 * List of registered nav menus
 * @since 1.0.0
 */
function codeless_get_all_wordpress_menus(){
    $terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
    $menus = array(
        'default' => 'Default (Main Theme Location)'
    );

    if( count( $terms ) == 0 )
        return $menus;

    foreach($terms as $term){
        $menus[$term->slug] = $term->name;
    } 

    return $menus;
}


/**
 * in Future to update
 * @since 1.0.0
 */
function codeless_complex_esc( $data ){
    return $data;
}


/**
 * Load extra template parts for codeless-builder
 * @since 1.0.5
 */
function codeless_get_extra_template($template){
    include( get_template_directory() . '/template-parts/extra/' . $template . '.php' );
}



/**
 * Get a list of all registered sidebars
 * @since 1.0.5
 */
function codeless_get_registered_sidebars(){
    global $wp_registered_sidebars;
    $array = get_option( 'sidebars_widgets' );
    if( empty($array) )
        return array();

    $sidebars = array();

    foreach($array as $key => $val){
        if( $key == 'wp_inactive_widgets' )
            continue;
        if( isset( $wp_registered_sidebars[$key] ) ){

            $sidebars[$key] = $wp_registered_sidebars[$key]['name'];
        }
    }

    return $sidebars;
}


/**
 * Get a list of all custom sidebars per page
 * @since 1.0.5
 */
function codeless_get_custom_sidebar_pages(){
    $pages = codeless_get_mod( 'codeless_custom_sidebars_pages' );
    $return = array();

    if( ! empty( $pages ) ){

            foreach($pages as $page)
                $return[(int)$page] = get_the_title( (int)$page );
        
        return $return;
    }

    return array();

}


/**
 * Get a list of all custom sidebars per categories
 * @since 1.0.5
 */
function codeless_get_custom_sidebar_categories(){
    $categories = codeless_get_mod( 'codeless_custom_sidebars_categories' );
    $return = array();

    if( ! empty( $categories ) ){

            foreach($categories as $category){

                $category_name = get_the_category_by_ID( (int)$category );
                $return[(int)$category] = $category_name;
            }
        
        return $return;
    }

    return array();

}


/**
 * Get all Pages for options
 * @since 1.0.5
 */
function codeless_get_pages(){
    $pages = get_pages();

    if( empty( $pages ) )
        return array();

    $result = array();

    foreach( $pages as $page ){
        $result[ $page->ID ] = $page->post_title;
    }

    return $result;
}


/**
 * Calculate Masonry item size
 * @since 1.0.5
 */
function codeless_calculate_masonry_size($preset_alg){
    global $codeless_masonry_size;

    $preset = array( 'preset1' => array( 'large', 'small', 'small' ) );

    $order_index = (codeless_loop_counter() - 1) % 3 ;
    $codeless_masonry_size = $preset[$preset_alg][$order_index];

    return $codeless_masonry_size;
}


 /**
  * Core function for retrieve get option value from element
  *
  * @since 1.0.0
  */
  function codeless_get_from_element( $id, $default = '' ){
    global $cl_from_element;
    if( isset($cl_from_element[$id]) )
        return $cl_from_element[$id];
    else
        return $default;
}


 /**
  * Core function for retrieve get layout option value combined from all attributes
  *
  * @since 1.0.0
  */

function codeless_get_layout_option( $id, $default = '' ){
    $value = $site_defaults = codeless_get_mod( $id, $default );
    
    if( is_page() && codeless_get_mod( 'overwrite_page_layout', 'default' ) == 'custom' )
        $value = codeless_get_mod( $id.'_page', $value );   

    if( is_single() && get_post_type() == 'post' && codeless_get_mod( 'overwrite_post_layout', 'default' ) == 'custom' )
        $value = codeless_get_mod( $id.'_post', $value );


    if( ( is_page() || ( is_single() && get_post_type() == 'post') ) && codeless_get_meta( $id, 'default', get_the_ID() ) != 'default' ){
        $value = codeless_get_meta( $id, 'default', get_the_ID() );
    }
        
    if( is_archive() && codeless_get_mod( 'overwrite_archive_layout', 'default' ) == 'custom'  )
        $value = codeless_get_mod( $id.'_archive', 'default' );

    return $value;
}


 /**
  * Maintenance
  *
  * @since 1.0.0
  */
add_action( 'template_redirect', 'codeless_maintenance' );

function codeless_maintenance(){
    if( codeless_get_mod( 'maintenance_mode', true ) && codeless_get_mod( 'maintenance_page', '' ) != '' ){
        if( ! is_page( codeless_get_mod( 'maintenance_page' ) ) )
            wp_redirect( get_permalink( codeless_get_mod( 'maintenance_page' ) ), 301 );
    }
}

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'codeless_vc_as_theme' );
function codeless_vc_as_theme() {
  vc_set_as_theme();
}

/**
 * Disable Gutenberg for Pages when visual composer active
 */
/*if (version_compare($GLOBALS['wp_version'], '5.0-beta', '>'))
	add_filter('use_block_editor_for_post_type', 'codeless_disable_gutenberg_pages', 100, 2);
else
    add_filter('gutenberg_can_edit_post_type', 'codeless_disable_gutenberg_pages', 100, 2);
    
function codeless_disable_gutenberg_pages($is_enabled, $post_type) {
	
	if ($post_type === 'page' && function_exists('vc_set_as_theme') ) return false;
	
	return $is_enabled;
	
}*/




function codeless_post_galleries_data( $post, $options = array() ) {
	// Default data
	$data = array(
		'image_ids'		=> array(),
		'image_count'	=> 0,
		'galleries'		=> array(),
	);
	// Default values.
	$galleries_image_ids = array();
	$galleries_data = array();
	$get_attached_images = false;
	// Shortcode.
	// Gather IDs from all gallery shortcodes in content.
	// This is based on the core get_content_galleries() function but slimmed down to do only what is needed.
	if ( preg_match_all( '/' . get_shortcode_regex() . '/s', $post->post_content, $matches, PREG_SET_ORDER ) && ! empty( $matches ) ) {
		// Loop matching shortcodes
		foreach ( $matches as $shortcode ) {
			// Gallery shortcodes only
			if ( 'gallery' === $shortcode[2] ) {
				// Get shortcode attributes
				$gallery_data = shortcode_parse_atts( $shortcode[3] );
				$galleries_data[] = $galleries_data;
				// Has ID attributes, get 'em
				if ( ! empty( $gallery_data['ids'] ) ) {
					// Loop IDs from gallery shortcode
					$gallery_ids_raw = explode( ',', $gallery_data['ids'] );
					foreach ( $gallery_ids_raw as $gallery_id ) {
						// Remove whitespace and exclude empty values (ie. ", 12, ,42,")
						if ( $gallery_id = trim( $gallery_id ) ) {
							// Add to array containing imag IDs from all galleries in post
							$galleries_image_ids[] = $gallery_id;
						}
					}
				}
				// No ID attributes, in which case all attached images shown - get 'em
				else {
					$get_attached_images = true;
				}
			}
		}
	}
	// Gutenberg block.
	if ( preg_match( '/wp-block-gallery/', $post->post_content ) ) {
		// DOM.
		$dom = new domDocument;
		libxml_use_internal_errors( true ); // suppress errors caused by domDocument not recognizing HTML5.
		$dom->loadHTML( $post->post_content );
		libxml_clear_errors();
		// Get gallery blocks.
		$finder = new DomXPath( $dom );
		$gallery_blocks = $finder->query( "//*[contains(@class, 'wp-block-gallery')]" );
		// Loop gallery blocks.
		foreach ( $gallery_blocks as $gallery_block ) {
			$gallery_image_ids = array();
			// Get images.
   			$gallery_images = $gallery_block->getElementsByTagName( 'img' );
   			// Have gallery images.
   			if ( $gallery_images ) {
	   			// Loop images.
	   			foreach ( $gallery_images as $gallery_image ) {
	   				// Get ID attribute.
					$gallery_image_id = $gallery_image->getAttribute( 'data-id' );
					// Add ID to array.
					if ( $gallery_image_id ) {
						$gallery_image_ids[] = $gallery_image_id;
					}
				}
				// Have gallery image IDs.
				if ( $gallery_image_ids ) {
					$galleries_image_ids = array_merge( $galleries_image_ids, $gallery_image_ids );
				}
				// No ID attributes, in which case all attached images shown - get 'em
				else {
					$get_attached_images = true;
				}
			}
		}
	}
	// Get all attached images because at least one gallery had no IDs, which means to use all attached to the page.
	if ( $get_attached_images ) {
		// Get all attached images for this post
		$images = get_children( array(
			'post_parent' => $post->ID,
			'post_type' => 'attachment',
			'post_status' => 'inherit', // for attachments
			'post_mime_type' => 'image',
			'numberposts' => -1, // all
			'orderby' => 'menu_order', // want first manually ordered ('Add Media > Uploaded to this page' lets drag order)
			'order' => 'ASC'
		) ) ;
		// Found some?
		if ( ! empty( $images ) ) {
			// Add to array containing image IDs from all galleries in post
			$attached_image_ids = array_keys( $images );
			$galleries_image_ids = array_merge( $galleries_image_ids, $attached_image_ids );
		}
	}
	// Did we find some images?
	if ( $galleries_image_ids ) {
		// Remove duplicates
		$galleries_image_ids = array_unique( $galleries_image_ids );
		// Build array of data
		$data['image_ids'] = $galleries_image_ids;
		$data['image_count'] = count( $galleries_image_ids );
		$data['galleries'] = $galleries_data;
	}
	// Return filterable
	return $data;
}

function codeless_catch_content_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1][0];

    return $first_img;
  }


  function codeless_get_permalink(){
    if( is_home() )
        return get_home_url();
    else
        return get_permalink();
  }


function codeless_page_from_builder(){
    
    global $codeless_page_from_builder;
    
    if( ! isset( $codeless_page_from_builder ) || is_null( $codeless_page_from_builder ) ){
        
        $codeless_page_from_builder = false;
        $page = get_page( codeless_get_post_id() );
        
        if( is_object($page) ){
            $content = $page->post_content;
            preg_match_all('/\[vc_row(.*?)\]/', $content, $matches_vc );
            preg_match_all('/\[cl_page_header(.*?)\]/', $content, $matches_cl_page_header );
            preg_match_all('/\[cl_row(.*?)\]/', $content, $matches_cl_row );
            
            if ( isset($matches_vc[0]) && !empty($matches_vc[0]) )
                $codeless_page_from_builder = true;
            
            if ( isset($matches_cl_page_header[0]) && !empty($matches_cl_page_header[0]) ) 
                $codeless_page_from_builder = true;
            if ( isset($matches_cl_row[0]) && !empty($matches_cl_row[0]) )
                $codeless_page_from_builder = true;
        }else{
            $codeless_page_from_builder = false;
        }

    }
        
    return $codeless_page_from_builder;
}


function codeless_embed_url_lookup() {
    $reg = preg_match('|^\s*(https?://[^\s"]+)\s*$|im', get_the_content(), $matches);

    if (!$reg) return false;

    return trim($matches[0]);

} // end embed_url_looku


function codeless_get_embed_content(){
    $content = apply_filters( 'the_content', get_the_content() );
    $video = false;
                                
    // Only get video from the content if a playlist isn't present.
    if ( false === strpos( $content, 'wp-playlist-script' ) ) {
        $video = get_media_embedded_in_content( $content );
    }
                                    
    if( is_array( $video ) && isset( $video[0] ) ){
        if( strpos($video[0], 'src' ) !== false ){
            $video = str_replace('src', 'data-src', $video[0]);
        }
    
        return $video;
    }

    return '';
}


function codeless_extract_link($content){
    preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
    return $match[0][0];
}