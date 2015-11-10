-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2015 at 08:56 PM
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
  `user` text NOT NULL,
  `type` text NOT NULL COMMENT '''V'' or ''S'' for type of user signed up'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `eventId` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `startDateTime` date NOT NULL COMMENT 'Format YYYY-MM-DD HH:MM:SS',
  `endDateTime` date NOT NULL COMMENT 'format YYYY-MM-DD HH:MM:SS',
  `minVolunteers` int(11) NOT NULL,
  `maxVolunteers` int(11) NOT NULL,
  `minStudents` int(11) NOT NULL,
  `maxStudents` int(11) NOT NULL,
  `creator` text NOT NULL,
  `removed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL COMMENT 'primary key',
  `first` text,
  `last` text,
  `email` text NOT NULL,
  `username` varchar(20) NOT NULL COMMENT 'username',
  `password` varchar(20) NOT NULL COMMENT 'password',
  `auth` varchar(1) NOT NULL COMMENT 'authorization {A, S, V}'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='User data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first`, `last`, `email`, `username`, `password`, `auth`) VALUES
(1, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'admin', 'password', 'A'),
(5, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'volunteer', '1IDUA', 'V'),
(6, 'Amy', 'Higgins', 'higgins.amy@uwlax.edu', 'student', 'password', 'S');

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventparticipation`
--
ALTER TABLE `eventparticipation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
