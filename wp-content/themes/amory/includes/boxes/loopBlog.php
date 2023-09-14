	
	<div class="entry">
		<div class = "meta">		
			<div class="blogContent">
				<div class="blogcontent"><?php the_content() ?></div>
			<?php if(amory_globals('display_post_meta')) { ?>
			
				<div class="bottomBlog">
			
					<?php if(amory_globals('display_socials')) { ?>
					
					<div class="blog_social"> <?php esc_html_e('Share: ','amory') . amory_socialLinkSingle(get_the_permalink(),get_the_title())  ?></div>
					<?php } ?>
					 <!-- end of socials -->
					
					<?php if(amory_globals('display_reading')) { ?>
					<div class="blog_time_read">
						<?php echo esc_html__('Reading time: ','amory') . esc_attr(amory_estimated_reading_time(get_the_ID())) . esc_html__(' min','amory') ; ?>
					</div>
					<?php } ?>
					<!-- end of reading -->
				</div> 
		
		<?php } ?> <!-- end of bottom blog -->
			</div>
			
			
		
</div>		
	</div>
