<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

$page_title = "Add Product";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Wedding Shoes Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #c41e3a;
            --dark-color: #1a1a1a;
        }

        body {
            background-color: #f5f5f5;
        }

        .sidebar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #8b1428 100%);
            min-height: 100vh;
            color: white;
            padding: 2rem 0;
            position: fixed;
            width: 280px;
            left: 0;
            top: 0;
        }

        .sidebar .brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 2rem;
        }

        .sidebar .brand h3 {
            margin: 0;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin: 0.5rem 0;
        }

        .sidebar-nav a {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .top-bar {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h2 {
            margin: 0;
            color: var(--primary-color);
            font-weight: bold;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section h4 {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }

        .form-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            border-radius: 5px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(196, 30, 58, 0.25);
        }

        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px dashed var(--primary-color);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            margin-top: 1rem;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 3px;
        }

        .image-preview.empty {
            color: #999;
            font-size: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #a01830;
            color: white;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
            color: white;
        }

        .btn-group-action {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .help-text {
            font-size: 0.85rem;
            color: #999;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                min-height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .btn-group-action {
                flex-direction: column;
            }

            .btn-group-action button,
            .btn-group-action a {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <h3><i class="fas fa-shoe-prints"></i> Wedding Shoes</h3>
            <small>Admin Panel</small>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="dashboard.php">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="products.php" class="active">
                    <i class="fas fa-shoe-prints"></i> Manage Products
                </a>
            </li>
            <li>
                <a href="orders.php">
                    <i class="fas fa-shopping-bag"></i> Orders
                </a>
            </li>
            <li>
                <a href="users.php">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
            <li>
                <a href="categories.php">
                    <i class="fas fa-list"></i> Categories
                </a>
            </li>
            <li>
                <a href="settings.php">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
            <li style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 2rem; padding-top: 2rem;">
                <a href="../controllers/logout.php">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div>
                <h2>Add New Product</h2>
                <small class="text-muted">Create a new wedding shoe product</small>
            </div>
            <a href="products.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>

        <!-- Form Container -->
        <div class="form-container">
            <form method="POST" action="add_product_process.php" enctype="multipart/form-data" id="productForm">
                <!-- Basic Information -->
                <div class="form-section">
                    <h4><i class="fas fa-info-circle"></i> Basic Information</h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="productName" class="form-label">Product Name *</label>
                            <input type="text" class="form-control" id="productName" name="product_name" placeholder="Enter product name" required>
                            <div class="help-text">E.g., Classic Black Formal Shoes</div>
                        </div>

                        <div class="form-group">
                            <label for="productSKU" class="form-label">SKU/Code *</label>
                            <input type="text" class="form-control" id="productSKU" name="product_sku" placeholder="Enter SKU" required>
                            <div class="help-text">Unique product code</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="productDescription" class="form-label">Description *</label>
                        <textarea class="form-control" id="productDescription" name="product_description" rows="4" placeholder="Enter detailed product description" required></textarea>
                        <div class="help-text">Describe the product features and details</div>
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <div class="form-section">
                    <h4><i class="fas fa-money-bill-wave"></i> Pricing & Stock</h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="productPrice" class="form-label">Price (€) *</label>
                            <input type="number" class="form-control" id="productPrice" name="product_price" placeholder="0.00" step="0.01" required>
                            <div class="help-text">Enter price in Euros</div>
                        </div>

                        <div class="form-group">
                            <label for="productStock" class="form-label">Stock Quantity *</label>
                            <input type="number" class="form-control" id="productStock" name="product_stock" placeholder="0" required>
                            <div class="help-text">Number of items in stock</div>
                        </div>

                        <div class="form-group">
                            <label for="minStock" class="form-label">Minimum Stock Level</label>
                            <input type="number" class="form-control" id="minStock" name="min_stock" placeholder="0">
                            <div class="help-text">Alert when stock falls below</div>
                        </div>
                    </div>
                </div>

                <!-- Category & Details -->
                <div class="form-section">
                    <h4><i class="fas fa-list"></i> Category & Details</h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="category" class="form-label">Category *</label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="men">Men's Shoes</option>
                                <option value="women">Women's Shoes</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" placeholder="E.g., Black, White, etc.">
                        </div>

                        <div class="form-group">
                            <label for="size" class="form-label">Available Sizes</label>
                            <input type="text" class="form-control" id="size" name="size" placeholder="E.g., 36-42">
                            <div class="help-text">E.g., 36-42 (EU sizes)</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="material" class="form-label">Material</label>
                            <input type="text" class="form-control" id="material" name="material" placeholder="E.g., Leather, Satin">
                        </div>

                        <div class="form-group">
                            <label for="style" class="form-label">Style</label>
                            <input type="text" class="form-control" id="style" name="style" placeholder="E.g., Formal, Casual, Heels">
                        </div>
                    </div>
                </div>

                <!-- Images -->
                <div class="form-section">
                    <h4><i class="fas fa-image"></i> Product Image</h4>
                    
                    <div class="form-group">
                        <label for="productImage" class="form-label">Upload Image *</label>
                        <input type="file" class="form-control" id="productImage" name="product_image" accept="image/*" required>
                        <div class="help-text">Recommended: 800x800px or larger</div>
                        <div class="image-preview empty" id="imagePreview">
                            <i class="fas fa-image"></i>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="form-section">
                    <h4><i class="fas fa-toggle-on"></i> Status</h4>
                    
                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="productStatus" name="product_status" checked>
                            <label class="form-check-label" for="productStatus">
                                Active Product
                            </label>
                        </div>
                        <div class="help-text">Enable this product to be visible on the store</div>
                    </div>

                    <div class="form-group">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="productFeatured" name="product_featured">
                            <label class="form-check-label" for="productFeatured">
                                Featured Product
                            </label>
                        </div>
                        <div class="help-text">Display this product on the home page</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="btn-group-action">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i> Add Product
                    </button>
                    <a href="products.php" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Image preview
        document.getElementById('productImage').addEventListener('change', function(e) {
            const reader = new FileReader();
            const preview = document.getElementById('imagePreview');
            
            reader.onload = function(event) {
                preview.innerHTML = '<img src="' + event.target.result + '" alt="Product Preview">';
            }
            
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Form validation
        document.getElementById('productForm').addEventListener('submit', function(e) {
            const price = document.getElementById('productPrice').value;
            const stock = document.getElementById('productStock').value;
            
            if (price <= 0) {
                alert('Price must be greater than 0');
                e.preventDefault();
            }
            
            if (stock < 0) {
                alert('Stock cannot be negative');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
