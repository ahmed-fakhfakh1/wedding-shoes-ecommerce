<?php
$page_title = "Register";
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <!-- Register Card -->
        <div class="card shadow-lg" style="border: none; border-radius: 15px; overflow: hidden; margin-top: 3rem; margin-bottom: 3rem;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #c41e3a 0%, #8b1428 100%); color: white; padding: 2rem; text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="fw-bold mb-2">Create Account</h3>
                <p class="mb-0" style="opacity: 0.9;">Join Wedding Shoes for exclusive offers</p>
            </div>

            <!-- Form Body -->
            <div class="card-body" style="padding: 2.5rem;">
                <form action="controllers/inscription.php" method="POST" id="registerForm" novalidate>
                    <!-- Full Name Field -->
                    <div class="mb-4">
                        <label for="fullname" class="form-label fw-bold" style="color: #333;">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                <i class="fas fa-user" style="color: #c41e3a; width: 20px;"></i>
                            </span>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="fullname" 
                                name="fullname" 
                                
                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                        </div>
                        <div class="invalid-feedback" style="display: block;">
                        </div>
                    </div>

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
                               
                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                        </div>
                        <div class="invalid-feedback" style="display: block;">
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label for="phone" class="form-label fw-bold" style="color: #333;">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                <i class="fas fa-phone" style="color: #c41e3a; width: 20px;"></i>
                            </span>
                            <input 
                                type="tel" 
                                class="form-control" 
                                id="phone" 
                                name="phone" 
                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                        </div>
                        <div class="invalid-feedback" style="display: block;">
                        </div>
                    </div>

                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="form-label fw-bold" style="color: #333;">Address</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                <i class="fas fa-map-marker-alt" style="color: #c41e3a; width: 20px;"></i>
                            </span>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="address" 
                                name="address" 

                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                        </div>
                        <div class="invalid-feedback" style="display: block;">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-4">
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
                                required
                                minimum="6"
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                            <button 
                                class="btn" 
                                type="button" 
                                onclick="togglePasswordVisibility('password', 'eyeIcon1')"
                                style="background-color: #f8f9fa; border: 1px solid #dee2e6;"
                            >
                                <i class="fas fa-eye" id="eyeIcon1" style="color: #c41e3a;"></i>
                            </button>
                        </div>
                        
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label fw-bold" style="color: #333;">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f9fa; border: 1px solid #dee2e6;">
                                <i class="fas fa-lock" style="color: #c41e3a; width: 20px;"></i>
                            </span>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="confirm_password" 
                                name="confirm_password" 
                                required
                                style="border: 1px solid #dee2e6; padding: 0.75rem 1rem;"
                            >
                            <button 
                                class="btn" 
                                type="button" 
                                onclick="togglePasswordVisibility('confirm_password', 'eyeIcon2')"
                                style="background-color: #f8f9fa; border: 1px solid #dee2e6;"
                            >
                                <i class="fas fa-eye" id="eyeIcon2" style="color: #c41e3a;"></i>
                            </button>
                        </div>
                        
                    </div>

                    <!-- Terms & Conditions -->
                    

                    <!-- Newsletter Opt-in -->
                  

                    <!-- Register Button -->
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
                        <i class="fas fa-user-plus me-2"></i> Create Account
                    </button>
                </form>
            </div>

            <!-- Footer -->
            <div style="background-color: #f8f9fa; padding: 1.5rem; text-align: center; border-top: 1px solid #dee2e6;">
                <p class="mb-0" style="color: #666; font-size: 0.95rem;">
                    Already have an account?
                    <a href="login.php" style="color: #c41e3a; text-decoration: none; font-weight: bold;">
                        Sign In Here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
function togglePasswordVisibility(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Form validation
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    
    // Check if passwords match
    if (password !== confirmPassword) {
        document.getElementById('confirm_password').classList.add('is-invalid');
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Check password length
    if (password.length < 6) {
        document.getElementById('password').classList.add('is-invalid');
        e.preventDefault();
        e.stopPropagation();
    }
    
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

document.getElementById('confirm_password').addEventListener('input', function() {
    this.classList.remove('is-invalid');
});
</script>

<?php
include 'includes/footer.php';
?>
