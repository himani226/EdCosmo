<?php get_header();

	/* Checkbox Default Values */
	$souje_show_sidebar_static = get_theme_mod( 'souje_show_sidebar_static', 1 );
	$souje_show_sidebar_page = get_theme_mod( 'souje_show_sidebar_page', 1 );
	$souje_show_page_comments = get_theme_mod( 'souje_show_page_comments', 1 );
	/* */

	?>
	<div class="main-container<?php echo souje_apply_layout(); ?>">
    	<article <?php post_class( 'clearfix' ); ?>>

			<?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();

				$meta_sidebar = get_post_meta( get_the_ID(), 'souje-sidebar-meta-box-checkbox', true ); ?>

				<?php if ( get_theme_mod( 'souje_map_page_id' ) == get_the_ID() ) { ?>
                    <div id="googleMap"></div>
                <?php } else {
                    ?><div class="article-featured-image"><?php the_post_thumbnail(); ?></div><?php
                } ?>
                <div class="article-content-outer<?php echo souje_apply_layout(); ?>">
                    <div class="article-content-inner">
                    	<h1 class="article-title"><?php the_title(); ?></h1>
                        <div class="article-pure-content clearfix"><?php the_content(); ?></div>
                        <?php
												if ( function_exists( 'WC' ) ) { if ( !is_cart() && !is_checkout() && !is_account_page() ) { get_template_part( 'social-bar' ); } }
                        get_template_part( 'pager-bar' );
                        ?>
                    </div>
                </div>

            <?php

            endwhile;

            else :

                echo souje_nothing_found();

            endif; ?>

        </article>
        <?php if ( $souje_show_page_comments ) { comments_template(); } ?>
	</div><!-- /main-container -->

    <!-- sidebar -->

    <?php

		if ( function_exists( 'WC' ) && ( is_cart() || is_checkout() || is_account_page() ) ) {

			// Hide Sidebar on WooCommerce Pages

		} else {

			$souje_s_type = 'home';

			if ( is_front_page() ) {

				if ( $souje_show_sidebar_static && !$meta_sidebar ) {

					if ( get_theme_mod( 'souje_enable_sidebar_static', 0 ) ) { $souje_s_type = 'static'; }
					souje_insert_sidebar( $souje_s_type );

				}

			} else {

				if ( $souje_show_sidebar_page && !$meta_sidebar ) {

					if ( get_theme_mod( 'souje_enable_sidebar_page', 0 ) ) { $souje_s_type = 'page'; }
					souje_insert_sidebar( $souje_s_type );

				}

			}

		}

    ?>

    <!-- /sidebar -->

</div><!-- /site-mid -->

<?php get_footer(); ?>
