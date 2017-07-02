<?php
/**
 * Footer Template
 *
 * The template for displaying the site footer. This includes the closing divs
 * that close the content opened in header.php - and all of the content after
 * (credits, widgets etc.)
 *
 * @link https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#footer-php
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	get_sidebar();
?>

	</div>

	<footer id="footer">

<?php
	get_sidebar( 'footer' );

	granule_social_links();
?>

		<a href="#header" class="scroll-to scroll-to-top">
<?php
	echo granule_svg( 'navigate-top' ); /* WPCS: xss ok. */
	esc_html_e( 'Top', 'granule' );
?>
		</a>

<?php

	/**
	 * Check to see if a custom credits option is set.
	 * If custom credits are set then the filter should output the credits and
	 * return a non false value. This will hide the default footer credits.
	 */
	if ( false === apply_filters( 'granule_credits', false ) ) {

?>

		<section id="colophon" class="site-footer">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'granule' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'granule' ); ?>" rel="generator"><?php
				/* Translators: %s = WordPress (cms name) */
				printf( esc_html__( 'Proudly powered by %s', 'granule' ), 'WordPress' );
?></a>
				<span class="sep"> | </span>
<?php
		/* Translators: %1$s = theme name, %2$s = theme author website */
		printf( esc_html__( 'Theme: %1$s by %2$s.', 'granule' ), 'Granule', '<a href="https://prothemedesign.com/">Pro Theme Design</a>' );
?>
			</div>
		</section>

<?php

	}

?>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
