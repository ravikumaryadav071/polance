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
-- Database: `polance_collaborations`
--

-- --------------------------------------------------------

--
-- Table structure for table `collaborations`
--

CREATE TABLE IF NOT EXISTS `collaborations` (
  `id` int(11) NOT NULL,
  `collaboration_name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `col_table` varchar(75) NOT NULL,
  `col_interests` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `members_count` int(11) NOT NULL,
  `profile_pic` varchar(350) NOT NULL,
  `profile_pic_dg` varchar(350) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collaborations`
--

INSERT INTO `collaborations` (`id`, `collaboration_name`, `unique_name`, `col_table`, `col_interests`, `created_by`, `members_count`, `profile_pic`, `profile_pic_dg`, `date`) VALUES
(1, 'My Col', 'MyCol', '', '(8->8),(1->7),', 1, 5, 'collaborations/profile_pic/625ef94dc60a4245bc27fcd21ea654e9593ce5ab990802a18ee94b8ca8d87e29_ravi_My Col.jpg', 'collaborations/profile_pic_dg/625ef94dc60a4245bc27fcd21ea654e9593ce5ab990802a18ee94b8ca8d87e29_ravi_My Col.jpg', '2015-09-16 09:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `collaborations_unique`
--

CREATE TABLE IF NOT EXISTS `collaborations_unique` (
  `unique_name` varchar(60) NOT NULL,
  `col_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collaborations_unique`
--

INSERT INTO `collaborations_unique` (`unique_name`, `col_id`) VALUES
('MyCol', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collaborations`
--
ALTER TABLE `collaborations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaborations_unique`
--
ALTER TABLE `collaborations_unique`
  ADD PRIMARY KEY (`unique_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collaborations`
--
ALTER TABLE `collaborations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
