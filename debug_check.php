<?php
require_once('includes/config.php');

$cnx = new connexion();
$pdo = $cnx->cnxBase();

// Check all users in database
echo "<h2>All Users in Database:</h2>";
$req = "SELECT id, name, email, is_admin FROM users";
$result = $pdo->query($req);
$users = $result->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($users);
echo "</pre>";

// Specifically check admin@weddingshoes.com
echo "<h2>Looking for admin@weddingshoes.com:</h2>";
$req2 = "SELECT * FROM users WHERE email='admin@weddingshoes.com'";
$result2 = $pdo->query($req2);
$admin_user = $result2->fetch(PDO::FETCH_ASSOC);
echo "<pre>";
print_r($admin_user);
echo "</pre>";
?>
