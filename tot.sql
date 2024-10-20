-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 09:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tot`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'News', '2024-10-12 13:38:10'),
(2, 'Announcements', '2024-10-12 13:38:23'),
(3, 'Entertainment', '2024-10-12 13:38:43'),
(4, 'MEMES', '2024-10-12 13:39:01'),
(5, 'Mail Box', '2024-10-12 13:39:10'),
(6, 'Games', '2024-10-14 08:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 6, 1, 'comment testing', '2024-10-18 18:48:50'),
(2, 8, 1, 'HELLO COMMENTTS', '2024-10-18 18:58:22'),
(3, 8, 1, 'HELLO COMMENTTS', '2024-10-18 18:58:24'),
(4, 3, 1, 'asdsad', '2024-10-18 18:58:32'),
(5, 4, 1, 'Hello this is apn', '2024-10-18 18:59:58'),
(6, 5, 1, 'Hello this is apn\n', '2024-10-18 19:00:52'),
(7, 7, 1, 'Hello', '2024-10-18 19:05:31'),
(8, 10, 1, 'Hello this is comment', '2024-10-18 19:07:59'),
(9, 10, 1, 'ddsfds', '2024-10-18 19:08:05'),
(10, 10, 1, 'dsfdsf', '2024-10-18 19:08:07'),
(11, 5, 1, 'fgfgfd', '2024-10-18 19:08:25'),
(12, 5, 1, 'dfsd', '2024-10-18 19:09:38'),
(13, 9, 1, 'HELLO', '2024-10-18 19:09:48'),
(14, 9, 1, 'sadsa', '2024-10-18 19:10:14'),
(15, 9, 1, 'sadsadsa', '2024-10-18 19:10:17'),
(16, 6, 1, 'dsfds', '2024-10-18 19:10:32'),
(17, 8, 1, 'sdfds', '2024-10-18 19:10:57'),
(18, 7, 1, 'dsfdsf', '2024-10-18 19:11:01'),
(19, 9, 1, 'fgdfgfdgfd', '2024-10-18 19:11:10'),
(20, 9, 1, 'Hello Marshmello', '2024-10-18 19:20:41'),
(21, 3, 1, 'dsds', '2024-10-18 19:20:57'),
(22, 8, 1, 'Time testing', '2024-10-18 19:21:11'),
(23, 8, 1, 'Hello this is teim testonds', '2024-10-18 19:21:29'),
(24, 4, 1, 'Hello This is apn travel destinations', '2024-10-18 19:28:24'),
(25, 4, 1, 'Hello This is apn travel destinations', '2024-10-18 19:28:24'),
(26, 4, 1, 'hello', '2024-10-18 19:29:14'),
(27, 6, 1, 'VEGANNNNN', '2024-10-18 19:29:45'),
(28, 5, 1, 'Yeah , this was so fun', '2024-10-18 19:33:51'),
(29, 9, 3, 'No more marshmello', '2024-10-18 19:34:53'),
(30, 5, 3, 'Yeah, It\'s so cool', '2024-10-18 19:38:33'),
(31, 2, 3, 'dsdfdsf', '2024-10-18 19:39:01'),
(32, 2, 3, 'dsfdsf', '2024-10-18 19:39:04'),
(33, 1, 3, 'Hello ', '2024-10-18 19:39:15'),
(34, 1, 3, 'Is anybody here', '2024-10-18 19:39:22'),
(35, 1, 3, 'tertre', '2024-10-18 19:39:44'),
(36, 7, 3, 'sdsad', '2024-10-18 19:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(89, 1, 8, '2024-10-18 14:37:52'),
(104, 1, 1, '2024-10-18 14:44:38'),
(106, 1, 9, '2024-10-18 14:44:48'),
(117, 1, 3, '2024-10-18 14:47:04'),
(118, 1, 5, '2024-10-18 17:58:01'),
(120, 1, 7, '2024-10-18 18:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author_id`, `category_id`, `created_at`, `likes`) VALUES
(1, 'TOT project', 'The project is being created by the Web Wizards', 1, 1, '2024-10-12 13:40:55', 1),
(2, 'The Future of AI', 'Artificial Intelligence is evolving rapidly and changing our world.', 1, 1, '2024-10-12 13:45:07', 0),
(3, 'Healthy Eating Tips', 'Here are some tips for maintaining a healthy diet.', 2, 2, '2024-10-12 13:45:07', 1),
(4, 'Top 10 Travel Destinations for 2024', 'Discover the best places to visit this year.', 3, 3, '2024-10-12 13:45:07', 0),
(5, 'Learning PHP for Beginners', 'PHP is a versatile language for web development.', 1, 4, '2024-10-12 13:45:07', 1),
(6, 'Delicious Vegan Recipes', 'Try these easy vegan recipes for a healthy meal.', 2, 5, '2024-10-12 13:45:07', 0),
(7, 'Posting Testing', 'Hello this is post tesing', NULL, 1, '2024-10-12 14:21:55', 1),
(8, 'Time Testing', 'This is time testing blah blah', NULL, 4, '2024-10-13 03:57:43', 1),
(9, 'New Released Music Videos', 'dsfdsfdsfdsfdsrtificial Intelligence is evolving rapidly and changing our world.rtificial Intelligence is evolving rapidly and changing our world.rtificial Intelligence is evolving rapidly and changing our world.rtificial Intelligence is evolving rapidly and changing our world.', NULL, 1, '2024-10-14 08:18:34', 1),
(10, 'Project TEsting', 'fdsvfdvcbvc cbThe project is being created by the Web WizardsThe project is being created by the Web Wizards', NULL, 2, '2024-10-15 03:54:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `saved_posts`
--

CREATE TABLE `saved_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `saved_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test table 88`
--

CREATE TABLE `test table 88` (
  `sfds` int(11) NOT NULL,
  `fffff` int(11) NOT NULL,
  `eere` int(11) NOT NULL,
  `43443` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'APN', 'apn@gmail.com', 'thisispassword', '2024-10-12 13:34:41'),
(2, 'john_doe', 'john@example.com', '$2y$10$e0A3bZxgC5LUIW1tCZ9l2uGMLok/5LrZn2YvS6eT9OYc5Kf8GgHKy', '2024-10-12 13:42:21'),
(3, 'jane_smith', 'jane@example.com', '$2y$10$CzD/9YPwFONz6gC3NzOwMOXIsByMsu9ZTnAxrNOPhxW.QXwCrU98m', '2024-10-12 13:42:21'),
(4, 'alice_jones', 'alice@example.com', '$2y$10$hVRRPr.Q2WMeD.k3Y0Z8b.fvQzZ/GRNcALwOspFfLnTzzhNSngq4K', '2024-10-12 13:42:21'),
(5, 'Aung Phyoe Naing', 'fdsfdss@gmail.com', '342343454632', '2024-10-14 07:27:29'),
(6, 'Daw Thiri', 'thiri@gmail.com', '23e2ewd32432', '2024-10-15 03:55:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `saved_posts`
--
ALTER TABLE `saved_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD CONSTRAINT `saved_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `saved_posts_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
