<?php
require_once 'config/database.php';
$sql = "
SELECT 
    Products.name AS product_name,
    SUM(Order_Items.quantity) AS total_sold
FROM Order_Items
JOIN Products ON Order_Items.product_id = Products.product_id
GROUP BY Products.product_id
ORDER BY total_sold DESC
";
$report = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Top-Selling Products</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Total Sold</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($report as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= htmlspecialchars($row['total_sold']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
