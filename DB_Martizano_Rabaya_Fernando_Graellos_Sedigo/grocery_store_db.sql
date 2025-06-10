-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 05:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery_store_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `IncreasePriceByCategory` (IN `cat` VARCHAR(50), IN `percent` DECIMAL(5,2))   BEGIN
    UPDATE Products
    SET price = price + (price * percent / 100)
    WHERE category = cat;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `email`, `phone`, `address`) VALUES
(1, 'John Doe', 'johndoe@email.com', '0911000001', '123 Elm Street'),
(2, 'Jane Smith', 'janesmith@email.com', '0911000002', '456 Oak Avenue'),
(3, 'Alice Brown', 'aliceb@email.com', '0911000003', '789 Pine Road'),
(4, 'Bob Green', 'bobg@email.com', '0911000004', '321 Maple Lane'),
(5, 'Cathy White', 'cathyw@email.com', '0911000005', '654 Cedar Blvd'),
(6, 'David Black', 'davidb@email.com', '0911000006', '987 Birch Way'),
(7, 'Ella Blue', 'ellab@email.com', '0911000007', '159 Spruce Court'),
(8, 'Frank Red', 'frankr@email.com', '0911000008', '753 Willow Drive'),
(9, 'Grace Pink', 'gracep@email.com', '0911000009', '852 Aspen Street'),
(10, 'Henry Gold', 'henryg@email.com', '0911000010', '951 Poplar Avenue');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT curdate(),
  `order_time` time NOT NULL DEFAULT curtime(),
  `total_amount` decimal(10,2) NOT NULL CHECK (`total_amount` >= 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `order_time`, `total_amount`) VALUES
(1, 1, '2025-06-01', '09:15:00', 8.40),
(2, 2, '2025-06-01', '10:30:00', 5.60),
(3, 3, '2025-06-02', '11:45:00', 12.00),
(4, 4, '2025-06-02', '12:00:00', 7.50),
(5, 5, '2025-06-03', '13:20:00', 15.00),
(6, 6, '2025-06-03', '14:05:00', 6.80),
(7, 7, '2025-06-04', '15:10:00', 9.30),
(8, 8, '2025-06-04', '16:25:00', 11.40),
(9, 9, '2025-06-05', '17:00:00', 13.80),
(10, 10, '2025-06-05', '18:15:00', 10.50),
(11, 1, '2025-06-06', '22:30:29', 3.60),
(12, 1, '2025-06-06', '23:12:58', 2.40);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL CHECK (`quantity` > 0),
  `price` decimal(10,2) NOT NULL CHECK (`price` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 1.20),
(2, 1, 2, 3, 0.80),
(3, 1, 4, 1, 2.00),
(4, 2, 3, 4, 0.50),
(5, 2, 5, 2, 1.50),
(6, 3, 6, 2, 2.50),
(7, 3, 7, 1, 4.00),
(8, 3, 8, 3, 1.00),
(9, 4, 9, 2, 2.20),
(10, 4, 10, 3, 0.90),
(11, 5, 2, 5, 0.80),
(12, 5, 4, 2, 2.00),
(13, 5, 5, 3, 1.50),
(14, 6, 1, 1, 1.20),
(15, 6, 7, 2, 4.00),
(16, 7, 3, 6, 0.50),
(17, 7, 8, 2, 1.00),
(18, 8, 6, 3, 2.50),
(19, 8, 9, 1, 2.20),
(20, 9, 10, 4, 0.90),
(21, 9, 5, 2, 1.50),
(22, 10, 2, 3, 0.80),
(23, 10, 4, 1, 2.00),
(24, 11, 1, 3, 1.20),
(25, 11, 1, 2, 1.20);

--
-- Triggers `order_items`
--
DELIMITER $$
CREATE TRIGGER `trg_update_stock_after_sale` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
    UPDATE Products
    SET stock_qty = stock_qty - NEW.quantity
    WHERE product_id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL CHECK (`price` > 0),
  `stock_qty` int(11) NOT NULL DEFAULT 0 CHECK (`stock_qty` >= 0),
  `supplier_id` int(11) DEFAULT NULL,
  `product_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category`, `price`, `stock_qty`, `supplier_id`, `product_code`) VALUES
(1, 'Apple', 'Fruit', 1.20, 93, 1, 'PRD001'),
(2, 'Banana', 'Fruit', 0.80, 120, 2, 'PRD002'),
(3, 'Carrot', 'Vegetable', 0.50, 80, 4, 'PRD003'),
(4, 'Milk', 'Dairy', 2.42, 60, 8, 'PRD004'),
(5, 'Bread', 'Bakery', 1.50, 50, 10, 'PRD005'),
(6, 'Eggs', 'Dairy', 3.03, 70, 8, 'PRD006'),
(7, 'Chicken Breast', 'Meat', 4.00, 40, 3, 'PRD007'),
(8, 'Rice', 'Grain', 1.00, 200, 7, 'PRD008'),
(9, 'Orange Juice', 'Beverage', 2.20, 30, 9, 'PRD009'),
(10, 'Tomato', 'Vegetable', 0.90, 90, 4, 'PRD010');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `contact_info`) VALUES
(1, 'Fresh Farms', 'freshfarms@email.com, 0912345678'),
(2, 'Green Valley', 'greenvalley@email.com, 0923456789'),
(3, 'Oceanic Foods', 'oceanic@email.com, 0934567890'),
(4, 'Sunrise Produce', 'sunrise@email.com, 0945678901'),
(5, 'Urban Organics', 'urban@email.com, 0956789012'),
(6, 'Healthy Harvest', 'harvest@email.com, 0967890123'),
(7, 'Golden Grains', 'golden@email.com, 0978901234'),
(8, 'Prime Dairy', 'prime@email.com, 0989012345'),
(9, 'Sweet Orchard', 'orchard@email.com, 0990123456'),
(10, 'Daily Essentials', 'essentials@email.com, 0901234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_customer_name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_code` (`product_code`),
  ADD KEY `fk_supplier_2` (`supplier_id`),
  ADD KEY `idx_product_category` (`category`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `fk_supplier_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`supplier_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
