<?php
namespace Vendor\Development\Model;

use PDO;

class Products
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function get()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $this->pdo->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($product);
        } else {
            $stmt = $this->pdo->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($products);
        }
    }

    public function post()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $name = $data['name'] ?? null;
        $description = $data['description'] ?? null;
        $price = $data['price'] ?? null;
        $stock = $data['stock'] ?? null;

        if ($name && $description && $price && $stock) {
            $stmt = $this->pdo->prepare("INSERT INTO products (name, description, price, stock) VALUES (:name, :description, :price, :stock)");
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':stock' => $stock
            ]);
            echo "Produto criado com sucesso!";
        } else {
            echo "Dados incompletos.";
        }
    }

    public function put()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'] ?? null;
        $name = $data['name'] ?? null;
        $description = $data['description'] ?? null;
        $price = $data['price'] ?? null;
        $stock = $data['stock'] ?? null;

        if ($id && $name && $description && $price && $stock) {
            $stmt = $this->pdo->prepare("UPDATE products SET name = :name, description = :description, price = :price, stock = :stock WHERE id = :id");
            $stmt->execute([
                ':name' => $name,
                ':description' => $description,
                ':price' => $price,
                ':stock' => $stock,
                ':id' => $id
            ]);
            echo "Produto atualizado com sucesso!";
        } else {
            echo "Dados incompletos.";
        }
    }

    public function delete()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? null;

        if ($id) {
            $stmt = $this->pdo->prepare("DELETE FROM products WHERE id = :id");
            $stmt->execute([':id' => $id]);
            echo "Produto excluído com sucesso!";
        } else {
            echo "ID não informado.";
        }
    }
}
