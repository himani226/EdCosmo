<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package noxiy
 */

if (is_page() || is_singular('post') && get_post_meta($post->ID, 'noxiy_meta_options', true)) {
    $noxiy_meta = get_post_meta($post->ID, 'noxiy_meta_options', true);
} else {
    $noxiy_meta = array();
}
$footer_custom = noxiy_option('custom_footer');

if ((is_array($noxiy_meta) && array_key_exists('meta_footer_layout', $noxiy_meta) && $noxiy_meta['meta_footer_layout'] != 'no') || ($footer_custom != 'no' && class_exists('CSF'))) {
    $footer_layout = 'theme-builder/footer-custom';
} else {
    $footer_layout = 'theme-default/footer-default';
}
?>

<?php get_template_part('template-parts/' . $footer_layout . ''); ?>

<?php get_template_part('template-parts/theme-default/' . 'scroll-up'); ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>