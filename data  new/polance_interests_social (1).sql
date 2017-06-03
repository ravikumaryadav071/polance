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
-- Database: `polance_interests_social`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_social_interests`
--

CREATE TABLE IF NOT EXISTS `all_social_interests` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `table_name` varchar(80) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` varchar(500) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_social_interests`
--

INSERT INTO `all_social_interests` (`id`, `name`, `unique_name`, `table_name`, `parent_id`, `child_id`) VALUES
(1, 'Modi', 'Modi', 'Modi_0_1', 0, ''),
(2, 'Modia', 'Modia', 'Modia_0_2', 0, ''),
(3, 'wwdwd', 'wwdwd', 'wwdwd_0_3', 0, ''),
(4, 'FaceBook', 'FaceBook', 'FaceBook_0_4', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_0_4`
--

CREATE TABLE IF NOT EXISTS `facebook_0_4` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facebook_0_4`
--

INSERT INTO `facebook_0_4` (`id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 1, 27, 'USER', '2015-09-14 18:40:04'),
(2, 1, 28, 'USER', '2015-09-14 18:41:01');

-- --------------------------------------------------------

--
-- Table structure for table `facebook_0_4_subscribers`
--

CREATE TABLE IF NOT EXISTS `facebook_0_4_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modia_0_2`
--

CREATE TABLE IF NOT EXISTS `modia_0_2` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modia_0_2`
--

INSERT INTO `modia_0_2` (`id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 1, 18, 'USER', '2015-09-11 19:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `modia_0_2_subscribers`
--

CREATE TABLE IF NOT EXISTS `modia_0_2_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modi_0_1`
--

CREATE TABLE IF NOT EXISTS `modi_0_1` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modi_0_1`
--

INSERT INTO `modi_0_1` (`id`, `userid`, `post_id`, `post_type`, `date`) VALUES
(1, 1, 16, 'USER', '2015-09-11 13:01:37'),
(2, 1, 21, 'USER', '2015-09-11 19:15:39'),
(3, 1, 26, 'USER', '2015-09-12 07:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `modi_0_1_subscribers`
--

CREATE TABLE IF NOT EXISTS `modi_0_1_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wwdwd_0_3`
--

CREATE TABLE IF NOT EXISTS `wwdwd_0_3` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wwdwd_0_3_subscribers`
--

CREATE TABLE IF NOT EXISTS `wwdwd_0_3_subscribers` (
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_social_interests`
--
ALTER TABLE `all_social_interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_0_4`
--
ALTER TABLE `facebook_0_4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facebook_0_4_subscribers`
--
ALTER TABLE `facebook_0_4_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `modia_0_2`
--
ALTER TABLE `modia_0_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modia_0_2_subscribers`
--
ALTER TABLE `modia_0_2_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `modi_0_1`
--
ALTER TABLE `modi_0_1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modi_0_1_subscribers`
--
ALTER TABLE `modi_0_1_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `wwdwd_0_3`
--
ALTER TABLE `wwdwd_0_3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wwdwd_0_3_subscribers`
--
ALTER TABLE `wwdwd_0_3_subscribers`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_social_interests`
--
ALTER TABLE `all_social_interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `facebook_0_4`
--
ALTER TABLE `facebook_0_4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `modia_0_2`
--
ALTER TABLE `modia_0_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modi_0_1`
--
ALTER TABLE `modi_0_1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `wwdwd_0_3`
--
ALTER TABLE `wwdwd_0_3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
