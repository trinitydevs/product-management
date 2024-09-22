<?php
namespace Vendor\Development\Model;

use PDO;
use PDOException;

class Products
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create($data)
    {
        $sql = "INSERT INTO products (name, description, user_insert, price, date_hour, stock) 
                VALUES (:name, :description, :user_insert, :price, :date_hour, :stock)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':user_insert' => $data['user_insert'],
            ':price' => $data['price'],
            ':date_hour' => date('Y-m-d H:i:s'),
            ':stock' => $data['stock']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getAll()
    {
        $sql = "SELECT id, name, description, price, date_hour, stock FROM products";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE products 
                SET name = :name, description = :description, price = :price, stock = :stock
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'],
            ':price' => $data['price'],
            ':stock' => $data['stock'],
            ':id' => $data['id']
        ]);

        return $stmt->rowCount();
    }

    public function delete($id)
    {
        if (empty($id)) {
            return 0;
        }

        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Erro ao excluir o produto: " . $e->getMessage();
            return 0;
        }
    }
}
