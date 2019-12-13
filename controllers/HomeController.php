<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;

class HomeController
{
    function default()
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();

        include 'pages/home.php';
    }
}
