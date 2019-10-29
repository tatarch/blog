<?php


$username = "root";
$password = "";
$database = "blog";
$servername="localhost";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



} catch (PDOException $error) {

}


$title=$_POST['usertitle'];
$text=$_POST['usertext'];

    function addArticle($conn,$title,$text)
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



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="style.css" rel="stylesheet">

</head>
<body>


<form action="index.php" method="post" class="emailsubmit"
<label class="emaillabel">Title</label><br>
<input name="usertitle" class="emailfield" placeholder="Enter title" required><br>
<input name="usertext" class="emailfield" placeholder="Enter text" required><br>
<input class="btn" type="submit" name="submit" value="Submit">


</form><br>


<?php

$result = $conn->query('SELECT * FROM articles');

while ($articles = $result->fetch()) {
    echo $articles['title'] . " " . $articles['text'] . "<br>";
}

echo "<ul>";
foreach ($lines as $line) {
    echo "<li>" . $line . "</li>";
}
echo "</ul>";
?>

</body>
</html>