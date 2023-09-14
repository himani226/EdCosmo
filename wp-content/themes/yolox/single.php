<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

get_header();

while ( have_posts() ) {
	the_post();

	get_template_part( apply_filters( 'yolox_filter_get_template_part', 'content', get_post_format() ), get_post_format() );

	// Previous/next post navigation.
	$yolox_show_posts_navigation = ! yolox_is_off( yolox_get_theme_option( 'show_posts_navigation' ) );
	$yolox_fixed_posts_navigation = ! yolox_is_off( yolox_get_theme_option( 'fixed_posts_navigation' ) ) ? 'nav-links-fixed fixed' : '';
	if ( $yolox_show_posts_navigation ) {
		?>
		<div class="nav-links-single<?php echo ' ' . esc_attr( $yolox_fixed_posts_navigation ); ?>">
			<?php
			the_post_navigation(
				array(
					'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'yolox' ) . '</span> '
						. '<h6 class="post-title">' . esc_html__( 'Next Post', 'yolox' ) . '</h6>' . '<span class="nav-arrow"></span>',
					'prev_text' => '<span class="nav-arrow"></span>'
						. '<span class="screen-reader-text">' . esc_html__( 'Prev post:', 'yolox' ) . '</span> '
						. '<h6 class="post-title">'  . esc_html__( 'Prev Post', 'yolox' ) . '</h6>',
				)
			);
			?>
		</div>
		<?php
	}

	// Related posts
	if ( yolox_get_theme_option( 'related_position' ) == 'below_content' ) {
		do_action( 'yolox_action_related_posts' );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();