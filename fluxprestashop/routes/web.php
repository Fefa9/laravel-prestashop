<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestaShopController;

// Route principale
Route::get('/', function () {
    return view('welcome');
});

// Route API pour obtenir un produit par ID
Route::get('/api/products/{id}', [PrestaShopController::class, 'getProduct']);

// Route API pour obtenir tous les produits
Route::get('/api/products', [PrestaShopController::class, 'getAllProducts']);