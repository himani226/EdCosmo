<?php

$new_query = array( 
    'post_type' => 'portfolio',
    'posts_per_page' => -1
);

?>

<div class="cl-element cl-portfolio">

    <div class="cl-filter cl-filter--isotope">
    <?php

        
        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC',
            'taxonomy' => 'portfolio_entries' 
        ) );

    ?>
        <div class="cl-filter__inner">

            <a data-filter="*" href="<?php echo esc_url( codeless_get_permalink() ) ?>" class="active"><?php esc_html_e( 'All', 'thype' ) ?></a>
            

            <?php foreach( $categories as $category ): ?>
            
                <a href="<?php echo esc_url( add_query_arg( 'cl_cat', $category->cat_ID, codeless_get_permalink() ) ) ?>" data-filter=".portfolio_entries-<?php echo esc_attr( $category->slug ) ?>"><?php echo esc_attr( $category->name ) ?></a>
          
            <?php endforeach; ?>

        </div><!-- .cl-filter__inner -->
    </div>

    <div class="cl-portfolio__items">

        <?php


        $the_query = new WP_Query( $new_query );
                                        
                // Display posts
                if ( $the_query->have_posts() ) :
                    // Start loop
                    while ( $the_query->have_posts() ) : $the_query->the_post();

                    $count = 1;
        ?>

                    <div <?php post_class('cl-portfolio-item cl-animate-on-visible bottom-t-top cl-isotope-item cl-msn-size-small') ?> data-delay="<?php echo (string) (100*$count) ?>" data-speed="300" data-isotope-type="masonry">
                    <a target="_blank" href="<?php echo esc_attr( codeless_get_meta( 'portfolio_custom_link', '#', get_the_ID() ) ) ?>" class="link"><?php the_post_thumbnail() ?>
                        <span><?php echo get_the_title() ?></span>
                    </a>
                    </div>

                    <?php $count++; endwhile; ?>
                <?php endif; ?>
    </div>
</div>