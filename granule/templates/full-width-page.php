<?php
/**
 * Full width page template
 * Template Name: Full Width
 *
 * @package Granule
 * @subpackage PageTemplate
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main role="main" class="full-width">

		<div class="main-content content-single">

<?php
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			get_template_part( 'parts/content-single', get_post_type() );
			get_template_part( 'parts/comments' );

		}
	}
?>

		</div>

	</main>

<?php
	get_footer();
