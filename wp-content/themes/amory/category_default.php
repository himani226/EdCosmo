
<!-- main content start -->
<div class="mainwrap blog <?php if(is_front_page()) echo 'home' ?> <?php if(!amory_globals('use_fullwidth')) echo 'sidebar' ?> default">
	<div class="main clearfix">
		<div class="pad"></div>			
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
			<?php if (have_posts()) : ?>
			<?php 
			add_filter( 'shortcode_atts_gallery', 'amory_gallery_C' );
			function amory_gallery_c( $out )
			{
				remove_filter( current_filter(), __FUNCTION__ );
				$out['size'] = 'amory-news';
				return $out;
			}
						
			?>
			<?php while (have_posts()) : the_post(); ?>
			<?php if(is_sticky(get_the_id())) { ?>
			<div class="amory_sticky">
			<?php } ?>
			<?php
			$postmeta = get_post_custom(get_the_id()); ?>
				
			
			<?php
			if ( has_post_format( 'gallery' , get_the_id())) { 
			?>
			<div class="slider-category">
				
				<div class="blogpostcategory">
					<div class="topBlog">	
						<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
						<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(amory_globals('display_post_meta')) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','amory'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>				
						</div>
						<?php } ?> <!-- end of post meta -->
					</div>				
					<?php
						$attachments = '';
						$attachments =  get_post_gallery_images( $post->ID);
						if ($attachments) { $rand = rand(0,100); ?>
							<div id="slider-category" class="slider-category">
							<script type="text/javascript">
							jQuery(document).ready(function($){
								jQuery('#bxslider-<?php echo esc_attr($rand); ?>').bxSlider({
								  easing : 'easeInOutQuint',
								  captions: true,
								  speed: 800,
								   buildPager: function(slideIndex){
									switch(slideIndex){
									<?php
									$i = 0;
									foreach ($attachments as  $image_url) { 
										echo 'case '.$i.':return "<img src=\"'. esc_url( $image_url) .'\"";';
										$i++;
									} ?>									
									}
								  }
								});
							});	
							</script>	
								<ul id="bxslider-<?php echo esc_attr($rand); ?>" class="bxslider">
									<?php 
										foreach ($attachments as  $image_url) {
										

											?>	
												<li>
													<img src="<?php echo esc_url( $image_url) ?>" alt="<?php ?>"/>							
												</li>
												<?php } ?>
								</ul>

							</div>
						<?php } ?>
				<?php get_template_part('includes/boxes/loopBlog','single'); ?>
				</div>
			</div>
			<?php } 
			if ( has_post_format( 'video' , get_the_id())) { ?>
			<div class="slider-category">
			
				<div class="blogpostcategory">
					<div class="topBlog">	
						<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
						<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(amory_globals('display_post_meta')) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','amory'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>			
						</div>
						<?php } ?> <!-- end of post meta -->
					</div>				
					<?php
					
					if(!empty($postmeta["video_post_url"][0])) {
						$embed_code = wp_oembed_get(esc_url($postmeta["video_post_url"][0]));
						echo $embed_code ;
					} ?>
					<?php get_template_part('includes/boxes/loopBlog','single'); ?>
				</div>
				
			</div>
			<?php } 
			if ( has_post_format( 'link' , get_the_id())) {
			$postmeta = get_post_custom(get_the_id()); 
			if(isset($postmeta["link_post_url"][0])){
				$link = esc_url($postmeta["link_post_url"][0]);
			} else {
				$link = "#";
			}			
			?>
			<div class="link-category">
				<div class="blogpostcategory">
					<div class="topBlog">	
						<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
						<h2 class="title"><a href="<?php $link ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<?php if(amory_globals('display_post_meta')) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','amory'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>				
						</div>
						<?php } ?> <!-- end of post meta -->
					</div>			
					<?php if(amory_getImage(get_the_id(), 'amory-postBlock') != '') { ?>	

					<a class="overdefultlink" href="<?php echo esc_url($link) ?>">
					<div class="overdefult">
					</div>
					</a>

					<div class="blogimage">	
						<div class="loading"></div>		
						<a href="<?php echo esc_url($link) ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo amory_getImage(get_the_id(), 'amory-postBlock'); ?></a>
					</div>
					<?php } ?>					
					<?php get_template_part('includes/boxes/loopBlogLink','single'); ?>								
				</div>
			</div>
			
			<?php 
			} 	
			if ( has_post_format( 'quote' , get_the_id())) {?>
			<div class="quote-category">
				<div class="blogpostcategory">				
					<?php get_template_part('includes/boxes/loopBlogQuote','single'); ?>								
				</div>
			</div>
			
			<?php 
			} 			
			?>
			<?php if ( has_post_format( 'audio' , get_the_id())) {?>
			<div class="blogpostcategory">
				<div class="topBlog">	
					<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
					<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php if(amory_globals('display_post_meta')) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','amory'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>			
						</div>
						<?php } ?> <!-- end of post meta -->
				</div>			
				<div class="audioPlayerWrap">
					<div class="audioPlayer">
						<?php 
						if(isset($postmeta["audio_post_url"][0]))
							echo do_shortcode('[soundcloud  params="auto_play=false&hide_related=false&visual=true" width="100%" height="150"]'. esc_url($postmeta["audio_post_url"][0]) .'[/soundcloud]') ?>
					</div>
				</div>
				<?php get_template_part('includes/boxes/loopBlog','single'); ?>		
			</div>	
			<?php
			}
			?>					
			
			
			<?php if ( !get_post_format() ) {?>
		

			<div class="blogpostcategory">
				<div class="topBlog">	
					<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
					<h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php if(amory_globals('display_post_meta')) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_time('d');
							$month= get_the_time('m');
							$year= get_the_time('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php the_date() ?></a> <a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','amory'); echo get_the_author(); ?></a> <a href="<?php echo the_permalink() ?>#commentform"><?php comments_number(); ?></a>		
						</div>
						<?php } ?> <!-- end of post meta -->
				</div>					
				<?php if(amory_getImage(get_the_id(), 'amory-postBlock') != '') { ?>	

					<a class="overdefultlink" href="<?php the_permalink() ?>">
					<div class="overdefult">
					</div>
					</a>

					<div class="blogimage">	
						<div class="loading"></div>		
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php echo amory_getImage(get_the_id(), 'amory-postBlock'); ?></a>
					</div>
					<?php } ?>
					<?php get_template_part('includes/boxes/loopBlog','single'); ?>
			</div>
			
			<?php } ?>		
			<?php if(is_sticky()) { ?>
				</div>
			<?php } ?>
			
				<?php endwhile; ?>
				<?php if(is_home() && class_exists( 'woocommerce' ) && amory_globals('show_product') && (amory_data('show_product_position') == 2 || amory_data('show_product_position') == 3)){ ?>
					<div class="pmc-home-products">
						<div class="pmc-home-products-title">
							<?php esc_attr_e('Our featured collection', 'amory') ?>
						</div>
						<div class="pmc-home-products-product">
						<?php echo do_shortcode('[recent_products per_page="3" columns="3"]'); ?>
						</div>
					</div>
				<?php } ?>					
					<?php
					
						get_template_part('includes/wp-pagenavi','navigation');
						if(function_exists('amory_wp_pagenavi')) { amory_wp_pagenavi(); }
					?>
					
					<?php else : ?>
					
						<div class="postcontent">
							<?php $amory_data = get_option(OPTIONS); ?>
							<h1><?php amory_security($amory_data['errorpagetitle']) ?></h1>
							<div class="posttext">
								<?php amory_security($amory_data['errorpage']) ?>
							</div>
						</div>
						
					<?php endif; ?>
				
		</div>
		<!-- sidebar -->
		<?php if(!amory_globals('use_fullwidth')) { ?>
			<div class="sidebar">	
				<?php dynamic_sidebar( 'amory_sidebar' ); ?>
			</div>
		<?php } ?>
	</div>
	
</div>											
