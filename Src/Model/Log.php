<?php
namespace App\Server\Model;
use App\Server\Model\Product;

class Log {

    private int $id;
    private string $action;
    private Product $product;
    private int $userInsert;
    private string $dateHour;


    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id) {
        $this->id = $id;
    }

    /**
     * Get the value of action
     *
     * @return string
     */
    public function getAction(): string {
        return $this->action;
    }

    /**
     * Set the value of action
     *
     * @param string $action
     *
     * @return self
     */
    public function setAction(string $action) {
        $this->action = $action;
    }

    /**
     * Get the value of product
     *
     * @return Product
     */
    public function getProduct(): Product {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @param Product $product
     *
     * @return self
     */
    public function setProduct(Product $product) {
        $this->product = $product;
    }

    /**
     * Get the value of userInsert
     *
     * @return int
     */
    public function getUserInsert(): int {
        return $this->userInsert;
    }

    /**
     * Set the value of userInsert
     *
     * @param int $userInsert
     *
     * @return self
     */
    public function setUserInsert(int $userInsert) {
        $this->userInsert = $userInsert;
    }

    /**
     * Get the value of dateHour
     *
     * @return string
     */
    public function getDateHour(): string {
        return $this->dateHour;
    }

    /**
     * Set the value of dataHora
     *
     * @param string $dateHour
     *
     * @return self
     */
    public function setDateHour(string $dateHour) {
        $this->dateHour = $dateHour;
    }
}