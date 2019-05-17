<?php

/**
 * bounce back if WooCommerce is not installed
 *
 * @since 1.0
 */
if ( ! class_exists( 'WooCommerce' ) )
	return;

/**
 * Woocommerce custom functions
 *
 * @since 1.0
 */
add_action( 'after_setup_theme', 'tokoo_woo_functions' );
function tokoo_woo_functions() {

	/* Disable WooCommerce styles */
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	/**
	 * Add theme support for woocommerce
	 *
	 * @link http://docs.woothemes.com/document/third-party-custom-theme-compatibility/#section-2
	 */
	add_theme_support( 'woocommerce' );

	/* Define custom image sizes for woocommerce on theme activation. */
	add_action( 'init', 'tokoo_woocommerce_image_dimensions', 1 );

	if ( class_exists( 'YITH_WCWL' ) ) :
		update_option( 'yith_wcwl_add_to_wishlist_icon', 'fa-heart-o' );
	endif;

	/* filter Cross Sells number */
	// add_filter( 'woocommerce_cross_sells_total', create_function( '', 'return 3;' ) );

	/** Template Hooks ********************************************************/

	if ( ! is_admin() || defined('DOING_AJAX') ) {

		/**
		 * Remove Breadcrumbs
		 */
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		/**
		 * Loop Meta
		 */
		add_action( 'woocommerce_before_main_content', 'tokoo_loop_meta', 20 );

		// Content Product
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

		/**
		 * woocommerce_single_product_summary hook
		 */
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
		//add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 1 );

		/**
		 * Remove sidebar
		 */
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		/**
		 * woocommerce_after_shop_loop_item_title
		 */
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

		// Remove "Sale" icon from product single page
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 5 );




		/**
		 * After Product Summary
		 */
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	}

}


/**
 * Define image sizes
 */
function tokoo_woocommerce_image_dimensions() {

	global $pagenow;

	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) {

		$catalog = array(
			'width' => '270', // px
			'height' => '315', // px
			'crop' => 1 // true
		);

		$single = array(
			'width' => '640', // px
			'height' => '9999', // px
			'crop' => 1 // true
		);

		$thumbnail = array(
			'width' => '150', // px
			'height' => '150', // px
			'crop' => 1 // true
		);

		/* Product category thumbs. */
		update_option( 'shop_catalog_image_size'  , $catalog );

		/* Single product image. */
		update_option( 'shop_single_image_size'   , $single );

		/* Image gallery thumbs. */
		update_option( 'shop_thumbnail_image_size', $thumbnail );

	}

}


/**
 * My account URL on header.php
 * @since 1.0
 */
function tokoo_my_account_url() {
	printf ( '<a class="top-account" href="%s">%s</a>',
		esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ),
		esc_html__( 'My Account', 'tokoo' )
	);
}


/**
 * Returns true if on WooCommerce pages
 * Includes: Cart, Checkout, Pay, Thanks (Order Received), View Order, Order Tracking,
 *   My Account, Edit Address, Change Password, and Term
 * @return boolean
 */
function tokoo_is_woocommerce_pages() {
	if ( is_cart() || is_checkout() || is_account_page() ) {
		return true;
	} else {
		return false;
	}
}

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'tokoo_header_add_to_cart_fragment' );
function tokoo_header_add_to_cart_fragment( $fragments ) {

	ob_start(); ?>
	<button class="mini-cart__toggle">
		<i class="simple-icon-bag"></i>
		<span class="mini-cart__count"><?php echo WC()->cart->cart_contents_count; ?></span>
	</button>

	<?php
	$fragments['button.mini-cart__toggle'] = ob_get_clean();

	return $fragments;
}

/**
 * Register sidebar shop
 *
 * @return void
 * @author tokoo
 **/
add_action( 'widgets_init', 'tokoo_register_sidebar_shop' );
function tokoo_register_sidebar_shop() {
	$shop_param = array(
		'name' 			=> esc_html__( 'Shop', 'tokoo' ),
		'id' 			=> 'shop',
		'description' 	=> esc_html__( 'Widgets in this area will be shown on the shop page.', 'tokoo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);

	register_sidebar( $shop_param );
}

/**
 * Tokoo WooCommerce control from theme option
 *
 * @since  2.0
 * @author tokoo
 */

/* Disable product category count */
if ( true == get_theme_mod( 'tokoo_product_category_count' ) ) {
	add_filter( 'woocommerce_subcategory_count_html', 'tokoo_disable_product_category_count' );
}
function tokoo_disable_product_category_count() {
	echo '';
}

/* Set product per page */
add_filter( 'loop_shop_per_page', 'tokoo_shop_per_page' );
function tokoo_shop_per_page() {
	$tokoo_product_per_page = get_theme_mod( 'tokoo_product_per_page' );
	$default_product_per_page = get_option( 'posts_per_page' );
	if ( ! empty ( $tokoo_product_per_page ) && $tokoo_product_per_page !== 0 ) {
		$per_page = $tokoo_product_per_page;
	} else {
		$per_page = $default_product_per_page;
	}

	return $per_page;
}

/**
 * Tokoo product sale flash
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_product_sale_flash() {
	if ( false == get_theme_mod( 'tokoo_product_sale_flash' ) ) {
		woocommerce_show_product_loop_sale_flash();
	}
}

/**
 * Tokoo product category
 *
 * @since  2.0
 * @author tokoo
 */
function tokoo_product_category() {
	if ( false == get_theme_mod( 'tokoo_product_category' ) ) { ?>
		<?php
		global $product;
		printf( wc_get_product_category_list( $product->get_id(), ', ', '<div class="product__categories">', '</div>' ) );
		?>
	<?php }
}

/**
 * Tokoo product title
 *
 * @since  2.0
 * @author tokoo
 */
function tokoo_product_title() {
	if ( false == get_theme_mod( 'tokoo_product_title' ) ) { ?>
		<h2 class="product__title" title="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php }
}

/**
 * Tokoo Star Rating
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_product_star_rating() {
	if ( false == get_theme_mod( 'tokoo_product_star_rating' ) ) {
		woocommerce_template_loop_rating();
	}
}

/**
 * Tokoo product price
 * not used in LeCrafts
 * @since  2.0
 * @author tokoo
 */
function tokoo_product_price() {
	if ( false == get_theme_mod( 'tokoo_product_price' ) ) {
		woocommerce_template_loop_price();
	}
}

/**
 * Tokoo product add to cart
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_product_add_to_cart() {
	if ( false == get_theme_mod( 'tokoo_product_add_to_cart' ) ) {
		woocommerce_template_loop_add_to_cart();
	}
}

/**
 * Tokoo product result count
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_product_result_count() {
	if ( false == get_theme_mod( 'tokoo_product_result_count' ) ) { ?>
		<div class="align center"><?php woocommerce_result_count(); ?></div>
		<?php
	}
}

/**
 * Tokoo product catalog ordering
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_product_catalog_ordering() {
	if ( false == get_theme_mod( 'tokoo_product_catalog_ordering' ) ) { ?>
		<div class="pull-right">
			<?php woocommerce_catalog_ordering(); ?>
		</div>
		<?php
	}
}

/**
 * Tokoo single product sale flash
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_single_product_sale_flash() {
	if ( false == get_theme_mod( 'tokoo_product_single_sale_flash' ) ) {
		woocommerce_show_product_sale_flash();
	}
}

/**
 * Tokoo single product price
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_single_price() {
	if ( false == get_theme_mod( 'tokoo_product_single_price' ) ) {
		woocommerce_template_single_price();
	}
}

/**
 * Tokoo single product add to cart
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_single_add_to_cart() {
	if ( false == get_theme_mod( 'tokoo_product_single_add_to_cart' ) ) {
		woocommerce_template_single_add_to_cart();
	}
}

/**
 * Tokoo single product excerpt
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_single_excerpt() {
	if ( false == get_theme_mod( 'tokoo_product_single_excerpt' ) ) {
		woocommerce_template_single_excerpt();
	}
}

/**
 * Tokoo single product meta
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_single_meta() {
	if ( false == get_theme_mod( 'tokoo_product_single_meta' ) ) {
		woocommerce_template_single_meta();
	}
}

/**
 * Tokoo single product rating
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_single_rating() {
	if ( false == get_theme_mod( 'tokoo_product_single_rating' ) ) {
		woocommerce_template_single_rating();
	}
}

/**
 * Tokoo related product
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_display_related_product() {
	$related_product_per_page = get_theme_mod( 'tokoo_related_product_per_page' );
	$related_product_per_page = ( $related_product_per_page ) ? $related_product_per_page : 5;
	if ( false == get_theme_mod( 'tokoo_product_related' ) ) {
		woocommerce_related_products( $args = array( 'posts_per_page' => $related_product_per_page ), $columns = 1 );
	}
}

/**
 * Tokoo upsells product
 * not used in LeCrafts
 *
 * @since  2.0
 * @author tokoo
 */
 function tokoo_display_upsells_product() {
	$upsells_product_per_page = get_theme_mod( 'tokoo_upsell_product_per_page', 5 );
	if ( false == get_theme_mod( 'tokoo_product_upsells' ) ) {
		woocommerce_upsell_display( $posts_per_page  = $upsells_product_per_page , $columns = 4 );
	}
}


/**
 *
 */
add_action( 'init', 'tokoo_ini_woo_setting_options' );
function tokoo_ini_woo_setting_options() {

	/* Disable sale flash on product page */
	if ( true == get_theme_mod( 'tokoo_product_sale_flash' ) ) {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	}

	/* Disable star rating on product page */
	if ( true == get_theme_mod( 'tokoo_product_star_rating' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	}

	/* Disable product price */
	if ( true == get_theme_mod( 'tokoo_product_price' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	}

	/* Disable add_to_cart on shop page */
	if ( true == get_theme_mod( 'tokoo_product_add_to_cart' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}

	/* Disable result count on shop page */
	if ( true == get_theme_mod( 'tokoo_product_result_count' ) ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}

	/* Disable catalog ordering on shop page */
	if ( true == get_theme_mod( 'tokoo_product_catalog_ordering' ) ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}

	/* Disable sale flash on single shop */
	if ( true == get_theme_mod( 'tokoo_product_single_sale_flash' ) ) {
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	}

	/* Disable price on single shop */
	if ( true == get_theme_mod( 'tokoo_product_single_price' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	}

	/* Disable add to cart on single shop */
	if ( true == get_theme_mod( 'tokoo_product_single_add_to_cart' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}

	/* Disable excerpt on single shop */
	if ( true == get_theme_mod( 'tokoo_product_single_excerpt' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	}

	/* Disable meta on single shop */
	if ( true == get_theme_mod( 'tokoo_product_single_meta' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	}

	/* Disable rating on single shop */
	if ( true == get_theme_mod( 'tokoo_product_single_rating' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	}

	/* Disable related product */
	if ( get_theme_mod( 'tokoo_product_related' ) ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	}

	/* Related product Per Page */
	add_filter( 'woocommerce_output_related_products_args', 'tokoo_related_product_per_page' );
	add_filter( 'woocommerce_related_products_args', 'tokoo_related_product_per_page' );
	function tokoo_related_product_per_page( $args ) {
		$args['posts_per_page'] = 3;
		$related_product_per_page = get_theme_mod( 'tokoo_related_product_per_page' );
		if ( $related_product_per_page )
			$args['posts_per_page'] = $related_product_per_page;
		return $args;
	}

	/* Related Product Title Change */
	if ( get_theme_mod( 'tokoo_related_product_title' ) ) {
		add_filter( 'woocommerce_related_products_title', 'tokoo_related_product_title', 10 );
		function tokoo_related_product_title() {
			echo get_theme_mod( 'tokoo_related_product_title' );
		}
	}

	/* Disable upsell product */
	if ( get_theme_mod( 'tokoo_product_upsells' ) ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	}

	/* Upsells product Per Page */
	add_filter( 'woocommerce_upsells_products_args', 'tokoo_upsell_product_per_page' );
	function tokoo_upsell_product_per_page( $args ) {
		$args['posts_per_page'] = 3;
		$upsells_product_per_page = get_theme_mod( 'tokoo_upsell_product_per_page' );
		if ( $upsells_product_per_page )
			$args['posts_per_page'] = $upsells_product_per_page;
		return $args;
	}

	/* UpSells Product Title change */
	if ( get_theme_mod( 'tokoo_upsell_product_title' ) ) {
		add_filter( 'woocommerce_upsells_products_title', 'tokoo_upsell_product_title', 10 );
		function tokoo_upsell_product_title() {
			echo get_theme_mod( 'tokoo_upsell_product_title' );
		}
	}

	/* Cross Sells Product Display or Not */
	if ( true == get_theme_mod( 'tokoo_product_cross_sells' ) ) {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
	}
}

/**
 * Pagination
 */
function tokoo_product_loop_nav_below() {
	if ( get_previous_posts_link() || get_next_posts_link() ) :
	?>
		<div class="pagination align-center">
			<?php get_template_part( 'loop', 'nav' ); ?>
		</div>
	<?php
	endif;
}

/**
 * Shop Featured images
 */
function tokoo_template_loop_product_thumbnail( $size = 'full' ) {
	// default placeholder
	if ( wc_placeholder_img_src() ) {
		$featured_image = wc_placeholder_img_src( 'shop_catalog' );
	} else {
		$featured_image = TOKOO_THEME_ASSETS_URI . '/img/imgo2.jpg';
	}

	if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size, false );
		if ( $image ) {
			$featured_image = $image[0];
		}
	}
	return $featured_image;
}

/**
 * Category loop thumbnail
 * cloned from original woocommerce_subcategory_thumbnail()
 */
function tokoo_woocommerce_subcategory_thumbnail( $category ) {
	$thumbnail_id  = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image = wp_get_attachment_image_src( $thumbnail_id, 'full' );
		$image = $image[0];
	} else {
		$image = wc_placeholder_img_src();
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds
		// Ref: http://core.trac.wordpress.org/ticket/23605
		$image = str_replace( ' ', '%20', $image );
		?>
		<div class="featured-image card-image-bg" data-bg-image="<?php echo esc_url( $image ); ?>"></div>
		<?php
	}
}

/**
 * Show Categories on Single Product bottom
 */
function tokoo_single_product_categories_list() {

	if ( false == get_theme_mod( 'tokoo_category_single_product' ) ) :

		// default
		$number = 3;

		// modified from customizer
		if ( get_theme_mod( 'tokoo_category_single_product_per_page' ) )
			$number = get_theme_mod( 'tokoo_category_single_product_per_page' );

		// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( http://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
		$product_categories = get_categories( apply_filters( 'tokoo_single_product_categories_list_args', array(
				'hide_empty'   => 0,
				'hierarchical' => 1,
				'taxonomy'     => 'product_cat',
				'pad_counts'   => 1,
				'number'       => $number,
				'orderby'      => 'count',
				'order'        => 'desc'
		) ) );

		if ( ! apply_filters( 'woocommerce_product_subcategories_hide_empty', false ) ) {
			$product_categories = wp_list_filter( $product_categories, array( 'count' => 0 ), 'NOT' );
		}

		if ( $product_categories ) {
			?>
			<div class="products-category card card--4x3">
				<?php
				foreach ( $product_categories as $category ) {
					wc_get_template( 'content-product_cat.php', array(
						'category' => $category
					) );
				}
				?>
			</div><!-- .products-category -->
			<?php
		}

	endif;

}

/**
 * Show sold out badge
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'tokoo_sold_out_product_badge' );
function tokoo_sold_out_product_badge() {
	global $product;

	if ( ! $product->is_in_stock() ) {
		echo '<span class="onsale soldout">'.esc_html__( 'Sold Out', 'tokoo' ).'</span>';
	}

}

/**
 * Get Portfolio Category 
 *
 * @return void
 * @author tokoo
 **/
function tokoo_product_get_tags() {
	$cats 			= wp_get_object_terms( get_the_ID(), 'product_tag' ); 
	$i 				= 0;
	$cats_length 	= count( $cats ); 
	if ( ! empty( $cats ) ) {
		foreach ( $cats as $cat ) { 
			$separator = ( $i !== $cats_length - 1 ) ? ', ' : ''; ?>
			<a href="<?php echo esc_url( get_term_link( $cat->slug, 'product_tag' ) ); ?>"><?php echo esc_attr( $cat->name ) . $separator; ?></a>
		<?php $i++;
		}
	} 
}
