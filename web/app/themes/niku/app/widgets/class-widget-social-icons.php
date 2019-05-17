<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

class Tokoo_Social_Connect extends WP_Widget {

	/**
	 * Widget setup
	 */
	function __construct() {

		$widget_ops = array(
			'classname' 	=> 'social-network',
			'description' 	=> esc_html__( 'A custom widget to display the social network icons.', 'tokoo' )
		);

		$control_ops = array(
			'width' 	=> 350,
			'height' 	=> 350
		);

		parent::__construct( 'tokoo_social_widget', esc_html__( 'Tokoo - Social Connect', 'tokoo' ), $widget_ops, $control_ops );

	}

	/**
	 * Display widget
	 */
	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		$title 			= apply_filters( 'widget_title', $instance['title'] );
		$type 			= esc_attr( $instance['type'] ) ;
		$size 			= esc_attr( $instance['size']);

		$fb_id         = strip_tags( $instance['fb_id'] );
		$twitter_id    = strip_tags( $instance['twitter_id'] );
		$gplus_id      = strip_tags( $instance['gplus_id'] );
		$linkedin_id   = strip_tags( $instance['linkedin_id'] );
		$spotify_id    = strip_tags( $instance['spotify_id'] );
		$codepen_id    = strip_tags( $instance['codepen_id'] );
		$digg_id       = strip_tags( $instance['digg_id'] );
		$foursquare_id = strip_tags( $instance['foursquare_id'] );
		$github_id     = strip_tags( $instance['github_id'] );
		$reddit_id     = strip_tags( $instance['reddit_id'] );
		$skype_id      = strip_tags( $instance['skype_id'] );
		$behance_id    = strip_tags( $instance['behance_id'] );
		$ytube_id      = strip_tags( $instance['ytube_id'] );
		$steam_id      = strip_tags( $instance['steam_id'] );
		$dribbble_id   = strip_tags( $instance['dribbble_id'] );
		$tumblr_id     = strip_tags( $instance['tumblr_id'] );
		$wordpress_id  = strip_tags( $instance['wordpress_id'] );
		$instagram_id  = strip_tags( $instance['instagram_id'] );
		$pinterest_id  = strip_tags( $instance['pinterest_id'] );
		$flickr_id     = strip_tags( $instance['flickr_id'] );
		$vimeo_id      = strip_tags( $instance['vimeo_id'] );
		$vine_id       = strip_tags( $instance['vine_id'] );
		$deviantart_id = strip_tags( $instance['deviantart_id'] );
		$lastfm_id     = strip_tags( $instance['lastfm_id'] );
		$soundcloud_id = strip_tags( $instance['soundcloud_id'] );

		printf( $before_widget );

		if ( ! empty( $title ) )
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		?>

		<div class="social-links <?php echo esc_attr( $size ) . ' ' . $type; ?>">

			<?php if ( $fb_id ) { ?>
				<a class="facebook" href="<?php echo esc_url( 'http://www.facebook.com/' . $fb_id ); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
			<?php } if ( $twitter_id ) { ?>
				<a class="twitter" href="<?php echo esc_url( 'http://twitter.com/' . $twitter_id ); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
			<?php } if ( $gplus_id ) { ?>
				<a class="google-plus" href="<?php echo esc_url( 'https://plus.google.com/u/' . $gplus_id ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			<?php } if ( $linkedin_id ) { ?>
				<a class="linkedin" href="<?php echo esc_url( 'http://linkedin.com/in/' . $linkedin_id ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
			<?php } if ( $spotify_id ) { ?>
				<a class="spotify" href="<?php echo esc_url( 'http://play.spotify.com/user/' . $spotify_id ); ?>" target="_blank"><i class="fa fa-spotify"></i></a>
			<?php } if ( $codepen_id ) { ?>
				<a class="codepen" href="<?php echo esc_url( 'http://codepen.io/' . $codepen_id ); ?>" target="_blank"><i class="fa fa-codepen"></i></a>
			<?php } if ( $digg_id ) { ?>
				<a class="digg" href="<?php echo esc_url( 'http://digg.com/' . $digg_id ); ?>" target="_blank"><i class="fa fa-digg"></i></a>
			<?php } if ( $foursquare_id ) { ?>
				<a class="foursquare" href="<?php echo esc_url( 'http://foursquare.com/' . $foursquare_id ); ?>" target="_blank"><i class="fa fa-foursquare"></i></a>
			<?php } if ( $github_id ) { ?>
				<a class="github" href="<?php echo esc_url( 'https://github.com/' . $github_id ); ?>" target="_blank"><i class="fa fa-github"></i></a>
			<?php } if ( $reddit_id ) { ?>
				<a class="reddit" href="<?php echo esc_url( 'http://reddit.com/r/' . $reddit_id ); ?>" target="_blank"><i class="fa fa-reddit"></i></a>
			<?php } if ( $skype_id ) { ?>
				<a class="skype" href="<?php echo esc_url( 'skype:' .  $skype_id . '?chat' ); ?>" target="_blank"><i class="fa fa-skype"></i></a>
			<?php } if ( $behance_id ) { ?>
				<a class="behance" href="<?php echo esc_url( 'http://behance.net/' . $behance_id ); ?>" target="_blank"><i class="fa fa-behance"></i></a>
			<?php } if ( $ytube_id ) { ?>
				<a class="youtube" href="<?php echo esc_url( 'http://www.youtube.com/user/' . $ytube_id ); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
			<?php } if ( $steam_id ) { ?>
				<a class="steam" href="<?php echo esc_url( 'http://steamcommunity.com/id/' . $steam_id ); ?>" target="_blank"><i class="fa fa-steam"></i></a>
			<?php } if ( $dribbble_id ) { ?>
				<a class="dribbble" href="<?php echo esc_url( 'http://dribbble.com/' . $dribbble_id ); ?>" target="_blank"><i class="fa fa-dribbble"></i></a>
			<?php } if ( $tumblr_id ) { ?>
				<a class="tumblr" href="<?php echo esc_url( 'http://' . '$tumblr_id' . '.tumblr.com' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a>
			<?php } if ( $wordpress_id ) { ?>
				<a class="wordpress" href="<?php echo esc_url( 'http://profiles.wordpress.org/' . $wordpress_id ); ?>" target="_blank"><i class="fa fa-wordpress"></i></a>
			<?php } if ( $instagram_id ) { ?>
				<a class="instagram" href="<?php echo esc_url( 'http://instagram.com/' . $instagram_id ); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
			<?php } if ( $pinterest_id ) { ?>
				<a class="pinterest" href="<?php echo esc_url( 'http://pinterest.com/' . $pinterest_id ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
			<?php } if ( $flickr_id ) { ?>
				<a class="flickr" href="<?php echo esc_url( 'http://www.flickr.com/photos/' . $flickr_id ); ?>" target="_blank"><i class="fa fa-flickr"></i></a>
			<?php } if ( $vimeo_id ) { ?>
				<a class="vimeo" href="<?php echo esc_url( 'http://vimeo.com/' . $vimeo_id ); ?>" target="_blank"><i class="fa fa-vimeo-square"></i></a>
			<?php } if ( $vine_id ) { ?>
				<a class="vine" href="<?php echo esc_url( 'http://vine.co/' . $vine_id ); ?>" target="_blank"><i class="fa fa-vine"></i></a>
			<?php } if ( $deviantart_id ) { ?>
				<a class="deviantart" href="<?php echo esc_url( 'http://' . $deviantart_id . '.deviantart.com/' ) ; ?>" target="_blank"><i class="fa fa-deviantart"></i></a>
			<?php } if ( $lastfm_id ) { ?>
				<a class="lastfm" href="<?php echo esc_url( 'http://www.last.fm/user/' . $lastfm_id ); ?>" target="_blank"><i class="fa fa-lastfm"></i></a>
			<?php } if ( $soundcloud_id ) { ?>
				<a class="soundcloud" href="<?php echo esc_url( 'https://soundcloud.com/' . $soundcloud_id ); ?>" target="_blank"><i class="fa fa-soundcloud"></i></a>
			<?php } ?>

		</div><!-- .social-links -->

		<?php
		printf( $after_widget );

	}

	/**
	 * Update widget
	 */
	function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['type']          = strip_tags( $new_instance['type'] );
		$instance['size']          = strip_tags( $new_instance['size'] );
		$instance['fb_id']         = strip_tags( $new_instance['fb_id'] );
		$instance['twitter_id']    = strip_tags( $new_instance['twitter_id'] );
		$instance['gplus_id']      = strip_tags( $new_instance['gplus_id'] );
		$instance['linkedin_id']   = strip_tags( $new_instance['linkedin_id'] );
		$instance['spotify_id']    = strip_tags( $new_instance['spotify_id'] );
		$instance['codepen_id']    = strip_tags( $new_instance['codepen_id'] );
		$instance['digg_id']       = strip_tags( $new_instance['digg_id'] );
		$instance['foursquare_id'] = strip_tags( $new_instance['foursquare_id'] );
		$instance['github_id']     = strip_tags( $new_instance['github_id'] );
		$instance['reddit_id']     = strip_tags( $new_instance['reddit_id'] );
		$instance['skype_id']      = strip_tags( $new_instance['skype_id'] );
		$instance['behance_id']    = strip_tags( $new_instance['behance_id'] );
		$instance['ytube_id']      = strip_tags( $new_instance['ytube_id'] );
		$instance['steam_id']      = strip_tags( $new_instance['steam_id'] );
		$instance['dribbble_id']   = strip_tags( $new_instance['dribbble_id'] );
		$instance['tumblr_id']     = strip_tags( $new_instance['tumblr_id'] );
		$instance['wordpress_id']  = strip_tags( $new_instance['wordpress_id'] );
		$instance['instagram_id']  = strip_tags( $new_instance['instagram_id'] );
		$instance['pinterest_id']  = strip_tags( $new_instance['pinterest_id'] );
		$instance['flickr_id']     = strip_tags( $new_instance['flickr_id'] );
		$instance['vimeo_id']      = strip_tags( $new_instance['vimeo_id'] );
		$instance['vine_id']       = strip_tags( $new_instance['vine_id'] );
		$instance['deviantart_id'] = strip_tags( $new_instance['deviantart_id'] );
		$instance['lastfm_id']     = strip_tags( $new_instance['lastfm_id'] );
		$instance['soundcloud_id'] = strip_tags( $new_instance['soundcloud_id'] );

		return $instance;
	}

	/**
	 * Widget setting
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
        $defaults = array(
            'title' 		=> '',
            'type' 			=> 'normal',
            'size' 			=> 'large',
            'fb_id' 		=> '',
            'twitter_id' 	=> '',
            'gplus_id' 		=> '',
            'linkedin_id' 	=> '',
            'spotify_id' 	=> '',
            'codepen_id' 	=> '',
            'digg_id' 		=> '',
            'foursquare_id' => '',
            'github_id' 	=> '',
            'reddit_id' 	=> '',
            'skype_id' 		=> '',
            'behance_id' 	=> '',
            'ytube_id' 		=> '',
            'steam_id' 		=> '',
            'dribbble_id' 	=> '',
            'tumblr_id' 	=> '',
            'wordpress_id' 	=> '',
            'instagram_id' 	=> '',
            'pinterest_id' 	=> '',
            'flickr_id' 	=> '',
            'vimeo_id' 		=> '',
            'vine_id' 		=> '',
            'deviantart_id' => '',
            'lastfm_id' 	=> '',
            'soundcloud_id' => ''
        );

		$instance      = wp_parse_args( (array) $instance, $defaults );
		$title         = strip_tags( $instance['title'] );
		$type          = esc_attr( strip_tags( $instance['type'] ) );
		$size          = esc_attr( strip_tags( $instance['size'] ) );
		$fb_id         = strip_tags( $instance['fb_id'] );
		$twitter_id    = strip_tags( $instance['twitter_id'] );
		$gplus_id      = strip_tags( $instance['gplus_id'] );
		$linkedin_id   = strip_tags( $instance['linkedin_id'] );
		$spotify_id    = strip_tags( $instance['spotify_id'] );
		$codepen_id    = strip_tags( $instance['codepen_id'] );
		$digg_id       = strip_tags( $instance['digg_id'] );
		$foursquare_id = strip_tags( $instance['foursquare_id'] );
		$github_id     = strip_tags( $instance['github_id'] );
		$reddit_id     = strip_tags( $instance['reddit_id'] );
		$skype_id      = strip_tags( $instance['skype_id'] );
		$behance_id    = strip_tags( $instance['behance_id'] );
		$ytube_id      = strip_tags( $instance['ytube_id'] );
		$steam_id      = strip_tags( $instance['steam_id'] );
		$dribbble_id   = strip_tags( $instance['dribbble_id'] );
		$tumblr_id     = strip_tags( $instance['tumblr_id'] );
		$wordpress_id  = strip_tags( $instance['wordpress_id'] );
		$instagram_id  = strip_tags( $instance['instagram_id'] );
		$pinterest_id  = strip_tags( $instance['pinterest_id'] );
		$flickr_id     = strip_tags( $instance['flickr_id'] );
		$vimeo_id      = strip_tags( $instance['vimeo_id'] );
		$vine_id       = strip_tags( $instance['vine_id'] );
		$deviantart_id = strip_tags( $instance['deviantart_id'] );
		$lastfm_id     = strip_tags( $instance['lastfm_id'] );
		$soundcloud_id = strip_tags( $instance['soundcloud_id'] );

	?>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'tokoo' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>

	<div class="widget-controls columns-2">
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Type:', 'tokoo' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>">
				<option value="normal" <?php selected( $type, 'normal' ); ?>><?php esc_html_e( 'Normal', 'tokoo' ); ?></option>
				<option value="boxed" <?php selected( $type, 'boxed' ); ?>><?php esc_html_e( 'Boxed', 'tokoo' ); ?></option>
				<option value="rounded" <?php selected( $type, 'rounded' ); ?>><?php esc_html_e( 'Rounded', 'tokoo' ); ?></option>
			</select>
		</p>
	</div>
	<div class="widget-controls columns-2 column-last">
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Size:', 'tokoo' ); ?></label>
			<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">
				<option value="large" <?php selected( $size, 'large' ); ?>><?php esc_html_e( 'Large', 'tokoo' ); ?></option>
				<option value="medium" <?php selected( $size, 'medium' ); ?>><?php esc_html_e( 'Medium', 'tokoo' ); ?></option>
				<option value="small" <?php selected( $size, 'small' ); ?>><?php esc_html_e( 'Small', 'tokoo' ); ?></option>
			</select>
		</p>
	</div>


	<div class="widget-controls columns-3">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'fb_id' ) ); ?>"><?php esc_html_e( 'Facebook Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'fb_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'fb_id' ) ); ?>" type="text" value="<?php echo esc_attr( $fb_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>"><?php esc_html_e( 'Twitter Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_id' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'gplus_id' ) ); ?>"><?php esc_html_e( 'Google Plus Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'gplus_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'gplus_id' ) ); ?>" type="text" value="<?php echo esc_attr( $gplus_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin_id' ) ); ?>"><?php esc_html_e( 'Linkedin Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin_id' ) ); ?>" type="text" value="<?php echo esc_attr( $linkedin_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'spotify_id' ) ); ?>"><?php esc_html_e( 'Spotify Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'spotify_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'spotify_id' ) ); ?>" type="text" value="<?php echo esc_attr( $spotify_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'codepen_id' ) ); ?>"><?php esc_html_e( 'Codepen Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'codepen_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'codepen_id' ) ); ?>" type="text" value="<?php echo esc_attr( $codepen_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'digg_id' ) ); ?>"><?php esc_html_e( 'Digg Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'digg_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'digg_id' ) ); ?>" type="text" value="<?php echo esc_attr( $digg_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'foursquare_id' ) ); ?>"><?php esc_html_e( 'Foursquare Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'foursquare_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'foursquare_id' ) ); ?>" type="text" value="<?php echo esc_attr( $foursquare_id ); ?>" />
		</p>

	</div>

	<div class="widget-controls columns-3">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'github_id' ) ); ?>"><?php esc_html_e( 'Github Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'github_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'github_id' ) ); ?>" type="text" value="<?php echo esc_attr( $github_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'reddit_id' ) ); ?>"><?php esc_html_e( 'Reddit Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit_id' ) ); ?>" type="text" value="<?php echo esc_attr( $reddit_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'skype_id' ) ); ?>"><?php esc_html_e( 'Skype Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'skype_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'skype_id' ) ); ?>" type="text" value="<?php echo esc_attr( $skype_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'behance_id' ) ); ?>"><?php esc_html_e( 'Behance Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behance_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behance_id' ) ); ?>" type="text" value="<?php echo esc_attr( $behance_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ytube_id' ) ); ?>"><?php esc_html_e( 'Youtube Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ytube_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ytube_id' ) ); ?>" type="text" value="<?php echo esc_attr( $ytube_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'steam_id' ) ); ?>"><?php esc_html_e( 'Steam Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'steam_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'steam_id' ) ); ?>" type="text" value="<?php echo esc_attr( $steam_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'dribbble_id' ) ); ?>"><?php esc_html_e( 'Dribbble Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble_id' ) ); ?>" type="text" value="<?php echo esc_attr( $dribbble_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tumblr_id' ) ); ?>"><?php esc_html_e( 'Tumblr Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tumblr_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tumblr_id' ) ); ?>" type="text" value="<?php echo esc_attr( $tumblr_id ); ?>" />
		</p>

	</div>

	<div class="widget-controls columns-3 column-last">

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'wordpress_id' ) ); ?>"><?php esc_html_e( 'WordPress Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wordpress_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wordpress_id' ) ); ?>" type="text" value="<?php echo esc_attr( $wordpress_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_id' ) ); ?>"><?php esc_html_e( 'Instagram Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_id' ) ); ?>" type="text" value="<?php echo esc_attr( $instagram_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_id' ) ); ?>"><?php esc_html_e( 'Pinterest Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest_id' ) ); ?>" type="text" value="<?php echo esc_attr( $pinterest_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>"><?php esc_html_e( 'Flickr Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'flickr_id' ) ); ?>" type="text" value="<?php echo esc_attr( $flickr_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo_id' ) ); ?>"><?php esc_html_e( 'Vimeo Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo_id' ) ); ?>" type="text" value="<?php echo esc_attr( $vimeo_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'vine_id' ) ); ?>"><?php esc_html_e( 'Vine Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vine_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vine_id' ) ); ?>" type="text" value="<?php echo esc_attr( $vine_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'deviantart_id' ) ); ?>"><?php esc_html_e( 'Deviantart Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'deviantart_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'deviantart_id' ) ); ?>" type="text" value="<?php echo esc_attr( $deviantart_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'lastfm_id' ) ); ?>"><?php esc_html_e( 'Last FM Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'lastfm_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'lastfm_id' ) ); ?>" type="text" value="<?php echo esc_attr( $lastfm_id ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'soundcloud_id' ) ); ?>"><?php esc_html_e( 'Soundcloud Username:', 'tokoo' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'soundcloud_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'soundcloud_id' ) ); ?>" type="text" value="<?php echo esc_attr( $soundcloud_id ); ?>" />
		</p>

	</div>

	<br class="clear" />

	<?php
	}

}

}
