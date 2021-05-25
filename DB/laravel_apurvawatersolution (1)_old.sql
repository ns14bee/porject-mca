-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 07:34 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_apurvawatersolution`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `entry_time` datetime DEFAULT current_timestamp(),
  `exit_time` datetime DEFAULT NULL,
  `registered` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `entry_time`, `exit_time`, `registered`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 32, '2021-04-12 02:47:53', '2021-04-12 02:47:53', 'yes', 'Present', '2021-04-11 21:17:53', '2021-04-11 21:19:33', NULL),
(4, 32, '2021-04-14 01:45:10', '2021-04-14 01:45:10', 'yes', 'Present', '2021-04-13 20:15:10', '2021-04-13 20:17:28', NULL),
(8, 33, '2021-04-14 01:56:53', '2021-04-14 01:57:00', 'yes', 'Present', '2021-04-13 20:26:53', '2021-04-13 20:27:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deceased_details`
--

CREATE TABLE `deceased_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `deceased_number` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_passing` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` bigint(20) NOT NULL,
  `dept_name` varchar(250) DEFAULT NULL,
  `dept_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dept_name`, `dept_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Account Department', 'Part of a company\'s administration that is responsible for preparing the financial statements, maintaining the general ledger, paying bills, billing customers, payroll, cost accounting, financial analysis, and more.', '2021-04-04 15:24:56', '2021-04-04 15:24:56', NULL),
(2, 'account', 'Definition: An account is a record in an accounting system that tracks the financial activities of a specific asset, liability, equity, revenue, or expense. ... Each individual account is stored in the general ledger and used to prepare the financial statements at the end of an accounting period.', '2021-04-09 15:14:23', '2021-04-09 15:36:02', '2021-04-09 15:36:02'),
(3, 'Marketing Department', 'A marketing department promotes your business and drives sales of its products or services. It provides the necessary research to identify your target customers and other audiences. Depending on the company\'s hierarchical organization, a marketing director, manager or vice president of marketing might be at the helm.', '2021-04-09 16:00:57', '2021-04-09 16:00:57', NULL),
(4, 'Projects Department', 'A Project Management Office (also called PMO), is an office or department within an organization that defines and maintains standards for project management. The Project Management Office provides guidance and standards in the execution of projects.', '2021-04-09 16:01:25', '2021-04-09 16:01:25', NULL),
(5, 'Receptions Department', 'A receptionist is an employee taking an office or administrative support position. ... Such receptionists are often called front desk clerks. Receptionists cover many areas of work to assist the businesses they work for, including setting appointments, filing, record keeping, and other office tasks.', '2021-04-09 16:01:52', '2021-04-09 16:01:52', NULL);

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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`) VALUES
(1, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `menu_permission`
--

CREATE TABLE `menu_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `read` int(11) NOT NULL DEFAULT 0,
  `write` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_permission`
--

INSERT INTO `menu_permission` (`id`, `user_id`, `menu_id`, `read`, `write`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, '2020-05-13 22:51:07', '2020-05-13 22:51:07'),
(2, 8, 1, 0, 1, '2020-05-14 08:10:07', '2020-05-14 09:38:26'),
(3, 9, 1, 1, 1, '2020-05-14 09:31:33', '2020-05-14 09:38:21'),
(4, 10, 1, 1, 0, '2020-05-15 03:48:24', '2020-05-15 03:50:21'),
(5, 18, 1, 1, 1, '2020-05-15 05:48:36', '2020-05-15 05:48:36'),
(6, 32, 1, 1, 1, '2021-04-02 15:41:14', '2021-04-09 16:26:40'),
(7, 33, 1, 1, 1, '2021-04-02 16:06:02', '2021-04-09 16:26:31'),
(8, 34, 1, 1, 1, '2021-04-09 16:09:55', '2021-04-09 16:26:19');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

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
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Employee', NULL, NULL),
(3, 'Guest', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_user_id` bigint(20) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recovery_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `forgot_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `salary` double(8,2) DEFAULT NULL,
  `wrong_attempt_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `parent_user_id`, `role_id`, `name`, `email`, `recovery_email`, `profile_pic`, `email_verified_at`, `password`, `remember_token`, `forgot_code`, `status`, `department_id`, `join_date`, `salary`, `wrong_attempt_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UHL00001', NULL, 1, 'Admin', 'info@apurvawater.com', 'Admin', NULL, '2020-05-13 18:30:00', '$2y$10$ZCjzN0mAqsQcsHqzTa6/9eugeOTNXzjGkxscDlqQN0Wv.HYW7iMOS', NULL, NULL, 'active', NULL, NULL, NULL, 0, '2020-05-13 22:49:31', '2021-04-01 16:27:08', NULL),
(32, 'EMP00002', NULL, 2, 'niraj surati', 'niraj.surati01@gmail.com', NULL, NULL, '2021-04-02 15:41:04', '$2y$10$LiflOy.Pk5vh81flBW008eoUWLfD57AdeRQjhOBryuvigkLXADZwi', NULL, NULL, 'active', '3', NULL, NULL, 0, '2021-04-02 15:41:04', '2021-04-09 16:26:40', NULL),
(33, 'EMP00002', NULL, 2, 'Hiren Patel', 'patelhiren.hp19@gmail.com', NULL, NULL, '2021-04-02 16:05:57', '$2y$10$iIj0OjNli1c8gFRwqw8LNOQmQ00rzGt8YRx5I/zEbs5uFV21omQz.', NULL, NULL, 'active', '5', NULL, NULL, 0, '2021-04-02 16:05:57', '2021-04-11 20:54:48', NULL),
(34, 'EMP00002', NULL, 2, 'Hiren Patel', 'patelhiren.hp12@gmail.com', NULL, NULL, '2021-04-09 16:09:47', '$2y$10$ikH3VVn2PZ8eyGe2jtFGdOeGMEban.Fl3xS5e.dhRHQeSojkVWLdC', NULL, NULL, 'active', '1', NULL, NULL, 0, '2021-04-09 16:09:47', '2021-04-15 05:28:56', '2021-04-15 05:28:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deceased_details`
--
ALTER TABLE `deceased_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_permission`
--
ALTER TABLE `menu_permission`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deceased_details`
--
ALTER TABLE `deceased_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_permission`
--
ALTER TABLE `menu_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
