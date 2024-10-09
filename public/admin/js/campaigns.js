(function ($) {
    ("use strict");

    $(document).ready(function () {
        allCampaignDataTable('All')
    });

    $(document).on('click', '.campaignStatusTab', function (e) {
        var status = $(this).data('status');
        allCampaignDataTable(status)
    });

    function allCampaignDataTable(status) {

        $("#campaignDataTable" + status).DataTable({
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
                url: $('#campaignStatusRoute').val(),
                data: function (data) {
                    data.status = status;
                }
            },
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-angles-left'></i>",
                    next: "<i class='fa-solid fa-angles-right'></i>",
                },
                searchPlaceholder: "Search campaign",
                search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
            },
            dom: '<>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
            columns: [
                { "data": "image", "name" : "image", searchable:false},
                { "data": "title", "name" : "title"},
                { "data": "category.name", "name" : "category.name"},
                { "data": "goal", "name" : "goal", searchable:false},
                { "width": "170px", "data": "date", "name" : "date", searchable:false},
                { "data": "status",  "name" : "status", searchable:false},
                { "data": "action",  "name" : "action", searchable:false}
            ],
            stateSave: true,
            "bDestroy": true
        });
    }
})(jQuery);
