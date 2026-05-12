<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}
$page_title = "Create Product";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Shoes Hub Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .image-preview {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            display: none;
            margin-top: 1rem;
            border: 2px solid #ddd;
        }
        .sizes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
            gap: 1rem;
        }
        .form-check {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
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
            .sizes-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <h3><i class="fas fa-shoe-prints"></i> Shoes Hub</h3>
            <small>Admin Panel</small>
        </div>
        <ul class="sidebar-nav">
            <li><a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
            <li><a href="products.php" class="active"><i class="fas fa-shoe-prints"></i> Manage Products</a></li>
            <li><a href="orders.php"><i class="fas fa-shopping-bag"></i> Orders</a></li>
            <li style="border-top: 1px solid rgba(255, 255, 255, 0.2); margin-top: 2rem; padding-top: 2rem;">
                <a href="../controllers/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </aside>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <h2>Create New Product</h2>
            <a href="products.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Products
            </a>
        </div>
        <!-- Create Product Form -->
        <form action="../controllers/create_product.php" method="POST" enctype="multipart/form-data">
            <!-- Product Information Section -->
            <div class="form-section">
                <h4><i class="fas fa-shoe-prints"></i> Product Information</h4>
                <div class="form-group mb-3">
                    <label for="name">Shoe Name *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="e.g., Classic Black Formal Heels" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="gender">Gender *</label>
                            <select class="form-select" id="gender" name="gender" required onchange="updateCategories()">
                                <option value="">-- Select Gender --</option>
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category">Category *</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <option value="">-- Select Category --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Size Selection Section -->
            <div class="form-section">
                <h4><i class="fas fa-expand"></i> Available Sizes (EU) *</h4>
                <p class="text-muted small">Select all available sizes for this shoe</p>
                <div class="sizes-grid">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="35" id="size35">
                        <label class="form-check-label" for="size35">35</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="36" id="size36">
                        <label class="form-check-label" for="size36">36</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="37" id="size37">
                        <label class="form-check-label" for="size37">37</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="38" id="size38">
                        <label class="form-check-label" for="size38">38</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="39" id="size39">
                        <label class="form-check-label" for="size39">39</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="40" id="size40">
                        <label class="form-check-label" for="size40">40</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="41" id="size41">
                        <label class="form-check-label" for="size41">41</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="42" id="size42">
                        <label class="form-check-label" for="size42">42</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="43" id="size43">
                        <label class="form-check-label" for="size43">43</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="44" id="size44">
                        <label class="form-check-label" for="size44">44</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sizes" value="45" id="size45">
                        <label class="form-check-label" for="size45">45</label>
                    </div>
                </div>
            </div>
            <!-- Stock Quantity Section -->
            <div class="form-section">
                <h4><i class="fas fa-cube"></i> Stock Quantity</h4>
                <div class="form-group">
                    <label for="quantity">Quantity in Stock *</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0" min="0" required>
                </div>
            </div>
            <!-- Price Section -->
            <div class="form-section">
                <h4><i class="fas fa-tag"></i> Price</h4>
                <div class="form-group">
                    <label for="price">Price (TND) *</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="0.00" step="0.01" min="0" required>
                </div>
            </div>
            <!-- Image Upload Section -->
            <div class="form-section">
                <h4><i class="fas fa-image"></i> Product Image</h4>
                <div class="form-group">
                    <label for="image">Upload Product Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
                    <small class="text-muted">Supported formats: JPG, PNG, GIF (Max 5MB). Optional.</small>
                    <img id="imagePreview" class="image-preview" src="" alt="Image Preview">
                </div>
            </div>
            <!-- Submit Section -->
            <div class="form-section">
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="products.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Product
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
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
        const categories = {
            'Men': [
                { id: 1, name: 'Formal' },
                { id: 2, name: 'Casual' },
                { id: 3, name: 'Party' },
                { id: 4, name: 'Comfort' }
            ],
            'Women': [
                { id: 5, name: 'Formal' },
                { id: 6, name: 'Casual' },
                { id: 7, name: 'Party' },
                { id: 8, name: 'Comfort' }
            ]
        };
        function updateCategories() {
            const gender = document.getElementById('gender').value;
            const categorySelect = document.getElementById('category');
            categorySelect.innerHTML = '<option value="">-- Select Category --</option>';
            if (gender && categories[gender]) {
                categories[gender].forEach(cat => {
                    const option = document.createElement('option');
                    option.value = cat.id;
                    option.textContent = cat.name;
                    categorySelect.appendChild(option);
                });
            }
        }
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const gender = document.getElementById('gender').value;
            const category = document.getElementById('category').value;
            const quantity = parseInt(document.getElementById('quantity').value);
            const sizeChecks = document.querySelectorAll('input[name="sizes"]:checked');
            if (!name) {
                alert('Shoe name is required');
                e.preventDefault();
                return;
            }
            if (!gender) {
                alert('Gender is required');
                e.preventDefault();
                return;
            }
            if (!category) {
                alert('Category is required');
                e.preventDefault();
                return;
            }
            if (sizeChecks.length === 0) {
                alert('Please select at least one size');
                e.preventDefault();
                return;
            }
            if (isNaN(quantity) || quantity < 0) {
                alert('Valid stock quantity is required');
                e.preventDefault();
                return;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
