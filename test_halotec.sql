-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 01:04 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_halotec`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_birth`
--

CREATE TABLE `tb_birth` (
  `birth_id` int(11) NOT NULL,
  `name_mother` varchar(250) NOT NULL,
  `age_mother` int(2) NOT NULL,
  `age_pregnancy` int(2) NOT NULL,
  `datetime_maternity` datetime NOT NULL,
  `parturition_process` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_birth`
--

INSERT INTO `tb_birth` (`birth_id`, `name_mother`, `age_mother`, `age_pregnancy`, `datetime_maternity`, `parturition_process`) VALUES
(2, 'warnita', 9, 8, '2023-02-08 01:44:41', 'Dibantu alat'),
(4, '889', 89, 9, '2023-02-02 22:35:33', 'Normal');

-- --------------------------------------------------------

--
-- Table structure for table `tb_child`
--

CREATE TABLE `tb_child` (
  `child_id` int(11) NOT NULL,
  `child_hd_id` int(11) NOT NULL,
  `child_gender` char(20) NOT NULL,
  `child_long` int(3) NOT NULL DEFAULT 0,
  `child_weight` int(10) NOT NULL DEFAULT 0,
  `child_condition` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_child`
--

INSERT INTO `tb_child` (`child_id`, `child_hd_id`, `child_gender`, `child_long`, `child_weight`, `child_condition`) VALUES
(1, 2, 'Laki-Laki', 50, 3, 'sehat');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_birth`
--
ALTER TABLE `tb_birth`
  ADD PRIMARY KEY (`birth_id`);

--
-- Indexes for table `tb_child`
--
ALTER TABLE `tb_child`
  ADD PRIMARY KEY (`child_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_birth`
--
ALTER TABLE `tb_birth`
  MODIFY `birth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_child`
--
ALTER TABLE `tb_child`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
