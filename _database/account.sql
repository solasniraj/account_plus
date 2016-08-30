-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2016 at 01:13 PM
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
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(50) NOT NULL,
  `bank_phone_no` varchar(20) DEFAULT NULL,
  `committee_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank_info`
--

INSERT INTO `bank_info` (`id`, `bank_name`, `bank_address`, `bank_account_number`, `bank_phone_no`, `committee_id`, `user_id`, `status`) VALUES
(1, 'Himalayan Bank Limited', 'Narayangarh, Chitwan', '98452141409845214140', '056-533977', NULL, NULL, 'Active');

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
(1, NULL, 'Assets', 'Active', NULL),
(2, NULL, 'Liabilities', 'Active', NULL),
(3, NULL, 'Income', 'Active', NULL),
(4, NULL, 'Costs', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chart_master`
--

CREATE TABLE IF NOT EXISTS `chart_master` (
  `id` int(11) NOT NULL,
  `account_code` varchar(50) DEFAULT NULL,
  `account_code2` varchar(50) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `chart_type_id` varchar(100) DEFAULT NULL,
  `account_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_master`
--

INSERT INTO `chart_master` (`id`, `account_code`, `account_code2`, `account_name`, `chart_type_id`, `account_status`) VALUES
(1, '1060', '', 'Checking Account', '1', '0'),
(2, '1065', '', 'Petty Cash', '1', '0'),
(3, '1200', '', 'Accounts Receivables', '1', '0'),
(4, '1205', '', 'Allowance for doubtful accounts', '1', '0'),
(5, '1510', '', 'Inventory', '2', '0'),
(6, '1520', '', 'Stocks of Raw Materials', '2', '0'),
(7, '1530', '', 'Stocks of Work In Progress', '2', '0'),
(8, '1540', '', 'Stocks of Finsihed Goods', '2', '0'),
(9, '1550', '', 'Goods Received Clearing account', '2', '0'),
(10, '1820', '', 'Office Furniture &amp; Equipment', '3', '0'),
(11, '1825', '', 'Accum. Amort. -Furn. &amp; Equip.', '3', '0'),
(12, '1840', '', 'Vehicle', '3', '0'),
(13, '1845', '', 'Accum. Amort. -Vehicle', '3', '0'),
(14, '2100', '', 'Accounts Payable', '4', '0'),
(15, '2110', '', 'Accrued Income Tax - Federal', '4', '0'),
(16, '2120', '', 'Accrued Income Tax - State', '4', '0'),
(17, '2130', '', 'Accrued Franchise Tax', '4', '0'),
(18, '2140', '', 'Accrued Real &amp; Personal Prop Tax', '4', '0'),
(19, '2150', '', 'Sales Tax', '4', '0'),
(20, '2160', '', 'Accrued Use Tax Payable', '4', '0'),
(21, '2210', '', 'Accrued Wages', '4', '0'),
(22, '2220', '', 'Accrued Comp Time', '4', '0'),
(23, '2230', '', 'Accrued Holiday Pay', '4', '0'),
(24, '2240', '', 'Accrued Vacation Pay', '4', '0'),
(25, '2310', '', 'Accr. Benefits - 401K', '4', '0'),
(26, '2320', '', 'Accr. Benefits - Stock Purchase', '4', '0'),
(27, '2330', '', 'Accr. Benefits - Med, Den', '4', '0'),
(28, '2340', '', 'Accr. Benefits - Payroll Taxes', '4', '0'),
(29, '2350', '', 'Accr. Benefits - Credit Union', '4', '0'),
(30, '2360', '', 'Accr. Benefits - Savings Bond', '4', '0'),
(31, '2370', '', 'Accr. Benefits - Garnish', '4', '0'),
(32, '2380', '', 'Accr. Benefits - Charity Cont.', '4', '0'),
(33, '2620', '', 'Bank Loans', '5', '0'),
(34, '2680', '', 'Loans from Shareholders', '5', '0'),
(35, '3350', '', 'Common Shares', '6', '0'),
(36, '3590', '', 'Retained Earnings - prior years', '7', '0'),
(37, '4010', '', 'Sales', '8', '0'),
(38, '4430', '', 'Shipping &amp; Handling', '9', '0'),
(39, '4440', '', 'Interest', '9', '0'),
(40, '4450', '', 'Foreign Exchange Gain', '9', '0'),
(41, '4500', '', 'Prompt Payment Discounts', '9', '0'),
(42, '4510', '', 'Discounts Given', '9', '0'),
(43, '5010', '', 'Cost of Goods Sold - Retail', '10', '0'),
(44, '5020', '', 'Material Usage Varaiance', '10', '0'),
(45, '5030', '', 'Consumable Materials', '10', '0'),
(46, '5040', '', 'Purchase price Variance', '10', '0'),
(47, '5050', '', 'Purchases of materials', '10', '0'),
(48, '5060', '', 'Discounts Received', '10', '0'),
(49, '5100', '', 'Freight', '10', '0'),
(50, '5410', '', 'Wages &amp; Salaries', '11', '0'),
(51, '5420', '', 'Wages - Overtime', '11', '0'),
(52, '5430', '', 'Benefits - Comp Time', '11', '0'),
(53, '5440', '', 'Benefits - Payroll Taxes', '11', '0'),
(54, '5450', '', 'Benefits - Workers Comp', '11', '0'),
(55, '5460', '', 'Benefits - Pension', '11', '0'),
(56, '5470', '', 'Benefits - General Benefits', '11', '0'),
(57, '5510', '', 'Inc Tax Exp - Federal', '11', '0'),
(58, '5520', '', 'Inc Tax Exp - State', '11', '0'),
(59, '5530', '', 'Taxes - Real Estate', '11', '0'),
(60, '5540', '', 'Taxes - Personal Property', '11', '0'),
(61, '5550', '', 'Taxes - Franchise', '11', '0'),
(62, '5560', '', 'Taxes - Foreign Withholding', '11', '0'),
(63, '5610', '', 'Accounting &amp; Legal', '12', '0'),
(64, '5615', '', 'Advertising &amp; Promotions', '12', '0'),
(65, '5620', '', 'Bad Debts', '12', '0'),
(66, '5660', '', 'Amortization Expense', '12', '0'),
(67, '5685', '', 'Insurance', '12', '0'),
(68, '5690', '', 'Interest &amp; Bank Charges', '12', '0'),
(69, '5700', '', 'Office Supplies', '12', '0'),
(70, '5760', '', 'Rent', '12', '0'),
(71, '5765', '', 'Repair &amp; Maintenance', '12', '0'),
(72, '5780', '', 'Telephone', '12', '0'),
(73, '5785', '', 'Travel &amp; Entertainment', '12', '0'),
(74, '5790', '', 'Utilities', '12', '0'),
(75, '5795', '', 'Registrations', '12', '0'),
(76, '5800', '', 'Licenses', '12', '0'),
(77, '5810', '', 'Foreign Exchange Loss', '12', '0'),
(78, '9990', '', 'Year Profit/Loss', '12', '0');

-- --------------------------------------------------------

--
-- Table structure for table `chart_types`
--

CREATE TABLE IF NOT EXISTS `chart_types` (
  `id` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `chart_class_id` varchar(3) NOT NULL DEFAULT '',
  `parent` varchar(10) NOT NULL DEFAULT '-1',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chart_types`
--

INSERT INTO `chart_types` (`id`, `name`, `chart_class_id`, `parent`, `status`) VALUES
('1', 'Current Assets', '1', '', 0),
('2', 'Inventory Assets', '1', '', 0),
('3', 'Capital Assets', '1', '', 0),
('4', 'Current Liabilities', '2', '', 0),
('5', 'Long Term Liabilities', '2', '', 0),
('6', 'Share Capital', '2', '', 0),
('7', 'Retained Earnings', '2', '', 0),
('8', 'Sales Revenue', '3', '', 0),
('9', 'Other Revenue', '3', '', 0),
('10', 'Cost of Goods Sold', '4', '', 0),
('11', 'Payroll Expenses', '4', '', 0),
('12', 'General &amp; Administrative expenses', '4', '', 0);

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
-- Table structure for table `ledger_info`
--

CREATE TABLE IF NOT EXISTS `ledger_info` (
  `id` int(11) NOT NULL,
  `ledger_name` varchar(255) DEFAULT NULL,
  `ledger_code` varchar(255) DEFAULT NULL,
  `committee_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `ledger_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledger_info`
--

INSERT INTO `ledger_info` (`id`, `ledger_name`, `ledger_code`, `committee_id`, `user_id`, `ledger_status`) VALUES
(1, 'asdf', NULL, NULL, NULL, 'Active');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programs_list`
--

INSERT INTO `programs_list` (`id`, `code`, `program_name`, `user_id`, `status`, `committee_id`, `subledger_id`, `fiscal_year`) VALUES
(7, '345', 'Plantation', 1, NULL, NULL, NULL, NULL),
(8, '345', 'Fencing', 1, NULL, NULL, NULL, NULL),
(9, '345', 'sanoj', 1, NULL, NULL, '1<##>2', NULL);

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
-- Indexes for table `chart_types`
--
ALTER TABLE `chart_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `chart_class_id` (`chart_class_id`);

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
-- Indexes for table `ledger_info`
--
ALTER TABLE `ledger_info`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `ledger_info`
--
ALTER TABLE `ledger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `programs_list`
--
ALTER TABLE `programs_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
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
