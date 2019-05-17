<?php
/**
 * The template for displaying header variant 2
 *
 * @package tokoo
 */
?>

<header class="site-header site-header--type-3">
	<div class="bottom-header">
		<div class="container">
			<?php tokoo_site_title(); ?>
			<?php get_template_part( 'menu', 'primary' ); ?>
	   
			<!-- .primary-right-navigation -->
		</div>
		<nav class="mobile-navigation"></nav>
		<!-- .mobile-navigation -->
	</div>
</header>