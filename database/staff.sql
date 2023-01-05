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
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
