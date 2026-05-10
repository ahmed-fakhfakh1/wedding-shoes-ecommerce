<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Set page title for header
$page_title = "Men's Shoes";

// Include header and necessary files
include 'includes/header.php';
require_once 'includes/config.php';
require_once 'class/product.class.php';

// Get all products and filter for Men only
$product = new Product();
$all_products = $product->getAllProducts();
$products = array_filter($all_products, function($p) {
    return $p['gender'] === 'Men';
});

// Category mapping
$category_names = [
    1 => 'Formal',
    2 => 'Casual',
    3 => 'Party',
    4 => 'Comfort'
];
?>

<!-- Page Header -->
<section style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 50px 0; text-align: center;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-2">Men's Shoes</h1>
        <p class="lead">Elegant options for grooms and groomsmen</p>
    </div>
</section>

<div class="container mt-5 mb-5">
    <!-- Filter Buttons -->
    <div class="mb-5">
        <h5 class="mb-3">Filter by Category:</h5>
        <div class="filter-buttons d-flex flex-wrap gap-2">
            <button class="btn btn-outline-danger filter-btn active" data-filter="all">
                <i class="fas fa-th me-2"></i> All Products
            </button>
            
            <?php 
            // Get unique categories for men's shoes
            $unique_categories = [];
            foreach ($products as $prod) {
                $cat_id = $prod['category_id'];
                if (!isset($unique_categories[$cat_id])) {
                    $unique_categories[$cat_id] = [
                        'id' => $cat_id,
                        'name' => $category_names[$cat_id] ?? 'Unknown'
                    ];
                }
            }
            
            // Sort categories by ID
            ksort($unique_categories);
            
            foreach ($unique_categories as $cat): 
            ?>
                <button class="btn btn-outline-danger filter-btn" data-filter="<?php echo $cat['id']; ?>">
                    <i class="fas fa-filter me-2"></i> <?php echo $cat['name']; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row" id="productsContainer">
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $prod): ?>
                <div class="col-md-4 mb-4 product-item" data-category="<?php echo $prod['category_id']; ?>">
                    <div class="card h-100 shadow-lg" style="border: none; border-radius: 10px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(196, 30, 58, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='';">
                        
                        <!-- Product Image -->
                        <div class="position-relative overflow-hidden" style="height: 280px;">
                            <?php if ($prod['image_url']): ?>
                                <img src="<?php echo htmlspecialchars($prod['image_url']); ?>" class="card-img-top h-100 w-100" alt="<?php echo htmlspecialchars($prod['name']); ?>" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="h-100 w-100 bg-secondary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-shoe-prints fa-3x text-white opacity-50"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Category Badge -->
                            <span class="position-absolute top-0 start-0 badge bg-danger m-2">
                                <?php echo $category_names[$prod['category_id']] ?? 'Unknown'; ?>
                            </span>
                            
                            <!-- Stock Status Badge -->
                            <?php if ($prod['quantity'] > 0): ?>
                                <span class="position-absolute top-0 end-0 badge bg-success m-2">In Stock</span>
                            <?php else: ?>
                                <span class="position-absolute top-0 end-0 badge bg-secondary m-2">Out of Stock</span>
                            <?php endif; ?>
                        </div>

                        <!-- Product Info -->
                        <div class="card-body" style="padding: 1.5rem;">
                            <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($prod['name']); ?></h5>
                            
                            <!-- SKU -->
                            <p class="text-muted small mb-2">
                                <strong>SKU:</strong> <?php echo htmlspecialchars($prod['sku']); ?>
                            </p>

                            <!-- Available Sizes -->
                            <p class="text-muted small mb-2">
                                <strong>Available Sizes:</strong> <?php echo htmlspecialchars($prod['size']); ?>
                            </p>

                            <!-- Price and Stock -->
                            <div class="d-flex justify-content-between align-items-center mb-3 pt-2 border-top">
                                <p class="card-text fw-bold" style="font-size: 1.3rem; color: #c41e3a;">
                                    TND <?php echo number_format(floatval($prod['price']), 2, ',', '.'); ?>
                                </p>
                                <p class="card-text text-muted small">
                                    <?php echo intval($prod['quantity']); ?> in stock
                                </p>
                            </div>

                            <!-- Action Button -->
                            <?php if ($prod['quantity'] > 0): ?>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <a href="checkout.php?product_id=<?php echo $prod['id']; ?>" class="btn w-100" style="background-color: #c41e3a; color: white; border: none; padding: 0.7rem; text-decoration: none;">
                                        <i class="fas fa-credit-card me-2"></i> Make Order
                                    </a>
                                <?php else: ?>
                                    <a href="login.php" class="btn w-100" style="background-color: #c41e3a; color: white; border: none; padding: 0.7rem; text-decoration: none;">
                                        <i class="fas fa-sign-in-alt me-2"></i> Login to Order
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="fas fa-ban me-2"></i> Out of Stock
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    No men's shoes available at the moment.
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Filter Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filterValue = this.getAttribute('data-filter');

            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Filter products
            productItems.forEach(item => {
                if (filterValue === 'all') {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.3s ease-in';
                } else {
                    const itemCategory = item.getAttribute('data-category');
                    if (itemCategory === filterValue) {
                        item.style.display = 'block';
                        item.style.animation = 'fadeIn 0.3s ease-in';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    });
});

// Add fade-in animation to CSS dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;<
            transform: translateY(0);
        }
    }

    .filter-btn {
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
    }

    .filter-btn.active {
        background-color: #c41e3a !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
    }
`;
document.head.appendChild(style);
</script>

<?php include 'includes/footer.php'; ?>
