<?php
/**
 * @var array $data
 */
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $data['title']; ?></h1>
            <p><?= $data['text']; ?></p>
            <?php if ($data['image'] != null): ?>
                <p><img src="/images/<?= $data['image']; ?>" class="img-fluid"></p>
            <?php endif; ?>


            <div class="like" data-id="<?= $data['id'] ?>">
                <button class="btn active" name="like" " ><i class="fas fa-heart"></i></button>
                <span class="counter"><?php print $data['likes'] ?></span>
            </div>

            <script type="text/javascript">
                $(document).ready(function() {
                    $(".btn").on('click', function (e) {
                        $.ajax({
                            url: 'likes/add',
                            type: 'POST',
                            data: {
                                articleId: $(this).data('articleId')
                            },
                            dataType: 'json',
                            success: (response) => {
                                console.log('ajax sent');
                            }
                        });
                    });
                    }
            </script>

            <form action="/articles/delete/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-danger">Deleta article</button>
            </form>

            <form action="/articles/form/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-warning my-3">Update article</button>
            </form>

        </div>
    </div>
</div>
