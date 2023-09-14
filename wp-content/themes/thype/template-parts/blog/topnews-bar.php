<?php
/**
 * Top News Bar
 *
 * @package Thype
 * @since 1.0.0
 *
 */

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'meta_key'     => 'top_news',
	'meta_value'   => 'yes',
	'meta_compare' => '=='
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :


?>

<div class="cl-blog cl-blog--style-top-news cl-blog--module-carousel">
    <div class="cl-blog__list cl-items-container cl-carousel owl-carousel owl-theme" data-nav="1" data-items="1" data-autoplay="1" data-autoplay-timeout="5000" data-loop="1">
        <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();

                ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class( codeless_extra_classes( 'entry' ) ); ?> <?php echo codeless_extra_attr( 'entry' ) ?> style="<?php echo esc_attr( $style ) ?>">
		
                    <div class="cl-entry__wrapper">
                    
                    
                        <div class="cl-entry__wrapper-content">
                        
                            <?php

                                /**
                                 * Entry Header
                                 * Output Entry Meta and title
                                 */ 
                            ?>
                            
                            <header class="cl-entry__header">

                                
                                <div class="cl-entry__categories"><?php echo get_the_category_list( ' ' ) ?></div>
                                <div class="cl-entry__date"><?php echo get_the_date() ?></div>
                                    
                                <?php the_title( '<h4 class="cl-entry__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' ); ?>
                                
                            </header><!-- .cl-entry__header -->

                        <?php
                        /**
                         * Close Entry Wrapper
                         */ 
                        ?>
                        
                        </div><!-- .cl-entry__wrapper-content -->
                        
                    </div><!-- .cl-entry__wrapper -->

                </article><!-- #post-## -->


                <?php
                
            endwhile;
        ?>
    </div>
</div>

<?php endif; 

wp_reset_query();
?>