<?php
/**
 * Footer Template
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

		<section class="footer-wrap" role="contentinfo">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'granule' ) ); ?>" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'granule' ); ?>" rel="generator"><?php printf( esc_html__( 'Proudly powered by %s', 'granule' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'granule' ), 'Granule', '<a href="https://prothemedesign.com/" rel="designer">Pro Theme Design</a>' ); ?>
		</section>

	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
