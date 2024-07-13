<?php

use Boutique\Core\Routes;

$router = new Routes();

$uri = replaceMultipleSlashes($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];


if (strpos($uri, '/api') === 0) {
    $apiRoutes = include '../router/api.php';
    foreach ($apiRoutes->getGetRoutes() as $route => $target) {
        $router->addGetRoute($route, $target);
    }
    foreach ($apiRoutes->getPostRoutes() as $route => $target) {
        $router->addPostRoute($route, $target);
    }
}

$webRoutes = include '../router/web.php';
foreach ($webRoutes->getGetRoutes() as $route => $target) {
    $router->addGetRoute($route, $target);
}
foreach ($webRoutes->getPostRoutes() as $route => $target) {
    $router->addPostRoute($route, $target);
}

$router->dispatch($uri, $method);