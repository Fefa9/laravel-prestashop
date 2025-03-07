<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $webservice = new PrestaShopWebservice(
        'https://example.com', 
        'your_api_key'
    );
    echo "Class loaded successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
