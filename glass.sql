-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2022 at 01:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glass`
--

-- --------------------------------------------------------

--
-- Table structure for table `challan`
--

CREATE TABLE `challan` (
  `challan_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challan`
--

INSERT INTO `challan` (`challan_id`, `customer_id`, `customer_name`, `time`) VALUES
(1, 1, 'dipesh', '2022-04-17 13:53:56'),
(2, 2, 'admin', '2022-04-17 13:55:42'),
(3, 2, 'admin', '2022-04-17 13:56:00'),
(4, 2, 'admin', '2022-04-20 12:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_contact` varchar(22) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `c_name`, `c_contact`, `c_email`, `c_address`, `time`) VALUES
(1, 'dipesh', '123123123', 'dipesh@gmail.com', 'virar', '2022-04-16 05:53:48'),
(2, 'admin', '234234234', 'admin@gmail.com', 'virar', '2022-04-16 05:54:29');

-- --------------------------------------------------------

--
-- Table structure for table `hardware`
--

CREATE TABLE `hardware` (
  `hardware_id` int(11) NOT NULL,
  `hardware_name` varchar(255) NOT NULL,
  `hardware_desc` varchar(255) DEFAULT NULL,
  `hardware_rate` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hardware`
--

INSERT INTO `hardware` (`hardware_id`, `hardware_name`, `hardware_desc`, `hardware_rate`, `time`) VALUES
(1, 'hardware1', 'test', 100, '2022-04-16 05:56:15'),
(2, 'Holders', 'test', 2000, '2022-04-20 07:07:29'),
(3, 'Cartrages', 'Used for holding ', 3466, '2022-04-20 07:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `iv_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `iv_challan_id` int(11) NOT NULL,
  `iv_product_id` int(11) NOT NULL,
  `iv_product_name` varchar(255) NOT NULL,
  `iv_product_dim` varchar(255) NOT NULL,
  `iv_product_quantity` int(11) NOT NULL,
  `iv_product_work` varchar(255) NOT NULL,
  `iv_product_tdim` int(11) NOT NULL,
  `iv_product_rate` int(11) NOT NULL,
  `iv_total` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`iv_id`, `customer_id`, `customer_name`, `iv_challan_id`, `iv_product_id`, `iv_product_name`, `iv_product_dim`, `iv_product_quantity`, `iv_product_work`, `iv_product_tdim`, `iv_product_rate`, `iv_total`, `time`) VALUES
(1, 1, 'dipesh', 1, 1, '4mm plain glass', '', 1, '', 0, 58, 58, '2022-04-20 14:50:50'),
(2, 1, 'dipesh', 1, 1, 'hardware1', '', 1, '', 0, 100, 100, '2022-04-20 14:50:50'),
(3, 2, 'admin', 2, 2, '5mm extra clear glass', '', 1, '', 0, 150, 150, '2022-04-20 14:50:50'),
(4, 2, 'admin', 2, 5, '5mm flutted glass', '', 1, '', 0, 150, 150, '2022-04-20 14:50:50'),
(5, 2, 'admin', 3, 5, '5mm flutted glass', '', 1, '', 0, 150, 150, '2022-04-20 14:50:50'),
(6, 2, 'admin', 3, 2, 'hardware2', '', 1, '', 0, 200, 200, '2022-04-20 14:50:50'),
(7, 2, 'admin', 3, 2, '5mm extra clear glass', '', 3, '', 0, 150, 450, '2022-04-20 14:50:50'),
(8, 2, 'admin', 3, 1, '4mm plain glass', '', 1, '', 0, 58, 58, '2022-04-20 14:50:50'),
(9, 2, 'admin', 3, 6, '10mm extra flutted glass', '', 3, '', 0, 445, 1335, '2022-04-20 14:50:50'),
(10, 2, 'admin', 3, 1, 'hardware1', '', 2, '', 0, 100, 200, '2022-04-20 14:50:50'),
(11, 2, 'admin', 3, 5, '5mm flutted glass', '', 1, '', 0, 150, 150, '2022-04-24 06:08:32'),
(12, 2, 'admin', 3, 1, 'hardware1', '', 1, '', 0, 100, 100, '2022-04-24 06:08:32'),
(13, 2, 'admin', 4, 2, '5mm extra clear glass', '', 1, '', 0, 150, 150, '2022-04-24 06:39:26'),
(14, 2, 'admin', 4, 1, 'hardware1', '', 1, '', 0, 100, 100, '2022-04-24 06:39:26'),
(15, 2, 'admin', 4, 5, '5mm flutted glass', '', 1, '', 0, 150, 150, '2022-04-24 06:39:26'),
(16, 1, 'dipesh', 1, 2, '5mm extra clear glass', '', 1, '', 0, 150, 150, '2022-04-24 11:06:56'),
(17, 1, 'dipesh', 1, 6, '10mm extra flutted glass', '', 1, '', 0, 445, 445, '2022-04-24 11:06:57');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_quote`
--

CREATE TABLE `invoice_quote` (
  `iv_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `iv_challan_id` int(11) NOT NULL,
  `iv_product_id` int(11) NOT NULL,
  `iv_product_name` varchar(255) NOT NULL,
  `iv_product_dim` varchar(255) NOT NULL,
  `iv_product_quantity` int(11) NOT NULL,
  `iv_product_work` varchar(255) NOT NULL,
  `iv_product_tdim` int(11) NOT NULL,
  `iv_product_rate` int(11) NOT NULL,
  `iv_total` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_quote`
--

INSERT INTO `invoice_quote` (`iv_id`, `customer_id`, `customer_name`, `iv_challan_id`, `iv_product_id`, `iv_product_name`, `iv_product_dim`, `iv_product_quantity`, `iv_product_work`, `iv_product_tdim`, `iv_product_rate`, `iv_total`, `time`) VALUES
(1, 1, 'dipesh', 1, 5, '5mm flutted glass', '', 1, '', 0, 150, 150, '2022-04-24 11:08:24'),
(2, 2, 'admin', 2, 2, '5mm extra clear glass', '', 1, '', 0, 150, 150, '2022-04-24 11:10:06'),
(3, 2, 'admin', 2, 1, 'hardware1', '', 1, '', 0, 100, 100, '2022-04-24 11:10:06'),
(4, 2, 'admin', 2, 5, '5mm flutted glass', '', 1, '', 0, 150, 150, '2022-04-24 11:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `process_id` int(11) NOT NULL,
  `process_name` varchar(255) NOT NULL,
  `process_rate` float NOT NULL,
  `time` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`process_id`, `process_name`, `process_rate`, `time`) VALUES
(1, 'back painted', 150, 2147483647),
(2, 'Back Painted metallic', 175, 2147483647),
(3, 'magnetic glass', 225, 2147483647),
(4, 'lamination', 105, 2147483647),
(5, 'Nano coating', 65, 2147483647),
(6, 'pvc coating', 12, 2147483647),
(7, 'cep', 1.25, 2147483647),
(8, 'Mirror Finish-Red', 250, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_thickness` int(11) DEFAULT NULL,
  `product_rate` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_thickness`, `product_rate`, `time`) VALUES
(1, '4mm plain glass', 'plain glass', 4, 58, '2022-04-16 05:39:54'),
(2, '5mm extra clear glass', 'ecg', 5, 150, '2022-04-16 05:40:47'),
(3, '4mm mirror', 'mirror', 4, 80, '2022-04-16 05:41:36'),
(4, '12mm brown plain glass', 'brown glass', 12, 195, '2022-04-16 05:43:08'),
(5, '5mm flutted glass', 'test', 5, 150, '2022-04-16 05:46:13'),
(6, '10mm extra flutted glass', 'test', 10, 445, '2022-04-16 05:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `quote_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`quote_id`, `customer_id`, `customer_name`, `time`) VALUES
(1, 1, 'dipesh', '2022-04-24 11:02:13'),
(2, 2, 'admin', '2022-04-24 11:09:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challan`
--
ALTER TABLE `challan`
  ADD PRIMARY KEY (`challan_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`hardware_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`iv_id`);

--
-- Indexes for table `invoice_quote`
--
ALTER TABLE `invoice_quote`
  ADD PRIMARY KEY (`iv_id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`process_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challan`
--
ALTER TABLE `challan`
  MODIFY `challan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hardware`
--
ALTER TABLE `hardware`
  MODIFY `hardware_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `iv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `invoice_quote`
--
ALTER TABLE `invoice_quote`
  MODIFY `iv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
