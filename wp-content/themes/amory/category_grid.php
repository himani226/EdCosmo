<!-- main content start -->
<div class="mainwrap blog <?php if(is_front_page()) echo 'home' ?> <?php if(!amory_globals('use_fullwidth')) echo 'sidebar' ?> grid">
	<div class="main clearfix">		
		<div class="content blog">
			<?php if(is_home() && class_exists( 'woocommerce' ) && amory_globals('show_product') && (amory_data('show_product_position') == 1 || amory_data('show_product_position') == 3)){ ?>
				<div class="pmc-home-products">
					<div class="pmc-home-products-title">
						<?php esc_attr_e('Our featured collection', 'amory'); ?>
					</div>
					<div class="pmc-home-products-product">
					<?php echo do_shortcode('[recent_products per_page="3" columns="3"]'); ?>
					</div>
				</div>
			<?php } ?>
			<div id="pmc-tabs">
				<?php if(is_front_page()) { ?>
				<ul>
				<li><a class="tab1" href="#tabs-1"><?php esc_html_e('Recent posts','amory'); ?></a></li>
				<li><a class="tab2" href="#tabs-2"><?php esc_html_e('Popular posts','amory'); ?></a></li>
				</ul>
				<?php } ?>
				<div class="pmc-tabs">
					<div id="tabs-1" >
					<?php  get_template_part('category_grid_latest','latest-post'); ?>
					</div>
					<?php if(is_front_page()) { ?>
					<div id="tabs-2" >
					<?php get_template_part('category_grid_popular','popular-post'); ?>
					</div>
					<?php } ?>
				</div>
			</div>		
			<div class="infinity-more"><?php esc_html_e('Load more posts','amory'); ?></div>
			<?php if(is_home() && class_exists( 'woocommerce' ) && amory_globals('show_product') && (amory_data('show_product_position') == 2 || amory_data('show_product_position') == 3)){ ?>
				<div class="pmc-home-products">
					<div class="pmc-home-products-title">
						<?php esc_attr_e('Our featured collection', 'amory'); ?>
					</div>
					<div class="pmc-home-products-product">
					<?php echo do_shortcode('[recent_products per_page="3" columns="3"]'); ?>
					</div>
				</div>
			<?php } ?>				
			<div class="navi-grid">
			<?php
				get_template_part('includes/wp-pagenavi','navigation');
				if(function_exists('amory_wp_pagenavi')) { amory_wp_pagenavi(); }
			?>
			</div>
		</div>
		<!-- sidebar -->
		<?php if(!amory_globals('use_fullwidth')) { ?>
			<div class="sidebar">	
				<?php dynamic_sidebar( 'amory_sidebar' ); ?>
			</div>
		<?php } ?>
	</div>
</div>											
