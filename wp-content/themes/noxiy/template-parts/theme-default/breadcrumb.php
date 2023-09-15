<?php

$banner_breadcrumb = noxiy_option('banner_breadcrumb', true);

if (is_page() || is_singular(array('post', 'service', 'portfolio')) && get_post_meta($post->ID, 'noxiy_meta_options', true)) {
	$noxiy_meta = get_post_meta($post->ID, 'noxiy_meta_options', true);
} else {
	$noxiy_meta = array();
}

if (is_array($noxiy_meta) && array_key_exists('custom_title', $noxiy_meta) && $noxiy_meta['custom_title'] != 'no') {
	$page_title = $noxiy_meta['page_title'];
} else {
	$page_title = get_the_title();
}

?>

<?php if ($banner_breadcrumb == 'yes'): ?>

	<!-- Page Banner Area Start -->
	<div class="page__banner">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="page__banner-content">

						<?php if (is_home()) { ?>
							<h1>
								<?php echo esc_html('Blog'); ?>
							</h1>
							<?php if (class_exists('CSF')): ?>
								<ul>
									<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html('Home'); ?></a><span>
											<?php echo esc_html('|'); ?>
										</span></li>
									<li>
									<?php echo esc_html('Blog'); ?>
									</li>
								</ul>
							<?php endif; ?>
						<?php } elseif (is_front_page()) { ?>

							<h1>
								<?php echo esc_html($page_title); ?>
							</h1>

						<?php } elseif (function_exists("is_shop") && is_shop()) {
							?>
							<h1>
								<?php echo esc_html('Shop'); ?>
							</h1>

						<?php } elseif (is_tax('product_cat') || is_tax('product_tag')) {
							?>
							<h1>
								<?php single_term_title(); ?>
							</h1>

						<?php } elseif (is_singular()) { ?>
							<h1>
								<?php echo esc_html($page_title); ?>
							</h1>
							<?php if (class_exists('CSF')): ?>
								<ul>
									<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html('Home'); ?></a><span>
											<?php echo esc_html('|'); ?>
										</span></li>
									<li>
										<?php echo esc_html(get_the_title()); ?>
									</li>
								</ul>
							<?php endif; ?>
							
						<?php } elseif (is_single()) { ?>

							<h1>
								<?php echo esc_html($page_title); ?>
							</h1>

						<?php } elseif (is_archive()) { ?>

							<h1>
								<?php the_archive_title(); ?>
							</h1>

						<?php } elseif (is_404()) { ?>
							<h1>
								<?php echo esc_html('Not Found', 'noxiy'); ?>
							</h1>
							<?php if (class_exists('CSF')): ?>
								<ul>
									<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html('Home'); ?></a><span>
											<?php echo esc_html('|'); ?>
										</span></li>
									<li>
										<?php echo esc_html('404'); ?>
									</li>
								</ul>
							<?php endif; ?>
							

						<?php } elseif (is_search()) { ?>
							<h1>
								<?php echo esc_html('Search Results..', 'noxiy'); ?>
							</h1>
						<?php } else { ?>
							<h1>
								<?php echo esc_html($page_title); ?>
							</h1>
							<?php if (class_exists('CSF')): ?>
								<ul>
									<li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html('Home'); ?></a><span>
											<?php echo esc_html('|'); ?>
										</span></li>
									<li>
										<?php echo esc_html(get_the_title()); ?>
									</li>
								</ul>
							<?php endif; ?>
							
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Page Banner Area End -->
<?php endif; ?>