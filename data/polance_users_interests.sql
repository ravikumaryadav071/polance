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
-- Database: `polance_users_interests`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_interests`
--

CREATE TABLE IF NOT EXISTS `anil_interests` (
`id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL,
  `db_id` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_st` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_interests`
--

CREATE TABLE IF NOT EXISTS `kapil_interests` (
`id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL,
  `db_id` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_st` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_interests`
--

CREATE TABLE IF NOT EXISTS `rahul_interests` (
`id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL,
  `db_id` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_st` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_interests`
--

CREATE TABLE IF NOT EXISTS `ravi_interests` (
`id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL,
  `db_id` int(11) NOT NULL,
  `name_init` varchar(1) NOT NULL,
  `id_in_st` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ravi_interests`
--

INSERT INTO `ravi_interests` (`id`, `id_in_db`, `db_id`, `name_init`, `id_in_st`, `date`) VALUES
(2, 1, 3, 'm', 1, '2015-09-09 13:43:47'),
(3, 2, 8, 'k', 1, '2015-09-09 14:29:56'),
(4, 3, 8, 'k', 2, '2015-09-09 14:30:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_interests`
--
ALTER TABLE `anil_interests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_interests`
--
ALTER TABLE `kapil_interests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_interests`
--
ALTER TABLE `rahul_interests`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_interests`
--
ALTER TABLE `ravi_interests`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_interests`
--
ALTER TABLE `anil_interests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_interests`
--
ALTER TABLE `kapil_interests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_interests`
--
ALTER TABLE `rahul_interests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_interests`
--
ALTER TABLE `ravi_interests`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
