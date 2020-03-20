<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticlesLikesRepository;
use App\Repositories\ArticlesCommentsRepository;
use App\Repositories\ArticlesImagesRepository;
use App\Repositories\ArticlesTagsRepository;
use App\System\Auth;
use App\System\Url;
use App\Views\View;

class ArticlesController
{
    private $articleRepository;
    private $articlesLikesRepository;
    private $articlesCommentsRepository;
    private $articlesImagesRepository;
    private $articlesTagsRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->articlesLikesRepository = new ArticlesLikesRepository();
        $this->articlesCommentsRepository = new ArticlesCommentsRepository();
        $this->articlesImagesRepository = new ArticlesImagesRepository();
        $this->articlesTagsRepository = new ArticlesTagsRepository();
    }

    public function form(): void
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $article = $this->articleRepository->getById($id);
            $article['images'] = $this->articlesImagesRepository->getById($id);
            $tags = $this->articlesTagsRepository->getAllTags();
            $article['tags'] = $this->articlesTagsRepository->getByArticleId($id);
            $data = ['article' => $article, 'tags' => $tags];

            View::render('form', $data);
        } else {
            $tags = $this->articlesTagsRepository->getAllTags();
            $data = ['tags' => $tags];
            View::render('form', $data);
        }
    }

    public function save(): void
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $tags = $_POST['tags'];
        $date = $this->getDate();
        if (!empty($_POST['articleId'])) {
            $id = (int)$_POST['articleId'];
            if (!empty(is_uploaded_file($_FILES['file']['tmp_name'][0]))) {
                $images = $this->saveImages($_FILES['file']['tmp_name']);
                $this->articlesImagesRepository->addImages($id, $images);
            }
            $this->articleRepository->updateArticle($id, $title, $text, $date);
        } else {
            $id = $this->articleRepository->addArticle($title, $text, $date);
            if (!empty($tags)) {
                $this->handleTags($id, $tags);
            }
            if (!empty(is_uploaded_file($_FILES['file']['tmp_name'][0]))) {
                $images = $this->saveImages($_FILES['file']['tmp_name']);
            } else {
                $images = [];
            }
            $this->articlesImagesRepository->addImages($id, $images);

        }
        header('Location: ' . Url::getRoot() . '/home/default');
        die();
    }

    public function delete(): void
    {
        $id = (int)$_GET['id'];
        $this->articlesCommentsRepository->deleteComments($id);
        $images = $this->articlesImagesRepository->getById($id);
        if ($images) {
            $this->deleteImages($images);
        }
        $this->articlesImagesRepository->deleteImages($id);
        $this->articleRepository->deleteArticle($id);
        $this->articlesLikesRepository->deleteLikes($id);

        header('Location: ' . Url::getRoot() . '/home/default');
        die ();
    }

    public function view(): void
    {
        $id = (int)$_GET['id'];
        $article = $this->articleRepository->getById($id);
        $article['images'] = $this->articlesImagesRepository->getById($id);
        $article['tags'] = $this->articlesTagsRepository->getByArticleId($id);

        $likes = $this->articlesLikesRepository->getLikesCount($id);
        $user = Auth::getUser();
        $isLiked = $user ? $this->articlesLikesRepository->isLiked($id, $user['id']) : false;
        $article += ['likesCount' => $likes, 'isLiked' => $isLiked];
        $article['comments'] = $this->articlesCommentsRepository->getAllComments($id);
        View::render('article', ['article' => $article]);
    }

    public function deleteImg(): void
    {
        $id = $_POST['imageId'];
        $image = $_POST['image'];

        $destinationDir = getcwd() . "/images/" . $image;
        unlink($destinationDir);

        $this->articlesImagesRepository->deleteImageOnForm($id);
    }

    public function like(): void
    {
        $user = Auth::getUser();
        if (!$user) {
            die();
        }
        $userId = $user['id'];
        $articleId = $_POST['articleId'];
        $isLiked = $this->articlesLikesRepository->isLiked($articleId, $userId);

        if (!$isLiked) {
            $addLikes = $this->articlesLikesRepository;
            $addLikes->addLike($articleId, $userId);
            $likes = $this->articlesLikesRepository->getLikesCount($articleId);

            echo json_encode(['likes' => $likes]);
        } else {
            $deleteLikes = $this->articlesLikesRepository;
            $deleteLikes->deleteLike($articleId, $userId);
            $likes = $this->articlesLikesRepository->getLikesCount($articleId);

            echo json_encode(['likes' => $likes]);
        }
    }

    public function comment()
    {
        $user = Auth::getUser();
        $userId = $user['id'];
        $userName = $user['name'];
        $id = $_POST['articleId'];
        $comment = $_POST['comment'];
        $date = date('Y-m-d H:i:s');

        $this->articlesCommentsRepository->addComment($id, $userId, $userName, $comment, $date);
        $article['comments'] = $this->articlesCommentsRepository->getAllComments($id);
        $data = ['article' => $article];

        include __DIR__ . '/../pages/comments.php';
    }

    private function getDate(): string
    {
        if (!empty($_POST['date'])) {
            $timestamp = strtotime($_POST['date']);
            $date = date('Y-m-d H:i:s', $timestamp);
        } else {
            $date = date('Y-m-d H:i:s');
        }
        return $date;
    }

    private function saveImages($filesImages): array
    {
        $images = [];
        foreach ($filesImages as $image) {
            $img = uniqid() . '.png';
            $destinationDir = getcwd() . "/images/" . $img;
            move_uploaded_file($image, $destinationDir);
            $images[] = $img;
        }
        return $images;
    }

    private function deleteImages(array $images): void
    {
        foreach ($images as $image) {
            $destinationDir = getcwd() . "/images/" . $image['path'];
            unlink($destinationDir);
        }
    }

    public function handleTags(int $id, array $tags): void
    {
        foreach ($tags as $key => $tag) {
            $tags[$key] = trim($tag);
        }
        $tagsInTable = $this->articlesTagsRepository->getAllTags();

        $newTags = array_diff($tags, $tagsInTable);
        $tagIds = $this->articlesTagsRepository->addTags($newTags);
        foreach ($tagIds as $tagId) {
            $this->articlesTagsRepository->addArticleTag($id, $tagId);
        }
        $sameTags = array_intersect($tags, $tagsInTable);
        foreach ($sameTags as $sameTag) {
            $tagId = (int)$this->articlesTagsRepository->getByName($sameTag);
            $this->articlesTagsRepository->addArticleTag($id, $tagId);
        }
    }

}
