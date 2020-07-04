-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 04:03 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID` int(6) NOT NULL,
  `productID` varchar(20) NOT NULL,
  `pQuantity` int(4) NOT NULL,
  `dateAdd` date NOT NULL,
  `paidMethod` varchar(20) NOT NULL,
  `orderID` varchar(20) NOT NULL,
  `userID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID`, `productID`, `pQuantity`, `dateAdd`, `paidMethod`, `orderID`, `userID`) VALUES
(4, 'H1002', 1, '2018-09-19', '', '', 'user'),
(5, 'A1002', 1, '2019-05-30', '', '', 'user'),
(6, 'A1001', 1, '2019-11-11', '', '', 'abc'),
(7, 'A1001', 1, '2019-11-11', '', '', 'abc'),
(8, 'A1001', 1, '2019-11-12', '', '', ''),
(9, 'A1001', 1, '2019-11-12', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `ID` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(3) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `available` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`ID`, `title`, `price`, `image`, `quantity`, `category`, `description`, `available`) VALUES
('A1001', 'ASUS Zenfone Max Pro (M1) ', 625.00, 'A1001.jpg', 6, 'Asus', 'Triple SIM slot: Dual SIM & one MicroSD card (up to 2TB)\r\n4K Ultra HD video recording at 30fps', '1'),
('A1002', 'Asus Zenfone 3s Max ZC521TL, ', 399.00, 'A1002.jpg', 4, 'Asus', '2 year warranty', '1'),
('A333', 'Asus 333', 1200.00, 'A333.jpg', 9, 'Asus', 'New Asus Phone', '1'),
('H1001', 'HUawei 2I', 2099.00, 'H1001.jpg', 3, 'Huawei', 'Dual Lens', '1'),
('H1002', 'Huawei Mate 10 Pro', 2200.00, 'H1002.jpg', 4, 'Huawei', '128G Rom + 6G RAM', '1'),
('O1001', 'OPPO A37', 439.00, 'O1001.jpg', 5, 'Oppo', '16GB Rom+ Original Set', '1'),
('P1001', 'Samsung Galaxy S8', 1999.00, 'P1001.jpg', 5, 'Samsung', 'Camera 20MP', '1'),
('S1001', 'Samsung A6 A600', 769.00, 'S1001.jpg', 3, 'Samsung', '3GB+32GB ROM\r\nOriginal Malaysia Set', '1'),
('S1002', 'SAMSUNG GALAXY J6', 665.00, 'S1002.jpg', 3, 'Samsung', 'Original Warranty', '1'),
('X1001', 'Redmi 5', 500.00, 'X1001.jpg', 5, 'Xiaomi', 'Android 7.1.2 (Nougat)\r\n5.7 inches, IPS LCD capacitive touchscreen, 16M colors', '1'),
('X1002', 'XiaoMi Pocophone', 1499.00, 'X1002.jpg', 3, 'Xiaomi', '64GB ROM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ID` varchar(10) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` double(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`ID`, `Name`, `Description`, `Price`) VALUES
('A540', 'wdfghj', '12345', 99.99);

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(10) NOT NULL,
  `todo` varchar(225) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `ordered_id` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_id` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `todo`, `completed`, `ordered_id`, `updated_id`) VALUES
(3, 'tttt', 0, '2019-07-04 16:00:00', '2019-07-05 16:00:00'),
(4, 'yyyy', 0, '2019-07-12 16:00:00', '2019-07-13 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fullName` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`username`, `password`, `fullName`, `address`, `category`, `email`) VALUES
('abc', 'sss', 'abcd', '12345', 'student', 'chao@gmail.com'),
('B180175B', '99', 'klavin', '456,jalan bunga,taman utama\r\n', 'Non-Student', 'chao1004@gmail.com'),
('D180300B', '88', 'jia', '234,JALAN BUNGA KEMBOJA\r\n', 'student', 'jia100@gmail.com'),
('def', 'www', 'defg', '876', 'student', 'nima@gmai.com'),
('l', '0', 'lo', '123sa', '', 'lo12@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
