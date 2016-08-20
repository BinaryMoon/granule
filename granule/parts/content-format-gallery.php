<?php
/**
 * Gallery content
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$gallery = get_post_gallery( get_the_ID() );

	// No gallery so use default layout.
	if ( ! $gallery ) {

		get_template_part( 'parts/content' );
		return;

	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-gallery">
		<?php echo $gallery; ?>
	</div>

	<section class="entry entry-archive">

<?php
	if ( get_the_title() ) {
?>

		<h2 class="entry-title">
			<a href="<?php the_permalink() ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

<?php
	}

	get_template_part( 'parts/post-meta' );
?>

	</section>

</article>
