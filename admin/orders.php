<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

require_once('../class/order.class.php');
require_once('../includes/config.php');

$page_title = "Manage Orders";

// Get all orders
$order = new Order();
$orders = $order->getAllOrders();

// Get success/error messages
$success_message = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : '';
$error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - Shoes Hub Admin</title>
    
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

        .orders-table {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .orders-table table {
            margin-bottom: 0;
        }

        .orders-table thead {
            background: linear-gradient(135deg, var(--primary-color) 0%, #8b1428 100%);
            color: white;
        }

        .orders-table tbody tr:hover {
            background-color: rgba(196, 30, 58, 0.05);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-shipped {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-delivered {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .status-denied {
            background-color: #f8d7da;
            color: #842029;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
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

            .action-buttons a,
            .action-buttons button {
                width: 100%;
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
            <li>
                <a href="dashboard.php">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="products.php">
                    <i class="fas fa-shoe-prints"></i> Manage Products
                </a>
            </li>
            <li>
                <a href="orders.php" class="active">
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
            <h2><i class="fas fa-shopping-bag me-2"></i> Manage Orders</h2>
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

        <!-- Success Message -->
        <?php if ($success_message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Success!</strong> <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Error!</strong> <?php echo $error_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Orders Table -->
        <div class="orders-table">
            <?php if (count($orders) > 0): ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $ord): ?>
                                <tr>
                                    <td>
                                        <strong>#<?php echo str_pad($ord['id'], 6, '0', STR_PAD_LEFT); ?></strong>
                                    </td>
                                    <td>
                                        <div class="text-dark">
                                            <strong><?php echo htmlspecialchars($ord['name']); ?></strong><br>
                                            <small class="text-muted"><?php echo htmlspecialchars($ord['email']); ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($ord['product_name']); ?>
                                    </td>
                                    <td>
                                        <strong style="color: var(--primary-color);">
                                            €<?php echo number_format(floatval($ord['price']), 2, ',', '.'); ?>
                                        </strong>
                                    </td>
                                    <td>
                                        <?php 
                                            $status = $ord['status'];
                                            $badge_class = 'status-' . $status;
                                        ?>
                                        <span class="status-badge <?php echo $badge_class; ?>">
                                            <?php echo ucfirst($status); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo date('M d, Y', strtotime($ord['order_date'])); ?>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="order-details.php?order_id=<?php echo $ord['id']; ?>" class="btn btn-sm btn-info text-white">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <?php if ($ord['status'] === 'pending'): ?>
                                                <form method="POST" action="../controllers/update_order_status.php" style="display: inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Accept
                                                    </button>
                                                </form>
                                                <form method="POST" action="../controllers/update_order_status.php" style="display: inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                                                    <input type="hidden" name="status" value="denied">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to deny this order?');">
                                                        <i class="fas fa-times"></i> Deny
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">No actions available</span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div style="padding: 3rem; text-align: center;">
                    <i class="fas fa-inbox fa-3x text-muted mb-3" style="display: block; margin-bottom: 1rem;"></i>
                    <h5 class="text-muted">No orders yet</h5>
                    <p class="text-muted">When customers place orders, they will appear here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
