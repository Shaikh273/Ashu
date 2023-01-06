-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2023 at 12:37 PM
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
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `id` int(10) NOT NULL,
  `org_id` varchar(100) NOT NULL,
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

INSERT INTO `organization` (`id`, `org_id`, `org_name`, `org_country`, `org_state`, `org_district`, `org_city`, `org_pincode`, `org_address`, `org_email`, `org_No`, `org_addedby`, `created_at`, `updated_at`) VALUES
( 'Ash_01', 'Ashu', 'India', 'Maharashtra', 'Mumbai', '400010', '', 'madanpura Nagpada 2 taki', 'nooralam@gmail.com', '8898971045', 'Maa-S_01', '2023-01-04 11:50:24', '2023-01-04 16:20:24');
INSERT INTO `organization` ( `org_id`, `org_name`, `org_country`, `org_state`, `org_district`, `org_city`, `org_pincode`, `org_address`, `org_email`, `org_No`, `org_addedby`, `created_at`, `updated_at`) VALUES
( 'Ash_01', 'Ashu', 'India', 'Maharashtra', 'Mumbai', '400010', '', 'madanpura Nagpada 2 taki', 'nooralam@gmail.com', '8898971045', 'Maa-S_01', '2023-01-04 11:50:24', '2023-01-04 16:20:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
