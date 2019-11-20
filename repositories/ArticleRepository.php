<?php


class ArticleRepository
{
    public $pdo;

    function __construct()
    {
        $username = "root";
        $password = "";
        $database = "blog";
        $servername = "localhost";

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            die('Cannot connect to DB');
        }
        $this->pdo = $pdo;
    }

    function addArticle(string $title, string $text)
    {
        $query = "INSERT INTO articles (title, text)  VALUES (:title, :text )";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text]);
    }

    function getArticles()
    {
        $pdoStatement = $this->pdo->query('SELECT * FROM articles');
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }
}