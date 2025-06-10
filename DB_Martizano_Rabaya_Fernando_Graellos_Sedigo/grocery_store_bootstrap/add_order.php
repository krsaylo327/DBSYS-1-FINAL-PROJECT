<?php
require_once 'config/database.php';

$message = '';
// Fetch all customers for dropdown
$customers = $pdo->query("SELECT customer_id, name FROM Customers")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'] ?? '';
    $order_date = $_POST['order_date'] ?? date('Y-m-d');
    $order_time = $_POST['order_time'] ?? date('H:i:s');
    $total_amount = $_POST['total_amount'] ?? 0;

    if ($customer_id && $total_amount >= 0) {
        $stmt = $pdo->prepare("INSERT INTO Orders (customer_id, order_date, order_time, total_amount) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$customer_id, $order_date, $order_time, $total_amount]);
            $message = '<div class="alert alert-success">Order added successfully!</div>';
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
    <title>Add Order - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Add New Order</h2>
    <a href="orders.php" class="btn btn-secondary mb-3">Back to Order List</a>
    <?= $message ?>
    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Customer *</label>
            <select name="customer_id" class="form-select" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $customer): ?>
                    <option value="<?= $customer['customer_id'] ?>"><?= htmlspecialchars($customer['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Order Date *</label>
            <input type="date" name="order_date" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Order Time *</label>
            <input type="time" name="order_time" class="form-control" value="<?= date('H:i:s') ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Total Amount *</label>
            <input type="number" name="total_amount" step="0.01" class="form-control" required>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Add Order</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
