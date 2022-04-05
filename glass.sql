-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 10:45 AM
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
(1, 'dipesh', '1243567890', 'dipeshbhowar001#gmail.com', 'virar', '2022-03-30 13:01:40'),
(2, 'Dipesh Bhowar', '324', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-03-30 14:40:59'),
(3, 'Dipesh Bhowar', '7969876', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-03-30 14:41:18'),
(4, 'Dipesh Bhowar', '324', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-03-30 14:41:36'),
(5, 'Dipesh Bhowar', '324', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-03-30 14:45:54'),
(6, 'Dipesh Bhowar', '3456', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-03-30 14:48:01'),
(7, 'Dipesh Bhowar', '89989324', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-03-31 05:30:53'),
(8, 'Dipesh Bhowar', '345346', 'dipeshbhowar@gmail.com', '301,Shree Vajreshwari,Padmi ', '2022-03-31 05:31:47'),
(9, 'Dipesh Bhowar', '987654321', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-04-01 05:15:10'),
(10, 'Dipesh Bhowar', '9090909090', 'dipeshbhowar001@gmail.com', '301,Shree Vajreshwari,Padmi nagar,phool pada road,virar east', '2022-04-01 05:27:37');

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
(1, 'black-painted', 150, 2147483647),
(2, 'Back Painted', 150, 2147483647),
(3, 'Back Painted metallic', 150, 2147483647),
(4, 'cep', 1, 2147483647),
(5, 'cep', 1, 2147483647),
(6, 'cep', 1, 2147483647),
(7, 'cep', 1, 2147483647),
(8, 'cep', 1.25, 2147483647),
(9, 'cep-latest', 6001, 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_rate` float NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_rate`, `time`) VALUES
(1, 'dipesh bhowar', 'lorem ipsum', 12, '2022-03-24 13:42:43'),
(2, 'glass 14mm', 'hello dipesh', 1005, '2022-03-24 13:43:05'),
(3, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:50:49'),
(4, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:51:58'),
(5, 'glass 14mm', 'daw', 435, '2022-03-24 13:52:07'),
(6, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:54:32'),
(7, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:55:32'),
(8, 'glass 14mm', 'ddwadaw', 3243250, '2022-03-24 13:55:39'),
(9, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:56:39'),
(10, 'glass 4mm', 'qfwd', 324, '2022-03-24 13:56:45'),
(11, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:58:20'),
(12, 'glass 14mm', 'wda', 324, '2022-03-24 13:58:26'),
(13, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:58:58'),
(14, 'glass 14mm', 'DEWQDW', 3245, '2022-03-24 13:59:04'),
(15, 'dipesh', 'lorem ipsum', 12, '2022-03-24 14:19:34'),
(17, 'glass 14mm', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available', 7890, '2022-03-25 14:16:47'),
(18, 'glass 14m13', 'hello world', 1300, '2022-03-26 06:02:23'),
(19, '12mm mirror white glass', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 170, '2022-03-26 10:35:00'),
(20, '10mm plain glass', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', 170, '2022-03-26 10:36:10'),
(21, '12mm red glass', 'this is a test', 195, '2022-03-26 12:27:16'),
(22, 'glass 8mm tuff glass', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 250, '2022-03-27 15:19:03'),
(23, '12mm brown plain glass', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 250, '2022-03-27 15:23:19'),
(24, '2mm brown mirror glass', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 234, '2022-03-28 09:05:26'),
(25, 'glass', 'r3', 23, '2022-03-28 09:06:23'),
(26, '2mm brown mirror glass', '342', 324, '2022-03-28 09:06:43'),
(27, 'glass 14mm 27 mirror', '23432', 3242, '2022-03-28 09:08:40'),
(28, 'glass 14mm mirror plane', '5000', 122, '2022-03-28 09:09:36'),
(29, '10mm flutted glass', 'lorem-ipusm', 380, '2022-03-29 08:46:34'),
(30, '10mm flutted glass', 'lorem-ipusm', 380, '2022-03-29 08:47:37'),
(31, '8mm extra clear flutted', 'lorem ipsum', 350, '2022-03-29 08:51:50'),
(32, 'glass 14mm', 'empty', 500, '2022-03-29 09:02:40'),
(33, 'glass 14mm', 'item decimal', 546, '2022-03-29 13:03:03'),
(34, 'glass', 'item', 500.5, '2022-03-29 13:03:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `process_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
