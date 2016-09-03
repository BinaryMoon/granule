<?php
/**
 * Search results template
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

			<h1 class="entry-title entry-archive-title">
				<?php printf( esc_html__( 'Search results for: %s', 'granule' ), esc_html( get_search_query() ) ); ?>
			</h1>

		</header>

		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>

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
