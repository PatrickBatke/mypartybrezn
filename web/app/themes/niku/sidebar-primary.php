<?php

/**
 * The Template for displaying sidebar primary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( is_active_sidebar( 'primary' ) ) { ?>
	<aside class="sidebar">
		<a href="#" class="close-sidebar"><i class="simple-icon-close"></i></a>
		<?php dynamic_sidebar( 'primary' ); ?>
	</aside><!-- .site-sidebar -->
<?php } else { ?>
	<aside class="sidebar sidebar--empty">
		<div class="empty-state">
			<i class="drip-icon-document"></i>
			<h2>Start Adding Widget in Admin page</h2>
		</div>

	</aside>
<?php }  ?>