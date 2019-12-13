<?php

class ArticleRepository
{
    function addArticle(string $title, string $text)
    {
        $connector = new MysqlConnector();
        $pdo=$connector->getConnection();

        $query = "INSERT INTO articles (title, text)  VALUES (:title, :text )";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text]);
    }

    function getArticles()
    {
        $connector = new MysqlConnector();
        $pdo=$connector->getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles');
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }

    function getById(int $id)
    {
        $connector = new MysqlConnector();
        $pdo=$connector->getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles WHERE id=' . $id);
        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }
}