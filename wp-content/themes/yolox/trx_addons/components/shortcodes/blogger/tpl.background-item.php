<?php
/**
 * The style "plain" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
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

	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php
        // Featured image
        trx_addons_get_template_part('templates/tpl.featured.php',
            'trx_addons_args_featured',
            apply_filters('trx_addons_filter_args_featured', array(
                'class' => 'sc_blogger_item_featured',
                'hover' => '',
                'thumb_bg'      => true,
                'post_info' => '<div class="post_info_wrap">'
                    . '<span class="post_categories">'.trx_addons_get_post_categories().'</span>'
                    . '<h1 class="post_title entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">' . wp_kses( get_the_title(), 'yolox_kses_content' ) . '</a></h1>'
                    . ( in_array( get_post_type(), array( 'post', 'attachment' ) )
                        ? '<div class="post_meta">'
                        . $post_meta = trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                                    'components' => 'date,counters',
                                    'counters' => 'views,comments',
                                    'echo' => false
                                ), 'sc_blogger_plain', $args['columns'])
                            )
                        . '</div>'
                        : '')
                    . '</div>',
                'no_links' => empty($post_link),
                'thumb_size' => apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size($args['columns'] > 2 ? 'blogger-med' : 'full'), 'blogger-default')
            ), 'blogger-default')
        );
		
	?></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>