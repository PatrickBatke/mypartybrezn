<?php

$get_sidebar_columns = get_theme_mod( 'tokoo_sidebar_footer_columns', 2 );

$sidebars_1 = array(

	/*
	* Edit this file to add widget sidebars to your theme. 
	* Place WordPress default settings for sidebars.
	* Add as many as you want, watch-out your commas!
	*/
	array(
		'name'			=> esc_html__( 'Footer One', 'tokoo' ),
		'id'			=> 'footer-1',
		'description'	=> esc_html__( 'Widget Area of Footer First column', 'tokoo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>'
	),

	array(
		'name'			=> esc_html__( 'Footer Two', 'tokoo' ),
		'id'			=> 'footer-2',
		'description'	=> esc_html__( 'Widget Area of Footer Second column', 'tokoo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>'
	),

);

$sidebars_3 = array(
	array(
		'name'			=> esc_html__( 'Footer Three', 'tokoo' ),
		'id'			=> 'footer-3',
		'description'	=> esc_html__( 'Widget Area of Footer Third column', 'tokoo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>'
	),
);

$sidebars_4 = array(
	array(
		'name'			=> esc_html__( 'Footer Four', 'tokoo' ),
		'id'			=> 'footer-4',
		'description'	=> esc_html__( 'Widget Area of Footer Fourth column', 'tokoo' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>'
	),
);

switch ( $get_sidebar_columns ) {
	case '3':
		$sidebars = array_merge( $sidebars_1, $sidebars_3 );
		break;

	case '4':
		$sidebars = array_merge( $sidebars_1, $sidebars_3, $sidebars_4 );
		break;
	
	default:
		$sidebars = $sidebars_1;
		break;
}


return apply_filters( 'tokoo_sidebars', $sidebars );