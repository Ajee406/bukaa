(function ($) {
    "use strict";
    $('#committeeElectionDatatable').DataTable({
        pageLength: 25,
        ordering: false,
        serverSide: true,
        processing: true,
        searching: true,
        responsive: true,
        ajax: $('#committee-election-result-route').val(),
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search Election",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            {"data": 'DT_RowIndex', "name": 'DT_RowIndex', searchable: false, responsivePriority:1},
            {"data": "title", "name": "title"},
            {"data": "session", "name": "session"},
            {"data": "vote_start_date", "name": "vote_start_date"},
            {"data": "vote_end_date", "name": "vote_end_date"},
            {"data": "status", "name": "status"},
            {"data": "action", searchable: false, responsivePriority:2},
        ]
    });
})(jQuery)
