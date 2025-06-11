<?php
$conn = new mysqli("localhost", "root", "", "movie_rental_system"); // <-- default MySQL user
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
