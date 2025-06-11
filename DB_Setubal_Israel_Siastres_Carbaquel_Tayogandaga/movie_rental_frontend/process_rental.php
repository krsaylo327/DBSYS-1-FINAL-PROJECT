<?php
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = (int)$_POST['customer_id'];
    $movie_id = (int)$_POST['movie_id'];
    $days = (int)$_POST['days'];
    
    // Call the stored procedure
    $result = $conn->query("CALL ProcessNewRental($customer_id, $movie_id, $days, 'Credit Card')");
    
    if ($result) {
        header("Location: index.php?success=Rental+processed+successfully");
    } else {
        header("Location: rent.php?error=" . urlencode($conn->error));
    }
    exit;
}


header("Location: rent.php");
?>