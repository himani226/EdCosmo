<?php

$args = array(
    "title"             => "",
    'taxonomies'        => '',
    'count'             => '12',
    'featured'           => ''
);
extract(shortcode_atts($args, $atts));

$new_query = array( 
    'post_type' => 'post',
    'posts_per_page' => $count,
    'tax_query' => array(
        'relation' => 'AND',
        array(
			'taxonomy' => 'post_format',
			'field'    => 'slug',
			'terms'    => array( 'post-format-video' ),
		),
    )
); 

if( !empty( $featured ) )
    $new_query['post__not_in'] = array( $featured );

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

    $new_query['tax_query'][] = $tax_query;
}

if( !empty( $featured ) ){
    $featured_query = array(
        'post_type' => 'post',
        'p'         => $featured,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field'    => 'slug',
                'terms'    => array( 'post-format-video' ),
            ),
        )
    );
}


?>

<div class="cl-element cl-video-gallery">
    
    <?php if( !empty( $title ) ): ?>
        <div class="cl-element__title-wrapper">
            <h4 class="cl-element__title cl-custom-font"><?php echo esc_html( $title ); ?></h4>
        </div>
    <?php endif; ?>

    <div id="cl-video-gallery-scroll" class="cl-video-gallery__items">

        <div class="cl-video-gallery__featured">

            <?php
        
            $the_query = new WP_Query( $featured_query );
                                    
            // Display posts
            if ( $the_query->have_posts() ) :
                // Start loop
                while ( $the_query->have_posts() ) : $the_query->the_post();

                    codeless_loop_counter(++$i);
                                        
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="cl-video-featured">
                            <div class="cl-entry__media" style="background-image:url('<?php echo get_the_post_thumbnail_url(); ?>');">
                                
                                <div class="cl-entry__overlay"></div>
                                <a href="<?php echo codeless_extract_link( codeless_get_embed_content() ) . '&autoplay=1&rel=1&showinfo=0&modestbranding=1&vq=hd720' ?>" class="cl-video-play"></a>
                                <div class="cl-iframe-wrap"></div>
                            </div>
                            
                            <div class="cl-entry__content">
                                <header class="cl-entry__header">
                                    <?php the_title( '<h2 class="cl-entry__title cl-custom-font"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                        
                                    <div class="cl-entry__details">
                                        <?php get_template_part( 'template-parts/blog/parts/entry', 'meta' ); ?>
                                        <?php get_template_part( 'template-parts/blog/parts/entry', 'tools' ); ?>
                                    </div><!-- .cl-entry__details -->

                                </header><!-- .cl-entry__header -->
                            </div>
                        </div>
                    </article>
                    <?php
                // End loop
                endwhile;
                
            endif; ?>

            <?php wp_reset_postdata(); ?>

        </div><!-- .cl-video-gallery__featured -->

        <div class="cl-video-gallery__more cl-scrollable has-scrollbar">

            <div class="cl-scrollable__content">
            
                <?php
                
                $the_query = new WP_Query( $new_query );
                                        
                // Display posts
                if ( $the_query->have_posts() ) :
                    // Start loop
                    while ( $the_query->have_posts() ) : $the_query->the_post();

                        codeless_loop_counter(++$i);
                                            
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('cl-video-entry'); ?>>

                            <div class="cl-video-entry__wrapper">

                                <div class="cl-video-entry__image">
                                    <?php the_post_thumbnail( 'codeless_video_entry' ); ?>
                        
                                    <a href="<?php echo codeless_extract_link( codeless_get_embed_content() ) . '&autoplay=1&rel=1&showinfo=0&modestbranding=1&vq=hd720' ?>" class="cl-video-play"></a>
                                </div>

                                <div class="cl-video-entry__content">
                                    <a href="<?php echo esc_url(get_permalink()) ?>"><?php the_title() ?></a>
                                    <span class="cl-video-entry__min"><?php echo codeless_get_meta( 'video_min', '03:30', get_the_ID() ) ?></span>
                                </div>



                            </div>

                        </article>

                        <?php
                            
                    // End loop
                    endwhile;
                    
                endif; ?>
            </div><!-- .cl-scrollable__content -->

            <div class="cl-scrollable__pane">
                <div class="cl-scrollable__slider"></div>
            </div>

        </div><!-- .cl-video-gallery__more -->

    </div><!-- .cl-video-gallery__items -->

    <?php wp_reset_postdata(); ?>
</div><!-- .cl-video-gallery -->