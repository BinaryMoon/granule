<?php
/**
 * Generic search form template
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">

	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'granule' ); ?></span>
		<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="search-field text" placeholder="<?php echo esc_attr_x( 'Search...', 'search input placeholder text', 'granule' ); ?>" />
	</label>

	<button class="search-submit"><?php granule_svg( 'search' ); ?><span class="screen-reader-text"><?php echo esc_html__( 'Search', 'granule' ); ?></span></button>

</form>
