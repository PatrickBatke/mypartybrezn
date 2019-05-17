<?php

/**
 * The Template for displaying sidebar primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$get_sidebar = tokoo_get_meta( '_page_details' );
$sidebar_id = isset( $get_sidebar['custom_sidebar'] ) ? $get_sidebar['custom_sidebar'] : '';
?>

<?php if ( is_active_sidebar( $sidebar_id ) ) { ?>
	<aside class="sidebar"> 
		<a href="#" class="close-sidebar"><i class="simple-icon-close"></i></a>
		<?php dynamic_sidebar( $sidebar_id ); ?>
	</aside><!-- .site-sidebar -->
<?php } ?>