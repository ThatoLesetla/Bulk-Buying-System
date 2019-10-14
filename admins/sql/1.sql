-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2019 at 06:48 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ambs`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `adminID` varchar(9) NOT NULL,
  `IDNo` varchar(13) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cell` varchar(10) NOT NULL,
  `role` int(1) NOT NULL,
  `passW` varchar(1000) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`adminID`, `IDNo`, `sname`, `name`, `email`, `cell`, `role`, `passW`, `active`, `deleted`) VALUES
('123456789', '1234567890987', 'Admin', 'Admin Testing', 'test@testing.com', '0712345678', 1, 'ead1c6f4950d085f4b66f2d8de33050c', 1, 0),
('953857421', '1234567890321', 'ELSE', 'IF', '', '', 1, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingID` int(7) NOT NULL,
  `stdNo` varchar(9) NOT NULL,
  `time` varchar(5) NOT NULL,
  `book_date` varchar(10) NOT NULL,
  `bus` varchar(10) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `qr` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingID`, `stdNo`, `time`, `book_date`, `bus`, `from`, `to`, `qr`) VALUES
(6, '112233445', '21', '27-05-2019', 'DMK 445 GP', 'Jane Furse', 'Kasi Q', '9743652'),
(10, '123234345', '21', '27-05-2019', 'DMK 445 GP', 'Jane Furse', 'Kasi Q', '7002258'),
(11, '123234345', '20', '27-05-2019', 'PNK 675 GP', 'Kasi Q', 'Jane Furse', '8107299');

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `busID` int(7) NOT NULL,
  `regNo` varchar(25) NOT NULL,
  `occupance` varchar(5) NOT NULL,
  `onDuty` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`busID`, `regNo`, `occupance`, `onDuty`, `deleted`) VALUES
(1, 'DMK 445 GP', '65', 1, 0),
(2, 'PNK 675 GP', '70', 1, 0),
(3, 'JKL 223 GP', '70', 1, 0),
(4, 'BBF 45 L', '65', 0, 0),
(5, 'GP MOS L', '65', 0, 0),
(6, 'GP BEEF L', '6', 0, 0),
(7, 'KING L', '65', 0, 0),
(8, 'KING GP', '65', 0, 0),
(9, 'ME GP', '90', 0, 0),
(10, 'JANE L', '5', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driverID` varchar(9) NOT NULL,
  `IDNo` varchar(13) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cell` varchar(10) NOT NULL,
  `role` int(1) NOT NULL,
  `passW` varchar(1000) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverID`, `IDNo`, `sname`, `name`, `email`, `cell`, `role`, `passW`, `active`, `deleted`) VALUES
('245239257', '5507216716084', 'WHILE', 'PHP', '', '', 2, '', 0, 0),
('285430908', '5507216716089', 'LO', 'LO', 'lo@gmail.com', '0701020304', 2, 'ead1c6f4950d085f4b66f2d8de33050c', 1, 0),
('53955078', '5507216716084', 'WHILE', 'IF', '', '', 2, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `locID` int(7) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locID`, `location`) VALUES
(28, 'Kasi Q'),
(37, 'Res P'),
(59, 'Lolo'),
(60, 'Limpopo'),
(61, 'Jane Furse');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `noticeID` int(10) NOT NULL,
  `notice_to` varchar(2) NOT NULL,
  `notice` varchar(1000) NOT NULL,
  `time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`noticeID`, `notice_to`, `notice`, `time`) VALUES
(13, '3', 'try', '2019-05-27 22:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleID` int(7) NOT NULL,
  `time` varchar(6) NOT NULL,
  `schedule_date` varchar(10) NOT NULL,
  `bus` varchar(25) NOT NULL,
  `driver` varchar(50) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `occupance` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleID`, `time`, `schedule_date`, `bus`, `driver`, `from`, `to`, `occupance`) VALUES
(50, '20', '27-05-2019', 'PNK 675 GP', '637043492', 'Kasi Q', 'Jane Furse', '70'),
(51, '12', '27-05-2019', 'DMK 445 GP', '637043492', 'Limpopo', 'Lolo', '65'),
(52, '21', '27-05-2019', 'DMK 445 GP', '637043492', 'Jane Furse', 'Kasi Q', '65'),
(53, '21', '27-05-2019', 'PNK 675 GP', '985534667', 'Jane Furse', 'Kasi Q', '70');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(9) NOT NULL,
  `IDNo` varchar(13) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cell` varchar(10) NOT NULL,
  `role` int(1) NOT NULL,
  `passW` varchar(1000) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `IDNo`, `sname`, `name`, `email`, `cell`, `role`, `passW`, `active`, `deleted`) VALUES
('219362436', '9901025715084', 'FOR ', 'END', 'for@gmail.com', '0701020304', 3, 'ead1c6f4950d085f4b66f2d8de33050c', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`busID`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driverID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`locID`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`noticeID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `busID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `locID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `noticeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
