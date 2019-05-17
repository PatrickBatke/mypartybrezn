<?php

/**
 * The Template for displaying sidebar small
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( is_active_sidebar( 'small' ) ) { ?>
	<?php dynamic_sidebar( 'small' ); ?>
<?php } ?>
