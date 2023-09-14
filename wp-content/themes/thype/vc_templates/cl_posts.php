<?php

$args = array(
    "title"             => "",
    "unique_id"         => 'id' . str_replace( ".", '-', uniqid("", true) ),
    'module'            => 'isotope',
    'isotope_type'      => 'masonry',
    'grid_block_type'  => '',
    'columns'           => '3',
    'carousel_nav'      => 'no',
    'style'             => 'default',
    'animation'         => 'none',
    'pagination'        => 'none',
    'filters'           => 'disabled',
    'image_size'        => 'theme_default',
    'image_filter'      => 'normal',
    'excerpt_length'    => 62,
    

    'taxonomies'        => '',
    'count'             => '12',
    'order_by'          => 'date',
    'order'             => 'DESC',
    'include'           => '',
    'exclude'           => '',

    'custom_width'      => '',
    'custom_heading_size' => '',
    'custom_wrapper_padding' => '',
    'custom_wrapper_color' => '',
    'custom_grid_gap'      => '',
    'post_text_color' => 'dark',
    'title_design' => 'only_text',
    'carousel_nav_position' => 'left'
);

extract(shortcode_atts($args, $atts));

/* Force fixes for blocks */
if( $module == 'grid-blocks' ){
    if( in_array( $grid_block_type, array( 'grid-1', 'grid-2', 'grid-3', 'grid-8', 'grid-9', 'grid-10' ) ) )
        $style = 'media';

    if( in_array( $grid_block_type, array( 'grid-6' ) ) && $style != 'default' )
        $style = 'default';
    
    if( in_array( $grid_block_type, array( 'grid-4', 'grid-5', 'grid-7' ) ) && $style != 'media' && $style != 'simple-no_content' )
        $style = 'simple-no_content';
}


// Set global params
global $cl_from_element;
$cl_from_element['blog_style'] = $style;
$cl_from_element['blog_module'] = $module;
$cl_from_element['blog_grid_block'] = $grid_block_type;
$cl_from_element['blog_isotope_type'] = $isotope_type;
$cl_from_element['blog_columns'] = $columns;
$cl_from_element['blog_carousel_nav'] = $carousel_nav;
$cl_from_element['blog_animation'] = $animation;
$cl_from_element['blog_pagination_style'] = $pagination;
$cl_from_element['blog_filters'] = $filters;
$cl_from_element['blog_image_size'] = $image_size;
$cl_from_element['blog_image_filter'] = $image_filter;
$cl_from_element['blog_excerpt_length'] = (int) $excerpt_length;
$cl_from_element['blog_taxonomies'] = $taxonomies;
$cl_from_element['blog_carousel_nav_position'] = $carousel_nav_position;

$extra_classes = $custom_css = '';

$new_query = array( 
    'post_type' => 'post',
    'orderby'   => $order_by, 
    'order'     => $order,
    'posts_per_page' => $count,
    
); 

if( !empty( $include ) ){
    $new_query['ignore_sticky_posts'] = 1;
    $new_query['post__in'] = explode(',', $include);
    $new_query['ignore_custom_sort'] = true;
}
    

if( !empty( $exclude ) )
    $new_query['post__not_in'] = explode(',', $exclude);

if( !empty( $taxonomies ) ){
    $vc_taxonomies_types = get_taxonomies( array( 'public' => true ) );
    $terms = get_terms( array_keys( $vc_taxonomies_types ), array(
            'hide_empty' => false,
            'include' => $atts['taxonomies'],
        ) );
    $tax_query = array();

    $tax_queries = array(); // List of taxnonimes
    foreach ( $terms as $t ) {
        if ( ! isset( $tax_queries[ $t->taxonomy ] ) ) {
            $tax_queries[ $t->taxonomy ] = array(
                'taxonomy' => $t->taxonomy,
                'field' => 'id',
                'terms' => array( $t->term_id ),
                'relation' => 'IN',
            );
        } else {
            $tax_queries[ $t->taxonomy ]['terms'][] = $t->term_id;
        }
    }

    $tax_query = array_values( $tax_queries );
    $tax_query['relation'] = 'OR';

    $new_query['tax_query'] = $tax_query;
}

$paged_attr = 'paged';

if( is_front_page() )
	$paged_attr = 'page';

if( get_query_var( $paged_attr ) )
	$new_query['paged'] = get_query_var( $paged_attr );
else
    $new_query['paged'] = 1;

global $paged;
$paged = $new_query['paged'];

if( isset( $_GET['cl_cat'] ) && !empty( $_GET['cl_cat'] ) ){
    $new_query['cat'] = (int) esc_attr( $_GET['cl_cat'] );

    if( isset( $new_query['tax_query'] ) )
        unset( $new_query['tax_query'] );
}


if( !empty( $custom_width ) ){
    $custom_css .= '#'.$unique_id.'{ width:' . $custom_width .'; }';
    $extra_classes .= 'cl-blog--custom-width';
}

if( $post_text_color == 'light' )
    $extra_classes .= ' cl-blog--light-text ';

if( !empty( $custom_heading_size ) ){
    $custom_css .= '@media (min-width:992px){ #'.$unique_id.' h2.cl-entry__title{ font-size:'.$custom_heading_size.'; } }';
}

if( !empty( $custom_wrapper_padding ) ){
    $custom_css .= ' @media (min-width:992px){ #'.$unique_id.' .cl-entry__wrapper{ padding:'.$custom_wrapper_padding.'; } }';
}

if( !empty( $custom_wrapper_color ) ){
    $custom_css .= ' #'.$unique_id.' article.format-standard .cl-entry__wrapper{ background-color: '.$custom_wrapper_color.' } ';
}

if( !empty( $custom_grid_gap ) ){
    if( $module == 'grid-blocks' )
        $custom_css .= ' @media (min-width:768px){ #'.$unique_id.' .cl-blog__list{ grid-gap:'.$custom_grid_gap.'; } } ';
    else if( $module == 'isotope' )
        $custom_css .= ' #'.$unique_id.' .cl-blog__list{ margin-left:-'.$custom_grid_gap.';margin-right:-'.$custom_grid_gap.'; }  #'.$unique_id.' .cl-entry{ padding: '.$custom_grid_gap.'; }';
}

if( $image_filter != 'normal' )
wp_enqueue_style('codeless-image-filters', get_template_directory_uri() . '/css/codeless-image-filters.css');


?>
<div id="<?php echo esc_attr( $unique_id ) ?>" class="cl-element <?php echo esc_attr( codeless_extra_classes( 'blog_entries' ) ) ?> <?php echo esc_attr( $extra_classes ) ?>" <?php echo codeless_extra_attr( 'blog_entries' ) ?> style="<?php echo esc_attr( $custom_width ) ?>">
    
    <?php if( !empty( $title ) ): ?>
        <div class="cl-element__title-wrapper <?php echo esc_attr( $title_design ); ?>">
            <h4 class="cl-element__title cl-custom-font"><?php echo esc_html( $title ); ?></h4>
            <?php 
                if( $filters != 'disabled' && ( is_page() || is_home() ) )
                    get_template_part( 'template-parts/blog/parts/filters' );
            ?>
        </div>
    <?php endif; ?>

    <?php if( $filters != 'disabled' && ( is_page() || is_home() ) && empty( $title ) ): ?>
        <div class="cl-filter-centered">
            <?php get_template_part( 'template-parts/blog/parts/filters' ); ?>
        </div>
    <?php endif; ?>

    <div class="cl-blog__list cl-items-container <?php echo esc_attr( codeless_extra_classes( 'blog_entries_list' ) ) ?>" <?php echo codeless_extra_attr( 'blog_entries_list' ) ?>>

        <?php
        
        $the_query = new WP_Query( $new_query );
                                
        // Display posts
        if ( $the_query->have_posts() ) :
            // Start loop
            $i = 0;
            while ( $the_query->have_posts() ) : $the_query->the_post();

                codeless_loop_counter(++$i);
                                    
                /*
                * Get Blog Template Style
                * Codeless_blog_style returns the style selected
                * from Theme Options or a custom filter
                */
                
                get_template_part( 'template-parts/blog/style', $style  );
                    
            // End loop
            endwhile;
            
            
        else : ?>
        
            <article class="content-none"><?php esc_html_e( 'No Posts found.', 'thype' ); ?></article>

        <?php endif; ?>                         
        
    </div><!-- .cl-posts__list -->

    <?php if( $pagination != 'none' ) codeless_blog_pagination($the_query, $unique_id ); ?>
    <?php wp_reset_postdata(); ?>

    <?php if( !empty($custom_css) ): ?>
        <style type="text/css"><?php echo codeless_complex_esc( $custom_css ) ?></style>
    <?php endif; ?>
</div><!-- .cl-posts -->

