<?php
namespace App\Server\Controller;
use App\Server\Repository\LogRepository;
use App\Server\Model\Log;
use App\Server\Model\Product;

class LogController{

    public static function getLogs(){

        $logs = LogRepository::get();

        if($logs==false){
            return ['status'=> false,
            'message'=>'O banco de dados não possui registros de operações.'];
        }

        return $logs;

    }

}