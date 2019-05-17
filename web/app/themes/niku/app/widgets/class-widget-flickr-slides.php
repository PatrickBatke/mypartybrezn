<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

/*-----------------------------------------------------------------------------------*/
/*	Flicker Gallery
/*-----------------------------------------------------------------------------------*/

class Tokoo_Flickr_Photo_Slides extends Tokoo_Widget {

	var $defaults;

	function __construct() {

		$args = array(
			'label' 		=> esc_html__( 'Tokoo - Flickr Photo Slides', 'tokoo' ),
			'description' 	=> esc_html__( 'A custom widget to display the flickr photo in slide display.', 'tokoo' ),
		 );

		// fields array
		$args['fields'] = array(

			// Title field
			array(
				'name' 		=> esc_html__( 'Title', 'tokoo' ),
				'desc' 		=> esc_html__( 'Enter the widget title.', 'tokoo' ),
				'id' 		=> 'title',
				'type' 		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> esc_html__( 'Flickr Photo Slides', 'tokoo' ),
				'validate' 	=> 'alpha_dash',
				'filter' 	=> 'strip_tags|esc_attr'
			 ),

			// Width
			array(
				'name'		=> esc_html__( 'Flickr ID', 'tokoo' ),
				'desc'		=> 'Check your ID here http://idgettr.com',
				'id' 		=> 'id',
				'type'		=> 'text',
				'class' 	=> 'widefat',
			 ),

			// Width
			array(
				'name'		=> esc_html__( 'How many photos will be displayed', 'tokoo' ),
				'id' 		=> 'count',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> 6,
			 ),

			// Width
			array(
				'name'		=> esc_html__( 'Thumbnail Width', 'tokoo' ),
				'id' 		=> 't_width',
				'type'		=> 'text',
				'class' 	=> 'widefat',
				'std' 		=> 80,
			 ),

			// Width
			array(
				'name'		=> esc_html__( 'Thumbnail Height', 'tokoo' ),
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
			'title'			=> 'Flickr Photo Slides',
			'id'			=> '',
			'count'			=> 9,
			't_width'		=> 85,
			't_height'		=> 85,
		);

		//Allow themes or plugins to modify default parameters
		$this->defaults = apply_filters( 'tokoo_flickr_widget_modify_defaults', $this->defaults );
	}


	function widget( $args, $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		printf( $before_widget );

		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );

		echo '<div class="koo-image-slider flickr-slide">';

		$ul_class = 'slides';

		$photos = $this->get_photos( $instance['id'], $instance['count'] );
		$count 	= 1;
		if ( ! empty( $photos ) ) {
			$style = 'width="'.$instance['t_width'].'" height="'.$instance['t_height'].'"';
			echo '<ul class="'.$ul_class.'">';
			foreach ( $photos as $photo ) {
				echo '<li><a href="'.esc_url( $photo['img_url'] ).' title="'.$photo['title'].'" target="_blank"><img class="lazyload" src="'.$photo['img_src'].'" data-src="'.$photo['img_src'].'" alt="'.esc_attr( $photo['title'] ).'" '.$style.' draggable="false" style="opacity: 1;"/></a></li>';
			$count++; }
			echo '</ul>';

		}

		echo '</div>';

		printf( $after_widget );
	}


	function get_photos( $id, $count = 8 ) {

		if ( empty( $id ) )
			return false;

		$transient_key 	= md5( 'tokoo_flickr_slides_cache_' . $id . $count );
		$cached 		= get_transient( $transient_key );
		if ( !empty( $cached ) ) {
			return $cached;
		}

		$output = array();
		$rss 	= 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$id.'&lang=en-us&format=rss_200';
		$rss 	= fetch_feed( $rss );

		if ( is_wp_error( $rss ) ) {
			//check for group feed
			$rss = 'http://api.flickr.com/services/feeds/groups_pool.gne?id='.$id.'&lang=en-us&format=rss_200';
			$rss = fetch_feed( $rss );
		}

		if ( ! is_wp_error( $rss ) ) {
			$maxitems 	= $rss->get_item_quantity( $count );
			$rss_items 	= $rss->get_items( 0, $maxitems );
			foreach ( $rss_items as $item ) {
				$temp 				= array();
				$temp['img_url'] 	= esc_url( $item->get_permalink() );
				$temp['title'] 		= esc_html( $item->get_title() );
				$content 			= $item->get_content();
				preg_match_all( "/<IMG.+?SRC=[\"']([^\"']+)/si", $content, $sub, PREG_SET_ORDER );
				$photo_url 			= str_replace( "_m.jpg", ".jpg", $sub[0][1] );
				$temp['img_src'] 	= esc_url( $photo_url );
				$output[] 			= $temp;
			}

			set_transient( $transient_key, $output, 60 * 60 * 24 );
		}


		return $output;
	}

}

}
