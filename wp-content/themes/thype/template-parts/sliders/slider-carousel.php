<?php
/**
 * Slider Carousel
 *
 * @package Thype
 * @since 1.0.0
 *
 */

 global $cl_slider_data, $cl_from_element;

$the_query = $cl_slider_data['the_query'];
$slider_id = $cl_slider_data['slider_id'];
$container = codeless_get_meta( 'slider_container', 'no', $slider_id );

$cl_from_element['blog_remove_animation'] = true;

$bg_color = codeless_get_meta( 'slider_bg_color', '#ffffff', $slider_id );
$padding_top = codeless_get_meta( 'slider_padding_top', '0px', $slider_id );
$padding_bottom = codeless_get_meta( 'slider_padding_bottom', '0px', $slider_id );

$slider_style = ' background-color:'. $bg_color . '; padding-top:'.$padding_top . '; padding-bottom:'.$padding_bottom.';';

?>

<div class="cl-blog cl-blog--style-media cl-blog--module-carousel cl-slider cl-slider--carousel" style="<?php echo esc_attr( $slider_style ) ?>">
    <div class="cl-blog__list cl-items-container cl-carousel owl-carousel owl-theme" data-auto-height="false" data-dots="0" data-nav="1" data-items="<?php echo esc_attr( codeless_get_meta( 'carousel_slider_columns', '3', $slider_id ) ) ?>" data-margin="5" data-loop="true" data-responsive='{"0": {"items":1}, "992": { "stagePadding":<?php echo esc_attr( codeless_get_meta( 'carousel_slider_columns', '3', $slider_id ) ) ?> } }'>
        <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();

            
            $style = 'background-image:url(\' ' . get_the_post_thumbnail_url() . '\' );';

            ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( codeless_extra_classes( 'entry' ) ); ?> <?php echo codeless_extra_attr( 'entry' ) ?> style="<?php echo esc_attr( $style ) ?>">
                    
                <div class="cl-entry__overlay"><a href="<?php echo get_permalink() ?>"></a></div>
                <div class="cl-entry__wrapper">
                
                
                    <div class="cl-entry__wrapper-content box-<?php echo esc_attr( codeless_get_meta( 'semi_carousel_box_color', 'white', $slider_id ) ) ?> cl-animate-on-visible bottom-t-top" data-delay="200" data-speed="400">
                    
                        <?php
            
                            /**
                             * Entry Header
                             * Output Entry Meta and title
                             */ 
                        ?>
                        
                        <header class="cl-entry__header">

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

$cl_from_element['blog_remove_animation'] = false;
?>