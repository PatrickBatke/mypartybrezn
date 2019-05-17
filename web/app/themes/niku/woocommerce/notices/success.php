<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}
 
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="woocommerce-message" role="alert">
		<div class="container">
			<?php
				echo wc_kses_notice( $message );
			?>
		</div>
	</div>
<?php endforeach; ?>
