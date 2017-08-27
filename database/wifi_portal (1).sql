-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2017 at 01:04 AM
-- Server version: 5.7.18-0ubuntu0.16.10.1
-- PHP Version: 7.0.15-0ubuntu0.16.10.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wifi_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `name`, `email`, `password`, `site_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'YKKO', 'ykko@gmail.com', '$2y$10$xN26OH84Ch.dCbhA2ZQfNOzr1m8gx/TOifcLLnzV2KtX8ARNofXNG', '["2"]', 1, '2017-08-17 11:24:16', '2017-08-17 11:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int(11) NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_id` bigint(20) NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `user_ap` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating_value` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `name`, `email`, `gender`, `age`, `phone`, `custom_1`, `custom_2`, `site_id`, `comment`, `status`, `user_ap`, `rating_key`, `rating_value`, `created_at`, `updated_at`) VALUES
(1, 'fiberno', 'fiberno@gmail.com', 1, '1', '254545452', NULL, NULL, 2, 'asfd', 1, '324fdfdfd', NULL, NULL, '2017-08-27 02:13:34', '2017-08-27 07:56:20'),
(2, 'fibernbo', 'indepentdent.89@gmail.com', 1, '3', '3434343', NULL, NULL, 2, NULL, 0, 'dc:9f:db:8a:21:b0', NULL, NULL, '2017-08-27 18:18:02', '2017-08-27 18:18:02'),
(3, 'fibernbo', 'indepentdent.89@gmail.com', 1, '3', '3434343', NULL, NULL, 2, NULL, 0, 'dc:9f:db:8a:21:b0', NULL, NULL, '2017-08-27 18:18:44', '2017-08-27 18:18:44'),
(4, 'fibernbo', 'indepentdent.89@gmail.com', 1, '3', '3434343', NULL, NULL, 2, NULL, 0, 'dc:9f:db:8a:21:b0', NULL, NULL, '2017-08-27 18:19:19', '2017-08-27 18:19:19');

-- --------------------------------------------------------

--
-- Table structure for table `image_qlt`
--

CREATE TABLE `image_qlt` (
  `id` int(10) UNSIGNED NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_qlt`
--

INSERT INTO `image_qlt` (`id`, `width`, `height`, `position`, `status`, `created_at`, `updated_at`) VALUES
(2, 500, 500, 1, 1, '2017-08-09 10:09:30', '2017-08-09 10:09:30'),
(3, 600, 300, 2, 1, '2017-08-09 10:09:40', '2017-08-09 10:09:40'),
(4, 1000, 1000, 3, 1, '2017-08-09 10:09:54', '2017-08-09 10:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `landing_fields`
--

CREATE TABLE `landing_fields` (
  `field_id` int(10) UNSIGNED NOT NULL,
  `template_id` int(11) NOT NULL,
  `social_login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_login` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_fields` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_fields`
--

INSERT INTO `landing_fields` (`field_id`, `template_id`, `social_login`, `form_login`, `feedback_fields`, `created_at`, `updated_at`) VALUES
(1, 1, '{"fb":"1","gmail":"1"}', '{"name":"1","n_req":null,"email":"1","e_req":"1","age":"1","a_req":null,"phone":"1","p_req":null,"field_1":null,"f1_req":null,"field_2":null,"f2_req":null}', '{"checkin":"1","like":"1","comment":"1","cbb_require":null,"survey":"1","s_require":"1","r_require":"1","rate":"1"}', '2017-08-17 11:21:09', '2017-08-17 11:22:11'),
(2, 2, '{"fb":"1","gmail":"1"}', '{"name":"1","n_req":"1","email":"1","e_req":"1","age":"1","gender":"1","g_req":"1","a_req":"1","phone":"1","p_req":null,"field_1":null,"f1_req":null,"field_2":null,"f2_req":null}', '{"checkin":"1","like":"1","comment":"1","cbb_require":null,"survey":"1","s_require":null,"r_require":null,"rate":"1"}', '2017-08-21 08:55:22', '2017-08-21 08:56:10');

-- --------------------------------------------------------

--
-- Table structure for table `landing_profiles`
--

CREATE TABLE `landing_profiles` (
  `profile_id` int(10) UNSIGNED NOT NULL,
  `header_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_profiles`
--

INSERT INTO `landing_profiles` (`profile_id`, `header_image`, `background_image`, `footer_image`, `logo_image`, `background_color`, `template_id`, `created_at`, `updated_at`) VALUES
(1, 'header/2017/08/header1502992307.jpg', NULL, 'footer/2017/08/footer1502992307.jpg', 'logo/2017/08/logo1502992307.png', '#006b2d', 1, '2017-08-17 11:21:47', '2017-08-17 11:21:47'),
(2, 'header/2017/08/header1503329157.png', NULL, 'footer/2017/08/footer1503329157.jpg', 'logo/2017/08/logo1503329157.png', NULL, 2, '2017-08-21 08:55:57', '2017-08-25 11:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE `lookups` (
  `lookup_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lookups`
--

INSERT INTO `lookups` (`lookup_id`, `title`, `key`, `value`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Age Group', '2', '18-24', 1, 1, '2017-08-15 10:47:48', '2017-08-15 10:58:40'),
(3, 'Age Group', '3', '25-34', 1, 1, '2017-08-15 10:49:49', '2017-08-15 10:58:50'),
(4, 'Age Group', '1', '13-17', 1, 1, '2017-08-15 10:59:33', '2017-08-17 08:08:07'),
(5, 'GENDER', '1', 'Male', 1, 1, '2017-08-21 08:50:51', '2017-08-21 08:50:51'),
(6, 'GENDER', '2', 'Female', 1, 1, '2017-08-21 08:51:02', '2017-08-21 08:51:02');

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
(3, '2017_08_07_165407_create_sites_table', 2),
(4, '2017_08_07_173313_create_userReach_table', 2),
(5, '2017_08_07_180626_create_imageInfo_table', 2),
(6, '2017_08_08_174345_create_client_table', 3),
(7, '2017_08_10_151625_create_siterequire_table', 4),
(8, '2017_08_10_152202_create_landinginage_table', 4),
(9, '2017_08_13_181622_create_template_table', 5),
(10, '2017_08_15_164833_create_lookup_table', 6),
(11, '2017_08_16_182947_create_addtemplatephoto_table', 7),
(12, '2017_08_17_152942_create_rating_table', 8),
(13, '2017_08_17_170857_create_rations_table', 9),
(14, '2017_08_23_175222_create_survey_table', 10),
(15, '2017_08_23_175242_create_surving_table', 10),
(16, '2017_08_26_150757_create_editguest_table', 11),
(17, '2017_08_26_150810_create_addguest_table', 11),
(18, '2017_08_27_110632_create_editsite_table', 12),
(19, '2017_08_27_122602_create_addguests_table', 13);

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
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `rate_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`rate_id`, `status`, `label`, `created_by`, `created_at`, `updated_at`) VALUES
(1, NULL, 'food', 1, '2017-08-17 09:46:34', '2017-08-17 09:46:34'),
(2, NULL, 'serviece', 1, '2017-08-17 10:56:51', '2017-08-17 10:56:51'),
(3, NULL, 'overall', 1, '2017-08-17 10:57:04', '2017-08-17 10:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(10) UNSIGNED NOT NULL,
  `template_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `template_id`, `rate_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, '2017-08-17 11:42:24', '2017-08-17 11:42:24'),
(4, 1, 3, '2017-08-17 11:42:25', '2017-08-17 11:42:25'),
(26, 2, 1, '2017-08-26 10:01:01', '2017-08-26 10:01:01'),
(27, 2, 2, '2017-08-26 10:01:01', '2017-08-26 10:01:01'),
(28, 2, 3, '2017-08-26 10:01:01', '2017-08-26 10:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `site_id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_limit` int(11) NOT NULL DEFAULT '0',
  `time_limit` int(11) NOT NULL DEFAULT '0',
  `timeout_limit` int(11) DEFAULT NULL,
  `speed_limit` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `site_name`, `site_code`, `data_limit`, `time_limit`, `timeout_limit`, `speed_limit`, `status`, `created_at`, `updated_at`) VALUES
(1, '3454HKKLFELK343', '', 2, 3, 10, 200, 0, '2017-08-17 11:18:29', '2017-08-17 11:18:29'),
(2, 'Ykko Junction City', 'om3sljbl', 3, 6, 5, 50, 1, '2017-08-17 11:18:47', '2017-08-27 15:49:16'),
(3, 'Ykko Hledan', 'adk7878sfd', 200, 5, 5, 100, 1, '2017-08-27 04:45:27', '2017-08-27 04:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `surveying`
--

CREATE TABLE `surveying` (
  `surveying_id` int(10) UNSIGNED NOT NULL,
  `template_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveying`
--

INSERT INTO `surveying` (`surveying_id`, `template_id`, `survey_id`, `created_at`, `updated_at`) VALUES
(7, 2, 1, '2017-08-26 10:01:01', '2017-08-26 10:01:01'),
(8, 2, 2, '2017-08-26 10:01:01', '2017-08-26 10:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `survey_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`survey_id`, `status`, `label`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'i am jusn wanna.', 1, '2017-08-23 11:41:35', '2017-08-23 11:41:35'),
(2, 1, 'Next target', 1, '2017-08-25 12:26:35', '2017-08-25 12:26:35');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `template_id` int(10) UNSIGNED NOT NULL,
  `site_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`template_id`, `site_id`, `status`, `step`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '["1"]', 1, 4, 1, '2017-08-17 11:19:58', '2017-08-17 11:29:44'),
(2, '["2"]', 1, 4, 1, '2017-08-21 08:55:01', '2017-08-25 12:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$CJP5a2FR1lFLux2ylaL8EOIfu5NeS/KE3vt7Krc9ooYQougSjqhi6', 1, 1, NULL, '2017-08-26 08:17:56', '2017-08-26 08:17:56'),
(3, 'fiberno', 'fiberno@gmail.com', '$2y$10$UgrNRNWslOrO3u68C.NjlOXUXGv5vhWb5KwRJV2CgFBmtpPrsl2pe', 1, 1, NULL, '2017-08-26 08:25:21', '2017-08-26 08:25:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `image_qlt`
--
ALTER TABLE `image_qlt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_fields`
--
ALTER TABLE `landing_fields`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `landing_profiles`
--
ALTER TABLE `landing_profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `lookups`
--
ALTER TABLE `lookups`
  ADD PRIMARY KEY (`lookup_id`);

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
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `surveying`
--
ALTER TABLE `surveying`
  ADD PRIMARY KEY (`surveying_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`);

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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `image_qlt`
--
ALTER TABLE `image_qlt`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `landing_fields`
--
ALTER TABLE `landing_fields`
  MODIFY `field_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `landing_profiles`
--
ALTER TABLE `landing_profiles`
  MODIFY `profile_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lookups`
--
ALTER TABLE `lookups`
  MODIFY `lookup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `rate_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `site_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `surveying`
--
ALTER TABLE `surveying`
  MODIFY `surveying_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `survey_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
