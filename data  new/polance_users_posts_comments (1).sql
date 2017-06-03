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
-- Database: `polance_users_posts_comments`
--

-- --------------------------------------------------------

--
-- Table structure for table `ravi_15_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_15_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_16_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_16_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_17_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_17_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_18_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_18_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_19_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_19_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_20_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_20_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_21_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_21_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_22_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_22_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_23_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_23_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_24_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_24_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_25_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_25_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_25_comments`
--

INSERT INTO `ravi_25_comments` (`id`, `userid`, `comment`, `date`) VALUES
(1, 1, 'here we go', '2015-09-14 13:41:29'),
(2, 1, 'dwdghwdw', '2015-09-14 15:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `ravi_26_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_26_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_26_comments`
--

INSERT INTO `ravi_26_comments` (`id`, `userid`, `comment`, `date`) VALUES
(1, 1, 'here I am', '2015-09-12 10:24:05'),
(2, 1, 'i am the first one to comment.', '2015-09-12 10:32:07'),
(3, 1, 'append it', '2015-09-12 10:35:30'),
(4, 1, 'gsygsyqs', '2015-09-12 13:15:07'),
(5, 2, 'suuww uhwuhuswhuw', '2015-09-12 13:19:01');

-- --------------------------------------------------------

--
-- Table structure for table `ravi_28_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_28_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'NO',
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_29_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_29_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'NO',
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_30_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_30_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'NO',
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_31_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_31_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'NO',
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_32_comments`
--

CREATE TABLE IF NOT EXISTS `ravi_32_comments` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'NO',
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ravi_15_comments`
--
ALTER TABLE `ravi_15_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_16_comments`
--
ALTER TABLE `ravi_16_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_17_comments`
--
ALTER TABLE `ravi_17_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_18_comments`
--
ALTER TABLE `ravi_18_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_19_comments`
--
ALTER TABLE `ravi_19_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_20_comments`
--
ALTER TABLE `ravi_20_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_21_comments`
--
ALTER TABLE `ravi_21_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_22_comments`
--
ALTER TABLE `ravi_22_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_23_comments`
--
ALTER TABLE `ravi_23_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_24_comments`
--
ALTER TABLE `ravi_24_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_25_comments`
--
ALTER TABLE `ravi_25_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_26_comments`
--
ALTER TABLE `ravi_26_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_28_comments`
--
ALTER TABLE `ravi_28_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_29_comments`
--
ALTER TABLE `ravi_29_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_30_comments`
--
ALTER TABLE `ravi_30_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_31_comments`
--
ALTER TABLE `ravi_31_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_32_comments`
--
ALTER TABLE `ravi_32_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ravi_15_comments`
--
ALTER TABLE `ravi_15_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_16_comments`
--
ALTER TABLE `ravi_16_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_17_comments`
--
ALTER TABLE `ravi_17_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_18_comments`
--
ALTER TABLE `ravi_18_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_19_comments`
--
ALTER TABLE `ravi_19_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_20_comments`
--
ALTER TABLE `ravi_20_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_21_comments`
--
ALTER TABLE `ravi_21_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_22_comments`
--
ALTER TABLE `ravi_22_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_23_comments`
--
ALTER TABLE `ravi_23_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_24_comments`
--
ALTER TABLE `ravi_24_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_25_comments`
--
ALTER TABLE `ravi_25_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ravi_26_comments`
--
ALTER TABLE `ravi_26_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ravi_28_comments`
--
ALTER TABLE `ravi_28_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_29_comments`
--
ALTER TABLE `ravi_29_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_30_comments`
--
ALTER TABLE `ravi_30_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_31_comments`
--
ALTER TABLE `ravi_31_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_32_comments`
--
ALTER TABLE `ravi_32_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
