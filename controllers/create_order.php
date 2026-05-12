<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$agree = isset($_POST['agree']) ? $_POST['agree'] : false;
$errors = [];
if ($product_id <= 0) {
    $errors[] = 'Invalid product';
}
if (empty($name)) {
    $errors[] = 'Name is required';
}
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}
if (empty($address)) {
    $errors[] = 'Address is required';
}
if (!$agree) {
    $errors[] = 'You must agree to the terms and conditions';
}
if (!empty($errors)) {
    $error_message = implode(', ', $errors);
    header("Location: ../checkout.php?product_id=$product_id&error=" . urlencode($error_message));
    exit;
}
require_once '../includes/config.php';
require_once '../class/product.class.php';
require_once '../class/order.class.php';
$product = new Product();
$prod = $product->getProduct($product_id);
if (!$prod) {
    header('Location: ../products-men.php?error=Product not found');
    exit;
}
$order = new Order();
$order->user_id = $_SESSION['user_id'];
$order->product_id = $product_id;
$order->product_name = $prod['name'];
$order->price = $prod['price'];
$order->quantity = 1;
$order->email = $email;
$order->name = $name;
$order->address = $address;
$order_id = $order->createOrder();
if ($order_id) {
    header("Location: ../order-confirmation.php?order_id=$order_id&success=Order placed successfully");
    exit;
} else {
    header('Location: ../checkout.php?product_id=' . $product_id . '&error=Failed to create order');
    exit;
}
?>
