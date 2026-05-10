<?php
$page_title = "Login";
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <!-- Login Card -->
        <div class="card shadow-lg" style="border: none; border-radius: 15px; overflow: hidden; margin-top: 3rem; margin-bottom: 3rem;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 2rem; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">
                    <i class="fas fa-shoe-prints"></i>
                </div>
                <h3 class="fw-bold mb-2">Welcome Back</h3>
                <p class="mb-0" style="opacity: 0.9;">Sign in to your Wedding Shoes account</p>
            </div>

            <!-- Form Body -->
            <div class="card-body" style="padding: 2.5rem;">
                <form action="controllers/connexion.php" method="POST" id="loginForm" novalidate>
                    <!-- Email Field -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold" style="color: #333;">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                <i class="fas fa-envelope" style="color: #c41e3a; width: 20px;"></i>
                            </span>
                            <input 
                                type="email" 
                                class="form-control" 
                                id="email" 
                                name="email" 
                                placeholder="your@email.com" 
                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                        </div>
                        <div class="invalid-feedback" style="display: block;">
                            Please provide a valid email address.
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold" style="color: #333;">Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                <i class="fas fa-lock" style="color: #c41e3a; width: 20px;"></i>
                            </span>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password" 
                                name="password" 
                                placeholder="Enter your password" 
                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                            <button 
                                class="btn" 
                                type="button" 
                                id="togglePassword" 
                                style="background-color: #f8f9fa; border: 1px solid #dee2e6;"
                                onclick="togglePasswordVisibility()"
                            >
                                <i class="fas fa-eye" id="eyeIcon" style="color: #c41e3a;"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback" style="display: block;">
                            Please enter your password.
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="btn w-100 fw-bold" 
                        style="
                            background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%);
                            color: white;
                            padding: 0.85rem;
                            border: none;
                            border-radius: 8px;
                            font-size: 1.1rem;
                            transition: all 0.3s ease;
                        "
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 16px rgba(196, 30, 58, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';"
                    >
                        <i class="fas fa-sign-in-alt me-2"></i> Sign In
                    </button>

                    <!-- Divider -->
                    <div class="my-4 position-relative">
                        <div style="border-top: 1px solid #dee2e6;"></div>
                        <span style="
                            position: absolute;
                            top: -12px;
                            left: 50%;
                            transform: translateX(-50%);
                            background: white;
                            padding: 0 10px;
                            color: #999;
                            font-size: 0.9rem;
                        ">OR</span>
                    </div>

                    <!-- Social Login (Optional) -->
                    <div class="d-grid gap-2">
                        <button 
                            type="button" 
                            class="btn" 
                            style="
                                background-color: #f8f9fa;
                                border: 1px solid #dee2e6;
                                color: #333;
                                padding: 0.75rem;
                                border-radius: 8px;
                            "
                            onclick="alert('Social login not implemented yet')"
                        >
                            <i class="fab fa-google" style="color: #db4437;"></i> Continue with Google
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div style="background-color: #f8f9fa; padding: 1.5rem; text-align: center; border-top: 1px solid #dee2e6;">
                <p class="mb-0" style="color: #666; font-size: 0.95rem;">
                    Don't have an account?
                    <a href="register.php" style="color: #c41e3a; text-decoration: none; font-weight: bold;">
                        Sign Up Here
                    </a>
                </p>
            </div>
        </div>

        <!-- Security Info -->
       

<script>
// Toggle password visibility
function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}

// Form validation
document.getElementById('loginForm').addEventListener('submit', function(e) {
    if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
    }
    this.classList.add('was-validated');
});

// Clear validation on input
document.getElementById('email').addEventListener('input', function() {
    this.classList.remove('is-invalid');
});

document.getElementById('password').addEventListener('input', function() {
    this.classList.remove('is-invalid');
});
</script>

<?php
include 'includes/footer.php';
?>
