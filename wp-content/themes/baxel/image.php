<?php get_header(); ?>

        <div class="clearfix main-container<?php echo baxel_apply_layout(); ?>">            
    
            <?php 
            if ( have_posts() ) :
                while ( have_posts() ) : the_post(); ?>
                
                    <article <?php post_class(); ?>>
                        <div class="article-inner clearfix table-cell-middle">                        
                            <?php echo wp_get_attachment_image( $post->ID, 'large' ); ?>    
                        </div>
                    </article>
                                
                <?php endwhile;
                
                else :
                
                echo baxel_nothing_found();
                
                endif; ?>
                        
        </div><!-- /main-container -->
                    
</div><!-- /site-mid -->
	
<?php get_footer(); ?>