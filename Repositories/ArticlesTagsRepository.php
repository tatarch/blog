<?php


namespace App\Repositories;


use App\Database\Connectors\MysqlConnector;
use PDO;


class ArticlesTagsRepository
{
    public function addTags( ?array $tags): array
    {
        $pdo = MysqlConnector::getConnection();
        $ids=[];
        foreach ($tags as $tag) {
            $query = "INSERT INTO tags (name) VALUE (:tag)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['tag' => $tag]);
            $id=$pdo->lastInsertId();
            $ids[]=$id;
        }
        return $ids;
    }
    public function getAllTags (): array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query('SELECT * FROM tags');


        foreach ($pdoStatement->fetchAll(PDO::FETCH_ASSOC) as $tag){
            $tags[]=$tag['name'];
        }
        return $tags;
    }

    public function  getByName($name)
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query("SELECT * FROM tags WHERE name='" . $name."'");

        $tag= $pdoStatement->fetch(PDO::FETCH_ASSOC);
        return $tag['id'];
    }

    public function addArticleTag(int $articleId, int $tagId): void
    {
        $pdo = MysqlConnector::getConnection();
            $query = "INSERT INTO articles_tags (article_id, tag_id) VALUES (:articleId, :tagId)";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['articleId' => $articleId, 'tagId' => $tagId]);
    }

    public function getById(int $id): ?array
    {
        $pdo = MysqlConnector::getConnection();

        $pdoStatement = $pdo->query("SELECT * FROM  articles_tags LEFT JOIN tags ON tag_id = tags.id WHERE articles_tags.article_id =" . $id);


        return $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
    }


}