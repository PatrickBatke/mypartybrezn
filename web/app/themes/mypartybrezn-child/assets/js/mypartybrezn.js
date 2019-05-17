jQuery(document).ready(function() {
    jQuery(window).on('scroll', function(e) {
        if (jQuery('.sticky-header').length > 0) {
            jQuery('.sticky-header').removeClass('shrinked');
        }
    });

    jQuery('.store-selection-item').off('click').on('click', function() {
        selectStore(this);
    });

    jQuery('.store-selection-page a').off('click').off('click').on('click', function(e) {
        e.preventDefault();

        if (jQuery(this).parents().eq(1).hasClass('store-selection-shop')) {
            window.location.href = '/riesenbrezn-riesengebaeck/';
        } else {
            window.location.href = '/brezn-konfigurator/';
        }
    });

    /* validate number for special formbrezn in shop view */
    jQuery('input[name=ziffer]').off('change').on('change', function() {
        var val = jQuery(this).val();
        validateFormDigit(val);
    });

    jQuery('#pa_ziffernanzahl').off('change').on('change', function() {
        setInitialFormDigit();
    });

    /* show loading animation on add to cart */
    jQuery('.main-navigation a, .footer-menu a, button[name=add-to-cart], .store-selection-page a, .products .product__image a, .mypartybrezn-btn:not(.configurator-continue)').on('click', function() {
        jQuery('.loading-wrap').addClass('in');
    });

    jQuery('#datepicker').on('change', function() {
        updatePickupTime();
    });
});

function selectStore(element) {
    jQuery('.store-selection-item').removeClass('active');
    jQuery(element).addClass('active');

    var store_name = jQuery(element).find('h3').text();

    jQuery.ajax({
        url: variables.ajax_url,
        type: 'post',
        data: {
            action: 'select_store',
            store_name: store_name
        },
        dataType: 'json',
        success: function(data, textStatus, XMLHttpRequest) {
            changeStoreImage(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

function changeStoreImage(storeName) {
    switch (storeName) {
        case 'Linz/Wegscheid':
            storeName = 'linz';
            break;
        case 'Vöcklabruck':
            storeName = 'voecklabruck';
            break;
        case 'Bruck a. d. Glocknerstraße':
            storeName = 'bruck';
            break;
    }

    storeName = storeName.toLowerCase();

    jQuery('.page-header-store').css('background', 'url(https://mypartybrezn.blob.core.windows.net/mypartybrezn/2018/12/header_maximarkt_' + storeName + '.jpg');
}

function setInitialFormDigit() {
    var selectedDigit = jQuery('#pa_ziffernanzahl option:selected').val();

    if (selectedDigit == 'einstellig') {
        jQuery('input[name=ziffer]').val(5);
    } else {
        jQuery('input[name=ziffer]').val(10);
    }
}

function validateFormDigit(val) {
    if (val < 0) {
        jQuery('input[name=ziffer]').val(1);
    }

    if (val > 99) {
        jQuery('input[name=ziffer]').val(99);
    }
}

/**
 * Update pickup time on date change by user
 */
function updatePickupTime() {
    var selected_date = jQuery('#datepicker').datepicker('getDate');

    var selected_year = selected_date.getFullYear();
    var selected_month = selected_date.getMonth() + 1;
    var selected_day = selected_date.getDate();

    var selected_date = selected_year + '-' + selected_month + '-' + selected_day;

    jQuery.ajax({
        url: variables.ajax_url,
        type: 'post',
        data: {
            action: 'update_pickup_time',
            selected_date: selected_date
        },
        dataType: 'json',
        success: function(data, textStatus, XMLHttpRequest) {
            jQuery('#timepicker').val(data.min_time);
            jQuery('#timepicker').timepicker('option', 'minTime', data.min_time);
            jQuery('#timepicker').timepicker('option', 'maxTime', data.max_time);
            jQuery('#timepicker').timepicker('option', 'defaultTime', data.min_time);
            jQuery('#timepicker').timepicker('option', 'scrollDefault', data.min_time);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}