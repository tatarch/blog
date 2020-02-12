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

            <div class="js-buttonLike" data-id="<?= $data['id'] ?>">
                <i class=" heartLike fas fa-heart <?= $data['isLiked'] ? 'active' : '' ?>"></i>
                <span class="counter" data-id="<?= $data['id'] ?>"><?= $data['likesCount']; ?></span>
            </div>

            <form action="/articles/delete/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-danger">Delete article</button>
            </form>

            <form action="/articles/form/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-warning my-3">Update article</button>
            </form>

        </div>
    </div>
</div>
