# Wedding Shoes E-Commerce Store

A modern PHP/MySQL e-commerce platform for selling wedding shoes for men and women.

## Features

- **User Authentication** - Registration, login, and session management
- **Admin Dashboard** - Manage products, orders, and view statistics
- **Product Management** - Create, edit, and delete wedding shoe products
- **Product Categories** - Organize shoes by gender (Men/Women) and category
- **Responsive Design** - Bootstrap 5 mobile-friendly interface
- **Secure Login** - Password hashing with PHP's `password_hash()` function

## Project Structure

```
├── admin/                   # Admin panel pages
│   ├── dashboard.php       # Admin dashboard
│   ├── products.php        # Product listing
│   ├── create_product.php  # Create new product
│   └── edit_product.php    # Edit product
├── class/                   # PHP classes
│   ├── user.class.php      # User model
│   └── product.class.php   # Product model
├── controllers/             # Business logic
│   ├── connexion.php       # Login handler
│   ├── inscription.php     # Registration handler
│   ├── logout.php          # Logout handler
│   ├── create_product.php  # Create product handler
│   ├── update_product.php  # Update product handler
│   └── delete_product.php  # Delete product handler
├── includes/               # Reusable components
│   ├── config.php         # Database configuration
│   ├── header.php         # Navigation header
│   └── footer.php         # Footer
├── css/                    # Stylesheets
│   └── style.css          # Custom styling
├── js/                     # JavaScript files
│   └── script.js          # Custom scripts
├── uploads/               # Product images
├── index.php              # Home page
├── login.php              # Login page
└── register.php           # Registration page
```

## Database Setup

1. Create a MySQL database called `shoesStore`
2. Run the SQL command to create the `users` table:

```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

3. Run the SQL command to create the `products` table:

```sql
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    sku VARCHAR(100) UNIQUE NOT NULL,
    description LONGTEXT,
    gender VARCHAR(50),
    category_id INT,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT DEFAULT 0,
    color VARCHAR(100),
    size VARCHAR(50),
    material VARCHAR(100),
    style VARCHAR(100),
    image_url VARCHAR(255),
    featured TINYINT DEFAULT 0,
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/wedding-shoes-ecommerce.git
```

2. Copy the project to your web server directory (e.g., `htdocs` for XAMPP)

3. Update `includes/config.php` with your database credentials:
```php
private $db_name = 'shoesStore';
private $db_user = 'root';
private $db_password = '';
private $db_host = 'localhost';
```

4. Create the `uploads/products/` directory for product images

5. Open your browser and navigate to: `http://localhost/projetahmed%26nour/`

## Admin Credentials

To access the admin panel, create an admin user in the database:

```sql
INSERT INTO users (name, email, password, is_admin) 
VALUES ('Admin User', 'admin@weddingshoes.com', PASSWORD('admin123'), 1);
```

Then login at: `http://localhost/projetahmed%26nour/login.php`

## Usage

### For Users
- Register a new account
- Browse products
- View product details

### For Admin
- Login to admin panel
- Create new products
- Edit/delete products
- View orders and statistics

## Technologies Used

- **PHP 7+** - Server-side language
- **MySQL** - Database
- **Bootstrap 5** - Frontend framework
- **Font Awesome 6** - Icons
- **JavaScript** - Client-side interactions

## Color Scheme

- **Primary Color:** #c41e3a (Wedding Red)
- **Dark Color:** #1a1a1a (Dark Gray)
- **Accent:** Gold/Champagne

## Security

- Passwords are hashed using `password_hash()` with PASSWORD_DEFAULT
- SQL queries use PDO prepared statements
- Session-based authentication
- Admin-only access check on admin pages
- File upload validation

## Future Features

- Shopping cart functionality
- Order management system
- Payment integration (Stripe/PayPal)
- Email notifications
- User account management
- Product reviews and ratings
- Search and advanced filtering

## Contributors

- Ahmed Fakhfakh

## License

This project is for educational purposes.
