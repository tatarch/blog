<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = "root";
$password = "";
$database = "blog";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo 'Record';

} catch (PDOException $error) {
    echo "Connection failed: ";
}

if (!empty($_POST['usertitle'] and $_POST['usertext'] )) {
    $querry = "INSERT INTO articles (title, text)  VALUES (:title, :text )";
    $title = $conn->prepare($querry);
    $text = $conn->prepare($querry);
    $title->execute(['title' => $_POST['usertitle'], 'text'=>$_POST['usertext']]);

    unset($_POST['usertitle']);
    unset($_POST['usertext']);

    echo 'Sucsess';
}



echo '<br>';

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
<input name="usertitle" class="emailfield"  placeholder="Enter title" required><br>
<input name="usertext" class="emailfield"  placeholder="Enter text" required><br>
<input class="btn" type="submit" name="submit" value="Submit">


</form><br>


<?php


echo "<ul>";
foreach ($lines as $line) {
    echo "<li>" . $line . "</li>";
}
echo "</ul>";
?>

</body>
</html>