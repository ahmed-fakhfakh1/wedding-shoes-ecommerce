<?php
// Set page title for header
$page_title = "Order Details";

// Include header and necessary files
include 'includes/header.php';
require_once 'includes/config.php';
require_once 'class/order.class.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id <= 0) {
    header('Location: my-orders.php');
    exit;
}

// Get order details
$order = new Order();
$ord = $order->getOrder($order_id);

if (!$ord || $ord['user_id'] != $_SESSION['user_id']) {
    header('Location: my-orders.php');
    exit;
}
?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 50px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Order Details</h1>
        <p class="lead">Order #<?php echo str_pad($ord['id'], 6, '0', STR_PAD_LEFT); ?></p>
    </div>
</section>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Order Information Card -->
            <div class="card shadow-lg" style="border: none; border-radius: 10px; border-left: 5px solid #c41e3a; margin-bottom: 2rem;">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="fas fa-box me-2"></i> Order Information
                    </h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Order ID:</strong><br>
                                <span style="color: #c41e3a; font-weight: bold; font-size: 1.1rem;">
                                    #<?php echo str_pad($ord['id'], 6, '0', STR_PAD_LEFT); ?>
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Order Date:</strong><br>
                                <?php echo date('F d, Y - H:i', strtotime($ord['order_date'])); ?>
                            </p>
                        </div>
                    </div>

                    <hr>

                    <!-- Status -->
                    <div class="mb-3">
                        <p class="mb-2">
                            <strong>Order Status:</strong><br>
                            <?php 
                                $status = $ord['status'];
                                $badge_class = '';
                                $badge_text = '';
                                
                                switch($status) {
                                    case 'pending':
                                        $badge_class = 'bg-warning text-dark';
                                        $badge_text = 'Pending';
                                        break;
                                    case 'confirmed':
                                        $badge_class = 'bg-info';
                                        $badge_text = 'Confirmed';
                                        break;
                                    case 'shipped':
                                        $badge_class = 'bg-primary';
                                        $badge_text = 'Shipped';
                                        break;
                                    case 'delivered':
                                        $badge_class = 'bg-success';
                                        $badge_text = 'Delivered';
                                        break;
                                    case 'cancelled':
                                        $badge_class = 'bg-danger';
                                        $badge_text = 'Cancelled';
                                        break;
                                    default:
                                        $badge_class = 'bg-secondary';
                                        $badge_text = ucfirst($status);
                                }
                            ?>
                            <span class="badge <?php echo $badge_class; ?>" style="font-size: 0.95rem; padding: 0.5rem 1rem;">
                                <?php echo $badge_text; ?>
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Product Details Card -->
            <div class="card shadow-lg" style="border: none; border-radius: 10px; margin-bottom: 2rem;">
                <div class="card-body p-4">
                    <h6 class="card-title fw-bold mb-3">
                        <i class="fas fa-shoe-prints me-2"></i> Product Details
                    </h6>

                    <div class="mb-3">
                        <p><strong>Product Name:</strong></p>
                        <p class="text-muted">
                            <?php echo htmlspecialchars($ord['product_name']); ?>
                        </p>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Quantity:</strong></p>
                            <p class="text-muted"><?php echo intval($ord['quantity']); ?> pair(s)</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Unit Price:</strong></p>
                            <p class="text-muted">TND <?php echo number_format(floatval($ord['price']), 2, ',', '.'); ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Total:</strong></p>
                            <p class="text-muted fw-bold" style="color: #c41e3a; font-size: 1.1rem;">
                                TND <?php echo number_format(floatval($ord['price']) * intval($ord['quantity']), 2, ',', '.'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Information Card -->
            <div class="card shadow-lg" style="border: none; border-radius: 10px;">
                <div class="card-body p-4">
                    <h6 class="card-title fw-bold mb-3">
                        <i class="fas fa-truck me-2"></i> Delivery Information
                    </h6>

                    <div class="mb-3">
                        <p><strong>Recipient Name:</strong></p>
                        <p class="text-muted">
                            <?php echo htmlspecialchars($ord['name']); ?>
                        </p>
                    </div>

                    <div class="mb-3">
                        <p><strong>Email Address:</strong></p>
                        <p class="text-muted">
                            <a href="mailto:<?php echo htmlspecialchars($ord['email']); ?>">
                                <?php echo htmlspecialchars($ord['email']); ?>
                            </a>
                        </p>
                    </div>

                    <div class="mb-0">
                        <p><strong>Delivery Address:</strong></p>
                        <p class="text-muted">
                            <?php echo nl2br(htmlspecialchars($ord['address'])); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Order Summary Card -->
            <div class="card shadow-lg" style="border: none; border-radius: 10px; position: sticky; top: 20px;">
                <div class="card-body p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);">
                    <h6 class="card-title fw-bold mb-3">Order Summary</h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>TND <?php echo number_format(floatval($ord['price']), 2, ',', '.'); ?></span>
                    </div>

                    <hr style="margin: 1rem 0;">

                    <div class="d-flex justify-content-between fw-bold" style="font-size: 1.2rem; color: #c41e3a;">
                        <span>Total:</span>
                        <span>TND <?php echo number_format(floatval($ord['price']) * intval($ord['quantity']), 2, ',', '.'); ?></span>
                    </div>

                    <hr style="margin: 1rem 0;">

                    <div class="d-grid gap-2">
                        <a href="my-orders.php" class="btn btn-outline-danger">
                            <i class="fas fa-list me-2"></i> Back to Orders
                        </a>
                        <a href="products-men.php" class="btn" style="background-color: #c41e3a; color: white; border: none;">
                            <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
