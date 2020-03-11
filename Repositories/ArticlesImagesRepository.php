<?php


namespace App\Repositories;

use App\Database\Connectors\MysqlConnector;
use PDO;

class ArticlesImagesRepository
{
    public function addImages(int $articleId, string $name, string $path): void
    {
        $pdo = MysqlConnector::getConnection();

        $query = "INSERT INTO articles_images (article_id, name, path) VALUES (:articleId, :name, :path)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['articleId' => $articleId, 'name' => $name, 'path' => $path]);
    }
}