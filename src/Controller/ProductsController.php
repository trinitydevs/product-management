<?php
namespace Vendor\Development\Controller;
use Vendor\Development\Model\Products;

class ProductsController
{
    private $productsModel;

    public function __construct(Products $productsModel)
    {
        $this->productsModel = $productsModel;
    }

    public function post()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'user_insert' => $_POST['user_insert'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock']
            ];

            $this->productsModel->create($data);
            echo json_encode(['success' => true]);
            exit();
        }
    }



    public function get()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $products = $this->productsModel->getAll();
            return $products;
        }
    }

    public function getProductDetails($id)
    {
        return $this->productsModel->getById($id);
    }

    public function put()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'PUT') {
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock']
            ];

            $rowsAffected = $this->productsModel->update($data);

            if ($rowsAffected > 0) {
                echo "Produto atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar o produto ou nenhuma alteração feita.";
            }

        }
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            $productId = $_POST['id'];

            if (!empty($productId)) {
                $rowsAffected = $this->productsModel->delete($productId);

                if ($rowsAffected > 0) {
                    echo "Produto excluído com sucesso!";
                } else {
                    echo "Erro ao excluir o produto ou produto não encontrado.";
                }
            } else {
                echo "ID do produto não fornecido.";
            }
        }
    }

}
