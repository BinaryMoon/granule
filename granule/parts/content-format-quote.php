<?php
/**
 * Quote content
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	$content = get_the_content();

	preg_match( '/<blockquote>(.*?)<\/blockquote>/s', $content, $matches );

	if ( ! empty( $matches[1] ) ) {

		$content = $matches[1];

	}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<blockquote>

		<?php echo wp_kses_post( wpautop( $content ) ); ?>

		<span class="permalink">
			<a href="<?php the_permalink(); ?>">
				<?php echo esc_html_x( '#', 'A symbol used to link to a blog post', 'granule' ); ?>
				<span class="screen-reader-text"><?php printf( esc_html__( 'Permanent link to %s', 'granule' ), get_the_title() ); ?></span>
			</a>
		</span>

	</blockquote>

</article>
