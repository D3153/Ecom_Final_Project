-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 03:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakery`
--
CREATE DATABASE IF NOT EXISTS `bakery` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bakery`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `custom_cake_id` int(11) DEFAULT NULL,
  `quantity` int(100) NOT NULL,
  `total_price` decimal(6,2) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `status` enum('cart','paid','shipped') NOT NULL DEFAULT 'cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Breads'),
(2, 'Cookies'),
(3, 'Pies'),
(4, 'Pastries'),
(5, 'Cakes'),
(6, 'New_Arrivals');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `contact_us_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(128) NOT NULL,
  `message` text NOT NULL,
  `send_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`contact_us_id`, `user_id`, `name`, `email`, `message`, `send_date`) VALUES
(5, 1, 'Mimi', 'mimi@gmail.com', 'Hello! This is a message from mimi', '2022-11-28'),
(6, 3, 'Dinal', 'dinal@hotmail.com', 'Test sending a second message', '2022-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `custom_cake`
--

DROP TABLE IF EXISTS `custom_cake`;
CREATE TABLE `custom_cake` (
  `custom_cake_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `layer` int(10) NOT NULL,
  `serving` int(10) NOT NULL,
  `flavor` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `custom_cake`
--

INSERT INTO `custom_cake` (`custom_cake_id`, `description`, `image`, `layer`, `serving`, `flavor`, `price`) VALUES
(3, 'birthday cake -make it blue instead of pink', '636d1d2c6072d.jpg', 3, 10, 'Fruit', '169.90');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(5) NOT NULL,
  `comment` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message_center`
--

DROP TABLE IF EXISTS `message_center`;
CREATE TABLE `message_center` (
  `message_Id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender` varchar(10) NOT NULL,
  `send_date` date NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_center`
--

INSERT INTO `message_center` (`message_Id`, `user_id`, `sender`, `send_date`, `message`) VALUES
(1, 2, 'Seller', '2022-11-28', 'Test reply'),
(2, 2, 'Seller', '2022-11-28', 'send a response to mimi');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `ship_id` int(11) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `name`, `description`, `image`, `size`, `price`) VALUES
(15, 5, 'Black forest', 'black forest cake 8 inches, freshly made', '63642b635ba6c.jpg', 'mediumCake', '99.77'),
(16, 1, 'Matcha Bread', 'matcha flavor 8 pieces', '636859c35065a.jpg', 'smallBread', '35.68'),
(17, 2, 'Fruit Macaron', 'Pack of 8 macarons, each filled with delicious fruit flavor.', '636d2a99b8857.jpg', 'smallCookie', '24.99'),
(18, 3, 'Fruit Tart', 'Freshly baked fruit tart with a creamy mouse filling and topped with organic fruits. ', '6377a0e23b37c.jpg', 'Small (4 inches)', '21.98'),
(19, 4, 'Croissant', 'A French delicacy, with a flaky outside and soft inside. Perfect with a cup of coffee.', '6377a0ea444f2.jpg', 'default', '7.97'),
(20, 5, 'Floral cake', 'Edible Flower Cake', '6377a202d7825.jpg', 'Large (10 inches)', '87.22'),
(21, 6, 'Brownies', 'A bag of 8 pieces chocolate brownies', '6377a20b4cf52.jpg', 'default', '5.99');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE `shipping` (
  `ship_id` int(11) NOT NULL,
  `tracking_info` varchar(72) NOT NULL,
  `time_stamp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(72) NOT NULL,
  `role` enum('user','seller') NOT NULL,
  `secret_key` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password_hash`, `role`, `secret_key`) VALUES
(1, 'jiamin', '$2y$10$l4cjJzx.gmnimTMOchP0/OnyNo.8odtHgAKu27j6zfFyPGKli9Tci', 'seller', 'XU5VVZTETBDMM7VC'),
(2, 'mimi', '$2y$10$pJGdhHXasC17oR7zlGv.P.7TClzRAKD6cIqXbOuWLfsSXojP44chG', 'user', NULL),
(3, 'dinal', '$2y$10$RHs9cWP.bNeELbaEQrVECu/1lISkS8xi5JWsYsfO.uN21SoXST9Cm', 'user', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_to_cart` (`product_id`),
  ADD KEY `custom_cake_to_cart` (`custom_cake_id`),
  ADD KEY `user_to_cart` (`user_id`),
  ADD KEY `shipping_to_cart` (`shipping_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`contact_us_id`),
  ADD KEY `user_to_contact_us` (`user_id`);

--
-- Indexes for table `custom_cake`
--
ALTER TABLE `custom_cake`
  ADD PRIMARY KEY (`custom_cake_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `order_to_feedback` (`order_id`),
  ADD KEY `product_to_feedback` (`product_id`);

--
-- Indexes for table `message_center`
--
ALTER TABLE `message_center`
  ADD PRIMARY KEY (`message_Id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_to_order` (`user_id`),
  ADD KEY `shipping_to_order` (`ship_id`),
  ADD KEY `cart_to_order` (`cart_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_to_product` (`category_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `contact_us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `custom_cake`
--
ALTER TABLE `custom_cake`
  MODIFY `custom_cake_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_center`
--
ALTER TABLE `message_center`
  MODIFY `message_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `custom_cake_to_cart` FOREIGN KEY (`custom_cake_id`) REFERENCES `custom_cake` (`custom_cake_id`),
  ADD CONSTRAINT `product_to_cart` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `shipping_to_cart` FOREIGN KEY (`shipping_id`) REFERENCES `shipping` (`ship_id`),
  ADD CONSTRAINT `user_to_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `message_center`
--
ALTER TABLE `message_center`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
