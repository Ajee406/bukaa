(function ($) {
    "use strict";
    $(document).on('click', '#reg-form-btn', function () {
        $(this).closest('form').find('input[name=custom_fields]').val(JSON.stringify(formRenderInstance.userData))
    });

    window.nominationResponse = function (response) {
        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        if (response['status'] === true) {
            toastr.success(response['message'])
            if (typeof response.data.url != 'undefined') {
                location.replace(response.data.url);
            } else {
                setTimeout(function () {
                    location.reload();
                }, 700)
            }
        } else {
            commonHandler(response)
        }
    }

    $('#bank_id').on('change', function () {
        $('#bankDetails').removeClass('d-none');
        let details = $(this).find(':selected').data('details');
        $('#bankDetails p').html(details);
        if(typeof details == 'undefined'){
            $('#bankDetails').addClass('d-none');
        }
    });

    $(document).on('change', '.paymentItem-input', function () {
        $('#currency').html('');
        $('#currency').niceSelect('update');
        commonAjax('GET', $('#getCurrencyByGatewayRoute').val(), getCurrencyRes, getCurrencyRes, {'id': $(this).data('val')});

        if ($('input[name="gateway"]:checked').val() == 'bank') {
            $('#bankBlock').removeClass('d-none');
            $('#bank_slip').attr('required', true);
            $('#bank_id').attr('required', true);
        } else {
            $('#bank_slip').attr('required', false);
            $('#bank_id').attr('required', false);
            $('#bankBlock').addClass('d-none');
        }
    });

    window.getCurrencyRes = function (response) {
        var html = '';
        var invoiceAmount = parseFloat($('#amount').val()).toFixed(2);
        invoiceAmount = isNaN(invoiceAmount) ? 0 : invoiceAmount;
        Object.entries(response.data).forEach((currency) => {
            let currencyAmount = currency[1].conversion_rate * invoiceAmount;
            html += `<option value="${currency[1].id}" data-rate="${currency[1].conversion_rate}" data-currency="${currency[1].currency}"> ${gatewayCurrencyPrice(currencyAmount, currency[1].currency)}</option>`;
        });
        $('#currency').html(html);
        $('#currency').niceSelect('update');
    }

    $(document).on('input', '#amount', function () {
        var invoiceAmount = parseFloat($('#amount').val()).toFixed(2);
        $("#currency option").each(function () {
            var rate = parseFloat($(this).data("rate"));
            var currency = $(this).data("currency");
            if (!isNaN(rate) && currency) {
                invoiceAmount = isNaN(invoiceAmount) ? 0 : invoiceAmount;
                let currencyAmount = rate * invoiceAmount;
                $(this).text(`${gatewayCurrencyPrice(currencyAmount, currency)}`);
            }
        });

        $('#currency').niceSelect('update');
    })

    window.addEventListener('load', function () {
        $(document).find('.paymentItem-input').first().trigger('change');
    })

    $(document).on('change', '#symbol_id', function () {
        $(document).find('#selected-flag').attr('src', $('option:selected', this).data('url'));
    });

})(jQuery)
