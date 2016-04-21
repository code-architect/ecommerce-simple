-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2016 at 04:00 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db`
--
CREATE DATABASE IF NOT EXISTS `ecom_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ecom_db`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Category 1'),
(2, 'Category 2'),
(3, 'Category 3');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(60) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `order_shop_id` varchar(255) NOT NULL,
  `order_amount` float NOT NULL,
  `order_tx` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_email`, `order_shop_id`, `order_amount`, `order_tx`, `order_status`, `order_currency`) VALUES
(45, 'jonnydoe@xyz.com', '6O68JA4I242S6P708125G9K2Y14', 345.9, 'JK025GY8OIP789AS2', 'Completed', 'USD'),
(46, 'jonnydoe@xyz.com', 'AY5061PG6824O548970IK7JO12K', 469.44, 'JK025GY8OIP789AOK', 'Completed', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_short_desc` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image_big` varchar(255) NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_description`, `product_short_desc`, `product_image`, `product_image_big`, `product_status`) VALUES
(1, 'Product 1', 1, 20, 2, 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '320x150.png', '700x600.png', 1),
(2, 'Product 2', 2, 50, 4, 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '320x150.png', '700x600.png', 1),
(3, 'Product 3', 1, 55.9, 19, 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '320x150.png', '700x600.png', 1),
(6, 'Product 4', 2, 25.69, 10, 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit', '320x150.png', '700x600.png', 1),
(8, 'Product 5', 2, 50.36, 45, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit', '320x150.png', '700x600.png', 1),
(11, 'Product 6', 1, 12, 12, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit', '320x150.png', '700x600.png', 1),
(12, 'Product 7', 3, 50.36, 13, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of lettersIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit', '320x150.png', '700x600.png', 0),
(13, 'Product 8', 3, 27, 21, 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '320x150.png', '700x600.png', 1),
(14, 'Product 9', 3, 34, 14, '                                        This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.   ok                                                             ', '                                                                                This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.                                                                ', '320x150.png', '700x600.png', 1),
(15, 'Product 10', 3, 12, 7, 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', 'This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit. ', '320x150.png', '700x600.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_shop_id` varchar(255) NOT NULL,
  `product_quanity_price` float NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `product_id`, `order_shop_id`, `product_quanity_price`, `product_quantity`) VALUES
(41, 15, '6O68JA4I242S6P708125G9K2Y14', 12, 1),
(42, 8, '6O68JA4I242S6P708125G9K2Y14', 201.44, 4),
(43, 2, 'AY5061PG6824O548970IK7JO12K', 200, 4),
(44, 3, 'AY5061PG6824O548970IK7JO12K', 167.7, 3),
(45, 6, 'AY5061PG6824O548970IK7JO12K', 51.38, 2),
(46, 8, 'AY5061PG6824O548970IK7JO12K', 50.36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_address` text NOT NULL,
  `user_state` varchar(50) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_country` varchar(50) NOT NULL,
  `user_pincode` int(10) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_address`, `user_state`, `user_city`, `user_country`, `user_pincode`, `user_phone`, `username`, `user_password`, `user_email`) VALUES
(1, '', '', '', '', '', '', 0, '', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@xyz.com'),
(2, 'john', 'doe', '22/1 LMK Road,(35th Street), In front of Glob Theater ', 'new york', 'Timbaktu', 'USA', 123456, '1234567890', 'user', 'e10adc3949ba59abbe56e057f20f883e', 'user@xyz.com'),
(3, 'Jonny', 'Doe', '22/1 LMK Road,(35th Street), In front of Glob Theater ', 'New York', 'Timbaktu', 'USA', 123456, '1234567890', 'jonny', 'e10adc3949ba59abbe56e057f20f883e', 'jonnydoe@xyz.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_shop_id` (`order_shop_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
