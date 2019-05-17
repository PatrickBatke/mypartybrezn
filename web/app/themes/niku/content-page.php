<?php

/**
 * The Template for displaying content of post format standard
 *
 * @author 		tokoo
 * @version     2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'type-page' ); ?>>

	<div class="entry-overview">
		<?php tokoo_single_post_featured_image( 'blog_thumbnail' ); ?>

		<div class="entry-content">

			<?php if ( has_excerpt() ) : ?>
				<div class="leading"><?php the_excerpt(); ?></div>
			<?php endif; ?>

			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="article-paging">' . '<strong>' . esc_html__( 'Pages:', 'tokoo' ) . '</strong>', 'after' => '</div>' ) ); ?>

			<?php if ( tokoo_get_option( 'comment_form', 1 ) && comments_open() ) comments_template(); // Loads the comments.php template. ?>

		</div> <!-- .entry-content -->
	</div>

</article><!-- .hentry -->



