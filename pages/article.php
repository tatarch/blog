
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $data['title']; ?></h1>
            <p><?= $data['text']; ?></p>
            <form action="/articles/delate/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-primary">Deleta article</button>
            </form>
        </div>
    </div>
</div>
