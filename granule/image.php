<?php
/**
 * Image Attachment template
 *
 * @package Granule
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main class="main-content content-single" role="main">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">

<?php
	the_title( '<h1 class="entry-title">', '</h1>' );
	get_template_part( 'parts/post-meta' );
?>

			</header>

			<section class="entry">

				<div class="attachment-image">
					<?php echo wp_get_attachment_link( get_the_ID(), 'granule-attachment-fullsize' ); ?>
				</div>

<?php
	the_content();

	if ( $post->post_parent ) {
?>

				<nav id="image-navigation" class="navigation image-navigation" role="navigation">
					<div class="nav-links">
						<span class="nav-parent"><a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>" rev="attachment" class="attachment-parent"><?php esc_html_e( '&lsaquo; Return to post', 'granule' ); ?></a></span>
						<span class="nav-previous"><?php previous_image_link( false, esc_html__( 'Previous Image', 'granule' ) ); ?></span>
						<span class="nav-next"><?php next_image_link( false, esc_html__( 'Next Image', 'granule' ) ); ?></span>
					</div>
				</nav>

<?php
	}
?>

			</section>
		</article>

<?php
	get_template_part( 'parts/comments' );
?>

	</main>

<?php

	get_footer();
