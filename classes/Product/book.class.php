<?php
namespace Product;

use TypeError;
class Book extends Product{
    private $weight;

    public function __construct($data){
        try{
            $this->setSKU ($data['SKU']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setWeight($data['weight']);
        }
        catch (TypeError $e){
            echo "Wrong type";
        }
    }

    public function toString(){
        return '<div class="product-card shadow ms-4 card text-white bg-light mb-3" style="width:18rem">
                    <div class="card-header fs-5">
                        '.$this->SKU.'
                    <input class="form-check-input" type="checkbox" name="products[]" value="'.$this->SKU.'" style="float:right;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$this->name.'</h5>
                        <p class="card-text mb-0">Price: $'.$this->price.'</p>
                        <p class="card-text">Weight: '.$this->weight.'kg</p>
                    </div>

                </div>';
    }
    public function setSKU(string $sku){
        $this->SKU = $sku;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setPrice(float $price){
        $this->price = $price;
    }

    public function setWeight(float $weight){
        $this->weight = $weight;
    }
    public function createQuery(){ //creating insert query to db
        return "insert into book (SKU, name, price, weight) values ('{$this->SKU}','{$this->name}',{$this->price},{$this->weight})";
    }
}

?>