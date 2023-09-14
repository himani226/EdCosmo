<?php


/**
 * Get portfolio page layout that you have selected on Page Meta
 *
 * @since 1.0.0
 */
function codeless_portfolio_layout(){
    return apply_filters( 'codeless_portfolio_layout', codeless_get_from_element( 'portfolio_layout', 'grid' ), codeless_get_post_id() );
}


/**
 * Get portfolio page style that you have selected on Page Meta
 *
 * @since 1.0.0
 */
function codeless_portfolio_style(){
    return apply_filters( 'codeless_portfolio_style', codeless_get_from_element( 'portfolio_style', 'only_media' ), codeless_get_post_id() );
}


/**
 * Get single portfolio item format
 * Thumbnail, Video or Slider
 *
 * @since 1.0.0
 */
function codeless_portfolio_item_format(){
    return apply_filters( 'codeless_portfolio_item_format', codeless_get_meta( 'portfolio_item_format', 'thumbnail' ), get_the_ID() );
}


/**
 * Return the exact thumbnail size to use for portfolio
 *
 * @since 1.0.0
 */
function codeless_get_portfolio_thumbnail_size(){
    global $codeless_masonry_size;

    $portfolio = codeless_get_mod( 'portfolio_image_size', 'portfolio_entry' );

    if( codeless_get_mod( 'portfolio_layout', 'grid' ) == 'masonry' ){

        if( isset( $codeless_masonry_size ) && !empty( $codeless_masonry_size ) )
            $portfolio = 'masonry_' . $codeless_masonry_size;
        else{

            $meta = codeless_get_meta( 'portfolio_masonry_layout', 'default', get_the_ID() );
          
            if( $meta != 'default' && !empty( $meta ) )
                $portfolio = 'masonry_' . $meta;

            if( $meta == 'default' )
                $portfolio = 'masonry_small';
        }

    }

    $codeless_masonry_size = '';

    return $portfolio;
} 


/**
 * Used only for portfolio pagination
 * Use conditionals to get the style of pagination
 * 
 * @since 1.0.0
 */
function codeless_portfolio_pagination( $query = false ){
    
    if( !$query ){
        global $wp_query;
        $query = $wp_query;
    }
    

    $pages = $query->max_num_pages;
    if ( ! $pages) {
        $pages = 1;
    }

    if ( 1 == $pages )
        return false;

    echo '<div class="cl-portfolio-pagination" data-container-id="portfolio-entries">';
    
    $pagination_style = codeless_get_from_element( 'portfolio_pagination_style', 'numbers' );

    if ( $pagination_style == 'infinite_scroll' ) {
        echo codeless_infinite_scroll('', $query);
    } elseif ( $pagination_style == 'next_prev' ) {
        echo codeless_nextprev_pagination('', 4, $query);
    } elseif ( $pagination_style == 'load_more' ){
        echo codeless_infinite_scroll('loadmore', $query);
    }else {
        codeless_number_pagination( $query );
    }
    
    echo '</div>';
}


/**
 * Check if a custom link is set for portfolio item
 * return permalink if not
 * 
 * @since 1.0.0
 * @version 1.0.5
 */
function codeless_portfolio_item_permalink(){

    $custom_link = codeless_get_meta( 'portfolio_custom_link', false, get_the_ID() );
    
    if( $custom_link !== false && ! empty( $custom_link ) )
        return $custom_link;
    else
        return get_permalink();
}


/**
 * Portfolio Link Target
 * return permalink if not
 * 
 * @since 1.0.0
 */
function codeless_portfolio_item_permalink_target(){
    return codeless_get_mod( 'portfolio_custom_link_target', '_self' );
}


/**
 * Generate Overlay Icon for portfolio
 * 
 * @since 1.0.0
 */
function codeless_portfolio_overlay_icon( $custom = '' ){
    return 'cl-icon-' . apply_filters( 'codeless_portfolio_overlay_icon', $custom );
}


/**
 * Generate Overlay for portfolio entries
 * 
 * @since 1.0.0
 */
function codeless_portfolio_overlay(){
    $portfolio_overlay = codeless_get_from_element('portfolio_overlay', 'color');
    $portfolio_overlay_distance = codeless_get_from_element('portfolio_overlay_distance', '0');
    $portfolio_overlay_title_style = codeless_get_from_element('portfolio_overlay_title_style', 'h5');
    $portfolio_overlay_title_style .= ' custom_font';

    $portfolio_overlay_icon = codeless_get_from_element('portfolio_overlay_icon', 'plus2');
    $portfolio_overlay_icon_bool = codeless_get_from_element('portfolio_overlay_icon_bool', false);
    $portfolio_overlay_title_bool = codeless_get_from_element('portfolio_overlay_title_bool', true);
    $portfolio_overlay_categories_bool = codeless_get_from_element('portfolio_overlay_categories_bool', true);

    $portfolio_overlay_color = apply_filters( 'codeless_portfolio_overlay_color', codeless_get_from_element('portfolio_overlay_color'), get_the_ID() );

    $portfolio_overlay_content_color = codeless_get_from_element('portfolio_overlay_content_color');
    $portfolio_overlay_gradient = 'cl-gradient-' . codeless_get_mod('portfolio_overlay_gradient', 'none');
    $delay = 200;

    ?>

    <div class="entry-overlay <?php echo esc_attr($portfolio_overlay_content_color) ?> entry-overlay-<?php echo esc_attr($portfolio_overlay) ?>" style="padding:<?php echo esc_attr($portfolio_overlay_distance) ?>px;">

    <?php if( $portfolio_overlay != 'none' ): ?>

        <div class="overlay-wrapper <?php echo esc_attr( $portfolio_overlay_gradient ) ?>" style=" background-color:<?php echo esc_attr($portfolio_overlay_color) ?>;">
            <div class="inner-wrapper">
                <?php if( $portfolio_overlay_icon_bool ){
                    ?>
                    <div class="icons-wrapper">
                        <?php

                        if( $portfolio_overlay_icon != 'lightbox_link' )
                            codeless_portfolio_overlay_icon_link( $portfolio_overlay_icon );
                        else{
                            codeless_portfolio_overlay_icon_link( 'lightbox', 200 );
                            codeless_portfolio_overlay_icon_link( 'link', 300 );
                        }
                            
                        ?>
                    </div><!-- .icons-wrapper -->
                <?php }

                if( $portfolio_overlay_title_bool || $portfolio_overlay_categories_bool ){
                    ?>
                    <div class="content-wrapper">
                        
                        <?php if( $portfolio_overlay_title_bool ){ ?>

                            <h3 class="<?php echo esc_attr($portfolio_overlay_title_style) ?> with_anim cl-portfolio-title" data-delay="<?php echo esc_attr($delay) ?>"><?php echo get_the_title() ?></h3>

                        <?php }

                        if( $portfolio_overlay_categories_bool ){ ?>

                            <span  data-delay="<?php echo ( (int) esc_attr( $delay ) + 100 ) ?>" class="categories with_anim"><?php echo get_the_term_list( get_the_ID(), 'portfolio_entries', '', ', ', '' ) ?></span>

                        <?php } ?>

                    </div><!-- .content-wrapper -->
                <?php } ?>
            </div><!-- .inner-wrapper -->

        </div><!-- overlay-wrapper -->

  
    <?php endif; ?>

    <?php if( $portfolio_overlay_icon != 'lightbox_link' ): ?>
        <?php  
            $classes = $caption = '';
            $link = codeless_portfolio_item_permalink();

            if( $portfolio_overlay_icon == 'lightbox' ){
                $classes = 'lightbox';
                $caption = 'data-caption="'.get_the_post_thumbnail_caption().'"';
                $link = get_the_post_thumbnail_url();

                $video_link = codeless_get_meta( 'portfolio_video_link', '', get_the_ID() );
      
                if( isset( $video_link ) && !empty( $video_link ) )
                    $link = $video_link;
            }
            
            $target = '';
            if( $portfolio_overlay_icon != 'lightbox' )
                $target = 'target="'.codeless_portfolio_item_permalink_target().'"';

        ?>



        <a class="entry-link <?php echo esc_attr( $classes ) ?>" <?php echo codeless_complex_esc( $target ) ?> <?php echo codeless_complex_esc( $caption ) ?> href="<?php echo esc_url($link) ?>" title="<?php esc_attr( the_title_attribute() ) ?>"></a>
    <?php endif; ?>
    </div><!-- Entry Overlay -->

    <?php
}


/**
 * Generate Overlay Icon Link, add lightbox if neccessary
 * 
 * @since 1.0.0
 */
function codeless_portfolio_overlay_icon_link( $icon, $delay = '400' ){
    $link = $classes = $icon_cl = $target = '';
    $icon_cl = $icon;
    if( $icon == 'lightbox' ){
        $link = get_the_post_thumbnail_url();
        $classes = 'lightbox';
        $icon_cl = 'search';
        $video_link = codeless_get_meta( 'portfolio_video_link', '', get_the_ID() );

        if( isset( $video_link ) && !empty( $video_link ) )
            $link = $video_link;

    }
    
    if( $icon == 'link' ){
        $link = codeless_portfolio_item_permalink();
        $icon_cl = 'link3';
    }

    if( $icon != 'lightbox' )
        $target = 'target="'.codeless_portfolio_item_permalink_target().'"';


    if( $icon == 'lightbox' || $icon == 'link' ): ?>
        <a href="<?php echo esc_url( $link ) ?>" <?php echo codeless_complex_esc( $target ) ?> class="<?php echo esc_attr( $classes ) ?> with_anim" data-delay="<?php echo esc_attr( $delay ) ?>"> 
    <?php endif; ?>

            <i class="<?php echo esc_attr( codeless_portfolio_overlay_icon( $icon_cl ) ) ?> with_anim"></i>

    <?php if( $icon == 'lightbox' || $icon == 'link' ): ?>
        </a>
    <?php endif;
}


/**
 * Generate Single Portfolio Navigations
 * 
 * @since 1.0.6
 */
function codeless_single_portfolio_navigation(){
    if( ! is_singular( 'portfolio' ) )
        return;

    if( codeless_get_mod('single_portfolio_navigation', false) == '1' && ( is_object( get_previous_post() ) || is_object( get_next_post() ) ) ): ?>
            <div class="portfolio_navigation"> 

                        <?php if( is_object( get_previous_post() ) ): ?>

                            <a class="cl-icon-arrow-left portfolio_single_left" href="<?php echo get_permalink(get_previous_post()->ID); ?>">
                                
                                <span><?php esc_attr_e('Prev', 'thype' ) ?></span>

                            </a> 
                            

                        <?php endif; ?>    

                        <?php if( is_object( get_next_post() ) ): ?>

                            <a class="cl-icon-arrow-right portfolio_single_right" href="<?php echo get_permalink(get_next_post()->ID); ?>">
                                
                                 <span><?php esc_attr_e('Next', 'thype' ) ?></span>

                            </a> 
                           

                        <?php endif; ?>   

            </div><!-- .portfolio_navigation -->    
    <?php endif;
}

?>