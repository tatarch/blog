<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Views\View;

class HomeController
{
    public function default(): void
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();

        View::render('home', $articles);
    }
}