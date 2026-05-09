<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header('Location: ../login.php');
    exit();
}

// Get form data
$order_id = isset($_POST['order_id']) ? intval($_POST['order_id']) : 0;
$status = isset($_POST['status']) ? htmlspecialchars($_POST['status']) : '';

// Validation
if ($order_id <= 0 || empty($status)) {
    header('Location: ../admin/orders.php?error=Invalid request');
    exit;
}

// Allowed statuses
$allowed_statuses = ['pending', 'confirmed', 'shipped', 'delivered', 'denied'];
if (!in_array($status, $allowed_statuses)) {
    header('Location: ../admin/orders.php?error=Invalid status');
    exit;
}

// Include necessary files
require_once '../includes/config.php';
require_once '../class/order.class.php';

// Update order status
$order = new Order();
$order->updateOrderStatus($order_id, $status);

// Set success message
$status_text = ucfirst($status);
header("Location: ../admin/orders.php?success=Order status updated to " . urlencode($status_text));
exit;
?>
