<?php
/**
 * The style "default" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

$args = get_query_var('trx_addons_args_sc_blogger');
if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = empty($args['no_links']) ? get_permalink() : '';
$post_title = get_the_title();

?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) . (empty($post_link) ? ' no_links' : '') ); ?>><?php
$post_link = empty($args['no_links']) ? get_permalink() : '';
if (!empty($post_link)) {
    ?><a href="<?php echo esc_url($post_link); ?>" class="blocks_link" aria-hidden="true"<?php if (!empty($post_link['link'])) echo ' target="_blank"'; ?>><?php
}

if (!empty($post_link)) {
    ?></a><?php
}?>
<div class="blogger-wrap">
    <?php
	// Featured image
	trx_addons_get_template_part('templates/tpl.featured.php',
									'trx_addons_args_featured',
									apply_filters('trx_addons_filter_args_featured', array(
														'class' => 'sc_blogger_item_featured',
														'hover' => 'zoomin',
                                                        'post_info' => '<div class="post_meta_item post_categories_wrap">'
                                                        . '<span class="post_categories">'.trx_addons_get_post_categories().'</span>'
                                                        . '</div>',
														'no_links' => empty($post_link),
														'thumb_size' => apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size($args['columns'] > 3 ? 'blogger-small' : 'blogger-big'), 'blogger-default')
														), 'blogger-default')
								);

	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php

		// Post title
		if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
			?><div class="sc_blogger_item_header entry-header"><?php 
				// Post title
            if($args['columns'] > 3 ){
                the_title( '<h5 class="sc_blogger_item_title entry-title">'
                    . (!empty($post_link)
                        ? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
                        : ''),
                    (!empty($post_link) ? '</a>' : '') . '</h5>' );
            } else{
                the_title( '<h2 class="sc_blogger_item_title entry-title">'
                    . (!empty($post_link)
                        ? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
                        : ''),
                    (!empty($post_link) ? '</a>' : '') . '</h2>' );
            }




            $post_meta =trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                    'components' => 'date,counters',
                    'counters' => 'comments,views',
                    'seo' => false
                ), 'sc_blogger_default', 1)
            );
				if (empty($post_link)) $post_meta = trx_addons_links_to_span($post_meta);
				trx_addons_show_layout($post_meta);
			?></div><!-- .entry-header --><?php
		}		

		// Post content
		if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) {
			?><div class="sc_blogger_item_excerpt">
				<div class="sc_blogger_item_excerpt_text">
					<?php
					if (has_excerpt()) {
						the_excerpt();
					} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
						the_content( '' );
					} else if (!$show_more) {
						the_content();
					} else {
						the_excerpt();
					}
					?>
				</div>
				<?php
				// Post meta
				if (in_array($post_format, array('link', 'aside', 'status', 'quote'))) {
					$post_meta = trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
						'components' => 'date',
						'echo' => false
						), 'sc_blogger_default', $args['columns'])
					);
					if (empty($post_link)) $post_meta = trx_addons_links_to_span($post_meta);
					trx_addons_show_layout($post_meta);
				}
			?></div><!-- .sc_blogger_item_excerpt --><?php
		}
		
	?></div><!-- .entry-content --><?php
// More button
$show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote'));
$show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote'));
if ( $show_more && !empty($post_link) && !empty($args['more_text']) ) {
    ?><div class="sc_blogger_item_button sc_item_button more-link"><a href="<?php echo esc_url($post_link); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button sc_button_simple', 'sc_blogger', $args)); ?>"><?php
        echo esc_html($args['more_text']);
        ?></a></div><?php
}
?></div><!-- .sc_blogger_item -->

    </div>
<?php

if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>