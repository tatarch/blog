<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticleRepository
{
    function addArticle(string $title, string $text, string $date)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles (title, text, date)  VALUES (:title, :text, :date )";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text, 'date'=>$date]);
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

    function delateArticle(int $id)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles WHERE id=".$id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    function getById(int $id)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles WHERE id=' . $id);
        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }

    function updateArticle(int $id, string $title, string $text)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "UPDATE `articles` SET  title=:title, text=:text WHERE id=".$id;
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text]);
    }
}