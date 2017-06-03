-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2015 at 04:43 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `polance_users_feeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_feeds`
--

CREATE TABLE IF NOT EXISTS `anil_feeds` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '4',
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_feeds`
--

CREATE TABLE IF NOT EXISTS `kapil_feeds` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '3',
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_feeds`
--

CREATE TABLE IF NOT EXISTS `rahul_feeds` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '2',
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_feeds`
--

CREATE TABLE IF NOT EXISTS `ravi_feeds` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '1',
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_feeds`
--
ALTER TABLE `anil_feeds`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_feeds`
--
ALTER TABLE `kapil_feeds`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_feeds`
--
ALTER TABLE `rahul_feeds`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_feeds`
--
ALTER TABLE `ravi_feeds`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_feeds`
--
ALTER TABLE `anil_feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_feeds`
--
ALTER TABLE `kapil_feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_feeds`
--
ALTER TABLE `rahul_feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_feeds`
--
ALTER TABLE `ravi_feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
