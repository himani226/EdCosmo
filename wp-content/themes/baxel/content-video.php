<?php

/* Checkbox Default Values */
$baxel_show_date = get_theme_mod( 'baxel_show_date_indexed', 1 );
$baxel_show_author = get_theme_mod( 'baxel_show_author_indexed', 1 );
$baxel_show_categories = get_theme_mod( 'baxel_show_categories_indexed', 1 );
if ( is_single() ) {
	$baxel_show_date = get_theme_mod( 'baxel_show_date', 1 );
	$baxel_show_author = get_theme_mod( 'baxel_show_author', 1 );
	$baxel_show_categories = get_theme_mod( 'baxel_show_categories', 1 );
}
/* */

/* Radio Default Values */
$baxel_featured_image_video = get_theme_mod( 'baxel_featured_image_video', 'vid' );
$baxel_layout_style = get_theme_mod( 'baxel_layout_style', '1col_sidebar' );
if ( is_archive() ) {
	$baxel_layout_style = get_theme_mod( 'baxel_layout_style_archive', '1col_sidebar' );
}
/* */

/* Thumbnail Choice */
if ( $baxel_layout_style == '1col' || $baxel_layout_style == '1col_sidebar' ) {
	$baxel_thumbnail_choice = 0;
} else if ( $baxel_layout_style == '1_2col_sidebar' ) {
	global $baxel_thumbnail_situation;
	$baxel_thumbnail_choice = $baxel_thumbnail_situation;
} else {
	$baxel_thumbnail_choice = 1;
}
/* */

$baxel_min_post_height = get_theme_mod( 'baxel_min_post_height', 0 );
$meta_woi = get_post_meta( get_the_ID(), 'baxel-woi-meta-box-checkbox', true );

?>

<?php if ( !is_single() && baxel_apply_columns() ) { echo '<div class="' . baxel_apply_columns() . '">'; } ?>
	<article <?php post_class( 'clearfix' ); if ( !is_single() && !baxel_check_style_z() && $baxel_min_post_height ) { echo 'style="min-height: ' . esc_attr( $baxel_min_post_height ) . 'px;"'; } ?>>
    	<?php if ( baxel_check_style_z() ) { ?>
            <a class="post-styleZ clearfix" href="<?php esc_url( the_permalink() ); ?>">
				<?php if ( has_post_thumbnail() ) { echo the_post_thumbnail( 'baxel-style-z-image', array( 'class' => 'fading' ) ); } ?>
                <div class="post-styleZ-inner<?php if ( has_post_thumbnail() ) { echo '-with-t'; } ?>">
                	<div class="table-cell-middle">
                        <?php if ( $baxel_show_date ) { ?><div class="post-styleZ-date"><?php echo get_the_date(); ?></div><?php } ?>
                        <h2 class="post-styleZ-title"><?php the_title(); ?></h2>
                    </div>
                </div>
            </a>
        <?php } else { ?>
            <?php
            $baxel_videos = baxel_featured_video();
            if ( $baxel_videos ) {
                if ( is_single() ) {
                    echo baxel_featured_video();
                } else {
                    if ( $baxel_featured_image_video == 'vid' ) {
                        echo baxel_featured_video();
                    } else if ( $baxel_featured_image_video == 'fea' ) { ?>
                        <div class="article-featured-image">
                            <a href="<?php esc_url( the_permalink() ); ?>">
                                <?php if ( $baxel_thumbnail_choice ) {
                                    the_post_thumbnail( 'baxel-thumbnail-image' );
                                } else {
                                    the_post_thumbnail();
                                } ?>
                            </a>
                        </div>
                    <?php }
                }
            } else {
				if ( is_single() ) {
					if ( !$meta_woi ) { ?>
						<div class="article-featured-image"><?php the_post_thumbnail(); ?></div>
                    <?php }
				} else { ?>
					<div class="article-featured-image">
						<a href="<?php esc_url( the_permalink() ); ?>">
							<?php if ( $baxel_thumbnail_choice ) {
								the_post_thumbnail( 'baxel-thumbnail-image' );
							} else {
								the_post_thumbnail();
							} ?>
						</a>
					</div>
				<?php }
            } ?>
            <div class="article-content-outer<?php echo baxel_apply_layout(); ?>">
                <div class="article-content-inner">
                	<?php if ( is_sticky() && is_home() && !is_paged() ) { ?>
                        <div class="sticky-icon"><?php echo esc_attr( baxel_translation( '_Sticky' ) ); ?></div>
                    <?php } ?>
                    <?php if ( $baxel_show_date ) { ?>
                        <div class="article-date-outer"><?php if ( is_single() ) { ?><span class="article-date"><?php echo get_the_date(); ?></span><?php } else { ?><a class="article-date" href="<?php esc_url( the_permalink() ); ?>"><?php echo get_the_date(); ?></a><?php } ?></div>
                    <?php } ?>
                    <?php if ( is_single() ) { ?><h1 class="article-title"><?php the_title(); ?></h1><?php } else { ?><h2 class="article-title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h2><?php } ?>
                    <?php if ( $baxel_show_author ) { ?>
                        <a class="article-author-outer" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                            <?php echo get_avatar( get_the_author_meta( 'ID' ), 30 ); ?>
                            <div class="article-author"><?php echo esc_attr( baxel_translation( '_By' ) ); ?> <?php the_author(); ?></div>
                        </a>
                    <?php } ?>
                    <?php if ( is_single() ) { ?>
                        <div class="article-pure-content clearfix">
							<?php if ( $baxel_videos ) {
								echo baxel_remove_featured_video();
							} else {
								the_content();
							} ?>
                        </div>
                    <?php } else { ?>
                        <?php echo baxel_append_excerpt(); ?>
                    <?php }
					get_template_part( 'social-bar' );
                    get_template_part( 'pager-bar' );
                    if ( $baxel_show_categories ) {
                        if ( get_the_category() ) { get_template_part( 'category-bar' ); }
                        the_tags( '<div class="category-bar tag-only clearfix"><span class="categories-label">' . esc_attr( baxel_translation( '_Tag' ) ) . ':</span>', ', ', '</div>' );
                    }
                    ?>
                </div>
            </div>
        <?php } ?>
	</article>
<?php if ( !is_single() && baxel_apply_columns() ) { echo '</div>'; } ?>
