<?php
/**
 * Custom Header
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Granule
 * @subpackage CustomHeader
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Add theme support for Custom Header image.
 *
 * Sets the default properties and the custom header callback {@see granule_colour_styles}.
 */
function granule_custom_header_support() {

	add_theme_support(
		'custom-header',
		apply_filters(
			'granule_custom_header',
			array(
				// 'default-image' => '%s/images/x.jpg',
				'default-text-color' => '000000',
				'random-default' => false,
				'width' => 1500,
				'height' => 500,
				'flex-height' => true,
				'header-text' => true,
				'uploads' => true,
				'wp-head-callback' => 'granule_colour_styles',
			)
		)
	);

}

add_action( 'after_setup_theme', 'granule_custom_header_support' );


/**
 * Print custom header styles.
 *
 * May also change other CSS properties related to the header colours.
 */
function granule_colour_styles() {

	/**
	 * Take care of header text color and visibility.
	 */
	$header_text_color = get_header_textcolor();

	/**
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text.
	 * Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	if ( ! display_header_text() ) {
?>
<style>
	.masthead .site-title,
	.masthead .site-description {
		clip: rect( 1px, 1px, 1px, 1px );
		position: absolute;
	}
</style>
<?php
	} else {
?>
<style>
	.masthead .site-title,
	.masthead .site-title a,
	.masthead .site-title a:hover,
	.masthead p.site-description {
		color: #<?php echo esc_attr( $header_text_color ); ?>;
	}
</style>
<?php
	}

}


/**
 * Display header image and link to homepage.
 *
 * On singular pages display featured image if it is large enough to fill the
 * space. Uses get_queried_object_id in case the header image is called outside
 * the_loop (before the_post has been called) so that we can be sure featured
 * images are found.
 */
function granule_header() {

	$header_image = get_header_image();
	$header_image_width = get_theme_support( 'custom-header', 'width' );
	$header_image_actual_width = get_custom_header()->width;
	$header_image_actual_height = get_custom_header()->height;

	// Use custom headers on singular pages, but only if the image is large
	// enough.
	if ( apply_filters( 'granule_featured_image_header', is_singular() ) ) {

		// Use get_queried_object_id so that the content id will always be found
		// in cases where $post has not been set.
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_queried_object_id() ), 'granule-header' );

		if ( ! empty( $image ) && $image[1] >= $header_image_width ) {
			$header_image = $image[0];
			$header_image_actual_width = $image[1];
			$header_image_actual_height = $image[2];
		}
	}

	if ( ! empty( $header_image ) ) {
?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="header-image">
			<img src="<?php echo esc_url( $header_image ); ?>" width="<?php echo (int) $header_image_actual_width; ?>" height="<?php echo (int) $header_image_actual_height; ?>" alt="" />
		</a>
<?php
	}

}
