<?php
require_once 'config/database.php';

$sql = "
SELECT 
    order_date,
    SUM(total_amount) AS daily_sales
FROM Orders
GROUP BY order_date WITH ROLLUP
";
$report = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Sales - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daily Sales (with Grand Total)</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Total Sales</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($report as $row): ?>
            <tr>
                <td>
                    <?= is_null($row['order_date']) ? '<strong>Grand Total</strong>' : htmlspecialchars($row['order_date']) ?>
                </td>
                <td>
                    <?= htmlspecialchars(number_format($row['daily_sales'], 2)) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
