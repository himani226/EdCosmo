<?php

$slider_data = codeless_post_galleries_data( get_post( get_the_ID() )); 

?>
<div class="cl-entry__media">
    <?php if( codeless_get_mod( 'blog_style', 'default' ) == 'simple-no_content' ): ?>
		<div class="cl-entry__categories"><?php echo get_the_category_list( ' ' ) ?></div>
	<?php endif; ?>
    <div class="cl-entry__gallery">
        <!-- Slider main container -->
        <div id="cl-owl-carousel-<?php the_ID() ?>" class="owl-carousel owl-theme cl-carousel" data-carousel-nav="1" data-carousel-dots="1">
            
                <!-- Slides -->
                <?php
                    
                    // Generate Slide
                    if( is_array( $slider_data ) && ! empty( $slider_data['image_ids'] ) ):
                        foreach( $slider_data['image_ids'] as $attachment_id ):
                            echo '<div class="cl-entry__slide">';
                                echo '<img src="'.codeless_get_attachment_image_src( $attachment_id, codeless_get_post_thumbnail_size() ).'" alt="'.esc_attr__('Slider Image', 'thype').'" />';
                                
                                    
                            echo '</div><!-- .cl-entry__slide --> ';
                        endforeach;
                    endif;
                    
                    
                ?>

        </div><!-- .cl-carousel -->
        
    </div><!-- .cl-entry__gallery -->
</div><!-- .cl-entry__media --> 