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
CREATE DATABASE IF NOT EXISTS `fitness` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `fitness`;


-- Dumping structure for table fitness.category_post
CREATE TABLE IF NOT EXISTS `category_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.category_post: ~2 rows (approximately)
DELETE FROM `category_post`;
/*!40000 ALTER TABLE `category_post` DISABLE KEYS */;
INSERT INTO `category_post` (`id`, `name`, `description`) VALUES
	(1, 'Cơ tay', ''),
	(2, 'Cơ Ngực', '');
/*!40000 ALTER TABLE `category_post` ENABLE KEYS */;


-- Dumping structure for table fitness.category_product
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.category_product: ~3 rows (approximately)
DELETE FROM `category_product`;
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` (`id`, `name`, `description`) VALUES
	(9, 'Trang Phục', 'Áo, quần thể thao'),
	(10, 'Trang thiết bị', 'Các dụng cụ, thiết bị để chơi thể thao, tập thể hình'),
	(11, 'Thực phẩm bổ sung', 'Nguồn thực phẩm bổ sung cho thể thao');
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;


-- Dumping structure for table fitness.function
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
CREATE TABLE IF NOT EXISTS `level_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.level_post: ~3 rows (approximately)
DELETE FROM `level_post`;
/*!40000 ALTER TABLE `level_post` DISABLE KEYS */;
INSERT INTO `level_post` (`id`, `name`, `description`) VALUES
	(1, 'Cơ bản', ''),
	(2, 'Nâng cao', ''),
	(3, 'Chuyên nghiệp', '');
/*!40000 ALTER TABLE `level_post` ENABLE KEYS */;


-- Dumping structure for table fitness.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `level_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `like` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `description` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_user` (`user_id`),
  KEY `FK_post_level_post` (`level_id`),
  KEY `FK_post_category_post` (`category_id`),
  CONSTRAINT `FK_post_category_post` FOREIGN KEY (`category_id`) REFERENCES `category_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_level_post` FOREIGN KEY (`level_id`) REFERENCES `level_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.post: ~5 rows (approximately)
DELETE FROM `post`;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `title`, `user_id`, `tag`, `content`, `time`, `level_id`, `category_id`, `like`, `img`, `status`, `description`) VALUES
	(14, '   Bài tập tay cơ bản', 2, 'tay, cơ bản', '<p>ABC Duhjaskjkd qwihdoahsansj jsdajsljd &aacute;</p>\r\n', '2016-07-14 13:04:59', 1, 1, 0, 'http://fitness.com/uploads/logo_2016_with_title_white.png', 0, '  '),
	(15, '  Bài tập chân nâng cao', 2, '', '<p>B&agrave;i tập ch&acirc;n n&agrave;y cải thiện nhiều cơ tay cho c&aacute;c bạn</p>\r\n\r\n<blockquote>\r\n<p>Đừng tin bố con thằng n&agrave;o</p>\r\n</blockquote>\r\n\r\n<ol>\r\n	<li>Tập đ&uacute;ng động t&aacute;c</li>\r\n	<li>Tập hết sức c&oacute; thể</li>\r\n</ol>\r\n\r\n<p><a href="http://fitness.com" target="_blank">http://fitness.com</a></p>\r\n', '2016-07-14 16:23:59', 1, 1, 0, 'http://fitness.com/uploads/slider3.jpg', 0, '  '),
	(16, '   Dbom', 2, '123123', '<p>ầgasdasdas</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2016-07-14 17:42:34', 1, 1, 0, 'http://fitness.com/uploads/lesson1.jpg', 0, '   '),
	(17, '  ávdxzc ávdxzc ávdxzc ávdxzc ávdxzc ávdxzc ávdxzc', 2, 'đâsdasdas', '<p>gca&nbsp;</p>\r\n\r\n<p>asfhis;d&nbsp;</p>\r\n\r\n<p>&aacute;dhasjdopaskljdasd</p>\r\n\r\n<p>asgdahsdkla;s</p>\r\n', '2016-07-15 11:07:36', 1, 1, 0, 'http://fitness.com/uploads/np1.jpg', 0, '  da'),
	(18, ' Liên minh huyền thoại', 2, 'lol, atrox', '<p>avbhsa</p>\r\n\r\n<p>hftg</p>\r\n\r\n<p>hdasdyasdyasd</p>\r\n\r\n<p>fad</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&aacute;gasd</p>\r\n\r\n<p>a]sdkjajsd[aksf</p>\r\n\r\n<p>&aacute;d<img alt="" src="http://fitness.com/uploads/Aatrox_Splash_1.jpg" style="height:717px; width:1215px" /></p>\r\n', '2016-07-15 18:26:05', 1, 1, 0, 'http://fitness.com/uploads/slider2.jpg', 0, ' LMHT');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;


-- Dumping structure for table fitness.post_comment
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
  CONSTRAINT `FK_product_product_type` FOREIGN KEY (`category_id`) REFERENCES `category_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.product: ~0 rows (approximately)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Dumping structure for table fitness.slogan
CREATE TABLE IF NOT EXISTS `slogan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.slogan: ~3 rows (approximately)
DELETE FROM `slogan`;
/*!40000 ALTER TABLE `slogan` DISABLE KEYS */;
INSERT INTO `slogan` (`id`, `content`) VALUES
	(1, 'Nói với chúng tôi những gì bạn chưa hài lòng, để cộng đồng ngày càng lớn mạnh hơn!'),
	(2, 'Hãy thay đổi bản thân ngay hôm nay, dù xuất phát điểm của bạn là số 0!'),
	(3, 'Đừng bao giờ dậm chân tại chỗ, luôn luôn vận động để thay đổi bản thân!'),
	(4, 'Kỹ năng, kinh nghiệm của bạn chính là bài học cho tất cả mọi người trong cộng đồng, hãy chia sẻ cùng chúng tôi!');
/*!40000 ALTER TABLE `slogan` ENABLE KEYS */;


-- Dumping structure for table fitness.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `email`, `level`) VALUES
	(2, 'dbom', '$2y$10$MOy4vCJ8wnQ2V6Pqhie99.f8mAuMSgD9ApZoIIfJjVfkrdITyylIy', 'dbom123@gmail.com', 1),
	(3, 'xuanbac216', '$2y$10$27YQ91Qc9BxkHcvUouZ9AODUYZUUy3PZfVwN9DVDmQqjfd0xJOcoC', 'xuanbac216@gmail.com', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table fitness.user_group
CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_group_ibfk_2` (`group_id`),
  CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.user_group: ~4 rows (approximately)
DELETE FROM `user_group`;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
	(2, 1),
	(2, 3),
	(2, 4),
	(3, 1);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
