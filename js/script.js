/* Custom JavaScript for Wedding Shoes */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Wedding Shoes site loaded');
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});

// Function to format currency
function formatCurrency(value) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(value);
}

// Function to add to cart (will be fully implemented later)
function addToCart(productId) {
    console.log('Adding product ' + productId + ' to cart');
    // Implementation will follow
}

// Function to remove from cart
function removeFromCart(productId) {
    console.log('Removing product ' + productId + ' from cart');
    // Implementation will follow
}

// Function to show loading spinner
function showLoading() {
    const loader = document.createElement('div');
    loader.className = 'spinner-border text-primary';
    loader.role = 'status';
    document.body.appendChild(loader);
}

// Function to hide loading spinner
function hideLoading() {
    const loader = document.querySelector('.spinner-border');
    if (loader) {
        loader.remove();
    }
}

// Form validation helper
function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }
    form.classList.add('was-validated');
    return form.checkValidity();
}
