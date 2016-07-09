-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for fitness
DROP DATABASE IF EXISTS `fitness`;
CREATE DATABASE IF NOT EXISTS `fitness` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `fitness`;


-- Dumping structure for table fitness.category_post
DROP TABLE IF EXISTS `category_post`;
CREATE TABLE IF NOT EXISTS `category_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.category_post: ~0 rows (approximately)
DELETE FROM `category_post`;
/*!40000 ALTER TABLE `category_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_post` ENABLE KEYS */;


-- Dumping structure for table fitness.category_product
DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.category_product: ~0 rows (approximately)
DELETE FROM `category_product`;
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;


-- Dumping structure for table fitness.function
DROP TABLE IF EXISTS `function`;
CREATE TABLE IF NOT EXISTS `function` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.function: ~3 rows (approximately)
DELETE FROM `function`;
/*!40000 ALTER TABLE `function` DISABLE KEYS */;
INSERT INTO `function` (`id`, `name`, `description`) VALUES
	(6, 'Quản trị user', 'Cho phép quản trị user'),
	(7, 'Quản trị Function', 'Cho phép quản trị Function'),
	(8, 'Quản trị Group', 'Chong phép quản trị group');
/*!40000 ALTER TABLE `function` ENABLE KEYS */;


-- Dumping structure for table fitness.group
DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.group: ~4 rows (approximately)
DELETE FROM `group`;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` (`id`, `name`, `description`) VALUES
	(1, 'admin', NULL),
	(2, 'vip', NULL),
	(3, 'seller', NULL),
	(4, 'poster', NULL);
/*!40000 ALTER TABLE `group` ENABLE KEYS */;


-- Dumping structure for table fitness.group_function
DROP TABLE IF EXISTS `group_function`;
CREATE TABLE IF NOT EXISTS `group_function` (
  `group_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  PRIMARY KEY (`group_id`,`function_id`),
  KEY `group_function_ibfk_2` (`function_id`),
  CONSTRAINT `group_function_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `group_function_ibfk_2` FOREIGN KEY (`function_id`) REFERENCES `function` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.group_function: ~0 rows (approximately)
DELETE FROM `group_function`;
/*!40000 ALTER TABLE `group_function` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_function` ENABLE KEYS */;


-- Dumping structure for table fitness.level_post
DROP TABLE IF EXISTS `level_post`;
CREATE TABLE IF NOT EXISTS `level_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.level_post: ~0 rows (approximately)
DELETE FROM `level_post`;
/*!40000 ALTER TABLE `level_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `level_post` ENABLE KEYS */;


-- Dumping structure for table fitness.post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `like` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_post_user` (`user_id`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.post: ~0 rows (approximately)
DELETE FROM `post`;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;


-- Dumping structure for table fitness.post_comment
DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE IF NOT EXISTS `post_comment` (
  `id_cmt` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `like` int(11) NOT NULL,
  `super_cmt` int(11) NOT NULL,
  PRIMARY KEY (`id_cmt`),
  KEY `FK_post_comment_user` (`id_user`),
  KEY `FK_post_comment_post` (`id_post`),
  KEY `FK_post_comment_post_comment` (`super_cmt`),
  CONSTRAINT `FK_post_comment_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_post_comment_post_comment` FOREIGN KEY (`super_cmt`) REFERENCES `post_comment` (`id_cmt`),
  CONSTRAINT `FK_post_comment_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.post_comment: ~0 rows (approximately)
DELETE FROM `post_comment`;
/*!40000 ALTER TABLE `post_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_comment` ENABLE KEYS */;


-- Dumping structure for table fitness.product
DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_product_product_type` (`category_id`),
  CONSTRAINT `FK_product_product_type` FOREIGN KEY (`category_id`) REFERENCES `type_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.product: ~0 rows (approximately)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Dumping structure for table fitness.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.user: ~25 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `level`) VALUES
	(14, '10', '123456', '10@gmail.com', 0),
	(15, '11', '123456', '11@gmail.com', 0),
	(16, '12', '123456', '12@gmail.com', 0),
	(17, '13', '123456', '13@gmail.com', 0),
	(18, '14', '123456', '14@gmail.com', 0),
	(19, '15', '123456', '15@gmail.com', 0),
	(20, '16', '123456', '16@gmail.com', 0),
	(21, '17', '123456', '17@gmail.com', 0),
	(22, '18', '123456', '18@gmail.com', 0),
	(23, '19', '123456', '19@gmail.com', 0),
	(6, '2', '$2y$10$nEqRdSaFpBzlOSs.mylqtOqomTJsIeBNf5uZX/bd5Z2DTguT931hm', '2@gmail.com', 0),
	(24, '20', '123456', '20@gmail.com', 0),
	(25, '21', '123456', '21@gmail.com', 0),
	(26, '22', '123456', '22@gmail.com', 0),
	(27, '23', '123456', '23@gmail.com', 0),
	(28, '24', '123456', '24@gmail.com', 0),
	(5, '3', '$2y$10$p9yhnYXSRpmgB8RZKJXy2.BWEkGXg0dS4CkHnPIEBdSD9IxyRVxGq', '3@gmail.com', 0),
	(8, '4', '$2y$10$6PsiEpVnbEhDOl4YO8xBh.DvtNbzn.ufb.VVb0QxOcUM6tD9bPmyy', '4@gmail.com', 0),
	(9, '5', '$2y$10$3hANshEN6TQiLMrq7aJm1uo/yGCCJlOBLfaM8lI1or4uW8405STX2', '5@gmail.com', 0),
	(10, '7', '', '7@gmail.com', 0),
	(12, '8', '123456', '8@gmail.com', 0),
	(13, '9', '123456', '9@gmail.com', 0),
	(2, 'dbom', '$2y$10$MOy4vCJ8wnQ2V6Pqhie99.f8mAuMSgD9ApZoIIfJjVfkrdITyylIy', 'dbom123@gmail.com', 1),
	(29, 'sdfxngchj,k', '$2y$10$Je1gDk6oSxb0Gc/93nZaW.XkurtmMfpIODaxd9ZpTvePeMTi/dXHG', 'dbom12123@gmail.com', 0),
	(4, 'user1', '$2y$10$mVv6R7Sb1ZFL.5RoNttTVeAKNo4DrBSlIiR6iqrrf59GakiLw1WTW', 'user1@gmail.com', 0),
	(3, 'xuanbac216', '$2y$10$27YQ91Qc9BxkHcvUouZ9AODUYZUUy3PZfVwN9DVDmQqjfd0xJOcoC', 'xuanbac216@gmail.com', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table fitness.user_group
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_group_ibfk_2` (`group_id`),
  CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.user_group: ~13 rows (approximately)
DELETE FROM `user_group`;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
	(2, 1),
	(2, 3),
	(2, 4),
	(3, 1),
	(4, 2),
	(5, 2),
	(5, 3),
	(6, 3),
	(8, 4),
	(9, 3),
	(29, 1),
	(29, 2),
	(29, 3);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
