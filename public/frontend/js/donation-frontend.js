(function ($) {
    ("use strict");

    $(document).on("change", "#donation-filter-item, input[name^=donation_category]", function () {
        $(document).find('#campaignsSearchRoute').val($(location).attr("href"));
        renderlist();
    });

    function donationSerchRequest(response) {
        $("#searchresult").html(response.data);
        countdown();
    }

    $(document).on('click', '.zPagination-one a', function (e) {
        e.preventDefault();
        $(document).find('#campaignsSearchRoute').val($(this).attr('href'));
        renderlist();
    });

    function renderlist() {
        var categoryIds = [];

        $('input[name^="donation_category"]:checked').each(function () {
            categoryIds.push($(this).val());
        });

        var donation_search_keys = {
            'keyword': $("#donation-filter-item").val(),
            'categoryIds': categoryIds
        };

        commonAjax('GET', $(document).find('#campaignsSearchRoute').val(), donationSerchRequest, donationSerchRequest, donation_search_keys);
    }

    function countdown() {
        var timers = document.querySelectorAll(".event-duration-p");
        if (timers.length === 0) return;

        for (var i = 0; i < timers.length; i++) {
            var date = timers[i].dataset.countdownDate;
            timezz(timers[i], {
                date: date, // add more options here
            });
        }
    }


    $(document).on('click', '.copy-button', function () {
        var inputElement = $(this).prev('input');
        var textToCopy = inputElement.val().trim();

        try {
            navigator.clipboard.writeText(textToCopy);
            toastr.success('Copied to clipboard!');
        } catch (err) {
            console.error('Unable to copy to clipboard', err);
            alert('Error copying to clipboard');
        }
    });

    $(document).on('click', '.reply-btn', function (e) {
        $(this).closest('.comment-area').find('.reply-to-name').text('');
        $(this).closest('.comment-area').find('.reply-note').find('.reply-to-id-input').val('');
        $(this).closest('.comment-area').find('.postCommentInput').val('');

        $(this).closest('.comment-area').find('.reply-note').removeClass('d-none');

        $(this).closest('.comment-area').find('.reply-to-name').text($(this).closest('.comment-data').data('user-name'));
        $(this).closest('.comment-area').find('.reply-note').find('.reply-to-id-input').val($(this).closest('.comment-data').data('id'));

        $('body').animate({
            scrollTop: ($(this).closest('.comment-area').find('.postCommentInput')[0]).top
        }, 1000);

        if ($(this).closest('.comment-area').find('.postCommentInput')) $($(this).closest('.comment-area').find('.postCommentInput')).focus();
    });

    $(document).on('click', '.cancel-reply-to', function (e) {
        $(this).closest('.reply-note').addClass('d-none');
        $(this).closest('.reply-note').find('.reply-to-id-input').val('');
        $(this).closest('.reply-note').find('.reply-to-name').html('');
        $(this).closest('.comment-input-box').find('.postCommentInput').val('');
    });

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

    $('#donateNowAnnonymous').change(function () {
        if ($(this).is(':checked')) {
            $('#anonymous-note').slideDown('slow');
        } else {
            $('#anonymous-note').slideUp('slow');
        }
    });

    window.donationPaymentResponse = function (response) {
        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        if (response['status'] === true) {
            toastr.success(response['message'])
            if(typeof response.data.url != 'undefined'){
                location.replace(response.data.url);
            }else{
                setTimeout(function (){
                    location.reload();
                },700)
            }
        } else {
            commonHandler(response)
        }
    }

})(jQuery);
