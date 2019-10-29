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



$tbbll = $conn->query('SELECT * FROM articles');

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
<br>

<table >
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Text</th>

    </tr>
    </thead>
    <tbody>
    <?php while($results = $tbbll->fetch(PDO::FETCH_ASSOC)):; ?>
        <tr>
            <td><?php echo $results['id'];?></td>
            <td><?php echo $results['title'];?></td>
            <td><?php echo $results['text'];?></td>

        </tr>
    </tbody>
    <?php endwhile;?>
<?php


?>

</body>
</html>