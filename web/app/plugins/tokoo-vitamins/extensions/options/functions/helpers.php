<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Add framework element
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_add_element' ) ) {
	function cs_add_element( $field = array(), $value = '', $unique = '' ) {

		$output     = '';
		$depend     = '';
		$sub        = ( isset( $field['sub'] ) ) ? 'sub-': '';
		$unique     = ( isset( $unique ) ) ? $unique : '';
		$languages  = cs_language_defaults();
		$class      = 'CSFramework_Option_' . $field['type'];
		$wrap_class = ( isset( $field['wrap_class'] ) ) ? ' ' . $field['wrap_class'] : '';
		$hidden     = ( isset( $field['show_only_language'] ) && ( $field['show_only_language'] != $languages['current'] ) ) ? ' hidden' : '';
		$is_pseudo  = ( isset( $field['pseudo'] ) ) ? ' cs-pseudo-field' : '';

		if ( isset( $field['dependency'] ) ) {
			$hidden  = ' hidden';
			$depend .= ' data-'. $sub .'controller="'. $field['dependency'][0] .'"';
			$depend .= ' data-'. $sub .'condition="'. $field['dependency'][1] .'"';
			$depend .= " data-". $sub ."value='". $field['dependency'][2] ."'";
		}

		$output .= '<div class="cs-element cs-field-'. $field['type'] . $is_pseudo . $wrap_class . $hidden .'"'. $depend .'>';

		if( isset( $field['title'] ) ) {
			$field_desc = ( isset( $field['desc'] ) ) ? '<p class="cs-text-desc">'. $field['desc'] .'</p>' : '';
			$output .= '<div class="cs-title"><h4>' . $field['title'] . '</h4>'. $field_desc .'</div>';
		}

		$output .= ( isset( $field['title'] ) ) ? '<div class="cs-fieldset">' : '';

		$value   = ( !isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
		$value   = ( isset( $field['value'] ) ) ? $field['value'] : $value;

		if( class_exists( $class ) ) {
			ob_start();
			$element = new $class( $field, $value, $unique );
			$element->output();
			$output .= ob_get_clean();
		} else {
			$output .= '<p>'. __( 'This field class is not available!', 'tokoo-vitamins' ) .'</p>';
		}

		$output .= ( isset( $field['title'] ) ) ? '</div>' : '';
		$output .= '<div class="clear"></div>';
		$output .= '</div>';

		return $output;

	}
}

/**
 *
 * Encode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_encode_string' ) ) {
	function cs_encode_string( $string ) {
		return rtrim( strtr( call_user_func( 'base'. '64' .'_encode', addslashes( gzcompress( serialize( $string ), 9 ) ) ), '+/', '-_' ), '=' );
	}
}

/**
 *
 * Decode string for backup options
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_decode_string' ) ) {
	function cs_decode_string( $string ) {
		return unserialize( gzuncompress( stripslashes( call_user_func( 'base'. '64' .'_decode', rtrim( strtr( $string, '-_', '+/' ), '=' ) ) ) ) );
	}
}

/**
 *
 * Array search key & value
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_array_search' ) ) {
	function cs_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[$key] ) && $array[$key] == $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, cs_array_search( $sub_array, $key, $value ) );
			}

		}

		return $results;

	}
}

/**
 *
 * Load options fields
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_load_option_fields' ) ) {
	function cs_load_option_fields() {

		$located_fields = array();

		foreach ( glob( CS_OPTION_DIR .'fields/*/*.php' ) as $cs_field ) {
			$located_fields[] = basename( $cs_field );
			require_once $cs_field;
		}

		$override_dir = get_template_directory() .'/cs-framework-override/fields';

		if( is_dir( $override_dir ) ) {

			foreach ( glob( $override_dir .'/*/*.php' ) as $override_field ) {

				if( ! in_array( basename( $override_field ), $located_fields ) ) {

					cs_locate_template( str_replace(  CS_OPTION_DIR .'-override', '', $override_field ) );

				}

			}

		}

		do_action( 'cs_load_option_fields' );

	}
}

/**
 *
 * WP Filesystem helper
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_filesystem' ) ) {
	function cs_filesystem() {

		global $wp_filesystem;

		if ( ! function_exists( 'WP_Filesystem' ) ) {
			include_once ABSPATH .'wp-admin/includes/file.php';
		}

		if ( ! is_object( $wp_filesystem ) ) {
			WP_Filesystem();
		}

		return $wp_filesystem;

	}
}

/**
 *
 * WPML plugin is activated
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'is_wpml_activated' ) ) {
	function is_wpml_activated() {
		if ( class_exists( 'SitePress' ) ) { return true; } else { return false; }
	}
}

/**
 *
 * qTranslate plugin is activated
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'is_qtranslate_activated' ) ) {
	function is_qtranslate_activated() {
		if ( function_exists( 'qtrans_getSortedLanguages' ) ) { return true; } else { return false; }
	}
}

/**
 *
 * Polylang plugin is activated
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'is_polylang_activated' ) ) {
	function is_polylang_activated() {
		if ( function_exists( 'pll_current_language' ) ) { return true; } else { return false; }
	}
}

/**
 *
 * Get language defaults
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'cs_language_defaults' ) ) {
	function cs_language_defaults() {

		$multilang = array();

		if( is_wpml_activated() || is_qtranslate_activated() || is_polylang_activated() ) {

			if( is_wpml_activated() ) {

				global $sitepress;
				$multilang['default']   = $sitepress->get_default_language();
				$multilang['current']   = $sitepress->get_current_language();
				$multilang['languages'] = $sitepress->get_active_languages();

			} else if( is_polylang_activated() ) {

				global $polylang;
				$current    = pll_current_language();
				$default    = pll_default_language();
				$current    = ( empty( $current ) ) ? $default : $current;
				$poly_langs = $polylang->model->get_languages_list();
				$languages  = array();

				foreach ( $poly_langs as $p_lang ) {
					$languages[$p_lang->slug] = $p_lang->slug;
				}

				$multilang['default']   = $default;
				$multilang['current']   = $current;
				$multilang['languages'] = $languages;

			} else if( is_qtranslate_activated() ) {

				global $q_config;
				$multilang['default']   = $q_config['default_language'];
				$multilang['current']   = $q_config['language'];
				$multilang['languages'] = array_flip( qtrans_getSortedLanguages() );

			}

		}

		$multilang = apply_filters( 'cs_language_defaults', $multilang );

		return ( ! empty( $multilang ) ) ? $multilang : false;

	}
}