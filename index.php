<?php

//if (!empty($_POST['usertitle']) && !empty($_POST['usertext'])) {
//    $title = $_POST['usertitle'];
//    $text = $_POST['usertext'];
//    $articlesRepository->addArticle($title, $text);
//
//    header('Location: ' . $_SERVER['HTTP_REFERER']);
//    die;
//}
require 'repositories/ArticleRepository.php';

$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);
if (file_exists('controllers/' . $urlParts[1] . 'Controller.php')) {
    require 'controllers/' . $urlParts[1] . 'Controller.php';
    $className = $urlParts[1] . 'Controller';
    $controller = new $className;
} else {
    echo 'Not Found';
    die();
}

$method = $urlParts[2];
if (method_exists($controller, $method)) {
    $controller->$method();
}
