<?php
/**
 * No content
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>
<article class="page-404 main-content post-singular no-results not-found">

	<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'granule' ); ?></h1>

	<section class="entry">

<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {
?>

		<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'granule' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php
	} if ( is_search() ) {
?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'granule' ); ?></p>

		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>

<?php
	} else {
?>

		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'granule' ); ?></p>

		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>

<?php
	}
?>

	</section>

</article>
