jQuery(document).ready(function() {
  minAmount = 400;
  maxAmount = 1000;

  maxAmountZone = minAmount;
  minAmountZone = maxAmount;

  jQuery("#form-basic-options")
    .off("change")
    .on("change", function() {
      updateInitialPrice();
    });

  jQuery("input[name=persons]")
    .off("change")
    .on("change", function() {
      var val = jQuery(this).val();
      validateNumber(val);
    });

  jQuery("input[name=type]").on("change", function() {
    if (this.value == "formbrezn") {
      jQuery(".type-dropdown").addClass("in");
    } else {
      jQuery(".type-dropdown").removeClass("in");
    }
  });

  /* validate number for formbrezn type in configurator */
  jQuery("input[name=type-digit]")
    .off("change")
    .on("change", function() {
      var val = jQuery(this).val();
      validateConfiguratorTypeDigit(val);
    });

  jQuery(".configurator-continue")
    .off("click")
    .on("click", function(e) {
      e.preventDefault();

      toggleStep();
    });

  jQuery(".zone-selector")
    .off("click")
    .off("click")
    .on("click", function() {
      toggleZone(this);
    });

  jQuery(".toggle-submenu")
    .off("click")
    .off("click")
    .on("click", function() {
      toggleIngredients(this);
    });

  jQuery("#form-topping-options")
    .off("change")
    .on("change", function(e) {
      saveTopping(e);
    });
});

function validateNumber(val) {
  if (val < 1) {
    jQuery("input[name=persons]").val(1);
  }
}

function validateConfiguratorTypeDigit(val) {
  if (val < 0) {
    jQuery("input[name=type-digit]").val(1);
  }

  if (val > 99) {
    jQuery("input[name=type-digit]").val(99);
  }
}

function toggleStep() {
  if (jQuery(".configurator-step.active").hasClass("configurator-step-one")) {
    validateFirstStep();
  } else {
    var minAmountFlag = verifyMinimalAmount();

    if (minAmountFlag === true) {
      jQuery(".error-text").text("");
      jQuery(".loading-wrap").addClass("in");

      configuratorAddCart();
    } else {
      jQuery(".error-text").text(
        "Bitte wählen Sie einen Mindestbelag von insgesamt " +
          minAmount +
          " Gramm aus."
      );
    }
  }
}

function updateInitialPrice() {
  var type = jQuery("input[name=type]:checked").data("basic-type");

  jQuery.ajax({
    url: variables.ajax_url,
    type: "post",
    data: {
      action: "update_initial_price",
      type: type
    },
    dataType: "json",
    success: function(data) {
      jQuery(".initial-price, .final-price").text(data);
    }
  });
}

function validateFirstStep() {
  jQuery(".loading-wrap").addClass("in");

  var form = jQuery("#form-basic-options").serialize();

  jQuery.ajax({
    url: variables.ajax_url,
    type: "post",
    data: {
      action: "save_basic",
      form: form
    },
    dataType: "json",
    success: function(data) {
      if (data["success"] == true) {
        jQuery.ajax({
          url: variables.ajax_url,
          type: "post",
          data: {
            action: "get_basic"
          },
          dataType: "json",
          success: function(data) {
            prepareSecondStep(data);
          }
        });
      }
    }
  });
}

function prepareSecondStep(values) {
  var persons = values[0];
  var type = values[1];
  var type_digit = values[2];
  var dough = values[3];
  var zones = values[4];

  switch (type) {
    case "riesenbrezn":
      minAmount = 400;
      maxAmount = 1000;
      break;
    case "riesenbrezn-xl":
    case "formbrezn":
      minAmount = 800;
      maxAmount = 1500;
      break;
  }

  var recommendedAmount = persons * 100;

  jQuery(".recommendation-amount").text(recommendedAmount);

  jQuery(".page-header").css(
    "background",
    "url(https://mypartybrezn.blob.core.windows.net/mypartybrezn/2018/12/header_schritt2.jpg"
  );

  if (zones == "gemischt") {
    jQuery(
      '.zone-overlay, .row-zones, [data-zone="ingredients-zone-2"]'
    ).remove();
  } else {
    minAmountZone = minAmount / 2;
    maxAmountZone = maxAmount / 2;
  }

  if (type == "formbrezn") {
    jQuery("[data-zone-wrap]")
      .not("[data-zone-wrap=" + type + "]")
      .remove();
  } else {
    jQuery("[data-zone-wrap]")
      .not("[data-zone-wrap=" + dough + "]")
      .remove();
  }

  jQuery(".loading-wrap").removeClass("in");
  jQuery(".configurator-step-one").removeClass("active");
  jQuery(".configurator-step-two").addClass("active");
  jQuery(".configurator-continue").attr("data-configurator-cart", true);

  jQuery(
    ".stepwizard-row .stepwizard-step:first-child .step-circle"
  ).removeClass("active");
  jQuery(".stepwizard-row .stepwizard-step:nth-child(2) .step-circle").addClass(
    "active"
  );

  jQuery(".row-headline .step-headline-single:first-child").removeClass(
    "active"
  );
  jQuery(".row-headline .step-headline-single:nth-child(2)").addClass("active");

  jQuery("html,body").animate(
    {
      scrollTop: jQuery(".configurator-wrap").offset().top - 100
    },
    "slow"
  );

  jQuery(".configurator-continue").text("Bestellen");

  calculatePrice();
}

function toggleZone(element) {
  jQuery(".zone-selector").removeClass("active");
  var zone = jQuery(element).data("zone-selector");

  jQuery(element).addClass("active");
  jQuery("[data-zone]").removeClass("active");
  jQuery('[data-zone="ingredients-' + zone + '"]').addClass("active");

  jQuery("[data-overlay-zone]").removeClass("active");
  jQuery("[data-overlay-zone]")
    .not("[data-overlay-zone=" + zone + "]")
    .addClass("active");
}

function toggleIngredients(element) {
  var zoneClass = jQuery(element)
    .parents()
    .eq(1)
    .data("zone");
  var elementClass = jQuery(element).attr("class");
  elementClass = "." + elementClass.substring(15) + " + .submenu";

  jQuery("[data-zone = " + zoneClass + "]")
    .find(".submenu")
    .removeClass("active");
  jQuery("[data-zone = " + zoneClass + "]")
    .find(elementClass)
    .addClass("active");

  jQuery(".toggle-submenu").removeClass("submenu-opened");
  jQuery(element).addClass("submenu-opened");
}

function saveTopping(e) {
  var amount = 0;
  var amountZoneOne = 0;
  var amountZoneTwo = 0;

  jQuery(e.target).prop("disabled", true);

  setTimeout(function() {
    jQuery(e.target).prop("disabled", false);
  }, 1000);

  if (jQuery("input[name=zones]:checked").val() == "gemischt") {
    jQuery("#form-topping-options input[type=number]").each(function(i) {
      jQuery(this).attr("max", maxAmount);

      //correct user input if values not matching 100 are entered
      var user_input = parseInt(jQuery(this).val());

      if (user_input % 100 != 0) {
        var difference = 100 - (user_input % 100);
        jQuery(this).val(user_input + difference);
      }

      amount += parseInt(jQuery(this).val());
    });

    if (amount > maxAmount) {
      jQuery(".error-text").text(
        "Der Maximalbelag wurde erreicht. Um eine weitere Zutat zu wählen, reduzieren Sie bitte die Menge der bereits gewählten Zutaten."
      );
      jQuery(e.target).val(e.target.value - 100);
    } else {
      jQuery(".error-text").text("");
    }
  } else {
    jQuery(
      '#form-topping-options [data-zone="ingredients-zone-1"] input[type=number]'
    ).each(function(i) {
      jQuery(this).attr("max", maxAmount);

      //correct user input if values not matching 100 are entered
      var user_input = parseInt(jQuery(this).val());

      if (user_input % 100 != 0) {
        var difference = 100 - (user_input % 100);
        jQuery(this).val(user_input + difference);
      }

      amountZoneOne += parseInt(jQuery(this).val());
    });

    var errorOne = false;
    var errorTwo = false;

    if (amountZoneOne > maxAmountZone) {
      errorOne = true;

      jQuery(e.target).val(e.target.value - 100);
    } else {
      errorOne = false;
    }

    jQuery(
      '#form-topping-options [data-zone="ingredients-zone-2"] input[type=number]'
    ).each(function(i) {
      jQuery(this).attr("max", maxAmount);

      //correct user input if values not matching 100 are entered
      var user_input = parseInt(jQuery(this).val());

      if (user_input % 100 != 0) {
        var difference = 100 - (user_input % 100);
        jQuery(this).val(user_input + difference);
      }

      amountZoneTwo += parseInt(jQuery(this).val());
    });

    if (amountZoneTwo > maxAmountZone) {
      errorTwo = true;

      jQuery(e.target).val(e.target.value - 100);
    } else {
      errorTwo = false;
    }

    if (errorOne == true) {
      jQuery(".error-text").text(
        "Der Maximalbelag für Zone 1 wurde erreicht. Um eine weitere Zutat zu wählen, reduzieren Sie bitte die Menge der bereits gewählten Zutaten."
      );
    } else if (errorTwo == true) {
      jQuery(".error-text").text(
        "Der Maximalbelag für Zone 2 wurde erreicht. Um eine weitere Zutat zu wählen, reduzieren Sie bitte die Menge der bereits gewählten Zutaten."
      );
    } else {
      jQuery(".error-text").text("");
    }
  }

  calculatePrice();
}

function calculatePrice() {
  var zoneOneTopping = [];
  var zoneTwoTopping = [];

  var size = jQuery("input[name=type]:checked").data("basic-type");
  var sizePrice = size == "standard" ? "" : "-secondary";

  var productPrice = 0;

  jQuery("#form-topping-options input")
    .not("#form-topping-options input[type=hidden]")
    .each(function() {
      var inputType = jQuery(this).attr("type");

      var ingredientId = jQuery(this)
        .siblings("[data-id]")
        .data("id");
      var ingredientName = jQuery(this)
        .siblings("label")
        .text();
      var ingredientPrice = jQuery(this)
        .siblings("[data-price" + sizePrice + "]")
        .data("price" + sizePrice);

      var itemPrice = 0;

      var amount = 1;

      var zone = jQuery(this)
        .parents()
        .eq(4)
        .data("zone");

      switch (inputType) {
        case "radio":
          if (jQuery(this).prop("checked") == true) {
            /* split the base ingredient, if two zones are selected */
            var zones = 0;

            jQuery("[data-zone]").each(function() {
              zones++;
            });

            itemPrice = zones == 1 ? ingredientPrice : ingredientPrice / 2;

            if (zone == "ingredients-zone-1") {
              zoneOneTopping.push([ingredientId, amount, ingredientName]);
            } else {
              zoneTwoTopping.push([ingredientId, amount, ingredientName]);
            }
          }

          break;
        case "number":
          var amount = jQuery(this).val() / 100;
          itemPrice = ingredientPrice * amount;

          if (zone == "ingredients-zone-1") {
            zoneOneTopping.push([ingredientId, amount, ingredientName]);
          } else {
            zoneTwoTopping.push([ingredientId, amount, ingredientName]);
          }

          break;
        case "checkbox":
          if (jQuery(this).prop("checked") == true) {
            var zones = 0;

            jQuery("[data-zone]").each(function() {
              zones++;
            });

            itemPrice = zones == 1 ? ingredientPrice : ingredientPrice / 2;

            if (zone == "ingredients-zone-1") {
              zoneOneTopping.push([ingredientId, amount, ingredientName]);
            } else {
              zoneTwoTopping.push([ingredientId, amount, ingredientName]);
            }
          }

          break;
      }

      productPrice += parseFloat(itemPrice);
    });

  var initialPrice = parseFloat(jQuery(".initial-price").text());
  productPrice += initialPrice;

  jQuery(".final-price").text(productPrice.toFixed(2));

  /*
    for (i = 0; i < zoneOneTopping.length; i++) {
        console.log(zoneOneTopping[i][0], zoneOneTopping[i][1], zoneOneTopping[i][2]);
    }*/

  var type = jQuery("input[name=type]:checked").data("basic-type");

  jQuery.ajax({
    url: variables.ajax_url,
    type: "post",
    data: {
      action: "calculate_price",
      type: type,
      zoneOneTopping: zoneOneTopping,
      zoneTwoTopping: zoneTwoTopping
    },
    dataType: "json",
    success: function(data) {
      //console.log(data);
    }
  });
}

function verifyMinimalAmount() {
  var amount = 0;

  jQuery("#form-topping-options input[type=number]").each(function() {
    amount += parseInt(this.value);
  });

  if (amount >= minAmount) {
    return true;
  }

  return false;
}

function configuratorAddCart() {
  var custom_price = jQuery(".final-price").text();

  var form_basic = jQuery("#form-basic-options").serialize();
  var form_topping = jQuery("#form-topping-options").serialize();

  jQuery.ajax({
    url: variables.ajax_url,
    type: "post",
    data: {
      action: "configurator_add_cart",
      custom_price: custom_price,
      form_basic: form_basic,
      form_topping: form_topping
    },
    dataType: "json",
    success: function(data) {
      window.location.href = "/checkout";
    }
  });
}
