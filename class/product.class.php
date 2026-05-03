<?php

class product {
    public $id;
    public $name;
    public $sku;
    public $description;
    public $gender;
    public $category_id;
    public $price;
    public $quantity;
    public $color;
    public $size;
    public $material;
    public $style;
    public $image_url;
    public $featured;
    public $status;
    public $created_at;
    public $updated_at;
    
    
    public function insert() {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "INSERT INTO products (name, sku, description, gender, category_id, price, quantity, color, size, material, style, image_url, featured, status) 
                VALUES ('$this->name', '$this->sku', '$this->description', '$this->gender', '$this->category_id', '$this->price', '$this->quantity', '$this->color', '$this->size', '$this->material', '$this->style', '$this->image_url', '$this->featured', '$this->status')";
        
        $pdo->exec($req);
    }
    
    
    public function getAllProducts() {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
    
    
    public function getProduct($id) {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products WHERE id = '$id'";
        $result = $pdo->query($req);
        $product = $result->fetch(PDO::FETCH_ASSOC);
        
        return $product ? $product : false;
    }
    
    
    public function updateProduct() {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "UPDATE products SET 
                name = '$this->name',
                sku = '$this->sku',
                description = '$this->description',
                gender = '$this->gender',
                category_id = '$this->category_id',
                price = '$this->price',
                quantity = '$this->quantity',
                color = '$this->color',
                size = '$this->size',
                material = '$this->material',
                style = '$this->style',
                image_url = '$this->image_url',
                featured = '$this->featured',
                status = '$this->status'
                WHERE id = '$this->id'";
        
        $pdo->exec($req);
    }
    
    
    public function deleteProduct($id) {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "DELETE FROM products WHERE id = '$id'";
        $pdo->exec($req);
    }
    
    
    public function getProductsByGender($gender) {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products WHERE gender = '$gender' ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
    
    
    public function getProductsByCategory($category_id) {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products WHERE category_id = '$category_id' ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
    
    
    public function searchProducts($keyword) {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR description LIKE '%$keyword%' OR sku LIKE '%$keyword%' ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
    
    
    public function getFeaturedProducts() {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products WHERE featured = 1 AND status = 1 ORDER BY created_at DESC LIMIT 6";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
    
    
    public function getActiveProducts() {
        require_once('../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM products WHERE status = 1 ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
    }
}

?>