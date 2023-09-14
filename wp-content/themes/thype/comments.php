<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Thype WordPress Theme
 * @subpackage Templates
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="cl-entry-single-section cl-entry-single-section--comments">
	<?php // You can start editing here -- including this comment!
	
	if ( have_comments() ) : ?>
		
		<div class="cl-entry-single-comments">

			<?php $extra_container = ''; if( ! codeless_is_inner_content() ) $extra_container = 'container'; ?>

			<div class="cl-entry-single-comments__wrapper <?php echo esc_attr( $extra_container ) ?>">

				<h6 class="cl-entry-single-section__title cl-custom-font">
					<?php
						$comments_number = get_comments_number();
						if( $comments_number == 1 )
							echo esc_attr( $comments_number ) . ' ' . esc_attr__('Comment', 'thype');
						else
							echo esc_attr( $comments_number ) . ' ' . esc_attr__('Comments', 'thype');
					?>
				</h6>

				<ol class="cl-entry-single-comments__list"> 
					<?php
						wp_list_comments( array(
							'walker'      => new codeless_comment_walker(),
							'style'       => 'ul',
							'short_ping'  => true,

						) );
					?>
				</ol>

				<?php the_comments_pagination( array(
					'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'thype' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'thype' ) . '</span>',
				) );

			

			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'thype' ); ?></p>
			<?php
			endif; ?>
		</div>
	</div>

	<?php endif;  // Check for have_comments(). ?>

	<?php $extra_container = ''; if( ! codeless_is_inner_content() ) $extra_container = 'container'; ?>
	
	<div class="cl-entry-single-comments__reply  <?php echo esc_attr( $extra_container ) ?>">
		<?php comment_form( array( 'title_reply_before' => '<h6 id="reply-title" class="cl-entry-single-section__title cl-custom-font">', 'title_reply_after' => '</h6>', 'class_submit' => codeless_button_classes() ) );
		?>
	</div>

</div><!-- #comments -->
