<?php

require 'vendor/autoload.php';

session_start();
$url = $_SERVER['REQUEST_URI'];
$urlParts = explode('/', $url);

if (!empty($urlParts[1])) {
    if (file_exists('Controllers/' . ucfirst($urlParts[1]) . 'Controller.php')) {
        $className = 'App\Controllers\\' . ucfirst($urlParts[1]) . 'Controller';
        $controller = new $className();
    } else {
        echo 'Not Found';
        die();
    }

} else {
    $controller = new \App\Controllers\HomeController();
}

if (isset($urlParts[2])) {
    $method = $urlParts[2];
    if (method_exists($controller, $method)) {
        $controller->$method();
    } else {
        die('Method not exists: ' . $method);
    }
} else {
    $controller->default();
}
