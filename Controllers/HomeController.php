<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Repositories\ArticlesImagesRepository;
use App\Repositories\ArticlesTagsRepository;
use App\Views\View;

class HomeController
{
    public function default(): void
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->getArticles();
        $articlesImagesRepository = new ArticlesImagesRepository();
        $articlesTagsRepository = new ArticlesTagsRepository();
        foreach ($articles as $key => $article) {
            $articles[$key]['images'] = $articlesImagesRepository->getById($article['id']);
            $articles[$key]['tags'] = $articlesTagsRepository->getByArticleId($article['id']);
        }

        View::render('home', ['articles' => $articles]);
    }
}
