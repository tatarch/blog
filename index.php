<?php

$fd = fopen('name.txt', 'a');
if (!empty($_POST['useremail'])) {
    $line = $_POST['useremail'];
    fwrite($fd, "\n" . $line);
    fclose($fd);
    unset($_POST['useremail']);
    header("Location: " . $_SERVER['PHP_SELF']);
}

$lines = file('name.txt');


$username = "root";
$password = "";
$database = "blog";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    echo 'Record';

} catch (PDOException $error) {
    echo "Connection failed: ";
}

echo '<br>';


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

$querry="INSERT INTO articles  VALUES (NULL, title, text)";
$sql="INSERT INTO articles (id, title, text)  VALUES (NULL, 'Eeemail', text)";
$conn->exec($sql);
$email=$conn->prepare($querry);
$email->execute(['useremail' => $_POST['useremail']]);



echo "<ul>";
foreach ($lines as $line) {
    echo "<li>" . $line . "</li>";
}
echo "</ul>";
?>

</body>
</html>