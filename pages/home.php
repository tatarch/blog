<?php
/** @var array $data */
?>

<div class="container">
    <div class="row">
        <div class="col">
            <a href="/users/form" class="btn btn-primary my-3" id="home-btn-registration">Registration</a>
            <a href="/articles/form" class="btn btn-primary my-3" id="home-btn">Add article</a>

                <?php foreach ($data as $article): ?>
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article['title']; ?></h5>
                            <small id="emailHelp" class="form-text text-muted"><?= $article['id']; ?></small>
                            <p class="card-text"><?= $article['text']; ?> </p>
                            <a href="/articles/view/?id=<?= $article['id']; ?>" class="btn btn-primary my-3" id="home-btn">See all</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                <?php endforeach; ?>

        </div>

    </div>
</div>
