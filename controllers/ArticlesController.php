<?php

namespace App\Controllers;

use App\Repositories\ArticleRepository;
use App\Views\View;

class ArticlesController
{
    function form()
    {
        if (!empty($_GET['id'])) {
            $id = (int)$_GET['id'];
            $articleRepository = new ArticleRepository();
            $article = $articleRepository->getById($id);

            View::render('form', $article);
        } else {
            View::render('form', []);
        }
    }

    function save()
    {
        $title = $_POST['title'];
        $text = $_POST['text'];
        $articleRepository = new ArticleRepository();

        if (!empty($_POST['id'])) {
            $id = (int)$_POST['id'];
            $articleRepository->updateArticle($id, $title, $text);

        } else {
            if (!empty($_POST['date'])) {
                $timestamp = strtotime($_POST['date']);
                $date = date('Y-m-d H:i:s', $timestamp);

            } else {
                $date = date('Y-m-d H:i:s');
            }
            $articleRepository->addArticle($title, $text, $date);
        }
        if(isset($_FILES) && $_FILES['inputfile']['error'] == 0){ // Проверяем, загрузил ли пользователь файл
            $destiation_dir =  __DIR__ ."/../images"; // Директория для размещения файла
            move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir.'/1.png' );
            echo 'File Uploaded'; // Оповещаем пользователя об успешной загрузке файла
        }
        else{
            echo 'No File Uploaded'; // Оповещаем пользователя о том, что файл не был загружен
        }
    }

    function delate()
    {
        $id = (int)$_GET['id'];

        $articleRepository = new ArticleRepository();
        $articleRepository->delateArticle($id);
        header('Location: http://blog.local/home/default');
        die;
    }

    function view()
    {
        $id = (int)$_GET['id'];
        if ($id < 0) {
            throw new \Exception();
        }
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->getById($id);

        View::render('article', $article);
    }

    function savefile ()
    {


    }

}