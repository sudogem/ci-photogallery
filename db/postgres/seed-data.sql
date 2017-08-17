
--
-- Dumping data for table album
--

INSERT INTO album (id, album_name, album_desc, created_at, updated_at) VALUES
(20, 'album 1', 'album..', '2013-08-12 00:00:00', '2013-08-12 00:00:00'),
(21, 'album 2', 'another album', '2013-08-12 00:00:00', '2013-08-13 00:00:00'),
(26, 'album 3', 'album 3', '2013-08-15 00:00:00', '2015-08-15 00:00:00');


--
-- Dumping data for table album_users
--

INSERT INTO album_users (user_id, album_id) VALUES
(1, 20),
(1, 21),
(1, 26);


--
-- Dumping data for table photo
--

INSERT INTO photo (id, title, filename, album_id, created_at, updated_at) VALUES
(54, 'pic 5', '970432_680260131988149_1272036275_n.jpg', 21, '2015-08-15 00:00:00', '2015-08-15 00:00:00'),
(50, 'pic 1', '73379_657616484262814_567567784_n.jpg', 20, '2015-08-12 00:00:00', '2015-08-12 00:00:00'),
(53, 'pic 4', '1480775_583436755045498_982223045_n.jpg', 21, '2015-08-12 00:00:00', '2015-08-12 00:00:00'),
(51, 'pic 2', 'xcute1.jpg', 26, '2015-08-12 00:00:00', '2015-08-15 00:00:00'),
(52, 'pic 3', '999291_333138583540347_3950188520053936407_n.jpg', 21, '2015-08-12 00:00:00', '2015-08-12 00:00:00');


--
-- Dumping data for table users
--

INSERT INTO users (id, username, first_name, last_name, password, user_level, created_at, updated_at) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'Administrator', '2013-03-09 17:33:54', '1999-01-08 04:05:06'),
(12, 'john', 'john', 'mc clane', 'john', 'Member', '2013-08-15 00:00:00', '2013-08-15 00:00:00'),
(10, 'ryan', 'ryan', 'pollock', 'ryan', 'Member', '2013-08-13 00:00:00', '2013-08-15 00:00:00'),
(11, 'ethan', 'ethan', 'hunt', 'ethan', 'Member', '2013-08-13 00:00:00', '2013-08-15 00:00:00');
