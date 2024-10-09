(function ($) {
    ("use strict");

    $(document).ready(function () {
        allNominationPaymentDataTable('All')
    });

    $(document).on('click', '.nominationPaymentStatusTab', function (e) {
        var status = $(this).data('status');
        allNominationPaymentDataTable(status)
    });

    function allNominationPaymentDataTable(status) {

        var dataTableColumns = [
            { "data": "user" },
            { "data": "nomination", "class" : "text-nowrap"},
            { "data": "payment_info", "class" : "text-nowrap"},
            { "data": "payment_time", "class" : "text-nowrap"},
            { "data": "amount",  "class" : "text-nowrap"},
            { "data": "status" }
        ];
        if(status == 'Pending'){
            dataTableColumns.push({ "data": "action", responsivePriority: 2 });
        }


        $("#nominationPaymentDataTable" + status).DataTable({
            pageLength: 10,
            ordering: false,
            serverSide: true,
            processing: true,
            searching: false,
            responsive: {
                breakpoints: [
                    { name: "desktop", width: Infinity },
                    { name: "tablet", width: 1400 },
                    { name: "fablet", width: 768 },
                    { name: "phone", width: 480 },
                ],
            },
            ajax: {
                url: $('#nominationStatusRoute').val(),
                data: function (data) {
                    data.status = status;
                }
            },
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-angles-left'></i>",
                    next: "<i class='fa-solid fa-angles-right'></i>",
                },
                searchPlaceholder: "Search here",
                search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
            },
            dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
            columns: dataTableColumns,
            stateSave: true,
            "bDestroy": true
        });
    }

    $(document).on('click', '.orderPayStatus', function () {
        commonAjax('GET', $('#ordersGetInfoRoute').val(), getInfoRes, getInfoRes, { 'id': $(this).data('id') });
    });

    function getInfoRes(response) {
        const selector = $('#payStatusChangeModal');
        selector.find('input[name=id]').val(response.data.id)
        selector.find('select[name=status]').val(response.data.payment_status)
        selector.modal('show')
    }
})(jQuery);
