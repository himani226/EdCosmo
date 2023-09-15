<?php get_header();
			
/* Radio Default Values */
$baxel_layout_style = get_theme_mod( 'baxel_layout_style', '1col_sidebar' );
/* */

?>

		<div class="clearfix posts-wrapper main-container<?php echo baxel_apply_layout(); ?>">            
            
            	<?php
				        
                $baxel_counter = 0;
				$baxel_hidden_cats = get_theme_mod( 'baxel_hidden_cats', '' );
				$baxel_hidden_posts = get_theme_mod( 'baxel_hidden_posts', '' );
				$hiddenPostIDs = explode( ',', esc_attr( $baxel_hidden_posts ) );
				
				$hiddenSliderPosts = implode( ',', baxel_exclude_posts_from_slider() );
				$hiddenCombinedPosts = $hiddenSliderPosts . ',' . esc_attr( $baxel_hidden_posts );
				$hiddenCombinedPostsArr = explode( ',', esc_attr( $hiddenCombinedPosts ) );
                            
                /* Hide the posts in the feed if "Show Blog Posts in Slider" option is chosen. - Optional */			
                if ( get_theme_mod( 'baxel_slider_exclude_posts', 0 ) ) {
													  
                    $indexLoop_args = array(
						'post_type' => 'post',
                        'post__not_in' =>  $hiddenCombinedPostsArr,
                        'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
                    );
                    
					if ( $baxel_hidden_cats ) {
						
						$getHiddenCatIDs = explode( ',', esc_attr( $baxel_hidden_cats ) );
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
                    
					if ( $baxel_hidden_cats ) {
						
						$getHiddenCatIDs = explode( ',', esc_attr( $baxel_hidden_cats ) );
						$indexLoop_shCats = array( 'category__not_in' => $getHiddenCatIDs );						
						$indexLoop_final = array_merge( $indexLoop_args, $indexLoop_shCats );
					
					} else {
						
						$indexLoop_final = $indexLoop_args;
						
					}
					                    
                    $indexPosts = new WP_Query( $indexLoop_final );
					
					if ( $baxel_hidden_cats ) {
					
						// Pagination fix
						$temp_query = $wp_query;
						$wp_query   = NULL;
						$wp_query   = $indexPosts;
					
					}
                    
                }
                
                $baxel_counter = 0;
    
                if ( $indexPosts->have_posts() ) :
                    while ( $indexPosts->have_posts() ) : $indexPosts->the_post();
                    
                    if ( $baxel_layout_style == '2col' || $baxel_layout_style == '2col_sidebar' ) {
                        
                        // Open & close row in every 2 entries for 2 columns layout
                            
                        if ( $baxel_counter % 2 == 0 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-2 clearfix">
                        
                    <?php }
                                
                        get_template_part( 'content', get_post_format() );
                        $baxel_counter += 1;
                                
                        if ( $baxel_counter % 2 == 0 || $baxel_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $baxel_layout_style == '1_2col_sidebar' ) {
                        
                        // Open & close row for the first entry and then in every 2 entries for 1 + 2 columns layout
						
						if ( $baxel_counter == 0 ) {
							
							$baxel_thumbnail_situation = 0; ?>
                        
                        	<!-- row -->
                            <div class="row-1-1-2 clearfix">
                            
                     	<?php } else {
							
                            $baxel_thumbnail_situation = 1;
							
							if ( $baxel_counter % 2 == 1 ) { ?>
							
								<!-- row -->
								<div class="row-1-2 clearfix">
							
						<?php }
					
						}
                                
                        get_template_part( 'content', get_post_format() );
                        $baxel_counter += 1;
                                
                        if ( $baxel_counter == 1 || $baxel_counter % 2 == 1 || $baxel_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $baxel_layout_style == '3col' ) {
                        
                        // Open & close row in every 3 entries for 3 columns layout
                            
                        if ( $baxel_counter % 3 == 0 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-3 clearfix">
                        
                    <?php }
                                
                        get_template_part( 'content', get_post_format() );
                        $baxel_counter += 1;
                                
                        if ( $baxel_counter % 3 == 0 || $baxel_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else if ( $baxel_layout_style == '2_3col' ) {
                        
                        // Open & close row for the first 2 entries and then in every 3 entries for 3 columns layout
						
						if ( $baxel_counter == 0 ) { ?>
                        
                        	<!-- row -->
                            <div class="row-2-3 clearfix">
                            
                     	<?php } else {
                            
                        if ( $baxel_counter % 3 == 2 ) { ?>
                        
                            <!-- row -->
                            <div class="row-1-3 clearfix">
                        
                    <?php }
					
						}
                                
                        get_template_part( 'content', get_post_format() );
                        $baxel_counter += 1;
                                
                        if ( $baxel_counter == 2 || $baxel_counter % 3 == 2 || $baxel_counter == $wp_query->post_count ) { ?>
                        
                            </div><!-- /row -->
                                        
                    <?php }
                    
                    } else {
                        
                        get_template_part( 'content', get_post_format() );
                        $baxel_counter += 1;
                        
                    }
                                    
                    endwhile;
                    
                else :
                    
                echo baxel_nothing_found();
                    
                endif;
                
                wp_reset_postdata();
                    
                ?>
                                                                
                <?php
                
                baxel_page_navigation();
				
				if ( get_theme_mod( 'baxel_slider_exclude_posts', 0 ) || $baxel_hidden_cats ) {
                
                    // Reset main query object
                    $wp_query = NULL;
                    $wp_query = $temp_query;
                
                }
								
				?>
            
		</div><!-- /main-container -->
        
    <?php /* Sidebar - Home */
    if ( $baxel_layout_style == '1col_sidebar' || $baxel_layout_style == '2col_sidebar' || $baxel_layout_style == '1_2col_sidebar' ) { baxel_insert_sidebar( 'home' ); } /* /Sidebar - Home */?>
    
</div><!-- /site-mid -->

<?php get_footer(); ?>