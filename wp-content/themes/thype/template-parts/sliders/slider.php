<?php
/**
 * Slider Template
 *
 * @package Thype
 * @since 1.0.0
 *
 */

global $cl_slider_data;

$slider_id = codeless_get_meta( 'select_slider', 'none' );
$slider_style = codeless_get_meta( 'slider_style', 'simple', $slider_id );
$slider_container = codeless_get_meta( 'slider_container', 'fullwidth', $slider_id );


$query = codeless_build_slider_query( $slider_id );

$the_query = new WP_Query( $query );

$cl_slider_data['the_query'] = $the_query;
$cl_slider_data['slider_id'] = $slider_id;

if ( $the_query->have_posts() ) :

    if( $slider_container == 'boxed' )
        echo '<div class="container"><div class="row"><div class="col-md-12">';
    

    get_template_part( 'template-parts/sliders/slider', $slider_style );

    if( $slider_container == 'boxed' )
        echo '</div></div></div>';

endif;


wp_reset_query();
?>