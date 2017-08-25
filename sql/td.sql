-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2017 at 06:02 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textbook`
--
CREATE DATABASE IF NOT EXISTS `textbook` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `textbook`;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `ISBN` varchar(13) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Author` varchar(40) NOT NULL,
  `Edition` int(11) NOT NULL,
  `Notes` varchar(100) NOT NULL,
  `imageurl` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `CampusID` int(11) NOT NULL,
  `CampusName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactmethods`
--

CREATE TABLE `contactmethods` (
  `ContactID` int(11) NOT NULL,
  `methodDesc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `campus` int(11) NOT NULL,
  `userType` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `prefContact` int(11) NOT NULL,
  `contactInfo` varchar(40) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller_book`
--

CREATE TABLE `seller_book` (
  `SellerID` int(11) NOT NULL,
  `BookISBN` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `TypeID` int(11) NOT NULL,
  `TypeDesc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`CampusID`),
  ADD UNIQUE KEY `CampusName` (`CampusName`);

--
-- Indexes for table `contactmethods`
--
ALTER TABLE `contactmethods`
  ADD PRIMARY KEY (`ContactID`),
  ADD UNIQUE KEY `methodDesc` (`methodDesc`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `campus` (`campus`),
  ADD KEY `userType` (`userType`),
  ADD KEY `prefContact` (`prefContact`);

--
-- Indexes for table `seller_book`
--
ALTER TABLE `seller_book`
  ADD PRIMARY KEY (`SellerID`,`BookISBN`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `BookISBN` (`BookISBN`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `CampusID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contactmethods`
--
ALTER TABLE `contactmethods`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `fk_campus` FOREIGN KEY (`campus`) REFERENCES `campus` (`CampusID`),
  ADD CONSTRAINT `fk_pref_contact` FOREIGN KEY (`prefContact`) REFERENCES `contactmethods` (`ContactID`),
  ADD CONSTRAINT `fk_userType` FOREIGN KEY (`userType`) REFERENCES `usertype` (`TypeID`);

--
-- Constraints for table `seller_book`
--
ALTER TABLE `seller_book`
  ADD CONSTRAINT `fk_book` FOREIGN KEY (`BookISBN`) REFERENCES `book` (`ISBN`),
  ADD CONSTRAINT `fk_seller` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
