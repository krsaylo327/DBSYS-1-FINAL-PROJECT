<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? null;
$message = '';

if (!$id) {
    die('Order ID not specified.');
}

// Fetch order data
$stmt = $pdo->prepare("SELECT * FROM Orders WHERE order_id = ?");
$stmt->execute([$id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die('Order not found.');
}

// Fetch customers for dropdown
$customers = $pdo->query("SELECT customer_id, name FROM Customers")->fetchAll(PDO::FETCH_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'] ?? '';
    $order_date = $_POST['order_date'] ?? '';
    $order_time = $_POST['order_time'] ?? '';
    $total_amount = $_POST['total_amount'] ?? 0;

    if ($customer_id && $order_date && $order_time && $total_amount >= 0) {
        $stmt = $pdo->prepare("UPDATE Orders SET customer_id=?, order_date=?, order_time=?, total_amount=? WHERE order_id=?");
        try {
            $stmt->execute([$customer_id, $order_date, $order_time, $total_amount, $id]);
            $message = '<div class="alert alert-success">Order updated successfully!</div>';
            // Refresh order data
            $stmt = $pdo->prepare("SELECT * FROM Orders WHERE order_id = ?");
            $stmt->execute([$id]);
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $message = '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    } else {
        $message = '<div class="alert alert-warning">Please fill all required fields.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Order - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Order</h2>
    <a href="orders.php" class="btn btn-secondary mb-3">Back to Order List</a>
    <?= $message ?>
    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Customer *</label>
            <select name="customer_id" class="form-select" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $customer): ?>
                    <option value="<?= $customer['customer_id'] ?>" <?= $order['customer_id'] == $customer['customer_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($customer['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Order Date *</label>
            <input type="date" name="order_date" class="form-control" value="<?= htmlspecialchars($order['order_date']) ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Order Time *</label>
            <input type="time" name="order_time" class="form-control" value="<?= htmlspecialchars($order['order_time']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Total Amount *</label>
            <input type="number" name="total_amount" step="0.01" class="form-control" value="<?= htmlspecialchars($order['total_amount']) ?>" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Order</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
