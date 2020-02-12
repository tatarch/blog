$(document).ready(function (response) {
    $(".js-buttonLike").on('click', function (e) {
        // что это и зачем это делать?
        $(this).find(".heartLike").toggleClass('far fa-heart fas fa-heart');
        $.ajax({
            url: '/articles/like',
            type: 'POST',
            data: {
                articleId: $(this).data('id'),
            },
            dataType: 'json',
            success: (response) => {
                // зачем тебе эта переменная?
                let likesCount = response.likes;
                // поубирай консоль логи
                console.log('span[data-id="' + $(this).data('id') + '"]');

                $('span[data-id="' + $(this).data('id') + '"]').html(response.likes);

                console.log(response.likes);

            },
            error: function(){
                // только англ) привыкай)
                console.log('Произошла ошибка!');
// оубирай лишние строки

            }

        });
    });
});