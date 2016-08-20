<?php
/**
 * Sidebar template
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	// if ( is_singular() && is_active_sidebar( 'sidebar-1' ) ) {
	// if ( is_active_sidebar( 'sidebar-1' ) && ! is_page_template( 'templates/full-width-page.php' ) ) {
	if ( is_active_sidebar( 'sidebar-1' ) ) {
?>

<!-- Sidebar Main (1) -->

<aside class="sidebar sidebar-main" role="complementary">

<?php
	do_action( 'before_sidebar' );
	dynamic_sidebar( 'sidebar-1' );
?>

</aside>

<?php
	}
