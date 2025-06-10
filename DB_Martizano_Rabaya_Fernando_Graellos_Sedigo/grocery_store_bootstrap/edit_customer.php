<?php
require_once 'config/database.php';

$id = $_GET['id'] ?? null;
$message = '';

if (!$id) {
    die('Customer ID not specified.');
}

// Fetch customer data
$stmt = $pdo->prepare("SELECT * FROM Customers WHERE customer_id = ?");
$stmt->execute([$id]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$customer) {
    die('Customer not found.');
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';

    if ($name && $email) {
        $stmt = $pdo->prepare("UPDATE Customers SET name=?, email=?, phone=?, address=? WHERE customer_id=?");
        try {
            $stmt->execute([$name, $email, $phone, $address, $id]);
            $message = '<div class="alert alert-success">Customer updated successfully!</div>';
            // Refresh customer data
            $stmt = $pdo->prepare("SELECT * FROM Customers WHERE customer_id = ?");
            $stmt->execute([$id]);
            $customer = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Edit Customer - Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Customer</h2>
    <a href="customers.php" class="btn btn-secondary mb-3">Back to Customer List</a>
    <?= $message ?>
    <form method="post" class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($customer['name']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($customer['email']) ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($customer['phone']) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($customer['address']) ?>">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Update Customer</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
