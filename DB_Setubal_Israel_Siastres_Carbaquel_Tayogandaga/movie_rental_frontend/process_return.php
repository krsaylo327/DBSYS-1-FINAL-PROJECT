<?php
require_once 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rental_id = (int)$_POST['rental_id'];
    
    // Call the stored procedure
    $result = $conn->query("CALL ProcessReturn($rental_id)");
    
    if ($result) {
        header("Location: index.php?success=Return+processed+successfully");
    } else {
        header("Location: return.php?error=" . urlencode($conn->error));
    }
    exit;
}


header("Location: return.php");
?>