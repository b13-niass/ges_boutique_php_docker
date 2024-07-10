<?php

use Boutique\Core\Routes;

function dd($data)
{
    echo "<pre >";
    var_dump($data);
    echo "</pre>";
    die();
}

function removeTrailingSlash($string)
{
    return rtrim($string, '/');
}

function replaceMultipleSlashes($url)
{
    return removeTrailingSlash(preg_replace('#/+#', '/', $url));
}

require_once dirname(__DIR__) . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$router = new Routes();

$uri = replaceMultipleSlashes($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

/**
 * Début Vrai Routes
 */

// Normalize URI by removing multiple slashes

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

// require_once "../router/router.php";

// require_once "../router/web.php";


// preg_match("/[a-d]/", "abdou", $result);
// preg_match("/[^a-d]/", "abdou", $result);
// preg_match_all("/./", "ssss\n", $result);
// preg_match("/\d/", "10LLs34", $result);
// preg_match_all("/\d/", "10LLs34", $result);
// preg_match_all("/[^0-9]/", "10LLs34", $result);
// preg_match_all("/\D/", "10LLs34", $result);
// preg_match_all("/[a-d]/", "abdou", $result);

// function callFunc1(Closure $closure)
// {
//     $closure();
// }

// function callFunc2(callable $callback)
// {
//     $callback();
// }

// function xy()
// {
//     echo 'Hello, World!';
// }

// callFunc2("xy");
// callFunc1(function () {
//     echo "teste";
// });
