-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 10:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `login_type` enum('user','admin') NOT NULL,
  `email_verify_token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>Unverified, 1=>verified',
  `status` enum('Active','Inactive','Disabled') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `email`, `password`, `first_name`, `last_name`, `login_type`, `email_verify_token`, `is_verified`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin.test@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'user', 'admin', NULL, 1, 'Active', '2022-03-25 23:35:22', '2022-03-25 18:05:26'),
(2, 'jeel.devid123@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'Devid', 'Jeel', 'user', NULL, 1, 'Active', '2022-03-25 19:09:45', '2022-03-25 18:13:56'),
(3, 'jack.ravi@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ravi', 'Jack', 'user', NULL, 1, 'Active', '2022-03-25 19:12:42', '2022-03-26 06:36:25'),
(10, 'sudhir.singh@quadrish.com', 'e10adc3949ba59abbe56e057f20f883e', 'Allen', 'Marks', 'user', 'pmks4WLxqQZz5E2MbDnfO0Jh9', 0, 'Active', '2022-03-26 05:27:02', '2022-03-26 04:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `description`, `image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'iPhone', 'This is an iPhone', NULL, 'Active', 1, '2022-03-25 19:35:57', '2022-03-26 06:57:17'),
(2, 'Android Phone', 'This is an Android', NULL, 'Active', 1, '2022-03-25 19:35:57', '2022-03-26 05:18:59'),
(3, 'iPod', 'This is an iPod', NULL, 'Active', 1, '2022-03-25 19:35:57', '2022-03-26 05:19:04'),
(4, 'Tab', 'This is an Tab', NULL, 'Active', 1, '2022-03-25 19:35:57', '2022-03-26 06:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_products`
--

CREATE TABLE `tbl_user_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` float(8,4) NOT NULL DEFAULT 0.0000,
  `product_count` int(5) DEFAULT 0,
  `total_price` float(8,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_products`
--

INSERT INTO `tbl_user_products` (`id`, `user_id`, `product_id`, `product_price`, `product_count`, `total_price`, `created_at`) VALUES
(1, 2, 1, 500.0000, 4, 0.0000, '2022-03-26 06:32:21'),
(2, 2, 2, 120.0000, 6, 0.0000, '2022-03-26 06:33:30'),
(3, 2, 4, 2000.0000, 2, 0.0000, '2022-03-26 06:34:28'),
(4, 3, 1, 170.0000, 2, 0.0000, '2022-03-26 06:37:12'),
(5, 3, 2, 200.0000, 1, 0.0000, '2022-03-26 06:37:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_products`
--
ALTER TABLE `tbl_user_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_products`
--
ALTER TABLE `tbl_user_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
