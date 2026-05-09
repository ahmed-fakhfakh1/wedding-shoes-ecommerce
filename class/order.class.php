<?php

class Order {
    public $id;
    public $user_id;
    public $product_id;
    public $product_name;
    public $price;
    public $quantity;
    public $email;
    public $name;
    public $address;
    public $card_number;
    public $order_date;
    public $status;
    
    // CREATE - Insert new order
    public function createOrder() {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "INSERT INTO orders (user_id, product_id, product_name, price, quantity, email, name, address, card_number, status) 
                VALUES ($this->user_id, $this->product_id, '$this->product_name', $this->price, $this->quantity, '$this->email', '$this->name', '$this->address', '$this->card_number', 'pending')";
        
        $pdo->exec($req);
        
        // Return the last inserted ID
        return $pdo->lastInsertId();
    }
    
    // READ - Get all orders
    public function getAllOrders() {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM orders ORDER BY order_date DESC";
        $result = $pdo->query($req);
        $orders = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $orders;
    }
    
    // READ - Get orders by user ID
    public function getOrdersByUser($user_id) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC";
        $result = $pdo->query($req);
        $orders = $result->fetchAll(PDO::FETCH_ASSOC);
        
        return $orders;
    }
    
    // READ - Get single order
    public function getOrder($id) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "SELECT * FROM orders WHERE id = $id";
        $result = $pdo->query($req);
        $order = $result->fetch(PDO::FETCH_ASSOC);
        
        return $order;
    }
    
    // UPDATE - Update order status
    public function updateOrderStatus($id, $status) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "UPDATE orders SET status = '$status' WHERE id = $id";
        $pdo->exec($req);
    }
    
    // DELETE - Delete order
    public function deleteOrder($id) {
        require_once(__DIR__ . '/../includes/config.php');
        $cnx = new connexion();
        $pdo = $cnx->cnxBase();
        
        $req = "DELETE FROM orders WHERE id = $id";
        $pdo->exec($req);
    }
}

?>
