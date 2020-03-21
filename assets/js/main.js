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

    $(".btn-comment").on('click', function (e) {
        let comment = $('#commentTextarea').val();
        if (comment === '') {
            console.log('empty');
        } else {
            $('#commentTextarea').val('');
            $.ajax({
                url: '/articles/comment',
                type: 'POST',
                data: {
                    articleId: $(this).data('id'),
                    comment: comment,
                },
                dataType: 'html',
                success: (response) => {
                    $(".comment-wrapper").html(response);
                }
            });
        }
    });

    $('.card-body span').click(function (event) {

        $.ajax({
            url: '/articles/deleteComment',
            type: 'post',
            data: {
                commentId: $(this).data('id')
            },
            success: function (data) {
                $(event.target).parent().parent().parent().remove();

            }
        });
    });

    $('.form-images span').click(function (event) {

        let imageId = $(this).siblings("#imageId").val();

        $.ajax({
            url: '/articles/deleteImg',
            type: 'post',
            data: {
                imageId: imageId,
                image: $(this).data('id')
            },
            success: function (data) {
                $(event.target).parent().parent().remove();

            }
        });
    });

    $('#datepicker').datepicker({
        uiLibrary: 'bootstrap4'
    });

    $('#select-beast').selectize({
        plugins: ['remove_button'],
        sortField: 'text',
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });

    $('#select-beast').selectize({
        plugins: ['remove_button'],
        sortField: 'text',
        create: function (input) {
            return {
                value: input,
                text: input
            }
        }
    });

});

