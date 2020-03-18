<?php


namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesImagesRepository
{
    public function addImages(int $articleId, ?array $images): void
    {
        $pdo = MysqlConnector::getConnection();
        foreach ($images as $image) {
            $query = "INSERT INTO articles_images (article_id, path) VALUES (:articleId, :path)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['articleId' => $articleId, 'path' => $image]);
        }
    }

    public function getById(int $id): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM articles_images WHERE article_id=' . $id);

        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteImageOnForm(int $id): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles_images WHERE id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

    public function deleteImages(int $id): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "DELETE FROM articles_images WHERE article_id=" . $id;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }

}