<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
    // Validation
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If there are errors, redirect back with error message
    if (!empty($errors)) {
        $_SESSION['contact_errors'] = $errors;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    // If validation passes, save to database
    try {
        $connexion = new connexion();
        $pdo = $connexion->cnxBase();
        
        // Prepare SQL statement to insert contact message
        $sql = "INSERT INTO contact_messages (name, email, message, created_at) 
                VALUES (:name, :email, :message, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
        
        // Set success message
        $_SESSION['contact_success'] = "Thank you! Your message has been sent successfully. We'll get back to you soon.";
        
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
        
    } catch (PDOException $e) {
        // Handle database error
        $_SESSION['contact_errors'] = ["An error occurred. Please try again later."];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    // If not a POST request, redirect to home
    header('Location: ../index.php');
    exit();
}
?>
