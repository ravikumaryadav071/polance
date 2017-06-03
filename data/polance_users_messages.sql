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
-- Database: `polance_users_messages`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_chat_groups`
--

CREATE TABLE IF NOT EXISTS `anil_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `last_seen` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `anil_deleted_chat_groups`
--

CREATE TABLE IF NOT EXISTS `anil_deleted_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `left_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `anil_inbox`
--

CREATE TABLE IF NOT EXISTS `anil_inbox` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `anil_messages`
--

CREATE TABLE IF NOT EXISTS `anil_messages` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `path` varchar(400) NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_chat_groups`
--

CREATE TABLE IF NOT EXISTS `kapil_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `last_seen` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_deleted_chat_groups`
--

CREATE TABLE IF NOT EXISTS `kapil_deleted_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `left_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_inbox`
--

CREATE TABLE IF NOT EXISTS `kapil_inbox` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_messages`
--

CREATE TABLE IF NOT EXISTS `kapil_messages` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `path` varchar(400) NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_chat_groups`
--

CREATE TABLE IF NOT EXISTS `rahul_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `last_seen` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_deleted_chat_groups`
--

CREATE TABLE IF NOT EXISTS `rahul_deleted_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `left_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_inbox`
--

CREATE TABLE IF NOT EXISTS `rahul_inbox` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_messages`
--

CREATE TABLE IF NOT EXISTS `rahul_messages` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `path` varchar(400) NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_chat_groups`
--

CREATE TABLE IF NOT EXISTS `ravi_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `last_seen` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_deleted_chat_groups`
--

CREATE TABLE IF NOT EXISTS `ravi_deleted_chat_groups` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `chat_table` varchar(60) NOT NULL,
  `left_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_inbox`
--

CREATE TABLE IF NOT EXISTS `ravi_inbox` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_messages`
--

CREATE TABLE IF NOT EXISTS `ravi_messages` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `path` varchar(400) NOT NULL,
  `sorr` varchar(10) NOT NULL DEFAULT 'SENT',
  `sorn` varchar(10) NOT NULL DEFAULT 'NOT SEEN',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_chat_groups`
--
ALTER TABLE `anil_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_deleted_chat_groups`
--
ALTER TABLE `anil_deleted_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_inbox`
--
ALTER TABLE `anil_inbox`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_messages`
--
ALTER TABLE `anil_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_chat_groups`
--
ALTER TABLE `kapil_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_deleted_chat_groups`
--
ALTER TABLE `kapil_deleted_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_inbox`
--
ALTER TABLE `kapil_inbox`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_messages`
--
ALTER TABLE `kapil_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_chat_groups`
--
ALTER TABLE `rahul_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_deleted_chat_groups`
--
ALTER TABLE `rahul_deleted_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_inbox`
--
ALTER TABLE `rahul_inbox`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_messages`
--
ALTER TABLE `rahul_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_chat_groups`
--
ALTER TABLE `ravi_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_deleted_chat_groups`
--
ALTER TABLE `ravi_deleted_chat_groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_inbox`
--
ALTER TABLE `ravi_inbox`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_messages`
--
ALTER TABLE `ravi_messages`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_chat_groups`
--
ALTER TABLE `anil_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_deleted_chat_groups`
--
ALTER TABLE `anil_deleted_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_inbox`
--
ALTER TABLE `anil_inbox`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_messages`
--
ALTER TABLE `anil_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_chat_groups`
--
ALTER TABLE `kapil_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_deleted_chat_groups`
--
ALTER TABLE `kapil_deleted_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_inbox`
--
ALTER TABLE `kapil_inbox`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_messages`
--
ALTER TABLE `kapil_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_chat_groups`
--
ALTER TABLE `rahul_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_deleted_chat_groups`
--
ALTER TABLE `rahul_deleted_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_inbox`
--
ALTER TABLE `rahul_inbox`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_messages`
--
ALTER TABLE `rahul_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_chat_groups`
--
ALTER TABLE `ravi_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_deleted_chat_groups`
--
ALTER TABLE `ravi_deleted_chat_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_inbox`
--
ALTER TABLE `ravi_inbox`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_messages`
--
ALTER TABLE `ravi_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
