<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Log;
use PrestaShopWebservice\PrestaShopWebservice;

define('DEBUG', false);

class PrestaShopController extends Controller
{
    protected $prestashop;

    public function __construct()
    {
        //Log::info('Initializing PrestaShop Webservice');
        $this->prestashop = new \PrestaShopWebservice(
            env('PRESTASHOP_API_URL'),
            env('PRESTASHOP_API_KEY'),
            false // Désactiver le debug
        );
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

    

    public function listCustomers()
    {
        try {
            $webservice = new \PrestaShopWebservice(
                env('PRESTASHOP_API_URL'),
                env('PRESTASHOP_API_KEY')
            );

            $opt['resource'] = 'customers';
            $xml = $webservice->get($opt);
            $resources = $xml->customers->children();

            $customers = [];
            foreach ($resources as $resource) {
                $customers[] = [
                    'id' => (string)$resource->attributes()->id,
                    'firstname' => (string)$resource->firstname,
                    'lastname' => (string)$resource->lastname,
                ];
            }

            return view('customers.list', ['customers' => $customers]);
        } catch (\PrestaShopWebserviceException $e) {
            return view('customers.list', ['error' => $e->getMessage()]);
        }
    }

    public function getCustomerDetails($id)
{
    try {
        // Initialiser le webservice PrestaShop
        $webservice = new \PrestaShopWebservice(
            env('PRESTASHOP_API_URL'),
            env('PRESTASHOP_API_KEY'),
            false // Désactiver le debug
        );

        // Options pour récupérer un client spécifique
        $opt['resource'] = 'customers';
        $opt['id'] = $id; // ID du client à récupérer

        // Appeler le webservice
        $xml = $webservice->get($opt);

        // Récupérer les données du client
        $customer = $xml->customer;

        // Convertir les données en tableau
        $customerDetails = [
            'id' => (string)$customer->id,
            'firstname' => (string)$customer->firstname,
            'lastname' => (string)$customer->lastname,
            'email' => (string)$customer->email,
            'date_add' => (string)$customer->date_add,
            'date_upd' => (string)$customer->date_upd,
            // Ajoutez d'autres champs si nécessaires
        ];

        // Retourner la vue avec les détails du client
        return view('customers.details', ['customer' => $customerDetails]);
    } catch (\PrestaShopWebserviceException $e) {
        // Gestion des erreurs
        return view('customers.details', ['error' => $e->getMessage()]);
    }
}


public function listProducts()
{
    try {
        // Initialiser le webservice PrestaShop
        $webservice = new \PrestaShopWebservice(
            env('PRESTASHOP_API_URL'),
            env('PRESTASHOP_API_KEY'),
            false // Désactiver le debug
        );

        // Options pour récupérer les ressources "produits"
        $opt['resource'] = 'products';

        // Appel au webservice
        $xml = $webservice->get($opt);

        // Récupérer les éléments enfants du noeud "products"
        $resources = $xml->products->children();

        $products = [];
        foreach ($resources as $resource) {
            $id = (string)$resource->attributes()->id;

            // Récupérer les détails pour chaque produit
            $productDetails = $webservice->get(['resource' => 'products', 'id' => $id])->product;

            $products[] = [
                'id' => $id,
                'name' => (string)$productDetails->name->language[0], // Supposant une seule langue
                'price' => (string)$productDetails->price,
            ];
        }

        // Retourner une vue avec la liste des produits
        return view('products.list', ['products' => $products]);
    } catch (\PrestaShopWebserviceException $e) {
        // Gestion des erreurs
        return view('products.list', ['error' => $e->getMessage()]);
    }
}



}


