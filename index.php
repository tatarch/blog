<?php


$username = "root";
$password = "";
$database = "blog";
$servername = "localhost";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch (PDOException $error) {

}


$title = $_POST['usertitle'];
$text = $_POST['usertext'];

function addArticle(PDO $conn, string $title, string $text)
{

    $querry = "INSERT INTO articles (title, text)  VALUES (:title, :text )";
    $stmt = $conn->prepare($querry);
    $stmt->execute(['title' => $title, 'text' => $text]);


    unset($_POST['usertitle']);
    unset($_POST['usertext']);


    header('Location: ' . $_SERVER['HTTP_REFERER']);

}


if (!empty($_POST['usertitle']) && !empty($_POST['usertext'])) {
    addArticle($conn, $title, $text);
}


function getArticle(PDO $conn)
{

    $tbbll = $conn->query('SELECT * FROM articles');
    while ($row = $tbbll->fetch(PDO::FETCH_ASSOC)) {
        $results[]=$row;
    }
    return $results;
}
$articles =getArticle($conn);
foreach ($articles as $article){
    echo $article['id'];
    echo $article['title'];
    echo $article['text'];
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



</body>
</html>