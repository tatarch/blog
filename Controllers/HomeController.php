<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticlesImagesRepository;
use App\Views\View;

class HomeController
{
    public function default(): void
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();
        $articlesImagesRepository = new ArticlesImagesRepository();
        foreach ($articles as $key => $article) {
            $articles[$key]['images'] = $articlesImagesRepository->getById($article['id']);
        }
        // пробрасывай сюда ['articles' => $articles]
        View::render('home', $articles);
    }
}
