<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesLikesRepository
{
    public function isLiked(int $articleId, int $userId): bool
    {
        $pdo = MysqlConnector::getConnection();
        // а давай ты на sql напишешь запрос который вернет 1 или 0 в зависимости от того есть лайк или нет. для тренировки и читаемости
        $liked = $pdo->query("SELECT COUNT(*) FROM articles_likes WHERE  article_id='" . $articleId . "' AND user_id='" . $userId . "'");
        $isLiked = $liked->fetch(PDO::FETCH_ASSOC);
        return (bool)$isLiked['COUNT(*)'];
    }

    public function addLike(int $articleId, int $userId): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles_likes (article_id, user_id) VALUES (:articleId, :userId)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['articleId' => $articleId, 'userId' => $userId]);
    }

    public function deleteLike(int $articleId, int $userId): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles_likes WHERE article_id='" . $articleId . "'AND user_id='" . $userId . "'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    public function getLikesCount(int $articleId): int
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT COUNT(*) FROM articles_likes WHERE article_id=' . $articleId);
        return $pdoStatement->fetchColumn();
    }

    public function deleteLikes(int $id): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles_likes WHERE article_id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
}