<?php
/**
 * The "News Magazine" template to show post's content
 *
 * Used in the widget Recent News.
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */

$widget_args = get_query_var('trx_addons_args_recent_news');
$style = $widget_args['style'];
$number = $widget_args['number'];
$count = $widget_args['count'];
$columns = $widget_args['columns'];
$featured = $widget_args['featured'];

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$animation = apply_filters('trx_addons_blog_animation', '');

$post_link = empty($args['no_links']) ? get_permalink() : '';
$post_title = get_the_title();



$animation = apply_filters('trx_addons_blog_animation', '');
$trx_addons_post_author_id   = get_the_author_meta('ID');
$trx_addons_post_link  = get_permalink();
$trx_addons_post_author_name = get_the_author_meta('display_name');
$trx_addons_post_author_url  = get_author_posts_url($trx_addons_post_author_id, '');
$trx_addons_show_author = isset($trx_addons_args['show_author']) ? (int) $trx_addons_args['show_author'] : 1;

$post_link = empty($args['no_links']) ? get_permalink() : '';

if ($number==$featured+1 && (int)$number > 1 && $featured < $count && $featured!=$columns-1) {
    ?><div class="post_delimiter<?php if ((int)$columns > 1) echo ' '.esc_attr(trx_addons_get_column_class(1, 1)); ?>"></div><?php
}


if ((int)$columns > 1 && !($featured==$columns-1 && $number>$featured+1)) {
    ?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $columns)); ?>"><?php
}
if ((int)$number > 1 && !($featured==$columns-1 && $number>$featured+1)) {?>
    <div class="related_posts_wrap sc_recent_news_columns_wrap trx_addons_columns_wrap">
<?php }
if ($number > $featured) {
    echo '<div class="trx_addons_column-1_2 right_column">';
}?>

<article
<?php post_class( 'post_item post_layout_'.esc_attr($style)
    .' post_format_'.esc_attr($post_format)
    .' post_accented_'.($number<=$featured ? 'on' : 'off')
    .($featured == $count && $featured > $columns ? ' post_accented_border' : '')
); ?>
<?php echo (!empty($animation) ? ' data-animation="'.esc_attr($animation).'"' : ''); ?>
    >

<?php
$post_link = empty($args['no_links']) ? get_permalink() : '';
if (!empty($post_link)) {
    ?><a href="<?php echo esc_url($post_link); ?>" class="blocks_link" aria-hidden="true"<?php if (!empty($post_link['link'])) echo ' target="_blank"'; ?>><?php
}

if (!empty($post_link)) {
    ?></a><?php
}

if ( is_sticky() && is_home() && !is_paged() ) {
    ?><span class="post_label label_sticky"></span><?php
}

trx_addons_get_template_part('templates/tpl.featured.php',
    'trx_addons_args_featured',
    apply_filters('trx_addons_filter_args_featured', array(
        'thumb_bg'      => false,
        'hover' => 'zoomin',
        'thumb_size' => apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size($args['columns'] > 2 ? 'full' : 'related'), 'recent_news-announce2')
    ), 'recent_news-announce2')
);

if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
    ?>
    <div class="recent_news_item_content entry-content"><?php
        // Display content and footer only in the featured posts
        // Post title
        if ( !in_array($post_format, array('link', 'aside', 'status', 'quote')) ) {
            ?><div class="recent_news_item_header entry-header"><?php
            if ($number <= $featured) {

                $post_meta =trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                        'components' => 'categories',
                        'counters' => '',
                        'seo' => false
                    ), 'recent_news-announce2', 1)
                );
            }
            // Post title
            if($number <= $featured ){
                the_title( '<h2 class="recent_news_item_title entry-title">'
                    . (!empty($post_link)
                        ? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
                        : ''),
                    (!empty($post_link) ? '</a>' : '') . '</h2>' );
            } else{
                the_title( '<h5 class="recent_news_item_title entry-title">'
                    . (!empty($post_link)
                        ? sprintf( '<a href="%s" rel="bookmark">', esc_url( $post_link ) )
                        : ''),
                    (!empty($post_link) ? '</a>' : '') . '</h5>' );
            }




            $post_meta =trx_addons_sc_show_post_meta('recent_news', apply_filters('trx_addons_filter_show_post_meta', array(
                    'components' => 'date,counters',
                    'counters' => 'comments,views',
                    'seo' => false
                ), 'recent_news-announce2', 1)
            );
            if (empty($post_link)) $post_meta = trx_addons_links_to_span($post_meta);
            trx_addons_show_layout($post_meta);
            ?></div><!-- .entry-header --><?php
        }

        $show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote'));
        // More button
        if ( $show_more && !empty($post_link)  ) {
            ?><div class=" sc_item_button  "><a href="<?php echo esc_url($post_link); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'sc_button sc_button_simple', 'recent_news', $args)); ?>"><?php
                echo esc_html__('Read More', 'yolox');
                ?></a></div><?php
        }

        ?></div><!-- .entry-content --> <?php

}
?>
    </article><?php
if ($number > $featured) {
    echo '</div>';;
}
if ( $number == $count  && (int)$number > 1 && $featured < $count) {
    echo '</div>';
}
if ((int)$columns > 1 && !($featured==$columns-1 && $featured<$number && $number<$count)) {
    ?></div><?php
}


?>