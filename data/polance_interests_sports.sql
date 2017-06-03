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
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `all_sports_interests`
--

INSERT INTO `all_sports_interests` (`id`, `name`, `unique_name`, `table_name`, `parent_id`) VALUES
(1, 'Cricket', 'Cricket', 'Cricket_0_1', 0),
(2, 'Kabaddi', 'Kabaddi', 'Kabaddi_0_2', 0),
(3, 'kuch bhi', 'kuchbhi', 'kuch bhi_0_3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cricket_0_1`
--

CREATE TABLE IF NOT EXISTS `cricket_0_1` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `kabaddi_0_2`
--

CREATE TABLE IF NOT EXISTS `kabaddi_0_2` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_sports_interests`
--
ALTER TABLE `all_sports_interests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cricket_0_1`
--
ALTER TABLE `cricket_0_1`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kabaddi_0_2`
--
ALTER TABLE `kabaddi_0_2`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
