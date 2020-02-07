$(document).ready(function() {
    $(".btn").on('click', function (e) {
        $.ajax({
            url: '/articles/like',
            type: 'POST',
            data: {
                articleId: $(this).data('id'),
            },
            dataType: 'json',
            success: (response) => {
                console.log('ajax sent');
            }
        });
    });
});