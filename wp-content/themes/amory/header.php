<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" >
<!-- start -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no">
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) {wp_enqueue_script( 'comment-reply' ); }?>
	
	<?php wp_head();?>
</head>		
<!-- start body -->
<body <?php body_class(); ?> >
	<!-- start header -->
			<!-- fixed menu -->		
			<?php 
			?>	
			<?php if(amory_globals('display_scroll')) { ?>
			<div class="pagenav fixedmenu">						
				<div class="holder-fixedmenu">							
					<div class="logo-fixedmenu">								
					<?php if(amory_globals('scroll_logo')){ ?>
						<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(amory_data('scroll_logo')); ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" ></a>
					<?php } ?>
					</div>
						<div class="menu-fixedmenu home">
						<?php
						if ( has_nav_menu( 'amory_scrollmenu' ) ) {
						wp_nav_menu( array(
						'container' =>false,
						'container_class' => 'menu-scroll',
						'theme_location' => 'amory_scrollmenu',
						'echo' => true,
						'fallback_cb' => 'amory_fallback_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => new amory_Walker_Main_Menu())
						);
						}
						?>	
					</div>
				</div>	
			</div>
			<?php } ?>
				<header>
				<!-- top bar -->
				<?php if(amory_globals('top_bar')) { ?>
					<div class="top-wrapper">
						<div class="top-wrapper-content">
							<div class="top-left">
								<?php dynamic_sidebar( 'amory_sidebar-top-left' ); ?>
							</div>
							<div class="top-right">
								<?php 
								if(class_exists( 'woocommerce' ) && amory_globals('display_woocommerce_cart')){ ?>
									<div class="cartWrapper">
										<?php 
										global $woocommerce, $product; 
										$check_out = '';
										if(wc_get_cart_url() != ''){ 
											$cart=wc_get_cart_url();
											$check_out = wc_get_checkout_url(); 
										}
										else {$cart = esc_url(home_url('/')).'cart/';};
										?>
										<div class="header-cart-left">
											<div class="header-cart-items">
												<a href="<?php echo $cart; ?>" class="cart-top"><?php   esc_html_e('Items', 'amory');  ?></a>
												<a class="cart-bubble cart-contents">(<?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'amory'), $woocommerce->cart->cart_contents_count);?>)</a>
											</div>
											<div class="header-cart-total">
												<a class="cart-total"><?php echo amory_security($woocommerce->cart->get_cart_total()); ?></a>
											</div>
										</div>
										<div class="header-cart-icon"><i class="fa fa-shopping-basket"></i></div>
										<div class="cartTopDetails">
											<div class="cart_list product_list_widget">
												<div class="widget_shopping_cart_top widget_shopping_cart_content">	

													<?php get_template_part('woocommerce/cart/mini-cart') ?>

												</div>	
											</div>	
										</div>
									</div>	
								<?php } ?>
								<?php dynamic_sidebar( 'amory_sidebar-top-right' ); ?>
							</div>
						</div>
					</div>
					<?php } ?>			
					<div id="headerwrap">			
						<!-- logo and main menu -->
						<div id="header">
							<div class="header-image">
							<!-- respoonsive menu main-->
							<!-- respoonsive menu no scrool bar -->
							<div class="respMenu noscroll">
								<div class="resp_menu_button"><i class="fa fa-list-ul fa-2x"></i></div>
								<?php 
								if ( has_nav_menu( 'amory_respmenu' ) ) {
									$menuParameters =  array(
									  'theme_location' => 'amory_respmenu', 
									  'walker'         => new amory_Walker_Responsive_Menu(),
									  'echo'            => false,
									  'container_class' => 'menu-main-menu-container',
									  'items_wrap'     => '<div class="event-type-selector-dropdown">%3$s</div>',
									);
									echo strip_tags(wp_nav_menu( $menuParameters ), '<a>,<br>,<div>,<i>,<strong>' );
								}
								?>	
							</div>	
							<!-- logo -->
							<div class="logo-inner">
								<div id="logo" class="<?php if(is_active_sidebar( 'amory_sidebar-logo' )) { echo 'logo-sidebar'; } ?>">
									<?php $logo = esc_url(amory_data('logo')); ?>
									<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php if (!empty($logo)) {?>
									<?php echo esc_url($logo); ?><?php } else {?><?php echo get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" /></a>
								</div>
								<?php if(is_active_sidebar( 'amory_sidebar-logo' )) { ?> 
									<div class="logo-advertise">
										<?php dynamic_sidebar( 'amory_sidebar-logo' ); ?>
									</div>
								<?php } ?>									
							</div>	
							</div>
							<!-- main menu -->
							<div class="pagenav"> 	
								<div class="pmc-main-menu">
								<?php
									if ( has_nav_menu( 'amory_mainmenu' ) ) {	
										wp_nav_menu( array(
										'container' =>false,
										'container_class' => 'menu-header home',
										'menu_id' => 'menu-main-menu-container',
										'theme_location' => 'amory_mainmenu',
										'echo' => true,
										'fallback_cb' => 'amory_fallback_menu',
										'before' => '',
										'after' => '',
										'link_before' => '',
										'link_after' => '',
										'depth' => 0,
										'walker' => new amory_Walker_Main_Menu()));								
									} ?>											
								</div> 	
							</div> 
						</div>
					</div> 												
				</header>	
				<?php
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				if(is_plugin_active( 'revslider/revslider.php')){						
					if(amory_globals('rev_slider') && is_front_page() ){ ?>
						<div id="amory-slider-wrapper">
							<div id="amory-slider">
								<?php putRevSlider(amory_data('rev_slider'),"homepage") ?>
							</div>
						</div>
					<?php } ?>
				<?php } ?>		
				<?php 					
				if(is_front_page() && amory_globals('use_block1')){ ?>
						<?php amory_block_one(); ?>
					<?php } ?>	
					<?php if(is_front_page() && amory_globals('use_block2') ){ ?>	
						<?php amory_block_two(); ?>
					<?php } ?>				
				<?php if(is_front_page()){ ?>
				<?php amory_custom_layout(); ?>
				<?php } ?>				
