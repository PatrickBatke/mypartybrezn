<?php
/**
 * Custom template tags for this theme.
 * List of useful functions for theme usage and for help theme developer.
 * All functions need to call in the theme template.
 *
 * @package TokooCore
 * @version 1.0
 *
 * @author     Tokooo
 * @copyright  Copyright (c) 2015, Tokoo
 *
 * @license license.txt
 */

/**
 * Site title/logo.
 *
 * @since 1.0
 */
function tokoo_site_title() {

		$logo 		= get_theme_mod( 'tokoo_custom_logo' );
		$logo_dark 	= get_theme_mod( 'tokoo_custom_logo_dark' );

		if ( $logo ) {

			$logotag  = ( is_home() || is_front_page() ) ? 'h1':'div';

				echo '<a class="branding" href="' . esc_url( home_url( '/' ) ) . '" title="' . get_bloginfo( 'name' ) . '" rel="home">' . "\n";
					echo '<' . $logotag . ' class="site-title">' . "\n";
						echo '<img class="logo-light" src="' . esc_url( $logo ) . '" alt="' . get_bloginfo( 'name' ) . '" />' . "\n";
						if ( $logo_dark ) {
							echo '<img class="logo-dark" src="' . esc_url( $logo_dark ) . '" alt="' . get_bloginfo( 'name' ) . '" />' . "\n";
						}
					echo '</' . $logotag . '>' . "\n";
				echo '</a>' . "\n";

		} else {

			// Site Title
			$tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
			echo '<a class="branding" href="' . esc_url( home_url( '/' ) ) . '">';
			echo '<h1 class="site-title">' . get_bloginfo( 'name' ) . '</h1>';
			echo '<small class="site-description">' . get_bloginfo( 'description' ) . '</small>';
			echo '</a>';

		}

}


/**
 * Dynamic footer text.
 *
 * @since 1.0
 */
function tokoo_footer_text() {
	echo '<span class="copy">';

		$footer_default =
			sprintf( wp_kses( __( 'Copyright &copy; %s %s.', 'tokoo' ), array( 'a' => array( 'href' => array(), 'class' => array(), 'title' => array(), 'rel' => array() ), 'span' => array() ) ),
				date( 'Y' ), // [the-year]
				'<a class="site-link" href="' . home_url( '/' ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home"><span>' . get_bloginfo( 'name' ) . '</span></a>' // [site-link]
			);

		$wp_link = '<a class="wp-link" href="http://wordpress.org" title="' . esc_html__( 'State-of-the-art semantic personal publishing platform', 'tokoo' ) . '"><span>' . esc_html__( 'WordPress', 'tokoo' ) . '</span></a>'; // [wp-link]

		$theme = wp_get_theme( get_template() );
		$theme_link = '<a class="theme-link" href="' . esc_url( $theme->get( 'ThemeURI' ) ) . '" title="' . sprintf( __( '%s WordPress Theme', 'tokoo' ), $theme->get( 'Name' ) ) . '" rel="nofollow"><span>' . esc_attr( $theme->get( 'Name' ) ) . '</span></a>'; // [theme-link]

		if ( ! is_child_theme() ) {

			$footer_default .= sprintf( __( ' Powered by %s and %s.', 'tokoo' ), $wp_link, $theme_link );

		} else {

			$child_theme = wp_get_theme();
			$child_theme_link = '<a class="child-link" href="' . esc_url( $child_theme->get( 'ThemeURI' ) ) . '" title="' . sprintf( __( '%s WordPress Theme', 'tokoo' ), $child_theme->get( 'Name' ) ) . '"><span>' . esc_html( $child_theme->get( 'Name' ) ) . '</span></a>'; // [child-link]

			$footer_default .= sprintf( __( ' Powered by %s, %s and %s.', 'tokoo' ), $wp_link, $theme_link, $child_theme_link );

		}

		$footer_credits = get_theme_mod( 'tokoo_footer_content' );

		if ( ! empty( $footer_credits ) ) {
			tokoo_echo( $footer_credits );
		} else {
			tokoo_echo( $footer_default );
		}

	echo '</span>';
}


/**
 * Post format link
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_format_link( $args = array() ) {

	$defaults = array( 'before' => '', 'after' => '' );
	$args = wp_parse_args( $args, $defaults );

	$format = get_post_format();
	$url = ( empty( $format ) ? get_permalink() : get_post_format_link( $format ) );

	return $args['before'] . '<a href="' . esc_url( $url ) . '" class="post-format-link">' . get_post_format_string( $format ) . '</a>' . $args['after'];
}

/**
 * Post author
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_author_link( $args = array() ) {

	global $post;
	$author_id = $post->post_author;
	$post_type = get_post_type();

	if ( post_type_supports( $post_type, 'author' ) ) {

		$defaults = array(
				'before' => '',
				'after'  => ''
			);
		$args = wp_parse_args( $args, $defaults );

		$author = '<a class="url fn n" rel="author" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '" title="' . esc_attr( get_the_author_meta( 'display_name', $author_id ) ) . '"><span class="person-name vcard">' . get_the_author_meta( 'display_name', $author_id ) . '</span></a>';

		return $args['before'] . $author . $args['after'];
	}

	return '';
}

/**
 * Post Author
 */
function tokoo_post_by_author( $args = array() ) {

	if ( true == tokoo_get_option( 'post_author', 1 ) ) :
	?>
	<div class="entry-author"><?php esc_html_e( 'Posted by ', 'tokoo' ); ?><a href="<?php echo esc_url( get_the_author_link() ); ?>"><?php echo get_the_author(); ?></a></div>
	<?php
	endif;
}

/**
 * Post published date
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_published_date( $args = array() ) {

	$defaults = array(
			'before' => '',
			'after' => '',
			'format' => get_option( 'date_format' ),
			'human_time' => '',
			'post_id' => get_the_ID()
		);
	$args = wp_parse_args( $args, $defaults );

	/* If $human_time is passed in, allow for '%s ago' where '%s' is the return value of human_time_diff(). */
	if ( !empty( $args['human_time'] ) )
		$time = sprintf( $args['human_time'], human_time_diff( get_the_time( 'U', $args['post_id'] ), current_time( 'timestamp' ) ) );

	/* Else, just grab the time based on the format. */
	else
		$time = get_the_time( $args['format'], $args['post_id'] );

	$published = '<time class="time" datetime="' . get_the_time( 'Y-m-d\TH:i:sP', $args['post_id'] ) . '" title="' . get_the_time( __( 'l, F jS, Y, g:i a', 'tokoo' ), $args['post_id'] ) . '">' . $time . '</time>';

	return $args['before'] . $published . $args['after'];
}

/**
 * Post Comment Link
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_comment_link( $args = array() ) {

	$comment_option = get_theme_mod( 'tokoo_comment_form', 1 );
	if ( ! isset( $comment_option ) || false == $comment_option	|| ! comments_open() )
		return;

	$comments_link = '';
	$number = doubleval( get_comments_number() );

	$defaults = array(
			'zero'      => esc_html__( 'Leave a response', 'tokoo' ),
			'one'       => __( '%1$s Response', 'tokoo' ),
			'more'      => __( '%1$s Responses', 'tokoo' ),
			'css_class' => 'comments-link',
			'none'      => '',
			'before'    => '',
			'after'     => ''
		);
	$args = wp_parse_args( $args, $defaults );

	if ( 0 == $number && !comments_open() && !pings_open() ) {
		if ( $args['none'] )
			$comments_link = '<span class="' . esc_attr( $args['css_class'] ) . '">' . sprintf( $args['none'], number_format_i18n( $number ) ) . '</span>';
	}
	elseif ( 0 == $number )
		$comments_link = '<a class="' . esc_attr( $args['css_class'] ) . '" href="' . esc_url( get_permalink() ) . '#respond" title="' . sprintf( __( 'Comment on %1$s', 'tokoo' ), the_title_attribute( 'echo=0' ) ) . '"><i class="drip-icon-message"></i>' . sprintf( $args['zero'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 == $number )
		$comments_link = '<a class="' . esc_attr( $args['css_class'] ) . '" href="' . esc_url( get_comments_link() ) . '" title="' . sprintf( __( 'Comment on %1$s', 'tokoo' ), the_title_attribute( 'echo=0' ) ) . '"><i class="drip-icon-message"></i>' . sprintf( $args['one'], number_format_i18n( $number ) ) . '</a>';
	elseif ( 1 < $number )
		$comments_link = '<a class="' . esc_attr( $args['css_class'] ) . '" href="' . esc_url( get_comments_link() ) . '" title="' . sprintf( __( 'Comment on %1$s', 'tokoo' ), the_title_attribute( 'echo=0' ) ) . '"><i class="drip-icon-message"></i>' . sprintf( $args['more'], number_format_i18n( $number ) ) . '</a>';

	if ( $comments_link )
		$comments_link = $args['before'] . $comments_link . $args['after'];

	return $comments_link;
}

/**
 * Post Edit Link
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_edit_link( $args = array() ) {
	$post_type = get_post_type_object( get_post_type() );

	if ( !current_user_can( $post_type->cap->edit_post, get_the_ID() ) )
		return '';

	$defaults = array( 'before' => '', 'after' => '' );
	$args = wp_parse_args( $args, $defaults );

	return $args['before'] . '<span class="edit"><a class="post-edit-link" href="' . esc_url( get_edit_post_link( get_the_ID() ) ) . '" title="' . sprintf( __( 'Edit %1$s', 'tokoo' ), $post_type->labels->singular_name ) . '">' . esc_html__( 'Edit', 'tokoo' ) . '</a></span>' . $args['after'];
}

/**
 * Post Terms
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_terms( $args = array() ) {

	$defaults = array(
			'id'        => get_the_ID(),
			'taxonomy'  => 'post_tag',
			'separator' => ', ',
			'before'    => '',
			'after'     => ''
		);
	$args = wp_parse_args( $args, $defaults );

	$args['before'] = ( empty( $args['before'] ) ? '<span class="' . $args['taxonomy'] . '">' : $args['before'] );
	$args['after'] = ( empty( $args['after'] ) ? '</span>' : $args['after'] );

	return get_the_term_list( $args['id'], $args['taxonomy'], $args['before'], $args['separator'], $args['after'] );
}

/**
 * Post Category
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_category( $args = array() ) {
	$args['taxonomy'] = 'category';
	return tokoo_post_terms( $args );
}

/**
 * Post Tags
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_tags( $args = array() ) {
	$args['taxonomy'] = 'post_tag';
	return tokoo_post_terms( $args );
}

/**
 * Post Meta
 *
 * @since  1.0
 * @author tokoo
 **/
function tokoo_post_meta() {
	?>
	<div class="entry-meta">

		<div class="entry-date entry-meta__item"><?php echo tokoo_published_date(); ?></div>

		<?php tokoo_post_by_author(); ?>

		<?php echo tokoo_post_category( array(
			'before' => '<div class="entry-categories entry-taxonomy"><h3> ' . esc_html__( 'Categories', 'tokoo' ) . '</h3>',
			'after'  => '</div>'
		) ); ?>

	</div><!-- .entry-meta -->
	<?php
}

/**
 * Single Post Meta
 */
function tokoo_single_post_meta() {
	?>
	<div class="entry-meta">

		<div class="entry-date"><?php echo tokoo_published_date(); ?></div>

		<?php tokoo_post_by_author(); ?>

		<?php echo tokoo_post_category( array(
			'before' => '<div class="entry-taxonomy entry-categories"><h3>' . esc_html__( 'Categories', 'tokoo' ) . '</h3>',
			'after'  => '</div>'
		) ); ?>

		<?php echo tokoo_post_tags( array(
			'before' => '<div class="entry-taxonomy entry-tags"><h3>' . esc_html__( 'Tags', 'tokoo' ) . '</h3>',
			'after'  => '</div>'
		) ); ?>

		<?php tokoo_related_post(); ?>

	</div><!-- .entry-meta -->
	<?php
}

/**
 * Featured Image
 *
 * @return void
 * @author tokoo
 **/
function tokoo_single_post_featured_image( $size = 'full', $default = false ) {

	// bounce back if doesn't have featured image nor default image is defined
	if ( ! has_post_thumbnail() && ! $default )
		return;

	echo '<figure class="featured-image">';

	if ( has_post_thumbnail() ) {
		echo get_the_post_thumbnail( get_the_ID(), $size );
	} else if ( $default ) {
		echo '<img src="' . esc_url( $default ) . '" alt="' . esc_html__( 'Placeholder', 'tokoo' ) . '" />';
	}

	echo '</figure>';
}

/**
 * Featured Image in Blog List
 * $featured = false use for You May Also Read (using post-image instead of featured-image)
 */
function tokoo_post_featured_image( $size = 'full' ) {

	// default placeholder
	$featured_image = TOKOO_THEME_ASSETS_URI . '/img/imgo2.jpg';

	if ( has_post_thumbnail() ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size, false );
		if ( $image ) {
			$featured_image = $image[0];
		}
	}
	?>
		<div class="featured-image card-image-bg" data-bg-image="<?php echo esc_url( $featured_image ); ?>"></div>
	<?php

}

/**
 * Add user meta field
 *
 * @return void
 **/
add_filter( 'user_contactmethods', 'tokoo_add_user_meta_field' );
function tokoo_add_user_meta_field( $profile_fields ) {
	// Add new fields
	$profile_fields['facebook'] 	= esc_html__( 'Facebook Username', 'tokoo' );
	$profile_fields['twitter'] 		= esc_html__( 'Twitter Username', 'tokoo' );
	$profile_fields['gplus'] 		= esc_html__( 'Google+ Username', 'tokoo' );
	$profile_fields['pinterest'] 	= esc_html__( 'Pinterest URL', 'tokoo' );
	$profile_fields['linkedin'] 	= esc_html__( 'Linkedin URL', 'tokoo' );
	$profile_fields['instagram'] 	= esc_html__( 'Instagram URL', 'tokoo' );

	return $profile_fields;
}

/**
 * Display post author box on single post.
 *
 */
function tokoo_post_author() {
	global $post;
	$author_id = $post->post_author;
	if ( tokoo_get_option( 'post_author', 1 ) && is_singular( 'post' ) ) { ?>

		<div class="author-box">
			<h3><?php esc_html_e( 'About the Author', 'tokoo' ); ?></h3>

			<div class="post-author">

				<a class="url fn n post-author__image" rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>" title="<?php echo esc_attr( get_the_author_meta( 'display_name', $author_id ) ); ?>">
					<?php echo get_avatar( get_the_author_meta( 'user_email', $author_id ), apply_filters( 'tokoo_author_bio_avatar_size', 60 ) ); ?>
				</a>

				<h3 class="post-author__name">
					<a class="url fn n" rel="author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>" title="<?php echo esc_attr( get_the_author_meta( 'display_name', $author_id ) ); ?>">
						<?php echo get_the_author_meta( 'display_name', $author_id ); ?>
					</a>
				</h3>

				<?php echo wpautop( get_the_author_meta( 'description', get_query_var( 'author' ) ) ); ?>

				<div class="social-links boxed small">
					<?php
						$facebook 	= get_the_author_meta( 'facebook' );
						$twitter 	= get_the_author_meta( 'twitter' );
						$gplus 		= get_the_author_meta( 'gplus' );
						$pinterest 	= get_the_author_meta( 'pinterest' );
						$linkedin 	= get_the_author_meta( 'linkedin' );
						$instagram 	= get_the_author_meta( 'instagram' );
					?>
					<?php if ( $facebook ) : ?>
						<a href="http://facebook.com/<?php echo esc_attr( $facebook ); ?>" class="facebook"><i class="fa fa-facebook"></i></a>
					<?php endif; ?>
					<?php if ( $twitter ) : ?>
						<a href="http://twitter.com/<?php echo esc_attr( $twitter ); ?>" class="twitter"><i class="fa fa-twitter"></i></a>
					<?php endif; ?>
					<?php if ( $gplus ) : ?>
						<a href="http://plus.google.com/<?php echo esc_attr( $gplus ); ?>" class="google-plus"><i class="fa fa-google-plus"></i></a>
					<?php endif; ?>
					<?php if ( $pinterest ) : ?>
						<a href="<?php echo esc_url( $pinterest ); ?>" class="pinterest"><i class="fa fa-pinterest"></i></a>
					<?php endif; ?>
					<?php if ( $linkedin ) : ?>
						<a href="<?php echo esc_url( $linkedin ); ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
					<?php endif; ?>
					<?php if ( $instagram ) : ?>
						<a href="<?php echo esc_url( $instagram ); ?>" class="instagram"><i class="fa fa-instagram"></i></a>
					<?php endif; ?>
				</div><!-- .social-links -->

			</div><!-- .post-author -->
		</div>

	<?php
	}
}

/**
 * Display previous post and next post
 *
 * @return void
 **/
function tokoo_prev_next_post() {
	$previous_post 	= get_previous_post();
	$next_post 		= get_next_post();
	?>
	<div class="post-navigation">
		<?php if ( $previous_post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" class="prev-post">
				<i class="fa fa-angle-left"></i>
				<?php echo esc_attr( $previous_post->post_title ); ?>
			</a>
		<?php endif; ?>
		<?php if ( $next_post ) : ?>
			<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="next-post">
				<i class="fa fa-angle-right"></i>
				<?php echo esc_attr( $next_post->post_title ); ?>
			</a>
		<?php endif; ?>
	</div> <!-- .post-navigation -->
	<?php
}

/**
 * Related post function
 *
 * @return void
 **/
function tokoo_related_post() {

	$include_categories = wp_get_object_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
	$include_tags 		= wp_get_object_terms( get_the_ID(), 'post_tag', array( 'fields' => 'ids' ) );
	$exclude_categories = tokoo_get_option( 'disallow_by_category' );
	$exclude_tags 		= tokoo_get_option( 'disallow_by_tags' );
	$per_page 			= tokoo_get_option( 'related_number', 3 );

	if ( empty( $exclude_categories ) ) {
		$exclude_categories = array();
	}

	if ( empty( $exclude_tags ) ) {
		$exclude_tags = array();
	}

	$args = array(
		'post_type' 		=> 'post',
		'post_status' 		=> 'publish',
		'posts_per_page' 	=> $per_page,
		'order' 			=> 'rand',
		'orderby' 			=> 'date',
		'category__in' 		=> $include_categories,
		'tags__in' 			=> $include_tags,
		'category__not_in'  => $exclude_categories,
		'tags__not_in' 		=> $exclude_tags,
		'post__not_in' 		=> array( get_the_ID() ) );


	$related_items = new WP_Query( $args ); ?>

	<?php if ( $related_items->have_posts() ) : ?>

		<div class="entry-related">

			<h3><?php echo tokoo_get_option( 'related_title', esc_html__( 'Related Posts', 'tokoo' ) ); ?></h3>

			<ul>

			<?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>

				<li>
					<a href="<?php the_permalink(); ?>"><?php tokoo_single_post_featured_image( 'related_thumbnail' ); ?></a>
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php echo wp_trim_words( get_the_content(), 13, '...' ); ?>
				</li>

			<?php endwhile;  ?>
			<?php wp_reset_postdata(); ?>

			</ul>

		</div><!-- .related -->
	<?php endif;

}

/**
 * Related Project function
 *
 * @return void
 **/
function tokoo_related_projects() {

	$include_categories = wp_get_object_terms( get_the_ID(), 'project_categories', array( 'fields' => 'ids' ) );

	$args = array(
			'post_type' 		=> 'tokoo-portfolio',
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 3,
			'order' 			=> 'rand',
			'orderby' 			=> 'date',
			'tax_query' 		=> array(
				array(
					'taxonomy' 	=> 'project_categories',
					'field' 	=> 'id',
					'terms' 	=> $include_categories
				)
			),
			'post__not_in' 		=> array( get_the_ID() ) );


	$related_items = new WP_Query( $args ); ?>

	<?php if ( $related_items->have_posts() ) : ?>

		<div class="related">

			<div class="related-title"><?php echo esc_html__( 'Related Project', 'tokoo' ); ?></div>

			<div class="portfolio-holder card columns-3">

			<?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>

				<article class="portfolio portfolio--small card-item">
					<div class="portfolio-inner card-inner">
						<?php tokoo_post_featured_image(); ?>
						<div class="portfolio__detail">
							<div class="portfolio__data">
								<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<small class="entry-category"><?php tokoo_portfolio_get_categories(); ?></small>
							</div>
						</div>
					</div>
				</article>

			<?php endwhile;  ?>
			<?php wp_reset_postdata(); ?>

			</div>

		</div><!-- .related -->

	<?php endif;
}

/**
 * Tokoo Custom Share Post
 *
 * @since  1.0
 **/
function tokoo_custom_social_share() {

	// bounce back on WooCommerce page
	if ( class_exists( 'WooCommerce' ) && tokoo_is_woocommerce_pages() )
		return;

	if ( true == tokoo_get_option( 'social_share', 1 ) ) :
	?>
	<div class="entry-share social-share-holder" data-url="<?php echo esc_url( get_permalink() ); ?>" data-title="<?php echo get_the_title(); ?>">
	</div>
	<?php
	endif;
}

/**
 * Wrapper Start
 *
 * @return void
 * @since  1.0
 * @author tokoo
 **/
add_action( 'tokoo_before_main_content', 'tokoo_wrapper_start', 10 );
function tokoo_wrapper_start() {
	get_template_part( 'wrapper', 'start' );
}

/**
 * Wrapper End
 *
 * @return void
 * @since  1.0
 * @author tokoo
 **/
add_action( 'tokoo_after_main_content', 'tokoo_wrapper_end', 10 );
function tokoo_wrapper_end() {
	get_template_part( 'wrapper', 'end' );
}

/**
 * Loop Meta
 *
 * @return void
 * @since  1.0
 * @author tokoo
 **/
add_action( 'tokoo_before_main_content', 'tokoo_loop_meta', 20 );
function tokoo_loop_meta() {
	// get_template_part( 'loop', 'meta' );
}

/**
 * Blog Above Nav
 * Tag Browser + Pagination
 *
 * @return void
 * @since  1.0
 * @author tokoo
 **/
function tokoo_loop_nav_above() {

	// only show in Blog Index
	if ( ! is_home() )
		return;
	?>

	<div class="posts-navigation">
		<?php tokoo_tag_browser(); ?>

		<div class="pagination pull-right">
			<?php get_template_part( 'loop', 'nav' ); ?>
		</div> <!-- .pagination -->
	</div> <!-- .post-navigation -->

	<?php
}

/**
 * Browse by Tags
 */
function tokoo_tag_browser( $tag = 'post_tag' ) {
	$tags = get_terms( $tag );
	?>
	<?php if ( $tags ) : ?>
		<div class="browse-bytag pull-left">

			<strong><?php esc_html_e( 'Browse by Tag:', 'tokoo' ); ?></strong>

			<?php if ( 5 >= count( $tags ) ) : ?>

				<?php foreach ( $tags as $tag ) : ?>
					<a href="<?php echo get_term_link( $tag ); ?>"><?php echo esc_attr( $tag->name ) . ' (' . $tag->count . ')'; ?></a>
				<?php endforeach; ?>

			<?php else : ?>

				<!-- If the existing tags has more than 5 use select intead -->
				<select name="post_bytag_select" class="post-bytag-select" id="post_bytag_select">
					<option value=""><?php esc_html_e( 'Select Tag', 'tokoo' ); ?></option>
					<?php foreach ( $tags as $tag ) : ?>
						<option value="<?php echo get_term_link( $tag ); ?>"><?php echo esc_attr( $tag->name ) . ' (' . $tag->count . ')'; ?></option>
					<?php endforeach; ?>
				</select>

			<?php endif; ?>

		</div> <!-- .browse-bytag -->
	<?php endif;
}

/**
 * Filter post count
 */
add_filter( 'wp_list_categories', 'tokoo_cat_count_span' );
function tokoo_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a> <span>(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return $links;
}

/**
 * Portfolio item classes
 *
 * @return void
 * @author tokoo
 **/
function tokoo_portfolio_item_classes() {
	$meta 			= get_post_meta( get_the_ID(), '_project_images_class', true );
	$categories 	= get_the_terms( get_the_ID(), 'project_categories' );
	$classes 		= '';
	$classes 		.= ! empty( $meta['masonry_class'] ) ? $meta['masonry_class'] . ' ' : 'small ';

	if ( $categories ) {
		foreach ( $categories as $class ) {
			$classes .= ' '. esc_attr( $class->slug );
		}
	}

	printf( $classes );
}

/**
 * Exclude Pages in Search
 *
 * @return void
 * @author tokoo
 **/
add_filter( 'pre_get_posts', 'tokokoo_search_filter' );
function tokokoo_search_filter( $query ) {
	if ( $query->is_search ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			$query->set( 'post_type', 'post' );
		} else {
			$query->set( 'post_type', 'product' );
		}
	}

	return $query;
}

/**
 * Add Class to next and prev link
 */
add_filter( 'previous_posts_link_attributes' , 'tokoo_posts_link_attributes_prev' );
function tokoo_posts_link_attributes_prev() {
	return 'class="prev"';
}

add_filter( 'next_posts_link_attributes' , 'tokoo_posts_link_attributes_next' );
function tokoo_posts_link_attributes_next() {
	return 'class="next"';
}
