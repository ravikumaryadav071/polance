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
-- Database: `polance_interests_sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_sports_interests`
--

CREATE TABLE IF NOT EXISTS `all_sports_interests` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `table_name` varchar(80) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_sports_interests`
--

INSERT INTO `all_sports_interests` (`id`, `name`, `unique_name`, `table_name`, `parent_id`, `child_id`) VALUES
(1, 'Cricket', 'Cricket', 'Cricket_0_1', 0, '8'),
(2, 'Kabaddi', 'Kabaddi', 'Kabaddi_0_2', 0, ''),
(3, 'kuch bhi', 'kuchbhi', 'kuch bhi_0_3', 0, ''),
(8, 'IPL', 'IPL', 'IPL_1_8', 1, ''),
(9, 'Cricket League', 'CricketLeague', 'Cricket League_0_9', 0, '10'),
(10, 'IPL', 'IPL', 'IPL_9_10', 9, ''),
(11, 'Rajasthan Royals', 'RajasthanRoyals', 'Rajasthan Royals_0_11', 8, ''),
(12, 'Rajasthan Royals', 'RajasthanRoyals', 'Rajasthan Royals_0_12', 10, ''),
(13, 'Sachin', 'Sachin', 'Sachin_0_13', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `cricket_0_1`
--

CREATE TABLE IF NOT EXISTS `cricket_0_1` (
  `id` int(11) NOT NULL,
  `this_int_id` int(11) NOT NULL DEFAULT '1',
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cricket_0_1`
--

INSERT INTO `cricket_0_1` (`id`, `this_int_id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 1, 1, 20, 'USER', '2015-09-11 19:13:11');

-- --------------------------------------------------------

--
-- Table structure for table `cricket_0_1_subscribers`
--

CREATE TABLE IF NOT EXISTS `cricket_0_1_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cricket_0_1_subscribers`
--

INSERT INTO `cricket_0_1_subscribers` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ipl_1_8`
--

CREATE TABLE IF NOT EXISTS `ipl_1_8` (
  `id` int(11) NOT NULL,
  `this_int_id` int(11) NOT NULL DEFAULT '8',
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ipl_1_8`
--

INSERT INTO `ipl_1_8` (`id`, `this_int_id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 8, 1, 14, 'USER', '2015-09-11 12:20:28'),
(2, 8, 1, 15, 'USER', '2015-09-11 12:28:51'),
(3, 8, 1, 26, 'USER', '2015-09-12 07:19:32'),
(4, 8, 1, 32, 'USER', '2015-09-14 19:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `ipl_1_8_subscribers`
--

CREATE TABLE IF NOT EXISTS `ipl_1_8_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipl_9_10`
--

CREATE TABLE IF NOT EXISTS `ipl_9_10` (
  `id` int(11) NOT NULL,
  `this_int_id` int(11) NOT NULL DEFAULT '10',
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ipl_9_10`
--

INSERT INTO `ipl_9_10` (`id`, `this_int_id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 10, 1, 14, 'USER', '2015-09-11 12:20:28'),
(2, 10, 1, 15, 'USER', '2015-09-11 12:28:51'),
(3, 10, 1, 29, 'USER', '2015-09-14 18:45:22'),
(4, 10, 1, 30, 'USER', '2015-09-14 18:45:45'),
(5, 10, 1, 31, 'USER', '2015-09-14 18:46:40');

-- --------------------------------------------------------

--
-- Table structure for table `ipl_9_10_subscribers`
--

CREATE TABLE IF NOT EXISTS `ipl_9_10_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kabaddi_0_2`
--

CREATE TABLE IF NOT EXISTS `kabaddi_0_2` (
  `id` int(11) NOT NULL,
  `this_int_id` int(11) NOT NULL DEFAULT '2',
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kabaddi_0_2_subscribers`
--

CREATE TABLE IF NOT EXISTS `kabaddi_0_2_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kabaddi_0_2_subscribers`
--

INSERT INTO `kabaddi_0_2_subscribers` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `sachin_0_13`
--

CREATE TABLE IF NOT EXISTS `sachin_0_13` (
  `id` int(11) NOT NULL,
  `this_int_id` int(11) NOT NULL DEFAULT '13',
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sachin_0_13_subscribers`
--

CREATE TABLE IF NOT EXISTS `sachin_0_13_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_sports_interests`
--
ALTER TABLE `all_sports_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_0_1`
--
ALTER TABLE `cricket_0_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cricket_0_1_subscribers`
--
ALTER TABLE `cricket_0_1_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ipl_1_8`
--
ALTER TABLE `ipl_1_8`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipl_1_8_subscribers`
--
ALTER TABLE `ipl_1_8_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ipl_9_10`
--
ALTER TABLE `ipl_9_10`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipl_9_10_subscribers`
--
ALTER TABLE `ipl_9_10_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `kabaddi_0_2`
--
ALTER TABLE `kabaddi_0_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabaddi_0_2_subscribers`
--
ALTER TABLE `kabaddi_0_2_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `sachin_0_13`
--
ALTER TABLE `sachin_0_13`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sachin_0_13_subscribers`
--
ALTER TABLE `sachin_0_13_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_sports_interests`
--
ALTER TABLE `all_sports_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `cricket_0_1`
--
ALTER TABLE `cricket_0_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ipl_1_8`
--
ALTER TABLE `ipl_1_8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ipl_9_10`
--
ALTER TABLE `ipl_9_10`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kabaddi_0_2`
--
ALTER TABLE `kabaddi_0_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sachin_0_13`
--
ALTER TABLE `sachin_0_13`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
