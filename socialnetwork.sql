-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 12:27 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialnetwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) UNSIGNED NOT NULL,
  `comment` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `posted_at` datetime NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `posted_at`, `post_id`) VALUES
(5, 'Ù…Ù†ØªÙ†Ù…ØªÙ†Ùƒ', 1, '2018-02-04 14:25:01', 4),
(6, 'wellcome ahmed', 2, '2018-02-12 19:32:56', 6),
(7, 'a', 1, '2018-02-12 20:44:31', 39),
(8, 'a', 1, '2018-02-12 20:46:47', 39),
(9, 'd', 1, '2018-02-12 20:47:10', 39),
(11, 'b', 1, '2018-02-12 20:48:44', 39),
(13, 'fdfsdfdfd', 1, '2018-02-12 20:51:32', 39),
(14, 'ffssdf', 1, '2018-02-12 20:52:56', 39),
(16, 'dsadas', 2, '2018-02-16 20:41:30', 5),
(17, '\'', 1, '2018-02-26 00:22:55', 5);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `followe_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `followe_id`) VALUES
(8, 1, 3),
(11, 2, 3),
(17, 3, 1),
(21, 2, 1),
(23, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(54, '444115f862a6f2621caa6286989971798ff6d317', 3),
(55, '3b1379f0c62ea6b2d60418ecd0952ebad3acfe80', 2);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL,
  `receiver` int(11) UNSIGNED NOT NULL,
  `seen` tinyint(1) UNSIGNED NOT NULL,
  `send_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `sender`, `receiver`, `seen`, `send_at`) VALUES
(66, 'from mohamed to ahmed_essa', 2, 1, 0, '2018-02-25 21:54:14'),
(67, 'from ahmed1 to ahmed_essa', 3, 1, 0, '2018-02-25 21:55:39'),
(68, 'from ahmed1 to mohamed', 3, 2, 0, '2018-02-25 21:56:05'),
(69, 'message to ahmed1 from ahmed_essa', 1, 3, 0, '2018-02-25 23:15:27'),
(70, 'hello mohamed from ahmed', 1, 2, 0, '2018-02-27 12:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` int(11) UNSIGNED NOT NULL,
  `reciver` int(11) UNSIGNED NOT NULL,
  `sender` int(11) UNSIGNED NOT NULL,
  `extra` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `type`, `reciver`, `sender`, `extra`) VALUES
(1, 1, 2, 1, NULL),
(2, 1, 1, 1, NULL),
(3, 1, 1, 1, NULL),
(4, 1, 1, 1, '{\"postbody\":\"@ahmed_essa\"}'),
(5, 1, 1, 1, '{\"postbody\":\"@ahmed_essa hellow\"}'),
(6, 1, 1, 1, '{\"postbody\":\"@ahmed_essa dsaffsdffffdfs\"}'),
(7, 2, 1, 1, ''),
(8, 2, 1, 1, ''),
(9, 2, 1, 1, ''),
(10, 2, 1, 1, ''),
(11, 2, 1, 1, ''),
(12, 2, 1, 1, ''),
(13, 2, 1, 1, ''),
(14, 2, 2, 2, ''),
(15, 1, 2, 1, '{\"postbody\":\"@mohamed ssee\"}'),
(16, 2, 1, 1, ''),
(17, 2, 1, 1, ''),
(18, 2, 1, 1, ''),
(19, 2, 1, 1, ''),
(20, 2, 1, 1, ''),
(21, 2, 1, 1, ''),
(22, 2, 2, 2, ''),
(23, 2, 1, 2, ''),
(24, 2, 1, 1, ''),
(25, 2, 2, 2, ''),
(26, 1, 2, 1, '{\"postbody\":\"@mohamed a\"}');

-- --------------------------------------------------------

--
-- Table structure for table `password_tokens`
--

CREATE TABLE `password_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
  `body` varchar(250) DEFAULT NULL,
  `posted_time` datetime NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `likes` int(10) UNSIGNED NOT NULL,
  `postimg` varchar(5000) NOT NULL,
  `topics` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_time`, `user_id`, `likes`, `postimg`, `topics`) VALUES
(4, 'hello', '2018-01-23 19:07:29', 2, 2, '', NULL),
(5, 'war', '2018-01-23 19:40:16', 2, 2, '', NULL),
(6, 'hello it\'s ahmed this is my first post', '2018-01-23 22:17:26', 1, 0, '', NULL),
(22, '#java is good', '2018-01-27 19:32:31', 1, 0, '', 'java,'),
(23, '#java is bad', '2018-01-27 19:38:36', 1, 0, '', 'java,'),
(38, '@mohamed ssee', '2018-02-11 04:13:52', 1, 1, '', ''),
(39, 'how are u', '2018-02-12 19:07:09', 1, 4, '', ''),
(42, '', '2018-02-17 18:57:42', 1, 0, 'layout/imges/617294.jpg', ''),
(45, 'mjk', '2018-02-17 19:40:47', 1, 0, '', ''),
(46, '@mohamed a', '2018-02-20 15:18:52', 1, 1, '', ''),
(47, 'hello', '2018-02-23 16:15:23', 3, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) UNSIGNED NOT NULL,
  `post_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`) VALUES
(20, 5, 2),
(70, 34, 1),
(83, 39, 2),
(85, 39, 3),
(117, 4, 1),
(118, 46, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `email` text NOT NULL,
  `profileimg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `profileimg`) VALUES
(1, 'ahmed_essa', '$2y$10$J8McEiYezCStgufwzVnf0eToN7lZhp4xj5lUhSCErjNHF7vJMq8SO', 'ahmedesa6120@gmail.com', 'layout/imges/11796209_665616713540580_7179526221618992971_n.jpg'),
(2, 'mohamed', '$2y$10$HhdKEpsNyw97YtdJRDLHSOUuhBpVDRecu5ZPWJPTlkIZ.HTbo5qRO', 'm@m.com', 'layout/imges/user.png'),
(3, 'ahmed1', '$2y$10$NQil1Nc.kinKoYUsflLpoOThcOCerD9yRDUMc4z7A.fW1VCcWkoRq', 'a@a.com', 'layout/imges/img_avatar2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comments_ibfk_1` (`post_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
