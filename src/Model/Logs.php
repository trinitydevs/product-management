<?php
namespace Vendor\Development\Model;

class Logs
{
    private int $id;
    private int $id_product;
    private string $type;
    private string $message;

    public $logs;

    public function __construct()
    {
        echo 'Logs';
    }
}