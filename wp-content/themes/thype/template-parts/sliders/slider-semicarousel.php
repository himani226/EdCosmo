<?php
/**
 * Slider Semi Carousel
 *
 * @package Thype
 * @since 1.0.0
 *
 */

 global $cl_slider_data, $cl_from_element;

 $the_query = $cl_slider_data['the_query'];
 $slider_id = $cl_slider_data['slider_id'];
$container = codeless_get_meta( 'slider_container', 'no', $slider_id );

if( codeless_get_meta( 'simple_slider_image', 'no', $slider_id ) == 'yes' )
    $cl_from_element['blog_featured_posts_image'] = true;

$cl_from_element['blog_remove_animation'] = true;

$bg_color = codeless_get_meta( 'slider_bg_color', '#ffffff', $slider_id );
$padding_top = codeless_get_meta( 'slider_padding_top', '0px', $slider_id );
$padding_bottom = codeless_get_meta( 'slider_padding_bottom', '0px', $slider_id );

$slider_style = ' background-color:'. $bg_color . '; padding-top:'.$padding_top . '; padding-bottom:'.$padding_bottom.';';

?>

<div class="cl-blog cl-blog--style-big cl-blog--module-carousel cl-slider cl-slider--semicarousel" style="<?php echo esc_attr( $slider_style ) ?>">
    <div class="cl-blog__list cl-items-container cl-carousel owl-carousel owl-theme"  data-margin="15" data-auto-height="false" data-dots="0" data-nav="1" data-items="1" data-center="true" data-loop="true" <?php echo (($container == 'fullwidth') ? 'data-responsive=\'{"0": {"stagePadding":0}, "992": { "stagePadding":300 } }\'' : ''); ?>>
        <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();

            
            $style = 'background-image:url(\' ' . get_the_post_thumbnail_url() . '\' );';

            ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( codeless_extra_classes( 'entry' ) ); ?> <?php echo codeless_extra_attr( 'entry' ) ?> style="<?php echo esc_attr( $style ) ?>">
                    
                <div class="cl-entry__overlay"></div>
                <div class="cl-entry__wrapper">
                
                
                    <div class="cl-entry__wrapper-content box-<?php echo esc_attr( codeless_get_meta( 'semi_carousel_box_color', 'white', $slider_id ) ) ?> cl-animate-on-visible bottom-t-top" data-delay="200" data-speed="400">
                    
                        <?php
            
                            /**
                             * Entry Header
                             * Output Entry Meta and title
                             */ 
                        ?>
                        
                        <header class="cl-entry__header">
                            
                            <?php if( codeless_get_mod( 'blog_entry_meta_author_category', true ) ): ?>
                            <div class="cl-entry__author">
                                <?php 
                                $avatar = get_avatar( get_the_author_meta('user_email') , 30 ) ;
            
                                if($avatar !== FALSE)
                                    echo codeless_complex_esc($avatar);
                                ?>
                                <div class="cl-entry__author-data">
                                    <div class="cl-entry__categories"><?php echo get_the_category_list( ' ' ) ?></div>
                                    <?php echo esc_attr__( 'by', 'thype' ) . ' ' . get_the_author() ?>
                                </div>
                            </div>
                            <?php endif; ?>
                                
                            <?php the_title( '<h2 class="cl-entry__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                            
                            <div class="cl-entry__details">
                                <?php get_template_part( 'template-parts/blog/parts/entry', 'meta' ); ?>
                                <?php get_template_part( 'template-parts/blog/parts/entry', 'tools' ); ?>
                            </div><!-- .cl-entry__details -->

                        </header><!-- .cl-entry__header -->

                    <?php
                    /**
                     * Close Entry Wrapper
                     */ 
                    ?>
                    
                    </div><!-- .cl-entry__wrapper-content -->
                    
                </div><!-- .cl-entry__wrapper -->
            
            </article><!-- #post-## -->

                
            <?php endwhile;
        ?>
    </div>
</div>

<?php

$cl_from_element['blog_featured_posts_image'] = false;
$cl_from_element['blog_remove_animation'] = false;
?>