<?php


namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesImagesRepository
{
    public function addImages(int $articleId, ?array $path): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles_images (article_id, path) VALUES (:articleId, :path)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['articleId' => $articleId, 'path' => json_encode($path)]);
    }

    public function getImages(): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles_images');
        $results = array();
        while ($row = $pdoStatement->fetch(PDO::FETCH_ASSOC)) {
            $row['path'] = json_decode($row['path']);
            $results[] = $row;
        }
        return $results;
    }
    public function getById(int $id): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles_images WHERE article_id=' . $id);
        $image = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $image['path'] = json_decode($image['path']);
        return $image['path'];
    }
    public function deleteImages(int $id): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles_images WHERE article_id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
    public function updateImg(int $id, ?array $path): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "UPDATE `articles_likes` SET  path=:path WHERE article_id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['path' => json_encode(array_values($path)), 'article_id' => $id]);
    }
}