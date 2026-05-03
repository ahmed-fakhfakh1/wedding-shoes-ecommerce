<?php
// Set page title for header
$page_title = "Home";

// Include header
include 'includes/header.php';
?>

<!-- Hero Section with Carousel Style -->
<section class="hero-section mb-5" style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 100px 0; text-align: center; position: relative; overflow: hidden;">
    <div class="hero-content" style="position: relative; z-index: 2;">
        <h1 class="display-3 fw-bold mb-3 animated-text">Welcome to Wedding Shoes</h1>
        <p class="lead mb-4" style="font-size: 1.4rem;">Stunning Shoes for Your Most Memorable Day</p>
        <p class="mb-5" style="font-size: 1.1rem; opacity: 0.95;">Step into elegance with our carefully curated collection for the perfect wedding day</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="products.php" class="btn btn-light btn-lg px-5">
                <i class="fas fa-shoe-prints me-2"></i> Shop Shoes
            </a>
            <a href="#featured" class="btn btn-outline-light btn-lg px-5">
                <i class="fas fa-arrow-down me-2"></i> Explore
            </a>
        </div>
    </div>
    <!-- Decorative element -->
    <div style="position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; z-index: 1;"></div>
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
            <div class="category-card" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.9), rgba(27, 27, 27, 0.9)), url('https://via.placeholder.com/500x300?text=Men+Shoes'); background-size: cover; background-position: center; height: 300px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; cursor: pointer;">
                <div class="text-center">
                    <h3 class="display-6 fw-bold mb-3">
                        <i class="fas fa-shoe-prints"></i> Men's Shoes
                    </h3>
                    <p style="font-size: 1.1rem;">Elegant Options for Grooms</p>
                    <button class="btn btn-light mt-3">View Collection</button>
                </div>
            </div>
        </div>

        <!-- Women's Shoes -->
        <div class="col-md-6 mb-4">
            <div class="category-card" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.9), rgba(27, 27, 27, 0.9)), url('https://via.placeholder.com/500x300?text=Women+Shoes'); background-size: cover; background-position: center; height: 300px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; text-decoration: none; transition: all 0.3s ease; cursor: pointer;">
                <div class="text-center">
                    <h3 class="display-6 fw-bold mb-3">
                        <i class="fas fa-crown"></i> Women's Shoes
                    </h3>
                    <p style="font-size: 1.1rem;">Exquisite Choices for Brides</p>
                    <button class="btn btn-light mt-3">View Collection</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="mb-5 py-5" id="featured">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Featured Collection</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Our most popular wedding shoe designs</p>
    </div>

    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100 shadow-lg" style="border: none; border-radius: 10px;">
                <div class="position-relative overflow-hidden" style="height: 280px;">
                    <img src="https://via.placeholder.com/400x300?text=Classic+Black+Formal" class="card-img-top h-100 w-100" alt="Classic Black Formal Shoes" style="object-fit: cover;">
                    <span class="product-category">Men's</span>
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-danger">New</span>
                    </div>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <h5 class="card-title fw-bold mb-2">Classic Black Formal Shoes</h5>
                    <p class="card-text text-muted small mb-3">Premium Italian leather with elegant stitching. Perfect for traditional weddings.</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="product-price mb-0">€149.99</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" style="background-color: #c41e3a; border: none; padding: 0.7rem;">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>

        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100 shadow-lg" style="border: none; border-radius: 10px;">
                <div class="position-relative overflow-hidden" style="height: 280px;">
                    <img src="https://via.placeholder.com/400x300?text=Elegant+White+Heels" class="card-img-top h-100 w-100" alt="Elegant White Heels" style="object-fit: cover;">
                    <span class="product-category">Women's</span>
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-success">Popular</span>
                    </div>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <h5 class="card-title fw-bold mb-2">Elegant Pearl White Heels</h5>
                    <p class="card-text text-muted small mb-3">Stunning satin heels with crystal embellishments. The perfect bride's choice.</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="product-price mb-0">€189.99</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" style="background-color: #c41e3a; border: none; padding: 0.7rem;">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>

        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100 shadow-lg" style="border: none; border-radius: 10px;">
                <div class="position-relative overflow-hidden" style="height: 280px;">
                    <img src="https://via.placeholder.com/400x300?text=Brown+Leather+Oxford" class="card-img-top h-100 w-100" alt="Brown Leather Oxford" style="object-fit: cover;">
                    <span class="product-category">Men's</span>
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-warning text-dark">Sale</span>
                    </div>
                </div>
                <div class="card-body" style="padding: 1.5rem;">
                    <h5 class="card-title fw-bold mb-2">Brown Leather Oxford</h5>
                    <p class="card-text text-muted small mb-3">Sophisticated brown oxford shoes. Versatile for any wedding style.</p>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="product-price mb-0"><del class="text-muted">€179.99</del> €129.99</p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100" style="background-color: #c41e3a; border: none; padding: 0.7rem;">
                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                    </button>
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
        <h2 class="display-5 fw-bold mb-3">Why Choose Wedding Shoes?</h2>
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
            <p class="text-muted">Express shipping available. Free over €100</p>
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

<!-- Testimonials Section -->
<section class="mb-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">What Our Customers Say</h2>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card" style="border: none; border-left: 4px solid #c41e3a; border-radius: 5px; padding: 1.5rem;">
                <div class="mb-3">
                    <span class="text-warning">★★★★★</span>
                </div>
                <p class="card-text" style="font-style: italic; margin-bottom: 1.5rem;">"Amazing shoes! They were so comfortable throughout the entire day. Highly recommended!"</p>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="https://via.placeholder.com/50x50?text=Sarah" class="rounded-circle" alt="Sarah" style="width: 50px; height: 50px;">
                    </div>
                    <div>
                        <p class="fw-bold mb-0">Sarah Johnson</p>
                        <p class="small text-muted mb-0">Bride, Paris</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card" style="border: none; border-left: 4px solid #c41e3a; border-radius: 5px; padding: 1.5rem;">
                <div class="mb-3">
                    <span class="text-warning">★★★★★</span>
                </div>
                <p class="card-text" style="font-style: italic; margin-bottom: 1.5rem;">"Perfect quality and excellent customer service. My shoes arrived on time!"</p>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="https://via.placeholder.com/50x50?text=Marie" class="rounded-circle" alt="Marie" style="width: 50px; height: 50px;">
                    </div>
                    <div>
                        <p class="fw-bold mb-0">Marie Dupont</p>
                        <p class="small text-muted mb-0">Bride, Lyon</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card" style="border: none; border-left: 4px solid #c41e3a; border-radius: 5px; padding: 1.5rem;">
                <div class="mb-3">
                    <span class="text-warning">★★★★★</span>
                </div>
                <p class="card-text" style="font-style: italic; margin-bottom: 1.5rem;">"Elegant design and superb craftsmanship. Worth every euro!"</p>
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="https://via.placeholder.com/50x50?text=Pierre" class="rounded-circle" alt="Pierre" style="width: 50px; height: 50px;">
                    </div>
                    <div>
                        <p class="fw-bold mb-0">Pierre Martin</p>
                        <p class="small text-muted mb-0">Groom, Marseille</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 80px 0; border-radius: 10px; text-align: center; margin-bottom: 5rem;">
    <h2 class="display-4 fw-bold mb-3">Ready to Find Your Perfect Wedding Shoes?</h2>
    <p class="lead mb-4" style="font-size: 1.2rem;">Join thousands of happy couples who found their ideal shoes with us</p>
    <a href="products.php" class="btn btn-light btn-lg px-5">
        <i class="fas fa-shopping-bag me-2"></i> Start Shopping
    </a>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
