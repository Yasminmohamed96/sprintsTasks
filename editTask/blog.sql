-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 سبتمبر 2021 الساعة 04:46
-- إصدار الخادم: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- بنية الجدول `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) NOT NULL,
  `block_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `blocks`
--

INSERT INTO `blocks` (`id`, `block_date`, `user_id`, `admin_id`) VALUES
(2, '2021-09-23 04:44:19', 7, 20);

-- --------------------------------------------------------

--
-- بنية الجدول `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sports'),
(2, 'Politics');

-- --------------------------------------------------------

--
-- بنية الجدول `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `like_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `follows`
--

CREATE TABLE `follows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL,
  `follow_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `like_date` datetime NOT NULL DEFAULT current_timestamp(),
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `likes`
--

INSERT INTO `likes` (`id`, `like_date`, `post_id`, `user_id`) VALUES
(30, '2021-09-19 22:00:36', 7, 5),
(31, '2021-09-19 22:00:37', 8, 5),
(32, '2021-09-19 22:00:39', 9, 5),
(33, '2021-09-19 22:00:40', 10, 5),
(34, '2021-09-19 22:01:46', 7, 6),
(36, '2021-09-19 22:02:08', 8, 6);

-- --------------------------------------------------------

--
-- بنية الجدول `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(1000) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(1000) NOT NULL,
  `publish_date` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `publish_date`, `created_at`, `updated_at`, `category_id`, `user_id`) VALUES
(7, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-09 20:26:09', NULL, 1, 5),
(8, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-09 20:26:09', NULL, 1, 5),
(9, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-09 20:26:09', NULL, 1, 5),
(10, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-09 20:26:09', NULL, 1, 5),
(11, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:44:32', NULL, 1, 5),
(12, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:45:15', NULL, 1, 5),
(13, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:53:17', NULL, 1, 5),
(14, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:54:15', NULL, 1, 5),
(15, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:55:15', NULL, 1, 5),
(16, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:57:10', NULL, 1, 5),
(17, 'Title2r', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 21:57:46', NULL, 1, 5),
(19, 'Title2r1111', 'Content2r', 'gallery_1238251741.jpg', '2021-09-14 00:00:00', '2021-09-16 22:07:02', NULL, 1, 5);

-- --------------------------------------------------------

--
-- بنية الجدول `post_tags`
--

CREATE TABLE `post_tags` (
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(19, 2),
(19, 4);

-- --------------------------------------------------------

--
-- بنية الجدول `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Ahly'),
(2, 'Zamalek'),
(3, 'Egypt'),
(4, 'Sudan');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `phone`, `type`, `active`) VALUES
(5, 'Ramy Ibrahim', 'ramy', '202cb962ac59075b964b07152d234b70', 'ramymibrahim@yahoo.com', NULL, 1, 1),
(6, 'ahmed mohamed', 'ahmed.mohamed', '202cb962ac59075b964b07152d234b70', 'ahmed.mohamed@yahoo.com', '01000000000', 0, 1),
(7, 'asd', 'sad', '202cb962ac59075b964b07152d234b70', 'asd@66asd.com', 'asd', 0, 1),
(11, 'asd', 'sad', '202cb962ac59075b964b07152d234b70', 'asd5@asd.com', 'asd', 0, 1),
(13, 'asd', 'sad', '202cb962ac59075b964b07152d234b70', 'asd@a22sd.com', 'asd', 0, 1),
(15, 'asd', 'sad', '202cb962ac59075b964b07152d234b70', 'd', 'asd', 0, 1),
(16, 'asd', 'sad', '202cb962ac59075b964b07152d234b70', 'asd@asd.com', 'asd', 0, 1),
(18, 'asd', 'sad', '202cb962ac59075b964b07152d234b70', 'asd@asd111.com', 'asd', 0, 1),
(20, 'yasmin', 'yasmin mohamed', '25f9e794323b453885f5181f1b624d0b', 'myasmin91@yahoo.com', '', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blockedUserId` (`user_id`),
  ADD KEY `adminWhblockuser` (`admin_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `posts_post_id_fk` (`post_id`),
  ADD KEY `user_user_id_fk` (`user_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `comments_comment_likes_fk` (`comment_id`),
  ADD KEY `users_comment_likes_fk` (`user_id`);

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `users_follow_id_fk` (`follower_id`),
  ADD KEY `users_following_id_fk` (`following_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `users_likes_user_id_fk` (`user_id`),
  ADD KEY `posts_likes_post_id_fk` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `categories_category_id_fk` (`category_id`),
  ADD KEY `users_user_id_fk` (`user_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tags_post_tags_tag_id_fk` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email_UI` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `blocks`
--
ALTER TABLE `blocks`
  ADD CONSTRAINT `adminWhblockuser` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blockedUserId` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `posts_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comments_comment_likes_fk` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_comment_likes_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `follows`
--
ALTER TABLE `follows`
  ADD CONSTRAINT `users_follow_id_fk` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_following_id_fk` FOREIGN KEY (`following_id`) REFERENCES `users` (`id`);

--
-- القيود للجدول `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `posts_likes_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_likes_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- القيود للجدول `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `categories_category_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `posts_post_tags_post_id_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_post_tags_tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
