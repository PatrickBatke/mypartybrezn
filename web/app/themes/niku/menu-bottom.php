<?php

/**
 * The Template for displaying menu top
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<nav class="footer-menu">
	<?php if ( has_nav_menu( 'bottom' ) ) : 

		wp_nav_menu(
			array(
				'theme_location'  	=> 'bottom',
				'container'    		=> '',
				'menu_class'      	=> 'menu'
			)
		);

	else : ?>

		<ul class="menu">
			<?php wp_list_pages( array( 'depth' => 1,'sort_column' => 'menu_order','title_li' => '', 'include'  => 2 ) ) ?>
		</ul>
		
	<?php endif; ?>
</nav>