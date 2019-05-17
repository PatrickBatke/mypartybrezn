<?php
$ingredients = apply_filters('get_ingredients', 10, 3);
?>

<div class="configurator-step configurator-step-two">
  <form id="form-topping-options">
    <div class="row row-configurator-picture">
      <div class="col-lg-8 mx-auto p-0">
        <div class="zone-wrap" data-zone-wrap="semmelteig">
          <img src="../app/themes/mypartybrezn-child/assets/images/configurator/semmelteig_mypartybrezn.jpg"
            alt="Partybrezn konfigurieren" title="Partybrezn konfigurieren" />
          <div class="zone-overlay">
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/semmelteig_zone1.png"
              class="overlay-zone" data-overlay-zone="zone-1" />
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/semmelteig_zone2.png"
              class="overlay-zone active" data-overlay-zone="zone-2" />
          </div>
        </div>
        <div class="zone-wrap" data-zone-wrap="3-kornteig">
          <img src="../app/themes/mypartybrezn-child/assets/images/configurator/dreikornteig_mypartybrezn.jpg"
            alt="Partybrezn konfigurieren" title="Partybrezn konfigurieren" />
          <div class="zone-overlay">
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/dreikornteig_zone1.png"
              class="overlay-zone" data-overlay-zone="zone-1" />
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/dreikornteig_zone2.png"
              class="overlay-zone overlay-zone-two active" data-overlay-zone="zone-2" />
          </div>
        </div>
        <div class="zone-wrap" data-zone-wrap="roggenteig">
          <img src="../app/themes/mypartybrezn-child/assets/images/configurator/roggenteig_mypartybrezn.jpg"
            alt="Partybrezn konfigurieren" title="Partybrezn konfigurieren" />
          <div class="zone-overlay">
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/roggenteig_zone1.png"
              class="overlay-zone overlay-zone-one" data-overlay-zone="zone-1" />
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/roggenteig_zone2.png"
              class="overlay-zone overlay-zone-two active" data-overlay-zone="zone-2" />
          </div>
        </div>
        <div class="zone-wrap" data-zone-wrap="formbrezn">
          <img src="../app/themes/mypartybrezn-child/assets/images/configurator/formbrezn.jpg"
            alt="Partybrezn konfigurieren" title="Partybrezn konfigurieren" />
          <div class="zone-overlay">
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/formbrezn_zone1.png"
              class="overlay-zone overlay-zone-one" data-overlay-zone="zone-1" />
            <img src="../app/themes/mypartybrezn-child/assets/images/configurator/formbrezn_zone2.png"
              class="overlay-zone overlay-zone-two active" data-overlay-zone="zone-2" />
          </div>
        </div>
      </div>
    </div>
    <div class="row row-zones">
      <div class="col-xs-8 col-sm-6 col-md-4 col-lg-2 mx-auto pb-3">
        <div class="zone-selection">
          <span class="zone-selector active" data-zone-selector="zone-1">Zone 1</span>
          <span class="zone-selector" data-zone-selector="zone-2">Zone 2</span>
        </div>
      </div>
    </div>

    <div class="row row-recommendations">
      <div class="col-xs-10 col-sm-8 mx-auto pb-5">
        <div class="recommendations">
          <p class="text-information">Auf Basis der angegebenen Personenanzahl empfehlen wir einen Belag von mindestens
            <span class="recommendation-amount">800</span> Gramm.</p>
        </div>
      </div>
    </div>

    <?php
    for ($zone = 1; $zone < 3; $zone++) {
        ?>

    <div class="row row-ingredients <?php if ($zone == 1) {
            echo 'active';
        } ?>" data-zone="ingredients-zone-<?php echo $zone ?>">
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_aufstrich.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-aufstrich submenu-opened">Aufstrich</span>
        <div class="submenu submenu-aufstrich active">
          <ul>
            <?php
        foreach ($ingredients['Aufstrich'] as $aufstrich => $value) {
            $checked = ($aufstrich == 0) ? 'checked' : ''; ?>
            <li>
              <input type="radio" name="aufstrich-zone<?php echo $zone ?>" value="<?php echo $value->name ?>"
                <?php echo $checked ?> />
              <label for="aufstrich-<?php echo $value->name . '-zone' . $zone ?>"><?php echo $value->name ?></label>
              <input type="hidden" data-id="<?php echo $value->id ?>" />
              <input type="hidden" data-price="<?php echo $value->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $value->price_secondary ?>" />
            </li>

            <?php
        } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_wurst.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-wurst">Wurst</span>
        <div class="submenu submenu-wurst">
          <ul>
            <?php
            foreach ($ingredients['Wurst'] as $wurst) {
                ?>
            <li>
              <input type="number" step="100" min="0" max="1500"
                name="wurst-<?php echo str_replace(' ', '-', $wurst->name) . '-zone' . $zone ?>" value="0">
              <label for="wurst-<?php echo $wurst->name . '-zone' . $zone ?>"><?php echo $wurst->name ?></label>
              <input type="hidden" data-id="<?php echo $wurst->id ?>" />
              <input type="hidden" data-price="<?php echo $wurst->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $wurst->price_secondary ?>" />
            </li>

            <?php
            } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_rohwurst.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-rohwurst">Rohwurst</span>
        <div class="submenu submenu-rohwurst">
          <ul>
            <?php
            foreach ($ingredients['Rohwurst'] as $rohwurst) {
                ?>
            <li>
              <input type="number" step="100" min="0" max="1500"
                name="rohwurst-<?php echo str_replace(' ', '-', $rohwurst->name) . '-zone' . $zone ?>" value="0">
              <label
                for="rohwurst-<?php echo $rohwurst->name . '-zone' . $zone ?>"><?php echo $rohwurst->name ?></label>
              <input type="hidden" data-id="<?php echo $rohwurst->id ?>" />
              <input type="hidden" data-price="<?php echo $rohwurst->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $rohwurst->price_secondary ?>" />
            </li>

            <?php
            } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_schinken.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-schinken">Schinken</span>
        <div class="submenu submenu-schinken">
          <ul>
            <?php
            foreach ($ingredients['Schinken'] as $schinken) {
                ?>
            <li>
              <input type="number" step="100" min="0" max="1500"
                name="schinken-<?php echo str_replace(' ', '-', $schinken->name) . '-zone' . $zone ?>" value="0">
              <label
                for="schinken-<?php echo $schinken->name . '-zone' . $zone ?>"><?php echo $schinken->name ?></label>
              <input type="hidden" data-id="<?php echo $schinken->id ?>" />
              <input type="hidden" data-price="<?php echo $schinken->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $schinken->price_secondary ?>" />
            </li>

            <?php
            } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_kaese.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-kaese">Käse</span>
        <div class="submenu submenu-kaese">
          <ul>
            <?php
            foreach ($ingredients['Käse'] as $kaese) {
                ?>
            <li>
              <input type="number" step="100" min="0" max="1500"
                name="kaese-<?php echo str_replace(' ', '-', $kaese->name) . '-zone' . $zone ?>" value="0">
              <label for="kaese-<?php echo $kaese->name . '-zone' . $zone ?>"><?php echo $kaese->name ?></label>
              <input type="hidden" data-id="<?php echo $kaese->id ?>" />
              <input type="hidden" data-price="<?php echo $kaese->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $kaese->price_secondary ?>" />
            </li>

            <?php
            } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_gebratenes.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-gebratenes">Gebratenes</span>
        <div class="submenu submenu-gebratenes">
          <ul>
            <?php
            foreach ($ingredients['Gebratenes'] as $gebratenes) {
                ?>
            <li>
              <input type="number" step="100" min="0" max="1500"
                name="gebratenes-<?php echo str_replace(' ', '-', $gebratenes->name) . '-zone' . $zone ?>" value="0">
              <label
                for="gebratenes-<?php echo $gebratenes->name . '-zone' . $zone ?>"><?php echo $gebratenes->name ?></label>
              <input type="hidden" data-id="<?php echo $gebratenes->id ?>" />
              <input type="hidden" data-price="<?php echo $gebratenes->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $gebratenes->price_secondary ?>" />
            </li>

            <?php
            } ?>
          </ul>
        </div>
      </div>
      <div class="col-6 col-sm-4 col-lg-3">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/zutaten_garnierung.jpg"
          class="configurator-thumbnail" />
        <span class="toggle-submenu toggle-garnierung">Garnierung</span>
        <div class="submenu submenu-garnierung">
          <ul>
            <?php
            foreach ($ingredients['Garnierung'] as $garnierung) {
                ?>
            <li>
              <input type="checkbox"
                name="garnierung-<?php echo str_replace(' ', '-', $garnierung->name) . '-zone' . $zone ?>"
                value="<?php echo $garnierung->name ?>" />
              <label
                for="garnierung-<?php echo $garnierung->name . '-zone' . $zone ?>"><?php echo $garnierung->name ?></label>
              <input type="hidden" data-id="<?php echo $garnierung->id ?>" />
              <input type="hidden" data-price="<?php echo $garnierung->price ?>" />
              <input type="hidden" data-price-secondary="<?php echo $garnierung->price_secondary ?>" />
            </li>

            <?php
            } ?>
          </ul>
        </div>
      </div>
    </div>

    <?php
    } ?>

    <div class="row justify-content-md-center">
      <p class="configurator-price pt-4 mb-0">
        <span class="woocommerce-Price-amount amount">
          <span class="woocommerce-Price-currencySymbol">€ </span>
          <span class="final-price"><?php echo $_SESSION['initial_price'] ?></span>
        </span>
      </p>
    </div>
    <div class="row justify-content-md-center pt-4">
      <p class="mb-0">
        <span class="error-text"></span>
      </p>
    </div>
  </form>
</div>