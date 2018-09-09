/**
 * Theme Customizer code
 *
 * Filename: theme-customizer.js v1.1
 *
 * Created by Ben Gillbanks <http://www.binarymoon.co.uk/>
 * Available under GPL2 license
 *
 * @package Granule
 */

/* global wp */

;( function( $ ) {

	var api = wp.customize;

	$( document ).ready(
		function() {

			$( '.granule-category-checkbox' ).on(
				'change',
				function() {

					var $this = $( this );
					var id = $this.closest( 'li' ).find( '.granule-hidden-categories' ).prop( 'id' );
					var categories = [];

					$this.closest( 'li' ).find( '.granule-category-checkbox' ).each(
						function() {

							var $this = $( this );
							if ( true === $this.prop( 'checked' ) ) {
								var element = $this.prop( 'id' ).split( '-' );
								categories.push( element[1] );
							}

						}
					);

					api.instance( id ).set( categories.join() );

				}
			);

			$( '.granule-dragdrop-select' ).on(
				'change',
				function(){

					var $this = $( this );
					var selected = $this.find( ':selected' );
					var new_li = '<li data-value="' + selected.val() + '">' + selected.text() + '</li>';

					$this.parent().find( '.granule-sortable' ).append( new_li );
					list_add_close_button();

					$this.val( 'default' );

					selected.remove();

					list_update();

				}
			);

			$( '.granule-sortable' ).sortable(
				{
					placeholder: 'granule-highlight',
					update: function() {
						list_update();
					}
				}
			);

			list_add_close_button();

		}
	);

	var list_close_button = function( element ) {

		var close = $( '<a href="" class="granule-close">&times;</a>' );

		$( element ).append( close );

		close.on(
			'click',
			function() {

				var $this = $( this );
				var parent = $this.parent();
				var select = $this.closest( '.customize-control' ).find( '.granule-dragdrop-select' );
				$this.remove();

				var new_option = '<option value="' + parent.data( 'value' ) + '">' + parent.text() + '</option>';
				select.append( new_option );
				parent.remove();

				list_update();
				return false;

			}
		);

	};

	var list_update = function() {

		$( '.granule-sortable' ).each(
			function() {

				var list = [];
				var id = $( this ).closest( 'li' ).find( '.granule-hidden-categories' ).prop( 'id' );

				$( this ).find( 'li' ).each(
					function() {
						list.push( $( this ).data( 'value' ) );
					}
				);

				api.instance( id ).set( list.join() );

			}
		);

	};

	var list_add_close_button = function() {

		$( '.granule-sortable li' ).each(
			function(){

				if ( 0 === $( this ).find( 'a.granule-close' ).length ) {
					list_close_button( this );
				}

			}
		);

	};

})( jQuery );
