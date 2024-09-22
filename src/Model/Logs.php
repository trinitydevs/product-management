<?php 
namespace Vendor\Development\Model;

use PDO;

class Logs
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createLog($action, $productId, $userInsert)
    {
        $sql = "INSERT INTO logs (operation_type, operation_date, product_id) 
                VALUES (:operation_type, :operation_date, :product_id)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':operation_type' => $action,
            ':operation_date' => date('Y-m-d H:i:s'),
            ':product_id' => $productId
        ]);
    }
}
