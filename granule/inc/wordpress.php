<?php
/**
 * Actions and Filters that customize WordPress
 *
 * @package Granule
 * @subpackage WordPress
 * @author Ben Gillbanks <ben@prothemedesign.com>
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU Public License
 */

/**
 * Enqueue scripts, styles, and fonts.
 *
 * Also sets javascript properties that need to access PHP.
 * Fonts are created with {@see granule_fonts}.
 *
 * @global type $wp_scripts
 */
function granule_enqueue() {

	// Styles.
	wp_enqueue_style( 'granule-style', get_stylesheet_uri(), null, '1.0' );

	// Fonts.
	$fonts_url = granule_fonts();

	if ( $fonts_url ) {
		wp_enqueue_style( 'granule-fonts', $fonts_url, array(), null );
	}

	// Javascript.
	// Always loaded in customizer for cases where widgets are added to an empty sidebar.
	if ( is_active_sidebar( 'sidebar-2' ) || ! is_singular() || is_customize_preview() ) {
		wp_enqueue_script( 'masonry' );
	}

	wp_enqueue_script( 'granule-script-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'granule-script-slider', get_template_directory_uri() . '/assets/js/jquery.slider.js', array( 'jquery' ), '1.3', false );

	// Localized Javascript strings and provide access to common properties.
	wp_localize_script(
		'granule-script-main',
		'site_settings',
		array(
			// Translation strings.
			'i18n' => array(
				'slide_next' => esc_html__( 'Next Slide', 'granule' ),
				'slide_prev' => esc_html__( 'Previous Slide', 'granule' ),
				/* translators: # is the slide number, it will be replaced with 1/ 2/ 3 etc */
				'slide_number' => esc_html__( 'Slide #', 'granule' ),
				'slide_controls_label' => esc_html__( 'Slider Buttons', 'granule' ),
				'menu' => esc_html__( 'Menu', 'granule' ),
			),
			// Slider settings.
			'slider' => array(
				'autoplay' => ( get_theme_mod( 'granule_autoplay_slider', true ) ) ? 1 : 0,
			),
			// Properties that are usable through javascript.
			'is' => array(
				'home' => is_front_page(),
				'single' => is_single(),
				'archive' => is_archive(),
			),
		)
	);

	// Comments Javascript.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

add_action( 'wp_enqueue_scripts', 'granule_enqueue' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * The theme is responsive so the width is likely to be narrower than the value set.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function granule_content_width() {

	$width = 900;

	// If using 'full width' template.
	if ( is_page_template( 'templates/full-width-page.php' ) ) {

		$width = 780;

	}

	$GLOBALS['content_width'] = apply_filters( 'granule_content_width', $width );

}

add_action( 'after_setup_theme', 'granule_content_width', 0 );


/**
 * Get url for embedding Google fonts.
 *
 * Output can be filtered with 'granule_fonts' filter.
 *
 * @return string|boolean Font url or false if there are no fonts.
 */
function granule_fonts() {

	$fonts = array();

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Merriweather: on or off', 'granule' ) ) {
		$fonts['merriweather'] = 'Merriweather:300,700,300italic';
	}

	/* translators: If there are characters in your language that are not supported by Merriweather Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== esc_html_x( 'on', 'Merriweather Sans: on or off', 'granule' ) ) {
		$fonts['merriweather-sans'] = 'Merriweather Sans:300,700,300italic';
	}

	// Filter fonts. Allows them to be disabled/ added to.
	$fonts = apply_filters( 'granule_fonts', $fonts );

	if ( $fonts ) {
		// Build font embed query string.
		$query_args = array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		return add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return false;

}


/**
 * Set up all the theme properties and extras.
 *
 * Also adds fonts to editor styles {@see granule_fonts}.
 */
function granule_after_setup_theme() {

	load_theme_textdomain( 'granule', get_template_directory() . '/languages' );

	// Title Tag.
	add_theme_support( 'title-tag' );

	// Feed me.
	add_theme_support( 'automatic-feed-links' );

	// Post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Attachment (image.php) page links.
	add_image_size( 'granule-attachment', 250, 250, true );

	// Ideal header image size.
	add_image_size( 'granule-header', 1500, 500, true );

	// Archive/ homepage thumbnails.
	add_image_size( 'granule-archive', 500, 500, true );

	// Attachment page size.
	add_image_size( 'granule-attachment-fullsize', 1200, 9999 );

	// Custom background.
	add_theme_support(
		'custom-background',
		apply_filters(
			'granule-custom-background',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// HTML5 FTW.
	add_theme_support(
		'html5',
		array(
			'comment-list',
			'comment-form',
			'gallery',
			'caption',
		)
	);

	// Post Formats.
	add_theme_support(
		'post-formats',
		array(
			'quote',
			'video',
			'image',
			'gallery',
			'audio',
		)
	);

	// Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'height' => 500,
			'width' => 500,
			'flex-height' => true,
			'flex-width' => true,
		)
	);

	// Menus.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Header Top', 'granule' ),
			'menu-2' => esc_html__( 'Header Bottom', 'granule' ),
		)
	);

	// Editor Style.
	if ( $fonts_url = granule_fonts() ) {
		add_editor_style( $fonts_url );
	}

	add_editor_style( 'assets/css/editor-styles.css' );

}

add_action( 'after_setup_theme', 'granule_after_setup_theme' );


/**
 * Intitiate sidebars
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 */
function granule_widgets_init() {

	// Sidebar.
	register_sidebar(
		array(
			'name' => esc_html__( 'Sidebar Widgets', 'granule' ),
			'id' => 'sidebar-1',
			'description' => esc_html__( 'Widgets that display on the side of your website', 'granule' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

	// Footer Widgets.
	register_sidebar(
		array(
			'name' => esc_html__( 'Footer Widgets', 'granule' ),
			'id' => 'sidebar-2',
			'description' => esc_html__( 'Widgets that display at the bottom of your website. They are arranged in 4 columns and lined up automatically to make the best use of the space available.', 'granule' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget' => '</div></section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);

}

add_action( 'widgets_init', 'granule_widgets_init' );


/**
 * Set a custom excerpt length.
 *
 * The WordPress default excerpt length is 55.
 *
 * @param type $length length of excerpt.
 * @return int
 */
function granule_excerpt_length( $length ) {

	return 60;

}

add_filter( 'excerpt_length', 'granule_excerpt_length', 999 );


/**
 * Fallback for navigation menu
 *
 * @param array $params list of menu parameters.
 * @return string
 */
function granule_nav_menu( $params ) {

	$echo = $params['echo'];

	$params['echo'] = false;
	$html = wp_page_menu( $params );

	if ( $params['container'] ) {

		$container_start = '<' . esc_attr( $params['container'] ) . ' id="' . esc_attr( $params['container_id'] ) . '" class="' . esc_attr( $params['container_class'] ) . '">';
		$container_end = '</' . esc_attr( $params['container'] ) . '>';

		$html = str_replace( '<div class="' . esc_attr( $params['menu_class'] ) . '">', $container_start, $html );
		$html = str_replace( '</div>', $container_end, $html );

	}

	if ( $echo ) {
		echo $html;
	}

	return $html;

}


/**
 * Add additional body classes to body_class function call.
 *
 * Checks to see if theme has featured posts using {@see granule_has_featured_posts}.
 *
 * @param array $classes Array of body classes.
 * @return array
 */
function granule_body_class( $classes ) {

	if ( is_multi_author() ) {
		$classes[] = 'multi-author-true';
	} else {
		$classes[] = 'multi-author-false';
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'themes-sidebar1-active';
	} else {
		$classes[] = 'themes-sidebar1-inactive';
	}

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'themes-sidebar2-active';
	} else {
		$classes[] = 'themes-sidebar2-inactive';
	}

	if ( granule_has_featured_posts() ) {
		$classes[] = 'themes-has-featured-posts';
	} else {
		$classes[] = 'themes-no-featured-posts';
	}

	if ( get_header_image() ) {
		$classes[] = 'has-custom-header';
	}

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;

}

add_filter( 'body_class', 'granule_body_class' );


/**
 * Add additional post classes to post_class function call.
 *
 * @param array $classes Array of post classes.
 * @return array
 */
function granule_post_class( $classes ) {

	if ( $image = get_the_post_thumbnail( get_the_ID() ) ) {

		$classes[] = 'post-has-thumbnail';

	} else {

		$classes[] = 'post-no-thumbnail';

	}

	/**
	 * Removes hentry class from the array of post classes.
	 * Currently, having the class on pages is not correct use of hentry.
	 * hentry requires more properties than pages typically have.
	 * Core is not likely to remove class because of backward compatibility.
	 * See: https://core.trac.wordpress.org/ticket/28482
	 */
	if ( 'page' === get_post_type() ) {

		$classes = array_diff( $classes, array( 'hentry' ) );

	}

	/**
	 * Remove this if you need to add text contrast to images
	if ( isset( $image[0] ) ) {

		$tone = granule_image_tone( $image[0] );

		if ( $tone ) {
			$classes[] = $tone;
		}
	}
	 */

	return $classes;

}

add_filter( 'post_class', 'granule_post_class' );


/**
 * Change the truncation text on excerpts to something more useful.
 *
 * Replaces '[...]' (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function granule_excerpt_more() {

	$link = sprintf( '<a href="%1$s" class="read-more">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		sprintf( esc_html_x( 'Continue Reading %s', 'Name of current post', 'granule' ), '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>' )
	);

	return ' &hellip; ' . $link;

}

add_filter( 'excerpt_more', 'granule_excerpt_more' );


/**
 * Add post terms (categories and tags) to the_content.
 *
 * Using this through the_content filter places it before the related posts,
 * social sharing, and other Jetpack content, which gives it more context.
 *
 * @param string $content The original post content.
 * @return string The modified post content.
 */
function granule_post_terms( $content = '' ) {

	// Ignore if on archive pages.
	if ( ! is_single() ) {
		return $content;
	}

	// Make sure it only happens on blog posts.
	if ( 'post' !== get_post_type( get_the_ID() ) ) {
		return $content;
	}

	$terms = '';

	// Add Categories.
	$terms .= '<p class="taxonomy tax-categories">' . get_the_category_list( esc_html_x( ', ', 'Category/ Tag list separator (includes a space after the comma)', 'granule' ) ) . '</p>';

	// Add Tags.
	if ( get_the_tags( get_the_ID() ) ) {
		$terms .= '<p class="taxonomy tax-tags">' . get_the_tag_list( '', esc_html_x( ', ', 'Category/ Tag list separator (includes a space after the comma)', 'granule' ), '' ) . '</p>';
	}

	// Output everything.
	$content .= '<div class="taxonomies">' . $terms . '</div>';

	return $content;

}

add_filter( 'the_content', 'granule_post_terms' );


/**
 * Wrap post content with a standard div that can be styled in any way.
 *
 * This means the content can be customized without affecting other things that
 * get appended/ prepended to the_content such as Jetpack related posts.
 *
 * @param string $content The content to be wrapped.
 * @return string Modified content with html wrapper.
 */
function granule_wrapper_content( $content ) {

	if ( ! is_singular() ) {

		return $content;

	}

	// Includes some new line characters so that paragraphs tags are properly applied to all paragraphs.
	return '<div class="the-content">' . "\n\n" . $content . "\n\n" . '</div>';

}

add_filter( 'the_content', 'granule_wrapper_content', 9 );


/**
 * Add a span around the title prefix so that the prefix can be hidden with CSS if desired.
 *
 * @param string $title Archive title.
 * @return string Archive title with inserted span around prefix.
 */
function granule_wrap_the_archive_title( $title ) {

	// Skip if the site isn't LTR, this is visual, not functional.
	// Should try to work out an elegant solution that works for both directions.
	if ( is_rtl() ) {
		return $title;
	}

	// Split the title into parts so we can wrap them with spans.
	$title_parts = explode( ': ', $title, 2 );

	// Glue it back together again.
	if ( ! empty( $title_parts[1] ) ) {
		$title = '<span>' . esc_html( $title_parts[0] ) . ': </span>' . wp_kses( $title_parts[1], array( 'span' => array( 'class' => array() ) ) );
	}

	return $title;

}

add_filter( 'get_the_archive_title', 'granule_wrap_the_archive_title' );


/**
 * Add a span to the category and tag listings.
 *
 * Gives them consistent html for simpler CSS styles.
 *
 * @param string $cat_list HTML containing list of categories/ tags.
 * @return string
 */
function granule_category_list_span( $cat_list ) {

	$cat_list = str_replace( 'tag">', 'tag"><span>', $cat_list );
	$cat_list = str_replace( '</a>', '</span></a>', $cat_list );

	return $cat_list;

}

add_filter( 'the_category', 'granule_category_list_span' );
add_filter( 'the_tags', 'granule_category_list_span' );


/**
 * Standardize menu classes.
 *
 * Reduces inconsistencies in menu classes.
 * These occur when using pages/ categories as the menu fallback.
 * This allows the css styles to be simpler since we only have to accomadate one
 * menu class.
 *
 * @param string $menu_html Page menu in a html list.
 * @return string
 */
function granule_change_menu( $menu_html = '' ) {

	$menu_html = str_replace( 'page_item_has_children', 'menu-item-has-children', $menu_html );

	return $menu_html;

}

add_filter( 'wp_page_menu','granule_change_menu' );


/**
 * Change the colour of the Google url bar to match the background colour of the site.
 *
 * This helps to improve branding and personalisation.
 *
 * @link https://developers.google.com/web/updates/2014/11/Support-for-theme-color-in-Chrome-39-for-Android
 */
function granule_theme_colour() {

	// Use the user defined background colour.
	$colour = get_background_color();

	if ( ! empty( $colour ) ) {
?>
		<meta name="theme-color" content="#<?php echo esc_attr( $colour ); ?>">
<?php
	}

}

add_filter( 'wp_head', 'granule_theme_colour' );


/**
 * Standardize wp_link_pages html so that it matches that used in the_posts_pagination.
 *
 * This allows simpler styling, and consistent CSS.
 *
 * @param  string $html Link html.
 * @return string       Modified html.
 */
function granule_link_pages_link( $html ) {

	$html = str_replace( '<a ', '<a class="page-numbers" ', $html );

	// No link so must be the current page.
	if ( false === strpos( $html, '<a ' ) ) {

		$html = '<span class="page-numbers current">' . $html . '</span>';

	}

	return $html;

}

add_filter( 'wp_link_pages_link', 'granule_link_pages_link' );


/**
 * Include svg symbols so that they can be 'used' with the {@see granule_svg} function.
 *
 * This uses `wp_footer` to place the svgs at the bottom of the page, which now
 * works in all major browsers.
 */
function granule_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/svg/svg.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {

		// The 'svg-defs' is hidden so that the reusable svgs are not visible.
		echo '<span class="svg-defs">';
		require_once( $svg_icons );
		echo '</span>';

	}

}

add_action( 'wp_footer', 'granule_include_svg_icons' );
