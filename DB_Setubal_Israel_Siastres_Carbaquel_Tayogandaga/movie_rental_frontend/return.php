<?php
require_once 'includes/header.php';
require_once 'includes/config.php';
?>

<h2 class="mb-4">Process Return</h2>

<div class="form-container">
    <form action="process_return.php" method="POST">
        <div class="mb-3">
            <label for="rental" class="form-label">Select Rental</label>
            <select class="form-select" name="rental_id" required>
                <?php
                $rentals = $conn->query("
                    SELECT r.rental_id, m.title, c.first_name, c.last_name 
                    FROM Rentals r
                    JOIN Movies m ON r.movie_id = m.movie_id
                    JOIN Customers c ON r.customer_id = c.customer_id
                    WHERE r.rental_status = 'Rented'
                ");
                
                while ($rental = $rentals->fetch_assoc()) {
                    echo "<option value='{$rental['rental_id']}'>";
                    echo "#{$rental['rental_id']} - {$rental['title']} ({$rental['first_name']} {$rental['last_name']})";
                    echo "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Process Return</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>