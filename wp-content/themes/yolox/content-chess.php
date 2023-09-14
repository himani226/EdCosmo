<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage YOLOX
 * @since YOLOX 1.0
 */

$yolox_template_args = get_query_var( 'yolox_template_args' );
if ( is_array( $yolox_template_args ) ) {
	$yolox_columns    = empty( $yolox_template_args['columns'] ) ? 1 : max( 1, min( 3, $yolox_template_args['columns'] ) );
	$yolox_blog_style = array( $yolox_template_args['type'], $yolox_columns );
} else {
	$yolox_blog_style = explode( '_', yolox_get_theme_option( 'blog_style' ) );
	$yolox_columns    = empty( $yolox_blog_style[1] ) ? 1 : max( 1, min( 3, $yolox_blog_style[1] ) );
}
$yolox_expanded    = ! yolox_sidebar_present() && yolox_is_on( yolox_get_theme_option( 'expand_content' ) );
$yolox_post_format = get_post_format();
$yolox_post_format = empty( $yolox_post_format ) ? 'standard' : str_replace( 'post-format-', '', $yolox_post_format );
$yolox_animation   = yolox_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $yolox_columns )
										. ' post_format_' . esc_attr( $yolox_post_format )
										. ( ! empty( $yolox_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! yolox_is_off( $yolox_animation ) && empty( $yolox_template_args['slider'] ) ? ' data-animation="' . esc_attr( yolox_get_animation_classes( $yolox_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor


	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$yolox_hover = ! empty( $yolox_template_args['hover'] ) && ! yolox_is_inherit( $yolox_template_args['hover'] )
						? $yolox_template_args['hover']
						: yolox_get_theme_option( 'image_hover' );
	yolox_show_post_featured(
		array(
			'class'         => 1 == $yolox_columns && ! is_array( $yolox_template_args ) ? 'yolox-full-height' : '',
			'singular'      => false,
			'hover'         => $yolox_hover,
			'no_links'      => ! empty( $yolox_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => yolox_get_thumb_size(
				strpos( yolox_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $yolox_columns ? 'huge' : 'original' )
										: ( 2 < $yolox_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'yolox_action_before_post_title' );

			// Post title
		if ( empty( $yolox_template_args['no_links'] ) ) {
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( '<h3 class="post_title entry-title">', '</h3>' );
		}

			do_action( 'yolox_action_before_post_meta' );

			// Post meta
			$yolox_components = yolox_array_get_keys_by_value( yolox_get_theme_option( 'meta_parts' ) );
			$yolox_counters   = yolox_array_get_keys_by_value( yolox_get_theme_option( 'counters' ) );
			$yolox_post_meta  = empty( $yolox_components ) || in_array( $yolox_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: yolox_show_post_meta(
											apply_filters(
												'yolox_filter_post_meta_args', array(
													'components' => $yolox_components,
													'counters' => $yolox_counters,
													'seo'  => false,
													'echo' => false,
												), $yolox_blog_style[0], $yolox_columns
											)
										);
			yolox_show_layout( $yolox_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
		<?php
		if ( empty( $yolox_template_args['hide_excerpt'] ) ) {
			?>
				<div class="post_content_inner">
				<?php
				if ( has_excerpt() ) {
					the_excerpt();
				} elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
					the_content( '' );
				} elseif ( in_array( $yolox_post_format, array( 'link', 'aside', 'status' ) ) ) {
					the_content();
				} elseif ( 'quote' == $yolox_post_format ) {
					$quote = yolox_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
					if ( ! empty( $quote ) ) {
						yolox_show_layout( wpautop( $quote ) );
					} else {
						the_excerpt();
					}
				} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
					the_excerpt();
				}
				?>
				</div>
				<?php
		}
			// Post meta
		if ( in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			yolox_show_layout( $yolox_post_meta );
		}
			// More button
		if ( empty( $yolox_template_args['no_links'] ) && ! in_array( $yolox_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			?>
				<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'yolox' ); ?></a></p>
				<?php
		}
		?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
