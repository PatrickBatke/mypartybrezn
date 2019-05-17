
( function( $ ) {

	$.each( mieStyle, function( index ) {

		var dataType      = mieStyle[index].type;
		var dataSlug      = mieStyle[index].slug;
		var dataProperty  = mieStyle[index].property;
		var dataProperty2 = mieStyle[index].property2;
		var dataSelector  = mieStyle[index].selector;
		var dataChoices   = mieStyle[index].choices;
		var dataOutput    = mieStyle[index].output;

		switch( dataType ) {

			case 'color' :
			case 'color_rgb' :
				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						$( dataSelector ).css( dataProperty, to ? to : '' );
					});
				});

				break; // use injector below

			case 'text' :
			case 'textarea' :
			case 'email' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						if ( dataSelector && ( 'css' == dataOutput ) ) {
							$( dataSelector ).css( dataProperty, to ? to : '' );
						} else if ( dataSelector && ( 'html' == dataOutput ) ) {
							$( dataSelector ).html( to );
						}
					} );
				} );

				break;

			case 'checkbox' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						false === to ? $( dataSelector ).hide() : $( dataSelector ).show();
					} );
				} );

				break;

			case 'images' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						$( dataSelector ).css( dataProperty, 'url(' + "'" + to + "'" + ')' + dataProperty2 );
					} );
				} );

				break;

			case 'google_font' :

				wp.customize( dataSlug, function( value ) {
					value.bind( function( to ) {
						$( dataSelector ).css( dataProperty, to ? to : '' );
						// add Google Fonts lib call in <head>
						var font_url = '//fonts.googleapis.com/css?family=';
						var font_link = '<link type="text/css" media="all" href="' + font_url + to.replace( ' ', '+') + '" rel="stylesheet">';
						$( font_link ).appendTo( $( 'head' ) );
					});
				});

				break;

			default:

				break;
		}

	});

	function injectCustomizerPrimaryColor(primaryColor){
		customizerStyle = 'a,a:hover, .user-menu__toggle .simple-icon-user, .cart-toggle i[class*="icon"], .search-form__toggle, .type-post .entry-meta__item > h3 i[class*="icon"], .type-page .entry-meta__item > h3 i[class*="icon"], .type-post .entry-title a:hover, .type-page .entry-title a:hover, .widget.widget_nav_menu .menu-item a:hover, .widget.widget_nav_menu .page_item a:hover, .primary-navigation .menu-item.mega-menu > .sub-menu .menu-item:hover > a, .primary-navigation .page_item.mega-menu > .sub-menu .menu-item:hover > a, .post-navigation .prev-post .fa, .post-navigation .next-post .fa, .post-navigation .prev-post:hover, .post-navigation .next-post:hover, .filterable-nav a.current, .filterable-nav a:hover, .star-rating span { color: ' + primaryColor +';}';
		customizerStyle += '.button, button, input[type="submit"], input[type="reset"], .widget.widget_shopping_cart .buttons .wc-forward, .widget.widget_shopping_cart .buttons .wc-forward.checkout, .site-footer .widget .widget-title:after, .primary-navigation .sub-menu .menu-item:hover > a, .primary-navigation .sub-menu .page_item:hover > a, .primary-navigation .children .menu-item:hover > a, .primary-navigation .children .page_item:hover > a, .primary-navigation .menu-item.mega-menu > .sub-menu .menu-item-has-children > a:after, .primary-navigation .page_item.mega-menu > .sub-menu .menu-item-has-children > a:after, .user-menu__list a:hover, .post-navigation:before, .post-navigation:after, .product-overview .product-summary .price { background-color: ' + primaryColor + ';}';

	customizerStyle += '.type-post.sticky, .type-page.sticky, .woocommerce-tabs .tabs li.active { border-color: ' + primaryColor + ';}';

		if ( jQuery("#primary-color").length > 0 ) {
			jQuery("#primary-color").html(customizerStyle);
		} else {
			jQuery("head").append('<style id="primary-color"></style>');
			jQuery("#primary-color").html(customizerStyle);
		}
	}

	wp.customize( 'tokoo_primary_color', function( value ) {
		value.bind( function( newval ) {
			injectCustomizerPrimaryColor(newval);
		});
	});
	

	if ( $("#customize-control-tokoo_header_style select").val() == "variant-3" ) {
		$("#customize-control-tokoo_logo_margin_top").slideUp();
	}

	$("#customize-control-tokoo_header_style select").change(function(){
		if(this.value == "variant-3"){
			$("#customize-control-tokoo_logo_margin_top").slideDown();
		}else{
			$("#customize-control-tokoo_logo_margin_top").slideUp();
		}
	});


} )( jQuery );