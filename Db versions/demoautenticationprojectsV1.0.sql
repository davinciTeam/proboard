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
  `docent` varchar(50) NOT NULL DEFAULT '0',
  `klant` varchar(50) NOT NULL DEFAULT '0',
  `leden` varchar(50) NOT NULL DEFAULT '0',
  `active` varchar(50) NOT NULL DEFAULT '0',
  `slug` tinytext,
  `description` tinytext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel demoautentication.projects: ~12 rows (ongeveer)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`id`, `name`, `docent`, `klant`, `leden`, `active`, `slug`, `description`) VALUES
	(1, 'test', 'slemmer', 'slemmer', 'student 1 , student2', '1', 'test', NULL),
	(2, 'name', 'test2', 'test2', 'test2', '1', 'test2', NULL),
	(3, 'wertyukie', 'eawrsfthj', 'ewrtyuj', 'aefsghf', '0', NULL, NULL),
	(4, 'asdas', 'dasdasd', 'asdasda', 'sadadadas', '0', NULL, NULL),
	(5, 'asdas', 'dasdasd', 'asdasda', 'sadadadas', '0', NULL, NULL),
	(6, 'adasdas', 'asdsad', 'adsasds', 'adada', '0', NULL, NULL),
	(7, 'adasdas', 'asdsad', 'adsasds', 'adada', '0', NULL, NULL),
	(8, 'tuy', 'ytutut', '5tutuy', 'ututut', '0', NULL, NULL),
	(9, 'asdas', 'adada', 'adaadada', 'adadadad', '0', NULL, NULL),
	(10, 'bla2', 'bla2', 'bla2', 'bla2', '0', NULL, NULL),
	(11, 'bla2', 'bla2', 'bla2', 'bla2', '0', NULL, NULL),
	(12, 'qwerty', 'qwerty', 'qwerty', 'qwerty', '0', NULL, NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
