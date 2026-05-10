<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Set page title for header
$page_title = "Checkout";

// Include header and necessary files
include 'includes/header.php';
require_once 'includes/config.php';
require_once 'class/product.class.php';
require_once 'class/order.class.php';

// Get product ID from URL
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id <= 0) {
    header('Location: products-men.php');
    exit;
}

// Get product details
$product = new Product();
$prod = $product->getProduct($product_id);

if (!$prod) {
    header('Location: products-men.php');
    exit;
}

// Get user info from session (already have user_id, user_name, user_email)
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';
$user_address = $_SESSION['user_address'] ?? '';

// Category mapping
$category_names = [
    1 => 'Formal', 2 => 'Casual', 3 => 'Party', 4 => 'Comfort',
    5 => 'Formal', 6 => 'Casual', 7 => 'Party', 8 => 'Comfort'
];
?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 50px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Checkout</h1>
        <p class="lead">Complete your order</p>
    </div>
</section>

<div class="container mt-5 mb-5">
    <div class="row">
        <!-- Order Summary -->
        <div class="col-lg-5 mb-4">
            <div class="card shadow-lg" style="border: none; border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-4">Order Summary</h5>
                    
                    <!-- Product Image -->
                    <?php if ($prod['image_url']): ?>
                        <img src="<?php echo htmlspecialchars($prod['image_url']); ?>" class="img-fluid mb-3" alt="<?php echo htmlspecialchars($prod['name']); ?>" style="border-radius: 8px; max-height: 300px; object-fit: cover;">
                    <?php endif; ?>
                    
                    <!-- Product Details -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-2"><?php echo htmlspecialchars($prod['name']); ?></h6>
                        <p class="text-muted small mb-1">
                            <strong>Category:</strong> <?php echo $category_names[$prod['category_id']] ?? 'Unknown'; ?>
                        </p>
                        <p class="text-muted small mb-1">
                            <strong>SKU:</strong> <?php echo htmlspecialchars($prod['sku']); ?>
                        </p>
                        <p class="text-muted small mb-1">
                            <strong>Available Sizes:</strong> <?php echo htmlspecialchars($prod['size']); ?>
                        </p>
                    </div>
                    
                    <hr>
                    
                    <!-- Price Breakdown -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Product Price:</span>
                            <strong>TND <?php echo number_format(floatval($prod['price']), 2, ',', '.'); ?></strong>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Total -->
                    <div class="d-flex justify-content-between">
                        <h6 class="fw-bold">Total Amount:</h6>
                        <h6 class="fw-bold" style="color: #c41e3a;">TND <?php echo number_format(floatval($prod['price']), 2, ',', '.'); ?></h6>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Checkout Form -->
        <div class="col-lg-7">
            <div class="card shadow-lg" style="border: none; border-radius: 10px;">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Order Information</h5>
                    
                    <form action="controllers/create_order.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        
                        <!-- Personal Information Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">
                                <i class="fas fa-user me-2"></i> Personal Information
                            </h6>
                            
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?php echo htmlspecialchars($user_name); ?>" 
                                       readonly style="background-color: #f5f5f5;">
                            </div>
                            
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?php echo htmlspecialchars($user_email); ?>" 
                                       readonly style="background-color: #f5f5f5;">
                            </div>
                            
                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Delivery Address *</label>
                                <textarea class="form-control" id="address" name="address" rows="3" 
                                           style="background-color: #f5f5f5;"><?php echo htmlspecialchars($user_address); ?></textarea>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <!-- Terms and Order Button -->
                        
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-lg" style="background-color: #c41e3a; color: white; border: none;">
                                <i class="fas fa-check-circle me-2"></i> Complete Order
                            </button>
                            <a href="javascript:history.back()" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
