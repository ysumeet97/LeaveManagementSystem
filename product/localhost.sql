-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2020 at 11:30 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leavedb`
--
CREATE DATABASE `leavedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `leavedb`;

-- --------------------------------------------------------

--
-- Table structure for table `leaveapplications`
--

CREATE TABLE IF NOT EXISTS `leaveapplications` (
  `LeaveID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) NOT NULL,
  `Startdate` varchar(40) NOT NULL,
  `Enddate` varchar(40) NOT NULL,
  `ApprovalStatus` varchar(40) NOT NULL,
  `Comments` varchar(40) NOT NULL,
  `Fullname` varchar(40) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`LeaveID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `leaveapplications`
--

INSERT INTO `leaveapplications` (`LeaveID`, `Description`, `Startdate`, `Enddate`, `ApprovalStatus`, `Comments`, `Fullname`, `UserID`) VALUES
(7, 'carerâ€™s leave', '2020-9-20', '2020-9-23', 'accepted', 'approved', 'SAM', 9),
(9, 'annual leave', '2020-09-21', '2020-09-26', 'pending', 'NONE', 'sam', 9),
(10, 'carerâ€™s leave', '2020-09-28', '2020-09-30', 'pending', 'approved', 'dennis', 11),
(12, 'carerâ€™s leave', '2020-09-29', '2020-09-30', 'PENDING', 'NONE', 'Erick', 13);

-- --------------------------------------------------------

--
-- Table structure for table `leavenotifications`
--

CREATE TABLE IF NOT EXISTS `leavenotifications` (
  `NoteID` int(11) NOT NULL AUTO_INCREMENT,
  `Dates` varchar(20) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`NoteID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `leavenotifications`
--

INSERT INTO `leavenotifications` (`NoteID`, `Dates`, `Message`, `UserID`) VALUES
(8, '2020-09-30', 'take annual leave', 11),
(9, '2020-09-30', 'apply annual leave', 13);

-- --------------------------------------------------------

--
-- Table structure for table `publicholidays`
--

CREATE TABLE IF NOT EXISTS `publicholidays` (
  `HolidayID` int(20) NOT NULL AUTO_INCREMENT,
  `HolidayName` varchar(50) NOT NULL,
  `Dates` varchar(20) NOT NULL,
  PRIMARY KEY (`HolidayID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `publicholidays`
--

INSERT INTO `publicholidays` (`HolidayID`, `HolidayName`, `Dates`) VALUES
(3, 'CHRISTMAS', '25-12-2020'),
(4, 'END YEAR', '2020-12-31'),
(5, 'New year', '2020-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) NOT NULL,
  `Telphone` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Status` varchar(40) NOT NULL,
  `User_Type` varchar(40) NOT NULL,
  `Usernames` varchar(40) NOT NULL,
  `Passwords` varchar(40) NOT NULL,
  `LeaveBalance` int(20) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Telphone`, `Email`, `Status`, `User_Type`, `Usernames`, `Passwords`, `LeaveBalance`) VALUES
(1, 'SUSAN', '+546565656', 'susan45@gmail.com', 'active', 'admin', 'admin', 'admin', 4),
(9, 'samuel', '+454656666', 'sam12@gmail.com', 'active', 'staff', 'sam', 'Samuel1234', 4),
(10, 'Titus', '+54565656565', 'Titus@gmail.com', 'active', 'manager', 'Titus', 'Titus12345', 2),
(11, 'dennis', '+5456566', 'den1@gmail.com', 'active', 'staff', 'dennis', 'Dennis12340', 1),
(12, 'Isaac', '+565655656', 'isa@gmail.com', 'active', 'manager', 'isaac', 'Isaac123456', 6),
(13, 'Erick', '+546565654', 'er1@gmail.com', 'active', 'staff', 'Erick', 'Erick12345', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  ADD CONSTRAINT `leaveapplications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `leavenotifications`
--
ALTER TABLE `leavenotifications`
  ADD CONSTRAINT `leavenotifications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
