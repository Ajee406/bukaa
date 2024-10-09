(function ($) {
    "use strict";

    $("#subscriptionEmailTemplateDatatable").DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: true,
        processing: true,
        responsive: true,
        searching: true,
        ajax: $('#subscriptions-email-template-route').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search subscription email template ....",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            {"data": 'DT_RowIndex', "name": 'DT_RowIndex', searchable: false, responsivePriority: 1},
            {"data": "category", "name": "category"},
            {"data": "subject", "name": "subject", searchable: false},
            {"data": "status", "name": "status", searchable: false},
            {"data": "action", searchable: false, responsivePriority: 2},
        ],
    });


    $(document).ready(function() {
        $('#subscriptionType').change(function() {
            var selectedOption = $(this).val();
            if (selectedOption === 'individual-subscription') {
                $('.individual_subscription_label').removeClass('d-none');
                $('.individual_alumni_label').addClass('d-none');
            } else if(selectedOption === 'individual-alumni') {
                $('.individual_alumni_label').removeClass('d-none');
                $('.individual_subscription_label').addClass('d-none');
            }else{
                $('.individual_subscription_label').addClass('d-none');
                $('.individual_alumni_label').addClass('d-none');
            }
        });
    });

    $(document).ready(function (){
        $('#individual_subscription').select2({
            // placeholder: 'Search and select',
            allowClear: true,
            dropdownCssClass: "sf-select-dropdown",
            selectionCssClass: "sf-select-section",
            minimumInputLength: 1,
            ajax: {
                url: $('#individual_subscription').data('search-route'),
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    return {
                        individual_subscription: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.email,
                                text: item.email
                            };
                        })
                    };
                }
            }
        });
    });

    $(document).ready(function (){
        $('#individual_alumni').select2({
            // placeholder: 'Search and select',
            allowClear: true,
            dropdownCssClass: "sf-select-dropdown",
            selectionCssClass: "sf-select-section",
            minimumInputLength: 1,
            ajax: {
                url: $('#individual_alumni').data('search-route'),
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                delay: 250,
                dataType: 'json',
                data: function(params) {
                    return {
                        individual_alumni: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                id: item.email,
                                text: item.email
                            };
                        })
                    };
                }
            }
        });
    });




})(jQuery)
