<html>
<head>
        <title>Liste des clients</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<?php
/*
* 2007-2020 PrestaShop SA and Contributors
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
* PrestaShop Webservice Library
* @package PrestaShopWebservice
*/

// Here we define constants /!\ You need to replace this parameters
define('DEBUG', false);											// Debug mode
define('PS_SHOP_PATH', 'http://localhost:8080/');		// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', '8IFRIW5XG2AE4YV64QM67XMFA13F4PAT');	// Auth key (Get it in your Back Office)
require_once(__DIR__ . '/../vendor/prestashop/prestashop-webservice-lib/PSWebServiceLibrary.php');
('../PSWebServiceLibrary.php');

// Here we make the WebService Call
try
{
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	
	// Here we set the option array for the Webservice : we want customers resources
	$opt['resource'] = 'customers';
	
	// Call
	$xml = $webService->get($opt);

	// Here we get the elements from children of customers markup "customer"
	$resources = $xml->customers->children();
}
catch (PrestaShopWebserviceException $e)
{
	// Here we are dealing with errors
	$trace = $e->getTrace();
	if ($trace[0]['args'][0] == 404) echo 'Bad ID';
	else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
	else echo 'Other error';
}

// rajout pour Bootstrap
echo "<div class='container'>";

// We set the Title
echo "<h1 class='mt-5'>Liste des clients</h1>";

echo '<table class="table table-bordered mt-3">';
echo '<thead class="thead-dark"><tr><th>ID</th><th>First Name</th><th>Last Name</th></tr></thead>';
echo '<tbody>';
// if $resources is set we can lists element in it otherwise do nothing cause there's an error
if (isset($resources))
{
		//echo '<tr><th>Id</th></tr>';
		foreach ($resources as $resource)
		{
            $id = $resource->attributes()->id;
            $firstName = $resource->firstname;
            $lastName = $resource->lastname;
            echo '<tr><td>'.$id.'</td><td>'.$firstName.'</td><td>'.$lastName.'</td></tr>';
        }
}
echo '</tbody></table>';
echo "</div>";
?>
</body></html>
