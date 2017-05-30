-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2017 at 12:12 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cambodiaintermarket_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_districts`
--

CREATE TABLE `tbl_districts` (
  `id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_code` varchar(100) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_districts`
--

INSERT INTO `tbl_districts` (`id`, `province_id`, `district_code`, `district_name`) VALUES
(1, 1, '', 'kong meas'),
(2, 1, '', 'prey chhor'),
(3, 2, '', 'meanchey'),
(4, 2, '', '7makara'),
(5, 3, '', 'ksachkandal'),
(6, 3, '', 'koh thom');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_districts`
--
ALTER TABLE `tbl_districts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_districts`
--
ALTER TABLE `tbl_districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
