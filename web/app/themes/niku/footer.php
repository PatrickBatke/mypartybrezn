<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package tokoo
 */
?>
	<footer class="site-footer">

		<?php get_sidebar( 'footer' ); ?>

		<div class="footer-copy">
			<div class="container">
				<?php get_template_part( 'social', 'icons' ); ?>
				<?php get_template_part( 'menu', 'bottom' ); ?>
			</div>
		</div>
	</footer><!-- #colophon -->

</div><!-- .site-content -->

<?php get_template_part( 'content', 'footer-testimonials' ); ?>

<div class="sidebar-overlay"></div>
<?php
	if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_singular( 'product' ) || is_product_category() ) )
		tokoo_maybe_has_sidebar( 'shop' );
	else
		tokoo_maybe_has_sidebar( 'primary' );
?>

<?php wp_footer(); ?>
</body>
</html>
