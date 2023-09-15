<?php
if (is_page() || is_singular('post') && get_post_meta($post->ID, 'noxiy_meta_options', true)) {
    $noxiy_meta = get_post_meta($post->ID, 'noxiy_meta_options', true);
} else {
    $noxiy_meta = array();
}
if (is_array($noxiy_meta) && array_key_exists('noxiy_builder_footer', $noxiy_meta) && $noxiy_meta['meta_footer_layout'] != 'no') {
    $noxiy_builder = $noxiy_meta['noxiy_builder_footer'];
} else {
    $noxiy_builder = noxiy_option('noxiy_builder_footer');
}

if (true == post_type_exists('noxiy_builder')):
    $footer_args = array(
        'p' => $noxiy_builder,
        'post_type' => 'noxiy_builder',
    );
    $footer_has_style = new WP_Query($footer_args);
    if ($footer_has_style->have_posts()):
        while ($footer_has_style->have_posts()):
            $footer_has_style->the_post(); ?>
            <div class="noxiy-builder-footer">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
        wp_reset_postdata();

    endif;

endif;
?>