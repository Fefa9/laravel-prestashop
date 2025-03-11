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

            // Options pour la requête
            $opt = [
                'resource' => 'products',
                'id' => $id,
            ];

            // Effectuer la requête et obtenir la réponse en XML
            $xmlResponse = $this->prestashop->get($opt);

            // Vérifier si la réponse XML est valide
            if ($xmlResponse === false) {
                throw new \Exception("Invalid XML response");
            }

            // Enregistrer la réponse brute pour le débogage
            Log::info("Raw XML response: {$xmlResponse}");

            // Charger et parser la réponse XML
            $productXml = simplexml_load_string($xmlResponse);

            // Vérifier si le chargement du XML a réussi
            if ($productXml === false) {
                throw new \Exception("Failed to parse XML");
            }

            // Convertir l'objet SimpleXMLElement en tableau associatif
            $productArray = json_decode(json_encode((array)$productXml), true);

            // Ajouter une instruction de débogage pour examiner la structure du tableau
            Log::info("Product array structure: ", $productArray);

            // Vérifier et accéder aux données du produit
            $product = $productArray['product'] ?? [];

            // Accéder aux champs `name` et `description`
            $productName = $product['name'] ?? 'Nom non disponible';
            $productDescription = $product['description'] ?? 'Description non disponible';
            $productPrice = $product['price'] ?? 'Prix non disponible';

            // Passer les données du produit à la vue
            return view('products.show', compact('productName', 'productDescription', 'productPrice'));
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
                'id' => $id,
                'headers' => [
                    'output_format' => 'JSON'                ]
            ];
            $xml = $this->prestashop->get($opt);
            $customer = json_decode(json_encode((array)simplexml_load_string($xml)), true);
            Log::info("Customer fetched successfully: ", $customer);
            return response()->json($customer);
            return view('customerById', ['customer' => $customer]);
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

    public function updateProductPrice(Request $request, $id)
{
    try {
        Log::info("Updating price for product with ID: {$id}");

        // Options pour la requête
        $opt = [
            'resource' => 'products',
            'id' => $id,
        ];

        // Effectuer la requête et obtenir la réponse en XML
        $xmlResponse = $this->prestashop->get($opt);

        // Charger la réponse XML
        $productXml = simplexml_load_string($xmlResponse);

        // Modifier le prix
        if (isset($productXml->product->price)) {
            $productXml->product->price = (float)$request->input('price');
        }

        // Enregistrer les modifications
        $opt['putXml'] = $productXml->asXML();
        $this->prestashop->edit($opt);

        Log::info("Price updated successfully for product with ID: {$id}");

        // Rediriger vers la vue avec le message de succès
        return redirect()->route('getProduct', $id)->with('success', 'Le prix a été mis à jour avec succès.');
    } catch (\Exception $e) {
        Log::error("Error updating price for product with ID {$id}: {$e->getMessage()}");
        return redirect()->route('getProduct', $id)->with('error', 'Erreur lors de la mise à jour du prix.');
    }
}



}


