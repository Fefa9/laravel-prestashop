<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Protechstudio\PrestashopWebService\PrestashopWebService;
use Illuminate\Support\Facades\Log;

class PrestaShopController extends Controller
{
    protected $prestashop;

    public function __construct()
    {
        Log::info('Initializing PrestaShop Webservice');
        $this->prestashop = new PrestashopWebService(
            env('PRESTASHOP_API_URL'),
            env('PRESTASHOP_API_KEY')
        );
    }

    // Méthode pour obtenir un produit par ID
    public function getProduct($id)
    {
        try {
            Log::info("Fetching product with ID: {$id}");
            $product = $this->prestashop->get(['resource' => 'products', 'id' => $id]);
            Log::info("Product fetched successfully: ", $product);
            return response()->json($product);
        } catch (\Exception $e) {
            Log::error("Error fetching product with ID {$id}: {$e->getMessage()}");
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Méthode pour obtenir tous les produits
    public function getAllProducts()
    {
        try {
            Log::info("Fetching all products");
            $products = $this->prestashop->get(['resource' => 'products']);
            Log::info("All products fetched successfully");
            return response()->json($products);
        } catch (\Exception $e) {
            Log::error("Error fetching products: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to fetch products', 'message' => $e->getMessage()], 500);
        }
    }
}


