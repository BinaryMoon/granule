/**
 * main.js v1
 *
 * The main javascript file for the theme, this makes the magic happen
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @package Granule
 */
 /* global site_settings */

;( function( window, document, $ ) {

	'use strict';

	/**
	 * JS mobile detection
	 * Is this a touch enabled device or not?
	 *
	 * @return boolean
	 */
	var is_touch_device = function() {

		return ( ( 'ontouchstart' in window ) || ( navigator.MaxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 ) );

	};


	/**
	 * Smooth scroll to # anchor
	 *
	 * @param  object e Element.
	 * @return false
	 */
	var scroll_to_hash = function( e ) {

		var $target = $( e.hash );

		if ( $target.length ) {
			var targetOffset = $target.offset().top - parseInt( $( 'html' ).css( 'margin-top' ) );
			$( 'html,body' ).animate( { scrollTop: targetOffset }, 750 );
			focus_element( e.hash );
		}

		return false;

	};


	/**
	 * Set an elements focus.
	 * if required sets a tabindex for elements that can't normally be focused
	 *
	 * @param  string id ID of object to focus.
	 */
	var focus_element = function( id ) {

		var element = document.getElementById( id.replace( '#', '' ) );

		if ( element ) {

			if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
				element.tabIndex = -1;
			}

			element.focus();
		}

	};


	/**
	 * Set default heights for social media widgets
	 */
	var social_widget_heights = function() {

		// Twitter
		$( 'a.twitter-timeline' ).each(
			function() {

				var thisHeight = $( this ).attr( 'height' );
				$( this ).parent().css( 'min-height', thisHeight + 'px' );

			}
		);

		// Facebook
		$( '.fb-page' ).each(
			function() {

				var $set_height = $( this ).data( 'height' );
				var $show_facepile = $( this ).data( 'show-facepile' );
				var $show_posts = $( this ).data( 'show-posts' ); // AKA stream
				var $min_height = $set_height; // set the default 'min-height'

				// These values are defaults from the FB widget.
				var $no_posts_no_faces = 130;
				var $no_posts = 220;

				if ( $show_posts ) {

					// Showing posts; may also be showing faces and/or cover -
					// the latter doesn't affect the height at all.
					$min_height = $set_height;

				} else if ( $show_facepile ) {

					// Showing facepile with or without cover image - both would
					// be same height.
					// If the user selected height is lower than the no_posts
					// height, we'll use that instead
					$min_height = ( $set_height < $no_posts ) ? $set_height : $no_posts;

				} else {

					// Either just showing cover, or nothing is selected (both
					// are same height).
					// If the user selected height is lower than the
					// no_posts_no_faces height, we'll use that instead
					$min_height = ( $set_height < $no_posts_no_faces ) ? $set_height : $no_posts_no_faces;

				}

				// apply min-height to .fb-page container
				$( this ).css( 'min-height', $min_height + 'px' );

			}
		);

	};

	/**
	 * Attachment page navigation
	 */
	var attachment_page_navigation = function() {

		if ( $( 'body' ).hasClass( 'attachment' ) ) {

			$( document ).keydown(
				function( e ) {

					if ( $( 'textarea, input' ).is( ':focus' ) ) {
						return;
					}

					var url = false;

					switch( e.which ) {

						// left arrow key (previous attachment)
						case 37:
							url = $( '.image-previous a' ).attr( 'href' );
							break;

						// right arrow key (next attachment)
						case 39:
							url = $( '.image-next a' ).attr( 'href' );
							break;

					}

					if ( url.length ) {
						window.location = url;
					}

				}
			);

		}

	};

	/**
	 * Setup Masonry layouts
	 */
	var masonry_setup = function() {

		// Masonry grid sizer.
		$( '#main-content, .sidebar-footer' ).prepend( '<div class="grid-sizer"></div>' );

		// Blog post content.
		var $grid = $( '#main-content' ).masonry(
			{
				itemSelector: 'article',
				columnWidth: '.grid-sizer',
				gutter: 0,
				isOriginLeft: ! $( 'body' ).is( '.rtl' ),
				percentPosition: true
			}
		);

		// Update again once images have loaded.
		$grid.imagesLoaded(
			function() {

				$grid.masonry( 'layout' );
				$grid.children().addClass( 'post-loaded' );

			}
		);

		// Update on infinite scroll load.
		$( 'body' ).on(
			'post-load',
			function() {

				var $new_articles = $( '#main-content' ).children().not( '.post-loaded, .infinite-loader' ).addClass( 'post-loaded' );
				$grid.masonry( 'appended', $new_articles );

				$new_articles.imagesLoaded(
					function () {
						$grid.masonry( 'layout' );
					}
				);

			}
		);

		// Footer widgets.
		$( '.sidebar-footer .widget' ).imagesLoaded(
			function() {

				var $footer_widgets = $( '.sidebar-footer' ).masonry(
					{
						itemSelector: '.widget',
						columnWidth: '.grid-sizer',
						gutter: 0,
						isOriginLeft: ! $( 'body' ).is( '.rtl' ),
						percentPosition: true
					}
				);

				setTimeout(
					function() {
						$footer_widgets.masonry( 'layout' );
					},
					2000
				);

			}
		);

		// testimonials
		$( 'body.archive .testimonials' ).imagesLoaded(
			function() {

				$( 'body.archive .testimonials' ).masonry(
					{
						itemSelector: '.testimonial',
						gutter: 0,
						isOriginLeft: ! $( 'body' ).is( '.rtl' )
					}
				);

			}
		);

	};


	/**
	 * Do all the stuffs.
	 */
	$( document ).ready(
		function() {

			social_widget_heights();

			attachment_page_navigation();

			// masonry layout

			$( window ).load(
				function() {

					if ( $.isFunction( $.fn.masonry ) ) {

						masonry_setup();

					}

				}
			);


			// featured content slides

			if ( $.isFunction( $.fn.elementalSlides ) ) {

				$( '.showcase' ).elementalSlides(
					{
						'nav_arrows': true,
						'autoplay': parseInt( site_settings.slider.autoplay )
					}
				);

			}


			// fade in infinite scroll posts

			$( '#main-content' ).find( 'article' ).addClass( 'post-static' );

			$( 'body' ).on(
				'post-load',
				function() {

					$( '#main-content' ).find( 'article' ).not( '.post-loaded, .post-static' ).addClass( 'post-loaded' );

				}
			);


			// menu toggle

			$( '.menu-toggle' ).on(
				'click',
				function() {

					var $parent = $( this ).parent();
					var $menu = $parent.find( '#nav' );
					var $this = $( this );

					$parent.toggleClass( 'menu-on' );

					// menu is shown
					if ( $parent.hasClass( 'menu-on' ) ) {

						$menu.attr( 'aria-expanded', 'true' );
						$this.attr( 'aria-expanded', 'true' );

					// menu is hidden
					} else {

						$menu.attr( 'aria-expanded', 'false' );
						$this.attr( 'aria-expanded', 'false' );

					}

				}
			);


			// set menu items with submenus to aria-haspopup="true".

			$( '.menu-item-has-children' ).each(
				function() {

					$( this ).attr( 'aria-haspopup', 'true' );

				}
			);


			// dropdown menu touch screen improvements

			$( '.menu' ).find( 'a' ).on(
				'focus blur',
				function() {

					$( this ).parents().toggleClass( 'focus' );

				}
			);


			// smooth scroll to element

			$( '.scroll-to' ).click(
				function() {

					return scroll_to_hash( this );

				}
			);


			// mobile device detection

			$( 'body' ).addClass( is_touch_device() ? 'device-touch' : 'device-click' );


			// add author icon to comment author titles

			var user_icon = $( '.user-icon-container' ).html();
			$( '.bypostauthor > article .fn' ).append( user_icon );


			// skip link fix
			// based on https://github.com/Automattic/_s/blob/master/js/skip-link-focus-fix.js

			var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
				isOpera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
				isIe     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

			if ( ( isWebkit || isOpera || isIe ) && document.getElementById && window.addEventListener ) {
				window.addEventListener(
					'hashchange',
					function() {

						var id = location.hash.substring( 1 );

						if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
							return;
						}

						focus_element( id );

					},
					false
				);
			}

		}
	);

} )( window, document, jQuery );
