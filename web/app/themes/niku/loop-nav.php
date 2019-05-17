<?php

/**
 * The Template for displaying loop nav
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>


	<?php if ( is_attachment() ) : ?>

		<div class="loop-nav">
			<?php previous_post_link( '%link', '<span class="previous">' . wp_kses( __( '<span class="meta-nav">&larr;</span> Return to entry', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ) . '</span>' ); ?>
		</div><!-- .loop-nav -->

	<?php elseif ( is_singular( 'post' ) ) : ?>

		<div class="loop-nav">
			<?php previous_post_link( '%link', '<span class="previous">' . wp_kses( __( '<span class="meta-nav">&larr;</span> Previous', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ) . '</span>' ); ?>
			<?php next_post_link( '%link', '<span class="next">' . wp_kses( __( 'Next <span class="meta-nav">&rarr;</span>', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ) . '</span>' ); ?>
		</div><!-- .loop-nav -->

	<?php elseif ( ! is_singular() && current_theme_supports( 'loop-pagination' ) ) :
		loop_pagination( array( 'prev_text' => wp_kses( __( '<span class="meta-nav">&larr;</span> Previous', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ), 'next_text' => wp_kses( __( 'Next <span class="meta-nav">&rarr;</span>', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ) ) ); ?>

	<?php elseif ( ! is_singular() && $nav = get_posts_nav_link( array( 'sep' => '', 'prelabel' => '<span class="previous">' . wp_kses( __( '<span class="meta-nav">&larr;</span> Previous', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ) . '</span>', 'nxtlabel' => '<span class="next">' . wp_kses( __( 'Next <span class="meta-nav">&rarr;</span>', 'tokoo' ), array( 'span' => array( 'class' => array() ) ) ) . '</span>' ) ) ) :

		//previous link
		previous_posts_link( '<i class="fa fa-angle-left"></i>' .esc_html__( "Prev" , "tokoo" ) ) ;

			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base'					=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'				=> '?paged=%#%',
				'current'				=> max( 1, get_query_var('paged') ),
				'total'					=> $wp_query->max_num_pages,
				'prev_text'				=> esc_html__( 'Prev' , 'tokoo' ),
				'next_text'				=> esc_html__( 'Next' , 'tokoo' ),
				'prev_next'          	=> False,
				'before_page_number' 	=> '',
				'after_page_number'  	=> ''
			) );

		//next link
		next_posts_link( esc_html__( 'Next' , 'tokoo' ) . '<i class="fa fa-angle-right"></i>' );


	endif; ?>