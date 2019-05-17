<?php

/*-----------------------------------------------------------------------------------*/
/*	Koo Menus Slider Shortcodes
/*-----------------------------------------------------------------------------------*/
$css 		= '';
$atts 		= vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts ); ?>

<?php
	$menus_slider_args   	= array(
		'post_type'         => 'product',
		'post_status'       => 'publish',
		'order'             => 'DESC',
		'orderby'           => 'post__in',
		'posts_per_page'	=> -1,
	);


	if ( ! empty( $ids ) ) {
		$array_ids 						= explode( ',', $ids );
		$menus_slider_args['post__in'] 	= $array_ids;
	}

	$our_menus 	= new WP_Query( $menus_slider_args );
 ?>

<?php if ( $our_menus->have_posts() ) : ?>

	<div class="featured-menu-slider-container" id="<?php echo esc_attr( $unique_class ); ?>">
		<div class="slider">

			<?php while ( $our_menus->have_posts() ) : $our_menus->the_post(); ?>

				<div class="slide" style="background-image:url(<?php echo tokoo_get_featured_image_url(); ?>);">
					<div class="slide-menu-content">
						<header class="menu-header">
							<span><?php esc_html_e( 'Our', 'tokoo' ); ?></span>
							<strong><?php esc_html_e( 'Specialities', 'tokoo' ); ?></strong>
							<div class="nav-slide">
								<a href="#" class="prev-slide"><i class="fa fa-angle-left"></i></a>
								<a href="#" class="next-slide"><i class="fa fa-angle-right"></i></a>
							</div>
						</header>
						<div class="menu-item">
							<div class="menu-item-detail">
								<h2 class="menu-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="menu-item-excerpt">
									<?php echo wp_trim_words( get_the_content(), 10 ); ?>
								</div>
							</div>
							<div class="menu-item-price">
								<?php if ( function_exists( 'woocommerce_template_loop_price' ) ) : ?>
									<?php woocommerce_template_loop_price(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

		</div>
	</div>

<?php endif; ?>

<script>
	jQuery(document).ready(function(){
		var featuredMenu = jQuery("#<?php echo esc_attr( $unique_class ); ?> .slider");
		featuredMenu.slick({
			arrows: false,
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
		});
		featuredMenu.parents(".featured-menu-slider-container").find(".next-slide").click(function(e){
			e.preventDefault();
			featuredMenu.slick('slickNext');
		});
		featuredMenu.parents(".featured-menu-slider-container").find(".prev-slide").click(function(e){
			e.preventDefault();
			featuredMenu.slick('slickPrev');
		});
	});
</script>