<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$product_id) {
    header('Location: products.php');
    exit();
}

$page_title = "Edit Product";

// Load product data (you'll handle this in your product.class)
// For now, we'll show the form structure, you'll add the database query
$product = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Wedding Shoes</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
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
            overflow-y: auto;
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

        .form-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .form-section h4 {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .form-group label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(196, 30, 58, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #8b1428;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 0.75rem 2rem;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            padding: 0.75rem 2rem;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            margin-top: 1rem;
            border: 2px solid #ddd;
        }

        .current-image {
            margin-bottom: 1rem;
        }

        .row-two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .alert-info {
            background-color: rgba(13, 202, 240, 0.1);
            border-color: #0dcaf0;
            color: #084298;
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

            .top-bar {
                flex-direction: column;
                text-align: center;
            }

            .row-two-col {
                grid-template-columns: 1fr;
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
            <li><a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
            <li><a href="products.php" class="active"><i class="fas fa-shoe-prints"></i> Manage Products</a></li>
            <li><a href="orders.php"><i class="fas fa-shopping-bag"></i> Orders</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="categories.php"><i class="fas fa-list"></i> Categories</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 2rem; padding-top: 2rem;">
                <a href="../controllers/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h2>Edit Product</h2>
            <a href="products.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>

        <!-- Info Alert -->
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i> Product ID: <strong><?php echo $product_id; ?></strong>
        </div>

        <!-- Edit Product Form -->
        <form action="../controllers/update_product.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

            <!-- Basic Information Section -->
            <div class="form-section">
                <h4><i class="fas fa-info-circle"></i> Basic Information</h4>
                
                <div class="row-two-col">
                    <div class="form-group">
                        <label for="name">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Classic Black Formal Heels" required>
                    </div>

                    <div class="form-group">
                        <label for="sku">SKU (Stock Keeping Unit) *</label>
                        <input type="text" class="form-control" id="sku" name="sku" placeholder="e.g., WS-BLACK-001" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Detailed product description..."></textarea>
                </div>
            </div>

            <!-- Pricing & Stock Section -->
            <div class="form-section">
                <h4><i class="fas fa-money-bill-wave"></i> Pricing & Stock</h4>
                
                <div class="row-two-col">
                    <div class="form-group">
                        <label for="price">Price (€) *</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" placeholder="0.00" required>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity in Stock *</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0" required>
                    </div>
                </div>
            </div>

            <!-- Category & Details Section -->
            <div class="form-section">
                <h4><i class="fas fa-palette"></i> Category & Details</h4>
                
                <div class="row-two-col">
                    <div class="form-group">
                        <label for="gender">Gender *</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Men">Men</option>
                            <option value="Women">Women</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category *</label>
                        <select class="form-select" id="category" name="category_id" required>
                            <option value="">-- Select Category --</option>
                            <option value="1">Formal</option>
                            <option value="2">Casual</option>
                            <option value="3">Wedding Collection</option>
                            <option value="4">Special Events</option>
                            <option value="5">Party</option>
                            <option value="6">Comfort</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" placeholder="e.g., Black, White, Gold">
                </div>

                <div class="row-two-col">
                    <div class="form-group">
                        <label for="size">Size</label>
                        <select class="form-select" id="size" name="size">
                            <option value="">-- Select Size --</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="material">Material</label>
                        <input type="text" class="form-control" id="material" name="material" placeholder="e.g., Leather, Suede, Synthetic">
                    </div>
                </div>

                <div class="form-group">
                    <label for="style">Style</label>
                    <select class="form-select" id="style" name="style">
                        <option value="">-- Select Style --</option>
                        <option value="Heels">Heels</option>
                        <option value="Flats">Flats</option>
                        <option value="Loafers">Loafers</option>
                        <option value="Oxfords">Oxfords</option>
                        <option value="Sandals">Sandals</option>
                        <option value="Boots">Boots</option>
                        <option value="Pumps">Pumps</option>
                        <option value="Ballerinas">Ballerinas</option>
                    </select>
                </div>
            </div>

            <!-- Image Section -->
            <div class="form-section">
                <h4><i class="fas fa-image"></i> Product Image</h4>
                
                <div class="form-group">
                    <label>Current Image</label>
                    <div class="current-image">
                        <img id="currentImage" class="image-preview" src="#" alt="Current Product Image" style="display:none;">
                        <p id="noImage" class="text-muted">No image uploaded yet</p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Change Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewNewImage(event)">
                    <small class="text-muted">Leave empty to keep current image. Supported formats: JPG, PNG, GIF (Max 5MB)</small>
                    <img id="newImagePreview" class="image-preview" src="" alt="New Image Preview" style="display:none;">
                </div>
            </div>

            <!-- Status Section -->
            <div class="form-section">
                <h4><i class="fas fa-toggle-on"></i> Status</h4>
                
                <div class="row-two-col">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="active" name="status" value="1">
                            <label class="form-check-label" for="active">Active Product</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                            <label class="form-check-label" for="featured">Featured Product</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="form-section">
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="products.php" class="btn btn-secondary">Cancel</a>
                    <a href="products.php?action=delete&id=<?php echo $product_id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">
                        <i class="fas fa-trash"></i> Delete Product
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Product
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function previewNewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('newImagePreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Validate form before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const sku = document.getElementById('sku').value.trim();
            const price = parseFloat(document.getElementById('price').value);
            const quantity = parseInt(document.getElementById('quantity').value);

            if (!name) {
                alert('Product name is required');
                e.preventDefault();
                return;
            }

            if (!sku) {
                alert('SKU is required');
                e.preventDefault();
                return;
            }

            if (isNaN(price) || price <= 0) {
                alert('Valid price is required');
                e.preventDefault();
                return;
            }

            if (isNaN(quantity) || quantity < 0) {
                alert('Valid quantity is required');
                e.preventDefault();
                return;
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
