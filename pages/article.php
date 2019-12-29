<?php
$user=\App\Repositories\UserRepository::getUser();
?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $data['title']; ?></h1>
            <p><?= $data['text']; ?></p>
            <?php if($data['image']!=null): ?><p><img src="/images/<?= $data['image']; ?>" class="img-fluid" ></p><?php endif; ?>
            <form action="/articles/delete/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-danger">Deleta article</button>
            </form>

            <form action="/articles/form/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-warning my-3">Update article</button>
            </form>

        </div>
    </div>
</div>
