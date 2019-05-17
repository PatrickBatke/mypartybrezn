(function($, document, window){
	"use strict";

	/**
	 * clickOff plugin
	 */
	$.fn.clickOff = function(callback, selfDestroy) {
	    var clicked = false;
	    var parent = this;
	    var destroy = selfDestroy || true;
	    
	    parent.click(function() {
	        clicked = true;
	    });
	    
	    $(document).click(function(event) { 
	        if (!clicked) {
	            callback(parent, event);
	        }
	        if (destroy) {
	        };
	        clicked = false;
	    });
	};

	// check if Google Analytics code exist
	// to avoid error in console after sharing Google Plus
	// http://stackoverflow.com/a/15011353
	if (typeof(_gaq) == 'undefined') {
		var tracking = false;
	} else {
		var tracking = true;
	}
	$('.social-share-holder').sharrre({
		share: {
			facebook: true,
			googlePlus: true,
			twitter: true,
			pinterest: true,
			linkedin: true
		},
		template:
			'<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>' +
			'<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>' +
			'<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>' +
			'<a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>' +
			'<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>',
		enableHover: false,
		enableTracking: tracking,
		urlCurl: '',
		render: function(api, options){
			$(api.element).on('click', '.twitter', function() {
				api.openPopup('twitter');
			});
			$(api.element).on('click', '.facebook', function() {
				api.openPopup('facebook');
			});
			$(api.element).on('click', '.google-plus', function() {
				api.openPopup('googlePlus');
			});
			$(api.element).on('click', '.pinterest', function() {
				api.openPopup('pinterest');
			});
			$(api.element).on('click', '.linkedin', function() {
				api.openPopup('linkedin');
			});
		}
	});


	// Document ready
	$(document).ready(function(){


		var headerHeight = $(".site-header").innerHeight();
		$(".page-header").css({
			"padding-top": headerHeight +100
		});

		if( $(".site-header").hasClass("site-header--type-2") ){
			$(".mobile-navigation").append('<ul class="menu"></ul>');
			$(".mobile-navigation .menu").append( $(".desktop-navigation .menu > .menu-item").clone() );
		} else {
			// Cloning main navigation for mobile menu
			$(".mobile-navigation").append( $(".desktop-navigation .menu").clone() );
			
		}
		var toggleButton = '<button type="button"><i class="fa fa-angle-down"></i></button>';
		$(".mobile-navigation .menu-item-has-children, .widget_nav_menu .menu-item-has-children").prepend(toggleButton);

		// Making mobile menu behave like an accordion
		$(".mobile-navigation .menu-item-has-children button, .widget_nav_menu .menu-item-has-children button").click(function(){

			$(this).toggleClass("active");
			$(this).siblings('.sub-menu').slideToggle(200);

    		return false;
		});

		// Changing background image using data-attribute
		$("[data-bg-image]").each(function(){
			var image = $(this).data("bg-image");
			$(this).css("background-image", "url("+image+")");
		});

		// Changing background color using data-attribute
		$("[data-bg-color]").each(function(){
			var color = $(this).data("bg-color");
			$(this).css("background-color", color );
		});

		$(".posts-holder.masonry-layout").isotope();

		// Mobile menu toggle 
		$(".menu-toggle").click(function(){
			$(".mobile-navigation").slideToggle(300);
			if ( $(".mini-cart").hasClass("active") ){
				$(".mini-cart").removeClass("active");
			}
		});

		$(".sidebar-toggle, .close-sidebar,.sidebar-overlay").on("click", function(e){
			e.preventDefault();
			$("body").toggleClass("sidebar-active");
		});

		$(".search-toggle").on("click", function(e){
			e.preventDefault();
			$(".search-form-box").toggleClass("active").find("input").focus();
		});
		$(".search-form-box .close").on("click", function(e){
			e.preventDefault();
			$(".search-form-box").toggleClass("active");
		});

		$(".video-wrap,.media-wrap").fitVids();

		$(".tiles").tilesGallery({
			tileMinHeight: 200,
			margin: 10
		});

		$(".gallery-slider").flexslider({
			animation: "slide",
			prevText: '<i class="fa fa-angle-left"></i>',
			nextText: '<i class="fa fa-angle-right"></i>'
		});

		$(".datepicker").pickadate();
		$(".timepicker").pickatime({
			interval: 60,
			min: [9,0], // Open Hour
  			max: [21,0] // Close Hour
		});
		$(".desktop-navigation ul.menu").superfish({
			delay: 300,
			onBeforeShow: function(){
				var subMenu     = $(this);
				var parent      = this.context;
				var isMegaMenu = $(parent).hasClass("mega-menu");
				var isFullwidth = $(parent).hasClass("mega-fullwidth");
				var headerContainer = $(".site-header .container").innerWidth();
				var windowOffset = ( window.innerWidth - headerContainer ) / 2;

				if( isMegaMenu && !isFullwidth ){
					
					var subMenuOffset = $(parent).offset().left;
					var subMenuWidth = subMenu.innerWidth() + subMenuOffset;
					
					if( subMenuWidth > ( headerContainer+windowOffset ) ) {
						$(parent).addClass("mega-fullwidth");
					}


				}

			},
			onShow: function(){

			}
		});

		$(".images .thumbnails").slick({
			slidesToShow: 4,
			prevArrow:'<a class="slick-prev"><i class="fa fa-angle-left"></i></a>',
			nextArrow:'<a class="slick-next"><i class="fa fa-angle-right"></i></a>',
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 3
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false,
						centerMode: true,
						centerPadding: '40px',
						slidesToShow: 2
					}
				}
			]
		});

		$(document).on("click",".mini-cart__toggle",function(e){
			$(".site-header .mini-cart").toggleClass("active");

			$(".mobile-navigation").slideUp();
			e.stopPropagation();
		});

		$(document).on("click", function(e){
			if ( $(this).closest(".mini-cart") ) return;
			$(".site-header .mini-cart").removeClass("active");
		})

		$(".footer-testimonial-slider").slick({
			fade          : true,
			arrows        : false,
			autoplay      : true,
			autoplaySpeed : 3000,
		});

		footerScrollSpace();

		$("[data-trianglify]").each(function(){
			var t = new Trianglify();
			var pattern = t.generate($(this).innerWidth(),$(this).innerHeight());
			$(this).css("background-image",pattern.dataUrl);
		});

		$(document).on("click",".speaker-popup-trigger",function(e){
			e.preventDefault();
			var speakerData = $(this).parents(".speaker").data("speaker-detail");
			var html;
			
			html  = '<div class="speaker-overlay">';
			html += '<div class="speaker-modal"><a class="close" href="#"><i class="drip-icon-cross"></i></a>';
			html += '<div class="left-side">';
			html += '<img class="avatar" src='+speakerData.avatar+">";
			html += '<div class="social-links">';
			html += '<a class="facebook" target="_blank" href="'+speakerData.facebook+'"><i class="fa fa-facebook"></i></a>';
			html += '<a class="twitter" target="_blank" href="'+speakerData.twitter+'"><i class="fa fa-twitter"></i></a>';
			html += '<a class="link" target="_blank" href="'+speakerData.url+'"><i class="fa fa-link"></i></a>';
			html += '</div>';
			html += '</div>';
			html += '<div class="speaker-detail">';
			html += '<h2>'+speakerData.name+'</h2>';
			html += '<small>'+speakerData.position+'</small>';
			html += '<p>'+speakerData.bio+'</p>';

			html += '</div>';
			html += '</div>';
			html += '</div>';

			$("body").append(html);
			$(".speaker-overlay").fadeIn(300,function(){
				$(this).addClass("active");
			})

		});

		$(document).on("click",".speaker-modal .close",function(e){
			e.preventDefault();
			$(".speaker-overlay").removeClass("active").delay(300).fadeOut(300, function(){
				$(this).remove();
			});
		});

		var $pca = $(".products-carousel");
		var $pcaItems = $pca.data("items");

		$pca.slick({
			slidesToShow: $pcaItems,
			prevArrow:'<button class="slick-prev"><i class="drip-icon-chevron-left"></i></button>',
			nextArrow:'<button class="slick-next"><i class="drip-icon-chevron-right"></i></button>',
			responsive: [{

		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 3,
		        infinite: true
		      }

		    }, {

		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
		      }

		    }, {

		      breakpoint: 300,
		      settings: "unslick" // destroys slick

		    }]
		});

		$(window).trigger("scroll");

		var controller = new ScrollMagic.Controller();

		$( ".product-menu--parallax" ).each( function(){

			var box = $(this).find( ".product-menu__box" );

			var menuBox = TweenMax.to( box, 1, {
				y: "-100%",
			} );
			var parallaxMenu = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook : .6,
				duration: '200%',
			})
			.setTween( menuBox )
			.addTo( controller );

		} );

	});

	function footerScrollSpace(){
		if( $(".footer-scroll-space").length ){
			var fssHeight = $(".footer-scroll-space").innerHeight();
			$(".site-content").css( "margin-bottom", fssHeight );
		}
	}


	// Window resizing event
	$(window).resize(function(){
		footerScrollSpace();
	});	


	// Window loaded event
	$(window).load(function(){

		$('.tiles a, .koo-image-slider .slides a').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: true,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				gallery: {
				enabled: true,
				navigateByImgClick: true,
				preload: [0,1] // Will preload 0 - before current, and 1 after the current image
			},
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: false,
				duration: 300 // don't foget to change the duration also in CSS
			}
		});

		$(".posts-holder.masonry-layout").isotope().addClass("loaded");

	});


	$(window).scroll(function() {
		
	    if( window.innerWidth >991 && $("body").hasClass("has-sticky-header") ){

	    	var offset = $(".top-header").innerHeight();
			if( $(this).scrollTop() > offset ) {
				
				var bH = $(".bottom-header").innerHeight();
				$("body:not(.header-collapsed) .top-header").css("margin-bottom",bH);
				$(".bottom-header").addClass("sticky-header");
			} else {
				$("body:not(.header-collapsed) .top-header").css("margin-bottom",0);
				$(".bottom-header").removeClass("sticky-header");
			}

			if( $(this).scrollTop() > 500 ){
				$(".bottom-header.sticky-header").addClass("shrinked");
			} else {
				$(".bottom-header.sticky-header").removeClass("shrinked");
			}
	    	
	    }

	});

})(jQuery, document, window);