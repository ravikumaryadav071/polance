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
-- Database: `polance_interests_politics`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_politics_interests`
--

CREATE TABLE IF NOT EXISTS `all_politics_interests` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `table_name` varchar(80) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_politics_interests`
--

INSERT INTO `all_politics_interests` (`id`, `name`, `unique_name`, `table_name`, `parent_id`, `child_id`) VALUES
(1, 'sachin', 'sachin', 'sachin_0_1', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sachin_0_1`
--

CREATE TABLE IF NOT EXISTS `sachin_0_1` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sachin_0_1_subscribers`
--

CREATE TABLE IF NOT EXISTS `sachin_0_1_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_politics_interests`
--
ALTER TABLE `all_politics_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sachin_0_1`
--
ALTER TABLE `sachin_0_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sachin_0_1_subscribers`
--
ALTER TABLE `sachin_0_1_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_politics_interests`
--
ALTER TABLE `all_politics_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sachin_0_1`
--
ALTER TABLE `sachin_0_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
