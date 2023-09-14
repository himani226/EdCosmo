<?php
/**
 * List View Nav Template
 * This file loads the list view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */
if ( ! $wp_query = tribe_get_global_query_object() ) {
	return;
}

$events_label_plural = tribe_get_event_label_plural();

if ( ! defined( 'ABSPATH' ) ) {
	wp_die( '-1' );
} ?>

<nav class="tribe-events-nav-pagination" aria-label="<?php echo esc_html( sprintf( esc_html__( '%s List Navigation', 'yolox' ), $events_label_plural ) ); ?>">
	<ul class="tribe-events-sub-nav">
		<!-- Left Navigation -->

		<?php if ( tribe_has_previous_event() ) : ?>
			<li class="<?php echo esc_attr( tribe_left_navigation_classes() ); ?>">
				<a href="<?php echo esc_url( tribe_get_listview_prev_link() ); ?>" rel="prev"><span>&laquo;</span> <?php echo esc_html__( 'Previous ', 'yolox' ); ?></a>

			</li><!-- .tribe-events-nav-left -->
		<?php endif; ?>

		<!-- Right Navigation -->
		<?php if ( tribe_has_next_event() ) : ?>
			<li class="<?php echo esc_attr( tribe_right_navigation_classes() ); ?>">
				<a href="<?php echo esc_url( tribe_get_listview_next_link() ); ?>" rel="next"><?php echo esc_html__( 'Next', 'yolox' ); ?> <span>&raquo;</span></a>
			</li><!-- .tribe-events-nav-right -->
		<?php endif; ?>
	</ul>
</nav>