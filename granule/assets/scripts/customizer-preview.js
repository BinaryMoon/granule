/**
 * Live-update changed settings in real time in the Customizer preview.
 *
 * Filename: customizer-preview.js v1
 *
 * Created by Ben Gillbanks <https://prothemedesign.com/>
 * Available under GPL2 license
 *
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#javascript-driven-widget-support
 *
 * @package Granule
 */
/* global jQuery, document, wp */

;( function( $, document ) {

	$( document ).ready( function() {

		// Site title.
		wp.customize( 'blogname', function( value ) {
			value.bind( function( to ) {
				$( '.site-title a' ).text( to );
			});
		});

		// Site description.
		wp.customize( 'blogdescription', function( value ) {
			value.bind( function( to ) {
				$( '.site-description' ).text( to );
			});
		});

	} );

} )( jQuery, document );
