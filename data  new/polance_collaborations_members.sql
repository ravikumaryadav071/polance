-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2015 at 01:12 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polance_collaborations_members`
--

-- --------------------------------------------------------

--
-- Table structure for table `mycol_members`
--

CREATE TABLE IF NOT EXISTS `mycol_members` (
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `member_type` varchar(15) NOT NULL DEFAULT 'MEMBER'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mycol_members`
--

INSERT INTO `mycol_members` (`userid`, `name_init`, `member_type`) VALUES
(1, 'r', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `mycol_requests`
--

CREATE TABLE IF NOT EXISTS `mycol_requests` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mycol_members`
--
ALTER TABLE `mycol_members`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `mycol_requests`
--
ALTER TABLE `mycol_requests`
  ADD PRIMARY KEY (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
