$(document).ready(function (response) {
    $(".js-buttonLike").on('click', function (e) {
        $.ajax({
            url: '/articles/like',
            type: 'POST',
            data: {
                articleId: $(this).data('id'),
            },
            dataType: 'json',
            success: (response) => {
                $('span[data-id="' + $(this).data('id') + '"]').html(response.likes);
                $(this).find(".heartLike").toggleClass('active');
            },
            error: function () {
                console.log('error');
            }
        });
    });
});

$(document).ready(function (response) {
    $(".btn-comment").on('click', function (e) {
        let comment = $('#commentTextarea').val();

        $.ajax({
            url: '/articles/comment',
            type: 'POST',
            data: {
                articleId: $(this).data('id'),
                comment: comment,
            },
            dataType: 'html',
            success: (response) => {
            }
        });
    });
});


