<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} 

if ( $total <= 1 ) {
	return;
}

?>
<div class="posts-navigation">
	<div class="pagination">
		<?php get_template_part( 'loop', 'nav' ); ?>
	</div>
</div>
