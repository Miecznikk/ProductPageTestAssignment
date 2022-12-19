<?php

class DBConnection{ //class representing db connection, Singleton
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "scandiweb_db";
    private $conn;

    private static $instance;

    private function __construct(){
        $this->conn = new mysqli($this->host,$this->username,$this->password,$this->database);

        if($this->conn->connect_error){
            die("Connection failed ".$this->conn->connect_error);
        }
    }

    public static function getInstance(){ //if instance of DBConnection already exists, return it, otherwise create new and then return it
        if(self::$instance === null){     //this way we are making sure that no more than one endpoint will be there
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql){
        return $this->conn->query($sql);
    }

    public function close(){
        $this->conn->close();
    }
}

class ProductFactory{
    private static $productTypes = [ 
        'Book' => 'Product\Book',            
        'DVD' => 'Product\DVD',
        'Furniture' => 'Product\Furniture'
    ];

    public static function create($post_data){ // factory method
        if(array_key_exists($post_data['opt'],self::$productTypes)){
            $productClassName = self::$productTypes[$post_data['opt']];

            return new $productClassName($post_data);
        }
        else{
            throw new Exception("Unrecognized product type {$post_data['opt']}");
        }
    }
}
class Store{
    private $products = [];
    private $db;
    public function __construct(){
        $this->db = DBConnection::getInstance(); //only one endpoint allowed => using singleton getInstance method instead of public constructor
        $this->loadProductsFromDb();
    }

    public function loadProductsFromDb(){
        $res = $this->db->query("SELECT * FROM book");
        while($obj = $res->fetch_assoc()){
            $this->add_product(new Product\Book($obj));
        }
        $res = $this->db->query("SELECT * FROM furniture");
        while($obj = $res->fetch_assoc()){
            $this->add_product(new Product\Furniture($obj));
        }
        $res = $this->db->query("SELECT * FROM dvd");
        while($obj = $res->fetch_assoc()){
            $this->add_product(new Product\DVD($obj));
        }
        usort($this->products, function ($a, $b) {//sort elements by SKU
            return strcmp($a->SKU, $b->SKU);
        }); 
    }

    public function get_products_cards(){ //prints product card to our page
        foreach($this->products as $prod){
            echo $prod->toString();
        }
    }
    public function add_product($object){ //adds product to array
        array_push($this->products, $object);
    }

    public function post_product($post_data){ //uses factory method to post product to database
        $new_product = ProductFactory::create($post_data);
        $sql = $new_product->createQuery();
        $this->db->query($sql);
        header("Location: /php");
    }

    public function existing_sku(){ //returns array of existing SKU (used in vue.js form validation)
        $sku = array_map(function ($obj) {
            return $obj->SKU;
        },$this->products);
        return $sku;
    }

    public function delete_from_db($products){ // mass delete action
        $prods_sep = implode("','", $products); // separate SKU by coma and put them in ''
        $sql = "delete from furniture where SKU in ('{$prods_sep}');";
        $this->db->query($sql);
        $sql = "delete from book where SKU in ('{$prods_sep}');";
        $this->db->query($sql);
        $sql = "delete from dvd where SKU in ('{$prods_sep}');";
        $res = $this->db->query($sql);
        header("Location: /php");
        return $res;
    }
}

$store = new Store();

?>