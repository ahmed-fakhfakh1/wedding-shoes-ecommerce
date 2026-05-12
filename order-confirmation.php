<?php
$page_title = "Order Confirmation";
include 'includes/header.php';
require_once 'includes/config.php';
require_once 'class/order.class.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
if ($order_id <= 0) {
    header('Location: products-men.php');
    exit;
}
$order = new Order();
$ord = $order->getOrder($order_id);
if (!$ord || $ord['user_id'] != $_SESSION['user_id']) {
    header('Location: products-men.php');
    exit;
}
$success_message = isset($_GET['success']) ? $_GET['success'] : 'Order placed successfully';
?>
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 50px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Order Confirmation</h1>
        <p class="lead">Thank you for your order!</p>
    </div>
</section>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Message -->
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Success!</strong> <?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!-- Order Details Card -->
            <div class="card shadow-lg" style="border: none; border-radius: 10px; border-left: 5px solid #c41e3a;">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">
                        <i class="fas fa-box me-2"></i> Order Details
                    </h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Order ID:</strong><br>
                                <span style="color: #c41e3a; font-weight: bold; font-size: 1.2rem;">
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
                    <!-- Customer Information -->
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-user me-2"></i> Customer Information
                    </h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Name:</strong><br>
                                <?php echo $ord['name']; ?>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Email:</strong><br>
                                <?php echo $ord['email']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-2">
                            <strong>Delivery Address:</strong><br>
                            <?php echo $ord['address']; ?>
                        </p>
                    </div>
                    <hr>
                    <!-- Product Information -->
                    <h6 class="fw-bold mb-3">
                        <i class="fas fa-shoe-prints me-2"></i> Product Information
                    </h6>
                    <div class="mb-3">
                        <p class="mb-2">
                            <strong>Product:</strong><br>
                            <?php echo $ord['product_name']; ?>
                        </p>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <p class="mb-0">
                                <strong>Quantity:</strong><br>
                                <?php echo intval($ord['quantity']); ?> pair(s)
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0">
                                <strong>Unit Price:</strong><br>
                                TND <?php echo number_format(floatval($ord['price']), 2, ',', '.'); ?>
                            </p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-0">
                                <strong>Total:</strong><br>
                                <strong style="color: #c41e3a; font-size: 1.1rem;">
                                    TND <?php echo number_format(floatval($ord['price']) * intval($ord['quantity']), 2, ',', '.'); ?>
                                </strong>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <!-- Order Status -->
                    <div class="mb-3">
                        <p class="mb-2">
                            <strong>Order Status:</strong><br>
                            <span class="badge bg-warning text-dark" style="font-size: 0.95rem; padding: 0.5rem 1rem;">
                                <?php echo ucfirst($ord['status']); ?>
                            </span>
                        </p>
                    </div>
                    <hr>
                    <!-- Next Steps -->
                    <div class="alert alert-info" role="alert">
                        <h6 class="alert-heading fw-bold">
                            <i class="fas fa-info-circle me-2"></i> What's Next?
                        </h6>
                        <p class="mb-0">
                            Your order has been confirmed and is being processed. We'll send you an email confirmation shortly to <strong><?php echo $ord['email']; ?></strong> with tracking information.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="d-grid gap-2 mt-4">
                <a href="products-men.php" class="btn btn-outline-danger btn-lg">
                    <i class="fas fa-shopping-bag me-2"></i> Continue Shopping
                </a>
                <a href="my-orders.php" class="btn btn-primary btn-lg" style="background-color: #c41e3a; border: none;">
                    <i class="fas fa-list me-2"></i> View My Orders
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .card {
        animation: fadeIn 0.5s ease-in;
    }
</style>
<?php include 'includes/footer.php'; ?>
