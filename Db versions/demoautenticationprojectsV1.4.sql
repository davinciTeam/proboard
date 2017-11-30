-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Versie:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Databasestructuur van demoautentication wordt geschreven
CREATE DATABASE IF NOT EXISTS `demoautentication` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `demoautentication`;


-- Structuur van  tabel demoautentication.projects wordt geschreven
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `teacher` varchar(50) NOT NULL DEFAULT '0',
  `client` varchar(50) NOT NULL DEFAULT '0',
  `active` varchar(50) NOT NULL DEFAULT '0',
  `slug` tinytext,
  `description` tinytext,
  `iteration_date` varchar(50) DEFAULT NULL,
  `iteration_start` varchar(50) DEFAULT NULL,
  `iteration_end` varchar(50) DEFAULT NULL,
  `code_date` varchar(50) DEFAULT NULL,
  `code_start` varchar(50) DEFAULT NULL,
  `code_end` varchar(50) DEFAULT NULL,
  `git_url` varchar(255) DEFAULT NULL,
  `trello_url` varchar(255) DEFAULT NULL,
  `project_url` varchar(255) DEFAULT NULL,
  `bug_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel demoautentication.projects: ~6 rows (ongeveer)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`id`, `name`, `teacher`, `client`, `active`, `slug`, `description`, `iteration_date`, `iteration_start`, `iteration_end`, `code_date`, `code_start`, `code_end`, `git_url`, `trello_url`, `project_url`, `bug_url`) VALUES
	(1, 'stagemarktAO', 'Huisman', 'slemmer', '1', 'test', 'Dit project houdt in het bouwen van een nieuwe versie van stagemarktAO', '13-10-2017', '15:00', '16:00', '22-10-2017', '12:00', '13:00', NULL, NULL, NULL, NULL),
	(2, 'stagemarkt 23erwerw', 'nouwen1234', 'Nouwen1234', '1', 'test2', 'Deze project houdt in het bouwen van een nieuwe versie van stagemarkt', '', '16:00', '16:30', NULL, '', '', NULL, NULL, NULL, NULL),
	(28, 'ufo', 'df', 'sdf', '0', 'ufo1', 'sdafs', '12-10-2017', '14:00', '15:00', '21-10-2017', '11:00', '12:00', NULL, NULL, NULL, NULL),
	(29, 'ufo', 'ufo', 'ufo', '0', 'ufo12', 'ufo', '11-10-2017', '13:00', '14:00', '20-10-2017', '10:00', '11:00', NULL, NULL, NULL, NULL),
	(40, 'testproject', 'slemmer', 'jan klaas', '0', 'testproject1', 'Dit is een beschrijving', '15-10-2017', '16:30', '17:00', '23-10-2017', '13:00', '14:00', NULL, NULL, NULL, NULL),
	(41, 'naam12', 'docent12', 'klant12', '0', 'naam12', 'qeeqwrewrerwe', NULL, NULL, NULL, NULL, NULL, NULL, 'giturl12', 'trellourl12', NULL, NULL),
	(42, 'rewr', 'werwerwe', 'werwer', '0', 'rewr', 'werwerwrwrwerw', NULL, NULL, NULL, NULL, NULL, NULL, 'git123', 'trello123', 'test123', 'bug123');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
