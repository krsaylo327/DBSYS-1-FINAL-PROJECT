<?php
require_once 'config/database.php';

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock_qty = $_POST['stock_qty'] ?? 0;
    $supplier_id = $_POST['supplier_id'] ?? null;
    $product_code = $_POST['product_code'] ?? '';

    // Simple validation
    if ($name && $category && $price > 0 && $stock_qty >= 0 && $product_code) {
        $stmt = $pdo->prepare("INSERT INTO Products (name, category, price, stock_qty, supplier_id, product_code)
                               VALUES (?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$name, $category, $price, $stock_qty, $supplier_id ?: null, $product_code]);
            $message = '<div class="alert alert-success">Product added successfully!</div>';
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
    <title>Add Product - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add New Product</h2>
    <a href="products.php" class="btn btn-secondary mb-3">Back to Product List</a>
    <?= $message ?>
    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Product Name *</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Category *</label>
            <input type="text" name="category" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Price *</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Stock Quantity *</label>
            <input type="number" name="stock_qty" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Supplier</label>
            <select name="supplier_id" class="form-select">
                <option value="">-- Select Supplier (optional) --</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= $supplier['supplier_id'] ?>"><?= htmlspecialchars($supplier['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Product Code *</label>
            <input type="text" name="product_code" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
