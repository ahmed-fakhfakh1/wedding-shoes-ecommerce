<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}
require_once('../class/product.class.php');
$name = isset($_POST['name']) ? $_POST['name'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$sizes = isset($_POST['sizes']) ? $_POST['sizes'] : array();
if (!is_array($sizes)) {
    $sizes = array($sizes);
}
if (!$name || !$gender || !$category_id || empty($sizes) || $quantity < 0 || $price < 0) {
    header('Location: ../admin/create_product.php?error=Missing required fields');
    exit();
}
$sizes_str = implode(',', $sizes);
$image_url = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = '../uploads/products/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    $filename = basename($file_name);
    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (in_array($file_ext, $allowed)) {
        if ($file_size <= 5 * 1024 * 1024) {
            $new_filename = uniqid() . '_' . time() . '.' . $file_ext;
            $destination = $upload_dir . $new_filename;
            if (move_uploaded_file($file_tmp, $destination)) {
                $image_url = 'uploads/products/' . $new_filename;
            }
        }
    }
}
$prod = new product();
$prod->name = $name;
$prod->gender = $gender;
$prod->category_id = $category_id;
$prod->size = $sizes_str;
$prod->quantity = $quantity;
$prod->price = $price;
$prod->sku = $gender . '-' . strtoupper(str_replace(' ', '', $name)) . '-' . time();
$prod->status = 1;
$prod->image_url = $image_url;
try {
    $product_id = $prod->insert();
    header('Location: ../admin/edit_product.php?id=' . $product_id . '&created=1');
    exit();
} catch (Exception $e) {
    header('Location: ../admin/create_product.php?error=Error creating product: ' . $e->getMessage());
    exit();
}
?>
