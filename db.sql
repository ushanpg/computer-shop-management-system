-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 09:28 AM
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
-- Database: `comshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `status`) VALUES
(1, 'dell', 1),
(2, 'lenovo', 1),
(3, 'acer', 1),
(4, 'hp', 1),
(6, 'asus', 1),
(7, 'huawei ', 1),
(8, 'alcatel', 1),
(9, 'other', 1),
(10, 'gladias', 1),
(11, 'g skill', 1),
(12, 'samsung', 1),
(13, 'falcon', 1),
(14, 'east', 1),
(15, 'amd', 1),
(16, 'nzxt', 1),
(17, 'apple', 1),
(18, 'u green', 1),
(19, 'intel', 1),
(20, 'aoc', 1),
(21, 'eset', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `updated_at`, `status`) VALUES
(84, 30, 1, 1, '2024-06-11 16:47:00', 1),
(85, 30, 10, 1, '2024-06-11 16:47:03', 1),
(86, 30, 17, 4, '2024-06-11 16:47:09', 1),
(87, 30, 18, 1, '2024-06-11 16:47:12', 1),
(120, 17, 4, 1, '2024-08-17 11:52:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(1, 'laptops & tablets', 1),
(2, 'desktop computers', 1),
(6, 'mobile broadband ', 1),
(7, 'desktop components', 1),
(10, 'computer accessories', 1),
(11, 'computer displays', 1),
(12, 'other devices', 1),
(13, 'retail software', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(256) NOT NULL,
  `city` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'TBC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`id`, `order_id`, `first_name`, `last_name`, `address`, `city`, `added_at`, `status`) VALUES
(5, 1718096845, 'Kasun', 'Wickramasinghe', '104, Main Rd', 'Gampaha', '2024-06-11 14:37:26', 'Delivered'),
(6, 1718096937, 'Madusha', 'Rajapaksa', '105, Main Rd', 'Chilaw', '2024-06-11 14:38:58', 'TBC'),
(7, 1718097034, 'Chathura', 'Samaraweera', '142, Main Rd', 'Kalutara', '2024-06-11 14:40:34', 'Returned'),
(8, 1718097143, 'Sandali', 'Peris', '325, Main Rd', 'Rajagiriya', '2024-06-11 14:42:24', 'Delivered'),
(9, 1718097186, 'Sandali', 'Peris', '325, Main Rd', 'Rajagiriya', '2024-06-11 14:43:07', 'Delivered'),
(10, 1718097787, 'Dhanushka', 'Pathirana', '102, Main Rd', 'Matara', '2024-06-11 14:53:07', 'Shipped'),
(11, 1718097877, 'Nimnaka', 'Ranasinghe', '152, Main Rd', 'Colombo', '2024-06-11 14:54:37', 'Shipped'),
(12, 1718097964, 'Sachini', 'Wijesekara', '262, Main Rd', 'Negombo', '2024-06-11 14:56:04', 'Returned'),
(13, 1718098079, 'Nethmi', 'Fernando', '108, Main Rd', 'Dehiwala', '2024-06-11 14:58:00', 'Delivered'),
(14, 1718098574, 'Kasun', 'Wickramasinghe', '131, Main Rd', 'Galle', '2024-06-11 15:06:14', 'TBC'),
(15, 1718445542, 'Ushan', 'Palliyaguru', '102, Main Rd', 'Colombo', '2024-06-15 15:29:03', 'TBC'),
(17, 1718968407, 'Ushan', 'Palliyaguru', '102, Main Rd', 'Colombo', '2024-06-21 16:43:28', 'TBC'),
(18, 1718968943, 'Ushan', 'Palliyaguru', '102, Main Rd', 'Colombo', '2024-06-21 16:52:24', 'TBC'),
(20, 1719139880, 'Ushan', 'Palliyaguru', '102, Main Rd', 'Colombo', '2024-06-23 16:21:21', 'TBC'),
(21, 1719397756, 'Ushan', 'Palliyaguru', '102, Main Rd', 'Colombo', '2024-06-26 15:59:51', 'TBC'),
(39, 1723813040, 'Thilini', 'Jayawardena', '102, Main Rd', 'Colombo', '2024-08-16 18:27:40', 'TBC'),
(40, 1723869287, 'Kasun', 'Wickramasinghe', '102, Main Rd', 'Colombo', '2024-08-17 10:05:24', 'TBC'),
(41, 1723871856, 'Kasun', 'Wickramasinghe', '102, Main Rd', 'Colombo', '2024-08-17 10:48:04', 'TBC'),
(43, 1723871945, 'Kasun', 'Wickramasinghe', '102, Main Rd', 'Colombo', '2024-08-17 10:49:27', 'TBC'),
(45, 1723872108, 'Kasun', 'Wickramasinghe', '102, Main Rd', 'Colombo', '2024-08-17 10:52:09', 'TBC'),
(47, 1731317315, 'Kasun', 'Wickramasinghe', '102, Main Rd', 'Colombo', '2024-11-11 14:58:35', 'TBC');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `user_id`, `status`) VALUES
(12, 'ushan97@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 14, 1),
(14, 'david@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 16, 1),
(15, 'franklin@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 17, 1),
(16, 'john@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 18, 1),
(17, 'sara@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 19, 1),
(18, 'stephanie@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 20, 1),
(19, 'ravindu@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 21, 1),
(20, 'thilini@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 22, 1),
(21, 'kasun@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 23, 1),
(22, 'madusha@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 24, 1),
(23, 'chathura@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 25, 1),
(24, 'sandali@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 26, 1),
(25, 'dhanuka@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 27, 1),
(26, 'nimnaka@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 28, 1),
(27, 'sachini@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 29, 1),
(28, 'nethmi@gmail.com', 'c7d15d30b961acd6d599f52868cd26fe', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` text NOT NULL,
  `url` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `image`, `url`, `status`) VALUES
(1, 'Users Management', 'users.png', 'userController.php?req=user', 1),
(2, 'Products Management', 'products.png', 'productController.php?req=product', 1),
(3, 'Inventory Management', 'inventory.png', 'inventoryController.php?req=inventory', 1),
(4, 'Orders Management', 'orders.png', 'orderController.php?req=order', 1),
(5, 'Payments Management', 'payments.png', 'paymentController.php?req=payment', 1),
(6, 'Delivery Management', 'delivery.png', 'deliveryController.php?req=delivery', 1),
(7, 'Shopping Cart', 'cart.png', 'cartController.php?req=showCart', 1),
(8, 'Support Management', 'support.png', 'supportController.php?req=support', 1),
(9, 'Support Requests', 'request.png', 'supportController.php?req=trackToken', 1),
(10, 'Reports Generation', 'reports.png', 'reportController.php?req=report', 1),
(11, 'Delivery Tracker', 'tracker.png', 'deliveryController.php?req=deliveryTracker', 1),
(12, 'Delivery Updater', 'updater.png', 'deliveryController.php?req=deliveryUpdater', 1),
(13, 'My Profile', 'profile.png', 'userController.php?req=editUser', 1),
(16, 'My Orders', 'myOrders.png', 'orderController.php?req=myOrder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_role`
--

CREATE TABLE `module_role` (
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `module_role`
--

INSERT INTO `module_role` (`module_id`, `role_id`) VALUES
(3, 4),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(8, 1),
(10, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(8, 2),
(10, 2),
(8, 6),
(5, 3),
(6, 5),
(12, 5),
(7, 7),
(9, 7),
(11, 7),
(13, 7),
(16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_with` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'TBC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `pay_with`, `added_at`, `status`) VALUES
(33, 1718096845, 23, 'COD', '2024-06-11 14:37:25', 'Accepted'),
(34, 1718096937, 24, 'COD', '2024-06-11 14:38:57', 'Accepted'),
(35, 1718097034, 25, 'COD', '2024-06-11 14:40:34', 'Cancelled'),
(36, 1718097143, 26, 'COD', '2024-06-11 14:42:23', 'Cancelled'),
(37, 1718097186, 26, 'COD', '2024-06-11 14:43:07', 'TBC'),
(38, 1718097787, 27, 'COD', '2024-06-11 14:53:07', 'Dispatched'),
(39, 1718097877, 28, 'COD', '2024-06-11 14:54:37', 'Dispatched'),
(40, 1718097964, 29, 'COD', '2024-06-11 14:56:04', 'Completed'),
(41, 1718098079, 30, 'COD', '2024-06-11 14:57:59', 'TBC'),
(42, 1718098574, 23, 'COD', '2024-06-11 15:06:14', 'TBC'),
(43, 1718445542, 14, 'COD', '2024-06-15 15:29:03', 'TBC'),
(45, 1718968407, 14, 'COD', '2024-06-21 16:43:27', 'TBC'),
(46, 1718968943, 14, 'COD', '2024-06-21 16:52:23', 'TBC'),
(48, 1719139880, 14, 'COD', '2024-06-23 16:21:21', 'TBC'),
(49, 1719397756, 23, 'Online', '2024-06-26 15:59:51', 'TBC'),
(97, 1723813040, 22, 'Online', '2024-08-16 18:27:40', 'TBC'),
(98, 1723869287, 23, 'Online', '2024-08-17 10:05:24', 'TBC'),
(99, 1723871856, 23, 'Online', '2024-08-17 10:48:03', 'TBC'),
(101, 1723871945, 23, 'Online', '2024-08-17 10:49:27', 'TBC'),
(103, 1723872108, 23, 'Online', '2024-08-17 10:52:09', 'TBC'),
(105, 1731317315, 23, 'COD', '2024-11-11 14:58:35', 'TBC');

-- --------------------------------------------------------

--
-- Table structure for table `orders_product`
--

CREATE TABLE `orders_product` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_product`
--

INSERT INTO `orders_product` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `stock_id`) VALUES
(6, 1718096845, 10, 1, 5000, 40),
(7, 1718096845, 12, 1, 10000, 42),
(8, 1718096937, 13, 1, 2500, 34),
(9, 1718097034, 7, 2, 199000, 37),
(10, 1718097143, 20, 1, 25000, 50),
(11, 1718097143, 24, 1, 9750, 33),
(12, 1718097143, 25, 1, 2500, 51),
(13, 1718097186, 18, 1, 8000, 48),
(14, 1718097787, 17, 5, 2500, 47),
(15, 1718097877, 20, 1, 25000, 50),
(16, 1718097877, 16, 1, 97500, 46),
(17, 1718097877, 15, 1, 2500, 45),
(18, 1718097964, 9, 1, 159000, 39),
(19, 1718098079, 8, 1, 149000, 38),
(20, 1718098079, 2, 1, 30000, 30),
(21, 1718098574, 14, 1, 7500, 44),
(22, 1718445542, 10, 1, 5000, 40),
(24, 1718968407, 1, 1, 95000, 28),
(25, 1718968943, 8, 1, 149000, 38),
(27, 1719139880, 3, 1, 150000, 32),
(28, 1719397756, 11, 1, 3000, 41),
(43, 1723813040, 10, 2, 5000, 40),
(44, 1723869287, 10, 1, 5000, 40),
(45, 1723871856, 2, 1, 30000, 52),
(46, 1723871945, 10, 1, 5000, 40),
(47, 1723872108, 2, 1, 30000, 52),
(50, 1731317315, 2, 2, 30000, 52);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `order_id` int(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `card_no` int(50) DEFAULT 0,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `order_id`, `amount`, `method`, `card_no`, `added_at`, `status`) VALUES
(5, 1718096845, 15000, 'COD', 0, '2024-06-11 14:37:27', 'TBC'),
(6, 1718096937, 2500, 'COD', 0, '2024-06-11 14:38:58', 'TBC'),
(7, 1718097034, 398000, 'COD', 0, '2024-06-11 14:40:34', 'TBC'),
(8, 1718097143, 37250, 'COD', 0, '2024-06-11 14:42:24', 'TBC'),
(9, 1718097186, 8000, 'COD', 0, '2024-06-11 14:43:07', 'TBC'),
(10, 1718097787, 12500, 'COD', 0, '2024-06-11 14:53:07', 'TBC'),
(11, 1718097877, 125000, 'COD', 0, '2024-06-11 14:54:38', 'TBC'),
(12, 1718097964, 159000, 'COD', 0, '2024-06-11 14:56:05', 'TBC'),
(13, 1718098079, 179000, 'COD', 0, '2024-06-11 14:58:00', 'Collected'),
(14, 1718098574, 7500, 'COD', 0, '2024-06-11 15:06:15', 'TBC'),
(15, 1718445542, 5000, 'COD', 0, '2024-06-15 15:29:03', 'TBC'),
(16, 1718968407, 95000, 'COD', 0, '2024-06-21 16:43:28', 'TBC'),
(17, 1718968943, 149000, 'COD', 0, '2024-06-21 16:52:24', 'TBC'),
(19, 1719139880, 150000, 'COD', 0, '2024-06-23 16:21:21', 'Success'),
(20, 1719397756, 3000, 'Online', 0, '2024-06-26 15:59:51', 'TBC'),
(38, 1723813040, 10000, 'Online', 0, '2024-08-16 18:27:40', 'TBC'),
(39, 1723869287, 5000, 'Online', 0, '2024-08-17 10:05:24', 'TBC'),
(40, 1723871856, 30000, 'Online', 0, '2024-08-17 10:48:04', 'TBC'),
(44, 1723872108, 30000, 'Online', 0, '2024-08-17 10:52:09', 'TBC'),
(46, 1731317315, 60000, 'COD', 0, '2024-11-11 14:58:35', 'TBC');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `warranty` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `brand_id`, `subcat_id`, `description`, `price`, `warranty`, `image`, `added_at`, `status`) VALUES
(1, 'lenovo ideapad 3 15 celeron n4020', 2, 1, '', 95000, 1000, '1716887855.jpeg', '2024-05-10 17:02:14', 1),
(2, 'alcatel linkzone 2 4g lte mobile hotspot', 8, 8, '', 30000, 365, '1716973306.png', '2024-05-10 17:02:14', 1),
(3, 'dell inspiron 15 core i3 12450u', 1, 1, '', 150000, 1000, '1716887929.jpg', '2024-05-10 17:02:14', 1),
(4, 'lite gamer custom pc build', 9, 3, '', 99500, 1000, '1716888048.jpg', '2024-05-10 17:02:14', 1),
(7, 'acer aspire 3 15 core i5 12650u', 3, 1, '', 199000, 1000, '1716973622.jpg', '2024-05-29 14:37:02', 1),
(8, 'asus vivobook 15 amd ryzen 3 7250u', 6, 1, '', 149000, 1000, '1716973922.jpeg', '2024-05-29 14:42:02', 1),
(9, 'hp pavillion 15 core i3 1335u', 4, 1, '', 159000, 1000, '1716974104.jpg', '2024-05-29 14:45:04', 1),
(10, 'asus rog gaming pc casing rgb', 6, 10, '', 5000, 0, '1716981836.png', '2024-05-29 16:53:56', 1),
(11, 'asus rog gaming keyboard rgb', 6, 9, '', 3000, 365, '1716982365.png', '2024-05-29 17:02:45', 1),
(12, 'gskill tridentz rgb ddr4 32gb ram kit', 11, 14, '', 10000, 1000, '1716982736.png', '2024-05-29 17:08:56', 1),
(13, 'gladias 2 core gaming mice', 10, 11, '', 2500, 365, '1716982866.png', '2024-05-29 17:11:06', 1),
(14, 'asus external dvd writer usb', 6, 24, '', 7500, 365, '1716983085.png', '2024-05-29 17:14:45', 1),
(15, 'asus internal dvd writer sata', 6, 16, '', 2500, 365, '1716983125.png', '2024-05-29 17:15:25', 1),
(16, 'samsung 990 pro m2 nvme ssd', 12, 17, '', 97500, 720, '1716983296.png', '2024-05-29 17:18:16', 1),
(17, 'falcon pc casing micro atx', 13, 10, '', 2500, 0, '1716983457.png', '2024-05-29 17:20:57', 1),
(18, 'east 650va line interactive ups', 14, 18, '', 8000, 365, '1716983549.jpg', '2024-05-29 17:22:29', 1),
(19, 'asus prime b650 ma wifi motherboard', 6, 19, '', 30000, 1000, '1716983633.png', '2024-05-29 17:23:53', 1),
(20, 'asus prime h510 me motherboard', 6, 19, '', 25000, 1000, '1716983722.png', '2024-05-29 17:25:22', 1),
(21, 'amd ryzen 5 5600g desktop processor', 15, 20, '', 40000, 720, '1716983781.png', '2024-05-29 17:26:21', 1),
(22, 'nzxt relay subwoofer hero ', 16, 12, '', 9000, 365, '1716984041.png', '2024-05-29 17:30:41', 1),
(23, 'asus rog strix geforce rtx4090 ', 6, 15, '', 100000, 1000, '1716984109.png', '2024-05-29 17:31:49', 1),
(24, 'apple magic keyboard wireless', 17, 9, '', 9750, 365, '1716984319.png', '2024-05-29 17:35:19', 1),
(25, 'apple magic mice wireless', 17, 11, '', 2500, 365, '1716984355.png', '2024-05-29 17:35:55', 1),
(26, 'apple macbook pro 13 m1 8gb 2020', 17, 1, '', 250000, 1000, '1717058909.png', '2024-05-30 14:18:29', 1),
(27, 'apple macbook air 13 m1 8gb 2020', 17, 1, '', 250000, 1000, '1717058959.png', '2024-05-30 14:19:19', 1),
(28, 'asus tuf b760 plus wifi motherboard', 6, 19, '', 30000, 1000, '1717059055.png', '2024-05-30 14:20:55', 1),
(30, 'intel core i5 12650 desktop processor', 19, 20, '', 50000, 1000, '1717059285.png', '2024-05-30 14:24:45', 1),
(31, 'g733 black rgb pro headset', 9, 13, '', 4000, 720, '1717059447.png', '2024-05-30 14:27:27', 1),
(32, 'asus eyecare plus 24 ips 75hz monitor', 6, 22, '', 45000, 1000, '1717059561.jpeg', '2024-05-30 14:29:21', 1),
(33, 'asus gaming series 24 ips 100hz monitor', 6, 22, '', 60000, 1000, '1717059651.jpeg', '2024-05-30 14:30:51', 1),
(34, 'aoc essential 20 tn 60hz monitor', 20, 22, '', 25000, 1000, '1717059783.jpeg', '2024-05-30 14:33:03', 1),
(35, 'eset internet security 1 user 1 year pack', 21, 23, '', 2500, 0, '1717059902.jpeg', '2024-05-30 14:35:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `status`) VALUES
(1, 'Administrator', 1),
(2, 'Manager', 1),
(3, 'Cashier', 1),
(4, 'Stock Keeper', 1),
(5, 'Sales Assistant', 1),
(6, 'Receptionist', 1),
(7, 'Customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `product_id` int(11) NOT NULL,
  `grade` varchar(11) NOT NULL DEFAULT 'A',
  `note` varchar(256) DEFAULT NULL,
  `unit_cost` int(30) NOT NULL,
  `remaining` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `quantity`, `added_at`, `product_id`, `grade`, `note`, `unit_cost`, `remaining`, `status`) VALUES
(28, 50, '2024-05-29 16:12:57', 1, 'A', '', 75000, 39, 1),
(29, 50, '2024-05-29 16:13:39', 1, 'A', '', 75000, 50, 1),
(30, 10, '2024-05-29 16:17:15', 2, 'B', '', 22500, 1, 1),
(32, 50, '2024-05-29 16:41:33', 3, 'A', '', 125000, 45, 1),
(33, 10, '2024-05-29 17:37:11', 24, 'A', '', 1700, 8, 1),
(34, 50, '2024-05-30 16:37:33', 13, 'A', '', 1200, 48, 1),
(35, 2, '2024-06-03 15:07:26', 1, 'A', '', 72500, 2, 1),
(36, 10, '2024-06-03 16:08:27', 4, 'A', '', 90000, 10, 1),
(37, 10, '2024-06-03 16:08:55', 7, 'A', '', 150000, 8, 1),
(38, 15, '2024-06-03 16:09:22', 8, 'A', '', 145000, 12, 1),
(39, 50, '2024-06-03 16:10:08', 9, 'A', '', 129000, 45, 1),
(40, 50, '2024-06-11 14:15:12', 10, 'A', '', 3500, 38, 1),
(41, 40, '2024-06-11 14:15:50', 11, 'A', '', 2000, 39, 1),
(42, 25, '2024-06-11 14:16:24', 12, 'A', '', 7500, 24, 1),
(43, 20, '2024-06-11 14:16:57', 13, 'A', '', 1800, 20, 1),
(44, 30, '2024-06-11 14:17:28', 14, 'A', '', 6000, 26, 1),
(45, 50, '2024-06-11 14:17:54', 15, 'A', '', 2000, 49, 1),
(46, 10, '2024-06-11 14:18:21', 16, 'A', '', 75000, 9, 1),
(47, 50, '2024-06-11 14:18:41', 17, 'A', '', 1700, 45, 1),
(48, 30, '2024-06-11 14:19:25', 18, 'A', '', 7000, 29, 1),
(49, 50, '2024-06-11 14:19:59', 19, 'A', '', 25000, 49, 1),
(50, 50, '2024-06-11 14:20:18', 20, 'A', '', 20000, 48, 1),
(51, 10, '2024-06-11 14:21:23', 25, 'A', '', 2000, 9, 1),
(52, 100, '2024-08-14 16:57:25', 2, 'A', '', 22500, 95, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `cat_id`, `status`) VALUES
(1, 'laptop', 1, 1),
(3, 'assembled pc', 2, 1),
(8, 'mobile wifi', 6, 1),
(9, 'keyboard', 10, 1),
(10, 'pc casing', 7, 1),
(11, 'mice', 10, 1),
(12, 'speaker', 10, 1),
(13, 'headset', 10, 1),
(14, 'ram', 7, 1),
(15, 'graphics card', 7, 1),
(16, 'optical drive', 7, 1),
(17, 'ssd', 7, 1),
(18, 'ups', 12, 1),
(19, 'motherboard', 7, 1),
(20, 'processor', 7, 1),
(21, 'docking station', 12, 1),
(22, 'monitor', 11, 1),
(23, 'virus guard', 13, 1),
(24, 'storage drives', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `token_no` int(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(256) NOT NULL,
  `fee` int(11) NOT NULL DEFAULT 0,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'TBC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`id`, `token_no`, `user_id`, `type`, `description`, `fee`, `added_at`, `status`) VALUES
(8, 1714647162, 14, 'Other', 'Test1', 500, '2024-05-02 16:22:42', 'In_Works'),
(9, 1714647440, 14, 'Payment', 'Test2', 200, '2024-05-02 16:27:20', 'TBC'),
(10, 1723634966, 17, 'Payment', ' ', 0, '2024-08-14 16:59:26', 'Accepted'),
(11, 1723719933, 14, 'Purchase', 'Test1', 0, '2024-08-15 16:35:33', 'TBC'),
(12, 1723720039, 23, 'Purchase', 'Test1', 600, '2024-08-15 16:37:19', 'Solved'),
(13, 1723720455, 23, 'Delivery', 'Test1', 350, '2024-08-15 16:44:15', 'TBC'),
(14, 1723722094, 23, 'Technical', 'Test1', 0, '2024-08-15 17:11:34', 'TBC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL DEFAULT 'N/A',
  `last_name` varchar(256) NOT NULL DEFAULT 'N/A',
  `gender` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `nic` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'default.png',
  `role_id` int(11) NOT NULL DEFAULT 7,
  `added_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `gender`, `dob`, `nic`, `phone`, `image`, `role_id`, `added_at`, `status`) VALUES
(14, 'ushan', 'palliyaguru', 0, '1997-11-03', '199703080415', 114125727, '1718095194.png', 1, '2024-05-10 16:55:54', 1),
(16, 'Staff', 'User', NULL, NULL, 'N/A', NULL, 'staff.png', 6, '2024-05-10 16:55:54', 1),
(17, 'Staff', 'User', NULL, NULL, 'N/A', NULL, 'staff.png', 2, '2024-05-10 16:55:54', 1),
(18, 'Staff', 'User', NULL, NULL, NULL, NULL, 'staff.png', 3, '2024-05-28 16:35:46', 1),
(19, 'Staff', 'User', NULL, NULL, NULL, NULL, 'staff.png', 4, '2024-05-28 17:07:17', 1),
(20, 'Staff', 'User', NULL, NULL, NULL, NULL, 'staff.png', 5, '2024-06-01 16:11:50', 1),
(21, 'ravindu', 'gunaratne', 0, '1983-05-24', '198305241111', 114251000, 'default.png', 7, '2024-06-10 16:43:31', 1),
(22, 'thilini', 'jayawardena', 1, '1987-09-12', '198712092222', 114252000, 'default2.png', 7, '2024-06-10 16:45:45', 1),
(23, 'kasun', 'wickramasinghe', 0, '1987-06-07', '198706073333', 114253005, 'default.png', 7, '2024-06-10 16:48:35', 1),
(24, 'madusha', 'rajapaksa', 1, '1995-11-18', '199511184444', 114254000, 'default2.png', 7, '2024-06-10 16:54:57', 1),
(25, 'chathura', 'samaraweera', 0, '1988-04-03', '198804035555', 114255000, 'default.png', 7, '2024-06-10 17:04:09', 1),
(26, 'sandali', 'peris', 1, '1994-08-29', '199408296666', 114256000, 'default2.png', 7, '2024-06-10 17:07:23', 1),
(27, 'dhanuka', 'pathirana', 0, '1982-02-14', '198202147777', 114257000, 'default.png', 7, '2024-06-10 17:08:48', 1),
(28, 'nimnaka', 'ranasinghe', 0, '1999-06-09', '199906098888', 114258000, 'default.png', 7, '2024-06-10 17:10:20', 1),
(29, 'sachini', 'wijesekara', 1, '1985-12-22', '198512229999', 114259000, 'default2.png', 7, '2024-06-10 17:11:42', 1),
(30, 'nethmi', 'fernando', 1, '1998-10-17', '199810170000', 114250000, '1717238535.jpg', 7, '2024-06-10 17:14:33', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_role`
--
ALTER TABLE `module_role`
  ADD KEY `module_id` (`module_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `subcat_id` (`subcat_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `orders_product`
--
ALTER TABLE `orders_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `delivery_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `module_role`
--
ALTER TABLE `module_role`
  ADD CONSTRAINT `module_role_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`),
  ADD CONSTRAINT `module_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD CONSTRAINT `orders_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orders_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `orders_product_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`subcat_id`) REFERENCES `subcategory` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
