-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2017 at 12:11 PM
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
-- Table structure for table `tbl_communes`
--

CREATE TABLE `tbl_communes` (
  `id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `commune_code` varchar(100) NOT NULL,
  `communes_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_communes`
--

INSERT INTO `tbl_communes` (`id`, `district_id`, `commune_code`, `communes_name`) VALUES
(1, 1, '', 'Angkorban'),
(2, 2, '', 'khum prey chhor'),
(3, 3, '', 'stengmanchey'),
(4, 4, '', 'Toul Kok'),
(5, 5, '', 'vihea sur'),
(6, 6, '', 'khum koh touj');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_communes`
--
ALTER TABLE `tbl_communes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_communes`
--
ALTER TABLE `tbl_communes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
