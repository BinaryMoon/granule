<?php
/**
 * Gutenberg Compatibility File
 *
 * @package Granule
 * @subpackage Gutenberg
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @link https://github.com/WordPress/gutenberg/
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add theme support for Gutenberg.
 */
function granule_gutenberg_init() {

	/**
	 * Add theme support for Gutenberg functionality.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
	 */
	add_theme_support(
		'gutenberg',
		array(
			// Full width images and other content such as videos.
			// Remove this if the theme does not support a
			// full width layout.
			'wide-images' => true,

			// Custom colours for use in the editor. A nice way to provide
			// consistancy in user editable content.
			'colors' => array(
				'#ffffff',
				'#ffffff',
				'#ffffff',
				'#ffffff',
				'#ffffff',
				'#ffffff',
			),
		)
	);

}

add_action( 'after_setup_theme', 'granule_gutenberg_init' );


/**
 * Enqueue WordPress theme styles within the Gutenberg editor.
 */
function granule_gutenberg_styles() {

	// Load the theme styles within Gutenberg.
	// wp_enqueue_style( 'granule-gutenberg', get_theme_file_uri( '/assets/css/gutenberg.css' ), false, '1.0', 'all' );

}

add_action( 'enqueue_block_editor_assets', 'granule_gutenberg_styles' );
