<?php

namespace Product;
use TypeError;
class DVD extends Product{
    private $size;

    public function __construct($data){
        try{
            $this->setSKU ($data['SKU']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setSize($data['size']);
        }
        catch (TypeError $e){
            echo "Wrong type";
        }
        
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
    public function setSize(float $size){
        $this->size = $size;
    }

    public function toString(){
        return '<div class="product-card shadow ms-4 card text-white bg-light mb-3" style="width:18rem">
                    <div class="card-header fs-5">
                        '.$this->SKU.'
                    <input class="form-check-input delete-checkbox" name="products[]" value="'.$this->SKU.'" type="checkbox" style="float:right;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">'.$this->name.'</h5>
                        <p class="card-text mb-0">Price: $'.$this->price.'</p>
                        <p class="card-text">Size: '.$this->size.'MB</p>
                    </div>

                </div>';
    }

    public function createQuery(){ //creating insert query to db
        return "insert into dvd (SKU, name, price, size) values ('{$this->SKU}','{$this->name}',{$this->price},{$this->size})";
    }
}
?>