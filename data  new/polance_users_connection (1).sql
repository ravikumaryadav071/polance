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
-- Database: `polance_users_connection`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_blocked`
--

CREATE TABLE IF NOT EXISTS `anil_blocked` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anil_followers`
--

CREATE TABLE IF NOT EXISTS `anil_followers` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anil_followers`
--

INSERT INTO `anil_followers` (`id`, `userid`, `name_init`, `date`) VALUES
(6, 1, 'r', '2015-09-13 14:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `anil_following`
--

CREATE TABLE IF NOT EXISTS `anil_following` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anil_friends`
--

CREATE TABLE IF NOT EXISTS `anil_friends` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `received_from` varchar(50) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anil_friends`
--

INSERT INTO `anil_friends` (`id`, `userid`, `received_from`, `name_init`, `id_in_gf`, `priority`, `date`) VALUES
(1, 1, 'anil_following', 'r', 1, 0, '2015-09-16 11:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `anil_requests`
--

CREATE TABLE IF NOT EXISTS `anil_requests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_blocked`
--

CREATE TABLE IF NOT EXISTS `kapil_blocked` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_followers`
--

CREATE TABLE IF NOT EXISTS `kapil_followers` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kapil_followers`
--

INSERT INTO `kapil_followers` (`id`, `userid`, `name_init`, `date`) VALUES
(1, 1, 'r', '2015-09-14 18:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `kapil_following`
--

CREATE TABLE IF NOT EXISTS `kapil_following` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_friends`
--

CREATE TABLE IF NOT EXISTS `kapil_friends` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `received_from` varchar(50) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_requests`
--

CREATE TABLE IF NOT EXISTS `kapil_requests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_blocked`
--

CREATE TABLE IF NOT EXISTS `rahul_blocked` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_followers`
--

CREATE TABLE IF NOT EXISTS `rahul_followers` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_following`
--

CREATE TABLE IF NOT EXISTS `rahul_following` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_friends`
--

CREATE TABLE IF NOT EXISTS `rahul_friends` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `received_from` varchar(50) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rahul_friends`
--

INSERT INTO `rahul_friends` (`id`, `userid`, `received_from`, `name_init`, `id_in_gf`, `priority`, `date`) VALUES
(8, 1, 'rahul_following', 'r', 1, 0, '2015-09-10 21:37:36');

-- --------------------------------------------------------

--
-- Table structure for table `rahul_requests`
--

CREATE TABLE IF NOT EXISTS `rahul_requests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_blocked`
--

CREATE TABLE IF NOT EXISTS `ravi_blocked` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_followers`
--

CREATE TABLE IF NOT EXISTS `ravi_followers` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_following`
--

CREATE TABLE IF NOT EXISTS `ravi_following` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_following`
--

INSERT INTO `ravi_following` (`id`, `userid`, `name_init`, `id_in_gf`, `priority`, `date`) VALUES
(6, 4, 'a', 7, 0, '2015-09-13 14:45:02'),
(7, 3, 'k', 9, 0, '2015-09-14 18:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `ravi_friends`
--

CREATE TABLE IF NOT EXISTS `ravi_friends` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `received_from` varchar(50) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_gf` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_friends`
--

INSERT INTO `ravi_friends` (`id`, `userid`, `received_from`, `name_init`, `id_in_gf`, `priority`, `date`) VALUES
(8, 2, 'ravi_followers', 'r', 2, 0, '2015-09-10 21:37:36'),
(11, 4, 'ravi_followers', 'a', 12, 0, '2015-09-16 11:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `ravi_requests`
--

CREATE TABLE IF NOT EXISTS `ravi_requests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_blocked`
--
ALTER TABLE `anil_blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_followers`
--
ALTER TABLE `anil_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_following`
--
ALTER TABLE `anil_following`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_friends`
--
ALTER TABLE `anil_friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_requests`
--
ALTER TABLE `anil_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_blocked`
--
ALTER TABLE `kapil_blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_followers`
--
ALTER TABLE `kapil_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_following`
--
ALTER TABLE `kapil_following`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_friends`
--
ALTER TABLE `kapil_friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_requests`
--
ALTER TABLE `kapil_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_blocked`
--
ALTER TABLE `rahul_blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_followers`
--
ALTER TABLE `rahul_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_following`
--
ALTER TABLE `rahul_following`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_friends`
--
ALTER TABLE `rahul_friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_requests`
--
ALTER TABLE `rahul_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_blocked`
--
ALTER TABLE `ravi_blocked`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_followers`
--
ALTER TABLE `ravi_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_following`
--
ALTER TABLE `ravi_following`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_friends`
--
ALTER TABLE `ravi_friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_requests`
--
ALTER TABLE `ravi_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_blocked`
--
ALTER TABLE `anil_blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_followers`
--
ALTER TABLE `anil_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `anil_following`
--
ALTER TABLE `anil_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `anil_friends`
--
ALTER TABLE `anil_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `anil_requests`
--
ALTER TABLE `anil_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_blocked`
--
ALTER TABLE `kapil_blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_followers`
--
ALTER TABLE `kapil_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kapil_following`
--
ALTER TABLE `kapil_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_friends`
--
ALTER TABLE `kapil_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_requests`
--
ALTER TABLE `kapil_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_blocked`
--
ALTER TABLE `rahul_blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_followers`
--
ALTER TABLE `rahul_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_following`
--
ALTER TABLE `rahul_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_friends`
--
ALTER TABLE `rahul_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `rahul_requests`
--
ALTER TABLE `rahul_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_blocked`
--
ALTER TABLE `ravi_blocked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_followers`
--
ALTER TABLE `ravi_followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ravi_following`
--
ALTER TABLE `ravi_following`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ravi_friends`
--
ALTER TABLE `ravi_friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ravi_requests`
--
ALTER TABLE `ravi_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
