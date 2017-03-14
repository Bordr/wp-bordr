<?php
/**
 * The template for displaying Comments.
 *
 * @package Nu Themes
 */

if ( post_password_required() )
	return;
?>

	<div id="comments" class="box comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'nuthemes' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h3>

		<ol class="comment-list">
			<?php wp_list_comments( array( 'callback' => 'nuthemes_comment' ) ); ?>
		<!-- .comment-list --></ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'nuthemes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'nuthemes' ) ); ?></div>
		<!-- #comment-nav-below --></nav>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="alert alert-danger no-comments"><?php _e( 'Comments are closed.', 'nuthemes' ); ?></p>
	<?php endif; ?>

	<?php
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$args = array(
			'id_form'				=> 'commentform',
			'id_submit'				=> 'submit',
			'title_reply'			=> __( 'Leave a Reply', 'nuthemes' ),
			'title_reply_to'		=> __( 'Leave a Reply to %s', 'nuthemes' ),
			'cancel_reply_link' 	=> __( 'Cancel Reply', 'nuthemes' ),
			'label_submit'			=> __( 'Post Comment', 'nuthemes' ),

			'comment_field' 		=>	'<div class="form-group comment-form-comment">' .
				'<textarea id="comment" class="form-control" name="comment" cols="45" rows="4" aria-required="true" placeholder="Your comment...">' .
				'</textarea></div>',

			'must_log_in' 			=> '<p class="must-log-in">' .
				sprintf(
					__( 'You must be <a href="%s">logged in</a> to post a comment.', 'nuthemes' ),
					wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</p>',

			'logged_in_as' 			=> '<p class="logged-in-as">' .
				sprintf(
				__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'nuthemes' ),
					admin_url( 'profile.php' ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
				) . '</p>',

			'comment_notes_before' 	=> '<p class="comment-notes">' .
				__( 'Your email address will not be published.', 'nuthemes' ) .
				'</p>',

			'comment_notes_after' => '<p class="form-allowed-tags">' .
				sprintf(
					__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'nuthemes' ),
					' <code>' . allowed_tags() . '</code>'
				) . '</p>',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="form-group comment-form-author">' .
					'<input id="author" class="form-control" name="author" type="text" placeholder="Name'. ( $req ? '*' : '' ) .'" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' /></div>',

				'email' =>
					'<div class="form-group comment-form-email">' .
					'<input id="email" class="form-control" name="email" type="text" placeholder="Email'. ( $req ? '*' : '' ) .'" value="' . esc_attr(	$commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' /></div>',

				'url' =>
					'<div class="form-group comment-form-url">' .
					'<input id="url" class="form-control" name="url" type="text" placeholder="Website" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" /></div>'
				)
			),
		);
	?>

	<?php comment_form( $args ); ?>

<!-- #comments --></div>