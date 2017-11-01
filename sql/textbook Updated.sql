-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2017 at 04:36 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE PROCEDURE `addBook` (IN `sname` VARCHAR(20), IN `slname` VARCHAR(40), IN `scampus` INT, IN `semail` VARCHAR(40), IN `sprefcontact` INT, IN `scontactinfo` VARCHAR(20), IN `susername` VARCHAR(20), IN `spassword` VARCHAR(20), IN `isbn` VARCHAR(13), IN `title` VARCHAR(200), IN `author` VARCHAR(40), IN `edition` INT, IN `notes` VARCHAR(255), IN `url` VARCHAR(20))  BEGIN
DECLARE sellerID int;
	start TRANSACTION;
    	INSERT INTO `seller`(`firstName`, `lastName`, `campus`, `userType`, `email`, `prefContact`, `contactInfo`, `userName`, `password`) 
    VALUES (sfname,slname,scampus,susertype,semail,sprefcontact,scontactinfo,susername,spassword);
    
    set sellerID = (select sellerID from `seller` where `email` = semail);
    
    INSERT INTO `book`(`ISBN`, `Title`, `Author`, `Edition`, `Notes`, `imageurl`) VALUES (isbn,title,author,edition,notes,url);
    
    INSERT INTO `seller_book`(`SellerID`, `BookISBN`) VALUES (sellerID,isbn);
    
    COMMIT;
 
END$$

CREATE  PROCEDURE `sp_test` ()  BEGIN
  SELECT 'Number of records: ', count(*) from book;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `bookID` int(11) NOT NULL,
  `sellerID` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Author` varchar(40) NOT NULL,
  `Edition` int(11) NOT NULL,
  `Notes` varchar(255) NOT NULL,
  `imageurl` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`bookID`, `sellerID`, `ISBN`, `Title`, `Author`, `Edition`, `Notes`, `imageurl`) VALUES
(4, 27, '1212121212', 'bio', 'me', 8, 'clean book, little wear, bought used', './images/books/121212121220170926075247.jpg'),
(5, 27, '1212121213', 'math', 'me again', 5, 'bought new, used one semester. Great Condition!', './images/books/121212121320170926075329.jpg'),
(6, 27, '1212121214', 'history', 'you', 8, 'very old, pages work, giving it away for free', './images/books/121212121420170926075416.jpg'),
(7, 27, '1212121215', 'algorithms', 'smarty', 0, 'NEW!!!', './images/books/121212121520170926075744.jpeg'),
(8, 27, '1212121216', 'art', 'c#', 1, 'this is THE handbook. It\'s not that heavy :)', './images/books/121212121620170926075836.jpg'),
(9, 27, '1212121217', 'clean code', 'coder', 0, 'good stuff for agile', './images/books/121212121720170926075919.jpg'),
(10, 27, '1212121218', 'another bio', 'amoeba', 2, 'it\'s old, but still wonderful!', './images/books/121212121820170926075958.jpg'),
(11, 28, '2589856895', 'mynewbook', 'me', 1, 'old', './images/books/258985689520171025022449.jpg'),
(12, 30, '2589568947', 'jkl', 'hkj', 0, '', './images/books/na.jpg'),
(13, 32, '2589856895878', 'hghfgh', 'hgh', 29, '', './images/books/na.jpg'),
(14, 32, '1111111111', 'gfdh', 'bhgh', 0, '', './images/books/na.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `CampusID` int(11) NOT NULL,
  `CampusName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`CampusID`, `CampusName`) VALUES
(2, 'LAS-Men'),
(1, 'LAS-Women');

-- --------------------------------------------------------

--
-- Table structure for table `contactmethods`
--

CREATE TABLE `contactmethods` (
  `ContactID` int(11) NOT NULL,
  `methodDesc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactmethods`
--

INSERT INTO `contactmethods` (`ContactID`, `methodDesc`) VALUES
(1, 'Email'),
(2, 'Phone');

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
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`userID`, `firstName`, `lastName`, `campus`, `userType`, `email`, `prefContact`, `contactInfo`, `userName`, `password`) VALUES
(25, 'ds', 'gerg', 2, 1, 'b@k.com', 1, 'b@k.com', 'fry', '$2y$10$YVgBq83VrdIhG'),
(26, 'ds', 'bhyn', 2, 1, 'b@y.com', 2, '2589633214', 'frt', '$2y$10$oq907EZsyk.vf'),
(27, 'Rivka', 'Schuster', 1, 1, 'collegers96@gmail.com', 2, '6464671045', 'rivka11', '$2y$10$HcF1mCDcBQp1g'),
(28, 'fds', 'bhyn', 1, 1, 'b@b.com', 1, 'b@b.com', 'tyu', '$2y$10$Q8nkBK34BUAaj'),
(29, 'jioj', 'hkj', 1, 1, 'vb@b.com', 1, 'b@b.com', 'bjb', '$2y$10$DDrbtrcPjtuLg'),
(30, 'ds', 'bhyn', 2, 1, 'b@u.com', 1, 'b@u.com', 'ds', '$2y$10$CDJH6HKpZfhMm'),
(31, 'ds', 'bhyn', 2, 1, 'fr@g.com', 1, 'fr@g.com', 'fr', '$2y$10$tbqUbIYmbWQw2'),
(32, 'Rivka', 'Schuster', 2, 1, 'me@me.com', 1, 'me@me.com', 'rivka11', '$2y$10$rmOwioqKA9j3lIQ35W30Oe8yoxYFx8Y.p.3jch4S6HVnaHc9mqjj6');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `TypeID` int(11) NOT NULL,
  `TypeDesc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`TypeID`, `TypeDesc`) VALUES
(1, 'Seller'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `fk_seller` (`sellerID`);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `campus` (`campus`),
  ADD KEY `userType` (`userType`),
  ADD KEY `prefContact` (`prefContact`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`TypeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `CampusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contactmethods`
--
ALTER TABLE `contactmethods`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_seller` FOREIGN KEY (`sellerID`) REFERENCES `seller` (`userID`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `fk_campus` FOREIGN KEY (`campus`) REFERENCES `campus` (`CampusID`),
  ADD CONSTRAINT `fk_pref_contact` FOREIGN KEY (`prefContact`) REFERENCES `contactmethods` (`ContactID`),
  ADD CONSTRAINT `fk_userType` FOREIGN KEY (`userType`) REFERENCES `usertype` (`TypeID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
