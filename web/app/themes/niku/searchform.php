<?php

/**
 * The Template for search form
 *
 * @author 		tokoo
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>

<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'tokoo' ); ?></span>
		<input type="search" class="search-field" name="s" placeholder="<?php echo esc_attr_e( 'Search', 'tokoo' ); ?>" title="<?php esc_attr_e( 'Search for:', 'tokoo' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
	</label>
	<input type="submit" class="search-submit" value="<?php esc_html_e( 'Search', 'tokoo' ); ?>" />
</form>