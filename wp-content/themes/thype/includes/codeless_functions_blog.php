<?php


/**
 * Returns true if the current Query is standart blog post.
 *
 * @since 1.0.0
 */
function codeless_is_blog_query() {
    
	// False by default
	$blog_bool = false;

	// Return true for blog archives
	if ( is_search() ) {
		$blog_bool = false; // Fixes wp bug
	} elseif (
		is_home() 
		|| is_category()
		|| is_tag()
		|| is_date()
		|| is_author()
		|| is_page_template( 'template-blog.php' )
		|| ( is_tax( 'post_format' ) && 'post' == get_post_type() )
	) {
		$blog_bool = true;
	}

	return $blog_bool;

}


/**
 * Manage Classes of Blog Entries Div
 * @since 1.0.0
 */
function codeless_extra_classes_blog_entries( $classes ) {
    $classes[] = 'cl-blog';
    $classes[] = 'cl-blog--style-' . codeless_blog_style();
    $classes[] = 'cl-blog--module-' . codeless_get_mod( 'blog_module', 'isotope' );

    if( codeless_get_mod( 'blog_module', 'isotope' ) == 'grid-blocks' )
        $classes[] = 'cl-blog--'. codeless_get_mod( 'blog_grid_block', 'grid-1' );

    if( codeless_get_mod( 'blog_animation', 'none' ) != 'none' )
        $classes[] = 'cl-blog--animated';
    
    return $classes;
}

/**
 * Manage Attributes of Blog Entries
 * @since 1.0.0
 */
function codeless_extra_attr_blog_entries( $attr ) {

    return $attr;
}


/**
 * Manage Classes of Blog Entries List
 * @since 1.0.0
 */
function codeless_extra_classes_blog_entries_list( $classes ) {

    if( codeless_get_mod( 'blog_module', 'none' ) == 'carousel' ){
        $classes[] = 'owl-carousel';
        $classes[] = 'cl-carousel';
        $classes[] = 'owl-theme';
    }

    if( codeless_get_mod( 'blog_carousel_nav_position', 'left' ) == 'center' )
        $classes[] = 'cl-carousel--nav-centered';
        
    
    return $classes;
}


/**
 * Manage Attributes of Blog Entries List
 * @since 1.0.0
 */
function codeless_extra_attr_blog_entries_list( $attr ) {
    $attr[] = 'data-items="' . codeless_get_mod( 'blog_columns', '1' ) . '"';
    if( codeless_is_blog_isotope() ){
        $attr[] = 'data-isotope-type="' . codeless_get_mod( 'blog_isotope_type', 'masonry' ) . '"';
    }

    if( codeless_get_mod( 'blog_carousel_nav', 'no' ) == 'yes' )
        $attr[] = 'data-nav="1"';

    if( codeless_get_mod( 'blog_module', 'none' ) == 'carousel' ){ 
        $attr[] = 'data-slide-by="1"';
        $attr[] = 'data-responsive=\'{"0": {"items": 1}, "992": {"items": '.esc_attr( codeless_get_mod( 'blog_columns', '3' ) ).' } }\'';
    }

    $attr[] = 'data-transition-duration="' . codeless_get_mod( 'blog_transition_duration', '0.4' ) . '"';
    return $attr;
}


/**
 * Blog Entry 
 * Blog Style, Blog Boxed Layout, Blog Animation
 * @since 1.0.0 
 */
function codeless_extra_classes_entry( $classes ) {
    
    $blog_style = codeless_blog_style();
    $classes[] = 'cl-entry';

    // Add animation style class
    if( codeless_get_mod( 'blog_animation', 'none' ) != 'none' && ( codeless_get_from_element('blog_featured_posts_image', false) === false ) && ( codeless_get_from_element('blog_remove_animation', false) === false ) ) {
        $classes[] = 'cl-animate-on-visible';
        $classes[] = codeless_get_mod( 'blog_animation', 'none' );
    }
    
    // Check if isotope is active and add necessary class
    if( codeless_is_blog_isotope() )
        $classes[] = 'cl-isotope-item';
    
    // Add large-featured or wide or default class for items that should look larger than others to create the masonry
    if( codeless_is_blog_isotope() ) 
        $classes[] = 'cl-msn-size-' . codeless_get_meta( 'post_masonry_layout', 'small', get_the_ID() );

    if( codeless_get_meta('hide_post_entry_content', 'no', get_the_ID()) == 'yes' )
        $classes[] = 'cl-hide-post-content';
    
    return $classes;
}


/**
 * Blog Entry Attr
 * Blog Animation
 * @since 1.0.0
 */
function codeless_extra_attr_entry( $attr ) {
    if( codeless_get_mod( 'blog_animation', 'none' ) != 'none' )
        $attr[] = 'data-speed="300"';
    
    $default_delay = 300;
    
    if( codeless_loop_counter() != 0 && codeless_blog_style() == 'timeline' )
        $counter = ( codeless_loop_counter() % 2 == 0 ) ? 2 : 1;
    else
        $counter = 1;
    
    if( codeless_loop_counter() != 0 && ( codeless_is_blog_isotope() ) ) {
        
        $counter = codeless_loop_counter() % (int) codeless_get_mod( 'blog_columns', 4 );
        if( $counter == 0 )
            $counter = (int) codeless_get_mod( 'blog_columns', 4 );
        
        $default_delay = 100;
    }
    
    if( codeless_get_mod( 'blog_animation', 'none' ) != 'none' )
        $attr[] = 'data-delay="' . ( $default_delay * $counter ) . '"';
    
    return $attr;
}


/**
 * Manage all classes of Entry Content div
 * @since 1.0.0
 */
function codeless_extra_classes_entry_content( $classes ) {
    return $classes;
}


/**
 * Return true if is blog entry (not single post)
 * @since 1.0.0
 */
function codeless_is_blog_entry(){
    if( get_post_type( codeless_get_post_id() ) == 'page' && get_post_type( get_the_ID() ) == 'post' 
                                                          && codeless_is_blog_query() 
                                                          && in_the_loop() )
        return true;

    return false;
}


/**
 * Return true if is single post, restrict when post is in related posts of SINGLE POST
 * @since 1.0.0
 */
function codeless_is_single_post(){
    if( ! is_single() || codeless_get_from_element( 'blog_from_element', false ) )
        return false;
    return true;
}


/**
 * Check if blog is isotope (grid or masonry)
 * @since 1.0.0
 */
function codeless_is_blog_isotope(){
    if( codeless_get_mod( 'blog_module', 'isotope' ) == 'isotope' )
        return true;
    return false;
}


/**
 * Retun Blog Post Style
 * @since 1.0.0
 */
function codeless_get_post_style(){
    // From overall options
    $style = codeless_get_mod( 'blog_post_style', 'modern' );

    // Single Post Style (from meta)
    $post_style = codeless_get_meta( 'post_style', 'modern' );
    if( $post_style != 'default' )
        $style = $post_style;

    // if style is modern but not featured image is set, return a classic style
    if( $style == 'modern' && ! has_post_thumbnail() )
        $style == 'classic';

    return apply_filters( 'codeless_post_style', $style );
}


/**
 * Return the blog style from theme options
 * or filtered value from codeless_blog_style
 * 
 * @since 1.0.0
 */
function codeless_blog_style(){
    
    // Get value from theme options
    $blog_style = codeless_get_mod( 'blog_style', 'default' );
    
    // Returns a filtered value
    return apply_filters( 'codeless_blog_style', $blog_style );
    
}


/**
 * Used only for blog pagination
 * Use conditionals to get the style of pagination
 * 
 * @since 1.0.0
 */
function codeless_blog_pagination( $the_query = false, $id = '' ){
    
    echo '<div class="cl-blog-pagination" data-container-id="'.esc_attr( $id ).'">';
    
    $pagination_style = codeless_get_mod( 'blog_pagination_style', 'numbers' );

    if ( $pagination_style == 'infinite_scroll' ) {
        echo codeless_infinite_scroll( 'infinite_scroll', $the_query );
    } elseif ( $pagination_style == 'next_prev' ) {
        echo codeless_nextprev_pagination('', 4, $the_query);
    }elseif ( $pagination_style == 'next_prev_ajax' ) {
        echo codeless_nextprev_ajax_pagination('', 4, $the_query);
    } elseif ( $pagination_style == 'load_more' ){
        echo codeless_infinite_scroll( 'loadmore', $the_query );
    }else {
        codeless_number_pagination($the_query);
    }
    
    echo '</div>';
}


/**
 * Add twitterwidget on allowed media
 *
 * @since 1.0.0
 */
add_filter( 'media_embedded_in_content_allowed_types', 'codeless_media_embedded_in_content_allowed_types' );

function codeless_media_embedded_in_content_allowed_types($types){
    // used for twitter
    $types[] = 'blockquote';
    $types[] = 'script';
    return $types;
}


/**
 * Return the exact thumbnail size to use for blog post
 *
 * @since 1.0.0
 */
function codeless_get_post_thumbnail_size(){
    
    $blog = 'codeless_blog_entry';
    
    if( is_single() ){
        $blog = 'codeless_blog_post';
    }
    
    if( codeless_get_mod( 'blog_image_size', 'theme_default' ) != 'theme_default' )
        $blog = codeless_get_mod( 'blog_image_size', 'theme_default' );

    if( codeless_get_from_element( 'is_related', false ) )
        $blog = 'codeless_blog_related';
    
    return $blog;
}


/**
 * Generate Post Entry Meta
 * To use on blog templates.
 * 
 * @since 1.0.0
 */
function codeless_get_post_entry_meta(){
    
    $entry_meta = array();

    // Add Author (By)
    if( codeless_get_mod( 'blog_entry_meta_author', false ) ){
        $entry_meta_ = array();
        $entry_meta_['id'] = 'cl-entry__meta--author';
        $entry_meta_['prepend'] = esc_attr__( 'By', 'thype' );
        $entry_meta_['value'] = codeless_get_entry_meta_author();
        $entry_meta[] = $entry_meta_;
    }
    
    // Categories Listing
    if( codeless_get_mod( 'blog_entry_meta_categories', false ) ){
        $entry_meta_ = array();
        $entry_meta_['id'] = 'cl-entry__meta--category';
        $entry_meta_['prepend'] = esc_attr__( 'In', 'thype' );
        $entry_meta_['value'] = codeless_get_entry_meta_categories();
        $entry_meta[] = $entry_meta_;
    }
    
    // Date Posted
    if( codeless_get_mod( 'blog_entry_meta_date', true ) ){
        $entry_meta_ = array();
        $entry_meta_['id'] = 'cl-entry__meta--date';
        $entry_meta_['prepend'] = esc_attr__( '', 'thype' );

        $format = false;
        if( codeless_get_mod( 'blog_module', 'isotope' ) == 'grid-blocks' && codeless_get_mod( 'blog_grid_block' ) == 'grid-4'  )   
            $format = 'M j, Y';

        $entry_meta_['value'] = codeless_get_entry_meta_date($format);

        $entry_meta[] = $entry_meta_;
    }
    
    return apply_filters('codeless_post_entry_meta', $entry_meta);
}


/**
 * Generate Post Entry Meta Author
 * 
 * @since 1.0.0
 */
function codeless_get_entry_meta_author(){
    
    $author_name = get_the_author();
    
    // Sanitize to not show empty author on customize preview partial refresh
    if( empty( $author_name ) || is_customize_preview() )
        $author_name = esc_attr__( 'admin', 'thype' );
    
    // Get the author name; wrap it in a link.
	$author = sprintf(
		/* translators: %s: post author */
		__( '%s', 'thype' ),
		'<span class="author"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . $author_name . '</a></span>'
	);
	
	return $author;
}


/**
 * Generate Post Entry Meta Date
 * 
 * @since 1.0.0
 */
function codeless_get_entry_meta_date( $format = false ){
    
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    
    $date = get_the_date();
    
    if( $format !== false )
        $date = get_the_date( $format );
    
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		$date
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '%s', 'thype' ),
		'<span class="time"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>'
	);
	
}


/**
 * Generate Post Entry Meta Categories
 * 
 * @since 1.0.0
 */
function codeless_get_entry_meta_categories(){
    
    /* translators: used between list items, there is a space after the comma */
	$separate_meta = esc_attr__( ', ', 'thype' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );
	
	return sprintf(
		/* translators: %s: categories list */
		__( '%s', 'thype' ),
		'<span class="categories_list">'.$categories_list.'</span>'
	);
	
}


/**
 * Generate Post Entry Tools
 * To use on blog templates.
 * 
 * @since 1.0.0
 */
function codeless_get_post_entry_tools(){
    
    $entry_tools = array();
    
    // Add Comments Count
    if( codeless_get_mod( 'blog_entry_tools_comments_count', true ) ){
        $entry_tool_ = array();
        $entry_tool_['id'] = 'cl-entry__tool--comments';
        $entry_tool_['html'] = codeless_get_entry_tool_comments_count();
        $entry_tools[] = $entry_tool_;
    }

    // Add Likes
    if( codeless_get_mod( 'blog_entry_tools_likes', false ) ){
        $entry_tool_ = array();
        $entry_tool_['id'] = 'cl-entry__tool--likes';
        $entry_tool_['html'] = codeless_get_entry_tool_likes();
        $entry_tools[] = $entry_tool_;
    }

    // Add Share
    if( codeless_get_mod( 'blog_entry_tools_share', false ) ){
        $entry_tool_ = array();
        $entry_tool_['id'] = 'cl-entry__tool--share';
        $entry_tool_['html'] = codeless_get_entry_tool_share();
        $entry_tools[] = $entry_tool_;
    }
    
    return apply_filters( 'codeless_post_entry_tools', $entry_tools );
}



/**
 * Generate blog entry comments_count
 * 
 * @since 1.0.0
 */
function codeless_get_entry_tool_comments_count(){
    
    ob_start();
    comments_number('0', '1', '%');

    $output = '<a href="' . get_permalink() . '#comments" class="comments"><span class="cl-entry__tool-count">' . ob_get_contents() . '</span><i class="cl-icon-comment"></i></a>';
    ob_get_clean();
    return $output;
}


/**
 * Generate blog entry like button
 * 
 * @since 1.0.0
 */
function codeless_get_entry_tool_likes(){

    $output = '';

    if( class_exists('Codeless_Post_Like') )
        $output = Codeless_Post_Like::like();

    return $output;
}


/**
 * Generate single blog footer Content
 * 
 * @since 1.0.0
 */

function codeless_single_blog_footer(){

       

        /**
         * Load Related Blog Items if it's active
         */
        if( codeless_get_mod( 'single_blog_tags', true ) && codeless_single_blog_tags() != '' )
            get_template_part( 'template-parts/blog/parts/single', 'tags' );

        /**
         * Single Blog Author Box
         */
        if( codeless_get_mod( 'single_blog_author_box', false )  )
            get_template_part( 'template-parts/blog/parts/single', 'author' );

       /**
         * Load Related Blog Items if it's active
         */

        if( codeless_get_mod( 'single_blog_related', false ) )
            get_template_part( 'template-parts/blog/parts/single', 'related' );

}


/**
 * Generate single blog post tags list
 * 
 * @since 1.0.0
 */
function codeless_single_blog_tags(){
    $tags = get_the_tag_list( '', '' );
    return $tags;
}


/**
 * Options to pass at Swiper Initialization
 * Only for Slider Post
 * 
 * @since 1.0.0
 */
function codeless_get_post_slider_options(){
    $data = array(
        'effect' => codeless_get_mod( 'blog_slider_effect', 'scroll' ),
        'lazyLoading' => (bool) codeless_get_mod( 'blog_slider_lazyload', 0 ),
        'autoplay' => (codeless_get_mod( 'blog_slider_speed', '' ) == 0 ? '' : codeless_get_mod( 'blog_slider_speed', 0 ) ),
        'loop' => (bool) codeless_get_mod( 'blog_slider_loop', 0 )
    );

    
    if( codeless_get_mod( 'blog_slider_lazyload', false ) )
        $data['preloadImages'] = false;
        
    if( codeless_get_mod( 'blog_slider_pagination', true ) ){
        $data['pagination'] = '.swiper-pagination';
        $data['paginationClickable'] = true;
    } 
    
    if( codeless_get_mod( 'blog_slider_nav', true ) ){
        $data['nextButton'] = '.swiper-button-next';
        $data['prevButton'] = '.swiper-button-prev';
    }
    
    return apply_filters( 'codeless_post_slider_options', $data );
}


function codeless_entry_overlay_icon( $custom = '' ){
    $icon = codeless_get_mod( 'blog_entry_overlay_icon', 'arrow-right' );
    if( $custom != '' )
        $icon = $custom;

    return 'cl-icon-' . apply_filters( 'codeless_entry_overlay_icon', $icon );
}

/**
 * Generate Overlay for blog entries
 * 
 * @since 1.0.0
 */
function codeless_blog_overlay(){
    ?>
    <div class="cl-entry__overlay"></div><!-- Entry Overlay -->
    <a href="<?php the_permalink() ?>" class="cl-entry__overlay-link"></a>
    <?php
}


/**
 * Add wrapper for creating Grid for News Blog
 * @since 1.0.0
 */
function codeless_news_grid_item_wrapper(){
    if( codeless_get_mod( 'blog_news' ) == 'grid_1' ){

        if( codeless_loop_counter() == 1 )
            echo '<div class="first-wrap flex-wrap full-height large-text parent-wrap">';

        if( codeless_loop_counter() == 2 )
            echo '<div class="second-wrap flex-wrap semi-height full-width-img parent-wrap">';

        if( codeless_loop_counter() == 3 )
            echo '<div class="inner-wrap flex-wrap full-height-img semi-wrap">';

    } else if( codeless_get_mod( 'blog_news' ) == 'grid_2' ){

        if( codeless_loop_counter() == 1 )
            echo '<div class="first-wrap flex-wrap full-height large-text parent-wrap">';

        if( codeless_loop_counter() == 2 )
            echo '<div class="second-wrap flex-wrap semi-height semi-width full-height-img parent-wrap">';


    } else if( codeless_get_mod( 'blog_news' ) == 'grid_3' ){

        if( codeless_loop_counter() == 1 )
            echo '<div class="first-wrap flex-wrap full-height large-text parent-wrap">';

        if( codeless_loop_counter() == 2 )
            echo '<div class="second-wrap flex-wrap onethird-height full-width-img parent-wrap">';


    }
    
}

/**
 * Close wrapper for creating Grid for News Blog
 * @since 1.0.0
 */
function codeless_news_grid_item_wrapper_close(){
    if( codeless_get_mod( 'blog_news' ) == 'grid_1' ){

        if( codeless_loop_counter() == 4 )
            echo '</div><!-- .inner-wrap -->';
        if( codeless_loop_counter() == 1 || codeless_loop_counter() == 4 )
            echo '</div><!-- .parent-wrap -->';

    } else if( codeless_get_mod( 'blog_news' ) == 'grid_2' ){

        if( codeless_loop_counter() == 1 || codeless_loop_counter() == 5 )
            echo '</div><!-- .parent-wrap -->';

    } else if( codeless_get_mod( 'blog_news' ) == 'grid_3' ){

        if( codeless_loop_counter() == 1 || codeless_loop_counter() == 4 )
            echo '</div><!-- .parent-wrap -->';

    }
    
}


/**
 * Modify Blog News excerpt length
 * @since 1.0.0
 */
function codeless_blog_news_excerpt_length(){
    return 20;
}


/**
 * Get related posts of post
 * @since 1.0.0
 */
function codeless_get_related_posts( $post_id, $related_count, $args = array() ) {
	$terms = get_the_terms( $post_id, 'category' );
	
	if ( empty( $terms ) ) $terms = array();
	
	$term_list = wp_list_pluck( $terms, 'slug' );
	
	$related_args = array(
		'post_type' => 'post',
		'posts_per_page' => $related_count,
		'post_status' => 'publish',
		'post__not_in' => array( $post_id ),
		'orderby' => 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $term_list
			)
		)
	);

	return new WP_Query( $related_args );
}



/**
 * Add Blog Post Modern Style Page Header
 * @since 1.0.0
 */
function codeless_add_post_header(){
    if( is_single() && get_post_type() == 'post' )
        get_template_part( 'template-parts/blog/post-header' );
}


/**
 * Codeless modify password form.
 * @since 1.0.0
 */
function codeless_password_form( $post ){
    $post = get_post( $post );
    $label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
    $output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
    <p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'thype' ) . '</p>
    <p><label for="' . $label . '">' . esc_html__( 'Password:', 'thype' ) . ' <input name="post_password" id="' . $label . '" type="password" size="20" /></label> <input type="submit" name="'.esc_attr__('Submit', 'thype').'" class="'.codeless_button_classes().'" value="' . esc_attr_x( 'Enter', 'post password form', 'thype' ) . '" /></p></form>
    ';
  
    return $output;
}

add_filter( 'the_password_form', 'codeless_password_form' );

?>