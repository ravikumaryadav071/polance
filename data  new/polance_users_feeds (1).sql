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
-- Database: `polance_users_feeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `anil_feeds`
--

CREATE TABLE IF NOT EXISTS `anil_feeds` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '4',
  `sec_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `privacy` varchar(10) NOT NULL,
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anil_generate_feeds`
--

CREATE TABLE IF NOT EXISTS `anil_generate_feeds` (
  `id` int(11) NOT NULL,
  `generator_id` int(11) NOT NULL,
  `generator_type` varchar(20) NOT NULL,
  `new_feed_id` int(11) NOT NULL,
  `last_seen_id` int(11) NOT NULL DEFAULT '0',
  `pointer` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anil_generate_feeds`
--

INSERT INTO `anil_generate_feeds` (`id`, `generator_id`, `generator_type`, `new_feed_id`, `last_seen_id`, `pointer`, `last_updated`) VALUES
(1, 1, 'USER', 139, 139, 0, '2015-09-14 19:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `kapil_feeds`
--

CREATE TABLE IF NOT EXISTS `kapil_feeds` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '3',
  `sec_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `privacy` varchar(10) NOT NULL,
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_generate_feeds`
--

CREATE TABLE IF NOT EXISTS `kapil_generate_feeds` (
  `id` int(11) NOT NULL,
  `generator_id` int(11) NOT NULL,
  `generator_type` varchar(20) NOT NULL,
  `new_feed_id` int(11) NOT NULL,
  `last_seen_id` int(11) NOT NULL DEFAULT '0',
  `pointer` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_feeds`
--

CREATE TABLE IF NOT EXISTS `rahul_feeds` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '2',
  `sec_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `privacy` varchar(10) NOT NULL,
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rahul_feeds`
--

INSERT INTO `rahul_feeds` (`id`, `userid`, `sec_id`, `post_id`, `post_type`, `privacy`, `action`, `date`) VALUES
(1, 1, 0, 26, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 12:54:50'),
(2, 1, 0, 26, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-12 13:19:01'),
(3, 1, 0, 26, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 13:19:04'),
(4, 1, 0, 26, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 13:19:16'),
(5, 1, 0, 26, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 13:21:44'),
(6, 1, 0, 26, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 13:21:47'),
(7, 1, 0, 26, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 13:21:51'),
(8, 1, 0, 26, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 13:21:53'),
(9, 1, 0, 26, 'USER', 'FOLLOWERS', 'REPORTED', '2015-09-12 13:21:56'),
(10, 1, 0, 26, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 13:22:45'),
(11, 1, 0, 26, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 13:23:01'),
(12, 1, 0, 26, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 13:28:28'),
(13, 1, 0, 26, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 13:29:12'),
(14, 1, 0, 26, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 13:29:53'),
(15, 1, 0, 26, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 13:31:12'),
(16, 1, 0, 26, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 13:31:16'),
(17, 1, 0, 26, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 13:31:23'),
(18, 1, 0, 26, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 13:31:31'),
(19, 1, 0, 25, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-13 13:16:52'),
(20, 1, 0, 20, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 14:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `rahul_generate_feeds`
--

CREATE TABLE IF NOT EXISTS `rahul_generate_feeds` (
  `id` int(11) NOT NULL,
  `generator_id` int(11) NOT NULL,
  `generator_type` varchar(20) NOT NULL,
  `new_feed_id` int(11) NOT NULL,
  `last_seen_id` int(11) NOT NULL DEFAULT '0',
  `pointer` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rahul_generate_feeds`
--

INSERT INTO `rahul_generate_feeds` (`id`, `generator_id`, `generator_type`, `new_feed_id`, `last_seen_id`, `pointer`, `last_updated`) VALUES
(1, 2, 'USER', 131, 20, 20, '2015-09-14 13:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `ravi_feeds`
--

CREATE TABLE IF NOT EXISTS `ravi_feeds` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '1',
  `sec_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `post_type` varchar(20) NOT NULL DEFAULT 'USER',
  `privacy` varchar(10) NOT NULL,
  `action` varchar(30) NOT NULL DEFAULT 'UPLOADED',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_feeds`
--

INSERT INTO `ravi_feeds` (`id`, `userid`, `sec_id`, `post_id`, `post_type`, `privacy`, `action`, `date`) VALUES
(16, 1, 0, 16, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 13:01:37'),
(17, 1, 0, 17, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 18:57:56'),
(18, 1, 0, 18, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:10:27'),
(19, 1, 0, 19, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:11:12'),
(20, 1, 0, 20, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:13:11'),
(21, 1, 0, 21, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:15:39'),
(22, 1, 0, 22, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:24:19'),
(23, 1, 0, 23, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:37:58'),
(24, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-11 19:38:17'),
(25, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:20:27'),
(26, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:21:09'),
(27, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:21:20'),
(28, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:22:55'),
(29, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:23:55'),
(30, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:24:41'),
(31, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:35:50'),
(32, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:40:36'),
(33, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:40:38'),
(34, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-11 20:40:39'),
(35, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-11 20:40:45'),
(36, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:40:46'),
(37, 1, 0, 23, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:42:30'),
(38, 1, 0, 23, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:42:31'),
(39, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:42:31'),
(40, 1, 0, 23, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-11 20:42:32'),
(41, 1, 0, 23, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:42:37'),
(42, 1, 0, 23, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:42:37'),
(43, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:42:38'),
(44, 1, 0, 23, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-11 20:42:38'),
(45, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:42:46'),
(46, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:42:47'),
(47, 1, 0, 23, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:44:12'),
(48, 1, 0, 23, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:44:14'),
(49, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:45:48'),
(50, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:46:21'),
(51, 1, 0, 23, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:49:56'),
(52, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:51:34'),
(53, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-11 20:51:41'),
(54, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:51:45'),
(55, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:51:51'),
(56, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:54:02'),
(57, 1, 0, 23, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 20:54:07'),
(58, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:55:41'),
(59, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:55:47'),
(60, 1, 0, 23, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-11 20:59:23'),
(63, 1, 0, 16, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 21:01:04'),
(64, 1, 0, 16, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-11 21:01:05'),
(65, 1, 0, 16, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 21:01:10'),
(66, 1, 0, 16, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 21:01:13'),
(67, 1, 0, 16, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-11 21:01:16'),
(68, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:25:09'),
(69, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:26:32'),
(70, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:26:36'),
(71, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:26:46'),
(72, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:26:47'),
(73, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:26:52'),
(74, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:26:53'),
(75, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:26:54'),
(76, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:26:55'),
(77, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:29:14'),
(78, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:29:16'),
(79, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:29:17'),
(80, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:29:18'),
(81, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:29:20'),
(82, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:29:20'),
(83, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:29:21'),
(84, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 06:29:23'),
(85, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:31:09'),
(86, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:33:41'),
(87, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:33:41'),
(88, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:33:46'),
(89, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 06:33:47'),
(90, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 06:33:49'),
(91, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:35:37'),
(92, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:36:24'),
(93, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:36:34'),
(94, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:36:41'),
(95, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:36:43'),
(96, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:36:52'),
(97, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:36:55'),
(98, 1, 0, 24, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-12 06:40:08'),
(99, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:40:09'),
(100, 1, 0, 24, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-12 06:40:12'),
(101, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 06:40:15'),
(102, 1, 0, 24, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-12 06:40:17'),
(103, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:40:18'),
(104, 1, 0, 24, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-12 06:40:23'),
(105, 1, 0, 25, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-12 07:02:04'),
(106, 1, 0, 25, 'USER', 'FOLLOWERS', 'REPORTED', '2015-09-12 07:15:55'),
(107, 1, 0, 25, 'USER', 'FOLLOWERS', 'REPORTED', '2015-09-12 07:16:02'),
(108, 1, 0, 26, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-12 07:19:31'),
(109, 1, 0, 26, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-12 10:24:05'),
(110, 1, 0, 26, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-12 10:32:07'),
(111, 1, 0, 26, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-12 10:35:30'),
(112, 1, 0, 26, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-12 13:15:08'),
(113, 1, 0, 26, 'USER', 'FOLLOWERS', 'REPORTED', '2015-09-12 13:22:25'),
(114, 1, 0, 26, 'USER', 'FOLLOWERS', 'REPORTED', '2015-09-12 13:22:34'),
(116, 1, 0, 26, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 12:58:24'),
(117, 1, 0, 25, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 12:58:49'),
(118, 1, 0, 22, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 13:00:34'),
(119, 1, 0, 23, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 13:02:24'),
(120, 1, 0, 21, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 13:05:27'),
(121, 1, 0, 18, 'USER', 'FOLLOWERS', 'UPVOTED', '2015-09-13 13:07:57'),
(123, 1, 0, 16, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-14 12:42:32'),
(124, 1, 0, 16, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-14 12:42:33'),
(126, 1, 0, 16, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-14 12:42:43'),
(128, 1, 0, 25, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-14 12:51:31'),
(129, 1, 0, 26, 'USER', 'FOLLOWERS', 'SHARED', '2015-09-14 12:56:00'),
(130, 1, 0, 25, 'USER', 'FOLLOWERS', 'DOWNVOTED', '2015-09-14 12:56:07'),
(131, 1, 0, 16, 'USER', 'FOLLOWERS', 'VARIFIED', '2015-09-14 13:25:59'),
(132, 1, 0, 25, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-14 13:41:29'),
(133, 1, 0, 25, 'USER', 'FOLLOWERS', 'COMMENTED', '2015-09-14 15:18:13'),
(134, 1, 0, 27, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-14 18:40:04'),
(135, 1, 0, 28, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-14 18:41:01'),
(136, 1, 0, 29, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-14 18:45:22'),
(137, 1, 0, 30, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-14 18:45:45'),
(138, 1, 0, 31, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-14 18:46:40'),
(139, 1, 0, 32, 'USER', 'FOLLOWERS', 'UPLOADED', '2015-09-14 19:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `ravi_generate_feeds`
--

CREATE TABLE IF NOT EXISTS `ravi_generate_feeds` (
  `id` int(11) NOT NULL,
  `generator_id` int(11) NOT NULL,
  `generator_type` varchar(20) NOT NULL,
  `new_feed_id` int(11) NOT NULL,
  `last_seen_id` int(11) NOT NULL DEFAULT '0',
  `pointer` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_generate_feeds`
--

INSERT INTO `ravi_generate_feeds` (`id`, `generator_id`, `generator_type`, `new_feed_id`, `last_seen_id`, `pointer`, `last_updated`) VALUES
(1, 1, 'USER', 139, 139, 120, '2015-09-13 13:05:27'),
(2, 2, 'USER', 20, 20, 1, '2015-09-12 12:54:50'),
(8, 1, 'COLLABORATION', 0, 0, 0, '2015-09-13 20:19:18'),
(9, 3, 'USER', 0, 0, 0, '2015-09-13 10:09:50'),
(12, 4, 'USER', 0, 0, 0, '2015-09-13 10:10:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anil_feeds`
--
ALTER TABLE `anil_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anil_generate_feeds`
--
ALTER TABLE `anil_generate_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_feeds`
--
ALTER TABLE `kapil_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kapil_generate_feeds`
--
ALTER TABLE `kapil_generate_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_feeds`
--
ALTER TABLE `rahul_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rahul_generate_feeds`
--
ALTER TABLE `rahul_generate_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_feeds`
--
ALTER TABLE `ravi_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ravi_generate_feeds`
--
ALTER TABLE `ravi_generate_feeds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anil_feeds`
--
ALTER TABLE `anil_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anil_generate_feeds`
--
ALTER TABLE `anil_generate_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kapil_feeds`
--
ALTER TABLE `kapil_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kapil_generate_feeds`
--
ALTER TABLE `kapil_generate_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rahul_feeds`
--
ALTER TABLE `rahul_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `rahul_generate_feeds`
--
ALTER TABLE `rahul_generate_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ravi_feeds`
--
ALTER TABLE `ravi_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `ravi_generate_feeds`
--
ALTER TABLE `ravi_generate_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
