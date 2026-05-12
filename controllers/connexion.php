<?php
session_start();
require_once('../class/user.class.php');
$us = new user();
$us->email = $_POST['email'];
$us->password = $_POST['password'];
$row = $us->login();
if($row) {
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];
    $_SESSION['user_email'] = $row['email'];
    $_SESSION['is_admin'] = $row['is_admin'];
    if($row['is_admin'] == 1) {
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../login.php');
    exit();
}
?>
