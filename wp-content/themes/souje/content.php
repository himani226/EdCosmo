<?php

/* Checkbox Default Values */
$souje_featured_image_standard = get_theme_mod( 'souje_featured_image_standard', 1 );
$souje_show_date = get_theme_mod( 'souje_show_date_indexed', 1 );
$souje_show_comments_icon = get_theme_mod( 'souje_show_comments_icon_indexed', 1 );
$souje_show_author = get_theme_mod( 'souje_show_author_indexed', 1 );
$souje_show_categories = get_theme_mod( 'souje_show_categories_indexed', 1 );
if ( is_single() ) {
	$souje_show_date = get_theme_mod( 'souje_show_date', 1 );
	$souje_show_comments_icon = get_theme_mod( 'souje_show_comments_icon', 1 );
	$souje_show_author = get_theme_mod( 'souje_show_author', 1 );
	$souje_show_categories = get_theme_mod( 'souje_show_categories', 1 );
}
/* */

/* Radio Default Values */
$souje_layout_style = get_theme_mod( 'souje_layout_style', '1col_sidebar' );
if ( is_archive() ) {
	$souje_layout_style = get_theme_mod( 'souje_layout_style_archive', '1col_sidebar' );
}
/* */

/* Thumbnail Choice */
if ( $souje_layout_style == '1col' || $souje_layout_style == '1col_sidebar' ) {
	$souje_thumbnail_choice = 0;
} else if ( $souje_layout_style == '1_2col_sidebar' ) {
	global $souje_thumbnail_situation;
	$souje_thumbnail_choice = $souje_thumbnail_situation;
} else {
	$souje_thumbnail_choice = 1;
}
/* */

$souje_min_post_height = get_theme_mod( 'souje_min_post_height', 0 );
$meta_woi = get_post_meta( get_the_ID(), 'souje-woi-meta-box-checkbox', true );

?>

<?php if ( !is_single() && souje_apply_columns() ) { echo '<div class="' . souje_apply_columns() . '">'; } ?>
	<article <?php post_class( 'clearfix' ); if ( !is_single() && !souje_check_style_z() && $souje_min_post_height ) { echo 'style="min-height: ' . esc_attr( $souje_min_post_height ) . 'px;"'; } ?>>
		<?php if ( souje_check_style_z() ) { ?>
            <a class="post-styleZ clearfix" href="<?php esc_url( the_permalink() ); ?>">
				<?php if ( has_post_thumbnail() ) { echo the_post_thumbnail( 'souje-thumbnail-image', array( 'class' => 'fading' ) ); } ?>
                <div class="post-styleZ-inner<?php if ( has_post_thumbnail() ) { echo '-with-t'; } ?>">
                	<div class="table-cell-middle">
                        <h2 class="post-styleZ-title"><?php the_title(); ?></h2>
                        <div class="post-styleZ-arrow"><i class="fa fa-long-arrow-right"></i></div>
                    </div>
                </div>
            </a>
        <?php } else { ?>
            <?php if ( has_post_thumbnail() ) { ?>
				<?php if ( is_single() ) { ?>
                    <?php if ( $souje_featured_image_standard && !$meta_woi ) { ?>
                        <div class="article-featured-image"><?php the_post_thumbnail(); ?></div>
                	<?php }
                } else { ?>
                	<div class="article-featured-image">
                        <a href="<?php esc_url( the_permalink() ); ?>">
                            <?php if ( $souje_thumbnail_choice ) {
                            	the_post_thumbnail( 'souje-thumbnail-image' );
                            } else {
	                            the_post_thumbnail();
                            } ?>
                        </a>
                    </div>
                <?php }
            } ?>
            <div class="article-content-outer<?php echo souje_apply_layout(); ?>">
                <div class="article-content-inner">
                	<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
                        <div class="sticky-icon"><?php echo esc_attr( souje_translation( '_Sticky' ) ); ?></div>
                    <?php } ?>
                    <?php if ( is_single() ) { ?><h1 class="article-title"><?php the_title(); ?></h1><?php } else { ?><h2 class="article-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2><?php } ?>
                    <?php if ( $souje_show_date ) { ?>
                        <div class="article-date-outer"><?php if ( is_single() ) { ?><span class="article-date"><?php echo get_the_date(); ?></span><?php } else { ?><a class="article-date" href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_date(); ?></a><?php } ?></div>
                    <?php } ?>
                    <?php if ( $souje_show_author ) { ?>
                        <a class="article-author-outer" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
                            <div class="article-author"><?php echo esc_attr( souje_translation( '_By' ) ); ?> <?php the_author(); ?></div>
                        </a>
                    <?php } ?>
					<?php if ( $souje_show_comments_icon && comments_open() ) { ?>
                        <a class="article-comments-outer" href="<?php esc_url( the_permalink() ); ?>#comments">
                            <div class="article-comments-icon fading"><i class="fa fa-comment"></i></div>
                            <div class="article-comments-number fading"><?php comments_number( '0 ' . esc_attr( souje_translation( '_Comments' ) ), '1 ' . esc_attr( souje_translation( '_Comment' ) ), '% ' . esc_attr( souje_translation( '_Comments' ) ) ); ?></div>
                        </a>
                    <?php } ?>
                    <?php if ( is_single() ) { ?>
                        <div class="article-pure-content clearfix"><?php the_content(); ?></div>
                    <?php } else { ?>
                        <?php echo souje_append_excerpt(); ?>
                    <?php }
					get_template_part( 'social-bar' );
                    get_template_part( 'pager-bar' );
                    if ( $souje_show_categories ) {
                        if ( get_the_category() ) { get_template_part( 'category-bar' ); }
                        the_tags( '<div class="category-bar tag-only">', ', ', '</div>' );
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
	</article>
<?php if ( !is_single() && souje_apply_columns() ) { echo '</div>'; } ?>
