<?php

$amorypop = new WP_Query( array( 'posts_per_page' => 8, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC' , 'post_type' => 'post'  ) );
?>
		
			<?php if ($amorypop->have_posts()) : ?>
			<?php $do_not_duplicate = array(); $i = 0;?>
			<?php while ($amorypop->have_posts()) : $amorypop->the_post(); 
			if ( in_array( get_the_id(), $do_not_duplicate ) ) { continue; }
			$do_not_duplicate[$i++] = get_the_id();

			?>

			<?php
			$postmeta = get_post_custom(get_the_id()); 
				
			if ( has_post_format( 'video' , get_the_id())) { ?>
			<div class="slider-category">
			
				<div class="blogpostcategory">			
					<?php
					
					if(!empty($postmeta["video_post_url"][0])) {
				$embed_code = wp_oembed_get(esc_url($postmeta["video_post_url"][0]),array('width'=>300,'height'=>200));
				echo $embed_code ;
					} ?>
					<?php get_template_part('includes/boxes/loopBlogGrid','single'); ?>
				</div>
				
			</div>
			<?php } 
			if ( has_post_format( 'link' , get_the_id())) {
			$postmeta = get_post_custom(get_the_id()); 
			if(isset($postmeta["link_post_url"][0])){
				$link = $postmeta["link_post_url"][0];
			} else {
				$link = "#";
			}			
			?>
			<div class="link-category">
				<div class="blogpostcategory">	
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
				<div class="audioPlayerWrap">
					<div class="audioPlayer">
						<?php 
						if(isset($postmeta["audio_post_url"][0]))
							echo do_shortcode('[soundcloud  params="auto_play=false&hide_related=false&visual=true" width="100%" height="150"]'. esc_url($postmeta["audio_post_url"][0]) .'[/soundcloud]') ?>
					</div>
				</div>
				<?php get_template_part('includes/boxes/loopBlogGrid','single'); ?>		
			</div>	
			<?php
			}
			?>					
			
			
	<?php if ( !get_post_format() || has_post_format( 'gallery' , get_the_id())) {?>
		

			<div class="blogpostcategory">					
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
					<?php get_template_part('includes/boxes/loopBlogGrid','single'); ?>
			</div>
			
			<?php } ?>		

			
				<?php endwhile; ?>
						
			<?php endif; ?>
				
	<?php wp_reset_postdata(); ?>	