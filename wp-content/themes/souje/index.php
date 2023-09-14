<?php get_header();
			
/* Radio Default Values */
$souje_layout_style = get_theme_mod( 'souje_layout_style', '1col_sidebar' );
/* */

?>

		<div class="clearfix posts-wrapper main-container<?php echo souje_apply_layout(); ?>">            
            
            	<?php
				        
                $souje_counter = 0;
				$souje_hidden_cats = get_theme_mod( 'souje_hidden_cats', '' );
				$souje_hidden_posts = get_theme_mod( 'souje_hidden_posts', '' );
				$hiddenPostIDs = explode( ',', esc_attr( $souje_hidden_posts ) );
				
				$hiddenSliderPosts = implode( ',', souje_exclude_posts_from_slider() );
				$hiddenCombinedPosts = $hiddenSliderPosts . ',' . esc_attr( $souje_hidden_posts );
				$hiddenCombinedPostsArr = explode( ',', esc_attr( $hiddenCombinedPosts ) );
                            
                /* Hide the posts in the feed if "Show Blog Posts in Slider" option is chosen. - Optional */			
                if ( get_theme_mod( 'souje_slider_exclude_posts', 0 ) ) {
													  
                    $indexLoop_args = array(
						'post_type' => 'post',
                        'post__not_in' =>  $hiddenCombinedPostsArr,
                        'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
                    );
                    
					if ( $souje_hidden_cats ) {
						
						$getHiddenCatIDs = explode( ',', esc_attr( $souje_hidden_cats ) );
						$indexLoop_shCats = array( 'category__not_in' => $getHiddenCatIDs );						
						$indexLoop_final = array_merge( $indexLoop_args, $indexLoop_shCats );
					
					} else {
						
						$indexLoop_final = $indexLoop_args;
						
					}
                    
                    $indexPosts = new WP_Query( $indexLoop_final );
                    
                    // Pagination fix
                    $temp_query = $wp_query;
                    $wp_query   = NULL;
                    $wp_query   = $indexPosts;
                    
                } else {

                    $indexLoop_args = array(
						'post_type' => 'post',
						'post__not_in' => $hiddenPostIDs,
                        'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
                    );
                    
					if ( $souje_hidden_cats ) {
						
						$getHiddenCatIDs = explode( ',', esc_attr( $souje_hidden_cats ) );
						$indexLoop_shCats = array( 'category__not_in' => $getHiddenCatIDs );						
						$indexLoop_final = array_merge( $indexLoop_args, $indexLoop_shCats );
					
					} else {
						
						$indexLoop_final = $indexLoop_args;
						
					}
					                    
                    $indexPosts = new WP_Query( $indexLoop_final );
					
					if ( $souje_hidden_cats ) {
					
						// Pagination fix
						$temp_query = $wp_query;
						$wp_query   = NULL;
						$wp_query   = $indexPosts;
					
					}
                    
                }
                
                $souje_counter = 0;
    
                if ( $indexPosts->have_posts() ) :
                    while ( $indexPosts->have_posts() ) : $indexPosts->the_post();
                    
                    if ( $souje_layout_style == '2col' || $souje_layout_style == '2col_sidebar' ) {
                        
                        // Open & close row in every 2 entries for 2 columns layout
                            
                        if ( $souje_counter % 2 == 0 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-2 clearfix">
                        
                    <?php }
                                
                        get_template_part( 'content', get_post_format() );
                        $souje_counter += 1;
                                
                        if ( $souje_counter % 2 == 0 || $souje_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $souje_layout_style == '1_2col_sidebar' ) {
                        
                        // Open & close row for the first entry and then in every 2 entries for 1 + 2 columns layout
						
						if ( $souje_counter == 0 ) {
							
							$souje_thumbnail_situation = 0; ?>
                        
                        	<!-- row -->
                            <div class="row-1-1-2 clearfix">
                            
                     	<?php } else {
							
                            $souje_thumbnail_situation = 1;
							
							if ( $souje_counter % 2 == 1 ) { ?>
							
								<!-- row -->
								<div class="row-1-2 clearfix">
							
						<?php }
					
						}
                                
                        get_template_part( 'content', get_post_format() );
                        $souje_counter += 1;
                                
                        if ( $souje_counter == 1 || $souje_counter % 2 == 1 || $souje_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $souje_layout_style == '3col' ) {
                        
                        // Open & close row in every 3 entries for 3 columns layout
                            
                        if ( $souje_counter % 3 == 0 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-3 clearfix">
                        
                    <?php }
                                
                        get_template_part( 'content', get_post_format() );
                        $souje_counter += 1;
                                
                        if ( $souje_counter % 3 == 0 || $souje_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $souje_layout_style == '2_3col' ) {
                        
                        // Open & close row for the first 2 entries and then in every 3 entries for 3 columns layout
						
						if ( $souje_counter == 0 ) { ?>
                        
                        	<!-- row -->
                            <div class="row-2-3 clearfix">
                            
                     	<?php } else {
                            
                        if ( $souje_counter % 3 == 2 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-3 clearfix">
                        
                    <?php }
					
						}
                                
                        get_template_part( 'content', get_post_format() );
                        $souje_counter += 1;
                                
                        if ( $souje_counter == 2 || $souje_counter % 3 == 2 || $souje_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else {
                        
                        get_template_part( 'content', get_post_format() );
                        $souje_counter += 1;
                        
                    }
                                    
                    endwhile;
                    
                else :
                    
                echo souje_nothing_found();
                    
                endif;
                
                wp_reset_postdata();
                    
                ?>
                                                                
                <?php
                
                souje_page_navigation();
				
				if ( get_theme_mod( 'souje_slider_exclude_posts', 0 ) || $souje_hidden_cats ) {
                
                    // Reset main query object
                    $wp_query = NULL;
                    $wp_query = $temp_query;
                
                }
								
				?>
            
		</div><!-- /main-container -->
        
    <?php /* Sidebar - Home */
    if ( $souje_layout_style == '1col_sidebar' || $souje_layout_style == '2col_sidebar' || $souje_layout_style == '1_2col_sidebar' ) { souje_insert_sidebar( 'home' ); } /* /Sidebar - Home */?>
    
</div><!-- /site-mid -->

<?php get_footer(); ?>