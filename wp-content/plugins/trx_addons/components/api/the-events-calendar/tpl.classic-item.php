<?php
/**
 * The style "default" of the Events
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.51
 */

$args = get_query_var('trx_addons_args_sc_events');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);

if (!empty($args['slider'])) {
	?><div class="slider-slide swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_events_item trx_addons_hover trx_addons_hover_style_links">
	<?php if (has_post_thumbnail()) { ?>
		<div class="sc_events_item_thumb">
			<?php
			the_post_thumbnail(
							apply_filters('trx_addons_filter_thumb_size', trx_addons_get_thumb_size($args['columns'] > 2 ? 'medium' : 'big'), 'events-classic'),
							array('alt' => get_the_title())
							);
			?>
			<span class="sc_events_item_categories"><?php trx_addons_show_layout(trx_addons_get_post_terms(' ', get_the_ID(), Tribe__Events__Main::TAXONOMY)); ?></span>
		</div>
	<?php } ?>
	<div class="sc_events_item_info">
		<div class="sc_events_item_header">
			<h4 class="sc_events_item_title"><?php the_title(); ?></h4>
			<div class="sc_events_item_meta">
				<span class="sc_events_item_meta_item sc_events_item_meta_date"><?php
					$dt = tribe_get_start_date(null, true, 'Y-m-d');
					$dt2 = tribe_get_end_date(null, true, 'Y-m-d');
					echo sprintf( $dt < date('Y-m-d') 
									? esc_html__('Started on %1$s to %2$s', 'trx_addons') 
									: esc_html__('Starting %1$s to %2$s', 'trx_addons'),
								'<span class="sc_events_item_date sc_events_item_date_start">' . date_i18n(get_option('date_format'), strtotime($dt)) . '</span>',
								'<span class="sc_events_item_date sc_events_item_date_end">' . date_i18n(get_option('date_format'), strtotime($dt2)) . '</span>'
								);
				?></span>
            </div>
		</div>
		<div class="sc_events_item_price"><?php echo tribe_get_formatted_cost(); ?></div>
	</div>
	<div class="trx_addons_hover_mask"></div>
	<div class="trx_addons_hover_content">
		<h4 class="trx_addons_hover_title"><a href="<?php echo esc_url(get_permalink()); ?>" class="trx_addons_hover_title_link"><?php the_title(); ?></a></h4>
		<?php
		if (($excerpt = get_the_excerpt()) != '') {
			?><div class="trx_addons_hover_text"><?php echo esc_html($excerpt); ?></div><?php
		}
		if (!empty($args['more_text'])) {
			?><div class="trx_addons_hover_links">
				<a href="<?php echo esc_url(get_permalink()); ?>" class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', 'trx_addons_hover_link', 'sc_events', $args)); ?>"><?php echo esc_html($args['more_text']); ?></a>
			</div><?php
		}
	?></div>
</div><?php
if (!empty($args['slider']) || (int)$args['columns'] > 1) {
	?></div><?php
}
?>