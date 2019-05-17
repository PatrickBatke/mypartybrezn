<?php

/**
 * Core Loaders
 *
 * @return void
 * @author kreativ
 **/
class Tokoo_Autoloaders {
	
	private $customizer_data;
	private $functions_data;
	private $helpers_data;
	private $images_data;
	private $menus_data;
	private $metaboxes_data;
	private $options_data;
	private $widget_data;
	private $widgets_files;
	private $support_data;

	public function __construct() {
		$this->customizer_data 	= TOKOO_THEME_APP_DIR . '/customizer';
		$this->functions_data 	= TOKOO_THEME_APP_DIR . '/functions';
		$this->widgets_files 	= TOKOO_THEME_APP_DIR . '/widgets';
		$this->metaboxes_data 	= TOKOO_THEME_APP_DIR . '/metabox';
		$this->options_data 	= TOKOO_THEME_APP_DIR . '/options';
		$this->libraries_data 	= get_template_directory() . '/bootstrap/library';
		$this->helpers_data 	= get_template_directory() . '/bootstrap/helpers';
		$this->images_date 		= include( TOKOO_THEME_APP_DIR . '/config/images-config.php' );
		$this->menus_data 		= include( TOKOO_THEME_APP_DIR . '/config/menus-config.php' );
		$this->widget_data 		= include( TOKOO_THEME_APP_DIR . '/config/widgets-config.php' );
		$this->support_data 	= include( TOKOO_THEME_APP_DIR . '/config/supports-config.php' );

		$this->directory_loader( $this->libraries_data );
		$this->directory_loader( $this->helpers_data );
		$this->directory_loader( $this->customizer_data );
		$this->directory_loader( $this->functions_data );
		$this->directory_loader( $this->metaboxes_data );
		$this->directory_loader( $this->options_data );
		$this->directory_loader( $this->widgets_files );
		$this->supports_loader( $this->support_data );
		$this->widgets_loader();
		$this->images_loader();
		
		add_action( 'init', array( $this, 'menus_loader' ) );
		add_filter( 'image_size_names_choose', array( $this, 'add_image_to_dropdown_list' ) );
	}

	/**
	 * Loader for files inside directory
	 *
	 * @return void
	 * @author multipress
	 **/
	public function directory_loader( $path ) {
		if ( is_dir( $path ) ) {
			$dir = new \DirectoryIterator( $path );

			foreach ( $dir as $file ) {
				if ( ! $file->isDot() || ! $file->isDir() ) {
					$file_extension = pathinfo( $file->getFilename(), PATHINFO_EXTENSION );

					if ( $file_extension === 'php' ) {
						$this->names[] = $file->getBasename( '.php' );
						require_once $file->getPath().DIRECTORY_SEPARATOR.$file->getBasename();
					}
				}
			}

			return true;
		}

		return false;
	}

	/**
	 * Loader for menus
	 *
	 * @return void
	 * @author multipress
	 **/
	public function menus_loader() {
		if ( is_array( $this->menus_data ) && ! empty( $this->menus_data ) ) {
			$locations = array();

			foreach ( $this->menus_data as $slug => $desc ) {
				$locations[$slug] = $desc;
			}

			register_nav_menus( $locations );
		}

	}

	/**
	 * Loader for supports
	 *
	 * @return void
	 * @author multipress
	 **/
	public function supports_loader( $data ) {

		if ( is_array( $this->support_data ) && ! empty( $this->support_data ) ) {
			foreach ( $this->support_data as $feature => $value ) {
				// Allow theme features without options.
				if ( is_int( $feature ) ) {
					add_theme_support( $value );
				} else {
					// Theme features with options.
					add_theme_support( $feature, $value );
				}
			}
		}

	}

	/**
	 * Loader for widgets
	 *
	 * @return void
	 * @author multipress
	 **/
	public function widgets_loader() {

		if ( is_array( $this->widget_data ) && ! empty( $this->widget_data ) ) {
			foreach ( $this->widget_data as $widget ) {
				if ( class_exists( $widget ) ) {
					register_widget( $widget );
				}
			}
		}

	}

	/**
	 * Loader for images size
	 *
	 * @return void
	 * @author multipress
	 **/
	public function images_loader() {
		if ( ! empty( $this->images_date ) ) {
			foreach ( $this->images_date as $slug => $properties ) {
				list( $width, $height, $crop ) = $properties;
				add_image_size( $slug, $width, $height, $crop );
			}
		}
	}

	/**
	 * Add image size to the list
	 *
	 * @return void
	 * @author multipress
	 **/
	public function add_image_to_dropdown_list( array $sizes ) {
		$new = array();

		if ( ! empty( $this->images_date ) ) {
			foreach ( $this->images_date as $slug => $properties ) {
				// If no 4th option, stop the loop.
				if ( 4 !== count( $properties ) ) break;

				$show = array_pop( $properties );

				if ( $show ) {
					$new[$slug] = $this->label( $slug );
				}
			}
		}

		return array_merge( $sizes, $new );
	}

	/**
	 * Labels
	 *
	 * @return void
	 * @author multipress
	 **/
	public function label( $text ) {
		return ucwords( str_replace( array( '-', '_' ), ' ', $text ) );
	}
	
}