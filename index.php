<?php

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

if (!empty($_POST['useremail'])) {
    $querry = "INSERT INTO articles (title, text)  VALUES ($email, $text)";
    $email = $conn->prepare($querry);
    $email->execute(['useremail' => $_POST["useremail"]]);
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
<input name="useremail" class="emailfield"  placeholder="Enter email" required><br>
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