-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2021 at 03:06 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `user_id`, `name`, `created_at`) VALUES
(126, 1, 'masoud', '2021-08-21 19:53:37'),
(141, 1, 'work', '2021-08-22 22:23:39'),
(144, 1, 'aaaa', '2021-08-22 22:32:30'),
(147, 32, 'aaaa', '2021-08-24 01:06:44'),
(148, 32, 'ghghg', '2021-08-24 01:13:05'),
(160, 34, 'مصرور', '2021-08-24 21:49:02'),
(162, 39, 'first folder', '2021-08-26 23:13:34'),
(165, 33, 'folder one', '2021-08-26 23:29:18'),
(175, 33, 'testFolder', '2021-08-28 12:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `path` varchar(1024) COLLATE utf8_persian_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `musics`
--

CREATE TABLE `musics` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(512) CHARACTER SET utf8 NOT NULL,
  `path` varchar(1024) COLLATE utf8_persian_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `musics`
--

INSERT INTO `musics` (`id`, `user_id`, `name`, `path`, `created_at`) VALUES
(30, 35, 'sinaSae-Tolani', 'assets/audio/80b39b96d67f465b911f8898fd8f0c51.mp3', '2021-08-27 03:08:21'),
(32, 39, 'sina-sae', 'assets/audio/aee7b39d9ce9cafceae87736b17d738d.mp3', '2021-08-27 03:51:42'),
(63, 33, 'sina-sae', 'assets/audio/c45bf2c0b1bbe16e367531cb7c4c373b.mp3', '2021-08-31 16:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `folder_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(512) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `folder_id`, `title`, `status`, `created_at`) VALUES
(56, 32, 147, 'aaa', 1, '2021-08-24 01:10:30'),
(57, 32, 147, 'aaaa', 0, '2021-08-24 01:21:04'),
(68, 34, 160, 'اسیدشووی', 0, '2021-08-24 21:49:19'),
(69, 34, 160, 'work', 0, '2021-08-24 21:50:44'),
(82, 39, 163, 'edited', 1, '2021-08-26 23:14:20'),
(84, 33, 165, 'first taks inside this folder', 0, '2021-08-26 23:30:34'),
(85, 33, 165, 'second task inside this folder', 1, '2021-08-26 23:30:52'),
(86, 33, 165, 'learn english', 1, '2021-08-26 23:31:12'),
(90, 33, 165, 'learn php', 1, '2021-08-26 23:32:34'),
(91, 33, 165, 'edited', 1, '2021-08-26 23:32:48'),
(92, 33, 165, 'learn CSS', 1, '2021-08-26 23:33:00'),
(93, 33, 165, 'learn Java Script', 1, '2021-08-26 23:33:18'),
(96, 33, 165, 'edited', 1, '2021-08-27 00:05:18'),
(99, 33, 171, 'new task inside this folder', 1, '2021-08-27 10:09:11'),
(100, 33, 165, 'new Task', 1, '2021-08-27 10:50:30'),
(104, 33, 175, 'new task inside this folder', 0, '2021-08-28 16:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(256) COLLATE utf8_persian_ci NOT NULL,
  `email` varchar(512) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(512) COLLATE utf8_persian_ci NOT NULL,
  `creat_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `creat_at`) VALUES
(32, 'aliharooni', 'ali@gmail.com', '$2y$10$7CbUB32iocBHmxmgCXT47uKb/liZ2UJ.7E3rKNZQqNChBhPIy2.yS', '2021-08-23 23:27:35'),
(33, 'masoudharooni', 'masoudharooni50@gmail.com', '$2y$10$hYrhH7NMMtEAF6dtRVeRa.T8wEIHecklZsz.OEdCLESObb1.iLV6G', '2021-08-23 23:59:48'),
(34, 'hamidharooni', 'hamid@gmail.com', '$2y$10$kyuhkJFrTtmf3JIPG20dqu1llEnPkw.y/DRv4mkZQaT1WXF71C4Fe', '2021-08-25 02:18:21'),
(35, 'melinaharooni', 'melina@gmail.com', '$2y$10$PxK524WqsH4ojv7qMbHvYuGgXBmT7qpNboPg3Zm9Khec03qlU978O', '2021-08-27 03:07:29'),
(36, 'abbas', 'abbas@gmail.com', '$2y$10$SM/hUzqp5MgKzWTxYnubxu6EPYNfxuOjz5VgLyLxfh3uvEvPpNoQW', '2021-08-27 03:27:35'),
(37, 'asghar', 'asghar@gmail.com', '$2y$10$8HlgQgzGir5CJ/hEoqVzWuqLL9qIcbkv9lO.QD3g3BA36RVTxN3TC', '2021-08-27 03:31:28'),
(38, 'leylaBayati', 'leyla@gmail.com', '$2y$10$GaUjtWvxb52pGIANbXu5iem.Eo/ayIHGIgEA3WKqlUJDu5/JNUCey', '2021-08-27 03:34:48'),
(39, 'masoud', 'masoud@gmail.com', '$2y$10$adBcvc8NDVPr0lV9b6fIEObg46KoalBKwV3aitCpBM7fDTySal0Me', '2021-08-27 03:42:49'),
(40, 'zahraBayati', 'zahra@gmail.com', '$2y$10$TdV5zCahAP6MSonkH06sHOPd1L7scCqJukYM0Z1fyHi8Ii/daIPRy', '2021-08-30 19:49:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `musics`
--
ALTER TABLE `musics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
