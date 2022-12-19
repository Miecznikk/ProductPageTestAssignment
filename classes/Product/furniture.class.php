<?php
namespace Product;
use TypeError;

class Furniture extends Product{
    private $height;
    private $width;
    private $length;
    
    public function __construct($data){
        try{
            $this->setSKU ($data['SKU']);
            $this->setName($data['name']);
            $this->setPrice($data['price']);
            $this->setWidth($data['width']);
            $this->setHeight($data['height']);
            $this->setLength($data['length']);
        }
        catch(TypeError $e){
            echo "Error!: ". $e->getMessage();
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

    public function setHeight(float $height){
        $this->height = $height;
    }
    public function setWidth(float $width){
        $this->width = $width;
    }

    public function setLength(float $length){
        $this->length = $length;
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
                        <p class="card-text">Dimensions: '.$this->height.'x'.$this->width.'x'.$this->length.'</p>
                    </div>

                </div>';
    }   

    public function createQuery(){ //creating insert query to db
        return "insert into furniture (SKU, name, price, height, width, length) values ('{$this->SKU}','{$this->name}',{$this->price},{$this->height}, {$this->width}, {$this->length})";
    }
}

?>