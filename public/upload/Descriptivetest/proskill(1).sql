-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2022 at 05:43 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proskill`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shortNews` int(11) NOT NULL DEFAULT '0',
  `titleTwo` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publishDate` datetime DEFAULT NULL,
  `imageAlt` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyWords` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article_Group_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mainContent` text COLLATE utf8mb4_unicode_ci,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `shortNews`, `titleTwo`, `publishDate`, `imageAlt`, `url`, `source`, `metaDescription`, `metaKeyWords`, `user_id`, `tag`, `article_Group_id`, `image`, `mainContent`, `summary`, `active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'همکاری جک دورسی و جی زی برای برنامه آموزشی بیت کوین در بروکلین', 0, 'برنامه آموزشی بیت کوین در بروکلین 22', '1401-03-09 00:00:00', 'amir.jpeg', '4724', 'cointelegraph.com', 'همکاری جک دورسی و جی زی', 'بیت کوین', 10, '2,3', 3, 'Onmyk_f0.jpg', 'پس از دو فصل بازی در پرسپولیس و تجربه یک قهرمانی در لیگ برتر و سوپر جام و نایب&zwnj;قهرمانی در لیگ قهرمانان آسیا و لیگ، از این تیم جدا شد تا با خیال راحت&zwnj; باشگاه بعدی خود را انتخاب کند.\r\n\r\nحامد لک که در زمان پیوستن به پرسپولیس نیز مثل روز جدایی جلسه کوتاه مدتی با مدیرعامل این باشگاه داشت، حالا احتمالا تیمی را انتخاب می&zwnj;کند که شرایط حضور در جمع مدعیان را داشته باشد و دوباره بتواند در آن تیم خودی نشان بدهد.\r\n\r\nاین دروازه&zwnj;بان در شرایطی قراردادش با پرسپولیس را فسخ کرد که نخستین بازیکن جدا شده این تیم در نقل و انتقالات تابستانی لقب گرفت و زودتر از نفراتی که صحبت جدایی&zwnj;شان مطرح بود، از پرسپولیس جدا شد.', '', 0, NULL, '2022-06-11 12:35:10', '2022-06-11 13:09:38');

-- --------------------------------------------------------

--
-- Table structure for table `article_groups`
--

DROP TABLE IF EXISTS `article_groups`;
CREATE TABLE IF NOT EXISTS `article_groups` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `shortNews` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_groups`
--

INSERT INTO `article_groups` (`id`, `title`, `url`, `menu_id`, `shortNews`, `created_at`, `updated_at`) VALUES
(1, 'اقتصادی', NULL, 2, 0, '2022-06-10 09:41:39', '2022-06-10 09:41:39'),
(2, 'بانک ها', 'banks', 2, 0, '2022-06-10 09:44:10', '2022-06-10 09:44:10'),
(3, 'فناوری', 'www.aparat.com', 2, 1, '2022-06-10 09:45:33', '2022-06-10 10:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `imageAlt` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subMenu_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `url`, `priority`, `imageAlt`, `parent_id`, `symbol`, `image`, `subMenu_id`, `created_at`, `updated_at`) VALUES
(2, 'اخبار', 'category/news', 2, 'news.jpeg', NULL, NULL, 'fish.jpg', 1, '2022-06-10 07:23:12', '2022-06-10 08:25:54'),
(3, 'دلار آمریکا', 'category\\news', 1, NULL, 'اخبار', NULL, NULL, 2, '2022-06-10 07:29:23', '2022-06-10 08:26:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_06_08_133801_create_permission_tables', 2),
(7, '2022_06_09_081535_update_users_table', 3),
(12, '2022_06_10_083425_create_menus_table', 4),
(13, '2022_06_10_085142_create_sub_menus_table', 4),
(14, '2022_06_10_133912_create_article_groups_table', 5),
(15, '2022_06_11_064636_create_tags_table', 6),
(19, '2022_06_11_111409_create_articles_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 10),
(3, 'App\\User', 2),
(6, 'App\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(8, 'تحلیلگر', 'web', '2022-06-09 07:51:59', '2022-06-09 07:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ادمین', 'web', '2022-06-08 11:08:30', '2022-06-09 10:34:46'),
(3, 'نویسنده', 'web', '2022-06-08 11:11:00', '2022-06-09 10:35:01'),
(6, 'کاربر', 'web', '2022-06-09 05:31:17', '2022-06-09 05:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menus`
--

DROP TABLE IF EXISTS `sub_menus`;
CREATE TABLE IF NOT EXISTS `sub_menus` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `systemTitle` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menus`
--

INSERT INTO `sub_menus` (`id`, `title`, `systemTitle`, `created_at`, `updated_at`) VALUES
(1, 'منو اصلی', 'header', '2022-06-10 07:18:44', '2022-06-10 07:18:44'),
(2, 'دسترسی سریع', 'quickAccess', '2022-06-10 07:23:49', '2022-06-10 07:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `topDescription` text COLLATE utf8mb4_unicode_ci,
  `bottomDescription` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `url`, `topDescription`, `bottomDescription`, `created_at`, `updated_at`) VALUES
(2, 'بیت کوین', 'category/index', 'ویرایش را شروع کنید', 'ویرایش را شروع کنید', '2022-06-11 08:52:56', '2022-06-11 08:52:56'),
(3, 'طلا', 'gold', 'ویرایش را شروع کنید', 'ویرایش را شروع کنید', '2022-06-11 08:53:54', '2022-06-11 08:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstName` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phoneNumber` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `nationalCode` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `firstName`, `email`, `phone`, `image`, `phoneNumber`, `email_verified_at`, `password`, `active`, `nationalCode`, `remember_token`, `created_at`, `updated_at`) VALUES
(10, 'admin', NULL, NULL, 'admin@gmail.com', NULL, 'user-default-profile.jpg', '09126646164', NULL, '$2y$10$vr2dTKuKIwtf6UrX9eybveNmUla/Fn1UVdcBUEX25HXBwSX2YEHoy', 0, NULL, NULL, '2022-06-09 13:58:42', '2022-06-09 14:04:23'),
(2, 'AmirSadr', NULL, NULL, 'amir@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$I2IPWTF51iE/lo2BX.9cNuc6KAejXIqHCRdg3yd3wk7w4z4WcYcmK', 1, NULL, NULL, '2022-06-08 07:38:24', '2022-06-09 09:05:20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
