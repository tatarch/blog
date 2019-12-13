<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;

class ArticlesController
{
    function form()
    {
        include 'pages/form.php';
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

    function view()
    {
        $id =(int) $_GET['id'];
        if ($id<0) {
            throw new \Exception();
        }
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->getById($id);
        include 'pages/article.php';
    }
}