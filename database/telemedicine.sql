-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2023 at 06:51 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `telemedicine`
--
ALTER TABLE `telemedicine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `telemedicine`
--
ALTER TABLE `telemedicine`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
