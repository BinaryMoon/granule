<?php
/**
 * Edit Post Link
 *
 * @package Granule
 * @subpackage TemplatePart
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			wp_kses( __( 'Edit<span class="screen-reader-text"> %s</span>', 'granule' ), array( 'span' => array( 'class' => array() ) ) ),
			get_the_title()
		),
		'<span class="edit-link meta">',
		'</span>'
	);
