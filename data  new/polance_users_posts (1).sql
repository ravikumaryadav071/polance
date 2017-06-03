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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anil_posts`
--

CREATE TABLE IF NOT EXISTS `anil_posts` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kapil_posts`
--

CREATE TABLE IF NOT EXISTS `kapil_posts` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rahul_posts`
--

CREATE TABLE IF NOT EXISTS `rahul_posts` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ravi_posts`
--

CREATE TABLE IF NOT EXISTS `ravi_posts` (
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ravi_posts`
--

INSERT INTO `ravi_posts` (`id`, `text_content`, `file_type`, `extention`, `files`, `contributors`, `refs`, `interest_tags`, `privacy`, `suggested_tags`, `tot_upvotes`, `tot_downvotes`, `tot_comments`, `tot_shares`, `tot_varify`, `tot_reports`, `edit_id`, `delete_id`, `date`) VALUES
(1, 'wgdw duwd uhw', '', 'TEXT', '', '', '', 'page,page', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 11:49:14'),
(2, '<file>gwydywgdywgdywd', 'image/jpeg,', 'Array,', 'posts/r/raviFallout_New_Vegas_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,', '', '', 'IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 11:57:03'),
(3, '<file>gwydywgdywgdywd', 'image/jpeg,', 'jpg,', 'posts/r/raviFallout_New_Vegas_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,', '', '', 'IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 11:57:45'),
(4, 'gwugduwgdwduwdguwd', '', 'TEXT', '', ' 2,', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 11:59:32'),
(5, 'gwugduwgdwduwdguwd', '', 'TEXT', '', '', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:00:38'),
(6, 'gwugduwgdwduwdguwd', '', 'TEXT', '', '', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:01:01'),
(7, 'gwugduwgdwduwdguwd', '', 'TEXT', '', '', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:01:36'),
(8, 'gwugduwgdwduwdguwd', '', 'TEXT', '', '', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:02:36'),
(9, 'gwugduwgdwduwdguwd', '', 'TEXT', '', '', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:03:09'),
(10, 'gwugduwgdwduwdguwd', '', 'TEXT', '', '', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:03:34'),
(11, 'gwugduwgdwduwdguwd', '', 'TEXT', '', ' 2,', 'uwhduwd,65e2998598', 'IPL,IPL', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:04:53'),
(12, 'gwugduwgdwduwdguwd', '', 'TEXT', '', ' 2,', 'uwhduwd,65e2998598', '(Array->Array)(Array->Array)', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:10:50'),
(13, 'gwugduwgdwduwdguwd', '', 'TEXT', '', ' 2,', 'uwhduwd,65e2998598', '(8->8),(10->8)', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:11:33'),
(14, 'gwugduwgdwduwdguwd', '', 'TEXT', '', ' 2,', 'uwhduwd,65e2998598', '(8->8),(10->8)', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:20:28'),
(15, 'gwugduwgdwduwdguwd', '', 'TEXT', '', ' 2,', 'uwhduwd,65e2998598', '(8->8),(10->8)', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 12:28:51'),
(16, 'karkar<file>', 'image/jpeg,', 'jpg,', 'posts/r/ravi/Fallout_New_Vegas_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,', '', '', '(1->7)', 'FOLLOWERS', '', 1, 1, 0, 2, 2, 0, 0, 0, '2015-09-11 13:01:37'),
(17, 'gyhgyyugyugyugyhgyyugyugyu <file> ', 'image/jpeg,', 'jpg,', 'posts/r/ravi/Sims_3_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,', ' 2,', 'herewego.in,thisismyrefe.com', '(6->1),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 18:57:56'),
(18, 'uwduw duwuwduw duw <file> dwjdijwidw', 'image/jpeg,', 'jpg,', 'posts/r/ravi/Sims_3_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,', '', '', '(2->7),', 'FOLLOWERS', '', 1, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 19:10:27'),
(19, ' <file> ', 'image/jpeg,image/jpeg,', 'jpg,jpg,', 'posts/r/ravi/Fallout_New_Vegas_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,posts/r/ravi/Sims_3_1680x1050widescreen.jpg_kapil_1.jpg_ravi_1.jpg,', '', '', '(1->3),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 19:11:12'),
(20, '', '', '', '', '', '', '(1->8),', 'FOLLOWERS', '', 1, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 19:13:11'),
(21, ' <file> ', '', '', '', '', '', '(1->7),', 'FOLLOWERS', '', 1, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 19:15:39'),
(22, '<file>', 'application/octet-stream', 'flv', 'posts/r/ravi/JavaProgrammingTutorial-2-RunningaJavaProgram.flv_ravi_1.flv', '', '', '(1->3),', 'FOLLOWERS', '', 1, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 19:24:19'),
(23, ' <file> ', 'application/pdf,application/pdf', 'pdf,pdf', 'posts/r/ravi/HtmlXhtmlAndCssBible3rdEdition.pdf_ravi_1.pdf,posts/r/ravi/9f6f6a37dee868409560446db64d351dca0ec8fcc683077f070345f8a99197a8_ravi_1.pdf', '', '', '(1->3),', 'FOLLOWERS', '', 1, 0, 0, 0, 0, 0, 0, 0, '2015-09-11 19:37:58'),
(24, ' <file> ', 'application/pdf,application/pdf', 'pdf,pdf', 'posts/r/ravi/HtmlXhtmlAndCssBible3rdEdition.pdf_ravi_1.pdf,posts/r/ravi/82442138b3e670531379424e33f5a4d3f6d5049b9e92562169e32f6c2cd44795_ravi_1.pdf', '', '', '(1->3),', 'FOLLOWERS', '', 1, 0, 0, 1, 1, 0, 0, 0, '2015-09-11 19:38:17'),
(25, 'watch this', 'video/mp4', 'mp4', 'posts/r/ravi/a60d7db93a44c306065147b2dee1b01d013121ba3d7e7f9c0479e823e445bba7_ravi_1.mp4', '', '', '(1->3),', 'FOLLOWERS', '', 1, 1, 2, 2, 0, -2, 0, 0, '2015-09-12 07:02:04'),
(26, 'here we gohere we go <file> ', 'video/mp4,video/mp4', 'mp4,mp4', 'posts/r/ravi/05-TheTooltipWidget.mp4_ravi_1.mp4,posts/r/ravi/05-TheTooltipWidget.mp4_ravi_1.mp4', '', '', '(1->7),(8->8),', 'FOLLOWERS', '', 2, 1, 5, 2, 1, -2, 0, 0, '2015-09-12 07:19:31'),
(27, 'got it', '', 'TEXT', '', '', '', '(4->7),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-14 18:40:04'),
(28, 'got it', '', 'TEXT', '', '', '', '(4->7),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-14 18:41:01'),
(29, 'now', '', 'TEXT', '', '', '', '(10->8),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-14 18:45:22'),
(30, 'now', '', 'TEXT', '', '', '', '(10->8),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-14 18:45:45'),
(31, 'now', '', 'TEXT', '', '', '', '(10->8),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-14 18:46:40'),
(32, 'here i am', '', 'TEXT', '', '', '', '(8->8),', 'FOLLOWERS', '', 0, 0, 0, 0, 0, 0, 0, 0, '2015-09-14 19:40:58');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
