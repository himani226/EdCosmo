<?php get_header();  ?>
<!-- top bar with breadcrumb and post navigation -->
<?php

$post_categories = wp_get_post_categories( get_the_ID() );
$cats = array();
     
foreach($post_categories as $c){
    $cat = get_category( $c );
    $cats[] = $cat->term_id;
}
$cats = implode(",", $cats);


$args = array( 
		'category__and' => $cats,
		'posts_per_page' => 50,
		'orderby' => 'rand',
		'exclude' => array( get_the_id(),
		
		)
	);

$postslist = get_posts( $args ); 

?>
<!-- main content start -->
<div class="mainwrap single-default <?php if(!amory_globals('use_fullwidth')) echo 'sidebar' ?>">
	<?php if (have_posts()) : while (have_posts()) : the_post();  $postmeta = get_post_custom(get_the_id());  ?>
	<!--rev slider-->
	<?php
	if(isset($postmeta["custom_post_rev"][0]) && ($postmeta["custom_post_rev"][0] != 'empty')) { ?>
		<div id="amory-slider-wrapper" class="amory-rev-slider">
		<?php putRevSlider($postmeta["custom_post_rev"][0]); ?>
		</div>
		<?php
	}
	?>
	
	<div class="main clearfix">	
	<div class="content singledefult">
		<div class="postcontent singledefult" id="post-<?php  get_the_id(); ?>" <?php post_class(); ?>>		
			<div class="blogpost">		
				<div class="posttext">
					<div class="topBlog">	
						<?php if ( !has_post_format( 'quote' , get_the_id()) && !has_post_format( 'link' , get_the_id())) {?>	
						<?php if(amory_globals('display_post_meta')) { ?>
						<div class = "post-meta">
							<?php 
							$day = get_the_date('d');
							$month= get_the_date('m');
							$year= get_the_date('Y');
							?>
							<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php echo get_the_date() ?></a><a class="post-meta-author" href="<?php echo  the_author_meta( 'user_url' ) ?>"><?php esc_html_e('by ','amory'); echo get_the_author(); ?></a><a href="#commentform"><?php comments_number(); ?></a><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?>
						</div>
						<?php } ?> 		
					
							<h1 class="title"><?php the_title(); ?></h1>
						<?php } ?>
						<!-- end of post meta -->
					</div>		
					<?php if ( !has_post_format( 'gallery' , get_the_id())) { ?>
						 
						<div class="blogsingleimage">			
							
							<?php if ( !get_post_format() ) {?>
								<?php echo amory_getImage(get_the_id(), 'amory-postBlock'); ?>
							<?php } ?>
							
							<?php if ( has_post_format( 'video' , get_the_id())) {?>
							
								<?php  
									if(!empty($postmeta["video_post_url"][0])) {
										$embed_code = wp_oembed_get(esc_url($postmeta["video_post_url"][0]));
										echo $embed_code ;
									}
								?>
							<?php } ?>	
							<?php if ( has_post_format( 'audio' , get_the_id())) {?>
							<div class="audioPlayer">
								<?php 
								if(isset($postmeta["audio_post_url"][0]))
									echo do_shortcode('[soundcloud  params="auto_play=false&hide_related=false&visual=true" width="100%" height="150"]'. esc_url($postmeta["audio_post_url"][0]) .'[/soundcloud]') ?>
							</div>
							<?php
							}
							?>	

						</div>
		

					<?php } else {?>

					<?php
						$attachments = '';
						add_filter( 'shortcode_atts_gallery', 'amory_gallery' );
						function amory_gallery( $out )
						{
							remove_filter( current_filter(), __FUNCTION__ );
							$out['size'] = 'amory-news';
							return $out;
						}
						$attachments =  get_post_gallery_images( $post->ID);
						if ($attachments) {?>
							<div id="slider-category" class="slider-category">
							<script type="text/javascript">
							jQuery(document).ready(function($){
								jQuery('.bxslider').bxSlider({
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
								<ul id="slider" class="bxslider">
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

					<?php }  ?>
					<div class="sentry">
						<?php if ( has_post_format( 'video' , get_the_id())) {?>
							<div><?php the_content(); ?></div>
						<?php
						}
					    if ( has_post_format( 'audio' , get_the_id())) { ?>
							<div><?php the_content(); ?></div>
						<?php
						}						
						if(has_post_format( 'gallery' , get_the_id())){?>
							<div class="gallery-content"><?php the_content(); 	?></div>
						<?php } 
						if ( has_post_format( 'quote' , get_the_id())) {?>
						<div class="quote-category">
							<div class="blogpostcategory">				
								<?php get_template_part('includes/boxes/loopBlogQuote','single'); ?>								
							</div>
						</div>
						
						<?php 
						} 		
						if ( has_post_format( 'link' , get_the_id())) {
						$postmeta = get_post_custom(get_the_id()); 
						if(isset($postmeta["link_post_url"][0])){
							$link = esc_url($postmeta["link_post_url"][0]);
						} else {
							$link = "#";
						}			
						?>
						<div class="link-category">
								<div class="topBlog">	
									<div class="blog-category"><?php echo '<em>' . get_the_category_list( esc_html__( ', ', 'amory' ) ) . '</em>'; ?> </div>
									<h2 class="title"><a href="<?php $link ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
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
						
						<?php 
						} 						
						if( !get_post_format()){?> 
						    <?php add_filter('the_content', 'amory_addlightbox'); ?>
							<div><?php the_content(); ?></div>		
						<?php } ?>
						<div class="post-page-links"><?php wp_link_pages(); ?></div>
						<div class="singleBorder"></div>
					</div>
				</div>
				
				<?php if(amory_globals('single_display_tags')) { ?>
				<?php if(has_tag()) { ?>
					<div class="tags"><?php the_tags('',' ',''); ?></div>	
				<?php } ?>
				<?php } ?>
				
				<?php if(amory_globals('single_display_post_meta')) { ?>
				<div class="blog-info">
					
				
					<?php if(amory_globals('single_display_socials')) { ?>
					<div class="blog_social"> <?php esc_html_e('Share: ','amory') . amory_socialLinkSingle(get_the_permalink(),get_the_title())  ?></div>	
					<?php } ?>
				
				</div>
				<?php } ?> <!-- end of blog-info -->
				
				<?php if(amory_globals('display_author_info') && get_the_author_meta('description')!= '') { ?>
				<div class = "author-info-wrap">
					<div class="blogAuthor">
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta( 'ID' ), 100); ?></a>
					</div>
					<div class="authorBlogName">	
						<?php esc_html_e('Written by ','amory'); ?> <?php echo get_the_author(); ?>  
					</div>
					<div class = "bibliographical-info"><?php echo get_the_author_meta('description')?></div>
				</div>
				<?php } ?> <!-- end of author info -->
				
			</div>						
			
		</div>	
		
		<?php if(amory_globals('display_related')) { ?>

		<div class="titleborderOut">
			<div class="titleborder"></div>
		</div>
	
		<div class="relatedPosts">
			<div class="relatedtitle">
				<h4><?php  esc_html_e('Related Posts','amory'); ?></h4>
			</div>
			<div class="related">	
			
			<?php
			$count = 0;
			foreach($postslist as $amory_post) {
				setup_postdata( $amory_post );
				if(!has_post_format( 'quote' , $amory_post->ID) && !has_post_format( 'link' , $amory_post->ID)) {
				if(amory_getImage($amory_post->ID, 'amory-related') !=''){
					$image_related = amory_getImage($amory_post->ID, 'amory-related');
				}
				if($count != 2){ ?>
					<div class="one_third">
				<?php } else { ?>
					<div class="one_third last">
				<?php } ?>
						<?php if(!empty($image_related)){ ?>
							<div class="image"><a href="<?php echo esc_url(get_permalink($amory_post->ID)) ?>" rel="bookmark" title="Permanent Link to <?php echo esc_attr($amory_post->post_title); ?>"><?php amory_security($image_related) ?></a></div>
						<?php } ?>
						<h4><a href="<?php echo esc_url(get_permalink($amory_post->ID)) ?>" rel="bookmark" title="Permanent Link to <?php echo esc_attr($amory_post->post_title); ?>"><?php echo esc_attr($amory_post->post_title); ?></a></h4>
						<?php
						$day = get_the_time('d',$amory_post->ID);
						$month= get_the_time('m',$amory_post->ID);
						$year= get_the_time('Y',$amory_post->ID);
						
						?>
						<?php echo '<a class="post-meta-time" href="'.get_day_link( $year, $month, $day ).'">'; ?><?php echo esc_attr(date('F j, Y', strtotime($amory_post->post_date))) ?></a>						
					</div>
						
				<?php 
				$count++;
				if($count == 3) {break;}
				}
			} ?>
			</div>
			</div>
			<?php 
			wp_reset_postdata();
			
			?>	
		<?php } ?> <!-- end of related -->
		
		
		<?php comments_template(); ?>
		
		<?php if(amory_globals('single_display_post_navigation')) { ?>
		<div class = "post-navigation">
			<?php next_post_link('%link', '<div class="link-title-previous"><span>&#171; '.esc_html__('Previous post','amory').'</span><div class="prev-post-title">%title</div></div>' ,false,''); ?> 
			<?php previous_post_link('%link','<div class="link-title-next"><span>'.esc_html__('Next post','amory').' &#187;</span><div class="next-post-title">%title</div></div>',false,''); ?> 
		</div>
		<?php } ?> <!-- end of post navigation -->
		
		<?php endwhile; else: ?>
						
			<?php get_template_part('404','error-page'); ?>
		<?php endif; ?>
		</div>
		
		
	<?php if(!amory_globals('use_fullwidth')) { ?>
		<div class="sidebar">	
			<?php dynamic_sidebar( 'amory_sidebar' ); ?>
		</div>
	<?php } ?>
</div>
</div>
<?php get_footer(); ?>
