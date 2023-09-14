<?php
/**
 * Slider Simple
 *
 * @package Thype
 * @since 1.0.0
 *
 */

 global $cl_slider_data, $cl_from_element;

 $the_query = $cl_slider_data['the_query'];
 $slider_id = $cl_slider_data['slider_id'];


if( codeless_get_meta( 'simple_slider_image', 'no', $slider_id ) == 'yes' )
    $cl_from_element['blog_featured_posts_image'] = true;

$cl_from_element['blog_remove_animation'] = true;

$bg_color = codeless_get_meta( 'slider_bg_color', '#ffffff', $slider_id );
$padding_top = codeless_get_meta( 'slider_padding_top', '0px', $slider_id );
$padding_bottom = codeless_get_meta( 'slider_padding_bottom', '0px', $slider_id );

$slider_style = ' background-color:'. $bg_color . '; padding-top:'.$padding_top . '; padding-bottom:'.$padding_bottom.';';

?>

<div class="cl-blog cl-blog--style-big cl-blog--module-carousel cl-slider cl-slider--simple cl-slider--align-<?php echo esc_attr( codeless_get_meta( 'simple_slider_align', 'left', $slider_id ) ) ?> cl-slider--image-<?php echo esc_attr( codeless_get_meta( 'simple_slider_image', 'no', $slider_id ) ) ?>" style="<?php echo esc_attr( $slider_style ) ?>">
    <div class="cl-blog__list cl-items-container cl-carousel owl-carousel owl-theme" data-anim-in="fadeOut" data-dots="1" data-nav="0" data-items="1">
        <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();

                get_template_part( 'template-parts/blog/style', 'big' );
                
            endwhile;
        ?>
    </div>
</div>

<?php

$cl_from_element['blog_featured_posts_image'] = false;
$cl_from_element['blog_remove_animation'] = false;
?>