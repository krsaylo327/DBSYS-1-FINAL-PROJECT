<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? null;
$message = '';

if (!$id) {
    die('Product ID not specified.');
}

// Fetch product data
$stmt = $pdo->prepare("SELECT * FROM Products WHERE product_id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die('Product not found.');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock_qty = $_POST['stock_qty'] ?? 0;
    $supplier_id = $_POST['supplier_id'] ?? null;
    $product_code = $_POST['product_code'] ?? '';

    if ($name && $category && $price > 0 && $stock_qty >= 0 && $product_code) {
        $stmt = $pdo->prepare("UPDATE Products SET name=?, category=?, price=?, stock_qty=?, supplier_id=?, product_code=? WHERE product_id=?");
        try {
            $stmt->execute([$name, $category, $price, $stock_qty, $supplier_id ?: null, $product_code, $id]);
            $message = '<div class="alert alert-success">Product updated successfully!</div>';
            // Refresh product data
            $stmt = $pdo->prepare("SELECT * FROM Products WHERE product_id = ?");
            $stmt->execute([$id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        $message = '<div class="alert alert-warning">Please fill all required fields correctly.</div>';
    }
}

// Fetch suppliers for the dropdown
$suppliers = $pdo->query("SELECT supplier_id, name FROM Suppliers")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Product</h2>
    <a href="products.php" class="btn btn-secondary mb-3">Back to Product List</a>
    <?= $message ?>
    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Product Name *</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Category *</label>
            <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($product['category']) ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Price *</label>
            <input type="number" name="price" step="0.01" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Stock Quantity *</label>
            <input type="number" name="stock_qty" class="form-control" value="<?= htmlspecialchars($product['stock_qty']) ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Select Supplier (optional) --</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= $supplier['supplier_id'] ?>" <?= $product['supplier_id'] == $supplier['supplier_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($supplier['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Product Code *</label>
            <input type="text" name="product_code" class="form-control" value="<?= htmlspecialchars($product['product_code']) ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
