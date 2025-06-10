<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM Orders WHERE order_id = ?");
    $stmt->execute([$id]);
}

header('Location: orders.php');
exit;
