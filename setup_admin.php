<?php
require_once('includes/config.php');

$cnx = new connexion();
$pdo = $cnx->cnxBase();

// Simple password
$password = "admin";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Delete old admin users and create fresh one
$pdo->exec("DELETE FROM users WHERE email='admin@weddingshoes.com'");

// Insert new admin user with known password
$req = "INSERT INTO users (name, email, password, phone, address, is_admin) 
        VALUES ('Admin User', 'admin@weddingshoes.com', '$hashedPassword', '+33 1 23 45 67 89', '123 Admin Street, Paris, France', 1)";

$pdo->exec($req);

echo "<h2 style='color: green;'>✓ Admin user created successfully!</h2>";
echo "<h3>Login credentials:</h3>";
echo "<p><strong>Email:</strong> admin@weddingshoes.com</p>";
echo "<p><strong>Password:</strong> admin</p>";
echo "<p><a href='login.php' style='padding: 10px 20px; background-color: #c41e3a; color: white; text-decoration: none; border-radius: 5px;'>Go to Login</a></p>";
?>
