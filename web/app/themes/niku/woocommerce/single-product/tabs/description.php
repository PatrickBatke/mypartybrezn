<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading 	= esc_html( apply_filters( 'woocommerce_product_description_heading', esc_html__( 'Product Description', 'tokoo' ) ) );
$vc_enabled = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );
?>

<?php if ( false == $vc_enabled ): ?>
  <h2><?php echo esc_attr( $heading ); ?></h2>
<?php endif; ?>

<?php the_content(); ?>
