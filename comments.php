<?php
/**
 * Comments Template
 *
 * Displays the comments, and the comment submission form.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#comments-php
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	// Ignore comments if a password is required.
	if ( post_password_required() ) {
		return;
	}

	// Ensure the current post type supports comments.
	if ( ! post_type_supports( get_post_type(), 'comments' ) ) {
		return;
	}

	// Only display this if there are comments posted, or the comments are open
	// for publishing.
	if ( have_comments() || comments_open() ) {

?>

	<section class="content-comments">

<?php
		if ( have_comments() ) {
?>

		<h2 id="comments" class="comments-title">

<?php

			$comment_count = (int) get_comments_number();

			if ( 1 === $comment_count ) {

				printf(
					/* Translators: %1$s: Post title */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'granule' ),
					'<span>' . get_the_title() . '</span>'
				);

			} else {

				printf( // WPCS: XSS OK.
					esc_html(
						/* Translators: %1$s: Comment count, %2$s: Post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comment_count,
							'comments title',
							'granule'
						)
					),
					number_format_i18n( $comment_count ),
					'<span>' . get_the_title() . '</span>'
				);

			}

?>

			<a href="#respond" class="scroll-to">
				<span class="screen-reader-text"><?php esc_html_e( 'Leave a comment', 'granule' ); ?></span>
				<?php esc_html_e( '&rsaquo;', 'granule' ); ?>
			</a>

		</h2>

		<ol class="comment-list" id="singlecomments">

<?php
			wp_list_comments(
				array(
					'style' => 'ol',
					'avatar_size' => apply_filters( 'granule_comments_avatar_size', 80 ),
					'short_ping' => true,
					'reply_text' => granule_svg( 'reply', false ) . '<span class="screen-reader-text">' . esc_html__( 'Reply', 'granule' ) . '</span>',
				)
			);
?>

		</ol>

<?php

			the_comments_navigation();

		} // End if().

		if ( comments_open() ) {

			comment_form(
				array(
					'title_reply_before' => '<h2 class="comment-reply-title">',
					'title_reply_after'  => '</h2>',
					'cancel_reply_before' => '',
					'cancel_reply_after' => '',
					'cancel_reply_link' => granule_svg( 'close', false ) . '<span class="screen-reader-text">' . esc_html__( 'Cancel Reply', 'granule' ) . '</span>',
				)
			);

		}

		// If there are existing comments and comments are now disabled then
		// display a message letting visitors know why they can't post new
		// comments.
		if ( ! comments_open() && $comment_count > 0 ) {
?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'granule' ); ?></p>

<?php
		}
?>

		<div class="user-icon-container">
			<?php granule_svg( 'user' ); ?>
		</div>

	</section>

<?php
	} // End if().
