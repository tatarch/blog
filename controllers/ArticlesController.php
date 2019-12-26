<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Views\View;

class ArticlesController
{
    function form()
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $articleRepository = new ArticleRepository();
            $article = $articleRepository->getById($id);

            View::render('form', $article);
        } else {
            View::render('form', []);
        }
    }

    function save()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $articleRepository = new ArticleRepository();
        $date = $this->datecreate();

        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];
            $article = $articleRepository->getById($id);
            if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
                if(isset($article['image'])) {
                    $this->delateImage($articleRepository, $id);
                }
                $image = $this->moveImg();
            } else {
                $image = $article['image'];
            }
            $articleRepository->updateArticle($id, $title, $text, $date, $image);
        } else {
            if (isset($_FILES) && $_FILES['inputfile']['error'] == 0) { // Проверяем, загрузил ли пользователь файл
                $image = $this->moveImg();
            } else {
                $image = null;
            }
            $articleRepository->addArticle($title, $text, $date, $image);
        }
        header('Location: http://blog.local/home/default');
        die;
    }

    function datecreate()
    {
        if (!empty($_POST['date'])) {
            $timestamp = strtotime($_POST['date']);
            $date = date('Y-m-d H:i:s', $timestamp);

        } else {
            $date = date('Y-m-d H:i:s');
        }
        return $date;
    }

    function moveImg()
    {
        $image = uniqid() . '.png';
        $destiationdir = getcwd() . "/images" . '/' . $image;
        move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiationdir);
        return $image;
    }

    function delate()
    {
        $id = (int)$_GET['id'];
        $articleRepository = new ArticleRepository();
        $this->delateImage($articleRepository, $id);
        $articleRepository->delateArticle($id);

        header('Location: http://blog.local/home/default');
        die;
    }

    function delateImage($articleRepository, $id)
    {
        $article = $articleRepository->getById($id);
        if ($article['image'] != null) {
            $destiationdir = getcwd() . "/images" . '/' . $article['image'];
            unlink($destiationdir);
        }
    }

    function view()
    {
        $id = (int)$_GET['id'];
        if ($id < 0) {
            throw new \Exception();
        }
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->getById($id);

        View::render('article', $article);
    }

    function savefile()
    {


    }

}