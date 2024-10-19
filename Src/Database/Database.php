<?php
namespace App\Server\Database;

use PDO;
use PDOException;

class Database {

    public static function connect() {

        $path = 'products.sqlite';

        try {
            $pdo = new PDO("sqlite:$path");
            return $pdo;
        } catch (PDOException $e) {
            echo $e;
        }

    }
}

$queryProduct = 'CREATE TABLE IF NOT EXISTS products (
    idProduct INTEGER PRIMARY KEY AUTOINCREMENT,
    nameProduct VARCHAR(50) NOT NULL,
    descProduct VARCHAR(500) NOT NULL,
    priceProduct FLOAT NOT NULL,
    stockProduct INTEGER NOT NULL,
    userInsert INTEGER NOT NULL,
    dateHour DATETIME NOT NULL
);';

$queryLog = 'CREATE TABLE IF NOT EXISTS logs (
    idLog INTEGER PRIMARY KEY AUTOINCREMENT,
    actionLog VARCHAR(20) NOT NULL,
    dateHour DATETIME NOT NULL,
    userInsert INTEGER NOT NULL,
    idProduct INTEGER NOT NULL
);';

$pdo = Database::connect();
$prepareProduct = $pdo->prepare($queryProduct);
$prepareLog = $pdo->prepare($queryLog);

$prepareProduct->execute();
$prepareLog->execute();