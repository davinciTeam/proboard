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


-- Structuur van  tabel demoautentication.projects_tags wordt geschreven
CREATE TABLE IF NOT EXISTS `projects_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel demoautentication.projects_tags: ~0 rows (ongeveer)
/*!40000 ALTER TABLE `projects_tags` DISABLE KEYS */;
INSERT INTO `projects_tags` (`id`, `project_id`, `tag_id`) VALUES
	(4, 28, 4);
/*!40000 ALTER TABLE `projects_tags` ENABLE KEYS */;


-- Structuur van  tabel demoautentication.tags wordt geschreven
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel demoautentication.tags: ~3 rows (ongeveer)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`, `name`, `description`, `slug`, `active`) VALUES
	(1, 'PHP', 'php tag', 'php', 1),
	(2, 'Html/Css', 'html/css', 'htmlcss', 0),
	(3, 'SQL', 'Dit is een SQl tag', 'sql', 1),
	(4, 'Javascript', 'Dit is een Javascript tag', 'javascript', 1),
	(5, 'Test', 'Dit is een test tag', 'test', NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
