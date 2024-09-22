<?php
namespace Vendor\Development\Controller;

use Vendor\Development\Model\Products;
use Vendor\Development\Controller\Logs;
use PDO;

class ProductsController
{
    protected $logs;
    protected $products;

    public function __construct(PDO $pdo)
    {
        $this->logs = new Logs();
        
        $this->products = new Products($pdo);
        echo 'Controller de Produtos iniciado.';
    }

    public function insertProduct($name, $description, $price, $stock)
    {
        $this->products->post($name, $description, $price, $stock);

        $this->logs->logMessage("Produto inserido: " . $name);
    }

    public function deleteProduct($productId)
    {
        $this->products->delete($productId);

        $this->logs->logMessage("Produto excluído: ID " . $productId);
    }

}
