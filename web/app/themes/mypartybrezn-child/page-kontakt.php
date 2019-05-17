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
?>

	<?php
    /**
      * tokoo_before_main_content hook
      *
      * @hooked tokoo_wrapper_start - 10 (outputs opening divs for the content)
      */
      do_action('tokoo_before_main_content');
    ?>

		<div class="bow-wrap">
			<div class="container">

				<div class="row">
					<div class="col col-md-8 mx-auto">
						<div class="text-box">
							<h2 class="step-headline">Kontakt</h2>
							<p class="text-information">
								MYPARTYBREZN gibt es 7 mal in Österreich. Sie finden uns in jedem Maximarkt. Wir freuen uns auf Ihren Besuch oder von Ihnen zu hören.
							</p>
						</div>
					</div>
				</div>

				<?php global $stores; ?>

				<div class="row pt-5 pb-5 store-contact-wrapper">

				<?php foreach ($stores as $store) {
        ?>
				    <div class="col-9 col-sm-6 col-lg-3 store-contact-item">
				      <h3><?php echo $store->store ?></h3>
				      <p>
				        Maximarkt <?php echo $store->store ?><br />
				        <?php echo $store->street ?><br />
				        A-<?php echo $store->zip . ' ' . $store->place ?><br />
								<?php echo $store->tel ?>
								<br /><br/>
								<b>Öffnungszeiten:</b><br/>
								Mo-Fr: <?php echo $store->opening_weekdays . ' - ' . $store->closing_weekdays ?><br />
								Sa: <?php echo $store->opening_saturday . ' - ' . $store->closing_saturday ?><br />
				      </p>
				      <input type="hidden" name="store-id" value="<?php echo $store->id ?>" />
				    </div>
				<?php
    } ?>

				</div>

				<div class="row">
					<div class="col-md-6 mx-auto">
						<?php echo do_shortcode('[ninja_form id=1]'); ?>
					</div>
				</div>

			</div>

			<div class="bow-relative">
				<div id="map" class="bow-top" style="width: 100%; height: 800px;"></div>

				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADdOs7NFiMVLLCKskDWQWOf7Upc3r1q34&callback=initMap" async defer></script>

				<script type="text/javascript">
					var locations = [
						['Maximarkt Linz/Wegscheid', 48.2429087, 14.2747446, 1],
						['Maximarkt Vöcklabruck', 48.0014951, 13.6465537, 1],
						['Maximarkt Haid', 48.1956124, 14.2446853, 1],
						['Maximarkt Anif', 47.736709, 13.0657568, 5],
						['Maximarkt Wels', 48.1454018, 13.9690956, 2],
						['Maximarkt Bruck a.d. Glocknerstraße', 47.2874898, 12.8092379, 3],
						['Maximarkt Ried', 48.2183458, 13.4913983, 4]
					];

					var map;

					function initMap() {
						map = new google.maps.Map(document.getElementById('map'), {
							zoom: 9,
							center: new google.maps.LatLng(47.9877562,13.6471631),
							mapTypeId: google.maps.MapTypeId.ROADMAP
						});

						var infowindow = new google.maps.InfoWindow();

						var marker, i;

						for (i = 0; i < locations.length; i++) {
							marker = new google.maps.Marker({
								position: new google.maps.LatLng(locations[i][1], locations[i][2]),
								map: map
							});

							google.maps.event.addListener(marker, 'click', (function(marker, i) {
								return function() {
									infowindow.setContent(locations[i][0]);
									infowindow.open(map, marker);
								}
							})(marker, i));
						}
					}


					/*
					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 10,
						center: new google.maps.LatLng(-33.92, 151.25),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});*/
/*
					var infowindow = new google.maps.InfoWindow();

					var marker, i;

					for (i = 0; i < locations.length; i++) {
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map
						});

						google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
								infowindow.setContent(locations[i][0]);
								infowindow.open(map, marker);
							}
						})(marker, i));
					}*/
				</script>

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
