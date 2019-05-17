<?php

/**
 * @version   1.0
 * @author    alispx
 * @copyright Copyright (c) 2015, alispx
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
class Tokoo_New_Customizer {

	protected static $default_data = array(
			'default' 		=> '',
			'slug' 			=> '',
			'panel'			=> '',
			'section'		=> '',
			'label' 		=> '',
			'description'	=> '',
			'transport' 	=> 'postMessage',
			'priority' 		=> '',
			'type' 			=> 'color',
			'selector' 		=> '',
			'property' 		=> '',
			'property2' 	=> '',
			'output' 		=> true,
			'font_amount' 	=> 500,
		);

	function __construct() {
		add_action( 'customize_register', array( $this, 'tokoo_theme_customizer_register' ), 10 );
		add_action( 'customize_preview_init', array( $this, 'tokoo_customizer_live_preview' ) , 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'tokoo_customizer_font_output' ), 15 );
		add_action( 'wp_head', array( $this, 'tokoo_customizer_print_css' ), 20 );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'tokoo_customizer_enqueue_scripts' ), 20 );
	}

	/**
	 * Get all registered data
	 *
	 * @since 1.0
	 */
	function tokoo_get_customizer_data() {
		$tokoo_options = array();
		return apply_filters( 'tokoo_new_customizer_data', $tokoo_options );
	}

	/**
	 * Register Custom Sections, Settings, And Controls
	 *
	 * @since 1.0
	 */
	function tokoo_theme_customizer_register( $wp_customize ) {
		
		foreach ( glob( TOKOO_VITAMINS_PATH . "extensions/customizer/*.php" ) as $filename ) {
		    if ( $filename !== TOKOO_VITAMINS_PATH . "extensions/customizer/TokooCustomizer.php" ) {
		    	include $filename;
		    }
		}

		// Rename Colors Sections Into General Colors
		$wp_customize->remove_section( 'colors' );
		$tokoo_data = $this->tokoo_get_customizer_data();

		//create the componen from array data
		foreach ( $tokoo_data as $data ) {

			$data = wp_parse_args( $data, self::$default_data );

			// Define each customizer type
			switch ( $data['type'] ) {

				case 'panel':
					// Add Panel
					$wp_customize->add_panel( $data['slug'], array(
						'priority'			=> $data['priority'],
						'capability'		=> 'edit_theme_options',
						'theme_supports'	=> '',
						'title'				=> $data['label'],
						'description'		=> $data['description'],
					) );

					break;

				case 'section':
					// Add Section
					$wp_customize->add_section( $data['slug'],
						array(
							'title'    	=> $data['label'],
							'priority' 	=> $data['priority'],
							'panel' 	=> $data['panel']
					));
					break;

				case 'color':
				case 'color_rgb':
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'			=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_hex_color',
							)
						);
					$wp_customize->add_control( new WP_Customize_Color_Control(
						$wp_customize, $data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug']
							)
						) );
					break;

				case 'color_special':
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'			=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_hex_color',
							)
						);
					$wp_customize->add_control( new WP_Customize_Color_Control(
						$wp_customize, $data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug']
							)
						) );
					break;

				case 'text' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_text_field',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'type'			=> 'text'
							)
						));
					break;

				case 'email' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_email',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'type'			=> 'email'
							)
						));
					break;

				case 'url' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'esc_url',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'type'			=> 'url'
							)
						));
					break;

				case 'password' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_text_field',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'type'			=> 'password'
							)
						));
					break;

				case 'textarea' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> '',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'type'			=> 'textarea'
							)
						));
					break;

				case 'date' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'capability' 		=> 'edit_theme_options',
							'transport'   		=> $data['transport'],
							'sanitize_callback'	=> 'sanitize_text_field',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'default' 		=> $data['default'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'type'			=> 'date'
							)
						));
					break;

				case 'select' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> 'esc_attr',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'choices'	=> $data['choices'],
							'type'		=> 'select'
							)
						));
					break;

				case 'radio' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> 'esc_attr',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'choices'	=> $data['choices'],
							'type'		=> 'radio'
							)
						));
					break;

				case 'dropdown-pages' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> 'esc_attr',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'type'		=> 'dropdown-pages'
							)
						));
					break;

				case 'checkbox' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> 'esc_attr',
						) );
					$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'default' 	=> $data['default'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'type'		=> 'checkbox'
							)
						));
					break;

				case 'images' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_url_raw',
							));
					$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'image_select' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Image_Select_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'choices' 	=> $data['choices']
							 )));
					break;

				case 'file' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_url_raw',
							));
					$wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'category_dropdown' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Category_Dropdown_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'menu_dropdown' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Menu_Dropdown_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'post_dropdown' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Post_Dropdown_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'slider_input' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default'           => $data['default'],
							'capability'        => 'edit_theme_options',
							'type'              => 'theme_mod',
							'transport'			=> $data['transport'],
							'sanitize_callback' => 'esc_attr',
						)
					);
					$wp_customize->add_control( new Tokoo_Slider_Input_CUstom_control( $wp_customize, 
						$data['slug'],
						array(
							'label'    => $data['label'],
							'section'  => $data['section'],
							'priority' => $data['priority'],
							'settings' => $data['slug'],
							'min'      => $data['min'],
							'max'      => $data['max'],
						) ) );
					break;

				case 'post_type_dropdown' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Post_Type_Dropdown_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'dropdown_user' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_User_Dropdown_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'editor' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_textarea',
							));
					$wp_customize->add_control( new Tokoo_Text_Editor_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug']
							 )));
					break;

				case 'google_font' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					if ( class_exists( 'Google_Font_Dropdown_Custom_Control' ) ) {
						$wp_customize->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customize,
							$data['slug'],
							array(
								'label' 	=> $data['label'],
								'section' 	=> $data['section'],
								'priority'	=> $data['priority'],
								'settings' 	=> $data['slug'],
								'amount' 	=> $data['font_amount']
								 )));
					}
					break;

				case 'select_chosen' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Chosen_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'choices' 	=> $data['choices'],
							 )));
					break;

				case 'image_select' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'capability' 		=> 'edit_theme_options',
							'type' 				=> 'theme_mod',
							'sanitize_callback'	=> 'esc_attr',
							));
					$wp_customize->add_control( new Tokoo_Image_Select_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 		=> $data['label'],
							'section' 		=> $data['section'],
							'priority'		=> $data['priority'],
							'settings' 		=> $data['slug'],
							'choices' 		=> $data['choices']
							 )));
					break;

				case 'checkbox_multiple' :
					$wp_customize->add_setting( $data['slug'],
						array(
							'default' 			=> $data['default'],
							'type' 				=> 'theme_mod',
							'transport'   		=> $data['transport'],
							'capability' 		=> 'edit_theme_options',
							'sanitize_callback'	=> 'esc_attr',
						) );
					$wp_customize->add_control( new Tokoo_Checkbox_Multiple_Custom_Control( $wp_customize,
						$data['slug'],
						array(
							'label' 	=> $data['label'],
							'section' 	=> $data['section'],
							'priority'	=> $data['priority'],
							'settings' 	=> $data['slug'],
							'choices'	=> $data['choices']
							)
						));
					break;

				default:
					break;
			}
		}
	}

	/**
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see add_action( 'customize_preview_init', $func )
	 */
	function tokoo_customizer_live_preview() {

		$tokoo_options	= $this->tokoo_get_customizer_data();

		wp_enqueue_script( 'customizer-preview', TOKOO_VITAMINS_URL . 'extensions/customizer/assets/js/customizer-preview.js', array( 'jquery', 'customize-preview' ), '', true );
		wp_localize_script(	'customizer-preview', 'mieStyle', $tokoo_options );

	}

	/**
	* Enqueue Scripts
	*
	* @return void
	* @author alispx
	**/
	function tokoo_customizer_enqueue_scripts() {
		$tokoo_options	= array();
		$tokoo_options	= $this->tokoo_get_customizer_data( $tokoo_options );
		wp_enqueue_script( 	'jquery-ui-slider' );
		wp_enqueue_script( 'tokoo-new-customizer-plugins', TOKOO_VITAMINS_URL . 'extensions/customizer/assets/js/plugins.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'tokoo-new-customizer-methods', TOKOO_VITAMINS_URL . 'extensions/customizer/assets/js/mie-methods.js', array( 'jquery' ), '', true );
		wp_localize_script( 'tokoo-new-customizer-methods', 'mieScript', $tokoo_options );
		wp_enqueue_style( 'tokoo-new-customizer-style', TOKOO_VITAMINS_URL . 'extensions/customizer/assets/css/mie-styles.css' );
		wp_enqueue_style( 'tokoo-new-customizer-plugins', TOKOO_VITAMINS_URL . 'extensions/customizer/assets/css/plugins.min.css' );
	}

	/**
	 * Sanitize and Print To Head
	 *
	 * @since 1.0
	 */
	function tokoo_customizer_print_css() {

		$tokoo_options 	= $this->tokoo_get_customizer_data();
		$style 			= '';

		foreach ( $tokoo_options as $data ) {

			$data = wp_parse_args( $data, self::$default_data );

			$selectors 	= $data['selector'];
			$newvalue	= get_theme_mod( $data['slug'] );

			if ( isset( $newvalue ) && ! empty( $newvalue ) ) {
				switch ( $data['type'] ) {

					case 'color':
						if ( true == $data['output'] ) {
							$style .=
								$selectors. '{'
								.$data['property'].':'.$newvalue.' '.$data['property2'].'}';
						}
						break;

					case 'color_rgb':
						if ( true == $data['output'] ) {
							$get_rgb_color 	= $this->tokoo_hex2RGB( $newvalue );
							$red 			= $get_rgb_color['r'];
							$green 			= $get_rgb_color['g'];
							$blue 			= $get_rgb_color['b'];
							$property2 		= $data['property2'];
							$rgb_color 		= 'rgb('.$red.','.$green.','.$blue.', ' . $property2 . ')';

							$style .=
								$selectors. '{'
								.$data['property'].':'.$rgb_color.'}';
						}
						break;

					case 'images':
						if ( true == $data['output'] ) {
							$style .=  $selectors. '{'
							.$data['property'].':url("'.$newvalue.'") '.' '.$data['property2'].'}';
						}
						break;

					case 'google_font':
						if ( $data['default'] != $newvalue )
							$style .=  $selectors.'{'
							.$data['property'].':'.$newvalue.$data['property2'].'}';
						break;

					case 'text':
						if ( $selectors && ( 'css' == $data['output'] ) && ( $data['default'] != $newvalue ) ) {
							$style .= $selectors.'{'
								.$data['property'].':'.$newvalue.'}';
						}
						break;

					default:
						break;
				}
			}
		}
		if ( $style ) {
			$style = "\n".'<!-- Tokoo New Customizer CSS -->'."\n".'<style type="text/css">'.trim( $style ).'</style>'."\n";
			printf( '%s', $style );
		}
	}

	/**
	 * Enqueue Google Font Base on Customizer Data
	 *
	 * @return void
	 * @author alispx
	 **/
	function tokoo_customizer_font_output() {

		$tokoo_data 	= $this->tokoo_get_customizer_data();

		foreach ( $tokoo_data as $data ) {

			$data = wp_parse_args( $data, self::$default_data );

			$selectors 	= $data['selector'];
			$newvalue	= get_theme_mod( $data['slug'] );

			if ( $data['type'] == 'google_font' ) {
				if ( isset( $newvalue ) && ! empty( $newvalue ) && ( $data['default'] != $newvalue ) ) {
					$get_selected_font = str_replace(' ', '+', $newvalue );
					$subset = isset( $data['subset'] ) ? get_theme_mod( $data['subset'] ) : NULL;
					$subset = !empty( $subset ) ? '&subset=' . $subset : '';
					$theme = wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );
					wp_enqueue_style( $data['slug'], '//fonts.googleapis.com/css?family=' . $get_selected_font . $subset, array(), $theme->Version );
				}
			}
		}
	}

	/**
	 * Convert Hexa to RGB
	 *
	 * @return void
	 * @author alispx
	 **/
	function tokoo_hex2RGB( $hex ) {
		preg_match( "/^#{0,1}([0-9a-f]{1,6})$/i", $hex, $match );

		if ( ! isset( $match[1] ) ) {
			return false;
		}

		if ( strlen( $match[1] ) == 6 ) {
			list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[2] . $hex[3], $hex[4] . $hex[5] );
		} elseif ( strlen( $match[1] ) == 3 ) {
			list( $r, $g, $b ) = array( $hex[0] . $hex[0], $hex[1] . $hex[1], $hex[2] . $hex[2] );
		} else if ( strlen( $match[1] ) == 2 ) {
			list( $r, $g, $b ) = array( $hex[0] . $hex[1], $hex[0] . $hex[1], $hex[0] . $hex[1] );
		} else if ( strlen( $match[1] ) == 1 ) {
			list( $r, $g, $b ) = array( $hex . $hex, $hex . $hex, $hex . $hex );
		} else {
			return false;
		}

		$color 		= array();
		$color['r'] = hexdec( $r );
		$color['g'] = hexdec( $g );
		$color['b'] = hexdec( $b );

		return $color;
	}

}