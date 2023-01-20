-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 12:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

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
(1, 'Case_2022-2023_01', 0, 0, 0, 'TEST', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', 174, 0, 0, '1testaaaaaaaaaaaaaaaaaaa', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', 174, 0, 0, '', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 0, 0, 0, 'teast', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 0, 0, 0, 'teast', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', 0, 0, 0, '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', 0, 0, 0, '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', 0, 0, 0, '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
(1, 'Case_2022-2023_01', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', '1test', 'Bilal', '10', '', '', '', 'No I have Done Properly', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', 'Not Treated Properly', 'Bilal', '10', '', '', '', 'No I have Done Properly', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 'test', 'test', 'test', 'test', 'test', 'test', '', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'test', 'test', 'test', 'test', 'test', 'test', '', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', '', '', '', '', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', 'test', '', '', '', '', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', '123test', '', '', '', '', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
(1, 'Case_2022-2023_01', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', '', 'Epidermis', '5', '', '', '', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', '', 'Epidermis', '5', '', '', '', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 'test', 'test', 'test', 'tesst', 'test', 'test', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'test', 'test', 'test', 'tesst', 'test', 'test', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', '', '', '', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', '', '', '', '', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', '', '', '', '', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
(1, 'Case_2022-2023_01', 'Hello', 'Biotin', 'Hello', 'Hello', 'Hello', 'Hello', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', '', 'Biotin', '20', '', '', '', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', '', 'Biotin', '20', '', '', '', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 'test', 'etts', 'test', 'test', 'test', 'test', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'test', 'etts', 'test', 'test', 'test', 'test', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', '', '', '', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', '', '', '', '', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', '', '', '', '', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
(1, 'Case_2022-2023_01', 'Hello', 'Mushroom', 'Hello', 'Hello', 'Hello', 'Hello', '', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', '', 'Mushroom', '12', '', '', '', '', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', '', 'Mushroom', '12', '', '', '', '', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 'test', 'ttestasdas', 'test', 'test', 'test', 'test', 'test', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'test', 'ttestasdas', 'test', 'test', 'test', 'test', 'test', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', '', '', '', '', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', '', '', '', '', '', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', '', '', '', '', '', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
(1, 'Case_2022-2023_01', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', '', 'Lungs', '15', '', '', '', '', '', '', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', '', 'Lungs', '15', '', '', '', '', '', '', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 'test', 'test', 'etets', 'test', 'test', 'test', 'test', 'ests', 'test', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'test', 'test', 'etets', 'test', 'test', 'test', 'test', 'ests', 'test', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', '', '', '', '', '', '', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', '', '', '', '', '', '', '', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', '', '', '', '', '', '', '', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
  `created_by` varchar(55) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_visit`
--

INSERT INTO `history_visit` (`id`, `C_id`, `org_id`, `pat_id`, `visit_type`, `comments`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Case_2022-2023_01', 'Ash_01', 'BIL-P_01 ', 'Fever', 'Cough and Cold', '', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(5, 'Case_2022-2023_04', 'INC_02', 'BIL-P_04', 'Test', '', 'Maj-Noo-C_01', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'INC_02', 'BIL-P_04', 'Test', '', 'Maj-Noo-C_01', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', 'BIL-P_01', 'test12', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', 'Ash_01', 'TES-P_05', 'Test', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', 'Ash_01', 'TES-P_05', 'Test123', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

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
(1, 'Case_2022-2023_01', 'Hello', 'Hello', 'Hello', 'Hello', 'Hello', '2023-01-07 08:07:22', '2023-01-07 12:37:22'),
(3, 'Case_2022-2023_02', '', '', '70', '', '', '2023-01-09 07:51:32', '2023-01-09 12:21:32'),
(4, 'Case_2022-2023_03', '', '', '70', '', '', '2023-01-09 08:01:25', '2023-01-09 12:31:25'),
(5, 'Case_2022-2023_04', 'tets', 'asdas', 'test', 'tasda', 'teast', '2023-01-09 10:27:50', '2023-01-09 14:57:50'),
(6, 'Case_2022-2023_05', 'tets', 'asdas', 'test', 'tasda', 'teast', '2023-01-09 12:53:47', '2023-01-09 17:23:47'),
(7, 'Case_2022-2023_06', '', '', '', '', '', '2023-01-10 07:05:32', '2023-01-10 11:35:32'),
(8, 'Case_2022-2023_07', '', '', '', '', '', '2023-01-10 07:06:46', '2023-01-10 11:36:46'),
(9, 'Case_2022-2023_08', '', '', '', '', '', '2023-01-10 07:07:20', '2023-01-10 11:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` int(55) NOT NULL,
  `prescription_id` varchar(55) NOT NULL,
  `instruction` varchar(556) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `prescription_id`, `instruction`, `created_at`, `updated_at`) VALUES
(1, '6', 'test', '2023-01-19 08:02:01', '2023-01-20 09:36:54');

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
(1, 'Ash_01', '', 'Ashu', 'India', 'Maharashtra', 'Mumbai', '400010', '', 'madanpura Nagpada 2 taki', 'nooralam@gmail.com', '8898971045', 'Maa-S_01', '2023-01-04 11:50:24', '2023-01-04 16:20:24'),
(6, 'INC_02', '', 'INCUBATION', 'India', 'Maharashtra', 'Raigad', 'Panvel', '', 'Test', 'test@gmial.com', '', '', '2023-01-09 12:52:22', '2023-01-09 17:22:22');

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
  `years` varchar(11) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `months` varchar(11) CHARACTER SET utf8 NOT NULL,
  `days` varchar(55) NOT NULL,
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
  `qr` varchar(55) NOT NULL,
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

INSERT INTO `patients` (`id`, `pat_id`, `org_id`, `first_name`, `middle_name`, `last_name`, `mobile_no`, `secondarynumber`, `email`, `gender`, `DOB`, `years`, `months`, `days`, `language`, `patienttype`, `address`, `state`, `city`, `pincode`, `occupation`, `employeeid`, `medicalrecordno`, `governmentid_type`, `governmentidno`, `img`, `qr`, `blood_grp`, `maritail_status`, `disabled`, `emg_relation`, `emg_name`, `emg_no`, `created_at`, `updated_at`) VALUES
(1, 'BIL-P_01', 'Ash_01', 'BILAL', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker90490953161931933023.jpg', '', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-05 10:49:47.000000', '2023-01-05 15:19:47.113639'),
(3, 'BIL-P_03', 'Ash_01', 'Saqib', 'Salim', 'Shaikh', '+918286012383', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Yes', '', '', '', '', '2023-01-05 10:59:02.000000', '2023-01-05 15:29:02.381903'),
(4, 'BIL-P_04', 'INC_02', 'BILAL', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker9049095316193193302.jpg', '', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-05 11:01:32.000000', '2023-01-05 15:31:32.224345'),
(5, 'TES-P_05', 'INC_02', 'TEST', 'SALIM', 'SHAIKH', '', '', 'bilal.softdigit@gmail.com', 'male', '27-03-2001', '', '', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400072', 'Developer', '', '', 'Aadhar Card', '984807422721', 'image_picker90490953161931933022.jpg', '', 'O', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-09 13:00:23.000000', '2023-01-09 17:30:23.847281'),
(16, 'BIL-P_06', 'Ash_01', 'BILAL', 'SALIM', 'Ansari', '8286012383', '', 'saqib..softdigit@gmail.com', 'male', '15-02-1998', '21', '10', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400089', 'Developer', '', '', 'Aadhar Card', '123456789', 'image_picker90490953161931933023.jpg', 'image_picker90490953161931933022.jpg', 'A+', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-18 06:57:33.000000', '2023-01-18 11:27:33.389074'),
(17, 'BIL-P_07', 'Ash_01', 'BILAL', 'SALIM', 'Ansari', '8286012383', '', 'saqib..softdigit@gmail.com', 'male', '15-02-1998', '21', '10', '', 'Hindi', 'VIP', 'Test', 'Maharashtra', 'Mumbai', '400089', 'Developer', '', '', 'Aadhar Card', '123456789', 'image_picker90490953161931933025.jpg', 'image_picker90490953161931933024.jpg', 'A+', 'Unmarried', 'No', 'Brother', 'Test', '123456789', '2023-01-18 07:34:57.000000', '2023-01-18 12:04:57.270732');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `id` int(22) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `staff_id` varchar(55) NOT NULL,
  `C_id` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `quantity` varchar(55) NOT NULL,
  `frequency` varchar(55) NOT NULL,
  `duration` varchar(55) NOT NULL,
  `duration_unit` varchar(55) NOT NULL,
  `taper_id` varchar(55) NOT NULL,
  `instruction_id` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `pat_id`, `staff_id`, `C_id`, `name`, `type`, `quantity`, `frequency`, `duration`, `duration_unit`, `taper_id`, `instruction_id`, `created_at`, `updated_at`) VALUES
(1, 'BIL-P_01', '', 'Case_2022-2023_01', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2023-01-17 12:06:17', '2023-01-20 10:32:28'),
(2, 'BIL-P_01', '', 'Case_2022-2023_02', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2023-01-17 12:06:17', '2023-01-20 10:33:16'),
(3, 'BIL-P_01', '', 'Case_2022-2023_03', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2023-01-17 12:06:17', '2023-01-20 10:32:53'),
(6, 'BIL-P_01', 'Maa-Maj-A_01', 'Case_2022-2023_01', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', 'Test', '2023-01-18 12:59:40', '2023-01-18 11:59:40');

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
(1, 'Maa-S_01', '', '', 'Maaz', 'maazoly1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 1, 1, '2023-01-03 12:30:44', '2023-01-18 06:49:23'),
(2, 'Maa-Maj-A_01', 'Maa-S_01', '', 'Majid Ansari', 'majid@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 2, 1, '2023-01-04 10:08:14', '2023-01-18 06:30:27'),
(4, 'Maj-Zai-D_01', 'Maa-Maj-A_01', 'Ash_01', 'Zaid Ansari', 'shaikhmohdzaid5@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 3, 0, '2023-01-04 10:19:10', '2023-01-04 10:56:54'),
(7, 'Maj-Noo-C_01', 'Maa-Maj-A_01', 'Ash_01', 'Noor Alam', 'nooralam@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'male', '2001-10-02', 21, 'chdcfcgsdcghh', 2147483647, '', '15', 'Backend', '', '', '0000-00-00', 4, 0, '2023-01-04 10:56:44', '2023-01-04 10:56:44'),
(8, 'Bil-S_02', '', '', 'Bilal', 'bilal.softdigit@gmail.com', 'e51550191f55e5b2ad7e0469ab365b58fe33a52e', 'male', '2001-03-27', 21, 'TEST', 2147483647, '', 'Graduate', 'Backend-Dev', '', '', '0000-00-00', 1, 0, '2023-01-11 06:55:28', '2023-01-11 07:11:56'),
(16, 'Bil-S_03', '', '', 'BilalTEST', 'bilal.softdigit@gmail.com', '5cccd787d78d3a982524a209d8c1e4ab7e26cd2d', 'male', '2001-03-27', 21, 'chdcfcgsdcghh', 2147483647, '', 'Graduate', 'Backend', '', '', '0000-00-00', 1, 0, '2023-01-12 10:29:23', '2023-01-12 10:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `taper`
--

CREATE TABLE `taper` (
  `id` int(11) NOT NULL,
  `prescription_id` bigint(15) NOT NULL,
  `medicine_name` varchar(55) NOT NULL,
  `no_of_days` varchar(55) NOT NULL,
  `start_date` varchar(55) NOT NULL,
  `start_time` varchar(55) NOT NULL,
  `end_time` varchar(55) NOT NULL,
  `frequency` varchar(55) NOT NULL,
  `frequency_unit` varchar(55) NOT NULL,
  `interval` varchar(55) NOT NULL,
  `interval_unit` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taper`
--

INSERT INTO `taper` (`id`, `prescription_id`, `medicine_name`, `no_of_days`, `start_date`, `start_time`, `end_time`, `frequency`, `frequency_unit`, `interval`, `interval_unit`, `created_at`, `updated_at`) VALUES
(1, 6, 'Paracetamol', '10', '19-01-23', '6:00 AM', '', '2', 'days', '2 ', 'hours', '2023-01-19 08:02:01', '2023-01-19 09:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `telemedicine`
--

CREATE TABLE `telemedicine` (
  `id` int(10) NOT NULL,
  `tele_id` varchar(55) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `doc_id` varchar(55) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` longtext NOT NULL,
  `status` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `telemedicine`
--

INSERT INTO `telemedicine` (`id`, `tele_id`, `pat_id`, `doc_id`, `start_time`, `end_time`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tele2022_01', 'BIL-P_01', 'Maj-Zai-D_01', '01:04:26', '17:36:56', '16 Hours 32 Minutes', 'incoming', '2023-01-06 10:22:04', '0000-00-00 00:00:00'),
(2, 'Tele2022_02', 'BIL-P_01', 'Maj-Zai-D_01', '11:04:26', '17:36:56', '6 Hours 32 Minutes', 'incoming', '2023-01-06 10:22:19', '0000-00-00 00:00:00'),
(3, 'Tele2022_03', 'BIL-P_01', 'Maj-Zai-D_01', '11:04:26', '17:36:56', '6 Hours 32 Minutes', 'incoming', '2023-01-06 11:45:50', '0000-00-00 00:00:00'),
(4, 'Tele2022_04', 'TES-P_05', 'Maj-Zai-D_01', '11:04:26', '17:36:56', '6 Hours 32 Minutes', 'incoming', '2023-01-06 12:05:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test` varchar(128) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test`, `status`) VALUES
(1, 'Blood Hemoglobin', 'Basic'),
(2, 'Temperature', 'Basic'),
(3, 'Blood Glucose', 'Basic'),
(4, 'Blood Pressure', 'Basic'),
(5, 'Pulse Oximeter', 'Basic'),
(6, 'Weight', 'Basic'),
(7, 'Height', 'Basic'),
(8, 'Ecg', 'Advance'),
(9, 'Stethoscope', 'Advance'),
(10, 'Spirometer', 'Advance'),
(11, 'Otoscope', 'Advance'),
(12, 'Intraoralcam', 'Advance'),
(13, 'Dermoscope', 'Advance'),
(14, 'Tonometer', 'Eye'),
(15, 'Opthalmoscope', 'Eye'),
(16, 'Refractometer', 'Eye'),
(17, 'Ovulation', 'Rapid'),
(18, 'Maleria AG', 'Rapid'),
(19, 'Troponin', 'Rapid'),
(20, 'Hepatitis C', 'Rapid'),
(21, 'Pregnancy', 'Rapid'),
(22, 'HIV Triline', 'Rapid'),
(23, 'Dengue', 'Rapid'),
(24, 'HIV I II', 'Rapid'),
(25, 'Hepatitis B', 'Rapid'),
(26, 'Maleria AB', 'Rapid'),
(27, 'Syphilis', 'Rapid');

-- --------------------------------------------------------

--
-- Table structure for table `tests_master`
--

CREATE TABLE `tests_master` (
  `id` int(11) NOT NULL,
  `test_id` varchar(55) NOT NULL,
  `master_id` varchar(55) NOT NULL,
  `test_master_name` varchar(110) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests_master`
--

INSERT INTO `tests_master` (`id`, `test_id`, `master_id`, `test_master_name`, `created_at`, `updated_at`) VALUES
(1, '1', 'M_01', 'Test1', '2023-01-16 12:22:22', '2023-01-17 05:48:28'),
(2, '1', 'M_01', 'Test1', '2023-01-16 12:22:26', '2023-01-17 05:48:33'),
(3, '2', 'M_01', 'Test1', '2023-01-16 12:22:31', '2023-01-17 05:48:40'),
(4, '3', 'M_04', 'test', '2023-01-16 12:22:34', '2023-01-16 11:22:34'),
(5, '3', 'M_04', 'test', '2023-01-16 12:24:34', '2023-01-16 12:28:51'),
(6, '5', 'M_02', 'Test2', '2023-01-17 06:48:43', '2023-01-17 05:49:57'),
(7, '9', 'M_03', 'Test2', '2023-01-17 06:48:43', '2023-01-17 05:49:54'),
(8, '55', 'M_02', 'Test2', '2023-01-17 06:50:05', '2023-01-17 06:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `test_cases`
--

CREATE TABLE `test_cases` (
  `id` bigint(15) NOT NULL,
  `C_id` varchar(64) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `problem` varchar(128) NOT NULL,
  `description` varchar(256) NOT NULL,
  `test_id` varchar(64) NOT NULL,
  `reading` varchar(64) NOT NULL,
  `doctor_id` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_cases`
--

INSERT INTO `test_cases` (`id`, `C_id`, `pat_id`, `problem`, `description`, `test_id`, `reading`, `doctor_id`, `status`) VALUES
(4, 'Case_2022-2023_04', 'BIL-P_06', 'Fever', 'This is a test', '1', '100 F', 'Maj-Zai-D_01', 'Completed'),
(5, 'Case_2022-2023_05', 'BIL-P_06', 'Fever', 'This is a test', '1', '100 F', 'Maj-Zai-D_01', 'Completed'),
(6, 'Case_2022-2023_06', 'BIL-P_06', 'Fever', 'This is a test', '1', '100 F', 'Maj-Zai-D_01', 'Completed'),
(7, 'Case_2022-2023_08', '', 'Fever', 'This is a test', '1', '100 F', 'Maj-Zai-D_01', 'Completed');

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
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
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
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
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
-- Indexes for table `taper`
--
ALTER TABLE `taper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telemedicine`
--
ALTER TABLE `telemedicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests_master`
--
ALTER TABLE `tests_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_cases`
--
ALTER TABLE `test_cases`
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
-- AUTO_INCREMENT for table `history_anthropometry`
--
ALTER TABLE `history_anthropometry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_chief_complaints`
--
ALTER TABLE `history_chief_complaints`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_contact_allergies`
--
ALTER TABLE `history_contact_allergies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_drug_allergies`
--
ALTER TABLE `history_drug_allergies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_food_allergies`
--
ALTER TABLE `history_food_allergies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_systemic_history`
--
ALTER TABLE `history_systemic_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_visit`
--
ALTER TABLE `history_visit`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_vital_signs`
--
ALTER TABLE `history_vital_signs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `id` int(22) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `taper`
--
ALTER TABLE `taper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `telemedicine`
--
ALTER TABLE `telemedicine`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tests_master`
--
ALTER TABLE `tests_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `test_cases`
--
ALTER TABLE `test_cases`
  MODIFY `id` bigint(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
