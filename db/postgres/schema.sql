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

-- --------------------------------------------------------
--
-- Table structure for table album_users
--

CREATE TABLE IF NOT EXISTS album_users (
  user_id integer NOT NULL,
  album_id integer NOT NULL
) ;

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
