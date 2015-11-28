# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.42)
# Database: holmenhighschool
# Generation Time: 2015-11-26 06:58:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table eventparticipation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eventparticipation`;

CREATE TABLE `eventparticipation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `type` text NOT NULL COMMENT '''V'' or ''S'' for type of user signed up',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `eventparticipation` WRITE;
/*!40000 ALTER TABLE `eventparticipation` DISABLE KEYS */;

INSERT INTO `eventparticipation` (`id`, `eventId`, `user`, `type`)
VALUES
	(215,19,10,'S');

/*!40000 ALTER TABLE `eventparticipation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `startDateTime` datetime NOT NULL COMMENT 'Format YYYY-MM-DD HH:MM:SS',
  `endDateTime` datetime NOT NULL COMMENT 'format YYYY-MM-DD HH:MM:SS',
  `minVolunteers` int(11) NOT NULL,
  `maxVolunteers` int(11) NOT NULL,
  `minStudents` int(11) NOT NULL,
  `maxStudents` int(11) NOT NULL,
  `creator` text NOT NULL,
  `removed` int(11) NOT NULL,
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;

INSERT INTO `events` (`eventId`, `title`, `description`, `startDateTime`, `endDateTime`, `minVolunteers`, `maxVolunteers`, `minStudents`, `maxStudents`, `creator`, `removed`)
VALUES
	(18,'Overlap1','22','2015-12-12 10:20:00','2015-12-12 20:20:00',22,22,22,20,'admin',0),
	(19,'Overlap2','2123','2015-12-12 11:00:00','2015-12-12 14:00:00',1,11,11,9,'admin',0),
	(20,'Overlap3','123','2015-12-12 16:22:00','2015-12-12 18:22:00',1,11,11,9,'admin',0);

/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `first` text,
  `last` text,
  `email` text NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT 'username',
  `password` varchar(20) NOT NULL COMMENT 'password',
  `auth` varchar(1) NOT NULL COMMENT 'authorization {A, S, V}',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_2` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='User data';

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first`, `last`, `email`, `username`, `password`, `auth`)
VALUES
	(1,'Amy','Higgins','higgins.amy@uwlax.edu','admin','password','A'),
	(6,'Amy','Higgins','higgins.amy@uwlax.edu','v2','ykQIz','S'),
	(7,'Changsong','Li','lisdad@uwlax.edu','2','tX56w','V'),
	(10,'Changsong','Li','lisdad@uwlax.edu','student2','password','S');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
