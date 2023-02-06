-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2023 at 08:44 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `u848800466_ashu`
--

CREATE DATABASE IF NOT EXISTS `u848800466_ashu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `u848800466_ashu`;

-- --------------------------------------------------------
--
-- Table structure for table `admin_org`
--
CREATE TABLE `admin_org` (
  `id` int(10) NOT NULL,
  `admin_id` varchar(56) CHARACTER SET utf8 NOT NULL,
  `org_id` varchar(56) CHARACTER SET utf8 NOT NULL,
  `status` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `admin_org`
--
INSERT INTO
  `admin_org` (`id`, `admin_id`, `org_id`, `status`)
VALUES
  (1, 'Maa-Maj-A_01', 'Ash_01', 1);

-- --------------------------------------------------------
--
-- Table structure for table `advice`
--
CREATE TABLE `advice` (
  `id` int(22) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `staff_id` varchar(55) NOT NULL,
  `C_id` varchar(55) NOT NULL,
  `advice` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `advice`
--
INSERT INTO
  `advice` (
    `id`,
    `pat_id`,
    `staff_id`,
    `C_id`,
    `advice`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'BIL-P_01',
    '',
    'Case_2022-2023_01',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 11:06:17'
  ),
  (
    2,
    'BIL-P_01',
    '',
    'Case_2022-2023_02',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  ),
  (
    3,
    'BIL-P_01',
    '',
    'Case_2022-2023_02',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  ),
  (
    4,
    'BIL-P_01',
    '',
    'Case_2022-2023_03',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

--
-- Dumping data for table `api_keys`
--
INSERT INTO
  `api_keys` (
    `id`,
    `user_id`,
    `my_key`,
    `level`,
    `ignore_limits`,
    `is_private_key`,
    `ip_addresses`,
    `date_created`
  )
VALUES
  (1, 0, 'taibah123456', 0, 0, 0, NULL, 0);

-- --------------------------------------------------------
--
-- Table structure for table `appointments`
--
CREATE TABLE `appointments` (
  `id` int(55) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `C_id` varchar(55) NOT NULL,
  `staff_id` varchar(55) NOT NULL,
  `appointment_date` varchar(55) NOT NULL,
  `appointment_time` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `appointments`
--
INSERT INTO
  `appointments` (
    `id`,
    `pat_id`,
    `C_id`,
    `staff_id`,
    `appointment_date`,
    `appointment_time`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'BIL-P_01',
    'Case_2022-2023_01',
    'Maa-Maj-A_01',
    '31/01/23',
    '01:00 AM',
    '2023-01-31 11:38:06',
    '2023-01-31 10:38:06'
  ),
  (
    2,
    'BIL-P_01',
    'Case_2022-2023_01',
    'Maa-Maj-A_01',
    '31/01/23',
    '01:00 AM',
    '2023-01-31 11:38:27',
    '2023-01-31 10:46:49'
  ),
  (
    3,
    'BIL-P_01',
    'Case_2022-2023_01',
    'Maa-Maj-A_01',
    '31/01/23',
    '01:00 AM',
    '2023-01-31 11:38:39',
    '2023-01-31 10:38:39'
  ),
  (
    5,
    'BIL-P_06',
    'Case_2022-2023_06',
    'Maa-Maj-A_01',
    '31/01/23',
    '01:00 AM',
    '2023-01-31 11:57:28',
    '2023-01-31 10:57:28'
  ),
  (
    6,
    'BIL-P_06',
    'Case_2022-2023_06',
    'Maa-Maj-A_01',
    '31/01/23',
    '01:00 AM',
    '2023-01-31 16:43:18',
    '2023-01-31 11:13:18'
  );

-- --------------------------------------------------------
--
-- Table structure for table `bills`
--
CREATE TABLE `bills` (
  `id` int(55) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `C_id` varchar(55) NOT NULL,
  `tele_id` varchar(55) NOT NULL,
  `doc_id` varchar(55) NOT NULL,
  `amount` varchar(55) NOT NULL,
  `payment_method` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `bills`
--
INSERT INTO
  `bills` (
    `id`,
    `pat_id`,
    `C_id`,
    `tele_id`,
    `doc_id`,
    `amount`,
    `payment_method`,
    `status`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'BIL-P_01 ',
    'Case_2022-2023_06',
    'Tele2022_01',
    'Maj-Zai-D_01',
    '500',
    'Cash',
    '1',
    '2023-01-24 17:07:52',
    '2023-01-24 12:07:02'
  ),
  (
    2,
    'BIL-P_01 ',
    'Case_2022-2023_05',
    'Tele2022_01',
    'Maj-Zai-D_01',
    '600',
    'Online',
    '1',
    '2023-01-25 10:38:25',
    '2023-01-25 05:17:09'
  ),
  (
    3,
    'TES-P_05',
    'Case_2022-2023_07',
    'Tele2022_04',
    'Maj-Zai-D_01',
    '100',
    'Cash',
    '1',
    '2023-01-25 10:40:48',
    '2023-01-25 05:11:24'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_anthropometry`
--
INSERT INTO
  `history_anthropometry` (
    `id`,
    `C_id`,
    `height`,
    `weight`,
    `bmi`,
    `comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    0,
    0,
    0,
    'TEST',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    174,
    0,
    0,
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    174,
    0,
    0,
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    0,
    0,
    0,
    'teast',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    0,
    0,
    0,
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    0,
    0,
    0,
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    0,
    0,
    0,
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    0,
    0,
    0,
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    0,
    0,
    0,
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    0,
    0,
    0,
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    0,
    0,
    0,
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    0,
    0,
    0,
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    0,
    0,
    0,
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    0,
    0,
    0,
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    0,
    0,
    0,
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    0,
    0,
    0,
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:42'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_chief_complaints`
--
INSERT INTO
  `history_chief_complaints` (
    `id`,
    `C_id`,
    `chief_complaint_type`,
    `name`,
    `duration`,
    `duration_unit`,
    `comments1`,
    `options`,
    `comments2`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    'Not Treated Properly',
    'Bilal',
    '10',
    '',
    '',
    '',
    'No I have Done Properly',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    'Not Treated Properly',
    'Bilal',
    '10',
    '',
    '',
    '',
    'No I have Done Properly',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    '',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    '123test',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    '123test',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    '',
    '',
    '2',
    '1',
    '',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    '',
    '',
    '2',
    '1',
    '',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    '',
    '',
    '2',
    '1',
    '',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:41'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_contact_allergies`
--
INSERT INTO
  `history_contact_allergies` (
    `id`,
    `C_id`,
    `contact_allergies_type`,
    `name`,
    `duration`,
    `duration_unit`,
    `comments1`,
    `comments2`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    '',
    'Epidermis',
    '5',
    '',
    '',
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    '',
    'Epidermis',
    '5',
    '',
    '',
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    'test',
    'test',
    'test',
    'tesst',
    'test',
    'test',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    '',
    '',
    '1',
    '1',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    '',
    '',
    '3',
    '3',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    '',
    '[Betadine, Alcohol]',
    '2',
    '1',
    'test contact 10',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:42'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_drug_allergies`
--
INSERT INTO
  `history_drug_allergies` (
    `id`,
    `C_id`,
    `drug_allergies_type`,
    `name`,
    `duration`,
    `duration_unit`,
    `comments1`,
    `comments2`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Hello',
    'Biotin',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    '',
    'Biotin',
    '20',
    '',
    '',
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    '',
    'Biotin',
    '20',
    '',
    '',
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    'test',
    'etts',
    'test',
    'test',
    'test',
    'test',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    '',
    '',
    '2',
    '3',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    '',
    '',
    '2',
    '3',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    '',
    '',
    '3',
    '2',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    '',
    '',
    '3',
    '2',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    '',
    '',
    '3',
    '3',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    '',
    '[Antimicrobial Agents, Antifun',
    '2',
    '2',
    'test drug 10',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:42'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_food_allergies`
--
INSERT INTO
  `history_food_allergies` (
    `id`,
    `C_id`,
    `food_allergies_type`,
    `name`,
    `duration`,
    `duration_unit`,
    `comments1`,
    `comments2`,
    `other`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Hello',
    'Mushroom',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    '',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    '',
    'Mushroom',
    '12',
    '',
    '',
    '',
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    '',
    'Mushroom',
    '12',
    '',
    '',
    '',
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    'test',
    'ttestasdas',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    '',
    '[All Seafood, Corn, Milk Proti',
    '3',
    '4',
    'food test10',
    '',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:42'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_systemic_history`
--
CREATE TABLE `history_systemic_history` (
  `id` int(10) NOT NULL,
  `C_id` varchar(65) NOT NULL,
  `systemic_history_type` varchar(30) NOT NULL,
  `name` varchar(64) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `comments1` varchar(100) NOT NULL,
  `comments2` varchar(100) NOT NULL,
  `family_history` varchar(30) NOT NULL,
  `medical_history` varchar(30) NOT NULL,
  `special_status` varchar(30) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_systemic_history`
--
INSERT INTO
  `history_systemic_history` (
    `id`,
    `C_id`,
    `systemic_history_type`,
    `name`,
    `duration`,
    `duration_unit`,
    `comments1`,
    `comments2`,
    `family_history`,
    `medical_history`,
    `special_status`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    '',
    'Lungs',
    '15',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    '',
    'Lungs',
    '15',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    'test',
    'test',
    'etets',
    'test',
    'test',
    'test',
    'test',
    'ests',
    'test',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    '',
    '',
    '1',
    '2',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    '',
    '',
    '1',
    '2',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    '',
    '',
    '3',
    '4',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    '',
    '',
    '2',
    '2',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    '',
    '[Hypertension, Diabetes, Alcoh',
    '1',
    '3',
    '',
    '',
    '',
    '',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:42'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_visit`
--
INSERT INTO
  `history_visit` (
    `id`,
    `C_id`,
    `org_id`,
    `pat_id`,
    `visit_type`,
    `comments`,
    `created_by`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Ash_01',
    'BIL-P_01 ',
    'Fever',
    'Cough and Cold',
    '',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    'Ash_01',
    'BIL-P_01',
    'Cough',
    'Cough and Cold',
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    'Ash_01',
    'BIL-P_02',
    'Cough',
    'Cough and Cold',
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    6,
    'Case_2022-2023_05',
    'Ash_01',
    'TES-P_05',
    'Test123',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    'Ash_01',
    'TES-P_05',
    'test12',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    'Ash_01',
    'vs-P_021',
    '',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    'Ash_01',
    'abc-P_022',
    '',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    'Ash_01',
    'ati-P_023',
    '',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    'Ash_01',
    'hel-P_024',
    '',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    'Ash_01',
    'qwe-P_025',
    '',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    'Ash_01',
    'tes-P_026',
    '',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    'Ash_01',
    'tes-P_010',
    '',
    '',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:41'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_vital_signs`
--
INSERT INTO
  `history_vital_signs` (
    `id`,
    `C_id`,
    `temperature`,
    `pulse`,
    `blood_pressure`,
    `rr`,
    `spo2`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    'Hello',
    '2023-01-07 08:07:22',
    '2023-01-07 12:37:22'
  ),
  (
    3,
    'Case_2022-2023_02',
    '',
    '',
    '70',
    '',
    '',
    '2023-01-09 07:51:32',
    '2023-01-09 12:21:32'
  ),
  (
    4,
    'Case_2022-2023_03',
    '',
    '',
    '70',
    '',
    '',
    '2023-01-09 08:01:25',
    '2023-01-09 12:31:25'
  ),
  (
    5,
    'Case_2022-2023_04',
    'tets',
    'asdas',
    'test',
    'tasda',
    'teast',
    '2023-01-09 10:27:50',
    '2023-01-09 14:57:50'
  ),
  (
    6,
    'Case_2022-2023_05',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:14:58',
    '2023-01-10 06:14:58'
  ),
  (
    7,
    'Case_2022-2023_06',
    '',
    '',
    '',
    '',
    '',
    '2023-01-10 06:16:05',
    '2023-01-10 06:16:05'
  ),
  (
    8,
    'Case_2022-2023_07',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 16:50:32',
    '2023-01-27 16:50:32'
  ),
  (
    9,
    'Case_2022-2023_08',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 17:01:37',
    '2023-01-27 17:01:37'
  ),
  (
    10,
    'Case_2022-2023_09',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 17:05:07',
    '2023-01-27 17:05:07'
  ),
  (
    11,
    'Case_2022-2023_010',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 17:49:56',
    '2023-01-27 17:49:56'
  ),
  (
    12,
    'Case_2022-2023_011',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 18:19:34',
    '2023-01-27 18:19:34'
  ),
  (
    13,
    'Case_2022-2023_012',
    '',
    '',
    '',
    '',
    '',
    '2023-01-27 18:37:59',
    '2023-01-27 18:37:59'
  ),
  (
    14,
    'Case_2022-2023_013',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:30',
    '2023-01-28 14:47:30'
  ),
  (
    15,
    'Case_2022-2023_014',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:47:44',
    '2023-01-28 14:47:44'
  ),
  (
    16,
    'Case_2022-2023_015',
    '',
    '',
    '',
    '',
    '',
    '2023-01-28 14:48:22',
    '2023-01-28 14:48:22'
  ),
  (
    17,
    'Case_2022-2023_016',
    '',
    '',
    '',
    '',
    '',
    '2023-02-02 18:31:41',
    '2023-02-02 18:31:42'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `instructions`
--
INSERT INTO
  `instructions` (
    `id`,
    `prescription_id`,
    `instruction`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    '1',
    'test',
    '2023-01-19 08:02:01',
    '2023-01-20 11:20:09'
  ),
  (
    4,
    '4',
    'eat , lift , sleep . repeat',
    '2023-01-19 08:02:01',
    '2023-01-20 12:26:58'
  ),
  (
    5,
    '3',
    'Test',
    '2023-01-20 12:23:16',
    '2023-01-20 12:23:16'
  );

-- --------------------------------------------------------
--
-- Table structure for table `labtest`
--
CREATE TABLE `labtest` (
  `id` int(22) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `staff_id` varchar(55) NOT NULL,
  `C_id` varchar(55) NOT NULL,
  `test` varchar(55) NOT NULL,
  `description` varchar(256) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `labtest`
--
INSERT INTO
  `labtest` (
    `id`,
    `pat_id`,
    `staff_id`,
    `C_id`,
    `test`,
    `description`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'BIL-P_01',
    '',
    'Case_2022-2023_01',
    'Test',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 11:06:17'
  ),
  (
    2,
    'BIL-P_01',
    '',
    'Case_2022-2023_02',
    'Test',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  ),
  (
    3,
    'BIL-P_01',
    '',
    'Case_2022-2023_02',
    'Test',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  ),
  (
    4,
    'BIL-P_01',
    '',
    'Case_2022-2023_03',
    'Test',
    'Test',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `organization`
--
INSERT INTO
  `organization` (
    `id`,
    `org_id`,
    `org_logo`,
    `org_name`,
    `org_country`,
    `org_state`,
    `org_district`,
    `org_city`,
    `org_pincode`,
    `org_address`,
    `org_email`,
    `org_No`,
    `org_addedby`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Ash_01',
    '',
    'Ashu',
    'India',
    'Maharashtra',
    'Mumbai',
    '400010',
    '',
    'madanpura Nagpada 2 taki',
    'nooralam@gmail.com',
    '8898971045',
    'Maa-S_01',
    '2023-01-04 11:50:24',
    '2023-01-04 16:20:24'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Dumping data for table `patients`
--
INSERT INTO
  `patients` (
    `id`,
    `pat_id`,
    `org_id`,
    `first_name`,
    `middle_name`,
    `last_name`,
    `mobile_no`,
    `secondarynumber`,
    `email`,
    `gender`,
    `DOB`,
    `years`,
    `months`,
    `language`,
    `patienttype`,
    `address`,
    `state`,
    `city`,
    `pincode`,
    `occupation`,
    `employeeid`,
    `medicalrecordno`,
    `governmentid_type`,
    `governmentidno`,
    `img`,
    `blood_grp`,
    `maritail_status`,
    `disabled`,
    `emg_relation`,
    `emg_name`,
    `emg_no`,
    `created_at`,
    `updated_at`
  )
VALUES
  (

    2,
    'BIL-P_02',
    'Ash_01',
    'TESTname1',
    'TESTmidname1',
    'TESTsurname1',
    '+918898050464',
    '',
    'bilal.softdigit@gmail.com',
    'male',
    '27-03-2001',
    '',
    '',
    '',
    'Hindi',
    'VIP',
    'Test',
    'Maharashtra',
    'Mumbai',
    '400072',
    'Developer',
    '',
    '',
    'Aadhar Card',
    '984807422721',
    'image_picker90490953161931933024.jpg',
    '',
    'O',
    'Yes',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-01-05 10:50:47.000000',
    '2023-01-05 15:20:47.820945'
  ),
  (
    3,
    'BIL-P_03',
    'Ash_01',
    'TESTname2',
    'TESTmidname2',
    'TESTsurnmae2',
    '+918286012383',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    'Yes',
    '',
    '',
    '',
    '',
    '2023-01-05 10:59:02.000000',
    '2023-01-05 15:29:02.381903'
  ),
  (
    8,
    'Saq-P_04',
    'Ash_01',
    'TESTname3',
    'TESTmidname3',
    'TESTsurname3',
    '+918286012383',
    '',
    'saqib..softdigit@gmail.com',
    'male',
    '15-02-1998',
    '',
    '',
    '',
    'Hindi',
    'VIP',
    'Test',
    'Maharashtra',
    'Mumbai',
    '400089',
    'Developer',
    '',
    '',
    'Aadhar Card',
    '123456789',
    '',
    '',
    'A+',
    'Unmarried',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-01-10 07:08:20.000000',
    '2023-01-10 07:08:20.598868'
  ),
  (
    9,
    'BIL-P_01',
    'Ash_01',
    'TESTname4',
    'TESTmidname4',
    'TESTsurname4',
    '+918898050464',
    '',
    'bilal.softdigit@gmail.com',
    'male',
    '27-03-2001',
    '',
    '',
    '',
    'Hindi',
    'VIP',
    'Test',
    'Maharashtra',
    'Mumbai',
    '400072',
    'Developer',
    '',
    '',
    'Aadhar Card',
    '984807422721',
    'image_picker90490953161931933024.jpg',
    '',
    'O',
    'Yes',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-01-05 10:50:47.000000',
    '2023-01-05 15:20:47.820945'
  ),
  (
    11,
    'BIL-P_03',
    'Ash_01',
    'TESTname5',
    'TESTmidname5',
    'TESTsurname5',
    '+918286012383',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    '',
    'Yes',
    '',
    '',
    '',
    '',
    '2023-01-05 10:59:02.000000',
    '2023-01-05 15:29:02.381903'
  ),
  (
    13,
    'TES-P_05',
    'INC_02',
    'TESTname6',
    'TESTmidname6',
    'TESTsurname5',
    '+919870029314',
    '',
    'bilal.softdigit@gmail.com',
    'male',
    '27-03-2001',
    '',
    '',
    '',
    'Hindi',
    'VIP',
    'Test',
    'Maharashtra',
    'Mumbai',
    '400072',
    'Developer',
    '',
    '',
    'Aadhar Card',
    '984807422721',
    'image_picker90490953161931933022.jpg',
    '',
    'O',
    'Unmarried',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-01-09 13:00:23.000000',
    '2023-01-09 17:30:23.847281'
  ),
  (
    14,
    'BIL-P_06',
    'Ash_01',
    'TESTname7',
    'TESTmidname7',
    'TESTsurname6',
    '8286012383',
    '',
    'saqib..softdigit@gmail.com',
    'male',
    '15-02-1998',
    '21',
    '10',
    '',
    'Hindi',
    'VIP',
    'Test',
    'Maharashtra',
    'Mumbai',
    '400089',
    'Developer',
    '',
    '',
    'Aadhar Card',
    '123456789',
    'image_picker90490953161931933023.jpg',
    'image_picker90490953161931933022.jpg',
    'A+',
    'Unmarried',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-01-18 06:57:33.000000',
    '2023-01-18 11:27:33.389074'
  ),
  (
    15,
    'BIL-P_07',
    'Ash_01',
    'TESTname8',
    'TESTmidname8',
    'TESTsurname7',
    '8286012383',
    '',
    'saqib..softdigit@gmail.com',
    'male',
    '15-02-1998',
    '21',
    '10',
    '',
    'Hindi',
    'VIP',
    'Test',
    'Maharashtra',
    'Mumbai',
    '400089',
    'Developer',
    '',
    '',
    'Aadhar Card',
    '123456789',
    'image_picker90490953161931933025.jpg',
    'image_picker90490953161931933024.jpg',
    'A+',
    'Unmarried',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-01-18 07:34:57.000000',
    '2023-01-18 12:04:57.270732'
  ),
  (
    17,
    ' Zi-P_09',
    'Ash_01',
    'TESTname9',
    'TESTmidname9',
    'TESTsurname9',
    '7700066780',
    '7700066780',
    'ZishanSorathiya111@gmail.com',
    'male',
    '02-01-2023',
    '',
    '',
    '',
    'English',
    'Option A',
    'Adcon iris flat no 202, Gaothan Lane 1 ,Near panneri showroom',
    'Maharashtra',
    'Mumbai',
    '400058',
    'Engineer',
    '123456789',
    '1234',
    'Adhaar Card',
    '1111222233334444',
    '',
    '',
    'O+',
    'N',
    '',
    'Mother',
    'abcd',
    '123456789',
    '2023-01-26 11:47:28.000000',
    '2023-01-26 11:47:28.332292'
  ),
  (
    35,
    'tes-P_010',
    'Ash_01',
    'test10',
    'testmiddlename10',
    'testsurname10',
    '1234567890',
    '12345678955',
    'test10@email.com',
    'male',
    '16-02-2017',
    '',
    '',
    '',
    'Hindi',
    'Option A',
    'testaddr1-10 testaddr2-10',
    'Gujarat',
    'Mumbai',
    '400058',
    'Business Man',
    '',
    'abc123',
    'Adhaar Card',
    '1234567896',
    '',
    '',
    'O+',
    'S',
    'Y',
    'Mother',
    'test10 mother',
    '123456789',
    '2023-02-02 18:31:41.000000',
    '2023-02-02 18:31:41.545943'
  );

-- --------------------------------------------------------
--
-- Table structure for table `prescription`
--
CREATE TABLE `prescription` (
  `id` int(22) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `staff_id` varchar(55) NOT NULL,
  `C_id` varchar(55) NOT NULL,
  `medicine_name` varchar(55) NOT NULL,
  `type` varchar(55) NOT NULL,
  `quantity` varchar(55) NOT NULL,
  `frequency` varchar(55) NOT NULL,
  `duration` varchar(55) NOT NULL,
  `duration_unit` varchar(55) NOT NULL,
  `instruction` varchar(256) NOT NULL,
  `taper` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `prescription`
--
INSERT INTO
  `prescription` (
    `id`,
    `pat_id`,
    `staff_id`,
    `C_id`,
    `medicine_name`,
    `type`,
    `quantity`,
    `frequency`,
    `duration`,
    `duration_unit`,
    `instruction`,
    `taper`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'BIL-P_01',
    '',
    'Case_2022-2023_01',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    '',
    '2023-01-17 12:06:17',
    '2023-01-17 11:06:17'
  ),
  (
    2,
    'BIL-P_01',
    '',
    'Case_2022-2023_02',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    '',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  ),
  (
    3,
    'BIL-P_01',
    '',
    'Case_2022-2023_02',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    '',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  ),
  (
    4,
    'BIL-P_01',
    '',
    'Case_2022-2023_03',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    'Test',
    '',
    '2023-01-17 12:06:17',
    '2023-01-17 05:36:17'
  );

-- --------------------------------------------------------
--
-- Table structure for table `ratings`
--
CREATE TABLE `ratings` (
  `id` bigint(15) NOT NULL,
  `doc_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pat_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Dumping data for table `ratings`
--
INSERT INTO
  `ratings` (
    `id`,
    `doc_id`,
    `pat_id`,
    `rating`,
    `created_at`,
    `update_at`
  )
VALUES
  (
    1,
    'Maj-Zai-D_01',
    'BIL-P_02',
    '5',
    '2023-01-31 11:49:23',
    '2023-02-01 09:35:53'
  ),
  (
    2,
    'Maj-Zai-D_01',
    'BIL-P_01',
    '4',
    '2023-02-01 09:36:40',
    '2023-02-01 09:37:00'
  );

-- --------------------------------------------------------
--
-- Table structure for table `role`
--
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(65) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Dumping data for table `role`
--
INSERT INTO
  `role` (`id`, `role`, `created_at`, `updated_at`)
VALUES
  (
    1,
    'Super Admin',
    '2023-01-03 11:15:59',
    '2023-01-03 11:15:59'
  ),
  (
    2,
    'Admin',
    '2023-01-03 11:15:59',
    '2023-01-03 11:15:59'
  ),
  (
    3,
    'Doctor',
    '2023-01-03 11:15:59',
    '2023-01-03 11:15:59'
  ),
  (
    4,
    'Clinic Operator',
    '2023-01-03 11:15:59',
    '2023-01-03 12:19:48'
  );

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
  `rating` varchar(11) NOT NULL,
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
  `status` enum('Pending', 'Approved') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = MyISAM DEFAULT CHARSET = utf8;

--
-- Dumping data for table `staff`
--
INSERT INTO
  `staff` (
    `id`,
    `u_id`,
    `admin`,
    `org_id`,
    `name`,
    `email`,
    `password`,
    `rating`,
    `gender`,
    `d_o_b`,
    `age`,
    `address`,
    `mobile_no`,
    `img`,
    `qualification`,
    `speciality`,
    `ID_proof`,
    `ID_img`,
    `join_date`,
    `role_id`,
    `status`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Maa-S_01',
    '',
    '',
    'Maaz',
    'maazoly1@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '0',
    'male',
    '2001-10-02',
    21,
    'chdcfcgsdcghh',
    2147483647,
    '',
    '15',
    'Backend',
    '',
    '',
    '0000-00-00',
    1,
    'Approved',
    '2023-01-03 12:30:44',
    '2023-01-20 06:38:40'
  ),
  (
    2,
    'Maa-Maj-A_01',
    'Maa-S_01',
    '',
    'Majid Ansari',
    'majid@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '0',
    'male',
    '2001-10-02',
    21,
    'chdcfcgsdcghh',
    2147483647,
    '',
    '15',
    'Backend',
    '',
    '',
    '0000-00-00',
    2,
    'Approved',
    '2023-01-04 10:08:14',
    '2023-01-20 06:38:44'
  ),
  (
    4,
    'Maj-Zai-D_01',
    'Maa-Maj-A_01',
    'Ash_01',
    'Zaid Ansari',
    'shaikhmohdzaid5@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '4.5',
    'male',
    '2001-10-02',
    21,
    'chdcfcgsdcghh',
    2147483647,
    '',
    '15',
    'Backend',
    '',
    '',
    '0000-00-00',
    3,
    'Approved',
    '2023-01-04 10:19:10',
    '2023-02-01 09:37:00'
  ),
  (
    7,
    'Maj-Noo-C_01',
    'Maa-Maj-A_01',
    'Ash_01',
    'Noor ',
    'noor@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '0',
    'male',
    '2001-10-02',
    21,
    'chdcfcgsdcghh',
    2147483647,
    '',
    '15',
    'Backend',
    '',
    '',
    '0000-00-00',
    4,
    'Approved',
    '2023-01-04 10:56:44',
    '2023-02-02 06:35:13'
  ),
  (
    20,
    'TES-S_02',
    '',
    '',
    'TEST',
    'bilal.softdigit@gmail.com',
    '5cccd787d78d3a982524a209d8c1e4ab7e26cd2d',
    '0',
    'male',
    '2001-03-27',
    21,
    'chdcfcgsdcghh',
    2147483647,
    '',
    'Graduate',
    'Backend',
    '',
    '',
    '0000-00-00',
    1,
    'Approved',
    '2023-01-12 10:56:44',
    '2023-01-20 06:38:55'
  ),
  (
    21,
    'Noo-TES-A_02',
    'Maa-S_01',
    '',
    'Noor Alam',
    'nooralam@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '',
    'male',
    '1999-10-02',
    23,
    'chdcfcgsdcghh',
    2147483647,
    '',
    '15',
    'Flutter',
    '',
    '',
    '0000-00-00',
    2,
    '',
    '2023-02-02 06:40:16',
    '2023-02-02 06:40:16'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `taper`
--
INSERT INTO
  `taper` (
    `id`,
    `prescription_id`,
    `medicine_name`,
    `no_of_days`,
    `start_date`,
    `start_time`,
    `end_time`,
    `frequency`,
    `frequency_unit`,
    `interval`,
    `interval_unit`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    4,
    'Paracetamol',
    '10',
    '19-01-23',
    '6:00 AM',
    '',
    '2',
    'days',
    '2 ',
    'hours',
    '2023-01-19 08:02:01',
    '2023-01-20 12:19:57'
  ),
  (
    4,
    1,
    'Paracetamol',
    '9',
    '19-01-23',
    '6:00 AM',
    '',
    '2',
    'days',
    '2',
    'hours',
    '2023-01-20 12:21:18',
    '2023-01-30 11:24:38'
  );

-- --------------------------------------------------------
--
-- Table structure for table `telemedicine`
--
CREATE TABLE `telemedicine` (
  `id` int(10) NOT NULL,
  `case_id` varchar(65) NOT NULL,
  `tele_id` varchar(55) NOT NULL,
  `pat_id` varchar(55) NOT NULL,
  `doc_id` varchar(55) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration` longtext NOT NULL,
  `status` varchar(55) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `telemedicine`
--
INSERT INTO
  `telemedicine` (
    `id`,
    `case_id`,
    `tele_id`,
    `pat_id`,
    `doc_id`,
    `start_time`,
    `end_time`,
    `duration`,
    `status`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Tele2022_01',
    'BIL-P_01',
    'Maj-Zai-D_01',
    '01:04:26',
    '17:36:56',
    '16 Hours 32 Minutes',
    'incoming',
    '2023-01-06 10:22:04',
    '0000-00-00 00:00:00'
  ),
  (
    2,
    'Case_2022-2023_01',
    'Tele2022_02',
    'BIL-P_01',
    'Maj-Zai-D_01',
    '11:04:26',
    '17:36:56',
    '6 Hours 32 Minutes',
    'incoming',
    '2023-01-06 10:22:19',
    '0000-00-00 00:00:00'
  ),
  (
    3,
    'Case_2022-2023_02',
    'Tele2022_03',
    'BIL-P_01',
    'Maj-Zai-D_01',
    '11:04:26',
    '17:36:56',
    '6 Hours 32 Minutes',
    'incoming',
    '2023-01-06 11:45:50',
    '0000-00-00 00:00:00'
  ),
  (
    4,
    'Case_2022-2023_05',
    'Tele2022_04',
    'TES-P_05',
    'Maj-Zai-D_01',
    '11:04:26',
    '17:36:56',
    '6 Hours 32 Minutes',
    'incoming',
    '2023-01-06 12:05:06',
    '0000-00-00 00:00:00'
  ),
  (
    5,
    'Case_2022-2023_05',
    'Tele2022_05',
    'TES-P_05',
    'Maj-Zai-D_01',
    '11:04:26',
    '17:36:56',
    '6 Hours 32 Minutes',
    'incoming',
    '2023-01-10 06:50:35',
    '0000-00-00 00:00:00'
  ),
  (
    6,
    'Case_2022-2023_06',
    'Tele2022_06',
    'TES-P_05',
    'Maj-Zai-D_01',
    '11:04:26',
    '17:36:56',
    '6 Hours 32 Minutes',
    'incoming',
    '2023-01-10 06:51:00',
    '0000-00-00 00:00:00'
  ),
  (
    7,
    'Case_2022-2023_03',
    'Tele2022_07',
    'Saq-P_04',
    'Maj-Zai-D_01',
    '11:04:26',
    '17:36:56',
    '6 Hours 32 Minutes',
    'incoming',
    '2023-01-11 07:20:52',
    '0000-00-00 00:00:00'
  );

-- --------------------------------------------------------
--
-- Table structure for table `tests`
--
CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test` varchar(128) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Dumping data for table `tests`
--
INSERT INTO
  `tests` (`id`, `test`, `status`)
VALUES
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `tests_master`
--
INSERT INTO
  `tests_master` (
    `id`,
    `test_id`,
    `master_id`,
    `test_master_name`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    '1',
    'M_01',
    'Test1',
    '2023-01-16 12:22:22',
    '2023-01-17 05:48:28'
  ),
  (
    2,
    '1',
    'M_01',
    'Test1',
    '2023-01-16 12:22:26',
    '2023-01-17 05:48:33'
  ),
  (
    3,
    '2',
    'M_01',
    'Test1',
    '2023-01-16 12:22:31',
    '2023-01-17 05:48:40'
  ),
  (
    4,
    '3',
    'M_04',
    'test',
    '2023-01-16 12:22:34',
    '2023-01-16 11:22:34'
  ),
  (
    5,
    '3',
    'M_04',
    'test',
    '2023-01-16 12:24:34',
    '2023-01-16 12:28:51'
  ),
  (
    6,
    '5',
    'M_02',
    'Test2',
    '2023-01-17 06:48:43',
    '2023-01-17 05:49:57'
  ),
  (
    7,
    '9',
    'M_03',
    'Test2',
    '2023-01-17 06:48:43',
    '2023-01-17 05:49:54'
  ),
  (
    8,
    '55',
    'M_02',
    'Test2',
    '2023-01-17 06:50:05',
    '2023-01-17 06:03:51'
  );

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
  `title` varchar(128) NOT NULL,
  `reading` varchar(64) NOT NULL,
  `doctor_id` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Indexes for table `admin_org`
--
INSERT INTO
  `test_cases` (
    `id`,
    `C_id`,
    `pat_id`,
    `problem`,
    `description`,
    `test_id`,
    `title`,
    `reading`,
    `doctor_id`,
    `status`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    4,
    'Case_2022-2023_04',
    'BIL-P_06',
    'Fever',
    'This is a test',
    '1',
    '',
    '100 F',
    'Maj-Zai-D_01',
    'Completed',
    '',
    '2023-01-21 10:23:06'
  ),
  (
    5,
    'Case_2022-2023_05',
    'BIL-P_06',
    'Fever',
    'This is a test',
    '1',
    '',
    '100 F',
    'Maj-Zai-D_01',
    'Completed',
    '',
    '2023-01-21 10:23:06'
  ),
  (
    6,
    'Case_2022-2023_06',
    'BIL-P_06',
    'Fever',
    'This is a test',
    '1',
    '',
    '100 F',
    'Maj-Zai-D_01',
    'Completed',
    '',
    '2023-01-21 10:23:06'
  ),
  (
    7,
    'Case_2022-2023_07',
    'TES-P_05',
    'Fever',
    'This is a test',
    '1',
    '',
    '100 F',
    'Maj-Zai-D_01',
    'Completed',
    '',
    '2023-01-25 05:13:23'
  ),
  (
    8,
    'Case_2022-2023_01',
    '',
    'Fever',
    'Too much',
    '1',
    '',
    '',
    'Maj-Zai-D_01',
    'Pending',
    '',
    '2023-01-28 14:48:02'
  ),
  (
    9,
    'Case_2022-2023_06',
    '',
    'Obesity',
    'Too much',
    '6',
    'BMI',
    '40F',
    'Maj-Zai-D_01',
    'Pending',
    '',
    '2023-01-30 06:56:24'
  );

--
-- Indexes for table `api_keys`
--
--
-- Indexes for table `breaktime`
--
ALTER TABLE
  `admin_org`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `advice`
--
ALTER TABLE
  `advice`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE
  `api_keys`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE
  `appointments`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE
  `bills`
ADD
  PRIMARY KEY (`id`);
  
--
-- Indexes for table `history_anthropometry`
--
ALTER TABLE
  `history_anthropometry`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_chief_complaints`
--
ALTER TABLE
  `history_chief_complaints`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_contact_allergies`
--
ALTER TABLE
  `history_contact_allergies`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_drug_allergies`
--
ALTER TABLE
  `history_drug_allergies`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_food_allergies`
--
ALTER TABLE
  `history_food_allergies`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_systemic_history`
--
ALTER TABLE
  `history_systemic_history`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_visit`
--
ALTER TABLE
  `history_visit`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_vital_signs`
--
ALTER TABLE
  `history_vital_signs`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `instructions`
--
ALTER TABLE
  `instructions`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `labtest`
--
ALTER TABLE
  `labtest`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `organization`
--
ALTER TABLE
  `organization`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE
  `patients`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE
  `prescription`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE
  `ratings`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE
  `role`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE
  `staff`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `taper`
--
ALTER TABLE
  `taper`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `telemedicine`
--
ALTER TABLE
  `telemedicine`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE
  `tests`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `tests_master`
--
ALTER TABLE
  `tests_master`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `test_cases`
--
ALTER TABLE
  `test_cases`
ADD
  PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `admin_org`
--
ALTER TABLE
  `admin_org`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `advice`
--
ALTER TABLE
  `advice`
MODIFY
  `id` int(22) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE
  `api_keys`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE
  `appointments`
MODIFY
  `id` int(55) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE
  `bills`
MODIFY
  `id` int(55) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `history_anthropometry`
--
ALTER TABLE
  `history_anthropometry`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_chief_complaints`
--
ALTER TABLE
  `history_chief_complaints`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_contact_allergies`
--
ALTER TABLE
  `history_contact_allergies`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_drug_allergies`
--
ALTER TABLE
  `history_drug_allergies`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_food_allergies`
--

ALTER TABLE
  `history_food_allergies`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_systemic_history`
--
ALTER TABLE
  `history_systemic_history`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_visit`
--
ALTER TABLE
  `history_visit`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `history_vital_signs`
--
ALTER TABLE
  `history_vital_signs`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 18;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE
  `instructions`
MODIFY
  `id` int(55) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `labtest`
--
ALTER TABLE
  `labtest`
MODIFY
  `id` int(22) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE
  `organization`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE
  `patients`
MODIFY
  `id` int(30) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 36;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE
  `prescription`
MODIFY
  `id` int(22) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE
  `ratings`
MODIFY
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE
  `role`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE
  `staff`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 22;

--
-- AUTO_INCREMENT for table `taper`
--
ALTER TABLE
  `taper`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `telemedicine`
--
ALTER TABLE
  `telemedicine`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE
  `tests`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 28;

--
-- AUTO_INCREMENT for table `tests_master`
--
ALTER TABLE
  `tests_master`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `test_cases`
--
ALTER TABLE
  `test_cases`
MODIFY
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 10;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;