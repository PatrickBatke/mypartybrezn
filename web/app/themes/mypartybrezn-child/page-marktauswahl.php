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

get_header();

/**
 * fetch the available stores
 */
do_action('fetch_stores');

/**
 * get the chosen store
 */
$header = apply_filters('get_store', 10, 3);

/**
 * get the location where the visitor intended to go before choosing the store
 */
$referrer = $_SESSION['referrer'];
?>

<div class="page-header page-header-store" style="background: url(<?php echo $header ?>)"></div>
<div class="container">
	<div class="row">
		<div class="col col-md-8 mx-auto pb-5">
			<div class="text-box">
				<h2 class="step-headline">Region und Filiale</h2>
					<p class="text-information">
					  Bitte wählen Sie den Markt aus. an dem Sie Ihre Partybrezn abholen möchten. Bitte beachten Sie, dass der Abholtermin von der aktuellen Auftragslast des jeweiligen Marktes abhängig ist (wird nach der Produktwahl kalkuliert).
					</p>
				</div>
			</div>
	</div>

	<?php get_template_part('partials/store-overview', 'store-overview'); ?>

	<div class="row mb-5 mt-5">
	  <div class="mx-auto">
	    <a class="mypartybrezn-btn" href="/<?php echo $referrer; ?>/">Weiter zu unseren Brezn</a>
	  </div>
	</div>
</div>

<?php #get_template_part('partials/prefer-self', 'prefer-self');?>

<?php
    /**
     * tokoo_after_main_content hook
     *
     * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('tokoo_after_main_content');
?>

<?php get_footer(); ?>
