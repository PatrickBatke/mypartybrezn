<?php

/**
 * The Template for displaying content of post format image
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $tokoo_blog_display_type;
?>

<?php if ( is_singular( get_post_type() ) ) { ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="inner-post">

			<?php tokoo_single_post_featured_image( 'blog_thumbnail' ); ?>

			<div class="entry-meta">
				<?php echo tokoo_post_category( array(
						'before' => '<span class="categories">',
						'after'  => '</span>'
					) ); ?>

				<?php echo sprintf( wp_kses( __( '<span class="author"><a href="%1$s">%2$s</a></span> / ', 'tokoo' ), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array() ) ) ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_attr( get_the_author() ) ); ?>

				<span class="date"><?php echo tokoo_published_date(); ?></span>
			</div>

			<div class="entry-details">

				<div class="entry-content">

					<?php if ( has_excerpt() ) : ?>
						<div class="leading"><?php the_excerpt(); ?></div>
					<?php endif; ?>

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="article-paging">' . '<strong>' . esc_html__( 'Pages:', 'tokoo' ) . '</strong>', 'after' => '</div>' ) ); ?>

				</div> <!-- .entry-content -->

				<?php echo tokoo_post_tags( array(
						'before' => '<div class="entry-tags"><strong>'. esc_html__( 'Tags', 'tokoo' ).'</strong><span>',
						'after'  => '</span></div>'
					) ); ?>
				<div class="share-post"><strong><?php echo esc_html( 'Share', 'tokoo' ); ?></strong><?php tokoo_custom_social_share(); ?></div>
				<?php tokoo_post_author(); ?>
				<?php tokoo_related_post(); ?>
				<?php tokoo_prev_next_post(); ?>

			</div><!-- .entry-details -->

			<?php if ( tokoo_get_option( 'comment_form', 1 ) && comments_open() ) comments_template(); // Loads the comments.php template. ?>

		</div> <!-- .inner-post -->

	</div>

<?php } else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="inner-post">

			<?php if ( $tokoo_blog_display_type == 'masonry' ) : ?>

				<?php tokoo_single_post_featured_image( 'blog_thumbnail' ); ?>

				<div class="entry-meta">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<span class="date"><?php echo tokoo_published_date(); ?></span>
				</div>

				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="article-paging">' . '<strong>' . esc_html__( 'Pages:', 'tokoo' ) . '</strong>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-details -->

				<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'tokoo' ); ?></a>

			<?php else : ?>

				<div class="featured-image">
					<?php tokoo_single_post_featured_image( 'blog_thumbnail' ); ?>
				</div>

				<div class="entry-meta">
					<?php echo tokoo_post_category( array(
							'before' => '<span class="categories">',
							'after'  => '</span>'
						) ); ?>

					<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<?php echo sprintf( wp_kses( __( '<span class="author"><a href="%1$s">%2$s</a></span> / ', 'tokoo' ), array( 'span' => array( 'class' => array() ), 'a' => array( 'href' => array() ) ) ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_attr( get_the_author() ) ); ?>

					<span class="date"><?php echo tokoo_published_date(); ?></span>
				</div>

				<div class="entry-excerpt">
					<?php the_excerpt(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="article-paging">' . '<strong>' . esc_html__( 'Pages:', 'tokoo' ) . '</strong>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-details -->

				<div class="entry-action">
					<?php tokoo_custom_social_share(); ?>

					<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'tokoo' ); ?></a>
				</div>

			<?php endif; ?>

		</div><!-- .inner-post -->
	</article><!-- .hentry -->

<?php } ?>