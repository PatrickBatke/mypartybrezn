<?php 

/**
 * All of custom functions
 *
 * @return void
 * @author alispx
 **/
 
if ( ! function_exists( 'tokoo_scrape_instagram' ) ) {

	function tokoo_scrape_instagram( $username, $slice = 9 ) {

		$username = strtolower( $username );

		if ( false === ( $instagram = get_transient( 'instagram-media-new-'.sanitize_title_with_dashes( $username ) ) ) ) {

			$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

			if ( is_wp_error( $remote ) )
				return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'festiven' ) );

			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
				return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'festiven' ) );

			$shards 		= explode( 'window._sharedData = ', $remote['body'] );
			$insta_json 	= explode( ';</script>', $shards[1] );
			$insta_array 	= json_decode( $insta_json[0], TRUE );

			if ( ! $insta_array )
				return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'festiven' ) );

			// old style
			if ( isset( $insta_array['entry_data']['UserProfile'][0]['userMedia'] ) ) {
				$images = $insta_array['entry_data']['UserProfile'][0]['userMedia'];
				$type = 'old';
			// new style
			} else if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
				$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
				$type = 'new';
			} else {
				return new WP_Error( 'bad_josn_2', esc_html__( 'Instagram has returned invalid data.', 'festiven' ) );
			}

			if ( !is_array( $images ) )
				return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'festiven' ) );

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
							'description'   => esc_html__( 'Instagram Image', 'festiven' ),
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

			return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'festiven' ) );

		}
	}
	
}
