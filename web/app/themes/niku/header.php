<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package tokoo
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<?php
	$page_meta = get_post_meta( get_the_ID(), '_page_details', true );
	if ( isset( $page_meta['collapse_header'] ) && true == $page_meta['collapse_header'] ) {
		$header_collapsed_class = 'header-collapsed';
	} else {
		$header_collapsed_class = '';
	}
?>

<body <?php body_class( $header_collapsed_class ); ?>>

<div class="site-content<?php tokoo_site_layout(); ?>">

	<?php $global_header_style 	= get_theme_mod( 'tokoo_header_style', 'variant-1' ); ?>
	<?php $header_style 		= ( isset( $page_meta['header_style'] ) && ! empty( $page_meta['header_style'] ) ) ? $page_meta['header_style'] : $global_header_style; ?>
	<?php switch ( $header_style ) {
		case 'variant-2':
			get_template_part( 'header', 'variant-2' );
			break;
		case 'variant-3':
			get_template_part( 'header', 'variant-3' );
			break;
		default:
			get_template_part( 'header', 'variant-1' );
			break;
	} ?>
