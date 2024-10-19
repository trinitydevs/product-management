<?php
namespace App\Server\Repository;
use App\Server\Database\Database;
use App\Server\Model\Product;
use PDO;
use PDOException;

class ProductRepository {

    public static function getAll() : bool|array {
        $pdo = Database::connect();
        $select = 'SELECT * FROM products';
        $prepare = $pdo->prepare($select);
        try {
            $prepare->execute();
            $list = $prepare->fetchAll(PDO::FETCH_ASSOC);
            return $list;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function getById(Product $p) : bool|array {
        $pdo = Database::connect();
        $select = 'SELECT * FROM products WHERE idProduct= ?';
        $prepare = $pdo->prepare($select);
        $prepare->bindValue(1, $p->getId());
        try {
            $prepare->execute();
            $list = $prepare->fetch(PDO::FETCH_ASSOC);
            return $list;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function post(Product $p) : bool|int {
        $pdo = Database::connect();
        $insert = "INSERT INTO products(nameProduct,descProduct,priceProduct,stockProduct,userInsert,dateHour) VALUES (?,?,?,?,?,DATETIME('now','-3 hours'))";
        $prepare = $pdo->prepare($insert);
        $prepare->bindValue(1, $p->getName());
        $prepare->bindValue(2, $p->getDesc());
        $prepare->bindValue(3, $p->getPrice());
        $prepare->bindValue(4, $p->getStock());
        $prepare->bindValue(5, $p->getUserInsert());
        try {
            $prepare->execute();
            return $pdo->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function put(Product $p) : bool|int {
        $pdo = Database::connect();
        $update = "UPDATE products SET nameProduct = ?,descProduct = ?,priceProduct = ?,stockProduct = ?,userInsert = ?,dateHour = DATETIME('now','-3 hours') WHERE idProduct = ?";
        $prepare = $pdo->prepare($update);
        $prepare->bindValue(1, $p->getName());
        $prepare->bindValue(2, $p->getDesc());
        $prepare->bindValue(3, $p->getPrice());
        $prepare->bindValue(4, $p->getStock());
        $prepare->bindValue(5, $p->getUserInsert());
        $prepare->bindValue(6, $p->getId());
        try {
            $prepare->execute();
            return $p->getId();
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function delete(Product $p) : bool {
        $pdo = Database::connect();
        $update = 'DELETE FROM products WHERE idProduct = ?';
        $prepare = $pdo->prepare($update);
        $prepare->bindValue(1, $p->getId());
        try {
            $prepare->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}