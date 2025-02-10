-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2024 at 09:46 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appraisal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8513 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `department_id`, `name`, `created_at`, `updated_at`) VALUES
(8507, 6508, '100 Group 1', '2023-12-18 01:49:50', '2023-12-18 01:49:50'),
(8508, 6508, '100 Group 2', '2023-12-18 01:49:58', '2023-12-18 01:49:58'),
(8509, 6500, '100 Group 1', '2023-12-18 01:50:11', '2023-12-18 01:50:11'),
(8510, 6500, '100 Group 2', '2023-12-18 01:50:18', '2023-12-18 01:50:18'),
(8511, 6500, '100 Group 3', '2023-12-18 01:50:25', '2023-12-18 01:50:25'),
(8512, 6500, '200 Group 1', '2023-12-18 01:50:45', '2023-12-18 01:50:45');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_id` bigint UNSIGNED NOT NULL,
  `course` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `course_code` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `course_type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_course_unique` (`course`),
  KEY `courses_department_id_foreign` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7503 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `course`, `course_code`, `course_type`, `description`, `created_at`, `updated_at`) VALUES
(7501, 6506, 'Introduction to Basic Education', 'PDR111', 'Educational', 'No comments for now', '2023-12-18 06:05:16', '2023-12-18 06:05:16'),
(7502, 6511, 'Introduction to Information & Communication I', 'GPD111', 'Educational', 'No comment for now', '2023-12-18 06:08:26', '2023-12-18 06:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `faculty_id` bigint UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_department_unique` (`department`),
  KEY `departments_faculty_id_foreign` (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6513 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `department`, `description`, `created_at`, `updated_at`) VALUES
(6500, 1502, 'Human Resource Management', 'No comments now', '2023-12-18 00:01:18', '2023-12-18 00:01:18'),
(6501, 1502, 'Accounting Education', 'No comments now', '2023-12-18 00:02:07', '2023-12-18 00:02:07'),
(6502, 1502, 'Procuirement & Supply Chain Management', 'No comments now', '2023-12-18 00:02:38', '2023-12-18 00:02:38'),
(6503, 1502, 'Industrul Marketing', 'No comments now', '2023-12-18 00:03:11', '2023-12-18 00:03:11'),
(6504, 1503, 'Political Science', 'No comments now', '2023-12-18 00:03:32', '2023-12-18 00:47:56'),
(6505, 1503, 'History Education', 'No comments now', '2023-12-18 00:03:50', '2023-12-18 00:03:50'),
(6506, 1503, 'Management Science Education', 'No comments now', '2023-12-18 00:04:18', '2023-12-18 00:04:18'),
(6507, 1508, 'Biology Education', 'No comments now', '2023-12-18 00:06:48', '2023-12-18 00:06:48'),
(6508, 1508, 'Chemistry Education', 'No comments now', '2023-12-18 00:06:59', '2023-12-18 00:06:59'),
(6509, 1508, 'Physics Education', 'No comments now', '2023-12-18 00:07:21', '2023-12-18 00:07:21'),
(6510, 1508, 'Integrated Science Education', 'No comments now', '2023-12-18 00:07:37', '2023-12-18 00:07:37'),
(6511, 1508, 'Information & Communication Technology Education', 'No comments now', '2023-12-18 00:08:13', '2023-12-18 00:08:13'),
(6512, 1507, 'Theatre Art Education', 'No comments now', '2023-12-18 00:08:38', '2023-12-18 00:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
CREATE TABLE IF NOT EXISTS `faculties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `faculty` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faculties_faculty_unique` (`faculty`)
) ENGINE=InnoDB AUTO_INCREMENT=1509 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty`, `description`, `created_at`, `updated_at`) VALUES
(1502, 'School of Business & Applied Management', 'No comments for now', '2023-12-17 21:19:21', '2023-12-17 21:19:21'),
(1503, 'Faculty of Scocial Science', 'No comments for now', '2023-12-17 21:37:06', '2023-12-17 21:37:06'),
(1505, 'Faculty of Foreign Languages', 'No comments now', '2023-12-18 00:04:54', '2023-12-18 00:04:54'),
(1506, 'Faculty of Ghanaian Languages Education', 'No comments now', '2023-12-18 00:05:20', '2023-12-18 00:05:20'),
(1507, 'School of Creatvie Art Education', 'No comments now', '2023-12-18 00:05:53', '2023-12-18 00:05:53'),
(1508, 'Faculty of Science Education', 'No comments now', '2023-12-18 00:06:11', '2023-12-18 00:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_16_133012_create_roles_table', 1),
(6, '2023_12_16_133131_create_faculties_table', 1),
(7, '2023_12_16_133239_create_departments_table', 1),
(8, '2023_12_16_133309_create_permissions_table', 1),
(9, '2023_12_16_133310_create_courses_table', 1),
(10, '2023_12_16_133311_create_classes_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `permission_key` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hook` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_permission_unique` (`permission`),
  UNIQUE KEY `permissions_permission_key_unique` (`permission_key`),
  KEY `permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2512 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `permission_key`, `description`, `hook`, `created_at`, `updated_at`) VALUES
(2508, 1513, 'View Departments', 'view-departments', 'No comment here', 'Private', '2023-12-17 20:22:54', '2023-12-17 20:39:34'),
(2510, 1514, 'View Classes', 'view-classes', 'No need to apologize', 'Public', '2023-12-17 20:25:13', '2023-12-17 20:25:13'),
(2511, 1512, 'System Config', 'system-config', 'No need to apologize', 'Private', '2023-12-17 20:25:37', '2023-12-17 20:25:37');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `hook` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_role_unique` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=1516 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`, `hook`, `created_at`, `updated_at`) VALUES
(1512, 'Student', 'No comment for now', 'Specify', '2023-12-17 20:13:15', '2023-12-17 20:13:15'),
(1513, 'Lecturer', 'No comment for now', 'Specify', '2023-12-17 20:13:36', '2023-12-17 20:13:36'),
(1514, 'HOD', 'No comment for now', 'Specify', '2023-12-17 20:14:03', '2023-12-17 20:14:03'),
(1515, 'Dean', 'No comment for now', 'Private', '2023-12-17 20:14:56', '2023-12-17 20:14:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
