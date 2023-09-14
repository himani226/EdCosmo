<?php
/**
 * Slider Modern
 *
 * @package Thype
 * @since 1.0.0
 *
 */

 global $cl_slider_data, $cl_from_element;

 $the_query = $cl_slider_data['the_query'];
 $slider_id = $cl_slider_data['slider_id'];
$container = codeless_get_meta( 'slider_container', 'no', $slider_id );


$cl_from_element['blog_excerpt_length'] = 20;
$cl_from_element['blog_remove_animation'] = true;


$bg_color = codeless_get_meta( 'slider_bg_color', '#ffffff', $slider_id );
$padding_top = codeless_get_meta( 'slider_padding_top', '0px', $slider_id );
$padding_bottom = codeless_get_meta( 'slider_padding_bottom', '0px', $slider_id );

$slider_style = ' background-color:'. $bg_color . '; padding-top:'.$padding_top . '; padding-bottom:'.$padding_bottom.';';

$text_color = codeless_get_meta( 'modern_slider_color', 'dark', $slider_id );

?>

<div class="cl-blog cl-blog--module-carousel cl-slider--color-<?php echo esc_attr($text_color) ?> cl-slider cl-slider--modern" style="<?php echo esc_attr( $slider_style ) ?>">
    <div class="cl-blog__list cl-items-container cl-carousel owl-carousel owl-theme"  data-auto-height="false" data-dots="0" data-nav="1" data-items="1">
        <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();

            
            $style = 'background-image:url(\' ' . get_the_post_thumbnail_url() . '\' );';

            ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( codeless_extra_classes( 'entry' ) ); ?> <?php echo codeless_extra_attr( 'entry' ) ?>>
                    
                <div class="cl-entry__overlay"></div>
                
                <div class="cl-entry__wrapper">
                
                
                    <div class="cl-entry__wrapper-content cl-animate-on-visible bottom-t-top" data-delay="250" data-speed="400">
                    
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

                            <?php get_template_part( 'template-parts/blog/formats/content' ) ?>
                            
                            

                        </header><!-- .cl-entry__header -->

                    <?php
                    /**
                     * Close Entry Wrapper
                     */ 
                    ?>
                    
                    </div><!-- .cl-entry__wrapper-content -->

                    <div class="cl-entry__media cl-animate-on-visible zoom-in" data-delay="100" data-speed="500" style="<?php echo esc_attr( $style ) ?>"></div>
                    
                </div><!-- .cl-entry__wrapper -->
            
            </article><!-- #post-## -->

                
            <?php endwhile;
        ?>
    </div>
</div>

<?php

$cl_from_element['blog_remove_animation'] = false;
?>