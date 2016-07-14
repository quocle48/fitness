-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2016 at 05:46 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_post`
--

CREATE TABLE IF NOT EXISTS `category_post` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_post`
--

INSERT INTO `category_post` (`id`, `name`, `description`) VALUES
(1, 'Chân - Mông - Đùi', 'Các bài tập liên quan đến chân - mông - đùi.'),
(2, 'Ngực', 'Các bài tập liên quan đến ngực.'),
(3, 'Lưng - Xô', 'Các bài tập liên quan đến lưng - xô.'),
(4, 'Vai', 'Các bài tập liên quan đến vai.'),
(5, 'Tay trước', 'Các bài tập liên quan đến tay trước.'),
(6, 'Tay sau', 'Các bài tập liên quan đến tay sau.'),
(7, 'Bụng', 'Các bài tập liên quan đến bụng.'),
(8, 'Cardio', 'Các bài tập giảm mỡ, cải thiện sức khỏe tim mạch.'),
(9, 'Giáo án nữ', 'Các bài tập dành cho nữ.'),
(10, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE IF NOT EXISTS `category_product` (
`id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE IF NOT EXISTS `function` (
`id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`id`, `name`, `description`) VALUES
(6, 'Quản trị hệ thống', 'Cho phép quản trị hệ thống'),
(7, 'Quản lý bài viết', 'Cho phép quản lý các bài viết'),
(8, 'Quản lý bán hàng', 'Cho phép quản lý bán hàng'),
(9, 'Post bài', 'Cho phép đăng bài');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
`id` int(11) NOT NULL,
  `name` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Quản trị hệ thống'),
(2, 'viper', 'Siêu nhân'),
(3, 'seller', 'Người bán hàng'),
(4, 'poster', 'Người quản lý bài viết'),
(5, 'member', 'Thành viên chính thức'),
(6, 'newbie', 'Trẻ trâu mới đăng ký');

-- --------------------------------------------------------

--
-- Table structure for table `group_function`
--

CREATE TABLE IF NOT EXISTS `group_function` (
  `group_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_function`
--

INSERT INTO `group_function` (`group_id`, `function_id`) VALUES
(1, 6),
(2, 6),
(2, 7),
(4, 7),
(2, 8),
(3, 8),
(1, 9),
(4, 9),
(5, 9);

-- --------------------------------------------------------

--
-- Table structure for table `level_post`
--

CREATE TABLE IF NOT EXISTS `level_post` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `level_post`
--

INSERT INTO `level_post` (`id`, `name`, `description`) VALUES
(1, 'Cơ bản', 'Các bài viết cho người mới.'),
(2, 'Nâng cao', 'Các bài viết về kiến thức nâng cao.');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `level_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `like` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `user_id`, `tag`, `content`, `time`, `level_id`, `category_id`, `like`, `img`, `disabled`) VALUES
(1, 'Barbell Bench Press', 30, '#Ngực #Đạ đòn #Đẩy', '<p>kalsdkalasldk</p>\r\n', '2016-07-14 16:19:33', '1', '2', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE IF NOT EXISTS `post_comment` (
  `id_cmt` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `like` int(11) NOT NULL,
  `super_cmt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tag` text COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disabled` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

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
(3, 'xuanbac216', '$2y$10$27YQ91Qc9BxkHcvUouZ9AODUYZUUy3PZfVwN9DVDmQqjfd0xJOcoC', 'xuanbac216@gmail.com', 1),
(30, 'zboy', '$2y$10$pIXW4gs.33KvO9SlIVkDL.e32/sJ77XU/UFNLSGztgyQoln12dlYu', 'zboy@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
(2, 1),
(3, 1),
(29, 1),
(30, 1),
(4, 2),
(5, 2),
(29, 2),
(30, 2),
(2, 3),
(5, 3),
(6, 3),
(9, 3),
(29, 3),
(30, 3),
(2, 4),
(8, 4),
(30, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_post`
--
ALTER TABLE `category_post`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_function`
--
ALTER TABLE `group_function`
 ADD PRIMARY KEY (`group_id`,`function_id`), ADD KEY `group_function_ibfk_2` (`function_id`);

--
-- Indexes for table `level_post`
--
ALTER TABLE `level_post`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_post_user` (`user_id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
 ADD PRIMARY KEY (`id_cmt`), ADD KEY `FK_post_comment_user` (`id_user`), ADD KEY `FK_post_comment_post` (`id_post`), ADD KEY `FK_post_comment_post_comment` (`super_cmt`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_product_product_type` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`), ADD UNIQUE KEY `email` (`email`), ADD KEY `id` (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
 ADD PRIMARY KEY (`user_id`,`group_id`), ADD KEY `user_group_ibfk_2` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_post`
--
ALTER TABLE `category_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `level_post`
--
ALTER TABLE `level_post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
ADD CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_function`
--
ALTER TABLE `group_function`
ADD CONSTRAINT `group_function_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `group_function_ibfk_2` FOREIGN KEY (`function_id`) REFERENCES `function` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
ADD CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `post_comment`
--
ALTER TABLE `post_comment`
ADD CONSTRAINT `FK_post_comment_post` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`),
ADD CONSTRAINT `FK_post_comment_post_comment` FOREIGN KEY (`super_cmt`) REFERENCES `post_comment` (`id_cmt`),
ADD CONSTRAINT `FK_post_comment_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `FK_product_product_type` FOREIGN KEY (`category_id`) REFERENCES `type_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
