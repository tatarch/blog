<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticleRepository
{
    public function addArticle(string $title, string $text, string $date): int
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles (title, text, date)  VALUES (:title, :text, :date)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text, 'date' => $date]);
        return $pdo->lastInsertId();
    }

    public function getArticles(): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles');

        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteArticle(int $id): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles WHERE id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }


    public function getById(int $id): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles WHERE id=' . $id);

        return $pdoStatement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateArticle(int $id, string $title, string $text, string $date): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "UPDATE `articles` SET  title=:title, text=:text, date=:date WHERE id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute(['title' => $title, 'text' => $text, 'date' => $date]);
    }
}
