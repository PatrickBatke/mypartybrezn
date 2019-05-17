<?php
/**
 * The template for displaying header variant 2
 *
 * @package tokoo
 */
?>

<header class="site-header site-header--type-2">

	<div class="top-header">
		<div class="container">
			<div class="left-section pull-left">
				<?php $global_header_style 	= get_theme_mod( 'tokoo_menu_top_style', 'topmenu' ); ?>
				<?php $topmenu_style 		= ( isset( $page_meta['tokoo_menu_top_style'] ) && ! empty( $page_meta['tokoo_menu_top_style'] ) ) ? $page_meta['tokoo_menu_top_style'] : $global_header_style; ?>
				<?php switch ( $topmenu_style ) {
					case 'headertext': ?>
						<div class="text-center">
							<?php
							$get_reservation_text 	= get_theme_mod( 'tokoo_reservation_text' );
							$get_reservation_link 	= get_theme_mod( 'tokoo_reservation_link' );
							$get_contactus_text 	= get_theme_mod( 'tokoo_contactus_text' );
							$get_contactus_phone 	= get_theme_mod( 'tokoo_contactus_phone' );
							
							if ( ! empty( $get_reservation_text ) ) {
								$reservation_text = $get_reservation_text;
							} else {
								$reservation_text = esc_html__( 'Online Reservation', 'tokoo' );
							}
							if ( ! empty( $get_reservation_link ) ) {
								$reservation_link = $get_reservation_link;
							} else {
								$reservation_link = '';
							}
							if ( ! empty( $get_contactus_text ) ) {
								$contactus_text = $get_contactus_text;
							} else {
								$contactus_text = esc_html__( 'Call Us', 'tokoo' );
							}
							if ( ! empty( $get_contactus_phone ) ) {
								$contactus_phone = $get_contactus_phone;
							} else {
								$contactus_phone = '';
							}
							echo sprintf( wp_kses( __( '<a href="%1$s">%2$s</a> or <a href="tel:%3$s">%4$s <strong>%5$s</strong></a>', 'tokoo' ), array( 'a' => array( 'href' => array() ), 'strong' => array() ) ), esc_url( $reservation_link ), esc_attr( $reservation_text ), esc_attr( $contactus_phone ), esc_attr( $contactus_text ), esc_attr( $contactus_phone )  );
							?>
						</div>
					<?php	break;
					default:
						get_template_part( 'menu', 'top' );
						break;
				} ?>
			</div>
			<div class="right-section pull-right">
			
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<div class="mini-cart">
						<button class="mini-cart__toggle">
							<i class="simple-icon-bag"></i>
							<span class="mini-cart__count"><?php echo WC()->cart->cart_contents_count; ?></span>
						</button>
						<?php the_widget( 'WC_Widget_Cart' ); ?>
					</div>
				<?php endif; ?>

				<button class="sidebar-toggle"><i class="simple-icon-logout"></i></button>

				<div class="main-search-form">
					<button class="search-toggle"><i class="simple-icon-magnifier"></i></button>
					<div class="search-form-box">
						<a href="#" class="close"><i class="simple-icon-close"></i></a>
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input type="text" name="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'tokoo' ); ?>">
							<span><?php esc_html_e( 'Begin typing your search above and press return to search.', 'tokoo' ); ?></span>
							<?php if ( class_exists( 'WooCommerce' ) ) : ?>
								<input type="hidden" name="post_type" value="product" />
							<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="bottom-header">
		<div class="container">
			<div class="header-content">
				<div class="left-menu">
					<?php get_template_part( 'menu', 'primary-left' ); ?>
				</div>

				<?php tokoo_site_title(); ?>

				<div class="right-menu">
					<?php get_template_part( 'menu', 'primary-right' ); ?>
				</div>
			</div>

			<button type="button" class="menu-toggle"><i class="fa fa-bars"></i> Menu</button>
			<nav class="mobile-navigation"></nav> <!-- .mobile-navigation -->
		</div>
	</div>

</header> <!-- .site-header -->