<?php
/**
 * @var array $data
 */
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $data['article']['title']; ?></h1>
            <?php if ($data['article']['image'] != null): ?>
                <p><img src="/images/<?= $data['article']['image']; ?>" class="img-fluid"></p>
            <?php endif; ?>
            <p><?= $data['article']['text']; ?></p>

            <div class="js-buttonLike" data-id="<?= $data['article']['id'] ?>">
                <i class=" heartLike fas fa-heart <?= $data['article']['isLiked'] ? 'active' : '' ?>"></i>
                <span class="counter"
                      data-id="<?= $data['article']['id'] ?>"><?= $data['article']['likesCount']; ?></span>
            </div>

            <div class="form-group row">
                <label for="commentTextarea" class="col-sm-2 col-form-label">Leave a reply</label>
                <div class="col-sm-10">
                    <textarea id="commentTextarea" name="comment" rows="3" class="form-control">Enter your comment here ...</textarea>
                </div>
                <button type="submit" class="btn-comment" data-id="<?= $data['article']['id'] ?>">Submit</button>
            </div>

            <?= include __DIR__ . '/../pages/comments.php'; ?>

            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="/articles/form/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-warning"
                   role="button"
                   aria-pressed="true">Update</a>
                <a href="/articles/delete/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-danger"
                   role="button"
                   aria-pressed="true">Delete</a>
            </div>
        </div>
    </div>
</div>
