(function ($) {
    ("use strict");

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


})(jQuery);
