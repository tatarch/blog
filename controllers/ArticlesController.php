<?php

class ArticlesController
{
    function default()
    {
        echo 'Article contr m default';
    }

    function form()
    {
        include 'pages/form.html';
        if (!empty($_POST['usertitle']) && !empty($_POST['usertext'])) {
            $this->save();
        }
    }
    function save(){
        $title = $_POST['usertitle'];
        $text = $_POST['usertext'];
        $articlesRepository->addArticle($title, $text);
    }
}