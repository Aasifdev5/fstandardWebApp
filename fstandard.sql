-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2025 at 06:19 AM
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
-- Database: `fstandard`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_gallery_images`
--

CREATE TABLE `about_us_gallery_images` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `order` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `about_us_generals`
--

CREATE TABLE `about_us_generals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_area_title` varchar(255) DEFAULT NULL,
  `gallery_area_subtitle` text DEFAULT NULL,
  `gallery_third_image` varchar(255) DEFAULT NULL,
  `gallery_second_image` varchar(255) DEFAULT NULL,
  `gallery_first_image` varchar(255) DEFAULT NULL,
  `our_history_title` varchar(255) DEFAULT NULL,
  `our_history_subtitle` text DEFAULT NULL,
  `upgrade_skill_logo` varchar(255) DEFAULT NULL,
  `upgrade_skill_title` varchar(255) DEFAULT NULL,
  `upgrade_skill_subtitle` text DEFAULT NULL,
  `upgrade_skill_button_name` varchar(255) DEFAULT NULL,
  `team_member_logo` varchar(255) DEFAULT NULL,
  `team_member_title` varchar(255) DEFAULT NULL,
  `team_member_subtitle` text DEFAULT NULL,
  `instructor_support_title` varchar(255) DEFAULT NULL,
  `instructor_support_subtitle` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_generals`
--

INSERT INTO `about_us_generals` (`id`, `gallery_area_title`, `gallery_area_subtitle`, `gallery_third_image`, `gallery_second_image`, `gallery_first_image`, `our_history_title`, `our_history_subtitle`, `upgrade_skill_logo`, `upgrade_skill_title`, `upgrade_skill_subtitle`, `upgrade_skill_button_name`, `team_member_logo`, `team_member_title`, `team_member_subtitle`, `instructor_support_title`, `instructor_support_subtitle`, `created_at`, `updated_at`) VALUES
(1, 'Mere Tranquil Existence, That I Neglect My Talents Should', 'Possession Of My Entire Soul, Like These Sweet Mornings Of Spring Which I Enjoy With My Whole Heart. I Am Alone, And Charm Of Existence In This Spot, Which Was Created For The Bliss Of Souls Like Mine. I Am So Happy, My Dear Friend, So Absorbed In The Exquisite Sense Of Mere Tranquil Existence', 'uploads_demo/gallery/3.jpg', 'uploads_demo/gallery/2.jpg', 'uploads_demo/gallery/1.jpg', 'Our History', 'Possession Of My Entire Soul, Like These Sweet Mornings Of Spring Which I Enjoy With My Whole Heart. I Am Alone, And Charm Of Existence In This Spot Which', 'uploads_demo/about_us_general/upgrade.jpg', 'Upgrade Your Skills Today For Upgrading Your Life.', 'Noticed by me when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence stalks, and grow familiar with the countless', 'Find Your Course', 'uploads_demo/about_us_general/team-members-heading-img.png', 'Our Passionate Team Members', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', 'Quality Course, Instructor And Support', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `coordinates` varchar(255) NOT NULL DEFAULT '0.0,0.0',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `label`, `street`, `city`, `coordinates`, `is_default`, `created_at`, `updated_at`) VALUES
(8, 29, 'Home', '123 Main Street', 'Cityville', '40.7128,-74.0060', 0, '2025-05-24 08:42:47', '2025-05-26 05:02:24'),
(9, 29, 'office', 'Azad nagar', 'indore', '0.0,0.0', 0, '2025-05-24 08:43:59', '2025-05-26 05:02:24'),
(18, 30, 'Home', '86CC+RR3,Industrial Area', 'Burhanpur', '21.3223666,76.2223826', 0, '2025-05-25 07:12:37', '2025-05-25 07:32:06'),
(20, 30, 'Home', '86CC+RR3,Industrial Area', 'Burhanpur', '21.3223666,76.2223826', 1, '2025-05-25 07:32:06', '2025-05-25 07:32:06'),
(21, 29, 'Home', '86CC+RR3,Industrial Area', 'Burhanpur', '21.3223666,76.2223826', 0, '2025-05-25 07:33:26', '2025-05-26 05:02:24'),
(26, 32, 'Home', '86CC+RR3,Industrial Area', 'Burhanpur', '21.3223666,76.2223826', 0, '2025-05-25 07:53:42', '2025-05-25 07:53:57'),
(27, 32, 'Home', '86CC+RR3,Industrial Area', 'Burhanpur', '21.3223666,76.2223826', 1, '2025-05-25 07:53:57', '2025-05-25 07:53:57'),
(31, 33, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 0, '2025-05-26 04:53:04', '2025-05-26 04:53:04'),
(32, 33, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 1, '2025-05-26 04:53:04', '2025-05-26 04:53:04'),
(33, 34, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 0, '2025-05-26 04:56:21', '2025-05-26 04:56:21'),
(34, 34, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 1, '2025-05-26 04:56:21', '2025-05-26 04:56:21'),
(35, 35, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 0, '2025-05-26 04:58:06', '2025-05-26 04:58:06'),
(36, 35, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 1, '2025-05-26 04:58:06', '2025-05-26 04:58:06'),
(37, 29, 'Home', 'Google Building 43', 'Mountain View', '37.4219983,-122.084', 1, '2025-05-26 05:02:24', '2025-05-26 05:02:24'),
(38, 36, 'Home', '138/06,Industrial Area', 'Burhanpur', '21.324985,76.2235441', 0, '2025-05-26 05:20:40', '2025-05-26 05:20:41'),
(39, 36, 'Home', '138/06,Industrial Area', 'Burhanpur', '21.324985,76.2235441', 1, '2025-05-26 05:20:41', '2025-05-26 05:20:41'),
(40, 37, 'Home', '6RH7+CMW,Centro', 'Santa Cruz de la Sierra', '-17.7713817,-63.1857887', 1, '2025-05-26 05:39:43', '2025-05-26 05:39:43'),
(41, 31, 'Home', '246,Av. Cristóbal De Mendoza 246,Centro', 'Santa Cruz de la Sierra', '-17.7714435,-63.1857815', 1, '2025-05-28 16:38:52', '2025-05-28 16:38:52'),
(42, 31, 'Ubicación actual', 'Av. Cristobal de Mendoza # 246 Edificio La Casona', 'Santa Cruz de la Sierra', '-17.7715362,-63.1857979', 0, '2025-05-30 23:45:34', '2025-05-30 23:45:34'),
(43, 37, 'Ubicación actual', 'Av. Cristóbal De Mendoza 246', 'Santa Cruz de la Sierra', '-17.7717747,-63.1858207', 0, '2025-06-02 19:25:06', '2025-06-02 19:25:06'),
(44, 31, 'Ubicación actual', 'Av. Cristóbal De Mendoza 246', 'Santa Cruz de la Sierra', '-17.7714322,-63.1857941', 0, '2025-06-03 16:21:18', '2025-06-03 16:21:18');

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(255) NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 18.00,
  `earnings` decimal(12,2) NOT NULL DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `referral_code`, `commission_rate`, `earnings`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Aasif', 'Ahmed', 'hrnatrajinfotech@gmail.com', NULL, '$2y$10$e6mmJ1vddb2Jt7ssEHloNenk0csBHQcbT.F3i/UNas/i0lVP34/zq', 'JVSGWIQYHM', 18.00, 0.00, NULL, '2025-11-24 08:05:28', '2025-11-24 08:05:28'),
(2, 'alex', 'joseph', 'alex@gmail.com', NULL, '$2y$10$UAzP.7pWViHR3AEDTuUQeOBX29VPPHRNWHNu7zd6Dc8ZM5EfGWXFu', '7FAPXJIQNO', 18.00, 0.00, NULL, '2025-11-24 23:02:11', '2025-11-24 23:02:11'),
(3, 'asd', 'zsdsad', 'sdsad@gmail.com', NULL, '$2y$10$ArwJtrIMoaqnQ6N68YKiVeOV8yQ2p.Vcd6ziF8Bnfu9Cpidkum0Ji', '46S8XQBVDP', 18.00, 0.00, NULL, '2025-11-25 22:02:13', '2025-11-25 22:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `balances`
--

CREATE TABLE `balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `balances`
--

INSERT INTO `balances` (`id`, `user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 5, 1550.00, '2024-11-20 02:08:40', '2024-11-22 00:18:32'),
(2, 10, 300.00, '2024-11-21 23:11:37', '2024-11-21 23:11:37'),
(3, 11, 330.00, '2024-11-22 00:14:43', '2024-11-22 00:18:32'),
(4, 14, 300.00, '2024-11-22 00:18:32', '2024-11-22 00:18:32'),
(5, 6, 630.00, '2024-11-27 22:13:54', '2024-11-27 22:31:51'),
(6, 17, 300.00, '2024-11-27 22:31:51', '2024-11-27 22:31:51'),
(7, 3, 630.00, '2024-11-28 01:20:54', '2024-11-28 01:26:07'),
(8, 20, 300.00, '2024-11-28 01:26:07', '2024-11-28 01:26:07'),
(9, 7, 630.00, '2024-11-28 01:34:16', '2024-11-28 01:37:51'),
(10, 22, 300.00, '2024-11-28 01:37:51', '2024-11-28 01:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active,0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `account_name`, `account_number`, `status`, `created_at`, `updated_at`) VALUES
(5, 'State Bank Of India', 'Aasif Ahmed', '987654321', 1, '2025-01-13 01:30:34', '2025-01-13 01:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `account_number` varchar(191) DEFAULT NULL,
  `ifsc_code` varchar(191) DEFAULT NULL,
  `qrcode_path` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `user_id`, `bank_name`, `account_number`, `ifsc_code`, `qrcode_path`, `created_at`, `updated_at`) VALUES
(7, NULL, NULL, NULL, NULL, 'Commons_QR_code.png', '2024-04-13 23:44:41', '2024-04-13 23:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title1` varchar(255) DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `title3` varchar(255) DEFAULT NULL,
  `button` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `image` varchar(191) NOT NULL,
  `page_banner` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title1`, `title2`, `title3`, `button`, `link`, `image`, `page_banner`, `created_at`, `updated_at`) VALUES
(7, 'Fin de semana perfecto', '-', '-', '-', 'https://bikebros.net/productbyCategory/7', 'uploads/banners/1748888808-Hbl33rnWlg.jpg', NULL, '2024-08-15 06:10:17', '2025-06-02 18:26:48'),
(11, 'Un fin de semana perfecto', 'Ofrecemos experiencias increíbles y creamos', 'aventuras seguras para ti al mismo tiempo.', 'Sobre Nosotros', 'http://superfastsattaresult.in/', 'uploads/banners/1748881980-o67iq3XIKl.jpg', NULL, '2024-08-15 13:05:16', '2025-06-02 16:33:00'),
(12, 'A cualquier parte de la ciudad', 'Una gran variedad de toboganes de agua, desde los más empinados hasta los más suaves,', 'para todos los gustos. ¡Diversión garantizada!', 'Sobre Nosotros', 'https://desawarkingsatta.com/', 'uploads/banners/1748882884-UgViGVCJ4l.jpg', NULL, '2025-01-27 00:56:33', '2025-06-02 16:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `behavioural_metrics`
--

CREATE TABLE `behavioural_metrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `for_date` date NOT NULL,
  `scores` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`scores`)),
  `stability_index` decimal(8,4) DEFAULT NULL,
  `discipline_score` decimal(8,4) DEFAULT NULL,
  `emotional_stability` decimal(8,4) DEFAULT NULL,
  `impulse_score` decimal(8,4) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blockchain_hash_records`
--

CREATE TABLE `blockchain_hash_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `for_date` date NOT NULL,
  `chain` varchar(255) DEFAULT NULL,
  `tx_hash` varchar(255) DEFAULT NULL,
  `behaviour_metrics_hash` text NOT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `like_count` varchar(255) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `details` mediumtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=published, 0=unpublished',
  `blog_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `uuid`, `user_id`, `like_count`, `title`, `slug`, `short_description`, `details`, `image`, `status`, `blog_category_id`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `created_at`, `updated_at`) VALUES
(1, '3c6bc7c0-caa4-11f0-9eae-84144d03fc31', 1, '245', 'Mastering Support & Resistance in 2025', 'mastering-support-resistance-2025', 'Learn how pro traders use S&R levels for high-probability entries with laser precision.', '<p>Support and resistance are the foundation of price action trading...</p>', 'https://images.unsplash.com/photo-1561414927-6d86591d0c4f', 1, 1, 'Mastering Support & Resistance in 2025', 'Professional guide to drawing and trading S&R levels', 'forex, support resistance, price action', 'https://images.unsplash.com/photo-1559526324-593bc073d938', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(3, '3c6bd279-caa4-11f0-9eae-84144d03fc31', 1, '312', 'How to Trade News Without Getting Stop-Hunted', 'trade-news-without-stop-hunt', '3 proven strategies to survive NFP, CPI, and rate decisions safely.', '<p>News doesn’t have to be gambling...</p>', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40', 1, 1, 'Safe News Trading Strategy', 'Avoid stop hunts during high-impact news', 'nfp, news trading', 'https://images.unsplash.com/photo-1535223289827-42f1e9919769', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(7, '3c6bd340-caa4-11f0-9eae-84144d03fc31', 1, '892', 'The 1% Risk Rule That Saved My Career', '1-percent-risk-rule', 'How proper position sizing turns losers into winners.', '<p>I blew 3 accounts before I learned this one rule...</p>', 'https://images.unsplash.com/photo-1509021436665-8f07dbf5bf1d', 1, 3, '1% Risk Rule Explained', 'Never blow another account again', 'risk management, position sizing', 'https://images.unsplash.com/photo-1515165562835-c4c7f589308c', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(8, '3c6bd36b-caa4-11f0-9eae-84144d03fc31', 1, '721', 'Why 90% of Traders Fail – Real Stats', 'why-90-percent-traders-fail', 'The brutal truth backed by broker data.', '<p>Most traders ignore these 3 things...</p>', 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0', 1, 3, 'Why Traders Fail', 'Trading statistics and psychology', 'trading failure, risk', 'https://images.unsplash.com/photo-1543286386-713bdd548da4', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(10, '3c6bd3c4-caa4-11f0-9eae-84144d03fc31', 1, '945', 'How to Stop Revenge Trading Forever', 'stop-revenge-trading', 'The one mental shift that breaks emotional trading.', '<p>I lost $8k in one day — then fixed my mind...</p>', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f', 1, 4, 'Stop Revenge Trading', 'Overcome emotional trading', 'trading psychology, revenge', 'https://images.unsplash.com/photo-1455849318743-b2233052fcff', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(11, '3c6bd3f3-caa4-11f0-9eae-84144d03fc31', 1, '876', 'How to Beat FOMO in Trading (3 Steps)', 'beat-trading-fomo', 'Stop chasing every green candle.', '<p>FOMO kills accounts. Here’s the cure...</p>', 'https://images.unsplash.com/photo-1521791055366-0d553872125f', 1, 4, 'Beat FOMO Trading', 'Discipline and patience', 'fomo, psychology', 'https://images.unsplash.com/photo-1536233716094-d76a24f2e71e', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(12, '3c6bd41d-caa4-11f0-9eae-84144d03fc31', 1, '801', 'Daily Routine of a 6-Figure Funded Trader', 'funded-trader-routine', 'Copy the exact morning routine of elite traders.', '<p>Journal → Analysis → Execution...</p>', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f', 1, 4, 'Funded Trader Routine', 'Pro trader habits', 'trading routine', 'https://images.unsplash.com/photo-1515165562835-c4c7f589308c', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(15, '3c6bd4de-caa4-11f0-9eae-84144d03fc31', 1, '834', '5 Candlestick Patterns That Actually Work', 'candlestick-patterns-2025', 'Backtested 80%+ win rate patterns.', '<p>Not all candles are equal. These 5 dominate...</p>', 'https://images.unsplash.com/photo-1517148815978-75f6acaaf32c', 1, 5, 'Best Candlestick Patterns', 'Price action trading', 'candlesticks, reversal', 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d', '2025-11-26 08:45:18', '2025-11-26 08:45:18'),
(17, '3c6bd535-caa4-11f0-9eae-84144d03fc31', 1, '1156', 'How I Passed FTMO in 7 Days', 'pass-ftmo-7-days', 'Exact strategy used by 200+ traders.', '<p>From $10k to $400k funded...</p>', 'https://images.unsplash.com/photo-1551836022-d5d88e9218df', 1, 6, 'Pass FTMO Fast', 'FTMO challenge strategy', 'ftmo, funded', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40', '2025-11-26 08:45:18', '2025-11-26 08:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=active, 0=deactivated',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `uuid`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, '86d5f6cd-caa2-11f0-9eae-84144d03fc31', 'Forex Trading', 'forex-trading', 0, '2025-11-26 08:33:04', '2025-11-26 08:33:04'),
(2, '86d600c6-caa2-11f0-9eae-84144d03fc31', 'Crypto Analysis', 'crypto-analysis', 0, '2025-11-26 08:33:04', '2025-11-26 08:33:04'),
(3, '86d60134-caa2-11f0-9eae-84144d03fc31', 'Risk Management', 'risk-management', 0, '2025-11-26 08:33:04', '2025-11-26 08:33:04'),
(4, '86d60159-caa2-11f0-9eae-84144d03fc31', 'Psychology', 'trading-psychology', 0, '2025-11-26 08:33:04', '2025-11-26 08:33:04'),
(5, '86d60178-caa2-11f0-9eae-84144d03fc31', 'Technical Analysis', 'technical-analysis', 0, '2025-11-26 08:33:04', '2025-11-26 08:33:04'),
(6, '86d60197-caa2-11f0-9eae-84144d03fc31', 'Funded Accounts', 'funded-accounts', 0, '2025-11-26 08:33:04', '2025-11-26 08:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active, 2=deactivate',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_comments`
--

INSERT INTO `blog_comments` (`id`, `blog_id`, `user_id`, `name`, `email`, `comment`, `status`, `parent_id`, `created_at`, `updated_at`) VALUES
(4, 14, 3, NULL, NULL, 'test', 1, NULL, '2024-11-02 01:38:48', '2024-11-02 01:38:48'),
(5, 14, 3, NULL, NULL, 'cxgvsdfsd', 1, NULL, '2024-11-02 01:45:47', '2024-11-02 01:45:47'),
(6, 14, 3, NULL, NULL, 'blog comment test', 1, NULL, '2024-11-02 02:36:27', '2024-11-02 02:36:27'),
(7, 11, 3, NULL, NULL, 'edu', 1, NULL, '2024-11-02 02:37:09', '2024-11-02 02:37:09'),
(8, 14, 5, NULL, NULL, 'wow', 1, NULL, '2024-11-02 02:55:14', '2024-11-02 02:55:14'),
(9, 14, 5, NULL, NULL, 'reh', 1, 5, '2024-11-02 03:03:41', '2024-11-02 03:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `blog_tags`
--

CREATE TABLE `blog_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tags`
--

INSERT INTO `blog_tags` (`id`, `blog_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(9, 4, 2, '2024-03-29 00:44:55', '2024-03-29 00:44:55'),
(10, 4, 3, '2024-03-29 00:44:55', '2024-03-29 00:44:55'),
(12, 7, 3, '2024-03-29 01:30:57', '2024-03-29 01:30:57'),
(17, 10, 3, '2024-03-29 01:46:55', '2024-03-29 01:46:55'),
(19, 3, 4, '2024-03-29 05:13:33', '2024-03-29 05:13:33'),
(23, 15, 3, '2024-10-28 03:53:46', '2024-10-28 03:53:46'),
(27, 14, 1, '2024-10-28 05:14:45', '2024-10-28 05:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_feature` varchar(10) NOT NULL DEFAULT 'no' COMMENT 'yes, no',
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_image` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active, 0=inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `uuid`, `name`, `image`, `is_feature`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `status`, `created_at`, `updated_at`) VALUES
(1, '', 'Construcción', NULL, 'no', 'construccion', NULL, NULL, NULL, NULL, 1, '2025-07-08 10:29:10', '2025-07-15 12:00:00'),
(4, 'c4d5e6f7-5be6-11f0-8620-9a4383c8618e', 'Hogar', NULL, 'no', 'hogar', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(5, 'c4d5e6f8-5be6-11f0-8620-9a4383c8618e', 'Gastronomía', NULL, 'no', 'gastronomia', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(6, 'c4d5e6f9-5be6-11f0-8620-9a4383c8618e', 'Cuidado y Bienestar', NULL, 'no', 'cuidado-y-bienestar', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(7, 'c4d5e6fa-5be6-11f0-8620-9a4383c8618e', 'Seguridad', NULL, 'no', 'seguridad', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(8, 'c4d5e6fb-5be6-11f0-8620-9a4383c8618e', 'Educación', NULL, 'no', 'educacion', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(9, 'c4d5e6fc-5be6-11f0-8620-9a4383c8618e', 'Mascotas', NULL, 'no', 'mascotas', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(10, 'c4d5e6fd-5be6-11f0-8620-9a4383c8618e', 'Belleza', NULL, 'no', 'belleza', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(11, 'c4d5e6fe-5be6-11f0-8620-9a4383c8618e', 'Eventos', NULL, 'no', 'eventos', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(12, 'c4d5e6ff-5be6-11f0-8620-9a4383c8618e', 'Redes Sociales', NULL, 'no', 'redes-sociales', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(13, 'c4d5e700-5be6-11f0-8620-9a4383c8618e', 'Mantenimiento y Reparación', NULL, 'no', 'mantenimiento-y-reparacion', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(14, 'c4d5e701-5be6-11f0-8620-9a4383c8618e', 'Otros', NULL, 'no', 'otros', NULL, NULL, NULL, NULL, 1, '2025-07-15 12:00:00', '2025-07-15 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `celebrity_endorsements`
--

CREATE TABLE `celebrity_endorsements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `quote` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `youtube_id` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `celebrity_endorsements`
--

INSERT INTO `celebrity_endorsements` (`id`, `name`, `role`, `quote`, `image`, `youtube_id`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Barra Cuadrada de Aluminio', 'footer', 'sadsadsad', 'uploads/celebrities/1764408209-xkLKhJwUDA.png', 'qs8ySjeT2wA', 1, 0, '2025-11-29 03:48:06', '2025-11-29 03:53:29'),
(2, 'chrish', 'crickert', 'sdfxcvxzczcdsdf', 'uploads/celebrities/1764467574-JFrmNk3k3y.png', 'zpfZby3NOkU', 1, 0, '2025-11-29 20:22:54', '2025-11-29 20:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `capacity_value` decimal(16,2) NOT NULL,
  `start_balance` decimal(16,2) NOT NULL,
  `current_balance` decimal(16,2) NOT NULL,
  `peak_balance` decimal(16,2) DEFAULT NULL,
  `total_profit` decimal(16,2) NOT NULL DEFAULT 0.00,
  `total_loss` decimal(16,2) NOT NULL DEFAULT 0.00,
  `daily_drawdown` decimal(8,2) NOT NULL DEFAULT 0.00,
  `overall_drawdown` decimal(8,2) NOT NULL DEFAULT 0.00,
  `phase` tinyint(4) NOT NULL DEFAULT 1,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `min_days_required` int(11) NOT NULL DEFAULT 5,
  `valid_days_completed_days` int(11) NOT NULL DEFAULT 0,
  `max_trading_days` int(11) DEFAULT NULL,
  `trading_days_elapsed` int(11) NOT NULL DEFAULT 0,
  `profit_target_percent` decimal(8,2) NOT NULL,
  `max_daily_loss_percent` decimal(8,2) NOT NULL,
  `max_overall_loss_percent` decimal(8,2) NOT NULL,
  `current_daily_loss_percent` decimal(8,2) NOT NULL DEFAULT 0.00,
  `current_overall_loss_percent` decimal(8,2) NOT NULL DEFAULT 0.00,
  `next_payout_eligible_at` timestamp NULL DEFAULT NULL,
  `payout_amount` decimal(16,2) NOT NULL DEFAULT 0.00,
  `last_payout_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ended_at` timestamp NULL DEFAULT NULL,
  `passed_at` timestamp NULL DEFAULT NULL,
  `failed_at` timestamp NULL DEFAULT NULL,
  `account_id` varchar(255) DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_demo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `user_id`, `plan_id`, `capacity_value`, `start_balance`, `current_balance`, `peak_balance`, `total_profit`, `total_loss`, `daily_drawdown`, `overall_drawdown`, `phase`, `status`, `min_days_required`, `valid_days_completed_days`, `max_trading_days`, `trading_days_elapsed`, `profit_target_percent`, `max_daily_loss_percent`, `max_overall_loss_percent`, `current_daily_loss_percent`, `current_overall_loss_percent`, `next_payout_eligible_at`, `payout_amount`, `last_payout_at`, `started_at`, `ended_at`, `passed_at`, `failed_at`, `account_id`, `meta`, `is_demo`, `created_at`, `updated_at`) VALUES
(1, 15, 7, 1000000.00, 1000000.00, 1035075.00, 1052000.00, 35075.00, 0.00, 0.00, 0.00, 1, 'active', 5, 3, NULL, 4, 8.00, 5.00, 10.00, 0.00, 0.00, NULL, 0.00, NULL, '2025-12-02 22:25:18', NULL, NULL, NULL, 'DEMO-04QlDogz', '{\"note\":\"Demo challenge for testing\"}', 1, '2025-12-06 22:25:18', '2025-12-06 22:25:18'),
(2, 15, 8, 1000000.00, 1000000.00, 1035075.00, 1052000.00, 35075.00, 0.00, 0.00, 0.00, 1, 'active', 5, 3, NULL, 4, 8.00, 5.00, 10.00, 0.00, 0.00, NULL, 0.00, NULL, '2025-12-02 22:29:18', NULL, NULL, NULL, 'DEMO-VHTERVPN', '{\"seeder\":true}', 1, '2025-12-06 22:29:18', '2025-12-06 22:29:18'),
(3, 15, 9, 1000000.00, 1000000.00, 1035075.00, 1052000.00, 35075.00, 0.00, 0.00, 0.00, 1, 'active', 5, 3, NULL, 4, 8.00, 5.00, 10.00, 0.00, 0.00, NULL, 0.00, NULL, '2025-12-02 22:31:52', NULL, NULL, NULL, 'DEMO-WZXC1PDM', '{\"seeder\":true}', 1, '2025-12-06 22:31:52', '2025-12-06 22:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `client_account_type` varchar(255) DEFAULT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `worker_account_type` varchar(255) DEFAULT NULL,
  `chat_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `request_id`, `client_id`, `client_account_type`, `worker_id`, `worker_account_type`, `chat_id`, `created_at`, `updated_at`) VALUES
(1, 4, 41, 'Client', 43, 'Client', 'chat_4_Ps27DEFdpZhAcozI0IlJVvLn2UM2_YdwgkxnnK0VfdXmyhsieDutqGyD3', '2025-07-08 13:55:00', '2025-07-25 13:15:16'),
(2, 11, 41, 'Client', 44, 'Chambeador', 'chat_11_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-07-08 15:47:51', '2025-07-12 03:57:05'),
(3, 11, 44, 'Chambeador', 44, 'Chambeador', 'chat_11_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-07-08 16:33:32', '2025-07-08 16:51:09'),
(4, 11, 41, 'Client', 44, 'Chambeador', 'chat_11_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2_Ps27DEFdpZhAcozI0IlJVvLn2UM2', '2025-07-08 16:48:11', '2025-07-08 16:51:36'),
(5, 4, 41, 'Client', 42, 'Chambeador', 'chat_4_Ps27DEFdpZhAcozI0IlJVvLn2UM2_4Mqh5sTGviPOnqsCrIfH5FDnGPw1', '2025-07-19 04:55:13', '2025-07-19 05:44:27'),
(6, 18, 41, 'Client', 44, 'Chambeador', 'chat_18_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-07-19 08:04:08', '2025-07-19 08:04:08'),
(7, 20, 41, 'Client', 44, 'Chambeador', 'chat_20_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-07-19 08:56:53', '2025-07-25 13:16:15'),
(8, 41, 41, 'Client', 44, 'Chambeador', 'chat_41_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-07-28 07:05:48', '2025-07-28 07:05:48'),
(9, 44, 41, 'Client', 46, 'Chambeador', 'chat_44_Ps27DEFdpZhAcozI0IlJVvLn2UM2_eTaMlGgWVoak3CXuUNUHAevXWVM2', '2025-08-01 15:48:18', '2025-08-06 03:08:05'),
(10, 45, 46, 'Client', 68, 'Chambeador', 'chat_45_eTaMlGgWVoak3CXuUNUHAevXWVM2_qgj9Gik54BYk8Po1xei4lxFurQ03', '2025-08-06 08:23:06', '2025-09-10 16:09:07'),
(11, 43, 41, 'Client', 44, 'Chambeador', 'chat_43_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-08-07 08:25:34', '2025-08-07 08:25:34'),
(12, 65, 41, 'Client', 44, 'Chambeador', 'chat_65_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-09-05 09:26:50', '2025-09-09 15:39:06'),
(13, 67, 46, 'Client', 94, 'Chambeador', 'chat_67_eTaMlGgWVoak3CXuUNUHAevXWVM2_FiGfxzgXRKfIaE7F7a1JAgL09HF3', '2025-09-09 17:13:01', '2025-09-09 17:13:01'),
(14, 68, 46, 'Client', 94, 'Chambeador', 'chat_68_eTaMlGgWVoak3CXuUNUHAevXWVM2_FiGfxzgXRKfIaE7F7a1JAgL09HF3', '2025-09-09 17:21:57', '2025-09-09 17:21:57'),
(15, 75, 84, 'Client', 49, 'Chambeador', 'chat_75_JfREDCu0MhgsJCF7dezcZAc6fkU2_2PqcjE3oykWtVPdKCU9ZUYpA0yr1', '2025-09-14 05:15:24', '2025-09-14 05:17:06'),
(16, 78, 84, 'Client', 49, 'Chambeador', 'chat_78_JfREDCu0MhgsJCF7dezcZAc6fkU2_2PqcjE3oykWtVPdKCU9ZUYpA0yr1', '2025-09-14 05:44:05', '2025-09-14 05:44:20'),
(17, 79, 41, 'Client', 44, 'Chambeador', 'chat_79_Ps27DEFdpZhAcozI0IlJVvLn2UM2_9iTS6GPWa1RBKhoUeXQgMrgb3Lv2', '2025-09-14 06:54:18', '2025-09-14 06:54:18'),
(18, 80, 41, 'Client', 104, 'Chambeador', 'chat_80_Ps27DEFdpZhAcozI0IlJVvLn2UM2_rnBZGW9BScYBOZzIcaAcMDUcP9u1', '2025-09-14 07:37:10', '2025-09-14 07:37:10'),
(19, 81, 41, 'Client', 42, 'Chambeador', 'chat_81_Ps27DEFdpZhAcozI0IlJVvLn2UM2_4Mqh5sTGviPOnqsCrIfH5FDnGPw1', '2025-09-14 07:49:50', '2025-09-14 07:49:50'),
(20, 82, 84, 'Client', 49, 'Chambeador', 'chat_82_JfREDCu0MhgsJCF7dezcZAc6fkU2_2PqcjE3oykWtVPdKCU9ZUYpA0yr1', '2025-09-14 08:08:22', '2025-09-14 08:09:18'),
(21, 83, 41, 'Client', 132, 'Chambeador', 'chat_83_Ps27DEFdpZhAcozI0IlJVvLn2UM2_1JKFRVLoHDcJ4j7OqXvWpp68iWW2', '2025-09-14 08:37:20', '2025-09-14 08:37:20'),
(22, 84, 84, 'Client', 49, 'Chambeador', 'chat_84_JfREDCu0MhgsJCF7dezcZAc6fkU2_2PqcjE3oykWtVPdKCU9ZUYpA0yr1', '2025-09-14 08:39:08', '2025-09-14 08:39:21'),
(23, 85, 41, 'Client', 133, 'Chambeador', 'chat_85_Ps27DEFdpZhAcozI0IlJVvLn2UM2_BWSb9mDTwXOKW5iRyKutAAr7GSv1', '2025-09-14 08:50:22', '2025-09-14 08:50:22'),
(24, 86, 41, 'Client', 133, 'Chambeador', 'chat_86_Ps27DEFdpZhAcozI0IlJVvLn2UM2_BWSb9mDTwXOKW5iRyKutAAr7GSv1', '2025-09-14 09:48:49', '2025-09-14 09:50:01'),
(25, 87, 41, 'Client', 133, 'Chambeador', 'chat_87_Ps27DEFdpZhAcozI0IlJVvLn2UM2_BWSb9mDTwXOKW5iRyKutAAr7GSv1', '2025-09-14 09:55:10', '2025-09-14 09:55:10'),
(26, 100, 46, 'Client', 84, 'Chambeador', 'chat_100_eTaMlGgWVoak3CXuUNUHAevXWVM2_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-15 15:26:55', '2025-09-15 15:43:50'),
(27, 103, 84, 'Client', 46, 'Chambeador', 'chat_103_JfREDCu0MhgsJCF7dezcZAc6fkU2_eTaMlGgWVoak3CXuUNUHAevXWVM2', '2025-09-15 17:14:46', '2025-09-15 17:15:35'),
(28, 104, 46, 'Client', 84, 'Chambeador', 'chat_104_eTaMlGgWVoak3CXuUNUHAevXWVM2_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-16 00:55:20', '2025-09-16 00:55:40'),
(29, 105, 84, 'Client', 46, 'Chambeador', 'chat_105_JfREDCu0MhgsJCF7dezcZAc6fkU2_eTaMlGgWVoak3CXuUNUHAevXWVM2', '2025-09-16 01:11:31', '2025-09-16 01:11:31'),
(30, 107, 136, 'Client', 41, 'Chambeador', 'chat_107_bocExt1uGBWVHiO0bpsuIoBqNxE3_Ps27DEFdpZhAcozI0IlJVvLn2UM2', '2025-09-16 04:04:54', '2025-09-16 04:17:29'),
(31, 113, 84, 'Client', 46, 'Chambeador', 'chat_113_JfREDCu0MhgsJCF7dezcZAc6fkU2_eTaMlGgWVoak3CXuUNUHAevXWVM2', '2025-09-16 12:40:21', '2025-09-16 12:40:35'),
(32, 116, 46, 'Client', 84, 'Chambeador', 'chat_116_eTaMlGgWVoak3CXuUNUHAevXWVM2_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-17 04:56:44', '2025-09-17 05:04:36'),
(33, 121, 49, 'Client', 84, 'Chambeador', 'chat_121_2PqcjE3oykWtVPdKCU9ZUYpA0yr1_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-18 18:49:51', '2025-09-18 18:49:51'),
(34, 127, 135, 'Client', 84, 'Chambeador', 'chat_127_hSBrqstY49QipUpxk9cfdNp67C73_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-18 23:51:39', '2025-09-19 17:00:34'),
(35, 127, 135, 'Client', 49, 'Chambeador', 'chat_127_hSBrqstY49QipUpxk9cfdNp67C73_2PqcjE3oykWtVPdKCU9ZUYpA0yr1', '2025-09-18 23:52:53', '2025-09-18 23:53:00'),
(36, 47, 57, 'Client', 57, 'Chambeador', 'chat_47_W7IE6M18rGhVgNQaWlPnxVKypDq1_W7IE6M18rGhVgNQaWlPnxVKypDq1', '2025-09-21 03:26:59', '2025-09-21 03:26:59'),
(37, 123, 84, 'Client', 46, 'Chambeador', 'chat_123_JfREDCu0MhgsJCF7dezcZAc6fkU2_eTaMlGgWVoak3CXuUNUHAevXWVM2', '2025-09-23 02:08:16', '2025-09-23 02:08:16'),
(38, 89, 69, 'Client', 70, 'Chambeador', 'chat_89_psLu0VroyLcEMP1q6EfH5VhU4A83_gJP4m0NfJIT15DDuaK9vPINz9Eq1', '2025-09-23 03:12:15', '2025-09-23 03:12:15'),
(39, 131, 57, 'Client', 84, 'Chambeador', 'chat_131_W7IE6M18rGhVgNQaWlPnxVKypDq1_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-23 11:37:58', '2025-09-23 11:37:58'),
(40, 143, 46, 'Client', 84, 'Chambeador', 'chat_143_eTaMlGgWVoak3CXuUNUHAevXWVM2_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-23 20:38:02', '2025-09-23 20:38:25'),
(41, 151, 144, 'Client', 84, 'Chambeador', 'chat_151_Tke15qGA49eJDkajJhEdvuf53Wv1_JfREDCu0MhgsJCF7dezcZAc6fkU2', '2025-09-25 15:21:30', '2025-09-25 15:21:30'),
(42, 152, 144, 'Client', 135, 'Chambeador', 'chat_152_Tke15qGA49eJDkajJhEdvuf53Wv1_hSBrqstY49QipUpxk9cfdNp67C73', '2025-09-25 17:17:52', '2025-09-25 17:17:52');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhanmondi', NULL, NULL),
(2, 1, 'Bannai', NULL, NULL),
(4, 2, 'Zero Point', NULL, NULL),
(5, 3, 'Tomchombridge', NULL, NULL),
(6, 3, 'Cantonment', NULL, NULL),
(7, 4, 'Acton', NULL, NULL),
(8, 4, 'Alamo', NULL, NULL),
(9, 5, 'Albin', NULL, NULL),
(10, 6, 'Bartow', NULL, NULL),
(11, 7, 'Oban', NULL, NULL),
(12, 8, 'Holywood', NULL, NULL),
(13, 9, 'Ely', NULL, NULL),
(14, 1, 'Tejgaon', '2024-06-07 06:12:00', '2024-06-07 06:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Aasif Ahmed', 'aasifdev5@gmail.com', '8878326802', NULL, '2025-10-16 03:45:38', '2025-10-16 04:03:05');

-- --------------------------------------------------------

--
-- Table structure for table `client_logos`
--

CREATE TABLE `client_logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_logos`
--

INSERT INTO `client_logos` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Ovita', 'uploads_demo/client-logo/1.png', '2022-12-04 17:05:33', '2025-01-13 06:31:55'),
(2, 'Vigon', 'uploads_demo/client-logo/2.png', '2022-12-04 17:05:33', '2025-01-13 06:31:55'),
(3, 'Betribe', 'uploads_demo/client-logo/3.png', '2022-12-04 17:05:33', '2025-01-13 06:31:55'),
(4, 'Parsit', 'uploads_demo/client-logo/4.png', '2022-12-04 17:05:33', '2025-01-13 06:31:55'),
(5, 'Karika', 'uploads/client_logo/1736769716IbQJzw0Mp8.jpg', '2022-12-04 17:05:33', '2025-01-13 06:31:55'),
(6, 'd', NULL, '2025-01-13 05:41:26', '2025-01-13 06:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `user_id`, `author`, `email`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 'fgdg', 'hrnatrajinfotech@gmail.com', 'dfss', '2025-02-13 21:17:35', '2025-02-13 21:17:35'),
(2, 3, 1, 'fdgd', 'hrnatrajinfotech@gmail.com', 'xcvxvc', '2025-02-13 21:31:38', '2025-02-13 21:31:38'),
(3, 3, 11, 'wow', 'aasifdev5@gmail.com', 'sfsdf', '2025-02-13 21:32:41', '2025-02-13 21:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_us_issue_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us_issues`
--

CREATE TABLE `contact_us_issues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=active, 0=deactivated',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us_issues`
--

INSERT INTO `contact_us_issues` (`id`, `uuid`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, '7c57e841-fdcb-401f-aaf9-c64b31bd1e3c', 'Withdraw', 1, '2024-03-09 23:39:51', '2024-03-09 23:39:51'),
(4, '1d2a6c9d-d2f8-494a-98a3-53833530945e', 'Refund', 1, '2024-03-09 23:40:12', '2024-03-09 23:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_request_id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `worker_id` bigint(20) UNSIGNED NOT NULL,
  `agreed_budget` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `service_request_id`, `proposal_id`, `client_id`, `worker_id`, `agreed_budget`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 1, 41, 44, 3.00, 'completed', '2025-07-19 08:03:34', '2025-07-19 08:08:46'),
(2, 19, 2, 41, 44, 55.00, 'completed', '2025-07-19 08:12:42', '2025-07-19 08:13:31'),
(3, 20, 3, 41, 44, 45.00, 'completed', '2025-07-19 08:58:07', '2025-07-19 09:00:58'),
(11, 41, 5, 41, 44, 55.00, 'accepted', '2025-07-28 07:02:39', '2025-07-28 07:02:39'),
(12, 44, 6, 41, 46, 56.00, 'accepted', '2025-08-01 15:51:41', '2025-08-01 15:51:41'),
(21, 43, 9, 41, 44, 456.00, 'accepted', '2025-08-07 08:39:07', '2025-08-07 08:39:07'),
(29, 67, 33, 46, 94, 645.00, 'completed', '2025-09-09 17:13:00', '2025-09-09 17:37:30'),
(30, 68, 34, 46, 94, 500.00, 'completed', '2025-09-09 17:21:57', '2025-09-09 17:38:46'),
(31, 69, 35, 46, 94, 500.00, 'accepted', '2025-09-09 17:43:26', '2025-09-09 17:43:26'),
(32, 71, 37, 46, 84, 500.00, 'accepted', '2025-09-10 16:06:59', '2025-09-10 16:06:59'),
(33, 72, 38, 46, 84, 500.00, 'accepted', '2025-09-10 16:14:12', '2025-09-10 16:14:12'),
(34, 73, 39, 46, 84, 500.00, 'accepted', '2025-09-11 18:23:13', '2025-09-11 18:23:13'),
(35, 64, 24, 84, 70, 800.00, 'accepted', '2025-09-12 19:42:14', '2025-09-12 19:42:14'),
(36, 74, 41, 46, 84, 2000.00, 'completed', '2025-09-12 20:46:46', '2025-09-13 11:11:44'),
(37, 75, 43, 84, 49, 150.00, 'completed', '2025-09-14 05:15:24', '2025-09-14 05:17:52'),
(38, 76, 45, 84, 49, 150.00, 'accepted', '2025-09-14 05:21:13', '2025-09-14 05:21:13'),
(39, 77, 46, 84, 49, 150.00, 'completed', '2025-09-14 05:21:28', '2025-09-14 05:40:36'),
(40, 78, 47, 84, 49, 6545.00, 'completed', '2025-09-14 05:44:05', '2025-09-14 05:46:52'),
(41, 79, 48, 41, 44, 6.00, 'completed', '2025-09-14 06:54:18', '2025-09-14 06:55:59'),
(42, 80, 49, 41, 104, 6.00, 'accepted', '2025-09-14 07:37:09', '2025-09-14 07:37:09'),
(43, 81, 50, 41, 42, 6.00, 'accepted', '2025-09-14 07:49:49', '2025-09-14 07:49:49'),
(44, 82, 51, 84, 49, 256.00, 'accepted', '2025-09-14 08:08:22', '2025-09-14 08:08:22'),
(45, 83, 52, 41, 132, 59.00, 'accepted', '2025-09-14 08:37:19', '2025-09-14 08:37:19'),
(46, 84, 53, 84, 49, 25.00, 'accepted', '2025-09-14 08:39:08', '2025-09-14 08:39:08'),
(47, 85, 54, 41, 133, 2356.00, 'accepted', '2025-09-14 08:50:22', '2025-09-14 08:50:22'),
(48, 86, 55, 41, 133, 3556.00, 'completed', '2025-09-14 09:48:49', '2025-09-14 09:52:01'),
(49, 87, 56, 41, 133, 556.00, 'accepted', '2025-09-14 09:55:10', '2025-09-14 09:55:10'),
(50, 88, 57, 84, 68, 2500.00, 'completed', '2025-09-14 14:37:56', '2025-09-14 14:59:50'),
(51, 50, 17, 70, 84, 1.00, 'accepted', '2025-09-14 18:02:43', '2025-09-14 18:02:43'),
(52, 99, 60, 68, 84, 2000.00, 'in progress', '2025-09-15 11:16:56', '2025-09-15 11:18:35'),
(53, 100, 61, 46, 84, 100.00, 'completed', '2025-09-15 15:26:54', '2025-09-18 18:54:02'),
(54, 103, 62, 84, 46, 26.00, 'completed', '2025-09-15 17:14:46', '2025-09-18 22:26:38'),
(55, 104, 63, 46, 84, 250.00, 'completed', '2025-09-16 00:55:20', '2025-09-16 00:57:26'),
(56, 105, 64, 84, 46, 1.00, 'completed', '2025-09-16 01:11:31', '2025-09-16 01:31:57'),
(57, 107, 66, 136, 41, 235.00, 'accepted', '2025-09-16 04:04:53', '2025-09-16 04:04:53'),
(58, 113, 70, 84, 46, 25.00, 'completed', '2025-09-16 12:40:21', '2025-09-17 18:19:06'),
(59, 116, 71, 46, 84, 250.00, 'completed', '2025-09-17 04:56:43', '2025-09-17 05:05:50'),
(60, 121, 72, 49, 84, 500.00, 'completed', '2025-09-18 18:49:51', '2025-09-18 18:52:47'),
(61, 127, 76, 135, 84, 80.00, 'completed', '2025-09-18 23:51:38', '2025-09-23 20:52:02'),
(62, 47, 10, 57, 57, 100.00, 'completed', '2025-09-21 03:26:58', '2025-09-23 11:46:17'),
(63, 123, 73, 84, 46, 125.00, 'accepted', '2025-09-23 02:08:16', '2025-09-23 02:08:16'),
(64, 89, 58, 69, 70, 50.00, 'accepted', '2025-09-23 03:12:15', '2025-09-23 03:12:15'),
(65, 131, 77, 57, 84, 80.00, 'in progress', '2025-09-23 11:37:57', '2025-09-23 20:51:03'),
(66, 136, 78, 57, 57, 100.00, 'accepted', '2025-09-23 11:49:00', '2025-09-23 11:49:00'),
(67, 137, 79, 57, 57, 100.00, 'accepted', '2025-09-23 11:49:49', '2025-09-23 11:49:49'),
(68, 143, 82, 46, 84, 280.00, 'completed', '2025-09-23 20:38:01', '2025-09-23 20:48:00'),
(69, 146, 83, 139, 46, 250.00, 'accepted', '2025-09-24 20:49:44', '2025-09-24 20:49:44'),
(70, 148, 84, 69, 46, 300.00, 'completed', '2025-09-24 21:41:43', '2025-09-24 22:15:43'),
(71, 151, 87, 144, 84, 150.00, 'completed', '2025-09-25 15:21:30', '2025-09-25 15:33:40'),
(72, 152, 89, 144, 135, 70.00, 'completed', '2025-09-25 17:17:51', '2025-09-25 17:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `short_name` varchar(10) NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `phonecode` varchar(255) NOT NULL,
  `continent` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `short_name`, `country_name`, `flag`, `slug`, `phonecode`, `continent`, `created_at`, `updated_at`) VALUES
(1, 'BD', 'Bangladesh', '', 'bangladesh', '+88', 'Asia', NULL, NULL),
(2, 'USA', 'United States', '', 'united-states', '+1', 'North America', NULL, NULL),
(3, 'UK', 'United Kingdom', '', 'united-kingdom', '+44', 'Europe', NULL, NULL),
(7, 'BO', 'Bolivia', 'BO', '', '+591', 'South America', '2025-01-13 01:28:10', '2025-01-13 01:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `currency_placement` varchar(255) NOT NULL DEFAULT 'before' COMMENT 'before, after',
  `current_currency` varchar(255) NOT NULL DEFAULT 'no' COMMENT 'on, off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `symbol`, `currency_placement`, `current_currency`, `created_at`, `updated_at`) VALUES
(1, 'USD', '$', 'before', 'off', NULL, '2025-12-01 00:13:36'),
(2, 'BDT', '৳', 'before', 'off', NULL, '2025-12-01 00:13:36'),
(3, 'INR', '₹', 'before', 'on', NULL, '2025-12-01 00:13:36'),
(4, 'GBP', '£', 'after', 'off', NULL, '2025-12-01 00:13:36'),
(5, 'MXN', '$', 'before', 'off', NULL, '2025-12-01 00:13:36'),
(6, 'SAR', 'SR', 'before', 'off', NULL, '2025-12-01 00:13:36'),
(7, 'TRY', '₺', 'after', 'off', NULL, '2025-12-01 00:13:36'),
(8, 'ARS', '$', 'before', 'off', NULL, '2025-12-01 00:13:36'),
(9, 'EUR', '€', 'before', 'off', NULL, '2025-12-01 00:13:36'),
(11, 'BS', 'Bs', 'before', 'off', '2024-06-07 04:12:21', '2025-12-01 00:13:36'),
(12, 'Dinars', 'Dinar', 'after', 'off', '2024-06-07 04:20:07', '2025-12-01 00:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `delayed_feed_assignments`
--

CREATE TABLE `delayed_feed_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `delay_seconds` int(11) NOT NULL DEFAULT 0,
  `reason` varchar(255) DEFAULT NULL,
  `assigned_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_accounts`
--

CREATE TABLE `evaluation_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_balance` decimal(18,6) NOT NULL,
  `current_balance` decimal(18,6) NOT NULL,
  `peak_balance` decimal(18,6) NOT NULL DEFAULT 0.000000,
  `total_profit` decimal(18,6) NOT NULL DEFAULT 0.000000,
  `max_allowed_loss` decimal(18,6) DEFAULT NULL,
  `rules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rules`)),
  `status` enum('active','failed','passed','paused') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq_questions`
--

CREATE TABLE `faq_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_questions`
--

INSERT INTO `faq_questions` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'which I enjoy with my whole heart am alone feel?', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a  greater artist than now. When, while the lovely valley with vapour around me, and the meridian.', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(2, 'which I enjoy with my whole heart am alone feel?', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a  greater artist than now. When, while the lovely valley with vapour around me, and the meridian.', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(3, 'which I enjoy with my whole heart am alone feel?', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a  greater artist than now. When, while the lovely valley with vapour around me, and the meridian.', '2022-12-04 17:05:33', '2022-12-04 17:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `folder_id` bigint(20) UNSIGNED NOT NULL,
  `path` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `size`, `extension`, `folder_id`, `path`, `created_at`, `updated_at`) VALUES
(2, 'Screenshot (158).png', NULL, 'png', 1, 'C:\\Users\\Aasif\\Desktop\\New\\public\\uploads/video\\Screenshot (158).png', '2025-01-16 07:45:54', '2025-01-16 07:45:54'),
(3, 'links audiolibros.pdf', NULL, 'pdf', 1, 'C:\\Users\\Aasif\\Desktop\\New\\public\\uploads/video\\links audiolibros.pdf', '2025-01-16 07:48:58', '2025-01-16 07:48:58'),
(4, '1732531639-mS4pBBAF6v.mp3', NULL, 'mp3', 1, 'C:\\Users\\Aasif\\Desktop\\New\\public\\uploads/video\\1732531639-mS4pBBAF6v.mp3', '2025-01-16 08:33:02', '2025-01-16 08:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `path`, `created_at`, `updated_at`) VALUES
(1, 'video', 'C:\\Users\\Aasif\\Desktop\\New\\public\\uploads/video', '2025-01-16 06:03:51', '2025-01-16 06:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `title` varchar(191) NOT NULL,
  `subtitle` varchar(191) NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `slug` varchar(191) NOT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active, 0=disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `uuid`, `title`, `subtitle`, `logo`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(8, '76ac56d7-5987-463c-819c-24353f23acc2', 'sd', 'sdsad', NULL, 'sd', 1, '2024-11-07 05:58:26', '2024-11-07 05:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text NOT NULL,
  `forum_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active, 0=disable',
  `total_seen` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `uuid`, `user_id`, `title`, `forum_category_id`, `description`, `status`, `total_seen`, `created_at`, `updated_at`) VALUES
(8, '5f69be7d-e69d-4e23-85e5-d6246890cda7', NULL, 'fdgg', 8, 'dfgg', 1, 1, '2024-11-09 02:56:27', '2024-11-09 02:56:28'),
(9, '73bfcbe9-48a1-4807-8160-793f3811f8af', NULL, 'fdgg', 8, 'dfgg', 1, 5, '2024-11-09 02:57:39', '2024-11-09 03:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `forum_post_comments`
--

CREATE TABLE `forum_post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `forum_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` longtext NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=active, 0=disable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funding_plans`
--

CREATE TABLE `funding_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `capital` decimal(15,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `profit_target` varchar(255) NOT NULL,
  `max_loss` varchar(255) NOT NULL,
  `drawdown_type` varchar(255) NOT NULL,
  `payout_cycle` varchar(255) NOT NULL,
  `news_trading` tinyint(1) NOT NULL DEFAULT 1,
  `weekend_holding` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `funding_plans`
--

INSERT INTO `funding_plans` (`id`, `title`, `capital`, `fee`, `profit_target`, `max_loss`, `drawdown_type`, `payout_cycle`, `news_trading`, `weekend_holding`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, '20L', 2000000.00, 37000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 1, '2025-11-29 05:03:53', '2025-11-29 05:03:53'),
(2, '50L', 5000000.00, 55000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 2, '2025-11-29 05:03:53', '2025-11-29 05:03:53'),
(3, '75L', 7500000.00, 77000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 3, '2025-11-29 05:03:53', '2025-11-29 05:03:53'),
(4, '1Cr', 10000000.00, 100000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 4, '2025-11-29 05:03:53', '2025-11-29 05:03:53'),
(6, '10K Evaluation', 1000000.00, 15000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 1, '2025-12-06 22:24:03', '2025-12-06 22:24:03'),
(7, '10K Evaluation', 1000000.00, 15000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 1, '2025-12-06 22:25:18', '2025-12-06 22:25:18'),
(8, '10K Evaluation', 1000000.00, 15000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 1, '2025-12-06 22:29:18', '2025-12-06 22:29:18'),
(9, '10K Evaluation', 1000000.00, 15000.00, '8%', '6%', 'Trailing', '20 Days', 1, 1, 1, 1, '2025-12-06 22:31:52', '2025-12-06 22:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `hedging_monitors`
--

CREATE TABLE `hedging_monitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_a` bigint(20) UNSIGNED NOT NULL,
  `user_b` bigint(20) UNSIGNED DEFAULT NULL,
  `triggers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`triggers`)),
  `hedging_score` decimal(5,4) NOT NULL DEFAULT 0.0000,
  `action` enum('none','alert','fail') NOT NULL DEFAULT 'none',
  `evidence` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`evidence`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_verifications`
--

CREATE TABLE `kyc_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `aadhaar_number` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alternate_contact` varchar(255) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `permanent_city` varchar(255) DEFAULT NULL,
  `permanent_state` varchar(255) DEFAULT NULL,
  `permanent_pincode` varchar(255) DEFAULT NULL,
  `permanent_country` varchar(255) NOT NULL DEFAULT 'India',
  `correspondence_address` text DEFAULT NULL,
  `correspondence_city` varchar(255) DEFAULT NULL,
  `correspondence_state` varchar(255) DEFAULT NULL,
  `correspondence_pincode` varchar(255) DEFAULT NULL,
  `correspondence_country` varchar(255) NOT NULL DEFAULT 'India',
  `same_as_permanent` tinyint(1) NOT NULL DEFAULT 1,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `occupation_type` enum('salaried','business','professional','housewife','student','retired','other') DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `annual_income` decimal(12,2) DEFAULT NULL,
  `income_source` enum('salary','business','investments','pension','other') DEFAULT NULL,
  `pan_card_path` varchar(255) DEFAULT NULL,
  `aadhaar_front_path` varchar(255) DEFAULT NULL,
  `aadhaar_back_path` varchar(255) DEFAULT NULL,
  `passport_photo_path` varchar(255) DEFAULT NULL,
  `signature_path` varchar(255) DEFAULT NULL,
  `cancelled_cheque_path` varchar(255) DEFAULT NULL,
  `address_proof_path` varchar(255) DEFAULT NULL,
  `income_proof_path` varchar(255) DEFAULT NULL,
  `status` enum('pending','submitted','under_review','approved','rejected') NOT NULL DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `demat_account_number` varchar(255) DEFAULT NULL,
  `trading_account_number` varchar(255) DEFAULT NULL,
  `dp_id` varchar(255) DEFAULT NULL,
  `client_id` varchar(255) DEFAULT NULL,
  `risk_appetite` enum('low','moderate','high') NOT NULL DEFAULT 'moderate',
  `investment_experience` enum('beginner','intermediate','expert') NOT NULL DEFAULT 'beginner',
  `investment_objectives` text DEFAULT NULL,
  `politically_exposed` tinyint(1) NOT NULL DEFAULT 0,
  `us_citizen` tinyint(1) NOT NULL DEFAULT 0,
  `agree_terms` tinyint(1) NOT NULL DEFAULT 0,
  `agree_declaration` tinyint(1) NOT NULL DEFAULT 0,
  `submission_ip` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kyc_verifications`
--

INSERT INTO `kyc_verifications` (`id`, `user_id`, `pan_number`, `aadhaar_number`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `father_name`, `mother_name`, `mobile_number`, `email`, `alternate_contact`, `permanent_address`, `permanent_city`, `permanent_state`, `permanent_pincode`, `permanent_country`, `correspondence_address`, `correspondence_city`, `correspondence_state`, `correspondence_pincode`, `correspondence_country`, `same_as_permanent`, `bank_name`, `account_number`, `account_holder_name`, `ifsc_code`, `branch_name`, `bank_address`, `occupation_type`, `company_name`, `designation`, `annual_income`, `income_source`, `pan_card_path`, `aadhaar_front_path`, `aadhaar_back_path`, `passport_photo_path`, `signature_path`, `cancelled_cheque_path`, `address_proof_path`, `income_proof_path`, `status`, `rejection_reason`, `submitted_at`, `verified_at`, `verified_by`, `demat_account_number`, `trading_account_number`, `dp_id`, `client_id`, `risk_appetite`, `investment_experience`, `investment_objectives`, `politically_exposed`, `us_citizen`, `agree_terms`, `agree_declaration`, `submission_ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'BPXPA0623Q', '443929863390', 'Aasif', 'saddam', 'Ahmed', '2003-02-01', 'male', 'abid', 'rafiya', '9589642080', 'hrnatrajinfotech@gmail.com', '9876543210', '722 Azad Nagar Indore', 'Indore', 'Maharashtra', '452001', 'India', '722 Azad Nagar Indore', 'Indore', 'Maharashtra', '452001', 'India', 1, 'HDFC Bank', '98765432154', 'aasif ahmed', NULL, 'indore', '722 Azad Nagar Indore', 'salaried', 'arstech', 'Web Developer', 100000.00, 'salary', 'uploads/kyc/documents/5/1764579921-Wv37uEkMxQ.png', 'uploads/kyc/documents/5/1764579921-FlmCXYat9h.png', 'uploads/kyc/documents/5/1764579921-AgX6HW5K4V.png', 'uploads/kyc/documents/5/1764579921-VOb35Lnqz5.png', 'uploads/kyc/documents/5/1764579921-54UzkauTNy.png', 'uploads/kyc/documents/5/1764579921-EHqBPpeoIT.png', 'uploads/kyc/documents/5/1764579921-1MgeDshm9V.png', 'uploads/kyc/documents/5/1764579921-YNql9xGPzp.png', 'submitted', NULL, '2025-12-01 03:35:21', NULL, NULL, NULL, NULL, NULL, NULL, 'low', 'intermediate', 'sddsda', 1, 1, 1, 1, '127.0.0.1', '2025-12-01 03:34:53', '2025-12-01 03:35:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) NOT NULL,
  `iso_code` varchar(255) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active,2=inactive',
  `default_language` varchar(255) DEFAULT 'off' COMMENT 'on,off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`, `iso_code`, `flag`, `rtl`, `status`, `default_language`, `created_at`, `updated_at`) VALUES
(2, 'Spanish', 'es', '<i class=\"flag-icon flag-icon-es\"></i>', 0, 1, 'off', '2024-04-03 08:08:17', '2025-12-01 00:13:36'),
(3, 'Portuguese', 'pt', '<i class=\"flag-icon flag-icon-pt\"></i>', 0, 1, 'off', '2024-10-30 05:02:08', '2025-12-01 00:13:36'),
(4, 'English', 'gb', '<i class=\"flag-icon flag-icon-gb\"></i>', 0, 1, 'on', '2024-10-30 05:02:08', '2025-12-01 00:13:36'),
(10, 'Hindi', 'in', 'in', 0, 1, 'off', '2025-01-13 02:33:50', '2025-12-01 00:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `mail_templates`
--

CREATE TABLE `mail_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT 'default_alias',
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `shortcodes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`shortcodes`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_templates`
--

INSERT INTO `mail_templates` (`id`, `alias`, `name`, `subject`, `body`, `status`, `shortcodes`, `created_at`, `updated_at`) VALUES
(4, 'employee_leave_notification', 'Employee Leave Notification', 'Leave Request Notification for {employee_name}', '<p>Dear {manager_name},</p>\r\n\r\n<p>We have received a leave request from {employee_name}.</p>\r\n\r\n<p>Here are the details of the request:</p>\r\n\r\n<p>- **Employee Name**: {employee_name}<br />\r\n- **Department**: {department}<br />\r\n- **Leave Type**: {leave_type}<br />\r\n- **Start Date**: {start_date}<br />\r\n- **End Date**: {end_date}<br />\r\n- **Reason**: {leave_reason}</p>\r\n\r\n<p>Please review this request and take the necessary action.</p>\r\n\r\n<p>Kind regards, &nbsp;<br />\r\n{website_name}<br />\r\n&nbsp;</p>', 1, '{\"employee_name\":\"John Doe\",\"manager_name\":\"Jane Smith\",\"department\":\"Sales\",\"leave_type\":\"Annual Leave\",\"start_date\":\"2025-01-20\",\"end_date\":\"2025-01-25\",\"leave_reason\":\"Family trip\",\"website_name\":\"HR Portal\"}', NULL, NULL),
(5, 'password_reset', 'Restablecer Contraseña', 'Notificación de Restablecimiento de Contraseña', '<div class=\"email-container\">\r\n<h2 class=\"email-header\">Notificaci&oacute;n de Restablecimiento de Contrase&ntilde;a</h2>\r\n<p class=\"email-body\">&iexcl;Hola!</p>\r\n<p class=\"email-body\">Est&aacute;s recibiendo este correo electr&oacute;nico porque hemos recibido una solicitud para restablecer la contrase&ntilde;a de tu cuenta.</p>\r\n<p class=\"email-body\">Haz clic en el bot&oacute;n de abajo para restablecer tu contrase&ntilde;a:</p>\r\n<p style=\"text-align: center;\"><a class=\"email-button\" href=\"{{link}}\">Restablecer Contrase&ntilde;a</a></p>\r\n<p class=\"email-body\">Este enlace para restablecer la contrase&ntilde;a caducar&aacute; en 15 minutos. Si no solicitaste un restablecimiento de contrase&ntilde;a, no es necesario que realices ninguna otra acci&oacute;n.</p>\r\n<p class=\"email-body\">Saludos cordiales,</p>\r\n<p class=\"email-body\">El equipo de Negociosgen</p>\r\n<hr style=\"border-top: 1px solid #ddd; margin: 20px 0;\">\r\n<p class=\"email-footer\">Recibiste este correo porque te suscribiste a nuestra lista.<br>Darse de baja de futuros correos o actualizar las preferencias de correo.<br>&copy; 2024 Negociosgen. Todos los derechos reservados.</p>\r\n</div>', 1, '{\r\n\"link\":\"Password reset link\",\r\n\"expiry_time\":\"Link expiry time\",\r\n\"website_name\":\"Your website name\"\r\n}', NULL, NULL),
(6, 'email_verification', 'Email Verification', 'Verify Your Email Address - F Standard', '<h2>Welcome to F Standard!</h2>\n     <p>Thank you for registering. Please verify your email address by clicking the button below:</p>\n     <p><a href=\"{{link}}\" style=\"background:#f89c10;color:white;padding:12px 30px;text-decoration:none;border-radius:50px;font-weight:bold;\">Verify Email Address</a></p>\n     <p>If you did not create an account, you can safely ignore this email.</p>\n     <p>Thanks,<br>F Standard Team</p>', 1, '{\"link\":\"Verification URL\",\"website_name\":\"F Standard\"}', '2025-11-24 11:33:52', '2025-11-24 11:33:52');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_seen` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `slug` varchar(191) DEFAULT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `meta_title` mediumtext DEFAULT NULL,
  `meta_description` mediumtext DEFAULT NULL,
  `meta_keyword` mediumtext DEFAULT NULL,
  `og_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `uuid`, `slug`, `page_name`, `meta_title`, `meta_description`, `meta_keyword`, `og_image`, `created_at`, `updated_at`) VALUES
(1, '4bcd0b6f-5692-4966-8a4e-8884d72edaa4', 'home', 'Home', 'Home', 'LMSZai Learning management system', 'Lmszai, Lms, Learning, Course', NULL, NULL, '2023-07-18 07:44:59'),
(2, '3c3ef58d-d459-441b-9b90-370f840b2da1', 'course', 'Course List', 'Courses', 'LMSZai Course List', 'Lmszai, Lms, Learning, Course', NULL, NULL, '2023-07-18 07:44:59'),
(5, '62892323-3220-408d-81ea-8875dc1065f4', 'blog', 'Blog List', 'Blog', 'LMSZAI Blog', 'blog, course', NULL, NULL, '2023-07-18 07:44:59'),
(7, '4869c7e6-9635-4203-850a-09a41f4954cc', 'about_us', 'About Us', 'About Us', 'About Us', 'about us', NULL, NULL, '2024-06-07 05:23:20'),
(8, 'b7b70870-0248-4781-a9a3-a76cffefb534', 'contact_us', 'Contact Us', 'Contact Us', 'LMSZAI contact us', 'lmszai, contact us', NULL, NULL, '2023-07-18 07:44:59'),
(9, '07d0a702-7a57-428f-8003-c172679ecbd2', 'support_faq', 'Support Page', 'Support', 'LMSZAI support ticket', 'lmszai, support, ticket', NULL, NULL, '2023-07-18 07:44:59'),
(10, 'f00f9d36-6b9c-47ee-8649-8f50a2f9fe7a', 'privacy_policy', 'Privacy Policy', 'Privacy Policy', 'LMSZAI Privacy Policy', 'lmszai, privacy, policy', NULL, NULL, '2023-07-18 07:44:59'),
(11, 'f74400a5-415f-4604-849e-a03e4896ff99', 'cookie_policy', 'Cookie Policy', 'Cookie Policy', 'LMSZAI Cookie Policy', 'lmszai, cookie, policy', NULL, NULL, '2023-07-18 07:44:59'),
(12, '2e0f0a6e-c573-475c-8913-95e241504c1a', 'faq', 'FAQ', 'FAQ', 'LMSZAI FAQ', 'lmszai, faq', NULL, NULL, '2023-07-18 07:44:59'),
(13, '2e0f0a6e-c573-479c-8913-95e241504c1a', 'terms_and_condition', 'Terms & Conditions', 'Terms & Conditions', 'LMSZAI Terms & Conditions Policy', 'Terms,Conditions', NULL, NULL, '2023-07-18 07:44:59'),
(14, '2e0f0a6e-c573-479c-8913-95e24150000a', 'refund_policy', 'Refund Policy', 'Refund Policy', 'LMSZAI Refund Policy', 'Refund Policies', NULL, NULL, '2023-07-18 07:44:59'),
(51, 'd538d469-265f-44fc-95b9-dc57d10f8c81', 'default', 'Default', 'Demo Title', 'Demo Description', 'Demo Keywords', '', NULL, NULL),
(52, 'a241f1cb-3711-4609-90b2-976cb1ab53f7', 'auth', 'Auth Page', 'Auth Page', 'Auth Page Meta Description', 'Auth Page Meta Keywords', '', NULL, NULL),
(53, '26092a11-6aea-44ce-8880-41b47c692324', 'bundle', 'Bundle List', 'Bundle List', 'Bundle List Page Meta Description', 'Bundle List Page Meta Keywords', '', NULL, NULL),
(54, '42c68cfa-028f-4ffd-b4a0-b8da50978854', 'consultation', 'Consultation List', 'Consultation List', 'Consultation List Page Meta Description', 'Consultation List Page Meta Keywords', '', NULL, NULL),
(55, '857e3c5c-8430-4c5d-b009-e8f7e33dceb0', 'instructor', 'Instructor List', 'Instructor List', 'Instructor List Page Meta Description', 'Instructor List Page Meta Keywords', '', NULL, NULL),
(56, '2f9557c3-c10e-4b47-bf1c-040b6f0182e3', 'saas', 'Saas List', 'Saas List', 'Saas List Page Meta Description', 'Saas List Page Meta Keywords', '', NULL, NULL),
(57, 'b945d05c-d72b-4d1e-838d-f552c769d28f', 'subscription', 'Subscription List', 'Subscription List', 'Subscription List Page Meta Description', 'Subscription List Page Meta Keywords', '', NULL, NULL),
(58, 'a26d5ab1-1fd5-4eeb-9b32-04469f751cbf', 'verify_certificate', 'Verify certificate List', 'Verify certificate List', 'Verify certificate List Page Meta Description', 'Verify certificate List Page Meta Keywords', '', NULL, NULL),
(59, 'e5089c78-bca2-4d57-9cd4-2f3792d09810', 'forum', 'Forum', 'Forum', 'Forum Page Meta Description', 'Forum Page Meta Keywords', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_17_112209_add_socialite_fields_to_users_table', 2),
(6, '2023_12_24_999999_add_active_status_to_users', 3),
(7, '2023_12_24_999999_add_avatar_to_users', 3),
(8, '2023_12_24_999999_add_dark_mode_to_users', 3),
(9, '2023_12_24_999999_add_messenger_color_to_users', 3),
(10, '2023_12_24_999999_create_chatify_favorites_table', 3),
(11, '2023_12_24_999999_create_chatify_messages_table', 3),
(12, '2023_12_25_053745_create_orders_table', 4),
(13, '2023_12_25_104906_create_tasks_table', 5),
(14, '2023_12_25_133036_create_purchases_table', 6),
(15, '2023_12_27_043258_create_balances_table', 7),
(16, '2023_12_27_044127_add_balance_to_users_table', 8),
(17, '2023_12_27_080751_create_payments_table', 9),
(18, '2016_06_01_000001_create_oauth_auth_codes_table', 10),
(19, '2016_06_01_000002_create_oauth_access_tokens_table', 10),
(20, '2016_06_01_000003_create_oauth_refresh_tokens_table', 10),
(21, '2016_06_01_000004_create_oauth_clients_table', 10),
(22, '2016_06_01_000005_create_oauth_personal_access_clients_table', 10),
(23, '2024_01_10_085202_create_posting_ads_table', 11),
(24, '2024_01_10_121310_create_images_table', 12),
(25, '2024_01_17_071550_create_banners_table', 13),
(26, '2024_01_17_085258_create_ads_table', 14),
(27, '2024_01_17_104036_create_calendars_table', 15),
(28, '2024_01_17_140951_create_credit_reload_promotions_table', 16),
(29, '2024_01_16_172130_create_attentions_table', 17),
(30, '2024_06_09_091155_create_permissions_table', 18),
(31, '2024_06_24_084835_create_product_variations_table', 19),
(32, '2024_11_03_091345_create_courses_table', 20),
(33, '2024_11_03_095819_add_uuid_to_courses_table', 21),
(34, '2024_11_03_100251_add_video_thumbnail_to_courses_table', 22),
(35, '2024_11_05_055606_create_events_table', 23),
(36, '2024_11_24_044400_create_audiobooks_table', 24),
(37, '2024_11_28_032108_create_sales_table', 25),
(38, '2025_01_14_062929_create_mail_templates_table', 26),
(39, '2025_01_16_103920_create_folders_table', 27),
(40, '2025_01_16_103948_create_files_table', 27),
(41, '2025_02_14_014007_create_comments_table', 28),
(42, '2025_02_14_015030_create_reactions_table', 28),
(43, '2025_04_02_074447_create_products_table', 29),
(44, '2025_04_02_074448_create_quotations_table', 29),
(45, '2025_05_21_154537_create_orders_table', 30),
(46, '2025_06_25_081735_create_chambeador_profiles_table', 31),
(47, '2025_06_25_084013_create_background_certificates_table', 32),
(48, '2025_06_25_084118_create_identity_cards_table', 32),
(49, '2025_10_16_081658_create_clients_table', 33),
(50, '2025_10_16_081722_create_equipment_table', 33),
(51, '2025_10_16_081938_create_inspection_photos_table', 34),
(52, '2025_11_24_121955_create_affiliates_table', 35),
(53, '2025_11_24_122242_add_affiliate_fields_to_users_table', 35),
(54, '2025_11_29_042601_create_funding_plans_table', 36),
(55, '2025_11_29_054809_update_plan_purchases_table_add_fields', 37),
(56, '2025_11_29_062227_add_gateway_fields_to_plan_purchases_table', 38),
(57, '2025_11_29_080938_add_mt4_credentials_to_plan_purchases_table', 39),
(58, '2025_11_29_090721_create_celebrity_endorsements_table', 40),
(59, '2025_12_01_022449_create_system_trade_configs_table', 41),
(60, '2025_12_01_034040_create_referral_settings_table', 42),
(61, '2025_12_01_035805_create_notification_settings_table', 43),
(62, '2025_12_05_033849_create_trade_logs_table', 44),
(63, '2025_12_05_033917_create_evaluation_accounts_table', 44),
(64, '2025_12_05_033940_create_behavioural_metrics_table', 44),
(65, '2025_12_05_035141_create_blockchain_hash_records_table', 44),
(66, '2025_12_05_035204_create_delayed_feed_assignments_table', 44),
(67, '2025_12_05_035249_create_slippage_profiles_table', 44),
(68, '2025_12_05_035309_create_hedging_monitors_table', 44),
(69, '2025_12_07_025642_create_orders_table', 45),
(70, '2025_12_07_025736_create_trades_table', 45),
(71, '2025_12_07_030207_create_challenges_table', 45),
(72, '2025_12_07_033521_safe_enhance_orders_table', 46);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `type` enum('text','image','audio','video') NOT NULL DEFAULT 'text',
  `thumbnail` varchar(191) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `file_path` varchar(191) DEFAULT NULL,
  `author` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `sender_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `text` varchar(255) NOT NULL,
  `target_url` varchar(255) DEFAULT NULL,
  `is_seen` varchar(255) NOT NULL DEFAULT 'no' COMMENT 'yes, no',
  `user_type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=admin, 2=instructor, 3=student',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `uuid`, `sender_id`, `user_id`, `text`, `target_url`, `is_seen`, `user_type`, `created_at`, `updated_at`) VALUES
(1, 'ed2ca2b7-bdb4-4fd2-b6a9-e69c128cca29', 1, 1, 'A new blog has been posted on the platform.', 'http://127.0.0.1:8000/blog_details/dsffsdf', 'no', 2, '2025-11-23 00:48:13', '2025-11-23 00:48:13'),
(2, 'ae2f9e83-575d-4df2-84b5-b34cb9fcf827', 9, 9, 'A new user has registered on the platform.', 'http://127.0.0.1:8000/admin/users', 'no', 1, '2025-11-24 06:04:54', '2025-11-24 06:04:54'),
(3, 'c85cfee8-e80b-4a53-a980-11a6d1e77c11', 10, 10, 'A new user has registered on the platform.', 'http://127.0.0.1:8000/admin/users', 'no', 1, '2025-11-24 06:07:25', '2025-11-24 06:07:25'),
(4, '2fdb001a-9517-4c3b-a3b7-1d117e39bf22', 11, 11, 'A new user has registered on the platform.', 'http://127.0.0.1:8000/admin/users', 'no', 1, '2025-11-24 06:21:06', '2025-11-24 06:21:06'),
(5, '583dc31f-4ba2-40a9-8302-bf59ac6df265', 13, 13, 'A new user has registered on the platform.', 'http://127.0.0.1:8000/admin/users', 'no', 1, '2025-11-24 06:38:35', '2025-11-24 06:38:35'),
(6, 'bb77fc74-4632-46dc-a57e-6a3cc10811ad', 5, 5, 'Un nuevo ticket ha sido creado con el siguiente asunto', 'http://127.0.0.1:8000/admin/support-ticket/index', 'no', 1, '2025-12-01 00:51:54', '2025-12-01 00:51:54'),
(7, '1330c0b2-62ac-4d74-8064-72570ff45f2b', 14, 14, 'A new user has registered on the platform.', 'http://127.0.0.1:8000/admin/users', 'no', 1, '2025-12-01 21:41:44', '2025-12-01 21:41:44'),
(8, 'b8abd9f8-0ca0-4852-8953-09499c81b6b3', 14, 14, 'Un nuevo ticket ha sido creado con el siguiente asunto', 'http://127.0.0.1:8000/admin/support-ticket/index', 'no', 1, '2025-12-01 21:43:39', '2025-12-01 21:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE `notification_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sender` varchar(40) DEFAULT NULL,
  `sent_from` varchar(40) DEFAULT NULL,
  `sent_to` varchar(40) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `notification_type` varchar(40) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_settings`
--

CREATE TABLE `notification_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fcm_api_key` varchar(255) DEFAULT NULL,
  `fcm_auth_domain` varchar(255) DEFAULT NULL,
  `fcm_project_id` varchar(255) DEFAULT NULL,
  `fcm_storage_bucket` varchar(255) DEFAULT NULL,
  `fcm_messaging_sender_id` varchar(255) DEFAULT NULL,
  `fcm_app_id` varchar(255) DEFAULT NULL,
  `fcm_measurement_id` varchar(255) DEFAULT NULL,
  `sms_provider` enum('nexmo','twilio','msg91','textlocal') NOT NULL DEFAULT 'nexmo',
  `nexmo_api_key` varchar(255) DEFAULT NULL,
  `nexmo_api_secret` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_settings`
--

INSERT INTO `notification_settings` (`id`, `fcm_api_key`, `fcm_auth_domain`, `fcm_project_id`, `fcm_storage_bucket`, `fcm_messaging_sender_id`, `fcm_app_id`, `fcm_measurement_id`, `sms_provider`, `nexmo_api_key`, `nexmo_api_secret`, `created_at`, `updated_at`) VALUES
(1, 'AIzaSyBsyabUP_yV7PTbsWtV6Be-eWVra9w_QDPg', 'fstandard-project.firebaseapp.com', 'fstandard-project', 'fstandard-project.appspot.com', '678649964403', '1:678649964403:web:94d6f4bcaf22ad2550706', 'G-X0Y03EL75D', 'twilio', 'cfzsfsdfdsfasdasd', NULL, '2025-11-30 22:31:46', '2025-11-30 22:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `act` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `push_title` varchar(255) DEFAULT NULL,
  `email_body` text DEFAULT NULL,
  `sms_body` text DEFAULT NULL,
  `push_body` text DEFAULT NULL,
  `shortcodes` text DEFAULT NULL,
  `email_status` tinyint(1) NOT NULL DEFAULT 1,
  `email_sent_from_name` varchar(40) DEFAULT NULL,
  `email_sent_from_address` varchar(40) DEFAULT NULL,
  `sms_status` tinyint(1) NOT NULL DEFAULT 1,
  `sms_sent_from` varchar(40) DEFAULT NULL,
  `push_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `act`, `name`, `subject`, `push_title`, `email_body`, `sms_body`, `push_body`, `shortcodes`, `email_status`, `email_sent_from_name`, `email_sent_from_address`, `sms_status`, `sms_sent_from`, `push_status`, `created_at`, `updated_at`) VALUES
(1, 'BAL_ADD', 'Balance - Added', 'Your Account has been Credited', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} INR has been credited to your account.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number: {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your Current Balance: <b>{{post_balance}} INR</b></div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div>Admin Note: {{remark}}</div>', '{{amount}} INR credited to your account. Current Balance {{post_balance}} INR. TRX: #{{trx}}', NULL, '{\"trx\":\"Transaction number\",\"amount\":\"Amount added\",\"remark\":\"Admin remark\",\"post_balance\":\"Balance after transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-12-01 00:02:26'),
(2, 'BAL_SUB', 'Balance - Subtracted', 'Your Account has been Debited', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">{{amount}} INR has been deducted from your account.</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Transaction Number: {{trx}}</div><div style=\"font-family: Montserrat, sans-serif;\"><br></div><div style=\"font-family: Montserrat, sans-serif;\">Your Current Balance: <b>{{post_balance}} INR</b></div><div>Admin Note: {{remark}}</div>', '{{amount}} INR debited from your account. Current Balance {{post_balance}} INR. TRX: #{{trx}}', NULL, '{\"trx\":\"Transaction number\",\"amount\":\"Amount deducted\",\"remark\":\"Admin remark\",\"post_balance\":\"Balance after transaction\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(3, 'DEPOSIT_COMPLETE', 'Deposit - Successful', 'Deposit Completed Successfully', NULL, '<div>Your deposit of <b>{{amount}} INR</b> has been completed successfully.<br><br>Transaction ID: {{trx}}<br><br>Your current balance is <b>{{post_balance}} INR</b></div>', '{{amount}} INR deposited successfully. TRX: {{trx}}', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Deposited amount\",\"post_balance\":\"Balance after deposit\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(4, 'DEPOSIT_APPROVE', 'Deposit - Approved', 'Your Deposit is Approved', NULL, '<div>Your deposit of <b>{{amount}} INR</b> has been approved.<br><br>Transaction ID: {{trx}}<br><br>Your current balance is <b>{{post_balance}} INR</b></div>', 'Your {{amount}} INR deposit approved. TRX: {{trx}}', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Deposited amount\",\"post_balance\":\"Balance after deposit\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(5, 'DEPOSIT_REJECT', 'Deposit - Rejected', 'Your Deposit Request is Rejected', NULL, '<div>Your deposit request of <b>{{amount}} INR</b> has been rejected.<br><br>Transaction ID: {{trx}}<br><br>Reason: {{rejection_message}}</div>', 'Your {{amount}} INR deposit rejected. Reason: {{rejection_message}}', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Requested amount\",\"rejection_message\":\"Rejection reason\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(6, 'DEPOSIT_REQUEST', 'Deposit - Requested', 'Deposit Request Submitted', NULL, '<div>Your deposit request of <b>{{amount}} INR</b> submitted successfully.<br><br>Transaction ID: {{trx}}</div>', '{{amount}} INR deposit request submitted. TRX: {{trx}}', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Requested amount\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(7, 'PASS_RESET_CODE', 'Password Reset Code', 'Password Reset Verification', NULL, '<div style=\"font-family: Montserrat, sans-serif;\">Your password reset code is: <b><font size=\"6\">{{code}}</font></b><br><br>Requested from IP: {{ip}} | {{browser}} on {{operating_system}}</div>', 'Your password reset code: {{code}}', NULL, '{\"code\":\"Verification code\",\"ip\":\"IP\",\"browser\":\"Browser\",\"operating_system\":\"OS\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(8, 'PASS_RESET_DONE', 'Password Reset Done', 'Password Changed Successfully', NULL, '<div>You have successfully changed your password from IP: {{ip}} using {{browser}} on {{operating_system}} at {{time}}</div>', 'Password changed successfully', NULL, '{\"ip\":\"IP\",\"browser\":\"Browser\",\"operating_system\":\"OS\",\"time\":\"Time\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(9, 'ADMIN_SUPPORT_REPLY', 'Support Ticket Reply', 'New Reply on Your Ticket', NULL, '<div>A support team member replied to your ticket:<br><br><b>Ticket #{{ticket_id}} - {{ticket_subject}}</b><br><br>Reply: {{reply}}<br><br>Click here to view: {{link}}</div>', 'New reply on Ticket #{{ticket_id}}', NULL, '{\"ticket_id\":\"Ticket ID\",\"ticket_subject\":\"Subject\",\"reply\":\"Admin reply\",\"link\":\"Ticket URL\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(10, 'EVER_CODE', 'Email Verification', 'Verify Your Email', NULL, '<div>Your email verification code is: <b><font size=\"6\">{{code}}</font></b></div>', 'Email verification code: {{code}}', NULL, '{\"code\":\"Verification code\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(11, 'SVER_CODE', 'SMS Verification', 'Verify Your Phone', NULL, 'Your phone verification code: {{code}}', 'Your phone verification code: {{code}}', NULL, '{\"code\":\"SMS code\"}', 0, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(12, 'WITHDRAW_APPROVE', 'Withdraw Approved', 'Withdrawal Processed', NULL, '<div>Your withdrawal of <b>{{amount}} INR</b> has been processed successfully.<br><br>Transaction ID: {{trx}}<br><br>Amount credited to your bank/account: {{amount}} INR (after charges)<br><br>Admin Details: {{admin_details}}</div>', 'Withdrawal of {{amount}} INR approved. TRX: {{trx}}', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Withdrawn amount\",\"admin_details\":\"Admin note\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(13, 'WITHDRAW_REJECT', 'Withdraw Rejected', 'Withdrawal Rejected', NULL, '<div>Your withdrawal request of <b>{{amount}} INR</b> has been rejected and refunded.<br><br>Transaction ID: {{trx}}<br>Current Balance: <b>{{post_balance}} INR</b><br>Reason: {{admin_details}}</div>', 'Withdrawal {{amount}} INR rejected & refunded. Balance {{post_balance}} INR', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Requested amount\",\"post_balance\":\"Current balance\",\"admin_details\":\"Rejection reason\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(14, 'WITHDRAW_REQUEST', 'Withdraw Requested', 'Withdrawal Request Submitted', NULL, '<div>Your withdrawal request of <b>{{amount}} INR</b> submitted successfully.<br><br>Transaction ID: {{trx}}<br>Current Balance: {{post_balance}} INR</div>', 'Withdrawal request {{amount}} INR submitted. TRX: {{trx}}', NULL, '{\"trx\":\"Transaction ID\",\"amount\":\"Requested amount\",\"post_balance\":\"Balance after request\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(15, 'DEFAULT', 'Default Template', '{{subject}}', NULL, '{{message}}', '{{message}}', NULL, '{\"subject\":\"Subject\",\"message\":\"Message\"}', 1, NULL, NULL, 1, NULL, 0, '2019-09-14 07:44:22', '2025-11-28 04:30:00'),
(21, 'REFERRAL_COMMISSION', 'Referral Commission', 'Referral Bonus Credited', NULL, '<div>You received <b>{{amount}} INR</b> as referral commission.<br><br>Level: {{level}}<br>Transaction: {{trx}}<br>Current Balance: <b>{{post_balance}} INR</b></div>', 'You earned {{amount}} INR referral bonus!', NULL, '{\"amount\":\"Bonus amount\",\"level\":\"Referral level\",\"trx\":\"Transaction ID\",\"post_balance\":\"Current balance\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(22, 'RECEIVED_MONEY', 'Money Received', 'You Received Money', NULL, '<div>You received <b>{{amount}} INR</b> from {{from_username}}</div>', 'Received {{amount}} INR from {{from_username}}', NULL, '{\"amount\":\"Amount\",\"from_username\":\"Sender\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00'),
(23, 'TRANSFER_MONEY', 'Money Transferred', 'Money Sent Successfully', NULL, '<div>You sent <b>{{amount}} INR</b> to {{to_username}}</div>', 'Sent {{amount}} INR to {{to_username}}', NULL, '{\"amount\":\"Amount\",\"to_username\":\"Receiver\"}', 1, NULL, NULL, 1, NULL, 0, '2021-11-03 06:30:00', '2025-11-28 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_symbol` varchar(255) NOT NULL,
  `security_id` varchar(255) DEFAULT NULL,
  `order_side` int(11) NOT NULL,
  `order_type` int(11) NOT NULL,
  `product_type` varchar(255) NOT NULL DEFAULT 'INTRADAY',
  `price` decimal(15,2) NOT NULL,
  `trigger_price` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(10,4) NOT NULL,
  `disclosed_quantity` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `filled_quantity` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `filled_percentage` int(11) NOT NULL DEFAULT 0,
  `average_price` decimal(15,2) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `brokerage` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL,
  `trx` varchar(255) DEFAULT NULL,
  `parent_order_id` varchar(255) DEFAULT NULL,
  `correlation_id` varchar(255) DEFAULT NULL,
  `placed_by` varchar(255) NOT NULL DEFAULT 'user',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `challenge_id`, `stock_symbol`, `security_id`, `order_side`, `order_type`, `product_type`, `price`, `trigger_price`, `quantity`, `disclosed_quantity`, `filled_quantity`, `filled_percentage`, `average_price`, `total_amount`, `brokerage`, `status`, `trx`, `parent_order_id`, `correlation_id`, `placed_by`, `meta`, `created_at`, `updated_at`) VALUES
(1, 15, 3, 'RELIANCE', '1333', 1, 2, 'INTRADAY', 0.00, NULL, 15.0000, 0.0000, 15.0000, 100, 2575.75, 38636.25, 20.00, 1, '412307150001', NULL, 'ebeba750-a6fd-4d28-a9fc-a5242deaea1d', 'user', NULL, '2025-12-03 22:31:52', '2025-12-03 22:31:52'),
(2, 15, 3, 'TCS', '11536', 2, 1, 'INTRADAY', 3780.00, NULL, 8.0000, 0.0000, 8.0000, 100, 3780.00, 30240.00, 15.00, 1, '412307150045', NULL, 'c4ec9b9e-34e3-4b09-86b5-613f0f660696', 'user', NULL, '2025-12-04 22:31:52', '2025-12-04 22:31:52'),
(3, 15, 3, 'INFY', '1594', 1, 1, 'INTRADAY', 1420.00, NULL, 25.0000, 0.0000, 0.0000, 0, NULL, NULL, 0.00, 0, '412307160089', NULL, '9ad60419-38c8-4ec9-9dea-05b31aefc24d', 'user', NULL, '2025-12-06 18:31:52', '2025-12-06 18:31:52'),
(4, 15, 3, 'HDFCBANK', '1330', 2, 3, 'INTRADAY', 1650.00, 1640.00, 20.0000, 0.0000, 20.0000, 100, 1642.50, 32850.00, 18.00, 1, '412307160112', NULL, '15136919-af6c-4c5a-86ee-ae8d26a07b55', 'user', '{\"sl_hit\":true}', '2025-12-05 22:31:52', '2025-12-05 22:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `our_histories`
--

CREATE TABLE `our_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_histories`
--

INSERT INTO `our_histories` (`id`, `year`, `title`, `subtitle`, `created_at`, `updated_at`) VALUES
(1, '1998', 'Mere tranquil existence', 'Possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart am alone', NULL, '2025-01-13 06:33:44'),
(2, '1998', 'Incapable of drawing', 'Exquisite sense of mere tranquil existence that I neglect my talents add should be incapable of drawing', NULL, '2025-01-13 06:33:44'),
(3, '1998', 'Foliage access trees', 'Serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my', NULL, '2025-01-13 06:33:44'),
(4, '1998', 'Among grass trickling', 'Should be incapable of drawing a single stroke at the present moment; and yet I feel that I never', NULL, '2025-01-13 06:33:44'),
(5, '1994', 'born', 'aasif', '2025-01-13 06:33:44', '2025-01-13 06:33:44');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(500) NOT NULL,
  `page_slug` varchar(500) NOT NULL,
  `page_content` text NOT NULL,
  `page_order` int(3) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `page_slug`, `page_content`, `page_order`, `status`) VALUES
(2, 'Términos y condiciones test', 'terminos-y-condiciones-test', '<p><strong>Use of this site is provided by Demos subject to the following Terms and Conditions:</strong><br />1. Your use constitutes acceptance of these Terms and Conditions as at the date of your first use of the site.<br />2. Demos reserves the rights to change these Terms and Conditions at any time by posting changes online. Your continued use of this site after changes are posted constitutes your acceptance of this agreement as modified.<br />3. You agree to use this site only for lawful purposes, and in a manner which does not infringe the rights, or restrict, or inhibit the use and enjoyment of the site by any third party.<br />4. This site and the information, names, images, pictures, logos regarding or relating to Demos are provided &ldquo;as is&rdquo; without any representation or endorsement made and without warranty of any kind whether express or implied. In no event will Demos be liable for any damages including, without limitation, indirect or consequential damages, or any damages whatsoever arising from the use or in connection with such use or loss of use of the site, whether in contract or in negligence.<br />5. Demos does not warrant that the functions contained in the material contained in this site will be uninterrupted or error free, that defects will be corrected, or that this site or the server that makes it available are free of viruses or bugs or represents the full functionality, accuracy and reliability of the materials.<br />6. Copyright restrictions: please refer to our Creative Commons license terms governing the use of material on this site.<br />7. Demos takes no responsibility for the content of external Internet Sites.<br />8. Any communication or material that you transmit to, or post on, any public area of the site including any data, questions, comments, suggestions, or the like, is, and will be treated as, non-confidential and non-proprietary information.<br />9. If there is any conflict between these Terms and Conditions and rules and/or specific terms of use appearing on this site relating to specific material then the latter shall prevail.<br />10. These terms and conditions shall be governed and construed in accordance with the laws of England and Wales. Any disputes shall be subject to the exclusive jurisdiction of the Courts of England and Wales.<br />11. If these Terms and Conditions are not accepted in full, the use of this site must be terminated immediately.</p>', 2, 1),
(5, 'Contact', 'contact', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing.</p>', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `product_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_details`)),
  `user_id` int(11) DEFAULT NULL,
  `reward_id` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `payment_receipt` text DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  `status` enum('initial','pending','success','failed','declined','dispute') DEFAULT 'initial',
  `payer_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `name`, `email`, `product_details`, `user_id`, `reward_id`, `amount`, `payment_receipt`, `accepted`, `status`, `payer_email`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Aasif Ahmed', NULL, NULL, 9, NULL, 1000.00, 'payment_receipt/logo.png', 1, 'initial', 'hrnatrajinffdggbvfdgotech@gmail.com', '2024-11-20 01:08:48', '2024-11-20 01:27:59'),
(2, NULL, 'brijlal pawar', NULL, NULL, 11, NULL, 1000.00, 'payment_receipt/socialandrea.png', 0, 'initial', 'brijlalpawar@gmail.com', '2024-11-20 02:02:16', '2024-11-20 02:02:16'),
(3, NULL, 'brijlal pawar', NULL, NULL, 11, NULL, 1000.00, 'payment_receipt/image (4).png', 0, 'initial', 'brijlalpawar@gmail.com', '2024-11-20 02:02:31', '2024-11-20 02:02:31'),
(4, NULL, 'brijlal pawar', NULL, NULL, 11, NULL, 198.00, 'payment_receipt/blog.png', 1, 'initial', 'brijlalpawar@gmail.com', '2024-11-20 02:02:48', '2024-11-20 02:14:25'),
(5, NULL, 'brijlal pawar', NULL, NULL, 11, NULL, 1000.00, 'payment_receipt/pqjvedcnyp9xjpaxk4kv.jpg', 1, 'initial', 'brijlalpawar@gmail.com', '2024-11-20 02:04:06', '2024-11-20 02:12:09'),
(6, NULL, 'brijlal pawar', NULL, NULL, 11, NULL, 1000.00, 'payment_receipt/pqjvedcnyp9xjpaxk4kv.jpg', 1, 'initial', 'brijlalpawar@gmail.com', '2024-11-20 02:04:44', '2024-11-20 02:10:32'),
(7, NULL, 'brijlal pawar', NULL, NULL, 11, NULL, 1000.00, 'payment_receipt/image_750x_65cc96e678ac4.png', 1, 'initial', 'brijlalpawar@gmail.com', '2024-11-20 02:06:59', '2024-11-20 02:08:40'),
(8, NULL, 'deepak rathore', NULL, NULL, 12, NULL, 1000.00, 'payment_receipt/Screenshot (129).png', 1, 'initial', 'deepak@gmail.com', '2024-11-21 23:11:21', '2024-11-21 23:11:37'),
(9, NULL, 'heena khan', NULL, NULL, 13, NULL, 1000.00, 'payment_receipt/image (5).png', 1, 'initial', 'heena@gmail.com', '2024-11-21 23:16:25', '2024-11-21 23:16:36'),
(10, NULL, 'akansha sharma', NULL, NULL, 14, NULL, 1000.00, 'payment_receipt/1657090503-9ynVP5V0Tx.jpg', 1, 'initial', 'akansha@gmail.com', '2024-11-22 00:14:03', '2024-11-22 00:14:43'),
(11, NULL, 'malka khan', NULL, NULL, 15, NULL, 1000.00, 'payment_receipt/IMG-20240124-WA0039.jpg', 1, 'initial', 'malkakhan@gmail.com', '2024-11-22 00:17:26', '2024-11-22 00:18:32'),
(12, NULL, 'xvxdffd sdfdfd', NULL, NULL, 16, NULL, 1000.00, 'payment_receipt/Sin título-2.png', 1, 'initial', 'dffffghwerw@gmail.com', '2024-11-27 22:12:41', '2024-11-27 22:13:54'),
(13, NULL, 'dfsfsfsd dfgsdfsf', NULL, NULL, 17, NULL, 1000.00, 'payment_receipt/images.jpg', 1, 'initial', 'dsfdsfxcfg@gmail.com', '2024-11-27 22:27:28', '2024-11-27 22:28:07'),
(14, NULL, 'nivesdk dgnjn', NULL, NULL, 18, NULL, 1000.00, 'payment_receipt/image (1).png', 1, 'initial', 'nbfef@gmail.com', '2024-11-27 22:31:42', '2024-11-27 22:31:51'),
(15, NULL, 'cxvxvxdfgerfsd fghfghfbhdgr', NULL, NULL, 19, NULL, 1000.00, 'payment_receipt/IMG-20240124-WA0040.jpg', 1, 'initial', 'qweqwzdawe@gmail.com', '2024-11-28 01:20:45', '2024-11-28 01:20:54'),
(16, NULL, 'park xzf', NULL, NULL, 20, NULL, 1000.00, 'payment_receipt/IMG-20240124-WA0041-removebg-preview.png', 1, 'initial', 'park@gmail.com', '2024-11-28 01:24:08', '2024-11-28 01:24:14'),
(17, NULL, 'dante tan', NULL, NULL, 21, NULL, 1000.00, 'payment_receipt/english-flag-vector-675964.jpg', 1, 'initial', 'dante@gmail.com', '2024-11-28 01:26:00', '2024-11-28 01:26:07'),
(18, NULL, 'dxzcdzfsa fg', NULL, NULL, 22, NULL, 1000.00, 'payment_receipt/1657090503-9ynVP5V0Tx.jpg', 1, 'initial', 'sdfxcsdfsa@gmail.com', '2024-11-28 01:34:09', '2024-11-28 01:34:16'),
(19, NULL, 'czxc xv', NULL, NULL, 23, NULL, 1000.00, 'payment_receipt/20241115_210616.jpg', 1, 'initial', 'zxc@gmail.com', '2024-11-28 01:35:45', '2024-11-28 01:35:53'),
(20, NULL, 'dgsdff sdfsafaf', NULL, NULL, 24, NULL, 1000.00, 'payment_receipt/logo.png', 1, 'initial', 'sdfzscqwfewqsafrq@gmail.com', '2024-11-28 01:37:45', '2024-11-28 01:37:51'),
(21, 1, NULL, NULL, NULL, 28, NULL, 50.00, NULL, 0, 'initial', NULL, '2025-05-21 11:25:38', '2025-05-21 11:25:38'),
(22, 2, NULL, NULL, NULL, 30, NULL, 75.00, NULL, 0, 'initial', NULL, '2025-05-22 09:50:05', '2025-05-22 09:50:05'),
(23, 3, NULL, NULL, NULL, 31, NULL, 50.00, NULL, 0, 'initial', NULL, '2025-05-22 14:41:40', '2025-05-22 14:41:40'),
(24, 4, NULL, NULL, NULL, 31, NULL, 25.00, NULL, 0, 'initial', NULL, '2025-05-22 14:42:04', '2025-05-22 14:42:04'),
(25, 5, NULL, NULL, NULL, 31, NULL, 945.00, NULL, 0, 'initial', NULL, '2025-05-22 20:39:13', '2025-05-22 20:39:13'),
(26, 6, NULL, NULL, NULL, 28, NULL, 360.00, NULL, 0, 'initial', NULL, '2025-05-24 04:53:25', '2025-05-24 04:53:25'),
(27, 7, NULL, NULL, NULL, 28, NULL, 140.00, NULL, 0, 'initial', NULL, '2025-05-24 05:01:09', '2025-05-24 05:01:09'),
(28, 8, NULL, NULL, NULL, 29, NULL, 215.00, NULL, 0, 'initial', NULL, '2025-05-24 08:44:24', '2025-05-24 08:44:24'),
(29, 9, NULL, NULL, NULL, 31, NULL, 740.00, NULL, 0, 'initial', NULL, '2025-05-24 18:30:51', '2025-05-24 18:30:51'),
(30, 10, NULL, NULL, NULL, 31, NULL, 260.00, NULL, 0, 'initial', NULL, '2025-05-25 13:59:25', '2025-05-25 13:59:25'),
(31, 11, NULL, NULL, NULL, 31, NULL, 240.00, NULL, 0, 'initial', NULL, '2025-05-25 14:04:53', '2025-05-25 14:04:53'),
(32, 12, NULL, NULL, NULL, 31, NULL, 120.00, NULL, 0, 'initial', NULL, '2025-05-25 14:08:41', '2025-05-25 14:08:41'),
(33, 13, NULL, NULL, NULL, 31, NULL, 387.00, NULL, 0, 'initial', NULL, '2025-05-25 15:04:23', '2025-05-25 15:04:23'),
(34, 14, NULL, NULL, NULL, 31, NULL, 120.00, NULL, 0, 'initial', NULL, '2025-05-26 05:42:11', '2025-05-26 05:42:11'),
(35, 15, NULL, NULL, NULL, 31, NULL, 555.00, NULL, 0, 'initial', NULL, '2025-05-27 10:15:02', '2025-05-27 10:15:02'),
(36, 16, NULL, NULL, NULL, 31, NULL, 250.00, NULL, 0, 'initial', NULL, '2025-05-28 16:04:46', '2025-05-28 16:04:46'),
(37, 17, NULL, NULL, NULL, 31, NULL, 270.00, NULL, 0, 'initial', NULL, '2025-05-28 16:39:24', '2025-05-28 16:39:24'),
(38, 18, NULL, NULL, NULL, 31, NULL, 120.00, NULL, 0, 'initial', NULL, '2025-05-28 16:40:18', '2025-05-28 16:40:18'),
(39, 19, NULL, NULL, NULL, 31, NULL, 770.00, NULL, 0, 'initial', NULL, '2025-05-28 19:52:47', '2025-05-28 19:52:47'),
(40, 20, NULL, NULL, NULL, 31, NULL, 120.00, NULL, 0, 'initial', NULL, '2025-05-28 19:55:32', '2025-05-28 19:55:32'),
(41, 21, NULL, NULL, NULL, 31, NULL, 140.00, NULL, 0, 'initial', NULL, '2025-05-28 22:11:56', '2025-05-28 22:11:56'),
(42, 22, NULL, NULL, NULL, 31, NULL, 360.00, NULL, 0, 'initial', NULL, '2025-05-29 01:00:26', '2025-05-29 01:00:26'),
(43, 23, NULL, NULL, NULL, 31, NULL, 360.00, NULL, 0, 'initial', NULL, '2025-05-29 01:05:49', '2025-05-29 01:05:49'),
(44, 24, NULL, NULL, NULL, 29, NULL, 300.00, NULL, 0, 'initial', NULL, '2025-05-29 04:33:05', '2025-05-29 04:33:05'),
(45, 25, NULL, NULL, NULL, 31, NULL, 145.00, NULL, 0, 'initial', NULL, '2025-05-29 11:19:17', '2025-05-29 11:19:17'),
(46, 26, NULL, NULL, NULL, 31, NULL, 851.00, NULL, 0, 'initial', NULL, '2025-05-30 23:45:45', '2025-05-30 23:45:45'),
(47, 27, NULL, NULL, NULL, 31, NULL, 320.00, NULL, 0, 'initial', NULL, '2025-05-30 23:48:01', '2025-05-30 23:48:01'),
(48, 28, NULL, NULL, NULL, 31, NULL, 1005.00, NULL, 0, 'initial', NULL, '2025-05-31 12:01:49', '2025-05-31 12:01:49'),
(49, 29, NULL, NULL, NULL, 31, NULL, 810.00, NULL, 0, 'initial', NULL, '2025-05-31 12:03:17', '2025-05-31 12:03:17'),
(50, 30, NULL, NULL, NULL, 31, NULL, 639.00, NULL, 0, 'initial', NULL, '2025-06-02 14:53:55', '2025-06-02 14:53:55'),
(51, 31, NULL, NULL, NULL, 31, NULL, 280.00, NULL, 0, 'initial', NULL, '2025-06-02 15:19:27', '2025-06-02 15:19:27'),
(52, 32, NULL, NULL, NULL, 31, NULL, 1109.00, NULL, 0, 'initial', NULL, '2025-06-02 15:23:44', '2025-06-02 15:23:44'),
(53, 33, NULL, NULL, NULL, 31, NULL, 280.00, NULL, 0, 'initial', NULL, '2025-06-02 18:41:11', '2025-06-02 18:41:11'),
(54, 34, NULL, NULL, NULL, 31, NULL, 42.00, NULL, 0, 'initial', NULL, '2025-06-02 18:43:38', '2025-06-02 18:43:38'),
(55, 35, NULL, NULL, NULL, 31, NULL, 135.00, NULL, 0, 'initial', NULL, '2025-06-02 18:44:28', '2025-06-02 18:44:28'),
(56, 36, NULL, NULL, NULL, 37, NULL, 360.00, NULL, 0, 'initial', NULL, '2025-06-02 18:46:08', '2025-06-02 18:46:08'),
(57, 37, NULL, NULL, NULL, 37, NULL, 34.00, NULL, 0, 'initial', NULL, '2025-06-02 18:50:57', '2025-06-02 18:50:57'),
(58, 38, NULL, NULL, NULL, 37, NULL, 811.00, NULL, 0, 'initial', NULL, '2025-06-02 19:21:49', '2025-06-02 19:21:49'),
(59, 39, NULL, NULL, NULL, 31, NULL, 110.00, NULL, 0, 'initial', NULL, '2025-06-02 19:26:18', '2025-06-02 19:26:18'),
(60, 40, NULL, NULL, NULL, 31, NULL, 488.00, NULL, 0, 'initial', NULL, '2025-06-03 16:21:43', '2025-06-03 16:21:43'),
(61, 41, NULL, NULL, NULL, 31, NULL, 592.00, NULL, 0, 'initial', NULL, '2025-06-07 15:51:19', '2025-06-07 15:51:19'),
(62, 42, NULL, NULL, NULL, 31, NULL, 42.00, NULL, 0, 'initial', NULL, '2025-06-07 15:54:53', '2025-06-07 15:54:53'),
(63, 43, NULL, NULL, NULL, 31, NULL, 120.00, NULL, 0, 'initial', NULL, '2025-06-08 15:21:10', '2025-06-08 15:21:10'),
(64, 44, NULL, NULL, NULL, 31, NULL, 140.00, NULL, 0, 'initial', NULL, '2025-06-09 12:17:44', '2025-06-09 12:17:44'),
(65, 45, NULL, NULL, NULL, 31, NULL, 120.00, NULL, 0, 'initial', NULL, '2025-06-09 12:18:18', '2025-06-09 12:18:18'),
(66, 46, NULL, NULL, NULL, 31, NULL, 23.00, NULL, 0, 'initial', NULL, '2025-06-09 12:18:38', '2025-06-09 12:18:38'),
(67, 47, NULL, NULL, NULL, 29, NULL, 43491.13, NULL, 0, 'initial', NULL, '2025-06-10 08:23:15', '2025-06-10 08:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `expires_at`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 28, 'auth_token', '63ae9dd7a59cde3aed2e2e43a6bf816d71a67df9c71efc2a8745cfbb8f9ac0ca', '[\"*\"]', NULL, NULL, '2025-05-20 07:35:41', '2025-05-20 07:35:41'),
(2, 'App\\Models\\User', 28, 'auth_token', '2faa03d8207138003526e436c4879c3b4fecc20e913ae7995118fe23e8efabdd', '[\"*\"]', NULL, '2025-05-20 07:38:49', '2025-05-20 07:37:03', '2025-05-20 07:38:49'),
(3, 'App\\Models\\User', 28, 'auth_token', '20ddd23e1352b52a68271251cc3d876c22e97e9b2e96aee67dbe506c8ea3b5cb', '[\"*\"]', NULL, NULL, '2025-05-21 00:19:16', '2025-05-21 00:19:16'),
(7, 'App\\Models\\User', 28, 'auth_token', 'd1f0ee9b0ef689830b943fa6120fd31031c60cd9f81bb00414bf288b44a379ce', '[\"*\"]', NULL, '2025-05-22 03:09:18', '2025-05-21 05:51:27', '2025-05-22 03:09:18'),
(8, 'App\\Models\\User', 28, 'auth_token', '6e645cc7021744226f2d2c0a80b3f2eae8d8c2b8c5ca6a4fe17afedc6c232749', '[\"*\"]', NULL, '2025-05-22 09:37:22', '2025-05-22 09:36:28', '2025-05-22 09:37:22'),
(11, 'App\\Models\\User', 30, 'auth_token', '13af640e677f1a313734831af589a9be5223e7d24a5b3c94a7579a45c0b51a5c', '[\"*\"]', NULL, '2025-05-22 17:16:48', '2025-05-22 09:54:33', '2025-05-22 17:16:48'),
(12, 'App\\Models\\User', 31, 'auth_token', '860fee11249a01521d8e5880280cc265d7b7fe0d6a01251e34012ffa830bdf99', '[\"*\"]', NULL, '2025-05-23 21:19:04', '2025-05-22 14:40:39', '2025-05-23 21:19:04'),
(13, 'App\\Models\\User', 31, 'auth_token', '8403ae1f5a465baa987a0b204321c5420d98107330b3e8a6a7caf4165c1dfe1e', '[\"*\"]', NULL, '2025-06-02 14:29:48', '2025-05-22 20:04:06', '2025-06-02 14:29:48'),
(15, 'App\\Models\\User', 29, 'auth_token', '18fdd4a05b81f25fa11877a26ba11bf5aa67509a7ea2f526ab5da83c81fafe49', '[\"*\"]', NULL, '2025-05-24 14:07:05', '2025-05-24 08:42:39', '2025-05-24 14:07:05'),
(16, 'App\\Models\\User', 31, 'auth_token', '121d77f7732f43fc4afbe10ab78a479725451ae85842d271336d8785f7df5669', '[\"*\"]', NULL, '2025-05-24 14:08:35', '2025-05-24 13:55:53', '2025-05-24 14:08:35'),
(17, 'App\\Models\\User', 30, 'auth_token', '9174bc2570caaab64ec9000629eae4e401a07cbb1e4538809866ac9c449f1c63', '[\"*\"]', NULL, '2025-05-25 06:30:50', '2025-05-25 06:22:24', '2025-05-25 06:30:50'),
(18, 'App\\Models\\User', 30, 'auth_token', 'e9003e050f3340a076eb532030d3ab28b6b56a958a500e8515e7a19c06d0f765', '[\"*\"]', NULL, '2025-05-25 07:00:00', '2025-05-25 06:51:53', '2025-05-25 07:00:00'),
(19, 'App\\Models\\User', 30, 'auth_token', '96391a8a74102945f2c46716e917efc1e6dc4e4821824533fbffb5cff0763947', '[\"*\"]', NULL, '2025-05-25 07:02:33', '2025-05-25 07:02:02', '2025-05-25 07:02:33'),
(20, 'App\\Models\\User', 30, 'auth_token', 'cc13d79d0bbbbe7e4c45b2e9126eb81a5bf9a1e550444b0d6a494effacac7962', '[\"*\"]', NULL, '2025-05-25 07:29:57', '2025-05-25 07:11:57', '2025-05-25 07:29:57'),
(23, 'App\\Models\\User', 32, 'auth_token', 'b0a5d0a9dae49a08f6bb0685cbe556f067671b7fda3381c33c1db119800a7c20', '[\"*\"]', NULL, '2025-05-25 07:39:10', '2025-05-25 07:37:57', '2025-05-25 07:39:10'),
(24, 'App\\Models\\User', 32, 'auth_token', '77e2f533f70bb04a42460acfc4606c0f7cee6d35f731860cd8071b75f2c1c181', '[\"*\"]', NULL, '2025-05-25 07:54:33', '2025-05-25 07:53:12', '2025-05-25 07:54:33'),
(26, 'App\\Models\\User', 31, 'auth_token', '5292334bb5f356ca10fa514ff108e5c575b44b04389b52826202c660f49c8f39', '[\"*\"]', NULL, '2025-05-25 14:05:48', '2025-05-25 13:58:41', '2025-05-25 14:05:48'),
(27, 'App\\Models\\User', 31, 'auth_token', '13b541fe52d6d6292c8ed208ec2889718c0d6aba249e984add56ea3df1b8cd60', '[\"*\"]', NULL, '2025-05-25 14:06:56', '2025-05-25 14:06:43', '2025-05-25 14:06:56'),
(28, 'App\\Models\\User', 31, 'auth_token', '10368282b57d908b20a4a3079ed4e220224bcd0417afdafc24d2e3a67ac99fe7', '[\"*\"]', NULL, '2025-05-25 15:04:46', '2025-05-25 14:07:58', '2025-05-25 15:04:46'),
(29, 'App\\Models\\User', 29, 'auth_token', 'b8898834e39f54fa2f485681bd598ff12a75126fb1a227c2608811daf284fcc5', '[\"*\"]', NULL, '2025-05-25 14:32:29', '2025-05-25 14:31:04', '2025-05-25 14:32:29'),
(31, 'App\\Models\\User', 29, 'auth_token', '5b3423374867258a39a4d90ccb05ff4008e5493af9dcd9b8857690f1cb01a6b1', '[\"*\"]', NULL, '2025-05-25 15:18:58', '2025-05-25 14:46:50', '2025-05-25 15:18:58'),
(32, 'App\\Models\\User', 31, 'auth_token', '0bc872fe98d4985c976b9e882bc3844d1d4801770b9eb7a04d190905a5fd30a2', '[\"*\"]', NULL, '2025-05-25 15:10:59', '2025-05-25 15:06:11', '2025-05-25 15:10:59'),
(36, 'App\\Models\\User', 29, 'auth_token', '649fe24dce313fe967ada201a26060a509d1ae267c3bd27edcb4ff0c7e359741', '[\"*\"]', NULL, NULL, '2025-05-26 04:35:28', '2025-05-26 04:35:28'),
(41, 'App\\Models\\User', 33, 'auth_token', '52705ad8095e69cdf866b96f6dc93c63115e629d7ed3164752dc96daef186098', '[\"*\"]', NULL, '2025-05-26 04:53:04', '2025-05-26 04:52:49', '2025-05-26 04:53:04'),
(42, 'App\\Models\\User', 34, 'auth_token', 'd5555fc475478fbc84e3092b371bb6d467bd92df0b3b6f2585fedc1d6bd72553', '[\"*\"]', NULL, '2025-05-26 04:56:21', '2025-05-26 04:55:56', '2025-05-26 04:56:21'),
(43, 'App\\Models\\User', 35, 'auth_token', 'fb2170e09559613b77102358197bf2b93ef75b63632e297ee7a73eedc8994e1e', '[\"*\"]', NULL, '2025-05-26 04:58:06', '2025-05-26 04:57:48', '2025-05-26 04:58:06'),
(47, 'App\\Models\\User', 36, 'auth_token', '62d8082af7585144b05bec3d321f03f82a839d5b8a0e0435310b753bde41848f', '[\"*\"]', NULL, '2025-05-26 05:21:36', '2025-05-26 05:21:35', '2025-05-26 05:21:36'),
(48, 'App\\Models\\User', 37, 'auth_token', '9adc837fb8ec54e385525b5d7f7789f8edf4d384b0a9e4aa988b28c4a0950a43', '[\"*\"]', NULL, '2025-05-27 19:21:40', '2025-05-26 05:39:36', '2025-05-27 19:21:40'),
(49, 'App\\Models\\User', 31, 'auth_token', '117b066f9dfb6e02e38d86df4119baf04902629805f380058fc27491cfccab97', '[\"*\"]', NULL, '2025-05-28 16:40:21', '2025-05-26 05:39:48', '2025-05-28 16:40:21'),
(50, 'App\\Models\\User', 31, 'auth_token', 'b55ac535676fab6a37ea3b3eca7cb947f2136d515efabdbaf0cc456d7f055983', '[\"*\"]', NULL, '2025-05-28 17:09:44', '2025-05-28 16:41:38', '2025-05-28 17:09:44'),
(51, 'App\\Models\\User', 31, 'auth_token', '27da04f1dfb865a3429c8cd794f62760f3a2ce3f9aff3a90b098611a76af4cd5', '[\"*\"]', NULL, '2025-05-29 11:16:13', '2025-05-28 17:14:22', '2025-05-29 11:16:13'),
(52, 'App\\Models\\User', 29, 'auth_token', 'cc34f26f7c2fbab40d97aa26c0be1e03d53b6294447d227936e5431de996a0f9', '[\"*\"]', NULL, '2025-06-10 08:29:12', '2025-05-29 03:32:55', '2025-06-10 08:29:12'),
(53, 'App\\Models\\User', 29, 'auth_token', '1586a4655f6098a35b5ecd1fc8f333a278afd6ff62f264a0d5d610285dfaab3f', '[\"*\"]', NULL, '2025-05-29 04:58:58', '2025-05-29 04:52:15', '2025-05-29 04:58:58'),
(54, 'App\\Models\\User', 29, 'auth_token', 'c0fce24ee5f3e9c42ddb7e6a04f317f19320b4ecff09393e62af5f4503550907', '[\"*\"]', NULL, '2025-06-08 12:35:48', '2025-05-29 05:07:12', '2025-06-08 12:35:48'),
(55, 'App\\Models\\User', 31, 'auth_token', '539d832637aa85868c603d88ae8fa83258ab0466f0fd7b8833c5dea96da8a80b', '[\"*\"]', NULL, '2025-06-04 14:04:28', '2025-05-29 11:17:17', '2025-06-04 14:04:28'),
(56, 'App\\Models\\User', 31, 'auth_token', 'f460026c6fb59dc45a8b89c0d28d7c085095e4985c3d90df4385cb050f3d15f4', '[\"*\"]', NULL, '2025-06-09 12:18:41', '2025-06-02 14:32:49', '2025-06-09 12:18:41'),
(57, 'App\\Models\\User', 37, 'auth_token', 'fc97a17e067927a4550fdc89b2905223198f682c98c5ba006c49b04f92aa3e4f', '[\"*\"]', NULL, '2025-06-02 19:25:27', '2025-06-02 18:44:58', '2025-06-02 19:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `plan_purchases`
--

CREATE TABLE `plan_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `funding_plan_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `gateway` varchar(255) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `gateway_order_id` varchar(255) DEFAULT NULL,
  `gateway_payment_id` varchar(255) DEFAULT NULL,
  `gateway_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gateway_response`)),
  `gateway_signature` text DEFAULT NULL,
  `payment_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`payment_response`)),
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `mt4_login` varchar(255) DEFAULT NULL,
  `mt4_password` varchar(255) DEFAULT NULL,
  `mt4_server` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_purchases`
--

INSERT INTO `plan_purchases` (`id`, `user_id`, `funding_plan_id`, `amount`, `gateway`, `transaction_id`, `gateway_order_id`, `gateway_payment_id`, `gateway_response`, `gateway_signature`, `payment_response`, `status`, `notes`, `approved_by`, `approved_at`, `expires_at`, `mt4_login`, `mt4_password`, `mt4_server`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 55000.00, 'razorpay', 'TXN_XHYIP4KITJB6', 'order_dummy_1', 'pay_dummy_1', '\"{\\\"simulated\\\":true,\\\"message\\\":\\\"Test payment success\\\"}\"', NULL, NULL, 'approved', 'approvd got the money', 1, '2025-11-29 20:19:39', NULL, '8779831', 'xq3bl0OJjQ', 'YourBroker-Live', '2025-11-29 20:18:11', '2025-11-29 20:19:39'),
(2, 14, 1, 37000.00, 'razorpay', 'TXN_OEHA1WKMDEJO', 'order_dummy_2', 'pay_dummy_2', '\"{\\\"simulated\\\":true,\\\"message\\\":\\\"Test payment success\\\"}\"', NULL, NULL, 'approved', 'approve', 1, '2025-12-01 21:46:04', NULL, '8008201', 'FMO7YKz8Lo', 'YourBroker-Live', '2025-12-01 21:44:22', '2025-12-01 21:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_items`
--

CREATE TABLE `portfolio_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(191) NOT NULL,
  `project_link` varchar(191) DEFAULT NULL,
  `skills` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) NOT NULL,
  `commission_type` varchar(40) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `percent` decimal(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_settings`
--

CREATE TABLE `referral_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `referral_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `referral_bonus_amount` decimal(12,2) NOT NULL DEFAULT 10.00,
  `bonus_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `bonus_type` enum('fixed','percentage') NOT NULL DEFAULT 'fixed',
  `referral_percentage` decimal(5,2) NOT NULL DEFAULT 10.00,
  `minimum_deposit_for_bonus` int(11) NOT NULL DEFAULT 100,
  `bonus_expiry_days` int(11) NOT NULL DEFAULT 30,
  `max_referrals_per_user` int(11) NOT NULL DEFAULT 0,
  `terms_conditions` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referral_settings`
--

INSERT INTO `referral_settings` (`id`, `referral_enabled`, `referral_bonus_amount`, `bonus_currency`, `bonus_type`, `referral_percentage`, `minimum_deposit_for_bonus`, `bonus_expiry_days`, `max_referrals_per_user`, `terms_conditions`, `created_at`, `updated_at`) VALUES
(1, 1, 500.00, 'INR', 'fixed', 10.00, 1000, 30, 0, 'Get ₹500 bonus for every friend you refer who deposits minimum ₹1000. Bonus expires in 30 days. Only for Indian users.', '2025-11-30 22:15:06', '2025-11-30 22:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_key` varchar(255) NOT NULL,
  `option_value` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `option_key`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'F Standard', '2022-12-04 17:05:33', '2025-11-22 02:37:07'),
(2, 'app_email', 'admin@firestill.com', '2022-12-04 17:05:33', '2025-10-16 02:20:34'),
(3, 'app_contact_number', '+591 45626594', '2022-12-04 17:05:33', '2024-10-27 00:11:55'),
(4, 'app_location', 'India', '2022-12-04 17:05:33', '2025-11-22 02:37:07'),
(5, 'app_date_format', 'd F, Y', '2022-12-04 17:05:33', '2024-10-27 00:11:55'),
(6, 'app_timezone', 'Asia/Dhaka', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(7, 'allow_preloader', '0', '2022-12-04 17:05:33', '2025-12-01 00:13:36'),
(8, 'app_preloader', 'uploads/setting/1763799555-qMliPDLEOW.gif', '2022-12-04 17:05:33', '2025-11-22 02:49:15'),
(9, 'app_logo', 'uploads/setting/1764254703-2Z2ORxSc8o.png', '2022-12-04 17:05:33', '2025-11-27 09:15:03'),
(10, 'app_fav_icon', 'uploads/setting/1764254703-FXJye21SDH.png', '2022-12-04 17:05:33', '2025-11-27 09:15:03'),
(11, 'app_copyright', 'F Standard', '2022-12-04 17:05:33', '2025-11-22 02:37:07'),
(12, 'app_developed', 'AAsif', '2022-12-04 17:05:33', '2024-10-27 00:11:55'),
(13, 'og_title', 'LMSZAI - Learning Management System', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(14, 'og_description', 'Learning Management System', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(15, 'zoom_status', '1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(16, 'bbb_status', '1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(17, 'jitsi_status', '1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(18, 'jitsi_server_base_url', 'https://meet.jit.si/', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(19, 'registration_email_verification', '0', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(20, 'footer_quote', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(21, 'paystack_currency', 'AFA', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(22, 'paystack_conversion_rate', '1', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(23, 'paystack_status', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(24, 'PAYSTACK_PUBLIC_KEY', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(25, 'PAYSTACK_SECRET_KEY', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(26, 'paypal_currency', 'AFA', '2022-12-04 17:05:33', '2024-10-27 01:16:43'),
(27, 'paypal_conversion_rate', '15', '2022-12-04 17:05:33', '2024-10-27 01:16:43'),
(28, 'paypal_status', '1', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(29, 'PAYPAL_MODE', 'sandbox', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(30, 'PAYPAL_CLIENT_ID', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(31, 'PAYPAL_SECRET', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(32, 'stripe_currency', 'AFA', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(33, 'stripe_conversion_rate', '1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(34, 'stripe_status', '1', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(35, 'STRIPE_MODE', 'sandbox', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(36, 'STRIPE_SECRET_KEY', '', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(37, 'STRIPE_PUBLIC_KEY', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(38, 'razorpay_currency', 'AFA', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(39, 'razorpay_conversion_rate', '1', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(40, 'razorpay_status', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(41, 'RAZORPAY_KEY', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(42, 'RAZORPAY_SECRET', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(43, 'mollie_currency', 'AFA', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(44, 'mollie_conversion_rate', '1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(45, 'mollie_status', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(46, 'MOLLIE_KEY', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(47, 'im_currency', 'AFA', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(48, 'im_conversion_rate', '1', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(49, 'im_status', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(50, 'IM_API_KEY', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(51, 'IM_AUTH_TOKEN', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(52, 'IM_URL', 'https://test.instamojo.com/api/1.1/payment-requests/', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(53, 'sslcommerz_currency', 'AFA', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(54, 'sslcommerz_conversion_rate', '1', '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(55, 'sslcommerz_status', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(56, 'sslcommerz_mode', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(57, 'SSLCZ_STORE_ID', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(58, 'SSLCZ_STORE_PASSWD', NULL, '2022-12-04 17:05:33', '2024-06-07 06:34:59'),
(59, 'MAIL_DRIVER', 'smtp', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(60, 'MAIL_HOST', 'smtp.hostinger.com', '2022-12-04 17:05:33', '2025-01-14 01:39:52'),
(61, 'MAIL_PORT', '465', '2022-12-04 17:05:33', '2025-01-14 01:39:52'),
(62, 'MAIL_USERNAME', 'gen@negociosgen.com', '2022-12-04 17:05:33', '2025-01-14 01:39:52'),
(63, 'MAIL_PASSWORD', 'zJ0O8[W5', '2022-12-04 17:05:33', '2025-01-14 01:39:52'),
(64, 'MAIL_ENCRYPTION', 'tls', '2022-12-04 17:05:33', '2024-06-07 06:29:46'),
(65, 'MAIL_FROM_ADDRESS', 'gen@negociosgen.com', '2022-12-04 17:05:33', '2025-01-14 01:39:52'),
(66, 'MAIL_FROM_NAME', 'Negociosgen', '2022-12-04 17:05:33', '2025-01-14 01:39:52'),
(67, 'MAIL_MAILER', 'smtp', '2022-12-04 17:05:33', '2024-10-27 00:59:40'),
(68, 'update', 'Update', '2022-12-04 17:05:33', '2024-03-07 06:41:34'),
(69, 'sign_up_left_text', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(70, 'sign_up_left_image', 'uploads_demo/home/hero-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(71, 'forgot_title', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(72, 'forgot_subtitle', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(73, 'forgot_btn_name', 'Reset', '2022-12-04 17:05:33', '2025-01-13 01:02:41'),
(74, 'facebook_url', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(75, 'twitter_url', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(76, 'linkedin_url', NULL, '2022-12-04 17:05:33', '2024-06-07 01:01:03'),
(77, 'youtube_url', 'https://www.youtube.com/', '2022-12-04 17:05:33', '2025-01-13 01:02:06'),
(78, 'app_instructor_footer_title', 'Join One Of The World’s Largest Learning Marketplaces.', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(79, 'app_instructor_footer_subtitle', 'Donald valley teems with vapour around me, and the meridian sun strikes the upper surface of the impenetrable foliage of my tree', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(80, 'get_in_touch_title', 'get', '2022-12-04 17:05:33', '2025-01-13 05:31:45'),
(81, 'send_us_msg_title', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(82, 'contact_us_location', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(83, 'contact_us_email_one', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(84, 'contact_us_email_two', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(85, 'contact_us_phone_one', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(86, 'contact_us_phone_two', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(87, 'contact_us_map_link', NULL, '2022-12-04 17:05:33', '2024-06-07 08:01:53'),
(88, 'contact_us_description', 'desc', '2022-12-04 17:05:33', '2025-01-13 05:41:10'),
(89, 'faq_title', 'Frequently Ask Questions.', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(90, 'faq_subtitle', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(91, 'faq_image_title', 'Still no luck?', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(92, 'faq_image', 'uploads_demo/setting\\faq-img.jpg', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(93, 'faq_tab_first_title', 'Item Support', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(94, 'faq_tab_first_subtitle', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a greater artist than now. When, while the lovely valley with vapour around me, and the meridian', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(95, 'faq_tab_sec_title', 'Licensing', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(96, 'faq_tab_sec_subtitle', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a greater artist than now. When, while the lovely valley with vapour around me, and the meridian', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(97, 'faq_tab_third_title', 'Your Account', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(98, 'faq_tab_third_subtitle', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a greater artist than now. When, while the lovely valley with vapour around me, and the meridian', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(99, 'faq_tab_four_title', 'Tax & Complications', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(100, 'faq_tab_four_subtitle', 'Ranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet I feel that was a greater artist than now. When, while the lovely valley with vapour around me, and the meridian', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(101, 'home_special_feature_first_logo', 'uploads_demo/setting\\feature-icon1.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(102, 'home_special_feature_first_title', 'Learn From Experts', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(103, 'home_special_feature_first_subtitle', 'Mornings of spring which I enjoy with my whole heart about the gen', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(104, 'home_special_feature_second_logo', 'uploads_demo/setting/feature-icon2.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(105, 'home_special_feature_second_title', 'Earn a Certificate', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(106, 'home_special_feature_second_subtitle', 'Mornings of spring which I enjoy with my whole heart about the gen', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(107, 'home_special_feature_third_logo', 'uploads_demo/setting\\feature-icon3.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(108, 'home_special_feature_third_title', '5000+ Courses', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(109, 'home_special_feature_third_subtitle', 'Serenity has taken possession of my entire soul, like these sweet spring', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(110, 'course_logo', 'uploads_demo/setting/courses-heading-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(111, 'course_title', 'A Broad Selection Of Courses', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(112, 'course_subtitle', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(113, 'bundle_course_logo', 'uploads_demo/setting/bundle-courses-heading-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(114, 'bundle_course_title', 'Latest Bundle Courses', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(115, 'bundle_course_subtitle', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(116, 'top_category_logo', 'uploads_demo/setting/categories-heading-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(117, 'top_category_title', 'Our Top Categories', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(118, 'top_category_subtitle', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(119, 'top_instructor_logo', 'uploads_demo/setting\\top-instructor-heading-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(120, 'top_instructor_title', 'Top Rated Courses From Our Top Instructor.', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(121, 'top_instructor_subtitle', 'CHOOSE FROM 5,000 ONLINE VIDEO COURSES WITH NEW ADDITIONS', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(122, 'become_instructor_video', 'uploads_demo/setting/test.mp4', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(123, 'become_instructor_video_preview_image', 'uploads_demo/setting/video-poster.jpg', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(124, 'become_instructor_video_logo', 'uploads_demo/setting/top-instructor-heading-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(125, 'become_instructor_video_title', 'We Only Accept Professional Courses Form Professional Instructors', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(126, 'become_instructor_video_subtitle', 'Noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(127, 'customer_say_logo', 'uploads_demo/setting/customers-say-heading-img.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(128, 'customer_say_title', 'What Our Valuable Customers Say.', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(129, 'customer_say_first_name', 'DANIEL JHON', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(130, 'customer_say_first_position', 'UI/UX DESIGNER', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(131, 'customer_say_first_comment_title', 'Great instructor, great course', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(132, 'customer_say_first_comment_description', 'Wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence in this spot', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(133, 'customer_say_first_comment_rating_star', '5', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(134, 'customer_say_second_name', 'NORTH', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(135, 'customer_say_second_position', 'DEVELOPER', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(136, 'customer_say_second_comment_title', 'Awesome course & good response', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(137, 'customer_say_second_comment_description', 'Noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(138, 'customer_say_second_comment_rating_star', '4.5', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(139, 'customer_say_third_name', 'HIBRUPATH', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(140, 'customer_say_third_position', 'MARKETER', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(141, 'customer_say_third_comment_title', 'Fantastic course', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(142, 'customer_say_third_comment_description', 'Noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects and flies, then I feel the presence', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(143, 'customer_say_third_comment_rating_star', '5', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(144, 'achievement_first_logo', 'uploads_demo/setting\\1.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(145, 'achievement_first_title', 'Successfully trained', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(146, 'achievement_first_subtitle', '2000+ students', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(147, 'achievement_second_logo', 'uploads_demo/setting\\2.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(148, 'achievement_second_title', 'Video courses', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(149, 'achievement_second_subtitle', '2000+ students', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(150, 'achievement_third_logo', 'uploads_demo/setting\\3.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(151, 'achievement_third_title', 'Expert instructor', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(152, 'achievement_third_subtitle', '2000+ students', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(153, 'achievement_four_logo', 'uploads_demo/setting\\4.png', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(154, 'achievement_four_title', 'Proudly Received', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(155, 'achievement_four_title', 'Proudly Received', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(156, 'achievement_four_subtitle', '2000+ students', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(157, 'support_faq_title', 's', '2022-12-04 17:05:33', '2025-01-13 01:31:35'),
(158, 'support_faq_subtitle', 'g', '2022-12-04 17:05:33', '2025-01-13 01:31:35'),
(159, 'ticket_title', 'dfgg', '2022-12-04 17:05:33', '2025-01-13 01:31:35'),
(160, 'ticket_subtitle', 'd', '2022-12-04 17:05:33', '2025-01-13 01:31:35'),
(161, 'cookie_button_name', 'Allow cookies', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(162, 'cookie_msg', 'Your experience on this site will be improved by allowing cookies', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(163, 'COOKIE_CONSENT_STATUS', '1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(164, 'platform_charge', '3', '2022-12-04 17:05:33', '2024-10-27 00:11:55'),
(165, 'sell_commission', '10', '2022-12-04 17:05:33', '2024-10-27 00:11:55'),
(166, 'app_version', '21', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(167, 'current_version', '6.1', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(262, 'currency_id', '3', '2024-03-07 01:46:36', '2025-12-01 00:13:36'),
(263, 'FORCE_HTTPS', 'false', '2024-03-07 01:46:36', '2024-03-07 01:46:36'),
(264, 'language_id', '4', '2024-03-07 01:46:36', '2025-01-27 00:14:39'),
(265, 'TIMEZONE', 'UTC', '2024-03-07 01:46:36', '2025-01-13 01:02:06'),
(266, 'pwa_enable', '0', '2024-03-07 01:46:36', '2024-03-07 01:46:36'),
(267, 'instagram_url', NULL, '2024-03-07 01:46:36', '2024-06-07 01:01:03'),
(268, 'tiktok_url', NULL, '2024-03-07 01:46:36', '2024-06-07 01:01:03'),
(269, 'app_black_logo', 'uploads/setting/1763798827-xCCVKTz9TC.gif', '2024-03-07 01:46:37', '2025-11-22 02:37:07'),
(270, 'app_pwa_icon', NULL, '2024-03-07 01:46:37', '2024-03-07 01:46:37'),
(271, 'theme', '1', '2024-03-07 06:41:34', '2024-03-07 06:43:45'),
(272, 'mercado_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(273, 'mercado_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(274, 'mercado_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(275, 'MERCADO_PAGO_CLIENT_ID', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(276, 'MERCADO_PAGO_CLIENT_SECRET', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(277, 'flutterwave_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(278, 'flutterwave_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(279, 'flutterwave_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(280, 'FLW_PUBLIC_KEY', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(281, 'FLW_SECRET_KEY', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(282, 'FLW_SECRET_HASH', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(283, 'coinbase_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(284, 'coinbase_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(285, 'coinbase_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(286, 'coinbase_mode', 'sandbox', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(287, 'coinbase_key', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(288, 'zitopay_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(289, 'zitopay_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(290, 'zitopay_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(291, 'zitopay_username', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(292, 'iyzipay_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(293, 'iyzipay_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(294, 'iyzipay_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(295, 'iyzipay_mode', 'sandbox', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(296, 'iyzipay_key', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(297, 'iyzipay_secret', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(298, 'bitpay_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(299, 'bitpay_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(300, 'bitpay_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(301, 'bitpay_mode', 'testnet', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(302, 'bitpay_key', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(303, 'braintree_currency', 'AFA', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(304, 'braintree_conversion_rate', '1', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(305, 'braintree_status', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(306, 'braintree_test_mode', '0', '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(307, 'braintree_merchant_id', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(308, 'braintree_public_key', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(309, 'braintree_private_key', NULL, '2024-06-07 06:34:59', '2024-06-07 06:34:59'),
(310, 'app_footer_payment_image', 'uploads/setting/1763799582-EwtlgQ8KFT.gif', '2024-10-27 00:11:55', '2025-11-22 02:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deactivated',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `image`, `name`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Management', 'Management', 1, '2025-01-13 07:19:36', NULL, '2025-01-13 07:19:36'),
(2, NULL, 'Web Development', 'Web Development', 1, NULL, NULL, '2025-01-13 07:10:02'),
(3, NULL, 'Mobile Development', 'Mobile Development', 1, NULL, NULL, '2025-01-13 07:10:02'),
(4, 'uploads/upgrade_skill/1736772002mqiQKWodZL.jpg', 'Mobile App', 'App', 1, NULL, '2025-01-13 07:10:02', '2025-01-13 07:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `slippage_profiles`
--

CREATE TABLE `slippage_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `min_slippage` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `max_slippage` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `symbol_overrides` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`symbol_overrides`)),
  `time_overrides` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`time_overrides`)),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dhaka', NULL, NULL),
(2, 1, 'Khulna', NULL, NULL),
(3, 1, 'Comilla', NULL, NULL),
(4, 2, 'California', NULL, NULL),
(5, 2, 'Texas', NULL, NULL),
(6, 2, 'Florida', NULL, NULL),
(7, 3, 'Argyll', NULL, NULL),
(8, 3, 'Belfast', NULL, NULL),
(9, 3, 'Cambridge', NULL, NULL),
(11, 1, 'Khulna', '2024-06-07 05:59:39', '2024-06-07 06:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `meta_title` varchar(191) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `og_image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `uuid`, `parent_category_id`, `category_id`, `name`, `slug`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `created_at`, `updated_at`) VALUES
(13, 'b17f503c-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Albañil', 'albanil', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(14, 'b17f5053-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Plomero', 'plomero', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(15, 'b17f506a-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Pintor', 'pintor', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(16, 'b17f5081-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Electricista', 'electricista', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(17, 'b17f5098-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Carpintero', 'carpintero', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(18, 'b17f50af-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Cerrajero', 'cerrajero', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(19, 'b17f50c6-5be6-11f0-8620-9a4383c8618e', 1, NULL, 'Vidriero', 'vidriero', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(20, 'b17f50dd-5be6-11f0-8620-9a4383c8618e', 4, NULL, 'Personal de Limpieza', 'personal-de-limpieza', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(21, 'b17f50f4-5be6-11f0-8620-9a4383c8618e', 4, NULL, 'Lavandería', 'lavanderia', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(22, 'b17f510b-5be6-11f0-8620-9a4383c8618e', 4, NULL, 'Jardinería', 'jardineria', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(23, 'b17f5122-5be6-11f0-8620-9a4383c8618e', 4, NULL, 'Fumigación', 'fumigacion', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(24, 'b17f5139-5be6-11f0-8620-9a4383c8618e', 5, NULL, 'Churrasquero', 'churrasquero', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(25, 'b17f5150-5be6-11f0-8620-9a4383c8618e', 5, NULL, 'Chef', 'chef', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(26, 'b17f5167-5be6-11f0-8620-9a4383c8618e', 5, NULL, 'Cocinero/a', 'cocinero-a', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(27, 'b17f517e-5be6-11f0-8620-9a4383c8618e', 5, NULL, 'Ayudante de Cocina', 'ayudante-de-cocina', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(28, 'b17f5195-5be6-11f0-8620-9a4383c8618e', 5, NULL, 'Repostera/o', 'repostera-o', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(29, 'b17f51ac-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Niñera', 'ninera', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(30, 'b17f51c3-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Enfermería', 'enfermeria', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(31, 'b17f51da-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Fisioterapia', 'fisioterapia', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(32, 'b17f51f1-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Psicólogo', 'psicologo', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(33, 'b17f5208-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Personal Trainer', 'personal-trainer', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(34, 'b17f521f-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Nutricionista', 'nutricionista', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(35, 'b17f5236-5be6-11f0-8620-9a4383c8618e', 6, NULL, 'Cuidado de Adulto mayor', 'cuidado-de-adulto-mayor', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(36, 'b17f524d-5be6-11f0-8620-9a4383c8618e', 7, NULL, 'Sereno', 'sereno', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(37, 'b17f5264-5be6-11f0-8620-9a4383c8618e', 7, NULL, 'Guardaespaldas', 'guardaespaldas', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(38, 'b17f527b-5be6-11f0-8620-9a4383c8618e', 7, NULL, 'Detective Privado', 'detective-privado', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(39, 'b17f5292-5be6-11f0-8620-9a4383c8618e', 7, NULL, 'Personal de seguridad', 'personal-de-seguridad', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(40, 'b17f52a9-5be6-11f0-8620-9a4383c8618e', 8, NULL, 'Nivelación Escolar', 'nivelacion-escolar', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(41, 'b17f52c0-5be6-11f0-8620-9a4383c8618e', 8, NULL, 'Trabajos Escolares', 'trabajos-escolares', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(42, 'b17f52d7-5be6-11f0-8620-9a4383c8618e', 8, NULL, 'Profesor de idiomas', 'profesor-de-idiomas', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(43, 'b17f52ee-5be6-11f0-8620-9a4383c8618e', 8, NULL, 'Psicopedagogos', 'psicopedagogos', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(44, 'b17f5305-5be6-11f0-8620-9a4383c8618e', 8, NULL, 'Ayudantías Universitarias', 'ayudantias-universitarias', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(45, 'b17f531c-5be6-11f0-8620-9a4383c8618e', 8, NULL, 'Tutor de Tesis', 'tutor-de-tesis', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(46, 'b17f5333-5be6-11f0-8620-9a4383c8618e', 9, NULL, 'Veterinario', 'veterinario', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(47, 'b17f534a-5be6-11f0-8620-9a4383c8618e', 9, NULL, 'Cuidado de mascotas', 'cuidado-de-mascotas', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(48, 'b17f5361-5be6-11f0-8620-9a4383c8618e', 9, NULL, 'Paseo de Mascotas', 'paseo-de-mascotas', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(49, 'b17f5378-5be6-11f0-8620-9a4383c8618e', 9, NULL, 'Peluquería/spa', 'peluqueria-spa', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(50, 'b17f538f-5be6-11f0-8620-9a4383c8618e', 10, NULL, 'Barberia/corte', 'barberia-corte', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(51, 'b17f53a6-5be6-11f0-8620-9a4383c8618e', 10, NULL, 'Manicura/pedicura', 'manicura-pedicura', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(52, 'b17f53bd-5be6-11f0-8620-9a4383c8618e', 10, NULL, 'Maquillaje facial', 'maquillaje-facial', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(53, 'b17f53d4-5be6-11f0-8620-9a4383c8618e', 10, NULL, 'Depilación', 'depilacion', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(54, 'b17f53eb-5be6-11f0-8620-9a4383c8618e', 10, NULL, 'Peinados', 'peinados', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(55, 'b17f5402-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Meseros', 'meseros', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(56, 'b17f5419-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Barman', 'barman', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(57, 'b17f5430-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Filmación', 'filmacion', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(58, 'b17f5447-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Fotógrafo', 'fotografo', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(59, 'b17f545e-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Animación/Entretenimiento', 'animacion-entretenimiento', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(60, 'b17f5475-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Payasos', 'payasos', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(61, 'b17f548c-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Amplificación y Sonido', 'amplificacion-y-sonido', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(62, 'b17f54a3-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Decoración/escenario', 'decoracion-escenario', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(63, 'b17f54ba-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Servicio de DJ', 'servicio-de-dj', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(64, 'b17f54d1-5be6-11f0-8620-9a4383c8618e', 11, NULL, 'Grupo musical/solista', 'grupo-musical-solista', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(65, 'b17f54e8-5be6-11f0-8620-9a4383c8618e', 12, NULL, 'Influencer', 'influencer', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(66, 'b17f54ff-5be6-11f0-8620-9a4383c8618e', 12, NULL, 'Editor de Videos', 'editor-de-videos', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(67, 'b17f5516-5be6-11f0-8620-9a4383c8618e', 12, NULL, 'Editor de Imágenes', 'editor-de-imagenes', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(68, 'b17f552d-5be6-11f0-8620-9a4383c8618e', 12, NULL, 'Manejo de Redes Sociales', 'manejo-de-redes-sociales', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(69, 'b17f5544-5be6-11f0-8620-9a4383c8618e', 13, NULL, 'Mecánica General', 'mecanica-general', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(70, 'b17f555b-5be6-11f0-8620-9a4383c8618e', 13, NULL, 'Aires Acondicionados', 'aires-acondicionados', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(71, 'b17f5572-5be6-11f0-8620-9a4383c8618e', 13, NULL, 'Cámaras de Seguridad', 'camaras-de-seguridad', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(72, 'b17f5589-5be6-11f0-8620-9a4383c8618e', 13, NULL, 'Calefones', 'calefones', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00'),
(73, 'b17f55a0-5be6-11f0-8620-9a4383c8618e', 13, NULL, 'Sistemas Eléctricos', 'sistemas-electricos', NULL, NULL, NULL, NULL, '2025-07-15 12:00:00', '2025-07-15 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `support_ticket_questions`
--

CREATE TABLE `support_ticket_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_ticket_questions`
--

INSERT INTO `support_ticket_questions` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'What is the F Standard evaluation process?', 'The F Standard evaluation process consists of two phases. In Phase 1, you need to reach an 8% profit target without violating our trading rules. In Phase 2, you need to achieve a 5% profit target while continuing to adhere to our risk management rules. Once both phases are completed, you\'ll receive a funded account.', '2022-12-04 17:05:33', '2025-11-24 23:03:09'),
(2, 'How long does the payout process take?', 'We process payouts within 24 hours of request. In fact, our average payout time is just 5 hours. If we exceed 24 hours, you\'ll receive a $1,000 compensation as part of our guaranteed payout promise.', '2022-12-04 17:05:33', '2025-11-24 23:03:09'),
(3, 'Are there any time limits for completing the challenge?', 'No, there are no time limits for completing either phase of our evaluation process. You can take as long as you need to reach your profit targets, allowing you to trade at your own pace without pressure.', '2022-12-04 17:05:33', '2025-11-24 23:03:09'),
(17, 'tesst', 'dfsdfdsf', '2025-11-24 22:33:05', '2025-11-24 23:03:09'),
(18, 'dfdsfdsfdsf', 'dsfsfdsfdsffsdf', '2025-11-24 23:03:09', '2025-11-24 23:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `system_trade_configs`
--

CREATE TABLE `system_trade_configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `max_buy_order` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `min_decrease` decimal(5,2) NOT NULL DEFAULT 1.00,
  `max_decrease` decimal(5,2) NOT NULL DEFAULT 2.00,
  `buy_order_amount_range` decimal(5,2) NOT NULL DEFAULT 10.00,
  `buy_order_matching_chance` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `buy_order_matching_price_increase_up_to` decimal(5,2) NOT NULL DEFAULT 10.00,
  `max_sell_order` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `min_increase` decimal(5,2) NOT NULL DEFAULT 1.00,
  `max_increase` decimal(5,2) NOT NULL DEFAULT 2.00,
  `sell_order_amount_range` decimal(5,2) NOT NULL DEFAULT 10.00,
  `sell_order_matching_chance` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `sell_order_matching_price_decrease_up_to` decimal(5,2) NOT NULL DEFAULT 10.00,
  `buy_matching_with_system_trade` enum('yes','no') NOT NULL DEFAULT 'no',
  `sell_matching_with_system_trade` enum('yes','no') NOT NULL DEFAULT 'no',
  `buy_order_remains_minutes` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `sell_order_remains_minutes` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_trade_configs`
--

INSERT INTO `system_trade_configs` (`id`, `max_buy_order`, `min_decrease`, `max_decrease`, `buy_order_amount_range`, `buy_order_matching_chance`, `buy_order_matching_price_increase_up_to`, `max_sell_order`, `min_increase`, `max_increase`, `sell_order_amount_range`, `sell_order_matching_chance`, `sell_order_matching_price_decrease_up_to`, `buy_matching_with_system_trade`, `sell_matching_with_system_trade`, `buy_order_remains_minutes`, `sell_order_remains_minutes`, `created_at`, `updated_at`) VALUES
(1, 5, 1.00, 2.00, 10.00, 0, 10.00, 5, 1.00, 2.00, 10.00, 0, 10.00, 'no', 'no', 5, 5, '2025-12-01 02:57:57', '2025-12-01 21:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `uuid`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'd45fd1e7-a1e0-4d3f-954d-bd56dc95e48f', 'Design', 'design', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(2, '90bfec22-452f-42f4-b9aa-03c053aecc24', 'Development', 'development', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(3, 'b375ca10-66e9-43c1-8593-a6bdcc8ab3d9', 'IT', 'it', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(4, 'eecd9f5d-f023-4fe2-afcb-23b9ccc558b9', 'Programming', 'programming', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(5, '8f9fbd32-7878-443a-a531-faf1c4428b31', 'Travel', 'travel', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(6, '235b8c44-a340-4929-a48c-6238314d6af4', 'Music', 'music', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(7, '36ec1ef2-5bca-4d06-9446-a5d8ab6abdab', 'Digital marketing', 'digital-marketing', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(8, 'd8dc6caa-b578-49f6-aaca-e25783afe34b', 'Science', 'science', '2022-12-04 17:05:33', '2022-12-04 17:05:33'),
(9, '346c01be-ab53-406f-acc4-73c5fddc0b6f', 'Math', 'math', '2022-12-04 17:05:33', '2022-12-04 17:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `image`, `name`, `designation`, `created_at`, `updated_at`) VALUES
(1, 'uploads_demo/team_member/1.jpg', 'Arnold keens', 'CREATIVE DIRECTOR', '2022-12-04 17:05:33', '2025-01-13 06:32:57'),
(2, 'uploads_demo/team_member/2.jpg', 'James Bond', 'Designer', '2022-12-04 17:05:33', '2025-01-13 06:32:57'),
(3, 'uploads_demo/team_member/3.jpg', 'Ketty Perry', 'Customer Support', '2022-12-04 17:05:33', '2025-01-13 06:32:57'),
(4, 'uploads_demo/team_member/4.jpg', 'Scarlett Johansson', 'CREATIVE DIRECTOR', '2022-12-04 17:05:33', '2025-01-13 06:32:57'),
(5, NULL, 'arsh', 'Full', '2025-01-13 06:32:57', '2025-01-13 06:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_role` varchar(191) NOT NULL,
  `client_image_url` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `client_role`, `client_image_url`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Ivan Doe', 'CEO, Proshop', 'uploads/testimonials/1764044226-pk2e9qFBun.png', 'Working with Aasif has been exceptional. His expertise in Laravel development is commendable...', '2024-12-09 09:33:49', '2025-11-24 22:47:06'),
(2, 'Mohammed Alqatqat', 'Marketing Director, Sky Forecasting', 'uploads/testimonials/1764044236-LpakkhYTRt.png', 'Aasif showed exceptional proficiency and professionalism in our Laravel project. His outstanding communication ensured all deadlines were met...', '2024-12-09 09:34:25', '2025-11-24 22:47:16'),
(3, 'Nick Dinucci', 'CTO, Company C', 'uploads/testimonials/1764044246-spt9m8o0mJ.png', 'Working with Aasif on Upwork was a truly outstanding experience. Their professionalism, clear communication, and exceptional backend development skills were evident throughout the project...', '2024-12-09 09:35:05', '2025-11-24 22:47:26'),
(4, 'Barra Cuadrada de Aluminio', 'sdsad', 'uploads/testimonials/1764045280-NiMtY2qUkQ.png', 'sdffddasdsadsas', '2025-11-24 23:04:40', '2025-11-24 23:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `ticket_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1=Open, 2=Closed',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `related_service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `priority_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `uuid`, `ticket_number`, `name`, `email`, `subject`, `status`, `user_id`, `department_id`, `related_service_id`, `priority_id`, `created_at`, `updated_at`) VALUES
(12, '430f9845-4c6f-42c5-92cb-e4725b543f76', 'TCK-672F59AF68576', 'aasif', 'aasifdev5@gmail.com', 'i need to know abot gen', 1, 5, 2, 4, 1, '2024-11-09 07:16:39', '2024-11-09 07:16:39'),
(13, 'ed8262de-f76b-4ca9-b999-5f7327c23fad', 'TCK-672F5A7FB7BBA', 'aasif', 'aasifdev5@gmail.com', 'Welcome to Sky Forecasting', 1, 5, 2, 4, 1, '2024-11-09 07:20:07', '2024-11-09 07:20:07'),
(15, '0c6a2ba8-0c93-4374-8d4e-7000f964547a', 'TCK-692E59606D65B', 'tanzila', 'arstecht2a@gmail.com', 'how to purchase a plan', 1, 14, 2, 5, 1, '2025-12-01 21:43:36', '2025-12-01 21:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_departments`
--

CREATE TABLE `ticket_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_departments`
--

INSERT INTO `ticket_departments` (`id`, `uuid`, `name`, `created_at`, `updated_at`) VALUES
(2, '0697c6e0-dfca-45df-aead-3500fe1cbfe3', 'it', '2024-11-07 02:10:04', '2024-11-07 02:10:04'),
(3, '043ebb7e-6573-45f2-a55e-7f6d0e6a249b', 'Arsh', '2025-01-13 01:32:06', '2025-01-13 01:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_messages`
--

CREATE TABLE `ticket_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sender_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reply_admin_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `message` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_messages`
--

INSERT INTO `ticket_messages` (`id`, `ticket_id`, `sender_user_id`, `reply_admin_user_id`, `message`, `file`, `created_at`, `updated_at`) VALUES
(5, 6, NULL, 1, 'test', NULL, '2024-11-09 06:34:43', '2024-11-09 06:34:43'),
(6, 12, NULL, 1, 'gen is course lareaning platforma nd mlm', NULL, '2024-11-11 00:55:10', '2024-11-11 00:55:10'),
(7, 12, NULL, 5, 'how can i earn from it', NULL, '2024-11-11 00:56:38', '2024-11-11 00:56:38'),
(8, 12, NULL, 1, 'by refering course', NULL, '2024-11-11 01:27:40', '2024-11-11 01:27:40'),
(11, 12, NULL, 1, 'today', NULL, '2025-12-01 21:37:41', '2025-12-01 21:37:41'),
(12, 15, NULL, 14, 'please explain', NULL, '2025-12-01 21:44:03', '2025-12-01 21:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_priorities`
--

CREATE TABLE `ticket_priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_priorities`
--

INSERT INTO `ticket_priorities` (`id`, `uuid`, `name`, `created_at`, `updated_at`) VALUES
(1, '69cbc017-10dd-4d8e-823b-ce097a2dc092', 'Important', '2024-06-07 07:38:48', '2024-06-07 07:38:48'),
(2, '3531867a-fcda-4185-bf5d-8fda554cc86e', 'Important', '2024-06-07 07:39:04', '2024-06-07 07:39:04'),
(3, 'b1ccffbc-01f7-4fbd-bd81-bedb258e3b3f', 'very important', '2024-11-07 02:09:48', '2024-11-07 02:09:48'),
(4, 'f73327ed-90a8-4229-8ee9-278ff0e03f99', 'Arsh', '2025-01-13 01:32:29', '2025-01-13 01:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_related_services`
--

CREATE TABLE `ticket_related_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_related_services`
--

INSERT INTO `ticket_related_services` (`id`, `uuid`, `name`, `created_at`, `updated_at`) VALUES
(4, '80e3aa9f-69d7-48d3-a39e-8ca644321269', 'sad', '2024-11-07 02:09:27', '2024-11-07 02:09:27'),
(5, '3e0ff5db-5b22-4872-8972-0121ba30b560', 'Arsh', '2025-01-13 01:32:44', '2025-01-13 01:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` bigint(20) UNSIGNED NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `side` varchar(255) NOT NULL,
  `qty` decimal(10,4) NOT NULL,
  `entry_price` decimal(15,2) NOT NULL,
  `exit_price` decimal(15,2) DEFAULT NULL,
  `pnl` decimal(15,2) DEFAULT NULL,
  `sl_used` tinyint(1) NOT NULL DEFAULT 0,
  `tp_used` tinyint(1) NOT NULL DEFAULT 0,
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exit_time` timestamp NULL DEFAULT NULL,
  `holding_time_seconds` int(11) DEFAULT NULL,
  `gap_seconds` int(11) DEFAULT NULL,
  `news_flag` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`id`, `challenge_id`, `symbol`, `side`, `qty`, `entry_price`, `exit_price`, `pnl`, `sl_used`, `tp_used`, `entry_time`, `exit_time`, `holding_time_seconds`, `gap_seconds`, `news_flag`, `created_at`, `updated_at`) VALUES
(1, 3, 'RELIANCE', 'buy', 15.0000, 2575.75, 2610.00, 513.75, 0, 1, '2025-12-04 04:45:52', '2025-12-04 09:00:52', 19800, 0, 0, '2025-12-06 22:31:52', '2025-12-06 22:31:52'),
(2, 3, 'HDFCBANK', 'sell', 20.0000, 1642.50, 1630.00, 250.00, 0, 0, '2025-12-06 05:30:52', '2025-12-06 08:15:52', 9900, 0, 0, '2025-12-06 22:31:52', '2025-12-06 22:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `trade_logs`
--

CREATE TABLE `trade_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `challenge_id` bigint(20) UNSIGNED DEFAULT NULL,
  `strategy_id` bigint(20) UNSIGNED DEFAULT NULL,
  `symbol` varchar(255) NOT NULL,
  `direction` enum('long','short') NOT NULL DEFAULT 'long',
  `entry_price` decimal(18,8) NOT NULL,
  `exit_price` decimal(18,8) DEFAULT NULL,
  `entry_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `exit_time` timestamp NULL DEFAULT NULL,
  `quantity` decimal(20,8) NOT NULL DEFAULT 1.00000000,
  `profit_loss` decimal(18,8) DEFAULT NULL,
  `profit_loss_percent` decimal(12,4) DEFAULT NULL,
  `commission` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `swap` decimal(18,8) NOT NULL DEFAULT 0.00000000,
  `stop_loss` decimal(18,8) DEFAULT NULL,
  `take_profit` decimal(18,8) DEFAULT NULL,
  `stop_loss_used` tinyint(1) NOT NULL DEFAULT 0,
  `take_profit_used` tinyint(1) NOT NULL DEFAULT 0,
  `trailing_stop_used` tinyint(1) NOT NULL DEFAULT 0,
  `slippage` decimal(12,4) DEFAULT NULL,
  `holding_seconds` int(10) UNSIGNED DEFAULT NULL,
  `trade_type` varchar(255) DEFAULT NULL,
  `exchange` varchar(255) DEFAULT NULL,
  `segment` varchar(255) DEFAULT NULL,
  `order_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`order_ids`)),
  `broker_trade_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`broker_trade_ids`)),
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `is_paper` tinyint(1) NOT NULL DEFAULT 0,
  `delayed_feed` tinyint(1) NOT NULL DEFAULT 0,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_logs`
--

INSERT INTO `trade_logs` (`id`, `uuid`, `user_id`, `challenge_id`, `strategy_id`, `symbol`, `direction`, `entry_price`, `exit_price`, `entry_time`, `exit_time`, `quantity`, `profit_loss`, `profit_loss_percent`, `commission`, `swap`, `stop_loss`, `take_profit`, `stop_loss_used`, `take_profit_used`, `trailing_stop_used`, `slippage`, `holding_seconds`, `trade_type`, `exchange`, `segment`, `order_ids`, `broker_trade_ids`, `meta`, `is_paper`, `delayed_feed`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, 'ec26fc43-7840-44fc-8b29-ddae9491586f', 15, 3, NULL, 'RELIANCE', 'long', 2575.75000000, 2610.00000000, '2025-12-04 04:45:52', '2025-12-04 09:00:52', 15.00000000, 513.75000000, 1.3300, 20.00000000, 0.00000000, NULL, 2650.00000000, 0, 1, 0, 0.2500, 19800, 'intraday', 'NSE', 'EQ', '[\"412307150001\"]', '[\"T202512070001\"]', '{\"note\":\"Take profit hit\",\"setup\":\"Breakout\"}', 0, 0, '2025-12-04 09:00:52', '2025-12-06 22:31:52', '2025-12-06 22:31:52'),
(2, 'eea71d31-3934-4cd1-97dc-2405dee1c520', 15, 3, NULL, 'HDFCBANK', 'short', 1642.50000000, 1630.00000000, '2025-12-06 05:30:52', '2025-12-06 08:15:52', 20.00000000, 250.00000000, 0.7600, 18.00000000, 0.00000000, 1655.00000000, NULL, 0, 0, 0, 0.5000, 9900, 'intraday', 'NSE', 'EQ', '[\"412307160112\"]', '[\"T202512080112\"]', '{\"note\":\"Manual exit\"}', 0, 0, '2025-12-06 08:15:52', '2025-12-06 22:31:52', '2025-12-06 22:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `amount` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `charge` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `post_balance` decimal(28,8) NOT NULL DEFAULT 0.00000000,
  `trx_type` varchar(40) DEFAULT NULL,
  `trx` varchar(40) DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `remark` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `profile_photo` varchar(255) DEFAULT NULL,
  `mode` varchar(255) NOT NULL DEFAULT 'light',
  `account_type` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `is_subscribed` tinyint(1) DEFAULT NULL,
  `refer` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT '0',
  `is_online` tinyint(4) DEFAULT 0,
  `last_seen` timestamp NULL DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` varchar(255) DEFAULT 'Trabajador',
  `permissions` varchar(255) DEFAULT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `custom_password` varchar(255) DEFAULT NULL,
  `whatsapp_number` varchar(191) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `is_system` tinyint(4) DEFAULT 0,
  `country` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `language` varchar(191) NOT NULL DEFAULT '''en''',
  `is_super_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_affiliate` tinyint(1) NOT NULL DEFAULT 0,
  `referral_code` varchar(255) DEFAULT NULL,
  `affiliate_earnings` decimal(12,2) NOT NULL DEFAULT 0.00,
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 18.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `fcm_token`, `rating`, `username`, `is_active`, `profile_photo`, `mode`, `account_type`, `balance`, `is_subscribed`, `refer`, `level`, `is_online`, `last_seen`, `birth_date`, `role`, `permissions`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `custom_password`, `whatsapp_number`, `about`, `city`, `facebook`, `instagram`, `linkedin`, `twitter`, `address`, `status`, `remember_token`, `ip_address`, `is_system`, `country`, `created_by`, `deleted_at`, `language`, `is_super_admin`, `created_at`, `updated_at`, `is_affiliate`, `referral_code`, `affiliate_earnings`, `commission_rate`) VALUES
(1, NULL, NULL, NULL, NULL, 1, '', 'dark', 'admin', NULL, 0, NULL, NULL, 1, '2025-12-01 22:09:30', NULL, '1', NULL, 'SUPER ADMINISTRADOR', 'admin@fstandard.lat', NULL, '2023-03-23 07:45:02', '$2y$10$sgLXLiwlfSqKV7pPTSgco.SLKcpQwOg.L4VrnH.DBVirfour.CGLa', '987654321', '8878326802', NULL, 'bolivia', NULL, NULL, NULL, NULL, 'sdfafa', 1, NULL, '127.0.0.1', 1, '1', NULL, NULL, 'es', 1, '2023-03-23 07:45:02', '2025-12-01 22:09:30', 0, NULL, 0.00, 18.00),
(4, NULL, NULL, NULL, NULL, 1, NULL, 'dark', 'user', NULL, NULL, NULL, '0', 1, '2025-10-18 18:22:47', NULL, 'Trabajador', NULL, 'Juan Perez', 'arstech2a@gmail.com', NULL, NULL, '$2y$10$DG1ruRDoU1bRb9JA.Y4JZ.aSnnW.9mmA8NRNbC6PrM2Ua0/Rv4z5G', '987654321', '591591594332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '\'en\'', 0, '2025-10-17 01:19:30', '2025-10-18 18:22:47', 0, NULL, 0.00, 18.00),
(5, NULL, NULL, NULL, NULL, 1, NULL, 'light', 'user', NULL, NULL, NULL, '0', 1, '2025-12-06 22:50:10', NULL, 'Trabajador', NULL, 'Aasif Ahmed', 'hrnatrajinfotech@gmail.com', NULL, NULL, '$2y$10$4KiwKo1otj1W6hm2aqVSju7bonYEIaa38SAMa6YHaCH0eWUzEMoK6', NULL, '919876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '127.0.0.1', 0, NULL, NULL, NULL, '\'en\'', 0, '2025-11-24 05:09:31', '2025-12-06 22:50:10', 0, '9XTD4BQM7P', 0.00, 18.00),
(13, NULL, NULL, NULL, NULL, 1, NULL, 'light', 'user', NULL, NULL, NULL, '0', 0, '2025-11-24 03:31:57', NULL, 'Trabajador', NULL, 'Tarija', 'aasifdev5@gmail.com', NULL, '2025-11-24 06:38:54', '$2y$10$.wBqoNcObZUM8schU9Mx5eZvNAx61U0Pa1/RmSQTSHajqNAJcSG7C', NULL, '919876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '127.0.0.1', 0, NULL, NULL, NULL, '\'en\'', 0, '2025-11-24 06:38:32', '2025-11-24 07:31:57', 0, NULL, 0.00, 18.00),
(14, NULL, NULL, NULL, NULL, 1, NULL, 'light', 'user', NULL, NULL, NULL, '0', 0, '2025-12-01 17:45:06', NULL, 'Trabajador', NULL, 'tanzila', 'arstecht2a@gmail.com', NULL, NULL, '$2y$10$OLelSLqNBP26Kv47GRJpfuJ.vemGAYaZWQCo7R071hAyNBTs4AAxO', NULL, '919876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '127.0.0.1', 0, NULL, NULL, NULL, '\'en\'', 0, '2025-12-01 21:41:36', '2025-12-01 21:45:06', 0, 'ODY42L1K7W', 0.00, 18.00),
(15, NULL, NULL, NULL, NULL, 1, NULL, 'light', NULL, NULL, NULL, NULL, '0', 0, NULL, NULL, 'Trabajador', NULL, 'Demo Trader', 'demo@trader.com', NULL, '2025-12-06 22:31:52', '$2y$10$8wfR49IEv47Qx3PxreYOs.oO/S1vw0CeicI1n/DgrWNJBMTKQdTRu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'bU1bduE5z2', NULL, 0, NULL, NULL, NULL, '\'en\'', 0, '2025-12-06 22:31:52', '2025-12-06 22:31:52', 0, NULL, 0.00, 18.00);

-- --------------------------------------------------------

--
-- Table structure for table `user_balances`
--

CREATE TABLE `user_balances` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `balance` decimal(18,2) NOT NULL DEFAULT 0.00 COMMENT 'Available INR balance',
  `locked_balance` decimal(18,2) NOT NULL DEFAULT 0.00 COMMENT 'Balance locked in open orders',
  `total_deposited` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_withdrawn` decimal(18,2) NOT NULL DEFAULT 0.00,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_ip` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `country` varchar(40) DEFAULT NULL,
  `country_code` varchar(40) DEFAULT NULL,
  `longitude` varchar(40) DEFAULT NULL,
  `latitude` varchar(40) DEFAULT NULL,
  `browser` varchar(40) DEFAULT NULL,
  `os` varchar(40) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT 0.00 COMMENT 'Requested amount in INR',
  `charge` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Our withdrawal fee',
  `final_amount` decimal(15,2) NOT NULL DEFAULT 0.00 COMMENT 'Amount sent to bank',
  `bank_name` varchar(100) NOT NULL,
  `account_holder` varchar(150) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `trx` varchar(50) NOT NULL,
  `utr` varchar(100) DEFAULT NULL COMMENT 'Bank UTR after payout',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=Pending, 1=Approved, 2=Rejected, 3=Processed',
  `admin_feedback` varchar(255) DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_gallery_images`
--
ALTER TABLE `about_us_gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `about_us_generals`
--
ALTER TABLE `about_us_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affiliates_email_unique` (`email`),
  ADD UNIQUE KEY `affiliates_referral_code_unique` (`referral_code`);

--
-- Indexes for table `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `behavioural_metrics`
--
ALTER TABLE `behavioural_metrics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `behavioural_metrics_user_id_index` (`user_id`);

--
-- Indexes for table `blockchain_hash_records`
--
ALTER TABLE `blockchain_hash_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blockchain_hash_records_user_id_index` (`user_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_uuid_unique` (`uuid`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_uuid_unique` (`uuid`);

--
-- Indexes for table `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_tags`
--
ALTER TABLE `blog_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `celebrity_endorsements`
--
ALTER TABLE `celebrity_endorsements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chats_chat_id_unique` (`chat_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_logos`
--
ALTER TABLE `client_logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us_issues`
--
ALTER TABLE `contact_us_issues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_us_issues_uuid_unique` (`uuid`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contracts_service_request_id_foreign` (`service_request_id`),
  ADD KEY `contracts_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delayed_feed_assignments`
--
ALTER TABLE `delayed_feed_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delayed_feed_assignments_user_id_index` (`user_id`);

--
-- Indexes for table `evaluation_accounts`
--
ALTER TABLE `evaluation_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_accounts_user_id_index` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faq_questions`
--
ALTER TABLE `faq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_folder_id_foreign` (`folder_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forum_categories_uuid_unique` (`uuid`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forum_posts_uuid_unique` (`uuid`);

--
-- Indexes for table `forum_post_comments`
--
ALTER TABLE `forum_post_comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forum_post_comments_uuid_unique` (`uuid`);

--
-- Indexes for table `funding_plans`
--
ALTER TABLE `funding_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hedging_monitors`
--
ALTER TABLE `hedging_monitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_verifications`
--
ALTER TABLE `kyc_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_language_unique` (`language`),
  ADD UNIQUE KEY `languages_iso_code_unique` (`iso_code`);

--
-- Indexes for table `mail_templates`
--
ALTER TABLE `mail_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail_templates_alias_unique` (`alias`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `metas_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `notifications_uuid_unique` (`uuid`);

--
-- Indexes for table `notification_settings`
--
ALTER TABLE `notification_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_created_at_index` (`user_id`,`created_at`),
  ADD KEY `orders_challenge_id_index` (`challenge_id`),
  ADD KEY `orders_status_index` (`status`),
  ADD KEY `orders_trx_index` (`trx`);

--
-- Indexes for table `our_histories`
--
ALTER TABLE `our_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `personal_access_tokens_tokenable_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plan_purchases`
--
ALTER TABLE `plan_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plan_purchases_mt4_login_unique` (`mt4_login`);

--
-- Indexes for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_settings`
--
ALTER TABLE `referral_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slippage_profiles`
--
ALTER TABLE `slippage_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slippage_profiles_user_id_index` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_uuid_unique` (`uuid`);

--
-- Indexes for table `support_ticket_questions`
--
ALTER TABLE `support_ticket_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_trade_configs`
--
ALTER TABLE `system_trade_configs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_uuid_unique` (`uuid`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_uuid_unique` (`uuid`);

--
-- Indexes for table `ticket_departments`
--
ALTER TABLE `ticket_departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_departments_uuid_unique` (`uuid`);

--
-- Indexes for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_priorities_uuid_unique` (`uuid`);

--
-- Indexes for table `ticket_related_services`
--
ALTER TABLE `ticket_related_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_related_services_uuid_unique` (`uuid`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_logs`
--
ALTER TABLE `trade_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`);

--
-- Indexes for table `user_balances`
--
ALTER TABLE `user_balances`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_trx` (`trx`),
  ADD KEY `idx_user` (`user_id`),
  ADD KEY `idx_status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us_gallery_images`
--
ALTER TABLE `about_us_gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `about_us_generals`
--
ALTER TABLE `about_us_generals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `balances`
--
ALTER TABLE `balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `behavioural_metrics`
--
ALTER TABLE `behavioural_metrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blockchain_hash_records`
--
ALTER TABLE `blockchain_hash_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blog_tags`
--
ALTER TABLE `blog_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `celebrity_endorsements`
--
ALTER TABLE `celebrity_endorsements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `client_logos`
--
ALTER TABLE `client_logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us_issues`
--
ALTER TABLE `contact_us_issues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `delayed_feed_assignments`
--
ALTER TABLE `delayed_feed_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation_accounts`
--
ALTER TABLE `evaluation_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_questions`
--
ALTER TABLE `faq_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `forum_post_comments`
--
ALTER TABLE `forum_post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `funding_plans`
--
ALTER TABLE `funding_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hedging_monitors`
--
ALTER TABLE `hedging_monitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_verifications`
--
ALTER TABLE `kyc_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mail_templates`
--
ALTER TABLE `mail_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_settings`
--
ALTER TABLE `notification_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `our_histories`
--
ALTER TABLE `our_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `plan_purchases`
--
ALTER TABLE `plan_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `portfolio_items`
--
ALTER TABLE `portfolio_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `referral_settings`
--
ALTER TABLE `referral_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slippage_profiles`
--
ALTER TABLE `slippage_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `support_ticket_questions`
--
ALTER TABLE `support_ticket_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `system_trade_configs`
--
ALTER TABLE `system_trade_configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ticket_departments`
--
ALTER TABLE `ticket_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticket_messages`
--
ALTER TABLE `ticket_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_related_services`
--
ALTER TABLE `ticket_related_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trade_logs`
--
ALTER TABLE `trade_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_challenge_id_foreign` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_balances`
--
ALTER TABLE `user_balances`
  ADD CONSTRAINT `fk_user_balance` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
