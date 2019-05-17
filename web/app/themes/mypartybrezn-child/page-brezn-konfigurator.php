<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package tokoo
 */

do_action('check_store_selection');

get_header(); ?>

	<?php
        /**
         * tokoo_before_main_content hook
         *
         * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
         */
        do_action('tokoo_before_main_content');

                /**
         * initialize_configurator hook
         *
                 * (plugins/brezn-configurator/brezn-configurator.php)
         */
        do_action('initialize_configurator');
  ?>

	<?php
        /**
         * tokoo_after_main_content hook
         *
         * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('tokoo_after_main_content');
     ?>

<?php get_footer(); ?>
