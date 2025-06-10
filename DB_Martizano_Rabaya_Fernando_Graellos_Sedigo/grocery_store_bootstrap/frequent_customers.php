<?php
require_once 'config/database.php';

$sql = "
SELECT 
    Customers.name AS customer_name,
    Customers.email,
    COUNT(Orders.order_id) AS order_count
FROM Customers
JOIN Orders ON Customers.customer_id = Orders.customer_id
GROUP BY Customers.customer_id
ORDER BY order_count DESC
";
$report = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Frequent Customers - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Frequent Customers</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Number of Orders</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($report as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['order_count']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
