<?php

/**
 *
 * The Template for displaying social icons in header
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	$fb 		= get_theme_mod( 'tokoo_fb' );
	$tw 		= get_theme_mod( 'tokoo_tw' );
	$gplus 		= get_theme_mod( 'tokoo_gplus' );
	$pinterest 	= get_theme_mod( 'tokoo_pinterest' );
?>

<?php if ( $fb || $tw || $gplus || $pinterest ) : ?>

   <div class="social-links">
		<?php if ( $fb ) { ?>
			<a href="http://facebook.com/<?php echo esc_attr( $fb ); ?>"><i class="fa fa-facebook"></i></a>
		<?php } if ( $tw ) { ?>
			<a href="http://twitter.com/<?php echo esc_attr( $tw ); ?>"><i class="fa fa-twitter"></i></a>
		<?php } if ( $gplus ) { ?>
			<a href="http://plus.google.com/<?php echo esc_attr( $gplus ); ?>"><i class="fa fa-google-plus"></i></a>
		<?php } if ( $pinterest ) { ?>
			<a href="https://www.pinterest.com/<?php echo esc_attr( $pinterest ); ?>"><i class="fa fa-pinterest"></i></a>
		<?php } ?>
	</div> <!-- .social -->

<?php endif; ?>