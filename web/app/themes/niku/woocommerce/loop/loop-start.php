<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( isset( $_GET['style'] ) && ! empty( $_GET['style'] ) ) {
	$get_product_style = $_GET['style'];
} else {
	$get_product_style = get_theme_mod( 'tokoo_product_style', 'tokoo_product_style' );
}

switch ( $get_product_style ) {
	case 'gid_square':
		$ul_class = 'products--grid-classic';
		break;

	case 'list_square':
		$ul_class = 'products--list square-image';
		break;

	case 'list_circle':
		$ul_class = 'products--list square-circle';
		break;
	
	default:
		$ul_class = '';
		break;
}
?>

<ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?> <?php echo esc_attr( $ul_class ); ?>">