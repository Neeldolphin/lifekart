-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2021 at 07:23 PM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_lifekart`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin_login`
--

CREATE TABLE `Admin_login` (
  `id` int NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Admin_login`
--

INSERT INTO `Admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'Admin123');

-- --------------------------------------------------------

--
-- Table structure for table `category_info`
--

CREATE TABLE `category_info` (
  `id` int NOT NULL,
  `CName` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category_info`
--

INSERT INTO `category_info` (`id`, `CName`, `image`, `description`, `create_at`, `update_at`) VALUES
(6, 'TV', 'images (6).jpeg', 'asd', '2021-11-10', '2021-11-10'),
(7, 'watch', 'images (1).jpeg', 'qwert', '2021-10-28', '2021-10-28'),
(8, 'mobile', 'images (7).jpeg', 'm', '2021-11-02', '2021-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `coupen_code`
--

CREATE TABLE `coupen_code` (
  `coupen_id` int NOT NULL,
  `coupen_name` varchar(255) NOT NULL,
  `coupen_discount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupen_code`
--

INSERT INTO `coupen_code` (`coupen_id`, `coupen_name`, `coupen_discount`) VALUES
(1, 'hello', 10),
(3, 'happy', 15),
(4, 'welcome', 20);

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `Id` int NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`Id`, `FirstName`, `LastName`, `Email`, `phone_number`, `Address`, `country`, `create_at`, `update_at`) VALUES
(2, 'vivek', 'patel', 'vivek@patel.com', '7845129630', 'gseafuighfefegf1323', 'Usa', '2021-11-10', '2021-11-10'),
(3, 'xyz', 'xyz', 'xyz@xyz.com', '1233211233', 'efegf2344', 'india', '2021-10-29', '2021-10-29'),
(4, 'abc', 'xyz', 'abc@xyz.com', '1234567890', 'gseafuighfefegf1323', 'india', '2021-11-10', '2021-11-10'),
(154, 'poi', 'patel', 'op@patel.com', '1321324560', 'efegf2344', 'india', '2021-11-11', '2021-11-11'),
(183, 'QWE', 'asd', 'op@jk.com', '3126544560', 'gseafuighfefegf1323', 'Usa', '2021-11-11', '2021-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `customer_signup`
--

CREATE TABLE `customer_signup` (
  `Id` int NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_signup`
--

INSERT INTO `customer_signup` (`Id`, `FirstName`, `LastName`, `username`, `email`, `password`) VALUES
(1, 'yash', 'xyz', 'yashxyz', 'xyzyash@1.com', 'qwert@123'),
(3, 'abc', 'xyz', 'abcxyz', 'czxbbffdrvg@sgreg.gsg', '422c6470d423fab8505610e2138eb2e4'),
(8, 'QWE', 'asd', 'qwexyz', 'qwexyz@gmail.com', 'b57b03f73ea2cc6041f0214e64d38663'),
(9, 'poi', 'jkl', 'poijkl', 'abc@afd.com', 'e552ddf7d5d29ad04eea2b928ccad050'),
(10, 'QWE', 'asd', 'qweasd', 'email@asd.com', 'b23cf2d0fb74b0ffa0cf4c70e6e04926');

-- --------------------------------------------------------

--
-- Table structure for table `Product_info`
--

CREATE TABLE `Product_info` (
  `Id` int NOT NULL,
  `pname` varchar(255) NOT NULL,
  `category` int NOT NULL,
  `SKU` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `qty` int NOT NULL,
  `Status` varchar(255) NOT NULL,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Product_info`
--

INSERT INTO `Product_info` (`Id`, `pname`, `category`, `SKU`, `image`, `price`, `description`, `video`, `qty`, `Status`, `create_at`, `update_at`) VALUES
(197, 'watch', 8, 221, 'a:2:{i:0;s:15:\"images (5).jpeg\";i:1;s:15:\"images (4).jpeg\";}', 50000, 'abc', 'file_example_MP4_480_1_5MG.mp4', 11111, 'Enable', '2021-11-10', '2021-11-10'),
(200, 'watch', 7, 464, 'a:1:{i:0;s:15:\"images (1).jpeg\";}', 5464, 'awesome', 'file_example_MP4_480_1_5MG.mp4', 465, 'Enable', '2021-11-02', '2021-11-02'),
(201, 'nature', 9, 555, 'a:1:{i:0;s:15:\"images (5).jpeg\";}', 214, 'dsvf', 'file_example_MP4_480_1_5MG.mp4', 342, 'Enable', '2021-11-02', '2021-11-02'),
(202, 'watch', 7, 555, 'a:1:{i:0;s:15:\"images (1).jpeg\";}', 550, 'awesome', 'file_example_MP4_480_1_5MG.mp4 ', 5, 'Enable', '2021-11-02', '2021-11-02'),
(203, 'shoe', 7, 111, 'a:1:{i:0;s:15:\"images (8).jpeg\";}', 1180, 'good', 'file_example_MP4_480_1_5MG.mp4 ', 2, 'Enable', '2021-11-02', '2021-11-02'),
(204, 'wallet', 7, 333, 'a:1:{i:0;s:15:\"images (1).jpeg\";}', 3234, 'best', 'file_example_MP4_480_1_5MG.mp4 ', 44, 'Enable', '2021-11-02', '2021-11-02'),
(205, 'shirt', 9, 123, 'a:1:{i:0;s:15:\"images (4).jpeg\";}', 432, 'awesome', 'file_example_MP4_480_1_5MG.mp4 ', 32, 'Enable', '2021-11-02', '2021-11-02'),
(206, 'nike', 7, 332, 'a:1:{i:0;s:15:\"images (1).jpeg\";}', 234, 'good', 'file_example_MP4_480_1_5MG.mp4 ', 332, 'Enable', '2021-11-02', '2021-11-02'),
(207, 'things', 6, 222, 'a:1:{i:0;s:15:\"images (2).jpeg\";}', 222, 'best', 'file_example_MP4_480_1_5MG.mp4 ', 222, 'Enable', '2021-11-02', '2021-11-02'),
(209, 'shirt', 10, 556655, 'a:1:{i:0;s:15:\"images (1).jpeg\";}', 333, 'good', 'file_example_MP4_480_1_5MG.mp4', 23, 'Enable', '2021-11-10', '2021-11-10'),
(210, 'shirt', 10, 111444, 'a:1:{i:0;s:15:\"images (1).jpeg\";}', 212, 'awesome', 'file_example_MP4_480_1_5MG.mp4 ', 221, 'Enable', '2021-11-09', '2021-11-09'),
(211, 'mobile', 8, 11223344, 'a:1:{i:0;s:15:\"images (8).jpeg\";}', 555, 'awesome', 'file_example_MP4_480_1_5MG.mp4 ', 443, 'Enable', '2021-11-09', '2021-11-09'),
(212, 'wallet', 7, 777, 'a:1:{i:0;s:15:\"images (3).jpeg\";}', 776, 'wwww', 'file_example_MP4_480_1_5MG.mp4 ', 7676, 'Enable', '2021-11-09', '2021-11-09'),
(216, 'shirt', 37, 321, 'a:1:{i:0;s:15:\"images (2).jpeg\";}', 123, 'dfdsgf', 'file_example_MP4_480_1_5MG.mp4', 312, 'Enable', '2021-11-11', '2021-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `imageName`, `link`) VALUES
(5, 'images (4).jpeg', 'abc.php'),
(20, 'images (5).jpeg', 'test.php'),
(21, 'images (2).jpeg', 'xyz.php');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin_login`
--
ALTER TABLE `Admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_info`
--
ALTER TABLE `category_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupen_code`
--
ALTER TABLE `coupen_code`
  ADD PRIMARY KEY (`coupen_id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `u_email` (`Email`);

--
-- Indexes for table `customer_signup`
--
ALTER TABLE `customer_signup`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Product_info`
--
ALTER TABLE `Product_info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin_login`
--
ALTER TABLE `Admin_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_info`
--
ALTER TABLE `category_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `coupen_code`
--
ALTER TABLE `coupen_code`
  MODIFY `coupen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `customer_signup`
--
ALTER TABLE `customer_signup`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Product_info`
--
ALTER TABLE `Product_info`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
