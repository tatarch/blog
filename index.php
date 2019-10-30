<?php

include "ArticleRepository.php";

$username = "root";
$password = "";
$database = "blog";
$servername = "localhost";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
}
$articlesRepository = new ArticleRepository($conn);

if (!empty($_POST['usertitle']) && !empty($_POST['usertext'])) {
    $title = $_POST['usertitle'];
    $text = $_POST['usertext'];
    $articlesRepository->addArticle($title, $text);

    unset($_POST['usertitle']);
    unset($_POST['usertext']);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="style.css" rel="stylesheet">

</head>
<body>

<form action="index.php" method="post" class="emailsubmit">
    <label for="inputTitle" class="emaillabel">Title</label><br>
    <input id="inputTitle" name="usertitle" class="emailfield" placeholder="Enter title" required><br>
    <label for="inputText" class="emaillabel">Text</label><br>
    <input id="inputText" name="usertext" class="emailfield" placeholder="Enter text" required><br>
    <input class="btn" type="submit" name="submit" value="Submit">
    <br>
</form>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Text</th>

    </tr>
    </thead>
    <tbody>

    <?php
    $articles = $articlesRepository->getArticle();
    foreach ($articles as $article): ?>
    <tr>
        <td><?= $article['id']; ?></td>
        <td><?= $article['title']; ?></td>
        <td><?= $article['text']; ?></td>
    </tr>
    </tbody>
    <?php endforeach; ?>

</body>
</html>