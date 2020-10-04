-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2019 at 11:12 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cell` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin`, `surname`, `name`, `cell`, `email`, `password`) VALUES
(1, 'Selekedi', 'Jabu', '0769743592', 'selekedi@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_order`
--

CREATE TABLE `bulk_order` (
  `id` int(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderDate` varchar(205) DEFAULT NULL,
  `dateShipped` varchar(20) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `paymentType` varchar(30) DEFAULT NULL,
  `orderFilled` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulk_order`
--

INSERT INTO `bulk_order` (`id`, `customerId`, `orderDate`, `dateShipped`, `total`, `paymentType`, `orderFilled`) VALUES
(312, 3, 'Wed Oct 30 2019 20:37:46 GMT+0200 (South Africa Standard Time)', NULL, 2000, 'EFT', 0),
(313, 3, 'Wed Oct 30 2019 20:38:34 GMT+0200 (South Africa Standard Time)', NULL, 2200, 'EFT', 0),
(314, 3, 'Wed Oct 30 2019 20:39:44 GMT+0200 (South Africa Standard Time)', NULL, 1200, 'EFT', 0),
(315, 3, 'Wed Oct 30 2019 20:42:47 GMT+0200 (South Africa Standard Time)', NULL, 1800, 'EFT', 0),
(316, 3, 'Wed Oct 30 2019 20:44:07 GMT+0200 (South Africa Standard Time)', NULL, 1200, 'EFT', 0),
(317, 3, 'Wed Oct 30 2019 20:47:41 GMT+0200 (South Africa Standard Time)', NULL, 10000, 'EFT', 0),
(318, 3, 'Wed Oct 30 2019 21:05:19 GMT+0200 (South Africa Standard Time)', NULL, 10200, 'EFT', 0),
(319, 3, 'Wed Oct 30 2019 21:14:11 GMT+0200 (South Africa Standard Time)', NULL, 10400, 'EFT', 0),
(320, 3, 'Wed Oct 30 2019 21:16:46 GMT+0200 (South Africa Standard Time)', NULL, 200, 'EFT', 0),
(321, 3, 'Wed Oct 30 2019 21:18:22 GMT+0200 (South Africa Standard Time)', NULL, 6000, 'EFT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(2, 'audio'),
(3, 'tv'),
(4, 'kitchen'),
(5, 'computer');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `name`, `surname`, `city`, `phone`, `email`, `password`, `img`) VALUES
(2, 'MOSES', '', 'PLK', '0658119127', 'mahlo@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', ''),
(3, 'MAHLOMOLA', 'MOTHOGOANE', 'PLK', '0769743592', 'mahlomolamoses@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', ''),
(4, 'MOSES', 'MOTHOGOANE', 'JHB', '0869743592', 'me@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', ''),
(5, 'THATO', 'LESETLA', 'PRETORIA', '0659113403', 'tlesetla6198@gmail.com', '1bdf4bd8766a1e5477d73ce421d54084', ''),
(6, 'THUTO', 'NKOSI', 'PRETORIA', '0814118974', 'thuto@gmail.com', 'b80d7d8a4c55ef371d49a2236ac02f6d', ''),
(7, 'SUPER', 'CARTER', 'PETERSBURG', '0818588294', 'super.carter@email.com', 'ce945f2b981856e1091cb83d6420c737', ''),
(8, 'TONY', 'STARK', 'CALIFORNIA', '0765714450', 'tony.stark@hotmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', ''),
(9, 'DWAYNE', 'CARTER', 'LOISIANA', '0796262254', 'dwayne@yahoo.com', 'ead1c6f4950d085f4b66f2d8de33050c', ''),
(10, 'LERATO', 'BLOS', 'PRETORIA', '0817783985', 'rachellblos@gmail.com', '91a139677b904cd65d017372403ff65d', '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `vendorID` int(11) NOT NULL,
  `stockAmount` int(11) DEFAULT NULL,
  `reorderPoint` int(11) DEFAULT NULL,
  `discount` decimal(10,0) NOT NULL,
  `bulkCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryID`, `productID`, `vendorID`, `stockAmount`, `reorderPoint`, `discount`, `bulkCount`) VALUES
(25, 25, 15, 100, 20, '10', 30);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `orderFilled` tinyint(1) NOT NULL,
  `discountPrice` float NOT NULL,
  `vendoroderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `orderId`, `productId`, `quantity`, `orderFilled`, `discountPrice`, `vendoroderId`) VALUES
(166, 312, 25, 10, 1, 180, 18),
(167, 313, 25, 11, 1, 180, 18),
(169, 315, 25, 9, 1, 180, 18),
(170, 316, 25, 6, 1, 180, 18),
(171, 317, 25, 50, 1, 180, 18),
(172, 318, 25, 51, 1, 180, 18),
(173, 319, 25, 52, 1, 180, 19),
(174, 320, 25, 1, 1, 180, 20),
(175, 321, 25, 30, 1, 180, 20);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(25) NOT NULL,
  `productDescription` varchar(35) NOT NULL,
  `productPrice` float(8,2) NOT NULL,
  `proimg` varchar(100) NOT NULL,
  `updated` varchar(50) NOT NULL,
  `categoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productPrice`, `proimg`, `updated`, `categoryID`) VALUES
(25, 'EGGS', 'large', 200.00, 'SHOPIES25.jpg', '2019/10/30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `img` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorID`, `name`, `address`, `city`, `phone`, `email`, `password`, `img`, `date`) VALUES
(10, 'MAMAGADI', '140 coifrri', 'PTRTORIA', '0768119237', 'mahlo@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', '10.png', '1-10-2019'),
(12, 'KABELO', '80', 'PLK', '0658932145', 'kabelo@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', '', '12-8-2019'),
(13, 'PIE', '70 ', 'PLK', '0769743591', 'king@gmail.com', 'ead1c6f4950d085f4b66f2d8de33050c', 'KING13.png', '12-7-2019'),
(14, 'SAVE MORE', '321 Steve Biko Road, Capital P', 'PRETORIA', '0659724837', 'info@savemore.com', 'ead1c6f4950d085f4b66f2d8de33050c', 'SAVEMORE14.jpg', '16-Oct-2019'),
(15, 'SHOPIES', '123 pretorias', 'PTA', '0212565486', 'shopie@mail.com', 'ead1c6f4950d085f4b66f2d8de33050c', 'SHOPIES15.jpg', '30-Oct-2019');

-- --------------------------------------------------------

--
-- Table structure for table `vendororder`
--

CREATE TABLE `vendororder` (
  `id` int(11) NOT NULL,
  `dateOrder` varchar(100) DEFAULT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendororder`
--

INSERT INTO `vendororder` (`id`, `dateOrder`, `productID`, `quantity`) VALUES
(16, '2019-05-06', 25, 36),
(17, '2019-05-06', 25, 50),
(18, '2019-10-30 21:05:21', 25, 51),
(19, '2019-10-30 21:14:13', 25, 52),
(20, '2019-10-30 21:18:24', 25, 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin`);

--
-- Indexes for table `bulk_order`
--
ALTER TABLE `bulk_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `vendorID` (`vendorID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorID`);

--
-- Indexes for table `vendororder`
--
ALTER TABLE `vendororder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bulk_order`
--
ALTER TABLE `bulk_order`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendororder`
--
ALTER TABLE `vendororder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bulk_order`
--
ALTER TABLE `bulk_order`
  ADD CONSTRAINT `bulk_order_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerID`);

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`vendorID`) REFERENCES `vendor` (`vendorID`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `bulk_order` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
