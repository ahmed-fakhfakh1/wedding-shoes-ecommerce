<?php
require_once('../class/user.class.php');
$us=new user();
$us->name=$_POST['fullname'];
$us->email=$_POST['email'];
$us->phone=$_POST['phone'];
$us->address=$_POST['address'];
$us->password=$_POST['password'];
$us->createUser();
header('Location: ../login.php');
exit();
?>
