-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 05:48 AM
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

--
-- Dumping data for table `blockchain_hash_records`
--

INSERT INTO `blockchain_hash_records` (`id`, `user_id`, `for_date`, `chain`, `tx_hash`, `behaviour_metrics_hash`, `meta`, `created_at`, `updated_at`) VALUES
(1, 15, '2025-09-20', 'bsc-testnet', '0xb9727566523deb25af1108f13fae248477b8eabd8a217ef5310664dcd289098d', 'd78fa2ac9560eeb8ea58794577a442b04ce82c2859308cc82006281d64f6f81c', '{\"broker\":\"Groww\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE781321\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(2, 5, '2025-09-22', 'polygon', '0x93037cf2aaac232e8b21b9052b0a814df60b33cd062670f278d5d3e79dcb24f9', '5e88194c80adc174a980e7f6a4108a68369eaff8d1351b0774364a78569f9be6', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE771207\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(3, 4, '2025-11-20', 'polygon', '0x651ac31518b41437d05fb793960087b4307190af46d896a79fe6590002e96a9e', '302f5a4e525e40a69f7b80352b398db68d65d4825bdc33b6fc9f00ac9763386a', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE856114\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(4, 1, '2025-12-01', 'hyperledger-india', '0x89b92318dd8e0cbd6bac0dba1f4d20a5350a9d9565ef8b30c7f15345407e1b0e', '2bc5ab2968e4f4df024d9428efc2a5513dd965b7ff35ce9b5cbea9ca80c58e0a', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE151836\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(5, 1, '2025-10-11', 'hyperledger-india', '0x27b577d6de63b4edc215766fec78f79680d1e6cf01346e6cff2abc130d282697', 'af277affdfb36f4dd7983308a9394da8bcc93eafce63b377d7b700820199b48b', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE394947\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(6, 5, '2025-10-28', 'polygon-mumbai', '0x1d24bbe7a3cce17377e2fff4876608b4c083a476c157815854c7ae4b16140c60', '4fbf862d11547cd9edf376b8e58a15f7ac6f8756e6b62cc21b297e3d048e3276', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE595144\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(7, 15, '2025-11-10', 'cordapp-india', '0xa1fb5a70907c365b11fd788363791d06f188de5c680c8f3a22c46bc1615bb082', 'c104b4c1506d1a12e18b792bb5ca2758a0c4be2b9d5e78b8b6882e3c7628585e', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE593911\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(8, 14, '2025-09-13', 'hyperledger-india', '0x19ed3ce7a6b058c487749085b03002492a1691b01eb2bd214945eb35ec745211', 'd23e344ab0b03ed1dd5ccfd60b39de698c1bf90ad19ab01b39a437b9afbc796e', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE373130\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(9, 15, '2025-11-24', 'polygon', '0x82e196299db46765a47513a15a42161bf6c34256e3fea11d761ae28c57f4e268', 'b6885aef418f8261c0b91aec649df5b1aabe2e3c307233b36a8e4183e9f3e075', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE812294\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(10, 13, '2025-11-08', 'polygon-mumbai', '0x29c32da0ab692862c33e7d53b3b3ec73f1009cfbd155d0299d121ca10b1f9350', '998f4c39da95cfcce8f6453c7f3524a01c9c5329255b45ae36f4855b896f1b21', '{\"broker\":\"Groww\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE353568\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(11, 14, '2025-12-01', 'polygon-mumbai', '0x22471dc0b31875e09529628fb1ab4870fb45697b286badc774c27cc4555224d9', '02321e323e1ce92d5116882fcd87905581b8ce373fa7d41f9d8c4ab711e560b3', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE521457\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(12, 1, '2025-12-01', 'hyperledger-india', '0x3e713e6d35e6146698639a2374fb50daca088a1bc3e12c462e9fd14efb0db4de', 'd635ee89e83021fa3f70b5bae73d0d8fff984455e2f2ec078da8b5ba2b3b80af', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE730657\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(13, 13, '2025-11-26', 'bsc-testnet', '0x3d90dd7528282b8f460642894228e56002d55b9174eb2aaf72ee4ede78b7897c', 'acfa86fcf1e912417b0a260782e62c8ee962709e6f276eefb92b043fa012d602', '{\"broker\":\"Groww\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE524924\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(14, 4, '2025-11-27', 'cordapp-india', '0x5eb02063062950d2733acd466794b544152ebd78f4bf072445b13d2e7595e755', '0a6a03020c16bc767909a17ab7c899700be15d2fdaa7cad8092564e0f0196243', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE511000\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(15, 5, '2025-11-30', 'hyperledger-india', '0xed223f676a7989ff111f9906f43767aa0d9f60e0f85938ce724cb737c45167b6', '19eb8677f83eb397fd712fc8e161756f2ed646b157958a73c4a9f46ab086b6c6', '{\"broker\":\"Angel One\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE461258\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(16, 5, '2025-11-24', 'bsc-testnet', '0x3b0b5f6f76b6d7b36cb1241a5653aaadbb25408c61f3d0f53d8a7dd6f571d5c6', '183a493ab59760ba3c02ca60b8ad02b549a9bdfa5ec9d43d93ed40510a830efb', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE579358\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(17, 5, '2025-12-01', 'hyperledger-india', '0x3c231e10a9be7911363d71af9799d9f869a617f20ff89be4f99df6ec90268dec', '7c28d5fa4b3ebb30180e2ead65ecb0e252dec036dae06824fb0666a7d95246da', '{\"broker\":\"Fyers\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE790993\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(18, 13, '2025-10-02', 'bsc-testnet', '0x1a48d9576ec04ea708bdb664d86608a7a31847110f96ef52a017dc471a022e65', '3b5d8b4b54b02eddc901f6caab2756087b015189f509d5ff6f9427d8fbca0e8f', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE604979\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(19, 14, '2025-11-02', 'hyperledger-india', '0xd34afc53a878f8690c660480ff43fb27e3bf54e0970d7fc29ce5a875dbfddb03', '0851c46312e2a6f1aa74fc79104cf0f296ef3bdfa48432b9c8666cf2118cc0e0', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE975335\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(20, 1, '2025-09-17', 'polygon-mumbai', '0x1a7f76b17e55dc5605caf469362b0204e293e04799fa64e5e5a0d6f33a09615a', 'e29598be0e055e918619244daca5d7d9c649aa4d1b48d7e532a2474a3b22ad71', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE381927\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(21, 13, '2025-11-23', 'polygon-mumbai', '0x5d4e483be4a47187d1c7812397536d39228ba5d9db270f8cdcc95d8ada4cb373', 'c78e60fb10d68dde597727202a5f296ce12362d0940d77b4a856d6abea7cb303', '{\"broker\":\"Dhan\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE853363\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(22, 4, '2025-09-27', 'polygon-mumbai', '0xac0ffb11882a89d34885b8958ae27a356842f2a80216b65ee8a19ef89bfc81db', 'bda1fd1558b8649ceb4ca351c12f748837f4750fda1fdc69ff37b7e6cc9a19b0', '{\"broker\":\"Groww\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE748167\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(23, 13, '2025-11-21', 'cordapp-india', '0xddf6e66c3b943a6eef48c2373225444b0f46d5bd56c59c82d9c130abeb186660', '48a2a8448a51e8b63f2a847995ed67880298150e4a36a4f19176e5fb7b1df65b', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE901296\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(24, 14, '2025-11-27', 'bsc-testnet', '0x5099e0dc22ef36876c0ea92c66f2d86e47da1882ff907a9fbdef37c3b5767abb', '8789a9273e0648350ae89b359fef6b0a7652b6c0c2778eec5f1cc1124bde093a', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE118744\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(25, 5, '2025-11-24', 'polygon-mumbai', '0x359d8f1dc097d310a8e237ee3a03614a19d5cd4b15deae52495d857ab1aed6d7', '61bb4450c54d5a66a7ab38bbaf65e832b09b3d495150b9ac14be5704020a6bc3', '{\"broker\":\"Zerodha\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE388887\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(26, 5, '2025-11-08', 'cordapp-india', '0xa597f7b8873a1c56afc079469ec1da273a8f1b279dcad30a5c377a244c8e416f', '18669863aef0ab60e54a43a3099baea61258257550d36ac8512dffb548910081', '{\"broker\":\"Angel One\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE980354\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(27, 4, '2025-09-15', 'hyperledger-india', '0x26dca9f203af451cdddb854ee7cb02996422abf062a4654f53bc47ff1a7d9043', 'cf6c8f4cee868bcc08cb489af5e7992caefafc31e6a0345dcc876f477fe9f3d8', '{\"broker\":\"Angel One\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE322564\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(28, 15, '2025-10-29', 'hyperledger-india', '0xa68669e6184efb2397526b3c24e75c4c9332d995cb5bb7aa7d2e5270948a8b48', '60ceb5d36dc4a890b12cef97afd55f46c72fe22bdd66c416d5565f52f7dc770e', '{\"broker\":\"Fyers\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE608289\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(29, 5, '2025-09-12', 'polygon-mumbai', '0x7abbc3311104842a8d6fa1bfe9760ef4ef1436a5118a6f358c0e86f1a9dc5691', '3c38026ba6097735088e94e061dfbda7a116ecddfc6e75ed9e88423764921bc1', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE196813\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(30, 5, '2025-10-07', 'polygon', '0xfa88858ab64bb104b3997e4df6ffe9a55564d14502f4aac116669670ef9ecff7', '161ca8b2780f402e04684a147f9b17b29b3896eae4932a383cd9043036cd1fa2', '{\"broker\":\"Groww\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE445531\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(31, 4, '2025-10-09', 'cordapp-india', '0xf2745ec48ec95100b754594464fce90e7cad50e7a73c028a82d4c6d59c417e1b', '82d12d047a8cdfefe8efb0ec1ffbf5f83c3c2d22a3d815920f94142abab0280a', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE279920\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(32, 13, '2025-10-30', 'polygon', '0x6c22121a40570abfb4e929b5d57347b7f094c4c588734b6c522037573b9bc086', '3e4ad17b7e19c0c14abffee16bc3f9175386416105797704adb6d126e72dcd57', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE827844\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(33, 14, '2025-10-26', 'cordapp-india', '0xb205ecd0b6aac879753c4521c0bfa8351241281b241f9d72f38d1f40d1501b60', '9430f72da7cf8caa683b04f41543cb3fed642d29e769e8e54c395af5d6a74f3a', '{\"broker\":\"Groww\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE922164\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(34, 5, '2025-11-01', 'bsc-testnet', '0xb875d6a06f6c02348ee1c9796b974a0374e3d4088f5d78c01fa9acaa8889640e', '7f0a58084cec4a600d291f7cb1f5e4b909c66da42d7c9dc2b9e44877840e7961', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE232467\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(35, 5, '2025-10-19', 'bsc-testnet', '0x930f6b7d12b77a54dc9123f6312cb4caf4fe7ec1d16496b4353aaac64db05ed6', '238f143e1dcde70169343a46e17f639910d0818833179355cce2b5120d9debde', '{\"broker\":\"Upstox\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE774182\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(36, 15, '2025-09-18', 'polygon-mumbai', '0x544a86edebce93a7b4ca0e91c902aa53cec323615a3683d9835bbaa55e4a1d18', 'b0c8cb25d30a22d4aa49eb552588e7efe4d7f286705400f7fa7f774cd0346659', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE724048\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(37, 13, '2025-10-25', 'polygon-mumbai', '0x23c5a852f343128ee2f089d64257c2bc64c90fa9f69315b8c07f4928a37cd5d7', '38a1b1f8f9eff114a1067a523498ac20efd672139ebccb439e2c081348db8ea5', '{\"broker\":\"Angel One\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE350720\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(38, 1, '2025-10-06', 'polygon', '0x9e818e6d5a18a2618aff1fe4540b2dd52e3e10929dfa441d37bd0f10e36430fe', '5179224f7ed20c1372b541a26b54d90aca5df180a90d5588d58099dec96ad407', '{\"broker\":\"Dhan\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE996251\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(39, 15, '2025-10-06', 'cordapp-india', '0x45c4c3ad958e95c7a489be3d1161e97624ef52ffb21c675c916e73c83641c357', '5f613cfa6a812180ae584f9ccf49a04c58044c45923f297588c9d35016447c7e', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE274424\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(40, 4, '2025-12-01', 'polygon', '0x2c2f82be4286b1e9c6c93741508bdddae15950a88947be39499160818a187920', 'f2b4694ff44f307a15fb56ab43c1f0126e604e3994a49addd0e6414f246db488', '{\"broker\":\"Fyers\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE897263\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(41, 5, '2025-11-19', 'polygon', '0xee9f5f38434f1d293292c28a6fdde5ca09a0de7e60c1cfdbdf6271466d9892b1', 'ac6ae60671bae0da46fe43d814aa98288de54a743ace17b760745e5209174787', '{\"broker\":\"Dhan\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE520374\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(42, 4, '2025-09-15', 'polygon-mumbai', '0x9a021bc5a35cd282ee9107e9af91a9f920fb80b1165e755fce999672b9ac31ec', 'a0ae1f83dd9ee3e2b5671b3b7bf6c3a19bd984e23a918029b890285cf372321a', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE991468\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(43, 4, '2025-10-23', 'cordapp-india', '0x4237cdce5d8b69e3af97aee8cc558e591cce7b8b1384da7605d96fc545066353', '359db2f367eba43688ff9c97d8d4d4c07e60a7320cac9a74084e52d55abba5a9', '{\"broker\":\"Upstox\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE870995\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(44, 1, '2025-10-09', 'polygon-mumbai', '0x01d1fa83ab88b07ae989a2ca7fea56e9e1334028c918110a173c76bc5dceceed', 'a5ae4d0daa93dcb484300305b273901c3ffb083e11e098ed1a39a32cad398aa2', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE879947\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(45, 14, '2025-10-07', 'polygon-mumbai', '0xfa33204af5f63a45b013bc83a9540a249da04af5f8e3204e1693900ad0bc11ba', 'f98f676a7e691603c7b1802237c4ee2fb7c5c503dfb98d238ae041aaac1c2f3f', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE911700\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(46, 1, '2025-11-18', 'cordapp-india', '0xba298e859ce1b5bd5fa21297487dd5d4cd95ba4577850e69ec4c22a2bd8b5617', '76e1dcb1094efd4138274ecfbe1a07ec6c2350582917dbf6db0cb3df73bf1b47', '{\"broker\":\"Zerodha\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE424128\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(47, 13, '2025-11-18', 'polygon-mumbai', '0xd3a13142e8a347aa6c3512f40253fd711aca35b2cdf7ba32c3e03959fcc60150', '62c8548e817cc69924d81ba54e8133ae175c1b76c9e93048b7f2038b18b5beac', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE853908\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(48, 13, '2025-11-18', 'cordapp-india', '0xd5be6441f83351fd1c34276ac5395b1b0c30498d6ff633a791807bdd9640d3ef', 'b20d0835b3f21efa1e43d1a64aedb68dd4dbdecaaf4a88521e73bfca41c9b04f', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE153906\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(49, 4, '2025-11-02', 'bsc-testnet', '0x73a83442a5d84b28fd460deb6c6f65f0bd56ed35f0206d306d342a604ea651c5', '222494f28227dce8ca31c9ba6a28b278ab768a0464b94324cd1a1719da28a0ca', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE241108\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(50, 14, '2025-09-11', 'hyperledger-india', '0xb70637e6ff3c56460da665bb951dfaca00b0706da3e6bdf9dba6efe20efb0d0d', 'b2b3578060b227671bfef7de0ac78c1cb8662a1ac3b26e0c137fee78295486e2', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE358700\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(51, 15, '2025-11-13', 'cordapp-india', '0x6bd3f7fb7549307eebb9460c65059cfa2360ffd5e0134d775b7a649b3727c807', '52995674fab8e9441be041c05b08bfb82ff03bc2dc4ee3d88ef1cdc75a0c7630', '{\"broker\":\"Zerodha\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE622758\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(52, 15, '2025-11-29', 'cordapp-india', '0xff6abd15bdccc4b142533450052a04ffc3eded4de3f86ddb3614714b259a5543', 'bafe7d68aa0afb4cede7aeb75160f8cca4597341040a4603c9eb7577d7ce3fb2', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE896137\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(53, 4, '2025-09-19', 'polygon', '0x652dd3e0611e5ae31eb4bb6bdb488c48c1aeb8d1df640811dea14dad5a74ab58', 'd3daf41a34c8c40f6dd298c0df25465bbfc1cf155956b003b4d31474764d15c8', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE918602\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(54, 15, '2025-12-09', 'hyperledger-india', '0xcf55f0f098afe06bf0ea39a74cb3f0fba39e32ee1898f45947a2791c459c1e3d', '9070b63ca0ca86039a83f8cbc25f8f006cb35667ccfc31eceba8601f9f2e9381', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE537782\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(55, 13, '2025-11-13', 'hyperledger-india', '0xe4d43b7f3e84f2215d76f535791f74a6e1b4525b161eabd5f9941684ab3e5847', 'a9d0e4b7cd17b0607d48696faf9915bf3ab11c5f9340272f714ffc4b0d9ca3d2', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE527298\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(56, 13, '2025-10-13', 'bsc-testnet', '0x1b157c77af8f1f1fa072ea6b0c7409e05da5bc99ba50c0bde9a10743edb0b82a', '89323f0b146e716c48a051cbfce6035ea1225478724409f42c9204867e65dda7', '{\"broker\":\"Zerodha\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE613071\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(57, 15, '2025-12-07', 'cordapp-india', '0xe422cfc5d5af5fd7fa65632d2a8078c5e0415b11009a920b4eea2136377fc440', 'edc5d4890bbf47f720ad0c6a4e33a9f4137b08883053d57de2725bf1933a363d', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE670453\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(58, 13, '2025-11-11', 'cordapp-india', '0x2cec890ecb1775ca635aaf20f2ea57dd4f77bb2b359574463d43e035400c108d', 'c4253bae2ee6a464a24e7c3f6af42c7f7d28b417b7c8521b65731e5704d694e0', '{\"broker\":\"Groww\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE771088\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(59, 5, '2025-12-09', 'bsc-testnet', '0xf4780058a443091ddb889499fd159cfa8ffdacd9bd0a7ced44e4c4f3e65a8486', '238bcccaa87fe31eef3bfd36e748ac0b0a54be70f233d01b4074d4070e5924c1', '{\"broker\":\"Fyers\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE821932\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(60, 14, '2025-10-13', 'polygon-mumbai', '0x67a63f2e377ac02079b0ccab51c8ad9e72cdbe0885fbbb950b1430babe5dd730', '1f8c22786a81b00b1a36398a60bd31a2b94f2c2682d37fe9b23bbe356a46b05e', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE511047\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(61, 5, '2025-11-16', 'cordapp-india', '0x545080cc448329f09c2d9f1fe5705036361b62de3d13d5c68885295c9a988840', '64d2e109fc9636e47d1b6737fc91acfa7019d728e33a32b74e331adfa12e581d', '{\"broker\":\"Angel One\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE617087\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(62, 15, '2025-12-04', 'hyperledger-india', '0x600482b19682c4afa7073d261f9072519376f4305699d1eb590a6ad5d0242ef2', '3146967b07672dcc3c3c6770c10c49b3fca458b15e5b8e721556fc5c28419914', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE327375\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(63, 5, '2025-10-10', 'hyperledger-india', '0xe43debd59e581ebc4161b1fb1e20e8cd90125ac0d19716abb1cdd196160c1ff6', '46283bacd37658df2de601e708f04992817ff06e5d3bd344ddbadb3893598632', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE319127\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(64, 4, '2025-12-05', 'bsc-testnet', '0xd81c66c54bf6caeb93bf495c9daceea673d4bca95ddec61dcf8d63bd46c120d4', '75bf2738ccea354a04ba178257cc6a023a2c116900b0e22adbbc7da774105330', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE191567\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(65, 15, '2025-09-16', 'polygon-mumbai', '0xfc315d8639d1b60e9cd47cb56f5807092d79baf1270d01fd451707fee830c88a', 'ec4f116004ee9902832c5799cf76763fa53bf14b51a90290aad6d9cf15adab07', '{\"broker\":\"Groww\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE539437\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(66, 1, '2025-12-02', 'polygon', '0xd1bd6c826a45960d48439255a3901bbe0aa7c71b0f7bcedf9cbbb4a0ebaa0c2d', '4cdaa39d3b9c2c50e21fd6a9b39f960d84147c17771f81752c397c49c1023e54', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE176819\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(67, 13, '2025-11-21', 'polygon', '0xde5e2bd6361375f652833ed7474dddf987f592fc49194352e6120b751b397ffa', 'c1b3a1b83b18258465ff784cf88fc97192f600a29180e03a0e21ff36eed5a892', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE526809\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(68, 4, '2025-10-05', 'polygon', '0xaea72afb9d292280a71ce945e8e33e0c1ed2c6e5f20409fc1f5fb50681680937', '95652ced34fd2bf07004bed458d9bcc965ca88964ecb1fbd357b753662c4ec61', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE201007\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(69, 14, '2025-11-05', 'cordapp-india', '0xa47ee2679295f570f7fa60ff119e6b8dd7b424bae3256972b327f0ce9e1b0fbf', '2b66b80fa0eed690cce88c7296303bc55b81e7d9746b8d3f8711bb5678ab8086', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE932891\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(70, 14, '2025-10-21', 'polygon', '0x116658b514d14b5fc009ba9776a121ebeb99b05725c9975c4e82f39495fd104b', '1a70f24430de0a7f94693d8a7e006e491366c6c936bc84db1353db8289ece518', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE266198\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(71, 5, '2025-11-26', 'polygon', '0x3c093db85776bc5b0a313d229c01d40fdf810ef408f75023559f94ec55b46a20', '6566e0078a0cbf8ebb28574b0e9ae6ff5d00729c0afaf8a68569c930f61bb477', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE542258\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(72, 5, '2025-09-30', 'hyperledger-india', '0xb96ec7aec31463c740c7da18902b1417ddfaf555f93d652367d2a747b8db81bd', 'b7dd5295b8653cc93233de13725884bdbac7adf03e436b1d766047b95eba8179', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE797808\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(73, 5, '2025-11-07', 'cordapp-india', '0xf1ae8f594ec6b476b3bbe901e1fd3d8b10da59d41be06c328f88e901e756c27f', 'da77e00b78d3937d89f42883ba984050565cce35f0f15fcedf0c29941298e17d', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE320923\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(74, 15, '2025-10-16', 'bsc-testnet', '0x206f7c01ca0eafb097cdc6d8634a27d31e4e70fbc9cd60b4d55f86aaf13b3c28', 'c04ae3c074943966ff40933999e78d377a11845c39b8bb90dccfbb08f69b28a6', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE931171\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(75, 1, '2025-09-17', 'polygon-mumbai', '0xc3ca3994eccb506d03ed45e5a4250630cb8917bc1ea7e1ec97313da19bd6f220', '637c9fba2c953cf52f1039e7eccb98024c6fb27d4cd5b374bf2e5b64df146361', '{\"broker\":\"Zerodha\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE733984\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(76, 1, '2025-11-08', 'cordapp-india', '0x697b6ae89c650e2a78bd164ce16c69696b0b1ffecd81bae902e545992cc862d2', 'f999345453325c5da394e19f1a2c94d0c7c7177456322372296b19214633c279', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE195295\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(77, 13, '2025-11-10', 'hyperledger-india', '0xf5512a9088a4c631318945cd32c797b94b4e717dc5fe8946db0e7fc16ed99bb3', '699b4e11c5e2cbe851bb7f81a2afc05ded7bebcf62f129cf364859837942644c', '{\"broker\":\"Groww\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE934452\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(78, 4, '2025-10-26', 'bsc-testnet', '0x691f4cdd50ee07031b0653c911dfb59f85cb92714a4a61e840b471ea7f29bb0c', 'f8b011897c0c310b4c51494c0ca0e47428a61c100a5dd19a4bfab3e5043e7846', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE828052\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(79, 14, '2025-11-25', 'polygon', '0x212d30bf1449570976c2b70d2aa0c7c90ff004274bb8516df3a13a8c42d2ddf1', '2eb9988148fa1e7d394c49081e6e9ad19d869bd40c8f7286ac418a6c391d9de3', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE832360\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(80, 4, '2025-11-21', 'bsc-testnet', '0x1e04213a46fccd9c6f103387e94f374c8deeb536c37158ac7fe9cfddf59cfa3f', '9f4ab02b5f938a0eb74970fec1b4fea30a2b3a0fe4c9fdcbfd449c8fb5c41127', '{\"broker\":\"Fyers\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE346725\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(81, 15, '2025-09-23', 'bsc-testnet', '0x5676729014f7c6ca236de5e182be4902c143d67d9820eb212059a7b001dc310d', 'c0d3a950f8fd908e47eab61450618690b54cfb3ca51382156159d7d6dcec0597', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE535390\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(82, 14, '2025-12-03', 'bsc-testnet', '0xdc0b820b8d3b68647679dc4f508c96aa2b25f01f8f28542e8de3511081d70568', '9ba8a25e330423097b7cf570f06ae9ca3222904b59256872429313aee4b19f03', '{\"broker\":\"Groww\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE227494\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(83, 4, '2025-11-08', 'cordapp-india', '0x5c1591a7d7cc63b7bb1b3905324080a3db71db30e2de94633108bcb012b4c58e', '929522174f2a4026ae9b33f36c8b54217b699d4b72ea2b720d1c2372eead01cd', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE718665\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(84, 15, '2025-11-05', 'polygon-mumbai', '0x7de118bc7156b2f67ef8265c6765d1fad86da1cbd2b2bfc476d9a5e214dc09fe', 'f2b45648aa6712c97e99f92ebe5089f609608c637aefaa3a1e3e68f7e97b2fae', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE712646\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(85, 4, '2025-11-08', 'hyperledger-india', '0x5efaca5cb948e3bc88aab6698e05302cfa3760eccfb8f47927a3db02ee1b18f2', 'f6430ecf590b40afc5367a61e6977df6fe7721ebfbc735c79cb87e97aec8c6b7', '{\"broker\":\"Zerodha\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE796902\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(86, 15, '2025-11-21', 'hyperledger-india', '0xf96fe46eee06752ef5d60571cf778152ba8996985ec76858a23dd4e20a728ab8', '9a10e9aaa72b702310a4fd296c4036da40c98220d64e0968a42166374497a5d3', '{\"broker\":\"Zerodha\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE817967\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(87, 15, '2025-11-10', 'hyperledger-india', '0xdb03ee03dda06c0d47b26adb3b56f15101e14a071384294d8fd2f3d67c2da04d', 'ad31bed592c778c88719615506234f50bb7399ad582301a8e94739bf5e9442ad', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE471201\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(88, 5, '2025-10-14', 'hyperledger-india', '0xcbbaa0e6abc70e715187d17be42540959083dba2612ec8a2dab2ff5d4afb0cf4', '19b88b54661177db29e705d403616b0f08dd8aa8cab0b762483951e6427eca70', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE307695\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(89, 14, '2025-11-26', 'polygon', '0xba6a6cf0e5801001c39deaed7543be5d2d060e72e7b9010d305774e030e86e96', '300ebc5893153a1ad4cb4ad678fe18dbba57638a53458d5048c9ac9b76718f7f', '{\"broker\":\"Zerodha\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE769102\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(90, 4, '2025-09-26', 'cordapp-india', '0xf20a036faae49768e2f95e35d636b9d05c0c3252842ec606ae7ea6f4feeb1ccb', '4bd829d7543036d76766edf48c08a8703398e12d723e4e0e90ea878f1ae7fd39', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE372869\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(91, 4, '2025-10-17', 'polygon', '0x54312e83fb545a33643d44400b510aab23774e615fe8fe79996103edeecf542b', '44470200d90eab1264ac7eddef61b6ae36a6f77ead66624cf477c11055625889', '{\"broker\":\"Dhan\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE712106\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(92, 1, '2025-09-20', 'polygon-mumbai', '0x8feacbb4f33bcc799b2d574f30f7b1a695ff36f2d3d5282abc4dc81d18672467', '32fd336cfbdc0fec32d44f7ff45ddddb1c58f17fb0fb2ca9016d409a27b0fc9f', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE135285\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(93, 4, '2025-11-05', 'polygon', '0xf35162bc3df5f820e99acfe3550ecfa4693ba86228d9ce19e39add24e257a415', '5727b9eb169e646e7e74db9e5a1c79274e9299735ee35de7b84dcd36cece4cef', '{\"broker\":\"Angel One\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE918716\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(94, 5, '2025-10-26', 'polygon-mumbai', '0x7ce198e65c6f9eaaa9df0668b2c0838c3cc995227b18a8574ea1e07fccb33fe5', '9b4c8a60d21204bce33a577ee8876ea3cef071afaabac7f26d6b3d78509e4ae7', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE588954\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(95, 13, '2025-11-13', 'cordapp-india', '0x5a4db951b7d773dbbc3b9d8b49929b0deb67f62adb3f8829a08f6982b162141d', 'f5ba910cd00d217467d5934d05f3c70c8867a1ccb6486099377adadb924c092a', '{\"broker\":\"Groww\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE398859\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(96, 1, '2025-11-15', 'cordapp-india', '0x27e639eb62c321745e68657e1308207d223cd4ef1698775d036bf86d18592e33', '8e19d886d853fdddaebe1bb9d38335722ebc1eb9928870c2c432ddf7335a30b7', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE684247\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(97, 4, '2025-11-13', 'polygon', '0xc7818eb80b077b23791b7c81982bc44cd00bb182853c67f3f0229a0bef40f572', '57ad0d4bc0c6b7c9fed633e7c096f5c123edcfe52e49902fa0326579eef1f7af', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE519431\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(98, 15, '2025-10-22', 'hyperledger-india', '0x86800d714b5a6b5371002f6351192230418b88e304afb5063adc755bc62a1f06', '54b12d777f5cc9011f5bc6c37f965b8fc1e805e8f5434cd1789589430331f99e', '{\"broker\":\"Groww\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE321354\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(99, 14, '2025-09-15', 'bsc-testnet', '0xf408cd2b3f5419a0364dedb892b03e4e4ac2cc3943ae6079133140e1466ca42d', '7bc61b50e139ede11a22959e5a69a79ab702221ab0786b42e7330094e0853e95', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE729855\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(100, 13, '2025-09-20', 'hyperledger-india', '0xd59be2322c42f90270a2dbd8a3034b7b346ac5848bcde9b215fc25d69454c090', 'c8d030705b7671185de112f64123f8ba05485b692d070763001609a78f67fe1b', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE268945\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(101, 4, '2025-09-21', 'hyperledger-india', '0xba5c271b91cfa928d30be691a5478b86be4c5ef13715e52a3e66e5c072adadb9', '3ba93023eeda9aa466d06fef3d0a29906296ae692881b98b22a262f64cb99680', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE903042\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(102, 14, '2025-11-20', 'bsc-testnet', '0x9915fd611e019818fdd516a1c9d113661a25f1ae8c69fa87c3c99b7f629f4a90', 'df96d716b03a3f8cc39a169371a2da227babf8bf3f4d46855b4db285d2a125f4', '{\"broker\":\"Fyers\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE911599\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(103, 13, '2025-10-02', 'polygon', '0xd3614cff4d68e35c26a695b7999d665a6db7dba344579994b9ed5043651a0a30', 'c48b6213b0ff37668cea86e42f2ef6a5f1928e06e8ab563471d7f843ba0953ea', '{\"broker\":\"Angel One\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE652485\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(104, 15, '2025-10-23', 'cordapp-india', '0x2968757cd14ef3c168fbb70017868d69ea802887e446169bf24ae66298183796', 'bacb4b17b31f51a9726f4efbf69197e32875745390a86917c684ebf41846e248', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE342363\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(105, 5, '2025-10-18', 'bsc-testnet', '0x8a746c07f2c78c4def89d9950c8d1f58c1977e57b1a59d01ea920b4146f1f12c', 'e0194e45840ee3b910013c9e1cb893378b868dd54299855e82cf530c2884c61b', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE655574\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(106, 5, '2025-10-29', 'polygon', '0x78fba114e8666e978db47408c8ad890200831d7e89f31f37fe1ac0aef5ae1aae', 'c5ad4636194a89c4309370e0de16974e8149714446341ab664cb71e705074bae', '{\"broker\":\"Dhan\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE178552\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(107, 15, '2025-09-12', 'hyperledger-india', '0x66b43987e8b694d44a4b7b82742d5d22b285a55a0b8b98e93ce1f97831a2259b', '7c7694802ba7d2547ad22fdedef70c2d8f27aa1130f3093e8025da727c53e095', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE640920\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(108, 13, '2025-10-20', 'polygon', '0x1378e90462748d4d1e2a84f287339c45c9a6755be587597e4149625f754a2e64', '84f0e0cb1ec80433063e1990ca9f743e4d2a58dbcabec2058133838721a515d6', '{\"broker\":\"Angel One\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE900138\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(109, 13, '2025-09-29', 'hyperledger-india', '0x5cd69c0784bca94c054fed84592721c8a5305ec0e74fee92c1972aff84b46f45', 'df90cb371801adcfee5f3ab0d3ed36f323ab59d876d25867adaabeec290ee185', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE139817\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(110, 13, '2025-11-22', 'hyperledger-india', '0x272be920999342c43e2b368c78cac9a2dcbd33e9c17d91a1fbace4d57a062e6a', '9e3c39b0a6df7e9d9a315b571c8bc7c3ed9d4cdf2450b898c750c3791cad2ecc', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE829173\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(111, 5, '2025-11-09', 'bsc-testnet', '0xbd51848d3061ddad466025ab2b0fe8c87819d4cf601e04d492475a8d978a8940', 'f61350190b212decd51287b719fa4fac000bb78468e9df0ce45ad9f44f381d96', '{\"broker\":\"Fyers\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE342317\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(112, 4, '2025-10-13', 'bsc-testnet', '0x2813610171baefec0a211e0f7112dbe5fa25aaace10a7c6608c7f6c9a5144799', 'fb16d9f8bfb620f54d8b817b8ab96132c06cb773d18d39cf0f743bce6e1840ee', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE357574\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(113, 14, '2025-10-10', 'bsc-testnet', '0xcb6715c809db31337513b76858d90646dffa3456e5bea89047cf4979c73b8248', '7f5a34097633ea7a875e546e2a2fb60aa19a7d0722f9ce44f4d305f5d1eba32b', '{\"broker\":\"Groww\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE686236\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(114, 15, '2025-09-16', 'polygon-mumbai', '0xb14d724e899d547b720be6aead24e80cc2cd1a398abaf50bf3512bc041e5f85f', '571fc5924ffee6de5cdbce6696a7659f9c4da40f1b81fe3c82d49d51f7b4c391', '{\"broker\":\"Zerodha\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE567708\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(115, 5, '2025-11-06', 'polygon', '0x370abbb09d63bc72eae05c1f7878cc8ed6b882dd006faa16604773385c0b0083', '33fde8c67f04b14ee7b72ec637302dbec44bc22194a66bf355b009071455d666', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE418700\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(116, 15, '2025-12-07', 'polygon-mumbai', '0x743fab9cc7efc07678c50ec519b76298b46fc7256f2a7606823ebc3f4d8a7d0d', '4edaa83b7664cae2e9aa291c58e30554ec2b373bb4ee700cce669481f00b82e4', '{\"broker\":\"Zerodha\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE451740\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(117, 1, '2025-10-26', 'cordapp-india', '0xebf93d665d65e9d8b1547ee9050b75ad21391bec2255c567c88c53beb048c184', '31428a3a96b2f19269efbbd5ed0bdb8de9dab0b89642927e1ba07bd5f00aadbe', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE157278\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(118, 4, '2025-10-18', 'cordapp-india', '0x723ddf97fa7e3571ec180e4568bbe31ce5f17c986e8add357ead5f722e4145db', '63e8f0dfe265e4e6002c10a964a1ff50f9fc995c8b4441d45f4117f55c2a7af2', '{\"broker\":\"Groww\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE554818\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(119, 4, '2025-11-14', 'hyperledger-india', '0x99a151bae4dfb33099a94ee673a3c48e691876f7ed333b854e3ff8d6d825c562', 'ecc6a34cda98114579e38ab6b3580184492dbf48809dfe6cd47719e8b964ee88', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE980775\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(120, 15, '2025-11-16', 'bsc-testnet', '0x52ed2475b84c4ceeb264f76eafc78470eedbad449501d9ee7af77fd698bff622', '32ce65dd5e5706c1049a4c767a0c5179e436ff0866a7db7b772c52816eda822c', '{\"broker\":\"Fyers\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE585060\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(121, 15, '2025-09-23', 'polygon', '0x175ee569ca90ea919f4b2e175e2ace0ce4806b27a1952e5cfc07a7de4f287f6c', '9164c3a6a6c24b2f801d254440a2224dce0923d3f23c604a4ec9561454eb8c77', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE795009\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(122, 1, '2025-11-23', 'hyperledger-india', '0xc13183106d09d2a0d230be93017a638381cc24fa03da0696789ac74bd722fe02', '06e043023fd06f9ed8ff2d20c777aec19cda78ed264bed638cf93904b69a1a35', '{\"broker\":\"Upstox\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE900370\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(123, 14, '2025-09-17', 'hyperledger-india', '0x695157d849b1f5708eaeb64d806118da550c737f7dad9c14918e44874a3490d4', 'd4c7c33be689d3cd22fb38dcc0ef5c6aada8ea4e9e74beba17c5c56abf36c930', '{\"broker\":\"Fyers\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE608970\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(124, 13, '2025-12-04', 'bsc-testnet', '0xf6e6547c5fd914f1c5bb593033133f52e5a309d687268f990c2f290344477df0', 'a627231222791a5e88e4f089484d91672759e23afe2bdb2688b2a008341797c3', '{\"broker\":\"Fyers\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE901980\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(125, 13, '2025-11-05', 'cordapp-india', '0x37e67f25ef68afb95fba22e83813a5e37d5553394daa0f57a9f5abd871f79de9', '91ae8bdfaf6176b786a31f30020a5a655c99204ea2a0aa53ea8216a3a910c0c5', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE800957\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(126, 15, '2025-09-21', 'cordapp-india', '0x1adbb9e2f55dbb9d5f792956f7b238ea5982fa3a882c9fcb991f7009f7236a74', 'b434fd8246167635aecb686bf52652f59bb9208f1085fd08e5d206c7f78cf4e0', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE240583\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(127, 15, '2025-10-25', 'polygon', '0x62437321a304ea93021b6e43e4ce4ff78ee4ef3a497e1c3fbf36c6fb25d30bba', '7112544441d16ed55f4cb09d64737217d022d8678fe8de9609c8ed4317a8d0a5', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE586540\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(128, 15, '2025-10-17', 'polygon', '0xf3deb2438d3ab9960fbcd186dd0da3650a478618d5d424ae10d4d61e4450ca94', '3fa6957d12f858f534fbd2a8ba8befc6a3b3d883fadd713875f6360a230b83e9', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE475479\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(129, 15, '2025-09-24', 'bsc-testnet', '0xd12982a55bd9015300bc670ef4c7859d2dc3220fbdd1270ba8a193f1415caba5', 'f1248d07bbd2c81527574fd0cb2d70388c02750ce1097c3d3d1adaefd4478000', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE658061\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(130, 4, '2025-10-28', 'hyperledger-india', '0xb054d92ad12c875ed3a461508aceeb609673a98970ee961e117e9458eea8c670', '7997699b5baf3e65f1db9caa8d0d5905d8465c533e8c46067f3b70f4f50d5b3c', '{\"broker\":\"Fyers\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE881167\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(131, 1, '2025-09-22', 'cordapp-india', '0x83e1ed77daeb4296e7497834824085e651a91af3e7ba8a2025733ee2129826cd', '4d0994fab729d1c8a09ec62e3d2a570ac81d13c4c7edf6c96ed264e521f93e48', '{\"broker\":\"Upstox\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE309593\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(132, 4, '2025-10-10', 'bsc-testnet', '0x21f03969dbeec6218792024d8b8b0e2db231d1b19e59bdb036e2927c59d50d9f', 'e2f4a4961b8fb9cbe873dea4b87432d8fc5104ae612d2489c9c6e2339fb3c422', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE780625\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(133, 13, '2025-10-07', 'cordapp-india', '0xb98aca0234bb33fef96b64687d594e6292703f5843731d98d66094d229f17c3f', '950d88f3cab35afb97cf850ada705d6e9676d69aa0f72130b43ad1932bf4cd4f', '{\"broker\":\"Angel One\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE286432\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(134, 4, '2025-10-06', 'bsc-testnet', '0xfb61aa5d9547369b95584ee0ee9a049aa1c76afaa2e3bb40f6dbfa2faf0b6dd1', '6e38915836228f8f0985d2440389438ae8348cf8429ff64fc3443db1ad3e3e6b', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE665494\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(135, 1, '2025-10-12', 'bsc-testnet', '0xe93c1e44e2cf9b30a65eb867a28db3deaab5ae690185f1e0a5e26486a102f8eb', '98541938ec4cd5742f34cec02baca509ea484d423f1cbd1ffd08c5fadf608000', '{\"broker\":\"Groww\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE680910\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(136, 1, '2025-11-15', 'cordapp-india', '0x1984886ed3f3d51b4b72223866ab565d056f59c14c9548ba4b4142710a071228', '141fa4e2bcf2b1115cb7175c09e5a669dc302c4f3d357ecae45cc887513bcafd', '{\"broker\":\"Zerodha\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE414202\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(137, 13, '2025-11-24', 'polygon', '0x1f08f1f749c6e589bb4e47c4835c70d172c33a6b3eec9cb5ce7b06d754f92a52', '997e43d0969d7af86530867d531b3be47188689f3b7d1032922c3b0baa38f333', '{\"broker\":\"Fyers\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE560883\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(138, 15, '2025-10-13', 'polygon-mumbai', '0x86ddaf4cd928b09c44dd9e89c790a0a5903716aec4f1c43ca314aec7728c1c08', '4affe510e8291808e800cb3b773e8f141c9fcf949f68c085152ef885cded8ddc', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE814395\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(139, 15, '2025-11-16', 'polygon-mumbai', '0x7f066186320f63c1478ff6928a04a1b8a7a5f7b82a49bd6b4ed2b12b839c83f1', 'f0d1719df4ae8e951ddadbeae9c9fccf8b44213308a7f4daa4a55a4f0ea8833c', '{\"broker\":\"Upstox\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE377088\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(140, 5, '2025-11-24', 'bsc-testnet', '0x8ec777242f751b579b9d12b20946fe1c9aa24212d3885388a0370785ac787b2e', '983ec2613e70a56cb8a59709009cbfbfe667b84792b49a2abb74c92ded9ba52f', '{\"broker\":\"Fyers\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE535036\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(141, 4, '2025-10-18', 'polygon-mumbai', '0xd6db9bdcdce141a351e3228503c849982f623c65483b2845706f862d65276fa6', 'd3b26b109b7ec9c4ba8e29d2579da9c5be1d458c5b85a27a3b26151bbf5c62b3', '{\"broker\":\"Upstox\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE356073\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(142, 15, '2025-10-24', 'hyperledger-india', '0x17f9d4cf5546a9674958dcd9d435c8ece87ddb0019221a6c55c1c30d7494dde0', '3f10cbae2699b61d1a1f94b27a99de48d4486c2653589327a7a0867dba773531', '{\"broker\":\"Dhan\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE877777\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(143, 14, '2025-10-25', 'polygon', '0x5492b84cab23d79bbea1ae9f5674ca43a18017a73e2a5564a280983a6d927673', '5314d8332f86adb5bea34e6f11907e9df5aaffd0c02a42c041b8ad9df47a13ed', '{\"broker\":\"Zerodha\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE398284\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(144, 14, '2025-10-08', 'polygon-mumbai', '0x07b2695b9936da19a051c1f27628d6ce58dc812bb44af0e813fc8de311dea1f3', 'ccfc249cb992c44046b3df434a9cbd37cc689544f65c912879c3a20dee9dd41a', '{\"broker\":\"Dhan\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE165593\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(145, 15, '2025-10-21', 'hyperledger-india', '0x70ba1cc230d00201bbf05b94a20edc5472261c5695ea7724aae9dd233e90bb54', 'cf5e46435ac66489b2f6044587917eb80f3bb1e48977eaa74be5ba55d6ad5e77', '{\"broker\":\"Groww\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE933419\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(146, 4, '2025-10-21', 'polygon', '0x66bcedb188f30c1db45e158bd2534bce85e7a751fcaabd9cac10aac10e2b5f55', '11ac2c987d99526884dd0a4ad2751363c6a781ebd0a83dd40425d5c1a490a2d0', '{\"broker\":\"Angel One\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE108810\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(147, 14, '2025-11-02', 'hyperledger-india', '0xb11c910c3f19999435e1069cf209a003d551694dd1ee4980f766d1faa1a789e9', 'c1aa30dbe9906111527bb5dfdf0be715bdb75e6b272124eff02c13fc76ca8a00', '{\"broker\":\"Dhan\",\"segment\":\"Currency\",\"nse_order_id\":\"NSE334717\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(148, 4, '2025-10-28', 'polygon-mumbai', '0x70215e980671ec963e0a755aa893c12b2eb2c0aeeceadbc6dbd22dc5358e224c', '06f6d905cb2d44902386db37e9416f1e7911972655d239495c06b40c5db2e108', '{\"broker\":\"Dhan\",\"segment\":\"Equity Cash\",\"nse_order_id\":\"NSE843878\",\"exchange\":\"NSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(149, 13, '2025-12-04', 'bsc-testnet', '0xb2ea5631220616c879285f216f2540ffa3174311b29ab3825aead56ab3aa44c6', '92a713fd0c26d6399f33c65b4d0f894b20262d9355fe74b55a9b120b27b6c38f', '{\"broker\":\"Zerodha\",\"segment\":\"Commodity\",\"nse_order_id\":\"NSE734929\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(150, 5, '2025-10-03', 'polygon', '0x8c6673d2f928bc4e7183da08279083b5fd623fe7e6721a1273552c821a420ed4', '3b56101999c29f2da1a71e6ba31c3817af9657c2c3e1bc0fe34ed9ce0de9a51e', '{\"broker\":\"Zerodha\",\"segment\":\"F&O\",\"nse_order_id\":\"NSE872506\",\"exchange\":\"BSE\"}', '2025-12-09 22:55:37', '2025-12-09 22:55:37');

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

--
-- Dumping data for table `delayed_feed_assignments`
--

INSERT INTO `delayed_feed_assignments` (`id`, `user_id`, `delay_seconds`, `reason`, `assigned_at`, `active`, `created_at`, `updated_at`) VALUES
(1, 5, 120, 'High volatility – Budget Day 2025', '2025-12-07 06:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(2, 13, 120, 'F&O expiry day congestion', '2025-12-09 16:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(3, 14, 30, 'Abnormal order frequency (Algo trading)', '2025-12-07 10:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(4, 5, 180, 'Abnormal order frequency (Algo trading)', '2025-12-08 04:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(5, 14, 30, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-08 20:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(6, 1, 30, 'Abnormal order frequency (Algo trading)', '2025-12-07 19:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(7, 4, 180, 'Multiple broker logins detected', '2025-12-07 15:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(8, 4, 30, 'Multiple broker logins detected', '2025-12-09 00:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(9, 4, 30, 'Abnormal order frequency (Algo trading)', '2025-12-08 06:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(10, 13, 60, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-08 22:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(11, 4, 180, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 23:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(12, 13, 180, 'High volatility – Budget Day 2025', '2025-12-08 22:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(13, 13, 120, 'SEBI surveillance flag triggered', '2025-12-08 10:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(14, 4, 30, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-09 10:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(15, 5, 30, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-09 10:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(16, 4, 180, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 00:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(17, 15, 300, 'Circuit breaker hit on NIFTY', '2025-12-08 19:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(18, 15, 30, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-08 14:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(19, 4, 180, 'Multiple broker logins detected', '2025-12-07 17:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(20, 15, 90, 'SEBI surveillance flag triggered', '2025-12-08 00:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(21, 4, 120, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 22:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(22, 15, 180, 'High volatility – Budget Day 2025', '2025-12-09 13:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(23, 14, 180, 'F&O expiry day congestion', '2025-12-09 01:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(24, 14, 30, 'F&O expiry day congestion', '2025-12-09 11:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(25, 14, 60, 'F&O expiry day congestion', '2025-12-08 08:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(26, 1, 300, 'Multiple broker logins detected', '2025-12-08 03:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(27, 13, 60, 'High volatility – Budget Day 2025', '2025-12-08 01:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(28, 13, 90, 'F&O expiry day congestion', '2025-12-08 18:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(29, 14, 90, 'SEBI surveillance flag triggered', '2025-12-08 09:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(30, 15, 30, 'Abnormal order frequency (Algo trading)', '2025-12-08 19:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(31, 1, 30, 'Abnormal order frequency (Algo trading)', '2025-12-06 23:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(32, 1, 180, 'SEBI surveillance flag triggered', '2025-12-09 00:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(33, 15, 120, 'Circuit breaker hit on NIFTY', '2025-12-09 02:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(34, 4, 90, 'F&O expiry day congestion', '2025-12-08 12:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(35, 5, 30, 'F&O expiry day congestion', '2025-12-08 08:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(36, 4, 30, 'SEBI surveillance flag triggered', '2025-12-07 15:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(37, 4, 30, 'Circuit breaker hit on NIFTY', '2025-12-07 14:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(38, 14, 90, 'SEBI surveillance flag triggered', '2025-12-08 17:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(39, 1, 60, 'High volatility – Budget Day 2025', '2025-12-09 21:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(40, 15, 300, 'High volatility – Budget Day 2025', '2025-12-06 22:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(41, 5, 60, 'Multiple broker logins detected', '2025-12-09 19:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(42, 1, 180, 'Multiple broker logins detected', '2025-12-09 12:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(43, 4, 120, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-08 10:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(44, 5, 120, 'F&O expiry day congestion', '2025-12-09 00:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(45, 15, 90, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-07 13:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(46, 15, 30, 'Circuit breaker hit on NIFTY', '2025-12-06 23:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(47, 15, 120, 'Abnormal order frequency (Algo trading)', '2025-12-06 23:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(48, 4, 300, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-08 02:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(49, 13, 180, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 12:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(50, 4, 120, 'High volatility – Budget Day 2025', '2025-12-07 08:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(51, 4, 90, 'Circuit breaker hit on NIFTY', '2025-12-09 07:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(52, 13, 300, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 12:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(53, 4, 60, 'Multiple broker logins detected', '2025-12-09 12:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(54, 13, 180, 'F&O expiry day congestion', '2025-12-07 23:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(55, 5, 30, 'Circuit breaker hit on NIFTY', '2025-12-09 15:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(56, 14, 30, 'SEBI surveillance flag triggered', '2025-12-08 20:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(57, 14, 300, 'High volatility – Budget Day 2025', '2025-12-08 22:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(58, 4, 300, 'F&O expiry day congestion', '2025-12-07 13:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(59, 13, 300, 'Circuit breaker hit on NIFTY', '2025-12-08 19:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(60, 13, 120, 'Abnormal order frequency (Algo trading)', '2025-12-09 18:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(61, 5, 120, 'High volatility – Budget Day 2025', '2025-12-09 04:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(62, 14, 90, 'High volatility – Budget Day 2025', '2025-12-09 20:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(63, 15, 30, 'F&O expiry day congestion', '2025-12-09 18:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(64, 4, 300, 'F&O expiry day congestion', '2025-12-08 10:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(65, 5, 90, 'High volatility – Budget Day 2025', '2025-12-09 12:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(66, 4, 30, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-08 17:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(67, 14, 90, 'Multiple broker logins detected', '2025-12-09 12:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(68, 5, 300, 'Abnormal order frequency (Algo trading)', '2025-12-09 00:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(69, 4, 90, 'High volatility – Budget Day 2025', '2025-12-08 23:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(70, 4, 90, 'Multiple broker logins detected', '2025-12-08 04:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(71, 1, 120, 'Multiple broker logins detected', '2025-12-07 13:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(72, 5, 30, 'Circuit breaker hit on NIFTY', '2025-12-07 14:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(73, 15, 30, 'High volatility – Budget Day 2025', '2025-12-07 00:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(74, 4, 90, 'Abnormal order frequency (Algo trading)', '2025-12-08 12:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(75, 15, 60, 'Multiple broker logins detected', '2025-12-07 16:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(76, 5, 30, 'Circuit breaker hit on NIFTY', '2025-12-07 08:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(77, 13, 90, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-08 15:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(78, 5, 180, 'High volatility – Budget Day 2025', '2025-12-09 00:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(79, 4, 300, 'High volatility – Budget Day 2025', '2025-12-09 04:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(80, 1, 60, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-08 09:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(81, 4, 90, 'SEBI surveillance flag triggered', '2025-12-09 10:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(82, 5, 120, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 19:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(83, 5, 120, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-09 04:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(84, 5, 60, 'Circuit breaker hit on NIFTY', '2025-12-08 22:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(85, 5, 60, 'High volatility – Budget Day 2025', '2025-12-09 06:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(86, 15, 300, 'Broker API rate limit exceeded (Zerodha/Upstox)', '2025-12-07 14:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(87, 4, 90, 'F&O expiry day congestion', '2025-12-07 20:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(88, 13, 300, 'High volatility – Budget Day 2025', '2025-12-07 15:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(89, 1, 60, 'NSE feed delayed during market open (09:15-09:30)', '2025-12-08 11:55:37', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(90, 5, 60, 'Multiple broker logins detected', '2025-12-07 14:55:37', 0, '2025-12-09 22:55:37', '2025-12-09 22:55:37');

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

--
-- Dumping data for table `hedging_monitors`
--

INSERT INTO `hedging_monitors` (`id`, `user_a`, `user_b`, `triggers`, `hedging_score`, `action`, `evidence`, `created_at`, `updated_at`) VALUES
(1, 13, 15, '[\"same_ip_different_broker\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.8972, 'alert', '{\"ip_address\":\"73.148.63.71\",\"city\":\"Kota\",\"brokers\":[\"Alice Blue\",\"Angel One\"],\"scripts\":[\"BANKNIFTY\",\"HDFCBANK\",\"RELIANCE\"],\"time_difference_sec\":11}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(2, 4, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8507, 'none', '{\"ip_address\":\"154.183.224.32\",\"city\":\"Hisar\",\"brokers\":[\"Alice Blue\",\"5Paisa\"],\"scripts\":[\"HDFCBANK\",\"TCS\",\"RELIANCE\"],\"time_difference_sec\":24}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(3, 5, 4, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.7818, 'fail', '{\"ip_address\":\"99.0.27.182\",\"city\":\"Gandhinagar\",\"brokers\":[\"Upstox\",\"Angel One\"],\"scripts\":[\"RELIANCE\",\"BANKNIFTY\",\"FINNIFTY\"],\"time_difference_sec\":3}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(4, 4, 14, '[\"same_ip_different_broker\",\"opposite_positions_same_script\"]', 0.8050, 'none', '{\"ip_address\":\"48.142.153.229\",\"city\":\"Guwahati\",\"brokers\":[\"Upstox\",\"Zerodha\"],\"scripts\":[\"NIFTY\",\"BANKNIFTY\",\"HDFCBANK\"],\"time_difference_sec\":23}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(5, 1, 4, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9224, 'fail', '{\"ip_address\":\"204.215.5.53\",\"city\":\"Hisar\",\"brokers\":[\"Upstox\",\"Zerodha\"],\"scripts\":[\"FINNIFTY\",\"TCS\",\"NIFTY\"],\"time_difference_sec\":23}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(6, 5, 13, '[\"same_ip_different_broker\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9499, 'fail', '{\"ip_address\":\"31.53.227.169\",\"city\":\"Ludhiana\",\"brokers\":[\"5Paisa\",\"Angel One\"],\"scripts\":[\"TCS\",\"RELIANCE\",\"BANKNIFTY\"],\"time_difference_sec\":23}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(7, 4, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9140, 'none', '{\"ip_address\":\"236.11.158.200\",\"city\":\"Raipur\",\"brokers\":[\"Alice Blue\",\"Zerodha\"],\"scripts\":[\"TCS\",\"BANKNIFTY\",\"HDFCBANK\"],\"time_difference_sec\":23}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(8, 13, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.9127, 'alert', '{\"ip_address\":\"97.33.2.82\",\"city\":\"Mysore\",\"brokers\":[\"Zerodha\",\"Upstox\"],\"scripts\":[\"TCS\",\"FINNIFTY\",\"NIFTY\"],\"time_difference_sec\":10}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(9, 13, 14, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8201, 'alert', '{\"ip_address\":\"232.134.197.244\",\"city\":\"Trichy\",\"brokers\":[\"Upstox\",\"5Paisa\"],\"scripts\":[\"TCS\",\"BANKNIFTY\",\"HDFCBANK\"],\"time_difference_sec\":15}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(10, 4, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.7869, 'alert', '{\"ip_address\":\"251.221.22.88\",\"city\":\"Nagpur\",\"brokers\":[\"Alice Blue\",\"5Paisa\"],\"scripts\":[\"HDFCBANK\",\"FINNIFTY\",\"NIFTY\"],\"time_difference_sec\":25}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(11, 13, 1, '[\"same_ip_different_broker\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8709, 'fail', '{\"ip_address\":\"240.136.237.242\",\"city\":\"Faridabad\",\"brokers\":[\"5Paisa\",\"Angel One\"],\"scripts\":[\"NIFTY\",\"TCS\",\"HDFCBANK\"],\"time_difference_sec\":22}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(12, 4, 15, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"budget_day_arbitrage\"]', 0.9429, 'none', '{\"ip_address\":\"245.57.136.178\",\"city\":\"Bengaluru\",\"brokers\":[\"Angel One\",\"Alice Blue\"],\"scripts\":[\"TCS\",\"NIFTY\",\"BANKNIFTY\"],\"time_difference_sec\":23}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(13, 14, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.8498, 'none', '{\"ip_address\":\"60.213.253.77\",\"city\":\"Trichy\",\"brokers\":[\"Upstox\",\"Angel One\"],\"scripts\":[\"RELIANCE\",\"FINNIFTY\",\"NIFTY\"],\"time_difference_sec\":1}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(14, 15, 14, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9028, 'alert', '{\"ip_address\":\"143.91.212.223\",\"city\":\"Surat\",\"brokers\":[\"Upstox\",\"5Paisa\"],\"scripts\":[\"FINNIFTY\",\"TCS\",\"RELIANCE\"],\"time_difference_sec\":14}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(15, 4, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8076, 'alert', '{\"ip_address\":\"164.160.31.55\",\"city\":\"Bhubhaneshwar\",\"brokers\":[\"Zerodha\",\"Upstox\"],\"scripts\":[\"FINNIFTY\",\"TCS\",\"RELIANCE\"],\"time_difference_sec\":12}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(16, 5, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.8533, 'alert', '{\"ip_address\":\"107.98.118.230\",\"city\":\"Ranchi\",\"brokers\":[\"5Paisa\",\"Upstox\"],\"scripts\":[\"TCS\",\"BANKNIFTY\",\"NIFTY\"],\"time_difference_sec\":18}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(17, 15, 4, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.8564, 'none', '{\"ip_address\":\"191.78.41.79\",\"city\":\"Ahmedabad\",\"brokers\":[\"Zerodha\",\"Alice Blue\"],\"scripts\":[\"NIFTY\",\"FINNIFTY\",\"BANKNIFTY\"],\"time_difference_sec\":12}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(18, 13, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8292, 'none', '{\"ip_address\":\"6.90.229.212\",\"city\":\"Mumbai\",\"brokers\":[\"Upstox\",\"5Paisa\"],\"scripts\":[\"FINNIFTY\",\"TCS\",\"RELIANCE\"],\"time_difference_sec\":2}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(19, 13, 4, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.7925, 'none', '{\"ip_address\":\"248.141.101.149\",\"city\":\"Ahmedabad\",\"brokers\":[\"5Paisa\",\"Alice Blue\"],\"scripts\":[\"TCS\",\"BANKNIFTY\",\"HDFCBANK\"],\"time_difference_sec\":3}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(20, 4, 15, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8716, 'none', '{\"ip_address\":\"190.41.206.234\",\"city\":\"Lucknow\",\"brokers\":[\"Angel One\",\"5Paisa\"],\"scripts\":[\"NIFTY\",\"BANKNIFTY\",\"HDFCBANK\"],\"time_difference_sec\":12}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(21, 14, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.7800, 'alert', '{\"ip_address\":\"219.171.213.251\",\"city\":\"New Delhi\",\"brokers\":[\"Upstox\",\"Zerodha\"],\"scripts\":[\"HDFCBANK\",\"FINNIFTY\",\"RELIANCE\"],\"time_difference_sec\":24}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(22, 14, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.7606, 'fail', '{\"ip_address\":\"195.232.184.5\",\"city\":\"Vishakhapattanam\",\"brokers\":[\"5Paisa\",\"Zerodha\"],\"scripts\":[\"HDFCBANK\",\"NIFTY\",\"FINNIFTY\"],\"time_difference_sec\":2}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(23, 4, 15, '[\"same_ip_different_broker\",\"opposite_positions_same_script\",\"budget_day_arbitrage\"]', 0.9742, 'alert', '{\"ip_address\":\"127.128.129.214\",\"city\":\"Alwar\",\"brokers\":[\"Zerodha\",\"Angel One\"],\"scripts\":[\"RELIANCE\",\"BANKNIFTY\",\"NIFTY\"],\"time_difference_sec\":1}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(24, 15, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.8895, 'none', '{\"ip_address\":\"110.5.124.130\",\"city\":\"Rajkot\",\"brokers\":[\"5Paisa\",\"Zerodha\"],\"scripts\":[\"NIFTY\",\"FINNIFTY\",\"HDFCBANK\"],\"time_difference_sec\":15}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(25, 14, 5, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8207, 'alert', '{\"ip_address\":\"183.88.199.91\",\"city\":\"Ludhiana\",\"brokers\":[\"Upstox\",\"Zerodha\"],\"scripts\":[\"TCS\",\"HDFCBANK\",\"BANKNIFTY\"],\"time_difference_sec\":9}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(26, 5, 14, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9210, 'alert', '{\"ip_address\":\"173.115.237.66\",\"city\":\"Guwahati\",\"brokers\":[\"5Paisa\",\"Upstox\"],\"scripts\":[\"NIFTY\",\"RELIANCE\",\"TCS\"],\"time_difference_sec\":18}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(27, 15, 14, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8303, 'fail', '{\"ip_address\":\"129.212.206.197\",\"city\":\"Dehra Dun\",\"brokers\":[\"Angel One\",\"5Paisa\"],\"scripts\":[\"RELIANCE\",\"BANKNIFTY\",\"TCS\"],\"time_difference_sec\":16}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(28, 14, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.9621, 'alert', '{\"ip_address\":\"177.87.15.77\",\"city\":\"Bikaner\",\"brokers\":[\"Alice Blue\",\"5Paisa\"],\"scripts\":[\"TCS\",\"RELIANCE\",\"FINNIFTY\"],\"time_difference_sec\":22}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(29, 5, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9443, 'alert', '{\"ip_address\":\"207.151.63.214\",\"city\":\"Nashik\",\"brokers\":[\"Angel One\",\"Zerodha\"],\"scripts\":[\"FINNIFTY\",\"TCS\",\"BANKNIFTY\"],\"time_difference_sec\":17}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(30, 1, 15, '[\"same_ip_different_broker\",\"opposite_positions_same_script\"]', 0.9250, 'alert', '{\"ip_address\":\"96.205.112.94\",\"city\":\"Bengaluru\",\"brokers\":[\"Angel One\",\"Upstox\"],\"scripts\":[\"HDFCBANK\",\"FINNIFTY\",\"RELIANCE\"],\"time_difference_sec\":20}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(31, 1, 15, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.9076, 'none', '{\"ip_address\":\"225.28.250.240\",\"city\":\"Mysore\",\"brokers\":[\"Alice Blue\",\"Upstox\"],\"scripts\":[\"BANKNIFTY\",\"TCS\",\"FINNIFTY\"],\"time_difference_sec\":1}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(32, 14, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.9787, 'none', '{\"ip_address\":\"208.30.3.216\",\"city\":\"Srinagar\",\"brokers\":[\"Alice Blue\",\"Upstox\"],\"scripts\":[\"FINNIFTY\",\"BANKNIFTY\",\"NIFTY\"],\"time_difference_sec\":3}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(33, 13, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.9331, 'none', '{\"ip_address\":\"175.177.140.107\",\"city\":\"Patna\",\"brokers\":[\"Alice Blue\",\"Zerodha\"],\"scripts\":[\"BANKNIFTY\",\"HDFCBANK\",\"RELIANCE\"],\"time_difference_sec\":10}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(34, 14, 4, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.7769, 'fail', '{\"ip_address\":\"85.101.95.224\",\"city\":\"Gangtok\",\"brokers\":[\"Alice Blue\",\"Angel One\"],\"scripts\":[\"TCS\",\"HDFCBANK\",\"FINNIFTY\"],\"time_difference_sec\":6}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(35, 4, 1, '[\"same_ip_different_broker\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8627, 'fail', '{\"ip_address\":\"152.204.56.83\",\"city\":\"Vishakhapattanam\",\"brokers\":[\"Alice Blue\",\"Upstox\"],\"scripts\":[\"NIFTY\",\"FINNIFTY\",\"TCS\"],\"time_difference_sec\":10}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(36, 4, 5, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.8051, 'none', '{\"ip_address\":\"101.125.164.160\",\"city\":\"Bengaluru\",\"brokers\":[\"Upstox\",\"Alice Blue\"],\"scripts\":[\"RELIANCE\",\"TCS\",\"FINNIFTY\"],\"time_difference_sec\":11}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(37, 15, 4, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"budget_day_arbitrage\"]', 0.9013, 'alert', '{\"ip_address\":\"202.64.12.20\",\"city\":\"Pilani\",\"brokers\":[\"Angel One\",\"Upstox\"],\"scripts\":[\"TCS\",\"BANKNIFTY\",\"RELIANCE\"],\"time_difference_sec\":4}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(38, 14, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.7934, 'fail', '{\"ip_address\":\"168.200.198.171\",\"city\":\"Darjeeling\",\"brokers\":[\"5Paisa\",\"Zerodha\"],\"scripts\":[\"RELIANCE\",\"TCS\",\"FINNIFTY\"],\"time_difference_sec\":19}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(39, 13, 14, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8813, 'alert', '{\"ip_address\":\"56.104.247.47\",\"city\":\"Chennai\",\"brokers\":[\"Zerodha\",\"Angel One\"],\"scripts\":[\"BANKNIFTY\",\"NIFTY\",\"FINNIFTY\"],\"time_difference_sec\":21}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(40, 13, 15, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8405, 'alert', '{\"ip_address\":\"234.176.73.130\",\"city\":\"Raipur\",\"brokers\":[\"Upstox\",\"Angel One\"],\"scripts\":[\"HDFCBANK\",\"BANKNIFTY\",\"FINNIFTY\"],\"time_difference_sec\":7}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(41, 1, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\",\"budget_day_arbitrage\"]', 0.8888, 'none', '{\"ip_address\":\"161.245.152.50\",\"city\":\"Surat\",\"brokers\":[\"Zerodha\",\"Upstox\"],\"scripts\":[\"NIFTY\",\"FINNIFTY\",\"RELIANCE\"],\"time_difference_sec\":14}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(42, 5, 13, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\"]', 0.9674, 'alert', '{\"ip_address\":\"209.102.118.162\",\"city\":\"Ranchi\",\"brokers\":[\"Angel One\",\"5Paisa\"],\"scripts\":[\"RELIANCE\",\"BANKNIFTY\",\"NIFTY\"],\"time_difference_sec\":10}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(43, 4, 1, '[\"same_ip_different_broker\",\"opposite_positions_same_script\",\"budget_day_arbitrage\"]', 0.8740, 'alert', '{\"ip_address\":\"27.79.155.59\",\"city\":\"Jammu\",\"brokers\":[\"Alice Blue\",\"Zerodha\"],\"scripts\":[\"TCS\",\"FINNIFTY\",\"BANKNIFTY\"],\"time_difference_sec\":2}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(44, 4, 1, '[\"same_ip_different_broker\",\"mirror_trades_zerodha_upstox\",\"opposite_positions_same_script\",\"high_frequency_BANKNIFTY\"]', 0.8482, 'none', '{\"ip_address\":\"123.117.4.76\",\"city\":\"Vadodara\",\"brokers\":[\"Angel One\",\"Zerodha\"],\"scripts\":[\"NIFTY\",\"HDFCBANK\",\"FINNIFTY\"],\"time_difference_sec\":24}', '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(45, 13, 15, '[\"same_ip_different_broker\",\"opposite_positions_same_script\"]', 0.8726, 'alert', '{\"ip_address\":\"52.29.153.47\",\"city\":\"Thiruvananthapuram\",\"brokers\":[\"Angel One\",\"Upstox\"],\"scripts\":[\"NIFTY\",\"FINNIFTY\",\"RELIANCE\"],\"time_difference_sec\":4}', '2025-12-09 22:55:37', '2025-12-09 22:55:37');

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

--
-- Dumping data for table `slippage_profiles`
--

INSERT INTO `slippage_profiles` (`id`, `user_id`, `min_slippage`, `max_slippage`, `symbol_overrides`, `time_overrides`, `active`, `created_at`, `updated_at`) VALUES
(1, 4, 0.0013, 0.0240, '[{\"max\":0.095},{\"max\":0.12},{\"max\":0.018}]', '{\"09:15-09:45\":{\"max\":0.048},\"15:00-15:30\":{\"max\":0.042},\"budget_day\":{\"max\":0.09}}', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(2, 14, 0.0014, 0.0214, '[{\"max\":0.006},{\"max\":0.009},{\"max\":0.078}]', '{\"09:15-09:45\":{\"max\":0.048},\"15:00-15:30\":{\"max\":0.042},\"budget_day\":{\"max\":0.09}}', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(3, 5, 0.0009, 0.0445, '[{\"max\":0.009},{\"max\":0.038},{\"max\":0.12}]', '{\"09:15-09:45\":{\"max\":0.048},\"15:00-15:30\":{\"max\":0.042},\"budget_day\":{\"max\":0.09}}', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(4, 13, 0.0008, 0.0304, '[{\"max\":0.009},{\"max\":0.038},{\"max\":0.095}]', '{\"09:15-09:45\":{\"max\":0.048},\"15:00-15:30\":{\"max\":0.042},\"budget_day\":{\"max\":0.09}}', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(5, 15, 0.0009, 0.0416, '[{\"max\":0.007},{\"max\":0.006},{\"max\":0.009}]', '{\"09:15-09:45\":{\"max\":0.048},\"15:00-15:30\":{\"max\":0.042},\"budget_day\":{\"max\":0.09}}', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37'),
(6, 1, 0.0014, 0.0509, '[{\"max\":0.006},{\"max\":0.095},{\"max\":0.018}]', '{\"09:15-09:45\":{\"max\":0.048},\"15:00-15:30\":{\"max\":0.042},\"budget_day\":{\"max\":0.09}}', 1, '2025-12-09 22:55:37', '2025-12-09 22:55:37');

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
(1, NULL, NULL, NULL, NULL, 1, '', 'dark', 'admin', NULL, 0, NULL, NULL, 1, '2025-12-09 22:14:52', NULL, '1', NULL, 'SUPER ADMINISTRADOR', 'admin@fstandard.lat', NULL, '2023-03-23 07:45:02', '$2y$10$sgLXLiwlfSqKV7pPTSgco.SLKcpQwOg.L4VrnH.DBVirfour.CGLa', '987654321', '8878326802', NULL, 'bolivia', NULL, NULL, NULL, NULL, 'sdfafa', 1, NULL, '127.0.0.1', 1, '1', NULL, NULL, 'es', 1, '2023-03-23 07:45:02', '2025-12-09 22:14:52', 0, NULL, 0.00, 18.00),
(4, NULL, NULL, NULL, NULL, 1, NULL, 'dark', 'user', NULL, NULL, NULL, '0', 1, '2025-10-18 18:22:47', NULL, 'Trabajador', NULL, 'Juan Perez', 'arstech2a@gmail.com', NULL, NULL, '$2y$10$DG1ruRDoU1bRb9JA.Y4JZ.aSnnW.9mmA8NRNbC6PrM2Ua0/Rv4z5G', '987654321', '591591594332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, '\'en\'', 0, '2025-10-17 01:19:30', '2025-10-18 18:22:47', 0, NULL, 0.00, 18.00),
(5, NULL, NULL, NULL, NULL, 1, NULL, 'light', 'user', NULL, NULL, NULL, '0', 0, '2025-12-08 19:05:03', NULL, 'Trabajador', NULL, 'Aasif Ahmed', 'hrnatrajinfotech@gmail.com', NULL, NULL, '$2y$10$4KiwKo1otj1W6hm2aqVSju7bonYEIaa38SAMa6YHaCH0eWUzEMoK6', NULL, '919993605837', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '127.0.0.1', 0, NULL, NULL, NULL, '\'en\'', 0, '2025-11-24 05:09:31', '2025-12-08 23:05:03', 0, '9XTD4BQM7P', 0.00, 18.00),
(13, NULL, NULL, NULL, NULL, 1, NULL, 'light', 'user', NULL, NULL, NULL, '0', 0, '2025-11-24 03:31:57', NULL, 'Trabajador', NULL, 'Tarija', 'aasifdev5@gmail.com', NULL, '2025-11-24 06:38:54', '$2y$10$.wBqoNcObZUM8schU9Mx5eZvNAx61U0Pa1/RmSQTSHajqNAJcSG7C', NULL, '919876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '127.0.0.1', 0, NULL, NULL, NULL, '\'en\'', 0, '2025-11-24 06:38:32', '2025-11-24 07:31:57', 0, NULL, 0.00, 18.00),
(14, NULL, NULL, NULL, NULL, 1, NULL, 'light', 'user', NULL, NULL, NULL, '0', 0, '2025-12-01 17:45:06', NULL, 'Trabajador', NULL, 'tanzila', 'arstecht2a@gmail.com', NULL, NULL, '$2y$10$OLelSLqNBP26Kv47GRJpfuJ.vemGAYaZWQCo7R071hAyNBTs4AAxO', NULL, '919876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '127.0.0.1', 0, NULL, NULL, NULL, '\'en\'', 0, '2025-12-01 21:41:36', '2025-12-01 21:45:06', 0, 'ODY42L1K7W', 0.00, 18.00),
(15, NULL, NULL, NULL, NULL, 1, NULL, 'light', NULL, NULL, NULL, NULL, '0', 0, '2025-12-08 19:06:45', NULL, 'Trabajador', NULL, 'Demo Trader', 'demo@trader.com', NULL, '2025-12-06 22:31:52', '$2y$10$8wfR49IEv47Qx3PxreYOs.oO/S1vw0CeicI1n/DgrWNJBMTKQdTRu', NULL, '918817016704', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'bU1bduE5z2', NULL, 0, NULL, NULL, NULL, '\'en\'', 0, '2025-12-06 22:31:52', '2025-12-08 23:06:45', 0, NULL, 0.00, 18.00);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
