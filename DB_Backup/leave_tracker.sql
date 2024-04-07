-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.27-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for leave_tracker
CREATE DATABASE IF NOT EXISTS `leave_tracker` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `leave_tracker`;

-- Dumping structure for table leave_tracker.global_settings
DROP TABLE IF EXISTS `global_settings`;
CREATE TABLE IF NOT EXISTS `global_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `reg_prefix` varchar(255) NOT NULL,
  `institute_email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `currency_symbol` varchar(100) NOT NULL,
  `sms_service_provider` varchar(100) NOT NULL,
  `session_id` int(11) NOT NULL,
  `translation` varchar(100) NOT NULL,
  `footer_text` varchar(255) NOT NULL,
  `animations` varchar(100) NOT NULL,
  `timezone` varchar(100) NOT NULL,
  `date_format` varchar(100) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `twitter_url` varchar(255) NOT NULL,
  `linkedin_url` varchar(255) NOT NULL,
  `youtube_url` varchar(255) NOT NULL,
  `cron_secret_key` varchar(255) DEFAULT NULL,
  `preloader_backend` tinyint(1) NOT NULL DEFAULT 1,
  `footer_branch_switcher` tinyint(1) NOT NULL DEFAULT 1,
  `cms_default_branch` int(11) NOT NULL,
  `image_extension` text DEFAULT NULL,
  `image_size` float NOT NULL DEFAULT 1024,
  `file_extension` text DEFAULT NULL,
  `file_size` float DEFAULT 1024,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table leave_tracker.global_settings: ~1 rows (approximately)
DELETE FROM `global_settings`;
/*!40000 ALTER TABLE `global_settings` DISABLE KEYS */;
INSERT INTO `global_settings` (`id`, `institute_name`, `institution_code`, `reg_prefix`, `institute_email`, `address`, `mobileno`, `currency`, `currency_symbol`, `sms_service_provider`, `session_id`, `translation`, `footer_text`, `animations`, `timezone`, `date_format`, `facebook_url`, `twitter_url`, `linkedin_url`, `youtube_url`, `cron_secret_key`, `preloader_backend`, `footer_branch_switcher`, `cms_default_branch`, `image_extension`, `image_size`, `file_extension`, `file_size`, `created_at`, `updated_at`) VALUES
	(1, 'Dreamers Academy', 'RSM-', 'on', 'dreamers@example.com', '', '', 'USD', '$', 'disabled', 6, 'english', '© 2024 Leave Tracker Management - Developed by Bakibillah', 'fadeInUp', 'Asia/Dhaka', 'd.M.Y', '', '', '', '', '', 1, 1, 1, 'jpeg, jpg, bmp, png, mov, mp4', 300000, 'txt, pdf, doc, xls, docx, xlsx, jpg, jpeg, png, gif, bmp, zip, mp4, 7z, wmv, rar, mov', 300000, '2018-10-22 15:07:49', '2023-04-20 22:37:06');
/*!40000 ALTER TABLE `global_settings` ENABLE KEYS */;

-- Dumping structure for table leave_tracker.leave_application
DROP TABLE IF EXISTS `leave_application`;
CREATE TABLE IF NOT EXISTS `leave_application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(2) NOT NULL,
  `reason` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `leave_days` varchar(20) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1 COMMENT '1=pending,2=approved 3=rejected',
  `apply_date` date DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `rejected_by` int(11) DEFAULT NULL,
  `orig_file_name` varchar(255) DEFAULT NULL,
  `enc_file_name` varchar(255) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `attachment_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table leave_tracker.leave_application: ~1 rows (approximately)
DELETE FROM `leave_application`;
/*!40000 ALTER TABLE `leave_application` DISABLE KEYS */;
INSERT INTO `leave_application` (`id`, `user_id`, `category_id`, `reason`, `start_date`, `end_date`, `leave_days`, `status`, `apply_date`, `approved_by`, `rejected_by`, `orig_file_name`, `enc_file_name`, `comments`, `attachment_file`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, '', '2024-04-07', '2024-04-08', '2', 2, '2024-04-06', 1, NULL, NULL, NULL, '', NULL, '2024-04-06 08:27:19', '2024-04-07 02:20:31');
/*!40000 ALTER TABLE `leave_application` ENABLE KEYS */;

-- Dumping structure for table leave_tracker.leave_category
DROP TABLE IF EXISTS `leave_category`;
CREATE TABLE IF NOT EXISTS `leave_category` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `role_id` tinyint(1) NOT NULL,
  `days` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table leave_tracker.leave_category: ~3 rows (approximately)
DELETE FROM `leave_category`;
/*!40000 ALTER TABLE `leave_category` DISABLE KEYS */;
INSERT INTO `leave_category` (`id`, `name`, `role_id`, `days`) VALUES
	(1, 'Casual leave', 0, 10),
	(2, 'Sick Leave', 0, 15),
	(3, 'Emergency Leave', 0, 20);
/*!40000 ALTER TABLE `leave_category` ENABLE KEYS */;

-- Dumping structure for table leave_tracker.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `prefix` varchar(50) DEFAULT NULL,
  `is_system` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table leave_tracker.roles: ~3 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `prefix`, `is_system`) VALUES
	(1, 'Super Admin', 'superadmin', '1'),
	(2, 'Teacher', 'teacher', '1'),
	(3, 'Student', 'student', '1');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table leave_tracker.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(3) DEFAULT 4,
  `branch_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` char(1) DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table leave_tracker.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `role`, `branch_id`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'Superadmin', 'superadmin@gmail.com', 1, 1, NULL, '$2y$10$VyOK2cd8sxWg.ryC.k6X6Of/V9em4X1QBdcgRrKiHOaJuqsaY3s3y', 'tqDWAtGVwIl4N3uHH0tDHPrL8ZreRZzOW9x8YUnHDazTsc1HPjMaru1URUha', 'Y', '2023-06-01 18:42:02', '2023-06-01 18:42:02'),
	(2, 'Bakibillah', 'bakibillah@gmail.com', 4, NULL, NULL, '$2y$10$m.Eh5mhQbSsRMXEcPUKO6uNj78PXKvqqOd7sZ0mUmeexjkq7sIgOq', NULL, 'Y', '2024-04-06 02:57:52', '2024-04-06 05:32:31'),
	(3, 'Baki', 'bakibillah920@gmail.com', 4, NULL, NULL, '$2y$10$WKmuPikKyF8n7t72Fspvc.voaMOPDTY9pond/jy1Y6IbWHjx3zTX6', NULL, 'N', '2024-04-06 03:19:34', '2024-04-06 05:46:59');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
