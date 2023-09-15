<?php

/**
 * Enqueue scripts and styles.
 */
/**
 * Enqueue scripts and styles.
 */
function noxiy_scripts()
{
    if (!class_exists('CSF')) {
        wp_enqueue_style('noxiy-default-fonts', "//fonts.googleapis.com/css?family=Kumbh+Sans:400,500,600,700,800|Outfit:400,500,600,700,800", '', '1.0.0', 'screen');
    }
    wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/css/bootstrap.min.css'), null, NOXIY_VERSION);
    wp_enqueue_style('fontawesome', get_theme_file_uri('/assets/css/all.css'), null, NOXIY_VERSION);
    wp_enqueue_style('meanmenu', get_theme_file_uri('/assets/css/meanmenu.min.css'), null, NOXIY_VERSION);
    wp_enqueue_style('animate', get_theme_file_uri('/assets/css/animate.css'), null, NOXIY_VERSION);
    wp_enqueue_style('swiper-bundle', get_theme_file_uri('/assets/css/swiper-bundle.min.css'), null, NOXIY_VERSION);
    wp_enqueue_style('magnific-popup', get_theme_file_uri('/assets/css/magnific-popup.css'), null, NOXIY_VERSION);
    wp_enqueue_style('flaticon-noxiy', get_theme_file_uri('/assets/font/flaticon.css'), null, NOXIY_VERSION);
    wp_enqueue_style('noxiy-sass', get_theme_file_uri('/assets/sass/style.css'), null, NOXIY_VERSION);
    wp_enqueue_style('noxiy-style', get_stylesheet_uri(), array(), NOXIY_VERSION);

    wp_enqueue_script('bootstrap', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('popper', get_theme_file_uri('/assets/js/popper.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('meanmenu', get_theme_file_uri('/assets/js/jquery.meanmenu.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('swiper-bundle', get_theme_file_uri('/assets/js/swiper-bundle.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('magnific-popup', get_theme_file_uri('/assets/js/jquery.magnific-popup.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('progressbar', get_theme_file_uri('/assets/js/progressbar.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('isotope', get_theme_file_uri('/assets/js/isotope.pkgd.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('counterups', get_theme_file_uri('/assets/js/jquery.counterup.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('waypoints', get_theme_file_uri('/assets/js/jquery.waypoints.min.js'), array('jquery'), NOXIY_VERSION, true);
    wp_enqueue_script('noxiy-script', get_theme_file_uri('/assets/js/custom.js'), array('jquery'), NOXIY_VERSION, true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'noxiy_scripts');
