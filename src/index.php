<?php
namespace Vendor\Development;
require_once '../vendor/autoload.php';

use Vendor\Development\Controller\Logs;
use Vendor\Development\Controller\ProductsController;
use Vendor\Development\Model\Products;
use Vendor\Development\Database\Database;



$logs = new Logs();

$database = new Database();
$pdo = $database->connect(); 
$products = new Products($pdo);

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

function loadView($viewName)
{
    include __DIR__ . "/views/{$viewName}.php";
}

loadView('productManagement');


switch ($method) {
    case 'GET':
        $products->get();
        break;        
    case 'POST':
        $products->post();
        break;
    case 'PUT':
        $products->put();
        break;
    case 'DELETE':
        $products->delete();
        break;
    default:
        echo "Método HTTP não suportado.";
        break;
}
