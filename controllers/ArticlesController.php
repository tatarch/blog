<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Views\View;

class ArticlesController
{
    function form()
    {
        View::render('form', []);
    }

    function save()
    {
        $title = $_POST['usertitle'];
        $text = $_POST['usertext'];
        $articleRepository = new ArticleRepository();
        $articleRepository->addArticle($title, $text);
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