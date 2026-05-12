<?php
class product {
    public $id;
    public $name;
    public $sku;
    public $gender;
    public $category_id;
    public $size;
    public $quantity;
    public $price;
    public $image_url;
    public $status;
    public $created_at;
    public $updated_at;
    public function insert() {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "INSERT INTO products (name, sku, gender, category_id, size, quantity, price, image_url, status) 
                VALUES ('$this->name', '$this->sku', '$this->gender', '$this->category_id', '$this->size', '$this->quantity', '$this->price', '$this->image_url', '$this->status')";
        $pdo->exec($req);
        return $pdo->lastInsertId();
    }
    public function getAllProducts() {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "SELECT * FROM products ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getProduct($id) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "SELECT * FROM products WHERE id = $id";
        $result = $pdo->query($req);
        $product = $result->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
    public function getProductsByGender($gender) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "SELECT * FROM products WHERE gender = '$gender' ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getProductsByCategory($category_id) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "SELECT * FROM products WHERE category_id = $category_id ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function searchProducts($keyword) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "SELECT * FROM products WHERE name LIKE '%$keyword%' OR sku LIKE '%$keyword%' ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getActiveProducts() {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "SELECT * FROM products WHERE status = 1 ORDER BY created_at DESC";
        $result = $pdo->query($req);
        $products = $result->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function updateProduct() {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "UPDATE products SET 
                name = '$this->name', 
                gender = '$this->gender', 
                category_id = '$this->category_id', 
                size = '$this->size', 
                quantity = '$this->quantity', 
                price = '$this->price',
                image_url = '$this->image_url', 
                status = '$this->status',
                updated_at = NOW()
                WHERE id = $this->id";
        $pdo->exec($req);
    }
    public function deleteProduct($id) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        $req = "DELETE FROM products WHERE id = $id";
        $pdo->exec($req);
    }
}