<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticleRepository
{
    public function addArticle(string $title, string $text, string $date, $image)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles (title, text, date, image)  VALUES (:title, :text, :date, :image)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text, 'date' => $date, 'image' => $image]);
    }

    public function getArticles()
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles');
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }

    public function deleteArticle(int $id)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles WHERE id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    public function getById(int $id)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles WHERE id=' . $id);
        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateArticle(int $id, string $title, string $text, string $date, $image)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "UPDATE `articles` SET  title=:title, text=:text, date=:date, image=:image WHERE id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text, 'date' => $date, 'image' => $image]);
    }

    public function likes(int $id, int $likes)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "UPDATE `articles` SET  likes=:likes WHERE id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute(['likes' => $likes]);
    }

}
