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

        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];
            $articleRepository->updateArticle($id, $title, $text);

        } else {
            if (!empty($_POST['date'])) {
                $timestamp = strtotime($_POST['date-']);
                $date = date('Y-m-d H:i:s', $timestamp);

            } else {
                $date = date('Y-m-d H:i:s');
            }
            $articleRepository->addArticle($title, $text, $date);
        }
        header('Location: http://blog.local/home/default');
        die;
    }

    function delate()
    {
        $id = (int)$_GET['id'];

        $articleRepository = new ArticleRepository();
        $articleRepository->delateArticle($id);
        header('Location: http://blog.local/home/default');
        die;
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

}