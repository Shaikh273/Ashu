-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 01:28 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ashu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_org`
--

CREATE TABLE `admin_org` (
  `id` int(10) NOT NULL,
  `admin_id` varchar(56) CHARACTER SET utf8 NOT NULL,
  `org_id` varchar(56) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_org`
--

INSERT INTO `admin_org` (`id`, `admin_id`, `org_id`, `status`) VALUES
(1, 'Maa-Maj-A_01', 'Ash_01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `my_key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `my_key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, 'taibah123456', 0, 0, 0, NULL, 0);

-- --------------------------------------------------------

--

-- Table structure for table `history_anthropometry`
--

CREATE TABLE `history_anthropometry` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `height` int(3) NOT NULL,
  `weight` int(3) NOT NULL,
  `bmi` int(3) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_anthropometry`
--

INSERT INTO `history_anthropometry` (`id`, `C_id`, `height`, `weight`, `bmi`, `comments`, `created_at`, `updated_at`) VALUES
(1, '1', 0, 0, 0, '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', 0, 0, 0, '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', 0, 0, 0, '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', 0, 0, 0, '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', 0, 0, 0, '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', 0, 0, 0, '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', 0, 0, 0, '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', 0, 0, 0, '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', 0, 0, 0, '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', 0, 0, 0, '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', 0, 0, 0, '', '2023-01-05 06:38:02', '2023-01-05 11:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `history_chief_complaints`
--

CREATE TABLE `history_chief_complaints` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `chief_complaint_type` varchar(40) NOT NULL,
  `name` varchar(30) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `comments1` varchar(100) NOT NULL,
  `options` varchar(30) NOT NULL,
  `comments2` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_chief_complaints`
--

INSERT INTO `history_chief_complaints` (`id`, `C_id`, `chief_complaint_type`, `name`, `duration`, `duration_unit`, `comments1`, `options`, `comments2`, `created_at`, `updated_at`) VALUES
(1, '1', '', '', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '', '', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '', '', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '', '', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '', '', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '', '', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '', '', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '', '', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '', '', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '', '', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '', '', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02'),
(19, 'Case_2022-2023_01', '', 'BILAL', '', '', '', '', '', '2023-01-05 13:44:40', '2023-01-05 18:14:40'),
(20, 'Case_2022-2023_02', '', 'Malaria and Dengue', '', '', '', '', '', '2023-01-05 13:50:48', '2023-01-05 18:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `history_contact_allergies`
--

CREATE TABLE `history_contact_allergies` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `contact_allergies_type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `comments1` varchar(100) NOT NULL,
  `comments2` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_contact_allergies`
--

INSERT INTO `history_contact_allergies` (`id`, `C_id`, `contact_allergies_type`, `name`, `duration`, `duration_unit`, `comments1`, `comments2`, `created_at`, `updated_at`) VALUES
(1, '1', '', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02'),
(18, '0', '', 'BILAL', '', '', '', '', '2023-01-05 13:34:15', '2023-01-05 18:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `history_drug_allergies`
--

CREATE TABLE `history_drug_allergies` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `drug_allergies_type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `comments1` varchar(100) NOT NULL,
  `comments2` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_drug_allergies`
--

INSERT INTO `history_drug_allergies` (`id`, `C_id`, `drug_allergies_type`, `name`, `duration`, `duration_unit`, `comments1`, `comments2`, `created_at`, `updated_at`) VALUES
(1, '1', '', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02'),
(18, '0', '', 'BILAL', '', '', '', '', '2023-01-05 13:34:15', '2023-01-05 18:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `history_food_allergies`
--

CREATE TABLE `history_food_allergies` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `food_allergies_type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `comments1` varchar(100) NOT NULL,
  `comments2` varchar(100) NOT NULL,
  `other` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_food_allergies`
--

INSERT INTO `history_food_allergies` (`id`, `C_id`, `food_allergies_type`, `name`, `duration`, `duration_unit`, `comments1`, `comments2`, `other`, `created_at`, `updated_at`) VALUES
(1, '1', '', '', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '', '', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '', '', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '', '', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '', '', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '', '', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '', '', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '', '', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '', '', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '', '', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '', '', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02'),
(18, '0', '', 'BILAL', '', '', '', '', '', '2023-01-05 13:34:15', '2023-01-05 18:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `history_systemic_history`
--

CREATE TABLE `history_systemic_history` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `systemic_history_type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `comments1` varchar(100) NOT NULL,
  `comments2` varchar(100) NOT NULL,
  `family_history` varchar(30) NOT NULL,
  `medical_history` varchar(30) NOT NULL,
  `special_status` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_systemic_history`
--

INSERT INTO `history_systemic_history` (`id`, `C_id`, `systemic_history_type`, `name`, `duration`, `duration_unit`, `comments1`, `comments2`, `family_history`, `medical_history`, `special_status`, `created_at`, `updated_at`) VALUES
(1, '1', '', '', '', '', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '', '', '', '', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '', '', '', '', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '', '', '', '', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '', '', '', '', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '', '', '', '', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '', '', '', '', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '', '', '', '', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '', '', '', '', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '', '', '', '', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '', '', '', '', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02'),
(18, '0', '', 'BILAL', '', '', '', '', '', '', '', '2023-01-05 13:34:15', '2023-01-05 18:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `history_visit`
--

CREATE TABLE `history_visit` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `org_id` varchar(65) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `visit_type` varchar(65) NOT NULL,
  `comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_visit`
--

INSERT INTO `history_visit` (`id`, `C_id`, `org_id`, `pat_id`, `visit_type`, `comments`, `created_at`, `updated_at`) VALUES
(1, 'Case_2022-2023_01', 'Ash_01', 'BIL-P_01', 'Cough', '0', '2023-01-05 13:44:40', '2023-01-05 18:14:40'),
(2, 'Case_2022-2023_02', 'Ash_01', 'BIL-P_01', 'Malar', '0', '2023-01-05 13:50:48', '2023-01-05 18:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `history_vital_signs`
--

CREATE TABLE `history_vital_signs` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `temperature` varchar(5) NOT NULL,
  `pulse` varchar(5) NOT NULL,
  `blood_pressure` varchar(5) NOT NULL,
  `rr` varchar(5) NOT NULL,
  `spo2` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_vital_signs`
--

INSERT INTO `history_vital_signs` (`id`, `C_id`, `temperature`, `pulse`, `blood_pressure`, `rr`, `spo2`, `created_at`, `updated_at`) VALUES
(1, '1', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(10) NOT NULL,
  `org_id` varchar(100) NOT NULL,
  `org_logo` varchar(65) NOT NULL,
  `org_name` varchar(10) NOT NULL,
  `org_country` varchar(10) NOT NULL,
  `org_state` varchar(40) NOT NULL,
  `org_district` varchar(30) NOT NULL,
  `org_city` varchar(30) NOT NULL,
  `org_pincode` varchar(30) NOT NULL,
  `org_address` varchar(100) NOT NULL,
  `org_email` varchar(30) NOT NULL,
  `org_No` varchar(100) NOT NULL,
  `org_addedby` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `org_id`, `org_logo`, `org_name`, `org_country`, `org_state`, `org_district`, `org_city`, `org_pincode`, `org_address`, `org_email`, `org_No`, `org_addedby`, `created_at`, `updated_at`) VALUES
(1, 'Ash_01', '', 'Ashu', 'India', 'Maharashtra', 'Mumbai', '400010', '', 'madanpura Nagpada 2 taki', 'nooralam@gmail.com', '8898971045', 'Maa-S_01', '2023-01-04 11:50:24', '2023-01-04 16:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(30) NOT NULL,
  `pat_id` varchar(55) CHARACTER SET utf8 NOT NULL,
  `org_id` varchar(55) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile_no` varchar(15) CHARACTER SET utf8 NOT NULL,
  `secondarynumber` varchar(15) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 NOT NULL,
  `DOB` varchar(15) CHARACTER SET utf8 NOT NULL,
  `year` varchar(11) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `months` varchar(11) CHARACTER SET utf8 NOT NULL,
  `language` varchar(100) NOT NULL,
  `patienttype` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `employeeid` varchar(100) NOT NULL,
  `medicalrecordno` varchar(100) NOT NULL,
  `governmentid_type` varchar(100) NOT NULL,
  `governmentidno` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `blood_grp` varchar(100) NOT NULL,
  `maritail_status` varchar(100) NOT NULL,
  `disabled` varchar(100) NOT NULL,
  `emg_relation` varchar(100) NOT NULL,
  `emg_name` varchar(100) NOT NULL,
  `emg_no` varchar(100) NOT NULL,
  `created_at` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `pat_id`, `org_id`, `first_name`, `middle_name`, `last_name`, `mobile_no`, `secondarynumber`, `email`, `gender`, `DOB`, `year`, `months`, `language`, `patienttype`, `address`, `state`, `city`, `pincode`, `occupation`, `employeeid`, `medicalrecordno`, `governmentid_type`, `governmentidno`, `img`, `blood_grp`, `maritail_status`, `disabled`, `emg_relation`, `emg_name`, `emg_no`, `created_at`, `updated_at`) VALUES
(1, 'BIL-P_01', 'Ash_01', 'BILAL', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker90490953161931933023.jpg', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-05 10:49:47.000000', '2023-01-05 15:19:47.113639'),
(2, 'BIL-P_02', 'Ash_01', 'BILAL', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker90490953161931933024.jpg', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-05 10:50:47.000000', '2023-01-05 15:20:47.820945'),
(3, 'BIL-P_03', 'Ash_01', 'BILAL', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker90490953161931933025.jpg', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-05 10:59:02.000000', '2023-01-05 15:29:02.381903'),
(4, 'BIL-P_04', 'Ash_01', 'BILAL', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker9049095316193193302.jpg', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-05 11:01:32.000000', '2023-01-05 15:31:32.224345');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(65) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2023-01-03 11:15:59', '2023-01-03 11:15:59'),
(2, 'Admin', '2023-01-03 11:15:59', '2023-01-03 11:15:59'),
(3, 'Doctor', '2023-01-03 11:15:59', '2023-01-03 11:15:59'),
(4, 'Clinic Operator', '2023-01-03 11:15:59', '2023-01-03 12:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `u_id` varchar(65) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `org_id` varchar(65) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `gender` text NOT NULL,
  `d_o_b` date NOT NULL,
  `age` int(22) NOT NULL,
  `address` text NOT NULL,
  `mobile_no` int(22) NOT NULL,
  `img` text NOT NULL,
  `qualification` text NOT NULL,
  `speciality` text NOT NULL,
  `ID_proof` text NOT NULL,
  `ID_img` text NOT NULL,
  `join_date` date NOT NULL,
  `role_id` int(22) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `u_id`, `admin`, `org_id`, `name`, `email`, `password`, `gender`, `d_o_b`, `age`, `address`, `mobile_no`, `img`, `qualification`, `speciality`, `ID_proof`, `ID_img`, `join_date`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Maa-S_01', '', '', 'Maaz', 'maazoly1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 1, 0, '2023-01-03 12:30:44', '2023-01-03 12:30:44'),
(2, 'Maa-Maj-A_01', 'Maa-S_01', '', 'Majid Ansari', 'majid@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 2, 0, '2023-01-04 10:08:14', '2023-01-04 10:08:32'),
(4, 'Maj-Zai-D_01', 'Maa-Maj-A_01', 'Ash_01', 'Zaid Ansari', 'shaikhmohdzaid5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 3, 0, '2023-01-04 10:19:10', '2023-01-04 10:56:54'),
(7, 'Maj-Noo-C_01', 'Maa-Maj-A_01', 'Ash_01', 'Noor Alam', 'nooralam@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 4, 0, '2023-01-04 10:56:44', '2023-01-04 10:56:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_org`
--
ALTER TABLE `admin_org`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breaktime`
--
ALTER TABLE `breaktime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_anthropometry`
--
ALTER TABLE `history_anthropometry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_chief_complaints`
--
ALTER TABLE `history_chief_complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_contact_allergies`
--
ALTER TABLE `history_contact_allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_drug_allergies`
--
ALTER TABLE `history_drug_allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_food_allergies`
--
ALTER TABLE `history_food_allergies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_systemic_history`
--
ALTER TABLE `history_systemic_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_visit`
--
ALTER TABLE `history_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_vital_signs`
--
ALTER TABLE `history_vital_signs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_org`
--
ALTER TABLE `admin_org`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `breaktime`
--
ALTER TABLE `breaktime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1717;

--
-- AUTO_INCREMENT for table `history_anthropometry`
--
ALTER TABLE `history_anthropometry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `history_chief_complaints`
--
ALTER TABLE `history_chief_complaints`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `history_contact_allergies`
--
ALTER TABLE `history_contact_allergies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_drug_allergies`
--
ALTER TABLE `history_drug_allergies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_food_allergies`
--
ALTER TABLE `history_food_allergies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_systemic_history`
--
ALTER TABLE `history_systemic_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `history_visit`
--
ALTER TABLE `history_visit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history_vital_signs`
--
ALTER TABLE `history_vital_signs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
