<?php
namespace App\Server\Repository;
use App\Server\Database\Database;
use App\Server\Model\Log;
use App\Server\Model\Product;
use PDO;
use PDOException;

class LogRepository {

    public static function register(Log $l) : bool {
        $pdo = Database::connect();
        $insert = "INSERT INTO logs(actionLog,userInsert,idProduct,dateHour) VALUES(?,?,?,DATETIME('now','-3 hours'))";
        $prepare = $pdo->prepare($insert);
        $prepare->bindValue(1, $l->getAction());
        $prepare->bindValue(2, $l->getUserInsert());
        $prepare->bindValue(3, $l->getProduct()->getId());
        try {
            $prepare->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function get() : bool|array {
        $pdo = Database::connect();
        $select = 'SELECT * FROM logs';
        $prepare = $pdo->prepare($select);
        try {
            $prepare->execute();
            $list = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $list;
        } catch (PDOException $e) {
            return false;
        }
    }

}