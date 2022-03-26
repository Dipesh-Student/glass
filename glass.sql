-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 04:08 PM
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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_rate` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_rate`, `time`) VALUES
(1, 'dipesh bhowar', 'lorem ipsum', 12, '2022-03-24 13:42:43'),
(2, 'glass 14mm', 'hello updated', 1005, '2022-03-24 13:43:05'),
(3, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:50:49'),
(4, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:51:58'),
(5, 'glass 14mm', 'daw', 435, '2022-03-24 13:52:07'),
(6, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:54:32'),
(7, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:55:32'),
(8, 'glass 14mm', 'ddwadaw', 3243254, '2022-03-24 13:55:39'),
(9, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:56:39'),
(10, 'glass 4mm', 'qfwd', 324, '2022-03-24 13:56:45'),
(11, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:58:20'),
(12, 'glass 14mm', 'wda', 324, '2022-03-24 13:58:26'),
(13, 'dipesh', 'lorem ipsum', 12, '2022-03-24 13:58:58'),
(14, 'glass 14mm', 'DEWQDW', 3245, '2022-03-24 13:59:04'),
(15, 'dipesh', 'lorem ipsum', 12, '2022-03-24 14:19:34'),
(17, 'glass 14mm', 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before the final copy is available', 7890, '2022-03-25 14:16:47'),
(18, 'glass 14m13', 'hello world', 1300, '2022-03-26 06:02:23'),
(19, '12mm mirror glass', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 170, '2022-03-26 10:35:00'),
(20, '10mm plain glass', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, co', 170, '2022-03-26 10:36:10'),
(21, '12mm red glass', 'this is a test', 195, '2022-03-26 12:27:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
