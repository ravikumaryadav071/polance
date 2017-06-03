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
-- Database: `polance_interests_education`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_education_interests`
--

CREATE TABLE IF NOT EXISTS `all_education_interests` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `table_name` varchar(80) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_education_interests`
--

INSERT INTO `all_education_interests` (`id`, `name`, `unique_name`, `table_name`, `parent_id`, `child_id`) VALUES
(1, 'My Sql', 'MySql', 'My Sql_0_1', 0, ''),
(2, 'FaceBook', 'FaceBook', 'FaceBook_0_2', 0, '3,4,5'),
(3, 'page', 'page', 'page_0_3', 2, '4,5'),
(4, 'polance', 'polance', 'polance_0_4', 3, ''),
(5, 'quora', 'quora', 'quora_0_5', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_0_2`
--

CREATE TABLE IF NOT EXISTS `facebook_0_2` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facebook_0_2_subscribers`
--

CREATE TABLE IF NOT EXISTS `facebook_0_2_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_0_3`
--

CREATE TABLE IF NOT EXISTS `page_0_3` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_0_3_subscribers`
--

CREATE TABLE IF NOT EXISTS `page_0_3_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polance_0_4`
--

CREATE TABLE IF NOT EXISTS `polance_0_4` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polance_0_4_subscribers`
--

CREATE TABLE IF NOT EXISTS `polance_0_4_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quora_0_5`
--

CREATE TABLE IF NOT EXISTS `quora_0_5` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quora_0_5_subscribers`
--

CREATE TABLE IF NOT EXISTS `quora_0_5_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_education_interests`
--
ALTER TABLE `all_education_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_0_2`
--
ALTER TABLE `facebook_0_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_0_2_subscribers`
--
ALTER TABLE `facebook_0_2_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `page_0_3`
--
ALTER TABLE `page_0_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_0_3_subscribers`
--
ALTER TABLE `page_0_3_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `polance_0_4`
--
ALTER TABLE `polance_0_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polance_0_4_subscribers`
--
ALTER TABLE `polance_0_4_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `quora_0_5`
--
ALTER TABLE `quora_0_5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quora_0_5_subscribers`
--
ALTER TABLE `quora_0_5_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_education_interests`
--
ALTER TABLE `all_education_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `facebook_0_2`
--
ALTER TABLE `facebook_0_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `page_0_3`
--
ALTER TABLE `page_0_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `polance_0_4`
--
ALTER TABLE `polance_0_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quora_0_5`
--
ALTER TABLE `quora_0_5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
