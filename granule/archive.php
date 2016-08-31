<?php
/**
 * Archive Template
 *
 * @package Granule
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main role="main">

<?php
	if ( have_posts() ) {
?>

		<header class="entry-archive-header">

<?php
		the_archive_title( '<h1 class="entry-title entry-archive-title">', '</h1>' );
		the_archive_description( '<div class="category-description">', '</div>' );

		if ( 'jetpack-portfolio' === get_post_type() ) {
			granule_project_terms();
		}
?>

		</header>

		<div id="main-content" class="main-content content-posts">

<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );
		}
?>

		</div>

<?php
		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => esc_html__( 'Older', 'granule' ),
				'next_text' => esc_html__( 'Newer', 'granule' ),
			)
		);

	} else {
?>

		<div class="main-content">

			<?php get_template_part( 'parts/content-empty' ); ?>

		</div>

<?php
	}
?>

	</main>

<?php
	get_footer();
