<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package noxiy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function noxiy_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'noxiy_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function noxiy_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'noxiy_pingback_header');

// Excerpts Enable

function noxiy_excerpts_enable() {
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'noxiy_excerpts_enable' );

// Comment list
function noxiy_custom_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment; ?>

	<div class="blog__details-left-comment-item" id="comment-<?php comment_ID(); ?>">
		<div class="blog__details-left-comment-item-comment">
			<div class="blog__details-left-comment-item-comment-image">
				<?php if ($avarta = get_avatar($comment)) :
					printf($avarta);
				endif; ?>
			</div>
			<div class="blog__details-left-comment-item-comment-content">
				<?php
				if ($comment->user_id != '0') {
					printf('<h6>%1$s</h6>', get_user_meta($comment->user_id, 'nickname', true));
				} else {
					printf('<h6>%1$s</h6>', get_comment_author_link());
				}
				?>
				<?php 
				comment_reply_link(array_merge($args, array(
					'depth' => $depth, 
					'max_depth' => $args['max_depth'], 
					'reply_text' => '<i class="fal fa-reply-all"></i>' . esc_html__('Reply', 'noxiy'),
				)));
				?>
				<span><?php echo get_comment_date('j M, Y'); ?></span>
				<span><?php edit_comment_link(esc_html__('Edit', 'noxiy'), '', ''); ?></span>
				<?php comment_text() ?>
			</div>

			<?php if ($comment->comment_approved == '0') : ?>
				<div class='comments-notify'>
					<span class="unapproved"><?php esc_html_e('Your comment is awaiting moderation.', 'noxiy'); ?></span>
				</div>
			<?php endif; ?>

		</div>
	</div>
				
<?php }
