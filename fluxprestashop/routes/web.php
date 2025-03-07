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

// route api clients
Route::get('api/customers/{id}', [PrestaShopController::class, 'getCustomer']);

// route de test
Route::get('/test-webservice', function () {
    try {
        $webservice = new \PrestaShopWebservice(
            env('PRESTASHOP_API_URL'),
            env('PRESTASHOP_API_KEY')
        );
        return response()->json(['message' => 'Webservice initialized successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
