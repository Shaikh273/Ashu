-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 07:04 AM
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
-- Table structure for table `history_vital_signs`
--

CREATE TABLE `history_vital_signs` (
  `id` int(10) NOT NULL,
  `C_id` varchar(10) NOT NULL,
  `pat_id` varchar(10) NOT NULL,
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

INSERT INTO `history_vital_signs` (`id`, `C_id`, `pat_id`, `temperature`, `pulse`, `blood_pressure`, `rr`, `spo2`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '', '', '', '', '', '2022-12-27 12:44:10', '2022-12-27 17:14:10'),
(2, '2', '1', '', '', '', '', '', '2022-12-28 11:38:55', '2022-12-28 16:08:55'),
(5, '3', '1', '', '', '', '', '', '2022-12-29 10:36:04', '2022-12-29 15:06:04'),
(6, '3', '1', '', '', '', '', '', '2022-12-29 13:00:09', '2022-12-29 17:30:09'),
(7, '3', '1', '', '', '', '', '', '2022-12-29 13:00:43', '2022-12-29 17:30:43'),
(8, '3', '1', '', '', '', '', '', '2022-12-29 13:01:05', '2022-12-29 17:31:05'),
(9, '3', '1', '', '', '', '', '', '2022-12-29 13:01:55', '2022-12-29 17:31:55'),
(10, '3', '1', '', '', '', '', '', '2022-12-29 13:02:25', '2022-12-29 17:32:25'),
(11, '2', '1', '', '', '', '', '', '2022-12-29 13:03:57', '2022-12-29 17:33:57'),
(12, '5', '1', '', '', '', '', '', '2023-01-02 11:56:32', '2023-01-02 16:26:32'),
(15, '5', '1', '', '', '', '', '', '2023-01-05 06:38:02', '2023-01-05 11:08:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_vital_signs`
--
ALTER TABLE `history_vital_signs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_vital_signs`
--
ALTER TABLE `history_vital_signs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
