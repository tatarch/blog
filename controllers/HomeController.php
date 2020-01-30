<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Views\View;

class HomeController
{
    public function default()
    {
        $user = Auth::getUser();
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();

        // не нужно передавать во вьюху текущего пользователя. ты это можешь сделать внутри вьюхи
        View::render('home', $articles, $user['name']);
    }
}
