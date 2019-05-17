<div class="configurator-step configurator-step-one active">
  <form id="form-basic-options">
    <div class="row mb-4">
      <div class="col-6 col-sm-4 col-md-4 col-lg-3 mx-auto">
        <label for="persons">Anzahl der Personen (nicht verpflichtend)</label>
        <input type="number" name="persons" value="8" min="1" />
      </div>
    </div>
    <div class="row justify-content-sm-center mb-4 basic-option-row">
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_riesenbrezn.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="type" value="riesenbrezn" data-basic-type="standard" checked />
        <label for="type">Riesen-Partybrezn (6-8 Personen)</label>
      </div>
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_riesenbrezn_xl.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="type" value="riesenbrezn-xl" data-basic-type="xl" />
        <label for="type">Riesen-Partybrezn XL (10-12 Personen)</label>
      </div>
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_formbrezn.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="type" value="formbrezn" data-basic-type="xl" />
        <label for="type">Form-Partybrezn (10-12 Personen)</label>
        <div class="type-dropdown">
          <label for="type-digit">Ziffer (1- oder 2-stellig)</label>
          <input type="text" name="type-digit" value="10" />
        </div>
      </div>
    </div>
    <div class="row justify-content-sm-center mb-4 basic-option-row">
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_semmelteig.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="dough" value="semmelteig" checked />
        <label for="dough">Semmelteig</label>
      </div>
      <div class="col-6 col-sm-4 col-md-4 col-lg-3 mt-4">
          <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_3kornteig.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="dough" value="3-kornteig" />
        <label for="dough">3-Kornteig</label>
      </div>
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
          <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_roggenteig.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="dough" value="roggenteig" />
        <label for="dough">Roggenteig</label>
      </div>
    </div>
    <div class="row justify-content-sm-center mb-4 basic-option-row">
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_riesenbrezn_xl.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="zones" value="gemischt" checked />
        <label for="zones">Belag gemischt</label>
      </div>
      <div class="col-6 col-sm-4 col-lg-3 mt-4">
        <img src="../app/themes/mypartybrezn-child/assets/images/configurator/icon_brezen50x50.png" class="configurator-thumbnail thumbnail-shrinked" />
        <input type="radio" name="zones" value="2-zonen" />
        <label for="zones">Belag in 2 Zonen</label>
      </div>
    </div>

    <?php do_action('get_initial_price'); ?>

    <div class="row justify-content-md-center">
      <p class="configurator-price pt-4 mb-0">
        <span class="woocommerce-Price-amount amount">
          <span class="woocommerce-Price-currencySymbol">€ </span>
          <span class="initial-price"><?php echo $_SESSION['initial_price'] ?></span>
        </span>
      </p>
    </div>
  </form>
</div>
