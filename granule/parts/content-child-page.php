<?php
/**
 * Child pages listing
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
	<a href="<?php the_permalink(); ?>"><?php echo $image; ?></a>
<?php
	}
?>

	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>

	<?php the_excerpt(); ?>

</div>
