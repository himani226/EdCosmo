<?php
/**
 * The style "extra" of the Blogger
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
														'no_links' => empty($post_link),
														'thumb_size' => apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size($args['columns'] > 2 ? 'med' : 'big'), 'blogger-extra')
														), 'blogger-default')
								);

	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php
        $post_meta = trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                'components' => 'categories',
                'counters' => '',
                'seo' => false
            ), 'blogger-modern', 1)
        );
		// Post title
		if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
			?><div class="sc_blogger_item_header entry-header"><?php 
				// Post title
            if($args['columns'] > 2 ){
                the_title( '<h4 class="sc_blogger_item_title entry-title">'
                    . (!empty($post_link)
                        ? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
                        : ''),
                    (!empty($post_link) ? '</a>' : '') . '</h4>' );
            } else{
                the_title( '<h1 class="sc_blogger_item_title entry-title">'
                    . (!empty($post_link)
                        ? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
                        : ''),
                    (!empty($post_link) ? '</a>' : '') . '</h1>' );
            }




            $post_meta =trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                    'components' => 'date,counters',
                    'counters' => 'comments,views',
                    'seo' => false
                ), 'sc_blogger_extra', 1)
            );
				if (empty($post_link)) $post_meta = trx_addons_links_to_span($post_meta);
				trx_addons_show_layout($post_meta);
			?></div><!-- .entry-header --><?php
		}		

		// Post content
		if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) {
			?><div class="sc_blogger_item_excerpt">

				<?php
				// Post meta
				if (in_array($post_format, array('link', 'aside', 'status', 'quote'))) {
					$post_meta = trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
						'components' => 'date',
						'echo' => false
						), 'sc_blogger_extra', $args['columns'])
					);
					if (empty($post_link)) $post_meta = trx_addons_links_to_span($post_meta);
					trx_addons_show_layout($post_meta);
				}
			?></div><!-- .sc_blogger_item_excerpt --><?php
		}
		
	?></div><!-- .entry-content --><?php

?></div><!-- .sc_blogger_item -->

    </div>
<?php

if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>