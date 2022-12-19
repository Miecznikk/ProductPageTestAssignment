<?php
namespace Product;

abstract class Product{ //abstract class representing product
    private $SKU;
    private $name;
    private $price;

    abstract public function toString(); //to override
    abstract public function createQuery(); //to override
}

?>