-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2018 at 07:41 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beritaku_v4`
--

-- --------------------------------------------------------

--
-- Table structure for table `aa`
--

CREATE TABLE `aa` (
  `id` int(11) NOT NULL,
  `nama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(500) NOT NULL,
  `link` varchar(500) NOT NULL,
  `link_hash` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `content_nohtml` longtext,
  `content_hash` varchar(250) NOT NULL,
  `media_content_url` varchar(500) NOT NULL,
  `feed_id` int(11) UNSIGNED NOT NULL,
  `centroid_id` int(11) UNSIGNED DEFAULT NULL,
  `distance_to_centroid` double DEFAULT NULL,
  `publish_date` datetime NOT NULL,
  `date_entered` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `centroid`
--

CREATE TABLE `centroid` (
  `id` int(10) UNSIGNED NOT NULL,
  `distance_to_zero` double DEFAULT NULL,
  `count_member` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `d_max` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `centroid_lama`
--

CREATE TABLE `centroid_lama` (
  `id` int(10) UNSIGNED NOT NULL,
  `distance_to_zero` double DEFAULT NULL,
  `count_member` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `d_max` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `centroid_setting`
--

CREATE TABLE `centroid_setting` (
  `id` int(11) NOT NULL,
  `initial_d_max` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `count_word`
--

CREATE TABLE `count_word` (
  `id` int(11) UNSIGNED NOT NULL,
  `article_id` int(11) UNSIGNED DEFAULT NULL,
  `word_id` int(11) UNSIGNED DEFAULT NULL,
  `count` int(11) NOT NULL,
  `unique_column` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_centroid`
--

CREATE TABLE `detail_centroid` (
  `id` int(11) NOT NULL,
  `centroid_id` int(11) UNSIGNED DEFAULT NULL,
  `word_id` int(11) UNSIGNED DEFAULT NULL,
  `value` double DEFAULT NULL,
  `unique_column` varchar(200) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `feed_url` varchar(250) NOT NULL,
  `icon_url` varchar(250) NOT NULL,
  `is_validated` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stopword_list`
--

CREATE TABLE `stopword_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `stoplist` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `word`
--

CREATE TABLE `word` (
  `id` int(10) UNSIGNED NOT NULL,
  `word` varchar(250) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aa`
--
ALTER TABLE `aa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_hash` (`content_hash`),
  ADD UNIQUE KEY `hash_link` (`link_hash`),
  ADD KEY `id_feed` (`feed_id`),
  ADD KEY `centroid_id` (`centroid_id`);

--
-- Indexes for table `centroid`
--
ALTER TABLE `centroid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centroid_lama`
--
ALTER TABLE `centroid_lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centroid_setting`
--
ALTER TABLE `centroid_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `count_word`
--
ALTER TABLE `count_word`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kolom_unik` (`unique_column`),
  ADD KEY `id_artikel` (`article_id`),
  ADD KEY `id_kata_dasar` (`word_id`);

--
-- Indexes for table `detail_centroid`
--
ALTER TABLE `detail_centroid`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_column` (`unique_column`),
  ADD KEY `centroid_id` (`centroid_id`),
  ADD KEY `word_id` (`word_id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feed_url` (`feed_url`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `stopword_list`
--
ALTER TABLE `stopword_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stoplist_2` (`stoplist`),
  ADD KEY `stoplist` (`stoplist`),
  ADD KEY `stoplist_3` (`stoplist`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `word`
--
ALTER TABLE `word`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `katadasar` (`word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `centroid`
--
ALTER TABLE `centroid`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `centroid_setting`
--
ALTER TABLE `centroid_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `count_word`
--
ALTER TABLE `count_word`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_centroid`
--
ALTER TABLE `detail_centroid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stopword_list`
--
ALTER TABLE `stopword_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `word`
--
ALTER TABLE `word`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
