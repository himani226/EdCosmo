<?php
$site_logo = noxiy_option('default_logo');
$site_logo_2 = noxiy_option('default_logo_2');
$mobile_logo = noxiy_option('mobile_logo_1');
$default_search = noxiy_option('default_search', true);
$sticky_header = noxiy_option('sticky_header', false);

if ($sticky_header == 'yes') {
	$sticky_enable = 'header__sticky';
} else {
	$sticky_enable = 'disable_sticky_header';
}
?>
<!-- Header Area Start -->
<div class="header__area one <?php echo esc_attr($sticky_enable); ?>">
	<div class="container">
		<div class="header__area-menubar p-relative">
			<div class="header__area-menubar-left">
				<div class="header__area-menubar-left-logo">
					<?php
					if (has_custom_logo()) {
						the_custom_logo();
					} else {
						if (!empty($site_logo['url']) && !empty($site_logo_2['url'])) { ?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img class="dark-n" src="<?php echo esc_url($site_logo['url']); ?>"
									alt="<?php bloginfo('name'); ?>">
								<img class="light-n" src="<?php echo esc_url($site_logo_2['url']); ?>"
									alt="<?php bloginfo('name'); ?>">
							</a>
							<?php
						} else {
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img class="dark-n" src="<?php echo get_theme_file_uri(); ?>/assets/img/logo-2.png"
									alt="<?php bloginfo('name'); ?>">
								<img class="light-n" src="<?php echo get_theme_file_uri(); ?>/assets/img/logo-1.png"
									alt="<?php bloginfo('name'); ?>">
							</a>
							<?php
						}
					}
					?>

				</div>
			</div>
			<?php if (has_nav_menu('header-menu')) : ?>
			<div class="header__area-menubar-center">
				<div class="header__area-menubar-center-menu menu-responsive">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'header-menu',
							'menu_id' => 'mobilemenu',
							'container_class' => 'noxiy-default-menu',
						)
					);
					?>
				</div>
			</div>
			<?php endif; ?>
			<div class="header__area-menubar-right">
				<?php if ($default_search == 'yes'): ?>
					<div class="header__area-menubar-right-search one">
						<div class="search">
							<span class="header__area-menubar-right-search-icon open"><i class="fal fa-search"></i></span>
						</div>
						<div class="header__area-menubar-right-search-box">
							<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
								<input type="search" placeholder="<?php echo esc_attr('Search Here.....', 'noxiy'); ?>"
									value="<?php the_search_query(); ?>" name="s">
								<button value="Search" type="submit"><i class="fal fa-search"></i>
								</button>
							</form>
							<span class="header__area-menubar-right-search-box-icon"><i class="fal fa-times"></i></span>
						</div>
					</div>
				<?php endif; ?>
				<?php if (has_nav_menu('header-menu')) : ?>
				<div class="header__area-menubar-right-responsive-menu menu__bar one">
					<i class="flaticon-dots-menu"></i>
				</div>
				<?php endif;?>
			</div>
		</div>
		<div class="menu__bar-popup">
			<div class="menu__bar-popup-close"><i class="fal fa-times"></i></div>
			<div class="menu__bar-popup-left">
				<div class="menu__bar-popup-left-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<?php
						if (!empty($mobile_logo['url'])) { ?>
							<img src="<?php echo esc_url($mobile_logo['url']); ?>" alt="<?php bloginfo('name'); ?>">
						<?php } else { ?>
							<img src="<?php echo get_theme_file_uri(); ?>/assets/img/logo-1.png"
								alt="<?php bloginfo('name'); ?>">
						<?php } ?>
					</a>
					<div class="responsive-menu"></div>
				</div>
			</div>
			<div class="menu__bar-popup-right">
				<div class="menu__bar-popup-right-search">
					<form method="get" action="<?php echo esc_url(home_url('/')); ?>">
						<input type="search" placeholder="<?php echo esc_attr('Search Here.....', 'noxiy'); ?>"
							value="<?php the_search_query(); ?>" name="s">
						<button value="Search" type="submit"><i class="fal fa-search"></i>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Header Area End -->