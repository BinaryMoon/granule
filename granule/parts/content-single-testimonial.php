<?php
/**
 * Individual Testimonial layout
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$image = get_the_post_thumbnail( get_the_ID(), 'granule-attachment', array( 'class' => 'avatar' ) );
?>

<article id="post-<?php the_ID(); ?>" class="testimonial">

	<div class="entry">

<?php
	the_content(
		sprintf(
			esc_html__( 'Read more %s', 'granule' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		)
	);
?>

	</div>

	<div class="entry-meta">

<?php
	if ( $image ) {
		echo $image;
	}
?>

		<h3><?php the_title(); ?></h3>

	</div>

</article>
