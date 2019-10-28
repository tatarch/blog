<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $error) {
    echo "Connection failed: ";
}

echo '<br>';

// query - запрос, fetch - вытащить
$result = $conn->query('SELECT * FROM article where id=3');

while ($article = $result->fetch()) {
    echo $article['title'] . " " . $article['text'] . "<br>";
}
