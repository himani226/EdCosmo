<?php get_header();

		/* Checkbox Default Values */
		$baxel_show_related_posts = get_theme_mod( 'baxel_show_related_posts', 1 );
		$baxel_show_post_comments = get_theme_mod( 'baxel_show_post_comments', 1 );
		$baxel_show_sidebar_standard = get_theme_mod( 'baxel_show_sidebar_standard', 1 );
		$baxel_show_sidebar_gallery = get_theme_mod( 'baxel_show_sidebar_gallery', 1 );
		$baxel_show_sidebar_video = get_theme_mod( 'baxel_show_sidebar_video', 1 );
		/* */

		/* Radio Default Values */
		$baxel_related_post_base = get_theme_mod( 'baxel_related_post_base', 'tag' );
		$baxel_related_post_count = get_theme_mod( 'baxel_related_post_count', 3 );
		/* */

		$baxel_current_layout = baxel_apply_layout();

		?>

    	<div class="main-container<?php echo esc_attr( $baxel_current_layout ); ?>">

				<?php

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

                    if ( function_exists( 'baxel_set_post_views' ) ) { baxel_set_post_views( get_the_ID() ); }
										$meta_sidebar = get_post_meta( get_the_ID(), 'baxel-sidebar-meta-box-checkbox', true );

                    get_template_part( 'content', get_post_format() );

                    endwhile;

                    else :

                    echo baxel_nothing_found();

                    endif;

					?>

                    <div class="post-navi clearfix">
                    	<?php
						echo baxel_post_navigation( 'prev', get_adjacent_post( false, '', true ), baxel_translation( '_PrevPost' ) );
						echo baxel_post_navigation( 'next', get_adjacent_post( false, '', false ), baxel_translation( '_NextPost' ) );
						?>
                    </div>

                    <?php

                    echo baxel_author_box();

					$baxel_orig_post = $post;
					global $post;
					$baxel_tags = wp_get_post_tags( $post->ID );
					$baxel_cats = wp_get_post_categories( $post->ID );
					$baxel_author_id = get_the_author_meta( 'ID' );
					$baxel_RPBaseTermIDs = '';

					if ( $baxel_related_post_base == 'tag' ) { $baxel_RPBaseTermIDs = $baxel_tags; } else if ( $baxel_related_post_base == 'category' ) { $baxel_RPBaseTermIDs = $baxel_cats; }

					if ( $baxel_RPBaseTermIDs || $baxel_related_post_base == 'author' || $baxel_related_post_base == 'random' ) {

						if ( $baxel_related_post_base == 'tag' ) {

							$baxel_tag_ids = array();
							foreach ( $baxel_tags as $baxel_individual_tag ) { $baxel_tag_ids[] = $baxel_individual_tag->term_id; }

							$args = array(
								'tag__in' => $baxel_tag_ids,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $baxel_related_post_count,
								'ignore_sticky_posts' => 1

							);

						} else if ( $baxel_related_post_base == 'category' ) {

							$baxel_cat_ids = array();
							foreach ( $baxel_cats as $baxel_individual_cat ) { $cat = get_category( $baxel_individual_cat ); $baxel_cat_ids[] = $cat->term_id; }

							$args = array(
								'category__in' => $baxel_cat_ids,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $baxel_related_post_count,
								'ignore_sticky_posts' => 1

							);

						} else if ( $baxel_related_post_base == 'author' ) {

							$args = array(
								'author' => $baxel_author_id,
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $baxel_related_post_count,
								'ignore_sticky_posts' => 1

							);

						} else if ( $baxel_related_post_base == 'random' ) {

							$args = array(
								'orderby' => 'rand',
								'post__not_in' => array( $post->ID ),
								'posts_per_page' => $baxel_related_post_count,
								'ignore_sticky_posts' => 1

							);

						}

						$related_posts_query = new wp_query( $args );
						$baxel_counter = 0;
						if ( $baxel_related_post_count == 2 || $baxel_related_post_count == 4 ) { $baxel_rpCol = 2; } else { $baxel_rpCol = 3; }

						if ( $baxel_show_related_posts && $related_posts_query->have_posts() ) { ?>

							<!-- related-posts -->
							<div class="related-posts">

                            	<h2><?php echo esc_attr( baxel_translation( '_RelatedPosts' ) ); ?></h2>

                                <?php

                                while( $related_posts_query->have_posts() ) {
                                    $related_posts_query->the_post();

                                    if ( $baxel_counter % $baxel_rpCol == 0 ) {

                                        ?><!-- related-posts-row -->
                                        <div class="clearfix related-posts-row<?php echo esc_attr( $baxel_current_layout ); ?>"><?php

                                    } ?>

                                            <a class="clearfix related-post-item<?php if ( $baxel_rpCol == 2 ) { echo '-2'; } echo esc_attr( $baxel_current_layout ); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>">
												<?php the_post_thumbnail( 'baxel-thumbnail-image' ); ?>
                                                <div class="post-widget-container fading">
	                                                <div class="post-widget-title"><?php the_title(); ?></div>
                                                </div>
                                            </a>

                                    <?php

                                    $baxel_counter += 1;

                                    if ( $baxel_counter % $baxel_rpCol == 0 || $baxel_counter == $related_posts_query->post_count ) { ?>

                                        </div><!-- /related-posts-row -->

                                    <?php }

                                }

                                $post = $baxel_orig_post;
                                wp_reset_postdata();

                                ?>

							</div><!-- /related-posts -->

					<?php }

				}

				if ( $baxel_show_post_comments ) { comments_template(); }

				?>

		</div><!-- /main-container -->

    <!-- sidebar -->
    <?php

		if ( !$meta_sidebar && ( ( ( get_post_format() == '' || get_post_format() == 'aside' ) && $baxel_show_sidebar_standard ) || ( get_post_format() == 'video' && $baxel_show_sidebar_video ) || ( get_post_format() == 'gallery' && $baxel_show_sidebar_gallery ) ) ) {

            $baxel_s_type = 'home';
			if ( get_theme_mod( 'baxel_enable_sidebar_post', 0 ) ) { $baxel_s_type = 'post'; }
			baxel_insert_sidebar( $baxel_s_type );

        }

    ?>
    <!-- /sidebar -->

</div><!-- /site-mid -->

<?php get_footer(); ?>
