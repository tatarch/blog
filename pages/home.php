<?php
/**
 * @var array $data
 */

use App\System\Auth;

?>
<?php if ($user = Auth::getUser()): ?>
    <p>Hello, <?= $user['name']; ?></p>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <?php if (!isset($user)): ?>
                <a href="/users/form" class="btn btn-primary my-3" id="home-btn-registration">Registration</a>
            <?php endif; ?>
            <?php if (!isset($user)): ?>
                <a href="/users/loginForm" class="btn btn-primary my-3" id="home-btn-registration">log in</a>
            <?php endif; ?>
            <a href="/articles/form" class="btn btn-primary my-3" id="home-btn">Add article</a>
            <?php if (isset($user)): ?>
                <a href="/users/logout" class="btn btn-danger my-3" id="home-btn-registration">Exit</a>
            <?php endif; ?>

            <?php foreach ($data as $article):
                $date = strtotime($article['date']);
                $date = date('d.m.Y', $date); ?>
                <div class="card my-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $article['title']; ?></h5>
                        <small id="emailHelp" class="form-text text-muted"><?= $article['id']; ?></small>
                        <p class="card-text"><?= $article['text']; ?> </p>
                        <a href="/articles/view/?id=<?= $article['id']; ?>" class="btn btn-primary my-3" id="home-btn">See
                            all</a>
                        <a href="/articles/form/?id=<?= $article['id']; ?>" class="btn btn-warning my-3"
                           id="home-btn-update">update article</a>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted"><?= $date; ?></small>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
