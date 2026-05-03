<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

require_once('../class/product.class.php');

// Get product ID
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$product_id) {
    header('Location: ../admin/products.php?error=Invalid product ID');
    exit();
}

// Get product to retrieve image path
$prod_temp = new product();
$product = $prod_temp->getProduct($product_id);

if (!$product) {
    header('Location: ../admin/products.php?error=Product not found');
    exit();
}

// Delete image from server if exists
if ($product['image_url']) {
    $image_path = '../' . $product['image_url'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

// Delete product from database
try {
    $prod = new product();
    $prod->deleteProduct($product_id);
    header('Location: ../admin/products.php?success=Product deleted successfully');
    exit();
} catch (Exception $e) {
    header('Location: ../admin/products.php?error=' . urlencode($e->getMessage()));
    exit();
}

?>
