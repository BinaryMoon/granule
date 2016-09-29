/**
 * jquery.slider.js v1.5.1
 *
 * This is a super simple javascript slider script.
 *
 * Created by Ben Gillbanks <https://www.binarymoon.co.uk/>
 * Available under GPL2 license
 *
 * @package Granule
 */
/* global site_settings */

;( function( $ ) {

	$.fn.elementalSlides = function( options ) {

		var defaults = {
			interval: 5000,
			group_selector: 'article',
			nav_arrows: false,
			autoplay: 0
		};

		options = $.extend( defaults, options );

		return this.each( function() {

			// set the timer that determines how long each slide appears for
			var start_timer = function() {

				if ( ! autoplay || 0 === autoplay ) {

					return;

				}

				clearInterval( timer );

				timer = setInterval(
					function() {
						next();
					},
					interval
				);

			};

			// stop the timer - used to pause the slider
			var stop_timer = function() {

				clearInterval( timer );

			};

			// display the selected slide
			var show_slide = function( slide ) {

				var $slide = $( slide );

				// quit if the slide is already the current one
				if ( $slide.hasClass( 'current' ) ) {
					return;
				}

				articles.fadeOut( 500 ).removeClass( 'current' );
				$slide.fadeIn( 500 ).addClass( 'current' );

				articles.attr( 'aria-hidden', 'true' );
				$slide.attr( 'aria-hidden', 'false' );

			};

			// get the slide id
			var get_slide_id = function( tab ) {

				return '#slide_' + tab.data( 'slide' );

			};

			// display the next slide in the list
			var next = function() {

				var next_slide = nav.find( '.selected' ).removeClass( 'selected' ).next( '.tab' );

				// loop round if at the end
				if ( 0 === next_slide.length ) {
					next_slide = nav.find( '.tab:first' );
				}

				next_slide.addClass( 'selected' );
				show_slide( get_slide_id( next_slide ) );

			};

			// display the previous slide
			var previous = function() {

				var next_slide = nav.find( '.selected' ).removeClass( 'selected' ).prev( '.tab' );

				// loop round if at the start
				if ( 0 === next_slide.length ) {
					next_slide = nav.find( '.tab:last' );
				}

				next_slide.addClass( 'selected' );
				show_slide( get_slide_id( next_slide ) );

			};

			var $this = $( this );
			var timer;
			var slide_count = 0;

			// remove empty slides
			$this.children( options.group_selector ).filter( function() {

				return $.trim( this.innerHTML ).length < 1;

			} ).remove();

			var articles = $this.children( options.group_selector );
			var nav = $this.find( 'nav' );
			var interval = $this.data( 'interval' ) || options.interval;
			var autoplay = options.autoplay;

			// quit if there is nothing to display
			if ( articles.length <= 1 ) {

				// make sure the slides are visible. They should be hidden by default
				articles.fadeIn();
				return;

			}

			$this.attr( 'aria-live', 'polite' );

			// create slide navigation if it doesn't exist.
			// The navigation is the dots that you can use to select a slide to jump to.
			if ( nav.length === 0 ) {

				nav = $( '<nav></nav>' );
				nav.attr( 'aria-label', site_settings.i18n.slide_controls_label );
				$this.prepend( nav );

			}

			// loop through articles and create buttons for the nav
			articles.each( function() {

				slide_count ++;
				$( this ).attr( 'id', 'slide_' + slide_count );
				var tab = $( '<button type="button" data-slide="' + slide_count + '" class="tab"><span class="screen-reader-text">' + site_settings.i18n.slide_number.replace( '#', slide_count ) + '</span></button>' );
				nav.append( tab );

			} );

			// click navigation items
			nav.find( 'button' ).on( 'click', function( e ) {

				e.preventDefault();

				var $this = $( this );

				show_slide( get_slide_id( $this ) );
				nav.find( 'button' ).removeClass( 'selected' );
				$this.addClass( 'selected' );

				start_timer();

			} );

			// stop the animation when links on each slide are focused
			articles.find( 'a' ).on( 'focus', function() {

				stop_timer();

			} );

			// restart the animation when links on each slide lose focus
			articles.find( 'a' ).on( 'blur', function() {

				start_timer();

			} );

			// stop the animation when the mouse hovers the content (hover implies the user is reading the content)
			$this[($.fn.hoverIntent) ? 'hoverIntent' : 'hover']( function() {

				stop_timer();

			}, function(){

				start_timer();

			} );

			// add next and previous links to the slider nav
			if ( options.nav_arrows ) {

				var arrow_next = $( '<button type="button" class="arrow arrow-next"><span class="screen-reader-text">' + site_settings.i18n.slide_next + '</span></button>' );
				var arrow_prev = $( '<button type="button" class="arrow arrow-prev"><span class="screen-reader-text">' + site_settings.i18n.slide_prev + '</span></a>' );

				arrow_next.on( 'click', function( e ) {

					e.preventDefault();

					next();

					start_timer();

				} );

				arrow_prev.on( 'click', function( e ) {

					e.preventDefault();

					previous();

					start_timer();

				} );

				nav.append( arrow_next );
				nav.prepend( arrow_prev );

			}

			// set the first slide as the current one
			// this stops the fade in & out effect
			var $first = nav.find( '.tab:first' );
			$( get_slide_id( $first ) ).addClass( 'current' );

			// select the first slide
			$first.click();

			// start timer (in case the nav is not being used)
			start_timer();

		});

	};

})( jQuery );
