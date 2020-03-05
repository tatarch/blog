<?php


namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesCommentsRepository
{
    public function addComment(int $articleId, int $userId, string $userName, string $comment, string $date): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles_comments (article_id, user_id, user_name, body, date) VALUES (:articleId, :userId, :userName, :comment, :date)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['articleId' => $articleId, 'userId' => $userId, 'userName' => $userName, 'comment' => $comment, 'date' => $date]);
    }

    public function getAllComments(int $id): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles_comments WHERE article_id=' . $id);
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $results[] = $row;
        }
        return $results;
    }
}