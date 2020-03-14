<?php
/**
 * @var array $data
 */

use App\System\Auth;

$user = Auth::getUser(); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <header>
                <nav class="nav-nav">
                    <a class="logo" href="/home/default">
                        <span>L</span>
                        <span>O</span>
                        <span>G</span>
                        <span>O</span>
                    </a>
                    <div class="nav-toggle"><span></span></div>
                    <ul id="menu">
                        <?php if (!isset($user)): ?>
                            <li><a href="/users/form" id="menu-unregistered">Registration</a></li>
                            <li>or</li>
                            <li><a href="/users/loginForm" id="menu-unregistered">log in</a></li>
                        <?php endif; ?>
                        <?php if (isset($user)): ?>
                            <li><a href="/articles/form" class="btn  btn-sm" id="menu-adding">Add article</a></li>
                            <li><a href="/users/logout" class="btn  btn-sm" id="menu-exit">Exit</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </header>
            <div class="article-content">
                <h1><?= $data['article']['title']; ?></h1>
                <? $date = strtotime($data['article']['date']);
                $date = date('d.m.Y', $date); ?>
                <small class="text-muted"><?= $date; ?></small>
                <div class="btn-group" role="group">
                    <a href="/articles/form/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-warning"
                       role="button" aria-pressed="true">Update</a>
                    <a href="/articles/delete/?id=<?= $data['article']['id']; ?>" class="btn btn-outline-danger"
                       role="button" aria-pressed="true">Delete</a>
                </div>

                <?php if ($data['article']['images'] != null): ?>
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

            <?php if ($user = Auth::getUser()): ?>
                <div class="form-group">
                    <label for="commentTextarea" id="textarea-label" class="col-sm-2 col-form-label">Leave a
                        reply</label>
                    <textarea id="commentTextarea" name="comment" rows="5" class="form-control"></textarea>
                    <button type="submit" class="btn-comment" data-id="<?= $data['article']['id'] ?>">Submit
                    </button>
                </div>
            <?php endif; ?>

            <div class="comment-wrapper">
                <?= include __DIR__ . '/../pages/comments.php'; ?>
            </div>

        </div>
    </div>
</div>
