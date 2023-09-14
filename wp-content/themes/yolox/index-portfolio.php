<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

yolox_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	yolox_blog_archive_start();

	$yolox_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$yolox_sticky_out = yolox_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $yolox_stickies ) && count( $yolox_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$yolox_cat          = yolox_get_theme_option( 'parent_cat' );
	$yolox_post_type    = yolox_get_theme_option( 'post_type' );
	$yolox_taxonomy     = yolox_get_post_type_taxonomy( $yolox_post_type );
	$yolox_show_filters = yolox_get_theme_option( 'show_filters' );
	$yolox_tabs         = array();
	if ( ! yolox_is_off( $yolox_show_filters ) ) {
		$yolox_args           = array(
			'type'         => $yolox_post_type,
			'child_of'     => $yolox_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $yolox_taxonomy,
			'pad_counts'   => false,
		);
		$yolox_portfolio_list = get_terms( $yolox_args );
		if ( is_array( $yolox_portfolio_list ) && count( $yolox_portfolio_list ) > 0 ) {
			$yolox_tabs[ $yolox_cat ] = esc_html__( 'All', 'yolox' );
			foreach ( $yolox_portfolio_list as $yolox_term ) {
				if ( isset( $yolox_term->term_id ) ) {
					$yolox_tabs[ $yolox_term->term_id ] = $yolox_term->name;
				}
			}
		}
	}
	if ( count( $yolox_tabs ) > 0 ) {
		$yolox_portfolio_filters_ajax   = true;
		$yolox_portfolio_filters_active = $yolox_cat;
		$yolox_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters yolox_tabs yolox_tabs_ajax">
			<ul class="portfolio_titles yolox_tabs_titles">
				<?php
				foreach ( $yolox_tabs as $yolox_id => $yolox_title ) {
					?>
					<li><a href="<?php echo esc_url( yolox_get_hash_link( sprintf( '#%s_%s_content', $yolox_portfolio_filters_id, $yolox_id ) ) ); ?>" data-tab="<?php echo esc_attr( $yolox_id ); ?>"><?php echo esc_html( $yolox_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$yolox_ppp = yolox_get_theme_option( 'posts_per_page' );
			if ( yolox_is_inherit( $yolox_ppp ) ) {
				$yolox_ppp = '';
			}
			foreach ( $yolox_tabs as $yolox_id => $yolox_title ) {
				$yolox_portfolio_need_content = $yolox_id == $yolox_portfolio_filters_active || ! $yolox_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $yolox_portfolio_filters_id, $yolox_id ) ); ?>"
					class="portfolio_content yolox_tabs_content"
					data-blog-template="<?php echo esc_attr( yolox_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( yolox_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $yolox_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $yolox_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $yolox_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $yolox_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $yolox_cat ); ?>"
					data-need-content="<?php echo ( false === $yolox_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $yolox_portfolio_need_content ) {
						yolox_show_portfolio_posts(
							array(
								'cat'        => $yolox_id,
								'parent_cat' => $yolox_cat,
								'taxonomy'   => $yolox_taxonomy,
								'post_type'  => $yolox_post_type,
								'page'       => 1,
								'sticky'     => $yolox_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		yolox_show_portfolio_posts(
			array(
				'cat'        => $yolox_cat,
				'parent_cat' => $yolox_cat,
				'taxonomy'   => $yolox_taxonomy,
				'post_type'  => $yolox_post_type,
				'page'       => 1,
				'sticky'     => $yolox_sticky_out,
			)
		);
	}

	yolox_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
