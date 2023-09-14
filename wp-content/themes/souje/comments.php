<?php

if ( ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

            <!-- comments -->
            <div id="comments" class="comments comments-outer<?php echo souje_apply_layout(); ?> clearfix">
            	<h2 class="comments-title"><?php comments_number( '0 ' . esc_attr( souje_translation( '_Comments' ) ), '1 ' . esc_attr( souje_translation( '_Comment' ) ), '% ' . esc_attr( souje_translation( '_Comments' ) ) ); ?></h2>
                <div class="comments-container">
                    <ul class="comments-inner">
                    <?php
                        wp_list_comments( array(
                            'avatar_size' => 60,
                            'max_depth' => 3,
                            'style' => 'ul',
                            'callback' => 'souje_setCommentItem',
                            'type' => 'all'
                        ) );
                    ?>
                    </ul>

                    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>

                    <div class="comments-pagenavi clearfix"><?php echo paginate_comments_links( array( 'prev_text' => '<i class="fa fa-chevron-left"></i>', 'next_text' => '<i class="fa fa-chevron-right"></i>' ) ); ?></div>

                    <?php } ?>

                    <?php
                    $req = get_option( 'require_name_email' );
                    $aria_req = ( $req ? " aria-required=true" : '' );

                    $fields = array (
                        'author' => '<div class="comment-form-name-outer"><label for="author">' . esc_attr( souje_translation( '_Name' ) ) . ( $req ? ' *' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . esc_attr( $aria_req ) . ' /></div>',
                        'email' => '<div class="comment-form-email-outer"><label for="email">' . esc_attr( souje_translation( '_Email' ) ) . ( $req ? ' *' : '' ) . '</label><input id="email" name="email" ' . 'type="text"' . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . esc_attr( $aria_req ) . ' /></div>',
                    );

                    $comment_field = '<label for="comment">' . esc_attr( souje_translation( '_Comment' ) ) . '</label><textarea id="comment" name="comment" aria-describedby="form-allowed-tags" aria-required="true"></textarea>';

                    $must_log_in = sprintf( '<a href="%s">' . esc_attr( souje_translation( '_MustBeLogged' ) ) . '.</a>', wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) );

                    $logged_in_as = '<p class="logged-in-as">' . sprintf( esc_attr( souje_translation( '_Logged' ) ) . ': <a href="%1$s">%2$s</a> - <a href="%3$s">' . esc_attr( souje_translation( '_LogOut' ) ) . '</a>', get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>';

                    $cancel_reply = '<i class="fa fa-close"></i>' . esc_attr( souje_translation( '_CancelReply' ) );

                    comment_form( array(
                        'fields' => $fields,
                        'comment_field' => $comment_field,
                        'comment_notes_after' => '',
                        'comment_notes_before' => '',
                        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
                        'title_reply_after' => '</h3>',
                        'title_reply' => esc_attr( souje_translation( '_LeaveReply' ) ),
                        'title_reply_to' => esc_attr( souje_translation( '_LeaveReply' ) ),
                        'cancel_reply_link' => $cancel_reply,
                        'label_submit' => esc_attr( souje_translation( '_PostComment' ) ),
                        'must_log_in' => $must_log_in,
                        'logged_in_as' => $logged_in_as
                    ) );
                    ?>

                </div>
            </div><!-- /comments -->

<?php }

function souje_setCommentItem( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class( 'clearfix' ); ?> id="comment-<?php comment_ID(); ?>">
		<?php if ( get_avatar( $comment ) ) { ?><?php echo get_avatar( $comment, $args['avatar_size'] ); ?><?php } ?>
        <div class="commenter-info">
            <div class="commenter-info-inner">
                <div class="comment-date"><?php printf( '%1$s ' . esc_attr( souje_translation( '_At' ) ) . ' %2$s', get_comment_date(),  get_comment_time() ) ?></div>
                <div class="commenter-name"><?php echo get_comment_author_link(); ?></div>
                <?php if ( !$comment->comment_approved ) { echo '<div class="comment-awaiting">' . esc_attr( souje_translation( '_Awaiting' ) ) . '</div>'; } ?>
            </div>
        </div>
        <div class="comment-text clearfix<?php if ( get_avatar( $comment ) ) { echo ' comment-text-w-a'; } ?>">
            <?php
            comment_text();
            if ( $depth < 3 ) { comment_reply_link( array_merge( $args, array( 'reply_text' => esc_attr( souje_translation( '_Reply' ) ), 'login_text' => esc_attr( souje_translation( '_LoginToReply' ) ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ), $comment->comment_ID); }
            if ( user_can( wp_get_current_user(), 'administrator' ) ) { edit_comment_link( esc_attr( souje_translation( '_Edit' ) ) ); }
            ?>
        </div>

<?php } ?>
