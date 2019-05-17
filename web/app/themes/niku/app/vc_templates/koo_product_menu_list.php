<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Menus List
/*-----------------------------------------------------------------------------------*/
$css 				= '';
$atts 				= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$products_args   	= array(
	'post_type'         => 'product',
	'post_status'       => 'publish',
	'order'             => 'DESC',
	'orderby'           => 'date',
	'posts_per_page'	=> $per_columns,
	'tax_query' => array(
		array(
			'taxonomy' 	=> 'product_cat',
			'field' 	=> 'id',
			'terms' 	=> $ids,
	   ),
	),
);

global $post;
$theproducts 	= get_posts( $products_args ); 
$chunk_products = array_chunk( $theproducts, $columns );
?>

<?php if ( ! empty( $theproducts ) ) : ?>

	<!-- 
	Component 1: Product Menu List
	====================================
	Options:
	- Menu Title         | text
	- Category Source    | Select [product categories]
	- Columns            | Select [2,3,4]
	- Product per column | input
	- Show thumbnail     | checkbox
	-->
	<div class="product-menu product-menu--list">
		<?php if ( ! empty( $menu_title ) ) : ?>
			<h2 class="product-menu__title"><?php echo esc_attr( $menu_title ); ?></h2>
		<?php endif; ?>
		
		<div class="row">
			
			<?php foreach ( $chunk_products as $prouduks ) : ?>
				
				<div class="col-md-<?php echo 12/$columns; ?>">

					<ul class="product-menu__list">
						
						<?php foreach ( $prouduks as $post ) : setup_postdata( $post ); ?>
							
							<li class="product-item <?php echo ( true == $show_thumbnail ) ? "has-thumbnail" : ""; ?>">
								<?php if ( true == $show_thumbnail ) : ?>
									<a href="<?php the_permalink(); ?>" class="product__image">
										<?php 
											$thumbnail_id 	= get_post_thumbnail_id( get_the_ID() ); 
											if ( ! empty( $thumbnail_id ) ) {
												echo wp_get_attachment_image( $thumbnail_id, 'menu_small' );
											} else {
												echo '<img src="http://placehold.it/60x60" />';
											}
										?>
									</a>
								<?php endif; ?>

								<h2 class="product__name"><a href="<?php the_permalink(); ?>">
									<span class="product__title"><?php the_title(); ?></span>
									<span class="dots"></span>
									<?php tokoo_product_price(); ?>
								</a></h2>
								<span class="product__tags">
									<?php tokoo_product_get_tags(); ?>
								</span>
							</li>

						<?php endforeach; ?>
						<?php wp_reset_postdata(); ?>

					</ul>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

<?php endif; ?>
