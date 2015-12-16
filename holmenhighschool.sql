-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2015 at 04:27 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `holmenhighschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventparticipation`
--

CREATE TABLE IF NOT EXISTS `eventparticipation` (
  `id` int(11) NOT NULL,
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `type` varchar(1) NOT NULL COMMENT '''V'' or ''S'' for type of user signed up'
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `eventparticipation`
--

INSERT INTO `eventparticipation` (`id`, `eventId`, `userId`, `type`) VALUES
(216, 18, 6, 'S');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `startDateTime` datetime NOT NULL COMMENT 'Format YYYY-MM-DD HH:MM:SS',
  `endDateTime` datetime NOT NULL COMMENT 'format YYYY-MM-DD HH:MM:SS',
  `minVolunteers` int(11) NOT NULL,
  `maxVolunteers` int(11) NOT NULL,
  `minStudents` int(11) NOT NULL,
  `maxStudents` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `removed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventId`, `title`, `description`, `location`, `startDateTime`, `endDateTime`, `minVolunteers`, `maxVolunteers`, `minStudents`, `maxStudents`, `creator`, `removed`) VALUES
(18, 'Overlap1', '22', '', '2015-12-12 10:20:00', '2015-12-12 20:20:00', 22, 22, 22, 16, 11, 0),
(19, 'Overlap2', '2123', '', '2015-12-12 11:00:00', '2015-12-12 14:00:00', 1, 11, 11, 9, 11, 0),
(20, 'Overlap3', '123', '', '2015-12-12 16:22:00', '2015-12-12 18:22:00', 1, 11, 11, 9, 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL COMMENT 'primary key',
  `first` text,
  `last` text,
  `email` text NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT 'username',
  `password` varchar(60) NOT NULL COMMENT 'password',
  `auth` varchar(1) NOT NULL COMMENT 'authorization {A, S, V}'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='User data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first`, `last`, `email`, `username`, `password`, `auth`) VALUES
(6, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'student', '$2y$10$JXhcX6aF3ZkkGroTtxtA3epiqbLgLmjUG09KXcvOj4XlqNrcRnF.6', 'S'),
(11, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'admin', '$2y$10$kbZcA44A6omlB1vyxti7NeRxEuBOhSxUjGmjvH/dv6fOTtQ/NwVn.', 'A'),
(12, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'volunteer', '$2y$10$06ixhuen.ylN5yx20chfy.WpJAkP5Jg4.d/5ne19TDS4JMQPdhCg6', 'V'),
(13, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'admin2', '$2y$10$Sl8rN1/X5xbbFwqWNjCBneRkOAW17Qbxdb.57/BWQTm.HUPQBBkLi', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventparticipation`
--
ALTER TABLE `eventparticipation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventparticipation`
--
ALTER TABLE `eventparticipation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=217;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
