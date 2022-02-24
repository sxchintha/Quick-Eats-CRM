-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2022 at 11:47 AM
-- Server version: 8.0.24
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quickeats`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `SID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`SID`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `PhoneNumber` int NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Address` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ManagedBy` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_manage`
--

CREATE TABLE `customer_manage` (
  `ID` int NOT NULL,
  `SID` int DEFAULT NULL,
  `Customer` int DEFAULT NULL,
  `Task` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_person`
--

CREATE TABLE `sales_person` (
  `SID` int NOT NULL,
  `Address` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NIC` varchar(12) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `RegisteredBy` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_person_phone`
--

CREATE TABLE `sales_person_phone` (
  `SID` int NOT NULL,
  `PhoneNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `SID` int NOT NULL,
  `Username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `Name` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`SID`, `Username`, `Name`, `Password`) VALUES
(1, 'ucsc', 'Admin', 'ucsc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`SID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`PhoneNumber`);

--
-- Indexes for table `customer_manage`
--
ALTER TABLE `customer_manage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SID` (`SID`),
  ADD KEY `Customer` (`Customer`);

--
-- Indexes for table `sales_person`
--
ALTER TABLE `sales_person`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `NIC` (`NIC`),
  ADD KEY `RegisteredBy` (`RegisteredBy`);

--
-- Indexes for table `sales_person_phone`
--
ALTER TABLE `sales_person_phone`
  ADD PRIMARY KEY (`SID`,`PhoneNumber`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`SID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_manage`
--
ALTER TABLE `customer_manage`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `SID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `staff` (`SID`);

--
-- Constraints for table `customer_manage`
--
ALTER TABLE `customer_manage`
  ADD CONSTRAINT `customer_manage_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `staff` (`SID`),
  ADD CONSTRAINT `customer_manage_ibfk_2` FOREIGN KEY (`Customer`) REFERENCES `customer` (`PhoneNumber`);

--
-- Constraints for table `sales_person`
--
ALTER TABLE `sales_person`
  ADD CONSTRAINT `sales_person_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `staff` (`SID`),
  ADD CONSTRAINT `sales_person_ibfk_2` FOREIGN KEY (`RegisteredBy`) REFERENCES `admin` (`SID`);

--
-- Constraints for table `sales_person_phone`
--
ALTER TABLE `sales_person_phone`
  ADD CONSTRAINT `sales_person_phone_ibfk_1` FOREIGN KEY (`SID`) REFERENCES `sales_person` (`SID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
