<?php
require_once 'config/database.php';

// Fetch all orders with customer names
$stmt = $pdo->query("
    SELECT Orders.*, Customers.name AS customer_name
    FROM Orders
    JOIN Customers ON Orders.customer_id = Customers.customer_id
    ORDER BY Orders.order_date DESC, Orders.order_time DESC
");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Order List</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <a href="add_order.php" class="btn btn-success mb-3">Add New Order</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Time</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= htmlspecialchars($order['order_date']) ?></td>
                <td><?= htmlspecialchars($order['order_time']) ?></td>
                <td><?= htmlspecialchars($order['total_amount']) ?></td>
                <td>
                    <a href="edit_order.php?id=<?= $order['order_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_order.php?id=<?= $order['order_id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
