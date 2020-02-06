<?php

namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesLikesRepository
{
    public function isLiked (int $userId, int $articleId): bool
    {
        $pdo = MysqlConnector::getConnection();

        $liked = $pdo->query("SELECT * FROM articles_likes WHERE user_id='" . $userId . "' AND article_id='" . $articleId . "'");
        $isLiked=$liked->fetch(PDO::FETCH_ASSOC);
        return (bool) $isLiked;
    }

    public function addLike(int $articleId, int $userId)
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles_likes (article_id, user_id)  VALUES (:articleId, :userId)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['article_id' => $articleId, 'user_id' => $userId]);
    }

    public function howManyLikes(int $articleId)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT COUNT(*) FROM articles_likes WHERE article_id=' . $articleId);
        return $pdoStatement->fetchColumn();
    }
}