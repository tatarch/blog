
<div class="container">
    <div class="row">
        <div class="col">
            <h1><?= $data['title']; ?></h1>
            <p><?= $data['text']; ?></p>
            <p><img src="/images/<?= $data['image']; ?>" class="img-fluid" ></p>
            <form action="/articles/delate/?id=<?= $data['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-danger">Deleta article</button>
            </form>

            <form action="/articles/form/?id=<?= $article['id']; ?>" method="post" class="articles-form">
                <button type="submit" class="btn btn-warning my-3">Update article</button>
            </form>

        </div>
    </div>
</div>
