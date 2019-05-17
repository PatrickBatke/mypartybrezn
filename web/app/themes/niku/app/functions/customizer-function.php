<?php 

/**
 * Print CSS
 *
 * @return void
 * @author tokoo
 **/
add_action( 'wp_head', 'tokoo_customizer_print_css', 20 );
function tokoo_customizer_print_css() {

	// COLOR
	$get_accent_color   				= get_theme_mod( 'tokoo_accent_color' );
	$get_heading_color					= get_theme_mod( 'tokoo_heading_color' );
	$get_body_color						= get_theme_mod( 'tokoo_body_color' );
	$get_link_color						= get_theme_mod( 'tokoo_link_color' );
	$get_link_hover_color				= get_theme_mod( 'tokoo_link_hover_color' );
	$get_button_color					= get_theme_mod( 'tokoo_button_color' );
	$get_button_hover_color				= get_theme_mod( 'tokoo_button_hover_color' );
	$get_button_bg_color				= get_theme_mod( 'tokoo_button_background_color' );
	$get_button_bg_hover_color			= get_theme_mod( 'tokoo_button_background_hover_color' );

	// HEADER COLOR 
	$get_top_header_bg					= get_theme_mod( 'tokoo_top_header_bg' );
	$get_top_header_color				= get_theme_mod( 'tokoo_top_header_color' );

	// FOOTER COLOR
	$get_footer_bg						= get_theme_mod( 'tokoo_footer_bg' );
	$get_footer_color					= get_theme_mod( 'tokoo_footer_color' );
	$get_footer_color					= get_theme_mod( 'tokoo_footer_color' );
	$get_footer_link_color				= get_theme_mod( 'tokoo_footer_link_color' );
	$get_footer_link_hover_color		= get_theme_mod( 'tokoo_footer_link_hover_color' );
	$get_footer_widget_title_color		= get_theme_mod( 'tokoo_footer_widget_title_color' );
	
	// TYPOGRAPHY
	$get_heading_font					= get_theme_mod( 'tokoo_heading_font' );
	$get_heading_font_weight			= get_theme_mod( 'tokoo_heading_font_weight' );
	$get_heading_letter_spacing			= get_theme_mod( 'tokoo_heading_letter_spacing' );
	$get_heading_line_height			= get_theme_mod( 'tokoo_heading_line_height' );
	$get_body_font						= get_theme_mod( 'tokoo_body_font' );
	$get_body_font_size					= get_theme_mod( 'tokoo_body_font_size' );
	$get_body_line_height				= get_theme_mod( 'tokoo_body_line_height' );
	$get_body_letter_spacing			= get_theme_mod( 'tokoo_body_letter_spacing' );
	$get_decoration_font				= get_theme_mod( 'tokoo_decoration_font' );
	

	if ( isset( $get_accent_color ) && ! empty( $get_accent_color ) && '#ff4e00' !== $get_accent_color ) {
		$accent_color = $get_accent_color;
	} else {
		$accent_color = '#ff4e00';
	}

	if ( isset( $get_heading_color ) && ! empty( $get_heading_color ) && '#24292d' !== $get_heading_color ) {
		$heading_color = $get_heading_color;
	} else {
		$heading_color = '#24292d';
	}

	if ( isset( $get_body_color ) && ! empty( $get_body_color ) && '#77828b' !== $get_body_color ) {
		$body_color = $get_body_color;
	} else {
		$body_color = '#77828b';
	}

	if ( isset( $get_link_color ) && ! empty( $get_link_color ) && '#ff4e00' !== $get_link_color ) {
		$link_color = $get_link_color;
	} else {
		$link_color = '#ff4e00';
	}

	if ( isset( $get_link_hover_color ) && ! empty( $get_link_hover_color ) && '#ff8d5b' !== $get_link_hover_color ) {
		$link_hover_color = $get_link_hover_color;
	} else {
		$link_hover_color = '#ff8d5b';
	}

	if ( isset( $get_button_color ) && ! empty( $get_button_color ) && '#ffffff' !== $get_button_color ) {
		$button_color = $get_button_color;
	} else {
		$button_color = '#ffffff';
	}

	if ( isset( $get_button_hover_color ) && ! empty( $get_button_hover_color ) && '#ffffff' !== $get_button_hover_color ) {
		$button_hover_color = $get_button_hover_color;
	} else {
		$button_hover_color = '#ffffff';
	}

	if ( isset( $get_button_bg_color ) && ! empty( $get_button_bg_color ) && '#24292d' !== $get_button_bg_color ) {
		$button_bg_color = $get_button_bg_color;
	} else {
		$button_bg_color = '#24292d';
	}

	if ( isset( $get_button_bg_hover_color ) && ! empty( $get_button_bg_hover_color ) && '#ff4e00' !== $get_button_bg_hover_color ) {
		$button_bg_hover_color = $get_button_bg_hover_color;
	} else {
		$button_bg_hover_color = '#ff4e00';
	}

	// HEADER
	if ( isset( $get_top_header_bg ) && ! empty( $get_top_header_bg ) && '#1f2326' !== $get_top_header_bg ) {
		$top_header_bg = $get_top_header_bg;
	} else {
		$top_header_bg = '#1f2326';
	}

	if ( isset( $get_top_header_color ) && ! empty( $get_top_header_color ) && '#ffffff' !== $get_top_header_color ) {
		$top_header_color = $get_top_header_color;
	} else {
		$top_header_color = '#ffffff';
	}

	// FOOTER
	if ( isset( $get_footer_bg ) && ! empty( $get_footer_bg ) && '#1f2326' !== $get_footer_bg ) {
		$footer_bg = $get_footer_bg;
	} else {
		$footer_bg = '#1f2326';
	}

	if ( isset( $get_footer_color ) && ! empty( $get_footer_color ) && '#ffffff' !== $get_footer_color ) {
		$footer_color = $get_footer_color;
	} else {
		$footer_color = '#ffffff';
	}

	if ( isset( $get_footer_link_color ) && ! empty( $get_footer_link_color ) && '#fafafa' !== $get_footer_link_color ) {
		$footer_link_color = $get_footer_link_color;
	} else {
		$footer_link_color = '#fafafa';
	}

	if ( isset( $get_footer_link_hover_color ) && ! empty( $get_footer_link_hover_color ) && '#ffffff' !== $get_footer_link_hover_color ) {
		$footer_link_hover_color = $get_footer_link_hover_color;
	} else {
		$footer_link_hover_color = '#ffffff';
	}

	if ( isset( $get_footer_widget_title_color ) && ! empty( $get_footer_widget_title_color ) && '#ffffff' !== $get_footer_widget_title_color ) {
		$footer_widget_title_color = $get_footer_widget_title_color;
	} else {
		$footer_widget_title_color = '#ffffff';
	}

	// TYPOGRAPHY
	if ( isset( $get_heading_font ) && ! empty( $get_heading_font ) ) {
		$heading_font = $get_heading_font . ', serif';
	} else {
		$heading_font = 'Montserrat';
	}

	if ( isset( $get_heading_font_weight ) && ! empty( $get_heading_font_weight ) ) {
		$heading_font_weight = $get_heading_font_weight;
	} else {
		$heading_font_weight = '700';
	}

	if ( isset( $get_heading_letter_spacing ) && ! empty( $get_heading_letter_spacing ) ) {
		$heading_letter_spacing = $get_heading_letter_spacing;
	} else {
		$heading_letter_spacing = '0';
	}

	if ( isset( $get_heading_line_height ) && ! empty( $get_heading_line_height ) ) {
		$heading_line_height = $get_heading_line_height;
	} else {
		$heading_line_height = '38px';
	}


	if ( isset( $get_body_font ) && ! empty( $get_body_font ) ) {
		$body_font = $get_body_font;
	} else {
		$body_font = 'Montserrat';
	}
	
	if ( isset( $get_body_font_size ) && ! empty( $get_body_font_size ) ) {
		$body_font_size = $get_body_font_size;
	} else {
		$body_font_size = '13px';
	}

	if ( isset( $get_body_font_weight ) && ! empty( $get_body_font_weight ) ) {
		$body_font_weight = $get_body_font_weight;
	} else {
		$body_font_weight = '400';
	}

	if ( isset( $get_body_line_height ) && ! empty( $get_body_line_height ) ) {
		$body_line_height = $get_body_line_height;
	} else {
		$body_line_height = '25px';
	}

	if ( isset( $get_body_letter_spacing ) && ! empty( $get_body_letter_spacing ) ) {
		$body_letter_spacing = $get_body_letter_spacing;
	} else {
		$body_letter_spacing = '0';
	}

	if ( isset( $get_decoration_font ) && ! empty( $get_decoration_font ) ) {
		$decoration_font = $get_decoration_font;
	} else {
		$decoration_font = 'Amatic SC';
	}


	$customizer_style = '';
 	$customizer_style .= "
		h1,h2,h3,h4,h5,h6{
			font-family    : {$heading_font};
			font-weight    : {$heading_font_weight};
			letter-spacing : {$heading_letter_spacing};
			line-height    : {$heading_line_height};
		}
		body{
			font-family    : {$body_font};
			font-size      : {$body_font_size};
			font-weight    : {$body_font_weight};
			line-height    : {$body_line_height};
			letter-spacing : {$body_letter_spacing};
		}
		.breadcrumbs, .page-header .page-title, .products-sorting .woocommerce-result-count, blockquote{
			font-family: {$decoration_font};
		}

		.products .product .onsale, .products .product__categories:after, .desktop-navigation .menu-item.mega-menu > .sub-menu .menu-item-has-children > a:after, .desktop-navigation .page_item.mega-menu > .sub-menu .menu-item-has-children > a:after, .desktop-navigation .sub-menu .menu-item:hover > a, .desktop-navigation .sub-menu .page_item:hover > a, .desktop-navigation .children .menu-item:hover > a, .desktop-navigation .children .page_item:hover > a, .product-overview .product-summary span.onsale, .product-overview .summary span.onsale, #yith-quick-view-content .product-summary span.onsale, #yith-quick-view-content .summary span.onsale, .type-post .entry-action .more-link:before, .type-page .entry-action .more-link:before, .type-post .entry-action .more-link:after, .type-page .entry-action .more-link:after, .widget.widget_price_filter .ui-slider .ui-slider-range,.widget.widget_price_filter .ui-slider .ui-slider-handle{
			background-color: {$accent_color};
		}
		.products .product .onsale:after, .main-search-form .search-form-box{
			border-top-color: {$accent_color};
		}
		.entry-content blockquote, .page-content blockquote, .comment-content blockquote{
			border-left-color: {$accent_color};
		}
		.products-sorting .woocommerce-ordering:after, input[type=\"text\"]:focus, input[type=\"text\"]:active, input[type=\"number\"]:focus, input[type=\"number\"]:active, input[type=\"tel\"]:focus, input[type=\"tel\"]:active, input[type=\"email\"]:focus, input[type=\"email\"]:active, input[type=\"search\"]:focus, input[type=\"search\"]:active, input[type=\"url\"]:focus, input[type=\"url\"]:active, input[type=\"password\"]:focus, input[type=\"password\"]:active, select:focus, select:active, textarea:focus, textarea:active{
			border-color: {$accent_color};
		}
		.desktop-navigation .menu-item.mega-menu > .sub-menu .menu-item a:hover, .desktop-navigation .page_item.mega-menu > .sub-menu .menu-item a:hover, .main-search-form .search-form-box .close, .woocommerce-product-rating .woocommerce-review-link, .close-sidebar:hover, .type-post .entry-action .more-link:hover, .type-page .entry-action .more-link:hover, .type-post .entry-action .entry-share a:hover, .type-page .entry-action .entry-share a:hover, .woocommerce-MyAccount-navigation-link.is-active a, .woocommerce-MyAccount-navigation-link:hover a{
			color: {$accent_color};
		}

		h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{
			color: {$heading_color};
		}

		a{
			color:  {$link_color};
		}
		a:hover{
			color: {$link_hover_color};
		}

		.btn, .button, input[type=\"submit\"], button, .posts-navigation .prev, .posts-navigation .next,.widget.widget_search input[type=submit]{
			background-color: {$button_bg_color};
			color: {$button_color};
		}
		.btn:hover, .button:hover, .posts-navigation .prev:hover, .posts-navigation .next:hover,.widget.widget_search input[type=submit]:hover{
			background-color: {$button_bg_hover_color};
			color: {$button_hover_color};
		}

		.top-header{
			background-color: {$top_header_bg};
			color: {$top_header_color};
		}
		.top-header a{ color: {$top_header_color}; }

		.site-footer{
			background-color: {$footer_bg};
			color: {$footer_color};
		}
		.site-footer a, .site-footer .footer-copy a,.site-footer .widget > ul li a, .site-footer .widget a{
			color: {$footer_link_color};
		}
		.site-footer a:hover,.site-footer .widget > ul li a:hover, , .site-footer .widget a:hover{
			color: {$footer_link_hover_color};
		}
		.site-footer .widget .widget-title{
			color: {$footer_widget_title_color};
		}
		";

	$customizer_style = "\n".'<style type="text/css">'.trim( $customizer_style ).'</style>'."\n";
	echo ''.$customizer_style;
}