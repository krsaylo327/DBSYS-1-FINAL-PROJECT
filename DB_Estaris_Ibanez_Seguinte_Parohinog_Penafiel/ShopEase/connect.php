<?php
// Database connection settings
$host = "localhost";       // Hostname (XAMPP default)
$user = "root";            // Default MySQL username in XAMPP
$password = "";            // Default password is empty
$database = "shopease_db"; // Must match your created DB name

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
