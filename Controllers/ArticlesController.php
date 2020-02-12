<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticlesLikesRepository;
use App\System\Auth;
use App\System\Url;
use App\Views\View;

class ArticlesController
{
    private $articleRepository;
    private $articlesLikesRepository;

    public function __construct()
    {
        $this->articleRepository = new ArticleRepository();
        $this->articlesLikesRepository = new ArticlesLikesRepository();
    }

    public function form(): void
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $article = $this->articleRepository->getById($id);

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

        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];
            $article = $this->articleRepository->getById($id);
            if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
                if (isset($article['image'])) {
                    $this->deleteImage($article['image']);
                }
                $image = $this->getImg();
            } else {
                $image = $article['image'];
            }
            $this->articleRepository->updateArticle($id, $title, $text, $date, $image);
        } else {
            if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
                $image = $this->getImg();
            } else {
                $image = null;
            }
            $this->articleRepository->addArticle($title, $text, $date, $image);
        }
        header('Location: ' . Url::getRoot() . '/home/default');
        die ();
    }

    public function delete(): void
    {
        $id = (int)$_GET['id'];
        $article = $this->articleRepository->getById($id);
        $imagePath = $article['image'];
        if ($imagePath) {
            $this->deleteImage($imagePath);
        }
        $this->articleRepository->deleteArticle($id);

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
        $likes = $this->articlesLikesRepository->howManyLikes($id);
        $user = Auth::getUser();
        $userId = $user['id'];
        $isLiked = Auth::getUser() ? $this->articlesLikesRepository->isLiked($id, $userId) : false;

        $article += ['likesCount' => $likes, 'isLiked' => $isLiked];

        View::render('article', $article);
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

    private function getImg(): string
    {
        $image = uniqid() . '.png';
        $destinationDir = getcwd() . "/images" . '/' . $image;
        move_uploaded_file($_FILES['inputfile']['tmp_name'], $destinationDir);
        return $image;
    }

    private function deleteImage(string $imagePath): void
    {
        $destinationDir = getcwd() . "/images/" . $imagePath;
        unlink($destinationDir);
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
}