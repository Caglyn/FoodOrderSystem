-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 10:17 PM
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
-- Database: `FoodOrderSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) NOT NULL,
  `title` varchar(250) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_name` varchar(250) NOT NULL,
  `active` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `price`, `image_name`, `active`) VALUES
(1, 'Simit', 10.00, 'simit.png', 'Evet'),
(2, 'Çay', 4.00, 'çay.png', 'Evet'),
(3, 'Kahve', 10.00, 'kahve.png', 'Evet'),
(4, 'Su', 5.00, 'su.png', 'Evet'),
(5, 'Poğaça', 10.00, 'pogaca.png', 'Evet'),
(6, 'Sade Soda', 10.00, 'soda.png', 'Evet');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `order_id` varchar(250) NOT NULL,
  `food` varchar(250) NOT NULL,
  `price` int(250) NOT NULL,
  `qty` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `order_date` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `user_id`) VALUES
(132, '669a3d8675b20', 'Kahve', 10, 1, 10, '19-07-2024 12:18:46pm', 'Sipariş iptal edildi', 1),
(133, '669a3d8fc90bf', 'Kahve', 10, 1, 10, '19-07-2024 12:18:55pm', 'Sipariş iptal edildi', 1),
(134, '669a61b78f363', 'Simit', 50, 1, 50, '19-07-2024 02:53:11pm', 'Sipariş teslim edildi', 4),
(135, '669a61b78f363', 'Çay', 2, 1, 2, '19-07-2024 02:53:11pm', 'Sipariş teslim edildi', 3),
(136, '669a61b78f363', 'Kahve', 10, 1, 10, '19-07-2024 02:53:11pm', 'Sipariş teslim edildi', 3),
(137, '669a61ec887d2', 'Simit', 50, 1, 50, '19-07-2024 02:54:04pm', 'Sipariş iptal edildi', 3),
(138, '669a620c5a853', 'Simit', 50, 1, 50, '19-07-2024 02:54:36pm', 'Sipariş iptal edildi', 3),
(139, '669a620c5a853', 'Çay', 2, 1, 2, '19-07-2024 02:54:36pm', 'Sipariş iptal edildi', 4),
(140, '669a62355d735', 'Çay', 2, 1, 2, '19-07-2024 02:55:17pm', 'Sipariş iptal edildi', 3),
(141, '669d543d9b385', 'Simit', 10, 3, 30, '21-07-2024 08:32:29pm', 'Sipariş iptal edildi', 1),
(142, '669d543d9b385', 'Kahve', 10, 1, 10, '21-07-2024 08:32:29pm', 'Sipariş iptal edildi', 1),
(143, '669d5492de5de', 'Simit', 10, 1, 10, '21-07-2024 08:33:54pm', 'Sipariş iptal edildi', 1),
(144, '669fa162dabff', 'Çay', 4, 1, 4, '23-07-2024 02:26:10pm', 'Sipariş iptal edildi', 1),
(145, '66a023fde867f', 'Simit', 10, 1, 10, '23-07-2024 11:43:25pm', 'Sipariş teslim edildi', 4),
(146, '66a023fde867f', 'Çay', 4, 1, 4, '23-07-2024 11:43:25pm', 'Sipariş teslim edildi', 4),
(147, '66a15a7c68ad7', 'Simit', 10, 1, 10, '24-07-2024 09:48:12pm', 'Sipariş iptal edildi', 1),
(148, '66a15a7c68ad7', 'Çay', 4, 1, 4, '24-07-2024 09:48:12pm', 'Sipariş iptal edildi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `department` varchar(250) NOT NULL,
  `balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `department`, `balance`) VALUES
(1, 'osmancan', '123456', 'Bilgi İşlem', 150.00),
(4, 'yusuf', '654321', 'Bilgi İşlem', 132.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
