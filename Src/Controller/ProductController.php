<?php
namespace App\Server\Controller;
use App\Server\Model\Product;
use App\Server\Model\Log;
use App\Server\Repository\ProductRepository;
use App\Server\Repository\LogRepository;

class ProductController {

    public static function get(null|Product $p){
        if($p){
            $product = ProductRepository::getById($p);
            if($product == false){
                return ['status' => false,
                'code' => 404,
                'message' => 'Não há nenhum produto registrado com o ID correspondente'];
            }
            return $product;
        }

        $products = ProductRepository::getAll();
        if($products == false){
            return ['status' => false,
            'code' => 404,
            'message' => 'Não há nenhum produto registrado'];
        }
        return $products;
    }

    public static function post(Product $p){
        
        if(strlen($p->getName())<3){
            return ['status'=> false,
            'code' => 401,
            'message' => 'Nome do produto muito curto'];
        }
        if($p->getPrice()<0){
            return ['status'=> false,
            'code' => 401,
            'message' => 'Preço do produto inexistente'];
        }
        if($p->getStock()<0){
            return ['status'=> false,
            'code' => 401,
            'message' => 'Número em estoque inexistente ou indevido'];
        }

        $response = ProductRepository::post($p);

        if(is_int($response)){
            $p->setId($response);
            $log = new Log();
            $log->setAction('Criação');
            $log->setUserInsert($p->getUserInsert());
            $log->setProduct($p);
            LogRepository::register($log);
        }

        return ['status' => true,
        'code' => 200,
        'mensagem' => 'Produto cadastrado com sucesso!'];
    }

    public static function put(Product $p){
        
        if(strlen($p->getName()) < 3){
            return ['status '=> false,
            'code' => 402,
            'message' => 'Nome do produto muito curto'];
        }
        if($p->getPrice() < 0){
            return ['status'=>false,'code'=>402,'message'=>'Preço do produto negativo.'];
        }
        if($p->getStock() < 0){
            return ['status' => false,
            'code' => 402,
            'message' => 'Número em estoque nulo ou negativo.'];
        }

        $response = ProductRepository::put($p);
        if($response == false){
            return ['status' => false,
            'code' => 501,
            'message' => 'Falha na atualização.'];
        }
        if(is_int($response)){
            $p->setId($response);
            $log = new Log();
            $log->setAction('Atualização');
            $log->setUserInsert($p->getUserInsert());
            $log->setProduct($p);
            LogRepository::register($log);
        }

        return ['status' => true,
        'code' => 201,
        'message' => 'Produto atualizado com sucesso!'];

    }

    public static function delete(Product $p){

        $response = ProductRepository::delete($p);
        if($response == false){
            return ['status' => false,
            'code' => 502,
            'message' =>' Falha na exclusão do produto!'];
        }
        $log = new Log();
        $log->setAction('Exclusão');
        $log->setUserInsert($p->getUserInsert());
        $log->setProduct($p);
        LogRepository::register($log);

        return ['status' => true,
        'code' => 202,
        'mensagem' => 'Produto excluído com sucesso!'];

    }

}