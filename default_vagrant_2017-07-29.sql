# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.56-MariaDB-1ubuntu0.14.04.1)
# Database: default_vagrant
# Generation Time: 2017-07-29 02:11:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table app_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_user`;

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_88BDF3E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_88BDF3E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `app_user` WRITE;
/*!40000 ALTER TABLE `app_user` DISABLE KEYS */;

INSERT INTO `app_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`)
VALUES
	(1,'johandouma','johandouma','johandouma@gmail.com','johandouma@gmail.com',1,NULL,'$2y$13$JsQKmJvzkbWec3IebakaReqrDcZGaLvBwiqF1cixaIAMnXsbPDbZG','2017-07-29 09:37:29',NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}');

/*!40000 ALTER TABLE `app_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table emergency
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emergency`;

CREATE TABLE `emergency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table emergency_skill
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emergency_skill`;

CREATE TABLE `emergency_skill` (
  `emergency_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  PRIMARY KEY (`emergency_id`,`skill_id`),
  KEY `IDX_DE33FC8AD904784C` (`emergency_id`),
  KEY `IDX_DE33FC8A5585C142` (`skill_id`),
  CONSTRAINT `FK_DE33FC8A5585C142` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_DE33FC8AD904784C` FOREIGN KEY (`emergency_id`) REFERENCES `emergency` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table migration_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration_versions`;

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;

INSERT INTO `migration_versions` (`version`)
VALUES
	('20170729020933');

/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table skill
# ------------------------------------------------------------

DROP TABLE IF EXISTS `skill`;

CREATE TABLE `skill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5E3DE4775E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table volunteer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `volunteer`;

CREATE TABLE `volunteer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table volunteer_enrolment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `volunteer_enrolment`;

CREATE TABLE `volunteer_enrolment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emergency_id` int(11) DEFAULT NULL,
  `volunteer_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5ADA3EF2D904784C` (`emergency_id`),
  KEY `IDX_5ADA3EF28EFAB6B1` (`volunteer_id`),
  CONSTRAINT `FK_5ADA3EF28EFAB6B1` FOREIGN KEY (`volunteer_id`) REFERENCES `volunteer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5ADA3EF2D904784C` FOREIGN KEY (`emergency_id`) REFERENCES `emergency` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
