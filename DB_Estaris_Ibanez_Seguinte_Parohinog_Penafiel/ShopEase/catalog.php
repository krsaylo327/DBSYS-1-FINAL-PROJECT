<?php include('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShopEase | Product Catalog</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="logo">ShopEase</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="catalog.php" class="active">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="hamburger-menu">&#9776;</div>
    </header>

    <main>
        <section class="catalog-section">
            <h2>Product Catalog</h2>
            <div class="product-grid">
                <?php
                $result = mysqli_query($conn, "SELECT * FROM Products");
                while ($product = mysqli_fetch_assoc($result)) {
                    echo '<div class="product-card">';
                    echo '<img src="https://via.placeholder.com/150" alt="' . htmlspecialchars($product['name']) . '">';
                    echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                    echo '<p class="price">₱' . number_format($product['price'], 2) . '</p>';
                    echo '<a href="product.php?id=' . $product['product_id'] . '" class="details-btn">View Details</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>ShopEase</h4>
                <p>Your one-stop shop for the latest trends and deals.</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="catalog.php">Shop</a></li>
                    <li><a href="cart.php">Cart</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Newsletter</h4>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email" disabled>
                    <button type="submit" disabled>Subscribe</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">&copy; 2025 ShopEase. All rights reserved.</div>
    </footer>
</body>
</html>
