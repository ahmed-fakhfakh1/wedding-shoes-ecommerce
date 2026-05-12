<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$page_title = "My Orders";
include 'includes/header.php';
require_once 'includes/config.php';
require_once 'class/order.class.php';
$order = new Order();
$orders = $order->getOrdersByUser($_SESSION['user_id']);
?>
<!-- Page Header -->
<section style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 50px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">My Orders</h1>
        <p class="lead">View and manage your orders</p>
    </div>
</section>
<div class="container mt-5 mb-5">
    <?php if (count($orders) > 0): ?>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-hover" style="border-radius: 10px; overflow: hidden;">
                        <thead style="background-color: #c41e3a; color: white;">
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i> Order ID</th>
                                <th><i class="fas fa-shoe-prints me-2"></i> Product</th>
                                <th><i class="fas fa-money-bill me-2"></i> Total</th>
                                <th><i class="fas fa-calendar me-2"></i> Date</th>
                                <th><i class="fas fa-sync me-2"></i> Status</th>
                                <th><i class="fas fa-eye me-2"></i> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $ord): ?>
                                <tr>
                                    <td>
                                        <strong>#<?php echo str_pad($ord['id'], 6, '0', STR_PAD_LEFT); ?></strong>
                                    </td>
                                    <td>
                                        <?php echo $ord['product_name']; ?>
                                    </td>
                                    <td>
                                        <strong style="color: #c41e3a;">
                                            TND <?php echo number_format(floatval($ord['price']) * intval($ord['quantity']), 2, ',', '.'); ?>
                                        </strong>
                                    </td>
                                    <td>
                                        <?php echo date('F d, Y', strtotime($ord['order_date'])); ?>
                                    </td>
                                    <td>
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
                                        <span class="badge <?php echo $badge_class; ?>">
                                            <?php echo $badge_text; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="order-details.php?order_id=<?php echo $ord['id']; ?>" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-eye me-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            <strong>No orders yet.</strong> Start shopping to place your first order!
        </div>
        <div class="text-center mt-4">
            <a href="products-men.php" class="btn btn-lg" style="background-color: #c41e3a; color: white; border: none;">
                <i class="fas fa-shopping-bag me-2"></i> Shop Now
            </a>
        </div>
    <?php endif; ?>
</div>
<?php include 'includes/footer.php'; ?>
