-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 02:36 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instagram`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_interact` int(10) UNSIGNED NOT NULL,
  `id_noti` int(10) UNSIGNED NOT NULL,
  `message` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_interact`, `id_noti`, `message`, `date`) VALUES
(1, 2, 3, 'nice, you\'re a lucky man', '2017-09-23 00:00:00'),
(2, 1, 4, 'Really?', '2017-09-24 00:08:10'),
(3, 2, 5, 'Where did you take it?', '2017-09-24 02:06:00'),
(4, 6, 0, 'We went to SaPa lastweek', '2017-09-24 05:00:06'),
(5, 6, 0, 'It was awsome', '2017-09-24 14:33:40'),
(6, 2, 16, 'So lovely you two!', '2017-09-24 22:10:55'),
(7, 11, 18, 'who is she?', '2017-09-24 22:15:25'),
(8, 11, 19, 'i\'ve never seen her before', '2017-09-24 22:17:18'),
(9, 8, 0, 'just my friend in high school', '2017-09-24 22:19:50'),
(10, 12, 20, 'What kind of club is it?', '2017-09-24 22:24:36'),
(11, 13, 21, 'hey man, she is my sister, who are you?', '2017-09-24 22:26:35'),
(12, 14, 22, 'where is there?', '2017-09-24 22:28:19'),
(13, 9, 0, 'a programming club, wanna join?', '2017-09-24 22:30:34'),
(14, 9, 0, 'they\'ll help you a lot', '2017-09-24 22:32:05'),
(15, 4, 23, 'thong nhat park', '2017-09-25 18:59:30'),
(16, 15, 30, 'how could u do that to me?', '2017-09-26 09:40:17'),
(17, 15, 31, 'u make me so confused', '2017-09-26 09:41:14'),
(20, 8, 0, 'dont be mad at me', '2017-09-26 09:51:44'),
(21, 16, 0, '@tuan how do u know?', '2017-09-26 15:06:56'),
(22, 16, 0, '@duong tuan\'s right', '2017-09-26 15:39:40'),
(23, 6, 0, '@tuan@duy wanna join the trip next week', '2017-09-26 15:48:52'),
(24, 6, 0, 'it\'ll be fun', '2017-09-26 18:27:56'),
(25, 6, 0, '@xxxxx', '2017-09-26 18:35:14'),
(26, 2, 36, '@phan ???', '2017-09-26 23:19:25'),
(27, 8, 0, '@phan look at her', '2017-09-27 15:56:00'),
(28, 4, 39, '@phan i\'ve gone there twice', '2017-09-27 22:18:34'),
(29, 16, 0, '@tuan whow', '2017-09-27 22:30:02'),
(30, 5, 44, 'how can i regist?', '2017-09-27 23:46:23'),
(31, 5, 45, 'and what time? need more information @phan!!!!!!', '2017-09-27 23:50:31'),
(32, 9, 0, 'link: https://www.facebook.com/laptrinhvienconfessions/', '2017-09-28 16:18:15'),
(33, 9, 0, '@tuan u should regist', '2017-09-28 16:45:18'),
(34, 15, 55, 'i hate u @tuan, what did u think @phan?', '2017-09-29 23:26:08'),
(35, 17, 58, '@trang u\'re ridiculous', '2017-09-29 23:36:28'),
(36, 4, 63, '????', '2017-09-30 11:14:57'),
(37, 17, 64, '@duong i\'m her boyfriend', '2017-09-30 13:05:19'),
(38, 1, 66, 'just test my web, dont care about that', '2017-10-01 22:55:39'),
(39, 2, 67, '@duy what are u talking about?', '2017-10-01 22:56:36'),
(40, 1, 69, 'sorry, it\'s my mistake', '2017-10-01 22:59:27'),
(41, 2, 70, '????', '2017-10-01 23:01:06'),
(42, 5, 71, 'ok, maybe i will', '2017-10-01 23:02:46'),
(43, 18, 72, 'i wanna join too, let\'s regist @tuan', '2017-10-01 23:25:17'),
(44, 9, 0, 'yeah!!!', '2017-10-01 23:55:31'),
(45, 9, 0, 'that\'ll be fun', '2017-10-02 00:04:05'),
(46, 19, 0, 'my hometown', '2017-10-02 19:55:22'),
(47, 20, 0, 'so beatity!!! I wish i could live there when i\'m old', '2017-10-02 19:57:11'),
(48, 22, 0, 'hi everyone!!!', '2017-10-02 19:58:20'),
(49, 23, 75, 'dsfsfsfsfsf', '2017-10-03 18:07:04'),
(50, 25, 76, 'nice', '2017-10-03 18:19:40'),
(55, 32, 0, 'my little sister - so cute hah?', '2018-05-09 21:13:04'),
(56, 33, 0, 'my idol :)', '2018-05-09 21:14:27'),
(57, 34, 83, 'so u\'re a fan of Real Madrid @phong', '2018-05-09 21:17:46'),
(58, 35, 0, 'same price but oposite emotions ', '2018-05-09 21:23:24'),
(59, 9, 0, 'hey', '2018-05-09 22:29:03'),
(66, 36, 0, 'she said \"ah oh!\"', '2018-05-10 16:35:58'),
(67, 41, 86, 'nice', '2018-05-11 17:01:24'),
(68, 41, 87, 'yellow', '2018-05-11 17:01:49'),
(69, 41, 90, 'tree', '2018-05-11 20:31:05'),
(70, 40, 0, 'ghjj @tuan', '2018-05-12 14:06:21'),
(71, 44, 94, 'sssss', '2018-05-12 14:06:49'),
(72, 40, 0, '@phan', '2018-05-12 14:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_following` int(10) UNSIGNED NOT NULL,
  `id_noti` int(10) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `id_user`, `id_following`, `id_noti`, `date`) VALUES
(2, 3, 1, 2, '2017-09-17 00:00:00'),
(4, 4, 2, 12, '2017-09-24 00:00:00'),
(5, 5, 1, 13, '2017-09-24 00:00:00'),
(7, 3, 2, 17, '2017-09-24 22:13:36'),
(13, 2, 3, 29, '2017-09-25 21:36:29'),
(25, 1, 4, 62, '2017-09-29 23:43:28'),
(26, 3, 4, 74, '2017-10-02 20:00:08'),
(28, 2, 1, 80, '2018-04-22 13:17:59'),
(30, 6, 5, 82, '2018-05-09 21:15:00'),
(31, 1, 2, 85, '2018-05-11 17:00:07'),
(34, 1, 3, 91, '2018-05-12 14:05:18'),
(35, 1, 5, 92, '2018-05-12 14:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `interact`
--

CREATE TABLE `interact` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL,
  `love` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `interact`
--

INSERT INTO `interact` (`id`, `id_user`, `id_post`, `love`) VALUES
(1, 3, 1, 1),
(2, 2, 1, 1),
(3, 4, 1, 1),
(4, 2, 4, 1),
(5, 2, 3, 1),
(6, 1, 1, 1),
(7, 3, 4, 1),
(8, 2, 2, 1),
(9, 1, 3, 0),
(11, 3, 2, 1),
(12, 5, 3, 0),
(13, 5, 2, 0),
(14, 5, 4, 0),
(15, 4, 2, 0),
(16, 1, 4, 1),
(17, 1, 2, 0),
(18, 3, 3, 0),
(19, 3, 5, 0),
(20, 5, 7, 1),
(21, 5, 5, 1),
(22, 4, 6, 1),
(23, 1, 6, 0),
(24, 3, 6, 1),
(25, 1, 5, 1),
(32, 6, 10, 1),
(33, 6, 12, 1),
(34, 1, 12, 1),
(35, 2, 13, 1),
(36, 1, 15, 1),
(39, 1, 13, 1),
(40, 5, 27, 1),
(41, 1, 26, 0),
(42, 2, 15, 0),
(43, 2, 26, 1),
(44, 1, 27, 1),
(45, 1, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mention`
--

CREATE TABLE `mention` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_comment` int(10) UNSIGNED NOT NULL,
  `id_noti` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mention`
--

INSERT INTO `mention` (`id`, `id_comment`, `id_noti`) VALUES
(1, 21, 32),
(2, 22, 33),
(3, 23, 34),
(4, 23, 35),
(5, 26, 37),
(6, 27, 38),
(7, 28, 40),
(8, 29, 41),
(9, 31, 46),
(10, 33, 47),
(11, 34, 56),
(12, 34, 57),
(13, 35, 59),
(14, 37, 65),
(15, 39, 68),
(16, 43, 73),
(17, 57, 84),
(18, 70, 93),
(19, 72, 95);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `noti_type` char(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `noti_type`) VALUES
(2, 1, 'f'),
(3, 1, 'c'),
(4, 1, 'c'),
(5, 1, 'c'),
(12, 2, 'f'),
(13, 1, 'f'),
(16, 1, 'c'),
(17, 2, 'f'),
(18, 2, 'c'),
(19, 2, 'c'),
(20, 1, 'c'),
(21, 2, 'c'),
(22, 1, 'c'),
(23, 1, 'c'),
(29, 3, 'f'),
(30, 2, 'c'),
(31, 2, 'c'),
(32, 2, 'm'),
(33, 5, 'm'),
(34, 2, 'm'),
(35, 3, 'm'),
(36, 1, 'c'),
(37, 1, 'm'),
(38, 1, 'm'),
(39, 1, 'c'),
(40, 1, 'm'),
(41, 2, 'm'),
(44, 1, 'c'),
(45, 1, 'c'),
(46, 1, 'm'),
(47, 2, 'm'),
(55, 2, 'c'),
(56, 2, 'm'),
(57, 1, 'm'),
(58, 2, 'c'),
(59, 4, 'm'),
(62, 4, 'f'),
(63, 1, 'c'),
(64, 2, 'c'),
(65, 5, 'm'),
(66, 1, 'c'),
(67, 1, 'c'),
(68, 3, 'm'),
(69, 1, 'c'),
(70, 1, 'c'),
(71, 1, 'c'),
(72, 1, 'c'),
(73, 2, 'm'),
(74, 4, 'f'),
(75, 4, 'c'),
(76, 3, 'c'),
(80, 1, 'f'),
(82, 5, 'f'),
(83, 6, 'c'),
(84, 6, 'm'),
(85, 2, 'f'),
(86, 2, 'c'),
(87, 2, 'c'),
(90, 2, 'c'),
(91, 3, 'f'),
(92, 5, 'f'),
(93, 2, 'm'),
(94, 5, 'c'),
(95, 1, 'm');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `link_img` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `id_user`, `link_img`, `date`) VALUES
(1, 1, 'img/img1.jpg', '2017-09-18 10:26:08'),
(2, 2, 'img/img2.jpg', '2017-09-16 13:19:13'),
(3, 1, 'img/img3.jpg', '2017-09-17 16:48:10'),
(4, 1, 'img/img4.jpg', '2017-09-18 05:38:09'),
(5, 3, 'img/img7.jpg', '2017-10-02 08:04:00'),
(6, 4, 'img/img5.jpg', '2017-10-02 09:04:20'),
(7, 5, 'img/img6.jpg', '2017-10-01 09:04:20'),
(10, 6, 'img/IMG_20170202_084131.jpg', '2017-10-10 20:10:12'),
(12, 6, 'img/cristiano-ronaldo.jpg', '2018-05-09 21:13:56'),
(13, 2, 'img/31949915_1688692141206586_303774094724169728_o.jpg', '2018-05-09 21:20:40'),
(15, 1, 'img/image.jpg', '2018-05-09 22:38:09'),
(22, 1, 'img/maxresdefault.jpg', '2018-05-10 17:04:17'),
(23, 2, 'img/960.jpg', '2018-05-10 17:04:45'),
(25, 1, 'img/Nature-amazing-wallpaper-HD-picture.jpg', '2018-05-10 17:06:44'),
(26, 2, 'img/Background-Beautiful-Nature-Full-HD.jpg', '2018-05-10 17:08:32'),
(27, 5, 'img/Free-nature-pictures-Full-HD.jpg', '2018-05-10 17:10:18'),
(29, 1, 'img/Background-Beautiful-Nature-Full-HD.jpg', '2018-05-12 14:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link_avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `noti` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `link_avatar`, `noti`) VALUES
(1, 'phan', '12345', 'img/avatar1.jpg', 0),
(2, 'tuan', '12345', 'img/avatar2.jpg', 1),
(3, 'duy', '12345', 'img/avatar0.jpg', 1),
(4, 'trang', '12345', 'img/avatar0.jpg', 1),
(5, 'duong', '12345', 'img/avatar5.jpg', 0),
(6, 'phong', '12345', 'img/avatar6.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interact`
--
ALTER TABLE `interact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mention`
--
ALTER TABLE `mention`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `interact`
--
ALTER TABLE `interact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `mention`
--
ALTER TABLE `mention`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
