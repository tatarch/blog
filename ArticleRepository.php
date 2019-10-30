<?php


class ArticleRepository
{
    public $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function addArticle(string $title, string $text)
    {
        $query = "INSERT INTO articles (title, text)  VALUES (:title, :text )";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text]);
    }

    function getArticle()
    {

        $pdoStatement = $this->pdo->query('SELECT * FROM articles');
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }
}