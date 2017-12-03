<?php
/**
 * Theme Customizer
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/
 *
 * @package Granule
 * @subpackage ThemeCustomizerSettings
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Exit if we're not in the Customizer.
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {

	return null;

}


/**
 * Theme Customizer properties
 *
 * @param WP_Customize_Manager $wp_customize WP Customize object. Passed by WordPress.
 */
function granule_customizer_settings( WP_Customize_Manager $wp_customize ) {

	/**
	 * Granule theme options section.
	 */
	$wp_customize->add_section(
		'granule_options',
		array(
			'title' => esc_html__( 'Theme Options', 'granule' ),
		)
	);

	/**
	 * Setting to allow the categories under the header to be hidden.
	 */
	$wp_customize->add_setting(
		'granule_display_category_summaries',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'granule_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'granule_display_category_summaries',
		array(
			'label' => esc_html__( 'Display Category Summaries', 'granule' ),
			'section' => 'granule_options',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to allow the categories under the header to be hidden
	 */
	$wp_customize->add_setting(
		'granule_display_date_social',
		array(
			'default' => true,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'granule_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'granule_display_date_social',
		array(
			'label' => esc_html__( 'Display Date and Social Links in Header', 'granule' ),
			'section' => 'granule_options',
			'type' => 'checkbox',
		)
	);

	/**
	 * Setting to select a category to set as featured in the main site content
	 */
	$wp_customize->add_setting(
		'granule_primary_content_category',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'granule_sanitize_int',
		)
	);

	$wp_customize->add_control(
		new Granule_Category_Dropdown_Custom_Control(
			$wp_customize,
			'granule_primary_content_category',
			array(
				'label' => esc_html__( 'Homepage Category', 'granule' ),
				'section' => 'granule_options',
			)
		)
	);

	/**
	 * Setting to select a category to set as featured in the main site content
	 */
	$wp_customize->add_setting(
		'granule_archive_layout',
		array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'granule_sanitize_int',
		)
	);

	$wp_customize->add_control(
		new Granule_Dropdown_Custom_Control(
			$wp_customize,
			'granule_archive_layout',
			array(
				'label' => esc_html__( 'Homepage and Archive Layout', 'granule' ),
				'section' => 'granule_options',
				'default' => 0,
				'params' => array(
					0 => esc_html__( 'Granule Layout (default)', 'granule' ),
					1 => esc_html__( 'Brick Layout', 'granule' ),
					2 => esc_html__( '5 Column Grid', 'granule' ),
					5 => esc_html__( '3 Column Grid', 'granule' ),
					3 => esc_html__( '5 column Portrait Grid', 'granule' ),
					6 => esc_html__( '3 column Portrait Grid', 'granule' ),
					4 => esc_html__( 'Jumble Layout', 'granule' ),
				),
			)
		)
	);

	/**
	 * Setting to control whether the slider autoplays or not.
	 */
	$wp_customize->add_setting(
		'granule_autoplay_slider',
		array(
			'default' => false,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'granule_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'granule_autoplay_slider',
		array(
			'label' => esc_html__( 'Autoplay the Featured Content Slider', 'granule' ),
			'section' => 'granule_options',
			'type' => 'checkbox',
		)
	);

}

add_action( 'customize_register', 'granule_customizer_settings' );


/**
 * Update Theme Elements without refreshing content.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function granule_register_customize_refresh( WP_Customize_Manager $wp_customize ) {

	// Ensure selective refresh is enabled.
	if ( ! isset( $wp_customize->selective_refresh ) ) {

		return false;

	}

	// Update site title.
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector' => '.site-title',
			'render_callback' => function() {
				bloginfo( 'name' );
			},
		)
	);

	// Update site description.
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector' => '.site-description',
			'render_callback' => function() {
				bloginfo( 'description' );
			},
		)
	);

	// Show and hide header text.
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}

add_action( 'customize_register', 'granule_register_customize_refresh' );


/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 */
function granule_customize_preview_js() {

	wp_enqueue_script( 'granule-customize-preview', get_theme_file_uri( '/assets/scripts/customizer-preview.js' ), array( 'customize-preview' ), '1.0', true );

}

add_action( 'customize_preview_init', 'granule_customize_preview_js' );


/**
 * Sanitize checkbox input
 *
 * @param boolean $setting Value to check and sanitize.
 * @return boolean
 */
function granule_sanitize_checkbox( $setting ) {

	return (bool) $setting;

}


/**
 * Sanitize category list
 *
 * The list is comma separated. First split the string into items, then loop
 * through all categories and make sure they are ints then join them back
 * together again.
 *
 * @param string $setting Value to check and sanitize.
 * @return string comma separated list of category ids
 */
function granule_sanitize_categories( $setting ) {

	$clean_cats = array();
	$cats = explode( ',', $setting );

	foreach ( $cats as $c ) {
		$c = (int) $c;

		if ( $c > 0 ) {
			$clean_cats[] = $c;
		}
	}

	return implode( ',', $clean_cats );

}


/**
 * Sanitize the value of an integer.
 *
 * Can be used for dropdown controls, or any other controls where an integer is
 * expected.
 *
 * @param number $setting Value to sanitize.
 * @return integer
 */
function granule_sanitize_int( $setting ) {

	return (int) $setting;

}


/**
 * Sanitize colours
 *
 * Would be so much nicer if sanitize_hex_color was available to themes! :)
 *
 * @param string $color Value to sanitize.
 * @return hex|string Returns clean colour, or empty string if not a valid colour.
 */
function granule_sanitize_hex_color( $color ) {

	if ( '' === $color ) {

		return '';

	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {

		return $color;

	}

	return '';

}
