<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

// Get form data
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
$agree = isset($_POST['agree']) ? $_POST['agree'] : false;

// Validation
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

// If there are errors, redirect back with error message
if (!empty($errors)) {
    $error_message = implode(', ', $errors);
    header("Location: ../checkout.php?product_id=$product_id&error=" . urlencode($error_message));
    exit;
}

// Include necessary files
require_once '../includes/config.php';
require_once '../class/product.class.php';
require_once '../class/order.class.php';

// Get product details
$product = new Product();
$prod = $product->getProduct($product_id);

if (!$prod) {
    header('Location: ../products-men.php?error=Product not found');
    exit;
}

// Create order
$order = new Order();
$order->user_id = $_SESSION['user_id'];
$order->product_id = $product_id;
$order->product_name = $prod['name'];
$order->price = $prod['price'];
$order->quantity = 1;
$order->email = $email;
$order->name = $name;
$order->address = $address;

// Insert order
$order_id = $order->createOrder();

if ($order_id) {
    // Redirect to order confirmation page
    header("Location: ../order-confirmation.php?order_id=$order_id&success=Order placed successfully");
    exit;
} else {
    header('Location: ../checkout.php?product_id=' . $product_id . '&error=Failed to create order');
    exit;
}
?>
