<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$fd = fopen('name.txt', 'a');
if (!empty($_POST['useremail'])) {
    $line = $_POST['useremail'];
    fwrite($fd, "\n" . $line);
    fclose($fd);
    unset($_POST['useremail']);
    header("Location: " . $_SERVER['PHP_SELF']);
}

$lines = file('name.txt');



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link href="style.css" rel="stylesheet">

</head>
<body>


<form method="post" class="emailsubmit"
<label class="emaillabel">Email address</label><br>
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