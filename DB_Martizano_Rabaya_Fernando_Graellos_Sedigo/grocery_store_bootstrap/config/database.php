<?php
// config/database.php

$host = 'localhost';
$db   = 'grocery_store_db'; // Use your actual database name
$user = 'root';             // Default XAMPP username
$pass = '';                 // Default XAMPP password is empty

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set error mode to exception for debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
