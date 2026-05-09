<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

require_once('../class/product.class.php');

$page_title = "Manage Products";

// Get all products
$prod = new product();
$products = $prod->getAllProducts();
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

        .container-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table thead th {
            color: var(--primary-color);
            font-weight: bold;
            border-bottom: 2px solid var(--primary-color);
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-buttons .btn {
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-edit:hover {
            background-color: #0056b3;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-delete:hover {
            background-color: #c82333;
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #a01830;
            border-color: #a01830;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-box input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .search-box .btn {
            padding: 0.75rem 1.5rem;
        }

        .badge-stock {
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .badge-stock.in-stock {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-stock.low-stock {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-stock.out-of-stock {
            background-color: #f8d7da;
            color: #721c24;
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

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
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
                <h2>Manage Products</h2>
                <small class="text-muted">View, edit, and manage all wedding shoes</small>
            </div>
            <a href="create_product.php" class="btn btn-primary btn-lg">
                <i class="fas fa-plus"></i> Add New Product
            </a>
        </div>

        <!-- Search & Filter -->
        <div class="container-section">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search products by name or ID..." class="form-control">
                <select id="categoryFilter" class="form-control" style="max-width: 200px;">
                    <option value="">All Categories</option>
                    <option value="men">Men's Shoes</option>
                    <option value="women">Women's Shoes</option>
                </select>
                <button class="btn btn-primary" onclick="filterProducts()">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>

            <!-- Products Table -->
            <div class="table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 10%;">Image</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 10%;">Category</th>
                            <th style="width: 12%;">Price</th>
                            <th style="width: 12%;">Stock</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 11%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($products && count($products) > 0) {
                            foreach ($products as $product) {
                                // Determine stock status
                                $stock_status = '';
                                $stock_badge = '';
                                if ($product['quantity'] == 0) {
                                    $stock_status = 'Out of Stock';
                                    $stock_badge = 'out-of-stock';
                                } elseif ($product['quantity'] <= 5) {
                                    $stock_status = 'Low Stock (' . $product['quantity'] . ')';
                                    $stock_badge = 'low-stock';
                                } else {
                                    $stock_status = 'In Stock (' . $product['quantity'] . ')';
                                    $stock_badge = 'in-stock';
                                }
                                
                                // Determine status badge
                                $status_badge = $product['status'] == 1 ? 'bg-success' : 'bg-secondary';
                                $status_text = $product['status'] == 1 ? 'Active' : 'Inactive';
                                
                                // Determine gender badge color
                                $gender_badge = '';
                                switch ($product['gender']) {
                                    case 'Men':
                                        $gender_badge = 'bg-info';
                                        break;
                                    case 'Women':
                                        $gender_badge = 'bg-warning text-dark';
                                        break;
                                    
                                    default:
                                        $gender_badge = 'bg-secondary';
                                }
                                
                                // Get image or placeholder
                                $image_url = !empty($product['image_url']) ? '../' . $product['image_url'] : 'https://via.placeholder.com/50x50?text=No+Image';
                        ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td>
                                <img src="<?php echo $image_url; ?>" alt="Product Image" class="product-image" onerror="this.src='https://via.placeholder.com/50x50?text=No+Image'">
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($product['name']); ?></strong>
                                <br>
                                <small class="text-muted">SKU: <?php echo htmlspecialchars($product['sku']); ?></small>
                            </td>
                            <td><span class="badge <?php echo $gender_badge; ?>"><?php echo $product['gender']; ?></span></td>
                            <td><strong>€<?php echo number_format($product['price'], 2); ?></strong></td>
                            <td>
                                <span class="badge badge-stock <?php echo $stock_badge; ?>"><?php echo $stock_status; ?></span>
                            </td>
                            <td>
                                <span class="badge <?php echo $status_badge; ?>"><?php echo $status_text; ?></span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn btn-edit btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="../controllers/delete_product.php?id=<?php echo $product['id']; ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted" style="padding: 2rem;">
                                <i class="fas fa-inbox"></i> No products found. <a href="create_product.php">Create your first product</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function filterProducts() {
            alert('Filter functionality will be added in backend');
        }
    </script>
</body>
</html>
