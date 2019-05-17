<?php

// Create custom widget class extending WPH_Widget
class Tokoo_Instagram_Photo_Grid extends Tokoo_Widget {

	function __construct() {

		$args = array(
			'label' 		=> __( 'Tokoo - Instagram Photo Grid', 'tokoo' ),
			'description' 	=> __( 'A custom widget to display instagram photos in grid display.', 'tokoo' ),
		 );

		// fields array
		$args['fields'] = array(

			// Title field
			array(
				'name' 		=> __( 'Title', 'tokoo' ),
				'desc' 		=> __( 'Enter the widget title.', 'tokoo' ),
				'id' 		=> 'title',
				'type' 		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> __( 'Instagram Photo Grid', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// username
			array(
				'name'		=> __( 'Username', 'tokoo' ),
				'id' 		=> 'username',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			// Number
			array(
				'name'		=> __( 'How many images will be displayed', 'tokoo' ),
				'id' 		=> 'number',
				'type'		=> 'number',
				'class' 	=> 'widefat',
				'std' 		=> 9,
			 ),

			// Target
			array(
				'name' 		=> __( 'Link target', 'tokoo' ),
				'id' 		=> 'target',
				'type'		=> 'select',
				'class' 	=> 'widefat',
				'std' 		=> '',
				'filter'	=> 'esc_attr',
				'fields' 	=> array(
						array(
							'name'  => __( 'Self', 'tokoo' ),
							'value' => '_self'
						 ),
						array(
							'name'  => __( 'Blank', 'tokoo' ),
							'value' => '_blank'
						 ),
				 ),
			 ),

			// Link
			array(
				'name'		=> __( 'Link', 'tokoo' ),
				'id' 		=> 'link',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> '',
			 ),

			// Width
			array(
				'name'		=> __( 'Thumbnail Width', 'tokoo' ),
				'id' 		=> 't_width',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> 80,
			 ),

			// Height
			array(
				'name'		=> __( 'Thumbnail Height', 'tokoo' ),
				'id' 		=> 't_height',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> 80,
			 ),

		 ); // fields array

		$args['options'] 	= array(
				'width'		=> 350,
				'height'	=> 350
			);

		// create widget
		$this->create_widget( $args );

		$this->defaults = array(
			'title'			=> 'Instagram Photo Grid',
			'username'		=> '',
			'number'		=> 9,
			'target'		=> '_self',
			'link'			=> '',
			't_width'		=> 85,
			't_height'		=> 85,
		);

		//Allow themes or plugins to modify default parameters
		$this->defaults = apply_filters( 'tokoo_flickr_widget_modify_defaults', $this->defaults );
	}


	// Output function
	function widget( $args, $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		printf( $before_widget );

		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );

		if ( $instance['username'] != '' ) {

			$media_array = $this->scrape_instagram( $instance['username'], $instance['number'] );

			if ( is_wp_error( $media_array ) ) {

				printf( $media_array->get_error_message() );

			} else {

				// filter for images only?
				if ( $images_only 	= apply_filters( 'tokoo_images_only', FALSE ) )
					$media_array 	= array_filter( $media_array, array( $this, 'images_only' ) );

				// filters for custom classes
				$count 		= 1;
				$liclass 	= esc_attr( apply_filters( 'tokoo_item_class', 'picture-item item-'.$count ) );
				$aclass 	= esc_attr( apply_filters( 'tokoo_a_class', '' ) );
				$imgclass 	= esc_attr( apply_filters( 'tokoo_img_class', '' ) );

				echo '<ul class="koo-photogrid">';
				foreach ( $media_array as $item ) {
					$style = 'width='.$instance['t_width'].' height='.$instance['t_height'];
					echo '<li class="'. $liclass .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $instance['target'] ) .'"  class="'. $aclass .'"><img src="'. esc_url( $item['thumbnail'] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. $imgclass .'" '.$style.' ></a></li>';
				}

				echo '</ul>';
			}
		}

		if ( $instance['link'] != '' ) { ?>
			<p class="clear">
				<a class="instagram-link" href="//instagram.com/<?php echo esc_attr( trim( $instance['username'] ) ); ?>" rel="me" target="<?php echo esc_attr( $instance['target'] ); ?>"><i class="fa fa-instagram"></i><?php echo esc_attr( $instance['link'] ); ?></a>
			</p>
			<?php
		}

		printf( $args['after_widget'] );

	}

	// based on https://gist.github.com/cosmocatalano/4544576
	function scrape_instagram( $username, $slice = 9 ) {

		$username = strtolower( $username );

		if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', __( 'Unable to communicate with Instagram.', 'tokoo' ) );

			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', __( 'Instagram did not return a 200.', 'tokoo' ) );

			$shards 		= explode( 'window._sharedData = ', $remote['body'] );
			$insta_json 	= explode( ';</script>', $shards[1] );
			$insta_array 	= json_decode( $insta_json[0], TRUE );

			if ( ! $insta_array )
				return new WP_Error( 'bad_json', __( 'Instagram has returned invalid data.', 'tokoo' ) );

			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', __( 'Instagram has returned invalid data.', 'tokoo' ) );
			}

			if ( !is_array( $images ) )
				return new WP_Error( 'bad_array', __( 'Instagram has returned invalid data.', 'tokoo' ) );

			$instagram = array();

			switch ( $type ) {
				case 'old':
					foreach ( $images as $image ) {

						if ( $image['user']['username'] == $username ) {

							$image['link']						  	= preg_replace( "/^http:/i", "", $image['link'] );
							$image['images']['thumbnail']		   	= preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
							$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
							$image['images']['low_resolution']	  	= preg_replace( "/^http:/i", "", $image['images']['low_resolution'] );

							$instagram[] = array(
								'description'   => $image['caption']['text'],
								'link'		  	=> $image['link'],
								'time'		  	=> $image['created_time'],
								'comments'	  	=> $image['comments']['count'],
								'likes'		 	=> $image['likes']['count'],
								'thumbnail'	 	=> $image['images']['thumbnail'],
								'large'		 	=> $image['images']['standard_resolution'],
								'small'		 	=> $image['images']['low_resolution'],
								'type'		  	=> $image['type']
							);
						}
					}
				break;
				default:
					foreach ( $images as $image ) {

						$image['display_src'] = preg_replace( "/^http:/i", "", $image['display_src'] );

						if ( $image['is_video']  == true ) {
							$type = 'video';
						} else {
							$type = 'image';
						}

						$instagram[] = array(
							'description'   => __( 'Instagram Image', 'tokoo' ),
							'link'		  	=> '//instagram.com/p/' . $image['code'],
							'time'		  	=> $image['date'],
							'comments'	  	=> $image['comments']['count'],
							'likes'		 	=> $image['likes']['count'],
							'thumbnail'	 	=> $image['display_src'],
							'type'		  	=> $type
						);
					}
				break;
			}

			// do not set an empty transient - should help catch private or empty accounts
			if ( ! empty( $instagram ) ) {
				$instagram = base64_encode( serialize( $instagram ) );
				set_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
			}
		}

		if ( ! empty( $instagram ) ) {

			$instagram = unserialize( base64_decode( $instagram ) );
			return array_slice( $instagram, 0, $slice );

		} else {

			return new WP_Error( 'no_images', __( 'Instagram did not return any images.', 'tokoo' ) );

		}
	}

	function images_only( $media_item ) {

		if ( $media_item['type'] == 'image' )
			return true;

		return false;
	}

} // class
