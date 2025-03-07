<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PrestaShopWebservice\PrestaShopWebservice;


class PrestaShopController extends Controller
{
    protected $prestashop;

    public function __construct()
    {
        Log::info('Initializing PrestaShop Webservice');
        $this->prestashop = new \PrestaShopWebservice(
            env('PRESTASHOP_API_URL'),
            env('PRESTASHOP_API_KEY')
        );
    }

    // Méthode pour obtenir un produit par ID
    public function getProduct($id)
    {
        try {
            Log::info("Fetching product with ID: {$id}");
            $opt = [
                'resource' => 'products',
                'id' => $id
            ];
            $xml = $this->prestashop->get($opt);
            $product = json_decode(json_encode((array)simplexml_load_string($xml)), true);
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
            $opt = ['resource' => 'products'];
            $xml = $this->prestashop->get($opt);
            $products = json_decode(json_encode((array)simplexml_load_string($xml)), true);
            Log::info("All products fetched successfully");
            return response()->json($products);
        } catch (\Exception $e) {
            Log::error("Error fetching products: {$e->getMessage()}");
            return response()->json(['error' => 'Failed to fetch products', 'message' => $e->getMessage()], 500);
        }
    }

    public function getCustomer($id)
    {
        try {
            Log::info("Fetching customer with ID: {$id}");
            $opt = [
                'resource' => 'customers',
                'id' => $id
            ];
            $xml = $this->prestashop->get($opt);
            $customer = json_decode(json_encode((array)simplexml_load_string($xml)), true);
            Log::info("Customer fetched successfully: ", $customer);
            return response()->json($customer);
        } catch (\Exception $e) {
            Log::error("Error fetching customer with ID {$id}: {$e->getMessage()}");
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function testWebservice()
    {
        try {
            $webservice = new \PrestaShopWebservice(
                env('PRESTASHOP_API_URL'),
                env('PRESTASHOP_API_KEY')
            );
            return response()->json(['message' => 'Webservice initialized successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}


