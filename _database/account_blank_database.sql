-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 30, 2016 at 09:28 पूर्वाह्न
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `account`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_ledger_info`
--

CREATE TABLE IF NOT EXISTS `account_ledger_info` (
  `id` int(11) NOT NULL,
  `ledger_code` varchar(25) DEFAULT NULL,
  `ledger_name` varchar(255) NOT NULL,
  `account_ledger_status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_ledger_info`
--

INSERT INTO `account_ledger_info` (`id`, `ledger_code`, `ledger_name`, `account_ledger_status`) VALUES
(1, '01', 'Bank Account', '1'),
(2, '02', 'Bank Account', '1'),
(3, '03', 'Bank Account', '1'),
(4, '04', 'Bank Account', '1'),
(5, '05', 'Bank Account', '1'),
(6, '06', 'Bank Account', '1'),
(7, '07', 'Bank Account', '1'),
(8, '08', 'Bank Account', '1'),
(9, '09', 'Bank Account', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE IF NOT EXISTS `bank_info` (
  `id` int(11) NOT NULL,
  `account_code` varchar(20) DEFAULT NULL,
  `subledger_code` varchar(25) DEFAULT NULL,
  `subledger_id` varchar(25) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `bank_account_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `bank_phone_no` varchar(20) DEFAULT NULL,
  `last_reconciled_date` timestamp NULL DEFAULT NULL,
  `ending_reconcile_balance` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bank_trans_info`
--

CREATE TABLE IF NOT EXISTS `bank_trans_info` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `trans_no` varchar(255) DEFAULT NULL,
  `trans_date` varchar(255) DEFAULT NULL,
  `ledger_master_code` varchar(50) DEFAULT NULL,
  `memo` text,
  `amount` varchar(50) DEFAULT NULL,
  `reconciled` varchar(255) DEFAULT NULL,
  `bank_id` varchar(50) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chart_class`
--

CREATE TABLE IF NOT EXISTS `chart_class` (
  `id` int(11) NOT NULL,
  `chart_code` varchar(255) DEFAULT NULL,
  `chart_class_name` varchar(255) DEFAULT NULL,
  `chart_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_class`
--

INSERT INTO `chart_class` (`id`, `chart_code`, `chart_class_name`, `chart_status`) VALUES
(1, '01', 'Assets', '1'),
(2, '02', 'Liabilities', '1'),
(3, '03', 'Income', '1'),
(4, '04', 'Expenses', '1');

-- --------------------------------------------------------

--
-- Table structure for table `committee_info`
--

CREATE TABLE IF NOT EXISTS `committee_info` (
  `id` int(11) NOT NULL,
  `committee_name` text,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `logo` varchar(1000) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `donar_info`
--

CREATE TABLE IF NOT EXISTS `donar_info` (
  `id` int(11) NOT NULL,
  `donar_name` text,
  `donar_address` text,
  `donar_contact_no` varchar(255) DEFAULT NULL,
  `donar_code` varchar(25) NOT NULL,
  `donar_email` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_person_cell_no` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_year_info`
--

CREATE TABLE IF NOT EXISTS `fiscal_year_info` (
  `id` int(11) NOT NULL,
  `fiscal_year` varchar(255) DEFAULT NULL,
  `begin_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `committee_code` varchar(255) DEFAULT NULL,
  `committee_id` varchar(25) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gl_trans_comment_details`
--

CREATE TABLE IF NOT EXISTS `gl_trans_comment_details` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(255) DEFAULT NULL,
  `detailed_comment` text
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gl_trans_info`
--

CREATE TABLE IF NOT EXISTS `gl_trans_info` (
  `id` int(11) NOT NULL,
  `journal_voucher_no` varchar(255) DEFAULT NULL,
  `tran_date` varchar(50) DEFAULT NULL,
  `ledger_master_code` varchar(255) DEFAULT NULL,
  `ledger_master_description` text,
  `account_ledger_head_code` varchar(25) NOT NULL,
  `sub_ledger_code` varchar(255) DEFAULT NULL,
  `donor_code` varchar(255) DEFAULT NULL,
  `ledger_type_code` varchar(255) DEFAULT NULL,
  `memo` tinytext,
  `amount` double NOT NULL DEFAULT '0',
  `cheque_no` varchar(255) DEFAULT NULL,
  `trans_type` varchar(25) DEFAULT NULL,
  `gl_trans_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_master`
--

CREATE TABLE IF NOT EXISTS `ledger_master` (
  `id` int(11) NOT NULL,
  `ledger_master_code` varchar(25) NOT NULL,
  `ledger_master_name` varchar(500) NOT NULL,
  `account_code` varchar(25) NOT NULL,
  `ledger_code` varchar(25) NOT NULL,
  `subledger_code` varchar(25) NOT NULL,
  `donor_code` varchar(25) NOT NULL,
  `ledger_type_code` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_type_info`
--

CREATE TABLE IF NOT EXISTS `ledger_type_info` (
  `id` int(11) NOT NULL,
  `ledger_type_name` varchar(255) NOT NULL,
  `ledger_type_code` varchar(255) NOT NULL,
  `ledger_type_status` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledger_type_info`
--

INSERT INTO `ledger_type_info` (`id`, `ledger_type_name`, `ledger_type_code`, `ledger_type_status`) VALUES
(1, 'Select None', '00', '1'),
(2, 'Cash', '01', '1'),
(3, 'Internal Cash', '02', '1'),
(4, 'Labour Support', '03', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subledger_info`
--

CREATE TABLE IF NOT EXISTS `subledger_info` (
  `id` int(11) NOT NULL,
  `subledger_name` varchar(255) DEFAULT NULL,
  `subledger_code` varchar(255) DEFAULT NULL,
  `subledger_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `committee_id` varchar(255) DEFAULT NULL,
  `committee_code` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_ledger_info`
--
ALTER TABLE `account_ledger_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_trans_info`
--
ALTER TABLE `bank_trans_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_class`
--
ALTER TABLE `chart_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_info`
--
ALTER TABLE `committee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donar_info`
--
ALTER TABLE `donar_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fiscal_year_info`
--
ALTER TABLE `fiscal_year_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_trans_comment_details`
--
ALTER TABLE `gl_trans_comment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gl_trans_info`
--
ALTER TABLE `gl_trans_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_master`
--
ALTER TABLE `ledger_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_type_info`
--
ALTER TABLE `ledger_type_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subledger_info`
--
ALTER TABLE `subledger_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_ledger_info`
--
ALTER TABLE `account_ledger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank_trans_info`
--
ALTER TABLE `bank_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chart_class`
--
ALTER TABLE `chart_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `committee_info`
--
ALTER TABLE `committee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `donar_info`
--
ALTER TABLE `donar_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fiscal_year_info`
--
ALTER TABLE `fiscal_year_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `gl_trans_comment_details`
--
ALTER TABLE `gl_trans_comment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `gl_trans_info`
--
ALTER TABLE `gl_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ledger_master`
--
ALTER TABLE `ledger_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ledger_type_info`
--
ALTER TABLE `ledger_type_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subledger_info`
--
ALTER TABLE `subledger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
