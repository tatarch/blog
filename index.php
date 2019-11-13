<?php

//if (!empty($_POST['usertitle']) && !empty($_POST['usertext'])) {
//    $title = $_POST['usertitle'];
//    $text = $_POST['usertext'];
//    $articlesRepository->addArticle($title, $text);
//
//    header('Location: ' . $_SERVER['HTTP_REFERER']);
//    die;
//}

$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);
if (file_exists('controllers/' . $urlParts[1] . 'Controller.php')) {
    $className = $urlParts[1] . 'Controller';
    require 'controllers/' . $urlParts[1] . 'Controller.php';
    $controller = new $className;
} else {
    echo 'Not Found';
    die();
}
if(method_exists($controller, $urlParts[2])){
    $controller->$urlParts[2]();
}
require "controllers/HomeController.php";

$controller = new HomeController();
$controller->default();
