        </div>
    </main>
    <!-- Footer Styles -->
    <style>
        .footer-custom {
            background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%);
            box-shadow: 0 -4px 12px rgba(196, 30, 58, 0.3);
        }
        .footer-custom a {
            color: white !important;
            transition: all 0.3s ease;
        }
        .footer-custom a:hover {
            color: #ffffff !important;
            transform: translateY(-2px);
            display: inline-block;
        }
        .footer-custom .form-control {
            background-color: rgba(255,255,255,0.1) !important;
            border: 1px solid rgba(255,255,255,0.2) !important;
            color: white !important;
            padding: 0.4rem 0.6rem;
            font-size: 0.9rem;
        }
        .footer-custom .form-control::placeholder {
            color: rgba(255,255,255,0.6);
        }
        .footer-custom h5 {
            font-size: 1.1rem;
            margin-bottom: 0.8rem;
        }
        .footer-custom p {
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            color: white !important;
        }
    </style>
    <!-- Footer -->
    <footer class="footer-custom text-white mt-5 py-3">
        <div class="container">
            <div class="row">
                <!-- Company Info -->
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="mb-2">
                         Shoes Hub
                    </h5>
                    <p class="text-white mb-2">
                        Your premier destination for quality and comfortable shoes for men and women. 
                        Find the perfect pair for every style and occasion.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-white me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <!-- Contact Form -->
                <div class="col-md-6" id="contact">
                    <h5 class="mb-2">Quick Contact</h5>
                    <!-- Display messages -->
                    <?php
                    if (isset($_SESSION['contact_success'])) {
                        echo '<div class="alert alert-success alert-dismissible fade show mb-2" role="alert" style="font-size: 0.85rem; padding: 0.5rem 0.8rem;">
                            ' . $_SESSION['contact_success'] . '
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        unset($_SESSION['contact_success']);
                    }
                    if (isset($_SESSION['contact_errors'])) {
                        foreach ($_SESSION['contact_errors'] as $error) {
                            echo '<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert" style="font-size: 0.85rem; padding: 0.5rem 0.8rem;">
                                ' . $error . '
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                        }
                        unset($_SESSION['contact_errors']);
                    }
                    ?>
                    <form action="controllers/contact_form.php" method="POST" style="background-color: rgba(255,255,255,0.05); padding: 0.8rem; border-radius: 8px;">
                        <div class="mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                        </div>
                        <div class="mb-2">
                            <textarea name="message" class="form-control" placeholder="Your Message" rows="2" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-light btn-sm w-100">Send Message</button>
                    </form>
                </div>
            </div>
            <!-- Bottom Footer -->
            <div class="row" style="margin-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1rem;">
                <div class="col-md-6">
                    <p class="text-white small mb-0">
                        &copy; 2026 Shoes Hub. All Rights Reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-unstyled small text-white mb-0">
                        <li class="d-inline me-2"><a href="privacy.php" class="text-white text-decoration-none">Privacy Policy</a></li>
                        <li class="d-inline me-2"><a href="terms.php" class="text-white text-decoration-none">Terms of Service</a></li>
                        <li class="d-inline"><a href="returns.php" class="text-white text-decoration-none">Returns</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
