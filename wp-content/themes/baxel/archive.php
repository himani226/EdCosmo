<?php get_header();

/* Radio Default Values */
$baxel_layout_style = get_theme_mod( 'baxel_layout_style_archive', '1col_sidebar' );
/* */

/* Checkbox Default Values */
$baxel_show_filter_word = get_theme_mod( 'baxel_show_filter_word', 1 );
/* */

$baxel_archiveSep = ' / ';
$baxel_pageHeader = '';

if ( is_search() ) {

	if ( $baxel_show_filter_word ) { $baxel_pageHeader = baxel_translation( '_SearchResults' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader .= esc_html( get_search_query( false ) );

} else if ( is_category() ) {

	$temp_title = '';
	if ( $baxel_show_filter_word ) { $temp_title = baxel_translation( '_Category' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader = single_cat_title( $temp_title, false );

} else if ( is_tag() ) {

	$temp_title = '';
	if ( $baxel_show_filter_word ) { $temp_title = baxel_translation( '_Tag' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader = single_tag_title( $temp_title, false );

} else if ( is_author() ) {

	the_post();
	if ( $baxel_show_filter_word ) { $baxel_pageHeader = baxel_translation( '_Author' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader .= get_the_author();
	rewind_posts();

} else if ( is_day() ) {

	if ( $baxel_show_filter_word ) { $baxel_pageHeader = baxel_translation( '_Archives' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader .= get_the_date();

} else if ( is_month() ) {

	if ( $baxel_show_filter_word ) { $baxel_pageHeader = baxel_translation( '_Archives' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader .= get_the_date( 'F Y' );

} else if ( is_year() ) {

	if ( $baxel_show_filter_word ) { $baxel_pageHeader = baxel_translation( '_Archives' ) . esc_html( $baxel_archiveSep ); }
	$baxel_pageHeader .= get_the_date( 'Y' );

} else {

	$baxel_pageHeader = baxel_translation( '_Archives' );

}

?>

		<div class="clearfix posts-wrapper main-container<?php echo baxel_apply_layout(); ?>">

            	<?php if ( get_theme_mod( 'baxel_show_filter', 1 ) ) { ?>
                    <div class="filter-bar">
                    	<div class="filter-bar-inner"><?php echo esc_attr( $baxel_pageHeader ); ?></div>
                    </div>
                <?php } ?>

                <?php

                $baxel_counter = 0;

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();

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

                <?php baxel_page_navigation(); ?>

		</div><!-- /main-container -->

    <?php /* Sidebar - Archive */

        if ( $baxel_layout_style == '1col_sidebar' || $baxel_layout_style == '2col_sidebar' || $baxel_layout_style == '1_2col_sidebar' ) {

			$baxel_s_type = 'home';
			if ( get_theme_mod( 'baxel_enable_sidebar_archive', 0 ) ) { $baxel_s_type = 'archive'; }
			baxel_insert_sidebar( $baxel_s_type );

        }

    ?>

</div><!-- /site-mid -->

<?php get_footer(); ?>
