<?php

$baxel_min_post_height = get_theme_mod( 'baxel_min_post_height', 0 );

?>

<?php if ( !is_single() && baxel_apply_columns() ) { echo '<div class="' . baxel_apply_columns() . '">'; } ?>
	<article <?php post_class( 'clearfix' ); if ( !is_single() && !baxel_check_style_z() && $baxel_min_post_height ) { echo 'style="min-height: ' . esc_attr( $baxel_min_post_height ) . 'px;"'; } ?>>
        <div class="article-content-outer<?php echo baxel_apply_layout(); ?>">
            <div class="article-content-inner">
                <div class="article-pure-content clearfix"><?php the_content(); ?></div>
            </div>
        </div>
	</article>
<?php if ( !is_single() && baxel_apply_columns() ) { echo '</div>'; } ?>
