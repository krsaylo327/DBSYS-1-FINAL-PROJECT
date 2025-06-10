<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM Customers WHERE customer_id = ?");
    $stmt->execute([$id]);
}

header('Location: customers.php');
exit;
