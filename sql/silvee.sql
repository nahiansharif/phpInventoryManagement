-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 02:00 PM
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
-- Database: `silvee`
--

-- --------------------------------------------------------

--
-- Table structure for table `plane`
--

CREATE TABLE `plane` (
  `NameID` varchar(255) NOT NULL,
  `fuel` int(11) DEFAULT NULL,
  `tire1` enum('Good','Medicore','Bad') DEFAULT NULL,
  `motor` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire2` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire3` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire4` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire5` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire6` enum('Good','Medicore','Bad') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plane`
--

INSERT INTO `plane` (`NameID`, `fuel`, `tire1`, `motor`, `tire2`, `tire3`, `tire4`, `tire5`, `tire6`) VALUES
('A123', 8000, 'Bad', 'Bad', 'Good', 'Bad', 'Bad', 'Bad', 'Bad'),
('A302', 60000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good'),
('A456', 70000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good'),
('A789', 25000, 'Medicore', 'Good', 'Bad', 'Good', 'Good', 'Good', 'Good'),
('A901', 68000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good'),
('B012', 7000, 'Good', 'Bad', 'Bad', 'Bad', 'Bad', 'Bad', 'Bad'),
('B234', 5000, 'Bad', 'Medicore', 'Bad', 'Bad', 'Bad', 'Bad', 'Bad'),
('B456', 40000, 'Good', 'Medicore', 'Good', 'Good', 'Good', 'Good', 'Good'),
('B518', 70000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good'),
('B789', 55000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good'),
('C345', 32000, 'Medicore', 'Good', 'Good', 'Good', 'Good', 'Medicore', 'Good'),
('C567', 30000, 'Good', 'Good', 'Medicore', 'Good', 'Good', 'Good', 'Good'),
('C678', 20000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Bad', 'Bad'),
('C890', 65000, 'Good', 'Good', 'Good', 'Good', 'Good', 'Good', 'Good'),
('C924', 10000, 'Bad', 'Bad', 'Bad', 'Bad', 'Bad', 'Bad', 'Bad');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(11) NOT NULL,
  `managerUserID` int(11) DEFAULT NULL,
  `plane` int(11) DEFAULT NULL,
  `fuel` int(11) DEFAULT NULL,
  `tire` int(11) DEFAULT NULL,
  `motor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `managerUserID`, `plane`, `fuel`, `tire`, `motor`) VALUES
(29, 27, 8, 1000, 5, 2),
(30, 45, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `storehouse`
--

CREATE TABLE `storehouse` (
  `plane` int(11) DEFAULT NULL,
  `fuel` int(11) DEFAULT NULL,
  `tire` int(11) DEFAULT NULL,
  `motor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `storehouse`
--

INSERT INTO `storehouse` (`plane`, `fuel`, `tire`, `motor`) VALUES
(67, 806600, 247, 88);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TaskID` int(11) NOT NULL,
  `TargetPlane` varchar(255) DEFAULT NULL,
  `Fuel` int(11) DEFAULT NULL,
  `tire1` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire2` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire3` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire4` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire5` enum('Good','Medicore','Bad') DEFAULT NULL,
  `tire6` enum('Good','Medicore','Bad') DEFAULT NULL,
  `motor` enum('Good','Medicore','Bad') DEFAULT NULL,
  `taskStatus` enum('on hold','approved','Completed','rejected') DEFAULT NULL,
  `comments` varchar(255) NOT NULL,
  `reporter` varchar(255) NOT NULL,
  `neededWorkers` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TaskID`, `TargetPlane`, `Fuel`, `tire1`, `tire2`, `tire3`, `tire4`, `tire5`, `tire6`, `motor`, `taskStatus`, `comments`, `reporter`, `neededWorkers`) VALUES
(1, 'B012', 4011, 'Good', 'Medicore', 'Good', 'Bad', 'Good', 'Good', 'Good', 'Completed', 'dsfdsfsddf', '40', 2),
(7, 'B518', 50000, 'Medicore', 'Medicore', 'Medicore', 'Good', 'Medicore', 'Medicore', 'Medicore', 'Completed', 'Amnira', '35', 4),
(8, 'B456', 10000, 'Good', 'Medicore', 'Medicore', 'Good', 'Good', 'Good', 'Bad', 'rejected', 'Halal', '40', 2),
(9, 'C924', 35000, 'Medicore', 'Medicore', 'Medicore', 'Medicore', 'Medicore', 'Medicore', 'Good', 'rejected', 'Engine is good, but all tire needs replacement. ', '40', 4),
(10, 'A456', 35000, 'Medicore', 'Bad', 'Bad', 'Medicore', 'Good', 'Medicore', 'Bad', 'on hold', 'Tires and engine needs some work', '40', 4),
(11, 'C678', 50000, 'Medicore', 'Good', 'Good', 'Good', 'Good', 'Good', 'Medicore', 'rejected', 'Lets get this done bois', '40', 2),
(12, 'C678', 20000, 'Good', 'Good', 'Good', 'Good', 'Bad', 'Bad', 'Good', 'Completed', '2 Tire needs some work', '45', 2),
(13, 'B518', 25000, 'Good', 'Good', 'Bad', 'Bad', 'Good', 'Bad', 'Bad', 'Completed', 'I am proud of this result.', '39', 4);

-- --------------------------------------------------------

--
-- Table structure for table `taskstaff`
--

CREATE TABLE `taskstaff` (
  `id` int(11) NOT NULL,
  `TaskID` int(11) NOT NULL,
  `staffUserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taskstaff`
--

INSERT INTO `taskstaff` (`id`, `TaskID`, `staffUserID`) VALUES
(1, 7, 45),
(2, 7, 44),
(3, 7, 43),
(4, 7, 42),
(6, 12, 37),
(7, 12, 39),
(8, 13, 32),
(9, 13, 38),
(10, 13, 36),
(11, 13, 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role` enum('admin','manager','staff') NOT NULL,
  `status` enum('available','busy') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `password`, `firstname`, `lastname`, `role`, `status`) VALUES
(23, 'P@sswOrd!23', 'Anya', 'Volkov', 'admin', 'available'),
(24, 'asd', 'Jax', 'Rider', 'admin', 'available'),
(25, 'Man@ger_42', 'Zara', 'Knight', 'manager', 'available'),
(26, 'Str0ngP@ss', 'Finn', 'Sterling', 'manager', 'available'),
(27, 'loli', 'Luna', 'Vance', 'manager', 'available'),
(28, 'M@nag3R_77', 'Kai', 'Frost', 'manager', 'available'),
(29, 'P@$$wOrd99', 'Nova', 'Reed', 'manager', 'available'),
(30, 'St@ff_1', 'Rory', 'Shaw', 'staff', 'available'),
(31, 'P@$$WOrd2', 'Sage', 'Ward', 'staff', 'available'),
(32, 'Secur3_Pass', 'Leo', 'West', 'staff', 'busy'),
(33, 'PassWOrd_4', 'Ivy', 'Lane', 'staff', 'available'),
(34, 'Str0ng_5', 'Milo', 'Bell', 'staff', 'available'),
(35, 'C0mpl3x6', 'Hazel', 'Page', 'staff', 'busy'),
(36, 'P@ss7WOrd', 'Owen', 'Cole', 'staff', 'busy'),
(37, 'S3cur3P@ss', 'Willow', 'Hill', 'staff', 'busy'),
(38, 'P@$$wOrd9', 'Asher', 'King', 'staff', 'busy'),
(39, 'Str0ng10', 'Scarlett', 'Dale', 'staff', 'busy'),
(40, 'qwe', 'Jasper', 'Rose', 'staff', 'available'),
(41, 'P@$$WOrd12', 'Violet', 'Lake', 'staff', 'available'),
(42, 'S3cur3P@ss13', 'Silas', 'River', 'staff', 'busy'),
(43, 'P@$$wOrd14', 'Coral', 'Stone', 'staff', 'busy'),
(44, 'Str0ng15', 'Zephyr', 'Meadow', 'staff', 'busy'),
(45, 'asli123', 'kob', 'alis', 'staff', 'busy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`NameID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `managerUserID` (`managerUserID`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskID`);

--
-- Indexes for table `taskstaff`
--
ALTER TABLE `taskstaff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TaskID` (`TaskID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `taskstaff`
--
ALTER TABLE `taskstaff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`managerUserID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `taskstaff`
--
ALTER TABLE `taskstaff`
  ADD CONSTRAINT `taskstaff_ibfk_1` FOREIGN KEY (`TaskID`) REFERENCES `task` (`TaskID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
