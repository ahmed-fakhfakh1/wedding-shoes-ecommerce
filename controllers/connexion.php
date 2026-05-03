<?php
session_start();
require_once('../class/user.class.php');

$us = new user();
$us->email = $_POST['email'];
$us->password = $_POST['password'];

// Check if user exists and verify password
$row = $us->login();

if($row) {
    // Login successful
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['is_admin'] = $row['is_admin'];
    
    // Check if admin
    if($row['is_admin'] == 1) {
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
} else {
    // Login failed
    header('Location: ../login.php');
    exit();
}
?>
