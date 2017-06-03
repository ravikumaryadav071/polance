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
-- Database: `polance_collaborations_posts`
--

-- --------------------------------------------------------

--
-- Table structure for table `mycol_deleted_posts`
--

CREATE TABLE IF NOT EXISTS `mycol_deleted_posts` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `edit_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` text NOT NULL,
  `extention` varchar(250) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refs` text NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mycol_edited_posts`
--

CREATE TABLE IF NOT EXISTS `mycol_edited_posts` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` text NOT NULL,
  `extention` varchar(250) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refs` text NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mycol_posts`
--

CREATE TABLE IF NOT EXISTS `mycol_posts` (
  `id` int(11) NOT NULL,
  `text_content` text NOT NULL,
  `file_type` text NOT NULL,
  `extention` varchar(250) NOT NULL DEFAULT 'TEXT',
  `files` text NOT NULL,
  `contributors` varchar(150) NOT NULL,
  `refs` text NOT NULL,
  `interest_tags` text NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'FOLLOWERS',
  `suggested_tags` text NOT NULL,
  `tot_upvotes` int(11) NOT NULL,
  `tot_downvotes` int(11) NOT NULL,
  `tot_comments` int(11) NOT NULL,
  `tot_shares` int(11) NOT NULL,
  `tot_varify` int(11) NOT NULL,
  `tot_reports` int(11) NOT NULL,
  `edit_id` int(11) NOT NULL,
  `delete_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mycol_deleted_posts`
--
ALTER TABLE `mycol_deleted_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mycol_edited_posts`
--
ALTER TABLE `mycol_edited_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mycol_posts`
--
ALTER TABLE `mycol_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mycol_deleted_posts`
--
ALTER TABLE `mycol_deleted_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mycol_edited_posts`
--
ALTER TABLE `mycol_edited_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mycol_posts`
--
ALTER TABLE `mycol_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
