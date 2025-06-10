<?php
require_once 'includes/header.php';
require_once 'includes/config.php';
?>

<h2 class="mb-4">Rent a Movie</h2>

<div class="form-container">
    <form action="process_rental.php" method="POST">
        <div class="mb-3">
            <label for="customer" class="form-label">Customer</label>
            <select class="form-select" name="customer_id" required>
                <?php
                $customers = $conn->query("SELECT customer_id, first_name, last_name FROM Customers");
                while ($customer = $customers->fetch_assoc()) {
                    echo "<option value='{$customer['customer_id']}'>";
                    echo "{$customer['first_name']} {$customer['last_name']}";
                    echo "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="movie" class="form-label">Movie</label>
            <select class="form-select" name="movie_id" required>
                <?php
                $movies = $conn->query("SELECT movie_id, title FROM Movies WHERE available_quantity > 0");
                while ($movie = $movies->fetch_assoc()) {
                    echo "<option value='{$movie['movie_id']}'>{$movie['title']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="days" class="form-label">Rental Days</label>
            <input type="number" class="form-control" name="days" min="1" value="3" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Rental</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>