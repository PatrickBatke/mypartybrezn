( function($){

	"use strict";

	$(document).ready(function(){

		// Alert box's close action
		$(document).on( "click", ".koo-alert-close", function(){
			$( this ).parent().slideUp();
		});

		// Collapsible box's close action
		$(document).on( "click", ".koo-box-title", function(){
			$(this).siblings().slideToggle();
		});

		$(document).on( "click", ".nav-tab a", function(e){
			var target = $(this).attr("href");

			e.preventDefault();
			$(this).parents(".tabbed-popular-posts-widget").find(".tab").removeClass("active");
			$(this).siblings().removeClass("active");
			$(this).addClass("active");
			$(target).addClass("active");
		} );

		// Code Snippet highlighting
		// Powered by Google Prettify
		if( $(".koo-code-snippet").length ){
			var s = document.createElement( 'script' );
			s.setAttribute( 'src', "assets/js/google-code-prettify/prettify.js" );
			document.body.appendChild( s );
		}

	});

	$(document).ready(function($) {

		$( ".koo-tabs" ).tabs({
			fx: { opacity: 'toggle', duration: 200 }
		});
		
		$(".koo-toggle").each( function () {
			if($(this).attr('data-id') == 'closed') {
				$(this).accordion({ header: '.koo-toggle-title', collapsible: true, active: false  });
			} else {
				$(this).accordion({ header: '.koo-toggle-title', collapsible: true});
			}
		});
		
		$(".koo-accordion").accordion( {
			autoHeight: false
		});
		
	});

} )(jQuery);