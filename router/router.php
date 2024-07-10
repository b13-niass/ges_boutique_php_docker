<?php

use Boutique\App\Controller\BoutiquierController;
use Boutique\Core\Route;


Route::get('/dettes', ['index', BoutiquierController::class]);
Route::get('/dettes/add', ['addDetteIndex', BoutiquierController::class]);
Route::get('/dettes/liste', ['listeDetteIndex', BoutiquierController::class]);
Route::get('/dettes/add/new', ['addDette', BoutiquierController::class]);

Route::post('/dettes/client', ['addClient', BoutiquierController::class]);
Route::post('/dettes/client/search', ['searchClient', BoutiquierController::class]);
Route::post('/dettes/add/search', ['addDetteSearchRef', BoutiquierController::class]);
Route::post('/dettes/add/article', ['addDetteArticle', BoutiquierController::class]);
Route::post('/dettes/liste/filtre', ['listeDetteFiltre', BoutiquierController::class]);
Route::post('/dettes/paiement', ['paiementForm', BoutiquierController::class]);
Route::post('/dettes/paiement/add', ['paiementAdd', BoutiquierController::class]);
Route::post('/dettes/paiement/liste', ['paiementListe', BoutiquierController::class]);

// To resolve the current request
try {
    Route::resolve();
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
