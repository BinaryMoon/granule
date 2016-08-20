<?php
/**
 * Footer Sidebar template
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	if ( is_active_sidebar( 'sidebar-2' ) ) {
?>

<!-- Sidebar Footer (2) -->

<aside class="footer-widgets sidebar-footer sidebar" role="complementary">

<?php
	dynamic_sidebar( 'sidebar-2' );
?>

</aside>

<?php
	}
