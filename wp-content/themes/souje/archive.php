<?php get_header();

/* Radio Default Values */
$souje_layout_style = get_theme_mod( 'souje_layout_style_archive', '1col_sidebar' );
/* */

/* Checkbox Default Values */
$souje_show_filter_word = get_theme_mod( 'souje_show_filter_word', 0 );
/* */

$souje_archiveSep = ' / ';
$souje_pageHeader = '';

if ( is_search() ) {

	if ( $souje_show_filter_word ) { $souje_pageHeader = souje_translation( '_SearchResults' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader .= esc_html( get_search_query( false ) );

} else if ( is_category() ) {

	$temp_title = '';
	if ( $souje_show_filter_word ) { $temp_title = souje_translation( '_Category' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader = single_cat_title( $temp_title, false );

} else if ( is_tag() ) {

	$temp_title = '';
	if ( $souje_show_filter_word ) { $temp_title = souje_translation( '_Tag' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader = single_tag_title( $temp_title, false );

} else if ( is_author() ) {

	the_post();
	if ( $souje_show_filter_word ) { $souje_pageHeader = souje_translation( '_Author' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader .= get_the_author();
	rewind_posts();

} else if ( is_day() ) {

	if ( $souje_show_filter_word ) { $souje_pageHeader = souje_translation( '_Archives' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader .= get_the_date();

} else if ( is_month() ) {

	if ( $souje_show_filter_word ) { $souje_pageHeader = souje_translation( '_Archives' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader .= get_the_date( 'F Y' );

} else if ( is_year() ) {

	if ( $souje_show_filter_word ) { $souje_pageHeader = souje_translation( '_Archives' ) . esc_html( $souje_archiveSep ); }
	$souje_pageHeader .= get_the_date( 'Y' );

} else {

	$souje_pageHeader = souje_translation( '_Archives' );

}

?>

		<div class="clearfix posts-wrapper main-container<?php echo souje_apply_layout(); ?>">

            	<?php if ( get_theme_mod( 'souje_show_filter', 1 ) ) { ?>
                    <div class="filter-bar">
                    	<div class="filter-bar-inner"><?php echo esc_attr( $souje_pageHeader ); ?></div>
                    </div>
                <?php } ?>

                <?php

                $souje_counter = 0;

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

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

                <?php souje_page_navigation(); ?>

		</div><!-- /main-container -->

    <?php /* Sidebar - Archive */

        if ( $souje_layout_style == '1col_sidebar' || $souje_layout_style == '2col_sidebar' || $souje_layout_style == '1_2col_sidebar' ) {

			$souje_s_type = 'home';
			if ( get_theme_mod( 'souje_enable_sidebar_archive', 0 ) ) { $souje_s_type = 'archive'; }
			souje_insert_sidebar( $souje_s_type );

        }

    ?>

</div><!-- /site-mid -->

<?php get_footer(); ?>
