<?php
/**
 * Edit post link
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'granule' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
