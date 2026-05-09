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
            <a href="products-men.php" style="text-decoration: none;">
                <div class="category-card" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.9), rgba(27, 27, 27, 0.9)), url('https://via.placeholder.com/500x300?text=Men+Shoes'); background-size: cover; background-position: center; height: 300px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.3)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    <div class="text-center">
                        <h3 class="display-6 fw-bold mb-3">
                            <i class="fas fa-shoe-prints"></i> Men's Shoes
                        </h3>
                        <p style="font-size: 1.1rem;">Elegant Options for Grooms</p>
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
                        <p style="font-size: 1.1rem;">Exquisite Choices for Brides</p>
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

<!-- Shoe Care Tips Section -->
<section class="mb-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 fw-bold mb-3">Wedding Shoe Care Tips</h2>
        <p class="text-muted" style="font-size: 1.1rem;">Maintain the beauty of your wedding shoes for years to come</p>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-droplet" style="color: #c41e3a; margin-right: 0.5rem;"></i>Water Protection
                    </h5>
                    <p class="card-text text-muted">
                        Apply a quality water-resistant spray to your wedding shoes before the big day. This protective coating will help repel water and stains, keeping your shoes looking pristine throughout your special event.
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
                        Store your wedding shoes in a cool, dry place, preferably in the original box or a shoe bag. Keep them away from direct sunlight and extreme temperatures. Use shoe trees to maintain their shape.
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
                        Never wear your wedding shoes for the first time on your wedding day! Break them in at home for a few hours each day starting 2-3 weeks before the event. This ensures maximum comfort when you really need it.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Wedding Shoes Section -->
<section class="mb-5 py-5" style="background: linear-gradient(135deg, rgba(196, 30, 58, 0.05) 0%, rgba(27, 27, 27, 0.05) 100%); border-radius: 10px; padding: 3rem;">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h2 class="display-5 fw-bold mb-3">The History of Wedding Shoes</h2>
            <p class="lead text-muted mb-3">
                Wedding shoes have been an integral part of bridal traditions for centuries. From ancient times to modern ceremonies, the shoes worn on a wedding day carry deep cultural significance.
            </p>
            <p class="text-muted mb-3">
                Traditionally, wedding shoes symbolize the journey of marriage and represent the bride and groom's readiness to step into their new life together. In many cultures, the condition and beauty of the bride's shoes were considered indicators of the couple's prosperity and happiness.
            </p>
            <p class="text-muted mb-3">
                Today, wedding shoes represent personal style, comfort, and the perfect balance between tradition and modern fashion. Whether you choose classic formal shoes or contemporary designs, the right pair can complete your wedding day look.
            </p>
        </div>
        <div class="col-lg-6">
            <div style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); border-radius: 10px; padding: 2rem; color: white; text-align: center; box-shadow: 0 8px 24px rgba(196, 30, 58, 0.2);">
                <i class="fas fa-shoe-prints" style="font-size: 4rem; margin-bottom: 1rem; display: block; opacity: 0.8;"></i>
                <h4 class="fw-bold mb-3">Why Wedding Shoes Matter</h4>
                <ul style="text-align: left; list-style: none; padding: 0;">
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Completes your wedding ensemble perfectly</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Provides all-day comfort and support</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Reflects your personal style and personality</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Creates lasting memories in photos</li>
                    <li class="mb-2"><i class="fas fa-check-circle me-2"></i> A keepsake for future generations</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>
