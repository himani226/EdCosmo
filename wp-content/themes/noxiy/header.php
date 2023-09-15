<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package noxiy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<?php
	if (class_exists('CSF')) {
		$elements = 'elements-design';
	} else {
		$elements = 'noxiy-core';
	}
	?>

	<?php
	if (is_page() || is_singular('post') && get_post_meta($post->ID, 'noxiy_meta_options', true)) {
		$noxiy_meta = get_post_meta($post->ID, 'noxiy_meta_options', true);
	} else {
		$noxiy_meta = array();
	}

	$header_custom = noxiy_option('custom_header');

	if ((is_array($noxiy_meta) && array_key_exists('meta_header_layout', $noxiy_meta) && $noxiy_meta['meta_header_layout'] != 'no') || ($header_custom != 'no' && class_exists('CSF'))) {
		$header_layout_style = 'theme-builder/header-custom';
	} else {
		$header_layout_style = 'theme-default/header-default';
	}

	$site_dark = noxiy_option('dark_mode');

	if (is_array($noxiy_meta) && array_key_exists('dark_mode', $noxiy_meta)) {
		$dark_mode = $noxiy_meta['dark_mode'];
	} else if (!empty($site_dark) && class_exists('CSF')) {
		$dark_mode = noxiy_option('dark_mode');
	} else {
		$dark_mode = 'light-mode';
	}
	
	?>

	<div id="page" class="site <?php echo esc_attr($dark_mode); ?> <?php echo esc_attr($elements); ?> <?php echo esc_attr($rtl_mode); ?>">
		<?php get_template_part('template-parts/theme-default/' . 'preloader'); ?>
		<?php get_template_part('template-parts/' . $header_layout_style . ''); ?>