<?php 
		/**
		 * Entry Content
		 * Output content of post for single and not single page
		 */ 
		?>
		<div class="cl-entry__content">
			<i class="cl-icon-quote-left"></i>
			
			<div class="post-quote-entry-inner clr">
        		<?php
        		// Content for single posts
        		if ( is_singular( 'post' ) ) : ?>
        			<div class="quote-entry-content">
        				<?php the_content(); ?>
        			</div><!-- .quote-entry-content -->
        		<?php else :
        			// Content for entries ?>
        			<div class="quote-entry-content">
						
        				<?php the_content(); ?>
        			</div><!-- .quote-entry-content -->
        		<?php endif; ?>
        	</div><!-- .post-quote-entry-inner -->
			
		</div><!-- .entry-content -->