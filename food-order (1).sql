-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2022 at 04:49 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `user_name`, `password`) VALUES
(48, 'Pawan BIsht', 'pwnbisht', '4e3f8ba75ae5d286e56641971ad2769b'),
(49, 'Aanchal Tiwari', 'aanchal', 'e6c3ffe47e015740add06a4ead11767f');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `feature` varchar(4) NOT NULL,
  `active` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `feature`, `active`) VALUES
(22, 'Burger', 'food_category_2021_12_29-19-23-13.jpg', 'Yes', 'Yes'),
(23, 'Pizza', 'food_category_2021_12_29-19-23-30.jpg', 'Yes', 'Yes'),
(24, 'Momos', 'food_category_2021_12_29-19-35-07.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `dscr` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `dscr`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(25, 'Chicken Burger', 'Made with Italian Sauce, Chicken, and organice vegetables.', '2.00', 'food_2021_12_29-20-02-04.jpg', 22, 'Yes', 'Yes'),
(26, 'Cheez Pizza', 'Made with Italian Sauce, Chicken, and organice vegetables.', '2.00', 'food_2021_12_29-20-02-38.jpg', 23, 'Yes', 'Yes'),
(27, 'Veg Momos', 'Made with Italian Sauce, Chicken, and organice vegetables.', '2.00', 'food_2021_12_29-20-03-08.jpg', 24, 'Yes', 'Yes'),
(28, 'BBQ Somkey PIZZA', 'Made with Italian Sauce, Chicken, and organice vegetables.', '5.00', 'food_2021_12_29-20-50-46.jpg', 23, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `custmor_name` varchar(100) NOT NULL,
  `custmor_contact` varchar(100) NOT NULL,
  `custmor_email` varchar(100) NOT NULL,
  `custmor_address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `custmor_name`, `custmor_contact`, `custmor_email`, `custmor_address`) VALUES
(2, 'Cheez Pizza', '2.00', 1, '2', '2021-12-31 12:54:32', 'Delivered', 'Pawan', '07251 822981', 'bishtp143@gmail.com', 'Gathgar,Dwarahat'),
(6, 'Chicken Burger', '2.00', 1, '4.00', '2021-12-31 21:07:19', 'On Delivery', 'xxxxxxxyyyzzz', '134234234', 'wfcwefcwefc@gmail.com', 'abcd efgh ijkl mnop'),
(7, 'Veg Momos', '2.00', 1, '2.00', '2021-12-31 21:21:09', 'Canceled', '92lnt3k9t2', '2570932278', 'sr5hc@fhup.com', 'qN9d5dwslP'),
(8, 'BBQ Somkey PIZZA', '5.00', 5, '25.00', '2021-12-31 21:35:59', 'Delivered', 'pf5l6zYqob', '9238966302', '2fm86@rczm.com', 'sYrWFqpRw9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
