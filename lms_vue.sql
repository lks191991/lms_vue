-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 05:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(20) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `expired_at` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `type`, `coupon_value`, `expired_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Test', 'IPRMLUMO', 'percent', 25, '2022-01-31', NULL, '2022-01-22 07:03:03', '2022-01-25 13:31:56'),
(3, 'Fixed', 'WFQJPBF7', 'fixed', 20, '2022-01-31', NULL, '2022-01-22 07:04:52', '2022-01-26 12:03:18'),
(4, 'Fixed', 'ZPKPFLS5', 'fixed', 5, '2022-01-31', NULL, '2022-01-22 07:04:52', '2022-01-22 07:04:52'),
(5, 'Test', '7GFVI8CY', 'fixed', 2, '2022-01-31', NULL, '2022-01-22 07:05:21', '2022-01-28 11:42:00'),
(6, 'Teee', 'SSJG8RWW', 'fixed', 100, '2022-03-24', NULL, '2022-03-27 03:10:36', '2022-03-27 03:10:36'),
(7, 'Teee', 'MPPQMZQF', 'fixed', 100, '2022-03-24', '2022-03-27 03:15:37', '2022-03-27 03:11:15', '2022-03-27 03:15:37'),
(8, 'asas', 'B2UVBLHO', 'percent', 11, '2022-03-15', '2022-03-27 03:15:31', '2022-03-27 03:12:03', '2022-03-27 03:15:31'),
(9, 'asa', 'IVWQBVEJ', 'percent', 12, '2022-03-08', '2022-03-27 03:15:02', '2022-03-27 03:13:44', '2022-03-27 03:15:02'),
(10, 'sfdfd', '2IYVFNOS', 'fixed', 1212, '2022-03-16', '2022-03-27 03:14:58', '2022-03-27 03:14:10', '2022-03-27 03:14:58');

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

INSERT INTO `courses` (`id`, `name`, `category_id`, `sub_category_id`, `course_type`, `price`, `demo_url`, `total_length_minutes`, `banner_image`, `status`, `user_id`, `uuid`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 1, 1, 'Non-certified', '21.00', 'test', NULL, NULL, 0, NULL, 'f785d9c6-7d9f-4811-a610-fd5ae14a1bb1', NULL, '2022-02-22 04:06:20', '2022-03-01 03:42:45', NULL),
(2, 'sas', 3, 1, 'Certified', '212.00', '12', NULL, NULL, 0, NULL, '0c794501-3fa6-4bac-b7c2-2b220bfa0f0c', '1', '2022-02-22 05:15:51', '2022-02-22 05:16:09', '2022-02-22 05:16:09'),
(3, 'sas', 2, 2, 'Certified', '212.00', '12', NULL, NULL, 0, NULL, '685a2d18-9d00-48a6-9c5c-1f72b928c0b5', '12', '2022-02-22 05:52:09', '2022-03-01 06:08:25', NULL),
(4, 'sasasas', 3, 1, 'Certified', '24.00', 'sasas', NULL, 'uploads/course/0703515133937341645599831__Chemistry.jpg', 0, NULL, '9392da61-ffb3-4d98-b65e-145d83c97b31', 'asa', '2022-02-22 08:15:26', '2022-02-23 03:41:08', NULL),
(5, 'Test 2', 3, 1, 'Non-certified', '100.00', 'sd', 200, 'uploads/course/07045617540142241645599896__Course4.jfif', 0, NULL, '922c8954-8565-4af7-bc91-2a9f6009b3ea', 'null', '2022-02-23 01:23:42', '2022-03-31 03:53:56', NULL);

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
(4, 'contact_page_address', 'orem ipsum dolor,<br>sit amet consectetur, adipisicing elit', NULL, '2022-03-27 11:29:24');

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

INSERT INTO `users` (`id`, `name`, `type`, `email`, `contact`, `dob`, `status`, `email_verified_at`, `password`, `remember_token`, `uuid`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, 0, '2022-02-21 18:30:00', '$2y$10$kYuD1xCz1kGkWCAWgofkSey/JXZB7HBb53HM.BQLDIXz19MadZwV6', NULL, '2c2974e6-4612-4010-800b-cb0f0d8467df', '2022-02-22 01:35:36', '2022-02-22 01:35:36'),
(3, 'tutors1', 'user', 'tutors@gmail.com', '9694754693', '2022-03-08', 1, NULL, '$2y$10$1MSpDIO3o9Y2IygMADMcFuw9DyOK6fntUTwUCrRd11Y5wtXocR0GC', NULL, 'a4a94aef-c97c-498e-93b5-9e696f13dc1c', '2022-03-25 04:35:44', '2022-03-25 11:33:23'),
(4, 'Student', 'student', 'student@gmail.com', NULL, NULL, 0, NULL, '$2y$10$FPZQTuo7ThbrTA9Yrlrpze2OrlR4UAWXcg3XIhN7ku7Yku1Uoim0y', NULL, 'c4d1cc0f-6901-4703-9d2c-69a6677eec03', '2022-03-25 04:58:05', '2022-03-25 04:58:05'),
(6, 'student2', 'student', 'student2@gmail.com', '9785550346', '2022-03-26', 1, '2022-03-25 05:03:28', '$2y$10$h0ZA3lrVGuTFb/bx4KvfxORitTQtT5kvDjelIobbMymhMqDtr8Tee', NULL, '7b5def20-8455-44cb-ab56-89929a930500', '2022-03-25 05:03:28', '2022-04-01 01:56:33'),
(9, 'tutors2', 'user', 'tutors2@gmail.com', '9785550345', '2022-03-16', 1, '2022-03-25 11:35:52', '$2y$10$J/78EkG0jL8SQrSbDOkVn.FwHa0pfaLktTQZxj5wu7WcxV9itrKTO', NULL, '066e7c85-242f-4e43-923d-8b5aa6e1f377', '2022-03-25 11:35:52', '2022-03-25 11:35:52');

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
(52, NULL, 1, '668904983', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 'Css Introduction', 143, 1, 2, 1, NULL, NULL, '2022-04-01 01:50:02', '2022-01-20 15:47:33', '2022-04-01 01:50:02', '72463de1-7572-4e7e-8082-9b780ffda664'),
(190, 'Test', 5, '668904983', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 's', 1, 1, 0, 1, '', NULL, NULL, '2022-01-28 06:52:16', '2022-03-31 06:53:44', '174734f0-6a42-4a19-a41d-64aac4f7df7d'),
(191, NULL, 1, '669302195', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 'f', 189, 121, 0, 1, NULL, NULL, '2022-01-28 13:12:35', '2022-01-28 13:02:13', '2022-01-28 13:12:35', '61d61c10-0161-49ff-bc68-85322e8c98ab'),
(192, NULL, 2, '669302195', 'https://player.vimeo.com/video/669302195?h=ec3da27079', 's', 190, 121, 0, 1, NULL, NULL, '2022-01-28 13:16:15', '2022-01-28 13:16:02', '2022-01-28 13:16:15', '0e322a23-e9cd-47d9-afc3-2b4a14173f6e'),
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
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
