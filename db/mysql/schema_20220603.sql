-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jun 03, 2022 at 03:35 PM
-- Server version: 5.5.62
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_photogallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `album_name` varchar(255) NOT NULL,
  `album_desc` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `album_name`, `album_desc`, `created_at`, `updated_at`) VALUES
(20, 'album 1', 'album..', '2013-08-12 00:00:00', '2013-08-12 00:00:00'),
(21, 'album 2', 'another album', '2013-08-12 00:00:00', '2013-08-13 00:00:00'),
(26, 'album 3', 'album 3', '2013-08-15 00:00:00', '2015-08-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `album_users`
--

CREATE TABLE `album_users` (
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album_users`
--

INSERT INTO `album_users` (`user_id`, `album_id`) VALUES
(1, 20),
(1, 21),
(1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `title`, `filename`, `album_id`, `created_at`, `updated_at`) VALUES
(54, 'pic 5', '150607796_787975885403936_6258443596926614986_n.jpg', 21, '2015-08-15 00:00:00', '2022-06-03 00:00:00'),
(50, 'pic 1', '272203896_985376255663897_3924882017659559611_n.jpg', 20, '2015-08-12 00:00:00', '2022-06-03 00:00:00'),
(53, 'pic 4', '272194143_985376228997233_5306176074456526303_n.jpg', 21, '2015-08-12 00:00:00', '2022-06-03 00:00:00'),
(51, 'pic 2', '272148536_985387545662768_7969323036771517438_n.jpg', 26, '2015-08-12 00:00:00', '2022-06-03 00:00:00'),
(52, 'pic 3', '999291_333138583540347_3950188520053936407_n.jpg', 21, '2015-08-12 00:00:00', '2015-08-12 00:00:00'),
(55, 'pic 6', '165204890_804746683726856_1103332954271553646_n.jpg', 20, '2022-06-03 00:00:00', '2022-06-03 00:00:00'),
(56, 'pic 7', '253826722_939367846931405_2546305504649104661_n.jpg', 26, '2022-06-03 00:00:00', '2022-06-03 00:00:00'),
(57, 'pic 8', '258869621_947776022757254_88767297408732204_n.jpg', 20, '2022-06-03 00:00:00', '2022-06-03 00:00:00'),
(58, 'pic 9', '254556932_939304723604384_8744906849424584413_n.jpg', 26, '2022-06-03 00:00:00', '2022-06-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` enum('Administrator','Member') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `first_name`, `last_name`, `password`, `user_level`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'Administrator', '2013-03-09 17:33:54', '0000-00-00 00:00:00'),
(12, 'john', 'john', 'mc clane', 'john', 'Member', '2013-08-15 00:00:00', '2013-08-15 00:00:00'),
(10, 'ryan', 'ryan', 'pollock', 'ryan', 'Member', '2013-08-13 00:00:00', '2013-08-15 00:00:00'),
(11, 'ethan', 'ethan', 'hunt', 'ethan', 'Member', '2013-08-13 00:00:00', '2013-08-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_users`
--
ALTER TABLE `album_users`
  ADD PRIMARY KEY (`user_id`,`album_id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
