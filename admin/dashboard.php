<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

$page_title = "Admin Dashboard";
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

        .sidebar .brand small {
            opacity: 0.8;
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), #8b1428);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: white;
        }

        .stat-card .icon.icon-blue {
            background-color: #007bff;
        }

        .stat-card .icon.icon-green {
            background-color: #28a745;
        }

        .stat-card .icon.icon-orange {
            background-color: #fd7e14;
        }

        .stat-card .icon.icon-red {
            background-color: var(--primary-color);
        }

        .stat-card h6 {
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            color: var(--dark-color);
        }

        .management-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .management-section h4 {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .management-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .management-card {
            border: 2px solid #e0e0e0;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: #333;
        }

        .management-card:hover {
            border-color: var(--primary-color);
            background-color: rgba(196, 30, 58, 0.05);
            transform: translateY(-3px);
        }

        .management-card .icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .management-card h6 {
            margin: 0;
            font-weight: bold;
        }

        .management-card small {
            color: #999;
            display: block;
            margin-top: 0.5rem;
        }

        .logout-btn {
            background-color: #dc3545;
            border: none;
            padding: 0.5rem 1rem;
        }

        .logout-btn:hover {
            background-color: #c82333;
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

            .stats-row {
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
            <li>
                <a href="dashboard.php" class="active">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="products.php">
                    <i class="fas fa-shoe-prints"></i> Manage Products
                </a>
            </li>
            <li>
                <a href="orders.php">
                    <i class="fas fa-shopping-bag"></i> Orders
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
            <h2>Dashboard</h2>
            <div class="user-info">
                <div>
                    <p class="mb-0"><strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong></p>
                    <small class="text-muted">Administrator</small>
                </div>
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="icon icon-blue">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <h6>Total Orders</h6>
                <div class="number">156</div>
                <small class="text-muted">+12 this month</small>
            </div>

            <div class="stat-card">
                <div class="icon icon-green">
                    <i class="fas fa-box"></i>
                </div>
                <h6>Total Products</h6>
                <div class="number">42</div>
                <small class="text-muted">In warehouse</small>
            </div>

            <div class="stat-card">
                <div class="icon icon-orange">
                    <i class="fas fa-users"></i>
                </div>
                <h6>Total Users</h6>
                <div class="number">287</div>
                <small class="text-muted">+18 new users</small>
            </div>
        </div>

        <!-- Management Section -->
        <div class="management-section">
            <h4>Quick Management</h4>
            <div class="management-grid">
                <a href="products.php" class="management-card">
                    <div class="icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h6>Add Product</h6>
                    <small>Create new product</small>
                </a>

                <a href="products.php" class="management-card">
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h6>Edit Products</h6>
                    <small>Manage existing</small>
                </a>

                <a href="orders.php" class="management-card">
                    <div class="icon">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <h6>View Orders</h6>
                    <small>Manage orders</small>
                </a>
            </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
