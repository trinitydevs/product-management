<?php
namespace Vendor\Development;
require_once '../vendor/autoload.php';

use Vendor\Development\Controller\ProductsController;
use Vendor\Development\Model\Products;
use Vendor\Development\Database\Database;

//$logs = new Logs();

$database = new Database();
$pdo = $database->connect();
$productsModel = new Products($pdo);
$productsController = new ProductsController($productsModel);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

function loadView($viewName, $data = [])
{
    extract($data); // Converte os índices do array $data em variáveis
    include __DIR__ . "/views/{$viewName}.php";
}

switch ($method) {
    case 'GET':
        $products = $productsController->get();

        $productDetails = null;
        if (isset($_GET['product'])) {
            $productId = $_GET['product'];
            $productDetails = $productsController->getProductDetails($productId);
        }

        loadView('productManagement', [
            'products' => $products,
            'productDetails' => $productDetails
        ]);
        break;

    case 'POST':
        (isset($_POST['_method']) && $_POST['_method'] === 'DELETE')
            ? $productsController->delete()
            : (isset($_POST['_method']) && $_POST['_method'] === 'PUT'
                ? $productsController->put()
                : $productsController->post());
        break;

    case 'DELETE':
        $productsController->delete();
        break;

    default:
        echo "Método HTTP não suportado.";
        break;
}
