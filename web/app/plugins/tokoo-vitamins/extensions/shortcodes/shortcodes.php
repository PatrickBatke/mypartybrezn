<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/

add_shortcode( 'koo_one_third', 'koo_one_third' );
function koo_one_third( $atts, $content = null ) {
   return '<div class="koo-one-third">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_one_third_last', 'koo_one_third_last' );
function koo_one_third_last( $atts, $content = null ) {
   return '<div class="koo-one-third koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_two_third', 'koo_two_third' );
function koo_two_third( $atts, $content = null ) {
   return '<div class="koo-two-third">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_two_third_last', 'koo_two_third_last' );
function koo_two_third_last( $atts, $content = null ) {
   return '<div class="koo-two-third koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_one_half', 'koo_one_half' );
function koo_one_half( $atts, $content = null ) {
   return '<div class="koo-one-half">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_one_half_last', 'koo_one_half_last' );
function koo_one_half_last( $atts, $content = null ) {
   return '<div class="koo-one-half koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_one_fourth', 'koo_one_fourth' );
function koo_one_fourth( $atts, $content = null ) {
   return '<div class="koo-one-fourth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_one_fourth_last', 'koo_one_fourth_last' );
function koo_one_fourth_last( $atts, $content = null ) {
   return '<div class="koo-one-fourth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_three_fourth', 'koo_three_fourth' );
function koo_three_fourth( $atts, $content = null ) {
   return '<div class="koo-three-fourth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_three_fourth_last', 'koo_three_fourth_last' );
function koo_three_fourth_last( $atts, $content = null ) {
   return '<div class="koo-three-fourth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_one_fifth', 'koo_one_fifth' );
function koo_one_fifth( $atts, $content = null ) {
   return '<div class="koo-one-fifth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_one_fifth_last', 'koo_one_fifth_last' );
function koo_one_fifth_last( $atts, $content = null ) {
   return '<div class="koo-one-fifth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_two_fifth', 'koo_two_fifth' );
function koo_two_fifth( $atts, $content = null ) {
   return '<div class="koo-two-fifth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_two_fifth_last', 'koo_two_fifth_last' );
function koo_two_fifth_last( $atts, $content = null ) {
   return '<div class="koo-two-fifth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_three_fifth', 'koo_three_fifth' );
function koo_three_fifth( $atts, $content = null ) {
   return '<div class="koo-three-fifth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_three_fifth_last', 'koo_three_fifth_last' );
function koo_three_fifth_last( $atts, $content = null ) {
   return '<div class="koo-three-fifth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_four_fifth', 'koo_four_fifth' );
function koo_four_fifth( $atts, $content = null ) {
   return '<div class="koo-four-fifth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_four_fifth_last', 'koo_four_fifth_last' );
function koo_four_fifth_last( $atts, $content = null ) {
   return '<div class="koo-four-fifth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_one_sixth', 'koo_one_sixth' );
function koo_one_sixth( $atts, $content = null ) {
   return '<div class="koo-one-sixth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_one_sixth_last', 'koo_one_sixth_last' );
function koo_one_sixth_last( $atts, $content = null ) {
   return '<div class="koo-one-sixth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}

add_shortcode( 'koo_five_sixth', 'koo_five_sixth' );
function koo_five_sixth( $atts, $content = null ) {
   return '<div class="koo-five-sixth">' . koo_clean_invalid_autop( $content ) . '</div>';
}

add_shortcode( 'koo_five_sixth_last', 'koo_five_sixth_last' );
function koo_five_sixth_last( $atts, $content = null ) {
   return '<div class="koo-five-sixth koo-column-last">' . koo_clean_invalid_autop( $content ) . '</div><div class="koo-clear"></div>';
}


/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_button', 'koo_button' );
function koo_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url'		=> '#',
		'target'	=> '_self',
		'type'		=> 'regular',
		'size'		=> 'small',
		'icon'		=> 'fa-heart'
	), $atts ) );
	
	$icons = ! empty ( $icon ) ? '<i class="fa '.$icon.'"></i>' : '';
	return '<a target="' . $target . '" class="button ' . $size . ' ' . $type . '" href="' . esc_url( $url ) . '">'. $icons . koo_clean_invalid_autop( $content ) . '</a>';
}



/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_alert', 'koo_alert' );
function koo_alert( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type'   		=> 'info',
		'dismisable'	=> false
	), $atts));
	
	$dismisable = ( 'on' == $dismisable ) ? '<button class="koo-alert-close">x</button>' : '';
	return '<div class="koo-alert ' . $type . '">'. $dismisable . koo_clean_invalid_autop( $content ) . '</div>';
}


/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_tabs', 'koo_tabs' );
function koo_tabs( $atts, $content = null ) {
	$defaults = array();
	extract( shortcode_atts( $defaults, $atts ) );
	
	// Extract the tab titles for use in the tab widget.
	preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	
	$tab_titles = array();
	if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
	
	$output = '';
	
	if( count($tab_titles) ){
		$output .= '<div id="koo-tabs-'. rand(1, 100) .'" class="koo-tabs"><div class="koo-tab-inner">';
		$output .= '<ul class="koo-nav koo-clearfix">';
		
		foreach( $tab_titles as $tab ){
			$output .= '<li><a href="#koo-tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
		}
		
		$output .= '</ul>';
		$output .= koo_clean_invalid_autop( $content );
		$output .= '</div></div>';
	} else {
		$output .= koo_clean_invalid_autop( $content );
	}
	
	return $output;
}

add_shortcode( 'koo_tab', 'koo_tab' );
function koo_tab( $atts, $content = null ) {
	$defaults = array( 'title' => __( 'Tab', 'tokoo-vitamins' ) );
	extract( shortcode_atts( $defaults, $atts ) );
	
	return '<div id="koo-tab-'. sanitize_title( $title ) .'" class="koo-tab">'. koo_clean_invalid_autop( $content ) .'</div>';
}

/*-----------------------------------------------------------------------------------*/
/*	Hightlight Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_highlight', 'koo_highlight' );
function koo_highlight( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'regular',
	), $atts ) );

	return '<span class="highlight '. $type .'">' . koo_clean_invalid_autop( $content ) . '</span>';

}

/*-----------------------------------------------------------------------------------*/
/*	Box Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_box', 'koo_box' );
function koo_box( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'type' => 'regular',
		'title' => __( 'This is box title', 'tokoo-vitamins' )
	), $atts ) );

	return '<div class="koo-collapsible-box"><div class="koo-box-title '.$type.'">' . esc_attr( $title ) . '</div><div class="koo-box-content">' . koo_clean_invalid_autop( $content ) . '</div></div>';

}

/*-----------------------------------------------------------------------------------*/
/*	Accordion Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_accordions', 'koo_accordions' );
function koo_accordions( $atts, $content = null ) {

	return '<div class="koo-accordion">' . koo_clean_invalid_autop( $content ) . '</div>';

}

add_shortcode( 'koo_accordion', 'koo_accordion' );
function koo_accordion( $atts, $content = null  ) {
	extract( shortcode_atts( array(
	  'title' => __( 'Title', 'tokoo-vitamins' ),
	), $atts ) );
	  
   return '<div class="koo-accordion-title">'. $title .'</div><div class="koo-accordion-inner">' . koo_clean_invalid_autop( $content ) . '</div>';
}

/*-----------------------------------------------------------------------------------*/
/*	Leading Paragraph Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_leading_paragraph', 'koo_leading_paragraph' );
function koo_leading_paragraph( $atts, $content = null ) {
   return '<p class="leading">' . koo_clean_invalid_autop( $content ) . '</p>';
}

/*-----------------------------------------------------------------------------------*/
/*	Icon Shortcode 
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_icon', 'koo_icon' );
function koo_icon( $atts, $content = null ) {
   extract( shortcode_atts( array(
	  'name' 	=> '',
	  'color' 	=> '',
	  'size' 	=> '',
	), $atts ) );

   $s_color = ! empty( $color ) ? 'color:'.$color.';' : '';
   $s_size 	= ! empty( $size ) ? 'font-size:'.$size : '';

   if ( ! empty( $color ) || ! empty( $s_size ) ) {
   		$styles = 'style="'.$s_color.$s_size.'"';
   } else {
   		$styles = '';
   }

   return '<i class="'.$name.'" '.$styles.'"></i>';
}

/*-----------------------------------------------------------------------------------*/
/*	Dropcap Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_dropcap', 'koo_dropcap' );
function koo_dropcap( $atts, $content = null ) {
	extract( shortcode_atts( array(
	  'type' => 'normal',
	), $atts ) );

	return '<p class="koo-dropcap '.$type.'">' . koo_clean_invalid_autop( $content ) . '</p>';
}

/*-----------------------------------------------------------------------------------*/
/*	Pullquote Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_pullquote', 'koo_pullquote' );
function koo_pullquote( $atts, $content = null ) {
	extract( shortcode_atts( array(
	  'position' 	=> 'left',
	  'style' 		=> 'plain',
	  'cite' 		=> '',
	  'from' 		=> '',
	), $atts ) );

	$the_cite 		= ( isset( $cite ) && ! empty( $cite ) ) ? '<cite class="fn">'.$cite.'</cite>' : '';
	$the_from 		= ( isset( $from ) && ! empty( $from ) ) ? '<span class="quote-bg">'.$from.'</span>' : '';
	$the_details 	= ( isset( $avatar ) && ! empty( $avatar ) ) ? '<div class="quote-src has-avatar"><img src="'.$avatar.'" alt="avatar" class="quote-avatar">'.$the_cite.' '.$the_from.'</div>' : '';
	return '<blockquote class="koo-pullquote '.$position.' '.$style.'">' . koo_clean_invalid_autop( $content ) . '</blockquote>';
}

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'koo_portfolio', 'koo_portfolio' );
function koo_portfolio( $atts ) {
	extract( shortcode_atts( array(
		'per_page' 			=> '',
		'orderby' 			=> 'date',
		'order' 			=> 'desc',
		'pagination'		=> false,
	), $atts ) );

	if ( 0 != get_query_var( 'paged' ) ) {
		$paged = absint( get_query_var( 'paged' ) );
	} elseif ( 0 != get_query_var( 'page' ) ) {
		$paged = absint( get_query_var( 'page' ) );
	} else {
		$paged = 1;
	}

	$args = array(
		'post_type'				=> 'tokoo-portfolio',
		'post_status'			=> 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' 		=> $per_page,
		'orderby' 				=> $orderby,
		'order' 				=> $order,
		'paged'             	=> $paged
	);
	
	ob_start();

		$portfolios = new WP_Query( apply_filters( 'shortcode_tokoo_portfolio_query', $args, $atts ) );

		if ( $portfolios->have_posts() ) : ?>

			<div class="portfolio-holder card packery-layout columns-5">

				<?php while ( $portfolios->have_posts() ) : $portfolios->the_post(); ?>

					<?php get_template_part( 'content', 'portfolio' ); ?>

				<?php endwhile; // end of the loop. ?>
			
			</div>
			
			<?php if ( true == $pagination ) : ?>
				<?php if ( get_previous_posts_link() || get_next_posts_link() ) : ?>
					<div class="pagination align-center">
						<?php get_template_part( 'loop', 'nav' ); ?>
					</div><!-- .pagination -->
				<?php endif; ?>	
			<?php endif; ?>

		<?php endif;

		wp_reset_postdata();
			
	return ob_get_clean();
}

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Shortcodes
/*-----------------------------------------------------------------------------------*/
add_shortcode( 'dokan_store_list', 'koo_dokan_store_list' );
function koo_dokan_store_list( $atts ) {
	extract( shortcode_atts( array(
		'per_page' 			=> 6,
		'orderby' 			=> 'date',
		'order' 			=> 'desc',
		'pagination'		=> false,
	), $atts ) );

	global $post;
	
	if ( function_exists( 'dokan_get_sellers' ) ) {

		/**
		* Filter return the number of store listing number per page.
		*
		* @since 2.2
		*
		* @param array
		*/
		$paged  	= max( 1, get_query_var( 'paged' ) );
		$limit  	= ( ! empty( $per_page ) ) ? $per_page : 6;
		$offset 	= ( $paged - 1 ) * $limit;
		$arg		= array(
						'number'     => $limit,
						'offset'     => $offset,
					);
		$sellers	= dokan_get_sellers( $arg );

		ob_start();

			if ( $sellers['users'] ) : ?>

					<div class="store-list">

						<?php
						foreach ( $sellers['users'] as $seller ) {
							$store_info = dokan_get_store_info( $seller->ID );
							$banner_id  = isset( $store_info['banner'] ) ? $store_info['banner'] : 0;
							$store_name = isset( $store_info['store_name'] ) ? esc_html( $store_info['store_name'] ) : __( 'N/A', 'tokoo' );
							$store_url  = dokan_get_store_url( $seller->ID );
							?>

							<div class="store">
								
								<?php if ( $banner_id ) :
										$get_banner_url = wp_get_attachment_image_src( $banner_id, 'large' );
										$banner_url 	= $get_banner_url[0];
									else : 
										$banner_url = dokan_get_no_seller_image();
									endif;
								?>

								<div class="store__image" data-bg-image="<?php echo esc_url( $banner_url ); ?>">
									<figure class="store__avatar">
										<?php echo get_avatar( $seller->ID, 80 ); ?>
										<figcaption>
											<h3 class="store__name"><?php printf( $store_name ); ?></h3>
										</figcaption>
									</figure>
								</div> <!-- .thumbnail -->
								<div class="store__detail">
									<address>
										<?php if ( isset( $store_info['address'] ) && !empty( $store_info['address'] ) ) {
											$address 		= $store_info['address'];
											$country_obj 	= new WC_Countries();
											$countries   	= $country_obj->countries;
											$states      	= $country_obj->states;
											echo isset( $address['street_1'] ) ? $address['street_1'] : '';
											echo isset( $address['street_2'] ) ? $address['street_2'] : '';
											echo ', ';
											echo isset( $address['city'] ) ? $address['city'] : '';
											echo ', ';
											echo isset( $address['zip'] ) ? $address['zip'] : '';
											echo ', ';
											$country_code = isset( $address['country'] ) ? $address['country'] : '';
											$state_code   = isset( $address['state'] ) ? $address['state'] : '';
											$state_code   = ( $address['state'] == 'N/A' ) ? '' : $address['state'];
											echo isset( $countries[$country_code] ) ? $countries[$country_code] : '';
											echo ', ';
											echo isset( $states[$country_code][$state_code] ) ? $states[$country_code][$state_code] : $state_code;
										} ?>
									</address>
									<?php if ( isset( $store_info['phone'] ) && !empty( $store_info['phone'] ) ) { ?>
										<a href="tel:<?php echo esc_html( $store_info['phone'] ); ?>">
											<i class="fa fa-phone"></i> <?php echo esc_html( $store_info['phone'] ); ?>
										</a>
									<?php } ?>
									<a href="<?php echo esc_url( $store_url ); ?>" class="button"><?php _e( 'Visit store', 'tokoo' ); ?></a>
								</div>

							</div> <!-- .single-seller -->
						<?php } ?>

					</div> <!-- .dokan-seller-wrap -->

				<?php
					$user_count 	= $sellers['count'];
					$num_of_pages 	= ceil( $user_count / $limit );

					if ( true == $pagination ) {
						if ( $num_of_pages > 1 ) {
							echo '<div class="pagination-container clearfix">';
							$page_links = paginate_links( array(
									'current'   => $paged,
									'total'     => $num_of_pages,
									'base'      => str_replace( $post->ID, '%#%', esc_url( get_pagenum_link( $post->ID ) ) ),
									'type'      => 'array',
									'prev_text' => __( '&larr; Previous', 'tokoo' ),
									'next_text' => __( 'Next &rarr;', 'tokoo' ),
								) );

							if ( $page_links ) {
								$pagination_links  = '<div class="pagination-wrap">';
								$pagination_links .= '<ul class="pagination"><li>';
								$pagination_links .= join( "</li>\n\t<li>", $page_links );
								$pagination_links .= "</li>\n</ul>\n";
								$pagination_links .= '</div>';

								printf( $pagination_links );
							}

							echo '</div>';
						}
					}
			endif;
		}
			
	return ob_get_clean();
}


/*-----------------------------------------------------------------------------------*/
/*	Koo Helper
/*-----------------------------------------------------------------------------------*/
function koo_clean_invalid_autop( $content ) { 
	/* Removes invalid <br/> or </p> tag in the begining and invalid <p> in the end of shortcode block. */
	$content = preg_replace( array( '/^<\/p>/', '/<p>$/', '/^<br \/>/', '/<br \/>$/' ), '', $content);
	/* Removes invalid <br/> or </p> between two shortcode block. */
	$content = str_replace( array( "]<br />[", "]<br />\n[", "]</p>[", "]</p>\n[" ), '][', $content);
	return do_shortcode( shortcode_unautop( $content ) ); 
}
