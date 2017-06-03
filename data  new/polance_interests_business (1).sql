-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2015 at 01:13 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polance_interests_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_business_interests`
--

CREATE TABLE IF NOT EXISTS `all_business_interests` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `table_name` varchar(80) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_business_interests`
--

INSERT INTO `all_business_interests` (`id`, `name`, `unique_name`, `table_name`, `parent_id`, `child_id`) VALUES
(1, 'IPL', 'IPL', '', 8, ''),
(2, 'IPL', 'IPL', '', 8, ''),
(3, 'IPL', 'IPL', '', 8, ''),
(4, 'IPL', 'IPL', '', 8, ''),
(5, 'FaceBook', 'FaceBook', 'FaceBook_0_5', 0, ''),
(6, 'page', 'page', 'page_0_6', 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_0_5`
--

CREATE TABLE IF NOT EXISTS `facebook_0_5` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_0_5_subscribers`
--

CREATE TABLE IF NOT EXISTS `facebook_0_5_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipl_0_`
--

CREATE TABLE IF NOT EXISTS `ipl_0_` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipl_0__subscribers`
--

CREATE TABLE IF NOT EXISTS `ipl_0__subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_0_6`
--

CREATE TABLE IF NOT EXISTS `page_0_6` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_0_6`
--

INSERT INTO `page_0_6` (`id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 1, 17, 'USER', '2015-09-11 18:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `page_0_6_subscribers`
--

CREATE TABLE IF NOT EXISTS `page_0_6_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_business_interests`
--
ALTER TABLE `all_business_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_0_5`
--
ALTER TABLE `facebook_0_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_0_5_subscribers`
--
ALTER TABLE `facebook_0_5_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ipl_0_`
--
ALTER TABLE `ipl_0_`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipl_0__subscribers`
--
ALTER TABLE `ipl_0__subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `page_0_6`
--
ALTER TABLE `page_0_6`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_0_6_subscribers`
--
ALTER TABLE `page_0_6_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_business_interests`
--
ALTER TABLE `all_business_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `facebook_0_5`
--
ALTER TABLE `facebook_0_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ipl_0_`
--
ALTER TABLE `ipl_0_`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page_0_6`
--
ALTER TABLE `page_0_6`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
