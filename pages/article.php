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
                <span class="counter" data-id="<?= $data['article']['id'] ?>"><?= $data['article']['likesCount']; ?></span>
            </div>

            <form action="/articles/comment/?id=<?= $data['article']['id']; ?>" method="post" class="articlesComment-form">
                <div class="form-group row">
                    <label for="commentTextarea" class="col-sm-2 col-form-label">Leave a reply</label>
                    <div class="col-sm-10">
                        <textarea id="commentTextarea" name="comment" rows="3" class="form-control">Enter your comment here ...</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>

            <?php foreach ($data['comments'] as $comm):
                $date = strtotime($comm['date']);
                $date = date('d.m.Y', $date); ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $comm['user_name']; ?></h5>
                        <p class="card-text"><?= $comm['body']; ?> </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?= $date; ?></small>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="/articles/form/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-warning" role="button"
                   aria-pressed="true">Update</a>
                <a href="/articles/delete/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-danger" role="button"
                   aria-pressed="true">Delete</a>
            </div>
        </div>
    </div>
</div>
