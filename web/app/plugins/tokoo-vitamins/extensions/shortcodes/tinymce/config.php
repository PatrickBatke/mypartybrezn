<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$koo_shortcodes['buttons'] = array(
	'no_preview' 	=> true,
	'params' 		=> array(
		'url' 		=> array(
			'std'		=> '',
			'type'		=> 'text',
			'label'		=> __( 'Button URL', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the button\'s url eg http://example.com', 'tokoo-vitamins' )
		),

		'type'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Button Color', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the button color', 'tokoo-vitamins' ),
			'options'	=> array(
				'regular'	=> __( 'Regular', 'tokoo-vitamins' ),
				'info'		=> __( 'Info', 'tokoo-vitamins' ),
				'warning'	=> __( 'Warning', 'tokoo-vitamins' ),
				'error'		=> __( 'Error', 'tokoo-vitamins' ),
			)
		),

		'size'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Button Size', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the button size', 'tokoo-vitamins' ),
			'options'	=> array(
				'small'		=> __( 'Small', 'tokoo-vitamins' ),
				'medium'	=> __( 'Medium', 'tokoo-vitamins' ),
				'large'		=> __( 'Large', 'tokoo-vitamins' )
			)
		),

		'target'	=> array(
			'type'		=> 'select',
			'label'		=> __( 'Button Target', 'tokoo-vitamins' ),
			'desc'		=> __( '_self = open in same window. _blank = open in new window', 'tokoo-vitamins' ),
			'options'	=> array(
				'_self'		=> '_self',
				'_blank'	=> '_blank'
			)
		),

		'icon'		=> array(
			'std'		=> __( 'fa-heart', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'Button Icon', 'tokoo-vitamins' ),
			'desc'		=> __( 'Enter button icon, eg : fa-heart', 'tokoo-vitamins' ),
		),

		'content'	=> array(
			'std'		=> __( 'Button Text', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'Button Text', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the button text', 'tokoo-vitamins' ),
		)

	),
	'shortcode'		=> '[koo_button url="{{url}}" type="{{type}}" size="{{size}}" icon="{{icon}}" target="{{target}}"] {{content}} [/koo_button]',
	'popup_title'	=> __( 'Insert Button Shortcode', 'tokoo-vitamins' )
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$koo_shortcodes['alert'] = array(
	'no_preview'	=> true,
	'params'		=> array(
		'type'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Alert Type', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the alert type', 'tokoo-vitamins' ),
			'options'	=> array(
				'info'		=> __( 'Info', 'tokoo-vitamins' ),
				'warning'	=> __( 'Warning', 'tokoo-vitamins' ),
				'error'		=> __( 'Error', 'tokoo-vitamins' ),
			)
		),

		'content'	=> array(
			'std'		=> __( 'Your Alert!', 'tokoo-vitamins' ),
			'type'		=> 'textarea',
			'label'		=> __( 'Alert Text', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the alert text', 'tokoo-vitamins' ),
		),

		'dismisable' 	=> array(
			'std'		=> 'off',
			'type'		=> 'checkbox',
			'label'		=> __( 'Dismissable', 'tokoo-vitamins' ),
			'checkbox_text'		=> __( 'Yes', 'tokoo-vitamins' ),
			'desc'		=> __( 'Is the alert dismissable?', 'tokoo-vitamins' ),
		),
		
	),
	'shortcode'		=> '[koo_alert type="{{type}}" dismisable="{{dismisable}}"] {{content}} [/koo_alert]',
	'popup_title'	=> __( 'Insert Alert Shortcode', 'tokoo-vitamins' )
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$koo_shortcodes['tabs'] = array(
	'params'		=> array(),
	'no_preview'	=> true,
	'shortcode'		=> '[koo_tabs] {{child_shortcode}}  [/koo_tabs]',
	'popup_title'	=> __( 'Insert Tab Shortcode', 'tokoo-vitamins' ),
	
	'child_shortcode'	=> array(
		'params'		=> array(
			'title'		=> array(
				'std'		=> __( 'Title', 'tokoo-vitamins' ),
				'type'		=> 'text',
				'label'		=> __( 'Tab Title', 'tokoo-vitamins' ),
				'desc'		=> __( 'Title of the tab', 'tokoo-vitamins' ),
			),

			'content'	=> array(
				'std'		=> __( 'Tab Content', 'tokoo-vitamins' ),
				'type'		=> 'textarea',
				'label'		=> __( 'Tab Content', 'tokoo-vitamins' ),
				'desc'		=> __( 'Add the tabs content', 'tokoo-vitamins' )
			)
		),
		'shortcode'		=> '[koo_tab title="{{title}}"] {{content}} [/koo_tab]',
		'clone_button'	=> __( 'Add Tab Shortcode', 'tokoo-vitamins' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$koo_shortcodes['columns'] = array(
	'params'		=> array(),
	'shortcode'		=> ' {{child_shortcode}} ',
	'popup_title'	=> __( 'Insert Columns Shortcode', 'tokoo-vitamins' ),
	'no_preview'	=> true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params'		=> array(
			'column'	=> array(
				'type'		=> 'select',
				'label'		=> __( 'Column Type', 'tokoo-vitamins' ),
				'desc'		=> __( 'Select the width of the column.', 'tokoo-vitamins' ),
				'options'	=> array(
					'koo_one_third'			=> __( 'One Third', 'tokoo-vitamins' ),
					'koo_one_third_last'	=> __( 'One Third Last', 'tokoo-vitamins' ),
					'koo_two_third'			=> __( 'Two Thirds', 'tokoo-vitamins' ),
					'koo_two_third_last'	=> __( 'Two Thirds Last', 'tokoo-vitamins' ),
					'koo_one_half'			=> __( 'One Half', 'tokoo-vitamins' ),
					'koo_one_half_last'		=> __( 'One Half Last', 'tokoo-vitamins' ),
					'koo_one_fourth'		=> __( 'One Fourth', 'tokoo-vitamins' ),
					'koo_one_fourth_last'	=> __( 'One Fourth Last', 'tokoo-vitamins' ),
					'koo_three_fourth'		=> __( 'Three Fourth', 'tokoo-vitamins' ),
					'koo_three_fourth_last'	=> __( 'Three Fourth Last', 'tokoo-vitamins' ),
					'koo_one_fifth'			=> __( 'One Fifth', 'tokoo-vitamins' ),
					'koo_one_fifth_last'	=> __( 'One Fifth Last', 'tokoo-vitamins' ),
					'koo_two_fifth'			=> __( 'Two Fifth', 'tokoo-vitamins' ),
					'koo_two_fifth_last'	=> __( 'Two Fifth Last', 'tokoo-vitamins' ),
					'koo_three_fifth'		=> __( 'Three Fifth', 'tokoo-vitamins' ),
					'koo_three_fifth_last'	=> __( 'Three Fifth Last', 'tokoo-vitamins' ),
					'koo_four_fifth'		=> __( 'Four Fifth', 'tokoo-vitamins' ),
					'koo_four_fifth_last'	=> __( 'Four Fifth Last', 'tokoo-vitamins' ),
					'koo_one_sixth'			=> __( 'One Sixth', 'tokoo-vitamins' ),
					'koo_one_sixth_last'	=> __( 'One Sixth Last', 'tokoo-vitamins' ),
					'koo_five_sixth'		=> __( 'Five Sixth', 'tokoo-vitamins' ),
					'koo_five_sixth_last'	=> __( 'Five Sixth Last', 'tokoo-vitamins' )
				)
			),
			'content'	=> array(
				'std'		=> '',
				'type'		=> 'textarea',
				'label'		=> __( 'Column Content', 'tokoo-vitamins' ),
				'desc'		=> __( 'Add the column content.', 'tokoo-vitamins' ),
			)
		),
		'shortcode'		=> '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button'	=> __( 'Add Column Shortcode', 'tokoo-vitamins' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Hightlight Config
/*-----------------------------------------------------------------------------------*/
$koo_shortcodes['highlight'] = array(
	'no_preview'	=> true,
	'params'		=> array(
		'type'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Highlight Color', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the highlight color', 'tokoo-vitamins' ),
			'options'	=> array(
				'regular'	=> __( 'Regular', 'tokoo-vitamins' ),
				'info'		=> __( 'Info', 'tokoo-vitamins' ),
				'warning'	=> __( 'Warning', 'tokoo-vitamins' ),
				'error'		=> __( 'Error', 'tokoo-vitamins' ),
			)
		),
		'content'	=> array(
			'std'		=> __( 'Highlighted Text', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'Highlight Text', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the highlight\'s text', 'tokoo-vitamins' ),
		)
		
	),
	'shortcode'		=> '[koo_highlight type="{{type}}"] {{content}} [/koo_highlight]',
	'popup_title'	=> __( 'Insert Highlight Shortcode', 'tokoo-vitamins' )
);

/*-----------------------------------------------------------------------------------*/
/*	Box Config
/*-----------------------------------------------------------------------------------*/

$koo_shortcodes['box'] = array(
	'no_preview'	=> true,
	'params'		=> array(
		'type'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Box Color', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the boxes color', 'tokoo-vitamins' ),
			'options'	=> array(
				'info'		=> __( 'Info', 'tokoo-vitamins' ),
				'warning'	=> __( 'Warning', 'tokoo-vitamins' ),
				'error'		=> __( 'Error', 'tokoo-vitamins' ),
			)
		),
		'title'		=> array(
			'std'		=> __( 'Title', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'Box Title', 'tokoo-vitamins' ),
			'desc'		=> __( 'The box title', 'tokoo-vitamins' ),
		),
		'content'	=> array(
			'std'		=> __( 'Your Box Content!', 'tokoo-vitamins' ),
			'type'		=> 'textarea',
			'label'		=> __( 'Box Content', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the box content', 'tokoo-vitamins' ),
		)
		
	),
	'shortcode'		=> '[koo_box type="{{type}}" title="{{title}}"] {{content}} [/koo_box]',
	'popup_title'	=> __( 'Insert Box Shortcode', 'tokoo-vitamins' )
);

/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/
$koo_shortcodes['accordions'] = array(
	'params'		=> array(),
	'no_preview'	=> true,
	'shortcode'		=> '[koo_accordions] {{child_shortcode}}  [/koo_accordions]',
	'popup_title'	=> __( 'Insert Accordion Shortcode', 'tokoo-vitamins' ),
	
	'child_shortcode'	=> array(
		'params'		=> array(
			'title'		=> array(
				'std'		=> __( 'Title', 'tokoo-vitamins' ),
				'type'		=> 'text',
				'label'		=> __( 'Accordion Title', 'tokoo-vitamins' ),
				'desc'		=> __( 'Title of the accordion', 'tokoo-vitamins' ),
			),
			'content'	=> array(
				'std'		=> __( 'Accordion Content', 'tokoo-vitamins' ),
				'type'		=> 'textarea',
				'label'		=> __( 'Accordion Content', 'tokoo-vitamins' ),
				'desc'		=> __( 'Add the accordions content', 'tokoo-vitamins' )
			)
		),
		'shortcode'		=> '[koo_accordion title="{{title}}"] {{content}} [/koo_accordion]',
		'clone_button'	=> __( 'Add Accordion Shortcode', 'tokoo-vitamins' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Leading Paragraph
/*-----------------------------------------------------------------------------------*/
$koo_shortcodes['leading'] = array(
	'no_preview'	=> true,
	'params'		=> array(
		'content'	=> array(
			'std'		=> __( 'Your Paragraph Content!', 'tokoo-vitamins' ),
			'type'		=> 'textarea',
			'label'		=> __( 'Paragraph Content', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the paragraph content', 'tokoo-vitamins' ),
		)
		
	),
	'shortcode'		=> '[koo_leading_paragraph] {{content}} [/koo_leading_paragraph]',
	'popup_title'	=> __( 'Insert Leading Pragraph Shortcode', 'tokoo-vitamins' )
);

/*-----------------------------------------------------------------------------------*/
/*	Dropcap Text
/*-----------------------------------------------------------------------------------*/
$koo_shortcodes['dropcap'] = array(
	'no_preview'	=> true,
	'params'		=> array(
		'type'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Dropcap Type', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the dropcap type', 'tokoo-vitamins' ),
			'options'	=> array(
				'normal'	=> __( 'Normal', 'tokoo-vitamins' ),
				'boxed'		=> __( 'Boxed', 'tokoo-vitamins' ),
			)
		),
		'content'	=> array(
			'std'		=> __( 'D', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'Dropcap Text', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the dropcap text', 'tokoo-vitamins' ),
		)
	),
	'shortcode'		=> '[koo_dropcap type="{{type}}"] {{content}} [/koo_dropcap]',
	'popup_title'	=> __( 'Insert Dropcap Shortcode', 'tokoo-vitamins' )
);

/*-----------------------------------------------------------------------------------*/
/*	Pullquote
/*-----------------------------------------------------------------------------------*/
$koo_shortcodes['pullquote'] = array(
	'no_preview'	=> true,
	'params'		=> array(
		'position'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Position', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the dropcap position', 'tokoo-vitamins' ),
			'options'	=> array(
				'left'	=> __( 'Left', 'tokoo-vitamins' ),
				'right'	=> __( 'Right', 'tokoo-vitamins' ),
			)
		),
		'style'		=> array(
			'type'		=> 'select',
			'label'		=> __( 'Quote Style', 'tokoo-vitamins' ),
			'desc'		=> __( 'Select the quote style', 'tokoo-vitamins' ),
			'options'	=> array(
				'plain'		=> __( 'Plain', 'tokoo-vitamins' ),
				'regular'	=> __( 'Regular', 'tokoo-vitamins' ),
				'boxed'		=> __( 'Boxed', 'tokoo-vitamins' ),
			)
		),
		'cite'		=> array(
			'std'		=> __( 'John Doe', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'Quote Cite', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the quote cite', 'tokoo-vitamins' ),
		),
		'from'		=> array(
			'std'		=> __( 'Company Name', 'tokoo-vitamins' ),
			'type'		=> 'text',
			'label'		=> __( 'From', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the company name', 'tokoo-vitamins' ),
		),
		'avatar'		=> array(
			'std'		=> '',
			'type'		=> 'text',
			'label'		=> __( 'Avatar Image URL', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the avatar image url', 'tokoo-vitamins' ),
		),
		'content'	=> array(
			'std'		=> __( 'Quote Content', 'tokoo-vitamins' ),
			'type'		=> 'textarea',
			'label'		=> __( 'Quote Content', 'tokoo-vitamins' ),
			'desc'		=> __( 'Add the Quote Content', 'tokoo-vitamins' ),
		)
	),
	'shortcode'		=> '[koo_pullquote position="{{position}}" cite="{{cite}}" from="{{from}}" avatar="{{avatar}}"] {{content}} [/koo_pullquote]',
	'popup_title'	=> __( 'Insert Pullquote Shortcode', 'tokoo-vitamins' )
);