-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 12:30 PM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34
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
  ),
  (
    8,
    'BIL-P_01',
    'Case_2022-2023_01',
    'Maa-Maj-A_01',
    '',
    '',
    '2023-02-10 16:12:38',
    '2023-02-10 10:42:38'
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
-- Table structure for table `history_contact_allergies`
--
CREATE TABLE `history_contact_allergies` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `name` varchar(60) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `contact_comments` varchar(100) NOT NULL,
  `contact_allergies_comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_contact_allergies`
--
INSERT INTO
  `history_contact_allergies` (
    `id`,
    `pat_id`,
    `name`,
    `duration`,
    `duration_unit`,
    `contact_comments`,
    `contact_allergies_comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-02-11 17:53:28',
    '2023-02-11 12:23:28'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_drug_allergies`
--
CREATE TABLE `history_drug_allergies` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `name` varchar(60) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `drug_comments` varchar(100) NOT NULL,
  `drug_allergies_comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_drug_allergies`
--
INSERT INTO
  `history_drug_allergies` (
    `id`,
    `pat_id`,
    `name`,
    `duration`,
    `duration_unit`,
    `drug_comments`,
    `drug_allergies_comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-02-11 17:52:39',
    '2023-02-11 12:22:39'
  ),
  (
    2,
    'Zai-P_013',
    'Antimicrobial Agents',
    'test',
    'test',
    'test',
    'test',
    '2023-02-15 20:51:19',
    '2023-02-15 15:21:19'
  ),
  (
    3,
    'Zai-P_013',
    'Antifungal Agents',
    'test',
    'test',
    'test',
    'test',
    '2023-02-15 20:51:19',
    '2023-02-15 15:21:19'
  ),
  (
    4,
    'Zai-P_013',
    'Antiviral Agents',
    'test',
    'test',
    'test',
    'test',
    '2023-02-15 20:51:20',
    '2023-02-15 15:21:20'
  ),
  (
    5,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-02-15 20:53:25',
    '2023-02-15 15:23:25'
  ),
  (
    6,
    'Dan-P_030',
    'Antimicrobial Agents',
    '2',
    '4',
    'hello',
    '',
    '2023-02-15 22:23:19',
    '2023-02-15 16:53:19'
  ),
  (
    7,
    'Dan-P_030',
    'Antifungal Agents',
    '4',
    '2',
    'world',
    '',
    '2023-02-15 22:23:20',
    '2023-02-15 16:53:20'
  ),
  (
    8,
    'BIL-P_02',
    'Antimicrobial Agents',
    '3',
    '1',
    'q',
    '',
    '2023-02-16 10:05:59',
    '2023-02-16 04:35:59'
  ),
  (
    9,
    'BIL-P_02',
    'Antifungal Agents',
    '2',
    '3',
    'q',
    '',
    '2023-02-16 10:05:59',
    '2023-02-16 04:35:59'
  ),
  (
    10,
    'BIL-P_02',
    'Antiviral Agents',
    '3',
    '2',
    'q',
    '',
    '2023-02-16 10:05:59',
    '2023-02-16 04:35:59'
  ),
  (
    11,
    'BIL-P_02',
    'Nsaids',
    '1',
    '3',
    'q',
    '',
    '2023-02-16 10:05:59',
    '2023-02-16 04:35:59'
  ),
  (
    12,
    'BIL-P_02',
    'Eye Drops',
    '1',
    '1',
    'q',
    '',
    '2023-02-16 10:05:59',
    '2023-02-16 04:35:59'
  ),
  (
    13,
    'Maa-P_036',
    'Antimicrobial Agents',
    '1',
    '3',
    'j',
    '',
    '2023-02-16 11:56:21',
    '2023-02-16 06:26:21'
  ),
  (
    14,
    'Maa-P_036',
    'Nsaids',
    '1',
    '2',
    'j',
    '',
    '2023-02-16 11:56:22',
    '2023-02-16 06:26:22'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_food_allergies`
--
CREATE TABLE `history_food_allergies` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `name` varchar(60) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `food_comments` varchar(100) NOT NULL,
  `food_allergies_comments` varchar(100) NOT NULL,
  `other_comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_food_allergies`
--
INSERT INTO
  `history_food_allergies` (
    `id`,
    `pat_id`,
    `name`,
    `duration`,
    `duration_unit`,
    `food_comments`,
    `food_allergies_comments`,
    `other_comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-02-11 17:54:24',
    '2023-02-11 12:24:24'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_medical_history`
--
CREATE TABLE `history_medical_history` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `family_history` varchar(100) NOT NULL,
  `medical_history` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_medical_history`
--
INSERT INTO
  `history_medical_history` (
    `id`,
    `pat_id`,
    `family_history`,
    `medical_history`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'test',
    'test',
    '2023-02-11 17:51:12',
    '2023-02-11 12:21:12'
  ),
  (
    2,
    'BIL-P_02',
    'e',
    'r',
    '2023-02-15 10:15:45',
    '2023-02-15 04:45:45'
  ),
  (
    3,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 20:51:18',
    '2023-02-15 15:21:18'
  ),
  (
    4,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 21:16:37',
    '2023-02-15 15:46:37'
  ),
  (
    5,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 21:24:39',
    '2023-02-15 15:54:39'
  ),
  (
    6,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 21:43:25',
    '2023-02-15 16:13:25'
  ),
  (
    7,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 21:56:55',
    '2023-02-15 16:26:55'
  ),
  (
    8,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 22:11:51',
    '2023-02-15 16:41:51'
  ),
  (
    9,
    'BIL-P_02',
    '',
    '',
    '2023-02-15 22:23:19',
    '2023-02-15 16:53:19'
  ),
  (
    10,
    'Maa-P_036',
    '',
    '',
    '2023-02-16 11:56:21',
    '2023-02-16 06:26:21'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_opthalmic_history`
--
CREATE TABLE `history_opthalmic_history` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `name` varchar(60) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `opthalmic_comments` varchar(100) NOT NULL,
  `opthalmic_history_comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_opthalmic_history`
--
INSERT INTO
  `history_opthalmic_history` (
    `id`,
    `pat_id`,
    `name`,
    `duration`,
    `duration_unit`,
    `opthalmic_comments`,
    `opthalmic_history_comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'TEST',
    'test',
    'test',
    'test',
    'test',
    '2023-02-11 17:49:21',
    '2023-02-11 12:19:21'
  ),
  (
    2,
    'Sor-P_024',
    'TEST',
    'test',
    'test',
    'test',
    'test',
    '2023-02-13 21:04:13',
    '2023-02-13 15:34:13'
  ),
  (
    3,
    'Sor-P_024',
    'TEST1',
    'test2',
    'test3',
    'test4',
    'test4',
    '2023-02-13 21:04:34',
    '2023-02-13 15:34:34'
  ),
  (
    26,
    'BIL-P_02',
    'Glaucoma',
    '2',
    '2',
    't',
    '',
    '2023-02-14 18:07:46',
    '2023-02-14 12:37:46'
  ),
  (
    27,
    'uma-P_032',
    'Glaucoma',
    '2',
    '2',
    '1234',
    'advadda',
    '2023-02-15 21:43:25',
    '2023-02-15 16:13:25'
  ),
  (
    28,
    'Maa-P_036',
    'Glaucoma',
    '3',
    '2',
    'fg',
    'tre',
    '2023-02-16 11:56:19',
    '2023-02-16 06:26:19'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_paediatric_history`
--
CREATE TABLE `history_paediatric_history` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `nutrition_assess` varchar(30) NOT NULL,
  `nutrition_comments` varchar(100) NOT NULL,
  `immunization_asses` varchar(30) NOT NULL,
  `immunization_comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_paediatric_history`
--
INSERT INTO
  `history_paediatric_history` (
    `id`,
    `pat_id`,
    `nutrition_assess`,
    `nutrition_comments`,
    `immunization_asses`,
    `immunization_comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    '2023-02-11 17:51:57',
    '2023-02-11 12:21:57'
  ),
  (
    2,
    'BIL-P_02',
    'Well Nourished',
    'Test1',
    'Complete',
    'Test2',
    '2023-02-15 10:11:37',
    '2023-02-15 04:41:37'
  ),
  (
    3,
    'ati-P_029',
    '',
    '',
    '',
    '',
    '2023-02-15 20:51:19',
    '2023-02-15 15:21:19'
  ),
  (
    4,
    'Dan-P_030',
    '',
    '',
    '',
    '',
    '2023-02-15 21:16:37',
    '2023-02-15 15:46:37'
  ),
  (
    5,
    'Waq-P_031',
    '',
    '',
    '',
    '',
    '2023-02-15 21:24:40',
    '2023-02-15 15:54:40'
  ),
  (
    6,
    'uma-P_032',
    'Malnourished',
    '',
    '',
    'dgggg',
    '2023-02-15 21:43:26',
    '2023-02-15 16:13:26'
  ),
  (
    7,
    'Suz-P_033',
    '',
    '',
    '',
    '',
    '2023-02-15 21:56:56',
    '2023-02-15 16:26:56'
  ),
  (
    8,
    'abc-P_034',
    '',
    '',
    '',
    '',
    '2023-02-15 22:11:52',
    '2023-02-15 16:41:52'
  ),
  (
    9,
    'Abd-P_035',
    '',
    '',
    '',
    '',
    '2023-02-15 22:23:19',
    '2023-02-15 16:53:19'
  ),
  (
    10,
    'Maa-P_036',
    'Malnourished',
    '',
    '',
    'ggjj',
    '2023-02-16 11:56:21',
    '2023-02-16 06:26:21'
  );

-- --------------------------------------------------------
--
-- Table structure for table `history_systemic_history`
--
CREATE TABLE `history_systemic_history` (
  `id` int(10) NOT NULL,
  `pat_id` varchar(65) NOT NULL,
  `name` varchar(60) NOT NULL,
  `duration` varchar(30) NOT NULL,
  `duration_unit` varchar(30) NOT NULL,
  `systemic_comments` varchar(100) NOT NULL,
  `systemic_history_comments` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `history_systemic_history`
--
INSERT INTO
  `history_systemic_history` (
    `id`,
    `pat_id`,
    `name`,
    `duration`,
    `duration_unit`,
    `systemic_comments`,
    `systemic_history_comments`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-02-11 17:50:33',
    '2023-02-11 12:20:33'
  ),
  (
    2,
    'Zai-P_013',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2023-02-14 17:38:45',
    '2023-02-14 12:08:45'
  ),
  (
    5,
    'BIL-P_02',
    'Diabetes',
    '1',
    '1',
    'r',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:17',
    '2023-02-14 12:42:17'
  ),
  (
    6,
    'BIL-P_02',
    'Chewing Tobacco',
    '2',
    '1',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    7,
    'BIL-P_02',
    'Hypertension',
    '1',
    '2',
    'r',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    8,
    'BIL-P_02',
    'Alcoholism',
    '2',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    9,
    'BIL-P_02',
    'Smoking Tobacco',
    '4',
    '3',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    10,
    'BIL-P_02',
    'Cardiac Disorder',
    '1',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    11,
    'BIL-P_02',
    'Drug Abuse',
    '2',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    12,
    'BIL-P_02',
    'HIV/AIDS',
    '1',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    13,
    'BIL-P_02',
    'Hyperthyroidism',
    '4',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    14,
    'BIL-P_02',
    'Consanguinity',
    '2',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    15,
    'BIL-P_02',
    'On Aspirin Blood Thinners',
    '3',
    '3',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    16,
    'BIL-P_02',
    'Hypothyroidism',
    '3',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    17,
    'BIL-P_02',
    'CNS Disorder Stroke',
    '4',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    18,
    'BIL-P_02',
    'On Insulin',
    '3',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    19,
    'BIL-P_02',
    'Acidity',
    '4',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    20,
    'BIL-P_02',
    'Asthma',
    '4',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    21,
    'BIL-P_02',
    'Tuberculosis',
    '2',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:18',
    '2023-02-14 12:42:18'
  ),
  (
    22,
    'BIL-P_02',
    'Cancer Tumor',
    '3',
    '3',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:19',
    '2023-02-14 12:42:19'
  ),
  (
    23,
    'BIL-P_02',
    'Hepatities Cirrhosis',
    '3',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:19',
    '2023-02-14 12:42:19'
  ),
  (
    24,
    'BIL-P_02',
    'Thyroid Disorder',
    '2',
    '2',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:19',
    '2023-02-14 12:42:19'
  ),
  (
    25,
    'BIL-P_02',
    'Renal Disorder',
    '2',
    '1',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:19',
    '2023-02-14 12:42:19'
  ),
  (
    26,
    'BIL-P_02',
    'Rheumatoid Arthritis',
    '1',
    '1',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:19',
    '2023-02-14 12:42:19'
  ),
  (
    27,
    'BIL-P_02',
    'Benign Prostatic Hyperplasia (',
    '2',
    '4',
    't',
    'OpthalmicHistoryComment.text',
    '2023-02-14 18:12:19',
    '2023-02-14 12:42:19'
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
  `problem` varchar(65) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_by` varchar(55) NOT NULL,
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
    `problem`,
    `description`,
    `created_by`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_01',
    'Ash_01',
    'Zai-P_013',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-09 15:48:58',
    '2023-02-09 10:18:58'
  ),
  (
    4,
    'Case_2022-2023_03',
    'Ash_01',
    'Zai-P_013',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-15 12:45:03',
    '2023-02-15 07:15:03'
  ),
  (
    5,
    'Case_2022-2023_04',
    'Ash_01',
    'Zai-P_013',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-15 12:45:10',
    '2023-02-15 07:15:10'
  ),
  (
    6,
    'Case_2022-2023_05',
    'Ash_01',
    'Zai-P_013',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-15 12:45:13',
    '2023-02-15 07:15:13'
  ),
  (
    27,
    'Case_2022-2023_06',
    'Ash_01',
    'BIL-P_02',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-16 18:11:35',
    '2023-02-16 12:41:35'
  ),
  (
    28,
    'Case_2022-2023_07',
    'Ash_01',
    'BIL-P_02',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-16 18:11:35',
    '2023-02-16 12:41:35'
  ),
  (
    29,
    'Case_2022-2023_08',
    'Ash_01',
    'BIL-P_02',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-16 18:11:35',
    '2023-02-16 12:41:35'
  ),
  (
    30,
    'Case_2022-2023_09',
    'Ash_01',
    'BIL-P_02',
    'FevFever',
    'test',
    'Maj-Noo-C_01',
    '2023-02-16 18:11:35',
    '2023-02-16 12:41:35'
  ),
  (
    31,
    'Case_2022-2023_010',
    'Ash_01',
    'BIL-P_02',
    'abcd',
    '',
    'Maa-Maj-A_01',
    '2023-02-16 21:12:04',
    '2023-02-16 15:42:04'
  ),
  (
    32,
    'Case_2022-2023_011',
    'Ash_01',
    'BIL-P_02',
    'd',
    '',
    'Maa-Maj-A_01',
    '2023-02-17 10:31:29',
    '2023-02-17 05:01:29'
  ),
  (
    33,
    'Case_2022-2023_012',
    'Ash_01',
    'BIL-P_02',
    'Friday Test',
    '',
    'Maa-Maj-A_01',
    '2023-02-17 11:24:47',
    '2023-02-17 05:54:47'
  ),
  (
    34,
    'Case_2022-2023_013',
    'Ash_01',
    'BIL-P_02',
    'h',
    '',
    'Maj-Noo-C_01',
    '2023-02-17 14:09:23',
    '2023-02-17 08:39:23'
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
-- Table structure for table `old_reports`
--
CREATE TABLE `old_reports` (
  `id` bigint(15) NOT NULL,
  `pat_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reports` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- --------------------------------------------------------
--
-- Table structure for table `organization`
--
CREATE TABLE `organization` (
  `id` int(10) NOT NULL,
  `org_id` varchar(100) NOT NULL,
  `org_logo` varchar(65) NOT NULL,
  `org_name` varchar(50) NOT NULL,
  `org_country` varchar(50) NOT NULL,
  `org_state` varchar(40) NOT NULL,
  `org_district` varchar(30) NOT NULL,
  `org_city` varchar(30) NOT NULL,
  `org_pincode` varchar(30) NOT NULL,
  `org_address` varchar(100) NOT NULL,
  `org_email` varchar(30) NOT NULL,
  `org_No` varchar(20) NOT NULL,
  `org_addedby` varchar(10) NOT NULL,
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
  ),
  (
    2,
    'INC_02',
    '',
    'INCUBATION',
    'India',
    'Maharashtra',
    'Raigad',
    'Panvel',
    '',
    'Test',
    'test@gmial.com',
    '123456789',
    'Maa-S_01',
    '2023-01-09 12:52:22',
    '2023-01-09 17:22:22'
  );

-- --------------------------------------------------------
--
-- Table structure for table `patients`
--
CREATE TABLE `patients` (
  `id` int(30) NOT NULL,
  `pat_id` varchar(55) CHARACTER SET utf8 NOT NULL,
  `org_id` varchar(55) CHARACTER SET utf8 NOT NULL,
  `profile` varchar(128) NOT NULL,
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
    `profile`,
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
    `days`,
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
    'image.png',
    'Noor',
    '',
    'Khan TEST',
    '+918898050464',
    '',
    'bilal.softdigit@gmail.com',
    'male',
    '27-03-2001',
    '21',
    '11',
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
    'boss 1.jpg',
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
    9,
    'BIL-P_01',
    'Ash_01',
    '',
    'Saqib',
    '',
    'Ansari',
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
    13,
    'TES-P_05',
    'INC_02',
    '',
    'Bilal',
    '',
    'Shaikh',
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
    17,
    ' Zi-P_09',
    'Ash_01',
    '',
    'Zaid',
    '',
    'Shaikh',
    '+917700066780',
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
    36,
    'Maa-P_011',
    'Ash_01',
    'Screen.png',
    'Maaz',
    'Mohammad',
    'Siddique',
    '+918433581551',
    '',
    'maazoly1@gmail.com',
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
    'boss.jpeg',
    '',
    '',
    '',
    '',
    '',
    '',
    '2023-02-04 11:45:36.000000',
    '2023-02-04 06:15:36.278833'
  ),
  (
    37,
    'Saq-P_012',
    'Ash_01',
    '',
    'Saqib',
    '',
    'Ansari',
    '',
    '',
    'ansarisaqib803@gmail.com',
    'male',
    '06-02-2002',
    '',
    '',
    '',
    'English',
    'Option A',
    'Chembur ',
    'Maharashtra',
    'Mumbai',
    '400089',
    'Self Service',
    '',
    '',
    'Adhaar Card',
    '1245789512',
    'office boss.jpg',
    'A+',
    'S',
    'N',
    'Brother',
    'Ansari',
    '1234567898',
    '2023-02-06 10:57:11.000000',
    '2023-02-06 05:27:11.264893'
  ),
  (
    38,
    'Zai-P_013',
    'Ash_01',
    '',
    'Zaid',
    '',
    'Ansari',
    '+918369521271',
    '',
    'shaikhmohdzaid5@gmail.com',
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
    'boss.jpeg',
    'A+',
    'Unmarried',
    'No',
    'Brother',
    'Test',
    '123456789',
    '2023-02-09 13:58:01.000000',
    '2023-02-09 08:28:01.007046'
  ),
  (
    39,
    'Ati-P_014',
    'Ash_01',
    '',
    'Atif',
    'Sorathiya',
    'Sorathiya',
    '7789456123',
    '',
    '',
    'Male',
    '17/2/22',
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
    'Adhaar cad',
    '123456',
    'Screenshot (1)1.png',
    '',
    '',
    'no',
    '',
    '',
    '123456789',
    '2023-02-12 13:44:45.000000',
    '2023-02-12 08:14:45.292559'
  ),
  (
    49,
    'Sor-P_024',
    'Ash_01',
    '',
    'Sorathiya',
    'Mohamed',
    'Zishan',
    '7700006678',
    '1234567897',
    '20co62@aiktc.ac.in',
    'male',
    '01-02-2023',
    '',
    '',
    '',
    'Marathi',
    'Option B',
    'abcd ',
    'Gujarat',
    '123',
    '12332',
    'Self Service',
    '123456789',
    '12345678',
    'Adhaar Card',
    '123456789',
    'fda5ade2-bad6-49c0-859c-170382722e8c9145573506081926093.jpg',
    'O+',
    'S',
    'N',
    'Sister',
    'abcd',
    '12346887',
    '2023-02-13 19:57:32.000000',
    '2023-02-13 14:27:32.571898'
  ),
  (
    50,
    'Sor-P_025',
    'Ash_01',
    '',
    'Sorathiya',
    'Mohmed',
    'Atif',
    '1234567890',
    '9874561230',
    'abc@gmail.com',
    'male',
    '06-02-2023',
    '',
    '',
    '',
    'English',
    'Option A',
    'ASCD VDFBFSD',
    'Haryana',
    '120255',
    '123456',
    'Self Service',
    '',
    '123456',
    'Adhaar Card',
    '123456789',
    'c3a00484-ceab-4029-b9cd-9eaf38e8baf85853314118077501708.jpg',
    'O+',
    'S',
    'N',
    'Mother',
    'xyszsc',
    '123456789',
    '2023-02-13 20:09:54.000000',
    '2023-02-13 14:39:54.780901'
  ),
  (
    51,
    'Zee-P_026',
    'Ash_01',
    '',
    'Zeeshan',
    '',
    'Khan',
    '7894561230',
    '1234567890',
    '4dssvsv@gmail.com',
    'male',
    '06-02-2023',
    '',
    '',
    '',
    'English',
    'Option B',
    'abd ',
    'Himachal Pradesh',
    'erty',
    '123456',
    '',
    '',
    '',
    'Adhaar Card',
    '1234567',
    'f468125b-ccf6-438d-b2e7-6c0d3ee1970b381242201699099495.jpg',
    'O+',
    'S',
    'N',
    'Brother',
    'atf',
    '123456788',
    '2023-02-13 20:35:46.000000',
    '2023-02-13 15:05:46.924080'
  ),
  (
    52,
    'Zis-P_027',
    'Ash_01',
    '',
    'Zishan',
    '',
    'Sorathiya',
    '+917700066780',
    '1234569877',
    '20co62@aiktc.ac.in',
    'male',
    '01-02-2023',
    '',
    '',
    '',
    'English',
    'Option B',
    'dsdvdv ',
    'Haryana',
    'jdnjsdbbid',
    '1656454',
    'Self Service',
    '',
    '',
    'Adhaar Card',
    '123465',
    '2c26834d-ad8c-4933-a11f-98e2573fa1cd5842311397026990974.jpg',
    'O+',
    'S',
    'N',
    'Sister',
    'abcd',
    'sdchsdbshbd',
    '2023-02-13 21:29:37.000000',
    '2023-02-13 15:59:37.506904'
  ),
  (
    54,
    'End-P_028',
    'Ash_01',
    '',
    'Endan',
    '',
    'Mollick',
    '4484849444',
    '',
    'endan@gmail.com',
    'male',
    '02-02-2023',
    '',
    '',
    '',
    'Hindi',
    '',
    'vsgcvasgca ',
    'Gujarat',
    'csdvs',
    '12655',
    'Business Man',
    '',
    '',
    'Adhaar Card',
    'sdvsvv',
    '3f816c4f-1179-43f6-9145-b1a45f1c8a098688091997333231749.jpg',
    'O+',
    'S',
    'N',
    'Sister',
    'vfvs',
    '11555555',
    '2023-02-13 21:45:31.000000',
    '2023-02-13 16:15:31.932893'
  ),
  (
    56,
    'ati-P_029',
    'Ash_01',
    'ati-P_029.png',
    'atif',
    '',
    'sorathiya',
    '1234567895',
    '1234567899',
    '',
    'male',
    '06-02-2014',
    '',
    '',
    '',
    'English',
    'Option A',
    'Kurla ',
    'Maharashtra',
    'Andheri',
    '1236456',
    'Business Man',
    '',
    'ddfggg',
    'Adhaar Card',
    '123555',
    '4b2044ad-3b41-46aa-89b2-736082efb4e72663383130720510875.jpg',
    'O+',
    'S',
    'N',
    'Sister',
    'Sister',
    '12346587',
    '2023-02-15 20:50:57.000000',
    '2023-02-15 15:20:57.946181'
  ),
  (
    57,
    'Dan-P_030',
    'Ash_01',
    'Dan-P_030.png',
    'Danish',
    '',
    'Nevrekar',
    '1234567890',
    '',
    '',
    'male',
    '01-02-2023',
    '',
    '',
    '',
    'Hindi',
    'Option A',
    'abcd ',
    'Maharashtra',
    'Andheri',
    '400052',
    'Business Man',
    '',
    '',
    'Adhaar Card',
    '123456789',
    '13648c8c-d005-4fc7-b306-7d7e6c4906343451926751361185078.jpg',
    'O+',
    'S',
    'Y',
    'Sister',
    'abcd',
    '123456',
    '2023-02-15 21:16:16.000000',
    '2023-02-15 15:46:16.240818'
  ),
  (
    58,
    'Waq-P_031',
    'Ash_01',
    'Waq-P_031.png',
    'Waqqas',
    '',
    'Malim',
    '1234567891',
    '',
    '',
    'male',
    '02-02-2023',
    '',
    '',
    '',
    '',
    '',
    'abcd ',
    '',
    'city',
    '123654',
    'Self Service',
    '',
    '',
    'Adhaar Card',
    '1452662',
    '980b1539-435c-4034-ba4f-2dda75e4bda97747414755269073168.jpg',
    'O+',
    'S',
    'Y',
    'Father',
    'abcd',
    'zishan',
    '2023-02-15 21:24:24.000000',
    '2023-02-15 15:54:24.884449'
  ),
  (
    59,
    'uma-P_032',
    'Ash_01',
    'uma-P_032.png',
    'umar',
    '',
    'siddique',
    '1234567899',
    '',
    '',
    'male',
    '01-02-2023',
    '',
    '',
    '',
    'English',
    'Option A',
    'abcd ',
    'Jammu and Kashmir',
    'abcd',
    '401250',
    'Business Man',
    '',
    '',
    'Adhaar Card',
    '1234567899',
    '6d9b0426-b018-4da8-bd60-6e20b9295fd64204967520839671272.jpg',
    'O+',
    'S',
    'N',
    'Sister',
    'Mother',
    '123654789',
    '2023-02-15 21:43:12.000000',
    '2023-02-15 16:13:12.592009'
  ),
  (
    61,
    'abc-P_034',
    'Ash_01',
    '',
    'abcd',
    '',
    'efgh',
    '1234569877',
    '',
    '',
    'male',
    '01-02-2023',
    '',
    '',
    '',
    'Marathi',
    'Option A',
    'Andheri ',
    '',
    'andheri',
    '400058',
    '',
    '',
    '',
    'Adhaar Card',
    'abch',
    '19fb2c61-6763-4d52-8a37-bf6f099d6cd66822902432270452370.jpg',
    'O+',
    'M',
    'N',
    'Sister',
    'Sister',
    '12345678',
    '2023-02-15 22:11:40.000000',
    '2023-02-15 16:41:40.204329'
  ),
  (
    62,
    'Abd-P_035',
    'Ash_01',
    '',
    'Abdul Gani',
    '',
    'Sorathiya',
    '1234567897',
    '',
    '',
    'male',
    '01-02-2023',
    '',
    '',
    '',
    'English',
    'Option A',
    'andheri ',
    '',
    'Andheri',
    '400058',
    'Business Man',
    '',
    '',
    'Adhaar Card',
    '123456',
    'f0c55ce6-f417-4418-8806-750cb5c0a8364819684764611020442.jpg',
    'O+',
    'S',
    'Y',
    'Sister',
    '',
    '12345678',
    '2023-02-15 22:23:04.000000',
    '2023-02-15 16:53:04.276844'
  ),
  (
    63,
    'Maa-P_036',
    'Ash_01',
    'Screen_(1).png',
    'Maaz',
    '',
    'afg',
    '1236548999',
    '',
    'shaikhbilal2732001@gmail.com',
    'male',
    '16-02-2023',
    '',
    '',
    '',
    '',
    '',
    'sdf ',
    '',
    'dfd',
    '2',
    '',
    '',
    '',
    'Adhaar Card',
    'g',
    'IMG_20230203_1525406.jpg',
    'A+',
    'S',
    'N',
    'Sister',
    'gh',
    'fh6',
    '2023-02-16 11:56:16.000000',
    '2023-02-16 06:26:16.218307'
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
  ),
  (
    3,
    'Maj-Zai-D_01asd',
    'BIL-P_02',
    '5',
    '2023-02-10 05:41:34',
    '0000-00-00 00:00:00'
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
  `mobile` varchar(20) NOT NULL,
  `img` text NOT NULL,
  `qualification` text NOT NULL,
  `speciality` text NOT NULL,
  `ID_proof` text NOT NULL,
  `ID_img` text NOT NULL,
  `about` varchar(256) NOT NULL,
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
    `mobile`,
    `img`,
    `qualification`,
    `speciality`,
    `ID_proof`,
    `ID_img`,
    `about`,
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
    '2147483647',
    '',
    '15',
    'Backend',
    '',
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
    '+918286012383',
    '',
    '15',
    'Backend',
    '',
    '',
    '',
    '0000-00-00',
    2,
    'Approved',
    '2023-01-04 10:08:14',
    '2023-02-04 12:08:04'
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
    '+918369521271',
    'boss.jpeg',
    '15',
    'Backend',
    '',
    '',
    '',
    '0000-00-00',
    3,
    'Approved',
    '2023-01-04 10:19:10',
    '2023-02-16 10:10:07'
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
    '+918898050464',
    '',
    '15',
    'Backend',
    '',
    '',
    '',
    '0000-00-00',
    4,
    'Approved',
    '2023-01-04 10:56:44',
    '2023-02-04 12:08:01'
  ),
  (
    22,
    'Bil-TES-A_03',
    '',
    '',
    'Bilal Shaikh',
    'bilal@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '',
    'male',
    '1999-10-02',
    23,
    'chdcfcgsdcghh',
    '+919870029314',
    '',
    '15',
    'BackendTESTETSTETSTETS',
    '',
    '',
    '',
    '0000-00-00',
    1,
    'Approved',
    '2023-02-03 12:35:32',
    '2023-02-06 10:23:41'
  ),
  (
    26,
    'Saq-Maj-D_02',
    'Maa-Maj-A_01',
    'Ash_01',
    'Saqib Ansari',
    'saqib@gmail.com',
    '7c4a8d09ca3762af61e59520943dc26494f8941b',
    '',
    'male',
    '0000-00-00',
    23,
    'chdcfcgsdcghh',
    '8898050464',
    '',
    '15',
    'Flutter',
    '',
    '',
    '',
    '0000-00-00',
    3,
    '',
    '2023-02-06 10:25:03',
    '2023-02-06 10:25:03'
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
  `C_id` varchar(65) NOT NULL,
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
    `C_id`,
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
  ),
  (
    8,
    'Case_2022-2023_04',
    'Tele2022_08',
    'Zai-P_013',
    'Maj-Zai-D_01',
    '11:04:00',
    '12:04:00',
    '1 Hours 0 Minutes',
    '',
    '2023-02-16 18:07:42',
    '0000-00-00 00:00:00'
  ),
  (
    9,
    'Case_2022-2023_04',
    'Tele2022_09',
    'Zai-P_013',
    'Maj-Zai-D_01',
    '11:04:00',
    '12:04:00',
    '1 Hours 0 Minutes',
    '',
    '2023-02-16 18:07:50',
    '0000-00-00 00:00:00'
  ),
  (
    10,
    'Case_2022-2023_04',
    'Tele2022_010',
    'Zai-P_013',
    'Maj-Zai-D_01',
    '11:04:00',
    '12:04:00',
    '1 Hours 0 Minutes',
    '',
    '2023-02-16 18:07:50',
    '0000-00-00 00:00:00'
  ),
  (
    11,
    'Case_2022-2023_04',
    'Tele2022_011',
    'Zai-P_013',
    'Maj-Zai-D_01',
    '11:04:00',
    '12:04:00',
    '1 Hours 0 Minutes',
    '',
    '2023-02-16 18:07:50',
    '0000-00-00 00:00:00'
  ),
  (
    12,
    'Case_2022-2023_04',
    'Tele2022_012',
    'Zai-P_013',
    'Maj-Zai-D_01',
    '10:04:00',
    '12:04:00',
    '2 Hours 0 Minutes',
    '',
    '2023-02-16 18:07:50',
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
  `test_id` varchar(64) NOT NULL,
  `title` varchar(128) NOT NULL,
  `reading` varchar(64) NOT NULL,
  `staff_id` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL,
  `method` varchar(12) NOT NULL,
  `created_at` varchar(55) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--
-- Dumping data for table `test_cases`
--
INSERT INTO
  `test_cases` (
    `id`,
    `C_id`,
    `test_id`,
    `title`,
    `reading`,
    `staff_id`,
    `status`,
    `method`,
    `created_at`,
    `updated_at`
  )
VALUES
  (
    1,
    'Case_2022-2023_05',
    '6',
    'BMI',
    '40F',
    'Maj-Noo-C_01',
    'Pending',
    '',
    '2023-02-15 17:03:39',
    '2023-02-15 11:33:39'
  ),
  (
    2,
    'Case_2022-2023_05',
    '6',
    'BMI',
    '40F',
    'Maj-Noo-C_01',
    'Pending',
    '',
    '2023-02-15 17:03:40',
    '2023-02-15 11:33:40'
  ),
  (
    3,
    'Case_2022-2023_05',
    '6',
    'TEst2',
    '100F',
    'Maj-Noo-C_01',
    'Pending',
    'Manual',
    '2023-02-15 17:03:40',
    '2023-02-17 07:12:52'
  ),
  (
    4,
    'Case_2022-2023_05',
    '6',
    'TEst2',
    '100F',
    'Maj-Noo-C_01',
    'Pending',
    'Manual',
    '2023-02-15 17:03:41',
    '2023-02-17 07:12:33'
  ),
  (
    7,
    'Case_2022-2023_01',
    '6',
    'BMI',
    '50F',
    'Maj-Zai-D_01',
    'Pending',
    '',
    '2023-02-17 16:39:42',
    '2023-02-17 11:09:42'
  ),
  (
    8,
    'Case_2022-2023_01',
    '7',
    'BMI',
    '6F',
    'Maj-Zai-D_01',
    'Pending',
    '',
    '2023-02-17 16:39:42',
    '2023-02-17 11:09:42'
  ),
  (
    9,
    'Case_2022-2023_01',
    '7',
    'BMI',
    '6.2F',
    'Maj-Zai-D_01',
    'Pending',
    '',
    '2023-02-17 16:39:42',
    '2023-02-17 11:09:42'
  );

--
-- Indexes for dumped tables
--
--
-- Indexes for table `admin_org`
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
-- Indexes for table `history_medical_history`
--
ALTER TABLE
  `history_medical_history`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_opthalmic_history`
--
ALTER TABLE
  `history_opthalmic_history`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `history_paediatric_history`
--
ALTER TABLE
  `history_paediatric_history`
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
-- Indexes for table `old_reports`
--
ALTER TABLE
  `old_reports`
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
  AUTO_INCREMENT = 9;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE
  `bills`
MODIFY
  `id` int(55) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `history_contact_allergies`
--
ALTER TABLE
  `history_contact_allergies`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `history_drug_allergies`
--
ALTER TABLE
  `history_drug_allergies`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 15;

--
-- AUTO_INCREMENT for table `history_food_allergies`
--
ALTER TABLE
  `history_food_allergies`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `history_medical_history`
--
ALTER TABLE
  `history_medical_history`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT for table `history_opthalmic_history`
--
ALTER TABLE
  `history_opthalmic_history`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 29;

--
-- AUTO_INCREMENT for table `history_paediatric_history`
--
ALTER TABLE
  `history_paediatric_history`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 11;

--
-- AUTO_INCREMENT for table `history_systemic_history`
--
ALTER TABLE
  `history_systemic_history`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 28;

--
-- AUTO_INCREMENT for table `history_visit`
--
ALTER TABLE
  `history_visit`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 35;

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
-- AUTO_INCREMENT for table `old_reports`
--
ALTER TABLE
  `old_reports`
MODIFY
  `id` bigint(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE
  `organization`
MODIFY
  `id` int(10) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE
  `patients`
MODIFY
  `id` int(30) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 64;

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
  AUTO_INCREMENT = 4;

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
  AUTO_INCREMENT = 27;

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
  AUTO_INCREMENT = 13;

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