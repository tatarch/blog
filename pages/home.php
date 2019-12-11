<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home page</title>
    <link href="/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <a href="/articles/form" class="btn btn-primary my-3" id="home-btn">Add article</a>

                <?php foreach ($articles as $article): ?>

                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article['title']; ?></h5>
                            <small id="emailHelp" class="form-text text-muted"><?= $article['id']; ?></small>
                            <p class="card-text"><?= $article['text']; ?> </p>
                            <a href="#" class="btn btn-primary my-3" id="home-btn">See all</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                <?php endforeach; ?>

        </div>

    </div>
</div>

</body>
</html>
