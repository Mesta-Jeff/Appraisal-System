-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2024 at 08:59 AM
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
-- Database: `skai_appraisal`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1500, 'Level 200', 'No Description', 'Active', '2024-07-07 15:55:08', '2024-07-07 17:32:31', 'No'),
(1501, 'Level 100', 'No Description', 'Active', '2024-07-07 15:56:48', '2024-07-07 17:32:22', 'No'),
(1502, 'Level 800', 'No Description', 'Active', '2024-07-08 06:13:16', '2024-07-08 06:13:16', 'No'),
(1503, 'Level 500', 'No Description', 'Active', '2024-07-08 06:13:38', '2024-07-08 06:13:54', 'No'),
(1507, 'Level 300', 'No Description', 'Active', '2024-07-24 12:08:37', '2024-07-24 12:08:37', 'No'),
(1508, 'Level 400', 'No Description', 'Active', '2024-07-24 12:08:50', '2024-07-24 12:08:50', 'No'),
(1509, 'Graduated', 'No Description', 'Active', '2024-07-24 12:27:31', '2024-07-24 12:27:31', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programme_id` bigint(20) UNSIGNED NOT NULL,
  `course` varchar(255) NOT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `course_type` varchar(255) DEFAULT NULL,
  `accessors` text DEFAULT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `programme_id`, `course`, `course_code`, `course_type`, `accessors`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(7500, 5501, 'Introduction to computer programming', 'ICTE213', 'Faculty', '6503,6500,6501', 'I will later do this', 'Active', '2024-07-07 08:39:42', '2024-07-07 13:12:51', 'No'),
(7501, 5500, 'Introduction to Organic Chemistry', 'CHM213', 'Departmental', NULL, 'Later will do all these', 'Active', '2024-07-07 09:54:27', '2024-07-07 12:13:56', 'No'),
(7502, 5500, 'Middle line chemistry III', 'CHM113', 'Departmental', NULL, 'Later issues here will find out', 'Active', '2024-07-07 10:07:43', '2024-07-07 11:33:31', 'No'),
(7503, 5505, 'Guidance and counseling', 'EDCR321', 'General', NULL, 'Later will see all these', 'Active', '2024-07-07 10:14:09', '2024-07-07 10:14:09', 'No'),
(7504, 5501, 'Computer System and Applications', 'ICTE111', 'Departmental', NULL, 'Later will do this', 'Active', '2024-07-09 12:54:03', '2024-07-09 12:54:03', 'No'),
(7505, 5501, 'Multimedia Authoring Tools in Education', 'ICT112E', 'Departmental', NULL, 'Later will do this', 'Active', '2024-07-09 12:56:15', '2024-07-09 12:56:15', 'No'),
(7506, 5501, 'PC Maintainance and Laboratory Management', 'ICT116', 'Departmental', NULL, 'Later will do this', 'Active', '2024-07-09 12:58:30', '2024-07-09 12:58:30', 'No'),
(7507, 5501, 'Technology and Project Management II', 'ICTE114', 'Departmental', NULL, 'Later will do this', 'Active', '2024-07-09 12:59:35', '2024-07-09 12:59:35', 'No'),
(7508, 5506, 'Introducation to Meta data', 'FES122', 'Faculty', '6503,6500,6501,6502', 'Later will fix all these', 'Active', '2024-09-24 10:54:00', '2024-09-24 10:54:33', 'No'),
(7509, 5506, 'Introduction to Agro Biology', 'BIO231', 'Departmental', NULL, 'Biology Students only', 'Active', '2024-10-02 10:02:10', '2024-10-02 10:02:10', 'No'),
(7510, 5507, 'Introduction to Basic French', 'FTR112', 'Departmental', NULL, 'Nothing', 'Active', '2024-10-03 13:13:42', '2024-10-03 13:13:42', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faculty_id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `department`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(6500, 1300, 'ICT Education', 'Will do this later', 'Active', '2024-07-05 10:14:13', '2024-07-05 16:26:20', 'No'),
(6501, 1300, 'Biology Education', 'Will do this later', 'Active', '2024-07-05 10:14:32', '2024-07-05 10:14:32', 'No'),
(6502, 1300, 'Chemistry Education', 'Will do this later', 'Active', '2024-07-05 10:18:52', '2024-07-05 10:18:52', 'No'),
(6503, 1300, 'Physics Education', 'Will do this later', 'Active', '2024-07-05 10:19:08', '2024-07-05 10:19:08', 'No'),
(6504, 1301, 'Geography Education', 'Will do this later', 'Active', '2024-07-05 10:19:50', '2024-07-05 10:19:50', 'No'),
(6505, 1301, 'Social Studies Education', 'Will do this later', 'Active', '2024-07-05 10:20:08', '2024-07-05 10:20:08', 'No'),
(6506, 1301, 'Political Science Education', 'Will do this later', 'Active', '2024-07-05 10:20:42', '2024-07-05 10:20:42', 'No'),
(6507, 1303, 'Management Sciences', 'Will do this later', 'Active', '2024-07-05 10:21:04', '2024-07-05 10:21:04', 'No'),
(6508, 1303, 'Accounting', 'Will do this later on', 'Active', '2024-07-05 10:21:24', '2024-07-05 16:46:03', 'No'),
(6509, 1303, 'Industral Marketing', 'Will do this later', 'Active', '2024-07-05 10:22:43', '2024-07-05 10:22:43', 'No'),
(6510, 1304, 'Art Education', 'Will do this later', 'Active', '2024-07-05 10:23:04', '2024-07-05 10:23:04', 'No'),
(6511, 1305, 'UEW', 'Later', 'Active', '2024-09-23 08:55:44', '2024-09-23 08:55:44', 'No'),
(6512, 1306, 'French Education', 'Later', 'Active', '2024-10-03 13:07:00', '2024-10-03 13:07:00', 'No'),
(6513, 1306, 'Linguistics', 'Nothing', 'Active', '2024-10-03 13:33:05', '2024-10-03 13:33:05', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1300, 'Faculty of Science Educaton', 'Later will do this not now', 'Active', '2024-07-05 09:46:39', '2024-07-05 10:05:48', 'No'),
(1301, 'Faculty of Social Science Educaton', 'Later will do this not now', 'Active', '2024-07-05 09:47:53', '2024-07-05 09:47:53', 'No'),
(1302, 'Schoool of Excellent and Long Learning', 'Later will do this not now', 'Active', '2024-07-05 10:05:07', '2024-07-05 10:05:07', 'No'),
(1303, 'School of Business', 'Later will do this not now on', 'Active', '2024-07-05 10:05:32', '2024-07-05 16:45:10', 'No'),
(1304, 'School of Creative Arts', 'I will do this later', 'Active', '2024-07-05 10:09:37', '2024-07-05 10:09:37', 'No'),
(1305, 'UEW', 'Later', 'Active', '2024-09-23 08:54:44', '2024-09-23 08:54:44', 'No'),
(1306, 'Faculty of foreign Languages', 'Nothing', 'Active', '2024-10-03 13:06:18', '2024-10-03 13:06:18', 'No');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` varchar(15) DEFAULT NULL,
  `title` varchar(15) NOT NULL,
  `initials` varchar(10) DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'Full-Time',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `staff_id`, `title`, `initials`, `department_id`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `phone`, `email`, `profile`, `role_id`, `type`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1102, 'WGUE46207', 'Dr.', 'NAS', 6500, 'Solomon', 'Ayisi', 'Nana', 'Male', '1999-02-04', '0545126024', 'lecturer@uew.edu.gh1', NULL, 501, 'Full-Time', 'Active', '2024-08-01 05:00:15', '2024-08-01 05:00:15', 'No'),
(1103, 'WGUE46208', 'Prof.', 'BAD', 6500, 'Desmond', 'Agyemang', 'Boateng', 'Male', '1999-02-05', '0545126025', 'lecturer@uew.edu.gh2', NULL, 501, 'Full-Time', 'Active', '2024-08-01 05:00:16', '2024-08-01 05:00:16', 'No'),
(1104, 'WGUE46209', 'Dr.', 'ABG', 6500, 'Grace', 'Badu', 'Awuni', 'Female', '1999-02-06', '0545126026', 'lecturer@uew.edu.gh3', NULL, 501, 'Full-Time', 'Active', '2024-08-01 05:00:16', '2024-08-01 05:00:16', 'No'),
(1149, 'WGUE46254', 'Prof.', 'AAI', 6501, 'Irene', 'Afia', 'Amponsah', 'Female', '1999-03-23', '0545126071', 'lecturer@uew.edu.gh48', NULL, 501, 'Full-Time', 'Active', '2024-08-01 05:00:34', '2024-08-01 05:00:34', 'No'),
(1150, 'WGUE46255', 'Dr.', 'BKP', 6501, 'Paul', 'Kwame', 'Boateng', 'Male', '1999-03-24', '0545126072', 'lecturer@uew.edu.gh49', NULL, 501, 'Full-Time', 'Active', '2024-08-01 05:00:35', '2024-08-01 05:00:35', 'No'),
(1151, 'WGUE46256', 'Prof.', 'DAH', 6501, 'Hannah', 'Akosua', 'Duah', 'Female', '1999-03-25', '0545126073', 'lecturer@uew.edu.gh50', NULL, 501, 'Full-Time', 'Active', '2024-08-01 05:00:35', '2024-08-01 05:00:35', 'No'),
(1154, 'DEV2021', 'Mr', 'DMT', 6511, 'The', 'Main', 'Developer', 'Male', '1999-12-20', '0245482021', 'mdevelper@st.uew.edu.gh', NULL, 500, 'Full-Time', 'Active', '2024-09-23 10:20:12', '2024-09-23 10:20:12', 'No'),
(1155, 'DEV2022', 'Mr', 'DNT', 6511, 'The', 'Next', 'Developer', 'Male', '1999-12-20', '0245482022', 'ndevelper@st.uew.edu.gh', NULL, 500, 'Full-Time', 'Active', '2024-09-23 10:20:51', '2024-09-23 10:20:51', 'No'),
(1156, 'QAD2031', 'Mr', 'AQF', 6511, 'First', 'Quality', 'Assurance', 'Male', '1999-12-10', '0245482031', 'qad1@st.uew.edu.gh', NULL, 504, 'Full-Time', 'Active', '2024-09-23 10:57:50', '2024-09-23 10:57:50', 'No'),
(1157, 'DEAN2041', 'Mrs', 'ADM', 6502, 'Main', 'Dean', 'Affairs', 'Female', '1994-10-20', '0245482041', 'mdean@st.uew.edu.gh', NULL, 505, 'Full-Time', 'Active', '2024-09-23 13:42:51', '2024-09-23 13:42:51', 'No'),
(1158, 'HOD2051', 'Ms', 'IOH', 6500, 'HOD', 'Of', 'ICT', 'Female', '1999-06-30', '0245482051', 'hodict@st.uew.edu.gh', NULL, 506, 'Full-Time', 'Active', '2024-09-23 15:41:35', '2024-09-23 15:41:35', 'No'),
(1159, 'HOD2052', 'Prof', 'BFH', 6501, 'HOD', 'For', 'Biology', 'Female', '1984-10-29', '0245482052', 'hodbiology@st.uew.edu.gh', NULL, 506, 'Full-Time', 'Active', '2024-10-02 09:46:10', '2024-10-02 09:46:10', 'No'),
(1160, 'DEAN2042', 'Mrs', 'FFD', 6512, 'Dean', 'For', 'French', 'Female', '1999-02-15', '0245482042', 'dean.french@st.uew.edu.gh', NULL, 505, 'Full-Time', 'Active', '2024-10-03 13:27:30', '2024-10-03 13:27:30', 'No'),
(1161, 'HOD2036', 'Mr', 'MKB', 6512, 'Bens', 'Kusi', 'Mensah', 'Male', '1999-12-10', '0245482036', 'kusi.hod@st.uew.edu.gh', NULL, 506, 'Full-Time', 'Active', '2024-10-03 13:31:42', '2024-10-03 13:31:42', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_courses`
--

CREATE TABLE `lecturer_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_course_id` bigint(20) UNSIGNED NOT NULL,
  `lecturer_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturer_courses`
--

INSERT INTO `lecturer_courses` (`id`, `session_course_id`, `lecturer_id`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2000, 2531, 1104, 'Will manage this course for the semester', 'Active', '2024-10-02 04:53:02', '2024-10-02 04:53:02', 'No'),
(2001, 2533, 1102, 'Will course for this course this semester', 'Active', '2024-10-02 07:03:32', '2024-10-02 08:10:47', 'No'),
(2004, 2534, 1149, 'Will care for this course', 'Active', '2024-10-02 10:04:15', '2024-10-02 10:04:15', 'No'),
(2005, 2534, 1150, 'Will care for this course', 'Active', '2024-10-02 10:04:56', '2024-10-02 10:04:56', 'No'),
(2006, 2535, 1103, 'Later', 'Active', '2024-10-02 10:16:46', '2024-10-02 10:16:46', 'No'),
(2007, 2536, 1151, 'Later will see this', 'Active', '2024-10-02 11:40:44', '2024-10-02 11:40:44', 'No'),
(2008, 2531, 1103, 'Will check this later', 'Active', '2024-10-03 03:46:14', '2024-10-03 03:46:14', 'No'),
(2009, 2532, 1158, 'Will check this later', 'Active', '2024-10-03 03:46:49', '2024-10-03 03:46:49', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `loginsessions`
--

CREATE TABLE `loginsessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date` date NOT NULL,
  `time_in` varchar(13) DEFAULT NULL,
  `time_out` varchar(13) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_roles_table', 1),
(2, '2014_10_12_000001_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_16_133131_create_faculties_table', 1),
(7, '2023_12_16_133239_create_departments_table', 1),
(8, '2023_12_16_133309_create_permissions_table', 1),
(9, '2023_12_16_133313_create_programmes_table', 1),
(10, '2023_12_16_133314_create_courses_table', 1),
(11, '2023_12_16_133315_create_classes_table', 1),
(14, '2024_07_03_051443_create_sessions_table', 1),
(15, '2024_07_03_051853_create_semesters_table', 1),
(16, '2024_07_03_123730_create_session_semesters_table', 1),
(17, '2024_07_03_123745_create_session_courses_table', 1),
(19, '2024_07_03_124212_create_user_permissions_table', 1),
(21, '2024_07_03_051407_create_students_table', 2),
(22, '2024_07_05_060959_create_student_courses_table', 2),
(27, '2024_07_03_051422_create_lecturers_table', 3),
(28, '2024_07_03_123900_create_lecturer_courses_table', 3),
(29, '2024_08_04_103402_create_sections_table', 4),
(30, '2024_08_04_103403_create_options_table', 4),
(31, '2024_08_04_103403_create_questions_table', 5),
(32, '2024_08_04_103405_create_question_options_table', 6),
(33, '2024_08_04_103406_create_responses_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_text`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Most Agree', '2024-08-05 05:16:26', '2024-08-05 05:16:26', 'No'),
(2, 'True', '2024-08-05 06:59:12', '2024-08-05 06:59:12', 'No'),
(3, 'False', '2024-08-05 06:59:29', '2024-08-05 06:59:29', 'No'),
(6, 'Very Bad', '2024-08-05 07:00:51', '2024-08-05 07:02:28', 'No'),
(7, 'Agree', '2024-08-05 07:06:37', '2024-08-05 07:06:37', 'No'),
(10, 'Short Answer', '2024-09-22 09:21:35', '2024-09-22 09:21:35', 'No'),
(11, 'Descriptive', '2024-09-22 09:22:22', '2024-09-22 09:22:22', 'No'),
(12, 'Essay', '2024-09-22 09:23:32', '2024-09-22 09:23:32', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `permission_key` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `hook` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `permission`, `permission_key`, `description`, `hook`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2500, 500, 'Users Account', 'users-account', 'Later will look into this', 'Public', 'Active', '2024-07-05 07:49:01', '2024-07-05 07:49:01', 'No'),
(2501, 500, 'View Students', 'view-students', 'Later will look into this', 'Public', 'Active', '2024-07-05 07:49:21', '2024-07-05 07:49:21', 'No'),
(2502, 500, 'View Roles', 'view-roles', 'Later will look into this', 'Private', 'Active', '2024-07-05 07:49:35', '2024-07-05 07:49:35', 'No');

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
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `programme` varchar(255) NOT NULL,
  `duration` varchar(15) NOT NULL DEFAULT '4 Years',
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `department_id`, `programme`, `duration`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(5500, 6502, 'BSc Chemistry Education', '4 Years', 'I will later do all these complete', 'Active', '2024-07-05 15:32:28', '2024-07-05 18:16:50', 'No'),
(5501, 6500, 'BSc Information & Communication Technology Education', '4 Years', 'I will later do all these', 'Active', '2024-07-05 15:36:28', '2024-07-05 15:36:28', 'No'),
(5503, 6505, 'BEd Biology Education', '4 Years', 'I will later do all these', 'Active', '2024-07-05 15:39:51', '2024-07-05 15:39:51', 'No'),
(5504, 6504, 'BsS Industral Economics', '4 Years', 'Later will look at this', 'Active', '2024-07-06 17:25:40', '2024-07-06 17:26:53', 'No'),
(5505, 6505, 'BeD Psycological Education', '4 Years', 'Later will look at this', 'Active', '2024-07-06 17:26:31', '2024-07-06 17:26:31', 'No'),
(5506, 6501, 'BSc Biology Education', '4 Years', 'Later will do this', 'Active', '2024-07-25 03:38:17', '2024-07-25 03:56:43', 'No'),
(5507, 6512, 'BeA French Education', '4 Years', 'Nothing', 'Active', '2024-10-03 13:10:39', '2024-10-03 13:10:39', 'No'),
(5508, 6513, 'BEa Linguistics Education', '4 Years', 'NOthing', 'Active', '2024-10-03 13:34:18', '2024-10-03 13:34:18', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `question_for` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `section_id`, `question_text`, `question_for`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 'Which of the following is the state mind of assurance or the mondays', 'Student', '2024-08-04 17:35:30', '2024-08-04 17:35:30', 'No'),
(2, 1, 'The second house of the question is the traditional look ups of the bronze to all the names', 'Student', '2024-08-05 04:25:19', '2024-08-05 04:25:19', 'No'),
(3, 4, 'Philadelphia alone on the guard', 'Student', '2024-08-05 04:26:19', '2024-08-05 04:27:19', 'Yes'),
(4, 1, 'Call the bad man to the poor man from the house will set out to the odds', 'Student', '2024-08-06 15:04:27', '2024-08-06 15:04:27', 'No'),
(5, 2, 'Call the agenda boys to come to the whats-app groups', 'Student', '2024-08-06 15:07:11', '2024-08-06 15:07:11', 'No'),
(6, 2, 'Loking at the three some', 'Student', '2024-09-10 14:30:32', '2024-09-10 15:54:54', 'No'),
(7, 1, 'Which of the following is a hoop data', 'Student', '2024-09-10 15:50:38', '2024-09-10 15:50:38', 'No'),
(8, 1, 'Naturlize the cause in a loop', 'Student', '2024-09-10 15:50:39', '2024-09-10 16:17:33', 'Yes'),
(9, 1, 'Set the data road', 'Student', '2024-09-10 15:50:40', '2024-09-10 16:17:25', 'Yes'),
(10, 2, 'asdfghjkgffgfgfg', 'Student', '2024-10-03 13:20:53', '2024-10-03 13:21:09', 'Yes'),
(11, 2, 'Whos is you...?', 'Student', '2024-10-03 13:22:49', '2024-10-03 13:22:49', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `option_id`, `question_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 7, 2, '2024-08-05 17:15:31', '2024-08-05 17:15:31', 'No'),
(2, 3, 1, '2024-08-06 11:21:09', '2024-08-06 11:21:09', 'No'),
(3, 2, 1, '2024-08-06 11:21:22', '2024-08-06 11:21:22', 'No'),
(4, 6, 1, '2024-08-06 11:21:34', '2024-08-06 11:21:34', 'No'),
(5, 1, 2, '2024-08-06 11:21:50', '2024-08-06 11:21:50', 'No'),
(6, 2, 4, '2024-08-06 15:49:51', '2024-08-06 15:49:51', 'No'),
(7, 3, 4, '2024-08-06 15:49:59', '2024-08-06 15:49:59', 'No'),
(8, 3, 5, '2024-08-06 15:50:26', '2024-08-06 15:50:26', 'No'),
(9, 2, 5, '2024-08-06 15:50:35', '2024-08-06 15:50:35', 'No'),
(10, 10, 6, '2024-09-22 09:24:22', '2024-09-22 09:24:22', 'No'),
(11, 10, 7, '2024-09-22 09:24:47', '2024-09-22 09:24:47', 'No'),
(12, 11, 7, '2024-09-22 09:24:57', '2024-09-22 09:24:57', 'No'),
(13, 10, 11, '2024-10-03 13:23:44', '2024-10-03 13:23:44', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `response_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `session_course_id` bigint(20) UNSIGNED NOT NULL,
  `lecturer_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `question_option_id` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `hook` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`, `hook`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(500, 'Developer', 'Later I will look into this', 'Private', 'Active', '2024-07-05 07:06:04', '2024-07-05 07:07:11', 'No'),
(501, 'Lecturer', 'Later I will look into this', 'Specify', 'Active', '2024-07-05 07:06:44', '2024-07-05 07:06:44', 'No'),
(502, 'Student', 'Later I will look into this', 'Specify', 'Active', '2024-07-05 07:07:00', '2024-07-05 07:07:00', 'No'),
(503, 'Administrator', 'Admin', 'Specify', 'Active', '2024-08-06 13:25:44', '2024-08-06 13:25:44', 'No'),
(504, 'Head QA', 'From Quality and Assurance', 'Private', 'Active', '2024-09-23 10:52:15', '2024-09-23 10:52:15', 'No'),
(505, 'Dean', 'From Faculty', 'Public', 'Active', '2024-09-23 10:52:51', '2024-09-23 10:52:51', 'No'),
(506, 'HOD', 'From Department', 'Public', 'Active', '2024-09-23 10:53:38', '2024-09-23 10:53:38', 'No'),
(507, 'Officer', 'From Department', 'Public', 'Active', '2024-09-23 10:53:59', '2024-09-23 10:53:59', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `section` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`, `section`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'SECTION A', 'Subject Area Review Statement', '2024-08-04 11:04:12', '2024-08-04 12:16:49', 'No'),
(2, 'SECTION B', 'Lecturer Attendance and Delivery', '2024-08-04 12:04:10', '2024-08-04 12:04:10', 'No'),
(3, 'AD', 'AD', '2024-08-04 12:17:11', '2024-08-04 12:17:17', 'Yes'),
(4, 'SECTION C', 'Awareness and stationary rotations', '2024-08-04 12:26:50', '2024-08-04 12:26:50', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2500, 'Semester 1', 'Later i will do this', 'Active', '2024-07-06 16:54:44', '2024-07-06 16:54:44', 'No'),
(2501, 'Semester 2', 'Later i will do this', 'Active', '2024-07-06 16:55:11', '2024-07-06 16:55:11', 'No'),
(2506, 'Semester 3', 'Later will fix this', 'Active', '2024-07-24 11:58:37', '2024-07-24 11:58:37', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `begins` date NOT NULL,
  `ends` date NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `begins`, `ends`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2000, '2024/2025 Academic Year', '2024-10-01', '2025-09-30', 'I will look into this later on', 'Active', '2024-07-06 12:01:30', '2024-09-24 07:30:09', 'No'),
(2001, '2023/2024 Academic Year', '2023-01-09', '2024-10-10', 'I will look into this later', 'Mounted', '2024-07-06 12:16:35', '2024-07-06 12:16:35', 'No'),
(2002, '2025/2027 Academic Year', '2025-10-20', '2027-10-20', 'Later', 'Active', '2024-09-24 14:29:18', '2024-09-24 14:34:38', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `session_courses`
--

CREATE TABLE `session_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `programme_id` bigint(20) UNSIGNED DEFAULT NULL,
  `classes_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `session_semester_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT '\'No Description\'',
  `status` varchar(10) NOT NULL DEFAULT 'Unmounted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session_courses`
--

INSERT INTO `session_courses` (`id`, `programme_id`, `classes_id`, `course_id`, `session_semester_id`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2531, 5501, 1501, 7507, 2500, 'All these will be done later', 'Mounted', '2024-09-24 14:56:21', '2024-09-24 16:36:54', 'No'),
(2532, 5501, 1501, 7504, 2500, 'All these will be done later', 'Mounted', '2024-09-24 14:56:21', '2024-09-24 14:56:21', 'No'),
(2533, 5501, 1501, 7503, 2500, 'Later will fix this', 'Mounted', '2024-09-24 17:57:23', '2024-09-24 17:57:23', 'No'),
(2534, 5506, 1501, 7509, 2500, 'Biology Students', 'Mounted', '2024-10-02 10:03:04', '2024-10-02 10:03:04', 'No'),
(2535, 5506, 1501, 7508, 2500, 'Biology Students', 'Mounted', '2024-10-02 10:03:04', '2024-10-02 10:03:04', 'No'),
(2536, 5506, 1501, 7503, 2500, 'Later will do', 'Mounted', '2024-10-02 10:10:24', '2024-10-02 10:10:24', 'No'),
(2537, 5507, 1508, 7510, 2500, 'NOthing', 'Mounted', '2024-10-03 13:16:54', '2024-10-03 13:16:54', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `session_semesters`
--

CREATE TABLE `session_semesters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `begins` date NOT NULL,
  `ends` date NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session_semesters`
--

INSERT INTO `session_semesters` (`id`, `session_id`, `semester_id`, `begins`, `ends`, `description`, `status`, `created_at`, `updated_at`, `is_deleted`) VALUES
(2500, 2000, 2500, '2024-09-30', '2025-01-20', 'Later will do this', 'InActive', '2024-07-08 10:13:24', '2024-07-09 08:20:30', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_number` varchar(15) NOT NULL,
  `initials` varchar(10) DEFAULT NULL,
  `programme_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_completed` varchar(3) NOT NULL DEFAULT 'No',
  `year_completed` date DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_number`, `initials`, `programme_id`, `class_id`, `first_name`, `middle_name`, `last_name`, `gender`, `dob`, `phone`, `email`, `profile`, `status`, `created_at`, `updated_at`, `is_completed`, `year_completed`, `is_deleted`) VALUES
(5453, '5231570343', 'OJ', 5506, 1500, 'JOHN', NULL, 'OKYERE', 'Male', '2004-07-15', '0591518686', 'johnokyere282@icloud.com', NULL, 'Active', '2024-08-06 13:19:51', '2024-08-06 13:19:51', 'No', NULL, 'No'),
(5454, '5231570299', 'OY', 5506, 1500, 'Yussif', NULL, 'Osman', 'Male', '1999-07-01', '0246900926', 'abdulyussifo5@gmail.com', NULL, 'Active', '2024-08-06 13:24:12', '2024-08-06 13:26:03', 'No', NULL, 'No'),
(5455, '5231570309', 'SBP', 5506, 1500, 'Prince', 'Bondor', 'Sey', 'Male', '2000-10-13', '0249591560', 'Seyvision@gmail.com', NULL, 'Active', '2024-08-06 13:24:36', '2024-08-06 13:24:36', 'No', NULL, 'No'),
(5456, '5231570339', 'OGD', 5506, 1500, 'Darlington', 'Gyekye', 'Ofori', 'Male', '2003-05-07', '0241952348', 'vigabwoynetwork@gmail.com', NULL, 'Active', '2024-08-06 13:25:03', '2024-08-06 13:25:03', 'No', NULL, 'No'),
(5457, '5231570155', 'DDD', 5506, 1500, 'Darlington', 'Dela', 'Dogbey', 'Male', '2009-12-10', '0203239477', '5231570155@st.uew.edu.gh', NULL, 'Active', '2024-08-06 13:26:45', '2024-08-06 13:26:45', 'No', NULL, 'No'),
(5458, '5231570323', 'AAD', 5506, 1500, 'David', 'Anani', 'Awudzi', 'Male', '2009-12-31', '0242902767', 'ziondavid079@gmail.com', NULL, 'Active', '2024-08-06 13:31:54', '2024-08-06 13:31:54', 'No', NULL, 'No'),
(5459, '5231570316', 'AN', 5506, 1500, 'Noble', NULL, 'Azameti', 'Male', '2004-01-02', '0262547749', 'Deboigetrich025@gmail.com', NULL, 'Active', '2024-08-06 13:32:04', '2024-08-06 13:32:04', 'No', NULL, 'No'),
(5460, '5231570380', 'KEG', 5506, 1500, 'Ganyo', 'Elikplim', 'King', 'Male', '2000-06-20', '0532014556', 'ganyokingelikplim2000@gmail.com', NULL, 'Active', '2024-08-06 13:32:47', '2024-08-06 13:32:47', 'No', NULL, 'No'),
(5461, '5231570025', 'ATS', 5506, 1500, 'Samuel', 'Tetteh', 'Asare', 'Male', '2002-01-21', '0592118041', 'samiyklorxx2002@gmail.com', NULL, 'Active', '2024-08-06 13:36:20', '2024-08-06 13:36:20', 'No', NULL, 'No'),
(5462, '5231570174', 'BNS', 5506, 1500, 'Stephen', 'Nyarko', 'Bonney', 'Male', '2003-07-08', '0591180607', 'bonneystephennyarko@gmail.com', NULL, 'Active', '2024-08-06 13:37:05', '2024-08-06 13:37:05', 'No', NULL, 'No'),
(5463, '5231570021', 'DKK', 5501, 1500, 'Kissi', 'Kwame', 'Dwomoh', 'Male', '2008-04-07', '0556406303', 'dwomohkissikwame2022@yahoo.com', NULL, 'Active', '2024-08-06 13:40:45', '2024-08-06 13:40:45', 'No', NULL, 'No'),
(5464, '5231570361', 'RSR', 5501, 1500, 'Rafiatu', 'Sulemana', 'Rafiatu', 'Female', '2009-12-11', '0551018207', 'rafiasulemana414@gmail.com', NULL, 'Active', '2024-08-06 13:41:03', '2024-08-06 13:41:03', 'No', NULL, 'No'),
(5465, '5231570291', 'BWV', 5501, 1500, 'Victor', 'Wadam', 'Binambila', 'Male', '1996-07-11', '0543131979', 'victorwadambinambila@gmail.com', NULL, 'Active', '2024-08-06 13:46:38', '2024-08-06 13:46:38', 'No', NULL, 'No'),
(5466, '230003951', 'KAE', 5501, 1500, 'Emmanuel', 'Angelo', 'Kwame', 'Male', '2001-04-24', '0207864068', 'emmanuelkwame578@outlook.com', NULL, 'Active', '2024-08-06 13:46:49', '2024-08-06 13:46:49', 'No', NULL, 'No'),
(5467, '5231570147', 'SNN', 5501, 1500, 'Nween', 'Njognam', 'Sarah', 'Female', '2000-03-28', '0546807040', 'nweensarah2021@gmail.com', NULL, 'Active', '2024-08-06 13:47:41', '2024-08-06 13:47:41', 'No', NULL, 'No'),
(5468, '5231570376', 'MKE', 5501, 1500, 'Evans', 'Kobina', 'Mills', 'Male', '2003-12-30', '2335594', 'millsevans194@gmail.com', NULL, 'Active', '2024-08-06 13:48:52', '2024-08-06 13:48:52', 'No', NULL, 'No'),
(5469, '5231570247', 'MOC', 5501, 1500, 'Christian', 'Owusu Ewusi', 'Mintah', 'Male', '2004-01-22', '0553849923', 'christianmintah341@gmail.com', NULL, 'Active', '2024-08-06 13:49:40', '2024-08-06 13:49:40', 'No', NULL, 'No'),
(5470, '5231570342', 'AYL', 5501, 1500, 'Lawrence', 'Yaw', 'Attakumah', 'Male', '1999-05-26', '0257538947', 'bhrayaw77@gmail.com', NULL, 'Active', '2024-08-06 13:50:20', '2024-08-06 13:54:10', 'No', NULL, 'No'),
(5471, '5231570332', 'QM', 5501, 1500, 'Mensah', NULL, 'Quartey', 'Male', '2009-12-20', '0548115296', 'mensahquartey3@gmail.com', NULL, 'Active', '2024-08-06 13:54:00', '2024-08-06 13:54:00', 'No', NULL, 'No'),
(5472, '5231570296', 'MHA', 5501, 1500, 'ayambilla', 'Haruna', 'Mumuni', 'Male', '2009-12-31', '0559140924', 'harunamumuni140@gmail.com', NULL, 'Active', '2024-08-06 13:55:06', '2024-08-06 13:55:06', 'No', NULL, 'No'),
(5473, '5231570275', 'AE', 5501, 1500, 'Evans', NULL, 'Ackon', 'Male', '2001-05-01', '0543103716', 'ackonevanssky@gmail.com', NULL, 'Active', '2024-08-06 13:55:33', '2024-08-06 13:55:33', 'No', NULL, 'No'),
(5474, '5231570314', 'BBR', 5501, 1500, 'Rejoyce', 'Baajoe', 'Bawa', 'Female', '2000-06-06', '0558033495', 'Bawarejoyce@gmail.com', NULL, 'Active', '2024-08-06 13:56:54', '2024-08-06 13:56:54', 'No', NULL, 'No'),
(5475, '5231570252', 'MEP', 5501, 1500, 'PRISCILLA', 'ESSEL', 'MENSAH', 'Female', '2003-04-15', '0597944048', 'prissel2003@gmail.com', NULL, 'Active', '2024-08-06 13:57:03', '2024-08-06 13:57:03', 'No', NULL, 'No'),
(5476, '5231570288', 'ATE', 5501, 1500, 'Ernest', 'Tettey', 'Angmor', 'Male', '2000-03-02', '0542726994', 'enersttettey@gmail.com', NULL, 'Active', '2024-08-06 13:58:39', '2024-08-06 13:58:39', 'No', NULL, 'No'),
(5477, '5231570335', 'NAB', 5501, 1500, 'BISMARK', 'AGYA', 'NTIMONESI', 'Male', '1994-08-20', '0247411179', 'agyabismarkntimonesi2@gmail.com', NULL, 'Active', '2024-08-06 14:06:27', '2024-08-06 14:06:27', 'No', NULL, 'No'),
(5478, '5231570019', 'ADA', 5501, 1500, 'AWINI', 'DANIEL', 'ATILAAD', 'Male', '2000-03-09', '0591360168', 'danielawinigh@gmail.com', NULL, 'Active', '2024-08-06 14:08:59', '2024-08-06 14:08:59', 'No', NULL, 'No'),
(5479, '200019385', 'BAP', 5501, 1501, 'Philemon', 'Addo', 'Boateng', 'Male', '2007-10-15', '0245482029', 'odenehonas1@gmail.com', NULL, 'Active', '2024-08-12 17:19:41', '2024-08-12 17:19:41', 'No', NULL, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_course_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `referer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_first_time` tinyint(1) NOT NULL DEFAULT 1,
  `default_password` tinyint(1) NOT NULL DEFAULT 1,
  `otp` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active',
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `referer_id`, `name`, `email`, `username`, `email_verified_at`, `password`, `is_first_time`, `default_password`, `otp`, `token`, `status`, `is_deleted`, `remember_token`, `created_at`, `updated_at`) VALUES
(56521, 501, 1102, 'Solomon Ayisi Nana', 'lecturer@uew.edu.gh1', 'WGUE46207', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-01 05:00:16', '2024-08-01 05:00:16'),
(56522, 501, 1103, 'Desmond Agyemang Boateng', 'lecturer@uew.edu.gh2', 'WGUE46208', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-01 05:00:16', '2024-08-01 05:00:16'),
(56523, 501, 1104, 'Grace Badu Awuni', 'lecturer@uew.edu.gh3', 'WGUE46209', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-01 05:00:17', '2024-08-01 05:00:17'),
(56568, 501, 1149, 'Irene Afia Amponsah', 'lecturer@uew.edu.gh48', 'WGUE46254', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-01 05:00:34', '2024-08-01 05:00:34'),
(56569, 501, 1150, 'Paul Kwame Boateng', 'lecturer@uew.edu.gh49', 'WGUE46255', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-01 05:00:35', '2024-08-01 05:00:35'),
(56570, 501, 1151, 'Hannah Akosua Duah', 'lecturer@uew.edu.gh50', 'WGUE46256', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-01 05:00:35', '2024-08-01 05:00:35'),
(56572, 502, 5453, 'JOHN OKYERE', 'johnokyere282@icloud.com', '5231570343', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:19:52', '2024-08-06 13:19:52'),
(56573, 502, 5454, 'Yussif Osman', 'abdulyussifo5@gmail.com', '523570299', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:24:12', '2024-08-06 13:24:12'),
(56574, 502, 5455, 'Prince Bondor Sey', 'Seyvision@gmail.com', '5231570309', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:24:37', '2024-08-06 13:24:37'),
(56575, 502, 5456, 'Darlington Gyekye Ofori', 'vigabwoynetwork@gmail.com', '5231570339', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:25:03', '2024-08-06 13:25:03'),
(56576, 502, 5457, 'Darlington Dela Dogbey', '5231570155@st.uew.edu.gh', '5231570155', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:26:45', '2024-08-06 13:26:45'),
(56577, 502, 5458, 'David Anani Awudzi', 'ziondavid079@gmail.com', '5231570323', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:31:55', '2024-08-06 13:31:55'),
(56578, 502, 5459, 'Noble Azameti', 'Deboigetrich025@gmail.com', '5231570316', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:32:04', '2024-08-06 13:32:04'),
(56579, 502, 5460, 'Ganyo Elikplim King', 'ganyokingelikplim2000@gmail.com', '5231570380', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:32:48', '2024-08-06 13:32:48'),
(56580, 502, 5461, 'Samuel Tetteh Asare', 'samiyklorxx2002@gmail.com', '5231570025', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:36:20', '2024-08-06 13:36:20'),
(56581, 502, 5462, 'Stephen Nyarko Bonney', 'bonneystephennyarko@gmail.com', '5231570174', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:37:05', '2024-08-06 13:37:05'),
(56582, 502, 5463, 'Kissi Kwame Dwomoh', 'dwomohkissikwame2022@yahoo.com', '5231570021', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:40:45', '2024-08-06 13:40:45'),
(56583, 502, 5464, 'Rafiatu Sulemana Rafiatu', 'rafiasulemana414@gmail.com', '5231570361', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:41:03', '2024-08-06 13:41:03'),
(56584, 502, 5465, 'Victor Wadam Binambila', 'victorwadambinambila@gmail.com', '5231570291', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:46:39', '2024-08-06 13:46:39'),
(56585, 502, 5466, 'Emmanuel Angelo Kwame', 'emmanuelkwame578@outlook.com', '230003951', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:46:49', '2024-08-06 13:46:49'),
(56586, 502, 5467, 'Nween Njognam Sarah', 'nweensarah2021@gmail.com', '5231570147', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:47:41', '2024-08-06 13:47:41'),
(56587, 502, 5468, 'Evans Kobina Mills', 'millsevans194@gmail.com', '5231570376', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:48:52', '2024-08-06 13:48:52'),
(56588, 502, 5469, 'Christian Owusu Ewusi Mintah', 'christianmintah341@gmail.com', '5231570247', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:49:40', '2024-08-06 13:49:40'),
(56589, 502, 5470, 'Lawrence Yaw Attakumah', 'bhrayaw77@gmail.com', '5231570342', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:50:20', '2024-08-06 13:50:20'),
(56590, 502, 5471, 'Mensah Quartey', 'mensahquartey3@gmail.com', '5231570332', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:54:00', '2024-08-06 13:54:00'),
(56591, 502, 5472, 'ayambilla Haruna Mumuni', 'harunamumuni140@gmail.com', '5231570296', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:55:06', '2024-08-06 13:55:06'),
(56592, 502, 5473, 'Evans Ackon', 'ackonevanssky@gmail.com', '5231570275', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:55:34', '2024-08-06 13:55:34'),
(56593, 502, 5474, 'Rejoyce Baajoe Bawa', 'Bawarejoyce@gmail.com', '5231570314', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:56:54', '2024-08-06 13:56:54'),
(56594, 502, 5475, 'PRISCILLA ESSEL MENSAH', 'prissel2003@gmail.com', '5231570252', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:57:03', '2024-08-06 13:57:03'),
(56595, 502, 5476, 'Ernest Tettey Angmor', 'enersttettey@gmail.com', '5231570288', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 13:58:40', '2024-08-06 13:58:40'),
(56596, 502, 5477, 'BISMARK AGYA NTIMONESI', 'agyabismarkntimonesi2@gmail.com', '5231570335', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 14:06:28', '2024-08-06 14:06:28'),
(56597, 502, 5478, 'AWINI DANIEL ATILAAD', 'danielawinigh@gmail.com', '5231570019', NULL, '$2y$12$mxKXy.K6Pb3/3ZgwGCUvx.nXWFKKpK/Mk/TjnfJflRNeA50QEIivG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-06 14:09:00', '2024-08-06 14:09:00'),
(56598, 502, 5479, 'Philemon Addo Boateng', 'odenehonas1@gmail.com', '200019385', NULL, '$2y$12$buyr0kNxGNoZbjesWapFPONwz.yHFnykXh73jg5aChPGpx4cFpvLq', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-08-12 17:19:41', '2024-08-12 17:19:41'),
(56601, 500, 1154, 'The Main Developer', 'mdevelper@st.uew.edu.gh', 'DEV2021', NULL, '$2y$12$ERLW5pNtyf.wVJK.6tnAQe9c/lHx1JmhypYsUneU4WIkN9.zI6H66', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-09-23 10:20:13', '2024-09-23 10:20:13'),
(56602, 500, 1155, 'The Next Developer', 'ndevelper@st.uew.edu.gh', 'DEV2022', NULL, '$2y$12$LY777/L/TjxKOp1HBvzExeRSwl9awi5tMM0sdoAufW.EqSa7wmxYG', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-09-23 10:20:52', '2024-09-23 10:20:52'),
(56603, 504, 1156, 'First Quality Assurance', 'qad1@st.uew.edu.gh', 'QAD2031', NULL, '$2y$12$pRGO03jxW2I3hjK0RjNDV.jvjDD0egF5tgxcDGoMgMMA5/afZ2LB.', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-09-23 10:57:51', '2024-09-23 10:57:51'),
(56604, 505, 1157, 'Main Dean Affairs', 'mdean@st.uew.edu.gh', 'DEAN2041', NULL, '$2y$12$PdJSH/YBy8JDQ/5H4VYOQO7KqnT5qDR.r4T6KnjP6SAZdv362iHcW', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-09-23 13:42:52', '2024-09-23 13:42:52'),
(56605, 506, 1158, 'HOD Of ICT', 'hodict@st.uew.edu.gh', 'HOD2051', NULL, '$2y$12$WCL5LqBsTRkX0Gz5dmf5gOnYGgxNVyXw1eoY5d5D.Jt9KcFd0evDC', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-09-23 15:41:36', '2024-09-23 15:41:36'),
(56606, 506, 1159, 'HOD For Biology', 'hodbiology@st.uew.edu.gh', 'HOD2052', NULL, '$2y$12$tREocv9b8WRZhqBUTKYIHOTVu9KwzTClecDy9W4PT3GbnJK3nNwvK', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-10-02 09:46:10', '2024-10-02 09:46:10'),
(56607, 505, 1160, 'Dean For French', 'dean.french@st.uew.edu.gh', 'DEAN2042', NULL, '$2y$12$WpD3wSDEvcHBsOLrr3urA.Snju2H5pZW0xsQsb.VjuVLpWCtZpAjC', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-10-03 13:27:30', '2024-10-03 13:27:30'),
(56608, 506, 1161, 'Bens Kusi Mensah', 'kusi.hod@st.uew.edu.gh', 'HOD2036', NULL, '$2y$12$IvNdREg/ZAyl9XKwlGwPEOcbqp50y3dcTsyQxWHyk3CSIM.45e8Zy', 1, 1, NULL, NULL, 'Active', 'No', NULL, '2024-10-03 13:31:43', '2024-10-03 13:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL DEFAULT 'No Description',
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` varchar(3) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `classes_class_unique` (`class`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `courses_course_unique` (`course`),
  ADD KEY `courses_programme_id_foreign` (`programme_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_department_unique` (`department`),
  ADD KEY `departments_faculty_id_foreign` (`faculty_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculties_faculty_unique` (`faculty`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lecturers_phone_unique` (`phone`),
  ADD UNIQUE KEY `lecturers_email_unique` (`email`),
  ADD UNIQUE KEY `lecturers_staff_id_unique` (`staff_id`),
  ADD KEY `lecturers_department_id_foreign` (`department_id`),
  ADD KEY `lecturers_role_id_foreign` (`role_id`);

--
-- Indexes for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_courses_session_course_id_foreign` (`session_course_id`),
  ADD KEY `lecturer_courses_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `loginsessions`
--
ALTER TABLE `loginsessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginsessions_user_id_index` (`user_id`),
  ADD KEY `loginsessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_permission_unique` (`permission`),
  ADD UNIQUE KEY `permissions_permission_key_unique` (`permission_key`),
  ADD KEY `permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programmes_programme_unique` (`programme`),
  ADD KEY `programmes_department_id_foreign` (`department_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_section_id_foreign` (`section_id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_options_option_id_foreign` (`option_id`),
  ADD KEY `question_options_question_id_foreign` (`question_id`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `responses_student_id_foreign` (`student_id`),
  ADD KEY `responses_session_course_id_foreign` (`session_course_id`),
  ADD KEY `responses_lecturer_id_foreign` (`lecturer_id`),
  ADD KEY `responses_question_id_foreign` (`question_id`),
  ADD KEY `responses_question_option_id_foreign` (`question_option_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_unique` (`role`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semesters_semester_unique` (`semester`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sessions_name_unique` (`name`);

--
-- Indexes for table `session_courses`
--
ALTER TABLE `session_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_courses_course_id_foreign` (`course_id`),
  ADD KEY `session_courses_session_semester_id_foreign` (`session_semester_id`),
  ADD KEY `fk_session_course_classes` (`classes_id`),
  ADD KEY `fk_session_course_programme` (`programme_id`);

--
-- Indexes for table `session_semesters`
--
ALTER TABLE `session_semesters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session_semesters_session_id_foreign` (`session_id`),
  ADD KEY `session_semesters_semester_id_foreign` (`semester_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_phone_unique` (`phone`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD KEY `students_programme_id_foreign` (`programme_id`),
  ADD KEY `students_class_id_foreign` (`class_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_courses_session_course_id_foreign` (`session_course_id`),
  ADD KEY `student_courses_student_id_foreign` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_permissions_user_id_foreign` (`user_id`),
  ADD KEY `user_permissions_permission_id_foreign` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1510;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7511;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6514;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1307;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1162;

--
-- AUTO_INCREMENT for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2010;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2503;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5509;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `response_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2507;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2003;

--
-- AUTO_INCREMENT for table `session_courses`
--
ALTER TABLE `session_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2538;

--
-- AUTO_INCREMENT for table `session_semesters`
--
ALTER TABLE `session_semesters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2501;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5480;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2000;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56609;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1500;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturers_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturer_courses`
--
ALTER TABLE `lecturer_courses`
  ADD CONSTRAINT `lecturer_courses_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturer_courses_session_course_id_foreign` FOREIGN KEY (`session_course_id`) REFERENCES `session_courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `programmes_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_options`
--
ALTER TABLE `question_options`
  ADD CONSTRAINT `question_options_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_question_option_id_foreign` FOREIGN KEY (`question_option_id`) REFERENCES `question_options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_session_course_id_foreign` FOREIGN KEY (`session_course_id`) REFERENCES `session_courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session_courses`
--
ALTER TABLE `session_courses`
  ADD CONSTRAINT `fk_session_course_classes` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_session_course_programme` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_courses_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_courses_session_semester_id_foreign` FOREIGN KEY (`session_semester_id`) REFERENCES `session_semesters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `session_semesters`
--
ALTER TABLE `session_semesters`
  ADD CONSTRAINT `session_semesters_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `session_semesters_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD CONSTRAINT `student_courses_session_course_id_foreign` FOREIGN KEY (`session_course_id`) REFERENCES `session_courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_courses_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
