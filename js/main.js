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

$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4'
});