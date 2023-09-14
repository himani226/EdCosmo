<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Thype
 * @subpackage Templates
 * @since 1.0.0
 */

?>

<aside id="left_sidebar" class="widget-area <?php echo codeless_cols_prepend() . '3' ?> <?php echo codeless_cols_prepend() . 'pull-6' ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->

<aside id="secondary" class="widget-area <?php echo codeless_extra_classes( 'secondary' ) ?>" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->