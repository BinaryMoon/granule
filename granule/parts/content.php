<?php
/**
 * Generic content
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$image = get_the_post_thumbnail( get_the_ID(), 'granule-archive' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	get_template_part( 'parts/post-meta' );
?>

	<section class="entry entry-archive">

<?php
	if ( $image ) {
?>

	<a href="<?php echo esc_url( get_permalink() ); ?>" class="thumbnail">
		<?php echo $image; ?>
	</a>

<?php
	}

	the_excerpt();
?>

		<p><a href="<?php the_permalink(); ?>" class="read-more"><?php granule_read_more_text(); ?></a></p>

	</section>

</article>
