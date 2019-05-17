<?php

if ( class_exists( 'Tokoo_Widget' ) ) {

/*-----------------------------------------------------------------------------------*/

/*	credit : https://wordpress.org/plugins/meks-themeforest-smart-widget/
/*-----------------------------------------------------------------------------------*/

class Tokoo_ThemeForest_Item extends WP_Widget {

	var $tf_cats;
	 //ThemeForest items categories
	var $exclude;
	 //Wheter to exclude items or not
	var $defaults;

	function __construct() {

		$widget_ops = array(
			'classname' 	=> 'tokoo-themeforest-item',
			'description' 	=> esc_html__( 'Display ThemeForest items with this widget', 'tokoo' )
		);

		$control_ops = array(
			'width' 	=> 350,
			'height' 	=> 350
		);

		parent::__construct( 'Tokoo_ThemeForest_Item', esc_html__( 'Tokoo - Themeforest Item', 'tokoo' ), $widget_ops, $control_ops );

		$this->tf_cats = array(
			array( 'name' => 'wordpress', 			'title' => 'WordPress' ),
			array( 'name' => 'site-templates', 		'title' => 'Site Templates' ),
			array( 'name' => 'psd-templates', 		'title' => 'PSD Templates' ),
			array( 'name' => 'cms-themes', 			'title' => 'CMS Themes' ),
			array( 'name' => 'ecommerce', 			'title' => 'eCommerce' ),
			array( 'name' => 'blogging', 			'title' => 'Blogging' ),
			array( 'name' => 'marketing', 			'title' => 'Marketing' ),
			array( 'name' => 'forums', 				'title' => 'Forums' ),
			array( 'name' => 'muse-templates', 		'title' => 'Muse Templates' ),
			array( 'name' => 'typeengine-themes', 	'title' => 'TypeEngine Themes' )
		);

		$this->exclude = array();

		$this->defaults = array(
			'title' 		=> 'ThemeForest',
			'description' 	=> '',
			'items_type' 	=> array( 'wordpress' ),
			'items_from' 	=> 'user',
			'user' 			=> 'tokokoo',
			'num_items' 	=> 9,
			'orderby' 		=> 'uploaded_on',
			'ref' 			=> 'meks',
			'more_link_url' => 'http://themeforest.net/user/tokomoo/portfolio?ref=tokomoo',
			'more_link_txt' => esc_html__( 'View more', 'tokoo' ),
			'order' 		=> 'desc',
			'target' 		=> '_blank',
			'exclude' 		=> ''
		);

		//Allow themes or plugins to modify default parameters
		$this->defaults = apply_filters( 'tokoo_tf_widget_modify_defaults', $this->defaults );
	}

	function widget( $args, $instance ) {

		extract( $args );
		$instance 	= wp_parse_args( (array)$instance, $this->defaults );
		$title 		= apply_filters( 'widget_title', $instance['title'] );

		printf( $before_widget );

		if ( ! empty( $title ) ) {
			printf( '%s %s %s', $args['before_title'], $title, $args['after_title'] );
		}

		if ( ! empty( $instance['description'] ) ) : ?>
			<p><?php
			echo nl2br( $instance['description'] ); ?></p>
		<?php
		endif;

		if ( isset( $instance['exclude'] ) && ! empty( $instance['exclude'] ) ) {
			$this->exclude = explode( ',', $instance['exclude'] );
			$this->exclude = array_map( 'absint', $this->exclude );
		}

		$items = array();
		switch ( $instance['items_from'] ) {
			case 'popular':
				$items = $this->get_popular_items( $instance['items_type'] );
				break;

			case 'latest':
				$items = $this->get_latest_items( $instance['items_type'] );
				break;

			default:
				if ( ! empty( $instance['user'] ) ) {
					$users = array_map( 'trim', explode( ',', $instance['user'] ) );
					$items = $this->get_items_from_users( $users, $instance['items_type'] );
				}
				break;
		}

		if ( ! empty( $items ) ):
			$this->orderby 		= $instance['orderby'];
			$this->items_order 	= $instance['order'];
			if ( $this->orderby != 'random' ) {
				usort( $items, array( $this, "cmp" ) );
			} else {
				shuffle( $items );
			}

			$items 	= array_slice( $items, 0, absint( $instance['num_items'] ) );
			$ref 	= ! empty( $instance['ref'] ) ? '?ref=' . $instance['ref'] : '';
			$target = ! empty( $instance['target'] ) ? $instance['target'] : '_blank';
		?>
			<ul class="tokoo_themeforest_widget_ul">
				<?php
				foreach ( $items as $item ) : ?>
					<li><a href="<?php
					echo esc_url( $item['url'] . $ref ); ?>" title="<?php
					echo esc_attr( $item['item'] ); ?>" target="<?php
					echo esc_attr( $target ); ?>"><img src="<?php
					echo esc_url( $item['thumbnail'] ); ?>" alt="<?php
					echo esc_attr( $item['item'] ); ?> "/></a></li>
				<?php endforeach; ?>
			 </ul>
		<?php
			if ( ! empty( $instance['more_link_url'] ) ) :
				$more_text = isset( $instance['more_link_txt'] ) && ! empty( $instance['more_link_txt'] ) ? $instance['more_link_txt'] : esc_html__( 'View more', 'tokoo' ); ?>
		  <p class="tokoo_read_more"><a href="<?php
				echo esc_url( $instance['more_link_url'] ); ?>" target="_blank" class="more"><?php
				echo esc_html( $more_text ); ?></a></p>
		<?php endif; ?>
		<?php endif; ?>

		<?php
		printf( $after_widget );
	}

	function update( $new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description'] = strip_tags($new_instance['description']);
		$instance['user'] = strip_tags($new_instance['user']);
		$instance['num_items'] = absint($new_instance['num_items']);
		$instance['exclude'] = strip_tags($new_instance['exclude']);
		$instance['ref'] = strip_tags($new_instance['ref']);
		$instance['orderby'] = strip_tags($new_instance['orderby']);
		$instance['more_link_url'] = $new_instance['more_link_url'];
		$instance['more_link_txt'] = $new_instance['more_link_txt'];
		$instance['order'] = $new_instance['order'];
		$instance['items_type'] = $new_instance['items_type'];
		$instance['items_from'] = $new_instance['items_from'];
		$instance['target'] = $new_instance['target'];
		return $instance;
	}

	function form($instance) {

		$instance = wp_parse_args((array)$instance, $this->defaults); ?>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php
		esc_html_e( 'Title', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'title' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php
		echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php
		esc_html_e( 'Description', 'tokoo' ); ?>:</label>
			<textarea id="<?php
		echo esc_attr( $this->get_field_id( 'description' ) ); ?>" rows="5" name="<?php
		echo esc_attr( $this->get_field_name( 'description' ) ); ?>" class="widefat"><?php
		echo esc_attr( $instance['description'] ); ?></textarea>
		</p>

		<p>
			<label"><?php
		esc_html_e( 'Item categories to show', 'tokoo' ); ?>:</label><br/>
			<?php
		foreach ($this->tf_cats as $cat): ?>
				<input id="<?php
			echo esc_attr( $this->get_field_id( $cat['name'] ) . '_id' ); ?>" type="checkbox" name="<?php
			echo esc_attr( $this->get_field_name( 'items_type' ) ); ?>[]" value="<?php
			echo esc_attr( $cat['name'] ); ?>" <?php
			echo in_array( $cat['name'], $instance['items_type'] ) ? 'checked' : ''; ?> /> <label for="<?php
			echo esc_attr( $this->get_field_id( $cat['name'] . '_id' ) ); ?>"><?php
			echo esc_attr( $cat['title'] ); ?></label><br/>
		<?php
		endforeach; ?>
	  </p>

	  <p>
			<label"><?php
		esc_html_e( 'Select items from', 'tokoo' ); ?>:</label><br/>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'select_from_popular' ) ); ?>" type="radio" name="<?php
		echo esc_attr( $this->get_field_name( 'items_from' ) ); ?>" value="popular" <?php
		checked( $instance['items_from'], 'popular' ); ?> /> <label for="<?php
		echo esc_attr( $this->get_field_id( 'select_from_popular' ) ); ?>"><?php
		esc_html_e( 'Popular Items (WordPress Only)', 'tokoo' ); ?></label><br/>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'select_from_latest' ) ); ?>" type="radio" name="<?php
		echo esc_attr( $this->get_field_name( 'items_from' ) ); ?>" value="latest" <?php
		checked($instance['items_from'], 'latest' ); ?> /> <label for="<?php
		echo esc_attr( $this->get_field_id( 'select_from_latest' ) ); ?>"><?php
		esc_html_e( 'Latest Items', 'tokoo' ); ?></label><br/>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'select_from_user' ) ); ?>" type="radio" name="<?php
		echo esc_attr( $this->get_field_name( 'items_from' ) ); ?>" value="user" <?php
		checked($instance['items_from'], 'user' ); ?> /> <label for="<?php
		echo esc_attr( $this->get_field_id( 'select_from_user' ) ); ?>"><?php
		esc_html_e( 'Specific User(s)', 'tokoo' ); ?></label>
	  </p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'user' ) ); ?>"><?php
		esc_html_e( 'ThemeForest username(s)', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'user' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'user' ) ); ?>" value="<?php
		echo strip_tags( $instance['user'] ); ?>" class="widefat" />
		  <small class="howto"><?php
		esc_html_e( 'For multiple users, separate by comma: i.e. user1,user2,user3', 'tokoo' ); ?></small>
		</p>


		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'num_items' ) ); ?>"><?php
		esc_html_e( 'Number of items to show', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'num_items' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'num_items' ) ); ?>" value="<?php
		echo absint( $instance['num_items'] ); ?>" class="widefat" />
		</p>

		<p>
			<label><?php
		esc_html_e( 'Order by', 'tokoo' ); ?>:</label>
				<select id="<?php
		echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php
		echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" value="<?php
		echo esc_attr($instance['orderby']); ?>" class="widefat" >
					<option value="uploaded_on" <?php
		selected( $instance['orderby'], 'uploaded_on' ); ?>><?php
		esc_html_e( 'Upload date', 'tokoo' ); ?></option>
					<option value="last_update" <?php
		selected($instance['orderby'], 'last_update' ); ?>><?php
		esc_html_e( 'Last update', 'tokoo' ); ?></option>
					<option value="sales" <?php
		selected( $instance['orderby'], 'sales' ); ?>><?php
		esc_html_e( 'Number of sales', 'tokoo' ); ?></option>
					<option value="cost" <?php
		selected( $instance['orderby'], 'cost' ); ?>><?php
		esc_html_e( 'Price', 'tokoo' ); ?></option>
					<option value="random" <?php
		selected( $instance['orderby'], 'random' ); ?>><?php
		esc_html_e( 'Random', 'tokoo' ); ?></option>
			</select>
		</p>

		<p>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'order_asc' ) ); ?>" type="radio" name="<?php
		echo esc_attr( $this->get_field_name( 'order' ) ); ?>" value="asc" <?php
		checked( $instance['order'], 'asc' ); ?> /> <label for="<?php
		echo esc_attr( $this->get_field_id( 'order_asc' ) ); ?>"><?php
		esc_html_e( 'Ascending', 'tokoo' ); ?></label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'order_desc' ) ); ?>" type="radio" name="<?php
		echo esc_attr( $this->get_field_name( 'order' ) ); ?>" value="desc" <?php
		checked( $instance['order'], 'desc' ); ?> /> <label for="<?php
		echo esc_attr( $this->get_field_id( 'order_desc' ) ); ?>"><?php
		esc_html_e( 'Descending', 'tokoo' ); ?></label>
		</p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php
		esc_html_e( 'Exclude item(s)', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" value="<?php
		echo strip_tags($instance['exclude']); ?>" class="widefat" />
		  <small class="howto"><?php
		esc_html_e( 'Specify item ID to exclude specific item (separate by comma for multiple items): i.e. 8134834,7184572', 'tokoo' ); ?></small>
		</p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'ref' ) ); ?>"><?php
		esc_html_e( 'Referral user', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'ref' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'ref' ) ); ?>" value="<?php
		echo strip_tags( $instance['ref'] ); ?>" class="widefat" />
			<small class="howto"><?php
		esc_html_e( 'Specify username if you want to use items as ThemeForest affiliate links', 'tokoo' ); ?></small>
		</p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'more_link_url' ) ); ?>"><?php
		esc_html_e( 'More link URL', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'more_link_url' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'more_link_url' ) ); ?>" value="<?php
		echo esc_attr($instance['more_link_url']); ?>" class="widefat" />
			<small class="howto"><?php
		esc_html_e( 'Specify URL if you want to show "more" link under the items list', 'tokoo' ); ?></small>
		</p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'more_link_txt' ) ); ?>"><?php
		esc_html_e( 'More link text', 'tokoo' ); ?>:</label>
			<input id="<?php
		echo esc_attr( $this->get_field_id( 'more_link_txt' ) ); ?>" type="text" name="<?php
		echo esc_attr( $this->get_field_name( 'more_link_txt' ) ); ?>" value="<?php
		echo esc_attr($instance['more_link_txt']); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php
		echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php
		esc_html_e( 'Open items in', 'tokoo' ); ?>: </label>
			<select id="<?php
		echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php
		echo esc_attr( $this->get_field_name( 'target' ) ); ?>">
				<option value="_blank" <?php selected( '_blank', $instance['target'] ); ?>><?php
		esc_html_e( 'New Window', 'tokoo' ); ?></option>
				<option value="_self" <?php selected( '_self', $instance['target'] ); ?>><?php
		esc_html_e( 'Same Window', 'tokoo' ); ?></option>
			</select>
		</p>

	<?php
	}

	function get_items_from_users( $users = array( 'tokoko' ), $type = array( 'wordpress' ) ) {

		$items = array();

		foreach ( $users as $user ) {
			$cached = get_transient( $this->id_base . '_' . $user );
			if ( empty( $cached ) ) {

				$api_url 	= 'http://marketplace.envato.com/api/v3/new-files-from-user:' . $user . ',themeforest.json';
				$response 	= wp_remote_get( $api_url );

				if ( is_wp_error( $response ) || ( wp_remote_retrieve_response_code( $response ) != 200 ) ) {
					continue;
				}

				$item_data = json_decode( wp_remote_retrieve_body( $response ), true );

				if ( isset( $item_data['new-files-from-user'] ) && ! empty( $item_data['new-files-from-user'] ) ) {
					$item_data_ready = $item_data['new-files-from-user'];

					//Cache data for one day
					set_transient( $this->id_base . '_' . $user, $item_data_ready, 86400 );
				} else {
					$item_data_ready = array();
				}
			} else {
				$item_data_ready = $cached;
			}

			$type_check = count( $type ) == count( $this->tf_cats ) ? false : true;

			foreach ( $item_data_ready as $item ) {
				if ( ! in_array( $item['id'], $this->exclude ) ) {
					if ( $type_check ) {
						if ( $this->item_type_check( trim( $item['category'] ), $type ) ) {
							$items[] = $item;
						}
					} else {
						$items[] = $item;
					}
				}
			}
		}

		return $items;
	}

	function get_popular_items( $type = array( 'wordpress' ) ) {

		$type = array( 'wordpress' );
		 //Hardcoded to WordPres only, due to current ThemeForest API limitations

		$items 		= array();
		$cached  	= get_transient( $this->id_base . '_popular' );
		if ( empty( $cached ) ) {
			$api_url 	= 'http://marketplace.envato.com/api/v3/popular:themeforest.json';
			$response 	= wp_remote_get( $api_url );

			if ( ! is_wp_error( $response ) || ( wp_remote_retrieve_response_code( $response ) == 200 ) ) {
				return;
			}

			$item_data = json_decode( wp_remote_retrieve_body( $response ), true );

			//print_r($item_data);
			if ( isset( $item_data['popular']['items_last_week']) && ! empty( $item_data['popular']['items_last_week'])) {
				$item_data_ready = $item_data['popular']['items_last_week'];

				//Cache data for one day
				set_transient( $this->id_base . '_popular', $item_data_ready, 86400 );
			} else {
				$item_data_ready = array();
			}
		} else {
			$item_data_ready = $cached;
		}

		$type_check = count( $type ) == count( $this->tf_cats ) ? false : true;

		foreach ( $item_data_ready as $item ) {
			if ( ! in_array( $item['id'], $this->exclude ) ) {
				if ( $type_check ) {
					if ($this->item_type_check(trim($item['category']), $type)) {
						$items[] = $item;
					}
				} else {
					$items[] = $item;
				}
			}
		}

		return $items;
	}

	function get_latest_items( $types = array( 'wordpress' ) ) {

		$items = array();

		foreach ( $types as $type ) {
			$cached = get_transient( $this->id_base . '_' . $type );
			if ( empty( $cached ) ) {

				$api_url = 'http://marketplace.envato.com/api/v3/new-files:themeforest,' . $type . '.json';

				$response = wp_remote_get( $api_url );

				if ( is_wp_error($response) || ( wp_remote_retrieve_response_code($response) != 200 ) ) {
					continue;
				}

				$item_data = json_decode( wp_remote_retrieve_body( $response ), true );
				if ( isset( $item_data['new-files'] ) && ! empty( $item_data['new-files'] ) ) {
					$item_data_ready = $item_data['new-files'];

					//Cache data for one day
					set_transient( $this->id_base . '_' . $type, $item_data_ready, 86400 );
				} else {
					$item_data_ready = array();
				}
			} else {
				$item_data_ready = $cached;
			}

			foreach ( $item_data_ready as $item ) {
				if ( ! in_array($item['id'], $this->exclude ) ) {
					$items[] = $item;
				}
			}
		}

		return $items;
	}

	function item_type_check( $category, $types ) {

		foreach ( $types as $type ) {
			if ( strpos( 'tokoo' . $category, $type ) ) {
				return true;
			}
		}

		return false;
	}

	function cmp( $a, $b ) {
		if ( $this->orderby == 'last_update' || $this->orderby == 'uploaded_on' ) {
			if ( $this->items_order == 'desc' ) {
				return strcmp( strtotime( $b[$this->orderby] ), strtotime( $a[$this->orderby] ) );
			} else {
				return strcmp( strtotime( $a[$this->orderby] ), strtotime( $b[$this->orderby] ) );
			}
		} else {
			if ( $this->items_order == 'desc' ) {
				return $b[$this->orderby] > $a[$this->orderby] ? true : false;
			} else {
				return $b[$this->orderby] > $a[$this->orderby] ? false : true;
			}
		}
	}
}

}

