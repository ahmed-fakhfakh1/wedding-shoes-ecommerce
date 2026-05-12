<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../includes/config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
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
    if (!empty($errors)) {
        $_SESSION['contact_errors'] = $errors;
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
    try {
        $connexion = new connexion();
        $pdo = $connexion->cnxBase();
        $sql = "INSERT INTO contact_messages (name, email, message, created_at) 
                VALUES (:name, :email, :message, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);
        $_SESSION['contact_success'] = "Thank you! Your message has been sent successfully. We'll get back to you soon.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } catch (PDOException $e) {
        $_SESSION['contact_errors'] = ["An error occurred. Please try again later."];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
