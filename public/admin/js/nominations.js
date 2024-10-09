(function ($) {
    "use strict";
    var election_id;
    var committee_category_id;
    var nominationDatatable = $('#nominationDatatable').DataTable({
        pageLength: 10,
        ordering: false,
        serverSide: true,
        processing: true,
        searching: true,
        responsive: true,
        ajax: {
            url: $('#nomination-route').val(),
            data: function (d) {
                d.committee_election_id = election_id;
                d.committee_category_id = committee_category_id;
            }
        },
        language: {
            paginate: {
                previous: "<i class='fa-solid fa-angles-left'></i>",
                next: "<i class='fa-solid fa-angles-right'></i>",
            },
            searchPlaceholder: "Search Here",
            search: "<span class='searchIcon'><i class='fa-solid fa-magnifying-glass'></i></span>",
        },
        dom: '<"tableTop"<"row align-items-center"<"col-sm-6"<"d-flex align-items-center cg-5"<"col-sm-12"<"z-filter-block">>>><"col-sm-6"<"tableLengthInput float-end"l>>>>tr<"tableBottom"<"row align-items-center"<"col-sm-6"<"tableInfo"i>><"col-sm-6"<"tablePagi"p>>>><"clear">',
        columns: [
            {"data": "session", "name": "committee_elections.session", responsivePriority: 1},
            {"data": "category", "name": "committee_categories.name"},
            {"data": "designation", "name": "committee_designations.name"},
            {"data": "start_date", "name": "start_date"},
            {"data": "end_date", "name": "end_date"},
            {"data": "amount", "name": "amount"},
            {"data": "status", "name": "status", searchable: false},
            {"data": "action", searchable: false, responsivePriority: 2},
        ],
        "initComplete": function( settings, json ) {
            $('.z-filter-block').html($('#search-section').html());
            $('#search-section').remove();

            $('.z-filter-button').html(`  <button class="zBtn-filter" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<ellipse cx="14.1646" cy="10.1667" rx="1.647" ry="1.66667" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<ellipse cx="8.39895" cy="5.16667" rx="1.647" ry="1.66667" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<ellipse cx="2.63528" cy="9.33332" rx="1.647" ry="1.66667" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<path d="M8.39941 14.3333L8.39941 6.83331" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<path d="M8.39941 3.5L8.39941 1" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<path d="M14.1631 8.5L14.1631 1" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<path d="M2.63574 14.3333L2.63574 11" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<path d="M14.1631 14.3333L14.1631 11.8333" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
			<path d="M2.63574 7.66666L2.63574 0.99999" stroke="#1B1C17" stroke-width="1.5" stroke-linecap="round" />
		  </svg>
		</button>`);
        }
    });

    $(document).on('change','#election_id,#committee_id',function(e){
        election_id = $(document).find('#election_id :selected').val();
        committee_category_id = $(document).find('#committee_id :selected').val();
        nominationDatatable.draw();
        e.preventDefault();
    });

    var formAddFieldSelector = document.getElementById("form-builder-form");
    var options = {
        disableHTMLLabels: false,
        controlPosition: "left",
        disabledActionButtons: ["data"],
        onCloseFieldEdit: false,
        disableFields: ["autocomplete", "hidden", "header", "paragraph", "button"],
        controlOrder: ["text", "number", "select", "checkbox-group", "radio-group"],
        showActionButtons: false,
        i18n: {
            locale: $('#lang_code').val(),
            location: '/assets/lang/',
            extension: '.lang'
        }
    };

    var formBuilder = $(formAddFieldSelector).formBuilder(options);

    $(document).on('click', '#form-save-btn', function () {
        $(this).closest('form').find('input[name=custom_fields]').val(formBuilder.actions.getData('json'))
    });

    var formUpdateBuilder;
    window.editModalResponse = function (){
        var formEditFieldSelector = $(document).find('#edit-modal').find("#form-builder-form");
        var options = {
            disableHTMLLabels: false,
            controlPosition: "left",
            disabledActionButtons: ["data"],
            onCloseFieldEdit: false,
            disableFields: ["autocomplete", "hidden", "header", "paragraph", "button"],
            controlOrder: ["text", "number", "select", "checkbox-group", "radio-group"],
            showActionButtons: false,
            defaultFields: typeof editFields == 'object' ? editFields : JSON.parse(editFields),
            i18n: {
                locale: $('#lang_code').val(),
                location: '/assets/lang/',
                extension: '.lang'
            }
        };

        formUpdateBuilder = $(formEditFieldSelector).formBuilder(options);
    }

    $(document).on('click', '#form-update-btn', function () {
        $(this).closest('form').find('input[name=custom_fields]').val(formUpdateBuilder.actions.getData('json'))
    });
})(jQuery)
