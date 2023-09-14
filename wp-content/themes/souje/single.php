<?php get_header();

		/* Checkbox Default Values */
		$souje_show_related_posts = get_theme_mod( 'souje_show_related_posts', 1 );
		$souje_show_post_comments = get_theme_mod( 'souje_show_post_comments', 1 );
		$souje_show_sidebar_standard = get_theme_mod( 'souje_show_sidebar_standard', 1 );
		$souje_show_sidebar_gallery = get_theme_mod( 'souje_show_sidebar_gallery', 1 );
		$souje_show_sidebar_video = get_theme_mod( 'souje_show_sidebar_video', 1 );
		/* */

		/* Radio Default Values */
		$souje_related_post_base = get_theme_mod( 'souje_related_post_base', 'tag' );
		$souje_related_post_count = get_theme_mod( 'souje_related_post_count', 2 );
		/* */

		$souje_current_layout = souje_apply_layout();

		?>

    	<div class="main-container<?php echo esc_attr( $souje_current_layout ); ?>">

				<?php

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                    if ( function_exists( 'souje_set_post_views' ) ) { souje_set_post_views( get_the_ID() ); }
										$meta_sidebar = get_post_meta( get_the_ID(), 'souje-sidebar-meta-box-checkbox', true );

                    get_template_part( 'content', get_post_format() );

                    endwhile;

                    else :

                    echo souje_nothing_found();

                    endif;

					?>

                    <div class="post-navi clearfix">
                    	<?php
						echo souje_post_navigation( 'prev', get_adjacent_post( false, '', true ), souje_translation( '_PrevPost' ) );
						echo souje_post_navigation( 'next', get_adjacent_post( false, '', false ), souje_translation( '_NextPost' ) );
						?>
                    </div>

                    <?php

                    echo souje_author_box();

					$souje_orig_post = $post;
					global $post;
					$souje_tags = wp_get_post_tags( $post->ID );
					$souje_cats = wp_get_post_categories( $post->ID );
					$souje_author_id = get_the_author_meta( 'ID' );
					$souje_RPBaseTermIDs = '';

					if ( $souje_related_post_base == 'tag' ) { $souje_RPBaseTermIDs = $souje_tags; } else if ( $souje_related_post_base == 'category' ) { $souje_RPBaseTermIDs = $souje_cats; }

					if ( $souje_RPBaseTermIDs || $souje_related_post_base == 'author' || $souje_related_post_base == 'random' ) {

						if ( $souje_related_post_base == 'tag' ) {

							$souje_tag_ids = array();
							foreach ( $souje_tags as $souje_individual_tag ) { $souje_tag_ids[] = $souje_individual_tag->term_id; }

							$args = array(
								'tag__in' => $souje_tag_ids,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $souje_related_post_count,
								'ignore_sticky_posts' => 1

							);

						} else if ( $souje_related_post_base == 'category' ) {

							$souje_cat_ids = array();
							foreach ( $souje_cats as $souje_individual_cat ) { $cat = get_category( $souje_individual_cat ); $souje_cat_ids[] = $cat->term_id; }

							$args = array(
								'category__in' => $souje_cat_ids,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $souje_related_post_count,
								'ignore_sticky_posts' => 1

							);

						} else if ( $souje_related_post_base == 'author' ) {

							$args = array(
								'author' => $souje_author_id,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $souje_related_post_count,
								'ignore_sticky_posts' => 1

							);

						} else if ( $souje_related_post_base == 'random' ) {

							$args = array(
								'orderby' => 'rand',
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $souje_related_post_count,
								'ignore_sticky_posts' => 1

							);

						}

						$related_posts_query = new wp_query( $args );
						$souje_counter = 0;
						if ( $souje_related_post_count == 2 || $souje_related_post_count == 4 ) { $souje_rpCol = 2; } else { $souje_rpCol = 3; }

						if ( $souje_show_related_posts && $related_posts_query->have_posts() ) { ?>

							<!-- related-posts -->
							<div class="related-posts">

                            	<h2><?php echo esc_attr( souje_translation( '_RelatedPosts' ) ); ?></h2>

                                <?php

                                while( $related_posts_query->have_posts() ) {
                                    $related_posts_query->the_post();

                                    if ( $souje_counter % $souje_rpCol == 0 ) {

                                        ?><!-- related-posts-row -->
                                        <div class="clearfix related-posts-row<?php echo esc_attr( $souje_current_layout ); ?>"><?php

                                    } ?>

                                            <a class="clearfix related-post-item<?php if ( $souje_rpCol == 2 ) { echo '-2'; } echo esc_attr( $souje_current_layout ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
												<?php the_post_thumbnail( 'souje-thumbnail-image' ); ?>
                                                <div class="post-widget-container fading">
                                                	<div class="post-widget-date"><?php echo get_the_date(); ?></div>
	                                                <div class="post-widget-title"><?php the_title(); ?></div>
                                                </div>
                                            </a>

                                    <?php

                                    $souje_counter += 1;

                                    if ( $souje_counter % $souje_rpCol == 0 || $souje_counter == $related_posts_query->post_count ) { ?>

                                        </div><!-- /related-posts-row -->

                                    <?php }

                                }

                                $post = $souje_orig_post;
                                wp_reset_postdata();

                                ?>

							</div><!-- /related-posts -->

					<?php }

				}

				if ( $souje_show_post_comments ) { comments_template(); }

				?>

		</div><!-- /main-container -->

    <!-- sidebar -->
    <?php

		if ( !$meta_sidebar && ( ( ( get_post_format() == '' || get_post_format() == 'aside' ) && $souje_show_sidebar_standard ) || ( get_post_format() == 'video' && $souje_show_sidebar_video ) || ( get_post_format() == 'gallery' && $souje_show_sidebar_gallery ) ) ) {

            $souje_s_type = 'home';
			if ( get_theme_mod( 'souje_enable_sidebar_post', 0 ) ) { $souje_s_type = 'post'; }
			souje_insert_sidebar( $souje_s_type );

        }

    ?>
    <!-- /sidebar -->

</div><!-- /site-mid -->

<?php get_footer(); ?>
