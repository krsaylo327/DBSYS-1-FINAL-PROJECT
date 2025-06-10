<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM Products WHERE product_id = ?");
    $stmt->execute([$id]);
}

header('Location: products.php');
exit;
