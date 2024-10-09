(function ($) {
    "use strict";
    $(document).on('click', '#result-btn', function () {
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

    window.voteFormResponse = function (response) {
        $('.error-message').remove();
        $('.is-invalid').removeClass('is-invalid');
        if (response['status'] === true) {
            toastr.success(response['message'])
            setTimeout(function () {
                location.replace(response.data.url);
            }, 500);
        } else {
            commonHandler(response)
        }
    }
})(jQuery)
