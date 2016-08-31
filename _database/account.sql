-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2016 at 09:22 पूर्वाह्न
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
-- Table structure for table `bank_info`
--

CREATE TABLE IF NOT EXISTS `bank_info` (
  `id` int(11) NOT NULL,
  `account_code` varchar(20) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `bank_account_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(50) NOT NULL,
  `bank_phone_no` varchar(20) DEFAULT NULL,
  `last_reconciled_date` timestamp NULL DEFAULT NULL,
  `ending_reconcile_balance` double DEFAULT NULL,
  `committee_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `account_code`, `account_type`, `bank_account_name`, `bank_name`, `bank_address`, `bank_account_number`, `bank_phone_no`, `last_reconciled_date`, `ending_reconcile_balance`, `committee_id`, `user_id`, `status`) VALUES
(1, NULL, NULL, NULL, 'Himalayan Bank Limited', 'Narayangarh, Chitwan', '98452141409845214140', '056-533977', NULL, NULL, NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `bank_trans_info`
--

CREATE TABLE IF NOT EXISTS `bank_trans_info` (
  `id` int(11) NOT NULL,
  `type` smallint(6) DEFAULT NULL,
  `trans_no` int(11) DEFAULT NULL,
  `bank_act` varchar(15) NOT NULL DEFAULT '',
  `ref` varchar(40) DEFAULT NULL,
  `trans_date` date NOT NULL DEFAULT '0000-00-00',
  `amount` double DEFAULT NULL,
  `dimension_id` int(11) NOT NULL DEFAULT '0',
  `dimension2_id` int(11) NOT NULL DEFAULT '0',
  `person_type_id` int(11) NOT NULL DEFAULT '0',
  `person_id` tinyblob,
  `reconciled` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_trans_info`
--

INSERT INTO `bank_trans_info` (`id`, `type`, `trans_no`, `bank_act`, `ref`, `trans_date`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`, `reconciled`) VALUES
(1, 0, 1, '1', '1', '2014-12-31', -312, 0, 0, 0, '', NULL),
(2, 0, 2, '1', '1', '2015-01-01', 312, 0, 0, 0, '', NULL),
(3, 0, 3, '1', '2', '2014-12-31', -500, 0, 0, 0, '', NULL),
(4, 0, 4, '1', '3', '2014-12-31', 500, 0, 0, 0, '', NULL),
(5, 0, 5, '1', '4', '2014-12-31', 1000, 0, 0, 0, '', NULL),
(6, 0, 6, '2', '5', '2014-12-31', 100, 0, 0, 0, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_class`
--

CREATE TABLE IF NOT EXISTS `chart_class` (
  `id` int(11) NOT NULL,
  `chart_code` varchar(255) DEFAULT NULL,
  `chart_class_name` varchar(255) DEFAULT NULL,
  `chart_status` varchar(255) DEFAULT NULL,
  `chart_class_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_class`
--

INSERT INTO `chart_class` (`id`, `chart_code`, `chart_class_name`, `chart_status`, `chart_class_type`) VALUES
(1, '1', 'Assets', 'Active', NULL),
(2, '2', 'Liabilities', 'Active', NULL),
(3, '3', 'Income', 'Active', NULL),
(4, '4', 'Expenses', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_master`
--

CREATE TABLE IF NOT EXISTS `chart_master` (
  `id` int(11) NOT NULL,
  `account_code` varchar(50) DEFAULT NULL,
  `account_code2` varchar(50) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_status` varchar(100) DEFAULT NULL,
  `chart_class_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_master`
--

INSERT INTO `chart_master` (`id`, `account_code`, `account_code2`, `account_name`, `account_status`, `chart_class_id`) VALUES
(1, '100', '', 'Cash Account', '0', '1'),
(2, '101', '', 'Bank Account', '0', '1'),
(3, '102', '', 'Bank Account', '0', '1'),
(4, '103', '', 'Personal Advance', '0', '1'),
(5, '104', '', 'Official Advance', '0', '1'),
(6, '105', '', 'Accounts Receivable', '0', '1'),
(7, '201', '', 'Accounts Payable', '0', '2'),
(8, '202', '', 'TDS Payable', '0', '2'),
(9, '301', '', 'Plantation', '0', '3'),
(10, '302', '', 'Grassland Management', '0', '3'),
(11, '303', '', 'AAAAAAAA Income', '0', '3'),
(12, '401', '', 'Salary Expenses', '0', '4'),
(13, '402', '', 'TADA Expenses', '0', '4'),
(14, '403', '', 'Salary Expenses', '0', '4'),
(15, '404', '', 'Rental Expenses', '0', '4'),
(16, '405', '', 'Repair &amp; Maintenance Expenses', '0', '4'),
(17, '406', '', 'Email, Internet, Telephone &amp; Postage Expenses', '0', '4'),
(18, '407', '', 'AAAAAAAAAA Expenses', '0', '4');

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
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `committee_info`
--

INSERT INTO `committee_info` (`id`, `committee_name`, `address`, `phone`, `code`, `status`) VALUES
(4, 'TAAL', 'Bharatpur', '9845214140', '12345', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `donar_info`
--

CREATE TABLE IF NOT EXISTS `donar_info` (
  `id` int(11) NOT NULL,
  `donar_name` text,
  `donar_address` text,
  `donar_contact_no` varchar(255) DEFAULT NULL,
  `donar_code` varchar(100) DEFAULT NULL,
  `donar_email` varchar(100) DEFAULT NULL,
  `committee_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donar_info`
--

INSERT INTO `donar_info` (`id`, `donar_name`, `donar_address`, `donar_contact_no`, `donar_code`, `donar_email`, `committee_id`, `user_id`, `status`) VALUES
(1, 'UNO', 'Kathmandu', '9845214140', '00210', 'bhomnath@salyani.com.np', NULL, NULL, 'Active'),
(2, 'kjdshjkh', 'jkhdjkshfkjh', 'khjkdhskjfsd', 'asjdfk', 'jkhdsjkhj', NULL, NULL, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fiscal_year_info`
--

CREATE TABLE IF NOT EXISTS `fiscal_year_info` (
  `id` int(11) NOT NULL,
  `fiscal_year` varchar(255) DEFAULT NULL,
  `begin_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `committee_name` text,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fiscal_year_info`
--

INSERT INTO `fiscal_year_info` (`id`, `fiscal_year`, `begin_date`, `end_date`, `committee_name`, `status`) VALUES
(3, '2072/2073', NULL, NULL, 'TAAL', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `gl_trans_info`
--

CREATE TABLE IF NOT EXISTS `gl_trans_info` (
  `counter` int(11) NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0',
  `type_no` bigint(16) NOT NULL DEFAULT '1',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `account` varchar(15) NOT NULL DEFAULT '',
  `memo_` tinytext NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `dimension_id` int(11) NOT NULL DEFAULT '0',
  `dimension2_id` int(11) NOT NULL DEFAULT '0',
  `person_type_id` int(11) DEFAULT NULL,
  `person_id` tinyblob
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gl_trans_info`
--

INSERT INTO `gl_trans_info` (`counter`, `type`, `type_no`, `tran_date`, `account`, `memo_`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`) VALUES
(1, 0, 1, '2014-12-31', '1060', '', -312, 0, 0, NULL, NULL),
(2, 0, 1, '2014-12-31', '2150', '', 312, 0, 0, NULL, NULL),
(3, 0, 2, '2015-01-01', '1060', '', 312, 0, 0, NULL, NULL),
(4, 0, 2, '2015-01-01', '2150', '', -312, 0, 0, NULL, NULL),
(5, 0, 3, '2014-12-31', '2620', '', 500, 0, 0, NULL, NULL),
(6, 0, 3, '2014-12-31', '1060', '', -500, 0, 0, NULL, NULL),
(7, 0, 4, '2014-12-31', '2620', '', -500, 0, 0, NULL, NULL),
(8, 0, 4, '2014-12-31', '1060', '', 500, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `programs_list`
--

CREATE TABLE IF NOT EXISTS `programs_list` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `committee_id` varchar(255) DEFAULT NULL,
  `subledger_id` text,
  `fiscal_year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programs_list`
--

INSERT INTO `programs_list` (`id`, `code`, `program_name`, `user_id`, `status`, `committee_id`, `subledger_id`, `fiscal_year`) VALUES
(7, '345', 'Plantation', 1, NULL, NULL, NULL, NULL),
(8, '345', 'Fencing', 1, NULL, NULL, NULL, NULL),
(9, '345', 'sanoj', 1, NULL, NULL, '1<##>2', NULL),
(10, '345', 'Plantation', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subledger_info`
--

CREATE TABLE IF NOT EXISTS `subledger_info` (
  `id` int(11) NOT NULL,
  `subledger_name` varchar(255) DEFAULT NULL,
  `subledger_code` varchar(255) DEFAULT NULL,
  `subledger_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subledger_info`
--

INSERT INTO `subledger_info` (`id`, `subledger_name`, `subledger_code`, `subledger_status`) VALUES
(1, 'Wooden Gate Construction', '34343', 'active'),
(2, 'asdf', '34343', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL,
  `committee_id` varchar(255) DEFAULT NULL,
  `fiscal_year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `password`, `status`, `user_type`, `committee_id`, `fiscal_year`) VALUES
(1, 'bhomnath', '9fe3ef0f7bab8b8f9c60056e680cd727', '1', 'administrator', NULL, NULL),
(2, 'sanoj', '9c5ddd54107734f7d18335a5245c286b', '1', 'administrator', NULL, NULL),
(3, 'sanoj', '9c5ddd54107734f7d18335a5245c286b', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_info`
--
ALTER TABLE `bank_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_trans_info`
--
ALTER TABLE `bank_trans_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_act` (`bank_act`,`ref`),
  ADD KEY `type` (`type`,`trans_no`),
  ADD KEY `bank_act_2` (`bank_act`,`reconciled`),
  ADD KEY `bank_act_3` (`bank_act`,`trans_date`);

--
-- Indexes for table `chart_class`
--
ALTER TABLE `chart_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chart_master`
--
ALTER TABLE `chart_master`
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
-- Indexes for table `gl_trans_info`
--
ALTER TABLE `gl_trans_info`
  ADD PRIMARY KEY (`counter`),
  ADD KEY `Type_and_Number` (`type`,`type_no`),
  ADD KEY `dimension_id` (`dimension_id`),
  ADD KEY `dimension2_id` (`dimension2_id`),
  ADD KEY `tran_date` (`tran_date`),
  ADD KEY `account_and_tran_date` (`account`,`tran_date`);

--
-- Indexes for table `programs_list`
--
ALTER TABLE `programs_list`
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
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bank_trans_info`
--
ALTER TABLE `bank_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `chart_class`
--
ALTER TABLE `chart_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `chart_master`
--
ALTER TABLE `chart_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `committee_info`
--
ALTER TABLE `committee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `donar_info`
--
ALTER TABLE `donar_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `fiscal_year_info`
--
ALTER TABLE `fiscal_year_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gl_trans_info`
--
ALTER TABLE `gl_trans_info`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `programs_list`
--
ALTER TABLE `programs_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `subledger_info`
--
ALTER TABLE `subledger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
