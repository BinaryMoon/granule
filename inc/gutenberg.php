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

	// Custom colours for use in the editor. A nice way to provide consistancy
	// in user editable content.
	add_theme_support(
		'editor-color-palette',
		array(
			'name' => esc_html__( 'White', 'granule' ),
			'color' => '#ffffff',
		),
		array(
			'name' => esc_html__( 'Light Gray', 'granule' ),
			'color' => '#f5f5f5',
		),
		array(
			'name' => esc_html__( 'Black', 'granule' ),
			'color' => '#000000',
		)
	);

	// Add support for full width images and other content such as videos.
	// Remove this if the theme does not support a full width layout.
	add_theme_support( 'align-wide' );

}

add_action( 'after_setup_theme', 'granule_gutenberg_init' );


/**
 * Enqueue WordPress theme styles within Gutenberg.
 */
function granule_editor_blocks_styles() {

	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'granule-editor-blocks', get_theme_file_uri( '/assets/css/editor-blocks.css' ), null, '1.2' );

	// Editor Style.
	$fonts_url = granule_fonts();

	if ( $fonts_url ) {
		wp_enqueue_style( 'granule-fonts', $fonts_url );
	}

	/**
	 * Overwrite Core theme styles with empty styles.
	 * @see https://github.com/WordPress/gutenberg/issues/7776#issuecomment-406700703
	 */
	wp_deregister_style( 'wp-block-library-theme' );
	wp_register_style( 'wp-block-library-theme', '' );

}

add_action( 'enqueue_block_editor_assets', 'granule_editor_blocks_styles' );


/**
 * Modify post type arguments to add default post type templates.
 *
 * @param  array  $args      The default post type arguments.
 * @param  string $post_type The post type for the current request.
 * @return array             Modified arguments including the new template properties.
 */
function granule_post_type_arguments( $args, $post_type ) {

	// Only apply changes to the specified post type.
	if ( 'post' === $post_type ) {

		/**
		 * Adds a template property to the specified post type arguments.
		 *
		 * You can get a list of available blocks by entering the following js
		 * command in the console window in your brownser.
		 * wp.blocks.getBlockTypes()
		 *
		 * The output of this command also shows the available attributes for setting defaults.
		 *
		 * @var array
		 */
		$args['template'] = array(
			array( 'core/image' ),
			array(
				'core/paragraph',
				array(
					'placeholder' => esc_attr__( 'Start writing', 'granule' ),
				),
			),
			array( 'core/quote' ),
		);

	}

	return $args;

}

add_filter( 'register_post_type_args', 'granule_post_type_arguments', 20, 2 );
