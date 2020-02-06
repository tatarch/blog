<?php

namespace App\Controllers;

use App\Database\Connectors\MysqlConnector;
use App\Repositories\ArticleRepository;
use App\Repositories\ArticlesLikesRepository;
use App\System\Auth;
use App\Views\View;

class ArticlesController
{
    private $articleRepository;

    function __construct()
    {
        $this->articleRepository = new ArticleRepository();
    }

    public function form()
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $article = $this->articleRepository->getById($id);

            View::render('form', $article);
        } else {
            View::render('form');
        }
    }

    public function save()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $date = $this->getDate();

        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];
            $article = $this->articleRepository->getById($id);
            if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
                if (isset($article['image'])) {
                    $this->deleteImage($this->articleRepository, $id);
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
        header('Location: http://blog.local/home/default');
        die ();
    }

    public function delete()
    {
        $id = (int)$_GET['id'];
        $this->deleteImage($this->articleRepository, $id);
        $this->articleRepository->deleteArticle($id);

        header('Location: http://blog.local/home/default');
        die ();
    }

    public function view()
    {
        $id = (int)$_GET['id'];
        if ($id < 0) {
            throw new \Exception();
        }
        $article = $this->articleRepository->getById($id);

        View::render('article', $article);
    }

    private function getDate()
    {
        if (!empty($_POST['date'])) {
            $timestamp = strtotime($_POST['date']);
            $date = date('Y-m-d H:i:s', $timestamp);
        } else {
            $date = date('Y-m-d H:i:s');
        }
        return $date;
    }

    private function getImg()
    {
        $image = uniqid() . '.png';
        $destiationdir = getcwd() . "/images" . '/' . $image;
        move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiationdir);
        return $image;
    }

    private function deleteImage($articleRepository, $id)
    {
        $article = $articleRepository->getById($id);
        if ($article['image'] != null) {
            $destiationdir = getcwd() . "/images" . '/' . $article['image'];
            unlink($destiationdir);
        }
    }

    public function like ()
    {
        $articleId=(int)$_GET['id'];
        $user = Auth::getUser();
        $userId=$user['id'];

        $articlesLikesRepository = new ArticlesLikesRepository();
        $isLiked = $articlesLikesRepository->isLiked($articleId, $userId);

        if ($isLiked != true) {
            $articlesLikesRepository1 = new ArticlesLikesRepository();
            $articlesLikesRepository1->addLike($articleId, $userId);

            $articlesLikesRepository2 = new ArticlesLikesRepository();
            $likes=$articlesLikesRepository2->howManyLikes($articleId);

            $this->articleRepository->likes($articleId, $likes);
        }

    }
}