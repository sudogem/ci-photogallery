-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2015 at 05:22 PM
-- Server version: 5.5.44-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.6



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: ci_photogallery
--


-- --------------------------------------------------------

--
-- Table structure for table album
--

CREATE TABLE IF NOT EXISTS album (
id integer NOT NULL,
  album_name varchar(255) NOT NULL,
  album_desc varchar(255) NOT NULL,
  created_at date NOT NULL,
  updated_at date NOT NULL
);

CREATE SEQUENCE album_id_seq;
ALTER TABLE album ALTER id SET DEFAULT NEXTVAL('album_id_seq');

--
-- Dumping data for table album
--

INSERT INTO album (id, album_name, album_desc, created_at, updated_at) VALUES
(20, 'album 1', 'album..', '2013-08-12 00:00:00', '2013-08-12 00:00:00'),
(21, 'album 2', 'another album', '2013-08-12 00:00:00', '2013-08-13 00:00:00'),
(26, 'album 3', 'album 3', '2013-08-15 00:00:00', '2015-08-15 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table album_users
--

CREATE TABLE IF NOT EXISTS album_users (
  user_id integer NOT NULL,
  album_id integer NOT NULL
) ;

--
-- Dumping data for table album_users
--

INSERT INTO album_users (user_id, album_id) VALUES
(1, 20),
(1, 21),
(1, 26);

-- --------------------------------------------------------

--
-- Table structure for table photo
--

CREATE TABLE IF NOT EXISTS photo (
id integer NOT NULL,
  title varchar(255) NOT NULL,
  filename varchar(255) NOT NULL,
  album_id integer NOT NULL,
  created_at date NOT NULL,
  updated_at date NOT NULL
);

CREATE SEQUENCE photo_id_seq;
ALTER TABLE photo ALTER id SET DEFAULT NEXTVAL('photo_id_seq');
--
-- Dumping data for table photo
--

INSERT INTO photo (id, title, filename, album_id, created_at, updated_at) VALUES
(54, 'pic 5', '970432_680260131988149_1272036275_n.jpg', 21, '2015-08-15 00:00:00', '2015-08-15 00:00:00'),
(50, 'pic 1', '73379_657616484262814_567567784_n.jpg', 20, '2015-08-12 00:00:00', '2015-08-12 00:00:00'),
(53, 'pic 4', '1480775_583436755045498_982223045_n.jpg', 21, '2015-08-12 00:00:00', '2015-08-12 00:00:00'),
(51, 'pic 2', 'xcute1.jpg', 26, '2015-08-12 00:00:00', '2015-08-15 00:00:00'),
(52, 'pic 3', '999291_333138583540347_3950188520053936407_n.jpg', 21, '2015-08-12 00:00:00', '2015-08-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table user
--

CREATE TYPE userlevel AS ENUM ('Administrator','Member');

CREATE TABLE IF NOT EXISTS users (
id integer NOT NULL,
  username varchar(255) NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  user_level userlevel,
  created_at date NOT NULL,
  updated_at date NOT NULL
);



--
-- Dumping data for table users
--

INSERT INTO users (id, username, first_name, last_name, password, user_level, created_at, updated_at) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'Administrator', '2013-03-09 17:33:54', '1999-01-08 04:05:06'),
(12, 'john', 'john', 'mc clane', 'john', 'Member', '2013-08-15 00:00:00', '2013-08-15 00:00:00'),
(10, 'ryan', 'ryan', 'pollock', 'ryan', 'Member', '2013-08-13 00:00:00', '2013-08-15 00:00:00'),
(11, 'ethan', 'ethan', 'hunt', 'ethan', 'Member', '2013-08-13 00:00:00', '2013-08-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table album
--
ALTER TABLE album
 ADD PRIMARY KEY (id);

--
-- Indexes for table album_users
--
ALTER TABLE album_users
 ADD PRIMARY KEY (user_id,album_id);

--
-- Indexes for table photo
--
ALTER TABLE photo
 ADD PRIMARY KEY (id);

--
-- Indexes for table user
--
ALTER TABLE users
 ADD PRIMARY KEY (id);
