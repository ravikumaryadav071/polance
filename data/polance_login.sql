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
-- Database: `polance_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'standared user', ''),
(2, 'Administrator', '{"admin":1}');

-- --------------------------------------------------------

--
-- Table structure for table `name_a`
--

CREATE TABLE IF NOT EXISTS `name_a` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `name_a`
--

INSERT INTO `name_a` (`userid`, `name`) VALUES
(4, 'anil');

-- --------------------------------------------------------

--
-- Table structure for table `name_b`
--

CREATE TABLE IF NOT EXISTS `name_b` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_c`
--

CREATE TABLE IF NOT EXISTS `name_c` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_d`
--

CREATE TABLE IF NOT EXISTS `name_d` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_e`
--

CREATE TABLE IF NOT EXISTS `name_e` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_f`
--

CREATE TABLE IF NOT EXISTS `name_f` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_g`
--

CREATE TABLE IF NOT EXISTS `name_g` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_h`
--

CREATE TABLE IF NOT EXISTS `name_h` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_i`
--

CREATE TABLE IF NOT EXISTS `name_i` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_j`
--

CREATE TABLE IF NOT EXISTS `name_j` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_k`
--

CREATE TABLE IF NOT EXISTS `name_k` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `name_k`
--

INSERT INTO `name_k` (`userid`, `name`) VALUES
(3, 'kapil');

-- --------------------------------------------------------

--
-- Table structure for table `name_l`
--

CREATE TABLE IF NOT EXISTS `name_l` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_m`
--

CREATE TABLE IF NOT EXISTS `name_m` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_n`
--

CREATE TABLE IF NOT EXISTS `name_n` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_o`
--

CREATE TABLE IF NOT EXISTS `name_o` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_p`
--

CREATE TABLE IF NOT EXISTS `name_p` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_q`
--

CREATE TABLE IF NOT EXISTS `name_q` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_r`
--

CREATE TABLE IF NOT EXISTS `name_r` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `name_r`
--

INSERT INTO `name_r` (`userid`, `name`) VALUES
(1, 'ravi'),
(2, 'rahul');

-- --------------------------------------------------------

--
-- Table structure for table `name_s`
--

CREATE TABLE IF NOT EXISTS `name_s` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_t`
--

CREATE TABLE IF NOT EXISTS `name_t` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_u`
--

CREATE TABLE IF NOT EXISTS `name_u` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_v`
--

CREATE TABLE IF NOT EXISTS `name_v` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_w`
--

CREATE TABLE IF NOT EXISTS `name_w` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_x`
--

CREATE TABLE IF NOT EXISTS `name_x` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_y`
--

CREATE TABLE IF NOT EXISTS `name_y` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `name_z`
--

CREATE TABLE IF NOT EXISTS `name_z` (
  `userid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usernames`
--

CREATE TABLE IF NOT EXISTS `usernames` (
  `username` varchar(40) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usernames`
--

INSERT INTO `usernames` (`username`, `userid`) VALUES
('anil', 4),
('kapil', 3),
('rahul', 2),
('ravi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `profile_pic` varchar(300) NOT NULL,
  `profile_pic_dg` varchar(300) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `salt`, `name`, `contact_no`, `profile_pic`, `profile_pic_dg`, `joined`, `group`) VALUES
(1, 'ravi', 'ravi', '74b94e6de3c1f24f2e07e8753783a892338ad7b95f78b448cabc3cde94899b23', '>´uýdÏ©tUf‹Ngí\rÿ~”?à„uóÂ¨TFl“', 'ravi', '1234564564', 'images/profile_pic/ff2dcc4476566c8afd313642a72ba63c7607af282d58c20df2aac61152755f39_ravi.jpg', 'images/profile_pic_dg/ff2dcc4476566c8afd313642a72ba63c7607af282d58c20df2aac61152755f39_ravi.jpg', '2015-09-08 02:38:55', 1),
(2, 'rahul', 'rahul', '8325e5f13fffeb8a5a1c2b768e74291d33f874e84f8ef695975abff3b42bd5f9', '°¶˜•9¹swá„ãš*)|¬¶½Ð>|ßmƒp—ez', 'rahul', '4512365478', '', '', '2015-09-08 02:39:30', 1),
(3, 'kapil', 'kapil', 'dce1824d87f7f550c1a37fcf8402de812f0f95919ef95fb8d4e0ccabd5a88472', 'sâƒýÈ/½ñª³]sÉEæ&¸)Ý‚\rìn±OÊV', 'kapil', '1245789632', '', '', '2015-09-08 02:40:10', 1),
(4, 'anil', 'anil', 'd753e4417a8ab7092de6a6a78097e08980a3391986c1b21e2d736a733a440141', '¤åŸô$ËñËÈ’à‘QÁ¾^È,õîT¦Žw²U¦ü', 'anil', '89746362115', '', '', '2015-09-08 02:40:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE IF NOT EXISTS `users_session` (
`id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `name_a`
--
ALTER TABLE `name_a`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_b`
--
ALTER TABLE `name_b`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_c`
--
ALTER TABLE `name_c`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_d`
--
ALTER TABLE `name_d`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_e`
--
ALTER TABLE `name_e`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_f`
--
ALTER TABLE `name_f`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_g`
--
ALTER TABLE `name_g`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_h`
--
ALTER TABLE `name_h`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_i`
--
ALTER TABLE `name_i`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_j`
--
ALTER TABLE `name_j`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_k`
--
ALTER TABLE `name_k`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_l`
--
ALTER TABLE `name_l`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_m`
--
ALTER TABLE `name_m`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_n`
--
ALTER TABLE `name_n`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_o`
--
ALTER TABLE `name_o`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_p`
--
ALTER TABLE `name_p`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_q`
--
ALTER TABLE `name_q`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_r`
--
ALTER TABLE `name_r`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_s`
--
ALTER TABLE `name_s`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_t`
--
ALTER TABLE `name_t`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_u`
--
ALTER TABLE `name_u`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_v`
--
ALTER TABLE `name_v`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_w`
--
ALTER TABLE `name_w`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_x`
--
ALTER TABLE `name_x`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_y`
--
ALTER TABLE `name_y`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `name_z`
--
ALTER TABLE `name_z`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `usernames`
--
ALTER TABLE `usernames`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
