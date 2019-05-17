<?php

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// WooCommerce Section
// -----------------------------------------------------------------------------------------------
// ===============================================================================================

if ( class_exists( 'WooCommerce' ) ) {

	add_filter( 'tokoo_new_customizer_data', 'tokoo_woocommerce_settings_data' );
	function tokoo_woocommerce_settings_data( $tokoo_options ) {

		/* ======================================================================================*
		 *  WooCommerce Panel + Settings + data 										 												*
		 * ======================================================================================*/
		$tokoo_options[] = array(
			'slug'		=> 'tokoo_woocommerce_settings',
			'label'		=> esc_html__( 'WooCommerce Settings', 'tokoo' ),
			'priority'	=> 4,
			'type' 		=> 'panel'
		);

			/* ==================================================== *
			 *  Shop Page Section  									*
			 * ==================================================== */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_shop_page_section',
				'label'		=> esc_html__( 'Shop Page', 'tokoo' ),
				'panel' 	=> 'tokoo_woocommerce_settings',
				'priority'	=> 1,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Shop Page Data  											*
				 * ============================================================ */
				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_style',
					'default'	=> 'default',
					'priority'	=> 1,
					'label'		=> esc_html__( 'Main Product Style', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'select',
					'transport'	=> 'refresh',
					'choices'	=> array(
						'default'		=> esc_html__( 'Default (Grid Circle)', 'tokoo' ),
						'gid_square'	=> esc_html__( 'Grid Square', 'tokoo' ),
						'list_square'	=> esc_html__( 'List Square', 'tokoo' ),
						'list_circle'	=> esc_html__( 'List Circle', 'tokoo' ),
					),
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_category_count',
					'default'	=> 0,
					'priority'	=> 1,
					'label'		=> esc_html__( 'Hide Products Category Count', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_per_page',
					'default'	=> 9,
					'priority'	=> 2,
					'label'		=> esc_html__( 'Products Per Page', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'text'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_sale_flash',
					'default'	=> 0,
					'priority'	=> 3,
					'label'		=> esc_html__( 'Hide Products Sale Flash', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_category',
					'default'	=> 0,
					'priority'	=> 4,
					'label'		=> esc_html__( 'Hide Products Category', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_title',
					'default'	=> 0,
					'priority'	=> 5,
					'label'		=> esc_html__( 'Hide Products Title', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_star_rating',
					'default'	=> 0,
					'priority'	=> 6,
					'label'		=> esc_html__( 'Hide Products Star Rating', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_price',
					'default'	=> 0,
					'priority'	=> 7,
					'label'		=> esc_html__( 'Hide Products Price', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_add_to_cart',
					'default'	=> 0,
					'priority'	=> 8,
					'label'		=> esc_html__( 'Hide Products Quick Shop', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_catalog_ordering',
					'default'	=> 0,
					'priority'	=> 10,
					'label'		=> esc_html__( 'Hide Products Catalog Ordering', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_browse_by_tags',
					'default'	=> 0,
					'priority'	=> 11,
					'label'		=> esc_html__( 'Hide Browse by Tag', 'tokoo' ),
					'section'	=> 'tokoo_shop_page_section',
					'type' 		=> 'checkbox'
				);

			/* ==================================================== *
			 *  Single Product Section  							*
			 * ==================================================== */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_single_product_section',
				'label'		=> esc_html__( 'Single Product', 'tokoo' ),
				'panel' 	=> 'tokoo_woocommerce_settings',
				'priority'	=> 2,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Single Product Data  										*
				 * ============================================================ */
				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_image_style',
					'default'	=> 0,
					'priority'	=> 1,
					'label'		=> esc_html__( 'Single Product Image Style', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'select',
					'transport' => 'refresh',
					'choices'	=> array(
						'circle' 	=> esc_html__( 'Circle', 'tokoo' ),
						'square' 	=> esc_html__( 'Square', 'tokoo' ),
					),
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_sale_flash',
					'default'	=> 0,
					'priority'	=> 1,
					'label'		=> esc_html__( 'Hide Single Products Sale Flash', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_price',
					'default'	=> 0,
					'priority'	=> 2,
					'label'		=> esc_html__( 'Hide Single Products Price', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_add_to_cart',
					'default'	=> 0,
					'priority'	=> 3,
					'label'		=> esc_html__( 'Hide Single Products Add To Cart', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_excerpt',
					'default'	=> 0,
					'priority'	=> 4,
					'label'		=> esc_html__( 'Hide Single Products Excerpt', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_meta',
					'default'	=> 0,
					'priority'	=> 5,
					'label'		=> esc_html__( 'Hide Single Products Meta', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_single_rating',
					'default'	=> 0,
					'priority'	=> 6,
					'label'		=> esc_html__( 'Hide Single Products Rating', 'tokoo' ),
					'section'	=> 'tokoo_single_product_section',
					'type' 		=> 'checkbox'
				);


			/* ==================================================== *
			 *  Related Product Section  							*
			 * ==================================================== */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_related_product_section',
				'label'		=> esc_html__( 'Related Product', 'tokoo' ),
				'panel' 	=> 'tokoo_woocommerce_settings',
				'priority'	=> 3,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Related Product Data  										*
				 * ============================================================ */
				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_related',
					'default'	=> 0,
					'priority'	=> 1,
					'label'		=> esc_html__( 'Hide Related Products', 'tokoo' ),
					'section'	=> 'tokoo_related_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_related_product_per_page',
					'default'	=> 3,
					'priority'	=> 2,
					'label'		=> esc_html__( 'Related Product Per Page', 'tokoo' ),
					'section'	=> 'tokoo_related_product_section',
					'type' 		=> 'text'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_related_product_title',
					'default'	=> '',
					'priority'	=> 3,
					'label'		=> esc_html__( 'Related Product Title', 'tokoo' ),
					'section'	=> 'tokoo_related_product_section',
					'type' 		=> 'text'
				);


			/* ==================================================== *
			 *  Upsells Product Section  							*
			 * ==================================================== */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_upsells_product_section',
				'label'		=> esc_html__( 'Upsells Product', 'tokoo' ),
				'panel' 	=> 'tokoo_woocommerce_settings',
				'priority'	=> 4,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Upsells Product Data  										*
				 * ============================================================ */
				$tokoo_options[] = array(
					'slug'		=> 'tokoo_product_upsells',
					'default'	=> 0,
					'priority'	=> 1,
					'label'		=> esc_html__( 'Hide Up-Sells Products', 'tokoo' ),
					'section'	=> 'tokoo_upsells_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_upsell_product_per_page',
					'default'	=> 3,
					'priority'	=> 2,
					'label'		=> esc_html__( 'Upsell Product Per Page', 'tokoo' ),
					'section'	=> 'tokoo_upsells_product_section',
					'type' 		=> 'text'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_upsell_product_title',
					'default'	=> '',
					'priority'	=> 3,
					'label'		=> esc_html__( 'Upsell Product Title', 'tokoo' ),
					'section'	=> 'tokoo_upsells_product_section',
					'type' 		=> 'text'
				);

			/* ==================================================== *
			 *  Category on Single Product Section  							*
			 * ==================================================== */
			$tokoo_options[] = array(
				'slug'		=> 'tokoo_category_single_product_section',
				'label'		=> esc_html__( 'Category on Single Product', 'tokoo' ),
				'panel' 	=> 'tokoo_woocommerce_settings',
				'priority'	=> 5,
				'type' 		=> 'section'
			);

				/* ============================================================ *
				 *  Category Single Product Data  								*
				 * ============================================================ */
				$tokoo_options[] = array(
					'slug'		=> 'tokoo_category_single_product',
					'default'	=> 0,
					'priority'	=> 1,
					'label'		=> esc_html__( 'Hide Category on Single Product', 'tokoo' ),
					'section'	=> 'tokoo_category_single_product_section',
					'type' 		=> 'checkbox'
				);

				$tokoo_options[] = array(
					'slug'		=> 'tokoo_category_single_product_per_page',
					'default'	=> 3,
					'priority'	=> 2,
					'label'		=> esc_html__( 'Category on Single Product Number', 'tokoo' ),
					'section'	=> 'tokoo_category_single_product_section',
					'type' 		=> 'text'
				);

		return $tokoo_options;
	}
}