-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 09:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_vue`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Electrical Vehicle/e-Power', '50', NULL, NULL),
(2, 'Compact Car', '50', NULL, NULL),
(3, 'Light Car', '50', NULL, NULL),
(4, 'Minivan', '50', NULL, NULL),
(5, 'Sports & Specialty', '50', NULL, NULL),
(6, 'Sedan', '50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `id` int(11) NOT NULL,
  `your_name` varchar(200) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `sending_as` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `uuid` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact_inquiries`
--

INSERT INTO `contact_inquiries` (`id`, `your_name`, `mobile_number`, `email`, `message`, `sending_as`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 'Lokesh', '978550346', 'lokesh@gmail.com', 'Hello', NULL, '2022-04-24 11:04:52', '2022-04-24 11:04:52', 'e90b1269-fb73-4ba5-b19d-3bb0b5c9958a'),
(2, 'Melinda Quinn', '310', 'dyve@mailinator.com', 'Nulla ea libero mole', NULL, '2022-05-03 01:24:10', '2022-05-03 01:24:10', '2fa87c46-f974-4a35-8a6b-47a176028621'),
(3, 'Baxter Mullen', '673', 'levypojad@mailinator.com', 'Rerum voluptatem Vo', NULL, '2022-05-03 01:24:14', '2022-05-03 01:24:14', '06ef837d-4ade-461f-9919-930fe2a1f733');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `used` tinyint(2) NOT NULL DEFAULT 0,
  `expired_at` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `type`, `coupon_value`, `used`, `expired_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Test', 'IPRMLUMO', 'percent', 25, 1, '2022-05-26', NULL, '2022-01-22 07:03:03', '2022-05-06 03:22:13'),
(3, 'Fixed', 'WFQJPBF7', 'fixed', 20, 0, '2022-05-31', NULL, '2022-01-22 07:04:52', '2022-01-26 12:03:18'),
(4, 'Fixed', 'ZPKPFLS5', 'fixed', 5, 0, '2022-01-31', NULL, '2022-01-22 07:04:52', '2022-01-22 07:04:52'),
(5, 'Test', '7GFVI8CY', 'fixed', 2, 0, '2022-01-31', NULL, '2022-01-22 07:05:21', '2022-01-28 11:42:00'),
(6, 'Teee', 'SSJG8RWW', 'fixed', 100, 0, '2022-03-24', NULL, '2022-03-27 03:10:36', '2022-03-27 03:10:36'),
(7, 'Teee', 'MPPQMZQF', 'fixed', 100, 0, '2022-03-24', '2022-03-27 03:15:37', '2022-03-27 03:11:15', '2022-03-27 03:15:37'),
(8, 'asas', 'B2UVBLHO', 'percent', 11, 0, '2022-03-15', '2022-03-27 03:15:31', '2022-03-27 03:12:03', '2022-03-27 03:15:31'),
(9, 'asa', 'IVWQBVEJ', 'percent', 12, 0, '2022-03-08', '2022-03-27 03:15:02', '2022-03-27 03:13:44', '2022-03-27 03:15:02'),
(10, 'sfdfd', '2IYVFNOS', 'fixed', 1212, 0, '2022-03-16', '2022-03-27 03:14:58', '2022-03-27 03:14:10', '2022-03-27 03:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(10) UNSIGNED NOT NULL,
  `course_type` enum('Certified','Non-certified') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `demo_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_length_minutes` int(11) DEFAULT NULL,
  `total_view` int(11) NOT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `category_id`, `sub_category_id`, `course_type`, `price`, `demo_url`, `total_length_minutes`, `total_view`, `banner_image`, `status`, `user_id`, `uuid`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 1, 1, 'Non-certified', '21.00', 'https://vimeo.com/703355279', 500, 2, NULL, 0, '1', 'f785d9c6-7d9f-4811-a610-fd5ae14a1bb1', NULL, '2022-02-22 04:06:20', '2022-04-24 11:26:25', NULL),
(2, 'sas', 3, 1, 'Certified', '212.00', 'https://vimeo.com/703355279', 600, 0, NULL, 0, '1', '0c794501-3fa6-4bac-b7c2-2b220bfa0f0c', '1', '2022-02-22 05:15:51', '2022-02-22 05:16:09', '2022-02-22 05:16:09'),
(3, 'sas', 2, 2, 'Certified', '212.00', 'https://vimeo.com/703355279', 600, 0, NULL, 0, '1', '685a2d18-9d00-48a6-9c5c-1f72b928c0b5', '12', '2022-02-22 05:52:09', '2022-03-01 06:08:25', NULL),
(4, 'sasasas', 3, 1, 'Certified', '24.00', 'https://vimeo.com/703355279', 150, 0, 'uploads/course/0703515133937341645599831__Chemistry.jpg', 0, '1', '9392da61-ffb3-4d98-b65e-145d83c97b31', 'asa', '2022-02-22 08:15:26', '2022-02-23 03:41:08', NULL),
(5, 'Test 2', 3, 1, 'Non-certified', '100.00', 'https://vimeo.com/703355279', 200, 0, 'uploads/course/07045617540142241645599896__Course4.jfif', 0, '1', '922c8954-8565-4af7-bc91-2a9f6009b3ea', 'null', '2022-02-23 01:23:42', '2022-03-31 03:53:56', NULL),
(6, 'Test 2', 3, 1, 'Non-certified', '100.00', 'https://vimeo.com/703355279', 200, 0, 'uploads/course/07045617540142241645599896__Course4.jfif', 0, '1', '922c8954-8565-4af7-bc91-2a9f6009b3ea', 'null', '2022-02-23 01:23:42', '2022-03-31 03:53:56', NULL),
(7, 'Test 2', 3, 1, 'Non-certified', '100.00', 'https://vimeo.com/703355279', 200, 0, 'uploads/course/07045617540142241645599896__Course4.jfif', 0, '1', '922c8954-8565-4af7-bc91-2a9f6009b3ea', 'null', '2022-02-23 01:23:42', '2022-03-31 03:53:56', NULL),
(8, 'Test 2', 3, 1, 'Non-certified', '100.00', 'https://vimeo.com/703355279', 200, 0, 'uploads/course/07045617540142241645599896__Course4.jfif', 0, '1', '922c8954-8565-4af7-bc91-2a9f6009b3ea', 'null', '2022-02-23 01:23:42', '2022-03-31 03:53:56', NULL),
(9, 'Test 2', 3, 1, 'Non-certified', '100.00', 'https://vimeo.com/703355279', 200, 0, 'uploads/course/07045617540142241645599896__Course4.jfif', 0, '1', '922c8954-8565-4af7-bc91-2a9f6009b3ea', 'null', '2022-02-23 01:23:42', '2022-03-31 03:53:56', NULL),
(10, 'sasasas', 3, 1, 'Certified', '24.00', 'https://vimeo.com/703355279', 111, 0, 'uploads/course/0703515133937341645599831__Chemistry.jpg', 0, '1', '9392da61-ffb3-4d98-b65e-145d83c97b31', 'asa', '2022-02-22 08:15:26', '2022-02-23 03:41:08', NULL),
(11, 'sas', 3, 1, 'Certified', '212.00', 'https://vimeo.com/703355279', 1213, 0, NULL, 0, '1', '0c794501-3fa6-4bac-b7c2-2b220bfa0f0c', '1', '2022-02-22 05:15:51', '2022-02-22 05:16:09', '2022-02-22 05:16:09'),
(12, 'sas', 2, 2, 'Certified', '212.00', 'https://vimeo.com/703355279', 222, 0, NULL, 0, '1', '685a2d18-9d00-48a6-9c5c-1f72b928c0b5', '12', '2022-02-22 05:52:09', '2022-03-01 06:08:25', NULL),
(13, 'sas', 3, 1, 'Certified', '212.00', 'https://vimeo.com/703355279', 333, 0, NULL, 0, '1', '0c794501-3fa6-4bac-b7c2-2b220bfa0f0c', '1', '2022-02-22 05:15:51', '2022-02-22 05:16:09', '2022-02-22 05:16:09'),
(14, 'sas', 2, 2, 'Certified', '212.00', 'https://vimeo.com/703355279', 23, 0, NULL, 0, '1', '685a2d18-9d00-48a6-9c5c-1f72b928c0b5', '12', '2022-02-22 05:52:09', '2022-03-01 06:08:25', NULL),
(15, 'sas', 2, 2, 'Certified', '212.00', 'https://vimeo.com/703355279', 232, 0, NULL, 0, '1', '685a2d18-9d00-48a6-9c5c-1f72b928c0b5', '12', '2022-02-22 05:52:09', '2022-03-01 06:08:25', NULL),
(16, 'sas', 2, 2, 'Certified', '212.00', 'https://vimeo.com/703355279', 232, 0, NULL, 0, '1', '685a2d18-9d00-48a6-9c5c-1f72b928c0b5', '12', '2022-02-22 05:52:09', '2022-03-01 06:08:25', NULL);

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_09_044534_create_roles_table', 1),
(10, '2019_12_09_082630_create_role_user_table', 1),
(11, '2019_12_09_094511_create_social_accounts_table', 1),
(12, '2019_12_27_065818_create_products_table', 1),
(13, '2019_12_27_070549_create_categories_table', 1),
(14, '2019_12_27_070603_create_tags_table', 1),
(15, '2020_01_08_113508_create_product_tag_pivot_table', 1),
(16, '2022_02_21_063405_create_sub_category_table', 2),
(17, '2022_02_22_062012_create_courses_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'masteradmin@mailinator.com', '2021-12-25 07:53:29', '2021-12-25 07:53:29'),
(4, 'lokesh@gmail.com', '2022-04-24 11:07:24', '2022-04-24 11:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `storage` varchar(20) DEFAULT 'local',
  `status` tinyint(3) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `file_url`, `storage`, `status`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 'notes/1DXPMcB8bCywNJlanstjTzynqw9KQ2vWmtSjyizm.docx', 'local', 1, '2022-01-22 13:45:45', '2022-01-22 13:45:45', 'a697ef67-44a7-4b07-91a4-a906773a9396'),
(2, 'notes/cFWE8NsAtCp2hUaktROB4REWIxqvNovCUIpMbngf.pdf', 'local', 1, '2022-01-22 13:48:03', '2022-01-22 13:48:03', 'c5aa2a22-4700-48ce-a421-353d5179cee6');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0419016a5d0b9860094801b01eabd42e3e621890f72f769a00b2cdc06b2f162f00df2d08caeabc1f', 14, 3, 'MyApp', '[]', 0, '2022-05-03 01:28:35', '2022-05-03 01:28:35', '2023-05-03 06:58:35'),
('061cdbec42b38983b46b3502a5d80d3585f9eff32f05717a647223e6a2b400ed5235b964a38ed44f', 13, 3, 'MyApp', '[]', 0, '2022-05-02 06:05:24', '2022-05-02 06:05:24', '2023-05-02 11:35:24'),
('0bdfc920fbd5038c4840756fb497f58aff9f0302fb4e036e6ae69ad81562d9c0e8c016ff8bb9198f', 14, 2, NULL, '[\"*\"]', 0, '2022-05-09 05:24:54', '2022-05-09 05:24:54', '2022-05-10 10:54:54'),
('168575e65978e54b7aa854055a322a58d5fc8190c9f15716fdcb5191f386d3f3e7254ce4c40b3432', 4, 3, 'MyApp', '[]', 0, '2022-05-02 07:51:24', '2022-05-02 07:51:24', '2023-05-02 13:21:24'),
('194813fa242d005f2f00f31fd68c174099be12a91542d6808d1243e88285e6ace56e566dd399a262', 4, 3, 'MyApp', '[]', 0, '2022-05-02 07:54:22', '2022-05-02 07:54:22', '2023-05-02 13:24:22'),
('1b7eb47de1f59ccf73c744a70b134ff790f920d1991c3cdf9ba4eae3325166bd10dd3894c7fef6c8', 14, 2, NULL, '[\"*\"]', 0, '2022-05-12 05:39:55', '2022-05-12 05:39:55', '2022-05-13 11:09:55'),
('37a6460746a3111669e68460f76cea2ffb7ab05328f74e45de332e42fb2916982999aaf1aff2a030', 4, 2, NULL, '[\"*\"]', 0, '2022-05-02 07:53:18', '2022-05-02 07:53:18', '2022-05-03 13:23:18'),
('44984902ad8806b7326e99b1504e46f53423b12927b1c457025aad60797c2dead157dfc9aff180b3', 4, 2, NULL, '[\"*\"]', 0, '2022-05-05 00:04:59', '2022-05-05 00:04:59', '2022-05-06 05:34:59'),
('49140a8966ffa6123313943357efb46de6b82285ae0662c437ab5f228dee2fff1998e39f22d60bf3', 4, 2, NULL, '[\"*\"]', 0, '2022-05-05 08:13:46', '2022-05-05 08:13:46', '2022-05-06 13:43:46'),
('5b72cd6c65164b03cb5203f4e73e11c81867ade440e446bf97510f6af35bebf680baf95f6e97ff6e', 14, 2, NULL, '[\"*\"]', 0, '2022-05-12 05:34:48', '2022-05-12 05:34:48', '2022-05-13 11:04:48'),
('657482b51c3d1bcb8d5f15a6a4e7b98b0a30c1fbdd9e04d2f4be6590249609a04ee0230fc6c214d0', 4, 3, 'MyApp', '[]', 0, '2022-05-02 07:53:15', '2022-05-02 07:53:15', '2023-05-02 13:23:15'),
('6af582b65df88179293d15066c55fd0dab0d8f483950892647e7b067e49111088cedf93ab5e76fb1', 14, 2, NULL, '[\"*\"]', 0, '2022-05-09 05:25:19', '2022-05-09 05:25:19', '2022-05-10 10:55:19'),
('799746d6ecbb11607d463c8375801b95be2da6b320da4e54d49e4a69ff1db705e8cede836f6d335f', 4, 2, NULL, '[\"*\"]', 0, '2022-05-05 08:18:04', '2022-05-05 08:18:04', '2022-05-06 13:48:04'),
('81a339ac4ee62c191dde1e50d14cd763205500fa5ed25c922c2c90bc67f0696477a633cee5c6af49', 14, 2, NULL, '[\"*\"]', 0, '2022-05-12 01:12:14', '2022-05-12 01:12:14', '2022-05-13 06:42:14'),
('8249545df166ca3cde2eb1a80dc43af892ad02a76db315996368eddb27c520dfa09bc8c11d9b867d', 4, 3, 'MyApp', '[]', 0, '2022-05-02 04:38:37', '2022-05-02 04:38:37', '2023-05-02 10:08:37'),
('8b1cae125f6ee61da95f52edf9c858be074d2f99103a9b1d993efe7cbc612bd2775c4f40a9b4c3ef', 11, 3, 'MyApp', '[]', 0, '2022-05-02 00:38:57', '2022-05-02 00:38:57', '2023-05-02 06:08:57'),
('8e41abce7938f741d196079323451e21970c5545f46186a62837790256d6695649569d704ee387ad', 4, 3, 'MyApp', '[]', 0, '2022-05-02 04:41:38', '2022-05-02 04:41:38', '2023-05-02 10:11:38'),
('9117d8e80cab2321879c5e0f3d00d154dd272c9e517778efb0f5647a5e6fe9ea00619fe5216494c7', 12, 3, 'MyApp', '[]', 0, '2022-05-02 03:56:53', '2022-05-02 03:56:53', '2023-05-02 09:26:53'),
('9496fa23877cf46be65b5dc94c9a82e5e82723b01e8915a75b30cb6de105a19e4ebd8c7a5f365b58', 4, 3, 'MyApp', '[]', 0, '2022-05-02 07:49:47', '2022-05-02 07:49:47', '2023-05-02 13:19:47'),
('9b6f387c1c7930ca75e799ed01e67ee47b0ade57d19d926afc6e26f42a9fb7f0ea9a494affc077fa', 14, 2, NULL, '[\"*\"]', 0, '2022-05-12 05:29:39', '2022-05-12 05:29:39', '2022-05-13 10:59:39'),
('af3a2b9570ae71e3d7346130b0a9e22c8a6fbb0a57218dcc286ede8afbe59e98778be448be73a388', 12, 3, 'MyApp', '[]', 0, '2022-05-02 03:59:32', '2022-05-02 03:59:32', '2023-05-02 09:29:32'),
('b2db63b873b3ee85eaeba8db8cf4a50235604c7ab41c743e96c415ae449e2171e7606098df2ead1c', 4, 3, 'MyApp', '[]', 0, '2022-05-02 07:50:28', '2022-05-02 07:50:28', '2023-05-02 13:20:28'),
('b83a0568a3122551f22f4e8c82a58a0f947b8817c57b24203ad8be93ac5cb4d16e79098c91a0b6d9', 14, 2, NULL, '[\"*\"]', 0, '2022-05-12 05:32:41', '2022-05-12 05:32:41', '2022-05-13 11:02:41'),
('c2458a8b3c361af51fbffad4ecdd5e6a97dca3276dd58586de6052b8b8a996bc3d62936971504ecd', 4, 2, NULL, '[\"*\"]', 0, '2022-05-04 05:42:48', '2022-05-04 05:42:48', '2022-05-05 11:12:48'),
('c85436c8ade2be038bc41360e650162efaa9292bd8a41ea7501d988a2bf230a3fa711669e2252935', 15, 3, 'MyApp', '[]', 0, '2022-05-09 05:26:00', '2022-05-09 05:26:00', '2023-05-09 10:56:00'),
('ec1ac3ade5b65c8752b7317af3a7659a12601f4c496579219a8659e56ec9bf2795320f46a886cf56', 4, 2, NULL, '[\"*\"]', 0, '2022-05-02 07:54:24', '2022-05-02 07:54:24', '2022-05-03 13:24:24'),
('f17685950ce01df2244480b2d646e056d5935d1d05db0bbfb488cb8270b91b5f68c4afbd53c1c3ea', 14, 2, NULL, '[\"*\"]', 0, '2022-05-12 05:28:55', '2022-05-12 05:28:55', '2022-05-13 10:58:55'),
('f193192c0ae8f7f206ada57856b69aa83bdec1187100e448605e8f77c1684ff310f550e9ee184867', 4, 2, NULL, '[\"*\"]', 0, '2022-05-02 07:55:08', '2022-05-02 07:55:08', '2022-05-03 13:25:08'),
('f2fce9b6075e1dab62054506b4bb7f21ca2fed1530f96dfa37e61fb83ddd9c8e392423e65dbcbb85', 4, 2, NULL, '[\"*\"]', 0, '2022-05-09 03:51:38', '2022-05-09 03:51:38', '2022-05-10 09:21:38'),
('f8b4efa9b784e67d91b79dd5a50efdedc8c3f8f7f8cd6d0e492ce2e0145f78414f832c1971caf40a', 4, 2, NULL, '[\"*\"]', 0, '2022-05-11 03:51:32', '2022-05-11 03:51:32', '2022-05-12 09:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Starter Personal Access Client', 'j6CPsGuEUQzxe5DXza77zs2WJxkXnpdPgIPxLOwL', NULL, 'http://localhost', 1, 0, 0, '2022-02-18 03:32:52', '2022-02-18 03:32:52'),
(2, NULL, 'Laravel Starter Password Grant Client', 'PPgRuppmnVmghcWMkolROFuwpOLEqQcSXai1zJKS', 'users', 'http://localhost', 0, 1, 0, '2022-02-18 03:32:52', '2022-02-18 03:32:52'),
(3, NULL, 'Laravel Starter Personal Access Client', 'WOCe6Jh8xYzqXRFb3SF8JON0fUaqnH2rzFG6c4XS', NULL, 'http://localhost', 1, 0, 0, '2022-02-18 07:44:45', '2022-02-18 07:44:45'),
(4, NULL, 'Laravel Starter Password Grant Client', '40ZvlXPqoPa4uE6cVw2inXu2CGMEVsILRlFyBrkG', 'users', 'http://localhost', 0, 1, 0, '2022-02-18 07:44:45', '2022-02-18 07:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-02-18 03:32:52', '2022-02-18 03:32:52'),
(2, 3, '2022-02-18 07:44:45', '2022-02-18 07:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('044cd62001bc630c89d01b1830263ccca484e22b79c0599bd7659cb2a425c90abfc7579df2bb522a', '5b72cd6c65164b03cb5203f4e73e11c81867ade440e446bf97510f6af35bebf680baf95f6e97ff6e', 0, '2022-05-22 11:04:48'),
('081f19271e996abdbb044adb855f16677447b48574ca3eb7185156de3e5cbfb70bdacd0c82476702', '0bdfc920fbd5038c4840756fb497f58aff9f0302fb4e036e6ae69ad81562d9c0e8c016ff8bb9198f', 0, '2022-05-19 10:54:54'),
('12ca71577997bbc86c89370e0a6662daa9183d01b659a8994e9f88ccb491a0d999432b191d27649d', '9b6f387c1c7930ca75e799ed01e67ee47b0ade57d19d926afc6e26f42a9fb7f0ea9a494affc077fa', 0, '2022-05-22 10:59:39'),
('3c8831186cc9fcf66a1a899138b399b2d1c34e43deec2deb3295baade50ee504070d5ee90a7d78f8', '81a339ac4ee62c191dde1e50d14cd763205500fa5ed25c922c2c90bc67f0696477a633cee5c6af49', 0, '2022-05-22 06:42:14'),
('5b78066f9a06d6058d86a45f7dd96da4ea9d2899237a93c9e31a9a4889c43584759ca435b5a9bfd1', 'ec1ac3ade5b65c8752b7317af3a7659a12601f4c496579219a8659e56ec9bf2795320f46a886cf56', 0, '2022-05-12 13:24:24'),
('5da976a71c0648484ba3de341d0af5d905ef68d0f3f38a9c07108dd0ea4903bc864b369fd4bddc1d', 'f193192c0ae8f7f206ada57856b69aa83bdec1187100e448605e8f77c1684ff310f550e9ee184867', 0, '2022-05-12 13:25:08'),
('5f7442ab61cffa9f42636836f978e7e85cd488afbdeb9019276c24762d9165a58cdd3df7abf7d69f', '44984902ad8806b7326e99b1504e46f53423b12927b1c457025aad60797c2dead157dfc9aff180b3', 0, '2022-05-15 05:34:59'),
('68f1e061ab6766827b2a98e629b472f153b619b35b4d0b01b0cb32f0940bb7f386c9a2b62244b685', '1b7eb47de1f59ccf73c744a70b134ff790f920d1991c3cdf9ba4eae3325166bd10dd3894c7fef6c8', 0, '2022-05-22 11:09:55'),
('74d8c039efcec49f7ac2e003e6df92c92ff8b1a29904ab1fe4191cec1b152eb78ad2938cd4b268e3', 'f2fce9b6075e1dab62054506b4bb7f21ca2fed1530f96dfa37e61fb83ddd9c8e392423e65dbcbb85', 0, '2022-05-19 09:21:38'),
('97458099df7d3ea1972ad92748b7016ceaa2272d88173d1fe84c93e77f59d4530a89a8600f3a4d35', 'c2458a8b3c361af51fbffad4ecdd5e6a97dca3276dd58586de6052b8b8a996bc3d62936971504ecd', 0, '2022-05-14 11:12:48'),
('a5a75d5518561b4e79fdb9be32560fe3c8da5862107bd1149becf3bfcd24577bb1d1c4331cec04bd', '49140a8966ffa6123313943357efb46de6b82285ae0662c437ab5f228dee2fff1998e39f22d60bf3', 0, '2022-05-15 13:43:46'),
('a635af479ac67a11f0ad9a8ac7a8a1fc1c87a91de6c2eba4459bfb12837f430aed986afce03d0658', '799746d6ecbb11607d463c8375801b95be2da6b320da4e54d49e4a69ff1db705e8cede836f6d335f', 0, '2022-05-15 13:48:04'),
('ba9aa20ca953b55195e6197603d9d11c8f1f9b9f071b14f0b3b87bbc686a035baebe68fb3f6a6494', 'f17685950ce01df2244480b2d646e056d5935d1d05db0bbfb488cb8270b91b5f68c4afbd53c1c3ea', 0, '2022-05-22 10:58:55'),
('bfdfdb335225d27f7c9f2d7499207b36f8a8d57a1967991025b261147016c527caa8c58498200a26', 'f8b4efa9b784e67d91b79dd5a50efdedc8c3f8f7f8cd6d0e492ce2e0145f78414f832c1971caf40a', 0, '2022-05-21 09:21:32'),
('d864269d1bf3a0a20fa7d55004974de0c7b2a0ab742fedd164e8ceab5dcf94300b39325cd2d834da', '37a6460746a3111669e68460f76cea2ffb7ab05328f74e45de332e42fb2916982999aaf1aff2a030', 0, '2022-05-12 13:23:18'),
('e99738c25a8a67e6788a83efe2aab8d86342c919e2420343bf726a32308e38efa46a065d19804754', '6af582b65df88179293d15066c55fd0dab0d8f483950892647e7b067e49111088cedf93ab5e76fb1', 0, '2022-05-19 10:55:19'),
('f3f96bb54bc038bc1b743e099f19982a94679245056ab8722ce5f974096b6631bfdc2f8fbc1124ca', 'b83a0568a3122551f22f4e8c82a58a0f947b8817c57b24203ad8be93ac5cb4d16e79098c91a0b6d9', 0, '2022-05-22 11:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `page_content`, `create_at`, `updated_at`) VALUES
(1, 'About Us', '<p>&nbsp;</p>\n<p><strong>lorem </strong>ipsum Dolor, Sit Amet Consectetur Adipisicing Elit. Rem, Ab Quis At Ducimus Libero Unde Corrupti Veritatis Ad Error Maxime! Repellat Dolor Iure Facilis Expedita Cum Nisi Perspiciatis, Itaque Quis! Lorem Ipsum Dolor, Sit Amet Consectetur Adipisicing Elit. Rem, Ab Quis At Ducimus Libero Unde Corrupti Veritatis Ad Error Maxime! Repellat Dolor Iure Facilis Expedita Cum Nisi Perspiciatis, Itaque Quis! Lorem Ipsum Dolor, Sit Amet Consectetur Adipisicing Elit. Rem, Ab Quis At Ducimus Libero Unde Corrupti Veritatis Ad Error Maxime! Repellat Dolor Iure Facilis Expedita Cum Nisi Perspiciatis, Itaque Quis! S</p>', NULL, '2022-03-27 06:37:33'),
(2, 'Privacy Policy', '<p>lorem Ipsum Dolor, Sit Amet Consectetur Adipisicing Elit. Rem, Ab Quis At Ducimus Libero Unde Corrupti Veritatis Ad Error Maxime! Repellat Dolor Iure Facilis Expedita Cum Nisi Perspiciatis, Itaque Quis! Lorem Ipsum Dolor,</p>', NULL, '2022-03-27 06:38:25'),
(3, 'Terms & Conditions', 'Terms & Conditions', NULL, NULL);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cima', 'The charm of this car. Choose CIMA. It is the pride and pleasure of choosing one vertex.', '45414388', 5, 'images/cars/cima_1912_top_01.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(2, 'Fuga', 'The Infiniti brand is highly regarded for its advanced design and powerful performance in each of its markets, including the U.S., Canada, Europe, Russia, the Middle East, China and Korea. With its highly refined style and responsiveness, Infiniti promises a driving experience with unparalleled appeal.', '30788641', 2, 'images/cars/fuga_1912_top_02 . jpg . ximg . l_full_m . smart . jpg', NULL, NULL, NULL),
(3, 'Skyline', 'Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '54783313', 2, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(4, 'Sylphy', 'Comfort to enjoy driving while relaxing.\r\n                The interior space on a class that has become even wider, and ample rear seats.\r\n                Here is a state-of-the-art environment where all occupants are comfortably wrapped.', '93947744', 1, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(5, 'Teana', 'Comfort of \"modern living\". Consideration of \"hospitality\". Tiana has found a value that has never been in a sedan before. Refining its modern living and hospitality, Tiana offers a cruise-like, elegant travel experience. Lets go to Tiana Cruz.', '29380575', 2, 'images/cars/teana_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(6, 'Leaf', 'NISSAN CROSSING. The Nissan Gallery in Ginza will now be born again as NISSAN CROSSING, a base to dispatch the Nissan brand globally.', '35296519', 2, 'images/cars/panel01_img01.jpg', NULL, NULL, NULL),
(7, 'Skyline 2 ', 'Details Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '91473152', 3, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(8, 'Cima', 'The charm of this car. Choose CIMA. It is the pride and pleasure of choosing one vertex.', '5470605', 5, 'images/cars/cima_1912_top_01.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(9, 'Fuga', 'The Infiniti brand is highly regarded for its advanced design and powerful performance in each of its markets, including the U.S., Canada, Europe, Russia, the Middle East, China and Korea. With its highly refined style and responsiveness, Infiniti promises a driving experience with unparalleled appeal.', '20338428', 2, 'images/cars/fuga_1912_top_02 . jpg . ximg . l_full_m . smart . jpg', NULL, NULL, NULL),
(10, 'Skyline', 'Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '94565123', 2, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(11, 'Sylphy', 'Comfort to enjoy driving while relaxing.\r\n                The interior space on a class that has become even wider, and ample rear seats.\r\n                Here is a state-of-the-art environment where all occupants are comfortably wrapped.', '69560402', 1, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(12, 'Teana', 'Comfort of \"modern living\". Consideration of \"hospitality\". Tiana has found a value that has never been in a sedan before. Refining its modern living and hospitality, Tiana offers a cruise-like, elegant travel experience. Lets go to Tiana Cruz.', '31896818', 2, 'images/cars/teana_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(13, 'Leaf', 'NISSAN CROSSING. The Nissan Gallery in Ginza will now be born again as NISSAN CROSSING, a base to dispatch the Nissan brand globally.', '24667110', 2, 'images/cars/panel01_img01.jpg', NULL, NULL, NULL),
(14, 'Skyline 2 ', 'Details Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '47326104', 3, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(15, 'Cima', 'The charm of this car. Choose CIMA. It is the pride and pleasure of choosing one vertex.', '61187544', 5, 'images/cars/cima_1912_top_01.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(16, 'Fuga', 'The Infiniti brand is highly regarded for its advanced design and powerful performance in each of its markets, including the U.S., Canada, Europe, Russia, the Middle East, China and Korea. With its highly refined style and responsiveness, Infiniti promises a driving experience with unparalleled appeal.', '94906878', 2, 'images/cars/fuga_1912_top_02 . jpg . ximg . l_full_m . smart . jpg', NULL, NULL, NULL),
(17, 'Skyline', 'Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '8028561', 2, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(18, 'Sylphy', 'Comfort to enjoy driving while relaxing.\r\n                The interior space on a class that has become even wider, and ample rear seats.\r\n                Here is a state-of-the-art environment where all occupants are comfortably wrapped.', '60508158', 1, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(19, 'Teana', 'Comfort of \"modern living\". Consideration of \"hospitality\". Tiana has found a value that has never been in a sedan before. Refining its modern living and hospitality, Tiana offers a cruise-like, elegant travel experience. Lets go to Tiana Cruz.', '75833169', 2, 'images/cars/teana_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(20, 'Leaf', 'NISSAN CROSSING. The Nissan Gallery in Ginza will now be born again as NISSAN CROSSING, a base to dispatch the Nissan brand globally.', '52174267', 2, 'images/cars/panel01_img01.jpg', NULL, NULL, NULL),
(21, 'Skyline 2 ', 'Details Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '34594126', 3, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(22, 'Cima', 'The charm of this car. Choose CIMA. It is the pride and pleasure of choosing one vertex.', '49117040', 5, 'images/cars/cima_1912_top_01.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(23, 'Fuga', 'The Infiniti brand is highly regarded for its advanced design and powerful performance in each of its markets, including the U.S., Canada, Europe, Russia, the Middle East, China and Korea. With its highly refined style and responsiveness, Infiniti promises a driving experience with unparalleled appeal.', '38633772', 2, 'images/cars/fuga_1912_top_02 . jpg . ximg . l_full_m . smart . jpg', NULL, NULL, NULL),
(24, 'Skyline', 'Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '57267152', 2, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(25, 'Sylphy', 'Comfort to enjoy driving while relaxing.\r\n                The interior space on a class that has become even wider, and ample rear seats.\r\n                Here is a state-of-the-art environment where all occupants are comfortably wrapped.', '48713686', 1, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(26, 'Teana', 'Comfort of \"modern living\". Consideration of \"hospitality\". Tiana has found a value that has never been in a sedan before. Refining its modern living and hospitality, Tiana offers a cruise-like, elegant travel experience. Lets go to Tiana Cruz.', '16942836', 2, 'images/cars/teana_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(27, 'Leaf', 'NISSAN CROSSING. The Nissan Gallery in Ginza will now be born again as NISSAN CROSSING, a base to dispatch the Nissan brand globally.', '75870058', 2, 'images/cars/panel01_img01.jpg', NULL, NULL, NULL),
(28, 'Skyline 2 ', 'Details Datsun will provide an appealing and sustainable motoring experience to optimistic up-and-coming customers in high-growth markets. Datsun combines Nissan Motor\'s 80 years of Japanese car-making expertise with the nearly century-old Datsun Brand DNA. Datsun vehicles will be Local Products ensured by a Global Brand, and starts sales in India, Indonesia, Russia and South Africa from 2014.', '30812010', 3, 'images/cars/sylphy_1803_top_002.jpg.ximg.l_full_m.smart.jpg', NULL, NULL, NULL),
(29, 'Test', 'as', '100', 3, NULL, '2022-02-22 03:49:19', '2022-02-22 03:49:19', NULL),
(30, 'Test', 'sd', '100', 3, NULL, '2022-02-22 03:50:53', '2022-02-22 03:50:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qnsans`
--

CREATE TABLE `qnsans` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `course_id` int(5) NOT NULL,
  `topic_id` int(5) NOT NULL,
  `video_id` int(6) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `ans1` text NOT NULL,
  `ans2` text NOT NULL,
  `ans3` text NOT NULL,
  `ans4` text NOT NULL,
  `rightans` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qnsans`
--

INSERT INTO `qnsans` (`id`, `uuid`, `course_id`, `topic_id`, `video_id`, `user_id`, `question`, `ans1`, `ans2`, `ans3`, `ans4`, `rightans`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '4d022dbd-6fef-4b1b-9c56-6d983e00481e', 1, 2, NULL, 1, 'Question 1', 'Ans 4', 'Ans 2', 'Ans 3', 'Ans 4', 'Ans 3', 0, NULL, '2022-04-02 11:57:48', '2022-04-02 12:00:28');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_video_id` int(11) NOT NULL,
  `type` enum('course','video') DEFAULT 'course',
  `rating` int(5) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `uuid` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `course_video_id`, `type`, `rating`, `comment`, `status`, `uuid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'course', 2, 'Test', 1, '', '2022-04-28 10:10:30', NULL, NULL),
(2, 2, 1, 'course', 2, 'Test', 1, '', '2022-04-28 10:10:35', NULL, NULL),
(3, 2, 1, 'course', 3, 'Test', 1, '', '2022-04-28 10:10:38', NULL, NULL),
(4, 15, 1, 'course', 5, 'hhh', 1, '084d4a93-f50e-4a22-aa07-835a0028b3e3', '2022-05-11 04:24:09', '2022-05-11 04:24:09', NULL),
(5, 14, 193, 'video', 3, 'my test review', 1, 'c5045ef8-2f68-4dc6-bfc0-59c4ffd526f9', '2022-05-12 06:09:38', '2022-05-12 06:09:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `val` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `val`, `created_at`, `updated_at`) VALUES
(1, 'contact_email', 'sharmalk1991@gmail.com', '2019-05-21 15:29:21', '2022-03-27 11:29:24'),
(2, 'admin_email', 'bright-horizon@mailinator.com', '2019-06-06 09:43:18', '2022-03-27 11:29:24'),
(3, 'contact_number', '+91-9785550346', NULL, '2022-03-27 11:29:24'),
(4, 'contact_page_address', 'orem ipsum dolor,<br>sit amet consectetur, adipisicing elit', NULL, '2022-03-27 11:29:24'),
(5, 'facebook_link', '#', NULL, NULL),
(6, 'twitter_link', '#', NULL, NULL),
(7, 'instagram_link', '#', NULL, NULL),
(8, 'linkedin_link', '#', NULL, NULL),
(9, 'youtube_link', '#', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slider_image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `course_id`, `slider_image`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 'BrightHorizon', 1, 'uploads/slider/05384819338278261648791528__0650372840241971643871037__BFSI course images -2.jpg', 'as', 1, NULL, '2022-04-01 00:01:52', '2022-04-01 00:08:48', '55c72ccd-9e00-46d1-b6d0-98d775e46603'),
(2, 'BrightHorizons', 4, 'uploads/slider/05361113934334921648791371__logo.png', 'asas', 1, NULL, '2022-04-01 00:06:11', '2022-04-01 00:10:25', '08e20093-8097-4090-8312-28c56bbe256c');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `user_id` int(11) NOT NULL,
  `provider_user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_favourites`
--

CREATE TABLE `student_favourites` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `course_id` int(11) NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_favourites`
--

INSERT INTO `student_favourites` (`id`, `user_id`, `course_id`, `video_id`, `created_at`, `updated_at`) VALUES
(1, 4, 5, 190, '2022-05-11 03:53:24', '2022-05-11 09:41:33'),
(2, 15, 1, 1, '2022-05-11 05:56:25', '2022-05-11 05:56:25'),
(3, 14, 5, 193, '2022-05-12 06:08:51', '2022-05-12 06:08:51');

-- --------------------------------------------------------

--
-- Table structure for table `student_flag`
--

CREATE TABLE `student_flag` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `video_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_flag`
--

INSERT INTO `student_flag` (`id`, `user_id`, `video_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 4, 190, '11', '2022-05-11 03:51:52', '2022-05-11 03:51:52'),
(2, 15, 1, 'aaaaaaa', '2022-05-11 05:56:49', '2022-05-11 05:56:49'),
(3, 14, 193, 'test flag video', '2022-05-12 06:09:18', '2022-05-12 06:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `category_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Test', 3, 'Test', '2022-02-21 01:28:38', '2022-02-21 01:38:57'),
(2, 'Test 2', 2, NULL, '2022-02-23 01:18:47', '2022-02-23 01:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tag 1', NULL, NULL),
(2, 'Tag 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `course_id`, `status`, `description`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 'Test Topic', 5, 1, 'test', NULL, '2022-03-01 07:17:44', '2022-03-02 01:30:50', '8c190418-5dfb-49df-b34e-cb2523a9b472'),
(2, 'Test 2 Topic', 1, 0, 'test 2', NULL, '2022-03-01 07:22:08', '2022-03-01 07:27:34', 'cc4c9866-4e62-462c-9d55-aafbe8bceb54'),
(3, 'Test tt', 4, 1, NULL, NULL, '2022-03-01 07:28:15', '2022-03-31 04:36:32', '1b8c228e-3cf4-4d46-8a2c-17de795587e2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `email`, `contact`, `dob`, `status`, `image`, `email_verified_at`, `password`, `remember_token`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, 0, '', '2022-02-21 18:30:00', '$2y$10$kYuD1xCz1kGkWCAWgofkSey/JXZB7HBb53HM.BQLDIXz19MadZwV6', 'lQcwxwWjCTQFeKZ4xcWYO03pkUvwQH57fYluDpI8xQst6CRZV5cZc5ijIEUH', '2c2974e6-4612-4010-800b-cb0f0d8467df', '2022-02-22 01:35:36', '2022-02-22 01:35:36'),
(3, 'tutors1', 'user', 'tutors@gmail.com', '9694754693', '2022-03-08', 1, '', NULL, '$2y$10$1MSpDIO3o9Y2IygMADMcFuw9DyOK6fntUTwUCrRd11Y5wtXocR0GC', NULL, 'a4a94aef-c97c-498e-93b5-9e696f13dc1c', '2022-03-25 04:35:44', '2022-03-25 11:33:23'),
(4, 'Student', 'student', 'student@gmail.com', NULL, NULL, 0, '1121559096794281651490515.JPEG', NULL, '$2y$10$A/kxWcOxznCDjzwle5OKtu8ssQ0GfgeEbPp6JcAcfuQLcv5IWtZ8y', NULL, 'c4d1cc0f-6901-4703-9d2c-69a6677eec03', '2022-03-25 04:58:05', '2022-05-02 05:51:55'),
(6, 'student2', 'student', 'student2@gmail.com', '9785550346', '2022-03-26', 1, '', '2022-03-25 05:03:28', '$2y$10$h0ZA3lrVGuTFb/bx4KvfxORitTQtT5kvDjelIobbMymhMqDtr8Tee', NULL, '7b5def20-8455-44cb-ab56-89929a930500', '2022-03-25 05:03:28', '2022-04-01 01:56:33'),
(9, 'tutors2', 'user', 'tutors2@gmail.com', '9785550345', '2022-03-16', 1, '', '2022-03-25 11:35:52', '$2y$10$J/78EkG0jL8SQrSbDOkVn.FwHa0pfaLktTQZxj5wu7WcxV9itrKTO', NULL, '066e7c85-242f-4e43-923d-8b5aa6e1f377', '2022-03-25 11:35:52', '2022-03-25 11:35:52'),
(10, 'Pawan Kr', 'student', 'pawankr@mailinator.com', '9876543210', NULL, 1, NULL, NULL, '$2y$10$vWBZf26QXTi7aobMDRovw.4reCa5wpjsssqWBwQp4e1cKc4NTWn8u', NULL, '983c6e56-c3d0-4d58-b18c-409fa5c3ea30', '2022-05-02 00:35:06', '2022-05-02 00:35:06'),
(11, 'Pawan Kr', 'student', 'pawankr2@mailinator.com', '9876543210', NULL, 1, NULL, NULL, '$2y$10$H7Ou0CUMTaa87fKz/.uGXe5Lrf8Jl//NyHn13mKwupYH5U3dxZSw6', NULL, '4bf7492c-d2df-44de-a80e-2344d83c9694', '2022-05-02 00:38:57', '2022-05-02 03:21:51'),
(12, 'Rahim Roman', 'student', 'tupa@mailinator.com', '4223432', NULL, 1, '1130115362781791651491011.png', NULL, '$2y$10$HhiJgXcNQhLsH.LbCvotOeP/hL.NnqxUcd9Jv6JPFg7wQFpV63fA6', NULL, '8fd0acd1-eb1d-462d-9ea6-efdd3466a285', '2022-05-02 03:56:52', '2022-05-02 06:00:11'),
(13, 'Chester Kaufman', 'student', 'duwi@mailinator.com', '3325345', NULL, 1, '11471916262230271651492039.png', NULL, '$2y$10$Z6jUgS94Mo84VP0Knh0AG.iy6gsoOD1ZO7Kz1NQZz8D8DZjjZY1su', NULL, 'afefaa3e-32af-4053-bcbf-307b66adb6cd', '2022-05-02 06:05:23', '2022-05-02 06:17:19'),
(14, 'Jessica Carlson', 'student', 'mail@mailinator.com', '4354334', NULL, 1, '07073312997045901651561653.png', NULL, '$2y$10$uL6WZbVURsE0JOB9g0KCs.VYx38owAHZ415uvWwVp9gsBbdft0xlK', NULL, '332c3265-f7bf-4bd5-8a03-00fad38de767', '2022-05-03 01:28:34', '2022-05-03 01:37:33'),
(15, 'Jacob Reilly', 'student', 'jine@mailinator.com', '45754754754', NULL, 1, NULL, NULL, '$2y$10$7A/0u2Bb5jaXZJkeLHusCegX21y/RGdfQYGHtzL.Isc5ItCja3i7O', NULL, 'e8f6b70e-42c5-49cf-9ce1-65b389e29292', '2022-05-09 05:25:59', '2022-05-09 05:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `course_id` int(10) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `status` enum('Success','Failed') NOT NULL DEFAULT 'Failed',
  `cupon_code` varchar(50) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `cupon_id` int(11) DEFAULT NULL,
  `expired_on` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `course_id`, `transaction_id`, `price`, `status`, `cupon_code`, `discount`, `cupon_id`, `expired_on`, `created_at`, `updated_at`) VALUES
(5, 14, 5, 'ch_3KwMtTBIHyP0wRjo1xswjgoD', '75', 'Success', 'IPRMLUMO', '25', 2, NULL, '2022-05-06 03:22:13', '2022-05-06 03:22:13'),
(6, 14, 3, 'ch_3KwP6lBIHyP0wRjo0N2cxuNY', '212.00', 'Success', NULL, NULL, NULL, NULL, '2022-05-06 05:44:06', '2022-05-06 05:44:06'),
(7, 15, 1, 'ch_3KxUHGBIHyP0wRjo1XkCxBNs', '21.00', 'Success', NULL, NULL, NULL, NULL, '2022-05-09 05:27:24', '2022-05-09 05:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `video_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topic_id` bigint(20) UNSIGNED DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note_id` bigint(20) UNSIGNED DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `video_note` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_views` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `course_id`, `video_id`, `video_url`, `description`, `topic_id`, `user_id`, `note_id`, `status`, `video_note`, `total_views`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(52, 'sas', 1, '668904983', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 'Css Introduction', 2, 1, 2, 1, NULL, NULL, '2022-04-01 01:50:02', '2022-01-20 15:47:33', '2022-04-01 01:50:02', '72463de1-7572-4e7e-8082-9b780ffda664'),
(190, 'Test', 5, '668904983', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 's', 1, 1, 0, 1, '', 2, NULL, '2022-01-28 06:52:16', '2022-05-09 04:42:58', '174734f0-6a42-4a19-a41d-64aac4f7df7d'),
(191, 'asas', 1, '669302195', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 'f', 2, 121, 0, 1, NULL, NULL, '2022-01-28 13:12:35', '2022-01-28 13:02:13', '2022-01-28 13:12:35', '61d61c10-0161-49ff-bc68-85322e8c98ab'),
(192, NULL, 2, '669302195', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 's', 3, 121, 0, 1, NULL, NULL, '2022-01-28 13:16:15', '2022-01-28 13:16:02', '2022-01-28 13:16:15', '0e322a23-e9cd-47d9-afc3-2b4a14173f6e'),
(193, 'dds', 1, NULL, 'https://vimeo.com/669302195', 'https://vimeo.com/669302195', 2, 1, 0, 1, 'uploads/video_note/0727338067906501648798053__0650372840241971643871037__BFSI course images -2.jpg', NULL, NULL, '2022-04-01 01:57:33', '2022-04-01 01:57:33', '6035dcd0-ce10-4545-9f48-d63fbcc5d09b'),
(194, 'dds', 1, NULL, 'https://vimeo.com/669302195', 'https://vimeo.com/669302195', 2, 1, 0, 1, 'uploads/video_note/0727564736969931648798076__0650372840241971643871037__BFSI course images -2.jpg', NULL, NULL, '2022-04-01 01:57:56', '2022-04-01 01:57:56', 'f19331fa-8435-4fcd-849c-85cbdb90350e'),
(195, 'ds', 1, NULL, 'https://vimeo.com/manage/videos/668895604', 'https://vimeo.com/manage/videos/668895604', 2, 1, 0, 1, 'uploads/video_note/0842244668031001648802544__NEAT AICTE (2).pdf', NULL, NULL, '2022-04-01 02:00:07', '2022-04-01 03:12:24', '10c56662-a6a5-4472-85ef-1b9e2cf01f61');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`,`coupon_value`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
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
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qnsans`
--
ALTER TABLE `qnsans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_name_unique` (`key_name`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_favourites`
--
ALTER TABLE `student_favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_flag`
--
ALTER TABLE `student_flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_video_topic` (`topic_id`),
  ADD KEY `FK_video_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `qnsans`
--
ALTER TABLE `qnsans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_favourites`
--
ALTER TABLE `student_favourites`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_flag`
--
ALTER TABLE `student_flag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
