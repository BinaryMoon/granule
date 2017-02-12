<?php
/**
 * Child Pages Listing
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$image = get_the_post_thumbnail( get_the_ID(), 'granule-archive' );
?>

<div class="child-page">

<?php
	if ( $image ) {
?>

	<a href="<?php the_permalink(); ?>">
		<?php echo $image; // WPCS: XSS OK. ?>
	</a>

<?php
	}

	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

	the_excerpt();

?>
</div>
