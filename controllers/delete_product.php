<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}
require_once('../class/product.class.php');
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$product_id) {
    header('Location: ../admin/products.php?error=Invalid product ID');
    exit();
}
$prod_temp = new product();
$product = $prod_temp->getProduct($product_id);
if (!$product) {
    header('Location: ../admin/products.php?error=Product not found');
    exit();
}
if ($product['image_url']) {
    $image_path = '../' . $product['image_url'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}
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
