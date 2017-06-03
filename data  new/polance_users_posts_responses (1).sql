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
-- Database: `polance_users_posts_responses`
--

-- --------------------------------------------------------

--
-- Table structure for table `ravi_15_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_15_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_15_report`
--

CREATE TABLE IF NOT EXISTS `ravi_15_report` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_15_share`
--

CREATE TABLE IF NOT EXISTS `ravi_15_share` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_15_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_15_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_16_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_16_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_16_report`
--

CREATE TABLE IF NOT EXISTS `ravi_16_report` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_16_share`
--

CREATE TABLE IF NOT EXISTS `ravi_16_share` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_16_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_16_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_17_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_17_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_17_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_17_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_17_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_17_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_17_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_17_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_17_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_17_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_18_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_18_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_18_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_18_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_18_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_18_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_18_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_18_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_18_upvotes`
--

INSERT INTO `ravi_18_upvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_18_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_18_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_19_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_19_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_19_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_19_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_19_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_19_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_19_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_19_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_19_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_19_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_20_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_20_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_20_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_20_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_20_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_20_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_20_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_20_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_20_upvotes`
--

INSERT INTO `ravi_20_upvotes` (`userid`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_20_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_20_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_21_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_21_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_21_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_21_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_21_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_21_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_21_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_21_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_21_upvotes`
--

INSERT INTO `ravi_21_upvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_21_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_21_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_22_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_22_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_22_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_22_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_22_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_22_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_22_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_22_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_22_upvotes`
--

INSERT INTO `ravi_22_upvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_22_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_22_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_23_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_23_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_23_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_23_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_23_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_23_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_23_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_23_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_23_upvotes`
--

INSERT INTO `ravi_23_upvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_23_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_23_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_24_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_24_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_24_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_24_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_24_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_24_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_24_shares`
--

INSERT INTO `ravi_24_shares` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_24_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_24_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_24_upvotes`
--

INSERT INTO `ravi_24_upvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_24_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_24_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_24_varify`
--

INSERT INTO `ravi_24_varify` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_25_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_25_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_25_downvotes`
--

INSERT INTO `ravi_25_downvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_25_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_25_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_25_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_25_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_25_shares`
--

INSERT INTO `ravi_25_shares` (`userid`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_25_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_25_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_25_upvotes`
--

INSERT INTO `ravi_25_upvotes` (`userid`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_25_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_25_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_26_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_26_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_26_downvotes`
--

INSERT INTO `ravi_26_downvotes` (`userid`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_26_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_26_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_26_reports`
--

INSERT INTO `ravi_26_reports` (`userid`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_26_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_26_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_26_shares`
--

INSERT INTO `ravi_26_shares` (`userid`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_26_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_26_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_26_upvotes`
--

INSERT INTO `ravi_26_upvotes` (`userid`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_26_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_26_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_26_varify`
--

INSERT INTO `ravi_26_varify` (`userid`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ravi_28_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_28_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_28_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_28_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_28_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_28_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_28_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_28_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_28_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_28_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_29_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_29_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_29_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_29_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_29_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_29_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_29_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_29_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_29_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_29_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_30_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_30_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_30_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_30_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_30_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_30_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_30_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_30_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_30_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_30_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_31_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_31_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_31_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_31_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_31_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_31_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_31_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_31_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_31_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_31_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_32_downvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_32_downvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_32_reports`
--

CREATE TABLE IF NOT EXISTS `ravi_32_reports` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_32_shares`
--

CREATE TABLE IF NOT EXISTS `ravi_32_shares` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_32_upvotes`
--

CREATE TABLE IF NOT EXISTS `ravi_32_upvotes` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_32_varify`
--

CREATE TABLE IF NOT EXISTS `ravi_32_varify` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ravi_15_downvotes`
--
ALTER TABLE `ravi_15_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_15_report`
--
ALTER TABLE `ravi_15_report`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_15_share`
--
ALTER TABLE `ravi_15_share`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_15_upvotes`
--
ALTER TABLE `ravi_15_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_16_downvotes`
--
ALTER TABLE `ravi_16_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_16_report`
--
ALTER TABLE `ravi_16_report`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_16_share`
--
ALTER TABLE `ravi_16_share`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_16_upvotes`
--
ALTER TABLE `ravi_16_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_17_downvotes`
--
ALTER TABLE `ravi_17_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_17_reports`
--
ALTER TABLE `ravi_17_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_17_shares`
--
ALTER TABLE `ravi_17_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_17_upvotes`
--
ALTER TABLE `ravi_17_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_17_varify`
--
ALTER TABLE `ravi_17_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_18_downvotes`
--
ALTER TABLE `ravi_18_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_18_reports`
--
ALTER TABLE `ravi_18_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_18_shares`
--
ALTER TABLE `ravi_18_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_18_upvotes`
--
ALTER TABLE `ravi_18_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_18_varify`
--
ALTER TABLE `ravi_18_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_19_downvotes`
--
ALTER TABLE `ravi_19_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_19_reports`
--
ALTER TABLE `ravi_19_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_19_shares`
--
ALTER TABLE `ravi_19_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_19_upvotes`
--
ALTER TABLE `ravi_19_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_19_varify`
--
ALTER TABLE `ravi_19_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_20_downvotes`
--
ALTER TABLE `ravi_20_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_20_reports`
--
ALTER TABLE `ravi_20_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_20_shares`
--
ALTER TABLE `ravi_20_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_20_upvotes`
--
ALTER TABLE `ravi_20_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_20_varify`
--
ALTER TABLE `ravi_20_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_21_downvotes`
--
ALTER TABLE `ravi_21_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_21_reports`
--
ALTER TABLE `ravi_21_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_21_shares`
--
ALTER TABLE `ravi_21_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_21_upvotes`
--
ALTER TABLE `ravi_21_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_21_varify`
--
ALTER TABLE `ravi_21_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_22_downvotes`
--
ALTER TABLE `ravi_22_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_22_reports`
--
ALTER TABLE `ravi_22_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_22_shares`
--
ALTER TABLE `ravi_22_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_22_upvotes`
--
ALTER TABLE `ravi_22_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_22_varify`
--
ALTER TABLE `ravi_22_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_23_downvotes`
--
ALTER TABLE `ravi_23_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_23_reports`
--
ALTER TABLE `ravi_23_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_23_shares`
--
ALTER TABLE `ravi_23_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_23_upvotes`
--
ALTER TABLE `ravi_23_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_23_varify`
--
ALTER TABLE `ravi_23_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_24_downvotes`
--
ALTER TABLE `ravi_24_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_24_reports`
--
ALTER TABLE `ravi_24_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_24_shares`
--
ALTER TABLE `ravi_24_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_24_upvotes`
--
ALTER TABLE `ravi_24_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_24_varify`
--
ALTER TABLE `ravi_24_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_25_downvotes`
--
ALTER TABLE `ravi_25_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_25_reports`
--
ALTER TABLE `ravi_25_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_25_shares`
--
ALTER TABLE `ravi_25_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_25_upvotes`
--
ALTER TABLE `ravi_25_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_25_varify`
--
ALTER TABLE `ravi_25_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_26_downvotes`
--
ALTER TABLE `ravi_26_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_26_reports`
--
ALTER TABLE `ravi_26_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_26_shares`
--
ALTER TABLE `ravi_26_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_26_upvotes`
--
ALTER TABLE `ravi_26_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_26_varify`
--
ALTER TABLE `ravi_26_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_28_downvotes`
--
ALTER TABLE `ravi_28_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_28_reports`
--
ALTER TABLE `ravi_28_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_28_shares`
--
ALTER TABLE `ravi_28_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_28_upvotes`
--
ALTER TABLE `ravi_28_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_28_varify`
--
ALTER TABLE `ravi_28_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_29_downvotes`
--
ALTER TABLE `ravi_29_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_29_reports`
--
ALTER TABLE `ravi_29_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_29_shares`
--
ALTER TABLE `ravi_29_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_29_upvotes`
--
ALTER TABLE `ravi_29_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_29_varify`
--
ALTER TABLE `ravi_29_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_30_downvotes`
--
ALTER TABLE `ravi_30_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_30_reports`
--
ALTER TABLE `ravi_30_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_30_shares`
--
ALTER TABLE `ravi_30_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_30_upvotes`
--
ALTER TABLE `ravi_30_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_30_varify`
--
ALTER TABLE `ravi_30_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_31_downvotes`
--
ALTER TABLE `ravi_31_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_31_reports`
--
ALTER TABLE `ravi_31_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_31_shares`
--
ALTER TABLE `ravi_31_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_31_upvotes`
--
ALTER TABLE `ravi_31_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_31_varify`
--
ALTER TABLE `ravi_31_varify`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_32_downvotes`
--
ALTER TABLE `ravi_32_downvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_32_reports`
--
ALTER TABLE `ravi_32_reports`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_32_shares`
--
ALTER TABLE `ravi_32_shares`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_32_upvotes`
--
ALTER TABLE `ravi_32_upvotes`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ravi_32_varify`
--
ALTER TABLE `ravi_32_varify`
  ADD PRIMARY KEY (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
