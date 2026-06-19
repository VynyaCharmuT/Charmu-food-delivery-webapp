-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 08:56 PM
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
-- Database: `foodapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `minimum_order` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `discount_percentage`, `expiry_date`, `minimum_order`, `description`) VALUES
(2, 'SAVE10', 10, '2027-12-31', 300, '10% OFF above ₹300'),
(3, 'SAVE20', 20, '2027-12-31', 700, '20% OFF above ₹700'),
(4, 'FOODIE50', 50, '2027-12-31', 1200, '50% OFF above ₹1200'),
(5, 'WELCOME50', 10, '2026-12-31', 100, 'Welcome Offer'),
(6, 'SAVE100', 20, '2026-12-31', 200, 'Save More'),
(9, 'SAVE20', 20, '2026-12-31', 500, 'Festival Offer');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_locations`
--

CREATE TABLE `delivery_locations` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `delivery_agent_id` int(11) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_locations`
--

INSERT INTO `delivery_locations` (`id`, `order_id`, `delivery_agent_id`, `latitude`, `longitude`, `updated_at`) VALUES
(1, 0, 0, '', '', '2026-06-16 13:44:45'),
(2, 0, 0, '', '', '2026-06-16 13:44:45'),
(3, 0, 0, '', '', '2026-06-16 13:44:45'),
(4, 0, 0, '', '', '2026-06-16 13:44:45'),
(5, 0, 0, '', '', '2026-06-16 13:44:45'),
(6, 0, 0, '', '', '2026-06-16 13:44:45'),
(7, 20, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(8, 86, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(9, 68, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(10, 54, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(11, 23, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(12, 3, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(13, 55, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(14, 30, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(15, 106, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(16, 28, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(17, 43, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(18, 51, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(19, 21, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(20, 37, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(21, 29, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(22, 15, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(23, 41, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(24, 42, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(25, 26, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(26, 65, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(27, 12, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(28, 58, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(29, 35, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(30, 31, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(31, 33, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(32, 104, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(33, 19, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(34, 8, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(35, 45, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(36, 49, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(37, 48, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(38, 60, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(39, 70, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(40, 40, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(41, 13, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(42, 32, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(43, 50, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(44, 47, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(45, 46, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(46, 10, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(47, 34, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(48, 38, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(49, 56, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(50, 7, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(51, 92, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(52, 18, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(53, 52, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(54, 22, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(55, 59, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(56, 71, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(57, 11, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(58, 36, 26, '17.4261', '78.5134', '2026-06-16 13:44:45'),
(59, 24, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(60, 27, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(61, 25, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(62, 53, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(63, 44, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(64, 4, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(65, 69, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(66, 17, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(67, 66, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(68, 98, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(69, 6, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(70, 57, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(71, 39, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(72, 96, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(73, 16, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(74, 67, 26, '17.4261', '78.5134', '2026-06-16 13:44:46'),
(75, 108, 26, '17.4261', '78.5134', '2026-06-18 07:48:08'),
(76, 110, 26, '17.4261', '78.5134', '2026-06-18 15:45:33'),
(77, 112, 26, '17.4261', '78.5134', '2026-06-18 15:59:43'),
(78, 94, 28, '17.4261', '78.5134', '2026-06-18 18:51:31'),
(79, 100, 28, '17.4261', '78.5134', '2026-06-18 18:51:31'),
(80, 102, 28, '17.4261', '78.5134', '2026-06-18 18:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`) VALUES
(1, 26, '✅ Your order has been delivered successfully.', '2026-06-18 18:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `order_status` varchar(50) DEFAULT NULL,
  `delivery_agent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tracking_status` varchar(100) DEFAULT 'Order Placed',
  `cutlery_persons` int(11) NOT NULL,
  `sauce_type` varchar(255) NOT NULL,
  `sauce_quantity` int(11) NOT NULL,
  `beverage_type` varchar(255) NOT NULL,
  `beverage_quantity` int(11) NOT NULL,
  `addon_charges` int(11) NOT NULL,
  `estimated_delivery` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `side_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `payment_method`, `payment_status`, `order_status`, `delivery_agent_id`, `created_at`, `tracking_status`, `cutlery_persons`, `sauce_type`, `sauce_quantity`, `beverage_type`, `beverage_quantity`, `addon_charges`, `estimated_delivery`, `address`, `phone`, `latitude`, `longitude`, `side_type`) VALUES
(1, 1, 598.50, 'UPI', 'Pending', 'Delivered', 2, '2026-05-11 09:58:18', 'Delivered', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 1159.00, 'COD', 'Pending', 'Delivered', 2, '2026-05-11 10:19:52', 'Delivered', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 998.00, 'COD', 'Pending', 'Delivered', 26, '2026-05-11 12:12:25', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, 998.00, 'UPI', 'Pending', 'Delivered', 26, '2026-05-12 06:02:16', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, 480.00, 'Card', 'Pending', 'Delivered', 2, '2026-05-12 08:00:03', 'Delivered', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, 396.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-12 08:46:20', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-12 09:47:59', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 449.10, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-12 10:03:36', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 314.10, 'COD', 'Pending', 'On The Way', 2, '2026-05-12 10:30:04', 'On The Way', 3, 'Cheese Dip', 1, 'Coke', 1, 50, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 4, 798.40, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-13 06:46:33', 'Assigned To Delivery Agent', 1, 'Tomato Ketchup', 1, 'Water', 1, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 8, 299.00, 'COD', 'Pending', 'Out For Delivery', 26, '2026-05-13 07:33:20', 'Assigned To Delivery Agent', 1, 'Tomato Ketchup', 1, 'Water', 1, 0, '30-40 mins', NULL, NULL, NULL, NULL, NULL),
(12, 8, 288.00, 'COD', 'Pending', 'Preparing', 26, '2026-05-13 07:39:03', 'Assigned To Delivery Agent', 1, 'Tomato Ketchup', 1, 'Water', 1, 0, '25 mins', NULL, NULL, NULL, NULL, NULL),
(13, 8, 538.20, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-15 07:47:48', 'Assigned To Delivery Agent', 1, 'Tomato Ketchup', 1, 'Water', 1, 0, '30-40 mins', NULL, NULL, NULL, NULL, NULL),
(14, 8, 280.00, 'UPI', 'Pending', 'Delivered', 7, '2026-05-15 10:17:26', 'Delivered', 2, 'Tomato Ketchup', 1, 'Coke', 1, 40, '10-15 mins', NULL, NULL, NULL, NULL, NULL),
(15, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 06:18:23', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(16, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 06:18:23', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'sudharshan towers', '9123456789', NULL, NULL, NULL),
(17, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 06:18:24', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'sudharshan towers', '9123456789', NULL, NULL, NULL),
(18, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 06:18:25', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'sudharshan towers', '9123456789', NULL, NULL, NULL),
(19, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 06:20:32', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(20, 18, 499.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-25 06:20:32', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(21, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 06:33:40', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(22, 18, 299.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 06:33:40', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(23, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 06:46:46', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(24, 18, 299.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 06:46:46', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(25, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 06:46:53', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(26, 18, 299.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 06:46:53', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(27, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:31:52', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(28, 18, 299.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-25 07:31:52', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(29, 18, 299.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-25 07:31:53', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(30, 18, 299.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-25 07:31:54', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(31, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:31:59', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(32, 18, 299.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-25 07:31:59', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(33, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:34:29', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(34, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:34:29', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'x', '9123456789', NULL, NULL, NULL),
(35, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:34:36', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(36, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:34:36', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'x', '9123456789', NULL, NULL, NULL),
(37, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:02', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(38, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:02', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(39, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:05', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(40, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:21', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(41, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:21', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(42, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:28', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(43, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:37:28', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(44, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:41:59', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(45, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:41:59', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(46, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:42:11', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(47, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:42:11', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(48, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:47:26', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(49, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:47:26', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers ', '9123456789', NULL, NULL, NULL),
(50, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 07:58:20', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(51, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 07:58:20', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(52, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 08:03:25', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(53, 18, 499.00, 'Card', 'Pending', 'Order Placed', 26, '2026-05-25 08:03:25', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(54, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 11:16:12', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(55, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-25 11:28:27', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(56, 18, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-05-25 11:28:27', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(57, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-27 10:49:49', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(58, 18, 499.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-27 10:49:50', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(59, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-05-29 06:39:58', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(60, 22, 499.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-05-29 06:39:58', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(61, 0, 0.00, '', 'Pending', 'Order Placed', 22, '2026-05-29 06:54:53', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(62, 22, 299.00, 'Card', 'Pending', 'Order Placed', 22, '2026-05-29 06:54:53', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(63, 0, 0.00, '', 'Pending', 'Order Placed', 22, '2026-05-29 08:14:57', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(64, 22, 320.00, 'COD', 'Pending', 'Order Placed', 22, '2026-05-29 08:14:57', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(65, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-06-01 07:07:08', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(66, 28, 499.00, 'UPI', 'Pending', 'Order Placed', 26, '2026-06-01 07:07:08', 'Picked Up', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(67, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-06-01 07:31:47', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(68, 22, 299.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-01 07:31:47', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(69, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-06-02 05:55:31', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(70, 22, 499.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-02 05:55:31', 'On The Way', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(71, 0, 0.00, '', 'Pending', 'Order Placed', 26, '2026-06-02 07:24:05', 'Assigned To Delivery Agent', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(72, 22, 299.00, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-02 07:24:05', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(73, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-02 11:33:30', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(74, 26, 499.00, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-02 11:33:30', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(75, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-02 11:41:46', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(76, 26, 249.50, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-02 11:41:46', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(77, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-02 11:54:07', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(78, 26, 110.00, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-02 11:54:07', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '', '', NULL),
(79, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-02 11:54:21', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(80, 26, 110.00, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-02 11:54:21', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '', '', NULL),
(81, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-02 11:59:22', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(82, 26, 249.50, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-02 11:59:22', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '', '', NULL),
(83, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-03 06:03:47', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(84, 22, 108.00, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-03 06:03:47', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '', '', NULL),
(85, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-03 07:09:07', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(86, 22, 120.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-03 07:09:07', 'On The Way', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '17.4224', '78.4877', NULL),
(87, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-05 11:12:01', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(88, 28, 249.50, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-05 11:12:02', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'sudharshan towers', '9123456789', '17.419', '78.4521', NULL),
(89, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-08 06:41:15', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(90, 22, 399.00, 'COD', 'Pending', 'Order Placed', NULL, '2026-06-08 06:41:15', 'Order Placed', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '17.4771', '78.5724', NULL),
(91, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-10 05:50:37', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(92, 22, 249.50, 'COD', 'Pending', 'Order Placed', 26, '2026-06-10 05:50:38', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '17.4771', '78.5724', NULL),
(93, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-10 07:03:08', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(94, 28, 299.00, 'COD', 'Pending', 'Order Placed', 28, '2026-06-10 07:03:08', 'On The Way', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '17.4771', '78.5724', NULL),
(95, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-12 10:15:23', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(96, 22, 798.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-12 10:15:23', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(97, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-15 14:21:28', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(98, 26, 220.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-15 14:21:28', 'Picked Up', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(99, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-15 14:26:57', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(100, 28, 320.00, 'COD', 'Pending', 'Order Placed', 28, '2026-06-15 14:26:57', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(101, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-15 18:31:29', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', NULL, NULL, NULL),
(102, 28, 499.00, 'COD', 'Pending', 'Order Placed', 28, '2026-06-15 18:31:29', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', NULL, NULL, NULL),
(103, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-16 05:51:11', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(104, 26, 320.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-16 05:51:11', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharhan Towers', '9123456789', '17.4771', '78.5724', NULL),
(105, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-16 07:00:12', 'Order Placed', 0, '', 0, '', 0, 0, NULL, '', '', '', '', NULL),
(106, 26, 299.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-16 07:00:12', 'Delivered', 0, '', 0, '', 0, 0, NULL, 'Sudharshan Towers', '9123456789', '17.4771', '78.5724', NULL),
(107, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-18 06:41:40', 'Order Placed', 0, 'Tomato Sauce', 0, '', 0, 0, NULL, '', '', '', '', ''),
(108, 30, 125.00, 'COD', 'Pending', 'Order Placed', 26, '2026-06-18 06:41:40', 'Delivered', 1, 'Tomato Sauce', 0, 'Water', 1, 30, NULL, 'Sudharshan Towers', '9123456789', '17.4261', '78.5134', 'French Fries'),
(109, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-18 15:45:21', 'Order Placed', 0, 'Tomato Sauce', 0, '', 0, 0, NULL, '', '', '', '', ''),
(110, 26, 239.20, 'UPI', 'Pending', 'Order Placed', 26, '2026-06-18 15:45:21', 'Delivered', 1, 'Tomato Sauce', 0, 'Water', 1, 0, NULL, 'Namala Gundu, Marredpally mandal, Greater Hyderabad Municipal Corporation North Zone, Hyderabad, Telangana, 500061, India', '9123456789', '17.4261', '78.5134', 'None'),
(111, 0, 0.00, '', 'Pending', 'Order Placed', NULL, '2026-06-18 15:59:18', 'Order Placed', 0, 'Tomato Sauce', 0, '', 0, 0, NULL, '', '', '', '', ''),
(112, 26, 256.00, 'Card', 'Pending', 'Order Placed', 26, '2026-06-18 15:59:18', 'Delivered', 1, 'Tomato Sauce', 0, 'Water', 1, 0, NULL, 'Namala Gundu, Marredpally mandal, Greater Hyderabad Municipal Corporation North Zone, Hyderabad, Telangana, 500061, India', '9123456789', '17.4261', '78.5134', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 1, NULL),
(2, 1, 4, 2, NULL),
(3, 2, 1, 1, NULL),
(4, 2, 6, 3, NULL),
(5, 3, 1, 2, NULL),
(6, 4, 1, 2, NULL),
(7, 5, 4, 3, NULL),
(8, 6, 6, 2, NULL),
(9, 7, 1, 1, NULL),
(10, 8, 1, 1, NULL),
(11, 9, 2, 1, NULL),
(12, 10, 1, 2, NULL),
(13, 11, 2, 1, NULL),
(14, 12, 4, 1, NULL),
(15, 13, 2, 2, NULL),
(16, 14, 5, 2, NULL),
(17, 49, 1, 1, 499.00),
(18, 51, 1, 1, 499.00),
(19, 53, 1, 1, 499.00),
(20, 56, 1, 1, 499.00),
(21, 58, 1, 1, 499.00),
(22, 60, 1, 1, 499.00),
(23, 62, 2, 1, 299.00),
(24, 64, 4, 1, 320.00),
(25, 66, 1, 1, 499.00),
(26, 68, 2, 1, 299.00),
(27, 70, 1, 1, 499.00),
(28, 72, 2, 1, 299.00),
(29, 74, 1, 1, 499.00),
(30, 76, 1, 1, 499.00),
(31, 78, 6, 1, 220.00),
(32, 80, 6, 1, 220.00),
(33, 82, 1, 1, 499.00),
(34, 84, 5, 1, 120.00),
(35, 86, 5, 2, 120.00),
(36, 88, 1, 1, 499.00),
(37, 90, 1, 1, 499.00),
(38, 90, 2, 1, 299.00),
(39, 92, 1, 1, 499.00),
(40, 94, 2, 1, 299.00),
(41, 96, 1, 1, 499.00),
(42, 96, 2, 1, 299.00),
(43, 98, 6, 1, 220.00),
(44, 100, 4, 1, 320.00),
(45, 102, 1, 1, 499.00),
(46, 104, 4, 1, 320.00),
(47, 106, 2, 1, 299.00),
(48, 108, 6, 1, 220.00),
(49, 110, 2, 1, 299.00),
(50, 112, 4, 1, 320.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `allergens` text DEFAULT NULL,
  `serving_size` varchar(100) DEFAULT NULL,
  `rating` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `stock`, `image`, `description`, `ingredients`, `allergens`, `serving_size`, `rating`) VALUES
(1, 'Chocolate Cake', 'Cakes', 499.00, 20, 'cake.jpg', 'Rich chocolate cake', 'Chocolate, Flour, Cream', 'Dairy', 'Serves 2-3', 4.5),
(2, 'Burger Combo', 'Combos', 299.00, 15, 'burger.jpg', 'Burger with fries and coke', 'Bread, Chicken, Cheese', 'Gluten', 'Serves 1', 4.7),
(4, 'Margherita Pizza', 'Pizza', 320.00, 25, 'pizza.jpg', 'Cheese pizza with a drizzle or olive oil and fresh basil leaves', 'dough, sauce, mozzarella cheese, olive oil, basil leaves', 'gluten, dairy', '1-2', 4.5),
(5, 'Hazelnut Choco-chip Ice cream', 'Ice Cream', 120.00, 50, 'icecream.jpg', 'Fresh hazelnut choco chip ice cream scoops', 'milk, chocolate, hazelnuts', 'dairy, nuts', '1', 4.7),
(6, 'Chicken Dum Biryani', 'Rice Item', 220.00, 30, 'biryani.jpg', 'Flavorful basmati rice cooked on wood fire with juicy marinated chicken and best spices', 'basmati rice, chicken, spices, oil', 'meat', '1-2', 4.9);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `user_id`, `product_id`, `rating`, `review`, `created_at`) VALUES
(1, 0, 0, 0, 0, '', '2026-06-15 15:33:44'),
(2, 100, 28, 0, 4, 'very good ', '2026-06-15 15:33:44'),
(3, 0, 0, 0, 0, '', '2026-06-16 05:52:48'),
(4, 104, 26, 0, 5, 'good', '2026-06-16 05:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin','delivery') DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vehicle_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `address`, `created_at`, `vehicle_number`) VALUES
(1, 'testuser', 'charmuthotapalli@gmail.com', '$2y$10$pNc0elEy83r7m0hblsyPruvdq96NXTyI9vO4IuEzWED3/DWBnswDO', 'user', NULL, NULL, '2026-05-11 07:05:45', NULL),
(2, 'testdelivery', 'delivery@gmail.com', '$2y$10$kh7UDyafuqmbtP4l6KAET.hdx3U6GE4kYxI1QpSem75hDIJD0Zt8m', 'delivery', NULL, NULL, '2026-05-11 07:19:41', NULL),
(3, 'testadmin', 'admin@gmail.com', '$2y$10$Cga00ZK.gjzooKVndt0enu88BKC7WVyBqR4Sb5WkTlKE4PG7C.5me', 'admin', NULL, NULL, '2026-05-11 07:23:19', NULL),
(7, 'testdelivery1', 'delivery1@gmail.com', '4321', 'delivery', NULL, NULL, '2026-05-13 06:53:09', NULL),
(8, 'testuser1', 'user1@gmail.com', '1234', 'user', NULL, NULL, '2026-05-13 06:53:35', NULL),
(9, 'testadmin1', 'admin1@gmail.com', '7777', 'admin', NULL, NULL, '2026-05-13 06:54:09', NULL),
(18, 'testuser3', 'user3@gmail.com', '1234', 'user', NULL, NULL, '2026-05-20 07:59:52', NULL),
(20, 'testadmin3', 'admin3@gmail.com', '7777', 'admin', NULL, NULL, '2026-05-27 11:12:03', NULL),
(21, '', '', '$2y$10$Xwhu8v0ser2FXzAooarPxO9nKzkPpB2GPM9ATuxMSMLd1gt06EK/W', '', NULL, NULL, '2026-05-29 05:44:28', NULL),
(22, 'testuser4', 'user4@gmail.com', '$2y$10$uujel8aKcQaGTDp06qOSBuZ8RDzfvAZ3cxApQjkMwLots1VPiFYj6', 'user', NULL, NULL, '2026-05-29 05:44:28', NULL),
(26, 'testdelivery4', 'delivery4@gmail.com', '$2y$10$ofXQcKSTn8suusovK2SA1egPsCD33hLIGouMGymC5M0M30aFViYMG', 'delivery', '9123456987', NULL, '2026-05-29 06:14:45', 'AP39AB1234'),
(28, 'testadmin4', 'admin4@gmail.com', '$2y$10$KF8IVxrU.6lH0UhCgu5tleSvIpsKCvwsu//Dxc.j/f8YsmnT/KqqS', 'admin', NULL, NULL, '2026-05-29 08:28:49', NULL),
(30, 'testuser5', 'user5@gmail.com', '$2y$10$YmImSrAlkBFVMFcBe23Xp.5BgN0eCraF3wwkwbp6sM42YmyYyNphO', 'user', NULL, NULL, '2026-06-18 06:33:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `delivery_locations`
--
ALTER TABLE `delivery_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
