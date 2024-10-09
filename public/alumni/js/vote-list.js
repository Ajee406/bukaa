(function ($) {
    "use strict";
    $('#voteListDatatable').DataTable({
        pageLength: 25,
        ordering: false,
        serverSide: true,
        processing: true,
        searching: true,
        responsive: true,
        ajax: $('#vote-list-route').val(),
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
            {"data": "session", "name": "session", responsivePriority:1},
            {"data": "vote_start_date", "name": "vote_start_date"},
            {"data": "vote_end_date", "name": "vote_end_date"},
            {"data": "status", "name": "status"},
            {"data": "action", searchable: false, responsivePriority:2},
        ]
    });

    $(document).on('click', '#vote-btn', function (){
        Swal.fire({
            title: 'Sure! You want to submit?',
            text: "You won't be able to revert this!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit this!'
        }).then((result) => {
            if (result.value) {
                $('#vote-form').submit();
            }
        })
    });

    window.voteFormResponse = function (response){
        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        if (response['status'] === true) {
            toastr.success(response['message'])
            setTimeout(function(){
                location.replace(response.data.url);
            },500);
        } else {
            commonHandler(response)
        }
    }
})(jQuery)
