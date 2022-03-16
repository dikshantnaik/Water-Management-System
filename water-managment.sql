-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2022 at 04:44 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `water-managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `type`) VALUES
(1, 'root', '', '$2y$10$FG3.WOTTFlGYlQ03O/Eqi.RrtZIoNHxQwfLuGxULeiZTxGFWe4DX.', 'admin'),
(2, 'root', '$2y$10$1f1O.n7smkk3iRkF5P3WcOK73VW6FQ4o8GkGZBxfkgFDuUnSNB60C', 'dik@gmail.com', 'admin'),
(3, 'root', 'pass@waa', '$2y$10$dztIGrP7r7uNGl63BAUf..iSN2QW8aWSwIFtSqH7peOvkyFgodDB2', 'admin'),
(4, 'admin', 'admin@gmail.com', '$2y$10$JXUHqe014he1VbVJfv441eh05wGBn4VMib2QwTuDb0LO.pOQVhQES', 'admin'),
(6, 'dik', 'dik@gmail.com', '$2y$10$xOz/HFJ4O6/oJIPCF5LJ/ubUX8KNaYOD7YoMauIBUNr263NQTsiTG', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_phone`) VALUES
(1, 'Dikshant23', '99750576266'),
(3, 'HEllo', '1223'),
(5, 'Akshata', '9004439609');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `type` int(50) NOT NULL COMMENT '0-bought 1-Sold',
  `vendor_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `payment_status` varchar(50) NOT NULL COMMENT '0=pending 1=paid',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `type`, `vendor_id`, `customer_id`, `total`, `payment_status`, `date`) VALUES
(1045, 1, NULL, 1, 200, 'paid', '2022-02-14'),
(1046, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1047, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1049, 1, NULL, 1, 0, 'paid', '2022-02-14'),
(1050, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1051, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1052, 1, NULL, 1, 0, 'paid', '2022-02-14'),
(1053, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1054, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1055, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1056, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1057, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1058, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1059, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1060, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1061, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1062, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1063, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1064, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1065, 1, NULL, 1, 0, 'pending', '2022-02-14'),
(1066, 1, NULL, 3, 0, 'pending', '2022-02-15'),
(1067, 1, NULL, 3, 0, 'pending', '2022-02-15'),
(1068, 1, NULL, 3, 0, 'pending', '2022-02-15'),
(1069, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1070, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1071, 1, NULL, 1, 300, 'pending', '2022-02-15'),
(1072, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1073, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1074, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1075, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1076, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1077, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1078, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1079, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1080, 1, NULL, 1, 0, 'pending', '2022-02-15'),
(1081, 1, NULL, 1, 20710, 'paid', '2022-02-15'),
(1082, 1, NULL, 1, 1700, 'paid', '2022-02-16'),
(1083, 0, 88, NULL, 0, 'pending', '2022-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `orders_product`
--

CREATE TABLE `orders_product` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_product`
--

INSERT INTO `orders_product` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1045, 1, 10),
(4, 1049, 1, 11),
(5, 1050, 1, 11),
(6, 1051, 1, 11),
(7, 1053, 1, 11),
(10, 1081, 2, 58),
(11, 1081, 3, 10),
(12, 1082, 1, 85);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_cost` int(11) NOT NULL,
  `product_price` int(11) NOT NULL DEFAULT 0,
  `product_stock` int(11) NOT NULL DEFAULT 0
) ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_category`, `product_name`, `product_cost`, `product_price`, `product_stock`) VALUES
(1, 'Water Bottle', 'Bislery', 0, 20, 1712),
(2, 'Water Jar', 'Kinely23', 0, 355, 100),
(3, 'aw', '2323', 0, 12, 10),
(4, 'www', 'www', 0, 233, 213123);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `vendor_phone` varchar(100) NOT NULL,
  `product_id` int(11) DEFAULT 1,
  `vendor_quantity` int(11) NOT NULL,
  `vendor_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendor_name`, `vendor_phone`, `product_id`, `vendor_quantity`, `vendor_price`) VALUES
(74, 'awdwad', '11113243132', 1, 1243, 43),
(80, 'John', '88117722', 2, 2312, 242423),
(88, 'Krishnataknt', '88888888888', 1, 23, 233),
(90, 'awdwad', '111', 2, 123, 223),
(92, 'Test2', '8828822213', 1, 122, 555);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vendor_phone` (`vendor_phone`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1084;

--
-- AUTO_INCREMENT for table `orders_product`
--
ALTER TABLE `orders_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD CONSTRAINT `orders_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orders_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
