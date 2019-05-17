<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package tokoo
 */

get_header();?>

	<?php
        /**
         * tokoo_before_main_content hook
         *
         * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
         */
        #do_action('tokoo_before_main_content');
     ?>

	<?php get_template_part('content', '404'); ?>

	<?php
        /**
         * tokoo_after_main_content hook
         *
         * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('tokoo_after_main_content');
     ?>

<?php get_footer(); ?>
