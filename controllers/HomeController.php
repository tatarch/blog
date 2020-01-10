<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Views\View;
use App\Controllers\Auth;

class HomeController
{
    public function default()
    {
        $user=Auth::getUser();
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();

        View::render('home', $articles, $user['name']);
    }
}
