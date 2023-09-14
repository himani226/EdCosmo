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

        $widget_args = $args;

        $count = $widget_args['count'];

        $thumb_size =    apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size($args['columns'] > 2 ? 'blogger-med' : 'blogger'), 'blogger-tiles');



        $maxlen = 30;
        if ($thumb_size == 'yolox-thumb-blogger-med') {
            $maxlen = 28;
        } else if ($thumb_size == 'yolox-thumb-blogger') {
            $maxlen = 35;
        }
        $title = '<span>' . wp_kses( get_the_title(), 'yolox_kses_content' ) . '</span>';
        $st = wordwrap($title,$maxlen,"</span><span class='del'></span><span>");



        ?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) . (empty($post_link) ? ' no_links' : '') ); ?>>
            <?php
            $post_link = empty($args['no_links']) ? get_permalink() : '';
            if (!empty($post_link)) {
            ?><a href="<?php echo esc_url($post_link); ?>" class="blocks_link" aria-hidden="true"<?php if (!empty($post_link['link'])) echo ' target="_blank"'; ?>><?php
}

if (!empty($post_link)) {
    ?></a><?php
}
?>

            <?php
            // Featured image
            trx_addons_get_template_part('templates/tpl.featured.php',
                'trx_addons_args_featured',
                apply_filters('trx_addons_filter_args_featured', array(
                    'class' => 'sc_blogger_item_featured',
                    'hover' => 'zoomin',
                    'thumb_bg'      => true,
                    'no_links' => empty($post_link),
                    'thumb_size' => apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size($args['columns'] > 2 ? 'news-excerpt' : 'news-excerpt'), 'blogger-horizontal')
                ), 'blogger-horizontal')
            );
            ;?>

            <div class="post_body">
                <div class="share_btn_wrap">
                    <?php
                    $post_meta =trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                            'components' => 'share',
                            'counters' => '',
                            'seo' => false
                        ), 'blogger-horizontal', 1)
                    );?>
                </div>
                 <div class="clear"></div>
                <?php
                if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
                    ?>
                    <div class="post_header entry-header">
                        <?php
                        $post_meta =trx_addons_sc_show_post_meta('recent_news', apply_filters('trx_addons_filter_show_post_meta', array(
                                'components' => 'date,counters',
                                'counters' => 'comments,views',
                                'seo' => false
                            ), 'blogger-horizontal', 1)
                        );
                        the_title( '<h4 class=" entry-title"><a href="'.esc_url(get_permalink()).'" rel="bookmark">', '</a></h4>' );

                        ?>
                    </div><!-- .entry-header -->
                    <?php
                }
                ?>

                <div class="post_content excerpt-content">
                    <?php
                    $excerpt =  wpautop(get_the_excerpt());

                    echo wp_trim_words( $excerpt, 15, '...' );
                    ?>
                </div><!-- .entry-content -->


            </div><!-- .post_body -->


            <?php

            ?></div><!-- .sc_blogger_item --><?php

        if ($args['slider'] || (int)$args['columns'] > 1) {
        ?></div><?php
}
?>




