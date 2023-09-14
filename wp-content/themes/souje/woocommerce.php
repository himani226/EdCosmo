<?php get_header();

	$souje_woo_layout = get_theme_mod( 'souje_woo_layout', '2col_sidebar' );
	$souje_show_woobar = get_theme_mod( 'souje_show_woobar', 1 );

	if ( $souje_woo_layout == '2col_sidebar' ) { $woo_layout = '-sidebar'; } else { $woo_layout = ''; }
	if ( is_product() ) { if ( $souje_show_woobar ) { $woo_layout = '-sidebar'; } else { $woo_layout = ''; } }

	?>
	<div class="main-container<?php echo esc_attr( $woo_layout ); ?>">
    <article <?php post_class( 'clearfix' ); ?>>
      <div class="article-content-outer<?php echo esc_attr( $woo_layout ); ?>">
        <div class="article-content-inner">
        	<div class="article-pure-content clearfix"><?php woocommerce_content(); ?></div>
        </div>
      </div>
    </article>
	</div><!-- /main-container -->

  <!-- sidebar -->
  <?php
	if ( $woo_layout == '-sidebar' ) {
		$souje_s_type = 'woo';
		souje_insert_sidebar( $souje_s_type );
	}
  ?>
  <!-- /sidebar -->

</div><!-- /site-mid -->

<?php get_footer(); ?>
