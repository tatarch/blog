<?php

require 'repositories/ArticleRepository.php';
require 'repositories/UserRepository.php';

$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);

if (!empty($urlParts[1])) {
    if (file_exists('controllers/' . $urlParts[1] . 'Controller.php')) {
        require 'controllers/' . $urlParts[1] . 'Controller.php';
        $className = $urlParts[1] . 'Controller';
        $controller = new $className;
    } else {
        echo 'Not Found';
        die();
    }

} else {
    require 'controllers/HomeController.php';
    $controller = new HomeController();
}

if (isset($urlParts[2])) {
    $method = $urlParts[2];
    if (method_exists($controller, $method)) {
        try {
            $controller->$method();
        } catch (Exception $e) {
            throw $e;
            die('NOT FOUND');
        }

    } else {
        die('Method not exists: ' . $method);
    }
} else {
    $controller->default();
}
