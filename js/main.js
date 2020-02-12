$(document).ready(function (response) {
    $(".js-buttonLike").on('click', function (e) {
        $(this).find(".heartLike").toggleClass('far fa-heart fas fa-heart');
        $.ajax({
            url: '/articles/like',
            type: 'POST',
            data: {
                articleId: $(this).data('id'),
            },
            dataType: 'json',
            success: (response) => {
                let likesCount = response.likes;

                console.log('span[data-id="' + $(this).data('id') + '"]');

                $('span[data-id="' + $(this).data('id') + '"]').html(response.likes);

                console.log(response.likes);

            },
            error: function () {
                console.log('Произошла ошибка!');

            }

        });
    });
});