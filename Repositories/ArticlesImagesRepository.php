<?php


namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesImagesRepository
{
    public function addImages(int $articleId, array $images): void
    {
        $pdo = MysqlConnector::getConnection();
        foreach ($images as $image) {
            $query = "INSERT INTO articles_images (article_id, path) VALUES (:articleId, :path)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['articleId' => $articleId, 'path' => $image]);
        }
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
        $rows = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
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