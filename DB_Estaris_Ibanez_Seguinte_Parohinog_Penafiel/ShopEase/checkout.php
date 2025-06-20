<?php include('connect.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopEase | Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="main-header">
        <div class="logo">ShopEase</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="catalog.php">Shop</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="checkout.php" class="active">Checkout</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li class="admin-account"><span>Admin</span></li>
            </ul>
        </nav>
        <div class="hamburger-menu">&#9776;</div>
    </header>
    <main>
        <section class="checkout-section">
            <h2>Checkout</h2>
            <form class="checkout-form">
               
                <fieldset>
                    <legend>Billing Information</legend>
                    <label>Full Name
                        <input type="text" placeholder="John Doe" disabled>
                    </label>
                    <label>Email
                        <input type="email" placeholder="john@example.com" disabled>
                    </label>
                    <label>Address
                        <input type="text" placeholder="123 Main St" disabled>
                    </label>
                    <label>City
                        <input type="text" placeholder="City" disabled>
                    </label>
                    <label>Country
                        <input type="text" placeholder="Country" disabled>
                    </label>
                </fieldset>
                <fieldset>
                    <legend>Payment</legend>
                    <label>Card Number
                        <input type="text" placeholder="1234 5678 9012 3456" disabled>
                    </label>
                    <label>Expiry
                        <input type="text" placeholder="MM/YY" disabled>
                    </label>
                    <label>CVV
                        <input type="text" placeholder="123" disabled>
                    </label>
                </fieldset>
                <button type="submit" class="checkout-btn" disabled>Place Order</button>
            </form>
            <div class="admin-note">Logged in as <strong>Admin</strong></div>
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
            <div class="footer-section">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"><svg width="20" height="20" fill="currentColor"><use href="#icon-facebook"/></svg></a>
                    <a href="#" aria-label="Twitter"><svg width="20" height="20" fill="currentColor"><use href="#icon-twitter"/></svg></a>
                    <a href="#" aria-label="Instagram"><svg width="20" height="20" fill="currentColor"><use href="#icon-instagram"/></svg></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">&copy; 2025 ShopEase. All rights reserved.</div>
        <svg style="display:none">
            <symbol id="icon-facebook" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.005 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.632.771-1.632 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 17.005 22 12z"/></symbol>
            <symbol id="icon-twitter" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.59-2.47.69a4.3 4.3 0 0 0 1.88-2.37 8.59 8.59 0 0 1-2.72 1.04A4.28 4.28 0 0 0 16.11 4c-2.37 0-4.29 1.92-4.29 4.29 0 .34.04.67.11.99C7.69 8.99 4.07 7.13 1.64 4.15c-.37.64-.58 1.39-.58 2.19 0 1.51.77 2.84 1.94 3.62-.72-.02-1.39-.22-1.98-.55v.06c0 2.11 1.5 3.87 3.5 4.27-.36.1-.74.16-1.13.16-.28 0-.54-.03-.8-.08.54 1.68 2.12 2.91 3.99 2.94A8.6 8.6 0 0 1 2 19.54c-.29 0-.57-.02-.85-.05A12.13 12.13 0 0 0 8.29 21.5c7.55 0 11.68-6.26 11.68-11.68 0-.18-.01-.36-.02-.54A8.18 8.18 0 0 0 22.46 6z"/></symbol>
            <symbol id="icon-instagram" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.584.012 4.85.07 1.17.056 1.97.24 2.43.41.59.22 1.01.48 1.45.92.44.44.7.86.92 1.45.17.46.354 1.26.41 2.43.058 1.266.07 1.65.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.24 1.97-.41 2.43-.22.59-.48 1.01-.92 1.45-.44.44-.86.7-1.45.92-.46.17-1.26.354-2.43.41-1.266.058-1.65.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.97-.24-2.43-.41-.59-.22-1.01-.48-1.45-.92-.44-.44-.7-.86-.92-1.45-.17-.46-.354-1.26-.41-2.43C2.212 15.584 2.2 15.2 2.2 12s.012-3.584.07-4.85c.056-1.17.24-1.97.41-2.43.22-.59.48-1.01.92-1.45.44-.44.86-.7 1.45-.92.46-.17 1.26-.354 2.43-.41C8.416 2.212 8.8 2.2 12 2.2zm0-2.2C8.736 0 8.332.013 7.052.072 5.77.13 4.77.31 3.97.54c-.8.23-1.48.54-2.16 1.22-.68.68-.99 1.36-1.22 2.16-.23.8-.41 1.8-.47 3.08C.013 8.332 0 8.736 0 12c0 3.264.013 3.668.072 4.948.058 1.28.24 2.28.47 3.08.23.8.54 1.48 1.22 2.16.68.68 1.36.99 2.16 1.22.8.23 1.8.41 3.08.47C8.332 23.987 8.736 24 12 24s3.668-.013 4.948-.072c1.28-.058 2.28-.24 3.08-.47.8-.23 1.48-.54 2.16-1.22.68-.68.99-1.36 1.22-2.16.23-.8.41-1.8.47-3.08.059-1.28.072-1.684.072-4.948 0-3.264-.013-3.668-.072-4.948-.058-1.28-.24-2.28-.47-3.08-.23-.8-.54-1.48-1.22-2.16-.68-.68-1.36-.99-2.16-1.22-.8-.23-1.8-.41-3.08-.47C15.668.013 15.264 0 12 0z"/><circle cx="12" cy="12" r="3.6"/><circle cx="18.406" cy="5.594" r="1.44"/></symbol>
        </svg>
    </footer>
</body>
</html>


