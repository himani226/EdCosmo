<?php
/**
 * The style "short" of the Team
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

$args = get_query_var('trx_addons_args_sc_team');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = empty($args['no_links']) ? get_permalink() : '';

if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div <?php post_class( 'sc_team_item' . (empty($post_link) ? ' no_links' : '') ); ?>>
	<?php
	// Featured image
	trx_addons_get_template_part('templates/tpl.featured.php',
								'trx_addons_args_featured',
								apply_filters('trx_addons_filter_args_featured', array(
												'allow_theme_replace' => false,
												'singular' => false,
												'class' => 'sc_team_item_thumb',
												'no_links' => empty($link),
												'hover' => '',
												'thumb_size' => apply_filters('trx_addons_filter_thumb_size', yolox_get_thumb_size('team-short'), 'team-short')
												), 'team-short')
								);
	?>
	<div class="sc_team_item_info">
		<div class="sc_team_item_header">
			<h5 class="sc_team_item_title"><?php
				if (!empty($link)) {
					?><a href="<?php echo esc_url($link); ?>"><?php
				}
				the_title();
				if (!empty($link)) {
					?></a><?php
				}
			?></h5>
			<div class="sc_team_item_subtitle"><?php echo esc_html($meta['subtitle']);?></div>
		</div>
        <?php
        if (!empty($meta['socials'])) {
            ?><div class="sc_team_item_socials socials_wrap"><?php trx_addons_show_layout(trx_addons_get_socials_links_custom($meta['socials'])); ?></div><?php
        }?>
	</div>
</div>
<?php
if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
?>