<?php

class ArticlesController
{

    function form()
    {
        include 'pages/form.html';

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
}