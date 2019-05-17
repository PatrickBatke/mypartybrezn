(function( $ ) {
  "use strict";

  $(window).load(function(){
		// Run Flexlider on widget slider type
		if( $(".koo-image-slider").length ){

			$(".koo-image-slider").flexslider({
				controlNav: false,
				directionNav: true,
				smoothHeight: true,
				prevText:'<i class="fa fa-angle-left"></i>',
				nextText:'<i class="fa fa-angle-right"></i>',
			});

		}

		if( $(".post-slider, .testimonial-slider").length ){

			$(".post-slider, .testimonial-slider").flexslider({
				animation: "slide",
				controlNav: false,
				directionNav: true,
				slideshow: false,
				prevText:'<i class="fa fa-angle-left"></i>',
				nextText:'<i class="fa fa-angle-right"></i>',
			});
		}
	});
}(jQuery));