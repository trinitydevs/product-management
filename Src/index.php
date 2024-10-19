<?php
namespace App\Server;
use App\Server\Controller\LogController;
use App\Server\Controller\ProductController;
use App\Server\Model\Product;
include_once(__DIR__.'/../vendor/autoload.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: *");

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri_splited = explode('/',$uri);

if(count($uri_splited)==3){
    $request_data = [
        "service"=>$uri_splited[1],
        "id"=>$uri_splited[2]
    ];
} else {
    $request_data = [
        "service"=>$uri_splited[1]
    ];
}

switch ($method) {
    case 'GET':
        switch ($request_data['service']) {
            case 'products':
                
                if(isset($request_data['id'])){
                    $product = new Product();
                    $product->setId($request_data['id']);
                    $response = ProductController::get($product);
                    echo json_encode($response);
                    break;
                }
                
                $response = ProductController::get(null);
                echo json_encode($response);
                break;
            
            case 'logs':
                $logs = LogController::getLogs();
                echo json_encode($logs);
                break;
        }
        
        break;
    
    case 'POST':
        $data = json_decode(file_get_contents('php://input'));
        $product = new Product();
        $product->setName($data->nameProduct);
        $product->setDesc($data->descProduct);
        $product->setStock($data->stockProduct);
        $product->setPrice($data->priceProduct);
        $product->setUserInsert(1);
        $response = ProductController::post($product);
        echo json_encode($response);

        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'));
        $product = new Product();
        $product->setId($request_data['id']);
        $product->setName($data->nameProduct);
        $product->setDesc($data->descProduct);
        $product->setStock($data->stockProduct);
        $product->setPrice($data->priceProduct);
        $product->setUserInsert(1);
        $response = ProductController::put($product);
        echo json_encode($response);

        break;

    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'));
        $product = new Product();
        $product->setId($request_data['id']);
        $product->setUserInsert(1);
        $response = ProductController::delete($product);
        echo json_encode($response);

        break;
}