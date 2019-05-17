<?php

/**
 * Set visual composer as theme
 *
 * @return void
 * @author tokoo
 **/
add_action( 'vc_before_init', 'tokoo_vcSetAsTheme', 9 );
function tokoo_vcSetAsTheme() {
	if ( function_exists( 'vc_set_as_theme' ) ) {
		vc_set_as_theme(true);
		vc_manager()->disableUpdater(true);
	}
}

add_action( 'vc_before_init', 'tokoo_vcSetDirectory' );
function tokoo_vcSetDirectory() {
	$dir = TOKOO_THEME_APP_DIR . '/vc_templates';
	vc_set_shortcodes_templates_dir( $dir );
}

/**
 * Get all type posts
 *
 * @return void
 * @author tokoo
 **/
function tokoo_get_type_posts_data( $post_type = 'post' ) {

	$posts = get_posts( array(
		'posts_per_page' 	=> -1,
		'post_type'			=> $post_type,
	));

	$result = array();
	foreach ( $posts as $post )	{
		$result[] = array(
			'value' => $post->ID,
			'label' => $post->post_title,
		);
	}
	return $result;
}

/**
 * Filter Google Font
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'vc_google_fonts_get_fonts_filter', 'tokoo_add_custom_font_to_vc_font_list' );
function tokoo_add_custom_font_to_vc_font_list( $content ) {

	$new_font = (object) array(
		"font_family" 	=> "Amatic SC",
		"font_styles" 	=> "regular,700",
		"font_types" 	=> "400 regular:400:normal,700 bold regular:700:normal"
	);

	array_push( $content, $new_font );

	return $content;

}

/**
 * Generate Random String
 *
 * @return void
 * @author tokoo
 **/
function tokoo_generate_random_string( $length = 10 ) {
    $characters 		= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength 	= strlen( $characters );
    $randomString 		= '';
    for ( $i = 0; $i < $length; $i++ ) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$product_image_style = array( 
	esc_html__( 'Default (Grid Circle)', 'tokoo' ) 	=> 'default',
	esc_html__( 'Grid Square', 'tokoo' ) 			=> 'gid_square',
	esc_html__( 'List Square', 'tokoo' ) 			=> 'list_square',
	esc_html__( 'List Circle', 'tokoo' ) 			=> 'list_circle',
);

if ( function_exists( 'vc_add_params' ) ) :

global $vc_add_css_animation;

vc_remove_param( 'vc_icon', 'type' );
vc_remove_param( 'vc_icon', 'icon_fontawesome' );
vc_remove_param( 'vc_icon', 'icon_openiconic' );
vc_remove_param( 'vc_icon', 'icon_typicons' );
vc_remove_param( 'vc_icon', 'icon_entypo' );
vc_remove_param( 'vc_icon', 'icon_linecons' );
vc_remove_param( 'vc_icon', 'color' );
vc_remove_param( 'vc_icon', 'custom_color' );
vc_remove_param( 'vc_icon', 'background_style' );
vc_remove_param( 'vc_icon', 'background_color' );
vc_remove_param( 'vc_icon', 'custom_background_color' );
vc_remove_param( 'vc_icon', 'size' );
vc_remove_param( 'vc_icon', 'align' );
vc_remove_param( 'vc_icon', 'link' );
vc_remove_param( 'vc_icon', 'el_class' );
vc_remove_param( 'vc_icon', 'css' );

if ( function_exists( 'getVcShared' ) ) :

	vc_add_params( 'vc_icon', array(
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Icon library', 'tokoo' ),
			'value' 		=> array(
				esc_html__( 'Font Awesome', 'tokoo' ) 	=> 'fontawesome',
				esc_html__( 'Open Iconic', 'tokoo' ) 	=> 'openiconic',
				esc_html__( 'Typicons', 'tokoo' ) 		=> 'typicons',
				esc_html__( 'Entypo', 'tokoo' ) 		=> 'entypo',
				esc_html__( 'Linecons', 'tokoo' ) 		=> 'linecons',
				esc_html__( 'Ionicons', 'tokoo' ) 		=> 'ionicons',
				esc_html__( 'Themifyicons', 'tokoo' ) 	=> 'themifyicons',
			),
			'admin_label' 	=> true,
			'param_name' 	=> 'type',
			'description' 	=> esc_html__( 'Select icon library.', 'tokoo' ),
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_fontawesome',
			'value' 		=> 'fa fa-adjust', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false,
				'iconsPerPage' 	=> 4000,
			),
			'dependency' 	=> array(
				'element' 	=> 'type',
				'value' 	=> 'fontawesome',
			),
			'description' 	=> esc_html__( 'Select icon from library.', 'tokoo' ),
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_openiconic',
			'value' 		=> 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'openiconic',
				'iconsPerPage' 	=> 4000, // default 100, how many icons per/page to display
			),
			'dependency' 	=> array(
				'element' 		=> 'type',
				'value' 		=> 'openiconic',
			),
			'description' 	=> esc_html__( 'Select icon from library.', 'tokoo' ),
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_typicons',
			'value' 		=> 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'typicons',
				'iconsPerPage' 	=> 4000, // default 100, how many icons per/page to display
			),
			'dependency' 	=> array(
				'element' 		=> 'type',
				'value' 		=> 'typicons',
			),
			'description' 	=> esc_html__( 'Select icon from library.', 'tokoo' ),
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_entypo',
			'value' 		=> 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'entypo',
				'iconsPerPage' 	=> 4000, // default 100, how many icons per/page to display
			),
			'dependency' 	=> array(
				'element' 		=> 'type',
				'value' 		=> 'entypo',
			),
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_linecons',
			'value' 		=> 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'linecons',
				'iconsPerPage' 	=> 4000, // default 100, how many icons per/page to display
			),
			'dependency' 	=> array(
				'element' 		=> 'type',
				'value' 		=> 'linecons',
			),
			'description' 	=> esc_html__( 'Select icon from library.', 'tokoo' ),
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_ionicons',
			'value' 		=> 'ion-alert', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'ionicons',
				'iconsPerPage' 	=> 4000, // default 100, how many icons per/page to display
			),
			'dependency' 	=> array(
				'element' 		=> 'type',
				'value' 		=> 'ionicons',
			),
			'description' 	=> esc_html__( 'Select icon from library.', 'tokoo' ),
		),

		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> esc_html__( 'Icon', 'tokoo' ),
			'param_name' 	=> 'icon_themifyicons',
			'value' 		=> 'alert', // default value to backend editor admin_label
			'settings' 		=> array(
				'emptyIcon' 	=> false, // default true, display an "EMPTY" icon?
				'type' 			=> 'themifyicons',
				'iconsPerPage' 	=> 4000, // default 100, how many icons per/page to display
			),
			'dependency' 	=> array(
				'element' 		=> 'type',
				'value' 		=> 'themifyicons',
			),
			'description' 	=> esc_html__( 'Select icon from library.', 'tokoo' ),
		),
		array(
			'type' 					=> 'dropdown',
			'heading' 				=> esc_html__( 'Icon color', 'tokoo' ),
			'param_name' 			=> 'color',
			'value' 				=> array_merge( getVcShared( 'colors' ), array( esc_html__( 'Custom color', 'tokoo' ) => 'custom' ) ),
			'description' 			=> esc_html__( 'Select icon color.', 'tokoo' ),
			'param_holder_class' 	=> 'vc_colored-dropdown',
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> esc_html__( 'Custom color', 'tokoo' ),
			'param_name' 	=> 'custom_color',
			'description' 	=> esc_html__( 'Select custom icon color.', 'tokoo' ),
			'dependency' 	=> array(
				'element' 		=> 'color',
				'value' 		=> 'custom',
			),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Background shape', 'tokoo' ),
			'param_name' 	=> 'background_style',
			'value' 		=> array(
				esc_html__( 'None', 'tokoo' ) => '',
				esc_html__( 'Circle', 'tokoo' ) => 'rounded',
				esc_html__( 'Square', 'tokoo' ) => 'boxed',
				esc_html__( 'Rounded', 'tokoo' ) => 'rounded-less',
				esc_html__( 'Outline Circle', 'tokoo' ) => 'rounded-outline',
				esc_html__( 'Outline Square', 'tokoo' ) => 'boxed-outline',
				esc_html__( 'Outline Rounded', 'tokoo' ) => 'rounded-less-outline',
			),
			'description' => esc_html__( 'Select background shape and style for icon.', 'tokoo' ),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Background color', 'tokoo' ),
			'param_name' 	=> 'background_color',
			'value' 		=> array_merge( getVcShared( 'colors' ), array( esc_html__( 'Custom color', 'tokoo' ) => 'custom' ) ),
			'std' 			=> 'grey',
			'description' 	=> esc_html__( 'Select background color for icon.', 'tokoo' ),
			'param_holder_class' => 'vc_colored-dropdown',
			'dependency' 		=> array(
				'element' 	=> 'background_style',
				'not_empty' => true,
			),
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> esc_html__( 'Custom background color', 'tokoo' ),
			'param_name' 	=> 'custom_background_color',
			'description' 	=> esc_html__( 'Select custom icon background color.', 'tokoo' ),
			'dependency' 	=> array(
				'element' 	=> 'background_color',
				'value' 	=> 'custom',
			),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Size', 'tokoo' ),
			'param_name' 	=> 'size',
			'value' 		=> array_merge( getVcShared( 'sizes' ), array( 'Extra Large' => 'xl' ) ),
			'std' 			=> 'md',
			'description' 	=> esc_html__( 'Icon size.', 'tokoo' ),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Icon alignment', 'tokoo' ),
			'param_name' 	=> 'align',
			'value' 		=> array(
				esc_html__( 'Left', 'tokoo' ) 	=> 'left',
				esc_html__( 'Right', 'tokoo' ) 	=> 'right',
				esc_html__( 'Center', 'tokoo' ) => 'center',
			),
			'description' 	=> esc_html__( 'Select icon alignment.', 'tokoo' ),
		),
		array(
			'type' 			=> 'vc_link',
			'heading' 		=> esc_html__( 'URL (Link)', 'tokoo' ),
			'param_name' 	=> 'link',
			'description' 	=> esc_html__( 'Add link to icon.', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Extra class name', 'tokoo' ),
			'param_name' 	=> 'el_class',
			'description' 	=> esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'tokoo' ),
		),
		array(
			'type' 			=> 'css_editor',
			'heading' 		=> esc_html__( 'CSS box', 'tokoo' ),
			'param_name' 	=> 'css',
			'group' 		=> esc_html__( 'Design Options', 'tokoo' ),
		),
	));

endif;

// Visual Composer Row Addition
vc_add_params( "vc_row", array(
	array(
		"type"			=> "dropdown",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Background Position",
		"param_name" 	=> "bg_position",
		"value" 		=> array(
			"Default" 		=> "",
			"Top Left" 		=> "bg-top-left",
			"Top Center" 	=> "bg-top-center",
			"Top Right" 	=> "bg-top-right",
			"Center Left" 	=> "bg-center-left",
			"Center" 		=> "bg-center",
			"Center Right" 	=> "bg-center-right",
			"Bottom Left" 	=> "bg-bottom-left",
			"Bottom Center" => "bg-bottom-center",
			"Bottom Right" 	=> "bg-bottom-right",
		),
		"description" 	=> "Control the background position for this row"
	),

	array(
		"type" 			=> "checkbox",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Fixed Background",
		"param_name" 	=> "fixed_background",
		"description" 	=> "When this option enable the background image will not scrolling as the user scroll the page"
	),

	array(
		"type" 			=> "colorpicker",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Background Overlay",
		"param_name" 	=> "bg_overlay",
		"description" 	=> "Add background color overlay to add more contrast to the text"
	),

	array(
		"type" 			=> "checkbox",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Equalize Column Height",
		"param_name" 	=> "equalize_column_height",
		"description" 	=> "Check this option so the column height have the same value"
	),

));

vc_add_params( "vc_column", array(
	array(
		"type" 			=> "dropdown",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Background Position",
		"param_name" 	=> "bg_position",
		"value" 		=> array(
			"Default" 			=> "",
			"Top Left" 			=> "bg-top-left",
			"Top Center" 		=> "bg-top-center",
			"Top Right" 		=> "bg-top-right",
			"Center Left" 		=> "bg-center-left",
			"Center" 			=> "bg-center",
			"Center Right" 		=> "bg-center-right",
			"Bottom Left" 		=> "bg-bottom-left",
			"Bottom Center" 	=> "bg-bottom-center",
			"Bottom Right" 		=> "bg-bottom-right",
		),
		"description" 	=> "Control the background position for this row"
	),
	array(
		"type" 			=> "checkbox",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Fixed Background",
		"param_name" 	=> "fixed_background",
		"description" 	=> "When this option enable the background image will not scrolling as the user scroll the page"
	),
));

vc_add_params( "vc_single_image", array(
	array(
		"type" 			=> "checkbox",
		"group" 		=> "Tokoo Options",
		"class" 		=> "",
		"heading" 		=> "Fullwith Image",
		"param_name" 	=> "fullwidth_image",
		"description" 	=> "Stretch the image to the container"
	),
));

vc_add_params( "vc_custom_heading", array(
	array(
		'type' 			=> 'textfield',
		'class' 		=> '',
		'heading' 		=> esc_html__( 'Letter Spacing', 'tokoo' ),
		'param_name' 	=> 'letter_spacing',
		'value' 		=> '',
		'description' 	=> esc_html__( 'Enter the Letter Spacing. e.g: 4px', 'tokoo' )
	),
));

vc_map( array(
	'name' 					=> esc_html__( 'Tokoo Portfolio', 'tokoo' ),
	'base' 					=> 'koo_portfolio',
	'class' 				=> 'tokoo-ico',
	'icon' 					=> 'tokoo-ico',
	'category' 				=> esc_html__( 'Portfolio', 'tokoo' ),
	'admin_enqueue_css' 	=> array( trailingslashit( TOKOO_THEME_URI ) . '/bootstrap/Assets/css/tokoovc.css' ),
	'description' 			=> esc_html__( 'Tokoo Portfolio.', 'tokoo' ),
	'params' 				=> array(

		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Enter Post Per Page', 'tokoo' ),
			'param_name' 	=> 'per_page',
			'value' 		=> 4,
			'description' 	=> esc_html__( 'Post Per Page.', 'tokoo' )
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Order By', 'tokoo' ),
			'param_name' 	=> 'orderby',
			'value' 		=> array( 'date', 'name', 'title' ),
			'description' 	=> esc_html__( 'Order by.', 'tokoo' )
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Order', 'tokoo' ),
			'param_name' 	=> 'order',
			'value' 		=> array( 'desc', 'asc' ),
			'description' 	=> esc_html__( 'Order.', 'tokoo' )
		),
		array(
			'type' 				=> 'checkbox',
			'heading' 			=> esc_html__( 'Display Pagination', 'tokoo'),
			'param_name' 		=> 'pagination',
			'description' 		=> esc_html__( 'If selected, pagination will be displayed', 'tokoo'),
			'value'				=> Array(esc_html__('Yes, please', 'tokoo') => 'yes' ),
		  ),
	)
) );


add_action( 'vc_before_init', 'koo_icon_box_integrateWithVC' );
function koo_icon_box_integrateWithVC() {
   vc_map( array(
		'name' 					=> esc_html__( 'Tokoo Icon Box', 'tokoo' ),
		'base' 					=> 'koo_icon_box',
		'class' 				=> 'tokoo-ico',
		'icon' 					=> 'tokoo-ico',
		'category' 				=> esc_html__( 'Features', 'tokoo' ),
		'admin_enqueue_css' 	=> array( trailingslashit( TOKOO_THEME_URI ) . '/bootstrap/Assets/css/tokoovc.css' ),
		'description' 			=> esc_html__( 'Tokoo Icon Box.', 'tokoo' ),
		'params' 				=> array(

			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Icon Type', 'tokoo' ),
				'param_name' 	=> 'icon_type',
				'value'			=> array(
					esc_html__( 'Top', 'tokoo' )		=> 'top',
					esc_html__( 'Left', 'tokoo' )		=> 'left',
					esc_html__( 'Right', 'tokoo' )		=> 'right',
				),
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Icon Style', 'tokoo' ),
				'param_name' 	=> 'icon_style',
				'value'			=> array(
					esc_html__( 'Default', 'tokoo' )		=> 'default',
					esc_html__( 'Circle', 'tokoo' )			=> 'circle',
					esc_html__( 'Circle Outline', 'tokoo' )	=> 'circle-outline',
				),
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Icon Source', 'tokoo' ),
				'param_name' 	=> 'icon_source',
				'value'			=> array(
					esc_html__( 'Font Icon', 'tokoo' )		=> 'font_icon',
					esc_html__( 'Image', 'tokoo' )			=> 'image',
				),
			),
			array(
				'type' 			=> 'attach_image',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Upload the image', 'tokoo' ),
				'param_name' 	=> 'image',
				'dependency'	=> array(
					'element'		=> 'icon_source',
					'value'			=> 'image',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Icon library',  'tokoo' ),
				'value'			=> array(
					esc_html__( 'Font Awesome',  'tokoo' )	=> 'fontawesome',
					esc_html__( 'Open Iconic',  'tokoo' )	=> 'openiconic',
					esc_html__( 'Typicons',  'tokoo' )		=> 'typicons',
					esc_html__( 'Entypo',  'tokoo' )		=> 'entypo',
					esc_html__( 'Linecons',  'tokoo' )		=> 'linecons',
				),
				'dependency'	=> array(
					'element'		=> 'icon_source',
					'value'			=> 'font_icon',
				),
				'admin_label'	=> true,
				'param_name'	=> 'icon_library',
				'description'	=> esc_html__( 'Select icon library.',  'tokoo' ),
			),
			array(
				'type'			=> 'iconpicker',
				'heading'		=> esc_html__( 'Icon',  'tokoo' ),
				'param_name'	=> 'icon_fontawesome',
				'value'			=> 'fa fa-adjust', // default value to backend editor admin_label
				'settings'		=> array(
					'emptyIcon'		=> false,
					'iconsPerPage'	=> 4000,
				),
				'dependency'	=> array(
					'element'		=> 'icon_library',
					'value'			=> 'fontawesome',
				),
				'description'	=> esc_html__( 'Select icon from library.',  'tokoo' ),
			),
			array(
				'type'			=> 'iconpicker',
				'heading'		=> esc_html__( 'Icon',  'tokoo' ),
				'param_name'	=> 'icon_openiconic',
				'value'			=> 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings'		=> array(
					'emptyIcon'		=> false, // default true, display an "EMPTY" icon?
					'type'			=> 'openiconic',
					'iconsPerPage'	=> 4000, // default 100, how many icons per/page to display
				),
				'dependency'	=> array(
					'element'		=> 'icon_library',
					'value'			=> 'openiconic',
				),
				'description'	=> esc_html__( 'Select icon from library.',  'tokoo' ),
			),
			array(
				'type'			=> 'iconpicker',
				'heading'		=> esc_html__( 'Icon',  'tokoo' ),
				'param_name'	=> 'icon_typicons',
				'value'			=> 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings'		=> array(
					'emptyIcon'		=> false, // default true, display an "EMPTY" icon?
					'type'			=> 'typicons',
					'iconsPerPage'	=> 4000, // default 100, how many icons per/page to display
				),
				'dependency'	=> array(
					'element'		=> 'icon_library',
					'value'			=> 'typicons',
				),
				'description'	=> esc_html__( 'Select icon from library.',  'tokoo' ),
			),
			array(
				'type'			=> 'iconpicker',
				'heading'		=> esc_html__( 'Icon',  'tokoo' ),
				'param_name'	=> 'icon_entypo',
				'value'			=> 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings'		=> array(
					'emptyIcon'		=> false, // default true, display an "EMPTY" icon?
					'type'			=> 'entypo',
					'iconsPerPage'	=> 4000, // default 100, how many icons per/page to display
				),
				'dependency'	=> array(
					'element'		=> 'icon_library',
					'value'			=> 'entypo',
				),
			),
			array(
				'type'			=> 'iconpicker',
				'heading'		=> esc_html__( 'Icon',  'tokoo' ),
				'param_name'	=> 'icon_linecons',
				'value'			=> 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings'		=> array(
					'emptyIcon'		=> false, // default true, display an "EMPTY" icon?
					'type'			=> 'linecons',
					'iconsPerPage'	=> 4000, // default 100, how many icons per/page to display
				),
				'dependency'	=> array(
					'element'		=> 'icon_library',
					'value'			=> 'linecons',
				),
				'description'	=> esc_html__( 'Select icon from library.',  'tokoo' ),
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Choose the icon color', 'tokoo' ),
				'param_name' 	=> 'icon_color',
				'dependency'	=> array(
					'element'		=> 'icon_source',
					'value'			=> 'font_icon',
				),
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Border Color', 'tokoo' ),
				'param_name' 	=> 'border_color',
				'dependency' 	=> Array( 'element' => 'icon_style', 'value' => array( 'circle-outline' ) )
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Icon Background Color', 'tokoo' ),
				'param_name' 	=> 'background_color',
				'dependency' 	=> Array( 'element' => 'icon_style', 'value' => array( 'circle' ) )
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Icon Size', 'tokoo' ),
				'param_name' 	=> 'icon_size',
				'value' 		=> 30,
				'dependency'	=> array(
					'element'		=> 'icon_source',
					'value'			=> 'font_icon',
				),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Title', 'tokoo' ),
				'param_name' 	=> 'title',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Title Size', 'tokoo' ),
				'param_name' 	=> 'title_size',
				'value' 		=> '',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Title Letter Spacing', 'tokoo' ),
				'param_name' 	=> 'title_letter_spacing',
				'value' 		=> '',
			),
			array(
				'type' 			=> 'textarea',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Content', 'tokoo' ),
				'param_name' 	=> 'the_content',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Content Size', 'tokoo' ),
				'param_name' 	=> 'content_size',
				'value' 		=> '',
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Content Alignment', 'tokoo' ),
				'param_name' 	=> 'text_alignment',
				'value'			=> array(
					esc_html__( 'Default', 'tokoo' )		=> 'default',
					esc_html__( 'Align Left', 'tokoo' )			=> 'left',
					esc_html__( 'Align Right', 'tokoo' )	=> 'right',
				),
			),
			array(
				'type' 				=> 'checkbox',
				'heading' 			=> esc_html__( 'Display View More', 'tokoo'),
				'param_name' 		=> 'more',
				'description' 		=> esc_html__( 'If selected, the view more button will be displayed', 'tokoo'),
				'value'				=> Array( esc_html__( 'Yes, please', 'tokoo' ) => 'yes' ),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Link', 'tokoo' ),
				'param_name' 	=> 'more_link',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Link Text', 'tokoo' ),
				'param_name' 	=> 'more_text',
			),
			array(
				'type'			=> 'css_editor',
				'heading'		=> esc_html__( 'Css', 'tokoo' ),
				'param_name'	=> 'css',
				'group'			=> esc_html__( 'Design options', 'tokoo' ),
			),
		)
	) );
}

add_action( 'vc_before_init', 'koo_image_box_integrateWithVC' );
function koo_image_box_integrateWithVC() {
   vc_map( array(
		'name' 					=> esc_html__( 'Tokoo Image Box', 'tokoo' ),
		'base' 					=> 'koo_image_box',
		'class' 				=> 'tokoo-ico',
		'icon' 					=> 'tokoo-ico',
		'category' 				=> esc_html__( 'Features', 'tokoo' ),
		'admin_enqueue_css' 	=> array( trailingslashit( TOKOO_THEME_URI ) . '/bootstrap/Assets/css/tokoovc.css' ),
		'description' 			=> esc_html__( 'Tokoo Image Box.', 'tokoo' ),
		'params' 				=> array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Title', 'tokoo' ),
				'param_name' 	=> 'title',
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Title Color', 'tokoo' ),
				'param_name' 	=> 'title_color',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Title Font Size', 'tokoo' ),
				'param_name' 	=> 'title_font_size',
			),
			array(
				'type' 			=> 'textarea_html',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Content', 'tokoo' ),
				'param_name' 	=> 'content',
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Content Color', 'tokoo' ),
				'param_name' 	=> 'content_color',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Link', 'tokoo' ),
				'param_name' 	=> 'more_link',
			),

			array(
				'type' 			=> 'checkbox',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Use Block Link', 'tokoo' ),
				'param_name' 	=> 'block_link',
			),

			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Link Text', 'tokoo' ),
				'param_name' 	=> 'more_text',
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Link Color', 'tokoo' ),
				'param_name' 	=> 'link_color',
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Content Alignment', 'tokoo' ),
				'param_name' 	=> 'content_alignment',
				'value'			=> array(
					esc_html__( 'Left', 'tokoo' )		=> 'left',
					esc_html__( 'Center', 'tokoo' )		=> 'center',
					esc_html__( 'Right', 'tokoo' )		=> 'right',
				),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Height (in px)', 'tokoo' ),
				'param_name' 	=> 'height',
			),
			array(
				'type' 			=> 'dropdown',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Background Position', 'tokoo' ),
				'param_name' 	=> 'bg_position',
				'value'			=> array(
					esc_html__( "Top Left", "tokoo" ) 		=> "top-left",
					esc_html__( "Top Center", "tokoo" ) 	=> "top-center",
					esc_html__( "Top Right", "tokoo" ) 		=> "top-right",
					esc_html__( "Center Left", "tokoo" ) 	=> "center-left",
					esc_html__( "Center", "tokoo" ) 		=> "center",
					esc_html__( "Center Right", "tokoo" ) 	=> "center-right",
					esc_html__( "Bottom Left", "tokoo" ) 	=> "bottom-left",
					esc_html__( "Bottom Center", "tokoo" ) 	=> "bottom-center",
					esc_html__( "Bottom Right", "tokoo" ) 	=> "bottom-right",
				),
			),
			array(
				'type'			=> 'css_editor',
				'heading'		=> esc_html__( 'Css', 'tokoo' ),
				'param_name'	=> 'css',
				'group'			=> esc_html__( 'Design options', 'tokoo' ),
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Overlay Color', 'tokoo' ),
				'param_name' 	=> 'overlay_color',
			),
			array(
				'type' 			=> 'google_fonts',
				'param_name' 	=> 'google_fonts',
				'value' 		=> 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal',
				'settings' 		=> array(
					'fields' 		=> array(
						'font_family_description' 	=> esc_html__( 'Select font family.', 'tokoo' ),
						'font_style_description' 	=> esc_html__( 'Select font styling.', 'tokoo' )
					)
				),
			),
		)
	) );
}

add_action( 'vc_before_init', 'koo_maps_integrateWithVC' );
function koo_maps_integrateWithVC() {
   vc_map( array(
		'name' 					=> esc_html__( 'Tokoo Maps', 'tokoo' ),
		'base' 					=> 'koo_maps',
		'class' 				=> 'tokoo-ico',
		'icon' 					=> 'tokoo-ico',
		'category' 				=> esc_html__( 'Features', 'tokoo' ),
		'admin_enqueue_css' 	=> array( trailingslashit( TOKOO_THEME_URI ) . '/bootstrap/Assets/css/tokoovc.css' ),
		'description' 			=> esc_html__( 'Tokoo Maps.', 'tokoo' ),
		'params' 				=> array(

			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Latitude', 'tokoo' ),
				'param_name' 	=> 'latitude',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Longitude', 'tokoo' ),
				'param_name' 	=> 'longitude',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Height', 'tokoo' ),
				'param_name' 	=> 'height',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Marker Title', 'tokoo' ),
				'param_name' 	=> 'marker_title',
			),
			array(
				'type' 			=> 'textarea',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Marker Content', 'tokoo' ),
				'param_name' 	=> 'marker_content',
			),

		)
	) );
}

add_action( 'vc_before_init', 'koo_testimonial_box_integrateWithVC' );
function koo_testimonial_box_integrateWithVC() {
   vc_map( array(
		'name' 					=> esc_html__( 'Tokoo Testimonial Box', 'tokoo' ),
		'base' 					=> 'koo_testimonial_box',
		'class' 				=> 'tokoo-ico',
		'icon' 					=> 'tokoo-ico',
		'category' 				=> esc_html__( 'Features', 'tokoo' ),
		'admin_enqueue_css' 	=> array( trailingslashit( TOKOO_THEME_URI ) . '/bootstrap/Assets/css/tokoovc.css' ),
		'description' 			=> esc_html__( 'Tokoo Testimonial Box.', 'tokoo' ),
		'params' 				=> array(
			array(
				'type' 			=> 'attach_image',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Picture', 'tokoo' ),
				'param_name' 	=> 'picture',
			),
			array(
				'type' 			=> 'textarea',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Enter The Content', 'tokoo' ),
				'param_name' 	=> 'testimonial_content',
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Choose the content color', 'tokoo' ),
				'param_name' 	=> 'content_color',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Name', 'tokoo' ),
				'param_name' 	=> 'name',
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Choose the name color', 'tokoo' ),
				'param_name' 	=> 'name_color',
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Position', 'tokoo' ),
				'param_name' 	=> 'position',
			),
			array(
				'type' 			=> 'colorpicker',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Choose the position color', 'tokoo' ),
				'param_name' 	=> 'position_color',
			),
			array(
				'type' 			=> 'google_fonts',
				'param_name' 	=> 'google_fonts',
				'value' 		=> 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:400%20regular%3A400%3Anormal',
				'settings' 		=> array(
					'fields' 		=> array(
						'font_family_description' 	=> esc_html__( 'Select font family.', 'tokoo' ),
						'font_style_description' 	=> esc_html__( 'Select font styling.', 'tokoo' )
					)
				),
			),
			array(
				'type'			=> 'css_editor',
				'heading'		=> esc_html__( 'Css', 'tokoo' ),
				'param_name'	=> 'css',
				'group'			=> esc_html__( 'Design options', 'tokoo' ),
			),
		)
	) );
}

$order_by_values = array(
	'',
	esc_html__( 'Date', 'tokoo' ) 			=> 'date',
	esc_html__( 'ID', 'tokoo' ) 			=> 'ID',
	esc_html__( 'Author', 'tokoo' ) 		=> 'author',
	esc_html__( 'Title', 'tokoo' ) 			=> 'title',
	esc_html__( 'Modified', 'tokoo' ) 		=> 'modified',
	esc_html__( 'Random', 'tokoo' ) 		=> 'rand',
	esc_html__( 'Comment count', 'tokoo' ) 	=> 'comment_count',
	esc_html__( 'Menu order', 'tokoo' ) 	=> 'menu_order',
);
$order_way_values = array(
	'',
	esc_html__( 'Descending', 'tokoo' ) => 'DESC',
	esc_html__( 'Ascending', 'tokoo' ) 	=> 'ASC',
);
vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Products', 'tokoo' ),
	'base' 			=> 'koo_products',
	'icon'			=> 'tokoo-ico',
	'category'		=> esc_html__( 'WooCommerce', 'tokoo' ),
	'description' 	=> esc_html__( 'Show multiple products by ID or SKU.', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Product Per Page', 'tokoo' ),
			'value' 		=> 4,
			'param_name' 	=> 'per_page',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Columns', 'tokoo' ),
			'value' 		=> 4,
			'param_name' 	=> 'columns',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Order by', 'tokoo' ),
			'param_name' 	=> 'orderby',
			'value' 		=> $order_by_values,
			'std' 			=> 'title',
			'save_always' 	=> true,
			'description' 	=> sprintf( wp_kses( __( 'Select how to sort retrieved products. More at %s. Default by Title', 'tokoo' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Sort order', 'tokoo' ),
			'param_name' 	=> 'order',
			'value' 		=> $order_way_values,
			'save_always' 	=> true,
			'description' 	=> sprintf( wp_kses( __( 'Designates the ascending or descending order. More at %s. Default by ASC', 'tokoo' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' 			=> 'autocomplete',
			'heading' 		=> esc_html__( 'Products', 'tokoo' ),
			'param_name' 	=> 'ids',
			'settings' 		=> array(
				'multiple' 		=> true,
				'sortable' 		=> true,
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' 	=> true,
			'description' 	=> esc_html__( 'Enter List of Products', 'tokoo' ),
		),
		array(
			'type' 			=> 'hidden',
			'param_name' 	=> 'skus',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Offset', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'offset',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Thumbnail Size', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'thumbnail_size',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Product Image Style', 'tokoo' ),
			'param_name' 	=> 'product_image_style',
			'value' 		=> $product_image_style,
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Products Carousel', 'tokoo' ),
	'base' 			=> 'koo_products_carousel',
	'icon'			=> 'tokoo-ico',
	'category'		=> esc_html__( 'WooCommerce', 'tokoo' ),
	'description' 	=> esc_html__( 'Show multiple products by ID or SKU in carousel display.', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Product Per Page', 'tokoo' ),
			'value' 		=> 4,
			'param_name' 	=> 'per_page',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Columns', 'tokoo' ),
			'value' 		=> 5,
			'param_name' 	=> 'columns',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Order by', 'tokoo' ),
			'param_name' 	=> 'orderby',
			'value' 		=> $order_by_values,
			'std' 			=> 'title',
			'save_always' 	=> true,
			'description' 	=> sprintf( wp_kses( __( 'Select how to sort retrieved products. More at %s. Default by Title', 'tokoo' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> esc_html__( 'Sort order', 'tokoo' ),
			'param_name' 	=> 'order',
			'value' 		=> $order_way_values,
			'save_always' 	=> true,
			'description' 	=> sprintf( wp_kses( __( 'Designates the ascending or descending order. More at %s. Default by ASC', 'tokoo' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' 			=> 'autocomplete',
			'heading' 		=> esc_html__( 'Products', 'tokoo' ),
			'param_name' 	=> 'ids',
			'settings' 		=> array(
				'multiple' 		=> true,
				'sortable' 		=> true,
				'unique_values' => true,
				// In UI show results except selected. NB! You should manually check values in backend
			),
			'save_always' 	=> true,
			'description' 	=> esc_html__( 'Enter List of Products', 'tokoo' ),
		),
		array(
			'type' 			=> 'hidden',
			'param_name' 	=> 'skus',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Offset', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'offset',
			'save_always' 	=> true,
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Thumbnail Size', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'thumbnail_size',
			'save_always' 	=> true,
			'description' 	=> esc_html__( 'Enter product thumbnail size e.g: 300x300', 'tokoo' ),
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Product Image Style', 'tokoo' ),
			'param_name' 	=> 'product_image_style',
			'value' 		=> array(
				esc_html__( 'Circle', 'tokoo' ) => '',
				esc_html__( 'Square', 'tokoo' ) => 'products--grid-classic',
			),
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Product', 'tokoo' ),
	'base' 			=> 'koo_product',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'WooCommerce', 'tokoo' ),
	'description' 	=> esc_html__( 'Show a single product by ID or SKU', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'autocomplete',
			'heading' 		=> esc_html__( 'Select identificator', 'tokoo' ),
			'param_name' 	=> 'id',
			'description' 	=> esc_html__( 'Input product ID or product SKU or product title to see suggestions', 'tokoo' ),
		),
		array(
			'type' 			=> 'hidden',
			'param_name' 	=> 'sku',
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Thumbnail Size', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'thumbnail_size',
			'save_always' 	=> true,
			'description' 	=> esc_html__( 'Enter product thumbnail size e.g: 300x300', 'tokoo' ),
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Product Image Style', 'tokoo' ),
			'param_name' 	=> 'product_image_style',
			'value' 		=> $product_image_style,
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Menus Slider', 'tokoo' ),
	'base' 			=> 'koo_menus_slider',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'WooCommerce', 'tokoo' ),
	'description' 	=> esc_html__( 'Show a menus slider', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'autocomplete',
			'heading' 		=> esc_html__( 'Products as menus', 'tokoo' ),
			'param_name' 	=> 'ids',
			'settings' 		=> array(
				'multiple' 		=> true,
				'sortable' 		=> true,
				'unique_values' => true,
				'values'		=> tokoo_get_type_posts_data( 'product' ),
			),
			'description' 	=> esc_html__( 'Enter List of Products as menus slider', 'tokoo' ),
		),
		array(
			'type' 			=> 'hidden',
			'param_name' 	=> 'unique_class',
			'value' 		=> 'koo_menus_slider_' . tokoo_generate_random_string(),
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Highlight Section', 'tokoo' ),
	'base' 			=> 'koo_highlight_section',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Show a highlight section', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Title', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'title',
			'save_always' 	=> true,
			'description' 	=> esc_html__( 'Enter the highlight title', 'tokoo' ),
		),
		array(
			'type' 			=> 'colorpicker',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Choose the title color', 'tokoo' ),
			'param_name' 	=> 'title_color',
		),
		array(
			'type' 			=> 'textarea_html',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Enter The Content', 'tokoo' ),
			'param_name' 	=> 'content',
		),
		array(
			'type' 			=> 'colorpicker',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Choose the content color', 'tokoo' ),
			'param_name' 	=> 'content_color',
		),
		array(
			'type' 			=> 'attach_image',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Upload the image', 'tokoo' ),
			'param_name' 	=> 'image',
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Image Position', 'tokoo' ),
			'param_name' 	=> 'image_position',
			'value' 		=> array( 'left', 'right' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Image Size', 'tokoo' ),
			'value' 		=> '540x321',
			'param_name' 	=> 'image_size',
			'description' 	=> esc_html__( 'Enter image size e.g: 540x321', 'tokoo' ),
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Booking Form', 'tokoo' ),
	'base' 			=> 'koo_booking_form',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Show a booking form', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Form Title', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'title',
			'description' 	=> esc_html__( 'Enter the form title', 'tokoo' ),
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Subscribe Form', 'tokoo' ),
	'base' 			=> 'koo_subscribe_form',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Show a subscribe form', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Form Title', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'title',
			'description' 	=> esc_html__( 'Enter the form title', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Form ID', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'id',
			'description' 	=> esc_html__( 'Enter the mailchimp form ID here', 'tokoo' ),
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Section Title', 'tokoo' ),
	'base' 			=> 'koo_section_title',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Custom section title', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Title', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'title',
			'description' 	=> esc_html__( 'Enter the title', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Font Size', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'font_size',
			'description' 	=> esc_html__( 'Enter the font size', 'tokoo' ),
		),
		array(
			'type' 			=> 'colorpicker',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Choose the title color', 'tokoo' ),
			'param_name' 	=> 'title_color',
		),
		array(
			'type' 			=> 'dropdown',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Alignment', 'tokoo' ),
			'param_name' 	=> 'alignment',
			'value'			=> array(
				esc_html__( "Center", "tokoo" ) 	=> "center",
				esc_html__( "Left", "tokoo" ) 		=> "left",
				esc_html__( "Right", "tokoo" ) 		=> "right",
			),
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Separator', 'tokoo' ),
	'base' 			=> 'koo_separator',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Custom separator', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Top Space', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'margin_top',
			'description' 	=> esc_html__( 'Enter the margin top eg:40px', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Bottom Space', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'margin_bottom',
			'description' 	=> esc_html__( 'Enter the margin bottom eg:40px', 'tokoo' ),
		),

	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Team', 'tokoo' ),
	'base' 			=> 'koo_team',
	'class' 		=> 'tokoo-ico',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Show the team', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'attach_image',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Team Avatar', 'tokoo' ),
			'param_name' 	=> 'avatar',
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Team Name', 'tokoo' ),
			'param_name' 	=> 'name',
			'value' 		=> '',
			'description' 	=> esc_html__( 'Enter the team name', 'tokoo' )
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Team Position', 'tokoo' ),
			'param_name' 	=> 'position',
			'value' 		=> '',
			'description' 	=> esc_html__( 'Enter the team position', 'tokoo' )
		),
		array(
			'type' 			=> 'textarea_html',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Team Biography', 'tokoo' ),
			'param_name' 	=> 'content',
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Facebook Username', 'tokoo' ),
			'param_name' 	=> 'facebook',
			'value' 		=> '',
			'description' 	=> esc_html__( 'Enter the facebook username e.g: example', 'tokoo' )
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Twitter Username', 'tokoo' ),
			'param_name' 	=> 'twitter',
			'value' 		=> '',
			'description' 	=> esc_html__( 'Enter the twitter username e.g: example', 'tokoo' )
		),
		array(
			'type' 			=> 'textfield',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'URL', 'tokoo' ),
			'param_name' 	=> 'url',
			'value' 		=> '',
			'description' 	=> esc_html__( 'Enter the team site URL e.g: http://example.com', 'tokoo' )
		),
		array(
			'type' 			=> 'colorpicker',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Background Color', 'tokoo' ),
			'param_name' 	=> 'bg_color',
		),
		array(
			'type' 			=> 'attach_image',
			'class' 		=> '',
			'heading' 		=> esc_html__( 'Background Image', 'tokoo' ),
			'param_name' 	=> 'bg_image',
		),
	)
) );

vc_map( array(
	'name' 			=> esc_html__( 'Tokoo Price Box', 'tokoo' ),
	'base' 			=> 'koo_price_box',
	'icon' 			=> 'tokoo-ico',
	'category' 		=> esc_html__( 'Features', 'tokoo' ),
	'description' 	=> esc_html__( 'Price Box', 'tokoo' ),
	'params' 		=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Price', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'price',
			'description' 	=> esc_html__( 'Enter the price', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Price Title', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'price_title',
			'description' 	=> esc_html__( 'Enter the price title', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Features Title', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'features_title',
			'description' 	=> esc_html__( 'Enter the features title', 'tokoo' ),
		),
		array(
			'type' 			=> 'exploded_textarea',
			'heading' 		=> esc_html__( 'Features List', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'features_list',
			'description' 	=> esc_html__( 'Enter the features list, separated by comma', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Button Link', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'button_link',
			'description' 	=> esc_html__( 'Enter the button link', 'tokoo' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> esc_html__( 'Button Label', 'tokoo' ),
			'value' 		=> '',
			'param_name' 	=> 'button_label',
			'description' 	=> esc_html__( 'Enter the button label', 'tokoo' ),
		),
		array(
			'type'			=> 'css_editor',
			'heading'		=> esc_html__( 'Css', 'tokoo' ),
			'param_name'	=> 'css',
			'group'			=> esc_html__( 'Design options', 'tokoo' ),
		),
	)
) );

add_action( 'vc_before_init', 'koo_fire_up_menus' );
function koo_fire_up_menus() {

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	$args = array(
	    'hide_empty' => false,
	);

	$terms = get_terms(	'product_cat', $args );
	$taxonomies_terms = array();
	if ( ! empty( $terms ) ) {
		foreach ( $terms as $term ) {
			$taxonomies_terms[] = array(
				'value' 	=> $term->term_id,
				'label' 	=> $term->name,
			);
		}
	}

	vc_map( array(
		'name' 			=> esc_html__( 'Tokoo Our Menus', 'tokoo' ),
		'base' 			=> 'koo_our_menus',
		'icon' 			=> 'tokoo-ico',
		'category' 		=> esc_html__( 'WooCommerce', 'tokoo' ),
		'description' 	=> esc_html__( 'Show a our menus', 'tokoo' ),
		'params' 		=> array(
			array(
				'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Category as menus', 'tokoo' ),
				'param_name' 	=> 'ids',
				'settings' 		=> array(
					'values'		=> $taxonomies_terms,
				),
				'description' 	=> esc_html__( 'Enter List of categories as menus', 'tokoo' ),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Product Per Page', 'tokoo' ),
				'value' 		=> 4,
				'param_name' 	=> 'per_page',
				'save_always' 	=> true,
			),
		)
	) );

	vc_map( array(
		'name' 			=> esc_html__( 'Tokoo Menus List', 'tokoo' ),
		'base' 			=> 'koo_product_menu_list',
		'icon' 			=> 'tokoo-ico',
		'category' 		=> esc_html__( 'WooCommerce', 'tokoo' ),
		'description' 	=> esc_html__( 'Show a our menus', 'tokoo' ),
		'params' 		=> array(
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Menu Title', 'tokoo' ),
				'value' 		=> '',
				'param_name' 	=> 'menu_title',
			),
			array(
				'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Category as menus', 'tokoo' ),
				'param_name' 	=> 'ids',
				'settings' 		=> array(
					'values'		=> $taxonomies_terms,
				),
				'description' 	=> esc_html__( 'Enter List of categories as menus', 'tokoo' ),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Columns', 'tokoo' ),
				'param_name' 	=> 'columns',
				'std' 			=> '3',
				'value'			=> array( 
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
				),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Product Per Columns', 'tokoo' ),
				'value' 		=> '3',
				'param_name' 	=> 'per_columns',
				'save_always' 	=> true,
			),
			array(
				'type' 				=> 'checkbox',
				'heading' 			=> esc_html__( 'Show Thumbnail', 'tokoo'),
				'param_name' 		=> 'show_thumbnail',
				'description' 		=> esc_html__( 'If selected, thumbnail will be displayed', 'tokoo'),
				'value'				=> Array( esc_html__('Yes, please', 'tokoo') => 'yes' ),
			),
		)
	) );

	vc_map( array(
		'name' 			=> esc_html__( 'Tokoo Menus Grid', 'tokoo' ),
		'base' 			=> 'koo_product_menu_grid',
		'icon' 			=> 'tokoo-ico',
		'category' 		=> esc_html__( 'WooCommerce', 'tokoo' ),
		'description' 	=> esc_html__( 'Show a our menus', 'tokoo' ),
		'params' 		=> array(
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Menu Title', 'tokoo' ),
				'value' 		=> '',
				'param_name' 	=> 'menu_title',
			),
			array(
				'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Category as menus', 'tokoo' ),
				'param_name' 	=> 'ids',
				'settings' 		=> array(
					'values'		=> $taxonomies_terms,
				),
				'description' 	=> esc_html__( 'Enter List of categories as menus', 'tokoo' ),
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Columns', 'tokoo' ),
				'param_name' 	=> 'columns',
				'std' 			=> '3',
				'value'			=> array( 
					'2' 	=> '2',
					'3' 	=> '3',
					'4' 	=> '4',
				),
			),
			array(
				'type' 				=> 'checkbox',
				'heading' 			=> esc_html__( 'Remove Column Gutter', 'tokoo'),
				'param_name' 		=> 'remove_column_gutter',
				'description' 		=> esc_html__( 'If selected, the column gutter will be displayed', 'tokoo'),
				'value'				=> Array( esc_html__( 'Yes, please', 'tokoo' ) => 'yes' ),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Product Limit', 'tokoo' ),
				'value' 		=> '8',
				'param_name' 	=> 'product_limit',
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Grid Style', 'tokoo' ),
				'param_name' 	=> 'grid_style',
				'std' 			=> 'expanded',
				'value'			=> array( 
					'Expanded' 	=> 'expanded',
					'Cover' 	=> 'cover',
				),
			),
		)
	) );

	vc_map( array(
		'name' 			=> esc_html__( 'Tokoo Menus Parallax', 'tokoo' ),
		'base' 			=> 'koo_product_menu_parallax',
		'icon' 			=> 'tokoo-ico',
		'category' 		=> esc_html__( 'WooCommerce', 'tokoo' ),
		'description' 	=> esc_html__( 'Show a our menus', 'tokoo' ),
		'params' 		=> array(
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Menu Title', 'tokoo' ),
				'value' 		=> '',
				'param_name' 	=> 'menu_title',
			),
			array(
				'type' 			=> 'autocomplete',
				'heading' 		=> esc_html__( 'Category as menus', 'tokoo' ),
				'param_name' 	=> 'ids',
				'settings' 		=> array(
					'values'		=> $taxonomies_terms,
				),
				'description' 	=> esc_html__( 'Enter List of categories as menus', 'tokoo' ),
			),
			array(
				'type' 			=> 'attach_image',
				'class' 		=> '',
				'heading' 		=> esc_html__( 'Category image', 'tokoo' ),
				'param_name' 	=> 'category_image',
			),
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Menu Position', 'tokoo' ),
				'param_name' 	=> 'menu_position',
				'std' 			=> '3',
				'value'			=> array( 
					'Left' 		=> 'left',
					'Center' 	=> 'center',
					'Right' 	=> 'right',
				),
			),
			array(
				'type' 			=> 'textfield',
				'heading' 		=> esc_html__( 'Product Limit', 'tokoo' ),
				'value' 		=> '8',
				'param_name' 	=> 'product_limit',
			),
			array(
				'type' 				=> 'checkbox',
				'heading' 			=> esc_html__( 'Show Thumbnail', 'tokoo'),
				'param_name' 		=> 'show_thumbnail',
				'description' 		=> esc_html__( 'If selected, thumbnail will be displayed', 'tokoo'),
				'value'				=> Array( esc_html__('Yes, please', 'tokoo') => 'yes' ),
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Menu background color', 'tokoo' ),
				'param_name' 	=> 'menu_background_color',
				'description' 	=> esc_html__( 'Select custom menu background color.', 'tokoo' ),
			),
			array(
				'type' 			=> 'colorpicker',
				'heading' 		=> esc_html__( 'Menu Content color', 'tokoo' ),
				'param_name' 	=> 'menu_content_color',
				'description' 	=> esc_html__( 'Select custom menu content color.', 'tokoo' ),
			),
			
		)
	) );
}


add_filter( 'vc_autocomplete_koo_products_ids_callback', 'tokoo_product_autocomplete_suggestion', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_koo_products_ids_render', 'tokoo_product_autocomplete_render', 10, 1 ); // Render exact product. Must return an array (label,value)
add_filter( 'vc_form_fields_render_field_products_ids_param_value', 'tokoo_product_ids_default_value', 10, 4 );
add_filter( 'vc_autocomplete_koo_products_carousel_ids_callback', 'tokoo_product_autocomplete_suggestion', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_koo_products_carousel_ids_render', 'tokoo_product_autocomplete_render', 10, 1 ); // Render exact product. Must return an array (label,value)
add_filter( 'vc_autocomplete_koo_product_id_callback', 'tokoo_product_autocomplete_suggestion', 10, 1 ); // Get suggestion(find). Must return an array
add_filter( 'vc_autocomplete_koo_product_id_render', 'tokoo_product_autocomplete_render', 10, 1 ); // Render exact product. Must return an array (label,value)
add_filter( 'vc_form_fields_render_field_koo_product_id_param_value', 'tokoo_product_id_default_value', 10, 4 );

//remove element
vc_remove_element( 'vc_gmaps' );


class WPBakeryShortCode_Koo_Icon_Box extends WPBakeryShortCode {
}
class WPBakeryShortCode_Koo_Image_Box extends WPBakeryShortCode {

	/**
	 * Defines fields names for google_fonts, font_container and etc
	 * @since 4.4
	 * @var array
	 */
	protected $fields = array(
		'google_fonts' => 'google_fonts',
		'font_container' => 'font_container',
		'text' => 'text',
	);

	/**
	 * Used to get field name in vc_map function for google_fonts, font_container and etc..
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return bool
	 */
	protected function getField( $key ) {
		return isset( $this->fields[ $key ] ) ? $this->fields[ $key ] : false;
	}

	/**
	 * Get param value by providing key
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return array|bool
	 */
	protected function getParamData( $key ) {
		return WPBMap::getParam( $this->shortcode, $this->getField( $key ) );
	}

}
class WPBakeryShortCode_Koo_Pagination extends WPBakeryShortCode {
}
class WPBakeryShortCode_Koo_Maps extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Menus_Slider extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Our_Menus extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Product_Menu_List extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Product_Menu_Grid extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Product_Menu_Parallax extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Highlight_Section extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Booking_Form extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Subscribe_Form extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Section_Title extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Separator extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Team extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Products extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Products_Carousel extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Product extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Price_Box extends WPBakeryShortCode{
}
class WPBakeryShortCode_Koo_Testimonial_Box extends WPBakeryShortCode{
	/**
	 * Defines fields names for google_fonts, font_container and etc
	 * @since 4.4
	 * @var array
	 */
	protected $fields = array(
		'google_fonts' => 'google_fonts',
		'font_container' => 'font_container',
		'text' => 'text',
	);

	/**
	 * Used to get field name in vc_map function for google_fonts, font_container and etc..
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return bool
	 */
	protected function getField( $key ) {
		return isset( $this->fields[ $key ] ) ? $this->fields[ $key ] : false;
	}

	/**
	 * Get param value by providing key
	 *
	 * @param $key
	 *
	 * @since 4.4
	 * @return array|bool
	 */
	protected function getParamData( $key ) {
		return WPBMap::getParam( $this->shortcode, $this->getField( $key ) );
	}
}

function tokoo_product_id_default_value( $current_value, $param_settings, $map_settings, $atts ) {
	$value = trim( $current_value );
	if ( strlen( trim( $current_value ) ) === 0 && isset( $atts['sku'] ) && strlen( $atts['sku'] ) > 0 ) {
		$value = $Vc_Vendor_Woocommerce->productIdDefaultValueFromSkuToId( $atts['sku'] );
	}

	return $value;
}

function tokoo_product_ids_default_value( $current_value, $param_settings, $map_settings, $atts ) {
	$Vc_Vendor_Woocommerce = new Vc_Vendor_Woocommerce();
	$value = trim( $current_value );
	if ( strlen( trim( $value ) ) === 0 && isset( $atts['skus'] ) && strlen( $atts['skus'] ) > 0 ) {
		$data = array();
		$skus = $atts['skus'];
		$skus_array = explode( ',', $skus );
		foreach ( $skus_array as $sku ) {
			$id = $Vc_Vendor_Woocommerce->productIdDefaultValueFromSkuToId( trim( $sku ) );
			if ( is_numeric( $id ) ) {
				$data[] = $id;
			}
		}
		if ( ! empty( $data ) ) {
			$values = explode( ',', $value );
			$values = array_merge( $values, $data );
			$value = implode( ',', $values );
		}
	}

	return $value;
}

function tokoo_product_autocomplete_suggestion( $query ) {
	global $wpdb;
	$product_id = (int) $query;
	$post_meta_infos = $wpdb->get_results(
		$wpdb->prepare( "SELECT a.ID AS id, a.post_title AS title, b.meta_value AS sku
				FROM {$wpdb->posts} AS a
				LEFT JOIN ( SELECT meta_value, post_id  FROM {$wpdb->postmeta} WHERE `meta_key` = '_sku' ) AS b ON b.post_id = a.ID
				WHERE a.post_type = 'product' AND ( a.ID = '%d' OR b.meta_value LIKE '%%%s%%' OR a.post_title LIKE '%%%s%%' )",
			$product_id > 0 ? $product_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

	$results = array();
	if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
		foreach ( $post_meta_infos as $value ) {
			$data = array();
			$data['value'] = $value['id'];
			$data['label'] = esc_html__( 'Id', 'tokoo' ) . ': ' .
			                 $value['id'] .
			                 ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'tokoo' ) . ': ' .
			                                                       $value['title'] : '' ) .
			                 ( ( strlen( $value['sku'] ) > 0 ) ? ' - ' . esc_html__( 'Sku', 'tokoo' ) . ': ' .
			                                                     $value['sku'] : '' );
			$results[] = $data;
		}
	}

	return $results;
}

function tokoo_product_autocomplete_render( $query ) {
	$query = trim( $query['value'] ); // get value from requested
	if ( ! empty( $query ) ) {
		// get product
		$product_object = wc_get_product( (int) $query );
		if ( is_object( $product_object ) ) {
			$product_sku = $product_object->get_sku();
			$product_title = $product_object->get_title();
			$product_id = $product_object->id;

			$product_sku_display = '';
			if ( ! empty( $product_sku ) ) {
				$product_sku_display = ' - ' . esc_html__( 'Sku', 'tokoo' ) . ': ' . $product_sku;
			}

			$product_title_display = '';
			if ( ! empty( $product_title ) ) {
				$product_title_display = ' - ' . esc_html__( 'Title', 'tokoo' ) . ': ' . $product_title;
			}

			$product_id_display = esc_html__( 'Id', 'tokoo' ) . ': ' . $product_id;

			$data = array();
			$data['value'] = $product_id;
			$data['label'] = $product_id_display . $product_title_display . $product_sku_display;

			return ! empty( $data ) ? $data : false;
		}

		return false;
	}

	return false;
}

endif;