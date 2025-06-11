<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/config.php'; ?>

<h2 class="mb-4">Dashboard</h2>

<div class="row">
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                Active Rentals
            </div>
            <div class="card-body">
                <?php
                $result = $conn->query("
                    SELECT m.title, c.first_name, c.last_name, r.due_date 
                    FROM Rentals r
                    JOIN Movies m ON r.movie_id = m.movie_id
                    JOIN Customers c ON r.customer_id = c.customer_id
                    WHERE r.rental_status = 'Rented'
                    LIMIT 5
                ");
                
                if ($result->num_rows > 0) {
                    echo '<ul class="list-group">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item d-flex justify-content-between">
                                <span>'.$row['title'].'</span>
                                <small class="text-muted">Due: '.date('M j', strtotime($row['due_date'])).'</small>
                              </li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No active rentals</p>';
                }
                ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                Quick Stats
            </div>
            <div class="card-body">
                <?php
                $movies = $conn->query("SELECT COUNT(*) AS total FROM Movies")->fetch_assoc();
                $available = $conn->query("SELECT COUNT(*) AS available FROM Movies WHERE available_quantity > 0")->fetch_assoc();
                $rentals = $conn->query("SELECT COUNT(*) AS active FROM Rentals WHERE rental_status = 'Rented'")->fetch_assoc();
                
                echo '<p>Total Movies: <strong>'.$movies['total'].'</strong></p>
                      <p>Available Now: <strong>'.$available['available'].'</strong></p>
                      <p>Active Rentals: <strong>'.$rentals['active'].'</strong></p>';
                ?>
            </div>
        </div>
    </div>
    <div class="mt-5">
    <h3>Rental History</h3>
    <table class="table">
        <?php
        $history = $conn->query("
            SELECT m.title, c.first_name, c.last_name, 
                   r.rental_date, r.return_date
            FROM Rentals r
            JOIN Movies m ON r.movie_id = m.movie_id
            JOIN Customers c ON r.customer_id = c.customer_id
            WHERE r.is_active = FALSE
            ORDER BY r.return_date DESC
            LIMIT 5
        ");
        
        while ($row = $history->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['first_name']} {$row['last_name']}</td>
                    <td>{$row['rental_date']}</td>
                    <td>{$row['return_date']}</td>
                  </tr>";
        }
        ?>
    </table>
</div>
</div>

<?php include 'includes/footer.php'; ?>