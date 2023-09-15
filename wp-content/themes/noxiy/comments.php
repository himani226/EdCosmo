<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package noxiy
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="blog__details-left-comment mt-65">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) :
	?>
		<?php
		$noxiy_comment_count = get_comments_number();
		$noxiy_comments_text = number_format_i18n($noxiy_comment_count);
		if ('1' === $noxiy_comment_count) {
			$noxiy_comments_text .= esc_html__(' Comment', 'noxiy');
		} else {
			$noxiy_comments_text .= esc_html__(' Comments', 'noxiy');
		}
		?>
		<h4 class="comments-title mb-30"><?php echo esc_html($noxiy_comments_text); ?></h4>
		<!-- .comments-title -->
		<?php the_comments_navigation(); ?>
		<div class="comment-list">
			<?php
			wp_list_comments(
				array(
					'callback' => 'noxiy_custom_comments',
				)
			);
			?>
		</div><!-- .comment-list -->
		
		<?php the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open()) :
		?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'noxiy'); ?></p>
	<?php
		endif;

	endif; ?>

	<div class="news__details-left-contact-form">
		<?php comment_form(); ?>
	</div>
</div><!-- #comments -->