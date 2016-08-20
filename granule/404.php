<?php
/**
 * Error - file not found
 *
 * @package Granule
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main role="main">

		<div class="header-404">
			<?php granule_svg( '404' ); ?>
		</div>

		<div class="main-content">

			<?php get_template_part( 'parts/content-empty' ); ?>

		</div>

	</main>

<?php
	get_footer();
