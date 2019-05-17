<?php

// Create custom widget class extending WPH_Widget
class Tokoo_Recent_Tweets extends Tokoo_Widget {

	function __construct() {
	
		$args = array( 
			'label' 		=> __( 'Tokoo - Recent Tweets', 'tokoo' ), 
			'description' 	=> __( 'A custom widget to display your recent tweets. Work with new Twitter API.', 'tokoo' ), 		
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
				'std' 		=> __( 'Recent Tweets', 'tokoo' ), 
				'validate' 	=> 'alpha_dash', 
				'filter' 	=> 'strip_tags|esc_attr'	
			 ), 
		
			// Screen Name
			array( 
				'name'		=> __( 'Screen Name', 'tokoo' ), 							
				'id' 		=> 'screen_name', 							
				'type'		=> 'text',
				'class' 	=> 'widefat', 
				'std' 		=> '',  				
			 ),

			// Consumer Key
			array( 
				'name'		=> __( 'Consumer Key', 'tokoo' ), 							
				'id' 		=> 'consumer_key', 							
				'type'		=> 'text',
				'class' 	=> 'widefat', 
				'std' 		=> '',  				
			 ),

			// Consumer Secret
			array( 
				'name'		=> __( 'Consumer Secret', 'tokoo' ), 							
				'id' 		=> 'consumer_secret', 							
				'type'		=> 'text',
				'class' 	=> 'widefat', 
				'std' 		=> '',  				
			 ),

			// Number of Tweets
			array( 
				'name'		=> __( 'Number of Tweets', 'tokoo' ), 							
				'id' 		=> 'num_tweets', 							
				'type'		=> 'text',
				'class' 	=> 'widefat', 
				'std' 		=> 5,  				
			 ),

			// Show Avatar Image
			array( 
				'name' 		=> __( 'Show Avatar Image', 'tokoo' ), 							
				'id' 		=> 'show_avatar', 							
				'type'		=> 'checkbox', 				
				'std' 		=> 1, // 0 or 1
				'filter'	=> 'strip_tags|esc_attr', 
			 ),

			// Show Follow
			array( 
				'name' 		=> __( 'Show Follow Button', 'tokoo' ), 							
				'id' 		=> 'show_follow', 							
				'type'		=> 'checkbox', 				
				'std' 		=> 0, // 0 or 1
				'filter'	=> 'strip_tags|esc_attr', 
			 ),
			
		 ); // fields array
		
		$args['options'] 	= array(
				'width'		=> 350, 
				'height'	=> 350
			);
		
		// create widget
		$this->create_widget( $args );
	}
	
	
	// Output function
	function widget( $args, $instance ) {

		extract( $args );
 
		$title 				= apply_filters( 'widget_title', $instance['title'] );
		$screen_name 		= $instance['screen_name'];
		$consumer_key 		= $instance['consumer_key'];
		$consumer_secret 	= $instance['consumer_secret'];
		$num_tweets 		= $instance['num_tweets'];
		$show_avatar 		= $instance['show_avatar'];
		$show_follow 		= $instance['show_follow'];
				
		printf( $args['before_widget'] );
 
		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		
		if ( empty( $instance['consumer_key'] ) || empty( $instance['consumer_secret'] ) || empty( $instance['screen_name'] ) ){
			echo __( 'Please fill all widget settings.', 'tokoo' ) . $after_widget;

			return;
		}

		if ( ! class_exists( 'Wp_Twitter_Api' ) ) { 
			echo __( 'Couldn\'t find the required class.', 'tokoo' ) . $after_widget;

			return;
		}

		$tweets = get_transient( 'tokoo_twitter_widget_cache' );

		if ( $tweets === false || $tweets === '' ) {

			$twitter_api = new Wp_Twitter_Api( array(
					'consumer_key' 		=> $consumer_key,
					'consumer_secret' 	=> $consumer_secret
				) );

			$query = 'count=' . $num_tweets . '&include_entities=true&include_rts=true&screen_name=' . $screen_name;
			$tweets = $twitter_api->query( $query );

			set_transient( 'tokoo_twitter_widget_cache', $tweets, 1800 );
		}

		echo '<ul class="twitter-tweets-list">';

		foreach ( $tweets as $tweet ) {
			$tweet_text 		= $this->linkify_tweet( $tweet->text );
			$tweet_time 		= $this->relative_time( $tweet->created_at );
			$tweet_url 			= 'http://twitter.com/' . $tweet->user->screen_name . '/status/' . $tweet->id_str;
			$screen_name 		= $tweet->user->screen_name;
			$name 				= $tweet->user->name;
			$profile_image_url 	= $tweet->user->profile_image_url;
				
			echo '<li>';
			echo '<div class="tweet">';

			if ( $show_avatar )
				echo '<div class="tweet-avatar"><img src="' . esc_url( $profile_image_url ) . '" width="48" height="48" alt="' . esc_attr( $screen_name ) . '" /></div>';

			echo '<div class="tweet-content">
					<span class="tweet-user"><a href="https://twitter.com/' . esc_attr( $screen_name ). '" target="_blank">@' . esc_attr( $screen_name ) . '</a></span>
					<span class="tweet-text">' . $tweet_text . '</span>
					</div>';
			echo '<small class="timespan"><a href="' . esc_url( $tweet_url ) . '" target="_blank">' . esc_attr( $tweet_time ) . '</a></small>';

			echo '</div>'; // .tweet
			echo '</li>';
		}

		echo '</ul><!-- .twitter-tweets-list -->';

		if ( $show_follow )
			echo '<span class="follow-me">
                    <a href="https://twitter.com/' . esc_attr( $screen_name ) . '" class="twitter-follow-button" data-show-count="false">Follow @' . esc_attr( $screen_name ) . '</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </span>';

		printf( $args['after_widget'] );

	}

	/**
	 * Makes links in a tweet clickable
	 */
	function linkify_tweet( $tweet ){
		// link to url
		$tweet = preg_replace_callback("/((http:\/\/|https:\/\/)[^ )]+)/", array( $this, 'url_callback' ), $tweet );
		// @ to follow
		$tweet = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" target=\"_blank\">$1</a>", $tweet );
		// # to search
		$tweet = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" target=\"_blank\">$1</a>", $tweet );
		return $tweet;
	}

	/**
	 * callback for URL
	 */
	function url_callback( $matches ) {
		$linkMaxLen = 140;
		$url 		= ( strlen( $matches[1])>=$linkMaxLen ) ? substr($matches[1], 0, $linkMaxLen) . '...' : $matches[1];
		return '<a href="' . esc_url( $matches[1] ) . '" title="' . esc_attr( $matches[1] ) . '" target="_blank">' . $url .'</a>';
	}

	/**
	 * Beautiful and translatable relative time
	 */
	function relative_time( $time ) {
		// time difference
		$diff 	= strtotime( 'now' ) - strtotime( $time );
		// the time values
		$minute = 60;
		$hour 	= $minute * 60;
		$day 	= $hour * 24;
		$week 	= $day * 7;
			
		if( is_numeric( $diff ) && $diff > 0 ) {
			// if less than 3 seconds
			if ( $diff < 3 ) return __( 'right now', 'tokoo' );
			// if less than 1 minute
			if ( $diff < $minute ) return floor( $diff ) . __( ' seconds ago', 'tokoo' );
			// if less than 2 minutes
			if ( $diff < $minute * 2 ) return __( 'about 1 minute ago', 'tokoo' );
			// if less than 1 hour
			if ( $diff < $hour ) return floor( $diff / $minute ) . __( ' minutes ago', 'tokoo' );
			// if less than 2 hours
			if ( $diff < $hour * 2 ) return __( 'about 1 hour ago', 'tokoo' );
			// if less than 1 day
			if ( $diff < $day ) return floor( $diff / $hour ) . __( ' hours ago', 'tokoo' );
			// if more then 1 day, but less then 2 days
			if ( $diff > $day && $diff < $day * 2 ) return __( 'yesterday', 'tokoo' );
			// if less than 1 year
			if ( $diff < $day * 365 ) return floor( $diff / $day ) . __( ' days ago', 'tokoo' );
			// else return over a year ago
			return __( 'over a year ago', 'tokoo' );
		}
	}

} // class
