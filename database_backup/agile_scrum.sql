-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2014 at 11:26 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agile_scrum`
--
CREATE DATABASE IF NOT EXISTS `agile_scrum` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `agile_scrum`;

-- --------------------------------------------------------

--
-- Table structure for table `attendace.sheet`
--

CREATE TABLE IF NOT EXISTS `attendace.sheet` (
  `student.number` varchar(111) NOT NULL,
  `employee.number` varchar(111) NOT NULL,
  `date.absent` varchar(111) NOT NULL,
  `subject` varchar(111) NOT NULL,
  `school.year` varchar(111) NOT NULL,
  `semester` varchar(111) NOT NULL,
  `month` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course.code` varchar(10) NOT NULL,
  `course.description` varchar(50) NOT NULL,
  PRIMARY KEY (`course.code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faculty.information.tbl`
--

CREATE TABLE IF NOT EXISTS `faculty.information.tbl` (
  `employee.number` varchar(9) NOT NULL,
  `faculty.firstname` varchar(22) NOT NULL,
  `faculty.lastname` varchar(22) NOT NULL,
  `faculty.middlename` varchar(22) NOT NULL,
  `date.of.birth` varchar(22) NOT NULL,
  `place.of.birth` varchar(100) NOT NULL,
  `sex` varchar(22) NOT NULL,
  `civil.status` varchar(22) NOT NULL,
  `citizenship` varchar(22) NOT NULL,
  `height` int(22) NOT NULL,
  `address` varchar(100) NOT NULL,
  `weight` int(22) NOT NULL,
  `zip.code` int(11) NOT NULL,
  `email` varchar(111) NOT NULL,
  `contact.num` varchar(11) NOT NULL,
  `educational.background` text NOT NULL,
  PRIMARY KEY (`employee.number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty.information.tbl`
--

INSERT INTO `faculty.information.tbl` (`employee.number`, `faculty.firstname`, `faculty.lastname`, `faculty.middlename`, `date.of.birth`, `place.of.birth`, `sex`, `civil.status`, `citizenship`, `height`, `address`, `weight`, `zip.code`, `email`, `contact.num`, `educational.background`) VALUES
('11-00415', 'Deliora', 'Camias', 'Libero', '12-14-15', 'San Pablo City', 'Female', 'Widow', 'Filipino', 45, 'San Pablo City', 56, 4000, 'camias_deliora@yahoo.com', '09199291233', 'Basta nakagraduate');

-- --------------------------------------------------------

--
-- Table structure for table `rating_sheet`
--

CREATE TABLE IF NOT EXISTS `rating_sheet` (
  `subject.code` varchar(10) NOT NULL,
  `student.number` varchar(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `employee.number` varchar(111) NOT NULL COMMENT 'faculty ID',
  `time.schedule` varchar(111) NOT NULL,
  `unit` varchar(111) NOT NULL,
  `semester` varchar(111) NOT NULL,
  `school.year` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_sheet`
--

INSERT INTO `rating_sheet` (`subject.code`, `student.number`, `grade`, `employee.number`, `time.schedule`, `unit`, `semester`, `school.year`) VALUES
('ITEP411', '01-1234', '3.00', '', '', '', '', ''),
('P.E.', '01-1234', '1.00', '', '', '', '', ''),
('MOR', '01-1234', '4.00', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `school.year`
--

CREATE TABLE IF NOT EXISTS `school.year` (
  `school.year` varchar(50) NOT NULL,
  PRIMARY KEY (`school.year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student.information.tbl`
--

CREATE TABLE IF NOT EXISTS `student.information.tbl` (
  `student.number` varchar(9) NOT NULL,
  `student.firstname` varchar(20) NOT NULL,
  `student.lastname` varchar(20) NOT NULL,
  `student.middlename` varchar(20) NOT NULL,
  `date.of.birth` varchar(10) NOT NULL,
  `place.of.birth` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `civil.status` varchar(10) NOT NULL,
  `citizenship` varchar(100) NOT NULL,
  `height` int(11) NOT NULL,
  `address` text NOT NULL,
  `zip.code` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `guardian` varchar(111) NOT NULL,
  `guardian.contact.number` int(11) NOT NULL,
  `student.contact.number` int(10) NOT NULL,
  `weight` int(22) NOT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'http://localhost/AGILE_SCRUM/img/account/default.jpg',
  PRIMARY KEY (`student.number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student.information.tbl`
--

INSERT INTO `student.information.tbl` (`student.number`, `student.firstname`, `student.lastname`, `student.middlename`, `date.of.birth`, `place.of.birth`, `sex`, `civil.status`, `citizenship`, `height`, `address`, `zip.code`, `email`, `guardian`, `guardian.contact.number`, `student.contact.number`, `weight`, `picture`) VALUES
('11-00416', 'Sercondo', 'Protacio', 'Liemo', '12-13-04', 'San Pablo city', 'Male', 'Single', 'Filipino', 56, 'San Pablo City, Laguna', 4000, 'klimpong@gmail.com', 'Wertilio Decara', 929919291, 919929123, 58, 'http://localhost/AGILE_SCRUM/img/account/default.jpg'),
('12-12345', 'Reversio', 'Mercado', 'Lemio', '12-13-14', 'San Pablo City, Laguna', 'Male', 'Single', 'Filipino', 56, 'San Pablo City, Laguna', 4000, 'klampong@gmail.com', 'Orlando Dumdum', 2147483647, 2147483647, 56, 'http://localhost/AGILE_SCRUM/img/account/default.jpg'),
('12-34567', 'Restituto', 'Panganiban', 'Mercado', '12-13-14', 'San Pablo', 'Male', 'Single', 'Filipino', 45, 'San Pablo City', 4000, 'aaa@yahoo.com', 'asdasd', 919929123, 919991, 45, 'http://localhost/AGILE_SCRUM/img/account/default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject.code` varchar(10) NOT NULL,
  `subject.description` varchar(50) NOT NULL,
  PRIMARY KEY (`subject.code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject.code`, `subject.description`) VALUES
('ITEC206', 'ComputerOrganization'),
('ITEP411', 'DatabseManagementSystem'),
('MOR', 'Method of Research'),
('P.E.', 'PE');

-- --------------------------------------------------------

--
-- Table structure for table `users.information.tbl`
--

CREATE TABLE IF NOT EXISTS `users.information.tbl` (
  `user.number` varchar(9) NOT NULL,
  `user.name` varchar(255) NOT NULL,
  `user.password` varchar(255) NOT NULL,
  `user.type` varchar(255) NOT NULL,
  `user.status` varchar(255) NOT NULL DEFAULT 'NOT ACTIVATED',
  `user.account` varchar(20) NOT NULL DEFAULT 'OFFLINE',
  `user.date.reg` date NOT NULL,
  `user.date.exp` date NOT NULL,
  PRIMARY KEY (`user.name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users.information.tbl`
--

INSERT INTO `users.information.tbl` (`user.number`, `user.name`, `user.password`, `user.type`, `user.status`, `user.account`, `user.date.reg`, `user.date.exp`) VALUES
('12-34567', '6d5b6975610a2fea6c12ee977b189c37', 'f8e50b1533f6337344dcb76bb6ae81d2', 'Student', 'ACTIVATED', 'OFFLINE', '2014-07-09', '2014-10-09'),
('11-00415', 'd38626c0c69034c384f5ed5700969cab', 'd38626c0c69034c384f5ed5700969cab', 'Faculty', 'ACTIVATED', 'ONLINE', '2014-07-09', '2014-10-09'),
('11-00416', 'e4261a4c015dd94505cc21b2e0e93616', 'e4261a4c015dd94505cc21b2e0e93616', 'Student', 'NOT ACTIVATED', 'OFFLINE', '2014-07-09', '0000-00-00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
