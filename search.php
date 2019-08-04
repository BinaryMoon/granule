<?php
/**
 * Search Results Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Granule
 * @subpackage Template
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_header();
?>

	<main id="main">

		<header class="entry-archive-header">

			<h1 class="entry-title entry-archive-title">
<?php
		printf(
			wp_kses(
				/* Translators: %s: Search query */
				__( '<span>Search results for:</span> %s', 'granule' ),
				array(
					'span' => array(),
				)
			),
			esc_html( get_search_query() )
		);
?>
			</h1>

		</header>

		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>

		<div id="infinite-scroll" class="content-masonry-wrapper">

			<div id="main-content" class="main-content content-posts content-masonry">

<?php

	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();
			get_template_part( 'parts/content', 'format-' . get_post_format() );

		}
?>

			</div>

		</div>

<?php

		the_posts_pagination(
			array(
				'mid_size' => 2,
				'prev_text' => esc_html__( 'Newer', 'granule' ),
				'next_text' => esc_html__( 'Older', 'granule' ),
				'before_page_number' => '<span class="screen-reader-text"> ' . __( 'page', 'granule' ) . ' </span>',
			)
		);

	}

?>

	</main>

<?php
	get_footer();
