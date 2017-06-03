-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2015 at 01:14 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polance_users_notifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_notifications`
--

CREATE TABLE IF NOT EXISTS `anil_notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ntf_type` varchar(30) NOT NULL,
  `ntf_text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_notifications`
--

CREATE TABLE IF NOT EXISTS `kapil_notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ntf_type` varchar(30) NOT NULL,
  `ntf_text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_notifications`
--

CREATE TABLE IF NOT EXISTS `rahul_notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ntf_type` varchar(30) NOT NULL,
  `ntf_text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_notifications`
--

CREATE TABLE IF NOT EXISTS `ravi_notifications` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ntf_type` varchar(30) NOT NULL,
  `ntf_text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_notifications`
--
ALTER TABLE `anil_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_notifications`
--
ALTER TABLE `kapil_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_notifications`
--
ALTER TABLE `rahul_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_notifications`
--
ALTER TABLE `ravi_notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_notifications`
--
ALTER TABLE `anil_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_notifications`
--
ALTER TABLE `kapil_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_notifications`
--
ALTER TABLE `rahul_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_notifications`
--
ALTER TABLE `ravi_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
