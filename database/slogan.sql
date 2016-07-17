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


-- Dumping structure for table fitness.slogan
CREATE TABLE IF NOT EXISTS `slogan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table fitness.slogan: ~4 rows (approximately)
DELETE FROM `slogan`;
/*!40000 ALTER TABLE `slogan` DISABLE KEYS */;
INSERT INTO `slogan` (`id`, `content`) VALUES
	(1, 'Nói với chúng tôi những gì bạn chưa hài lòng, để cộng đồng ngày càng lớn mạnh hơn!'),
	(2, 'Hãy thay đổi bản thân ngay hôm nay, dù xuất phát điểm của bạn là số 0!'),
	(3, 'Đừng bao giờ dậm chân tại chỗ, luôn luôn vận động để thay đổi bản thân!'),
	(4, 'Kỹ năng, kinh nghiệm của bạn chính là bài học cho tất cả mọi người trong cộng đồng, hãy chia sẻ cùng chúng tôi!');
/*!40000 ALTER TABLE `slogan` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
