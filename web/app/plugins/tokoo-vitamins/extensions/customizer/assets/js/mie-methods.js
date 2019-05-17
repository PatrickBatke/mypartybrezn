$ = jQuery.noConflict();

( function( $ ) {
	"use strict";

	$(document).ready(function(){
		$(".koo-chosen").chosen({
			allow_single_deselect :true,
			width:"100%",
		});

		$(".tokoo-slider-input").each(function(){
			var min = $(this).data('min');
			var max = $(this).data('max');

			var slideInput = $(this).siblings('.tokoo-slider-value');

			$(this).slider({
				min: min,
				max: max,
				value: slideInput.val(),
				slide: function( event, ui ) {
					// console.log( slideInput, ui.value );
					slideInput.val( ui.value );
					slideInput.trigger('change');
				}
			});
		});

		var sliderInput = $(".tokoo-slider-value");
		sliderInput.on( 'change', function() {
			$(this).siblings(".tokoo-slider-input").slider('value',$(this).val());
		} );

		/* === Checkbox Multiple Control === */
		$( '.customize-control-checkbox_multiple input[type="checkbox"]' ).on(
			'change',
			function() {
				var checkbox_values = $( this ).parents( '.customize-control-checkbox_multiple' ).find( 'input[type="checkbox"]:checked' ).map(
					function() {
						return this.value;
					}
					).get().join( ',' );

				$( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
			}
		);
		 
		$.each( mieScript, function( index ) {

			var dataType = mieScript[index].type;
			var dataSlug = mieScript[index].slug;
			var dataDependsOn = mieScript[index].dependson;
			var dataCondition = mieScript[index].condition;
			var dataValue = mieScript[index].value;

			if ( dataDependsOn) {
				var dataSelector = '#customize-control-' + dataSlug;
				var dataSelectorDep = '#customize-control-' + dataDependsOn +" input";

				$(dataSelector).attr("data-depends-on",dataDependsOn).hide();
				
				if ( $(dataSelectorDep).is(":checked") ) {
					$("[data-depends-on="+dataDependsOn+"]").show();
				} else {
					$("[data-depends-on="+dataDependsOn+"]").hide();
				}

				$(dataSelectorDep).on("click",function(){
					
					if( $(dataSelectorDep).is(":checked") ){
						$("[data-depends-on="+dataDependsOn+"]").slideDown();
					} else {
						$("[data-depends-on="+dataDependsOn+"]").slideUp();
					}

				});
			}
		});

	});

} )( jQuery );