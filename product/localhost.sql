-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2020 at 02:33 PM
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
  `Expirelystatus` varchar(40) NOT NULL,
  `Comments` varchar(40) NOT NULL,
  `Fullname` varchar(40) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`LeaveID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `leaveapplications`
--

INSERT INTO `leaveapplications` (`LeaveID`, `Description`, `Startdate`, `Enddate`, `ApprovalStatus`, `Expirelystatus`, `Comments`, `Fullname`, `UserID`) VALUES
(7, 'carerâ€™s leave', '20-9-2020', '23-9-2020', 'accepted', 'inprogress', 'approved', 'SAM', 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Telphone`, `Email`, `Status`, `User_Type`, `Usernames`, `Passwords`, `LeaveBalance`) VALUES
(1, 'SUSAN', '+546565656', 'susan45@gmail.com', 'active', 'admin', 'admin', 'admin', 4),
(9, 'samuel', '+454656666', 'sam12@gmail.com', 'active', 'staff', 'sam', 'Samuel1234', 5),
(10, 'Titus', '+54565656565', 'Titus@gmail.com', 'active', 'manager', 'Titus', 'Titus12345', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  ADD CONSTRAINT `leaveapplications_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
