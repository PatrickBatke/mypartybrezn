<?php

/**
 * The Template for displaying sidebar alt
 *
 * @author 		tokokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="sidebar col-md-3">

	<?php
	$get_sidebar 	= tokoo_get_meta( '_page_details' );
	$get_sidebar_id = $get_sidebar['page_sidebar_left'];

	$sidebar_id 	= $get_sidebar_id;
	if ( isset( $sidebar_id ) && '' !== $sidebar_id ) {
		dynamic_sidebar( $sidebar_id );
	} ?>

</div><!-- .sidebar -->