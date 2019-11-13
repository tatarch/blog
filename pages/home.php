<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Home page</title>
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
</body>
</html>