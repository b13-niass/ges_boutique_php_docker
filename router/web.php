<?php

use Boutique\App\Controller\BoutiquierController;
use Boutique\App\Controller\ErrorController;
use Boutique\Core\Routes;

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

$webRoutes->addGetRoute('/dettes', ["controller" => BoutiquierController::class, 'action' => 'index']);
$webRoutes->addGetRoute('/dettes/add', ["controller" => BoutiquierController::class, 'action' => 'addDetteIndex']);
$webRoutes->addGetRoute('/dettes/liste', ["controller" => BoutiquierController::class, 'action' => 'listeDetteIndex']);
$webRoutes->addGetRoute('/dettes/add/new', ["controller" => BoutiquierController::class, 'action' => 'addDette']);
// $webRoutes->addGetRoute('/dettes/paiement', ["controller" => BoutiquierController::class, 'action' => 'addDette']);
$webRoutes->addGetRoute('/dettes/paiement/{id}', ["controller" => BoutiquierController::class, 'action' => 'paiementFormShow']);
// $webRoutes->addGetRoute('/error404', ["controller" => ErrorController::class, "action" => "paiementFormShow"]);

$webRoutes->addPostRoute('/dettes/client', ["controller" => BoutiquierController::class, 'action' => 'addClient']);
$webRoutes->addPostRoute('/dettes/client/search', ["controller" => BoutiquierController::class, 'action' => 'searchClient']);
$webRoutes->addPostRoute('/dettes/add/search', ["controller" => BoutiquierController::class, 'action' => 'addDetteSearchRef']);
$webRoutes->addPostRoute('/dettes/add/article', ["controller" => BoutiquierController::class, 'action' => 'addDetteArticle']);
$webRoutes->addPostRoute('/dettes/liste/filtre', ["controller" => BoutiquierController::class, 'action' => 'listeDetteFiltre']);
$webRoutes->addPostRoute('/dettes/paiement', ["controller" => BoutiquierController::class, 'action' => 'paiementForm']);
$webRoutes->addPostRoute('/dettes/paiement/add', ["controller" => BoutiquierController::class, 'action' => 'paiementAdd']);
$webRoutes->addPostRoute('/dettes/paiement/liste', ["controller" => BoutiquierController::class, 'action' => 'paiementListe']);

return $webRoutes;
