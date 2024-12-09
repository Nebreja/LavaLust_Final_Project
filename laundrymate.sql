-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2024 at 09:43 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundrymate`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `phone_number`, `address`, `email`, `password`, `created_at`, `role`) VALUES
(4, 'Ivan', 'Fababaer', '09123456791', 'Laguna, Naujan Oriental Mindoro', 'ivan@gmail.com', '$2y$10$uiJfwPjkwF7MGuQsD39JQOPTZOp2Yf6w0M9A/o5MG46WU6O1DwIvy', '2024-11-26 13:26:25', 'customer'),
(5, 'Mate', 'Laundry', '09123456789', 'Masipit, Calapan City', 'laundrymate@gmail.com', '$2y$10$u6A.RxmFVLADLNNpMKc92u1orI.07aNG9lsn92hGggYgOYv6Ez42q', '2024-11-27 13:37:17', 'admin'),
(8, 'Harlyn', 'Nebreja', '09933886462', 'Laguna, Naujan Oriental Mindoro', 'nebrejaharlyn@gmail.com', '$2y$10$h8E.KUdvv4QuBgC8wJpP1uAjrL1CMVIMrC4S2gclelf/mMo0wwKEC', '2024-12-01 07:07:25', 'customer'),
(9, 'Rae Mae', 'Mistal', '09123456789', 'Laguna, Naujan', 'mistal@gmail.com', '$2y$10$MQe53ulkFROSFRe46MsfFeXAXHxrEHNUAnKTZjW7H4qd5zVfhQKNS', '2024-12-05 06:02:56', 'customer'),
(10, 'Darylld', 'Tupaz', '09123456789', 'Puerto Galera', 'tupaz@gmail.com', '$2y$10$VTGYHL0kv9lu.kdUAGUgjOFTN.BzSIQf.ZHtGOuwFSJNdKVPZM6Wu', '2024-12-06 15:19:03', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `service_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `special_instructions` text COLLATE utf8mb4_general_ci,
  `status` enum('Pending','In Progress','Completed') COLLATE utf8mb4_general_ci DEFAULT 'Pending',
  `kilo` decimal(5,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `is_paid` enum('Paid','Not Paid') COLLATE utf8mb4_general_ci DEFAULT 'Not Paid',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `customer_id`, `service_type`, `special_instructions`, `status`, `kilo`, `total_amount`, `is_paid`, `created_at`) VALUES
(1, 4, 'wash_and_fold', 'dapat malinis', 'Completed', 1.00, 200.00, 'Paid', '2024-11-27 14:48:59'),
(8, 4, 'express_laundry', 'i need it by afternoon', 'In Progress', 2.00, 400.00, 'Paid', '2024-11-27 15:08:37'),
(9, 4, 'ironing_only', 'flat dapat', 'Completed', 1.00, 150.00, 'Paid', '2024-11-27 15:10:14'),
(10, 4, 'ironing_only', 'flat dapat', 'Completed', 1.00, 150.00, 'Paid', '2024-11-27 15:13:06'),
(16, 10, 'wash_and_fold', 'i need it by afternoon', 'Completed', 2.00, 400.00, 'Paid', '2024-12-06 15:20:16');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
