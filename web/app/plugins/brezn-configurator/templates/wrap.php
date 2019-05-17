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
?>

<div class="configurator-wrap">

  <?php include('steps.php'); ?>
  <?php include('headline.php'); ?>

  <div class="shadow-bow-bottom">
    <div class="container">
      <div class="row justify-content-center pt-3 row-configurator-recommendation">
        <div class="col-12 configurator-information">
          <p><b>Hinweis:</b> Bei jeder konfigurierten Brezn ist Salat als Standardzutat vorhanden.</p>
          <p>Bitte wählen Sie im Konfigurator die gewünschten Zutaten, sowie die Menge der Zutaten in Gramm.</p>
        </div>

        <div class="col-4 recommendation-list">
          <!--<p>Empfohlener Mindestbelag:</p>
          <p>Maximalbelag:</p>-->
        </div>
      </div>

      <?php
       /*
        * brezn_configurator choose_location hook
        *
        * calling custom hook to display location snippet of the template
        *
        * @hooked choose_location
        */
      do_action('choose_location');
      ?>

      <div class="configurator-steps">

        <?php include('basic-options.php'); ?>
        <?php include('covering-options.php'); ?>

        <div class="row row-divider pt-1"></div>
        <div class="row mt-4">
          <a href="#" class="mypartybrezn-btn mb-4 configurator-continue">Weiter</a>
        </div>
      </div>
    </div>
  </div>

  <?php include('prefer-standard.php'); ?>

</div>
