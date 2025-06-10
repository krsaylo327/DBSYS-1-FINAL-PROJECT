<?php
require_once 'config/database.php';

// Fetch all products
$stmt = $pdo->query("SELECT * FROM Products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Product List</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock Qty</th>
                <th>Supplier ID</th>
                <th>Product Code</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['product_id']) ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars($product['category']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td><?= htmlspecialchars($product['stock_qty']) ?></td>
                <td><?= htmlspecialchars($product['supplier_id']) ?></td>
                <td><?= htmlspecialchars($product['product_code']) ?></td>

                <td>
                <a href="edit_product.php?id=<?= $product['product_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete_product.php?id=<?= $product['product_id'] ?>" class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
