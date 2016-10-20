-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2016 at 02:25 अपराह्न
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
(29, '10', 'Plantation', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `bank_account_code`, `ledger_code`, `account_type`, `bank_account_name`, `bank_name`, `bank_address`, `bank_account_number`, `bank_phone_no`, `last_reconciled_date`, `ending_reconcile_balance`, `status`) VALUES
(6, NULL, '01', NULL, 'Global Bank a/c', NULL, NULL, NULL, NULL, NULL, NULL, '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_trans_info`
--

INSERT INTO `bank_trans_info` (`id`, `type`, `trans_no`, `trans_date`, `tran_date_english`, `ledger_master_code`, `memo`, `amount`, `reconciled`, `bank_id`, `status`) VALUES
(21, 'dr', 'UC-BH-00001-FY2073/2074-00001', '2073-07-03', '2016-10-19', '0101000000', 'Cash Received For Plantation', '500000', NULL, '6', '1'),
(22, 'cr', 'UC-BH-00001-FY2073/2074-00002', '2073-07-03', '2016-10-19', '0101000000', 'j', '-50000', NULL, '6', '1'),
(23, 'cr', 'UC-BH-00001-FY2073/2074-00004', '2073-07-03', '2016-10-19', '0101000000', 'saczsncbk', '-7000', NULL, '6', '1'),
(24, 'cr', 'UC-BH-00001-FY2073/2074-00005', '2073-07-03', '2016-10-19', '0101000000', 'nvmnb,mbn', '-10000', NULL, '6', '1'),
(25, 'cr', 'UC-BH-00001-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0101000000', 'dsfsdfd', '-50000', NULL, '6', '1'),
(26, 'cr', 'UC-BH-00001-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0101000000', 'ZScd', '-20000', NULL, '6', '1'),
(27, 'cr', 'UC-BH-00001-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0101000000', 'FSDF', '-10000', NULL, '6', '1'),
(28, 'cr', 'UC-BH-00001-FY2073/2074-00009', '2073-07-03', '2016-10-19', '0101000000', 'JKGGJHFJK', '-5000', NULL, '6', '1'),
(29, 'dr', 'UC-BH-00001-FY2073/2074-00011', '2073-07-03', '2016-10-19', '0101000000', 'kjhklj', '1200', NULL, '6', '1'),
(30, 'cr', 'UC-BH-00001-FY2073/2074-00013', '2073-07-03', '2016-10-19', '0101000000', 'ajsdgasjdh', '-5000', NULL, '6', '1'),
(31, 'cr', 'UC-BH-00001-FY2073/2074-00014', '2073-07-03', '2016-10-19', '0101000000', 'sdjhasgdjkasd', '-8000', NULL, '6', '1');

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
(11, 'Bharatpur Natural Conservation User Cmmittee', 'Bharatpur-11, Chitwan, Nepal', '056-533977', 'UC-BH-00001', '', 'chitwan_national_park_logo1.gif', '1');

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
(8, 'WWF Nepal', 'Bharatpur, Chitwan', '056-533977', '01', 'bhomnath@salyani.com.np', 'Sushil Poudel(FCA)', '9856027412', '1');

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
(11, '2073/2074', '2073/04/01', '2074/03/30', 'UC-BH-00001', '11', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gl_trans_comment_details`
--

CREATE TABLE IF NOT EXISTS `gl_trans_comment_details` (
  `id` int(11) NOT NULL,
  `trans_no` varchar(255) DEFAULT NULL,
  `detailed_comment` text
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gl_trans_comment_details`
--

INSERT INTO `gl_trans_comment_details` (`id`, `trans_no`, `detailed_comment`) VALUES
(30, 'UC-BH-00001-FY2073/2074-00001', 'Being Cash Deposit into WWF Nepal For Plantation'),
(31, 'UC-BH-00001-FY2073/2074-00002', 'Being Purchase Stone For Plantation'),
(32, 'UC-BH-00001-FY2073/2074-00003', 'Being ansd,mansco;h'),
(33, 'UC-BH-00001-FY2073/2074-00004', 'adafsdgsddsfs'),
(34, 'UC-BH-00001-FY2073/2074-00005', 'akjdhaskfbasifhsapjf'),
(35, 'UC-BH-00001-FY2073/2074-00006', 'fasfas,dn,asnfs'),
(36, 'UC-BH-00001-FY2073/2074-00007', 'ASD ,JSMABD,MASDB'),
(37, 'UC-BH-00001-FY2073/2074-00008', 'SDGSDGDF'),
(38, 'UC-BH-00001-FY2073/2074-00009', 'AKLHDAMSBD,MSAD'),
(39, 'UC-BH-00001-FY2073/2074-00010', 'sasdfsdfsdf'),
(40, 'UC-BH-00001-FY2073/2074-00011', 'sdfsdfd'),
(41, 'UC-BH-00001-FY2073/2074-00012', 'asdasfjafhke'),
(42, 'UC-BH-00001-FY2073/2074-00013', 'jufhgfhjggkj'),
(43, 'UC-BH-00001-FY2073/2074-00014', 'sfasfasffs');

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
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gl_trans_info`
--

INSERT INTO `gl_trans_info` (`id`, `journal_voucher_no`, `tran_date`, `tran_date_english`, `ledger_master_code`, `ledger_master_description`, `account_ledger_head_code`, `gl_code`, `sub_ledger_code`, `donor_code`, `ledger_type_code`, `memo`, `amount`, `cheque_no`, `trans_type`, `gl_trans_status`) VALUES
(61, 'UC-BH-00001-FY2073/2074-00001', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'Cash Received For Plantation', 500000, '', 'dr', '1'),
(62, 'UC-BH-00001-FY2073/2074-00001', '2073-07-03', '2016-10-19', '0310000101', 'Plantation WWF Nepal Cash Account', '10', '03', '00', '01', '01', 'Bank Deposited Amount', 500000, '', 'cr', '1'),
(63, 'UC-BH-00001-FY2073/2074-00002', '2073-07-03', '2016-10-19', '0410010101', 'Plantation Stone Purchase', '10', '04', '01', '01', '01', 'Stone Purchase', 50000, '', 'dr', '1'),
(64, 'UC-BH-00001-FY2073/2074-00002', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'j', -50000, '', 'cr', '1'),
(65, 'UC-BH-00001-FY2073/2074-00003', '2073-07-03', '2016-10-19', '0410020101', 'Plantation WWF Nepal Tar Jali Purchase', '10', '04', '02', '01', '01', 'Tar Jali Purchase', 100000, '', 'dr', '1'),
(66, 'UC-BH-00001-FY2073/2074-00003', '2073-07-03', '2016-10-19', '0210140101', 'WWF Plantation Vendor a/c', '10', '02', '14', '01', '01', 'taabsdkjs', 100000, '', 'cr', '1'),
(67, 'UC-BH-00001-FY2073/2074-00004', '2073-07-03', '2016-10-19', '0410050101', 'Plantation WWF Nepal Staff Tiffin', '10', '04', '05', '01', '01', 'asdasd', 7000, '', 'dr', '1'),
(68, 'UC-BH-00001-FY2073/2074-00004', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'saczsncbk', -7000, '', 'cr', '1'),
(69, 'UC-BH-00001-FY2073/2074-00005', '2073-07-03', '2016-10-19', '0410060101', 'Plantation WWF Nepal Advertisment', '10', '04', '06', '01', '01', 'zdfasgafsfs', 10000, '', 'dr', '1'),
(70, 'UC-BH-00001-FY2073/2074-00005', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'nvmnb,mbn', -10000, '', 'cr', '1'),
(71, 'UC-BH-00001-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0410040101', 'WWF Nepal Plantation Staff Salary', '10', '04', '04', '01', '01', 'saaf,mabf,masfb', 50000, '', 'dr', '1'),
(72, 'UC-BH-00001-FY2073/2074-00006', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'dsfsdfd', -50000, '', 'cr', '1'),
(73, 'UC-BH-00001-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0110130101', 'Plantation WWF Nepal Petty Cash Account', '10', '01', '13', '01', '01', 'bJMxbZMbc', 20000, '', 'dr', '1'),
(74, 'UC-BH-00001-FY2073/2074-00007', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'ZScd', -20000, '', 'cr', '1'),
(75, 'UC-BH-00001-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0110070101', 'WWF Nepal Plantation Office Furniture Purchase', '10', '01', '07', '01', '01', 'ASASFSAD', 35000, '', 'dr', '1'),
(76, 'UC-BH-00001-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0110130101', 'Plantation WWF Nepal Petty Cash Account', '10', '01', '13', '01', '01', 'MBMNB', -20000, '', 'cr', '1'),
(77, 'UC-BH-00001-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0210140101', 'WWF Plantation Vendor a/c', '10', '02', '14', '01', '01', 'SDFSDF', 5000, '', 'cr', '1'),
(78, 'UC-BH-00001-FY2073/2074-00008', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'FSDF', -10000, '', 'cr', '1'),
(79, 'UC-BH-00001-FY2073/2074-00009', '2073-07-03', '2016-10-19', '0410080101', 'WWF Nepal Plantation Office Rent', '10', '04', '08', '01', '01', 'HFHGDHF', 5000, '', 'dr', '1'),
(80, 'UC-BH-00001-FY2073/2074-00009', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'JKGGJHFJK', -5000, '', 'cr', '1'),
(81, 'UC-BH-00001-FY2073/2074-00010', '2073-07-03', '2016-10-19', '0410030101', 'Plantation WWF Nepal Wage Paid', '10', '04', '03', '01', '01', 'zvdjbdkjsa', 10000, '', 'dr', '1'),
(82, 'UC-BH-00001-FY2073/2074-00010', '2073-07-03', '2016-10-19', '0210150101', 'Plantation WWF Nepal O/s Wages', '10', '02', '15', '01', '01', 'xcgdgvf', 10000, '', 'cr', '1'),
(83, 'UC-BH-00001-FY2073/2074-00011', '2073-07-03', '2016-10-19', '0310090101', 'Plantation WWF Nepal Intrest Account', '10', '03', '09', '01', '01', 'hyerdgdf', 1200, '', 'cr', '1'),
(84, 'UC-BH-00001-FY2073/2074-00011', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'kjhklj', 1200, '', 'dr', '1'),
(85, 'UC-BH-00001-FY2073/2074-00012', '2073-07-03', '2016-10-19', '0410100101', 'Plantation WWF Nepal Bamboo Purchase', '10', '04', '10', '01', '01', 'akjdhajsdg', 1800, '', 'dr', '1'),
(86, 'UC-BH-00001-FY2073/2074-00012', '2073-07-03', '2016-10-19', '0210140101', 'WWF Plantation Vendor a/c', '10', '02', '14', '01', '01', 'scsasfsa', 1800, '', 'cr', '1'),
(87, 'UC-BH-00001-FY2073/2074-00013', '2073-07-03', '2016-10-19', '0410110101', 'plantation WWF Nepal Transportation', '10', '04', '11', '01', '01', 'zsdgdfhg', 5000, '', 'dr', '1'),
(88, 'UC-BH-00001-FY2073/2074-00013', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'ajsdgasjdh', -5000, '', 'cr', '1'),
(89, 'UC-BH-00001-FY2073/2074-00014', '2073-07-03', '2016-10-19', '0110120101', 'Plantation WWF Nepal Vechile', '10', '01', '12', '01', '01', 'jsdasdbasdh', 8000, '', 'dr', '1'),
(90, 'UC-BH-00001-FY2073/2074-00014', '2073-07-03', '2016-10-19', '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', 'sdjhasgdjkasd', -8000, '', 'cr', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledger_master`
--

INSERT INTO `ledger_master` (`id`, `ledger_master_code`, `ledger_master_name`, `account_code`, `ledger_code`, `subledger_code`, `donor_code`, `ledger_type_code`, `status`) VALUES
(34, '0101000000', 'Global Bank a/c', '01', '01', '00', '00', '00', '1'),
(35, '0310000101', 'Plantation WWF Nepal Cash Account', '03', '10', '00', '01', '01', '1'),
(36, '0310000102', 'Plantation Area 1 WWF Internal Cash Account', '03', '10', '00', '01', '02', '1'),
(37, '0310000103', 'Plantation WWF Nepal Labour Support', '03', '10', '00', '01', '03', '1'),
(38, '0410010101', 'Plantation Stone Purchase', '04', '10', '01', '01', '01', '1'),
(39, '0410020101', 'Plantation WWF Nepal Tar Jali Purchase', '04', '10', '02', '01', '01', '1'),
(40, '0410050101', 'Plantation WWF Nepal Staff Tiffin', '04', '10', '05', '01', '01', '1'),
(41, '0410060101', 'Plantation WWF Nepal Advertisment', '04', '10', '06', '01', '01', '1'),
(42, '0410040101', 'WWF Nepal Plantation Staff Salary', '04', '10', '04', '01', '01', '1'),
(43, '0110130101', 'Plantation WWF Nepal Petty Cash Account', '01', '10', '13', '01', '01', '1'),
(44, '0110070101', 'WWF Nepal Plantation Office Furniture Purchase', '01', '10', '07', '01', '01', '1'),
(45, '0210140101', 'WWF Plantation Vendor a/c', '02', '10', '14', '01', '01', '1'),
(46, '0410080101', 'WWF Nepal Plantation Office Rent', '04', '10', '08', '01', '01', '1'),
(47, '0210150101', 'Plantation WWF Nepal O/s Wages', '02', '10', '15', '01', '01', '1'),
(48, '0310090101', 'Plantation WWF Nepal Intrest Account', '03', '10', '09', '01', '01', '1'),
(49, '0410100101', 'Plantation WWF Nepal Bamboo Purchase', '04', '10', '10', '01', '01', '1'),
(50, '0410110101', 'plantation WWF Nepal Transportation', '04', '10', '11', '01', '01', '1'),
(51, '0110120101', 'Plantation WWF Nepal Vechile', '01', '10', '12', '01', '01', '1'),
(52, '0410030101', 'Plantation WWF Nepal Wage Paid', '04', '10', '03', '01', '01', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subledger_info`
--

INSERT INTO `subledger_info` (`id`, `subledger_name`, `subledger_code`, `subledger_status`) VALUES
(16, 'Stone', '01', '1'),
(17, 'Tar Jali', '02', '1'),
(18, 'Labour Wage', '03', '1'),
(19, 'Staff Salary', '04', '1'),
(20, 'Staff Tiffin', '05', '1'),
(21, 'Advertismnt', '06', '1'),
(22, 'Office Furniture', '07', '1'),
(23, 'Office Rent', '08', '1'),
(24, 'Bank Intrest (Income)', '09', '1'),
(25, 'Bamboo & Sac', '10', '1'),
(26, 'Transportation', '11', '1'),
(27, 'Vechile (Bicycle)', '12', '1'),
(28, 'Petty Cash', '13', '1'),
(29, 'Vendor A/c', '14', '1'),
(30, 'O/s Wage', '15', '1');

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
(11, 'admin', NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', '1', 'administrator', '11', 'UC-BH-00001');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bank_trans_info`
--
ALTER TABLE `bank_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `gl_trans_info`
--
ALTER TABLE `gl_trans_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `ledger_master`
--
ALTER TABLE `ledger_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `ledger_type_info`
--
ALTER TABLE `ledger_type_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `subledger_info`
--
ALTER TABLE `subledger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
