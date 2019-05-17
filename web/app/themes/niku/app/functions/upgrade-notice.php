<?php 

/**
 * Admin Notice
 *
 * @return void
 * @author tokoo
 **/
add_action( 'admin_notices', 'tokoo_upgrade_tokoo_vitamins_admin_notice' );
function tokoo_upgrade_tokoo_vitamins_admin_notice() { 
	
	if ( class_exists( 'Tokoo_Vitamins' ) ) :
	
		$plugin_file = WP_PLUGIN_DIR . '/tokoo-vitamins/tokoo-vitamins.php';
		$plugin_data = get_plugin_data( $plugin_file );

		if ( ! empty( $plugin_data['Version'] ) ) :
			if ( version_compare( $plugin_data['Version'], '6.1', '<' ) ) :
		?>
			<div class="notice notice-warning is-dismissible">
				<p><?php esc_html_e( 'Old tokoo-vitamins plugin version detected, Please upgrade tokoo-vitamins plugin, follow the steps below:', 'tokoo' ); ?></p>
				<ol>
					<li><?php esc_html_e( 'Navigate to Appearance->Install Plugin or', 'tokoo' ); ?> <a href="<?php admin_url( 'themes.php?page=tokoo-install-plugins' ); ?>"><?php esc_html_e( 'Click Here', 'tokoo' ); ?></a></li>
					<li><?php esc_html_e( 'Click "update" link under the Tokoo Vitamins plugin title', 'tokoo' );?></li>
				</ol>
			</div>
		<?php 
			endif;
		endif;
	endif;
}