<?php
namespace Vendor\Development\Database;

use PDO;
use PDOException;

class Database
{
    private $path = 'litedatabase';

    public function connect()
    {
        try {
            $pdo = new PDO("sqlite:$this->path");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //echo "Conexão bem-sucedida com SQLite!<br>";
            $this->createTable($pdo); 
            $this->createLogsTable($pdo);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro ao conectar: " . $e->getMessage();
        }
    }

    private function createTable($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS products (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    description TEXT,
                    user_insert TEXT,
                    price REAL,
                    date_hour TEXT,
                    stock INTEGER
                )";

        $pdo->exec($sql);
        echo "Tabela 'products' criada (se não existia).<br>";
    }

    private function createLogsTable($pdo)
    {
        $sql = "CREATE TABLE IF NOT EXISTS logs (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                operation_type TEXT NOT NULL,
                operation_date TEXT NOT NULL,
                product_id INTEGER NOT NULL,
                FOREIGN KEY (product_id) REFERENCES products (id)
            )";

        $pdo->exec($sql);
        echo "Tabela 'logs' criada (se não existia).<br>";
    }
}
