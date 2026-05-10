<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

require_once('../class/order.class.php');
require_once('../includes/config.php');

$page_title = "Order Details";

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id <= 0) {
    header('Location: orders.php');
    exit;
}

// Get order details
$order = new Order();
$ord = $order->getOrder($order_id);

if (!$ord) {
    header('Location: orders.php?error=Order not found');
    exit;
}
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

        .details-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .details-card h5 {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .detail-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 1.5rem;
        }

        .detail-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .detail-item label {
            font-weight: bold;
            color: #666;
            font-size: 0.9rem;
            text-transform: uppercase;
            display: block;
            margin-bottom: 0.5rem;
        }

        .detail-item p {
            margin: 0;
            color: #333;
            font-size: 1.05rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: bold;
            font-size: 1rem;
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
            background-color: #d4edda;
            color: #155724;
        }

        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }

        .status-denied {
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

            .detail-row {
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
            <div>
                <h2>Order #<?php echo str_pad($ord['id'], 6, '0', STR_PAD_LEFT); ?></h2>
            </div>
            <a href="orders.php" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Orders
            </a>
        </div>

        <!-- Order Status -->
        <div class="details-card">
            <h5><i class="fas fa-info-circle me-2"></i> Order Status</h5>
            <div class="detail-row">
                <div class="detail-item">
                    <label>Current Status</label>
                    <p>
                        <span class="status-badge status-<?php echo $ord['status']; ?>">
                            <?php echo ucfirst($ord['status']); ?>
                        </span>
                    </p>
                </div>
                <div class="detail-item">
                    <label>Order Date</label>
                    <p><?php echo date('F d, Y - H:i:s', strtotime($ord['order_date'])); ?></p>
                </div>
            </div>

            <!-- Action Buttons (if pending) -->
            <?php if ($ord['status'] === 'pending'): ?>
                <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #ddd;">
                    <label style="font-weight: bold; margin-bottom: 1rem; display: block;">Quick Actions:</label>
                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        <form method="POST" action="../controllers/update_order_status.php" style="display: inline;">
                            <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Accept Order
                            </button>
                        </form>
                        <form method="POST" action="../controllers/update_order_status.php" style="display: inline;">
                            <input type="hidden" name="order_id" value="<?php echo $ord['id']; ?>">
                            <input type="hidden" name="status" value="denied">
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure you want to deny this order?');">
                                <i class="fas fa-times-circle me-2"></i> Deny Order
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Customer Information -->
        <div class="details-card">
            <h5><i class="fas fa-user me-2"></i> Customer Information</h5>
            <div class="detail-row">
                <div class="detail-item">
                    <label>Full Name</label>
                    <p><?php echo htmlspecialchars($ord['name']); ?></p>
                </div>
                <div class="detail-item">
                    <label>Email Address</label>
                    <p><a href="mailto:<?php echo htmlspecialchars($ord['email']); ?>"><?php echo htmlspecialchars($ord['email']); ?></a></p>
                </div>
                <div class="detail-item">
                    <label>Delivery Address</label>
                    <p><?php echo nl2br(htmlspecialchars($ord['address'])); ?></p>
                </div>
            </div>
        </div>

        <!-- Product Information -->
        <div class="details-card">
            <h5><i class="fas fa-shoe-prints me-2"></i> Product Information</h5>
            <div class="detail-row">
                <div class="detail-item">
                    <label>Product Name</label>
                    <p><?php echo htmlspecialchars($ord['product_name']); ?></p>
                </div>
                <div class="detail-item">
                    <label>Quantity</label>
                    <p><?php echo intval($ord['quantity']); ?> pair(s)</p>
                </div>
                <div class="detail-item">
                    <label>Unit Price</label>
                    <p>TND <?php echo number_format(floatval($ord['price']), 2, ',', '.'); ?></p>
                </div>
                <div class="detail-item">
                    <label>Total Amount</label>
                    <p style="font-size: 1.2rem; color: var(--primary-color); font-weight: bold;">
                        TND <?php echo number_format(floatval($ord['price']) * intval($ord['quantity']), 2, ',', '.'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
