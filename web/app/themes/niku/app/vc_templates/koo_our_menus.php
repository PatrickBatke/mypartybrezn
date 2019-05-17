<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Our Menus Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 				= '';
$atts 				= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$products_args   	= array(
	'post_type'         => 'product',
	'post_status'       => 'publish',
	'order'             => 'DESC',
	'orderby'           => 'date',
	'posts_per_page'	=> $per_page,
	'tax_query' => array(
		array(
			'taxonomy' 	=> 'product_cat',
			'field' 	=> 'id',
			'terms' 	=> $ids,
	   ),
	),
);

$theproducts 	= new WP_Query( $products_args ); ?>

<?php if ( $theproducts->have_posts() ) : ?>

	<div class="product-category-list">
		<?php if ( $ids ) : ?>
			<?php $term = get_term_by( 'id', $ids, 'product_cat' ) ?>
			<h3 class="category-name"><a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ); ?>"><?php echo esc_attr( $term->name ); ?></a></h3>
		<?php endif; ?>

		<ul>

			<?php while ( $theproducts->have_posts() ) : $theproducts->the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<img src="<?php echo tokoo_get_featured_image_url( 'small' ); ?>" alt="<?php the_title(); ?>" class="product-image">
						<?php endif; ?>
						<h2 class="product-title"><?php the_title(); ?></h2>
						<span class="product-short-desc">
							<?php echo wp_trim_words( get_the_content(), 10 ); ?>
						</span>

						<div class="price">
							<?php if ( function_exists( 'woocommerce_template_loop_price' ) ) : ?>
								<?php woocommerce_template_loop_price(); ?>
							<?php endif; ?>
						</div>
					</a>
				</li>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

		</ul>
	</div>

<?php endif; ?>


