<?php
/**
 * Jetpack Featured Content
 *
 * @link https://jetpack.me/support/featured-content/
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	if ( granule_has_featured_posts() ) {

		$featured_posts = granule_get_featured_posts( 4 );
?>

	<section class="showcase">

<?php
		foreach ( $featured_posts as $post ) {

			setup_postdata( $post );

			$styles = array();
			$image = granule_archive_image_url( get_the_ID(), 'granule-archive' );

			if ( $image ) {

				$styles = array(
					'background-image: url(' . esc_url( $image ) . ');'
				);

			}
?>

		<article <?php post_class(); ?> style="<?php echo esc_attr( implode( ' ', $styles ) ); ?>">

			<a href="<?php the_permalink(); ?>" class="entry" rel="bookmark">
				<h2 class="entry-title"><?php the_title(); ?></h2>
			</a>

		</article>

<?php
		}
?>

	</section>

<?php
		wp_reset_postdata();
	}
