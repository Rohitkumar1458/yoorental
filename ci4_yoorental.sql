-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2026 at 07:00 AM
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
-- Database: `ci4_yoorental`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `privilege_id` int(11) NOT NULL,
  `address` varchar(400) NOT NULL,
  `added_by` int(5) NOT NULL,
  `update_by` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '0-Inactive, 1-Active',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`user_id`, `name`, `email`, `password`, `ip_address`, `phone`, `image`, `privilege_id`, `address`, `added_by`, `update_by`, `status`, `created`, `updated`) VALUES
(1, 'KBC Institutes', 'admin@admin.com', '$2y$10$kMrp4B6YQD5n.nVwmUs.Muk.SX7ft3Y0kbH071yrmPVgArP5k41lm', '::1', '122344556', '', 1, 'Noida sector 19', 1, 1, 1, '2021-09-06 04:53:19', '2025-01-17 05:01:08'),
(15, 'test123', 'test@yopmail.com', '$2y$10$fqYWNLFqBT3yt7nCO4xsROQuDPi1Evl74/zTRkNkzlh2k4qVYQ4JG', '::1', '2356897485', '', 3, 'delhi', 1, 1, 1, '2022-12-27 03:45:07', '2022-12-30 09:33:34'),
(16, 'test175 qwertyy', 'test175@yopmail.com', '$2y$10$n6uyNrkfB9SHBImdRrCsR.x5sgHFkCCwQtQLODH65CqOasEOrFLBO', '::1', '7865432343', '', 3, 'delhi qwerty', 1, 15, 1, '2022-12-27 07:17:37', '2025-09-08 05:38:35'),
(17, 'md raj guddu', 'raj@yopmail.com', '$2y$10$FsYujlq0Iogtf4qypy4AuO6x4rVmE1qFH8RsQiS9SstotI8ysBC5u', '::1', '3214569870', '', 0, '', 15, 0, 1, '2025-09-04 05:55:12', '0000-00-00 00:00:00'),
(18, 'brajesh ', 'b@yopmail.com', '$2y$10$amdXxbNqclYbqyKQ2GKPqeHap.UwvJd2.4WRlwo6q.4pl.19mIUwO', '::1', '7894561234', 'u_1757656583.png', 0, '', 15, 15, 0, '2025-09-04 06:01:12', '2025-09-12 05:56:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(2) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int(2) NOT NULL,
  `unit` int(2) NOT NULL,
  `measur` varchar(10) NOT NULL,
  `status` int(2) NOT NULL COMMENT '0-inactive, 1-active',
  `is_front` int(2) NOT NULL COMMENT '0-no, 1-yes',
  `added_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `product_name`, `url`, `image`, `price`, `unit`, `measur`, `status`, `is_front`, `added_at`, `update_at`) VALUES
(1, 'Horlicks', 'horlicks', 'p_1758001509.jpg', 250, 500, 'g', 1, 1, '2025-09-16 05:45:09', '2025-09-19 05:18:13'),
(2, 'Masur Dal', 'masur-dal', 'p_1758174255.jpg', 85, 1, 'KG', 1, 1, '2025-09-18 05:44:15', '2025-09-18 05:45:26'),
(3, 'Refined Oil', 'refined-oil', 'p_1758174284.jpg', 150, 1, 'L', 1, 1, '2025-09-18 05:44:44', '2025-09-18 05:45:38'),
(4, 'Surf Excel', 'surf-excel', 'p_1758174314.jpg', 160, 2, 'KG', 1, 1, '2025-09-18 05:45:14', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `url` (`url`,`status`,`is_front`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
