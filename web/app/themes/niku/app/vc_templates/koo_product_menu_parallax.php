<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Menus Parallax
/*-----------------------------------------------------------------------------------*/
$css 				= '';
$atts 				= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$products_args   	= array(
	'post_type'         => 'product',
	'post_status'       => 'publish',
	'order'             => 'DESC',
	'orderby'           => 'date',
	'posts_per_page'	=> $product_limit,
	'tax_query' => array(
		array(
			'taxonomy' 	=> 'product_cat',
			'field' 	=> 'id',
			'terms' 	=> $ids,
	   ),
	),
);

$theproducts 	= new WP_Query( $products_args ); 
$menu_bg 		= ! empty( $menu_background_color ) ? 'background-color:'.$menu_background_color.';' : '';
$menu_color 	= ! empty( $menu_content_color ) ? 'color:'.$menu_content_color.';' : '';
?>

<?php if ( $theproducts->have_posts() ) : ?>

	<!--
	Component 3: Product Menu Parallax
	=====================================
	Options:
	- Menu Title            | text
	- Category Source       | Select [product categories]
	- Category Image		| image upload
	- Menu Position			| Select [left,center,right]
	- Product Limit         | input
	- Menu Background Color | color picker
	- Menu Content Color	| color picker
	-->

	<div class="product-menu product-menu--parallax menu-<?php echo esc_attr( $menu_position ); ?>">
		<div class="product-menu__image">
			<?php if ( ! empty( $category_image ) ) : ?>
				<?php $cat_img_src = wp_get_attachment_image_src( $category_image, 'big' ); ?>
				<img src="<?php echo ''.$cat_img_src[0];  ?>" alt="Image">
			<?php endif; ?>
		</div>
		<div class="product-menu__box" style="<?php echo ''.$menu_bg; ?><?php echo ''.$menu_color; ?>">
			<?php if ( ! empty( $menu_title ) ) : ?>
				<h2 class="product-menu__title"><?php echo esc_attr( $menu_title ); ?></h2>
			<?php endif; ?>

			<ul class="product-menu__list">
					
				<?php while ( $theproducts->have_posts() ) : $theproducts->the_post(); ?>

					<li class="product-item <?php echo ( $show_thumbnail ) ? "has-thumbnail" : ""; ?>">
						<?php if ( true == $show_thumbnail ) : ?>
							<a href="<?php the_permalink(); ?>" class="product__image">
								<?php the_post_thumbnail( 'menu_small' ); ?>
							</a>
						<?php endif; ?>

						<h2 class="product__name">
							<a href="<?php the_permalink(); ?>">
								<span class="product__title"><?php the_title(); ?></span>
								<span class="dots"></span>
								<?php tokoo_product_price(); ?>
							</a>
						</h2>
						<span class="product__tags">
							<?php tokoo_product_get_tags(); ?>
						</span>
					</li>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				
			</ul>
		</div>
	</div>

<?php endif; ?>
