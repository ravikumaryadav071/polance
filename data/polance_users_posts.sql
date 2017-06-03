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
-- Database: `polance_users_posts`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_deleted_posts`
--

CREATE TABLE IF NOT EXISTS `anil_deleted_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `edited_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `anil_edited_posts`
--

CREATE TABLE IF NOT EXISTS `anil_edited_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `anil_posts`
--

CREATE TABLE IF NOT EXISTS `anil_posts` (
`id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_deleted_posts`
--

CREATE TABLE IF NOT EXISTS `kapil_deleted_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `edited_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_edited_posts`
--

CREATE TABLE IF NOT EXISTS `kapil_edited_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_posts`
--

CREATE TABLE IF NOT EXISTS `kapil_posts` (
`id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_deleted_posts`
--

CREATE TABLE IF NOT EXISTS `rahul_deleted_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `edited_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_edited_posts`
--

CREATE TABLE IF NOT EXISTS `rahul_edited_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_posts`
--

CREATE TABLE IF NOT EXISTS `rahul_posts` (
`id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_deleted_posts`
--

CREATE TABLE IF NOT EXISTS `ravi_deleted_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `edited_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_edited_posts`
--

CREATE TABLE IF NOT EXISTS `ravi_edited_posts` (
`id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_posts`
--

CREATE TABLE IF NOT EXISTS `ravi_posts` (
`id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` varchar(100) NOT NULL DEFAULT 'TEXT_MESSAGE',
  `extention` varchar(30) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refrences` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_deleted_posts`
--
ALTER TABLE `anil_deleted_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_edited_posts`
--
ALTER TABLE `anil_edited_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_posts`
--
ALTER TABLE `anil_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_deleted_posts`
--
ALTER TABLE `kapil_deleted_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_edited_posts`
--
ALTER TABLE `kapil_edited_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_posts`
--
ALTER TABLE `kapil_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_deleted_posts`
--
ALTER TABLE `rahul_deleted_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_edited_posts`
--
ALTER TABLE `rahul_edited_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_posts`
--
ALTER TABLE `rahul_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_deleted_posts`
--
ALTER TABLE `ravi_deleted_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_edited_posts`
--
ALTER TABLE `ravi_edited_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_posts`
--
ALTER TABLE `ravi_posts`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_deleted_posts`
--
ALTER TABLE `anil_deleted_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_edited_posts`
--
ALTER TABLE `anil_edited_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_posts`
--
ALTER TABLE `anil_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_deleted_posts`
--
ALTER TABLE `kapil_deleted_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_edited_posts`
--
ALTER TABLE `kapil_edited_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_posts`
--
ALTER TABLE `kapil_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_deleted_posts`
--
ALTER TABLE `rahul_deleted_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_edited_posts`
--
ALTER TABLE `rahul_edited_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_posts`
--
ALTER TABLE `rahul_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_deleted_posts`
--
ALTER TABLE `ravi_deleted_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_edited_posts`
--
ALTER TABLE `ravi_edited_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ravi_posts`
--
ALTER TABLE `ravi_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
