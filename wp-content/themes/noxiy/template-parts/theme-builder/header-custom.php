<?php
if (is_page() || is_singular('post') && get_post_meta($post->ID, 'noxiy_meta_options', true)) {
    $noxiy_meta = get_post_meta($post->ID, 'noxiy_meta_options', true);
} else {
    $noxiy_meta = array();
}
if (is_array($noxiy_meta) && array_key_exists('noxiy_builder_header', $noxiy_meta) && $noxiy_meta['meta_header_layout'] != 'no') {
    $noxiy_builder = $noxiy_meta['noxiy_builder_header'];
} else {
    $noxiy_builder = noxiy_option('noxiy_builder_header');
}

if (true == post_type_exists('noxiy_builder')):
    $header_args = array(
        'p' => $noxiy_builder,
        'post_type' => 'noxiy_builder',
    );
    $header_has_style = new WP_Query($header_args);
    if ($header_has_style->have_posts()):
        while ($header_has_style->have_posts()):
            $header_has_style->the_post(); ?>
            <div class="noxiy-builder-header">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    endif;
endif;
?>