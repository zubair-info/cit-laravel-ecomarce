-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 06:21 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '26', 'Women Fashion', NULL, '2022-03-09 23:31:53', '2022-03-19 09:39:26'),
(3, '26', 'extra ok', '2022-03-12 12:49:36', '2022-03-09 23:33:25', '2022-03-12 12:49:36'),
(4, '27', 'Men Fashion', NULL, '2022-03-10 06:54:02', '2022-03-11 09:04:47'),
(6, '28', 'Women', '2022-03-12 12:49:36', '2022-03-11 07:34:37', '2022-03-12 12:49:36'),
(7, '28', 'Men', '2022-03-12 12:49:36', '2022-03-11 07:34:48', '2022-03-12 12:49:36'),
(9, '38', 'Watch', NULL, '2022-03-19 13:51:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_03_04_035438_create_categories_table', 2),
(7, '2022_03_04_045133_create_categories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'defult.jpg',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'Chloe Dawson', 'jucavoni@mailinator.com', NULL, '$2y$10$Y85jR7/MkyPBm59r.kpiSO.DHkZOxWqduklPPPbr9/vtQ1OFzdVTG', 'uploads/users/defult.jpg', NULL, '2022-03-03 20:24:07', '2022-03-03 20:24:07'),
(15, 'Roary Foreman', 'qaneqo@mailinator.com', NULL, '$2y$10$q8THEC3/4tU9hMY8OkMPfeZpIbocs9zxAejNhlb1iYlJSiblelfoe', NULL, NULL, '2022-03-03 20:24:45', '2022-03-03 20:24:45'),
(16, 'Daniel Carpenter', 'hubojyt@mailinator.com', NULL, '$2y$10$1mMvMcsRONHYtXeRQUDNY.y9UMPOm2S0xvK0QHvYumXHgkNlMC3pK', NULL, NULL, '2022-03-03 21:05:31', '2022-03-03 21:05:31'),
(19, 'Cody Kim', 'qylab@mailinator.com', NULL, '$2y$10$oj84WkKrAstT3vNv5FfU1OC2OBD8okzgfU.2HIKr/o7wxlcx.zDzm', NULL, NULL, '2022-03-03 21:06:03', '2022-03-03 21:06:03'),
(20, 'Jeanette Fulton', 'dyke@mailinator.com', NULL, '$2y$10$fKk/mUuwdS9t2T27ZCU5Du9rWAc9CuQRzd9ncFsyOqfs0x2JVRUjS', NULL, NULL, '2022-03-03 21:06:14', '2022-03-03 21:06:14'),
(21, 'Ifeoma Blanchard', 'ruqu@mailinator.com', NULL, '$2y$10$.nRWI616zolkKczHLMsN4eUbaer.BtOxyUpD6qS7ZwuFKduEnXK6W', NULL, NULL, '2022-03-03 21:06:26', '2022-03-03 21:06:26'),
(22, 'Minerva Sargent', 'xujyjawo@mailinator.com', NULL, '$2y$10$Jqt7ykCHiFBq9ZI5p.Wj0O5j9pnQsSXndO119r.woKtFG4QV/8yJi', NULL, NULL, '2022-03-03 21:06:41', '2022-03-03 21:06:41'),
(23, 'Reagan Murphy', 'helatesa@mailinator.com', NULL, '$2y$10$39N0BBeIMa8yAwTkblAb9.PbvA2UdEJt2egJtPoRO6lepfJW9E1hm', NULL, NULL, '2022-03-03 23:05:41', '2022-03-03 23:05:41'),
(26, 'Echo Martinez', 'xemupahava@mailinator.com', NULL, '$2y$10$vwv3seXN43sUrgHdxARnhO/66Knbed5KrEcxrPmBWTFYkEfl958T2', NULL, NULL, '2022-03-09 21:23:12', '2022-03-09 21:23:12'),
(27, 'Justin Burns', 'zebedybut@mailinator.com', NULL, '$2y$10$rnAiTyUhcQCXNfsXdYPWN.AwePl0O7I2M.kaxqPX4irAKgiuG0uLa', NULL, NULL, '2022-03-10 06:33:16', '2022-03-10 06:33:16'),
(28, 'Gillian Callahan', 'zunaw@mailinator.com', NULL, '$2y$10$hKC9U5YyPWgyxNmpbBSgRe1tStDoe8ywwTbekrpRa4DvkMaQcMcgC', NULL, NULL, '2022-03-11 06:28:34', '2022-03-11 06:28:34'),
(29, 'Myra Lopez', 'kyge@mailinator.com', NULL, '$2y$10$ksSuw6tDR6W2oacporxE5.GxwdByzf3DHtZMKLfQxWST0RpnxPRCm', NULL, NULL, '2022-03-11 12:43:31', '2022-03-11 12:43:31'),
(30, 'Vivien Carroll', 'jyjysy@mailinator.com', NULL, '$2y$10$qiIlFhPK.BiQCMW3HVFOSup5/YJOKUYRm0UpkPoo35dZWh.TRsCO6', NULL, NULL, '2022-03-12 07:52:24', '2022-03-12 07:52:24'),
(31, 'Mira Williams', 'pezosogaq@mailinator.com', NULL, '$2y$10$5JIUuJ1uVst.BLKZYvjJUOVtEoB/sZDGdaknUtmqPpuYpeMBAvCUG', NULL, NULL, '2022-03-12 12:23:45', '2022-03-12 12:23:45'),
(32, 'Stuart Morrow', 'curusuf@mailinator.com', NULL, '$2y$10$V8s/ScMTEGi9fPIlxuqaKeDsW.rfp/BHxnEmK3LuzdoUV5tWz5xUy', NULL, NULL, '2022-03-14 22:57:41', '2022-03-14 22:57:41'),
(33, 'Sybill Nunez', 'hojohap@mailinator.com', NULL, '$2y$10$SVfm3hhuKTGYsgthkOBj.uHjM0xrfJ.gJ8TUUurd1yH/GCTVU3r4u', NULL, NULL, '2022-03-19 08:57:46', '2022-03-19 09:36:46'),
(34, 'Hayley Stanton', 'tagu@mailinator.com', NULL, '$2y$10$68govcZNS5fcRTAFPcIjzODfJNs0UKLT.AJ4V0UWqMWTVX6SmqvOW', NULL, NULL, '2022-03-19 12:12:34', '2022-03-19 12:13:54'),
(35, 'Vance Farmer', 'hogacysi@mailinator.com', NULL, '$2y$10$tblT6h0riD6PAiwx1zMT4.hgbZLSgmsKHlDR7MdxdaV0.ScNTnUAe', NULL, NULL, '2022-03-19 12:16:05', '2022-03-19 12:16:05'),
(36, 'Felicia Snider', 'nuwypyweb@mailinator.com', NULL, '$2y$10$ptP6qStdNVDPsUMfC66uW.2.Mz4Ay286stsjdO9FbYDtg0gTblPeO', NULL, NULL, '2022-03-19 12:16:24', '2022-03-19 12:16:48'),
(37, 'Hayley Morrow', 'pybonota@mailinator.com', NULL, '$2y$10$9hMyb.vEUiVPF4mH.aeFMOfIH5cC4AR1rWveE7RinvdXT3ZXHra7u', '37.jpg', NULL, '2022-03-19 12:52:01', '2022-03-19 13:38:21'),
(39, 'Lois Leach', 'qecowyhiwe@mailinator.com', NULL, '$2y$10$0LKDXGigMPqiELOnkob0Ou24vAC1aP5px.X.4P8N.aLUhogvOVYkq', 'defult.jpg', NULL, '2022-03-19 14:13:40', '2022-03-19 14:13:40'),
(40, 'Stewart Irwin', 'nudozajuh@mailinator.com', NULL, '$2y$10$hzsEGYv3wTCKW5b/tsFvhugNpg0MJt.qi/T1hdgRu2zBSFHSJdIk.', 'defult.jpg', NULL, '2022-03-19 14:54:08', '2022-03-19 14:54:08'),
(41, 'Nolan Wood', 'jyxyhowip@mailinator.com', NULL, '$2y$10$0M5d/zzC3v.YdGySSMZ7WuCuYLlAQ3SEVD.FFX7BfO9khb0NWNUC.', 'defult.jpg', NULL, '2022-03-19 15:03:14', '2022-03-19 15:03:14'),
(42, 'Ian Eaton', 'pynamep@mailinator.com', NULL, '$2y$10$R/3puJoedqrMLaX4UphSmuEa1gJ85/wbaWY21WyKuGR8zMWhHPvWy', 'defult.jpg', 'xx795yRb7aduXafyp6pLW7jMQZaP67rCh4afMhdf7NYJtHDhoRGO1JuYv5gF', '2022-03-19 15:09:05', '2022-03-19 15:09:05'),
(43, 'Damian Justice', 'getoqiqyco@mailinator.com', NULL, '$2y$10$hckF1XBu6XZFhiijzN77v.hu.OCbrE9X0vwRfbvd.NmZpASo36R4u', '43.jpg', NULL, '2022-03-19 15:10:24', '2022-03-19 15:21:00'),
(44, 'Fatima Koch', 'zegimosi@mailinator.com', NULL, '$2y$10$/2afrE7IbKpTJMkiqWxXcOLyUO.XWjIHJBOUIpCee.SOlOe4PAIWi', 'defult.jpg', NULL, '2022-03-21 23:20:21', '2022-03-21 23:20:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
