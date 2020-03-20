<?php
/**
 * @var array $data
 */

use App\System\Auth;
use App\Views\View;

$user = Auth::getUser(); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="article-content">
                <h1><?= $data['article']['title']; ?></h1>
                <? $date = strtotime($data['article']['date']);
                $date = date('d.m.Y', $date); ?>
                <small class="text-muted"><?= $date; ?></small>

                <?php
                if ($user['admin']): ?>
                <div class="btn-group" role="group">
                    <a href="/articles/form/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-warning"
                       role="button" aria-pressed="true">Update</a>
                    <a href="/articles/delete/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-danger"
                       role="button" aria-pressed="true">Delete</a>
                </div>
                <?php endif; ?>

                <?php
                if ($data['article']['images']): ?>
                    <?php foreach ($data['article']['images'] as $image): ?>
                        <img src="/images/<?= $image['path']; ?>" class="img-fluid">
                    <?php endforeach; ?>
                <?php endif; ?>
                <p><?= $data['article']['text']; ?></p>
            </div>

            <div class="js-buttonLike" data-id="<?= $data['article']['id'] ?>">
                <i class=" heartLike fas fa-heart fa-2x <?= $data['article']['isLiked'] ? 'active' : '' ?>"></i>
                <span class="counter"
                      data-id="<?= $data['article']['id'] ?>"><?= $data['article']['likesCount']; ?></span>
            </div>

                <?php foreach ($data['article']['tags'] as $tag): ?>
                    <span class="tag tag-pill tag-primary"><?= $tag['name']; ?></span>
                <?php endforeach; ?>

            <?php
            if ($user): ?>
                <div class="form-group">
                    <label for="commentTextarea" id="textarea-label" class="col-sm-2 col-form-label">Leave a
                        comment</label>
                    <textarea id="commentTextarea" name="comment" rows="5" class="form-control"></textarea>
                    <button type="submit" class="btn-comment" data-id="<?= $data['article']['id'] ?>">Submit
                    </button>
                </div>
            <?php endif; ?>

            <div class="comment-wrapper">
                <?= View::renderBlock('comments', ['article' => $data['article']]); ?>
            </div>

        </div>
    </div>
</div>
