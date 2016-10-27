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

	if ( post_password_required() ) {
		return;
	}
?>

	<section class="content-comments">

<?php
	if ( have_comments() ) {
?>

		<h2 id="comments" class="comments-title">

<?php
		printf(
			esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'granule' ) ),
			(int) number_format_i18n( get_comments_number() ),
			'<span>' . get_the_title() . '</span>'
		);
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
				'avatar_size' => 80,
				'short_ping' => true,
				'reply_text' => granule_svg( 'reply', false ) . '<span class="screen-reader-text">' . esc_html__( 'Reply', 'granule' ) . '</span>',
			)
		);
?>

		</ol>

<?php
		the_comments_navigation();

	} // End if().

	if ( 'open' === $post->comment_status ) {

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
?>

		<div class="user-icon-container">
			<?php granule_svg( 'user' ); ?>
		</div>

	</section>
