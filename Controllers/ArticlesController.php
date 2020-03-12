<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticlesLikesRepository;
use App\Repositories\ArticlesCommentsRepository;
use App\Repositories\ArticlesImagesRepository;
use App\System\Auth;
use App\System\Url;
use App\Views\View;

class ArticlesController
{
    private $articleRepository;
    private $articlesLikesRepository;
    private $articlesCommentsRepository;
    private $articlesImagesRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->articlesLikesRepository = new ArticlesLikesRepository();
        $this->articlesCommentsRepository = new ArticlesCommentsRepository();
        $this->articlesImagesRepository = new ArticlesImagesRepository();
    }

    public function form(): void
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $data = $this->articleRepository->getById($id);
            $images= $this->articlesImagesRepository->getById($id);
            $article=['article' => $data, 'images' => $images];

            View::render('form', $article);
        } else {
            View::render('form');
        }
    }

    public function save(): void
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date = $this->getDate();

        if (!empty($_POST['articleId'])) {
            $id = (int)$_POST['articleId'];
            $img=$this->articlesImagesRepository->getById($id);
            if ((isset($_FILES) && $_FILES['inputfile']['error'] == 0)) { // Проверяем, загрузил ли пользователь файл
                $path=$this->saveImages();
            } else {
                $path = $img['path'];
            }
            $this->articleRepository->updateArticle($id, $title, $text, $date);
            $this->articlesImagesRepository->addImages($id, $path);
        } else {
            if (isset($_FILES)) { // Проверяем, загрузил ли пользователь файл
                $path = $this->saveImages();
            } else {
                $path = null;
            }
            $id=$this->articleRepository->addArticle($title, $text, $date);
            $this->articlesImagesRepository->addImages($id, $path);
        }
        header('Location: ' . Url::getRoot() . '/home/default');
        die ();
    }

    public function delete(): void
    {
        $id = (int)$_GET['id'];
        $images=$this->articlesImagesRepository->getById($id);
        if ($images['path']) {
            $this->deleteImages($images['path']);
        }
        $this->articleRepository->deleteArticle($id);
        $this->articlesImagesRepository->deleteImages($id);

        header('Location: ' . Url::getRoot() . '/home/default');
        die ();
    }

    public function view(): void
    {
        $id = (int)$_GET['id'];
        if ($id < 0) {
            throw new \Exception();
        }
        $article = $this->articleRepository->getById($id);
        $images=$this->articlesImagesRepository->getById($id);
        $likes = $this->articlesLikesRepository->howManyLikes($id);
        $user = Auth::getUser();
        $userId = $user['id'];
        $isLiked = Auth::getUser() ? $this->articlesLikesRepository->isLiked($id, $userId) : false;
        $article += ['likesCount' => $likes, 'isLiked' => $isLiked];
        $commentsGetById = $this->articlesCommentsRepository;
        $comments = $commentsGetById->getAllComments($id);
        $data = ['article' => $article, 'comments' => $comments, 'images' => $images];

        View::render('article', $data);
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

    private function saveImages(): array
    {
        $images = [];
        foreach ($_FILES['inputfile']['tmp_name'] as $image) {
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
            $destinationDir = getcwd() . "/images/" . $image;
            unlink($destinationDir);
        }
    }

    public function deleteImg(): void
    {
        $id = $_POST['articleId'];
        $image = $_POST['image'];
        $img =$this->articlesImagesRepository->getById($id);
        $images = $img['path'];
        foreach ($images as $key => $item) {
            if ($item == $image) {
                unset($images[$key]);
            }
        }
        $destinationDir = getcwd() . "/images/" . $image;
        unlink($destinationDir);

        $this->articleRepository->updateImg($id, $images);
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

        if ($isLiked != true) {
            $addLikes = $this->articlesLikesRepository;
            $addLikes->addLike($articleId, $userId);

            $countLikes = $this->articlesLikesRepository;
            $likes = $countLikes->howManyLikes($articleId);

            echo json_encode(['likes' => $likes]);
        } else {
            $deleteLikes = $this->articlesLikesRepository;
            $deleteLikes->deleteLike($articleId, $userId);

            $countLikes = $this->articlesLikesRepository;
            $likes = $countLikes->howManyLikes($articleId);

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

        $addComment = $this->articlesCommentsRepository;
        $addComment->addComment($id, $userId, $userName, $comment, $date);

        $commentsGetAllComments = $this->articlesCommentsRepository;
        $comments = $commentsGetAllComments->getAllComments($id);
        $data = ['comments' => $comments];

        include __DIR__ . '/../pages/comments.php';
    }
}
