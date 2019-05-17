<?php

/**
 * The Template for displaying footer testimonials
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( tokoo_get_customize_option( 'tokoo_enable_footer_testimonials_slider' ) ) :

	$data_sources 				= tokoo_get_customize_option( 'tokoo_footer_testimonials_slider' );
	$testimonials_content_color = tokoo_get_customize_option( 'tokoo_footer_testimonials_content_color' );
	$testimonials_cite_color 	= tokoo_get_customize_option( 'tokoo_footer_testimonials_cite_color' );
	$testimonials_bg_color 		= tokoo_get_customize_option( 'tokoo_footer_testimonials_background_color' );
	$testimonials_bg_image 		= tokoo_get_customize_option( 'tokoo_footer_testimonials_background_image' );

	if ( ! empty( $testimonials_content_color ) ) {
		$content_color = 'style="color:'.$testimonials_content_color.'"';
	} else {
		$content_color = '';
	}

	if ( ! empty( $testimonials_cite_color ) ) {
		$cite_color = 'style="color:'.$testimonials_cite_color.'"';
	} else {
		$cite_color = '';
	}

	$style_property = '';
	if ( ! empty( $testimonials_bg_color ) ) {
		$style_property .= 'background-color:'.$testimonials_bg_color.';';
	}
	if ( ! empty( $testimonials_bg_image ) ) {
		$get_bg_image 	 = wp_get_attachment_image_src( $testimonials_bg_image, 'full' );
		$style_property .= 'background-image: url('.$get_bg_image[0].') !important;';
	}

	$styles = 'style="'.esc_attr( $style_property ).'"';

	$testimonials_args = array(
		'post_type'		=> 'tokoo-testimonials',
		'post__in'		=> $data_sources
	);
	$testimonials_sliders = new WP_Query( $testimonials_args );
 ?>

	<?php if ( $testimonials_sliders->have_posts() ) : ?>

		<div class="footer-scroll-space" <?php echo ''.$styles; ?>>
			<div class="container">
				<div class="footer-testimonial-slider">

				<?php while ( $testimonials_sliders->have_posts() ) : $testimonials_sliders->the_post(); ?>

					<?php $page_meta = get_post_meta( get_the_ID(), '_page_details', true ); ?>

					<div class="slide-item">
						<blockquote <?php echo ''.$content_color; ?>>
							<p><?php echo tokoo_testimonials_get_content(); ?></p>
							<cite <?php echo ''.$cite_color; ?>><?php the_title(); ?></cite>
						</blockquote>
					</div>

				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>

				</div>
			</div>
		</div>

	<?php endif; ?>

<?php endif; ?>