(function ($) {
    "use strict";
    $('#campaignCommentDatatable').DataTable({
        pageLength: 25,
        ordering: false,
        serverSide: true,
        processing: true,
        searching: true,
        responsive: true,
        ajax: $('#campaign-comment-route').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search Comments",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            {"data": "user", "name": "user", responsivePriority:1},
            {"data": "campaign.title", "name": "campaign.title"},
            {"data": "comment", "name": "comment"},
            {"data": "status", "name": "status", searchable: false,},
            {"data": "action", searchable: false, responsivePriority:2},
        ]
    });
})(jQuery)
