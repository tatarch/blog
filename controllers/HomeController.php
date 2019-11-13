<?php

class HomeController
{
    function default()
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();

        include 'pages/home.php';
    }
}
