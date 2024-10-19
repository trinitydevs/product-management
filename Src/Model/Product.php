<?php
namespace App\Server\Model;

class Product {

    private int $id;
    private string $name;
    private string $desc;
    private float $price;
    private int $stock;
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
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * Get the value of desc
     *
     * @return string
     */
    public function getDesc(): string {
        return $this->desc;
    }

    /**
     * Set the value of desc
     *
     * @param string $desc
     *
     * @return self
     */
    public function setDesc(string $desc) {
        $this->desc = $desc;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice(): float {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price) {
        $this->price = $price;
    }

    /**
     * Get the value of stock
     *
     * @return int
     */
    public function getStock(): int {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @param int $stock
     *
     * @return self
     */
    public function setStock(int $stock) {
        $this->stock = $stock;
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
     * Set the value of dateHour
     *
     * @param string $dateHour
     *
     * @return self
     */
    public function setDateHour(string $dateHour) {
        $this->dateHour = $dateHour;
    }
}