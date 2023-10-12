-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2023 at 12:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvzvnxjr_medmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_name_slug` varchar(255) DEFAULT NULL,
  `account_icon` varchar(70) DEFAULT NULL,
  `account_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `account_name`, `account_name_slug`, `account_icon`, `account_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'User', 'user', '<i class=\"fal fa-user-circle\"></i>', '<ul>\r\n    <li>To handle the own account smoothly and keep secure user ID and password.</li>\r\n    <li>To respect doctor, medical mate, medicine vendor time and help them friendly.</li>\r\n    <li>To avoid the making any fake booking, doctor consultation, Lab test and medicine order.</li>\r\n    <li>To help our executives and take personal user experience with My Medical Mate.</li>\r\n    <li> Be verified user and get more benefits from My Medical Mate.</li>\r\n    <li>Post your quires in suggestion box to improve product and services.</li>\r\n    <li>To make a professional relationship with any service providers.</li>\r\n    <li>To keep your all valuable assets and gadgets at your own risky during the service time.</li>\r\n</ul>', 1, '2021-02-10 13:42:19', '2021-02-10 13:42:19'),
(2, 'Medical Mate', 'medical-mate', '<i class=\"fal fa-users\"></i>', '<ul>\r\n    <li>To handle the own account smoothly and keep secure user ID and password.</li>\r\n    <li>To improve profile status with affordable patient oriented service with My Medical Mate at 0% commission rates.</li>\r\n    <li>To respect user/customers valuable time and help them friendly.</li>\r\n    <li>To avoid regardless cancelation from your end always.</li>\r\n    <li>To assist patient during the medical case as friend and make user friendly environment.</li>\r\n    <li>To make an earlier no for the doctor consultation behalf of patients/customers.</li>\r\n    <li>Pick Up and drop facilities within limited distances according to medical mate preference.</li>\r\n    <li>If it required the Medical Mate will talk to the doctor behalf of patient.</li>\r\n</ul>', 1, '2021-02-10 13:42:19', '2021-02-10 13:42:19'),
(3, 'Doctor', 'doctor', NULL, NULL, 0, '2021-02-10 13:45:07', '2021-02-10 13:45:07'),
(4, 'Vendor', 'vendor', '<i class=\"far fa-file-prescription\"></i>', '<ul>\r\n    <li>To handle the own account smoothly and keep secure user ID and password.</li>\r\n    <li>To read carefully doctor’s prescription and mention the medicine name and price accordingly.</li>\r\n    <li>To pack/dispatch the concern medicines according to doctor prescription with proper information regarding on it.</li>\r\n    <li>To make separate pack of order if medicine/liquid has instruction from the higher authority.</li>\r\n    <li>To make high secure and safety of medicine delivery system.</li>\r\n    <li>To give the uses instruction of any medicine or liquid accordingly.</li>\r\n    <li>To tick ensure button that you have given right quantity and quality in the box.</li>\r\n</ul>', 1, '2021-06-12 17:57:19', '2021-06-12 17:57:19'),
(5, 'Delivery Boy', 'delivery-boy', '<i class=\"far fa-file-prescription\"></i>', '<ul>\r\n    <li>To handle the own account smoothly and keep secure user ID and password.</li>\r\n    <li>To read carefully doctor’s prescription and mention the medicine name and price accordingly.</li>\r\n    <li>To pack/dispatch the concern medicines according to doctor prescription with proper information regarding on it.</li>\r\n    <li>To make separate pack of order if medicine/liquid has instruction from the higher authority.</li>\r\n    <li>To make high secure and safety of medicine delivery system.</li>\r\n    <li>To give the uses instruction of any medicine or liquid accordingly.</li>\r\n    <li>To tick ensure button that you have given right quantity and quality in the box.</li>\r\n</ul>', 1, '2021-06-12 12:27:19', '2021-06-12 12:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `alltype_ads`
--

CREATE TABLE `alltype_ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_user` varchar(70) DEFAULT NULL,
  `file_path` varchar(70) DEFAULT NULL,
  `file_type` varchar(70) DEFAULT NULL,
  `staff_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alltype_user_logs`
--

CREATE TABLE `alltype_user_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `data_id` int(10) DEFAULT NULL,
  `user_id` varchar(70) DEFAULT NULL,
  `full_name` varchar(70) DEFAULT NULL,
  `gender` varchar(70) DEFAULT NULL,
  `doctorqualification` varchar(70) DEFAULT NULL,
  `univercity` varchar(70) DEFAULT NULL,
  `university_date` varchar(70) DEFAULT NULL,
  `slefemp_emplaye` varchar(70) DEFAULT NULL,
  `orgnization_name` varchar(70) DEFAULT NULL,
  `state_city` varchar(70) DEFAULT NULL,
  `landmark_pincode` varchar(70) DEFAULT NULL,
  `avl_days` varchar(70) DEFAULT NULL,
  `from_time` varchar(70) DEFAULT NULL,
  `to_time` varchar(70) DEFAULT NULL,
  `consul_fee_from` varchar(70) DEFAULT NULL,
  `consul_fee_to` varchar(70) DEFAULT NULL,
  `instagram_url` varchar(70) DEFAULT NULL,
  `youth_profile_url` varchar(70) DEFAULT NULL,
  `twiter_profile_url` varchar(70) DEFAULT NULL,
  `doctorachievement_file` varchar(70) DEFAULT NULL,
  `designation` varchar(70) DEFAULT NULL,
  `department` varchar(70) DEFAULT NULL,
  `total_experience` varchar(70) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `mobile` varchar(70) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `website_url` varchar(70) DEFAULT NULL,
  `social_media_link` varchar(70) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `comments` varchar(70) DEFAULT NULL,
  `star_ratings` varchar(70) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `etablished_year` varchar(70) DEFAULT NULL,
  `type_hospital` varchar(70) DEFAULT NULL,
  `specialized` varchar(70) DEFAULT NULL,
  `telephone` varchar(70) DEFAULT NULL,
  `achievement_award` varchar(255) DEFAULT NULL,
  `multi_specialist` enum('0','1') DEFAULT NULL,
  `available_test` text DEFAULT NULL,
  `course_offered` varchar(255) DEFAULT NULL,
  `last_date_of_apply` timestamp NULL DEFAULT NULL,
  `total_vacancy` varchar(70) DEFAULT NULL,
  `exam_date` timestamp NULL DEFAULT NULL,
  `references_site` varchar(70) DEFAULT NULL,
  `references_hos_doc` varchar(70) DEFAULT NULL,
  `doc_profile` varchar(255) DEFAULT NULL,
  `prime_contain` text DEFAULT NULL,
  `sec_contain` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alltype_user_logs`
--

INSERT INTO `alltype_user_logs` (`id`, `account_id`, `data_id`, `user_id`, `full_name`, `gender`, `doctorqualification`, `univercity`, `university_date`, `slefemp_emplaye`, `orgnization_name`, `state_city`, `landmark_pincode`, `avl_days`, `from_time`, `to_time`, `consul_fee_from`, `consul_fee_to`, `instagram_url`, `youth_profile_url`, `twiter_profile_url`, `doctorachievement_file`, `designation`, `department`, `total_experience`, `location`, `mobile`, `email`, `website_url`, `social_media_link`, `description`, `comments`, `star_ratings`, `profile_picture`, `etablished_year`, `type_hospital`, `specialized`, `telephone`, `achievement_award`, `multi_specialist`, `available_test`, `course_offered`, `last_date_of_apply`, `total_vacancy`, `exam_date`, `references_site`, `references_hos_doc`, `doc_profile`, `prime_contain`, `sec_contain`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-16 07:44:14', '2023-09-16 07:44:14'),
(2, 1, 16, '1,30', NULL, NULL, NULL, 'Utkal', '44', NULL, NULL, NULL, NULL, 'WEDNESDAY,THURSDAY,FRIDAY', '11:29 AM', '1:29 AM', '300', '350', 'https://www.instagram.com/', 'https://www.youtube.com/', 'https://twitter.com/i/flow/login', NULL, NULL, NULL, '30', NULL, NULL, NULL, 'https://stackoverflow.com/questions', 'https://www.facebook.com/', 'newValuedc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'goalachive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-20 09:23:56', '2023-09-27 05:35:18'),
(3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3:15 pm', '2:15 PM', '2', '2.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-21 09:45:18', '2023-09-21 10:50:23'),
(4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5:30 am', '5:30 am', '3067', '3680.4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-21 10:58:41', '2023-09-21 10:58:41'),
(5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5:30 am', '5:30 am', '340', '408', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-21 10:59:06', '2023-09-21 10:59:06'),
(6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5:30 am', '5:30 am', '350', '420', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-21 11:01:16', '2023-09-21 11:01:16'),
(9, 1, 14, '30,1', 'Dr.Susanta ku dasxx', 'Other', 'MMBs', 'Utkaladd', '2011', 'Employed', 'Hanshupals', 'bhunaswarcc', 'jaidevbihar  765423', 'MONDAY', '5:30 am', '5:30 am', NULL, NULL, NULL, NULL, NULL, NULL, 'BCD', 'dfdfx', '36', 'jaidevbiharzxx', '8904756346', 'tykab43@GMAIL.COM', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-25 07:22:59', '2023-09-28 11:24:30'),
(10, 1, 24, '1,30', 'Susanta Swain', NULL, NULL, NULL, '2018', NULL, NULL, 'Bhubaneswar', 'Near sumhospital 7540', 'TUESDAY,SUNDAY,MONDAY,WEDNESDAY,SATERDAY', '5:30 am', '5:30 am', '200', '240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sharatze@gmail.com', 'https://stackoverflw.com/questions', NULL, 'View Page & Edit Page', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-28 14:18:40', '2023-09-30 09:18:57'),
(11, 1, 22, '1,30', NULL, NULL, NULL, 'Utkal', '2010', NULL, 'Hanshup', 'bhunaswar', NULL, ',SUNDAY,TUESDAY,WEDNESDAY,SATERDAY,MONDAY,THURSDAY', '5:30 am', '5:30 am', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-28 14:24:33', '2023-10-04 09:33:52'),
(12, 1, 13, '1', NULL, NULL, NULL, 'Utkal', '2010', NULL, NULL, NULL, NULL, NULL, '5:30 am', '5:30 am', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tanmayarout101@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-30 10:48:35', '2023-09-30 10:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `all_bonuses`
--

CREATE TABLE `all_bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `gen_date` datetime NOT NULL,
  `exp_date` datetime DEFAULT NULL,
  `bonus_price` varchar(255) NOT NULL,
  `bonus_type` varchar(225) DEFAULT NULL,
  `refer_type` int(11) DEFAULT 0,
  `to_who_ref` int(11) DEFAULT 0,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `owned_by` enum('SYSTEM','ADMIN') NOT NULL DEFAULT 'SYSTEM',
  `staff_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `all_bonuses`
--

INSERT INTO `all_bonuses` (`id`, `user_id`, `gen_date`, `exp_date`, `bonus_price`, `bonus_type`, `refer_type`, `to_who_ref`, `status`, `owned_by`, `staff_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-07-01 11:43:06', '2023-07-31 11:43:06', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:13:06', '2023-07-01 06:13:06'),
(2, 2, '2023-07-01 11:44:31', '2023-07-31 11:44:31', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:14:31', '2023-07-01 06:14:31'),
(3, 2, '2023-07-01 11:48:08', '2023-07-31 11:48:08', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:18:08', '2023-07-01 06:18:08'),
(4, 3, '2023-07-01 11:48:08', '2023-07-31 11:48:08', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:18:08', '2023-07-01 06:18:08'),
(5, 1, '2023-07-01 11:48:22', '2023-07-31 11:48:22', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:18:22', '2023-07-01 06:18:22'),
(6, 4, '2023-07-01 11:48:22', '2023-07-31 11:48:22', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:18:22', '2023-07-01 06:18:22'),
(7, 4, '2023-07-01 11:54:45', '2023-07-31 11:54:45', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:24:45', '2023-07-01 06:24:45'),
(8, 1, '2023-07-01 11:54:45', '2023-07-31 11:54:45', '50', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:24:45', '2023-07-01 06:24:45'),
(9, 5, '2023-07-01 11:54:45', '2023-07-31 11:54:45', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:24:45', '2023-07-01 06:24:45'),
(10, 5, '2023-07-01 12:02:12', '2023-07-31 12:02:12', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(11, 4, '2023-07-01 12:02:12', '2023-07-31 12:02:12', '50', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(12, 6, '2023-07-01 12:02:12', '2023-07-31 12:02:12', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(13, 2, '2023-07-01 13:11:57', '2023-07-31 13:11:57', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 07:41:57', '2023-07-01 07:41:57'),
(14, 7, '2023-07-01 13:11:57', '2023-07-31 13:11:57', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 07:41:57', '2023-07-01 07:41:57'),
(15, 2, '2023-07-01 13:27:32', '2023-07-31 13:27:32', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 07:57:32', '2023-07-01 07:57:32'),
(16, 8, '2023-07-01 13:27:32', '2023-07-31 13:27:32', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 07:57:32', '2023-07-01 07:57:32'),
(17, 2, '2023-07-01 13:34:37', '2023-07-31 13:34:37', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 08:04:37', '2023-07-01 08:04:37'),
(18, 9, '2023-07-01 13:34:37', '2023-07-31 13:34:37', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 08:04:37', '2023-07-01 08:04:37'),
(19, 2, '2023-07-01 13:44:25', '2023-07-31 13:44:25', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 08:14:25', '2023-07-01 08:14:25'),
(20, 10, '2023-07-01 13:44:25', '2023-07-31 13:44:25', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 08:14:25', '2023-07-01 08:14:25'),
(21, 2, '2023-07-01 13:54:08', '2023-07-31 13:54:08', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 08:24:08', '2023-07-01 08:24:08'),
(22, 11, '2023-07-01 13:54:08', '2023-07-31 13:54:08', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 08:24:08', '2023-07-01 08:24:08'),
(23, 7, '2023-07-01 15:55:22', '2023-07-02 12:00:00', '4000', 'Special Bonus By Admin', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-01 10:25:22', '2023-07-01 10:25:22'),
(24, 2, '2023-07-05 22:19:39', '2023-08-04 22:19:39', '100', 'Referal', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-05 16:49:39', '2023-07-05 16:49:39'),
(25, 12, '2023-07-05 22:19:39', '2023-08-04 22:19:39', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-05 16:49:39', '2023-07-05 16:49:39'),
(26, 13, '2023-07-07 17:42:37', '2023-08-06 17:42:37', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-07 12:12:37', '2023-07-07 12:12:37'),
(27, 14, '2023-07-24 11:34:04', '2023-08-23 11:34:04', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-07-24 06:04:04', '2023-07-24 06:04:04'),
(28, 16, '2023-08-14 12:05:00', '2023-09-13 12:05:00', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-08-14 06:35:00', '2023-08-14 06:35:00'),
(29, 15, '2023-08-14 12:05:00', '2023-09-13 12:05:00', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-08-14 06:35:00', '2023-08-14 06:35:00'),
(30, 17, '2023-08-14 12:11:29', '2023-09-13 12:11:29', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-08-14 06:41:29', '2023-08-14 06:41:29'),
(31, 18, '2023-08-14 13:16:27', '2023-09-13 13:16:27', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-08-14 07:46:27', '2023-08-14 07:46:27'),
(32, 19, '2023-08-14 16:35:27', '2023-09-13 16:35:27', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-08-14 11:05:27', '2023-08-14 11:05:27'),
(33, 20, '2023-08-14 17:14:59', '2023-09-13 17:14:59', '100', 'Sign-Up', 0, 0, 'ACTIVE', 'SYSTEM', 0, '2023-08-14 11:44:59', '2023-08-14 11:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `assistant_boy_bookings`
--

CREATE TABLE `assistant_boy_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `assistant_boy_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'null(Admin)',
  `assistant_boy_meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Profile details' CHECK (json_valid(`assistant_boy_meta`)),
  `booking_pin` int(11) DEFAULT NULL,
  `customer_meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Profile details' CHECK (json_valid(`customer_meta`)),
  `book_date` varchar(255) DEFAULT NULL,
  `arrival_time` varchar(255) DEFAULT NULL,
  `service_start_time` timestamp NULL DEFAULT NULL,
  `service_detail_meta` text DEFAULT NULL,
  `service_close_request` varchar(225) DEFAULT NULL,
  `pickup_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=No, 1=yes',
  `arrival_km` varchar(70) DEFAULT NULL,
  `early_serial_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=No, 1=yes',
  `early_serial` varchar(70) DEFAULT NULL,
  `fooding_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=No, 1=yes',
  `booking_criteria` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Day Booking, 2-Night Booking, 3- Day and night',
  `currency` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=INR,2=Dollar',
  `coupon_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Non,1=Applied',
  `total_price` decimal(8,2) DEFAULT NULL,
  `pickup_price` decimal(8,2) DEFAULT NULL,
  `advance_price` decimal(10,0) NOT NULL DEFAULT 0,
  `discount_price` decimal(8,2) DEFAULT NULL,
  `grand_price` decimal(8,2) DEFAULT NULL,
  `extend_hour` int(11) NOT NULL DEFAULT 8,
  `extend_amount` decimal(10,0) NOT NULL DEFAULT 0,
  `booking_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Failed,1=Booked,2=Accepted,3=OnBusy,4=Cancelled,5=Completed',
  `booking_type` varchar(225) DEFAULT NULL,
  `request_start_time` timestamp NULL DEFAULT NULL,
  `request_end_time` timestamp NULL DEFAULT NULL,
  `fwrd_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not Forwarded,1=Forwarded',
  `payment_mode` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1=Online,2=Pay After service',
  `payment_receive_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not-received,1=Received,2=Medmate Payment Received',
  `paid` int(11) NOT NULL DEFAULT 0,
  `customer_review_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not-Viewed,1=Viewed',
  `assistant_review_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not-Viewed,1=Viewed',
  `confirm_message_assistant_boy` text DEFAULT NULL,
  `booking_id` text DEFAULT NULL,
  `paid_by` varchar(225) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `cronjob_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Not-sent,1=Sent',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistant_boy_bookings`
--

INSERT INTO `assistant_boy_bookings` (`id`, `customer_id`, `assistant_boy_id`, `assistant_boy_meta`, `booking_pin`, `customer_meta`, `book_date`, `arrival_time`, `service_start_time`, `service_detail_meta`, `service_close_request`, `pickup_status`, `arrival_km`, `early_serial_status`, `early_serial`, `fooding_status`, `booking_criteria`, `currency`, `coupon_status`, `total_price`, `pickup_price`, `advance_price`, `discount_price`, `grand_price`, `extend_hour`, `extend_amount`, `booking_status`, `booking_type`, `request_start_time`, `request_end_time`, `fwrd_status`, `payment_mode`, `payment_receive_status`, `paid`, `customer_review_status`, `assistant_review_status`, `confirm_message_assistant_boy`, `booking_id`, `paid_by`, `transaction_id`, `cronjob_status`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '{\"first_name\":\"Tapask\",\"last_name\":\"Kumar\",\"email\":\"sharataskitc@gmail.com\",\"phone\":\"8765453201\",\"whatsapp\":\"9876543270\",\"gender\":\"Male\",\"dob\":\"21-May-1995\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751002\",\"present_address\":\"ABC House Nakhara\",\"permanent_address\":\"ABC House Nakhara\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"5:30 AM\",\"to_time\":\"10:50 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"15\",\"account_holder_name\":\"Ranjan Mishra\",\"account_number\":\"98765432100\",\"ifsc_code\":\"SBINN 22220\",\"branch_name\":\"BTBT\",\"photo\":\"2y10Vj8gOnSNA0kYYP7uUg8ceEdLx3u5gvPvuMeuQMtm1fXlO5FHGeuC.png\",\"identity_information\":\"2y10ZtrFkMqqWOujvtaKPuspu8uDNr1EVsLfwS4ds6iep462isl7G6.png\",\"rating_patience\":\"9\",\"rating_behaviour\":\"9\",\"rating_honesty\":\"8\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":28}', 55663, '{\"patient_from\":\"Paradeep PPL\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"8877540211\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"40\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Random Sugar Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '01-07-2023', '04:00 PM', '2023-07-01 10:01:52', '[{\"hospital\":\"Dr.Nandini\",\"doctor\":\"Dr.Nandini\",\"specialized\":\"DDM\"}]', 'Complete without uploading prescription?', 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 5, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '255618', NULL, NULL, 0, '2023-07-01 09:39:05', '2023-07-01 10:05:11'),
(2, 2, NULL, NULL, 95619, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"7755002123\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Random Sugar Test\\\",\\\"Free Hemoglobin Test\\\",\\\"Free BMI Test\\\"]\"}', '01-07-2023', '04:00 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, 'no', '597558', NULL, NULL, 0, '2023-07-01 09:55:55', '2023-07-03 10:36:55'),
(3, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"20-30 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 89594, '{\"patient_from\":\"Rajnagar Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"7755002121\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"44\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '02-07-2023', '07:30 PM', '2023-07-02 11:42:14', '[{\"hospital\":\"Dr.Nandini\",\"doctor\":\"Dr.Nandini\",\"specialized\":\"Dr.Nandini\"}]', 'Complete without uploading prescription?', 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 5, 'fullbook', NULL, NULL, 0, 2, 0, 1, 0, 0, NULL, '632971', 'Payment by QR/UPI', NULL, 0, '2023-07-02 04:28:58', '2023-07-02 12:16:03'),
(4, 2, NULL, NULL, 55804, '{\"patient_from\":\"Rajnagar, Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"8877540211\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"50\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free Weight Measurement\\\",\\\"Free BMI Test\\\"]\"}', '02-07-2023', '07:30 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 4, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, 'no', '832725', NULL, NULL, 0, '2023-07-02 12:29:10', '2023-07-02 12:33:11'),
(5, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"20-30 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 28045, '{\"patient_from\":\"Mahakalupada, Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543210\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"20\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '04-07-2023', '01:00 PM', NULL, NULL, NULL, 1, '10-20KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 100.00, 0, 0.00, 170.00, 8, 0, 2, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '625435', NULL, NULL, 0, '2023-07-03 05:26:07', '2023-07-03 15:35:08'),
(6, 2, NULL, NULL, 92997, '{\"patient_from\":\"Rajnagar Kendrapara\",\"patient_name\":\"Padmlochan Swain\",\"patient_mobile\":\"9876543444\",\"whats_app_no\":\"7755002121\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"20\",\"patient_type\":\"New Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":\"10:30 AM\",\"location_pincode\":null,\"old_prescription\":null}', '03-07-2023', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 1, 1, 0, NULL, NULL, 0, NULL, NULL, 1, 0, 1, 'serial', NULL, NULL, 0, 1, 0, 0, 0, 0, NULL, '697564', NULL, NULL, 0, '2023-07-03 15:11:49', '2023-07-03 15:11:49'),
(7, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"20-30 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 33881, '{\"patient_from\":\"Rajnagar Kendrapara\",\"patient_name\":\"Padmlochan Swain\",\"patient_mobile\":\"9876543444\",\"whats_app_no\":\"7755002121\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"20\",\"patient_type\":\"New Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":\"10:30 AM\",\"location_pincode\":null,\"old_prescription\":null}', '03-07-2023', NULL, '2023-07-03 15:15:30', '[{\"hospital\":\"Dr.Nandini\",\"doctor\":\"Dr.Nandini\",\"specialized\":\"DDM\"}]', 'Complete without uploading prescription?', 0, NULL, 0, NULL, 0, 1, 1, 0, 100.00, 0.00, 0, NULL, 100.00, 1, 0, 5, 'serial', NULL, NULL, 0, 2, 0, 1, 0, 0, 'yes', '459887', 'Payment by QR/UPI', NULL, 0, '2023-07-03 15:12:01', '2023-07-03 15:23:11'),
(8, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"20-30 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 87938, '{\"patient_from\":\"Paradeep PPL\",\"patient_name\":\"Nirakar Biswal\",\"patient_mobile\":\"7788443334\",\"whats_app_no\":\"7654321234\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"21\",\"patient_type\":\"New Patient\",\"hospital\":\"Utkal Hospital\",\"specific_doctor\":\"Dr. Hindustan Swain\",\"destination_address\":\"10:30 AM\",\"location_pincode\":null,\"old_prescription\":null}', '03-07-2023', NULL, '2023-07-03 15:25:45', NULL, NULL, 0, NULL, 0, NULL, 0, 1, 1, 0, 100.00, 0.00, 0, NULL, 100.00, 1, 0, 5, 'serial', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '241173', NULL, NULL, 0, '2023-07-03 15:24:35', '2023-07-03 15:27:48'),
(9, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"20-30 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 10307, '{\"patient_from\":\"Daringibadi, Odisha\",\"patient_name\":\"Sathish Mishra\",\"patient_mobile\":\"9876509876\",\"whats_app_no\":\"9876543233\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"33\",\"patient_type\":\"New Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '04-07-2023', '10:00 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 4, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 2, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '745907', NULL, NULL, 0, '2023-07-03 15:38:35', '2023-07-03 15:39:29'),
(10, 2, NULL, NULL, 34403, '{\"patient_from\":\"Rajnagar Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"7654321234\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null}', '05-07-2023', NULL, NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 0.00, 0.00, 0, 0.00, 0.00, 8, 0, 4, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '839699', NULL, NULL, 0, '2023-07-04 16:35:12', '2023-07-05 17:15:34'),
(11, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751020\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 11590, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543210\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '05-07-2023', '11:30 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 2, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '102858', NULL, NULL, 0, '2023-07-05 17:13:49', '2023-08-14 06:29:19'),
(12, 2, 9, '{\"first_name\":\"Tapask\",\"last_name\":\"Kumar\",\"email\":\"sharataskitc@gmail.com\",\"phone\":\"8765453201\",\"whatsapp\":\"9876543270\",\"gender\":\"Male\",\"dob\":\"21-May-1995\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751002\",\"present_address\":\"ABC House Nakhara\",\"permanent_address\":\"ABC House Nakhara\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"5:30 AM\",\"to_time\":\"10:50 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"15\",\"account_holder_name\":\"Ranjan Mishra\",\"account_number\":\"98765432100\",\"ifsc_code\":\"SBINN 22220\",\"branch_name\":\"BTBT\",\"photo\":\"2y10Vj8gOnSNA0kYYP7uUg8ceEdLx3u5gvPvuMeuQMtm1fXlO5FHGeuC.png\",\"identity_information\":\"2y10ZtrFkMqqWOujvtaKPuspu8uDNr1EVsLfwS4ds6iep462isl7G6.png\",\"rating_patience\":\"9\",\"rating_behaviour\":\"9\",\"rating_honesty\":\"8\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":28}', 28720, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"7654321234\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"50\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '05-07-2023', '11:30 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 2, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, 'yes', '215580', NULL, NULL, 0, '2023-07-05 17:16:42', '2023-07-05 17:28:55'),
(13, 2, 12, '{\"first_name\":\"Samikhya\",\"last_name\":\"Nayak\",\"email\":\"mymedicalmate@gmail.com\",\"phone\":\"7055421001\",\"whatsapp\":\"9876543210\",\"gender\":\"Female\",\"dob\":\"30-May-1999\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Self Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House Pattamundai\",\"permanent_address\":\"ABC House Pattamundai\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"420\",\"night_charges\":\"500\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5540\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"Ramesh Chandra\",\"account_number\":\"32100123211\",\"ifsc_code\":\"SBI00001231\",\"branch_name\":\"CRP Square Bhubaneswar\",\"photo\":\"2y10ZDHCGGlo2y4rK1D3RkPr3aJtLeGMrMeMqPmpFyNyhzdaYOVO6m.png\",\"identity_information\":\"2y10mOf1ut6LkPKQAPfhaCTrp4m7gBiduOKbBJyVTGhbfBrJFDYtQxFu.png\",\"rating_patience\":\"10\",\"rating_behaviour\":\"10\",\"rating_honesty\":\"10\",\"rating_integrity\":\"10\",\"declaration\":\"1\",\"dob_year\":24}', 94618, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"7654321234\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"44\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Swain\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '06-07-2023', '10:30 AM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 2, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '244282', NULL, NULL, 0, '2023-07-06 04:27:03', '2023-08-09 11:47:19'),
(14, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"20-30 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 30037, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543233\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Rabindra Mishra\",\"destination_address\":null,\"old_prescription\":null}', '06-07-2023', '05:30 PM', '2023-07-06 11:15:35', '[{\"hospital\":\"Dr.Nandini\",\"doctor\":\"Dr.Nandini\",\"specialized\":\"DDM\"}]', 'Complete without uploading prescription?', 1, '20-30Km', 1, 'Morning', 1, 1, 1, 0, 250.00, 150.00, 0, 0.00, 400.00, 8, 0, 5, 'fullbook', NULL, NULL, 0, 2, 0, 1, 0, 0, NULL, '468923', 'Payment by QR/UPI', NULL, 0, '2023-07-06 11:14:19', '2023-08-14 06:30:12'),
(15, 2, NULL, NULL, 61632, '{\"patient_from\":\"Rajnagar Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543210\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"20\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '13-07-2023', '09:00 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, 'no', '423870', NULL, NULL, 0, '2023-07-13 14:48:22', '2023-07-13 14:51:05'),
(16, 2, 3, '{\"first_name\":\"Tek\",\"last_name\":\"Vision\",\"email\":\"tek2vision@gmail.com\",\"phone\":\"9876543200\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"dob\":\"20-May-1990\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"75002\",\"present_address\":\"ABC House Bhubaneswar\",\"permanent_address\":\"ABC House Bhubaneswar\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"270\",\"night_charges\":\"350\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Check\",\"donate_trust\":\"18\",\"photo\":\"2y10Ap6VcGhqyfF8mxfs0mj0au5Tjhnkfc2S9BpV6Xd29XXRWDjFPDW.png\",\"identity_information\":\"2y10mtHJr9p0VQizR4QkRFc14OlsAOrGrVpkfeAbAsfIyR871x4RMq.png\",\"rating_patience\":\"5\",\"rating_behaviour\":\"5\",\"rating_honesty\":\"5\",\"rating_integrity\":\"5\",\"declaration\":\"1\",\"dob_year\":33}', 71649, '{\"patient_from\":\"Rajnagar Kendrapa\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"7755002123\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"25\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null}', '13-07-2023', '09:00 PM', '2023-07-13 14:54:08', '[{\"hospital\":\"MTM\",\"doctor\":\"VVT\",\"specialized\":\"Dr.Nandini\"}]', 'Complete without uploading prescription?', 1, '10-20Km', 1, 'Morning', 1, 1, 1, 0, 270.00, 100.00, 0, 0.00, 370.00, 8, 0, 3, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '431145', NULL, NULL, 0, '2023-07-13 14:53:08', '2023-07-13 15:01:06'),
(17, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 48499, '{\"patient_from\":\"Palasuni\",\"patient_name\":\"TEK SHARA\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Other\",\"age\":\"31\",\"patient_type\":\"New Patient\",\"hospital\":\"AIIMS\",\"specific_doctor\":\"Mr Ramkant\",\"destination_address\":\"Palasuni\",\"location_pincode\":null,\"old_prescription\":null}', '01-08-2023', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 1, 1, 0, 100.00, NULL, 0, NULL, 100.00, 1, 0, 1, 'serial', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '671161', NULL, NULL, 0, '2023-07-31 12:55:43', '2023-07-31 12:55:43'),
(18, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 59351, '{\"patient_from\":null,\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"44\",\"patient_type\":\"New Patient\",\"hospital\":\"Patia\",\"specific_doctor\":\"Dr Ram\",\"destination_address\":null,\"old_prescription\":null}', '31-07-2023', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 3, 1, 0, 700.00, 0.00, 0, 0.00, 700.00, 16, 0, 1, 'fullbook', NULL, NULL, 0, 1, 0, 0, 0, 0, NULL, '554262', NULL, NULL, 0, '2023-07-31 13:29:40', '2023-07-31 13:29:40'),
(19, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 19137, '{\"patient_from\":null,\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"44\",\"patient_type\":\"New Patient\",\"hospital\":\"Patia\",\"specific_doctor\":\"Dr Ram\",\"destination_address\":null,\"old_prescription\":null}', '31-07-2023', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 3, 1, 0, 700.00, 0.00, 0, 0.00, 700.00, 16, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '195381', NULL, NULL, 0, '2023-07-31 13:32:32', '2023-07-31 13:32:32'),
(20, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 60688, '{\"patient_from\":\"Paradeep PPL\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543233\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"40\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Swain\",\"destination_address\":null,\"old_prescription\":null}', '03-08-2023', '12:00 AM', NULL, NULL, NULL, 1, '40-50Km', 1, 'Morning', 1, 1, 1, 0, 300.00, 250.00, 0, 0.00, 550.00, 8, 0, 4, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '809806', NULL, NULL, 0, '2023-07-31 20:08:38', '2023-07-31 20:08:58'),
(21, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 10590, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543233\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"55\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null}', '03-08-2023', '12:00 AM', NULL, NULL, NULL, 1, '40-50Km', 1, 'Morning', 1, 1, 1, 0, 300.00, 250.00, 0, 0.00, 550.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 1, 0, 0, 0, 0, NULL, '640267', NULL, NULL, 0, '2023-07-31 20:10:34', '2023-07-31 20:10:34'),
(22, 2, NULL, NULL, 96053, '{\"patient_from\":\"Rajnagar Kendrapa\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"Old Patient\",\"hospital\":\"Aditya Care\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null}', '04-08-2023', '04:30 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Evening', 1, 1, 1, 0, 0.00, 0.00, 0, 0.00, 0.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '563445', NULL, NULL, 0, '2023-08-04 09:19:51', '2023-08-04 09:19:51'),
(23, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 64131, '{\"patient_from\":\"Bhubaneswar\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"49\",\"patient_type\":\"Old Patient\",\"hospital\":\"KIIMS\",\"specific_doctor\":\"Mr Rao\",\"destination_address\":null,\"old_prescription\":null}', '06-08-2023', '04:30 AM', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 2, 1, 0, 400.00, 0.00, 0, 0.00, 400.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 1, 0, 0, 0, 0, NULL, '113990', NULL, NULL, 0, '2023-08-04 13:53:21', '2023-08-04 13:53:21'),
(24, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 27503, '{\"patient_from\":\"Cuttack\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"56\",\"patient_type\":\"Old Patient\",\"hospital\":\"KIIMS\",\"specific_doctor\":null,\"destination_address\":null,\"old_prescription\":null}', '05-08-2023', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 2, 1, 0, 400.00, 0.00, 0, 0.00, 400.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 1, 0, 0, 0, 0, NULL, '243996', NULL, NULL, 0, '2023-08-04 13:56:47', '2023-08-04 13:56:47'),
(25, 2, 10, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 13468, '{\"patient_from\":\"Cuttack\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"56\",\"patient_type\":\"Old Patient\",\"hospital\":\"KIIMS\",\"specific_doctor\":null,\"destination_address\":null,\"old_prescription\":null}', '05-08-2023', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 2, 1, 0, 400.00, 0.00, 0, 0.00, 400.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '476722', NULL, NULL, 0, '2023-08-04 13:57:32', '2023-08-04 13:57:32'),
(26, 2, 12, '{\"first_name\":\"Samikhya\",\"last_name\":\"Nayak\",\"email\":\"mymedicalmate@gmail.com\",\"phone\":\"7055421001\",\"whatsapp\":\"9876543210\",\"gender\":\"Female\",\"dob\":\"30-May-1999\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Self Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House Pattamundai\",\"permanent_address\":\"ABC House Pattamundai\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"420\",\"night_charges\":\"500\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5540\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"Ramesh Chandra\",\"account_number\":\"32100123211\",\"ifsc_code\":\"SBI00001231\",\"branch_name\":\"CRP Square Bhubaneswar\",\"photo\":\"2y10ZDHCGGlo2y4rK1D3RkPr3aJtLeGMrMeMqPmpFyNyhzdaYOVO6m.png\",\"identity_information\":\"2y10mOf1ut6LkPKQAPfhaCTrp4m7gBiduOKbBJyVTGhbfBrJFDYtQxFu.png\",\"rating_patience\":\"10\",\"rating_behaviour\":\"10\",\"rating_honesty\":\"10\",\"rating_integrity\":\"10\",\"declaration\":\"1\",\"dob_year\":24}', 17939, '{\"patient_from\":\"Rajnagar Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543210\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Female\",\"age\":\"30\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null}', '09-08-2023', '07:30 PM', '2023-08-09 11:48:01', NULL, NULL, 1, '10-20Km', 1, 'Evening', 1, 1, 1, 0, 420.00, 100.00, 0, 0.00, 520.00, 8, 0, 3, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '604700', NULL, NULL, 0, '2023-08-09 11:45:54', '2023-08-09 11:48:01'),
(27, 2, NULL, NULL, 71858, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543210\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"20\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"Dr. Hindustan Behera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Blood Group Report\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '14-08-2023', '01:30 PM', NULL, NULL, NULL, 1, '40-50KM', 1, 'Morning', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, 'no', '446484', NULL, NULL, 0, '2023-08-14 06:22:06', '2023-08-14 06:26:34');
INSERT INTO `assistant_boy_bookings` (`id`, `customer_id`, `assistant_boy_id`, `assistant_boy_meta`, `booking_pin`, `customer_meta`, `book_date`, `arrival_time`, `service_start_time`, `service_detail_meta`, `service_close_request`, `pickup_status`, `arrival_km`, `early_serial_status`, `early_serial`, `fooding_status`, `booking_criteria`, `currency`, `coupon_status`, `total_price`, `pickup_price`, `advance_price`, `discount_price`, `grand_price`, `extend_hour`, `extend_amount`, `booking_status`, `booking_type`, `request_start_time`, `request_end_time`, `fwrd_status`, `payment_mode`, `payment_receive_status`, `paid`, `customer_review_status`, `assistant_review_status`, `confirm_message_assistant_boy`, `booking_id`, `paid_by`, `transaction_id`, `cronjob_status`, `created_at`, `updated_at`) VALUES
(28, 2, 8, '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751020\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":23}', 20356, '{\"patient_from\":\"Kedarnath Swami Kendrapara\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":\"9876543210\",\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"31\",\"patient_type\":\"Old Patient\",\"hospital\":\"Utkal Hospital Bhubaneswar\",\"specific_doctor\":\"M M Khera\",\"destination_address\":null,\"old_prescription\":null,\"report_available\":\"[\\\"Free Random Sugar Test\\\",\\\"Free Hemoglobin Test\\\",\\\"Blood Pressure Test\\\",\\\"Free BMI Test\\\"]\"}', '14-08-2023', '01:30 PM', '2023-08-14 06:31:40', NULL, NULL, 1, '40-50KM', 1, 'Evening', 1, 1, 1, 0, 70.00, 250.00, 0, 0.00, 320.00, 8, 0, 3, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '353577', NULL, NULL, 0, '2023-08-14 06:27:42', '2023-08-14 06:31:40'),
(29, 19, 13, '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharat.coolattitude@gmail.com\",\"phone\":\"9437627244\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754321\",\"present_address\":\"ABCD Done\",\"permanent_address\":\"ABCD Done\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"account_holder_name\":\"Atul Kumar\",\"account_number\":\"98765432123\",\"ifsc_code\":\"SBI1111000\",\"branch_name\":\"ANNNA\",\"photo\":\"2y10wP6MyqSsYOBcaBqr8KeCgULq0ZIlI8wXLarxQ8Wz8TLGZKUxTK.png\",\"identity_information\":\"2y10U0TSPEgl8zBlt5IRnk8ugj0CeHY87I3Rj3PP0bwY4XR9yFPLYaC.png\",\"rating_patience\":\"10\",\"rating_behaviour\":\"10\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"dob_year\":26}', 12449, '{\"patient_from\":\"Bhunaswar\",\"patient_name\":\"Tanmaya Rout\",\"patient_mobile\":\"9040815030\",\"whats_app_no\":\"9040815032\",\"patient_email\":\"tanmayarout101@gmail.com\",\"gender\":\"Male\",\"age\":\"35\",\"patient_type\":\"New Patient\",\"hospital\":\"NO for specific hospital\",\"specific_doctor\":\"no for  specific doctor\",\"destination_address\":null,\"old_prescription\":null}', '16-08-2023', '12:00 AM', NULL, NULL, NULL, 0, NULL, 1, 'Morning', 1, 1, 1, 0, 300.00, 0.00, 0, 0.00, 300.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '260984', NULL, NULL, 0, '2023-08-14 11:32:40', '2023-08-14 11:32:40'),
(30, 2, 6, '{\"first_name\":\"Mia\",\"last_name\":\"Roman\",\"email\":\"harapriyamahanta10@yahoo.com\",\"phone\":\"2345678765\",\"gender\":\"Male\",\"dob\":\"16-February-1995\",\"highest_qualification\":\"B Tech\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751024\",\"present_address\":\"patia\",\"permanent_address\":\"patia\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day\",\"day_charges\":\"250\",\"night_charges\":\"300\",\"hourly_charges\":\"70\",\"available\":\"Mon, Wed, Fri, Sun\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"OD432345\",\"vehicle_number\":\"HG654324\",\"km_range\":\"10-20 KM\",\"from_time\":\"8:00 AM\",\"to_time\":\"10:00 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Hara\",\"account_number\":\"65454545\",\"ifsc_code\":\"SBI7654\",\"branch_name\":\"Patia\",\"photo\":\"2y10z7TSx6692bRTUdBppkSkDw6G7aRHnaHMuOzUp8GO0adCuKWsHKi.png\",\"identity_information\":\"2y10GMvXlFV8SSKsI5DKHwQ6nPSOzg4dZ57mQXuV3NxP6Ii92gQdLrCC.png\",\"rating_patience\":\"9\",\"rating_behaviour\":\"9\",\"rating_honesty\":\"9\",\"rating_integrity\":\"9\",\"declaration\":\"1\",\"dob_year\":28}', 22452, '{\"patient_from\":\"Bhubanaswar\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"New Patient\",\"hospital\":\"sum hospital\",\"specific_doctor\":\"susanta Das\",\"destination_address\":null,\"old_prescription\":null}', '26-08-2023', '08:00 PM', NULL, NULL, NULL, 0, NULL, 1, 'Morning', 1, 1, 1, 0, 250.00, 0.00, 0, 0.00, 250.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '219818', NULL, NULL, 0, '2023-08-26 06:31:59', '2023-08-26 06:31:59'),
(31, 2, 3, '{\"first_name\":\"Tek\",\"last_name\":\"Vision\",\"email\":\"tek2vision@gmail.com\",\"phone\":\"9876543200\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"dob\":\"20-May-1990\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"75002\",\"present_address\":\"ABC House Bhubaneswar\",\"permanent_address\":\"ABC House Bhubaneswar\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"270\",\"night_charges\":\"350\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Check\",\"donate_trust\":\"18\",\"photo\":\"2y10Ap6VcGhqyfF8mxfs0mj0au5Tjhnkfc2S9BpV6Xd29XXRWDjFPDW.png\",\"identity_information\":\"2y10mtHJr9p0VQizR4QkRFc14OlsAOrGrVpkfeAbAsfIyR871x4RMq.png\",\"rating_patience\":\"5\",\"rating_behaviour\":\"5\",\"rating_honesty\":\"5\",\"rating_integrity\":\"5\",\"declaration\":\"1\",\"dob_year\":33}', 39067, '{\"patient_from\":\"Bhubanaswar\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"New Patient\",\"hospital\":\"sum hospital\",\"specific_doctor\":\"susanta Das\",\"destination_address\":null,\"old_prescription\":null}', '08-09-2023', '12:00 PM', NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 1, 1, 0, 270.00, 0.00, 0, 0.00, 270.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '215556', NULL, NULL, 0, '2023-09-08 05:58:47', '2023-09-08 05:58:47'),
(32, 2, 6, '{\"first_name\":\"Mia\",\"last_name\":\"Roman\",\"email\":\"harapriyamahanta10@yahoo.com\",\"phone\":\"2345678765\",\"gender\":\"Male\",\"dob\":\"16-February-1995\",\"highest_qualification\":\"B Tech\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751024\",\"present_address\":\"patia\",\"permanent_address\":\"patia\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day\",\"day_charges\":\"250\",\"night_charges\":\"300\",\"hourly_charges\":\"70\",\"available\":\"Mon, Wed, Fri, Sun\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"OD432345\",\"vehicle_number\":\"HG654324\",\"km_range\":\"10-20 KM\",\"from_time\":\"8:00 AM\",\"to_time\":\"10:00 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"account_holder_name\":\"Hara\",\"account_number\":\"65454545\",\"ifsc_code\":\"SBI7654\",\"branch_name\":\"Patia\",\"photo\":\"2y10z7TSx6692bRTUdBppkSkDw6G7aRHnaHMuOzUp8GO0adCuKWsHKi.png\",\"identity_information\":\"2y10GMvXlFV8SSKsI5DKHwQ6nPSOzg4dZ57mQXuV3NxP6Ii92gQdLrCC.png\",\"rating_patience\":\"9\",\"rating_behaviour\":\"9\",\"rating_honesty\":\"9\",\"rating_integrity\":\"9\",\"declaration\":\"1\",\"dob_year\":28}', 38649, '{\"patient_from\":\"Bhubanaswar\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"New Patient\",\"hospital\":\"sum hospital\",\"specific_doctor\":\"susanta Das\",\"destination_address\":null,\"old_prescription\":null}', '08-09-2023', '02:00 PM', NULL, NULL, NULL, 0, NULL, 0, NULL, 1, 1, 1, 0, 250.00, 0.00, 0, 0.00, 250.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '442165', NULL, NULL, 0, '2023-09-08 06:02:20', '2023-09-08 06:02:20'),
(33, 2, 3, '{\"first_name\":\"Tek\",\"last_name\":\"Vision\",\"email\":\"tek2vision@gmail.com\",\"phone\":\"9876543200\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"dob\":\"20-May-1990\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"75002\",\"present_address\":\"ABC House Bhubaneswar\",\"permanent_address\":\"ABC House Bhubaneswar\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"270\",\"night_charges\":\"350\",\"hourly_charges\":\"70\",\"available\":\"All Days\",\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Check\",\"donate_trust\":\"18\",\"photo\":\"2y10Ap6VcGhqyfF8mxfs0mj0au5Tjhnkfc2S9BpV6Xd29XXRWDjFPDW.png\",\"identity_information\":\"2y10mtHJr9p0VQizR4QkRFc14OlsAOrGrVpkfeAbAsfIyR871x4RMq.png\",\"rating_patience\":\"5\",\"rating_behaviour\":\"5\",\"rating_honesty\":\"5\",\"rating_integrity\":\"5\",\"declaration\":\"1\",\"dob_year\":33}', 74857, '{\"patient_from\":\"Bhubanaswar\",\"patient_name\":\"TEK SHARAT\",\"patient_mobile\":\"9876543210\",\"whats_app_no\":null,\"patient_email\":\"teksharat@gmail.com\",\"gender\":\"Male\",\"age\":\"30\",\"patient_type\":\"New Patient\",\"hospital\":\"sum hospital\",\"specific_doctor\":\"susanta Das\",\"destination_address\":null,\"old_prescription\":null}', '16-09-2023', '04:30 PM', NULL, NULL, NULL, 0, NULL, 1, 'Morning', 1, 1, 1, 0, 270.00, 0.00, 0, 0.00, 270.00, 8, 0, 1, 'fullbook', NULL, NULL, 0, 2, 0, 0, 0, 0, NULL, '991489', NULL, NULL, 0, '2023-09-16 10:42:12', '2023-09-16 10:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `assistant_cancel_bookings`
--

CREATE TABLE `assistant_cancel_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_canceled` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Admin, 2=User, 3=Auto Cancel',
  `cancel_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistant_cancel_bookings`
--

INSERT INTO `assistant_cancel_bookings` (`id`, `booking_id`, `from_canceled`, `cancel_reason`, `created_at`, `updated_at`) VALUES
(1, 11, 2, 'wwwwwwwwwwww', '2023-07-05 17:14:52', '2023-07-05 17:14:52'),
(2, 10, 2, 'hhhhhhhhhhhhh', '2023-07-05 17:15:34', '2023-07-05 17:15:34'),
(3, 20, 2, 'rrrrrrrrrrr', '2023-07-31 20:08:58', '2023-07-31 20:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `assistant_fwrd_bookings`
--

CREATE TABLE `assistant_fwrd_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assistant_boy_fwrd_from_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'null(Admin)',
  `assistant_boy_fwrd_from_meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`assistant_boy_fwrd_from_meta`)),
  `assistant_boy_fwrd_comment` text DEFAULT NULL,
  `assistant_boy_fwrd_to_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'null(Admin)',
  `assistant_boy_fwrd_to_meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assistant_reviews`
--

CREATE TABLE `assistant_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `medmate_id` bigint(20) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `pb_rating` int(11) NOT NULL DEFAULT 0,
  `pc_rating` int(11) NOT NULL DEFAULT 0,
  `pp_rating` int(11) NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Verified',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistant_reviews`
--

INSERT INTO `assistant_reviews` (`id`, `booking_id`, `user_id`, `medmate_id`, `rating`, `pb_rating`, `pc_rating`, `pp_rating`, `review`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, NULL, 8, 5, 5, 5, 5, NULL, NULL, 0, '2023-07-02 12:16:12', '2023-07-02 12:16:12'),
(2, 3, NULL, NULL, 5, 0, 0, 0, 'wwwwwwwwwwwwwwwww', '2y10nZnF4AF0EKITnuYnTGqnKevULRYaHPWe86xlSPQs686SoUFnPLqO.png', 0, '2023-07-02 12:17:01', '2023-07-02 12:17:01'),
(3, 7, NULL, 8, 5, 5, 3, 5, NULL, NULL, 0, '2023-07-03 15:23:21', '2023-07-03 15:23:21'),
(4, 8, NULL, NULL, 5, 0, 0, 0, 'I got good service', NULL, 0, '2023-07-03 15:30:27', '2023-07-03 15:30:27'),
(5, 14, NULL, 8, 5, 5, 4, 5, NULL, NULL, 0, '2023-08-14 06:30:20', '2023-08-14 06:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `booking_commisions`
--

CREATE TABLE `booking_commisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `mademate_id` bigint(20) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `total_amt` varchar(255) DEFAULT NULL,
  `vendor_amt` varchar(255) DEFAULT NULL,
  `mademate_amt` varchar(255) DEFAULT NULL,
  `admin_amt` varchar(255) DEFAULT NULL,
  `vendor_prcnt` varchar(255) DEFAULT NULL,
  `mademate_prcnt` varchar(255) DEFAULT NULL,
  `admin_prcnt` varchar(255) DEFAULT NULL,
  `status` enum('paid','unpaid','Request Sent') NOT NULL DEFAULT 'unpaid',
  `admin_status` varchar(225) DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_commisions`
--

INSERT INTO `booking_commisions` (`id`, `booking_id`, `vendor_id`, `mademate_id`, `admin_id`, `total_amt`, `vendor_amt`, `mademate_amt`, `admin_amt`, `vendor_prcnt`, `mademate_prcnt`, `admin_prcnt`, `status`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 952321, 4, NULL, 1, NULL, NULL, NULL, '148', NULL, NULL, '5', 'unpaid', 'unpaid', '2023-07-01 07:28:12', '2023-07-01 07:28:12'),
(2, 670918, 7, NULL, 1, NULL, NULL, NULL, '185', NULL, NULL, '5', 'unpaid', 'unpaid', '2023-07-04 10:32:46', '2023-07-04 10:32:46');

-- --------------------------------------------------------

--
-- Table structure for table `booking_delivery_requests`
--

CREATE TABLE `booking_delivery_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `delivery_type` varchar(255) NOT NULL,
  `delivery_pin` varchar(255) DEFAULT NULL,
  `delivery_commision_by_admin` varchar(255) DEFAULT NULL,
  `cancel_reason` text DEFAULT NULL,
  `delivery_datetime` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_delivery_requests`
--

INSERT INTO `booking_delivery_requests` (`id`, `delivery_id`, `order_id`, `status`, `delivery_type`, `delivery_pin`, `delivery_commision_by_admin`, `cancel_reason`, `delivery_datetime`, `created_at`, `updated_at`) VALUES
(1, 5, '952321', 'Delivered', 'Medicine Delivered', NULL, '20', NULL, '2023-07-01 13:02:38', '2023-07-01 07:31:53', '2023-07-01 07:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(12) DEFAULT NULL,
  `userdetail_id` int(12) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `date` varchar(70) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `userdetail_id`, `comments`, `date`, `created_at`, `updated_at`) VALUES
(1, NULL, 14, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2023-10-09', '2023-10-09 11:47:56', '2023-10-09 11:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`user_config`)),
  `assistant_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`assistant_config`)),
  `doctor_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`doctor_config`)),
  `admin_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`admin_config`)),
  `vendor_config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `deliveryboy_config` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `user_config`, `assistant_config`, `doctor_config`, `admin_config`, `vendor_config`, `deliveryboy_config`, `created_at`, `updated_at`) VALUES
(1, '{\"configs\":[{\"node_type\":\"text\",\"node_label\":\"User Route\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"User Route\",\"node_code\":\"route\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"user\",\"options\":null,\"required\":true},{\"sequence\":2,\"node_type\":\"select\",\"node_label\":\"Toastr Msg Position\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":null,\"node_code\":\"toastr_msg_position\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"2\",\"options\":[{\"option_value\":\"\",\"option_label\":\"Select Toastr Msg Position\"},{\"option_value\":1,\"option_label\":\"Top left\"},{\"option_value\":2,\"option_label\":\"Top center\"},{\"option_value\":3,\"option_label\":\"Top right\"},{\"option_value\":4,\"option_label\":\"Top full\"},{\"option_value\":5,\"option_label\":\"Bottom left\"},{\"option_value\":6,\"option_label\":\"Bottom center\"},{\"option_value\":7,\"option_label\":\"Bottom right\"},{\"option_value\":8,\"option_label\":\"Bottom full\"}],\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Profile Img Size\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Profile Img Size\",\"node_code\":\"profile_img_size\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"255*255\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Assistant Not Available\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Assistant Not Available\",\"node_code\":\"assistant_not_available\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"Medical Mate isn\'t available. Please select another date\",\"options\":null,\"required\":true}]}', '{\"configs\":[{\"node_type\":\"text\",\"node_label\":\"User Route\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"User Route\",\"node_code\":\"route\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"Medical Mate\",\"options\":null,\"required\":true},{\"sequence\":2,\"node_type\":\"select\",\"node_label\":\"Toastr Msg Position\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":null,\"node_code\":\"toastr_msg_position\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"1\",\"options\":[{\"option_value\":\"\",\"option_label\":\"Select Toastr Msg Position\"},{\"option_value\":1,\"option_label\":\"Top left\"},{\"option_value\":2,\"option_label\":\"Top center\"},{\"option_value\":3,\"option_label\":\"Top right\"},{\"option_value\":4,\"option_label\":\"Top full\"},{\"option_value\":5,\"option_label\":\"Bottom left\"},{\"option_value\":6,\"option_label\":\"Bottom center\"},{\"option_value\":7,\"option_label\":\"Bottom right\"},{\"option_value\":8,\"option_label\":\"Bottom full\"}],\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Profile Img Size\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Profile Img Size\",\"node_code\":\"profile_img_size\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"413*413\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Auto Forward Request Time (Minute)\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Auto Forward Request Time\",\"node_code\":\"auto_forward_request\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"30\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Min Day Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Min Day Charge\",\"node_code\":\"min_day_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"250\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Max Day Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Max Day Charge\",\"node_code\":\"max_day_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"700\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Min Night Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Min Night Charge\",\"node_code\":\"min_night_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"300\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Max Night Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Max Night Charge\",\"node_code\":\"max_night_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"600\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Min Hourly Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Min Hourly Charge\",\"node_code\":\"min_hourly_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"50\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Max Hourly Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Max Hourly Charge\",\"node_code\":\"max_hourly_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"70\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Serial No Booking Charge\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Serial No Booking Charge\",\"node_code\":\"serial_no_booking_charge\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"100\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Insurance Link\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Insurance Link\",\"node_code\":\"insurance_link\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"https:\\/\\/www.iciciprulife.com\\/insurance-plans\\/buy-life-insurance-online.html\",\"options\":null,\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Insurance Link Image\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Insurance Link Image\",\"node_code\":\"insurance_link_image\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"https:\\/\\/www.iciciprulife.com\\/content\\/icici-prudential-life-insurance\\/_jcr_content\\/headerpar\\/header_sightly\\/navHeader.img.png\\/1459612354899.png\",\"options\":null,\"required\":true},{\"node_type\":\"textarea\",\"node_label\":\"List of Pincode\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Add pincode with Comma separate\",\"node_code\":\"list_of_pincode\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"751024,751023,751020, 754217, 754111, 754000\",\"options\":null,\"required\":true}]}', '{\"configs\":[{\"node_type\":\"text\",\"node_label\":\"User Route\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"User Route\",\"node_code\":\"route\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"doctor\",\"options\":null,\"required\":true},{\"sequence\":2,\"node_type\":\"select\",\"node_label\":\"Toastr Msg Position\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":null,\"node_code\":\"toastr_msg_position\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"4\",\"options\":[{\"option_value\":\"\",\"option_label\":\"Select Toastr Msg Position\"},{\"option_value\":1,\"option_label\":\"Top left\"},{\"option_value\":2,\"option_label\":\"Top center\"},{\"option_value\":3,\"option_label\":\"Top right\"},{\"option_value\":4,\"option_label\":\"Top full\"},{\"option_value\":5,\"option_label\":\"Bottom left\"},{\"option_value\":6,\"option_label\":\"Bottom center\"},{\"option_value\":7,\"option_label\":\"Bottom right\"},{\"option_value\":8,\"option_label\":\"Bottom full\"}],\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Profile Img Size\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Profile Img Size\",\"node_code\":\"profile_img_size\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"266*266\",\"options\":null,\"required\":true}]}', '{\"configs\":[{\"node_type\":\"text\",\"node_label\":\"User Route\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"User Route\",\"node_code\":\"route\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"cms-admin\",\"options\":null,\"required\":true},{\"sequence\":2,\"node_type\":\"select\",\"node_label\":\"Toastr Msg Position\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":null,\"node_code\":\"toastr_msg_position\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"2\",\"options\":[{\"option_value\":\"\",\"option_label\":\"Select Toastr Msg Position\"},{\"option_value\":1,\"option_label\":\"Top left\"},{\"option_value\":2,\"option_label\":\"Top center\"},{\"option_value\":3,\"option_label\":\"Top right\"},{\"option_value\":4,\"option_label\":\"Top full\"},{\"option_value\":5,\"option_label\":\"Bottom left\"},{\"option_value\":6,\"option_label\":\"Bottom center\"},{\"option_value\":7,\"option_label\":\"Bottom right\"},{\"option_value\":8,\"option_label\":\"Bottom full\"}],\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Profile Img Size\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Profile Img Size\",\"node_code\":\"profile_img_size\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"266*266\",\"options\":null,\"required\":true}]}', '{\"configs\":[{\"node_type\":\"text\",\"node_label\":\"Vendor Route\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Vendor Route\",\"node_code\":\"route\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"vendor\",\"options\":null,\"required\":true},{\"sequence\":2,\"node_type\":\"select\",\"node_label\":\"Toastr Msg Position\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":null,\"node_code\":\"toastr_msg_position\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"4\",\"options\":[{\"option_value\":\"\",\"option_label\":\"Select Toastr Msg Position\"},{\"option_value\":1,\"option_label\":\"Top left\"},{\"option_value\":2,\"option_label\":\"Top center\"},{\"option_value\":3,\"option_label\":\"Top right\"},{\"option_value\":4,\"option_label\":\"Top full\"},{\"option_value\":5,\"option_label\":\"Bottom left\"},{\"option_value\":6,\"option_label\":\"Bottom center\"},{\"option_value\":7,\"option_label\":\"Bottom right\"},{\"option_value\":8,\"option_label\":\"Bottom full\"}],\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Profile Img Size\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Profile Img Size\",\"node_code\":\"profile_img_size\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"266*266\",\"options\":null,\"required\":true},{\"node_type\":\"textarea\",\"node_label\":\"List of Pincode\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Add pincode with Comma separate\",\"node_code\":\"list_of_pincode\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"751024,751023,751020\",\"options\":null,\"required\":true}]}', '{\"configs\":[{\"node_type\":\"text\",\"node_label\":\"Deliveryboy Route\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Deliveryboy Route\",\"node_code\":\"route\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"delivery-boy\",\"options\":null,\"required\":true},{\"sequence\":2,\"node_type\":\"select\",\"node_label\":\"Toastr Msg Position\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":null,\"node_code\":\"toastr_msg_position\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"4\",\"options\":[{\"option_value\":\"\",\"option_label\":\"Select Toastr Msg Position\"},{\"option_value\":1,\"option_label\":\"Top left\"},{\"option_value\":2,\"option_label\":\"Top center\"},{\"option_value\":3,\"option_label\":\"Top right\"},{\"option_value\":4,\"option_label\":\"Top full\"},{\"option_value\":5,\"option_label\":\"Bottom left\"},{\"option_value\":6,\"option_label\":\"Bottom center\"},{\"option_value\":7,\"option_label\":\"Bottom right\"},{\"option_value\":8,\"option_label\":\"Bottom full\"}],\"required\":true},{\"node_type\":\"text\",\"node_label\":\"Profile Img Size\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Profile Img Size\",\"node_code\":\"profile_img_size\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"266*266\",\"options\":null,\"required\":true},{\"node_type\":\"textarea\",\"node_label\":\"List of Pincode\",\"node_label_class\":\"bmd-label-floating\",\"node_placeholder\":\"Add pincode with Comma separate\",\"node_code\":\"list_of_pincode\",\"node_class\":\"form-control\",\"node_comment\":{\"label_1\":\"col-md-12\",\"label_2\":\"form-group\"},\"node_value\":\"751024,751023,751020\",\"options\":null,\"required\":true}]}', '2021-04-25 09:50:43', '2023-06-28 14:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_title` varchar(255) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_discount_type` varchar(255) NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `user_ids` text DEFAULT NULL,
  `account_id` int(10) DEFAULT NULL COMMENT '1=user,2=medicalmate,4=vendor',
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `purchasing_value` decimal(10,0) DEFAULT 0,
  `coupon_value` decimal(10,0) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_title`, `coupon_name`, `coupon_discount_type`, `coupon_type`, `user_ids`, `account_id`, `start_date`, `end_date`, `status`, `purchasing_value`, `coupon_value`, `created_at`, `updated_at`) VALUES
(1, 'Black Friday', 'HJM9XBI52Q', 'FIXED', 'PUBLIC', '', 2, '2023-07-05 00:00:00', '2023-07-07 00:00:00', 'ACTIVE', 2000, 50, '2023-07-05 03:43:30', '2023-08-22 10:48:41'),
(2, 'ABCD egd', '2U7F59RTL4', 'PERCENTAGE', 'PRIVATE', '5', NULL, '2023-08-20 00:00:00', '2023-08-26 00:00:00', 'ACTIVE', 350, 50, '2023-08-16 08:32:45', '2023-08-22 06:24:30'),
(3, 'abchgads', 'EKDV9R08PO', 'FIXED', 'PRIVATE', '6', NULL, '2023-08-19 00:00:00', '2023-08-19 00:00:00', 'ACTIVE', 350, 50, '2023-08-18 05:35:44', '2023-08-18 07:21:23'),
(4, 'Holly Day', 'MQG5YX1UT9', 'PERCENTAGE', 'PUBLIC', '2', NULL, '2023-08-22 00:00:00', '2023-08-24 00:00:00', 'ACTIVE', 300, 30, '2023-08-21 05:20:03', '2023-08-21 05:20:03'),
(5, 'Christmas', 'U8J6AF3E4Z', 'FIXED', 'USER_CATEGORY', NULL, 2, '2023-08-23 00:00:00', '2023-08-23 00:00:00', 'ACTIVE', 300, 40, '2023-08-22 11:02:56', '2023-08-22 11:02:56'),
(6, 'Treewhee', 'VD6RYMFBUP', 'FIXED', 'PUBLIC', NULL, 4, '2023-08-23 00:00:00', '2023-08-23 00:00:00', 'ACTIVE', 400, 40, '2023-08-22 11:07:55', '2023-08-22 11:07:55'),
(7, 'For Diwali', 'DIWALI50', 'FIXED', 'USER_CATEGORY', NULL, 1, '2023-08-25 00:00:00', '2023-08-28 00:00:00', 'ACTIVE', 250, 50, '2023-08-25 13:32:27', '2023-08-25 13:32:27'),
(8, 'Dasahara', '8W5AD2MBYI', 'FIXED', 'PRIVATE', '5', NULL, '2023-09-05 00:00:00', '2023-09-05 00:00:00', 'ACTIVE', 300, 50, '2023-09-04 11:40:57', '2023-09-04 11:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `first_name` varchar(70) DEFAULT NULL,
  `last_name` varchar(70) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `phone` varchar(70) DEFAULT NULL,
  `password` varchar(70) DEFAULT NULL,
  `pin` int(11) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Profile image' CHECK (json_valid(`meta`)),
  `lat` varchar(225) DEFAULT NULL,
  `lang` varchar(225) DEFAULT NULL,
  `name_of_store` varchar(225) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `booking_type` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Only signup,1=Verified customer,2=Blocked by admin',
  `admin_pay_due` int(11) NOT NULL DEFAULT 0,
  `total_coin` int(11) NOT NULL DEFAULT 0,
  `customerId` varchar(225) DEFAULT NULL,
  `restricted_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `online_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Online,0=Offline',
  `admin_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Verified',
  `pincode` varchar(225) DEFAULT NULL,
  `is_profile_setup` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `account_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `pin`, `email_verified_at`, `meta`, `lat`, `lang`, `name_of_store`, `discount`, `booking_type`, `status`, `admin_pay_due`, `total_coin`, `customerId`, `restricted_reason`, `online_status`, `admin_status`, `pincode`, `is_profile_setup`, `created_at`, `updated_at`) VALUES
(1, 1, 'Odette', 'Burt', 'harapriyamahanta9@gmail.com', '7654345432', '$2y$10$CAxmKcvt0uhOcWN3U/f/dunPHdM3FhcGlKd1lRAHa/xopK7uwsrC.', NULL, '2023-07-01 11:43:57', '{\"first_name\":\"Odette\",\"last_name\":\"Burt\",\"email\":\"harapriyamahanta9@gmail.com\",\"phone\":\"7654345432\",\"gender\":\"Female\",\"dob\":\"10-March-2000\",\"present_address\":\"A5-403 patia\",\"permanent_address\":\"A5-403 patia\",\"pincode\":\"751024\",\"age\":23,\"photo\":null,\"identity_information\":null}', NULL, NULL, NULL, NULL, NULL, 1, 0, 100, 'MM00001', NULL, 1, 0, '751024', 0, '2023-07-01 06:13:06', '2023-07-01 07:28:12'),
(2, 1, 'TEK', 'SHARAT', 'teksharat@gmail.com', '9876543210', '$2y$10$CAxmKcvt0uhOcWN3U/f/dunPHdM3FhcGlKd1lRAHa/xopK7uwsrC.', NULL, '2023-07-01 11:45:22', '{\"first_name\":\"TEK\",\"last_name\":\"SHARAT\",\"email\":\"teksharat@gmail.com\",\"phone\":\"9876543210\",\"gender\":\"\",\"dob\":\"\",\"present_address\":\"\",\"permanent_address\":\"\",\"pincode\":\"\"}', NULL, NULL, NULL, NULL, NULL, 1, 0, 695, 'MM00002', NULL, 1, 0, NULL, 0, '2023-07-01 06:14:31', '2023-07-05 16:49:39'),
(3, 2, 'Tek', 'Vision', 'tek2vision@gmail.com', '9876543200', '$2y$10$FytuyFB7dGzhFQfaKLdiJO8pAOBdWUKcmqW/s63fswv2Qg9b99iEi', NULL, '2023-07-01 11:48:36', '{\"first_name\":\"Tek\",\"last_name\":\"Vision\",\"email\":\"tek2vision@gmail.com\",\"phone\":\"9876543200\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"dob\":\"20-May-1990\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"75002\",\"present_address\":\"ABC House Bhubaneswar\",\"permanent_address\":\"ABC House Bhubaneswar\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"270\",\"night_charges\":\"350\",\"hourly_charges\":\"70\",\"available\":[\"All\",\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Check\",\"donate_trust\":\"18\",\"upi_id\":null,\"account_holder_name\":null,\"account_number\":null,\"ifsc_code\":null,\"branch_name\":null,\"rating_patience\":\"5\",\"rating_behaviour\":\"5\",\"rating_honesty\":\"5\",\"rating_integrity\":\"5\",\"declaration\":\"1\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y10Ap6VcGhqyfF8mxfs0mj0au5Tjhnkfc2S9BpV6Xd29XXRWDjFPDW.png\",\"referance_list\":null,\"identity_information\":\"2y10mtHJr9p0VQizR4QkRFc14OlsAOrGrVpkfeAbAsfIyR871x4RMq.png\"}', NULL, NULL, NULL, NULL, 3, 1, 0, 0, 'MM00003', NULL, 1, 1, '75002', 1, '2023-07-01 06:18:08', '2023-07-01 07:38:10'),
(4, 4, 'Anne', 'Randolph', 'harapriya.euphern@gmail.com', '6543456543', '$2y$10$CAxmKcvt0uhOcWN3U/f/dunPHdM3FhcGlKd1lRAHa/xopK7uwsrC.', NULL, '2023-07-01 11:49:03', '{\"first_name\":\"Anne\",\"last_name\":\"Randolph\",\"email\":\"harapriya.euphern@gmail.com\",\"phone\":\"6543456543\",\"whatsapp\":null,\"gender\":\"Male\",\"are_you_owner\":\"I am Owner\",\"owner_manager_name\":\"Anne Randolph\",\"name_of_store\":\"MAA MANGALA MEDICINE STORE\",\"medicine_categories\":\"General\",\"from_time\":\"8:00 AM\",\"to_time\":\"10:00 PM\",\"total_staff\":\"05\",\"discount\":\"05\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751024\",\"store_address\":\"patia\",\"is_home_delivery\":\"Yes\",\"minimum_order\":\"200\",\"minimum_order_homedelivery\":\"300\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\"],\"is_dispatch_cod\":\"Yes\",\"per_percel_charge\":\"20\",\"platform_charge\":\"1\",\"is_want_to_donate\":\"Yes\",\"payment_information\":\"Account Transfer\",\"upi_id\":null,\"account_holder_name\":\"Aloe\",\"account_number\":\"765434543234\",\"ifsc_code\":\"SBI7654\",\"branch_name\":\"patia\",\"declaration\":\"declaration\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":null,\"referance_list\":null,\"identity_information\":null}', NULL, NULL, 'MAA MANGALA MEDICINE STORE', 5, NULL, 1, 0, 150, 'MM00004', NULL, 1, 1, '751024', 1, '2023-07-01 06:18:22', '2023-07-01 07:54:46'),
(5, 5, 'Demetria', 'Berg', 'pravanjanghadei.php@gmail.com', '9876543456', '$2y$10$crN0UukvT2F3JlkVwJiVq.qu9BdT0jL.7Bx5oGHq34l7joiCboZMy', NULL, '2023-07-01 11:56:07', '{\"existing_delivery_boy\":\"I m existing delivery boy\",\"partner_company\":[\"Delivery\",\"Amazon\"],\"first_name\":\"Demetria\",\"last_name\":\"Berg\",\"email\":\"pravanjanghadei.php@gmail.com\",\"phone\":\"9876543456\",\"whatsapp\":null,\"gender\":\"Male\",\"dob\":\"20-July-1995\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751024\",\"present_address\":\"patia\",\"permanent_address\":\"patia\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":\"751024,751023,751020\",\"vehiicle_name\":null,\"vehicle_number\":\"HG654324\",\"dl_number\":\"OD432345\",\"from_time\":\"6:00 AM\",\"to_time\":\"11:00 PM\",\"payment_information\":\"Account Transfer\",\"account_holder_name\":\"Hara\",\"account_number\":\"65454545\",\"ifsc_code\":\"SBI7654\",\"branch_name\":\"patia\",\"declaration\":\"declaration\",\"bike_photo\":\"2y10hW0RstV9MGdpOfLoEjjjPOAAU9uzRtmUKnFcHxLjHmfYgGuQFg1K.png\",\"adhere_photo\":\"2y10olQhAa9YvuJwPkEy0uWd6uDiGQxVyHz9tC3B5bxscW3c9EVFP20Lu.png\",\"photo\":null,\"referance_list\":null,\"identity_information\":\"2y10Ckshp2GXxRyZfprvabe6Suq0PpsMOs0mImFenVrc7gQ9sOryBq.png\",\"age\":27}', NULL, NULL, NULL, NULL, NULL, 1, 0, 100, 'MM00005', NULL, 1, 0, '751024', 1, '2023-07-01 06:24:45', '2023-07-01 07:52:41'),
(6, 2, 'Mia', 'Roman', 'harapriyamahanta10@yahoo.com', '2345678765', '$2y$10$FytuyFB7dGzhFQfaKLdiJO8pAOBdWUKcmqW/s63fswv2Qg9b99iEi', NULL, '2023-07-01 12:03:14', '{\"first_name\":\"Mia\",\"last_name\":\"Roman\",\"email\":\"harapriyamahanta10@yahoo.com\",\"phone\":\"2345678765\",\"whatsapp\":null,\"gender\":\"Male\",\"dob\":\"16-February-1995\",\"highest_qualification\":\"B Tech\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751024\",\"present_address\":\"patia\",\"permanent_address\":\"patia\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day\",\"day_charges\":\"250\",\"night_charges\":\"300\",\"hourly_charges\":\"70\",\"available\":[\"Monday\",\"Wednesday\",\"Friday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"OD432345\",\"vehicle_number\":\"HG654324\",\"km_range\":\"10-20 KM\",\"from_time\":\"8:00 AM\",\"to_time\":\"10:00 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"upi_id\":null,\"account_holder_name\":\"Hara\",\"account_number\":\"65454545\",\"ifsc_code\":\"SBI7654\",\"branch_name\":\"Patia\",\"rating_patience\":\"9\",\"rating_behaviour\":\"9\",\"rating_honesty\":\"9\",\"rating_integrity\":\"9\",\"declaration\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y10z7TSx6692bRTUdBppkSkDw6G7aRHnaHMuOzUp8GO0adCuKWsHKi.png\",\"referance_list\":null,\"identity_information\":\"2y10GMvXlFV8SSKsI5DKHwQ6nPSOzg4dZ57mQXuV3NxP6Ii92gQdLrCC.png\"}', NULL, NULL, NULL, NULL, 1, 1, 0, 0, 'MM00006', NULL, 1, 1, '751024', 1, '2023-07-01 06:32:12', '2023-07-06 05:22:58'),
(7, 4, 'Sathish', 'Mishra', 'fultimefashion@gmail.com', '0987654144', '$2y$10$BbUlr1KWehaRjfURAeG6E.lALi2.Drp6TEe0WhPQA0JVaaAS8HyxS', NULL, '2023-07-01 01:13:25', '{\"first_name\":\"Sathish\",\"last_name\":\"Mishra\",\"email\":\"fultimefashion@gmail.com\",\"phone\":\"0987654144\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"are_you_owner\":\"I am Owner\",\"owner_manager_name\":\"9877500121\",\"name_of_store\":\"Sai Medicine Store\",\"medicine_categories\":\"General\",\"from_time\":\"7:30 AM\",\"to_time\":\"7:30 PM\",\"total_staff\":\"20\",\"discount\":\"20\",\"state\":\"Odisha\",\"dist\":\"Cuttack\",\"pincode\":\"754001\",\"store_address\":\"ABC House Cuttack\",\"is_home_delivery\":\"Yes\",\"minimum_order\":\"200\",\"minimum_order_homedelivery\":\"400\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\"],\"is_dispatch_cod\":\"Yes\",\"per_percel_charge\":\"20\",\"platform_charge\":\"1\",\"is_want_to_donate\":\"Yes\",\"payment_information\":\"Account Transfer\",\"upi_id\":null,\"account_holder_name\":\"Rahde Radhe\",\"account_number\":\"765432123444\",\"ifsc_code\":\"SBI0000NT\",\"branch_name\":\"Chandan Nagar\",\"declaration\":\"declaration\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":null,\"referance_list\":null,\"identity_information\":null}', NULL, NULL, 'Sai Medicine Store', 20, NULL, 1, 0, 4000, 'MM00007', NULL, 1, 1, '754001', 1, '2023-07-01 07:41:57', '2023-07-01 10:25:22'),
(8, 2, 'Swapna', 'Sangita', 'swapnasangita2@gmail.com', '5876541444', '$2y$10$JxrrfhBxtqXNqGpE.ucrVujyElq1JG2EfNrDdy7FYhoDiYT1Ki7oK', NULL, '2023-07-01 01:27:55', '{\"first_name\":\"Swapna\",\"last_name\":\"Sangita\",\"email\":\"swapnasangita2@gmail.com\",\"phone\":\"5876541444\",\"whatsapp\":\"9876543211\",\"gender\":\"Female\",\"dob\":\"14-May-2000\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House D Park\",\"permanent_address\":\"ABC House D Park\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751020\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"250\",\"night_charges\":\"440\",\"hourly_charges\":\"70\",\"available\":[\"All\",\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"8:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"10\",\"upi_id\":null,\"account_holder_name\":\"Manish Kumar\",\"account_number\":\"987654321234\",\"ifsc_code\":\"SBI00000021\",\"branch_name\":\"Bhubaneswar\",\"rating_patience\":\"7\",\"rating_behaviour\":\"6\",\"rating_honesty\":\"6\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y10Zm4m6hRl6IQobKiKv4dVY0exJeomjUZYX5H8UhRFGR9XSecv3a.png\",\"referance_list\":null,\"identity_information\":\"2y10WddP9HbCB1qlE1vwo1WubTzjU9rtE3LKBVwUVTUYmuMTwBByN5u.png\"}', NULL, NULL, NULL, NULL, 3, 1, 0, 0, 'MM00008', NULL, 1, 1, '754001', 1, '2023-07-01 07:57:32', '2023-07-07 18:52:27'),
(9, 2, 'Tapask', 'Kumar', 'sharataskitc@gmail.com', '8765453201', '$2y$10$et.ONbf50MroNh5psF40U.NhujvcBoa5vh..JfXuovd.uG42jbMHe', NULL, '2023-07-01 01:38:09', '{\"first_name\":\"Tapask\",\"last_name\":\"Kumar\",\"email\":\"sharataskitc@gmail.com\",\"phone\":\"8765453201\",\"whatsapp\":\"9876543270\",\"gender\":\"Male\",\"dob\":\"21-May-1995\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Job holder\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"751002\",\"present_address\":\"ABC House Nakhara\",\"permanent_address\":\"ABC House Nakhara\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"70\",\"available\":[\"All\",\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"5:30 AM\",\"to_time\":\"10:50 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"15\",\"upi_id\":null,\"account_holder_name\":\"Ranjan Mishra\",\"account_number\":\"98765432100\",\"ifsc_code\":\"SBINN 22220\",\"branch_name\":\"BTBT\",\"rating_patience\":\"9\",\"rating_behaviour\":\"9\",\"rating_honesty\":\"8\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y10Vj8gOnSNA0kYYP7uUg8ceEdLx3u5gvPvuMeuQMtm1fXlO5FHGeuC.png\",\"referance_list\":null,\"identity_information\":\"2y10ZtrFkMqqWOujvtaKPuspu8uDNr1EVsLfwS4ds6iep462isl7G6.png\"}', NULL, NULL, NULL, NULL, 3, 1, 0, 0, 'MM00009', NULL, 1, 1, '751002', 1, '2023-07-01 08:04:37', '2023-07-01 08:19:11'),
(10, 2, 'Sharat', 'Kumar', 'sharatgtalk@gmail.com', '8850021111', '$2y$10$SvQzjQ/kW5Fuwld8owXtZehuzb38D4UdqAh3k5Twgo6RqKuJIrrH2', NULL, '2023-07-01 01:45:13', '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharatgtalk@gmail.com\",\"phone\":\"8850021111\",\"whatsapp\":\"9876543210\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"000000\",\"present_address\":\"ABC House Lane 3\",\"permanent_address\":\"ABC House Lane 3\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"50\",\"available\":[\"All\",\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"upi_id\":null,\"account_holder_name\":\"D K Sahoo\",\"account_number\":\"87654321110\",\"ifsc_code\":\"HDFC000111\",\"branch_name\":\"Cuttack\",\"rating_patience\":\"7\",\"rating_behaviour\":\"7\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y1010wjrepDKPYpSBHVUQVWauSU7xO6dSRsiYS25yVzKpXd6gX0NGA0q.png\",\"referance_list\":null,\"identity_information\":\"2y10GLeWLGyZSUEl8VN1TgGyhudkzs1ZOzN7GpnhUW0MegylHDFrwasZe.png\"}', NULL, NULL, NULL, NULL, 3, 1, 0, 0, 'MM000010', NULL, 1, 1, '000000', 1, '2023-07-01 08:14:24', '2023-07-01 08:19:27'),
(11, 4, 'Mr. Pratik', 'Ray', 'mr.pratikray@gmail.com', '8765432100', '$2y$10$3N/5VFsR/d9mHuIgAMBYwe6EhxzL7D3sFROx7JZsa1nnIh/Duhrm.', NULL, '2023-07-01 01:57:52', '{\"first_name\":\"Mr. Pratik\",\"last_name\":\"Ray\",\"email\":\"mr.pratikray@gmail.com\",\"phone\":\"8765432100\",\"whatsapp\":\"9876543277\",\"gender\":\"Male\",\"are_you_owner\":\"I am Owner\",\"owner_manager_name\":\"Ramesh Chandra\",\"name_of_store\":\"DD Medicines\",\"medicine_categories\":\"General\",\"from_time\":\"7:00 AM\",\"to_time\":\"11:30 AM\",\"total_staff\":\"15\",\"discount\":\"10\",\"state\":\"Odisha\",\"dist\":\"Balasore\",\"pincode\":\"876543\",\"store_address\":\"ABC Dindabandhu Rour\",\"is_home_delivery\":\"Yes\",\"minimum_order\":\"200\",\"minimum_order_homedelivery\":\"700\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\"],\"is_dispatch_cod\":\"Yes\",\"per_percel_charge\":\"20\",\"platform_charge\":\"1\",\"is_want_to_donate\":\"Yes\",\"payment_information\":\"Account Transfer\",\"upi_id\":null,\"account_holder_name\":\"D M Rout\",\"account_number\":\"543212345\",\"ifsc_code\":\"BSI221111000\",\"branch_name\":\"Ranchi\",\"declaration\":\"declaration\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":null,\"referance_list\":null,\"identity_information\":null}', NULL, NULL, 'DD Medicines', 10, NULL, 1, 0, 0, 'MM000011', NULL, 1, 1, '876543', 1, '2023-07-01 08:24:08', '2023-07-05 16:46:54'),
(12, 2, 'Samikhya', 'Nayak', 'mymedicalmate@gmail.com', '7055421001', '$2y$10$9PtPl5JXdYHtkxR1dY97aO1Wi4UtS42NNAfu6H2EEIpX.2ZzFIzyW', NULL, '2023-07-05 10:20:57', '{\"first_name\":\"Samikhya\",\"last_name\":\"Nayak\",\"email\":\"mymedicalmate@gmail.com\",\"phone\":\"7055421001\",\"whatsapp\":\"9876543210\",\"gender\":\"Female\",\"dob\":\"30-May-1999\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Self Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754001\",\"present_address\":\"ABC House Pattamundai\",\"permanent_address\":\"ABC House Pattamundai\",\"service_area\":\"Cuttack\",\"list_of_pincodes\":[\"751024\",\"751023\",\"751020\",\"754217\",\"754111\",\"754000\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"420\",\"night_charges\":\"500\",\"hourly_charges\":\"70\",\"available\":[\"All\",\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5540\",\"km_range\":\"10-20 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"11:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"upi_id\":null,\"account_holder_name\":\"Ramesh Chandra\",\"account_number\":\"32100123211\",\"ifsc_code\":\"SBI00001231\",\"branch_name\":\"CRP Square Bhubaneswar\",\"rating_patience\":\"10\",\"rating_behaviour\":\"10\",\"rating_honesty\":\"10\",\"rating_integrity\":\"10\",\"declaration\":\"1\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y10ZDHCGGlo2y4rK1D3RkPr3aJtLeGMrMeMqPmpFyNyhzdaYOVO6m.png\",\"referance_list\":null,\"identity_information\":\"2y10mOf1ut6LkPKQAPfhaCTrp4m7gBiduOKbBJyVTGhbfBrJFDYtQxFu.png\"}', NULL, NULL, NULL, NULL, 3, 1, 0, 0, 'MM000012', NULL, 1, 1, '754001', 1, '2023-07-05 16:49:39', '2023-07-06 04:29:31'),
(13, 2, 'Sharat', 'Kumar', 'sharat.coolattitude@gmail.com', '9437627244', '$2y$10$BL43Yi/icwTfZFvDptGTuu8u0kmaHxa0HwwnwQ7zoY7luQy4LdZ3K', NULL, '2023-07-07 05:43:15', '{\"first_name\":\"Sharat\",\"last_name\":\"Kumar\",\"email\":\"sharat.coolattitude@gmail.com\",\"phone\":\"9437627244\",\"whatsapp\":\"9876543211\",\"gender\":\"Male\",\"dob\":\"28-September-1997\",\"highest_qualification\":\"M Pharma\",\"current_occupation\":\"Employee\",\"state\":\"Odisha\",\"dist\":\"Khordha\",\"pincode\":\"754321\",\"present_address\":\"ABCD Done\",\"permanent_address\":\"ABCD Done\",\"service_area\":\"Bhubaneswar\",\"list_of_pincodes\":[\"751023\"],\"service_type\":\"Medical Mate Service\",\"service_provided_type\":\"Day & Night\",\"day_charges\":\"300\",\"night_charges\":\"400\",\"hourly_charges\":\"70\",\"available\":[\"All\",\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"is_bike\":\"1\",\"per_km_harges\":\"5\",\"dl_number\":\"DLMM1111\",\"vehicle_number\":\"OD33M5547\",\"km_range\":\"40-50 KM\",\"from_time\":\"7:30 AM\",\"to_time\":\"10:30 PM\",\"payment_information\":\"Account Transfer\",\"donate_trust\":\"25\",\"upi_id\":null,\"account_holder_name\":\"Atul Kumar\",\"account_number\":\"98765432123\",\"ifsc_code\":\"SBI1111000\",\"branch_name\":\"ANNNA\",\"rating_patience\":\"10\",\"rating_behaviour\":\"10\",\"rating_honesty\":\"7\",\"rating_integrity\":\"7\",\"declaration\":\"1\",\"admin_status\":\"1\",\"status\":\"1\",\"restricted_reason\":null,\"photo\":\"2y10wP6MyqSsYOBcaBqr8KeCgULq0ZIlI8wXLarxQ8Wz8TLGZKUxTK.png\",\"referance_list\":null,\"identity_information\":\"2y10U0TSPEgl8zBlt5IRnk8ugj0CeHY87I3Rj3PP0bwY4XR9yFPLYaC.png\"}', NULL, NULL, NULL, NULL, 3, 1, 0, 0, 'MM000013', NULL, 1, 1, '754321', 1, '2023-07-07 12:12:37', '2023-07-26 13:08:08'),
(14, 1, 'Sharmistha', 'Priyadarshini', 'priyadarshinisharmistha47@gmail.com', '8093352621', '$2y$10$K6ndZ3X0x2vN2iUhtHmzPOcC.YsmBFHo6NBnAg6NO83WLCkllVXPu', NULL, '2023-07-24 11:34:34', '{\"first_name\":\"Sharmistha\",\"last_name\":\"Priyadarshini\",\"email\":\"priyadarshinisharmistha47@gmail.com\",\"phone\":\"8093352621\",\"gender\":\"\",\"dob\":\"\",\"present_address\":\"\",\"permanent_address\":\"\",\"pincode\":\"\"}', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 'MM000014', NULL, 1, 0, NULL, 0, '2023-07-24 06:04:04', '2023-07-24 06:05:31'),
(15, NULL, 'TAPAS', 'SAMAL', 'samaltapaskumar2@gmail.com', '9337600059', '$2y$10$Bd6eKXavkaCATQb4/juYAejhLEniCdwmt0lVgf8IP4bOhRFI2fWqi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'MM000015', NULL, 1, 0, NULL, 0, '2023-08-14 06:34:59', '2023-08-14 06:34:59'),
(16, NULL, 'TAPAS', 'SAMAL', 'samaltapaskumar2@gmail.com', '9337600059', '$2y$10$Y4benBKklDeVJfrPaxN0G.SA98uBDGUmAAE7xsiL08qjaRtKhgUWO', NULL, '2023-08-14 12:05:49', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 'MM000016', NULL, 1, 0, NULL, 0, '2023-08-14 06:34:59', '2023-08-14 06:35:49'),
(17, NULL, 'Tanmaya', 'Rout', 'tanmyarout101@gmail.com', '9040815030', '$2y$10$E48x/Ct2nbZs80BvKLV8Ou9u3G/wYnBuKNAF2Pb4W02NKtA3wfCdu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'MM000017', NULL, 1, 0, NULL, 0, '2023-08-14 06:41:29', '2023-08-14 06:41:29'),
(18, NULL, 'Survi', 'Digal', 'digalsurvi@gmail.com', '6370421564', '$2y$10$9VAMTe0933Ff6LEIdUt/xOa8rBikb9y9tYkH.SX7HQSwfQElmBvc.', NULL, '2023-08-14 01:21:21', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 'MM000018', NULL, 1, 0, NULL, 0, '2023-08-14 07:46:27', '2023-08-14 07:51:21'),
(19, 1, 'Tanmaya', 'Rout', 'tanmayarout54@gmail.com', '9040815030', '$2y$10$N.v7eUlVbJkZcKSVTzJfGexag8vLEfzc0Bn4gPZNxa8TMSiTqxE/q', NULL, '2023-08-14 04:36:21', '{\"first_name\":\"Tanmaya\",\"last_name\":\"Rout\",\"email\":\"tanmayarout54@gmail.com\",\"phone\":\"9040815030\",\"gender\":\"Male\",\"dob\":\"30-May-1988\",\"present_address\":\"Rahama\",\"permanent_address\":null,\"pincode\":\"754142\",\"age\":35,\"photo\":null,\"identity_information\":null}', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 'MM000019', NULL, 1, 0, '754142', 0, '2023-08-14 11:05:27', '2023-08-14 11:36:08'),
(20, NULL, 'T ke', 'susantsha', 'susantsha23@gmail.com', '8945678345', '$2y$10$ISr7zkJZuvXXdqiLPD9Qm.I9vnZd7aCCnySspeWzdmpkHY8BePp26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'MM000020', NULL, 1, 0, NULL, 0, '2023-08-14 11:44:59', '2023-08-14 11:44:59'),
(21, 1, 'asdasd', 'asdasd', 'admincust@mymedicalmate.com', '9097867564', '$2y$10$DD6VB6MWhO7RJA2cy1Ccc.xWpXYP0vwnXBxoqQVKyo7w.a.Z6EXbu', NULL, NULL, '{\"first_name\":\"asdasd\",\"last_name\":\"asdasd\",\"email\":\"admincust@mymedicalmate.com\",\"phone\":\"9097867564\",\"gender\":\"\",\"dob\":\"\",\"present_address\":\"\",\"permanent_address\":\"\",\"pincode\":\"\"}', NULL, NULL, NULL, NULL, NULL, 1, 0, 0, NULL, NULL, 1, 0, NULL, 0, '2023-08-21 13:07:09', '2023-08-22 05:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `full_name` varchar(225) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `doctorqualification` varchar(255) DEFAULT NULL,
  `univercity` varchar(70) DEFAULT NULL,
  `university_date` varchar(70) DEFAULT NULL,
  `slefemp_emplaye` varchar(255) DEFAULT NULL,
  `orgnization_name` varchar(255) DEFAULT NULL,
  `state_city` varchar(255) DEFAULT NULL,
  `landmark_pincode` varchar(255) DEFAULT NULL,
  `avl_days` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Verified by admin,0=UnVerified,2=pending',
  `from_time` varchar(255) DEFAULT NULL,
  `to_time` varchar(255) DEFAULT NULL,
  `consul_fee_from` varchar(255) DEFAULT NULL,
  `consul_fee_to` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `youth_profile_url` varchar(255) DEFAULT NULL,
  `twiter_profile_url` varchar(255) DEFAULT NULL,
  `doctorachievement_file` varchar(255) DEFAULT NULL,
  `designation` varchar(225) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `total_experience` varchar(225) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `mobile` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `website_url` text DEFAULT NULL,
  `social_media_link` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `comments_date` varchar(70) DEFAULT NULL,
  `star_ratings` varchar(225) DEFAULT NULL,
  `profile_picture` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etablished_year` varchar(255) DEFAULT NULL,
  `type_hospital` varchar(255) DEFAULT NULL,
  `specialized` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `achievement_award` text DEFAULT NULL,
  `multi_specialist` enum('0','1') DEFAULT NULL COMMENT '0-no,1-yes',
  `available_test` text DEFAULT NULL,
  `course_offered` text DEFAULT NULL,
  `last_date_of_apply` timestamp NULL DEFAULT NULL,
  `total_vacancy` varchar(255) DEFAULT NULL,
  `exam_date` timestamp NULL DEFAULT NULL,
  `references_site` text DEFAULT NULL,
  `references_hos_doc` text DEFAULT NULL,
  `doc_profile` text DEFAULT NULL,
  `prime_contain` text DEFAULT NULL,
  `sec_contain` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`id`, `account_id`, `full_name`, `gender`, `doctorqualification`, `univercity`, `university_date`, `slefemp_emplaye`, `orgnization_name`, `state_city`, `landmark_pincode`, `avl_days`, `status`, `from_time`, `to_time`, `consul_fee_from`, `consul_fee_to`, `instagram_url`, `youth_profile_url`, `twiter_profile_url`, `doctorachievement_file`, `designation`, `department`, `total_experience`, `location`, `mobile`, `email`, `website_url`, `social_media_link`, `description`, `comments`, `comments_date`, `star_ratings`, `profile_picture`, `created_at`, `updated_at`, `etablished_year`, `type_hospital`, `specialized`, `telephone`, `achievement_award`, `multi_specialist`, `available_test`, `course_offered`, `last_date_of_apply`, `total_vacancy`, `exam_date`, `references_site`, `references_hos_doc`, `doc_profile`, `prime_contain`, `sec_contain`) VALUES
(13, 1, 'Harish das', 'Male', 'MMBSS', 'Utkal', '2010', 'Self-Employed', 'Hanshupal', 'bhunaswar', 'Jaydev Vihar, Bhubaneswar 754234', 'TUESDAY,SUNDAY,MONDAY', 1, '5:30 am', '5:30 am', '300', '350', 'https://www.instagram.com/', 'https://www.youtube.com/', 'https://twitter.com/i/flow/login', NULL, 'aBCD', 'dfdf', '30', 'jaidevbihar', '8904756345', 'tanmayarout54@gmail.com', 'https://stackoverflow.com/questions', 'https://www.facebook.com/', 'Lead Developer Snowflake Architect - As a Lead Developer Snowflake Architect, you will play a crucial role in designing\r\n                                                                    and implementing data solutions using the Snowflake cloud data platform. Your primary responsibility will be to lead a\r\n                                                                    team of developers and data high-performance Develop custom user-defined functions (UDFs) to extend Snowflake\'s\r\n                                                                    native capabilities and optimize query performance. Technical Leadership: Lead a team of developers and data\r\n                                                                    engineers, providing technical guidance, mentoring, and support throughout the development lifecycle. Drive best\r\n                                                                    practices, code reviews, and ensure the team follows industry standards and conventions.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL, 'images/GnH8uMPvicVfFt8MyopBsNTkmLjfcxWIw8Rna4ef.jpg', '2023-08-28 06:17:53', '2023-09-30 10:49:57', NULL, NULL, NULL, NULL, 'goalachive', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 'Dr.Susanta ku dasxx', 'Other', 'MMB', 'Utkala', '2010', 'Self-Employed', 'Hanshupal', 'bhunaswar', 'Acharya vihar Bhubaneswar 754234', 'TUESDAY', 1, '11:29 am', '5:30 am', '300', '360', 'https://www.instagram.com/', 'https://www.youtube.com/', 'https://twitter.com/i/flow/login', NULL, 'aBCD', 'dfdf', '30', 'jaidevbihar', '8904756346', 'tykab43@GMAIL.COM', 'https://stackoverflow.com/questions', 'https://www.facebook.com/', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL, 'images/MHmsdylPDmp7UDtpjfzZqzmbpkr82GcsqVxoSGkI.jpg', '2023-08-28 06:26:31', '2023-09-28 10:38:11', NULL, NULL, NULL, NULL, 'goalachive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, 'Dr.Debasis das', 'Male', 'MMB', NULL, NULL, 'Self-Employed', 'Hanshupal', 'bhunaswar', 'Jaydev Vihar Bhubaneswar 754234', 'SUNDAY,MONDAY,TUESDAY', 2, '11:29 am', '12:29 am', '300', '350', 'https://www.instagram.com/', 'https://www.youtube.com/', 'https://twitter.com/i/flow/login', NULL, 'aBCD', 'dfdf', '30', 'jaidevbihar', '8904756345', 'znmse123@GMAIL.COM', 'https://stackoverflow.com/questions', 'https://www.facebook.com/', 'newValuedc', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, NULL, 'images/DZpdZz6sj4qyqXaV7NOIAAOCGDyHMkFmeM78iD2d.jpg', '2023-08-28 07:03:39', '2023-09-18 10:24:06', NULL, NULL, NULL, NULL, 'goalachive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, 'Sukanta das', 'Male', 'MMB', NULL, NULL, 'Self-Employed', 'Hanshupal', 'bhunaswar', '754234', 'SUNDAY', 0, '11:29 am', '12:29 am', '300', '350', 'https://www.instagram.com/', 'https://www.youtube.com/', 'https://twitter.com/i/flow/login', 'D:\\xampp\\tmp\\php6396.tmp', 'aBCD', 'dfdf', '30', 'jaidevbihar', '8904756345', 'axcd123@GMAIL.COM', 'https://stackoverflow.com/questions', 'https://www.facebook.com/', 'Description', '', NULL, '1,2,3,4,5', 'images/QYiTsDQn99V8TESX6ZO0F2d74JKtU4nCi6F76Atg.jpg', '2023-08-28 07:10:14', '2023-08-29 11:49:53', NULL, NULL, NULL, NULL, 'goalachive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, 'Dr. Ansuman', 'Female', 'MMB', NULL, NULL, 'Self-Employed', 'Hanshupal', 'bhunaswar', 'Nayapalli, Bhubaneswar 754234', 'SUNDAY,MONDAY,TUESDAY', 0, '2:57 pm', '2:58 pm', '200', '250', 'instagram', 'youtub', 'twiter', 'D:\\xampp\\tmp\\phpCF3C.tmp', 'aBCD', 'dfdf', '30', 'jaidevbihar', '8904756345', 'qwopcrf13@GMAIL.COM', 'https://stackoverflow.com/questions', 'facebook', 'description', NULL, NULL, '1,2,3,4', 'images/nTU4H0NgyxlCCReADGbn52Rh6bZOKv1nLSoRbOt1.jpg', '2023-08-31 09:28:44', '2023-08-31 09:28:44', NULL, NULL, NULL, NULL, 'goalachive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, 'Dr.Susantanayak', 'Male', 'MMB', NULL, '2020', 'Self-Employed', 'Hanshupal', 'bhunaswar', 'Nayapalli, Bhubaneswar 754234', 'SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,FRIDAY,SATERDAY', 0, '9:51 pm', '11:54 pm', '300', '350', NULL, NULL, NULL, 'D:\\xampp\\tmp\\php7D11.tmp', 'aBCD', 'dfdf', '30', 'jaidevbihar', '8904756345', 'axcd123@GMAIL.COM', 'https://stackoverflow.com/questions', NULL, 'desc', NULL, NULL, NULL, 'images/6Nl1DyJfUXxYTGRWxVySQyHp3RB0QW6DI3GeCB3O.jpg', '2023-09-12 10:55:31', '2023-09-12 13:19:32', NULL, NULL, NULL, NULL, 'goalachive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, 'Dr.Dalai shoo', 'Male', 'BBA', 'Utkal', '2010', 'Self-Employed', 'Hanshup', 'bhunaswar', 'Near sumhospital 3456782345', 'SUNDAY,MONDAY,TUESDAY,WEDNESDAY,THURSDAY,SATERDAY', 1, '5:30 am', '5:30 am', '200', '360', NULL, NULL, NULL, NULL, 'Dotorate', 'cadiology', '55', 'jaidevbihar', '8904756908', 'dalaishoo23@gmail.com', 'https://stackoverflow.com/questions', NULL, NULL, NULL, NULL, NULL, NULL, '2023-09-15 07:02:25', '2023-10-07 10:15:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, 'sum hospital', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bhubanaswar', NULL, NULL, 'https://stackoverflow.com/questions', 'socialmedialink', 'description', NULL, NULL, '3', 'images/XHgLlW3nbfJH0Xi3UUKQ11MI2hwlXUmcms2mcssb.jpg', '2023-09-15 07:30:56', '2023-09-15 07:30:56', '1980', 'Type 1', 'Specialization 1', '2345673456', '[\"images\\/UkKq1eOQtUOkCiC0QqlYHykkCy23riWvlIZ4XVqd.jpg\"]', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, 'Susanta Swain', 'Male', 'MBBS', 'Utkal', '2018', 'Self-Employed', 'Utkal Hospital', 'Bhubaneswar', 'Near sumhospital 7540', 'SUNDAY,TUESDAY', 1, '5:30 am', '5:30 am', '200', '240', NULL, NULL, NULL, NULL, 'Professor', 'cadiology', '30', 'jayadev vihar', '9876789034', 'sharatze@gmail.com', 'https://stackoverflw.com/questions', NULL, 'View Page & Edit Page', NULL, NULL, NULL, 'images/1UFDyIpsnJx4b4VQD88cuYaIq8uOQnHOqsSv7mId.webp', '2023-09-28 13:53:09', '2023-09-30 08:08:26', NULL, NULL, NULL, NULL, 'National Award', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_prescriptions`
--

CREATE TABLE `customer_prescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `prescription_photo` varchar(70) DEFAULT NULL,
  `medicine` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`medicine`)),
  `full_name` varchar(70) DEFAULT NULL,
  `mobile_no` varchar(70) DEFAULT NULL,
  `gender` varchar(70) DEFAULT NULL,
  `age` varchar(70) DEFAULT NULL,
  `ship_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Courier,2=Transportation',
  `delivery_address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`delivery_address`)),
  `note` text DEFAULT NULL,
  `customer_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-Uploaded, 2-Assigned To Vendor, 3-Pending From Customer, 4-Confirmed, 5-Ready To Dispatched,9-Waiting For Payment Approval,10-waiting for Delivery Boy,11-Dispatched, 6-Delivered, 7-Return, 8-Returned, 0-Cancelled',
  `is_vendor_assigned` int(11) DEFAULT NULL,
  `order_id` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_prescriptions`
--

INSERT INTO `customer_prescriptions` (`id`, `customer_id`, `prescription_photo`, `medicine`, `full_name`, `mobile_no`, `gender`, `age`, `ship_type`, `delivery_address`, `note`, `customer_status`, `is_vendor_assigned`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '[{\"medicine\":\"med1\",\"quantity\":\"10\",\"photo\":null},{\"medicine\":\"med2\",\"quantity\":\"10\",\"photo\":null}]', 'Odette Burt', '7654345432', 'Female', '23', 2, '{\"city\":\"bbsr\",\"state\":\"Odisha\",\"zip\":\"751024\",\"country\":\"India\",\"address\":\"A Block 23\\/345 patia bbsr\"}', NULL, 6, 1, '952321', '2023-07-01 07:22:35', '2023-07-01 07:32:38'),
(2, 2, '2y10LCFj83M7ztrA7iKKbX0eTsni2fVPrsVsoDMNyiCMw4RnjJG8s2.png', '[{\"medicine\":\"MMDD TT\",\"quantity\":\"4\",\"photo\":\"2y10PVrLpu53cfffPPGKR8HNuPNVqntu8FVpehfbkHVsTL3BYcTod85.png\"},{\"medicine\":\"RAZO TMM\",\"quantity\":\"4\",\"photo\":\"2y10DtCPP3Wez7t1Dq2s7DqADyk5MyONUeatgVnERbEsZmr4zmWJTgW.png\"},{\"medicine\":\"ABC\",\"quantity\":\"4\",\"photo\":\"2y103c0uPiy1TMZkIjhwKhClOMehvVzANehfLTLNItGbSP5qkYjSF12.png\"}]', 'Sathish Mishra', '09876541444', 'Female', '55', 2, '{\"city\":\"Cuttack\",\"state\":\"Odisha\",\"zip\":\"80122\",\"country\":\"India\",\"address\":\"ABC House Cuttack\"}', NULL, 2, 1, '132288', '2023-07-03 14:30:16', '2023-07-03 14:52:13'),
(3, 2, '2y10xjIvPG4Ng3lv0tuxjGdN8eiQTiTCCv1c088W024EueO6QLI0Xt0e.png', '[{\"medicine\":\"MMDD TT\",\"quantity\":\"4\",\"photo\":\"2y10VZlO7VDjNpIzkcBR5K9YrOjBgmESiqB2qZY1G8FVC5jsHwrQI4ua.png\"},{\"medicine\":\"MMDD TT\",\"quantity\":\"4\",\"photo\":\"2y10Z9YoEaeYlFm7YGbxkymuWfDc99Ewc9VX3LTm2gMObh3oWcQs8Fm.png\"},{\"medicine\":\"MMDD TT\",\"quantity\":\"4\",\"photo\":\"2y10Sgxzhj7fbJL1v8HvOUVhOi1xHqcXIb1lU5a3VIe9YidQd1fPDvVu.png\"}]', 'Ramesh Kumar', '9876543210', 'Female', '55', 2, '{\"city\":\"Cuttack\",\"state\":\"Odisha\",\"zip\":\"754111\",\"country\":\"India\",\"address\":\"Hariharapur, Cuttack\"}', NULL, 5, 1, '670918', '2023-07-04 09:33:23', '2023-07-04 10:34:46'),
(4, 2, NULL, '[{\"medicine\":\"MMDD TT\",\"quantity\":\"4\",\"photo\":\"2y10cg4iW5yBSdW0CYcnBxRtetABzUsQZpFoBRX7EMXt8VwM3rvwPiaW.png\"},{\"medicine\":\"MMDD TT\",\"quantity\":\"4\",\"photo\":\"2y10wHqxT1u9QiXu73WtE85zRXsfJk8ikWQyYUqbkRNq4imyXOUuh0O.png\"},{\"medicine\":\"RAZO TMM\",\"quantity\":\"4\",\"photo\":\"2y10MvfO9V7MJxTLQG5SIcywOdQCRCDXbnVAJnX84ZJUk4Qzv4kcoxz2.png\"},{\"medicine\":\"MMDD TT\",\"quantity\":\"5\",\"photo\":\"2y101caP8IH657r5ZgQaT7tt6OopDYLDT0dT1FgoiYdxtNFyUgEBG6Eq.png\"}]', 'Sharat Kumar', '9437627244', 'Male', '40', 2, '{\"city\":\"Bhubaneswar\",\"state\":\"Odisha\",\"zip\":\"754005\",\"country\":\"India\",\"address\":\"Patia Raghunathpur, Royal Lagoon\"}', NULL, 1, NULL, '886996', '2023-07-05 16:45:28', '2023-07-05 16:45:28'),
(5, 2, '2y10oF1HxHNevsQ4sgazWUsLysyffwoGhhoBX3efbptgFBhwWQ9vQPPC.png', '[{\"medicine\":\"A\",\"quantity\":\"10\",\"photo\":\"2y109sEPfr7DXdSRxhWLkITdJdIfTp4CuSP9pD96pUgtYmVh1Ftg6.png\"},{\"medicine\":\"HHM\",\"quantity\":\"7\",\"photo\":\"2y107O4i0o6l7oQ0TS0bZ3pOMOeGb6GG8mLwYlhnm5AWZPVQF8tqFQS.png\"}]', 'TEK SHARAT', '9876543210', 'Male', '25', 3, '{\"address\":\"Bhubaneswar Nayapali\"}', NULL, 3, 1, '431145', '2023-07-13 14:54:50', '2023-07-13 14:58:31'),
(6, 2, NULL, '[{\"medicine\":\"Tablet A\",\"quantity\":\"10\",\"photo\":null},{\"medicine\":\"Tablet B\",\"quantity\":\"10\",\"photo\":null},{\"medicine\":\"Tablet C\",\"quantity\":\"10\",\"photo\":null}]', 'TEK SHARAT', '9876543210', 'Male', '23', 1, NULL, NULL, 2, 1, '996402', '2023-07-27 11:36:03', '2023-07-27 12:31:32'),
(7, 2, '2y10Pvf1UqJvxnJ15CUyDYkyOWQ4enxpkez0eW07VsQiUOMkn07fu7S.png', '[{\"medicine\":\"DMM\",\"quantity\":\"9\",\"photo\":\"2y10kHheAhp7UuIgrek3mPlx3u3CaRyEHa0Z9xrzswpzYsjeMz628wZ.png\"},{\"medicine\":\"DMM\",\"quantity\":\"7\",\"photo\":\"2y10yaRKdOMaZHOip28XbJmteBmmhq0ONCMoyXO54FhZAigyiyoftb.png\"},{\"medicine\":\"DMM\",\"quantity\":\"7\",\"photo\":\"2y10aFdFEgwzmJV14msljTgUyuVIoAR4BfA82O3SjwW8p9gixiZTDvNO.png\"}]', 'TEK SHARAT', '9876543210', 'Female', '30', 3, '{\"address\":\"Kendrapara, Odisha\"}', NULL, 2, 1, '604700', '2023-08-09 11:50:07', '2023-08-09 11:55:18'),
(8, 2, '2y10cTtxNUXqqwQBeIW4XIEdu7oeUrc2IDeu1sA2hyDAueMvYIhUSk6.png', '[{\"medicine\":\"DMM\",\"quantity\":\"5\",\"photo\":\"2y10uceJ4fy7p7CDuy2jiX8yuu0txAMeThvNrIpZiI7pFqV2WU9nKYIqe.png\"},{\"medicine\":\"DMM\",\"quantity\":\"7\",\"photo\":\"2y108s1PiyoKxTdB1a21CPi0du0LUSXVaXcSpWTWJ5AvfwLReZVxR2y.png\"}]', 'TEK SHARAT', '9876543210', 'Male', '31', 3, '{\"address\":\"Jayadev Vihar Bhubaneswar\"}', NULL, 2, 1, '353577', '2023-08-14 06:33:51', '2023-08-14 06:37:10'),
(9, 2, '2y106UJeQzYp46d7XX4bIDDyAewbT5VcgsgChIOdH7j1vuuAxnfmsGQK.png', '[{\"medicine\":\"Sai Medicine Store\",\"quantity\":\"1\",\"photo\":null}]', 'TEK SHARAT', '9876543210', 'Male', '1', 1, NULL, NULL, 1, NULL, '987748', '2023-08-14 10:38:36', '2023-08-14 10:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `disease_details`
--

CREATE TABLE `disease_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disease_id` bigint(20) DEFAULT NULL,
  `disease_desc` text DEFAULT NULL,
  `disease_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locators`
--

CREATE TABLE `locators` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `device_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Web,2=Android,3=Ios',
  `ip_address` varchar(70) DEFAULT NULL,
  `city` varchar(70) DEFAULT NULL,
  `country` varchar(70) DEFAULT NULL,
  `country_code` varchar(70) DEFAULT NULL,
  `region` varchar(70) DEFAULT NULL,
  `geo_location_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `device_browser_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`device_browser_info`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locators`
--

INSERT INTO `locators` (`id`, `customer_id`, `device_type`, `ip_address`, `city`, `country`, `country_code`, `region`, `geo_location_info`, `device_browser_info`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 12:15:46', '2023-01-23 12:15:46'),
(2, 2, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 12:17:47', '2023-01-23 12:17:47'),
(3, 3, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 12:32:34', '2023-01-23 12:32:34'),
(4, 4, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 12:50:36', '2023-01-23 12:50:36'),
(5, 5, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 13:32:21', '2023-01-23 13:32:21'),
(6, 6, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 14:07:18', '2023-01-23 14:07:18'),
(7, 7, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 16:18:54', '2023-01-23 16:18:54'),
(8, 8, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 16:21:00', '2023-01-23 16:21:00'),
(9, 9, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 17:20:32', '2023-01-23 17:20:32'),
(10, 10, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-23 19:58:48', '2023-01-23 19:58:48'),
(11, 11, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-24 14:49:35', '2023-01-24 14:49:35'),
(12, 12, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-25 10:23:46', '2023-01-25 10:23:46'),
(13, 13, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-25 11:18:42', '2023-01-25 11:18:42'),
(14, 14, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-25 13:14:30', '2023-01-25 13:14:30'),
(15, 15, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-26 20:08:25', '2023-01-26 20:08:25'),
(16, 16, 1, '182.79.88.222', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/110.0\",\"name\":\"Mozilla Firefox\",\"version\":\"110.0\",\"platform\":\"windows\"}', '2023-01-27 14:04:35', '2023-01-27 14:04:35'),
(17, 17, 1, '112.196.169.195', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-01-31 21:44:09', '2023-01-31 21:44:09'),
(18, 18, 1, '49.37.115.153', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/109.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"109.0.0.0\",\"platform\":\"windows\"}', '2023-02-08 22:13:19', '2023-02-08 22:13:19'),
(19, 19, 1, '157.41.228.204', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-02-12 12:33:14', '2023-02-12 12:33:14'),
(20, 20, 1, '49.37.113.142', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-02-28 19:50:07', '2023-02-28 19:50:07'),
(21, 21, 1, '49.37.113.142', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-01 11:06:57', '2023-03-01 11:06:57'),
(22, 1, 1, '103.24.85.220', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-07 06:25:03', '2023-03-07 06:25:03'),
(23, 1, 1, '42.111.162.48', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-07 06:33:39', '2023-03-07 06:33:39'),
(24, 2, 1, '42.111.162.48', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-07 06:36:26', '2023-03-07 06:36:26'),
(25, 3, 1, '42.111.162.48', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-07 07:02:47', '2023-03-07 07:02:47'),
(26, 4, 1, '106.207.84.235', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-07 08:45:17', '2023-03-07 08:45:17'),
(27, 5, 1, '106.207.84.235', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/110.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"110.0.0.0\",\"platform\":\"windows\"}', '2023-03-07 08:51:02', '2023-03-07 08:51:02'),
(28, 6, 1, '49.37.113.124', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-10 15:26:14', '2023-03-10 15:26:14'),
(29, 7, 1, '49.37.113.124', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-10 15:40:06', '2023-03-10 15:40:06'),
(30, 8, 1, '49.37.113.124', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-10 15:49:22', '2023-03-10 15:49:22'),
(31, 9, 1, '49.37.113.124', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-10 16:26:28', '2023-03-10 16:26:28'),
(32, 10, 1, '49.37.113.124', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-10 16:39:54', '2023-03-10 16:39:54'),
(33, 11, 1, '157.41.228.63', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-14 16:52:56', '2023-03-14 16:52:56'),
(34, 12, 1, '157.41.228.63', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-03-14 17:00:53', '2023-03-14 17:00:53'),
(35, 13, 1, '157.41.254.59', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 10; CPH2179) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/83.0.4103.106 Mobile Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"83.0.4103.106\",\"platform\":\"linux\"}', '2023-04-06 19:43:44', '2023-04-06 19:43:44'),
(36, 14, 1, '157.41.254.59', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 10; CPH2179) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/83.0.4103.106 Mobile Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"83.0.4103.106\",\"platform\":\"linux\"}', '2023-04-06 19:47:14', '2023-04-06 19:47:14'),
(37, 15, 1, '157.41.241.38', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/111.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"111.0.0.0\",\"platform\":\"windows\"}', '2023-04-11 11:46:20', '2023-04-11 11:46:20'),
(38, 1, 1, '157.41.199.34', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-19 05:35:45', '2023-04-19 05:35:45'),
(39, 2, 1, '157.41.229.73', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-19 08:45:05', '2023-04-19 08:45:05'),
(40, 3, 1, '157.41.229.73', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-19 08:50:25', '2023-04-19 08:50:25'),
(41, 4, 1, '157.41.249.168', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-19 11:31:02', '2023-04-19 11:31:02'),
(42, 5, 1, '223.176.64.233', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-19 15:40:14', '2023-04-19 15:40:14'),
(43, 6, 1, '157.41.229.234', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-20 10:35:41', '2023-04-20 10:35:41'),
(44, 7, 1, '157.41.229.186', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-20 12:13:55', '2023-04-20 12:13:55'),
(45, 8, 1, '157.41.229.186', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-20 12:37:25', '2023-04-20 12:37:25'),
(46, 9, 1, '223.231.212.233', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-24 03:06:44', '2023-04-24 03:06:44'),
(47, 10, 1, '106.207.105.205', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-25 19:21:39', '2023-04-25 19:21:39'),
(48, 11, 1, '106.207.105.201', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36 Edg\\/112.0.1722.58\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-26 13:31:39', '2023-04-26 13:31:39'),
(49, 12, 1, '223.231.196.254', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36 Edg\\/112.0.1722.58\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-04-27 16:44:38', '2023-04-27 16:44:38'),
(50, 1, 1, '157.41.240.237', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-05-05 18:45:16', '2023-05-05 18:45:16'),
(51, 2, 1, '157.41.240.237', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-05-05 18:53:15', '2023-05-05 18:53:15'),
(52, 3, 1, '157.41.240.61', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/112.0\",\"name\":\"Mozilla Firefox\",\"version\":\"112.0\",\"platform\":\"windows\"}', '2023-05-06 02:18:01', '2023-05-06 02:18:01'),
(53, 4, 1, '157.41.240.61', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/112.0\",\"name\":\"Mozilla Firefox\",\"version\":\"112.0\",\"platform\":\"windows\"}', '2023-05-06 02:32:39', '2023-05-06 02:32:39'),
(54, 5, 1, '157.41.240.61', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-05-06 03:05:10', '2023-05-06 03:05:10'),
(55, 6, 1, '117.217.53.74', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-05-06 05:43:48', '2023-05-06 05:43:48'),
(56, 7, 1, '157.41.240.182', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-05-06 05:59:34', '2023-05-06 05:59:34'),
(57, 8, 1, '157.41.240.182', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/112.0.0.0 Safari\\/537.36 Edg\\/112.0.1722.68\",\"name\":\"Google Chrome\",\"version\":\"112.0.0.0\",\"platform\":\"windows\"}', '2023-05-06 08:16:50', '2023-05-06 08:16:50'),
(58, 1, 1, '106.216.68.253', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-16 05:55:31', '2023-05-16 05:55:31'),
(59, 2, 1, '106.216.68.253', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-16 05:58:59', '2023-05-16 05:58:59'),
(60, 3, 1, '106.216.68.253', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-16 06:03:17', '2023-05-16 06:03:17'),
(61, 4, 1, '106.216.68.253', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/113.0\",\"name\":\"Mozilla Firefox\",\"version\":\"113.0\",\"platform\":\"windows\"}', '2023-05-16 06:30:34', '2023-05-16 06:30:34'),
(62, 5, 1, '106.216.68.237', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-16 14:15:34', '2023-05-16 14:15:34'),
(63, 6, 1, '49.37.117.28', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-16 15:19:56', '2023-05-16 15:19:56'),
(64, 7, 1, '49.37.117.28', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-16 15:26:39', '2023-05-16 15:26:39'),
(65, 8, 1, '117.201.122.12', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-17 16:59:31', '2023-05-17 16:59:31'),
(66, 9, 1, '49.37.117.12', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-21 06:56:34', '2023-05-21 06:56:34'),
(67, 10, 1, '106.207.105.253', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-23 08:17:03', '2023-05-23 08:17:03'),
(68, 11, 1, '157.48.212.90', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/113.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"113.0.0.0\",\"platform\":\"windows\"}', '2023-05-29 05:49:48', '2023-05-29 05:49:48'),
(69, 1, 1, '103.24.85.123', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-18 05:17:31', '2023-06-18 05:17:31'),
(70, 2, 1, '223.231.230.190', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-18 05:24:42', '2023-06-18 05:24:42'),
(71, 3, 1, '223.231.230.190', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-18 05:30:53', '2023-06-18 05:30:53'),
(72, 4, 1, '223.231.230.190', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-18 05:42:37', '2023-06-18 05:42:37'),
(73, 5, 1, '103.24.85.123', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-18 06:12:37', '2023-06-18 06:12:37'),
(74, 6, 1, '103.24.85.123', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-19 16:38:39', '2023-06-19 16:38:39'),
(75, 7, 1, '117.216.127.95', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/114.0\",\"name\":\"Mozilla Firefox\",\"version\":\"114.0\",\"platform\":\"windows\"}', '2023-06-20 06:11:59', '2023-06-20 06:11:59'),
(76, 8, 1, '157.41.198.4', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Linux; Android 10; CPH2185) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/83.0.4103.106 Mobile Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"83.0.4103.106\",\"platform\":\"linux\"}', '2023-06-20 19:20:37', '2023-06-20 19:20:37'),
(77, 1, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-22 13:09:12', '2023-06-22 13:09:12'),
(78, 2, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-22 13:14:11', '2023-06-22 13:14:11'),
(79, 3, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko\\/20100101 Firefox\\/113.0\",\"name\":\"Mozilla Firefox\",\"version\":\"113.0\",\"platform\":\"windows\"}', '2023-06-22 13:49:57', '2023-06-22 13:49:57'),
(80, 4, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 06:37:30', '2023-06-23 06:37:30'),
(81, 5, 1, '110.224.105.24', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 07:28:59', '2023-06-23 07:28:59'),
(82, 6, 1, '110.224.106.24', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 07:42:30', '2023-06-23 07:42:30'),
(83, 7, 1, '110.224.110.24', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 07:55:29', '2023-06-23 07:55:29'),
(84, 8, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 09:14:19', '2023-06-23 09:14:19'),
(85, 9, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 10:13:45', '2023-06-23 10:13:45'),
(86, 10, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-23 10:17:02', '2023-06-23 10:17:02'),
(87, 11, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-24 15:14:27', '2023-06-24 15:14:27'),
(88, 12, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-24 15:20:32', '2023-06-24 15:20:32'),
(89, 13, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-24 17:07:06', '2023-06-24 17:07:06'),
(90, 14, 1, '117.217.57.71', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-28 05:08:06', '2023-06-28 05:08:06'),
(91, 15, 1, '117.217.57.71', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-28 05:58:14', '2023-06-28 05:58:14'),
(92, 16, 1, '117.217.57.71', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-28 06:02:58', '2023-06-28 06:02:58'),
(93, 17, 1, '14.194.70.158', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-06-28 20:13:20', '2023-06-28 20:13:20'),
(94, 1, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 06:13:06', '2023-07-01 06:13:06'),
(95, 2, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 06:14:31', '2023-07-01 06:14:31'),
(96, 3, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 06:18:08', '2023-07-01 06:18:08'),
(97, 4, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 06:18:22', '2023-07-01 06:18:22'),
(98, 5, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 06:24:45', '2023-07-01 06:24:45'),
(99, 6, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(100, 7, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 07:41:57', '2023-07-01 07:41:57'),
(101, 8, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 07:57:32', '2023-07-01 07:57:32'),
(102, 9, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 08:04:37', '2023-07-01 08:04:37'),
(103, 10, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 08:14:24', '2023-07-01 08:14:24'),
(104, 11, 1, '45.121.2.99', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-01 08:24:08', '2023-07-01 08:24:08'),
(105, 12, 1, '223.176.106.119', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-05 16:49:39', '2023-07-05 16:49:39'),
(106, 13, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-07 12:12:37', '2023-07-07 12:12:37'),
(107, 14, 1, '117.97.208.23', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/114.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"114.0.0.0\",\"platform\":\"windows\"}', '2023-07-24 06:04:04', '2023-07-24 06:04:04'),
(108, 16, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/115.0.0.0 Safari\\/537.36 Edg\\/115.0.1901.200\",\"name\":\"Google Chrome\",\"version\":\"115.0.0.0\",\"platform\":\"windows\"}', '2023-08-14 06:34:59', '2023-08-14 06:34:59'),
(109, 15, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/115.0.0.0 Safari\\/537.36 Edg\\/115.0.1901.200\",\"name\":\"Google Chrome\",\"version\":\"115.0.0.0\",\"platform\":\"windows\"}', '2023-08-14 06:34:59', '2023-08-14 06:34:59'),
(110, 17, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/115.0.0.0 Safari\\/537.36 Edg\\/115.0.1901.200\",\"name\":\"Google Chrome\",\"version\":\"115.0.0.0\",\"platform\":\"windows\"}', '2023-08-14 06:41:29', '2023-08-14 06:41:29'),
(111, 18, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/115.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"115.0.0.0\",\"platform\":\"windows\"}', '2023-08-14 07:46:27', '2023-08-14 07:46:27'),
(112, 19, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/115.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"115.0.0.0\",\"platform\":\"windows\"}', '2023-08-14 11:05:27', '2023-08-14 11:05:27'),
(113, 20, 1, '49.249.181.214', NULL, NULL, NULL, NULL, NULL, '{\"user_agent\":\"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/115.0.0.0 Safari\\/537.36\",\"name\":\"Google Chrome\",\"version\":\"115.0.0.0\",\"platform\":\"windows\"}', '2023-08-14 11:44:59', '2023-08-14 11:44:59');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_02_12_065902_create_permission_tables', 1),
(11, '2021_02_10_190747_create_account_types_table', 2),
(16, '2021_02_15_193544_create_customers_table', 3),
(18, '2021_02_15_193612_create_locators_table', 4),
(23, '2021_04_15_003750_create_assistant_boy_bookings_table', 6),
(28, '2021_04_25_150614_create_configurations_table', 9),
(29, '2021_04_29_020315_create_assistant_fwrd_bookings_table', 10),
(30, '2021_04_29_021536_create_assistant_cancel_bookings_table', 11),
(31, '2021_05_21_234943_create_assistant_reviews_table', 12),
(32, '2021_04_06_011457_create_customer_prescriptions_table', 13),
(33, '2021_07_19_233712_create_vendor_prescriptions_table', 14),
(34, '2021_09_12_000348_create_reasons_table', 15),
(35, '2021_10_20_011746_create_suggetions_table', 16),
(36, '2023_09_15_173946_create_alltype_user_logs_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_user` bigint(20) NOT NULL,
  `from_user` bigint(20) NOT NULL,
  `to_user_type` varchar(255) NOT NULL,
  `from_user_type` varchar(255) NOT NULL,
  `notification_type` varchar(255) NOT NULL,
  `notification_message` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `is_readed` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('441e714453c24b96c996f4d7eaf8bdfd33f85f6952b85dc37527213eeb96f3e7ce76fffbbbb31061', 1, 1, 'Personal Access Token', '[]', 1, '2021-01-19 16:19:45', '2021-01-19 16:19:45', '2022-01-19 21:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
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
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
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
(1, NULL, 'Laravel Personal Access Client', 'tt0Tyedv8EyxNfrI6viP0E2E2XezsDVXv7urcpdh', NULL, 'http://localhost', 1, 0, 0, '2021-01-19 16:14:18', '2021-01-19 16:14:18'),
(2, NULL, 'Laravel Password Grant Client', 'KLTjDt0j1lH1s5SfQm5ktAY30KHPq5URw0kYvc8u', 'users', 'http://localhost', 0, 1, 0, '2021-01-19 16:14:18', '2021-01-19 16:14:18');

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
(1, 1, '2021-01-19 16:14:18', '2021-01-19 16:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_medmates`
--

CREATE TABLE `order_medmates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medmate_id` int(10) UNSIGNED DEFAULT NULL,
  `booking_id` int(10) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-Assign, 1-Approved, 2-Cancelled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_medmates`
--

INSERT INTO `order_medmates` (`id`, `medmate_id`, `booking_id`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 255618, NULL, 1, '2023-07-01 09:42:56', '2023-07-01 09:58:10'),
(6, 9, 597558, NULL, 1, '2023-07-01 09:56:19', '2023-07-03 06:11:48'),
(12, 8, 632971, NULL, 1, '2023-07-02 04:30:13', '2023-07-02 04:59:46'),
(20, 8, 832725, NULL, 1, '2023-07-02 12:29:47', '2023-07-02 12:30:07'),
(24, 8, 625435, NULL, 1, '2023-07-03 05:26:34', '2023-07-03 15:35:08'),
(28, 8, 459887, NULL, 1, '2023-07-03 15:12:15', '2023-07-03 15:14:36'),
(31, 8, 241173, NULL, 1, '2023-07-03 15:24:45', '2023-07-03 15:25:07'),
(39, 8, 745907, NULL, 1, '2023-07-03 15:39:09', '2023-07-03 15:39:29'),
(41, 8, 102858, NULL, 1, '2023-07-05 17:14:11', '2023-08-14 06:29:19'),
(49, 9, 215580, NULL, 1, '2023-07-05 17:17:22', '2023-07-05 17:19:40'),
(53, 12, 244282, NULL, 1, '2023-07-06 04:37:57', '2023-08-09 11:47:19'),
(60, 3, 423870, NULL, 1, '2023-07-13 14:48:55', '2023-07-13 14:50:33'),
(64, 8, 446484, NULL, 1, '2023-08-14 06:23:41', '2023-08-14 06:25:52'),
(70, 8, 353577, NULL, 1, '2023-08-14 06:28:19', '2023-08-14 06:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `booking_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `booking_start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `booking_end_date` timestamp NULL DEFAULT NULL,
  `payment_start_response` text NOT NULL,
  `payment_end_response` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `transaction_id`, `booking_type`, `status`, `booking_start_date`, `booking_end_date`, `payment_start_response`, `payment_end_response`, `created_at`, `updated_at`) VALUES
(1, 632971, 64, 'Service Close', 'Success', '2023-07-02 12:15:42', '2023-07-02 06:45:31', 'eyJpdiI6ImR1ZWg5dU90ZDhCRnZuYklGbUI5VHc9PSIsInZhbHVlIjoic0xNL3o5Q2Voeldack5Ld2I4bFVvY2Y5RDNQaEhEbGJ0RDRTY2ZENGZtUTAraVNTL2E2K1dhcmpXc3V3Z2ZzWXg2UUNZMmtkdGRCWWorWjZaRkZkTjNac2FEMmpZTVozWDk4UzJpSzd3M3k0K3Z0UjcyZEs3ZW1LbktJQW1wVTJ6b2VhV2JaelgvSFYxNXRUSFpLR0lBPT0iLCJtYWMiOiIxZWJkOTRmZWE0NmY0MWRkM2VlOTcyYTYwNjc4ODNkOTc5ZDhiOWYzY2YxNjM5MGEzYTViNzg5MTFjNDk1MWNlIn0=', 'eyJpdiI6IisvY0N2cEVYNGVScE1xRU40ZEZ1Q1E9PSIsInZhbHVlIjoiNmxqSzgrKzNoa2RuZVRqdTNLanpNb2dqZkVjd212YzNlZ0dCajBOYS9xZDhYVnRUdStKeFZaSjZ3Z0hvRDBEMWQyeHhTZ0k3SmczUE1BUGZRVWhGK0VuTm1TSkNXdHRYR25NOFhlUE42ekFLZCtLUWR2aERneExOVklJUWFQUndhT21pcVhEMjF1SE1EOFIrSzNVWENUTkRndFB6VEFBaHFGT1Rxdm9FWG1Uc2xNeU4ya1ZJM0w2WlI2dmZHZ1pYZ3dYc2xCay8vMjFLbnBNck5nVGJXNnBzczFhK0Y4MThOQ3hFU0cwSk9JaENVNmVEWFJLcTZMVnFzQTZBWWxNVDV5WGhNTnpKL21XR3ZxY0VxUC9TTkhPanduK1A5N3dEYVRrT0MySUxyaVVvTlpzNmNQclBMVGdzdVdXWHdvTStLdEhwNitqNjhjTUVqdVJpOFRmbUpUTUF4aGxTczJOajF5eDF5LzFudThFRTlZdTNHY1BzSzRVanI4SGtSWW1PNFU0R1VtK3JSRGRqRE4zTkErS0VrakR0NCtWSEVGMmJNVlo3SWhnNlMxanlEZE5aQkJaQ0dNcVVaM0Jma3h0Rm02clNNNlA2QlhPb09EYVNqeGVlR1p6ZzVMOEtWZlEzUW81WDRVQ3ZRamU0T0JBWC81c1E4WFVRdjY4MnNXTXhOWXJ1Zjd5VnhkWWlqdVAyd0F0cVgwMzI3YjlKSTg5QjcvZjcwdGx3VG1DMVBYMElCRGczeHJtTmt1ZkRQcDlwaHhXeHVtSHBRaytFVVBpSXQ0NlMvZjhjSFRGa3M2SzZjSkV5cHYrbnJYam90aHVCcFBxN1BvRE5QcllIQVVLa1pPR3FNMUFvc2g2UU96LzhOblkzVnJ6b0JGUmZHVlVPSVNNMnVlWUtMeGovMzRNYVdRUnYxcDVXUFdRVThRQ3U0cTllMXloRXFhdGRqNXZXSXpLR3h6NDVjK0NUVFlFMmhCU0J1U0FENlR4TWZ1S1dXTTVpMkl0cjVjVTgvRUxBTTVKc3A1c08rYWdTVFVYd25EMytVak5neGpwNzNVdGxlbldkRms1TFRjbG9weDRJM1ZaUHk1UVZvejVVV3BKZyIsIm1hYyI6IjMwZGQ4ZDA5ZmVjZGViZDQxYTgyN2VjNTM2MDY1ZjE0M2E5OGVlZjlkODY4NzAyMTcyZGFlYWJlNjQ0ZjdlZmIifQ==', '2023-07-02 11:53:50', '2023-07-02 12:15:42'),
(2, 459887, 64, 'Service Close', 'Success', '2023-07-03 15:22:53', '2023-07-03 09:52:42', 'eyJpdiI6IkRSWDNwWlpJcFV1VzY5R0h1TW1UNVE9PSIsInZhbHVlIjoiTWYzMVd3TGQzVlM2TzNvRm8zamc1SFZjZ0FzaCs1ZnZTdVJmaEVIVVpxL0JGWHpFeVZId2VNTEJhMVFOaFFuRlFIQlNlcWIxNXhWdkpHK1l2RXc4OWNqKzRQTU1CR25wemh2eVdSR2h0YnFDa29nWXRYSzdDbjdZbDFSei9GcHA0aGNPUjVHa2hpVnVKYnI0aEIrZDdRPT0iLCJtYWMiOiIwMjYwMTAxYzJiNzUwMWFjZWE5MWU1NDYzMTUzNmQ1NDMyOWVmZTBiZDNmYTFjNThhYThjZDA1MjJlMmUwZmU3In0=', 'eyJpdiI6ImZnSlN6bUVreG1ncFUvZ3krUk5POWc9PSIsInZhbHVlIjoiVFBSTUVLVkR3eFpsdTkvTElsc0FsWGhuWXRTQUh3aTI5UTZ5c1VtZ0tLQzZpNTZWc2F3VllHdlBUYjdnUGZKMGZOVy9zWnFpL0hrVW5TV3NhYndmbWFxZWRyRHdWOUU0UkxhTjk3R2hTbk9oWitXS055eWx5TDVMWCttZ015Y1I1eWRXVmI5cDZGSldnNFFFYU96Q1l2QkdhSHJtbGs0dWtBY2VjbytVSW92WHRwclRNWUl3elpDcVpoUXhNYzF6TURYbjdscWloNnpDanV6aWxkak1aRGVZNVZBNWpUd3UxRzRvczZ4dWdZaEwvZXQ1eXl3QnNDbElXU2M4NVVqVm94aUJub2Nua1dINnlsc0YwdlBKZnVlay8vQ01scGdob2JMa1BFaXA0SkRDVmxzZTEzN1FvMGtDeGxKdWtPejI1ZHp3OWIwUDFucWtHMlVKTWtOcmpLRUx5VEM4TWVkQkhaSEFhZmNWRVpWUnNSSENsNzFuK0w0dlhLTm9pdzlUWTNrNEw4cUs1VzYxUnZpVjd1Z3pCTklJZzNxNHBBUFByaTFKcFg1d3lrR0ZTd2U0Nm9XMXo2ZkNGeUIyYVFOd2QwV0k0ZWFOMi9UY09QRTdSVWxWejdpM0YrS0Fmd01kN3poVS9rTVdJM3l5ZWx0UG5XcGlHK2drN0VSV0pxYnpYU01ucm1rYzNiNmM5M0cvRWZHS2pjK2VmditmdlhBOWVmdXVxMHBQcm5TOU1BUy9OUTIvZzhRZVB3T3ZqRkdqcmovTU9veEkxSFpmcklTeDM4aUdXV3NXOXNTbVg5UTFNamFKUlRmMDh6S1ZKYkQwRkNZNURyNk5OVkt4cHNQRnBRTGRkVmh5cXhNV3ZLNDNyRWx5Rk5hKzA0YWdDVjNKcG41djllWXdHRzYyalpMMGJ2MVFQNmF5eEJNUjFRdit5eEUrMkVPNEhsdnBLYmFNczhsMHpOWjF2NjhZK3RHbTN6dGp4SHFGOEVqdVNwRjYyc29MQjhJN3BMRTkyUEtvR2lmMnVCSktRRTdCck43N1ZVUjJkYkt3ZEd0MVhKOTNsMlF6bHJtSGx2RExvRjdZUEhsbTNSTTNwR0VXODA2NCIsIm1hYyI6ImRlMmY5MGM3Y2I1MjRlNGZjZmJkODBmMDU2YmRjMDZlZjllMzI5Zjk5OGMxODM5MjZjMWY0Y2E2MjFiMTIxNTMifQ==', '2023-07-03 15:21:35', '2023-07-03 15:22:53'),
(3, 431145, 64, 'Service Close', 'Inprogress', '2023-07-13 15:01:14', NULL, 'eyJpdiI6InNQZXhONDZ6d2pxN0JaZ0l4dG82WVE9PSIsInZhbHVlIjoiZlVGQThKMXdpTU9UbjAzZGRNd2FGWlVMWlA4ZnB1ZERLS2d0c3Z1RzNkT0NVYmZ1N3JPT0huMkFuNTB3eHhPNTFNZTJ2Q2tmYTB2WnpoaUZKcFBEdC93WW1KZmlZL2Y1Q0d3SXlMblFnL1dUUDRuaWRERWRwRGlMR3FHRm5kMXY5ODljSUpwNkZzMTR6MmcvK3hMRWRRPT0iLCJtYWMiOiI0MTRjYjA5MGNkZmFiZmM1NDIyY2IyZGRiYjRkNzdiOWRjYzBjMTFkNzBjZjJiMjVmMjllYjU5OTM4NjBhNGFjIn0=', NULL, '2023-07-13 15:01:14', '2023-07-13 15:01:14'),
(4, 554262, 64, 'Full Booking', 'Inprogress', '2023-07-31 13:29:40', NULL, 'eyJpdiI6IlZQTEtXcm5GZ2liUGl0ODE2aTRrTUE9PSIsInZhbHVlIjoiVDA1dnNuQTRkbGNGcFByVVozd2FOeHhhbjNHOVVZeXZMUFMwSjh1YnN3OWo0QStiSG95eCszM3h3ajNYeVFUSUFEMUVJK3pVeEdVV3lzZXBxM1czaXk5SmJHWnBKREJJM3VHWFRvNkVCSXhmOUp5ODg2UHJocVBYY1R6V3VUU2QiLCJtYWMiOiJiZWRmN2M1ZDNlMDg2MjE1NWUxNTk3ZDk5YTQzZGRiZGQxYjNmYTA0NjUzNzM5NjQyMDc3YTgxNDlhMzg3ZjAwIn0=', NULL, '2023-07-31 13:29:40', '2023-07-31 13:29:40'),
(5, 640267, 64, 'Full Booking', 'Inprogress', '2023-07-31 20:10:34', NULL, 'eyJpdiI6IngwVWNDNUM3NlNDMjRtWWhka0h3alE9PSIsInZhbHVlIjoiTHRaR3ByazEwbWk5cnhMUmZlWGp0bVRMUkc5ZlFISmlzQXl0RkpYYlpVVVNFWXRvUVROeUU5YWRnWkt1NWVTZmt6R3huMkMrZkloM0U2bVhwRE1idGQ0aURucVNrOW5RbzRPNCt6Y0t5T0hNTnd1elNJQVVrTURCMVR3OGZKeVMiLCJtYWMiOiI0Zjk2ZDllMjE5YTgyYjA2YThlNjRmMTdlMjYzZmZhYmQ3N2ZlOTk0ZGY4NTAxNTA1YzliYzQ0MzRmNDI3NDM0In0=', NULL, '2023-07-31 20:10:34', '2023-07-31 20:10:34'),
(6, 113990, 64, 'Full Booking', 'Inprogress', '2023-08-04 13:53:21', NULL, 'eyJpdiI6IkRZZVJTZ1hja1poTW9pT0piUlVFQ2c9PSIsInZhbHVlIjoiVHErZXlGbE5zVlhRSVFyQ2kzTDF6aEJWSkhGMDA0dWhqSGVGZ3RtNGlxM0p1WS9wVXdpbWtKMEFTTWFicGdiUmNiTy9oLzVpN1VZQklXMjBZbTlaZTdSYjBTQ0FhSXJIdmZOeTFoaDVhRk1ORXpmWEZzSlZGanJSM2dFTE5tOGwiLCJtYWMiOiJlZjc5YzIzNzlkNWIyZmRmN2M3MmRkODQ1YTljMGMxMjI0OTJiYjk5NzlhN2M4ODMxMWY4NTI0NTEzNjFmM2Y5In0=', NULL, '2023-08-04 13:53:21', '2023-08-04 13:53:21'),
(7, 243996, 64, 'Full Booking', 'Inprogress', '2023-08-04 13:56:47', NULL, 'eyJpdiI6IlkrdktVdklEOVNhenFnVVVQWW5nSlE9PSIsInZhbHVlIjoiNFFrcmdkTmxBMnd0Q3ZnZUdzUXNuMTQwaFJxWXh1bFVQa3VYMm5XWFMzdUZVc2JIL2QwcnV6TnZreFBnWjlnSDZkbjYwK3VOckl0eVcvS2s5L1o3UVk0UDhCK3VBNGJINWRRdVloY2NjUWhnTjhNeGZVNjhRTTVzMDk0ZFFOVEIiLCJtYWMiOiI5NmU1ZGYwOTllZWRhNTUyMTQ5MmRlNzdmZGU5NmE1ZjM2YTQwYjExZmYyOWVhMzA4Y2Q0ZWM4NWRmZTdkMjQ3In0=', NULL, '2023-08-04 13:56:47', '2023-08-04 13:56:47'),
(8, 468923, 64, 'Service Close', 'Success', '2023-08-14 06:30:08', '2023-08-14 00:59:57', 'eyJpdiI6InRDQjdDSTJndnJJWjVtakRZRUFTZmc9PSIsInZhbHVlIjoiM0VJRklRd3Z6LzJpQ0tSZVhJWU55NGQ1V083UEsxZWhwenJwVGtZYXBDZS9Jc2d4ZW5jYjZzaTJnOUhWa2FhZG9tNzNCd1d5Mk5pSE55WlBOa05JMkEzcm5JNW0xZUNhZjB0WjRKZE1Fdi9ZdTgzZUlSTG0xSVIyWnBULzZwYWJjUVEycHFVbUZ0SDJ6RlNRS1lqLy93PT0iLCJtYWMiOiIwNjZjMzc0MjFhMzkwMGYxNTcwMzg3YTEzYWEyOTJmNTFjNmIwZDljZTM2NDU1ODNlMWY3MzY4ZDc4MzJjMmE0In0=', 'eyJpdiI6ImhQdXlEZ1lENnhyTVdROWN0SkNUbFE9PSIsInZhbHVlIjoiV0g1eE0rNy9XLzdaQyswYzY0S3hqaGRXSS9VS1FzQ1JKbHE4dFBKOEQyaUg0VVhKbXZFSlp1YTRQYkhGK1FqQ3Y4b3BvRm5MVXVYYXJyYW1xRFNNME9ET2J4L0Q0bitTRitrNmRHb3dvRGlUVk9wNktjRG1OTHRHbEFobml4VDcrVnpXRzJ0QlVpTjFHVGdKam5aN1NReGJnanNreTBFNjJ1a20yTklGeis2aEw4am5GREV5MzZaR3FJL2Z4N3VqQ3o1dWhkOFFSQlRMN1Zlc21DRG9BTzd3NzJWOG9TWkxuUHcraEhWSkx3MlNGNmVTYUJJV01SVHNVTnMxaTZIVFV1dVpzajFrcVY0a0dMMmg2ZFFId1YvbUUyVm1vVEtHUUlKcEdKWHBjYnM4MHZmMDVka2RVOSs4SjRXWkZYRGd2ZmpoVTdlbDFiK0cvNU8zYXJTZkR0Z0F3MlZUOXVmS0c0emR4NVlLYzJONXZkN0hvMVVySUFuSVpHeTdoR1JmZjZpNmZMaWg5R2tGZW1NaFFEVmNzK3FyLyt5N0tXSUk4a043SmROR1JRWXIrQ0ZQZVVkUUNqNlVzY0V5SDU4cU5kMS9Kb3VlRnI3K0RVZkdCSkNlYU5Rc0FmMHdXd2N0anV6UVVVaCtKenR0Q0FrSXZaT1ZmVldZbXQwZDZjNGlVV0RXRytSRFJPT3VlMk1LRWMxbkRoeWdkKzlsU1VMWllUMVBDSUkxZnduZFNPeHdJRHk1N3puUnk0UjBzc1dzcEdjeEhMY0ZRdHY3SzJoRDNPQ01uanl6aC9QQTY3WHBPOGkrQU42eXd0dW9DWTI4L2hCYm1zTDlVWU0rMDdOaTJ6WVBSZVM1NDY0WDN6RjFsbmM4N3VNQktmU28rSXdlTDB2Q1RNd1AwMDh1R1JCMlRHZFF6dzk3WkRMdEJaMmxZZmdkQ3dqd1c0SG9FaHMvWmhBbkh4LzBzekZKSWNaSGZQdUw4KzJKeCtqZytSZGRSNXlXMXJMMzRkT1IvZi9DbndZNFhUS1VFVTBnMHBwWnVKZ20ybktLWW5pQ2FvbUFlTkw0RVhVUmlGMTJRd0dIMHUvd3RxaFFCK3hXSTE5R0c3SzhHM2puaWxwTWI4aForZFFLRmdOQVpvMkROcmNodFRRWFcvM3FoQWs9IiwibWFjIjoiM2FkMGIyNTNiOGQ2OTY4M2FmODYyOWYwYzk3NjRhZjczYjQzMDQzN2YxOTgxZGVlM2E3Y2VkY2Y5Nzg1ZjYwYyJ9', '2023-08-14 06:29:31', '2023-08-14 06:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `to_user` bigint(20) NOT NULL,
  `from_user` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `booking_ids` text NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `route` varchar(225) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `route`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Account Settings', '/cms-admin/account-settings', 'web', NULL, NULL),
(2, 'Sub Admin Management', '/cms-admin/sub-admin', 'web', NULL, NULL),
(3, 'Role & Permission', '/cms-admin/roles', 'web', NULL, NULL),
(4, 'User Management', '/cms-admin/customer-listing/user', 'web', NULL, NULL),
(5, 'Booking', '/cms-admin/bookings', 'web', NULL, NULL),
(6, 'Prescription', '/cms-admin/prescription', 'web', NULL, NULL),
(7, 'Suggestions', '/cms-admin/suggetions', 'web', NULL, NULL),
(8, 'All Type Users', '/cms-admin/alltype-user/doctor', 'web', NULL, NULL),
(9, 'All Adds', '/cms-admin/alltype-ads', 'web', NULL, NULL),
(10, 'Referal History', '/cms-admin/referal-management', 'web', NULL, NULL),
(11, 'Commission Records', '/cms-admin/commision-management', 'web', NULL, NULL),
(12, 'Medmate Management', '/cms-admin/customer-listing/medicalmate', 'web', NULL, NULL),
(13, 'Doctor Management', '/cms-admin/customer-listing/doctor', 'web', NULL, NULL),
(14, 'Vendor Management', '/cms-admin/customer-listing/vendor', 'web', NULL, NULL),
(15, 'Add Subadmin', '/cms-admin/sub-admin/add', 'web', NULL, NULL),
(16, 'Store Subadmin', '/cms-admin/sub-admin/store', 'web', NULL, NULL),
(17, 'EDit Subadmin', '/cms-admin/sub-admin/edit/', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_answars`
--

CREATE TABLE `question_answars` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answar` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_answars`
--

INSERT INTO `question_answars` (`id`, `category`, `user_type`, `question`, `answar`, `created_at`, `updated_at`) VALUES
(1, 'Clinic', 3, 'What is the consult time', 'consult time 11.30pm', NULL, '2023-09-07 07:47:45'),
(2, 'Clinic', 3, 'what is your name', 'i am Husain daszxcddwd', '2023-09-07 01:58:45', '2023-09-07 07:48:24'),
(3, 'Vender', 4, 'question', 'answer', '2023-09-07 04:45:08', '2023-09-07 07:48:47'),
(4, NULL, NULL, 'what is the person Free', NULL, '2023-10-07 13:40:50', '2023-10-07 13:40:50'),
(5, NULL, NULL, 'what is the daily free', NULL, '2023-10-09 06:24:59', '2023-10-09 06:24:59'),
(6, NULL, NULL, NULL, NULL, '2023-10-10 10:50:02', '2023-10-10 10:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(12) DEFAULT NULL,
  `userdetail_id` int(12) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `rating_message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `userdetail_id`, `rating`, `rating_message`, `created_at`, `updated_at`) VALUES
(1, 2, 12, '5', 'Hello Dr susanta', '2023-09-05 09:59:47', '2023-09-08 10:47:38'),
(2, 3, 13, '5', 'Hello', NULL, '2023-09-06 10:02:35'),
(3, 2, 16, '1', 'Hello Debasis das', '2023-09-06 10:19:07', '2023-09-06 10:25:57'),
(4, 1, 12, '2', 'Hello susant', '2023-09-06 10:35:04', '2023-09-06 10:38:59'),
(5, 1, 13, '1', 'Hello harish', '2023-09-06 10:43:47', '2023-09-06 10:45:08'),
(6, 1, 14, '2', 'Hello susant ku das', '2023-09-06 10:47:30', '2023-09-06 10:47:30'),
(7, 3, 16, '1', 'Hello debasis', '2023-09-06 10:53:47', '2023-09-06 10:53:47'),
(8, 3, 16, '3', 'Hello', NULL, NULL),
(9, 2, 19, '4', NULL, '2023-09-28 14:00:32', '2023-09-28 14:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED DEFAULT NULL,
  `reason_type` varchar(70) DEFAULT NULL,
  `reasons` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`reasons`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `account_id`, `reason_type`, `reasons`, `created_at`, `updated_at`) VALUES
(1, 1, 'restricted', '[{\r\n  \"label\": \"Due to high volume of order cancellations\",\r\n  \"value\": \"Due to high volume of order cancellations\"\r\n},\r\n{\r\n  \"label\": \"Due to fake allegation to service providers\",\r\n  \"value\": \"Due to fake allegation to service providers\"\r\n},\r\n{\r\n  \"label\": \"Due to miss authentication issues\",\r\n  \"value\": \"Due to miss authentication issues\"\r\n},\r\n{\r\n  \"label\": \"Due to misuse of services\",\r\n  \"value\": \"Due to misuse of services\"\r\n}]', '2021-09-21 10:58:21', '2021-09-21 10:58:21'),
(2, 2, 'restricted', '[{\r\n  \"label\": \"Due to high cancelations\",\r\n  \"value\": \"Due to high cancelations\"\r\n},\r\n{\r\n  \"label\": \"Due to bad ratings\",\r\n  \"value\": \"Due to bad ratings\"\r\n},\r\n{\r\n  \"label\": \"Due to bad behaviour\",\r\n  \"value\": \"Due to bad behaviour\"\r\n},\r\n{\r\n  \"label\": \"Due to late arrival at working place\",\r\n  \"value\": \"Due to late arrival at working place\"\r\n}]', '2021-09-21 10:58:21', '2021-09-21 10:58:21'),
(3, 2, 'forwarding', '[{\r\n  \"label\": \"Already in a service\",\r\n  \"value\": \"Already in a service\"\r\n},\r\n{\r\n  \"label\": \"Due to Sickness\",\r\n  \"value\": \"Due to Sickness\"\r\n},\r\n{\r\n  \"label\": \"Busy in personal work\",\r\n  \"value\": \"Busy in personal work\"\r\n},\r\n{\r\n  \"label\": \"Not Interested\",\r\n  \"value\": \"Not Interested\"\r\n}]', '2021-09-21 11:03:09', '2021-09-21 11:03:09'),
(4, 4, 'restricted', '[{\r\n  \"label\": \"Due to high volume of late shipping\",\r\n  \"value\": \"Due to high volume of late shipping\"\r\n},\r\n{\r\n  \"label\": \"Due to high volume of prescription ignorance\",\r\n  \"value\": \"Due to high volume of prescription ignorance\"\r\n},\r\n{\r\n  \"label\": \"Due to high volume of mismatching products\",\r\n  \"value\": \"Due to high volume of mismatching products\"\r\n},\r\n{\r\n  \"label\": \"Due to high volume of order return & ignorance\",\r\n  \"value\": \"Due to high volume of order return & ignorance\"\r\n}]', '2021-09-21 11:03:09', '2021-09-21 11:03:09'),
(5, 3, 'restricted', '[{\r\n  \"label\": \"No any specific reasons\",\r\n  \"value\": \"No any specific reasons\"\r\n}]', '2021-09-21 11:20:12', '2021-09-21 11:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `referal_bonuses`
--

CREATE TABLE `referal_bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `ref_id` bigint(20) DEFAULT NULL,
  `ref_code` varchar(255) NOT NULL,
  `ref_coin_first` varchar(255) DEFAULT NULL,
  `ref_coin_second` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referal_bonuses`
--

INSERT INTO `referal_bonuses` (`id`, `user_id`, `ref_id`, `ref_code`, `ref_coin_first`, `ref_coin_second`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'OB175201', '100', '50', '2023-07-01 06:13:06', '2023-07-01 06:24:45'),
(2, 2, NULL, 'TS275592', '700', NULL, '2023-07-01 06:14:31', '2023-07-05 16:49:39'),
(3, 3, 2, 'TV387992', NULL, NULL, '2023-07-01 06:18:08', '2023-07-01 06:18:08'),
(4, 4, 1, 'AR437972', '100', '50', '2023-07-01 06:18:22', '2023-07-01 06:32:12'),
(5, 5, 4, 'DB562489', '100', NULL, '2023-07-01 06:24:45', '2023-07-01 06:32:12'),
(6, 6, 5, 'MR690666', NULL, NULL, '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(7, 7, 2, 'SM789368', NULL, NULL, '2023-07-01 07:41:57', '2023-07-01 07:41:57'),
(8, 8, 2, 'SS841964', NULL, NULL, '2023-07-01 07:57:32', '2023-07-01 07:57:32'),
(9, 9, 2, 'TK940314', NULL, NULL, '2023-07-01 08:04:37', '2023-07-01 08:04:37'),
(10, 10, 2, 'SK1050035', NULL, NULL, '2023-07-01 08:14:24', '2023-07-01 08:14:24'),
(11, 11, 2, 'MR1124283', NULL, NULL, '2023-07-01 08:24:08', '2023-07-01 08:24:08'),
(12, 12, 2, 'SN1239217', NULL, NULL, '2023-07-05 16:49:39', '2023-07-05 16:49:39'),
(13, 13, NULL, 'SK1362018', NULL, NULL, '2023-07-07 12:12:37', '2023-07-07 12:12:37'),
(14, 14, NULL, 'SP1416605', NULL, NULL, '2023-07-24 06:04:04', '2023-07-24 06:04:04'),
(15, 16, NULL, 'TS1662203', NULL, NULL, '2023-08-14 06:34:59', '2023-08-14 06:34:59'),
(16, 15, NULL, 'TS1549705', NULL, NULL, '2023-08-14 06:34:59', '2023-08-14 06:34:59'),
(17, 17, NULL, 'TR1761497', NULL, NULL, '2023-08-14 06:41:29', '2023-08-14 06:41:29'),
(18, 18, NULL, 'SD1816785', NULL, NULL, '2023-08-14 07:46:27', '2023-08-14 07:46:27'),
(19, 19, NULL, 'TR1931834', NULL, NULL, '2023-08-14 11:05:27', '2023-08-14 11:05:27'),
(20, 20, NULL, 'TS2065367', NULL, NULL, '2023-08-14 11:44:59', '2023-08-14 11:44:59');

-- --------------------------------------------------------

--
-- Table structure for table `referal_code_details`
--

CREATE TABLE `referal_code_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `refer_id` bigint(20) NOT NULL,
  `refer_code` varchar(225) NOT NULL,
  `reg_user_id` bigint(20) NOT NULL,
  `ref_user_id` bigint(20) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referal_code_details`
--

INSERT INTO `referal_code_details` (`id`, `refer_id`, `refer_code`, `reg_user_id`, `ref_user_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 'TS275592', 3, 2, '100', '2023-07-01 06:18:08', '2023-07-01 06:18:08'),
(2, 1, 'OB175201', 4, 1, '100', '2023-07-01 06:18:22', '2023-07-01 06:18:22'),
(3, 4, 'AR437972', 5, 4, '100', '2023-07-01 06:24:45', '2023-07-01 06:24:45'),
(4, 4, 'AR437972', 5, 1, '50', '2023-07-01 06:24:45', '2023-07-01 06:24:45'),
(5, 5, 'DB562489', 6, 5, '100', '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(6, 5, 'DB562489', 6, 4, '50', '2023-07-01 06:32:12', '2023-07-01 06:32:12'),
(7, 2, 'TS275592', 7, 2, '100', '2023-07-01 07:41:57', '2023-07-01 07:41:57'),
(8, 2, 'TS275592', 8, 2, '100', '2023-07-01 07:57:32', '2023-07-01 07:57:32'),
(9, 2, 'TS275592', 9, 2, '100', '2023-07-01 08:04:37', '2023-07-01 08:04:37'),
(10, 2, 'TS275592', 10, 2, '100', '2023-07-01 08:14:25', '2023-07-01 08:14:25'),
(11, 2, 'TS275592', 11, 2, '100', '2023-07-01 08:24:08', '2023-07-01 08:24:08'),
(12, 2, 'TS275592', 12, 2, '100', '2023-07-05 16:49:39', '2023-07-05 16:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(2, 'Account Settings', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(3, 'Sub Admin Management', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(4, 'Role & Permission', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(5, 'Customer listing', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(6, 'Booking', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(7, 'Prescription', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(8, 'Suggestions', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(9, 'All Type Users', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(10, 'All Adds', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(11, 'Referal History', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48'),
(12, 'Commission Records', 'web', '2023-05-10 23:42:48', '2023-05-10 23:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 5),
(2, 2),
(3, 2),
(4, 2),
(4, 6),
(5, 6),
(6, 5),
(6, 6),
(7, 5),
(7, 6),
(8, 5),
(8, 6),
(10, 6),
(10, 11),
(12, 6),
(13, 6),
(14, 5),
(14, 6),
(15, 2),
(16, 2),
(17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `staff_working_hours`
--

CREATE TABLE `staff_working_hours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` int(11) NOT NULL,
  `login_date` date NOT NULL,
  `login_date_time` datetime NOT NULL,
  `logout_date_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_working_hours`
--

INSERT INTO `staff_working_hours` (`id`, `staff_id`, `login_date`, `login_date_time`, `logout_date_time`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-07-01', '2023-07-01 12:12:25', '2023-07-01 12:15:22', '2023-07-01 06:42:25', '2023-07-01 06:45:22'),
(2, 1, '2023-07-01', '2023-07-01 12:14:14', '2023-07-01 12:18:53', '2023-07-01 06:44:14', '2023-07-01 06:48:53'),
(3, 1, '2023-07-01', '2023-07-01 12:46:33', '2023-07-01 13:04:35', '2023-07-01 07:16:33', '2023-07-01 07:34:35'),
(4, 1, '2023-07-01', '2023-07-01 13:07:55', '2023-07-01 13:17:14', '2023-07-01 07:37:55', '2023-07-01 07:47:14'),
(5, 1, '2023-07-01', '2023-07-01 13:24:10', '2023-07-01 13:26:22', '2023-07-01 07:54:10', '2023-07-01 07:56:22'),
(6, 1, '2023-07-01', '2023-07-01 13:38:26', '2023-07-01 13:43:39', '2023-07-01 08:08:26', '2023-07-01 08:13:39'),
(7, 20, '2023-07-01', '2023-07-01 13:43:49', '2023-07-01 13:54:39', '2023-07-01 08:13:49', '2023-07-01 08:24:39'),
(8, 1, '2023-07-01', '2023-07-01 13:48:08', '2023-07-01 13:50:12', '2023-07-01 08:18:08', '2023-07-01 08:20:12'),
(9, 1, '2023-07-01', '2023-07-01 13:48:25', '2023-07-01 14:41:03', '2023-07-01 08:18:25', '2023-07-01 09:11:03'),
(10, 26, '2023-07-01', '2023-07-01 13:54:49', '2023-07-01 14:05:53', '2023-07-01 08:24:49', '2023-07-01 08:35:53'),
(11, 1, '2023-07-01', '2023-07-01 14:03:22', NULL, '2023-07-01 08:33:22', '2023-07-01 08:33:22'),
(12, 26, '2023-07-01', '2023-07-01 14:06:24', '2023-07-01 14:08:10', '2023-07-01 08:36:24', '2023-07-01 08:38:10'),
(13, 26, '2023-07-01', '2023-07-01 14:08:19', '2023-07-01 14:10:11', '2023-07-01 08:38:19', '2023-07-01 08:40:11'),
(14, 26, '2023-07-01', '2023-07-01 14:10:26', '2023-07-01 14:48:26', '2023-07-01 08:40:26', '2023-07-01 09:18:26'),
(15, 1, '2023-07-01', '2023-07-01 14:30:46', NULL, '2023-07-01 09:00:46', '2023-07-01 09:00:46'),
(16, 1, '2023-07-02', '2023-07-02 09:57:34', '2023-07-02 22:51:53', '2023-07-02 04:27:34', '2023-07-02 17:21:53'),
(17, 1, '2023-07-02', '2023-07-02 22:51:22', '2023-07-02 22:53:28', '2023-07-02 17:21:22', '2023-07-02 17:23:28'),
(18, 1, '2023-07-02', '2023-07-02 22:52:29', '2023-07-02 22:56:08', '2023-07-02 17:22:29', '2023-07-02 17:26:08'),
(19, 28, '2023-07-02', '2023-07-02 22:53:31', '2023-07-02 22:54:58', '2023-07-02 17:23:31', '2023-07-02 17:24:58'),
(20, 1, '2023-07-02', '2023-07-02 22:55:03', '2023-07-02 22:56:20', '2023-07-02 17:25:03', '2023-07-02 17:26:20'),
(21, 1, '2023-07-02', '2023-07-02 22:55:33', NULL, '2023-07-02 17:25:33', '2023-07-02 17:25:33'),
(22, 1, '2023-07-02', '2023-07-02 22:56:16', NULL, '2023-07-02 17:26:16', '2023-07-02 17:26:16'),
(23, 28, '2023-07-02', '2023-07-02 22:56:50', '2023-07-02 23:00:17', '2023-07-02 17:26:50', '2023-07-02 17:30:17'),
(24, 1, '2023-07-02', '2023-07-02 23:00:23', NULL, '2023-07-02 17:30:23', '2023-07-02 17:30:23'),
(25, 1, '2023-07-03', '2023-07-03 00:45:18', NULL, '2023-07-02 19:15:18', '2023-07-02 19:15:18'),
(26, 28, '2023-07-03', '2023-07-03 00:45:23', NULL, '2023-07-02 19:15:23', '2023-07-02 19:15:23'),
(27, 1, '2023-07-03', '2023-07-03 15:48:23', NULL, '2023-07-03 10:18:23', '2023-07-03 10:18:23'),
(28, 1, '2023-07-04', '2023-07-04 15:07:24', NULL, '2023-07-04 09:37:24', '2023-07-04 09:37:24'),
(29, 1, '2023-07-04', '2023-07-04 18:20:49', NULL, '2023-07-04 12:50:49', '2023-07-04 12:50:49'),
(30, 1, '2023-07-05', '2023-07-05 09:12:36', '2023-07-05 22:24:20', '2023-07-05 03:42:36', '2023-07-05 16:54:20'),
(31, 1, '2023-07-05', '2023-07-05 19:18:08', '2023-07-05 22:36:56', '2023-07-05 13:48:08', '2023-07-05 17:06:56'),
(32, 1, '2023-07-05', '2023-07-05 21:40:34', NULL, '2023-07-05 16:10:34', '2023-07-05 16:10:34'),
(33, 1, '2023-07-05', '2023-07-05 22:25:47', NULL, '2023-07-05 16:55:47', '2023-07-05 16:55:47'),
(34, 1, '2023-07-05', '2023-07-05 22:44:29', NULL, '2023-07-05 17:14:29', '2023-07-05 17:14:29'),
(35, 1, '2023-07-06', '2023-07-06 09:59:12', NULL, '2023-07-06 04:29:12', '2023-07-06 04:29:12'),
(36, 1, '2023-07-06', '2023-07-06 16:41:25', NULL, '2023-07-06 11:11:25', '2023-07-06 11:11:25'),
(37, 1, '2023-07-07', '2023-07-07 17:01:14', '2023-07-07 17:43:54', '2023-07-07 11:31:14', '2023-07-07 12:13:54'),
(38, 1, '2023-07-08', '2023-07-08 00:21:31', '2023-07-08 15:29:00', '2023-07-07 18:51:31', '2023-07-08 09:59:00'),
(39, 1, '2023-07-08', '2023-07-08 15:14:24', '2023-07-08 15:55:43', '2023-07-08 09:44:24', '2023-07-08 10:25:43'),
(40, 1, '2023-07-08', '2023-07-08 15:54:33', NULL, '2023-07-08 10:24:33', '2023-07-08 10:24:33'),
(41, 1, '2023-07-09', '2023-07-09 14:37:26', NULL, '2023-07-09 09:07:26', '2023-07-09 09:07:26'),
(42, 1, '2023-07-09', '2023-07-09 17:35:44', NULL, '2023-07-09 12:05:44', '2023-07-09 12:05:44'),
(43, 1, '2023-07-10', '2023-07-10 09:39:25', NULL, '2023-07-10 04:09:25', '2023-07-10 04:09:25'),
(44, 1, '2023-07-11', '2023-07-11 19:25:58', '2023-07-11 19:29:27', '2023-07-11 13:55:58', '2023-07-11 13:59:27'),
(45, 29, '2023-07-11', '2023-07-11 19:29:31', NULL, '2023-07-11 13:59:31', '2023-07-11 13:59:31'),
(46, 1, '2023-07-11', '2023-07-11 19:30:33', NULL, '2023-07-11 14:00:33', '2023-07-11 14:00:33'),
(47, 1, '2023-07-11', '2023-07-11 23:22:25', NULL, '2023-07-11 17:52:25', '2023-07-11 17:52:25'),
(48, 1, '2023-07-12', '2023-07-12 14:51:41', NULL, '2023-07-12 09:21:41', '2023-07-12 09:21:41'),
(49, 1, '2023-07-12', '2023-07-12 16:37:56', NULL, '2023-07-12 11:07:56', '2023-07-12 11:07:56'),
(50, 1, '2023-07-12', '2023-07-12 19:58:48', NULL, '2023-07-12 14:28:48', '2023-07-12 14:28:48'),
(51, 1, '2023-07-12', '2023-07-12 19:58:48', NULL, '2023-07-12 14:28:48', '2023-07-12 14:28:48'),
(52, 1, '2023-07-13', '2023-07-13 20:16:33', NULL, '2023-07-13 14:46:33', '2023-07-13 14:46:33'),
(53, 1, '2023-07-17', '2023-07-17 16:58:14', NULL, '2023-07-17 11:28:14', '2023-07-17 11:28:14'),
(54, 1, '2023-07-19', '2023-07-19 09:10:59', NULL, '2023-07-19 03:40:59', '2023-07-19 03:40:59'),
(55, 1, '2023-07-19', '2023-07-19 16:39:08', NULL, '2023-07-19 11:09:08', '2023-07-19 11:09:08'),
(56, 1, '2023-07-19', '2023-07-19 20:39:50', NULL, '2023-07-19 15:09:50', '2023-07-19 15:09:50'),
(57, 1, '2023-07-19', '2023-07-19 20:41:55', NULL, '2023-07-19 15:11:55', '2023-07-19 15:11:55'),
(58, 1, '2023-07-23', '2023-07-23 19:28:43', NULL, '2023-07-23 13:58:43', '2023-07-23 13:58:43'),
(59, 1, '2023-07-24', '2023-07-24 16:54:15', NULL, '2023-07-24 11:24:15', '2023-07-24 11:24:15'),
(60, 1, '2023-07-25', '2023-07-25 16:14:50', '2023-07-25 16:41:08', '2023-07-25 10:44:50', '2023-07-25 11:11:08'),
(61, 1, '2023-07-26', '2023-07-26 11:41:42', '2023-07-26 18:32:04', '2023-07-26 06:11:42', '2023-07-26 13:02:04'),
(62, 1, '2023-07-26', '2023-07-26 18:30:01', NULL, '2023-07-26 13:00:01', '2023-07-26 13:00:01'),
(63, 1, '2023-07-26', '2023-07-26 18:37:28', NULL, '2023-07-26 13:07:28', '2023-07-26 13:07:28'),
(64, 1, '2023-07-27', '2023-07-27 15:26:24', NULL, '2023-07-27 09:56:24', '2023-07-27 09:56:24'),
(65, 1, '2023-07-28', '2023-07-28 15:59:59', NULL, '2023-07-28 10:29:59', '2023-07-28 10:29:59'),
(66, 1, '2023-07-31', '2023-07-31 15:54:43', NULL, '2023-07-31 10:24:43', '2023-07-31 10:24:43'),
(67, 1, '2023-07-31', '2023-07-31 19:05:46', NULL, '2023-07-31 13:35:46', '2023-07-31 13:35:46'),
(68, 1, '2023-08-03', '2023-08-03 17:30:29', NULL, '2023-08-03 12:00:29', '2023-08-03 12:00:29'),
(69, 1, '2023-08-07', '2023-08-07 13:20:05', NULL, '2023-08-07 07:50:05', '2023-08-07 07:50:05'),
(70, 1, '2023-08-08', '2023-08-08 09:27:26', NULL, '2023-08-08 03:57:26', '2023-08-08 03:57:26'),
(71, 1, '2023-08-08', '2023-08-08 18:12:51', NULL, '2023-08-08 12:42:51', '2023-08-08 12:42:51'),
(72, 1, '2023-08-09', '2023-08-09 17:16:23', NULL, '2023-08-09 11:46:23', '2023-08-09 11:46:23'),
(73, 1, '2023-08-09', '2023-08-09 17:16:29', NULL, '2023-08-09 11:46:29', '2023-08-09 11:46:29'),
(74, 1, '2023-08-12', '2023-08-12 14:38:30', NULL, '2023-08-12 09:08:30', '2023-08-12 09:08:30'),
(75, 1, '2023-08-13', '2023-08-13 10:42:26', NULL, '2023-08-13 05:12:26', '2023-08-13 05:12:26'),
(76, 1, '2023-08-14', '2023-08-14 11:54:22', NULL, '2023-08-14 06:24:22', '2023-08-14 06:24:22'),
(77, 1, '2023-08-14', '2023-08-14 15:21:38', NULL, '2023-08-14 09:51:38', '2023-08-14 09:51:38'),
(78, 1, '2023-08-17', '2023-08-17 10:26:45', NULL, '2023-08-17 04:56:45', '2023-08-17 04:56:45'),
(79, 1, '2023-08-17', '2023-08-17 15:54:39', NULL, '2023-08-17 10:24:39', '2023-08-17 10:24:39'),
(80, 1, '2023-08-17', '2023-08-17 17:22:08', NULL, '2023-08-17 11:52:08', '2023-08-17 11:52:08'),
(81, 1, '2023-08-18', '2023-08-18 10:35:14', NULL, '2023-08-18 05:05:14', '2023-08-18 05:05:14'),
(82, 1, '2023-08-18', '2023-08-18 18:18:13', NULL, '2023-08-18 12:48:13', '2023-08-18 12:48:13'),
(83, 1, '2023-08-19', '2023-08-19 10:38:36', NULL, '2023-08-19 05:08:36', '2023-08-19 05:08:36'),
(84, 1, '2023-08-21', '2023-08-21 10:36:17', '2023-08-21 18:43:33', '2023-08-21 05:06:17', '2023-08-21 13:13:33'),
(85, 1, '2023-08-21', '2023-08-21 15:45:59', '2023-08-21 18:47:11', '2023-08-21 10:15:59', '2023-08-21 13:17:11'),
(86, 1, '2023-08-21', '2023-08-21 18:43:41', '2023-08-21 18:48:22', '2023-08-21 13:13:41', '2023-08-21 13:18:22'),
(87, 1, '2023-08-21', '2023-08-21 18:47:21', '2023-08-21 18:51:14', '2023-08-21 13:17:21', '2023-08-21 13:21:14'),
(88, 1, '2023-08-21', '2023-08-21 18:48:30', NULL, '2023-08-21 13:18:30', '2023-08-21 13:18:30'),
(89, 20, '2023-08-21', '2023-08-21 19:01:09', '2023-08-21 19:03:11', '2023-08-21 13:31:09', '2023-08-21 13:33:11'),
(90, 1, '2023-08-21', '2023-08-21 19:03:17', NULL, '2023-08-21 13:33:17', '2023-08-21 13:33:17'),
(91, 1, '2023-08-22', '2023-08-22 10:21:43', NULL, '2023-08-22 04:51:43', '2023-08-22 04:51:43'),
(92, 1, '2023-08-23', '2023-08-23 11:30:57', NULL, '2023-08-23 06:00:57', '2023-08-23 06:00:57'),
(93, 1, '2023-08-23', '2023-08-23 18:36:04', NULL, '2023-08-23 13:06:04', '2023-08-23 13:06:04'),
(94, 1, '2023-08-24', '2023-08-24 10:12:15', NULL, '2023-08-24 04:42:15', '2023-08-24 04:42:15'),
(95, 1, '2023-08-25', '2023-08-25 10:23:10', NULL, '2023-08-25 04:53:10', '2023-08-25 04:53:10'),
(96, 1, '2023-08-26', '2023-08-26 10:20:34', NULL, '2023-08-26 04:50:34', '2023-08-26 04:50:34'),
(97, 1, '2023-08-26', '2023-08-26 10:39:51', NULL, '2023-08-26 05:09:51', '2023-08-26 05:09:51'),
(98, 1, '2023-08-28', '2023-08-28 10:29:58', NULL, '2023-08-28 04:59:58', '2023-08-28 04:59:58'),
(99, 1, '2023-08-29', '2023-08-29 15:04:06', NULL, '2023-08-29 09:34:06', '2023-08-29 09:34:06'),
(100, 1, '2023-08-30', '2023-08-30 18:10:38', NULL, '2023-08-30 12:40:38', '2023-08-30 12:40:38'),
(101, 1, '2023-08-31', '2023-08-31 10:18:33', NULL, '2023-08-31 04:48:33', '2023-08-31 04:48:33'),
(102, 1, '2023-09-02', '2023-09-02 11:14:37', NULL, '2023-09-02 05:44:37', '2023-09-02 05:44:37'),
(103, 1, '2023-09-04', '2023-09-04 10:22:36', NULL, '2023-09-04 04:52:36', '2023-09-04 04:52:36'),
(104, 1, '2023-09-06', '2023-09-06 16:49:44', NULL, '2023-09-06 11:19:44', '2023-09-06 11:19:44'),
(105, 1, '2023-09-07', '2023-09-07 10:29:01', '2023-09-07 10:29:51', '2023-09-07 04:59:01', '2023-09-07 04:59:51'),
(106, 1, '2023-09-07', '2023-09-07 10:30:00', '2023-09-07 10:32:43', '2023-09-07 05:00:00', '2023-09-07 05:02:43'),
(107, 20, '2023-09-07', '2023-09-07 10:32:49', '2023-09-07 10:34:31', '2023-09-07 05:02:49', '2023-09-07 05:04:31'),
(108, 1, '2023-09-07', '2023-09-07 10:34:40', NULL, '2023-09-07 05:04:40', '2023-09-07 05:04:40'),
(109, 1, '2023-09-08', '2023-09-08 11:11:00', NULL, '2023-09-08 05:41:00', '2023-09-08 05:41:00'),
(110, 1, '2023-09-09', '2023-09-09 10:15:27', NULL, '2023-09-09 04:45:27', '2023-09-09 04:45:27'),
(111, 1, '2023-09-11', '2023-09-11 10:42:40', NULL, '2023-09-11 05:12:40', '2023-09-11 05:12:40'),
(112, 1, '2023-09-12', '2023-09-12 10:22:58', '2023-09-12 18:08:05', '2023-09-12 04:52:58', '2023-09-12 12:38:05'),
(113, 28, '2023-09-12', '2023-09-12 18:08:22', '2023-09-12 18:14:26', '2023-09-12 12:38:22', '2023-09-12 12:44:26'),
(114, 1, '2023-09-12', '2023-09-12 18:14:40', '2023-09-12 18:19:44', '2023-09-12 12:44:40', '2023-09-12 12:49:44'),
(115, 30, '2023-09-12', '2023-09-12 18:20:02', NULL, '2023-09-12 12:50:02', '2023-09-12 12:50:02'),
(116, 1, '2023-09-13', '2023-09-13 14:34:56', NULL, '2023-09-13 09:04:56', '2023-09-13 09:04:56'),
(117, 1, '2023-09-14', '2023-09-14 10:29:20', NULL, '2023-09-14 04:59:20', '2023-09-14 04:59:20'),
(118, 1, '2023-09-15', '2023-09-15 10:23:53', '2023-09-15 13:02:02', '2023-09-15 04:53:53', '2023-09-15 07:32:02'),
(119, 30, '2023-09-15', '2023-09-15 13:02:12', NULL, '2023-09-15 07:32:12', '2023-09-15 07:32:12'),
(120, 1, '2023-09-16', '2023-09-16 10:22:37', NULL, '2023-09-16 04:52:37', '2023-09-16 04:52:37'),
(121, 1, '2023-09-18', '2023-09-18 10:26:13', NULL, '2023-09-18 04:56:13', '2023-09-18 04:56:13'),
(122, 1, '2023-09-20', '2023-09-20 11:16:08', NULL, '2023-09-20 05:46:08', '2023-09-20 05:46:08'),
(123, 1, '2023-09-21', '2023-09-21 11:03:35', NULL, '2023-09-21 05:33:35', '2023-09-21 05:33:35'),
(124, 1, '2023-09-25', '2023-09-25 10:31:20', NULL, '2023-09-25 05:01:20', '2023-09-25 05:01:20'),
(125, 1, '2023-09-26', '2023-09-26 11:09:23', '2023-09-26 11:10:17', '2023-09-26 05:39:23', '2023-09-26 05:40:17'),
(126, 30, '2023-09-26', '2023-09-26 11:10:24', '2023-09-26 12:12:24', '2023-09-26 05:40:24', '2023-09-26 06:42:24'),
(127, 1, '2023-09-26', '2023-09-26 12:12:33', '2023-09-26 12:14:47', '2023-09-26 06:42:33', '2023-09-26 06:44:47'),
(128, 1, '2023-09-26', '2023-09-26 12:15:28', '2023-09-26 12:15:35', '2023-09-26 06:45:28', '2023-09-26 06:45:35'),
(129, 30, '2023-09-26', '2023-09-26 12:16:00', '2023-09-26 15:10:21', '2023-09-26 06:46:00', '2023-09-26 09:40:21'),
(130, 30, '2023-09-26', '2023-09-26 15:10:28', '2023-09-26 15:10:42', '2023-09-26 09:40:28', '2023-09-26 09:40:42'),
(131, 1, '2023-09-26', '2023-09-26 15:10:49', '2023-09-26 16:00:52', '2023-09-26 09:40:49', '2023-09-26 10:30:52'),
(132, 30, '2023-09-26', '2023-09-26 16:01:02', NULL, '2023-09-26 10:31:02', '2023-09-26 10:31:02'),
(133, 1, '2023-09-27', '2023-09-27 10:54:29', '2023-09-27 15:11:32', '2023-09-27 05:24:29', '2023-09-27 09:41:32'),
(134, 30, '2023-09-27', '2023-09-27 15:11:40', '2023-09-27 15:12:43', '2023-09-27 09:41:40', '2023-09-27 09:42:43'),
(135, 1, '2023-09-27', '2023-09-27 15:12:52', '2023-09-27 16:03:22', '2023-09-27 09:42:52', '2023-09-27 10:33:22'),
(136, 30, '2023-09-27', '2023-09-27 16:03:30', '2023-09-27 16:03:41', '2023-09-27 10:33:30', '2023-09-27 10:33:41'),
(137, 1, '2023-09-27', '2023-09-27 16:03:48', '2023-09-27 16:06:11', '2023-09-27 10:33:48', '2023-09-27 10:36:11'),
(138, 30, '2023-09-27', '2023-09-27 16:06:20', '2023-09-27 16:07:02', '2023-09-27 10:36:20', '2023-09-27 10:37:02'),
(139, 1, '2023-09-27', '2023-09-27 16:07:08', '2023-09-27 18:51:06', '2023-09-27 10:37:08', '2023-09-27 13:21:06'),
(140, 30, '2023-09-27', '2023-09-27 18:51:14', '2023-09-27 18:51:36', '2023-09-27 13:21:14', '2023-09-27 13:21:36'),
(141, 1, '2023-09-27', '2023-09-27 18:51:51', '2023-09-27 18:54:53', '2023-09-27 13:21:51', '2023-09-27 13:24:53'),
(142, 30, '2023-09-27', '2023-09-27 18:55:08', NULL, '2023-09-27 13:25:08', '2023-09-27 13:25:08'),
(143, 1, '2023-09-28', '2023-09-28 12:54:48', '2023-09-28 15:10:18', '2023-09-28 07:24:48', '2023-09-28 09:40:18'),
(144, 1, '2023-09-28', '2023-09-28 14:47:19', '2023-09-28 15:26:15', '2023-09-28 09:17:19', '2023-09-28 09:56:15'),
(145, 30, '2023-09-28', '2023-09-28 15:10:28', '2023-09-28 15:12:27', '2023-09-28 09:40:28', '2023-09-28 09:42:27'),
(146, 1, '2023-09-28', '2023-09-28 15:12:36', '2023-09-28 15:39:48', '2023-09-28 09:42:36', '2023-09-28 10:09:48'),
(147, 1, '2023-09-28', '2023-09-28 15:26:23', '2023-09-28 19:54:59', '2023-09-28 09:56:23', '2023-09-28 14:24:59'),
(148, 30, '2023-09-28', '2023-09-28 15:39:56', '2023-09-28 15:50:15', '2023-09-28 10:09:56', '2023-09-28 10:20:15'),
(149, 1, '2023-09-28', '2023-09-28 15:50:22', NULL, '2023-09-28 10:20:22', '2023-09-28 10:20:22'),
(150, 30, '2023-09-28', '2023-09-28 19:55:07', '2023-09-28 19:57:56', '2023-09-28 14:25:07', '2023-09-28 14:27:56'),
(151, 1, '2023-09-28', '2023-09-28 19:58:03', NULL, '2023-09-28 14:28:03', '2023-09-28 14:28:03'),
(152, 1, '2023-09-29', '2023-09-29 10:17:06', '2023-09-29 10:22:55', '2023-09-29 04:47:06', '2023-09-29 04:52:55'),
(153, 1, '2023-09-29', '2023-09-29 10:20:37', NULL, '2023-09-29 04:50:37', '2023-09-29 04:50:37'),
(154, 30, '2023-09-29', '2023-09-29 10:23:03', '2023-09-29 18:14:26', '2023-09-29 04:53:03', '2023-09-29 12:44:26'),
(155, 1, '2023-09-29', '2023-09-29 18:14:33', NULL, '2023-09-29 12:44:33', '2023-09-29 12:44:33'),
(156, 1, '2023-09-30', '2023-09-30 10:17:26', NULL, '2023-09-30 04:47:26', '2023-09-30 04:47:26'),
(157, 1, '2023-10-02', '2023-10-02 10:23:39', '2023-10-02 12:49:23', '2023-10-02 04:53:39', '2023-10-02 07:19:23'),
(158, 30, '2023-10-02', '2023-10-02 12:49:29', '2023-10-02 12:50:00', '2023-10-02 07:19:29', '2023-10-02 07:20:00'),
(159, 1, '2023-10-02', '2023-10-02 12:50:07', NULL, '2023-10-02 07:20:07', '2023-10-02 07:20:07'),
(160, 1, '2023-10-03', '2023-10-03 10:18:51', NULL, '2023-10-03 04:48:51', '2023-10-03 04:48:51'),
(161, 1, '2023-10-04', '2023-10-04 10:18:51', NULL, '2023-10-04 04:48:51', '2023-10-04 04:48:51'),
(162, 1, '2023-10-05', '2023-10-05 10:43:46', NULL, '2023-10-05 05:13:46', '2023-10-05 05:13:46'),
(163, 1, '2023-10-06', '2023-10-06 10:20:56', '2023-10-06 10:38:02', '2023-10-06 04:50:56', '2023-10-06 05:08:02'),
(164, 1, '2023-10-06', '2023-10-06 10:34:52', NULL, '2023-10-06 05:04:52', '2023-10-06 05:04:52'),
(165, 1, '2023-10-06', '2023-10-06 10:38:16', NULL, '2023-10-06 05:08:16', '2023-10-06 05:08:16'),
(166, 1, '2023-10-06', '2023-10-06 12:09:55', NULL, '2023-10-06 06:39:55', '2023-10-06 06:39:55'),
(167, 1, '2023-10-07', '2023-10-07 10:20:28', NULL, '2023-10-07 04:50:28', '2023-10-07 04:50:28'),
(168, 1, '2023-10-09', '2023-10-09 10:17:54', NULL, '2023-10-09 04:47:54', '2023-10-09 04:47:54'),
(169, 1, '2023-10-10', '2023-10-10 10:19:21', NULL, '2023-10-10 04:49:21', '2023-10-10 04:49:21'),
(170, 1, '2023-10-11', '2023-10-11 10:31:13', NULL, '2023-10-11 05:01:13', '2023-10-11 05:01:13'),
(171, 1, '2023-10-11', '2023-10-11 11:10:23', NULL, '2023-10-11 05:40:23', '2023-10-11 05:40:23'),
(172, 1, '2023-10-12', '2023-10-12 10:37:41', NULL, '2023-10-12 05:07:41', '2023-10-12 05:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `suggetions`
--

CREATE TABLE `suggetions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `sugg_name` varchar(70) DEFAULT NULL,
  `sugg_phone` varchar(70) DEFAULT NULL,
  `sugg_email` varchar(70) DEFAULT NULL,
  `sugg_complaint_type` varchar(70) DEFAULT NULL,
  `sugg_state` int(11) DEFAULT NULL,
  `sugg_district` int(11) DEFAULT NULL,
  `sugg_message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suggetions`
--

INSERT INTO `suggetions` (`id`, `customer_id`, `sugg_name`, `sugg_phone`, `sugg_email`, `sugg_complaint_type`, `sugg_state`, `sugg_district`, `sugg_message`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Abinash Sahoo', '7894570520', 'abinashsahoo306@gmail.com', 'Feedback', 24, 18, 'Bhubaneswar, Khordha,', '2023-01-26 14:09:09', '2023-01-26 14:09:09'),
(2, 2, 'TAPAS KUMAR SAMAL', '9337600059', 'tapaskumarsamal95@gmail.com', 'Suggestion', 24, 16, 'service compatibility required', '2023-02-16 20:36:47', '2023-02-16 20:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_role` int(11) NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL,
  `user_password` varchar(225) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `user_role`, `user_type`, `user_password`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'My Medical Mate', 'admin@mymedicalmate.com', NULL, 1, 1, NULL, '$2y$10$nt6xtb4hBXIgkfK9jr51O.IWw.TfcB72pZk3NP0Yirhx3p.Pf.PJi', 'wlngxB36BSw1NUOSh5IYdlZ8E3EPrkJdgKIA6ahjqQkt9NkIomdMKBztA1Xg', '2021-01-19 10:48:58', '2023-05-26 06:56:30'),
(20, 'Sharat Kumar Nayak', 'sharatgtalk@gmail.com', NULL, 2, 2, '123456789a', '$2y$10$nt6xtb4hBXIgkfK9jr51O.IWw.TfcB72pZk3NP0Yirhx3p.Pf.PJi', NULL, '2023-05-30 01:52:06', '2023-07-01 08:13:32'),
(27, 'Sharat Kumar', 'dearnisha2020@gmail.com', NULL, 6, 2, '1234', '$2y$10$k3tkVyv.y.cspHMpnhQT3uavHgn8gkB7jfaBdXCiwPq5Wvme3dZe2', NULL, '2023-07-01 08:34:18', '2023-07-01 08:34:18'),
(28, 'Sharat Kumar', 'sharat.coolattitude@gmail.com', NULL, 5, 2, 'sharat@1234', '$2y$10$4dO0OSpQmkWiogwe6KdLf.biRwvdppy7It1IkiTlCUSF4boIailf6', 'BGEUBWbf6y5QayisO5ePW7rsYFBlxHCODm8Qr98MYIjmr6Aw3pmJH0XMk5Xk', '2023-07-02 17:23:09', '2023-07-02 17:23:09'),
(29, 'HARI', 'tapaskumarsamal95@gmail.com', NULL, 2, 2, 'TAPA1234', '$2y$10$un3eZtNVbxnpTRlKoAGP.ucKg/.cxnH16srYY4T6NeuCtCHmENoYu', NULL, '2023-07-11 13:57:12', '2023-07-11 13:57:12'),
(30, 'Tanmaya Rout', 'tanmayarout101@gmail.com', NULL, 3, 2, '000000', '$2y$10$ewA4gpSCfNF8spkasMBSseooaGgXwajuR9W9RuRt/RdmULLfwgSi6', NULL, '2023-09-12 12:49:28', '2023-09-12 12:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_invoices`
--

CREATE TABLE `vendor_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medicine_name` varchar(225) DEFAULT NULL,
  `price` varchar(225) DEFAULT NULL,
  `quantity` varchar(225) DEFAULT NULL,
  `total_price` varchar(225) DEFAULT NULL,
  `discount` varchar(225) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=apply,1=Confirm,2=Cancelled by user',
  `created_by` int(11) DEFAULT 1,
  `is_approved_by_vendor` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_invoices`
--

INSERT INTO `vendor_invoices` (`id`, `medicine_name`, `price`, `quantity`, `total_price`, `discount`, `vendor_id`, `order_id`, `status`, `created_by`, `is_approved_by_vendor`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'Med1', '98', '10', '980', NULL, 4, 952321, 0, 1, 0, '2023-07-01 07:25:55', '2023-07-01 07:25:55', 0),
(2, 'Med2', '99', '20', '1980', NULL, 4, 952321, 0, 1, 0, '2023-07-01 07:26:48', '2023-07-01 07:26:48', 0),
(3, 'RM 10', '200', '10', '2000', NULL, 7, 132288, 0, 1, 0, '2023-07-03 14:56:05', '2023-07-03 14:56:05', 0),
(4, 'RM 10', '200', '10', '2000', NULL, 7, 132288, 0, 1, 0, '2023-07-03 14:56:28', '2023-07-03 14:56:28', 0),
(5, 'RM 10', '200', '10', '2000', NULL, 7, 132288, 0, 1, 0, '2023-07-03 14:56:53', '2023-07-03 14:56:53', 0),
(6, 'MTM2', '320', '5', '1600', NULL, 7, 670918, 0, 1, 0, '2023-07-04 09:42:11', '2023-07-04 09:42:11', 0),
(7, 'MTO', '210', '5', '1050', NULL, 7, 670918, 0, 1, 0, '2023-07-04 09:42:31', '2023-07-04 09:42:31', 0),
(8, 'MTO', '210', '5', '1050', NULL, 7, 670918, 0, 1, 0, '2023-07-04 09:42:32', '2023-07-04 09:42:32', 0),
(9, 'MM', '120', '10', '1200', NULL, 7, 431145, 0, 2, 0, '2023-07-13 14:57:49', '2023-07-13 14:57:49', 0),
(10, 'MTM2', '344', '5', '1720', NULL, 7, 431145, 0, 1, 0, '2023-07-13 14:58:14', '2023-07-13 14:58:14', 0),
(11, 'sdfsd', '3232', '22', '71104', NULL, 7, 996402, 0, 1, 0, '2023-07-27 12:45:35', '2023-07-27 12:45:35', 0),
(12, 'MTM2', '140', '5', '700', NULL, 7, 604700, 0, 1, 0, '2023-08-09 12:02:34', '2023-08-09 12:02:34', 0),
(13, 'ASA', '500', '12', '6000', NULL, 7, 604700, 0, 2, 0, '2023-08-09 12:12:10', '2023-08-09 12:12:10', 0),
(14, 'MTM', '100', '15', '1500', NULL, 11, 353577, 0, 1, 0, '2023-08-14 06:37:52', '2023-08-14 06:37:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_prescriptions`
--

CREATE TABLE `vendor_prescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED DEFAULT NULL,
  `prescription_id` int(10) UNSIGNED DEFAULT NULL,
  `medicine` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`medicine`)),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-Assign, 1-Approved, 2-Cancelled',
  `min_amount` varchar(225) DEFAULT NULL,
  `discount` varchar(225) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `max_amount` float DEFAULT NULL,
  `all_medicine` int(11) DEFAULT NULL,
  `appox_amount` decimal(10,0) DEFAULT NULL,
  `medicine_list` text DEFAULT NULL,
  `cancel_reason` varchar(225) DEFAULT NULL,
  `payment_status` int(11) DEFAULT 0,
  `payment_mode` varchar(225) DEFAULT NULL,
  `payment_receipt` varchar(225) DEFAULT NULL,
  `coin_applied` varchar(225) DEFAULT NULL,
  `coupon` varchar(225) DEFAULT NULL,
  `paid_amount` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_prescriptions`
--

INSERT INTO `vendor_prescriptions` (`id`, `vendor_id`, `prescription_id`, `medicine`, `status`, `min_amount`, `discount`, `created_at`, `updated_at`, `max_amount`, `all_medicine`, `appox_amount`, `medicine_list`, `cancel_reason`, `payment_status`, `payment_mode`, `payment_receipt`, `coin_applied`, `coupon`, `paid_amount`) VALUES
(1, 4, 1, NULL, 5, NULL, NULL, '2023-07-01 07:22:45', '2023-07-01 07:28:12', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2868.24'),
(2, 11, 2, NULL, 0, NULL, NULL, '2023-07-03 14:31:05', '2023-07-03 14:31:05', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(3, 4, 2, NULL, 0, NULL, NULL, '2023-07-03 14:31:05', '2023-07-03 14:31:05', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(4, 7, 2, NULL, 4, NULL, NULL, '2023-07-03 14:31:05', '2023-07-03 14:52:13', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(5, 4, 3, NULL, 0, NULL, NULL, '2023-07-04 09:33:33', '2023-07-04 09:33:33', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(6, 11, 3, NULL, 0, NULL, NULL, '2023-07-04 09:33:34', '2023-07-04 09:33:34', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(7, 7, 3, NULL, 5, NULL, NULL, '2023-07-04 09:33:34', '2023-07-04 10:32:46', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, '3014.2'),
(8, 11, 4, NULL, 0, NULL, NULL, '2023-07-05 16:45:50', '2023-07-05 16:45:50', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(9, 7, 4, NULL, 0, NULL, NULL, '2023-07-05 16:45:51', '2023-07-05 16:45:51', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(10, 4, 4, NULL, 0, NULL, NULL, '2023-07-05 16:45:51', '2023-07-05 16:45:51', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(11, 4, 5, NULL, 0, NULL, NULL, '2023-07-13 14:54:58', '2023-07-13 14:54:58', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(12, 7, 5, NULL, 4, '4000', '15', '2023-07-13 14:54:58', '2023-07-13 14:57:14', 4200, 1, 3400, '[{\"sl\":\"Sl-1\",\"name\":\"ddd\",\"available\":\"Not Available\"},{\"sl\":\"Sl-1\",\"name\":null,\"available\":\"Available\"}]', NULL, 0, NULL, NULL, NULL, NULL, NULL),
(13, 11, 5, NULL, 0, NULL, NULL, '2023-07-13 14:54:58', '2023-07-13 14:54:58', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(14, 11, 6, NULL, 0, NULL, NULL, '2023-07-27 11:49:43', '2023-07-27 11:49:43', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(15, 4, 6, NULL, 0, NULL, NULL, '2023-07-27 11:49:44', '2023-07-27 11:49:44', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(16, 7, 6, NULL, 4, NULL, NULL, '2023-07-27 11:49:44', '2023-07-27 12:31:32', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(17, 11, 7, NULL, 0, NULL, NULL, '2023-08-09 11:50:33', '2023-08-09 11:50:33', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(18, 4, 7, NULL, 0, NULL, NULL, '2023-08-09 11:50:33', '2023-08-09 11:50:33', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(19, 7, 7, NULL, 4, '4000', '10', '2023-08-09 11:50:33', '2023-08-09 11:55:18', 4200, 1, 3600, '[{\"sl\":\"Sl-1\",\"name\":null,\"available\":\"Available\"}]', NULL, 0, NULL, NULL, NULL, NULL, NULL),
(20, 11, 8, NULL, 4, '4000', '70', '2023-08-14 06:33:59', '2023-08-14 06:37:10', 4200, 1, 1200, '[{\"sl\":\"Sl-1\",\"name\":\"MMA\",\"available\":\"Not Available\"},{\"sl\":\"Sl-2\",\"name\":\"ASA\",\"available\":\"Available\"}]', NULL, 0, NULL, NULL, NULL, NULL, NULL),
(21, 4, 8, NULL, 0, NULL, NULL, '2023-08-14 06:33:59', '2023-08-14 06:33:59', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
(22, 7, 8, NULL, 0, NULL, NULL, '2023-08-14 06:33:59', '2023-08-14 06:33:59', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_related_pincodes`
--

CREATE TABLE `vendor_related_pincodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_related_pincodes`
--

INSERT INTO `vendor_related_pincodes` (`id`, `vendor_id`, `pincode`, `lat`, `long`, `created_at`, `updated_at`) VALUES
(1, 4, '751024', NULL, NULL, '2023-07-01 06:22:34', '2023-07-01 06:22:34'),
(2, 4, '751023', NULL, NULL, '2023-07-01 06:22:34', '2023-07-01 06:22:34'),
(3, 4, '751020', NULL, NULL, '2023-07-01 06:22:34', '2023-07-01 06:22:34'),
(4, 6, '751024', NULL, NULL, '2023-07-01 06:42:31', '2023-07-01 06:42:31'),
(5, 6, '751023', NULL, NULL, '2023-07-01 06:42:31', '2023-07-01 06:42:31'),
(6, 6, '751020', NULL, NULL, '2023-07-01 06:42:31', '2023-07-01 06:42:31'),
(7, 6, '754217', NULL, NULL, '2023-07-01 06:42:31', '2023-07-01 06:42:31'),
(11, 3, '751024', NULL, NULL, '2023-07-01 07:37:50', '2023-07-01 07:37:50'),
(12, 3, '751023', NULL, NULL, '2023-07-01 07:37:50', '2023-07-01 07:37:50'),
(13, 3, '751020', NULL, NULL, '2023-07-01 07:37:50', '2023-07-01 07:37:50'),
(14, 3, '754217', NULL, NULL, '2023-07-01 07:37:50', '2023-07-01 07:37:50'),
(15, 3, '754111', NULL, NULL, '2023-07-01 07:37:50', '2023-07-01 07:37:50'),
(16, 3, '754000', NULL, NULL, '2023-07-01 07:37:50', '2023-07-01 07:37:50'),
(17, 5, '751024', NULL, NULL, '2023-07-01 07:52:41', '2023-07-01 07:52:41'),
(18, 5, '751023', NULL, NULL, '2023-07-01 07:52:41', '2023-07-01 07:52:41'),
(19, 5, '751020', NULL, NULL, '2023-07-01 07:52:41', '2023-07-01 07:52:41'),
(20, 7, '751024', NULL, NULL, '2023-07-01 07:54:03', '2023-07-01 07:54:03'),
(21, 7, '751023', NULL, NULL, '2023-07-01 07:54:03', '2023-07-01 07:54:03'),
(22, 7, '751020', NULL, NULL, '2023-07-01 07:54:03', '2023-07-01 07:54:03'),
(23, 8, '751023', NULL, NULL, '2023-07-01 08:03:40', '2023-07-01 08:03:40'),
(24, 8, '751020', NULL, NULL, '2023-07-01 08:03:40', '2023-07-01 08:03:40'),
(25, 8, '754217', NULL, NULL, '2023-07-01 08:03:40', '2023-07-01 08:03:40'),
(26, 9, '751024', NULL, NULL, '2023-07-01 08:12:54', '2023-07-01 08:12:54'),
(27, 9, '751023', NULL, NULL, '2023-07-01 08:12:54', '2023-07-01 08:12:54'),
(28, 9, '751020', NULL, NULL, '2023-07-01 08:12:54', '2023-07-01 08:12:54'),
(29, 9, '754217', NULL, NULL, '2023-07-01 08:12:54', '2023-07-01 08:12:54'),
(30, 9, '754111', NULL, NULL, '2023-07-01 08:12:54', '2023-07-01 08:12:54'),
(31, 9, '754000', NULL, NULL, '2023-07-01 08:12:54', '2023-07-01 08:12:54'),
(32, 10, '751024', NULL, NULL, '2023-07-01 08:18:19', '2023-07-01 08:18:19'),
(33, 10, '751023', NULL, NULL, '2023-07-01 08:18:19', '2023-07-01 08:18:19'),
(34, 10, '751020', NULL, NULL, '2023-07-01 08:18:19', '2023-07-01 08:18:19'),
(35, 10, '754217', NULL, NULL, '2023-07-01 08:18:19', '2023-07-01 08:18:19'),
(36, 11, '751024', NULL, NULL, '2023-07-01 08:33:17', '2023-07-01 08:33:17'),
(37, 11, '751023', NULL, NULL, '2023-07-01 08:33:17', '2023-07-01 08:33:17'),
(38, 11, '751020', NULL, NULL, '2023-07-01 08:33:17', '2023-07-01 08:33:17'),
(39, 12, '751024', NULL, NULL, '2023-07-05 17:11:39', '2023-07-05 17:11:39'),
(40, 12, '751023', NULL, NULL, '2023-07-05 17:11:39', '2023-07-05 17:11:39'),
(41, 12, '751020', NULL, NULL, '2023-07-05 17:11:39', '2023-07-05 17:11:39'),
(42, 12, '754217', NULL, NULL, '2023-07-05 17:11:39', '2023-07-05 17:11:39'),
(43, 12, '754111', NULL, NULL, '2023-07-05 17:11:39', '2023-07-05 17:11:39'),
(44, 12, '754000', NULL, NULL, '2023-07-05 17:11:39', '2023-07-05 17:11:39'),
(45, 13, '751023', NULL, NULL, '2023-07-26 13:07:15', '2023-07-26 13:07:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alltype_ads`
--
ALTER TABLE `alltype_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alltype_user_logs`
--
ALTER TABLE `alltype_user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_bonuses`
--
ALTER TABLE `all_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assistant_boy_bookings`
--
ALTER TABLE `assistant_boy_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistant_boy_bookings_customer_id_foreign` (`customer_id`),
  ADD KEY `assistant_boy_bookings_assistant_boy_id_foreign` (`assistant_boy_id`);

--
-- Indexes for table `assistant_cancel_bookings`
--
ALTER TABLE `assistant_cancel_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistant_cancel_bookings_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `assistant_fwrd_bookings`
--
ALTER TABLE `assistant_fwrd_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistant_fwrd_bookings_booking_id_foreign` (`booking_id`),
  ADD KEY `assistant_fwrd_bookings_assistant_boy_fwrd_from_id_foreign` (`assistant_boy_fwrd_from_id`),
  ADD KEY `assistant_fwrd_bookings_assistant_boy_fwrd_to_id_foreign` (`assistant_boy_fwrd_to_id`);

--
-- Indexes for table `assistant_reviews`
--
ALTER TABLE `assistant_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assistant_reviews_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `booking_commisions`
--
ALTER TABLE `booking_commisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_delivery_requests`
--
ALTER TABLE `booking_delivery_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_account_id_foreign` (`account_id`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_details_customer_id_foreign` (`account_id`);

--
-- Indexes for table `customer_prescriptions`
--
ALTER TABLE `customer_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_prescriptions_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `disease_details`
--
ALTER TABLE `disease_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locators`
--
ALTER TABLE `locators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locators_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
-- Indexes for table `order_medmates`
--
ALTER TABLE `order_medmates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_medmates_medmate_id_foreign` (`medmate_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_answars`
--
ALTER TABLE `question_answars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reasons`
--
ALTER TABLE `reasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reasons_account_id_foreign` (`account_id`);

--
-- Indexes for table `referal_bonuses`
--
ALTER TABLE `referal_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referal_code_details`
--
ALTER TABLE `referal_code_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `staff_working_hours`
--
ALTER TABLE `staff_working_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suggetions`
--
ALTER TABLE `suggetions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suggetions_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor_invoices`
--
ALTER TABLE `vendor_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_prescriptions`
--
ALTER TABLE `vendor_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_prescriptions_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_prescriptions_prescription_id_foreign` (`prescription_id`);

--
-- Indexes for table `vendor_related_pincodes`
--
ALTER TABLE `vendor_related_pincodes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alltype_ads`
--
ALTER TABLE `alltype_ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alltype_user_logs`
--
ALTER TABLE `alltype_user_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `all_bonuses`
--
ALTER TABLE `all_bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `assistant_boy_bookings`
--
ALTER TABLE `assistant_boy_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `assistant_cancel_bookings`
--
ALTER TABLE `assistant_cancel_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assistant_fwrd_bookings`
--
ALTER TABLE `assistant_fwrd_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assistant_reviews`
--
ALTER TABLE `assistant_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking_commisions`
--
ALTER TABLE `booking_commisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking_delivery_requests`
--
ALTER TABLE `booking_delivery_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `customer_prescriptions`
--
ALTER TABLE `customer_prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `disease_details`
--
ALTER TABLE `disease_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locators`
--
ALTER TABLE `locators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_medmates`
--
ALTER TABLE `order_medmates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `question_answars`
--
ALTER TABLE `question_answars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reasons`
--
ALTER TABLE `reasons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `referal_bonuses`
--
ALTER TABLE `referal_bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `referal_code_details`
--
ALTER TABLE `referal_code_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `staff_working_hours`
--
ALTER TABLE `staff_working_hours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT for table `suggetions`
--
ALTER TABLE `suggetions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendor_invoices`
--
ALTER TABLE `vendor_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vendor_prescriptions`
--
ALTER TABLE `vendor_prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `vendor_related_pincodes`
--
ALTER TABLE `vendor_related_pincodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assistant_boy_bookings`
--
ALTER TABLE `assistant_boy_bookings`
  ADD CONSTRAINT `assistant_boy_bookings_assistant_boy_id_foreign` FOREIGN KEY (`assistant_boy_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `assistant_boy_bookings_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `assistant_cancel_bookings`
--
ALTER TABLE `assistant_cancel_bookings`
  ADD CONSTRAINT `assistant_cancel_bookings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `assistant_boy_bookings` (`id`);

--
-- Constraints for table `assistant_fwrd_bookings`
--
ALTER TABLE `assistant_fwrd_bookings`
  ADD CONSTRAINT `assistant_fwrd_bookings_assistant_boy_fwrd_from_id_foreign` FOREIGN KEY (`assistant_boy_fwrd_from_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `assistant_fwrd_bookings_assistant_boy_fwrd_to_id_foreign` FOREIGN KEY (`assistant_boy_fwrd_to_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `assistant_fwrd_bookings_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `assistant_boy_bookings` (`id`);

--
-- Constraints for table `assistant_reviews`
--
ALTER TABLE `assistant_reviews`
  ADD CONSTRAINT `assistant_reviews_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `assistant_boy_bookings` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account_types` (`id`);

--
-- Constraints for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD CONSTRAINT `customer_details_customer_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `customer_prescriptions`
--
ALTER TABLE `customer_prescriptions`
  ADD CONSTRAINT `customer_prescriptions_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
