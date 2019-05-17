<?php

/**
 * The Template for displaying sidebar secondary
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( is_active_sidebar( 'secondary' ) ) { ?>
	<?php dynamic_sidebar( 'secondary' ); ?>
<?php } ?>