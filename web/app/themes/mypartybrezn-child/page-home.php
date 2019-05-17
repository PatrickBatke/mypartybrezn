<?php
/*
 * Template Name: Index
 */

get_header();

?>

	<?php
    /**
      * tokoo_before_main_content hook
      *
      * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
      */
      do_action('tokoo_before_main_content');
    ?>

		<div class="bow-wrap home-wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="text-box">
							<h2 class="step-headline">Riesenbrezn & Riesengebäck</h2>
							<p class="text-information">
								Wählen Sie aus einem unserer Klassiker. Es besteht die Möglichkeit diese in bestimmten Variationen zu bestellen. Bitte übermitteln Sie uns Ihren Auftrag mindestens 48 Stunden vor dem gewünschten Abholtermin. Vielen Dank für Ihr Verständnis. Wir freuen uns auf Ihre Bestellung.
							</p>
						</div>
						<a href="/riesenbrezn-riesengebaeck/">
							<img src="https://mypartybrezn.blob.core.windows.net/mypartybrezn/2019/02/mypartybrezn_gebratenes.jpg" />
						</a>
						<div class="text-center">
							<a class="mypartybrezn-btn" href="/riesenbrezn-riesengebaeck/">Zum Sortiment</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="text-box">
							<h2 class="step-headline">Brezn-Konfigurator</h2>
							<p class="text-information">
								Lassen Sie Ihrer Kreativität freien Lauf. Im Konfigurator können Sie ganz einfach selber belegen. Bitte übermitteln Sie uns Ihren Auftrag mindestens 48 Stunden vor dem gewünschten Abholtermin. Vielen Dank für Ihr Verständnis. Wir freuen uns auf Ihre Bestellung.
							</p>
						</div>
						<a href="/brezn-konfigurator/">
							<img src="https://mypartybrezn.blob.core.windows.net/mypartybrezn/2019/02/mypartybrezn_dreikornteig.jpg" />
						</a>
					  <div class="text-center">
					    <a class="mypartybrezn-btn" href="/brezn-konfigurator/">Zum Belegen</a>
					  </div>
					</div>
				</div>

				<div class="row mt-4 mb-1">
					<div class="col-sm-10 col-md-8 mx-auto">
						<div class="text-box">
							<h2 class="step-headline">Expressbrezn</h2>
							<p class="text-information">
								Die Expressbrezn von MYPARTYBREZN ist nicht nur schnell in der Zubereitung sondern auch sehr lecker. Nach Übermittlung des Auftrages steht die Brezn innerhalb von <b>drei Stunden</b> zur Abholung bereit. Bestellungen vor 14 Uhr können sogar noch am selben Tag abgeholt werden. Das gibt es sonst nirgends. <br/><br/><b>Bitte beachten Sie:</b> Die Expressbrezn ist im Maximarkt Ried erst ab 3.Juni 2019 verfügbar.
							</p>
						</div>
						<a href="/produkt-expressbrezn/">
							<img src="https://mypartybrezn.blob.core.windows.net/mypartybrezn/2019/02/mypartybrezn_express-brezn_messer.jpg" />
						</a>
						<div class="text-center">
							<a class="mypartybrezn-btn" href="/produkt/expressbrezn/">Schnell bestellen</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bow-relative">
			<div class="bow-bg bow-top bow-bottom bow-chalk" style="background: url(https://mypartybrezn.blob.core.windows.net/mypartybrezn/2019/02/bg_chalk_party.jpg); background-size: cover; background-position: center;"></div>
		</div>

		<div class="container">
			<div class="row mb-5 mt-4">
				<div class="col col-md-8 mx-auto">
					<div class="text-box">
						<h2 class="step-headline">Alles Gute für Ihr Fest!</h2>
						<p class="text-information">
							Geburtstage, Hochzeiten, Jubiläen, Faschingsfeste, Einweihungspartys oder einfach nur so: Es gibt viele Anlässe, um Familie, Freunde oder Kollegen einzuladen. Feines Essen und gute Getränke gehören da einfach dazu. Mit den frischen Köstlichkeiten vom Mypartybrezn können Sie Ihre Gäste – und sich selbst – so richtig verwöhnen!
							Bitte übermitteln Sie uns Ihren Auftrag mindestens 48 Stunden vor dem gewünschten Abholtermin. Danke.
						</p>
					</div>
				</div>
			</div>
		</div>

	<?php
        /**
         * tokoo_after_main_content hook
         *
         * @hooked tokoo_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action('tokoo_after_main_content');
     ?>

<?php get_footer(); ?>
