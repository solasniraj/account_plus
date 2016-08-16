-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2016 at 12:39 अपराह्न
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `account`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `password`, `status`, `user_type`) VALUES
(1, 'bhomnath', '9fe3ef0f7bab8b8f9c60056e680cd727', '1', 'administrator'),
(2, 'sanoj', '9c5ddd54107734f7d18335a5245c286b', '1', 'administrator'),
(3, 'sanoj', '9c5ddd54107734f7d18335a5245c286b', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_programs_list`
--

CREATE TABLE `user_programs_list` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `programName` varchar(255) NOT NULL,
  `programBudget` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_programs_list`
--

INSERT INTO `user_programs_list` (`id`, `code`, `programName`, `programBudget`, `category`, `user_id`) VALUES
(1, '2nr5g6', 'fasdfadasdas', 'dfasfadfas', 'afafdadfa', 2),
(2, 'gindagi', 'dopalki', 'intagaj', 'kyakag', 2),
(3, 'timro', 'name', 'k', 'ho', 2),
(4, 'fdfasfd', 'dfasdf', 'fasdf', 'fdasdf', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_programs_list`
--
ALTER TABLE `user_programs_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_programs_list`
--
ALTER TABLE `user_programs_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
