<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestaShopController;

// Route  par défaut
//Route::get('/', function () {
//    return view('welcome');
//});

// Route principale 
Route::get('/', function () {
    return view('home');       // Charge la vue home.blade.php
})->name('home');              // le nom home à la route d'accueil


// Route API pour obtenir un produit par ID
Route::get('/api/products/{id}', [PrestaShopController::class, 'getProduct']);

// Route API pour obtenir tous les produits
Route::get('/api/products', [PrestaShopController::class, 'getAllProducts']);

// route api clients
Route::get('api/customers/{id}', [PrestaShopController::class, 'getCustomer']);

// update prix
Route::post('/products/{id}/updatePrice', 'PrestaShopController@updateProductPrice')->name('updateProductPrice');


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

// Route pour afficher les clients
Route::get('/customers', [PrestaShopController::class, 'listCustomers']);


Route::get('/customer-details/{id}', [PrestaShopController::class, 'getCustomerDetails']);


Route::get('/products', [PrestaShopController::class, 'listProducts'])->name('products.list');
                                                                      // donne un nom à la route  