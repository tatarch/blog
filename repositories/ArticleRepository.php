<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticleRepository
{
    function addArticle(string $title, string $text)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles (title, text)  VALUES (:title, :text )";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text]);
    }

    function getArticles()
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles');
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }

    function getById(int $id)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles WHERE id=' . $id);
        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }
}