<?php

use Boutique\App\Controller\BoutiquierController;
use Boutique\App\Controller\ErrorController;
use Boutique\Core\Routes;
use \Boutique\App\Controller\SecurityController;
use \Boutique\App\Controller\ClientController;

function view($fileName)
{
    require_once '../views/' . $fileName . '.html.php';
}

$webRoutes = new Routes();

// $webRoutes->addRoute('/dette/add', ["controller" => "ExoController", "action" => "store"]);
// $webRoutes->addRoute('/dette/add/{id}', ["controller" => "ExoController", "action" => "store1"]);
// $webRoutes->addRoute('/dette/add/{id}/{name}', ["controller" => "ExoController", "action" => "store2"]);
// $webRoutes->addRoute('/dette/add/{id}/{name}/{code}', ["controller" => "ExoController", "action" => "store3"]);
// $webRoutes->addRoute('/error404', ["controller" => "ErrorController", "action" => "error404"]);
// $webRoutes->addRoute('/dette/list', function () {
//     view('l_dettes');
// });

// dd(BoutiquierController::class);

$webRoutes->addGetRoute('', ["controller" => SecurityController::class, 'action' => 'login']);
$webRoutes->addGetRoute('/login', ["controller" => SecurityController::class, 'action' => 'login']);
$webRoutes->addGetRoute('/client/dettes', ["controller" => ClientController::class, 'action' => 'index'])->middleware('auth');
$webRoutes->addGetRoute('/dettes', ["controller" => BoutiquierController::class, 'action' => 'index'])->middleware('auth');
$webRoutes->addGetRoute('/dettes/add', ["controller" => BoutiquierController::class, 'action' => 'addDetteIndex'])->middleware('auth');
$webRoutes->addGetRoute('/dettes/liste', ["controller" => BoutiquierController::class, 'action' => 'listeDetteIndex'])->middleware('auth');
$webRoutes->addGetRoute('/dettes/liste/page/{page}', ["controller" => BoutiquierController::class, 'action' => 'listeDetteIndexPage'])->middleware('auth');
$webRoutes->addGetRoute('/dettes/add/new', ["controller" => BoutiquierController::class, 'action' => 'addDette'])->middleware('auth');
// $webRoutes->addGetRoute('/dettes/paiement', ["controller" => BoutiquierController::class, 'action' => 'addDette']);
$webRoutes->addGetRoute('/dettes/paiement/{id}', ["controller" => BoutiquierController::class, 'action' => 'paiementFormShow'])->middleware('auth');
$webRoutes->addGetRoute('/dettes/paiement/{id}/articles', ["controller" => BoutiquierController::class, 'action' => 'paiementArticles'])->middleware('auth');
// $webRoutes->addGetRoute('/error404', ["controller" => ErrorController::class, "action" => "paiementFormShow"]);

// Notion de slug

$webRoutes->addPostRoute('/dettes/client', ["controller" => BoutiquierController::class, 'action' => 'addClient'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/client/search', ["controller" => BoutiquierController::class, 'action' => 'searchClient'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/add/search', ["controller" => BoutiquierController::class, 'action' => 'addDetteSearchRef'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/add/article', ["controller" => BoutiquierController::class, 'action' => 'addDetteArticle'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/liste/filtre', ["controller" => BoutiquierController::class, 'action' => 'listeDetteFiltre'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/paiement', ["controller" => BoutiquierController::class, 'action' => 'paiementForm'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/paiement/add', ["controller" => BoutiquierController::class, 'action' => 'paiementAdd'])->middleware('auth');
$webRoutes->addPostRoute('/dettes/paiement/liste', ["controller" => BoutiquierController::class, 'action' => 'paiementListe'])->middleware('auth');
$webRoutes->addPostRoute('/login', ["controller" => SecurityController::class, 'action' => 'login']);

return $webRoutes;
