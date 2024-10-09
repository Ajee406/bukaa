(function ($) {
	"use strict";

    $('#roles').select2({
        dropdownCssClass: "sf-select-dropdown",
        selectionCssClass: "sf-select-section",
        dropdownParent: $('#add-modal')
    });

	$("#moderatorDataTable").DataTable({
		pageLength: 10,
		ordering: false,
		serverSide: true,
        responsive: true,
		processing: true,
		searching: true,
		ajax: $('#moderator-list-route').val(),
		language: {
			paginate: {
				previous: "<i class='fa-solid fa-angles-left'></i>",
				next: "<i class='fa-solid fa-angles-right'></i>",
			},
			searchPlaceholder: "Search Here",
			search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
		},
		dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"tableSearch float-start"f>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
		columns: [
			{ "data": "name", "name": "name", responsivePriority: 1 },
			{ "data": "email", "name": "email" },
			{ "data": "status", "name": "status", searchable: false, responsivePriority: 3 },
			{ "data": "roles", "name": "roles.display_name" },
			{ "data": "action", searchable: false, responsivePriority: 2 },
		],
	});

    window.editReponse = function (){
        $('#roles_edit').select2({
            dropdownCssClass: "sf-select-dropdown",
            selectionCssClass: "sf-select-section",
            dropdownParent: $('#edit-modal')
        });
    }

})(jQuery)
