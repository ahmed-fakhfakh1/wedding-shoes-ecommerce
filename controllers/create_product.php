<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

require_once('../class/product.class.php');

// Get form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$sku = isset($_POST['sku']) ? $_POST['sku'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
$color = isset($_POST['color']) ? $_POST['color'] : '';
$size = isset($_POST['size']) ? $_POST['size'] : '';
$material = isset($_POST['material']) ? $_POST['material'] : '';
$style = isset($_POST['style']) ? $_POST['style'] : '';
$status = isset($_POST['status']) ? 1 : 0;
$featured = isset($_POST['featured']) ? 1 : 0;

// Initialize image URL as empty
$image_url = '';

// Handle image upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $upload_dir = '../uploads/products/';
    
    // Create upload directory if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_size = $_FILES['image']['size'];
    $file_error = $_FILES['image']['error'];
    
    // Allowed file types
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    $filename = basename($file_name);
    $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    // Validate file type
    if (in_array($file_ext, $allowed)) {
        // Validate file size (5MB max)
        if ($file_size <= 5 * 1024 * 1024) {
            // Generate unique filename
            $new_filename = uniqid() . '_' . time() . '.' . $file_ext;
            $destination = $upload_dir . $new_filename;
            
            // Move uploaded file
            if (move_uploaded_file($file_tmp, $destination)) {
                $image_url = 'uploads/products/' . $new_filename;
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "File size exceeds 5MB limit.";
        }
    } else {
        $error = "Invalid file type. Only JPG, PNG, GIF allowed.";
    }
}

// Validate required fields
if (!$name || !$sku || !$gender || !$category_id || !$price) {
    header('Location: ../admin/create_product.php?error=Missing required fields');
    exit();
}

// Create product object and set properties
$prod = new product();
$prod->name = $name;
$prod->sku = $sku;
$prod->description = $description;
$prod->gender = $gender;
$prod->category_id = $category_id;
$prod->price = $price;
$prod->quantity = $quantity;
$prod->color = $color;
$prod->size = $size;
$prod->material = $material;
$prod->style = $style;
$prod->image_url = $image_url;
$prod->status = $status;
$prod->featured = $featured;

// Insert product
try {
    $prod->insert();
    header('Location: ../admin/products.php?success=Product created successfully');
    exit();
} catch (Exception $e) {
    header('Location: ../admin/create_product.php?error=Error creating product: ' . $e->getMessage());
    exit();
}

?>
