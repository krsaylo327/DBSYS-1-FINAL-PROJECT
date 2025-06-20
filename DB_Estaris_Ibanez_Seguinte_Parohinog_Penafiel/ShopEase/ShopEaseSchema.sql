-- Clean ShopEase SQL Schema (No Procedures, No Triggers)

-- Disable FK checks to avoid constraint errors
SET FOREIGN_KEY_CHECKS = 0;

-- Drop existing tables in correct order
DROP TABLE IF EXISTS Ratings;
DROP TABLE IF EXISTS Reviews;
DROP TABLE IF EXISTS Customers;
DROP TABLE IF EXISTS Products;

-- Re-enable FK checks
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Products Table
CREATE TABLE Products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL CHECK (price >= 0),
    avg_rating DECIMAL(3,2) DEFAULT 0
);

-- 2. Customers Table
CREATE TABLE Customers (
    customer_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100)
);

-- 3. Reviews Table
CREATE TABLE Reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    customer_id INT,
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id) ON DELETE CASCADE
);

-- 4. Ratings Table
CREATE TABLE Ratings (
    rating_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT,
    customer_id INT,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id) ON DELETE CASCADE
);

-- 5. Sample Products
INSERT INTO Products (name, category, price, avg_rating) VALUES
('Smartphone X200', 'Electronics', 499.00, 4.5),
('Noise Cancelling Headphones', 'Electronics', 199.00, 4.0),
('Classic Sneakers', 'Fashion', 89.00, 3.8),
('Urban Backpack', 'Fashion', 59.00, 4.2),
('Minimalist Watch', 'Accessories', 129.00, 4.6),
('Polarized Sunglasses', 'Accessories', 49.00, 4.1);

-- 6. Sample Customers
INSERT INTO Customers (name, email, password) VALUES
('Alice', 'alice@example.com', 'password123'),
('Bob', 'bob@example.com', 'password456');

-- 7. Sample Reviews
INSERT INTO Reviews (product_id, customer_id, review_text) VALUES
(1, 1, 'Great smartphone for the price!'),
(2, 2, 'The noise cancelling is excellent.');

-- 8. Sample Ratings
INSERT INTO Ratings (product_id, customer_id, rating) VALUES
(1, 1, 5),
(2, 2, 4);
