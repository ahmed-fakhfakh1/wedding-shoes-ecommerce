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
$page_title = "Home";

// Include header
include 'includes/header.php';
?>

<!-- Banner Section with Text and Image -->
<section class="banner-section mb-5" style="background: white; padding: 0;">
    <div class="container-fluid" style="padding: 0;">
        <div class="row" style="margin: 0;">
            <!-- Left Side - Text Content -->
            <div class="col-md-6 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 30px 40px; min-height: 220px;">
                <div class="text-content">
                    <h1 class="display-4 fw-bold mb-3">Welcome to Shoes Hub</h1>
                    <p class="lead mb-3" style="font-size: 1.1rem;">Premium Quality Shoes for Every Style & Occasion</p>
                    <p class="mb-4" style="font-size: 0.95rem; opacity: 0.95;">Discover our wide selection of comfortable, stylish shoes for men, women, and every occasion.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="products.php" class="btn btn-light btn-sm px-4">
                            <i class="fas fa-shoe-prints me-2"></i> Shop Shoes
                        </a>
                        <a href="#featured" class="btn btn-outline-light btn-sm px-4">
                            <i class="fas fa-arrow-down me-2"></i> Explore
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Banner Image -->
            <div class="col-md-6" style="padding: 0; overflow: hidden; min-height: 220px;">
                <img src="images/banner.jpg" alt="Shoes Hub Banner" style="width: 100%; height: 100%; object-fit: cover; display: block;">
            </div>
        </div>
    </div>
</section>

<!-- Category Section -->
<section class="mb-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Shop by Category</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Find the perfect pair for everyone</p>
    </div>
    
    <div class="row">
        <!-- Men's Shoes -->
        <div class="col-md-6 mb-4">
            <a href="products-men.php" style="text-decoration: none;">
                <div class="category-card" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.9), rgba(27, 27, 27, 0.9)), url('https://via.placeholder.com/500x300?text=Men+Shoes'); background-size: cover; background-position: center; height: 300px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    <div class="text-center">
                        <h3 class="display-6 fw-bold mb-3">
                            <i class="fas fa-shoe-prints"></i> Men's Shoes
                        </h3>
                        <p style="font-size: 1.1rem;">Comfortable & Stylish Footwear</p>
                        <button class="btn btn-light mt-3">View Collection</button>
                    </div>
                </div>
            </a>
        </div>

        <!-- Women's Shoes -->
        <div class="col-md-6 mb-4">
            <a href="products-women.php" style="text-decoration: none;">
                <div class="category-card" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.9), rgba(27, 27, 27, 0.9)), url('https://via.placeholder.com/500x300?text=Women+Shoes'); background-size: cover; background-position: center; height: 300px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    <div class="text-center">
                        <h3 class="display-6 fw-bold mb-3">
                            <i class="fas fa-crown"></i> Women's Shoes
                        </h3>
                        <p style="font-size: 1.1rem;">Elegant & Comfortable Styles</p>
                        <button class="btn btn-light mt-3">View Collection</button>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="mb-5 py-5" id="featured">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Featured Collection</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Discover our most popular and bestselling shoe styles</p>
    </div>

    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100 shadow-lg" style="border: none; border-radius: 10px;">
                <div class="position-relative overflow-hidden" style="height: 280px;">
                    <img src="images/party_shoe.jpg" class="card-img-top h-100 w-100" alt="Formal Party Shoes" style="object-fit: cover;">
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <h5 class="card-title fw-bold mb-2">Elegant Black Formal Heels</h5>
                    <p class="card-text text-muted small mb-3">Premium heels with sophisticated design. Perfect for evening events and formal occasions.</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="product-price mb-0">TND 149.99</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100 shadow-lg" style="border: none; border-radius: 10px;">
                <div class="position-relative overflow-hidden" style="height: 280px;">
                    <img src="images/casual_shoe.jpg" class="card-img-top h-100 w-100" alt="Casual Shoes" style="object-fit: cover;">
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <h5 class="card-title fw-bold mb-2">Classic White Casual Sneaker</h5>
                    <p class="card-text text-muted small mb-3">Clean and versatile white sneaker with premium comfort. Perfect for everyday wear and casual style.</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="product-price mb-0">TND 189.99</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100 shadow-lg" style="border: none; border-radius: 10px;">
                <div class="position-relative overflow-hidden" style="height: 280px;">
                    <img src="images/confort_shoe.jpg" class="card-img-top h-100 w-100" alt="Comfort Shoes" style="object-fit: cover;">
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <h5 class="card-title fw-bold mb-2">Red Sport Running Shoe</h5>
                    <p class="card-text text-muted small mb-3">Stylish red running shoe with superior comfort technology. Perfect for sports and active lifestyle.</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="product-price mb-0"><del class="text-muted">TND 179.99</del> TND 129.99</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="products.php" class="btn btn-outline-primary btn-lg px-5">
            <i class="fas fa-th-large me-2"></i> View All Products
        </a>
    </div>
</section>

<!-- Features Section -->
<section class="py-5" style="background-color: #f8f9fa; border-radius: 10px; margin-bottom: 5rem;">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Why Choose Shoes Hub?</h2>
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-4 text-center">
            <div style="font-size: 3.5rem; color: #c41e3a; margin-bottom: 1rem;">
                <i class="fas fa-award"></i>
            </div>
            <h5 class="fw-bold mb-2">Premium Quality</h5>
            <p class="text-muted">Hand-selected premium materials and craftsmanship</p>
        </div>

        <div class="col-md-3 mb-4 text-center">
            <div style="font-size: 3.5rem; color: #c41e3a; margin-bottom: 1rem;">
                <i class="fas fa-truck"></i>
            </div>
            <h5 class="fw-bold mb-2">Fast Delivery</h5>
            <p class="text-muted">Express shipping available. Free over TND 100</p>
        </div>

        <div class="col-md-3 mb-4 text-center">
            <div style="font-size: 3.5rem; color: #c41e3a; margin-bottom: 1rem;">
                <i class="fas fa-heart"></i>
            </div>
            <h5 class="fw-bold mb-2">Comfort First</h5>
            <p class="text-muted">Ergonomic design for all-day comfort</p>
        </div>

        <div class="col-md-3 mb-4 text-center">
            <div style="font-size: 3.5rem; color: #c41e3a; margin-bottom: 1rem;">
                <i class="fas fa-redo-alt"></i>
            </div>
            <h5 class="fw-bold mb-2">30-Day Returns</h5>
            <p class="text-muted">Hassle-free returns if not satisfied</p>
        </div>
    </div>
</section>

<!-- Shoe Care Tips Section -->
<section class="mb-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Shoe Care Tips</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Maintain the beauty of your shoes for years to come</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-droplet" style="color: #c41e3a; margin-right: 0.5rem;"></i>Water Protection
                    </h5>
                    <p class="card-text text-muted">
                        Apply a quality water-resistant spray to your shoes before wearing them. This protective coating will help repel water and stains, keeping your shoes looking pristine.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-brush" style="color: #c41e3a; margin-right: 0.5rem;"></i>Regular Cleaning
                    </h5>
                    <p class="card-text text-muted">
                        Clean your shoes regularly with a soft cloth and appropriate cleaning products for the material. For leather shoes, use a leather conditioner every few months. For satin and delicate fabrics, use gentle specialized cleaners.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-box-open" style="color: #c41e3a; margin-right: 0.5rem;"></i>Proper Storage
                    </h5>
                    <p class="card-text text-muted">
                        Store your shoes in a cool, dry place, preferably in the original box or a shoe bag. Keep them away from direct sunlight and extreme temperatures. Use shoe trees to maintain their shape.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-shoe-prints" style="color: #c41e3a; margin-right: 0.5rem;"></i>Break-In Time
                    </h5>
                    <p class="card-text text-muted">
                        Break in your shoes at home for a few hours each day before wearing them out regularly. This ensures maximum comfort when you need it most.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Shoes Hub Section -->
<section class="mb-5 py-5" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.05) 0%, rgba(27, 27, 27, 0.05) 100%); border-radius: 10px; padding: 3rem;">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="display-5 fw-bold mb-3">About Shoes Hub</h2>
            <p class="lead text-muted mb-3">
                Shoes Hub is your premier destination for quality footwear for every occasion. We believe that the right pair of shoes can transform your entire day.
            </p>
            <p class="text-muted mb-3">
                Whether you're looking for formal shoes for professional events, casual footwear for everyday wear, or special occasion shoes, we have the perfect pair for you. Our carefully curated collection features premium materials and expert craftsmanship.
            </p>
            <p class="text-muted mb-3">
                We are committed to providing our customers with the highest quality shoes, excellent customer service, and competitive prices. Every shoe in our collection is selected to ensure comfort, style, and durability.
            </p>
        </div>
        <div class="col-lg-6">
            <div style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); border-radius: 10px; padding: 2rem; color: white; text-align: center; box-shadow: 0 8px 24px rgba(196, 30, 58, 0.2);">
                <i class="fas fa-shoe-prints" style="font-size: 4rem; margin-bottom: 1rem; display: block; opacity: 0.8;"></i>
                <h4 class="fw-bold mb-3">Why Choose Shoes Hub</h4>
                <ul style="text-align: left; list-style: none; padding: 0;">
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Premium quality materials</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Stylish and comfortable designs</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Wide variety of styles</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Competitive pricing</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Excellent customer support</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
