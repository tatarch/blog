<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home page</title>
    <link href="/style.css" rel="stylesheet">
</head>
<body>
<a href="/articles/form">Add article</a>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Text</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?= $article['id']; ?></td>
            <td><?= $article['title']; ?></td>
            <td><?= $article['text']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</body>
</html>
