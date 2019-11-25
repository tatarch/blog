<?php

class ArticlesController
{

    function form()
    {
        include 'pages/form.html';
            $this->save();

    }

    function save()
    {
        $title = $_POST['usertitle'];
        $text = $_POST['usertext'];
        $articleRepository = new ArticleRepository();
        $articleRepository->addArticle($title, $text);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
}