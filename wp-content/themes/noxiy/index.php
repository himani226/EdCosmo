<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package noxiy
 */

get_header();

$site_layout      = noxiy_option('blog_layout', 'right-sidebar');
$selected_sidebar = noxiy_option('blog_sidebar', 'sidebar-1');

if ($site_layout == 'left-sidebar' && is_active_sidebar($selected_sidebar) || $site_layout == 'right-sidebar' && is_active_sidebar($selected_sidebar)) {
	$content_layout = 'col-lg-8 lg-mb-60';
} else {
	$content_layout = 'col-lg-12';
}

?>
<main id="primary" class="site-main">
	<?php
	get_template_part('template-parts/theme-default/' . 'breadcrumb');
	?>
	<!-- News Standard Area Start -->
	<div class="blog__standard section-padding">
		<div class="container">
			<div class="row">
				<?php
				if ($site_layout == 'left-sidebar' && is_active_sidebar($selected_sidebar)) : ?>
					<div class="col-lg-4 order-last order-lg-first">
						<?php get_sidebar(); ?>
					</div>
				<?php endif; ?>
				<div class="<?php echo esc_attr($content_layout); ?>">
					<div class="blog__standard-left">
						<?php
						if (have_posts()) :

							while (have_posts()) :
								the_post();
								get_template_part('template-parts/content', get_post_type());

							endwhile;

						else :
							get_template_part('template-parts/content', 'none');

						endif;
						?>

					</div>

					<?php get_template_part('template-parts/theme-default/' . 'pagination'); ?>

				</div>


				<?php
				if ($site_layout == 'right-sidebar' && is_active_sidebar($selected_sidebar)) : ?>
					<div class="col-lg-4">
						<?php get_sidebar(); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<!-- News Standard Area End -->

</main>

<?php
get_footer();
