<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Menus Grid
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
$column_gutter 	= ( true == $remove_column_gutter ) ? 'no-gutter' : '';
?>
<?php if ( $theproducts->have_posts() ) : ?>

	<!--
	Component 2: Product Menu Grid
	=====================================
	Options:
	- Menu Title            | text
	- Category Source       | Select [product categories]
	- Columns               | Select [2,3,4]
	- Remove Column Gutter  | checkbox | Ini kalo true, nambah class no-gap di product-menu-grid
	- Product Limit         | input
	- grid-style			| select [expanded, cover]
	-->
	<div class="product-menu product-menu--grid">
		
		<?php if ( ! empty( $menu_title ) ) : ?>
			<h2 class="product-menu__title"><?php echo esc_attr( $menu_title ); ?></h2>
		<?php endif; ?>

		<div class="product-menu-grid <?php echo esc_attr( $column_gutter ); ?> columns-<?php echo esc_attr( $columns ); //columns  ?> style-<?php echo esc_attr( $grid_style ); ?>">

			<?php while ( $theproducts->have_posts() ) : $theproducts->the_post(); ?>

				<div class="product-item">
					<a href="<?php the_permalink(); ?>" class="product__image">
						<?php if ( has_post_thumbnail() ) : 
							the_post_thumbnail( 'random_thumbnail' );
						endif; ?>
					</a>
					<div class="product__detail">
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
						<?php 
							if ( $grid_style == "cover" ) :
								tokoo_product_price();
							endif; 
						?>
					</div>
				</div>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

		</div>
	</div>

<?php endif; ?>
