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
-- Database: `polance_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_a`
--

CREATE TABLE IF NOT EXISTS `interests_domain_a` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_b`
--

CREATE TABLE IF NOT EXISTS `interests_domain_b` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_c`
--

CREATE TABLE IF NOT EXISTS `interests_domain_c` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_c`
--

INSERT INTO `interests_domain_c` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'Cricket', 'Cricket', 8, 1),
(2, 'Cricket League', 'CricketLeague', 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_d`
--

CREATE TABLE IF NOT EXISTS `interests_domain_d` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_e`
--

CREATE TABLE IF NOT EXISTS `interests_domain_e` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_f`
--

CREATE TABLE IF NOT EXISTS `interests_domain_f` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_f`
--

INSERT INTO `interests_domain_f` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'FaceBook', 'FaceBook', 1, 5),
(2, 'FaceBook', 'FaceBook', 3, 2),
(3, 'FaceBook', 'FaceBook', 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_g`
--

CREATE TABLE IF NOT EXISTS `interests_domain_g` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_h`
--

CREATE TABLE IF NOT EXISTS `interests_domain_h` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_i`
--

CREATE TABLE IF NOT EXISTS `interests_domain_i` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_i`
--

INSERT INTO `interests_domain_i` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(2, 'IPL', 'IPL', 8, 8),
(3, 'IPL', 'IPL', 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_j`
--

CREATE TABLE IF NOT EXISTS `interests_domain_j` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_k`
--

CREATE TABLE IF NOT EXISTS `interests_domain_k` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_k`
--

INSERT INTO `interests_domain_k` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'Kabaddi', 'Kabaddi', 8, 2),
(2, 'kuch bhi', 'kuchbhi', 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_l`
--

CREATE TABLE IF NOT EXISTS `interests_domain_l` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_m`
--

CREATE TABLE IF NOT EXISTS `interests_domain_m` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_m`
--

INSERT INTO `interests_domain_m` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'My Sql', 'MySql', 3, 1),
(2, 'Modi', 'Modi', 7, 1),
(3, 'Modia', 'Modia', 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_n`
--

CREATE TABLE IF NOT EXISTS `interests_domain_n` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_o`
--

CREATE TABLE IF NOT EXISTS `interests_domain_o` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_p`
--

CREATE TABLE IF NOT EXISTS `interests_domain_p` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_p`
--

INSERT INTO `interests_domain_p` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'page', 'page', 1, 6),
(2, 'page', 'page', 3, 3),
(3, 'polance', 'polance', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_q`
--

CREATE TABLE IF NOT EXISTS `interests_domain_q` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_q`
--

INSERT INTO `interests_domain_q` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'quora', 'quora', 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_r`
--

CREATE TABLE IF NOT EXISTS `interests_domain_r` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_r`
--

INSERT INTO `interests_domain_r` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'Rajasthan Royals', 'RajasthanRoyals', 8, 11),
(2, 'Rajasthan Royals', 'RajasthanRoyals', 8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_s`
--

CREATE TABLE IF NOT EXISTS `interests_domain_s` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_s`
--

INSERT INTO `interests_domain_s` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'Sachin', 'Sachin', 8, 13),
(2, 'sachin', 'sachin', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_t`
--

CREATE TABLE IF NOT EXISTS `interests_domain_t` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_u`
--

CREATE TABLE IF NOT EXISTS `interests_domain_u` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_v`
--

CREATE TABLE IF NOT EXISTS `interests_domain_v` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_w`
--

CREATE TABLE IF NOT EXISTS `interests_domain_w` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interests_domain_w`
--

INSERT INTO `interests_domain_w` (`id`, `name`, `unique_name`, `db_id`, `id_in_db`) VALUES
(1, 'wwdwd', 'wwdwd', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_x`
--

CREATE TABLE IF NOT EXISTS `interests_domain_x` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_y`
--

CREATE TABLE IF NOT EXISTS `interests_domain_y` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `interests_domain_z`
--

CREATE TABLE IF NOT EXISTS `interests_domain_z` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `unique_name` varchar(60) NOT NULL,
  `db_id` int(11) NOT NULL,
  `id_in_db` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `main_interests_domain`
--

CREATE TABLE IF NOT EXISTS `main_interests_domain` (
  `name` varchar(60) NOT NULL,
  `db_name` varchar(60) NOT NULL,
  `interests_table` varchar(60) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_interests_domain`
--

INSERT INTO `main_interests_domain` (`name`, `db_name`, `interests_table`, `id`) VALUES
('Business', 'interests_business', 'all_business_interests', 1),
('Corporate World', 'interests_corporate_world', 'all_corporate_world_interests', 2),
('Education', 'interests_education', 'all_education_interests', 3),
('Finance', 'interests_finance', 'all_finance_interests', 4),
('Philosophy ', 'interests_philosophy', 'all_philosophy_interests', 5),
('Politics', 'interests_politics', 'all_politics_interests', 6),
('Social', 'interests_social', 'all_social_interests', 7),
('Sports', 'interests_sports', 'all_sports_interests', 8);

-- --------------------------------------------------------

--
-- Table structure for table `otp_table`
--

CREATE TABLE IF NOT EXISTS `otp_table` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `otp` varchar(64) NOT NULL,
  `otp_pf` varchar(64) NOT NULL,
  `passed` varchar(5) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_ip`
--

CREATE TABLE IF NOT EXISTS `users_ip` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ip_address` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `interests_domain_a`
--
ALTER TABLE `interests_domain_a`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_b`
--
ALTER TABLE `interests_domain_b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_c`
--
ALTER TABLE `interests_domain_c`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_d`
--
ALTER TABLE `interests_domain_d`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_e`
--
ALTER TABLE `interests_domain_e`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_f`
--
ALTER TABLE `interests_domain_f`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_g`
--
ALTER TABLE `interests_domain_g`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_h`
--
ALTER TABLE `interests_domain_h`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_i`
--
ALTER TABLE `interests_domain_i`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_j`
--
ALTER TABLE `interests_domain_j`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_k`
--
ALTER TABLE `interests_domain_k`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_l`
--
ALTER TABLE `interests_domain_l`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_m`
--
ALTER TABLE `interests_domain_m`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_n`
--
ALTER TABLE `interests_domain_n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_o`
--
ALTER TABLE `interests_domain_o`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_p`
--
ALTER TABLE `interests_domain_p`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_q`
--
ALTER TABLE `interests_domain_q`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_r`
--
ALTER TABLE `interests_domain_r`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_s`
--
ALTER TABLE `interests_domain_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_t`
--
ALTER TABLE `interests_domain_t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_u`
--
ALTER TABLE `interests_domain_u`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_v`
--
ALTER TABLE `interests_domain_v`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_w`
--
ALTER TABLE `interests_domain_w`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_x`
--
ALTER TABLE `interests_domain_x`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_y`
--
ALTER TABLE `interests_domain_y`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests_domain_z`
--
ALTER TABLE `interests_domain_z`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_interests_domain`
--
ALTER TABLE `main_interests_domain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `otp_table`
--
ALTER TABLE `otp_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_ip`
--
ALTER TABLE `users_ip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interests_domain_a`
--
ALTER TABLE `interests_domain_a`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_b`
--
ALTER TABLE `interests_domain_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_c`
--
ALTER TABLE `interests_domain_c`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interests_domain_d`
--
ALTER TABLE `interests_domain_d`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_e`
--
ALTER TABLE `interests_domain_e`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_f`
--
ALTER TABLE `interests_domain_f`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `interests_domain_g`
--
ALTER TABLE `interests_domain_g`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_h`
--
ALTER TABLE `interests_domain_h`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_i`
--
ALTER TABLE `interests_domain_i`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `interests_domain_j`
--
ALTER TABLE `interests_domain_j`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_k`
--
ALTER TABLE `interests_domain_k`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interests_domain_l`
--
ALTER TABLE `interests_domain_l`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_m`
--
ALTER TABLE `interests_domain_m`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `interests_domain_n`
--
ALTER TABLE `interests_domain_n`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_o`
--
ALTER TABLE `interests_domain_o`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_p`
--
ALTER TABLE `interests_domain_p`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `interests_domain_q`
--
ALTER TABLE `interests_domain_q`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `interests_domain_r`
--
ALTER TABLE `interests_domain_r`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interests_domain_s`
--
ALTER TABLE `interests_domain_s`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interests_domain_t`
--
ALTER TABLE `interests_domain_t`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_u`
--
ALTER TABLE `interests_domain_u`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_v`
--
ALTER TABLE `interests_domain_v`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_w`
--
ALTER TABLE `interests_domain_w`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `interests_domain_x`
--
ALTER TABLE `interests_domain_x`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_y`
--
ALTER TABLE `interests_domain_y`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interests_domain_z`
--
ALTER TABLE `interests_domain_z`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `main_interests_domain`
--
ALTER TABLE `main_interests_domain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `otp_table`
--
ALTER TABLE `otp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_ip`
--
ALTER TABLE `users_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
