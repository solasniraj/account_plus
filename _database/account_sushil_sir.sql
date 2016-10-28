-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2016 at 12:54 अपराह्न
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

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
(9, '09', 'Bank Account', '1'),
(29, '10', 'Rental Expenses', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bank_info`
--

CREATE TABLE IF NOT EXISTS `bank_info` (
  `id` int(11) NOT NULL,
  `bank_account_code` varchar(20) DEFAULT NULL,
  `ledger_code` varchar(25) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `bank_account_name` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(50) DEFAULT NULL,
  `bank_phone_no` varchar(20) DEFAULT NULL,
  `last_reconciled_date` timestamp NULL DEFAULT NULL,
  `ending_reconcile_balance` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `bank_account_code`, `ledger_code`, `account_type`, `bank_account_name`, `bank_name`, `bank_address`, `bank_account_number`, `bank_phone_no`, `last_reconciled_date`, `ending_reconcile_balance`, `status`) VALUES
(6, NULL, '01', NULL, 'RBB Kawasoti', NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(7, NULL, '02', NULL, 'Petty Cash Fund', NULL, NULL, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `bank_trans_info`
--

CREATE TABLE IF NOT EXISTS `bank_trans_info` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `trans_no` varchar(255) DEFAULT NULL,
  `trans_date` varchar(255) DEFAULT NULL,
  `tran_date_english` varchar(255) NOT NULL,
  `ledger_master_code` varchar(50) DEFAULT NULL,
  `memo` text,
  `amount` varchar(50) DEFAULT NULL,
  `reconciled` varchar(255) DEFAULT NULL,
  `bank_id` varchar(50) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_trans_info`
--

INSERT INTO `bank_trans_info` (`id`, `type`, `trans_no`, `trans_date`, `tran_date_english`, `ledger_master_code`, `memo`, `amount`, `reconciled`, `bank_id`, `status`) VALUES
(21, 'dr', 'CNP099-FY2073/2074-00001', '2073-07-03', '2016-10-19', '0101000000', 'WWF Nepal', '500000', NULL, '6', '1'),
(22, 'cr', 'CNP099-FY2073/2074-00003', '2073-07-03', '2016-10-19', '0101000000', '0000', '-50000', NULL, '6', '1'),
(23, 'cr', 'CNP099-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0102000001', 'payment', '-20000', NULL, '7', '1'),
(24, 'cr', 'CNP099-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0101000000', 'Nabaraj Poudel', '-10000', NULL, '6', '1'),
(25, 'cr', 'CNP099-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0101000000', 'Bakhan', '-4500', NULL, '6', '1'),
(26, 'dr', 'CNP099-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0101000000', 'fff', '1200', NULL, '6', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `committee_info`
--

INSERT INTO `committee_info` (`id`, `committee_name`, `address`, `phone`, `code`, `email_address`, `logo`, `status`) VALUES
(11, 'Amaltari Users Committee', 'Nawalparasi', '999999', 'CNP099', '', 'wife.jpg', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donar_info`
--

INSERT INTO `donar_info` (`id`, `donar_name`, `donar_address`, `donar_contact_no`, `donar_code`, `donar_email`, `contact_person`, `contact_person_cell_no`, `status`) VALUES
(8, 'WWF Nepal', 'Ratnanagar Ch', '', '01', '', '', '', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fiscal_year_info`
--

INSERT INTO `fiscal_year_info` (`id`, `fiscal_year`, `begin_date`, `end_date`, `committee_code`, `committee_id`, `status`) VALUES
(11, '2073/2074', '2073/04/01', '2074/03/30', 'CNP099', '11', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gl_trans_comment_details`
--

CREATE TABLE IF NOT EXISTS `gl_trans_comment_details` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(255) DEFAULT NULL,
  `detailed_comment` text
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gl_trans_comment_details`
--

INSERT INTO `gl_trans_comment_details` (`id`, `trans_no`, `detailed_comment`) VALUES
(30, 'CNP099-FY2073/2074-00001', 'WN75 grant amount received'),
(31, 'CNP099-FY2073/2074-00002', 'Internal cash managed'),
(32, 'CNP099-FY2073/2074-00003', 'Stone purchased'),
(33, 'CNP099-FY2073/2074-00004', 'Payable to Nabaraj Poudel'),
(34, 'CNP099-FY2073/2074-00005', 'WWF Plantation Support'),
(35, 'CNP099-FY2073/2074-00006', 'Payment of Chair purchase'),
(36, 'CNP099-FY2073/2074-00007', 'House rent paid'),
(37, 'CNP099-FY2073/2074-00008', 'Bank int');

-- --------------------------------------------------------

--
-- Table structure for table `gl_trans_info`
--

CREATE TABLE IF NOT EXISTS `gl_trans_info` (
  `id` int(11) NOT NULL,
  `journal_voucher_no` varchar(255) DEFAULT NULL,
  `tran_date` varchar(50) DEFAULT NULL,
  `tran_date_english` varchar(255) NOT NULL,
  `ledger_master_code` varchar(255) DEFAULT NULL,
  `ledger_master_description` text,
  `account_ledger_head_code` varchar(25) NOT NULL,
  `gl_code` varchar(50) DEFAULT NULL,
  `sub_ledger_code` varchar(255) DEFAULT NULL,
  `donor_code` varchar(255) DEFAULT NULL,
  `ledger_type_code` varchar(255) DEFAULT NULL,
  `memo` tinytext,
  `amount` double NOT NULL DEFAULT '0',
  `cheque_no` varchar(255) DEFAULT NULL,
  `trans_type` varchar(25) DEFAULT NULL,
  `gl_trans_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gl_trans_info`
--

INSERT INTO `gl_trans_info` (`id`, `journal_voucher_no`, `tran_date`, `tran_date_english`, `ledger_master_code`, `ledger_master_description`, `account_ledger_head_code`, `gl_code`, `sub_ledger_code`, `donor_code`, `ledger_type_code`, `memo`, `amount`, `cheque_no`, `trans_type`, `gl_trans_status`) VALUES
(61, 'CNP099-FY2073/2074-00001', '2073-07-03', '2016-10-19', '0301000101', 'WWF Plantation Grant', '01', '03', '00', '01', '01', 'WWF Neal WN75', 500000, '', 'cr', '1'),
(62, 'CNP099-FY2073/2074-00001', '2073-07-03', '2016-10-19', '0101000000', 'RBB Kawasoti', '01', '01', '00', '00', '00', 'WWF Nepal', 500000, '', 'dr', '1'),
(63, 'CNP099-FY2073/2074-00002', '2073-07-03', '2016-10-19', '0301000102', 'WWF Plantation Community Leverage', '01', '03', '00', '01', '02', 'Bank Deposited Amount', 200000, '', 'cr', '1'),
(64, 'CNP099-FY2073/2074-00002', '2073-07-03', '2016-10-19', '0401000102', 'WWF Plantation Expenses Internal Fund', '01', '04', '00', '01', '02', 'vvvv', 200000, '', 'dr', '1'),
(65, 'CNP099-FY2073/2074-00003', '2073-07-03', '2016-10-19', '0401000101', 'WWF Plantation Expenses', '01', '04', '00', '01', '01', 'cash', 50000, '', 'dr', '1'),
(66, 'CNP099-FY2073/2074-00003', '2073-07-03', '2016-10-19', '0101000000', 'RBB Kawasoti', '01', '01', '00', '00', '00', '0000', -50000, '', 'cr', '1'),
(67, 'CNP099-FY2073/2074-00004', '2073-07-03', '2016-10-19', '0401000101', 'WWF Plantation Expenses', '01', '04', '00', '01', '01', 'Jali', 100000, '', 'dr', '1'),
(68, 'CNP099-FY2073/2074-00004', '2073-07-03', '2016-10-19', '0201000000', 'TDS Payable', '01', '02', '00', '00', '00', '0000', 100000, '', 'cr', '1'),
(69, 'CNP099-FY2073/2074-00005', '2073-07-03', '2016-10-19', '0401000000', 'Plantation Expenses', '01', '04', '00', '00', '00', 'WWF Plantation', 10000, '', 'dr', '1'),
(70, 'CNP099-FY2073/2074-00005', '2073-07-03', '2016-10-19', '0401000103', 'WWF Nepal Plantation Labour Support', '01', '04', '00', '01', '03', 'wwf', -10000, '', 'cr', '1'),
(71, 'CNP099-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0401000101', 'WWF Plantation Expenses', '01', '04', '00', '01', '01', 'Table', 35000, '', 'dr', '1'),
(72, 'CNP099-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0102000001', 'Petty Cash Fund', '02', '01', '00', '00', '01', 'payment', -20000, '', 'cr', '1'),
(73, 'CNP099-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0201000100', 'WWF Plantation Payables', '01', '02', '00', '01', '00', 'payable', 5000, '', 'cr', '1'),
(74, 'CNP099-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0101000000', 'RBB Kawasoti', '01', '01', '00', '00', '00', 'Nabaraj Poudel', -10000, '', 'cr', '1'),
(75, 'CNP099-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0410010000', 'House Rent', '10', '04', '01', '00', '00', 'pmt', 5000, '', 'dr', '1'),
(76, 'CNP099-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0201000000', 'TDS Payable', '01', '02', '00', '00', '00', 'Bakhan Sing', 500, '', 'cr', '1'),
(77, 'CNP099-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0101000000', 'RBB Kawasoti', '01', '01', '00', '00', '00', 'Bakhan', -4500, '', 'cr', '1'),
(78, 'CNP099-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0301000000', 'Bank Interest Income', '01', '03', '00', '00', '00', 'rrr', 1200, '', 'cr', '1'),
(79, 'CNP099-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0101000000', 'RBB Kawasoti', '01', '01', '00', '00', '00', 'fff', 1200, '', 'dr', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledger_master`
--

INSERT INTO `ledger_master` (`id`, `ledger_master_code`, `ledger_master_name`, `account_code`, `ledger_code`, `subledger_code`, `donor_code`, `ledger_type_code`, `status`) VALUES
(34, '0101000000', 'RBB Kawasoti', '01', '01', '00', '00', '00', '1'),
(35, '0301000101', 'WWF Plantation Grant', '03', '01', '00', '01', '01', '1'),
(36, '0301000102', 'WWF Plantation Community Leverage', '03', '01', '00', '01', '02', '1'),
(37, '0401000101', 'WWF Plantation Expenses', '04', '01', '00', '01', '01', '1'),
(38, '0401000102', 'WWF Plantation Expenses Internal Fund', '04', '01', '00', '01', '02', '1'),
(39, '0201000100', 'WWF Plantation Payables', '02', '01', '00', '01', '00', '1'),
(40, '0401000103', 'WWF Nepal Plantation Labour Support', '04', '01', '00', '01', '03', '1'),
(41, '0102000001', 'Petty Cash Fund', '01', '02', '00', '00', '01', '1'),
(42, '0201000000', 'TDS Payable', '02', '01', '00', '00', '00', '1'),
(43, '0301000000', 'Bank Interest Income', '03', '01', '00', '00', '00', '1'),
(44, '0401000000', 'Plantation Expenses', '04', '01', '00', '00', '00', '1'),
(45, '0410010000', 'House Rent', '04', '10', '01', '00', '00', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subledger_info`
--

INSERT INTO `subledger_info` (`id`, `subledger_name`, `subledger_code`, `subledger_status`) VALUES
(16, 'House Rent', '01', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `full_name`, `email_address`, `contact_no`, `password`, `status`, `user_type`, `committee_id`, `committee_code`) VALUES
(11, 'admin', NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', '1', 'administrator', '11', 'CNP099');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `bank_info`
--
ALTER TABLE `bank_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bank_trans_info`
--
ALTER TABLE `bank_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `chart_class`
--
ALTER TABLE `chart_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `committee_info`
--
ALTER TABLE `committee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `donar_info`
--
ALTER TABLE `donar_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fiscal_year_info`
--
ALTER TABLE `fiscal_year_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `gl_trans_comment_details`
--
ALTER TABLE `gl_trans_comment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `gl_trans_info`
--
ALTER TABLE `gl_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `ledger_master`
--
ALTER TABLE `ledger_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `ledger_type_info`
--
ALTER TABLE `ledger_type_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subledger_info`
--
ALTER TABLE `subledger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;