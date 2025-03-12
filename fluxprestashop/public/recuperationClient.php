<html>
<head>
    <title>CRUD Tutorial - Retrieve example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Customers</h1>
    <?php
    define('DEBUG', true);
    define('PS_SHOP_PATH', 'http://localhost:8080/');
    define('PS_WS_AUTH_KEY', '8IFRIW5XG2AE4YV64QM67XMFA13F4PAT');
    require_once(__DIR__ . '/../vendor/prestashop/prestashop-webservice-lib/PSWebServiceLibrary.php');

    try {
        $webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
        $opt['resource'] = 'customers';
        if (isset($_GET['id'])) {
            $opt['id'] = (int)$_GET['id'];
        }
        $xml = $webService->get($opt);
        $resources = $xml->children()->children();
    } catch (PrestaShopWebserviceException $e) {
        $trace = $e->getTrace();
        if ($trace[0]['args'][0] == 404) echo 'Bad ID';
        else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
        else echo 'Other error<br />'.$e->getMessage();
    }

    echo '<h1>Customers ';
    if (isset($_GET['id']))
        echo 'Details';
    else
        echo 'List';
    echo '</h1>';

    if (isset($_GET['id']))
        echo '<a href="?" class="btn btn-primary mb-3">Return to the list</a>';

    echo '<table class="table table-bordered">';
    if (isset($resources)) {
        if (!isset($_GET['id'])) {
            echo '<thead class="thead-dark"><tr><th>ID</th><th>More</th></tr></thead><tbody>';
            foreach ($resources as $resource) {
                echo '<tr><td>'.$resource->attributes().'</td><td>'.
                     '<a href="?id='.$resource->attributes().'" class="btn btn-info">Retrieve</a>'.
                     '</td></tr>';
            }
            echo '</tbody>';
        } else {
            echo '<thead class="thead-dark"><tr><th>Property</th><th>Value</th></tr></thead><tbody>';
            foreach ($resources as $key => $resource) {
                echo '<tr>';
                echo '<th>'.$key.'</th><td>'.$resource.'</td>';
                echo '</tr>';
            }
            echo '</tbody>';
        }
    }
    echo '</table>';
    ?>
</div>
</body>
</html>
