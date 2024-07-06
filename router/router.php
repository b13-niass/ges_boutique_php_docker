<?php

use Boutique\App\Controller\BoutiquierController;
use Boutique\Core\Route;


Route::get('/dettes', ['index', BoutiquierController::class]);
Route::post('/dettes', ['store', BoutiquierController::class]);

// To resolve the current request
try {
    Route::resolve();
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
