-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2016 at 10:18 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maynardl_sixerdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `itf_assign_date`
--

CREATE TABLE IF NOT EXISTS `itf_assign_date` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `diagnose_id` bigint(255) NOT NULL,
  `manager_id` bigint(25) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) NOT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `tstartdatetime` bigint(20) NOT NULL,
  `tenddatetime` bigint(20) NOT NULL,
  `order_type` enum('1','2','3','4') NOT NULL COMMENT '1=>DIAGNOSE, 2=>Design, 3=>Delivery, 4=> Discovery',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `del_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `itf_assign_date`
--

INSERT INTO `itf_assign_date` (`id`, `order_id`, `diagnose_id`, `manager_id`, `start_date`, `start_time`, `end_date`, `end_time`, `tstartdatetime`, `tenddatetime`, `order_type`, `entry_date`, `comment`, `status`, `del_status`) VALUES
(1, 76, 22, 173, '11/30/2016', '9:30 AM', '11/30/2016', '4:30 PM', 1480478400, 1480503600, '1', '2016-11-29 07:29:15', NULL, 0, 1),
(2, 76, 22, 178, '11/30/2016', '9:30 AM', '11/30/2016', '4:30 PM', 1480478400, 1480503600, '1', '2016-11-29 08:15:35', NULL, 0, 0),
(3, 68, 39, 119, '12/01/2016', '9:30 AM', '12/02/2016', '5:30 PM', 1480564800, 1480680000, '3', '2016-11-29 09:02:51', NULL, 1, 1),
(5, 68, 39, 121, '12/01/2016', '9:30 AM', '12/02/2016', '5:30 PM', 1480564800, 1480680000, '3', '2016-11-29 09:04:10', NULL, 0, 1),
(6, 68, 39, 172, '12/01/2016', '9:30 AM', '12/02/2016', '5:30 PM', 1480564800, 1480680000, '3', '2016-11-29 09:04:40', NULL, 0, 1),
(7, 69, 40, 119, '12/08/2016', '9:30 AM', '12/09/2016', '5:30 PM', 1481169600, 1481284800, '3', '2016-11-29 09:37:21', NULL, 1, 1),
(8, 73, 44, 178, '12/02/2016', '2:00 PM', '12/02/2016', '4:00 PM', 1480667400, 1480674600, '3', '2016-11-29 11:34:31', NULL, 0, 0),
(9, 74, 45, 174, '12/07/2016', '9:30 AM', '12/08/2016', '5:30 PM', 1481083200, 1481198400, '3', '2016-11-30 07:08:25', NULL, 1, 0),
(10, 72, 43, 174, '12/14/2016', '9:00 AM', '12/14/2016', '11:00 AM', 1481686200, 1481693400, '3', '2016-11-30 07:24:43', NULL, 1, 0),
(11, 76, 49, 120, '12/16/2016', '9:30 AM', '12/17/2016', '5:30 PM', 1481860800, 1481976000, '3', '2016-11-30 07:29:04', NULL, 0, 0),
(12, 76, 49, 176, '12/16/2016', '9:30 AM', '12/17/2016', '5:30 PM', 1481860800, 1481976000, '3', '2016-11-30 07:29:40', NULL, 0, 0),
(13, 69, 40, 120, '12/08/2016', '9:30 AM', '12/09/2016', '5:30 PM', 1481169600, 1481284800, '3', '2016-11-30 07:50:26', NULL, 0, 0),
(14, 69, 40, 121, '12/08/2016', '9:30 AM', '12/09/2016', '5:30 PM', 1481169600, 1481284800, '3', '2016-11-30 07:51:14', NULL, 0, 0),
(17, 68, 39, 120, '12/01/2016', '9:00 AM', '12/02/2016', '6:00 PM', 1480563000, 1480681800, '3', '2016-11-30 07:54:32', NULL, 0, 0),
(20, 70, 41, 172, '12/15/2016', '9:00 AM', '12/16/2016', '6:00 PM', 1481772600, 1481891400, '3', '2016-11-30 08:23:03', NULL, 0, 0),
(21, 70, 41, 178, '12/15/2016', '9:00 AM', '12/16/2016', '6:00 PM', 1481772600, 1481891400, '3', '2016-11-30 08:23:24', NULL, 0, 0),
(22, 69, 40, 178, '12/08/2016', '9:00 AM', '12/09/2016', '6:00 PM', 1481167800, 1481286600, '3', '2016-11-30 08:25:22', NULL, 0, 0),
(23, 70, 41, 121, '12/15/2016', '9:30 AM', '12/16/2016', '5:30 PM', 1481774400, 1481889600, '3', '2016-11-30 08:35:56', NULL, 0, 0),
(24, 72, 43, 0, '12/14/2016', '10:30 AM', '12/14/2016', '12:00 PM', 1481691600, 1481697000, '3', '2016-11-30 10:31:54', NULL, 0, 0),
(25, 71, 51, 142, '12/15/2016', '9:30 AM', '12/16/2016', '5:30 PM', 1481774400, 1481889600, '3', '2016-12-01 03:49:42', NULL, 0, 0),
(26, 71, 51, 142, '01/11/2017', '9:30 AM', '01/12/2017', '5:30 PM', 1484107200, 1484222400, '3', '2016-12-01 03:54:29', NULL, 0, 0),
(27, 77, 48, 174, '12/01/2016', '9:30 AM', '12/02/2016', '5:30 PM', 1480564800, 1480680000, '3', '2016-12-01 04:41:54', NULL, 0, 0),
(28, 77, 48, 174, '12/15/2016', '9:30 AM', '12/16/2016', '5:30 PM', 1481774400, 1481889600, '3', '2016-12-01 04:42:40', NULL, 0, 0),
(30, 75, 46, 178, '12/05/2016', '9:30 AM', '12/05/2016', '6:30 PM', 1480910400, 1480942800, '3', '2016-12-01 04:49:47', NULL, 0, 0),
(31, 78, 52, 120, '12/22/2016', '9:30 AM', '12/23/2016', '5:30 PM', 1482379200, 1482494400, '3', '2016-12-01 08:25:37', NULL, 0, 0),
(32, 78, 52, 121, '12/22/2016', '9:30 AM', '12/23/2016', '5:30 PM', 1482379200, 1482494400, '3', '2016-12-01 08:26:11', NULL, 0, 0),
(33, 79, 53, 120, '12/05/2016', '10:00 AM', '12/05/2016', '5:00 PM', 1480912200, 1480937400, '3', '2016-12-01 08:34:18', NULL, 0, 1),
(34, 79, 53, 120, '12/07/2016', '9:30 AM', '12/07/2016', '12:30 PM', 1481083200, 1481094000, '3', '2016-12-01 08:49:42', NULL, 0, 1),
(35, 79, 53, 121, '12/06/2016', '10:00 AM', '12/06/2016', '5:30 PM', 1480998600, 1481025600, '3', '2016-12-01 10:21:12', NULL, 0, 0),
(36, 79, 53, 121, '12/07/2016', '9:30 AM', '12/07/2016', '2:20 PM', 1481083200, 1481100600, '3', '2016-12-01 10:22:33', NULL, 0, 0),
(37, 80, 58, 120, '01/24/2017', '9:00 AM', '01/24/2017', '1:00 PM', 1485228600, 1485243000, '3', '2016-12-01 11:20:42', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itf_category`
--

CREATE TABLE IF NOT EXISTS `itf_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `seo_url` varchar(255) NOT NULL,
  `orders` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `itf_category`
--

INSERT INTO `itf_category` (`id`, `name`, `seo_url`, `orders`, `status`, `entry_date`) VALUES
(1, 'System', 'system', 2, 1, '2015-08-15 05:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `itf_clients`
--

CREATE TABLE IF NOT EXISTS `itf_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contact_No` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `itf_clients`
--

INSERT INTO `itf_clients` (`id`, `name`, `address`, `active`, `entry_time`, `contact_No`) VALUES
(1, 'sonu', 'noida', 1, '2016-07-01 06:36:36', '8765676565'),
(2, 'sonia', 'ghaziabad', 1, '2016-07-01 06:37:07', '8767675454'),
(3, 'Roshan', 'Delhi', 1, '2016-07-01 06:38:08', '9878675490');

-- --------------------------------------------------------

--
-- Table structure for table `itf_contact_detail`
--

CREATE TABLE IF NOT EXISTS `itf_contact_detail` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(25) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `country` varchar(255) NOT NULL,
  `home_phone` varchar(15) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `work_email` varchar(255) NOT NULL,
  `other_email` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `itf_contact_detail`
--

INSERT INTO `itf_contact_detail` (`id`, `user_id`, `address1`, `address2`, `city`, `state`, `zipcode`, `country`, `home_phone`, `mobile`, `work_email`, `other_email`, `entry_date`) VALUES
(1, 9, 'Patna', 'Nagar', 'delhi', 'delhi', '11006', 'india', '980990999', '99009', '', '', '2015-12-20 11:02:22'),
(2, 10, 'A 188a', 'New Ashok Nagar New ', 'New delhi', 'Delhi', '110096', 'IndIA', '9015380652', '9015380652', 'raj@itfosters.com', 'codeofdata@gmail.com', '2015-12-20 11:12:41'),
(3, 5, 'Birganj', 'Ashok Nagar', 'Birganj', 'New Delhi', '110096', 'India', '9015380652', '8470965387', 'deepak@itfosters.com', '91dktiwari@gmail.com', '2015-12-21 07:52:31'),
(4, 11, 'ward no.5', 'Ramnagari-5 parsa', 'birgunj parsa', 'city birgunj', '11006', 'Nepal', '9817226735', '9809218441', 'itf.sahani@gmail.com', 'anilkumarsahani101914520', '2015-12-21 08:00:26'),
(5, 4, '', '', '', '', '', '', '', '', '', '', '2015-12-21 15:44:07'),
(6, 3, '', '', 'New Delhi', 'Delhi', '', 'India', '', '8447970860', 'itf.anita@gmail.com', 'neetusingh1990@hotmail.com', '2015-12-21 15:44:36'),
(7, 4, '', '', '', '', '', '', '', '', '', '', '2015-12-21 15:45:37'),
(8, 18, '', '', '', '', '', '', '', '', '', '', '2015-12-21 15:46:54'),
(9, 12, '', '', '', '', '', '', '', '', '', '', '2015-12-22 12:19:35'),
(10, 2, '', '', '', '', '', '', '', '', '', '', '2015-12-22 12:49:54'),
(11, 14, '', '', '', '', '', '', '', '', '', '', '2015-12-22 12:50:55'),
(12, 19, '', '', '', '', '', '', '', '', '', '', '2015-12-22 13:02:20'),
(13, 17, '', '', '', '', '', '', '', '', '', '', '2015-12-22 13:03:23'),
(14, 6, '', '', '', '', '', '', '', '', '', '', '2015-12-22 13:04:05'),
(15, 15, '', '', '', '', '', '', '', '', '', '', '2015-12-22 13:07:20'),
(16, 7, '', '', '', '', '', '', '', '', '', '', '2015-12-22 13:10:27'),
(17, 16, '', '', '', '', '', '', '', '', '', '', '2015-12-22 13:11:18'),
(18, 20, '', '', '', '', '', '', '', '', '', '', '2016-01-16 03:36:32'),
(19, 21, 'ward no 5', 'at-baliyari', 'garhwa', 'jharkhand', '822114', 'india', '9162119492', '9871470845', 'itf.mrityunjay@gmail.com', 'mrityunjay6897@gmail.com', '2016-01-16 03:43:27'),
(20, 22, '', '', '', '', '', '', '', '', '', '', '2016-01-16 04:47:15'),
(21, 23, '', '', '', '', '', '', '', '9990812351', '', '', '2016-04-28 00:24:52'),
(22, 8, '', '', '', '', '', '', '', '', '', '', '2016-05-11 08:38:03');

-- --------------------------------------------------------

--
-- Stand-in structure for view `itf_delivery_status`
--
CREATE TABLE IF NOT EXISTS `itf_delivery_status` (
`order_id` int(11)
,`diagnose_id` bigint(255)
,`status` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `itf_design_status`
--
CREATE TABLE IF NOT EXISTS `itf_design_status` (
`order_id` int(11)
,`diagnose_id` bigint(255)
,`status` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `itf_diagnose_status`
--
CREATE TABLE IF NOT EXISTS `itf_diagnose_status` (
`order_id` int(11)
,`diagnose_id` bigint(255)
,`status` text
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `itf_discovery_status`
--
CREATE TABLE IF NOT EXISTS `itf_discovery_status` (
`order_id` int(11)
,`diagnose_id` bigint(255)
,`status` text
);
-- --------------------------------------------------------

--
-- Table structure for table `itf_jobs`
--

CREATE TABLE IF NOT EXISTS `itf_jobs` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(25) DEFAULT NULL,
  `job_type_id` bigint(25) NOT NULL,
  `job_category_id` bigint(25) DEFAULT NULL,
  `join_date` varchar(255) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `contract_start_date` varchar(255) DEFAULT NULL,
  `contract_end_date` varchar(255) DEFAULT NULL,
  `contract_detail` text,
  `salary` varchar(255) DEFAULT NULL,
  `emp_status` tinyint(1) NOT NULL DEFAULT '1',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `itf_jobs`
--

INSERT INTO `itf_jobs` (`id`, `user_id`, `job_type_id`, `job_category_id`, `join_date`, `location_id`, `contract_start_date`, `contract_end_date`, `contract_detail`, `salary`, `emp_status`, `entry_date`) VALUES
(1, 9, 1, 1, '', 1, '', '', '', '50000', 1, '2015-12-21 14:33:26'),
(3, 3, 3, 1, '10-10-2014', 1, '10/10/2014', '', '', '7000', 0, '2015-12-21 15:44:36'),
(6, 4, 2, 1, '23-04-2015', 1, '', '', '', '9000', 1, '2015-12-21 15:53:57'),
(7, 10, 2, 1, '21-12-2013', 1, '', '', '', '0', 1, '2015-12-22 11:48:02'),
(8, 12, 3, 1, '', 1, '', '', '', '0', 1, '2015-12-22 12:19:35'),
(9, 2, 2, 1, '10-10-2014', 2, '', '', '', '300', 1, '2015-12-22 12:49:54'),
(10, 14, 2, 1, '10-10-2014', 1, '', '', '', '3000', 1, '2015-12-22 12:50:55'),
(11, 5, 1, 1, '10-10-2014', 1, '01/08/2014', '', '8470965387', '10000', 1, '2015-12-22 13:01:32'),
(12, 19, 7, 1, '10-10-2014', 1, '', '', '', '5000', 1, '2015-12-22 13:02:20'),
(13, 17, 3, 1, '10-10-2015', 1, '', '', '', 'Training', 0, '2015-12-22 13:03:23'),
(14, 6, 7, 1, '10-10-2014', 1, '', '', '', 'Training', 1, '2015-12-22 13:04:05'),
(15, 18, 2, 1, '1-12-2015', 1, '18-11-2015', '31-11-2015', 'Training', '7000', 1, '2015-12-22 13:06:30'),
(16, 15, 2, 1, '06-06-2015', 2, '06-06-2015', '06-11-2015', 'Training', 'Training', 2, '2015-12-22 13:07:20'),
(17, 11, 3, 1, '06-12-2015', 1, '06-12-2015', '06-06-2016', 'Training', 'Training', 1, '2015-12-22 13:09:10'),
(18, 7, 2, 1, '01-08-15', 1, '01-08-15', '31-11-2015', 'Training ', '3000', 1, '2015-12-22 13:10:27'),
(19, 16, 2, 1, '01-09-2015', 1, '01-09-2015', '31-01-2016', 'Training', 'Training', 1, '2015-12-22 13:11:18'),
(20, 20, 2, 1, '31/12/2015', 1, '31/12/2015', '31/03/2016', 'Training', 'Training', 1, '2016-01-16 03:36:33'),
(21, 21, 2, 1, '15-01-2016', 1, '15-01-2016', '15-04-2016', 'Training', 'Training', 1, '2016-01-16 03:43:27'),
(22, 22, 3, 1, '15-01-2016', 1, '15-01-2016', '15-04-2016', 'Training', 'Training', 1, '2016-01-16 04:47:15'),
(23, 23, 7, 6, '', 2, '', '', '', '', 0, '2016-04-28 00:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `itf_job_category`
--

CREATE TABLE IF NOT EXISTS `itf_job_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `itf_job_category`
--

INSERT INTO `itf_job_category` (`id`, `name`, `description`, `status`, `entry_date`) VALUES
(1, 'Technical', NULL, 1, '2015-12-22 11:29:34'),
(4, 'Worker', NULL, 1, '2015-12-22 13:56:55'),
(5, 'Technician', NULL, 1, '2015-12-22 13:57:06'),
(6, 'Office Boy', NULL, 1, '2015-12-22 13:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `itf_job_types`
--

CREATE TABLE IF NOT EXISTS `itf_job_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `itf_job_types`
--

INSERT INTO `itf_job_types` (`id`, `name`, `description`, `status`, `entry_date`) VALUES
(1, 'Hr', NULL, 1, '2015-12-21 10:01:10'),
(2, 'Developer', NULL, 1, '2015-12-21 10:01:16'),
(3, 'Designer', NULL, 1, '2015-12-21 10:04:08'),
(4, 'SEO', NULL, 1, '2015-12-21 10:04:22'),
(5, 'Tester', NULL, 1, '2015-12-21 10:04:47'),
(6, 'Training', NULL, 1, '2015-12-21 10:05:23'),
(7, 'Accountant', NULL, 1, '2015-12-22 13:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `itf_location`
--

CREATE TABLE IF NOT EXISTS `itf_location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `itf_location`
--

INSERT INTO `itf_location` (`id`, `name`, `city`, `state`, `pincode`, `phone`, `address`, `status`, `entry_date`) VALUES
(1, 'IT Fosters Web Solutions Pvt. Ltd (Main Branch)', 'New Delhi', 'New Delhi', '110096', '9717807162', 'A-188a New Ashok Nagar New delhi, Near pal Optical, New Delhi ', 1, '2015-12-22 11:35:23'),
(2, 'IT Fosters Branch', 'Patna', 'Bihar', '800006', '9717807162', 'Kadam kua Patna', 1, '2015-12-22 12:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `itf_mailers`
--

CREATE TABLE IF NOT EXISTS `itf_mailers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mailbody` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `orders` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `itf_mailers`
--

INSERT INTO `itf_mailers` (`id`, `title`, `subject`, `mailbody`, `entry_date`, `status`, `orders`) VALUES
(1, 'Congrutualtion for adverd', 'Congrutualtion for adverd', '<p>Hi {NAME},</p>\r\n\r\n<p>Have a great day.</p>\r\n\r\n<p>Test message sent on your register email:{EMAIL}</p>\r\n', '2015-08-15 04:04:24', 1, ''),
(2, 'Good Morning', 'Today', '<p>Hi {NAME},</p>\r\n\r\n<p>Have a great day.</p>\r\n\r\n<p>Test message sent on your register email:{EMAIL}</p>\r\n', '2015-08-15 04:04:26', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `itf_mails`
--

CREATE TABLE IF NOT EXISTS `itf_mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mailtitle` varchar(255) NOT NULL,
  `mailsubject` varchar(255) NOT NULL,
  `fromname` varchar(255) NOT NULL,
  `mailbody` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `itf_mails`
--

INSERT INTO `itf_mails` (`id`, `mailtitle`, `mailsubject`, `fromname`, `mailbody`, `status`) VALUES
(1, 'Admin Password Reset', 'Admin Password Reset', 'Admin Canvas Art', '<p>Hi Administrator,</p>\n\n<p>Username: {USERNAME}</p>\n\n<p>Password: {PASSWORD}</p>\n', 1),
(2, 'Contact Us', 'Contact Us', 'Apna Bihar Team', '<table width="523">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><b>Contact Us</b></p>\r\n\r\n			<p>Hi <strong>{NAME}</strong>,</p>\r\n\r\n			<p>Thank you contact us. We will contact you as soon as possible.</p>\r\n\r\n			<p>&nbsp;</p>\r\n\r\n			<p>These are following detail:</p>\r\n\r\n			<p>Email Address : {EMAIL}</p>\r\n\r\n			<p>Phone : {WEBSITE}</p>\r\n\r\n			<p>Comment : {MESSAGE}</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 1),
(3, 'Date Assign', 'Date Assigned by MLA', 'Maynardleigh', '<p>Hi <strong>{NAME}</strong>,</p>\n\n<p>You have been casted for following mentioned workshop:</p>\n\n<p>Client : {CLIENT}</p>\n\n<p>Job : {JOB}</p>\n\n<p>Sub-product : {SUBPRODUCT}</p>\n\n<p>Date: {DATE}</p>\n\n<p>Time: {TIME}</p>\n\n<p>Location: {LOCATION}</p>\n\n<p>Please confirm us your availability at the login panel.&nbsp;<a href="{LINK}">Click Here</a></p>\n', 1),
(4, 'Thank Contact Us', 'Canvas Art Contact', 'itfosters@gmail.com', '<p>Hi Admin</p>\r\n\r\n<p>There are following detail of user<br />\r\nName : {NAME}<br />\r\nEmail : {EMAIL}<br />\r\nWebsite : {WEBSITE}<br />\r\nMessage : {MESSAGE}</p>\r\n', 1),
(5, 'Contract Email', 'Commercial Contract / Maynardleigh', 'Maynardleigh', '<p>Dear {NAME}</p>\n\n<p>Hope you are doing Great!</p>\n\n<p>We acknowledge your order for our services. This is in reference to the commercial contract for the workshops booked with us.</p>\n\n<p>Request you to please click the link below to accept the commercials.</p>\n\n<p><a href="{LINK}">Link</a></p>\n\n<p>&nbsp;</p>\n', 0),
(20, 'Added as New Resource', 'Your account Created as a Resourse to MLA', 'Maynardleigh', '<p>Hi {NAME}</p>\n\n<p>Sixer has requested you to be a Resource with Maynardleigh.</p>\n\n<p>&nbsp;</p>\n\n<p>These are following details:</p>\n\n<p>User Name : {USERNAME}</p>\n\n<p>Password : {PASSWORD}</p>\n\n<p>Please login at <a href="{LINK}">Login</a></p>\n\n<p>You can change your password from your profile section in website.</p>\n\n<p>&nbsp;</p>\n', 1),
(21, 'Request Accepted', 'Request Accepted', 'Maynardleigh', '<p>Dear {NAME}</p>\n\n<p>We acknowledge your order for accepted.</p>\n\n<p>&nbsp;</p>\n', 0),
(22, 'Leaders Report', 'Leaders Report', 'Maynardleigh', '<p>&nbsp;</p>\n\n<h2>Leaders&nbsp;Report</h2>\n\n<h3>&nbsp;</h3>\n\n<h3>Client Name: {CLIENTNAME}</h3>\n\n<p>Job Name:{JOBNAME}</p>\n\n<p>Program Date: {PROGRAMDATE}</p>\n\n<p>Participants Briefed: {PARTICIPANTS_BRIEFED}</p>\n\n<p>Learning Community: {LEARNING_COMMUNITY}</p>\n\n<p>Target Date: {LEARNING}</p>\n\n<p>Feedback: {FEEDBACK}</p>\n\n<p>Target Date: {FEEDBACK_COMENT}</p>\n\n<p>Do it now cards: {NOW_CARDS}</p>\n\n<p>Target Date: {NEWCARDS}</p>\n\n<p>Trust Contract: {TRUSTCONTRACT}</p>\n\n<p>Target Date: {TRUST}</p>\n\n<p>Workshop pictures: {WORKSHOP_PICTURES}</p>\n\n<p>Target Date: {WORKSHOP}</p>\n\n<p>Books: {BOOK_DATA}</p>\n\n<p>Target Date: {BOOK}</p>\n\n<p>Any Others : {ANY_OTHERS}</p>\n\n<p>Target Date: {ANYOTHERS}</p>\n\n<p>ProgressIT: {PROGRESS_IT}</p>\n\n<p>Target Date: {PROGRESSIT}</p>\n\n<p>Logistics Rating: {OPTION_VALUE}</p>\n\n<p>CANI: {CANI}</p>\n\n<p>What could go better?: {GOBETTER}</p>\n\n<p>Additional Comments: {ADDITIONAL}</p>\n\n<p>Training Materials Given: {TRAINING}</p>\n\n<p>1. Books: {BOOKS}</p>\n\n<p>2. Cards: {CARDS}</p>\n\n<p>Future Business Development: {BUSINESS}</p>\n\n<p>&nbsp;</p>\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itf_membershipdetail`
--

CREATE TABLE IF NOT EXISTS `itf_membershipdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `valid_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `itf_membershipdetail`
--

INSERT INTO `itf_membershipdetail` (`id`, `user_id`, `name`, `detail`, `start_date`, `valid_date`) VALUES
(29, 58, 'Airtel', '2345678', NULL, NULL),
(30, 58, 'Vodafone', '89765432', NULL, NULL),
(31, 58, 'idea', '98765432', NULL, NULL),
(33, 146, 'vishal', '123456', NULL, NULL),
(35, 1, 'Air India', 'asp555', NULL, NULL),
(36, 1, 'jet airways', '876ffch', NULL, NULL),
(39, 140, 'Jet Privilege', '240829665', NULL, NULL),
(40, 119, 'Jet Airways', '141991371', NULL, NULL),
(41, 119, 'Vistara', '111639511', NULL, NULL),
(42, 172, 'Jet airways', '194587945', NULL, NULL),
(43, 172, 'Vistara ', '113544325', NULL, NULL),
(44, 120, 'Jetprivilege', '216622976', NULL, NULL),
(45, 174, 'Jet Privilege', '202232936', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `itf_metatags`
--

CREATE TABLE IF NOT EXISTS `itf_metatags` (
  `id` int(111) NOT NULL AUTO_INCREMENT,
  `name` varchar(111) NOT NULL,
  `title` varchar(111) NOT NULL,
  `urlname` varchar(111) NOT NULL,
  `metakeywords` varchar(111) NOT NULL,
  `metadiscryption` varchar(111) NOT NULL,
  `status` tinyint(111) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `itf_mrs_list`
--

CREATE TABLE IF NOT EXISTS `itf_mrs_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `itf_mrs_list`
--

INSERT INTO `itf_mrs_list` (`id`, `name`, `parent_id`, `active`) VALUES
(1, 'Character Profile  ', 0, 1),
(2, 'Informal encounter', 0, 1),
(3, 'Emotional expression', 0, 1),
(4, 'Personal impact It’s reciprocal ', 0, 1),
(5, 'Quick warm up ', 0, 1),
(6, 'Facial expressions', 0, 1),
(7, '30 second preparation', 0, 1),
(8, 'Building rapport', 0, 1),
(9, 'Ppsaao', 0, 1),
(10, 'Influence Aim', 0, 1),
(11, 'Process for influence ', 0, 1),
(12, 'Subtexts', 0, 1),
(13, 'One mint speech', 0, 1),
(14, 'A4 sheet & Drawing Sheet & Name Tag', 0, 1),
(15, 'Folder with stop, start, continue sheet', 0, 1),
(16, 'Charisma effect books ', 0, 1),
(17, '1ps mask & 1ps Ball ', 0, 1),
(18, 'Camera with stand', 0, 1),
(19, 'Spy', 0, 1),
(20, 'Feeling card PWP wale', 0, 1),
(21, 'Pwp poster not Five 5ps likhe wale ', 0, 1),
(22, 'Personal impact poster ', 0, 1),
(23, 'Status card', 0, 1),
(24, 'Color pen & Flip chart Marker & Board marker', 0, 1),
(25, 'Blue tag', 0, 1),
(26, 'Props ( small )', 0, 1),
(27, 'Medicine box.', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itf_mrs_record`
--

CREATE TABLE IF NOT EXISTS `itf_mrs_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `itf_mrs_record`
--

INSERT INTO `itf_mrs_record` (`id`, `proid`, `name`, `status`) VALUES
(31, 20, '4', '0'),
(32, 20, '5', '0'),
(33, 20, '6', '0'),
(34, 20, '7', '0'),
(40, 16, '1', '0'),
(41, 16, '2', '0'),
(42, 16, '3', '0'),
(43, 16, '4', '0'),
(44, 16, '5', '0'),
(45, 16, '6', '0'),
(46, 16, '7', '0'),
(47, 16, '8', '0'),
(48, 16, '9', '0'),
(49, 16, '10', '0'),
(50, 16, '11', '0'),
(51, 16, '12', '0'),
(52, 16, '13', '0'),
(53, 16, '15', '0'),
(54, 16, '21', '0'),
(55, 16, '22', '0'),
(56, 16, '23', '0'),
(57, 16, '25', '0'),
(58, 16, '26', '0'),
(59, 16, '27', '0'),
(60, 42, '1', '0'),
(61, 42, '2', '0'),
(62, 42, '3', '0'),
(63, 42, '4', '0'),
(64, 42, '7', '0'),
(65, 42, '13', '0'),
(66, 42, '15', '0'),
(67, 42, '16', '0'),
(68, 42, '18', '0'),
(74, 44, '4', '0'),
(75, 44, '6', '0'),
(76, 44, '8', '0'),
(77, 44, '9', '0'),
(78, 44, '11', '0'),
(82, 45, '10', '0'),
(83, 45, '11', '0'),
(84, 45, '13', '0'),
(88, 14, '10', '0'),
(89, 24, '14', '0'),
(90, 24, '15', '0'),
(91, 1, '6', '0'),
(92, 1, '9', '0');

-- --------------------------------------------------------

--
-- Table structure for table `itf_myinfodetail`
--

CREATE TABLE IF NOT EXISTS `itf_myinfodetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `user_current_location` varchar(255) NOT NULL,
  `preferred_airlience` varchar(255) NOT NULL,
  `food` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `itf_myinfodetail`
--

INSERT INTO `itf_myinfodetail` (`id`, `userid`, `user_current_location`, `preferred_airlience`, `food`) VALUES
(1, '91', 'Goa12', '7', 'nonveg'),
(2, '104', 'kolkata', '1', 'nonveg'),
(3, '103', 'Patna', '1', 'nonveg'),
(4, '108', 'kausabvi', '1', 'veg'),
(5, '8', 'Patna', '3', 'nonveg'),
(6, '121', 'Delhi', '26', 'veg'),
(7, '145', 'ashram', '28', 'veg'),
(8, '146', 'delhi', '35', 'nonveg'),
(9, '1', 'gurgaon', '26', 'veg'),
(10, '119', 'delhi', '26', 'nonveg'),
(11, '140', 'Bangalore, India', '26', 'veg'),
(12, '172', 'Mumbai', '26', 'nonveg'),
(13, '120', 'New Delhi', '26', 'nonveg'),
(14, '174', 'New Delhi', '26', 'nonveg');

-- --------------------------------------------------------

--
-- Table structure for table `itf_noof_casting`
--

CREATE TABLE IF NOT EXISTS `itf_noof_casting` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `diagnose_id` bigint(25) NOT NULL,
  `type` enum('1','2','3','4') NOT NULL COMMENT '1=diagnose,2=design,3=delivery,4=discovery',
  `casting_manager` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `itf_noof_casting`
--

INSERT INTO `itf_noof_casting` (`id`, `diagnose_id`, `type`, `casting_manager`, `status`, `entry_time`) VALUES
(6, 22, '1', '178', 1, '2016-11-29 08:14:33'),
(26, 42, '3', '121', 1, '2016-11-29 09:39:59'),
(27, 42, '3', '172', 1, '2016-11-29 09:39:59'),
(28, 42, '3', '178', 1, '2016-11-29 09:39:59'),
(31, 44, '3', '178', 1, '2016-11-29 11:33:56'),
(32, 48, '3', '174', 1, '2016-11-29 11:35:37'),
(33, 45, '3', '174', 1, '2016-11-30 07:05:58'),
(34, 43, '3', '174', 1, '2016-11-30 07:10:21'),
(35, 49, '3', '120', 1, '2016-11-30 07:28:26'),
(36, 49, '3', '176', 1, '2016-11-30 07:28:26'),
(37, 40, '3', '119', 1, '2016-11-30 07:49:48'),
(38, 40, '3', '120', 1, '2016-11-30 07:49:48'),
(39, 40, '3', '121', 1, '2016-11-30 07:49:48'),
(40, 40, '3', '178', 1, '2016-11-30 07:49:48'),
(41, 39, '3', '119', 1, '2016-11-30 07:54:02'),
(42, 39, '3', '120', 1, '2016-11-30 07:54:02'),
(43, 39, '3', '121', 1, '2016-11-30 07:54:02'),
(44, 39, '3', '172', 1, '2016-11-30 07:54:02'),
(45, 41, '3', '121', 1, '2016-11-30 08:22:19'),
(46, 41, '3', '172', 1, '2016-11-30 08:22:19'),
(47, 41, '3', '178', 1, '2016-11-30 08:22:19'),
(48, 51, '3', '142', 1, '2016-12-01 03:48:41'),
(49, 46, '3', '178', 1, '2016-12-01 04:43:16'),
(50, 52, '3', '120', 1, '2016-12-01 08:24:53'),
(51, 52, '3', '121', 1, '2016-12-01 08:24:53'),
(53, 53, '3', '120', 1, '2016-12-01 08:50:20'),
(54, 53, '3', '121', 1, '2016-12-01 08:50:20'),
(55, 58, '3', '120', 1, '2016-12-01 11:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `itf_noof_deliveredpro`
--

CREATE TABLE IF NOT EXISTS `itf_noof_deliveredpro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) NOT NULL,
  `delivery_pro_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `entry_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

--
-- Dumping data for table `itf_noof_deliveredpro`
--

INSERT INTO `itf_noof_deliveredpro` (`id`, `delivery_id`, `delivery_pro_id`, `active`, `entry_time`) VALUES
(1, 47, 13, 0, '2016-11-28 10:31:58'),
(2, 47, 14, 0, '2016-11-28 10:31:58'),
(3, 47, 44, 0, '2016-11-28 10:31:58'),
(4, 47, 45, 0, '2016-11-28 10:31:58'),
(5, 47, 46, 0, '2016-11-28 10:31:58'),
(6, 47, 47, 0, '2016-11-28 10:31:58'),
(7, 47, 48, 0, '2016-11-28 10:31:58'),
(8, 47, 49, 0, '2016-11-28 10:31:58'),
(9, 47, 50, 0, '2016-11-28 10:31:58'),
(10, 47, 51, 0, '2016-11-28 10:31:58'),
(11, 47, 52, 0, '2016-11-28 10:31:58'),
(12, 47, 53, 0, '2016-11-28 10:31:58'),
(13, 47, 54, 0, '2016-11-28 10:31:58'),
(14, 47, 55, 0, '2016-11-28 10:31:58'),
(15, 47, 56, 0, '2016-11-28 10:31:58'),
(16, 47, 57, 0, '2016-11-28 10:31:58'),
(17, 47, 58, 0, '2016-11-28 10:31:58'),
(18, 47, 59, 0, '2016-11-28 10:31:58'),
(19, 47, 60, 0, '2016-11-28 10:31:58'),
(20, 47, 61, 0, '2016-11-28 10:31:58'),
(21, 47, 62, 0, '2016-11-28 10:31:58'),
(22, 47, 63, 0, '2016-11-28 10:31:58'),
(23, 47, 64, 0, '2016-11-28 10:31:58'),
(24, 47, 65, 0, '2016-11-28 10:31:58'),
(25, 47, 66, 0, '2016-11-28 10:31:58'),
(26, 47, 67, 0, '2016-11-28 10:31:58'),
(27, 47, 68, 0, '2016-11-28 10:31:58'),
(28, 47, 69, 0, '2016-11-28 10:31:58'),
(29, 47, 70, 0, '2016-11-28 10:31:58'),
(30, 47, 71, 0, '2016-11-28 10:31:58'),
(31, 47, 72, 0, '2016-11-28 10:31:58'),
(32, 47, 73, 0, '2016-11-28 10:31:58'),
(33, 47, 74, 0, '2016-11-28 10:31:58'),
(34, 47, 75, 0, '2016-11-28 10:31:58'),
(35, 47, 76, 0, '2016-11-28 10:31:58'),
(36, 47, 77, 0, '2016-11-28 10:31:58'),
(37, 47, 78, 0, '2016-11-28 10:31:58'),
(38, 49, 16, 0, '2016-11-29 11:19:37'),
(39, 49, 17, 0, '2016-11-29 11:19:37'),
(40, 49, 18, 0, '2016-11-29 11:19:37'),
(41, 49, 19, 0, '2016-11-29 11:19:37'),
(42, 49, 21, 0, '2016-11-29 11:19:37'),
(43, 49, 22, 0, '2016-11-29 11:19:37'),
(44, 49, 23, 0, '2016-11-29 11:19:37'),
(45, 49, 24, 0, '2016-11-29 11:19:37'),
(46, 49, 25, 0, '2016-11-29 11:19:37'),
(47, 49, 26, 0, '2016-11-29 11:19:37'),
(48, 49, 27, 0, '2016-11-29 11:19:37'),
(49, 49, 28, 0, '2016-11-29 11:19:37'),
(50, 49, 29, 0, '2016-11-29 11:19:37'),
(51, 49, 30, 0, '2016-11-29 11:19:37'),
(52, 49, 31, 0, '2016-11-29 11:19:37'),
(53, 49, 32, 0, '2016-11-29 11:19:37'),
(54, 49, 33, 0, '2016-11-29 11:19:37'),
(55, 49, 34, 0, '2016-11-29 11:19:37'),
(56, 49, 35, 0, '2016-11-29 11:19:37'),
(57, 49, 36, 0, '2016-11-29 11:19:37'),
(58, 49, 37, 0, '2016-11-29 11:19:37'),
(59, 49, 38, 0, '2016-11-29 11:19:37'),
(60, 49, 39, 0, '2016-11-29 11:19:37'),
(61, 49, 40, 0, '2016-11-29 11:19:37'),
(62, 49, 41, 0, '2016-11-29 11:19:37'),
(63, 49, 42, 0, '2016-11-29 11:19:37'),
(64, 49, 43, 0, '2016-11-29 11:19:37'),
(65, 50, 12, 0, '2016-11-30 10:52:46'),
(66, 50, 137, 0, '2016-11-30 10:52:46'),
(67, 50, 138, 0, '2016-11-30 10:52:46'),
(68, 50, 139, 0, '2016-11-30 10:52:46'),
(69, 50, 140, 0, '2016-11-30 10:52:46'),
(70, 50, 141, 0, '2016-11-30 10:52:46'),
(71, 50, 142, 0, '2016-11-30 10:52:46'),
(72, 50, 143, 0, '2016-11-30 10:52:46'),
(73, 50, 144, 0, '2016-11-30 10:52:46'),
(74, 50, 145, 0, '2016-11-30 10:52:46'),
(75, 50, 146, 0, '2016-11-30 10:52:46'),
(76, 50, 147, 0, '2016-11-30 10:52:46'),
(77, 50, 148, 0, '2016-11-30 10:52:46'),
(78, 50, 149, 0, '2016-11-30 10:52:46'),
(79, 50, 150, 0, '2016-11-30 10:52:46'),
(80, 50, 151, 0, '2016-11-30 10:52:46'),
(81, 50, 152, 0, '2016-11-30 10:52:46'),
(82, 50, 153, 0, '2016-11-30 10:52:46'),
(83, 50, 154, 0, '2016-11-30 10:52:46'),
(84, 50, 155, 0, '2016-11-30 10:52:46'),
(85, 50, 156, 0, '2016-11-30 10:52:46'),
(86, 50, 157, 0, '2016-11-30 10:52:46'),
(87, 50, 158, 0, '2016-11-30 10:52:46'),
(88, 50, 159, 0, '2016-11-30 10:52:46'),
(89, 50, 160, 0, '2016-11-30 10:52:46'),
(90, 50, 161, 0, '2016-11-30 10:52:46'),
(91, 50, 162, 0, '2016-11-30 10:52:46'),
(92, 52, 16, 0, '2016-12-01 08:28:30'),
(93, 52, 17, 0, '2016-12-01 08:28:30'),
(94, 52, 18, 0, '2016-12-01 08:28:30'),
(95, 52, 19, 0, '2016-12-01 08:28:30'),
(96, 52, 21, 0, '2016-12-01 08:28:30'),
(97, 52, 22, 0, '2016-12-01 08:28:30'),
(98, 52, 23, 0, '2016-12-01 08:28:30'),
(99, 52, 24, 0, '2016-12-01 08:28:30'),
(100, 52, 25, 0, '2016-12-01 08:28:30'),
(101, 52, 26, 0, '2016-12-01 08:28:30'),
(102, 52, 27, 0, '2016-12-01 08:28:30'),
(103, 52, 28, 0, '2016-12-01 08:28:30'),
(104, 52, 29, 0, '2016-12-01 08:28:30'),
(105, 52, 30, 0, '2016-12-01 08:28:30'),
(106, 52, 31, 0, '2016-12-01 08:28:30'),
(107, 52, 32, 0, '2016-12-01 08:28:30'),
(108, 52, 33, 0, '2016-12-01 08:28:30'),
(109, 52, 34, 0, '2016-12-01 08:28:30'),
(110, 52, 35, 0, '2016-12-01 08:28:30'),
(111, 52, 36, 0, '2016-12-01 08:28:30'),
(112, 52, 37, 0, '2016-12-01 08:28:30'),
(113, 52, 38, 0, '2016-12-01 08:28:30'),
(114, 52, 39, 0, '2016-12-01 08:28:30'),
(115, 52, 40, 0, '2016-12-01 08:28:30'),
(116, 52, 41, 0, '2016-12-01 08:28:30'),
(117, 52, 42, 0, '2016-12-01 08:28:30'),
(118, 52, 43, 0, '2016-12-01 08:28:30'),
(119, 54, 12, 0, '2016-12-01 08:52:41'),
(120, 54, 137, 0, '2016-12-01 08:52:41'),
(121, 54, 138, 0, '2016-12-01 08:52:41'),
(122, 54, 139, 0, '2016-12-01 08:52:41'),
(123, 54, 140, 0, '2016-12-01 08:52:41'),
(124, 54, 141, 0, '2016-12-01 08:52:41'),
(125, 54, 142, 0, '2016-12-01 08:52:41'),
(126, 54, 143, 0, '2016-12-01 08:52:41'),
(127, 54, 144, 0, '2016-12-01 08:52:41'),
(128, 54, 145, 0, '2016-12-01 08:52:41'),
(129, 54, 146, 0, '2016-12-01 08:52:41'),
(130, 54, 147, 0, '2016-12-01 08:52:41'),
(131, 54, 148, 0, '2016-12-01 08:52:41'),
(132, 54, 149, 0, '2016-12-01 08:52:41'),
(133, 54, 150, 0, '2016-12-01 08:52:41'),
(134, 54, 151, 0, '2016-12-01 08:52:41'),
(135, 54, 152, 0, '2016-12-01 08:52:41'),
(136, 54, 153, 0, '2016-12-01 08:52:41'),
(137, 54, 154, 0, '2016-12-01 08:52:41'),
(138, 54, 155, 0, '2016-12-01 08:52:41'),
(139, 54, 156, 0, '2016-12-01 08:52:41'),
(140, 54, 157, 0, '2016-12-01 08:52:41'),
(141, 54, 158, 0, '2016-12-01 08:52:41'),
(142, 54, 159, 0, '2016-12-01 08:52:41'),
(143, 54, 160, 0, '2016-12-01 08:52:41'),
(144, 54, 161, 0, '2016-12-01 08:52:41'),
(145, 54, 162, 0, '2016-12-01 08:52:41'),
(146, 55, 12, 0, '2016-12-01 09:07:48'),
(147, 55, 137, 0, '2016-12-01 09:07:48'),
(148, 55, 138, 0, '2016-12-01 09:07:48'),
(149, 55, 139, 0, '2016-12-01 09:07:48'),
(150, 55, 140, 0, '2016-12-01 09:07:48'),
(151, 55, 141, 0, '2016-12-01 09:07:48'),
(152, 55, 142, 0, '2016-12-01 09:07:48'),
(153, 55, 143, 0, '2016-12-01 09:07:48'),
(154, 55, 144, 0, '2016-12-01 09:07:48'),
(155, 55, 145, 0, '2016-12-01 09:07:48'),
(156, 55, 146, 0, '2016-12-01 09:07:48'),
(157, 55, 147, 0, '2016-12-01 09:07:48'),
(158, 55, 148, 0, '2016-12-01 09:07:48'),
(159, 55, 149, 0, '2016-12-01 09:07:48'),
(160, 55, 150, 0, '2016-12-01 09:07:48'),
(161, 55, 151, 0, '2016-12-01 09:07:48'),
(162, 55, 152, 0, '2016-12-01 09:07:48'),
(163, 55, 153, 0, '2016-12-01 09:07:48'),
(164, 55, 154, 0, '2016-12-01 09:07:48'),
(165, 55, 155, 0, '2016-12-01 09:07:48'),
(166, 55, 156, 0, '2016-12-01 09:07:48'),
(167, 55, 157, 0, '2016-12-01 09:07:48'),
(168, 55, 158, 0, '2016-12-01 09:07:48'),
(169, 55, 159, 0, '2016-12-01 09:07:48'),
(170, 55, 160, 0, '2016-12-01 09:07:48'),
(171, 55, 161, 0, '2016-12-01 09:07:48'),
(172, 55, 162, 0, '2016-12-01 09:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order`
--

CREATE TABLE IF NOT EXISTS `itf_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_Id` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) NOT NULL,
  `sales_by_id` bigint(20) NOT NULL,
  `pm_id` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=''normal'',1=''accepted'',2=''rejected''',
  `comment` varchar(255) DEFAULT NULL,
  `entry_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `itf_order`
--

INSERT INTO `itf_order` (`id`, `order_Id`, `client_id`, `sales_by_id`, `pm_id`, `status`, `comment`, `entry_Time`) VALUES
(61, '211102', 127, 114, 116, 0, NULL, '2016-11-03 05:42:36'),
(62, '211103', 151, 114, 115, 0, NULL, '2016-11-03 09:14:41'),
(68, '211104', 163, 162, 116, 0, NULL, '2016-11-21 10:40:11'),
(69, '211105', 163, 162, 116, 0, NULL, '2016-11-21 11:25:34'),
(70, '221106', 163, 162, 116, 0, NULL, '2016-11-22 03:41:12'),
(71, '221107', 164, 162, 115, 0, NULL, '2016-11-22 06:16:54'),
(72, '221108', 165, 162, 115, 0, NULL, '2016-11-22 06:31:07'),
(73, '221109', 166, 114, 116, 0, NULL, '2016-11-22 10:07:02'),
(74, '221110', 169, 114, 115, 0, NULL, '2016-11-22 10:18:26'),
(75, '241111', 170, 114, 116, 0, NULL, '2016-11-24 07:54:38'),
(76, '241112', 171, 162, 115, 0, NULL, '2016-11-24 10:19:30'),
(77, '281177', 177, 114, 116, 0, NULL, '2016-11-28 09:27:16'),
(78, '011278', 163, 162, 116, 0, NULL, '2016-12-01 08:21:37'),
(79, '011279', 163, 162, 116, 0, NULL, '2016-12-01 08:29:33'),
(80, '011280', 181, 114, 116, 0, NULL, '2016-12-01 11:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_addressbilling`
--

CREATE TABLE IF NOT EXISTS `itf_order_addressbilling` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `order_Id` varchar(30) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `itf_order_addressbilling`
--

INSERT INTO `itf_order_addressbilling` (`Id`, `order_Id`, `street`, `location`, `state`, `country`, `city`, `pincode`) VALUES
(1, '52', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '61', NULL, NULL, NULL, NULL, NULL, NULL),
(3, '62', NULL, NULL, NULL, NULL, NULL, NULL),
(4, '68', 'Baghmane Tech Park, 65/2 -1', 'Adj LRDE, Byrasandra C.V.Raman Nagar', 'Karnataka', '0', 'Bangalore', '560 093'),
(5, '69', 'Plot # 26, Rajiv Gandhi Infotech Park', 'MIDC, Hinjawadi', 'Maharashta', '0', 'Pune', '411057'),
(6, '70', '#5/535, Old Mahabalipuram Road', 'Okkiam -Thoraipakkam', 'Tamil Nadu', '0', 'Chennai', '600 096'),
(7, '71', 'Amex Financial Centre,Wings 2-B, 3-B, 4-B, 5-B Comm. Block-3, (Zone-6)', 'GHS', 'Haryana', '0', 'Gurgaon ', '122009'),
(8, '72', 'Ericsson Forum DLF Cybercity', 'Sector-25A', 'Haryana', '0', 'Gurgaon', '122 002'),
(9, '73', NULL, NULL, NULL, NULL, NULL, NULL),
(10, '74', NULL, NULL, NULL, NULL, NULL, NULL),
(11, '75', NULL, NULL, NULL, NULL, NULL, NULL),
(12, '76', '7th Floor, DLF Centre Court', 'DLF City phase V, Sector 42', 'Haryana', '0', 'Gurgaon', '122002'),
(13, '77', 'Block C', 'Sector 45', 'Haryana', '0', 'Gugaon', '122 003'),
(14, '78', '#5/535, Old Mahabalipuram Road', 'Okkiam -Thoraipakkam', 'Tamil Nadu', '0', 'Chennai', '600 096'),
(15, '79', '#5/535, Old Mahabalipuram Road', 'Okkiam -Thoraipakkam', 'Tamil Nadu', '0', 'Chennai', '600 096'),
(16, '80', 'McKinsey and Company | 21 Floor, Express Towers ', 'Nariman Point', 'Maharashtra', '0', 'Mumbai', '400021');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_delivery`
--

CREATE TABLE IF NOT EXISTS `itf_order_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `subproducts` varchar(255) DEFAULT NULL,
  `weight` float(10,2) NOT NULL,
  `units` int(11) NOT NULL,
  `cunsultant` varchar(255) DEFAULT NULL,
  `pax` int(11) NOT NULL,
  `lunchstarttime` varchar(255) NOT NULL,
  `lunchendtime` varchar(255) NOT NULL,
  `intervaltime` varchar(255) NOT NULL,
  `no_ofcasting` int(11) NOT NULL,
  `no_ofdays` int(11) NOT NULL,
  `cunsulting_days` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `price_unit` int(11) NOT NULL,
  `coordinator` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `notconfirmed` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `itf_order_delivery`
--

INSERT INTO `itf_order_delivery` (`id`, `order_id`, `products`, `subproducts`, `weight`, `units`, `cunsultant`, `pax`, `lunchstarttime`, `lunchendtime`, `intervaltime`, `no_ofcasting`, `no_ofdays`, `cunsulting_days`, `start_date`, `end_date`, `location`, `price_unit`, `coordinator`, `email_id`, `contact`, `notconfirmed`) VALUES
(2, 19, '13', '1', 224.00, 2, NULL, 2, '', '', '', 0, 1, 1, '2016-09-07', '2016-09-07', 'noida', 65000, 'amit', 'amit@gmail.com', 1234512345, 0),
(3, 17, '15', '10', 2.00, 44, NULL, 4, '', '', '', 0, 2, 1, '2016-09-28', '2016-09-30', 'noida', 12000, 'amit', 'amit@gmail.com', 1234512345, 0),
(4, 39, '13', '1', 34.00, 10, NULL, 35, '', '', '', 0, 2, 1, '2016-10-05', '2016-10-06', 'ashok nagar', 65000, 'semim', 'itf.semimaktar@gmail.com', 2147483647, 0),
(5, 41, '13', '1', 34.00, 10, NULL, 35, '', '', '', 0, 4, 2, '2016-09-12', '2016-09-15', 'ashok nagar', 65000, 'semim', 'itf.semimaktar@gmail.com', 2147483647, 0),
(6, 47, '24', '2', 0.00, 2, NULL, 36, '', '', '', 0, 3, 1, '2016-09-27', '2016-09-29', 'Delhi', 10000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(7, 46, '45', '1', 24.00, 2, NULL, 36, '', '', '', 0, 4, 1, '2016-10-03', '2016-10-06', 'Delhi', 323, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(8, 46, '45', '2', 24.00, 2, NULL, 36, '', '', '', 0, 5, 1, '2016-10-03', '2016-10-07', 'Delhi', 323, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(9, 49, '45', '2', 24.00, 2, NULL, 36, '', '', '', 0, 3, 1, '2016-09-06', '2016-09-08', 'Delhi', 323, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(10, 49, '24', '1', 0.00, 2, NULL, 36, '', '', '', 0, 3, 1, '2016-09-27', '2016-09-29', 'Delhi', 10000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(11, 45, '45', '2', 24.00, 2, NULL, 36, '', '', '', 0, 4, 1, '2016-09-27', '2016-09-30', 'Delhi', 323, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(12, 52, '17', '9', 0.50, 2, NULL, 70, '', '', '', 0, 1, 3, '2016-11-09', '2016-11-09', 'Gurgaon', 35000, 'Abhishek', 'abhishek_jain@mckinsey.com', 2147483647, 0),
(13, 47, '16', '6', 0.50, 12, NULL, 8, '', '', '', 0, 2, 3, '2016-10-23', '2016-10-24', 'noida', 65000, 'amit', 'amit@gmail.com', 1234568956, 0),
(15, 55, '44', '2', 44.00, 2, NULL, 90, '', '', '', 0, 4, 1, '2016-10-18', '2016-10-21', 'noida', 22, 'sonu', 'sonu1@gmail.com', 2147483647, 0),
(16, 55, '13', '2', 1.00, 2, NULL, 8, '', '', '', 0, 2, 1, '2016-10-25', '2016-10-26', 'pune', 65000, 'kanika', 'info@maynardleigh.in', 2147483647, 0),
(17, 55, '13', '2', 1.00, 23, NULL, 23, '', '', '', 0, 2, 1, '2016-11-16', '2016-11-17', 'Delhi', 65000, 'Deepak', 'deepak@gmail.com', 2147483647, 0),
(18, 55, '13', '2', 1.00, 2, NULL, 36, '', '', '', 0, 12, 1, '2016-10-17', '2016-10-28', 'Delhi', 65000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(19, 55, '13', '2', 1.00, 2, NULL, 36, '', '', '', 0, 5, 1, '2016-09-27', '2016-10-01', 'Delhi', 65000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(20, 55, '13', '2', 1.00, 2, NULL, 36, '', '', '', 0, 4, 1, '2016-09-27', '2016-09-30', 'Delhi', 65000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(21, 55, '22', '2', 0.13, 21, NULL, 13, '', '', '', 0, 4, 1, '2016-10-18', '2016-10-21', 'nloida', 8000, 'rahul', 'ahul@gmail.com', 2147483647, 0),
(22, 56, '13', '4', 1.00, 2, NULL, 36, '', '', '', 0, 31, 1, '2016-09-27', '2016-10-27', 'Delhi', 65000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(23, 56, '14', '5', 0.50, 2, NULL, 36, '', '', '', 0, 4, 1, '2016-09-27', '2016-09-30', 'Delhi', 40000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(24, 50, '15', '15', 0.20, 2, NULL, 36, '', '', '', 0, 4, 1, '2016-10-04', '2016-10-07', 'Delhi', 12000, 'rahul', 'rahul@gmail.com', 2147483647, 0),
(25, 53, '13', '2', 1.00, 2, NULL, 90, '', '', '', 0, 4, 1, '2016-11-02', '2016-11-05', 'noida', 65000, 'sonu1', 'sonu1@gmail.com', 2147483647, 0),
(26, 58, '13', '2', 1.00, 2, NULL, 10, '', '', '', 0, 2, 1, '2016-11-10', '2016-11-11', 'gurgaon', 65000, 'HItesh Arora', 'hitesh@idea.com', 2147483647, 0),
(27, 58, '20', '2', 0.10, 76, NULL, 55, '', '', '', 0, 7, 1, '2016-11-23', '2016-11-29', 'noida', 5000, 'vishal', 'vahal@gmail.com', 2147483647, 0),
(28, 61, '20', '5', 0.10, 3, NULL, 80, '', '', '', 0, 1, 3, '2016-11-09', '2016-11-09', 'Gurgaon', 5000, 'Abhishek', 'abhishek_jain@mckinsey.com', 2147483647, 0),
(29, 58, '13', '1', 1.00, 2, NULL, 12, '', '', '', 0, 2, 1, '2016-11-17', '2016-11-18', 'bangalore', 65000, 'abhinav', 'abhinav@idea.com', 2147483647, 0),
(32, 63, '13', '2', 1.00, 2, NULL, 8, '', '', '', 0, 2, 1, '2016-11-29', '2016-11-30', 'Chennai', 65000, 'archana', 'archana@cogniant.com', 2147483647, 0),
(33, 63, '20', '2', 0.10, 2, NULL, 8, '', '', '', 0, 2, 1, '2016-12-06', '2016-12-07', 'bangalore', 5000, 'are', 'huhuh;i', 2147483647, 0),
(34, 65, '13', '1', 1.00, 3, NULL, 34, '', '', '', 0, 3, 1, '2016-12-01', '2016-12-03', 'delhi', 65000, 'delhi', 'rahul@gmail.com', 2147483647, 0),
(35, 66, '13', '2', 1.00, 2, NULL, 8, '', '', '', 0, 2, 1, '2016-12-01', '2016-12-02', 'bangalore', 65000, 'aditi', 'kanikaanugupta@gmail.com', 2147483647, 0),
(36, 66, '13', '2', 1.00, 2, NULL, 8, '', '', '', 0, 2, 1, '2016-12-08', '2016-12-09', 'Chennai', 65000, 'aditi', 'kanikaanugupta@gmail.com', 2147483647, 0),
(37, 66, '13', '2', 1.00, 4, NULL, 8, '', '', '', 0, 2, 2, '2016-12-06', '2016-12-07', 'Chennai', 65000, 'aditi', 'kanikaanugupta@gmail.com', 2147483647, 0),
(38, 66, '21', '2', 0.13, 4, NULL, 8, '', '', '', 0, 2, 1, '2016-12-13', '2016-12-14', 'pune', 8000, 'kanika', 'kanikaanugupta@gmail.com', 2147483647, 0),
(39, 68, '13', '15', 1.00, 8, NULL, 14, '', '', '', 0, 2, 4, '2016-12-01', '2016-12-02', 'Bangalore', 65000, 'Archana', 'archana.pramod@cognizant.com', 2147483647, 0),
(40, 69, '13', '15', 1.00, 8, NULL, 60, '', '', '', 0, 2, 4, '2016-12-08', '2016-12-09', 'Pune', 50000, 'Archana Pramod', 'Archana.Pramod@cognizant.com', 2147483647, 0),
(41, 70, '13', '15', 1.00, 8, NULL, 60, '', '', '', 0, 2, 4, '2016-12-15', '2016-12-16', 'Chennai', 50000, 'Archana Pramod', 'Archana.Pramod@cognizant.com', 2147483647, 0),
(42, 70, '13', '15', 1.00, 4, NULL, 40, '', '', '', 0, 2, 2, '2016-12-22', '2016-12-23', 'Chennai', 50000, 'Archana Pramod', 'Archana.Pramod@cognizant.com', 2147483647, 0),
(43, 72, '16', '81', 0.50, 1, NULL, 20, '', '', '', 0, 1, 1, '2016-11-24', '2016-11-24', 'Mumbai', 40000, ' Snigdha Tripathi', 'snigdha.tripathi@ericsson.com', 2147483647, 0),
(44, 73, '17', '9', 0.50, 1, NULL, 25, '', '', '', 0, 1, 1, '2016-12-02', '2016-12-02', 'Gurgaon', 40000, 'Neha Chahar', 'NChahar@scj.com', 2147483647, 0),
(45, 74, '13', '80', 1.00, 2, NULL, 9, '', '', '', 0, 2, 1, '2016-12-07', '2016-12-08', 'Gurgaon', 65000, 'Mitali', 'mitali.chaudhuri@stryker.com', 2147483647, 0),
(46, 75, '41', '0', 0.00, 8, NULL, 8, '', '', '', 0, 1, 1, '2016-12-05', '2016-12-05', 'Noida', 400, 'Geeta Bajaj', 'geeta.bajaj@dk.com', 2147483647, 0),
(48, 77, '13', '82', 1.00, 2, NULL, 14, '', '', '', 0, 2, 1, '2016-12-01', '2016-12-02', 'Gurgaon', 60500, 'Snigdha Nautiyal', 'snigdha.nautiyal@srf.com', 2147483647, 0),
(49, 76, '13', '15', 1.00, 4, NULL, 35, '', '', '', 0, 2, 2, '2016-12-16', '2016-12-17', 'Gurgaon', 60500, 'Malini Sharma', 'Malini.sharma@maxhealthcare.com', 2147483647, 0),
(51, 71, '13', '15', 1.00, 2, NULL, 14, '', '', '', 0, 2, 1, '2016-12-15', '2016-12-16', 'gurgaon', 65000, 'Shweta Vashisht', 'shweta.vashisht@aexp.com', 1246204725, 0),
(52, 78, '13', '15', 2.00, 4, NULL, 2, '', '', '', 0, 2, 2, '2016-12-22', '2016-12-23', 'Chennai', 65000, 'Sathish Kumar', 'SathishKumar.Vadivelu@cognizant.com', 2147483647, 0),
(53, 79, '20', '82', 0.10, 9, NULL, 1, '', '', '', 0, 1, 1, '2016-12-05', '2016-12-05', 'Phone', 5000, 'Nisha', 'nisha@maynardleigh.in', 2147483647, 0),
(57, 79, '41', '163', 0.00, 10, NULL, 10, '0', '0', '0', 0, 1, 1, '2016-12-05', '2016-12-05', 'gurgaon', 400, 'cnbfdljsf', 'kcvml;d', 2147483647, 0),
(58, 80, '13', '5', 1.00, 1, NULL, 1, '0', '0', '0', 0, 1, 1, '2017-01-24', '2017-01-24', 'Mumbai', 65000, 'Shivani Issar', 'shivani_issar@mckinsey.com', 2147483647, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_design`
--

CREATE TABLE IF NOT EXISTS `itf_order_design` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `subproducts` varchar(255) DEFAULT NULL,
  `weight` float(10,2) NOT NULL,
  `units` int(11) NOT NULL,
  `cunsultant` varchar(255) DEFAULT NULL,
  `pax` int(11) NOT NULL,
  `no_ofcasting` int(11) NOT NULL,
  `no_ofdays` int(11) NOT NULL,
  `cunsulting_days` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `price_unit` int(11) NOT NULL,
  `coordinator` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `itf_order_design`
--

INSERT INTO `itf_order_design` (`id`, `order_id`, `products`, `subproducts`, `weight`, `units`, `cunsultant`, `pax`, `no_ofcasting`, `no_ofdays`, `cunsulting_days`, `start_date`, `end_date`, `location`, `price_unit`, `coordinator`, `email_id`, `contact`) VALUES
(1, 71, '4', '15', 0.50, 1, NULL, 1, 0, 1, 1, '2016-11-28', '2016-11-28', 'Hauz Khas', 40000, 'Shweta Vashisht', 'Shweta.Vashisht@aexp.com', 1246204725),
(2, 76, '3', '9', 1.00, 1, NULL, 1, 0, 1, 1, '2016-12-03', '2016-12-03', 'Gurgaon', 60500, 'Malini Sharma', 'malini.sharma@maxhealthcare.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_diagnose`
--

CREATE TABLE IF NOT EXISTS `itf_order_diagnose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `products` varchar(255) NOT NULL,
  `subproducts` varchar(255) DEFAULT NULL,
  `weight` float(10,2) NOT NULL,
  `units` int(11) NOT NULL,
  `cunsultant` varchar(255) DEFAULT NULL,
  `pax` int(11) NOT NULL,
  `no_ofdays` int(11) NOT NULL,
  `cunsulting_days` int(11) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price_unit` int(11) NOT NULL,
  `coordinator` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `itf_order_diagnose`
--

INSERT INTO `itf_order_diagnose` (`id`, `order_id`, `products`, `subproducts`, `weight`, `units`, `cunsultant`, `pax`, `no_ofdays`, `cunsulting_days`, `start_date`, `end_date`, `location`, `price_unit`, `coordinator`, `email_id`, `contact`) VALUES
(5, 52, '1', '1', 2.00, 1, NULL, 33, 2, 1, '10/05/2016', '10/06/2016', 'noida', 65000, 'rahul', 'rahul@gmail.com', '9897876787'),
(6, 52, '2', '8', 0.50, 1, NULL, 33, 2, 1, '10/05/2016', '10/06/2016', 'noida', 40000, 'rahul3', 'sonu@gmail.com', '9897876787'),
(7, 49, '5', '3', 0.02, 12, NULL, 5, 0, 1, '10/11/2016', '10/17/2016', 'noida', 1000, 'rahul', 'sonu@gmail.com', '2147483612'),
(8, 49, '6', '4', 0.01, 12, NULL, 5, 0, 1, '10/10/2016', '10/12/2016', 'noida', 300, 'rahul', 'sonu@gmail.com', '1234569878'),
(9, 55, '1', '2', 1.00, 1, NULL, 7, 1, 1, '10/18/2016', '10/18/2016', 'bangalore', 65000, 'anamika singh', 'anamika@wipro.com', '9958820680'),
(10, 55, '1', '1', 1.00, 1, NULL, 6, 1, 1, '10/21/2016', '10/21/2016', 'gurgaon', 65000, 'kanika', 'infor@maynardleigh.in', '9958820680'),
(11, 47, '1', '3', 2.00, 1, NULL, 33, 3, 1, '10/18/2016', '10/20/2016', 'noida', 65000, 'rahul', 'rahul@gmail.com', '2147483333'),
(12, 56, '1', '4', 1.00, 1, NULL, 6, 1, 1, '10/27/2016', '10/27/2016', 'gurgaon', 65000, 'sheetal', 'sheetal@ey.com', '9324567901'),
(13, 57, '11', '1', 0.01, 2, NULL, 30, 2, 2, '11/02/2016', '11/03/2016', 'Vaisahli Sector1', 800, 'Mr Ranu', 'itf.ranu@gmail.com', '8750736100'),
(14, 57, '5', '1', 0.02, 3, NULL, 33, 2, 1, '12/01/2016', '12/02/2016', 'Vaisahli Sector1', 1000, 'Mr Ranu', 'rahulkumartiwari.indian@gmail.com', '8750736100'),
(15, 58, '1', '2', 1.00, 1, NULL, 7, 1, 1, '10/27/2016', '10/27/2016', 'gurgaon', 65000, 'Hitesh Arora', 'hitesh@idea.com', '9958820680'),
(16, 54, '1', '1', 1.00, 1, NULL, 33, 3, 1, '10/27/2016', '10/29/2016', 'noida', 65000, 'rahul', 'rahul@gmail.com', '9897876787'),
(17, 62, '2', '80', 0.50, 1, NULL, 4, 1, 1, '11/01/2016', '11/01/2016', 'Delhi', 40000, 'Deepika Kamboj', 'deepika.kamboj@rbs.co.uk', '8826600699'),
(18, 63, '1', '2', 1.00, 1, NULL, 6, 1, 1, '11/16/2016', '11/16/2016', 'gurgaon', 65000, 'archana', 'archana@cognozant.com', '9958820680'),
(19, 65, '2', '2', 0.50, 2, NULL, 30, 7, 1, '11/11/2016', '11/17/2016', 'Vaisahli Sector1', 40000, 'Mr Ranu', 'rahulkumartiwari.indian@gmail.com', '8750736100'),
(20, 66, '1', '1', 1.00, 1, NULL, 5, 1, 1, '11/24/2016', '11/24/2016', 'gurgaon', 65000, 'aditi', 'kanikaanugupta@gmail.com', '9958820680'),
(21, 66, '1', '2', 1.00, 1, NULL, 6, 1, 1, '11/22/2016', '11/22/2016', 'gurgaon', 650009, 'kanika', 'kanikaanugupta@gmail.com', '9958820680'),
(22, 76, '1', '9', 1.00, 1, NULL, 8, 1, 2, '11/30/2016', '11/30/2016', 'Gurgaon/ Saket', 60500, 'Rajender Sud', 'rajender.sud@maxlifeinsurance.com', '9910559583'),
(23, 77, '1', '4', 1.00, 1, NULL, 9, 1, 1, '08/16/2016', '08/16/2016', 'Gurgaon', 60500, 'Snigdha Nautiyal', 'snigdha.nautiyal@srf.com', '9871486072'),
(24, 71, '2', '15', 0.50, 3, NULL, 12, 2, 1, '11/23/2016', '11/24/2016', 'Gurgaon', 105000, 'Shweta Vashisht', 'Shweta.Vashisht@aexp.com', '1246204725');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_discovery`
--

CREATE TABLE IF NOT EXISTS `itf_order_discovery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `products` varchar(255) NOT NULL,
  `subproducts` varchar(255) DEFAULT NULL,
  `weight` float(10,2) NOT NULL,
  `units` int(11) NOT NULL,
  `cunsultant` varchar(255) DEFAULT NULL,
  `pax` int(11) NOT NULL,
  `no_ofcasting` int(11) NOT NULL,
  `no_ofdays` int(11) NOT NULL,
  `cunsulting_days` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `price_unit` int(11) NOT NULL,
  `coordinator` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_documentname`
--

CREATE TABLE IF NOT EXISTS `itf_order_documentname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) NOT NULL,
  `active` int(11) DEFAULT '1',
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `itf_order_documentname`
--

INSERT INTO `itf_order_documentname` (`id`, `document_name`, `active`, `upload_time`) VALUES
(1, 'SPIN', 1, '2016-05-29 10:18:46'),
(2, 'OPR', 1, '2016-05-29 10:18:46'),
(3, 'Approach Paper', 1, '2016-05-29 11:12:31'),
(4, 'Proposal', 1, '2016-05-29 11:32:05'),
(5, 'Document for Client', 1, '2016-05-29 11:32:05'),
(6, 'Picture if any', 1, '2016-05-29 11:32:42'),
(7, 'Voice Recording', 1, '2016-05-29 11:32:42');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_documentupload`
--

CREATE TABLE IF NOT EXISTS `itf_order_documentupload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `itf_order_documentupload`
--

INSERT INTO `itf_order_documentupload` (`id`, `order_id`, `document_id`, `file_name`) VALUES
(1, 77, 4, 'SRF Diagnostic Report_Nov 11.pptx'),
(2, 76, 2, 'Max Health Care OPR.docx');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_economic`
--

CREATE TABLE IF NOT EXISTS `itf_order_economic` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `order_Id` varchar(30) DEFAULT NULL,
  `first_Name` varchar(255) DEFAULT NULL,
  `last_Name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `contact_No` varchar(11) DEFAULT NULL,
  `email_Id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `itf_order_economic`
--

INSERT INTO `itf_order_economic` (`Id`, `order_Id`, `first_Name`, `last_Name`, `location`, `designation`, `contact_No`, `email_Id`) VALUES
(1, '52', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '61', NULL, NULL, NULL, NULL, NULL, NULL),
(3, '62', NULL, NULL, NULL, NULL, NULL, NULL),
(4, '68', 'Srithika', 'ThodurMadapusi', 'Bangalore', 'Senior Learning Specialist', '9940631757', 'Srithika.ThodurMadapusi@cognizant.com'),
(5, '69', 'Srithika', 'ThodurMadapusi', 'Pune', 'Senior Learning Specialist', '9940631757', 'Srithika.ThodurMadapusi@cognizant.com'),
(6, '70', 'Srithika', 'ThodurMadapusi', 'Chennai', 'Senior Learning Specialist', '9940631757', 'Srithika.ThodurMadapusi@cognizant.com'),
(7, '71', 'Rahul', 'A Agarwal', 'Gurgaon', 'Director Technical Delivery', '9811456913', 'rahul.a.agarwal@aexp.com'),
(8, '72', 'Snigdha ', 'Tripathy', 'Gurgaon', 'Manager HR', '9599994265', 'snigdha.tripathi@ericsson.com'),
(9, '73', NULL, NULL, NULL, NULL, NULL, NULL),
(10, '74', NULL, NULL, NULL, NULL, NULL, NULL),
(11, '75', NULL, NULL, NULL, NULL, NULL, NULL),
(12, '76', 'Rajender', 'Sud', 'Gurgaon', 'CEO', 'Contact No', 'rajender.sud@maxlifeinsurance.com'),
(13, '77', 'Snigdha', 'Nautiyal', 'Gurgaon', 'Head HR, Chemical Technology Group', '9871486072', 'Snigdha.Nautiyal@srf.com'),
(14, '78', 'Srithika ', 'ThodurMadapusi', 'Chennai', 'L &D', '9940631757', 'Srithika.ThodurMadapusi@cognizant.com'),
(15, '79', 'Srithika', 'ThodurMadapusi', 'Chennai', 'L &D', '9940631757', 'Srithika.ThodurMadapusi@cognizant.com'),
(16, '80', 'Shivani', 'Issar', 'Mumbai', 'L ', '8860786200', 'shivani_issar@mckinsey.com');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_termconditions`
--

CREATE TABLE IF NOT EXISTS `itf_order_termconditions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `price_validity` varchar(255) DEFAULT NULL,
  `cancellation_clouse` varchar(255) DEFAULT NULL,
  `special_item` varchar(255) DEFAULT NULL,
  `contract_no` int(11) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `handled_by` varchar(255) DEFAULT NULL,
  `nda_required` varchar(20) DEFAULT NULL,
  `payment_cycle` varchar(255) DEFAULT NULL,
  `mode_ofpayment` varchar(255) DEFAULT NULL,
  `termsconditions` varchar(255) DEFAULT NULL,
  `transport_tax` varchar(25) NOT NULL DEFAULT 'no',
  `tax` varchar(25) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `itf_order_termconditions`
--

INSERT INTO `itf_order_termconditions` (`id`, `order_id`, `price_validity`, `cancellation_clouse`, `special_item`, `contract_no`, `notes`, `handled_by`, `nda_required`, `payment_cycle`, `mode_ofpayment`, `termsconditions`, `transport_tax`, `tax`) VALUES
(1, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no'),
(2, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no'),
(3, 68, '20th September 2017', '1', '', 1, '', '0', 'No', '', 'NEFT', '60 days', 'Yes', 'Yes'),
(4, 69, '20th September 2017', '1', '', 1, '', '0', 'No', '', 'NEFT', '60 days', 'Yes', 'Yes'),
(5, 70, '20th September 2017', '1', '', 1, '', '0', 'No', '', 'NEFT', '60 days', 'Yes', 'Yes'),
(6, 71, '31st March 2017', '1', '', 0, 'Please make sure that you book the venue for the client and charge 15%.', '0', 'No', '', 'NEFT', '', 'No', 'Yes'),
(7, 72, '31st March 2017', '1', '', 0, '', '0', 'No', '', 'NEFT', '', 'No', 'Yes'),
(8, 73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no'),
(9, 74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no'),
(10, 75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'no', 'no'),
(11, 76, '31st March 2017', '1', '', 0, '', '0', 'Yes', '', 'NEFT', '', 'No', 'Yes'),
(12, 77, 'March 31, 2017', '1', 'none', 0, 'We are sending "Leading the Way" book for the Vital Leader workshop', '0', 'Yes', 'Monthly', 'NEFT', '30 Days', 'No', 'Yes'),
(13, 78, '', '0', '', 0, '', '0', '', '', '', '', '0', '0'),
(14, 79, '', '0', '', 0, '', '0', '', '', '', '', '0', '0'),
(15, 80, '', '0', '', 0, '', NULL, '', '', '', '', 'Yes', '0');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_transport`
--

CREATE TABLE IF NOT EXISTS `itf_order_transport` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `order_Id` int(11) NOT NULL,
  `transport_id` varchar(255) NOT NULL,
  `value` enum('c','m','n') NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `itf_order_transport`
--

INSERT INTO `itf_order_transport` (`Id`, `order_Id`, `transport_id`, `value`) VALUES
(22, 70, '1', 'm'),
(23, 70, '2', 'c'),
(24, 70, '3', 'm'),
(25, 70, '4', 'm'),
(26, 70, '5', 'm'),
(27, 70, '11', 'n'),
(28, 70, '12', 'n'),
(29, 69, '1', 'm'),
(30, 69, '2', 'c'),
(31, 69, '3', 'm'),
(32, 69, '4', 'm'),
(33, 69, '5', 'm'),
(34, 69, '11', 'n'),
(35, 69, '12', 'n'),
(36, 68, '1', 'm'),
(37, 68, '2', 'c'),
(38, 68, '3', 'm'),
(39, 68, '4', 'm'),
(40, 68, '5', 'm'),
(41, 68, '11', 'n'),
(42, 68, '12', 'n'),
(50, 77, '1', 'n'),
(51, 77, '2', 'c'),
(52, 77, '3', 'n'),
(53, 77, '4', 'c'),
(54, 77, '5', 'n'),
(55, 77, '11', 'n'),
(56, 77, '12', 'n'),
(57, 71, '1', 'n'),
(58, 71, '2', 'm'),
(59, 71, '3', 'n'),
(60, 71, '4', 'm'),
(61, 71, '5', 'n'),
(62, 71, '11', 'n'),
(63, 71, '12', 'n'),
(64, 76, '1', 'n'),
(65, 76, '2', 'c'),
(66, 76, '3', 'n'),
(67, 76, '4', 'm'),
(68, 76, '5', 'n'),
(69, 76, '11', 'n'),
(70, 76, '12', 'n'),
(71, 72, '1', 'n'),
(72, 72, '2', 'c'),
(73, 72, '3', 'n'),
(74, 72, '4', 'm'),
(75, 72, '5', 'n'),
(76, 72, '11', 'n'),
(77, 72, '12', 'n'),
(83, 78, '1', 'c'),
(84, 78, '2', 'c'),
(85, 78, '3', 'c'),
(86, 78, '4', 'm'),
(87, 78, '5', 'm'),
(88, 80, '1', 'c'),
(89, 80, '2', 'c'),
(90, 80, '3', 'c'),
(91, 80, '4', 'm'),
(92, 80, '5', 'c');

-- --------------------------------------------------------

--
-- Table structure for table `itf_order_transportationname`
--

CREATE TABLE IF NOT EXISTS `itf_order_transportationname` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_name` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `itf_order_transportationname`
--

INSERT INTO `itf_order_transportationname` (`id`, `trans_name`, `active`, `insert_time`) VALUES
(1, 'Hotel', 1, '2016-05-31 07:35:21'),
(2, 'Venue', 1, '2016-05-31 07:35:21'),
(3, 'Cab Outstation', 1, '2016-05-31 07:35:21'),
(4, 'Cab Home-City', 1, '2016-05-31 07:35:21'),
(5, 'Air Ticketing', 1, '2016-05-31 07:35:21'),
(11, 'Train Ticketing', 1, '2016-06-21 12:37:56'),
(12, 'Visa', 1, '2016-08-26 08:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `itf_pages`
--

CREATE TABLE IF NOT EXISTS `itf_pages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_content` text NOT NULL,
  `meta_title` text NOT NULL,
  `description` text NOT NULL,
  `seo_url` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orders` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `itf_pages`
--

INSERT INTO `itf_pages` (`id`, `name`, `title`, `meta_keyword`, `meta_content`, `meta_title`, `description`, `seo_url`, `entry_date`, `orders`, `status`) VALUES
(1, 'about-us', 'About Us', 'About Us', 'About Us', 'About Us', '<div class="tex">\n<h5>Dummy text: Its function as a filler or as a tool for comparing the visual impression of different typefaces</h5>\n\n<p>Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ''real'' content. This is required when, for example, the final text is not yet available. Dummy text is also known as ''fill text''. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a ''ready-made'' text to sing</p>\n</div>\n\n<h5>The usefulness of nonsensical content</h5>\n\n<p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters and ''words'' is random, the reader will not be distracted from making a neutral judgement on the visual impact and readability of the typefaces (typography), or the distribution of text on the page (layout or type area). For this reason, dummy text usually consists of a more or less random series of words or syllables. This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression</p>\n\n<h5>Incomprehensibility or readability? That is the question.</h5>\n\n<p>The most well-known dummy text is the ''Lorem Ipsum'', which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to ''proper'' Latin. It contains a series of real Latin words. This ancient dummy text is also incomprehensible, but it imitates the rhythm of most European languages in Latin script. The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer''s attention from the layout.</p>\n', 'about-us', '2013-08-16 08:34:42', 1, 1),
(26, 'contact', 'Contact Us', 'Contact Us', 'Contact Us', 'Contact Us', '<div class="tex">\r\n<h5>Dummy text: Its function as a filler or as a tool for comparing the visual impression of different typefaces</h5>\r\n\r\n<p>Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ''real'' content. This is required when, for example, the final text is not yet available. Dummy text is also known as ''fill text''. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a ''ready-made'' text to sing</p>\r\n</div>\r\n\r\n<h5>The usefulness of nonsensical content</h5>\r\n\r\n<p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters and ''words'' is random, the reader will not be distracted from making a neutral judgement on the visual impact and readability of the typefaces (typography), or the distribution of text on the page (layout or type area). For this reason, dummy text usually consists of a more or less random series of words or syllables. This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression</p>\r\n\r\n<h5>Incomprehensibility or readability? That is the question.</h5>\r\n\r\n<p>The most well-known dummy text is the ''Lorem Ipsum'', which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to ''proper'' Latin. It contains a series of real Latin words. This ancient dummy text is also incomprehensible, but it imitates the rhythm of most European languages in Latin script. The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer''s attention from the layout.</p>\r\n', '', '2014-12-23 16:04:49', 0, 1),
(19, 'home', 'Welcome to TheSatta', 'Welcome toTheSatta', 'Welcome to TheSatta', 'Welcome to TheSatta', '<p class="justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus</p>\n', '', '2014-01-13 05:10:05', 0, 1),
(39, 'price', 'Price', 'Price', 'Price', 'Price', '<p>Price inflajfl jalkdj klaj</p>\n', '', '2015-08-15 15:32:04', 0, 1),
(40, 'games', 'Games', '', '', '', '<p>Dummy text: Its function as a filler or as a tool for comparing the visual impression of different typefaces Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ''real'' content. This is required when, for example, the final text is not yet available. Dummy text is also known as ''fill text''. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to ha</p>\n\n<p>ve a ''ready-made'' text to sing The usefulness of nonsensical content Dummy text is also used to demonstrate the appearance of different typefaces and layouts, an</p>\n\n<p>d in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters and ''words'' is random, the reader will not be distracted from making a neutral judgement on the visual impact and readability of the typefaces (typography), or the distribution of text on</p>\n\n<p>the page (layout or type area). For this reason, dummy text usually consists of a more or less random series of words or syllables. This prevents repetitive patterns from impairing the overall visual impression and facilitates the compariso</p>\n\n<p>n of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression Incomprehensibility or readability? That is the question. The most well-known dummy text is the ''Lorem Ipsum'', which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to ''proper'' Latin. It contains a series of real Latin words. This ancient dummy text is also incomprehensible, but it imitates the rhythm of most European languages in Latin script. The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer''s attention from the layout.</p>\n', '', '2015-08-15 15:41:03', 0, 1),
(22, 'not-found', 'Not found', 'Not found', 'Not found', 'Not found', '<p>Page not found, You have to go on the valid page</p>\n', '', '2014-12-23 15:03:08', 0, 1),
(27, 'policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy', '<div class="tex">\r\n<h5>Dummy text: Its function as a filler or as a tool for comparing the visual impression of different typefaces</h5>\r\n\r\n<p>Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ''real'' content. This is required when, for example, the final text is not yet available. Dummy text is also known as ''fill text''. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a ''ready-made'' text to sing</p>\r\n</div>\r\n\r\n<h5>The usefulness of nonsensical content</h5>\r\n\r\n<p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters and ''words'' is random, the reader will not be distracted from making a neutral judgement on the visual impact and readability of the typefaces (typography), or the distribution of text on the page (layout or type area). For this reason, dummy text usually consists of a more or less random series of words or syllables. This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression</p>\r\n\r\n<h5>Incomprehensibility or readability? That is the question.</h5>\r\n\r\n<p>The most well-known dummy text is the ''Lorem Ipsum'', which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to ''proper'' Latin. It contains a series of real Latin words. This ancient dummy text is also incomprehensible, but it imitates the rhythm of most European languages in Latin script. The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer''s attention from the layout.</p>\r\n\r\n', '', '2014-12-23 16:18:34', 0, 1),
(28, 'term', 'Term & Condition', 'Term & Condition', 'Term & Condition', 'Canvas Art Parties | Terms Of Service', '<div class="tex">\r\n<h5>Dummy text: Its function as a filler or as a tool for comparing the visual impression of different typefaces</h5>\r\n\r\n<p>Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with ''real'' content. This is required when, for example, the final text is not yet available. Dummy text is also known as ''fill text''. It is said that song composers of the past used dummy texts as lyrics when writing melodies in order to have a ''ready-made'' text to sing</p>\r\n</div>\r\n\r\n<h5>The usefulness of nonsensical content</h5>\r\n\r\n<p>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters and ''words'' is random, the reader will not be distracted from making a neutral judgement on the visual impact and readability of the typefaces (typography), or the distribution of text on the page (layout or type area). For this reason, dummy text usually consists of a more or less random series of words or syllables. This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression</p>\r\n\r\n<h5>Incomprehensibility or readability? That is the question.</h5>\r\n\r\n<p>The most well-known dummy text is the ''Lorem Ipsum'', which is said to have originated in the 16th century. Lorem Ipsum is composed in a pseudo-Latin language which more or less corresponds to ''proper'' Latin. It contains a series of real Latin words. This ancient dummy text is also incomprehensible, but it imitates the rhythm of most European languages in Latin script. The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer''s attention from the layout.</p>\r\n', '', '2014-12-23 16:19:39', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itf_product`
--

CREATE TABLE IF NOT EXISTS `itf_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `weight` float NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `entry_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `itf_product`
--

INSERT INTO `itf_product` (`id`, `product_type`, `name`, `price`, `weight`, `active`, `entry_Time`) VALUES
(1, 1, 'Diagnosis  Full day ', 65000, 1, 1, '2016-06-30 06:26:37'),
(2, 1, 'Diagnosis half a day ', 40000, 0.5, 1, '2016-06-30 06:27:17'),
(3, 2, 'Design Full Day', 65000, 1, 1, '2016-06-30 06:28:28'),
(4, 2, 'Design Half a day', 40000, 0.5, 1, '2016-06-30 06:29:04'),
(5, 1, 'Customised Pre- assesment Meter', 1000, 0.02, 1, '2016-06-30 06:29:41'),
(6, 1, 'Care Thermometer', 300, 0.01, 1, '2016-06-30 06:30:08'),
(7, 1, 'JUICE Thermometer', 300, 0.01, 1, '2016-06-30 06:30:37'),
(8, 1, 'Communication Thermometer ', 300, 0.01, 1, '2016-06-30 06:31:00'),
(9, 1, 'Profile Personal Impact ', 800, 0.01, 1, '2016-06-30 06:31:38'),
(10, 1, 'Profile Personal Impact ', 800, 0.01, 1, '2016-06-30 06:31:39'),
(11, 1, 'Profile 7I ', 800, 0.01, 1, '2016-06-30 06:32:19'),
(12, 1, 'Profile Ace Teams', 500, 0.01, 1, '2016-06-30 06:32:50'),
(13, 3, 'Workshop Full Day', 65000, 1, 1, '2016-06-30 06:33:51'),
(14, 3, 'Workshop  Half Day', 40000, 0.5, 1, '2016-06-30 06:34:19'),
(15, 3, 'Stage Management', 12000, 0.2, 1, '2016-06-30 06:34:50'),
(16, 3, 'Expresso Session outside NCR', 65000, 0.5, 1, '2016-06-30 06:35:29'),
(17, 3, 'Expresso Session within NCR', 40000, 0.5, 1, '2016-06-30 06:36:06'),
(18, 3, 'Implementation Day', 65000, 1, 1, '2016-06-30 06:36:33'),
(19, 3, 'If travel is more than 3 hrs from the Airport ', 40000, 0.5, 1, '2016-06-30 06:37:07'),
(20, 3, 'Coaching Call 45 minutes', 5000, 0.1, 1, '2016-06-30 06:37:54'),
(21, 3, 'Coaching Call 60 minutes', 8000, 0.1333, 1, '2016-06-30 06:38:28'),
(22, 3, 'Coaching Call on Skype (60 Minutes)', 8000, 0.1333, 1, '2016-06-30 06:39:07'),
(23, 3, 'Group Coaching Call (60 Min)', 8000, 0.1333, 1, '2016-06-30 06:39:38'),
(24, 3, 'Coaching In Person', 10000, 0.2, 1, '2016-06-30 06:40:13'),
(25, 3, 'Fruit Call (60 min)', 8000, 0.1333, 1, '2016-06-30 06:41:14'),
(26, 3, 'Tripartite Agreement in-person Meeting', 10000, 0.2, 1, '2016-06-30 06:41:46'),
(27, 3, 'Tripartite Agreement Call(60 Mins)', 8000, 0.1333, 1, '2016-06-30 06:42:19'),
(28, 3, 'Executive Coaching (90 Mins) in Person', 22000, 0.33, 1, '2016-06-30 06:44:04'),
(29, 3, 'Executive Coaching  (60 Mins) Skype', 12000, 0.2, 1, '2016-06-30 06:44:37'),
(30, 3, 'Pro-Bono Session Full Day', 0, 1, 1, '2016-06-30 06:45:07'),
(31, 3, 'Pro Bono Session Half Day', 0, 0.5, 1, '2016-06-30 06:45:34'),
(32, 3, 'Orientation Session In Person (2 hours)', 40000, 0.5, 1, '2016-06-30 06:46:03'),
(33, 4, 'Orientation Session Skype (2 hours)', 25000, 0.4, 1, '2016-06-30 06:46:41'),
(34, 3, 'Dipstick Survey', 300, 0.01, 1, '2016-06-30 06:47:12'),
(35, 3, 'Trust Contract', 3000, 0.05, 1, '2016-06-30 06:47:44'),
(36, 3, 'Learning Community', 200, 0.01, 1, '2016-06-30 06:48:14'),
(37, 3, 'Open Workshop Dramatic Shift', 45000, 0, 1, '2016-06-30 06:48:51'),
(38, 3, 'Open Workshop Presenting With Presence', 32000, 0, 1, '2016-06-30 06:49:15'),
(39, 3, 'Open Workshop Personal Impact', 32000, 0, 1, '2016-06-30 06:49:45'),
(41, 3, 'Cards', 400, 0, 1, '2016-11-24 08:03:35'),
(42, 1, 'Leading the Way', 65000, 1, 1, '2016-11-28 10:10:21'),
(43, 1, 'Impact & Influence ', 426000, 1, 1, '2016-11-29 04:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `itf_projectmanager`
--

CREATE TABLE IF NOT EXISTS `itf_projectmanager` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email_Id` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `entry_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `itf_projectmanager`
--

INSERT INTO `itf_projectmanager` (`Id`, `name`, `email_Id`, `active`, `entry_Time`) VALUES
(1, 'Kamal', 'kamal@gmail.com', 1, '2016-07-01 06:41:08'),
(2, 'Kiran', 'kiran@gmail.com', 1, '2016-07-01 06:41:36'),
(15, 'Kiran kher', 'kiran@gmail.com', 1, '2016-07-01 10:57:09'),
(16, 'Dev Raj', 'raj@gmail.com', 1, '2016-07-01 11:11:49'),
(23, 'rahul', 'rahul@gmail.ciom', 1, '2016-07-01 11:20:07'),
(24, 'Kamal', 'kamal@gmail.com', 1, '2016-07-01 11:21:36'),
(29, 'NItesh', 'nityesh@gmail.com', 1, '2016-07-03 08:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `itf_resouces`
--

CREATE TABLE IF NOT EXISTS `itf_resouces` (
  `clientname` varchar(255) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `programdate` varchar(255) NOT NULL,
  `target_date` varchar(255) NOT NULL,
  `participants_briefed` varchar(255) NOT NULL,
  `deliverables` int(255) NOT NULL,
  `learningCommunity` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `cards` varchar(255) NOT NULL,
  `trustContract` varchar(255) NOT NULL,
  `workshopPictures` varchar(255) NOT NULL,
  `books` varchar(255) NOT NULL,
  `anyOthers` varchar(255) NOT NULL,
  `progressIT` varchar(255) NOT NULL,
  `logisticsRating` varchar(255) NOT NULL,
  `cani` varchar(255) NOT NULL,
  `better` varchar(255) NOT NULL,
  `logisticsWorkshopContent` varchar(255) NOT NULL,
  `trainingMaterials` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itf_resouces`
--

INSERT INTO `itf_resouces` (`clientname`, `program_name`, `programdate`, `target_date`, `participants_briefed`, `deliverables`, `learningCommunity`, `feedback`, `cards`, `trustContract`, `workshopPictures`, `books`, `anyOthers`, `progressIT`, `logisticsRating`, `cani`, `better`, `logisticsWorkshopContent`, `trainingMaterials`) VALUES
('Anita', 'a', '', '', '0', 0, '', '', '0', '0', '0', '0', '0', '0', '0', '', '', '', ''),
('0', '0', '0', '11/03/2016', '0', 0, '', '', '0', '0', '0', '0', '0', '0', '0', '', '', '', ''),
('0', '0', '0', '11/03/2016', '0', 0, '', '', '0', '0', '0', '0', '0', '0', '0', '', '', '', ''),
('0', '0', '0', '11/03/2016', '0', 0, 'visha', 'ljhgdjhs', '0', '', '0', '0', '0', '0', '0', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `itf_sellers`
--

CREATE TABLE IF NOT EXISTS `itf_sellers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email_Id` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `entry_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `itf_sellers`
--

INSERT INTO `itf_sellers` (`id`, `name`, `email_Id`, `active`, `entry_Time`) VALUES
(1, 'Dharm', 'dharm@gmail.com', 1, '2016-07-01 06:38:52'),
(2, 'Dhirendra', 'dhirendra@gmail.com', 1, '2016-07-01 06:39:36'),
(3, 'Dev Raj', 'dev@gmail.com', 1, '2016-07-01 06:40:26'),
(4, 'Dev Raj12', 'dev12@gmail.com', 1, '2016-07-03 10:47:32');

-- --------------------------------------------------------

--
-- Table structure for table `itf_siteconfig`
--

CREATE TABLE IF NOT EXISTS `itf_siteconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_code` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `orders` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `itf_siteconfig`
--

INSERT INTO `itf_siteconfig` (`id`, `field_code`, `field_name`, `field_value`, `status`, `orders`, `entry_date`) VALUES
(1, 'site_title', 'Site Title', 'Maynardleigh associates', 1, 1, '2013-08-21 05:18:13'),
(2, 'google_code', 'Google Code', 'google code', 1, 3, '2013-08-21 05:18:13'),
(3, 'contact_email', 'Contact Email', 'info@itfosters.com', 1, 2, '2013-08-21 05:19:24'),
(4, 'site_keyword', 'Site Keyword', 'Maynardleigh associates', 1, 4, '2013-08-26 04:26:49'),
(5, 'site_content', 'Meta Content', 'Maynardleigh associates', 1, 5, '2013-08-26 04:27:38'),
(7, 'site_email', 'Site Email', 'admin@itfosters.com', 1, 0, '2015-09-12 14:42:14'),
(8, 'site_phone', 'Site Phone', '9717807162', 1, 0, '2015-09-12 14:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `itf_subproducts`
--

CREATE TABLE IF NOT EXISTS `itf_subproducts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `entry_Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=168 ;

--
-- Dumping data for table `itf_subproducts`
--

INSERT INTO `itf_subproducts` (`id`, `name`, `parent_id`, `active`, `entry_Time`) VALUES
(1, 'Dramatic shift', 0, 1, '2016-09-07 06:36:31'),
(2, 'Personal Impact', 0, 1, '2016-09-07 06:40:25'),
(3, 'Leading the way', 5, 1, '2016-09-07 06:40:39'),
(4, 'Leading your team', 0, 1, '2016-09-07 06:42:28'),
(5, 'Care', 0, 1, '2016-09-07 06:42:45'),
(6, 'Juice', 5, 1, '2016-09-07 06:42:57'),
(8, 'Presenting with Presence', 5, 1, '2016-09-07 06:43:43'),
(9, 'Team Building', 0, 1, '2016-09-07 06:43:57'),
(10, 'Campus to Corporate', 0, 1, '2016-09-07 06:44:11'),
(11, 'Reaching your peak', 4, 1, '2016-09-07 06:44:24'),
(12, 'Impact & Influence', 1, 1, '2016-09-07 06:44:40'),
(13, '30 Second preparation technique', 2, 1, '2016-10-19 13:50:52'),
(14, 'Character profile', 2, 1, '2016-10-19 13:51:35'),
(15, 'Impact And Influence', 0, 1, '2016-10-20 10:16:56'),
(16, 'Character Profile', 15, 1, '2016-10-20 10:19:29'),
(17, 'Informal encounter', 15, 1, '2016-10-20 10:20:44'),
(18, 'Emotional expression', 15, 1, '2016-10-20 10:22:01'),
(19, 'Personal impact It’s reciprocal', 15, 1, '2016-10-20 10:22:51'),
(21, 'Quick warm up', 15, 1, '2016-10-20 10:24:35'),
(22, 'Facial expressions', 15, 1, '2016-10-20 10:25:41'),
(23, '30 second preparation', 15, 1, '2016-10-20 10:26:32'),
(24, 'Building rapport', 15, 1, '2016-10-20 10:27:07'),
(25, 'Ppsaao', 15, 1, '2016-10-20 10:27:44'),
(26, 'Influence Aim', 15, 1, '2016-10-20 10:28:30'),
(27, 'Process for influence', 15, 1, '2016-10-20 10:29:14'),
(28, 'Subtexts', 15, 1, '2016-10-20 10:29:54'),
(29, 'One mint speech', 15, 1, '2016-10-20 10:30:31'),
(30, 'A4 sheet & Drawing Sheet & Name Tag', 15, 1, '2016-10-20 10:31:07'),
(31, 'Folder with stop, start, continue sheet', 15, 1, '2016-10-20 10:31:48'),
(32, 'Charisma effect books', 15, 1, '2016-10-20 10:32:34'),
(33, '1ps mask & 1ps Ball ', 15, 1, '2016-10-20 10:33:14'),
(34, 'Camera with stand', 15, 1, '2016-10-20 10:33:46'),
(35, 'Spy', 15, 1, '2016-10-20 10:34:20'),
(36, 'Feeling card PWP wale', 15, 1, '2016-10-20 10:35:11'),
(37, 'Pwp poster not Five 5ps likhe wale ', 15, 1, '2016-10-20 10:35:42'),
(38, 'Personal impact poster ', 15, 1, '2016-10-20 10:36:13'),
(39, 'Status card', 15, 1, '2016-10-20 10:36:41'),
(40, 'Color pen & Flip chart Marker & Board marker', 15, 1, '2016-10-20 10:37:11'),
(41, 'Blue tag', 15, 1, '2016-10-20 10:37:34'),
(42, 'Props ( small )', 15, 1, '2016-10-20 10:38:05'),
(43, 'Medicine box1.', 15, 1, '2016-10-20 10:38:39'),
(44, 'A warm welcome to personal impact', 2, 1, '2016-10-20 10:57:27'),
(45, 'Emotional expression', 2, 1, '2016-10-20 10:58:11'),
(46, 'Entrances and subtexts', 2, 1, '2016-10-20 10:58:45'),
(47, 'Facial expression', 2, 1, '2016-10-20 10:59:21'),
(48, 'First impression', 2, 1, '2016-10-20 10:59:55'),
(49, 'Focus of attention', 2, 1, '2016-10-20 11:00:42'),
(50, 'How we communicate', 2, 1, '2016-10-20 11:01:11'),
(51, 'Informal encounter', 2, 1, '2016-10-20 11:01:41'),
(52, 'Mood', 2, 1, '2016-10-20 11:02:09'),
(53, 'Personal impact A – Aim', 2, 1, '2016-10-20 11:02:43'),
(54, 'Personal impact ABC', 2, 1, '2016-10-20 11:03:18'),
(55, 'Personal impact yourself', 2, 1, '2016-10-20 11:03:54'),
(56, 'Personal impact C Chemistry', 2, 1, '2016-10-20 11:04:31'),
(57, 'Personal impact Evaluation sheet', 2, 1, '2016-10-20 11:04:57'),
(58, 'Personal impact It’s Reciprocal ', 2, 1, '2016-10-20 11:05:23'),
(59, 'Poem In pairs', 2, 1, '2016-10-20 11:05:55'),
(60, 'Quick warm up', 2, 1, '2016-10-20 11:06:28'),
(61, 'Quote ', 2, 1, '2016-10-20 11:06:55'),
(62, 'Tips for making a personal impact', 2, 1, '2016-10-20 11:07:35'),
(63, 'Tips for social situation ', 2, 1, '2016-10-20 11:08:07'),
(64, 'Charisma effect Books ', 2, 1, '2016-10-20 11:08:41'),
(65, 'Personal impact do it now card', 2, 1, '2016-10-20 11:09:12'),
(66, 'Personal impact poster ', 2, 1, '2016-10-20 11:09:39'),
(67, 'Props', 2, 1, '2016-10-20 11:10:09'),
(68, 'Camera with stand ', 2, 1, '2016-10-20 11:10:52'),
(69, 'Tai chi stick', 2, 1, '2016-10-20 11:13:16'),
(70, 'Blue tag', 2, 1, '2016-10-20 11:13:51'),
(71, '1ps mask and 1ps boll', 2, 1, '2016-10-20 11:15:25'),
(72, 'Stop, start, continue sheet', 2, 1, '2016-10-20 11:16:10'),
(73, 'Mla folder ', 2, 1, '2016-10-20 11:16:35'),
(74, 'Drawing sheet & A4 sheet & Name tag', 2, 1, '2016-10-20 11:17:08'),
(75, 'Color pen ', 2, 1, '2016-10-20 11:17:41'),
(76, 'Flip chart marker', 2, 1, '2016-10-20 11:18:14'),
(77, 'Board marker', 2, 1, '2016-10-20 11:18:45'),
(78, 'Medicine box', 2, 1, '2016-10-20 11:19:21'),
(79, 'Test Product', 5, 1, '2016-10-23 14:26:31'),
(80, 'Presenting with Presence', 0, 1, '2016-11-03 09:50:50'),
(81, 'The Wining Streak', 0, 1, '2016-11-22 09:20:20'),
(82, 'Leading the Way', 0, 1, '2016-11-28 10:13:41'),
(83, 'Quick coach', 82, 1, '2016-11-29 05:54:32'),
(84, 'Symptoms of will – skill gaps', 82, 1, '2016-11-29 05:55:00'),
(85, 'Question', 82, 1, '2016-11-29 09:01:55'),
(86, 'Grow question', 82, 1, '2016-11-29 09:02:26'),
(87, 'Giving & receiving feedback', 82, 1, '2016-11-29 09:02:54'),
(88, 'Five zone of delegation ', 82, 1, '2016-11-29 09:03:16'),
(89, 'Developing insight ', 82, 1, '2016-11-29 09:03:40'),
(90, 'Coaching sheet ', 82, 1, '2016-11-29 09:03:58'),
(91, 'Goal sheet max life wali', 82, 1, '2016-11-29 09:06:41'),
(92, 'A4 sheet & Drawing sheet & Name Tag', 82, 1, '2016-11-29 09:07:41'),
(93, 'Folder With Stop Start continue sheet', 82, 1, '2016-11-29 09:08:08'),
(94, 'Leading your team books', 82, 1, '2016-11-29 09:08:32'),
(95, 'Do it now card talent ', 82, 1, '2016-11-29 09:08:52'),
(96, 'Blood test', 82, 1, '2016-11-29 09:09:18'),
(97, '2 Balti game + 16 balls', 82, 1, '2016-11-29 09:09:37'),
(98, 'Presenting with presence – recourse ', 80, 1, '2016-11-29 09:11:24'),
(99, 'The 5P’s of powerful presenting', 80, 1, '2016-11-29 09:11:48'),
(100, 'How we communicate', 80, 1, '2016-11-29 09:12:39'),
(101, 'Preparation – preparing yourself', 80, 1, '2016-11-29 09:13:00'),
(102, 'Tongue twisters', 80, 1, '2016-11-29 09:13:18'),
(103, 'Left and right brain functions ', 80, 1, '2016-11-29 09:13:36'),
(104, 'Mind mapping A', 80, 1, '2016-11-29 09:13:52'),
(105, 'Mind mapping B', 80, 1, '2016-11-29 09:14:08'),
(106, 'Story board – Blank', 80, 1, '2016-11-29 09:14:23'),
(107, 'Story board', 80, 1, '2016-11-29 09:14:44'),
(108, 'Purpose – conversation Hello', 80, 1, '2016-11-29 09:15:03'),
(109, 'Purpose – think feel act', 80, 1, '2016-11-29 09:15:21'),
(110, 'How moment – to – moment purpose ', 80, 1, '2016-11-29 09:15:50'),
(111, 'Purpose – effect ', 80, 1, '2016-11-29 09:16:06'),
(112, 'One minute speech ', 80, 1, '2016-11-29 09:16:23'),
(113, 'Tips for dealing with the unexpected', 80, 1, '2016-11-29 09:16:39'),
(114, 'Tips for  handing nerves in presentations', 80, 1, '2016-11-29 09:16:56'),
(115, 'Tips for handing question time ', 80, 1, '2016-11-29 09:17:15'),
(116, 'Presenting with presence – book list  A', 80, 1, '2016-11-29 09:17:41'),
(117, 'Follow – Up reading and viewing B', 80, 1, '2016-11-29 09:18:01'),
(118, 'Quote ', 80, 1, '2016-11-29 09:18:16'),
(119, 'Presenting with presence – evolution sheet ', 80, 1, '2016-11-29 09:18:33'),
(120, 'Tips for using computer slides ', 80, 1, '2016-11-29 09:18:48'),
(121, 'Continue sheet', 80, 1, '2016-11-29 09:19:08'),
(122, 'Mla folder', 80, 1, '2016-11-29 09:19:29'),
(123, 'Prefect presentation Books', 80, 1, '2016-11-29 09:20:00'),
(124, 'Do it now card Engaging talent', 80, 1, '2016-11-29 09:20:18'),
(125, 'Camera with stand and pen drives', 80, 1, '2016-11-29 09:20:39'),
(126, 'Personality card and feeling  card and chits ', 80, 1, '2016-11-29 09:21:03'),
(127, 'Eli chi and Cap and Pwp certificate', 80, 1, '2016-11-29 09:21:30'),
(128, 'CD marker and one ball and one mask', 80, 1, '2016-11-29 09:21:51'),
(129, 'Extension board ', 80, 1, '2016-11-29 09:22:23'),
(130, 'Drawing sheet & A4 Sheet & Name tag', 80, 1, '2016-11-29 09:25:11'),
(131, 'Color pen & Flip  chart marker & Board marker', 80, 1, '2016-11-29 09:25:38'),
(132, 'Medicine box ', 80, 1, '2016-11-29 09:25:56'),
(133, 'Blue tag', 80, 1, '2016-11-29 09:26:13'),
(134, 'Pwp poster', 80, 1, '2016-11-29 09:26:38'),
(135, 'Mla Books &Mineral Water & MLA Not Pad & Pen & PWP Standby & Wirth Board with Stand & Flip chart & TV.', 80, 1, '2016-11-29 09:27:02'),
(136, 'Mla Books &amp;Mineral Water &amp; MLA Not Pad &amp; Pen &amp; PWP Standby &amp;  Wirth Board with Stand &amp; Flip chart &amp; TV.', 2, 1, '2016-11-29 09:33:48'),
(137, 'Action/Who', 1, 1, '2016-11-29 09:36:18'),
(138, 'After the ball is over', 1, 1, '2016-11-29 09:36:45'),
(139, 'Central character', 1, 1, '2016-11-29 09:37:13'),
(140, 'Dramatic plan of action', 1, 1, '2016-11-29 09:37:41'),
(141, 'Dramatic shift – networking', 1, 1, '2016-11-29 09:38:11'),
(142, 'Dramatic shift – final evaluation', 1, 1, '2016-11-29 09:38:46'),
(143, 'Moods', 1, 1, '2016-11-29 09:39:13'),
(144, 'Mad, Sad, Glad, Afraid', 1, 1, '2016-11-29 09:39:45'),
(145, 'Overnight work', 1, 1, '2016-11-29 09:40:05'),
(146, 'The transformation scene', 1, 1, '2016-11-29 09:40:22'),
(147, 'The transformation scene Blank', 1, 1, '2016-11-29 09:40:41'),
(148, 'A4 sheet, &amp; Drawing Sheet, &amp; Name tag', 1, 1, '2016-11-29 09:41:02'),
(149, 'Folder with Stop Start Continue Sheet', 1, 1, '2016-11-29 09:41:22'),
(150, 'Dramatic success books', 1, 1, '2016-11-29 09:41:43'),
(151, 'Custom maximum', 1, 1, '2016-11-29 09:42:17'),
(152, 'Props Maximum', 1, 1, '2016-11-29 09:42:38'),
(153, 'Custom ke liye stand &amp; hanger', 1, 1, '2016-11-29 09:42:57'),
(154, 'Pen &amp; Color Pen 100ps &amp; Flip Chart Marker 2set &amp; Board Marker 2set', 1, 1, '2016-11-29 09:43:17'),
(155, 'Pencil &amp; Rabber &amp; Sharpener', 1, 1, '2016-11-29 09:43:33'),
(156, 'Flip chart 6ps &amp; Wirth Board 2ps &amp; Stand', 1, 1, '2016-11-29 09:43:53'),
(157, 'Balloons all animal', 1, 1, '2016-11-29 09:44:10'),
(158, 'Medicine box', 1, 1, '2016-11-29 09:44:26'),
(159, 'Dramatic shift certificate.', 1, 1, '2016-11-29 09:44:45'),
(160, 'Trunk 3no ps', 1, 1, '2016-11-29 09:45:00'),
(161, 'Dramatic shift poster', 1, 1, '2016-11-29 09:45:16'),
(162, 'Manyardleigh standy', 1, 1, '2016-11-29 09:45:38'),
(163, 'Do-It Now Cards - How to engage talent', 0, 1, '2016-12-01 10:59:17'),
(164, 'Do-It Now Cards - Team Impact', 0, 1, '2016-12-01 11:03:14'),
(165, 'Do-It Now Cards - Lead with Impact', 0, 1, '2016-12-01 11:17:21'),
(166, 'Do-It Now Cards - Personal Impact', 0, 1, '2016-12-01 11:17:37'),
(167, 'Do-It Now Cards - How to Present', 0, 1, '2016-12-01 11:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `itf_trf_information`
--

CREATE TABLE IF NOT EXISTS `itf_trf_information` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `diagnose_id` bigint(255) NOT NULL,
  `user_id` bigint(25) DEFAULT NULL,
  `mode` varchar(255) NOT NULL,
  `journey_date` varchar(255) NOT NULL,
  `return_date` varchar(225) DEFAULT NULL,
  `checkin_date` varchar(225) DEFAULT NULL,
  `checkout_date` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `preferred_train` varchar(225) DEFAULT NULL,
  `preferred_cab` varchar(225) DEFAULT NULL,
  `preferred_hotel` varchar(225) DEFAULT NULL,
  `room_preference` varchar(225) DEFAULT NULL,
  `diet_remark` varchar(225) DEFAULT NULL,
  `star_category` varchar(225) DEFAULT NULL,
  `budget` varchar(225) DEFAULT NULL,
  `breakfast` int(11) DEFAULT NULL,
  `meals` int(11) DEFAULT NULL,
  `select_option` varchar(225) DEFAULT NULL,
  `journey_from` varchar(255) NOT NULL,
  `journey_destination` varchar(255) NOT NULL,
  `preferred` varchar(255) NOT NULL,
  `clause` varchar(255) NOT NULL,
  `dept_time` varchar(255) DEFAULT NULL,
  `food` varchar(255) DEFAULT NULL,
  `order_type` enum('1','2','3','4') NOT NULL COMMENT '1=>DIAGNOSE, 2=>Design, 3=>Delivery, 4=> Discovery',
  `description` varchar(255) DEFAULT NULL,
  `venuedetail` text,
  `descriptions` varchar(255) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `itf_trf_information`
--

INSERT INTO `itf_trf_information` (`id`, `order_id`, `diagnose_id`, `user_id`, `mode`, `journey_date`, `return_date`, `checkin_date`, `checkout_date`, `city`, `preferred_train`, `preferred_cab`, `preferred_hotel`, `room_preference`, `diet_remark`, `star_category`, `budget`, `breakfast`, `meals`, `select_option`, `journey_from`, `journey_destination`, `preferred`, `clause`, `dept_time`, `food`, `order_type`, `description`, `venuedetail`, `descriptions`, `entry_date`, `status`) VALUES
(1, 89, 15, 103, 'Hotel', '', '', '2016/10/23', '2016/10/10', '', NULL, NULL, 'Taj', NULL, NULL, NULL, '999', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, ' asdf', '2016-10-23 13:10:22', 0),
(2, 89, 15, 103, 'Hotel', '', '', '2016/09/27', '2016/09/26', '', NULL, NULL, 'Taj', NULL, NULL, NULL, '999', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, ' sdfdf', '2016-10-23 13:12:33', 0),
(3, 89, 15, 84, 'air', '', '', '', '', '', NULL, NULL, '', 'select room', '', 'Select Hotel Type', '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', '   ', NULL, NULL, '2016-10-27 07:20:50', 0),
(4, 89, 15, 84, 'Hotel', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 07:23:10', 0),
(5, 89, 15, 84, 'Hotel', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 07:31:47', 0),
(6, 89, 15, 84, 'Hotel', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 07:32:22', 0),
(7, 89, 15, 84, 'Hotel', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 07:34:06', 0),
(8, 89, 15, 84, 'air', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 07:35:47', 0),
(9, 89, 15, 84, 'Hotel', '', '', '', '', '', NULL, NULL, '', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 07:36:20', 0),
(10, 89, 15, 91, 'Hotel', '', '', '2016/10/27', '2016/09/27', '', NULL, NULL, 'sdfs', NULL, NULL, NULL, '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' sdfs', NULL, NULL, '2016-10-27 07:38:17', 0),
(11, 89, 15, 84, 'Hotel', '', '', '2016/06/27', '2017/01/11', 'delhi', NULL, NULL, 'Taj', 'smoking', 'Remark', '5', '999', 1, 1, NULL, '', '', '1', '0', '', '0', '1', ' welcome', NULL, NULL, '2016-10-27 08:00:59', 0),
(12, 89, 15, 92, 'Hotel', '', '', '2016/08/08', '2017/01/04', 'mumbai', NULL, NULL, 'Amrapali', NULL, '55555', 'nonsmoking', '12', NULL, 1, NULL, '', '', '1', '0', '', '0', '1', ' no thanks', NULL, NULL, '2016-10-27 10:01:58', 0),
(14, 89, 15, 92, 'air', '2016/09/26', '2016/10/29', '', '', 'mumbai', NULL, NULL, '', '', '', '', '', NULL, NULL, NULL, 'Delhi Airport', 'Guraong Hotel', '3', 'before', '12:30 AM', 'veg', '1', ' good ', NULL, NULL, '2016-10-27 10:09:58', 0),
(15, 89, 15, 92, 'train', '2016/10/03', '2016/10/28', '', '', 'mumbai', 'Ag Kranti Rajdhani', NULL, '', '', '', '', '', NULL, NULL, NULL, 'bengluru', 'kamakhya', '1', 'after', '12:30 AM', 'non-veg', '1', ' dddddddddddddddd', NULL, NULL, '2016-10-27 10:11:18', 0),
(16, 89, 15, 92, 'cab', '2016/09/26', '2016/10/21', '', '', 'mumbai', '', NULL, '', '', '', '', '', NULL, NULL, NULL, 'Delhi Airport', 'Hauzkhar', '1', 'after', '12:30 AM', '0', '1', 'sadasdasd', NULL, NULL, '2016-10-27 10:24:37', 0),
(17, 89, 15, 84, 'air', '', '', '', '', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 10:40:05', 0),
(19, 89, 15, 91, 'train', '', '', '', '', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 10:43:59', 0),
(20, 89, 15, 92, 'Hotel', '', '', '', '', '', '', NULL, '', '', '', '', '', NULL, NULL, NULL, '', '', '1', '0', '', '0', '1', ' ', NULL, NULL, '2016-10-27 10:44:13', 0),
(21, 89, 26, 59, 'train', '2016/09/26', '2016/09/30', '', '', 'smp', 'Lokmanyatilak Terminus Ac Superfast', NULL, '', '', '', '', '', NULL, NULL, NULL, 'hghh', 'delhi', '1', 'before', '12:30 AM', 'non-veg', '1', ' hjvghfvghfv ', NULL, NULL, '2016-10-27 10:58:12', 0),
(23, 89, 16, 59, 'air', '2016/09/26', '2016/09/28', '', '', 'dubai', '', NULL, '', '', '', '', '', NULL, NULL, NULL, 'delhi', 'pune', '2', 'before', '12:30 AM', 'veg', '1', ' nb nbnm', NULL, NULL, '2016-10-27 11:06:41', 0),
(26, 89, 25, 103, 'air', '2016/10/03', '2016/10/28', '', '', 'mumbai', '', NULL, '', '', '', '', '', NULL, NULL, NULL, 'bengluru', 'Hauzkhar', '8', 'before', '01:30 AM', 'veg', '1', ' ggghhhhhhhjj', NULL, NULL, '2016-10-27 13:07:51', 0),
(27, 89, 16, 59, 'Hotel', '', '', '2016/10/04', '2016/10/11', 'delhi', '', NULL, 'Amrapali', 'nonsmoking', '111111', '3', '111111', 1, 1, NULL, '', '', '0', '0', '', '0', '1', ' ggjvhj', NULL, NULL, '2016-10-27 13:09:01', 0),
(28, 89, 26, 57, 'air', '2016/09/27', '2016/09/29', '', '', 'pune', '', NULL, '', '', '', '', '', NULL, NULL, NULL, 'pune', 'mumbai', '9', 'after', '12:30 AM', 'non-veg', '1', ' i want to book..', NULL, NULL, '2016-10-27 13:36:35', 0),
(29, 58, 13, 0, 'train', '', '', '', '', 'delhi', '', NULL, '', '', '', '', '', NULL, NULL, NULL, '', '', '0', '0', '', '0', '1', '  ', NULL, NULL, '2016-10-27 14:14:16', 0),
(30, 58, 15, 119, 'air', '2016/09/26', '2016/10/03', '', '', 'delhi', '', NULL, '', '', '', '', '', NULL, NULL, NULL, 'Delhi', 'Kolkata', '26', 'after', '12:30 AM', 'non-veg', '1', ' ', NULL, NULL, '2016-10-28 09:23:01', 0),
(31, 58, 26, 118, 'air', '2016/10/04', '2016/10/11', '', '', 'Delhi', '', '', '', '', '', '', '', NULL, NULL, NULL, 'Delhi', 'Patna', '26', '0', '', 'veg', '1', ' ', NULL, NULL, '2016-10-31 11:34:00', 0),
(32, 58, 26, 118, 'train', '2016/10/18', '', '', '', 'Delhi', '', '', '', '', '', '', '', NULL, NULL, NULL, 'New Delhi', 'Patna', '0', 'after', '12:00 AM', 'veg', '1', ' ', NULL, NULL, '2016-10-31 11:40:23', 0),
(33, 58, 26, 118, 'cab', '2016/10/04', '', '', '', 'Delhi', '', 'Mega Cabse', '', '', '', '', '', NULL, NULL, NULL, 'Airport', 'Taj Hotel', '0', 'after', '12:00 AM', '0', '1', ' ', NULL, NULL, '2016-10-31 11:42:25', 0),
(34, 58, 26, 118, 'cab', '2016/11/17', '', '', '', 'Delhi', '', 'Meru Cabs', '', '', '', '', '', NULL, NULL, NULL, 'Taj Hotel', 'Delhi Airport', '0', 'after', '12:30 AM', '0', '1', ' ', NULL, NULL, '2016-10-31 11:42:56', 0),
(35, 62, 17, 119, 'air', '2016/11/09', '2016/11/26', '', '', 'ghaziabad city', '', '', '', '', '', '', '', NULL, NULL, NULL, 'Delhi', 'Kolkata', '28', 'before', '12:30 AM', 'non-veg', '1', ' AIR', NULL, NULL, '2016-11-03 10:18:24', 0),
(36, 61, 28, 118, 'train', '2016/11/30', '', '', '', 'Delhi', 'Rajdhani', '', '', '', '', '', '', NULL, NULL, NULL, 'Delhi', 'Patna', '0', 'after', '12:30 AM', 'veg', '1', ' ', NULL, NULL, '2016-11-03 10:21:01', 0),
(39, 58, 29, 119, 'train', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-04 11:24:06', 0),
(40, 62, 31, 152, 'air', '2016/11/29', '2016/11/01', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'Delhi', 'Patna', '26', 'before', '09:00 AM', 'veg', '1', ' ', NULL, NULL, '2016-11-06 15:30:58', 0),
(41, 62, 31, 152, 'Hotel', '', '', '2016/12/30', '2017/01/01', 'Delhi', '', '', 'This Ginger', 'smoking', 'Thank you', '4', '344', 1, 1, NULL, '', '', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-06 15:32:02', 0),
(42, 62, 31, 152, 'cab', '2016/12/30', '', '', '', 'Patna', '', 'Uber', '', '', '', '', '', NULL, NULL, NULL, 'Patna Airport', 'The Ginger Hotel', '0', 'before', '04:30 AM', '0', '1', ' ', NULL, NULL, '2016-11-06 15:33:23', 0),
(43, 62, 31, 152, 'cab', '2017/01/01', '', '', '', 'Patna', '', 'Meru Cabs', '', '', '', '', '', NULL, NULL, NULL, 'The Ginger Hotel', 'Airtel', '0', 'after', '12:30 AM', '0', '1', ' ', NULL, NULL, '2016-11-06 15:34:30', 0),
(44, 58, 9, 143, 'air', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-07 11:16:58', 0),
(46, 63, 32, 117, 'air', '2016/11/28', '2016/11/30', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'pune', 'chennai', '26', 'after', '07:00 PM', 'non-veg', '1', '  fukvyulvikhgfchmbnhuilo', NULL, NULL, '2016-11-09 09:19:24', 0),
(47, 63, 18, 117, 'air', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '27', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-09 09:39:48', 0),
(48, 58, 9, 142, 'air', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '30', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-09 11:02:07', 0),
(49, 63, 18, 117, 'air', '2016/09/12', '2016/11/30', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'jammu', 'singhapur', '26', 'after', '12:30 AM', 'non-veg', '1', ' aiiiiiiir', NULL, NULL, '2016-11-11 06:16:26', 0),
(50, 63, 18, 117, 'train', '2016/10/30', '2016/11/15', '', '', 'ghaziabad city', 'vaishali ex', '', '', '', '', '', '', NULL, NULL, NULL, 'barauni jn', 'new delhi', '0', 'before', '12:00 AM', 'non-veg', '1', ' trainnnnnnnnnnnnn', NULL, NULL, '2016-11-11 06:17:34', 0),
(51, 63, 18, 117, 'cab', '2016/11/06', '', '', '', 'Delhi', '', 'Uber', '', '', '', '', '', NULL, NULL, NULL, 'ashram', 'airport', '0', 'before', '12:30 AM', '0', '1', 'cabbbbbbbbbbbbbbbbbb', NULL, NULL, '2016-11-11 06:18:31', 0),
(52, 63, 18, 117, 'Hotel', '', '', '2016/11/01', '2016/11/16', 'guragaon', '', '', 'amrapali', 'smoking', 'remark', '3', 'yes', 1, 1, NULL, '', '', '0', '0', '', '0', '1', ' hotelllllllllllllllll', NULL, NULL, '2016-11-11 06:19:45', 0),
(53, 65, 19, 117, 'Hotel', '', '', '2016/12/23', '2016/12/25', 'delhi', '', '', 'amrapali', 'smoking', 'remark', '5', 'yes', 1, 1, NULL, '', '', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-11 08:54:25', 0),
(54, 63, 33, 119, 'train', '2016/10/30', '2016/11/24', '', '', 'ghaziabad city', 'jansadharan', '', '', '', '', '', '', NULL, NULL, NULL, 'barauni jn', 'airport', '0', 'before', '12:30 AM', 'non-veg', '1', ' ', NULL, NULL, '2016-11-11 12:32:16', 0),
(55, 63, 33, 119, 'train', '2016/10/30', '2016/11/24', '', '', 'ghaziabad city', 'jansadharan', '', '', '', '', '', '', NULL, NULL, NULL, 'barauni jn', 'airport', '0', 'before', '', 'non-veg', '1', ' ', NULL, NULL, '2016-11-11 12:33:44', 0),
(56, 65, 19, 154, 'air', '2016/12/01', '2016/12/03', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'Delhi', 'Kathmandu', '27', 'before', '12:00 AM', 'veg', '1', ' ', NULL, NULL, '2016-11-15 10:00:04', 0),
(57, 65, 19, 154, 'cab', '2016/12/01', '', '', '', 'Delhi', '', 'Uber', '', '', '', '', '', NULL, NULL, NULL, 'Airport ', 'Delhi', '0', 'after', '08:00 AM', '0', '1', ' ', NULL, NULL, '2016-11-15 10:00:40', 0),
(58, 65, 19, 154, 'Hotel', '', '', '2016/12/01', '2016/12/02', 'Delhi', '', '', 'Taj', 'smoking', 'Need clean test', '3', '', 1, 1, NULL, '', '', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-15 10:02:01', 0),
(59, 66, 36, 154, 'air', '2016/12/07', '2016/12/09', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'delhi', 'chennai', '26', 'after', '05:30 PM', 'non-veg', '1', '  ', NULL, NULL, '2016-11-15 10:51:48', 0),
(60, 66, 36, 154, 'Hotel', '', '', '2016/11/07', '2016/11/09', 'chennai', '', '', '', 'nonsmoking', '', '4', '5000', 1, NULL, NULL, '', '', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-15 10:52:49', 0),
(61, 66, 38, 154, 'air', '2016/11/21', '2016/11/23', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'delhi', 'pune', '26', 'after', '8:00 pm', 'non-veg', '1', '   ft5432', NULL, NULL, '2016-11-18 11:15:16', 0),
(62, 66, 38, 154, 'Hotel', '', '', '2016/11/21', '2016/11/23', 'pune', '', '', '', 'Non Smoking', '', '4 Star', '5000', 1, NULL, NULL, '', '', '0', '0', '', '0', '1', '  lemon tree', NULL, NULL, '2016-11-18 11:20:56', 0),
(63, 72, 43, 0, 'cab', '2016/11/24', '', '', '', 'Mumbai', '', 'Uber', '', '', '', '', '', NULL, NULL, NULL, 'Nitten''s Residence', 'Ericcson Office', '0', '0', '', '0', '1', ' ', NULL, NULL, '2016-11-25 04:59:47', 0),
(64, 76, 22, 178, 'air', '2016/11/30', '2016/12/02', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, 'delhi', 'gurgaon', '26', 'after', '05:30 PM', 'non-veg', '1', ' ', NULL, NULL, '2016-11-29 08:21:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `itf_trf_PreferredAirlince`
--

CREATE TABLE IF NOT EXISTS `itf_trf_PreferredAirlince` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `itf_trf_PreferredAirlince`
--

INSERT INTO `itf_trf_PreferredAirlince` (`id`, `name`, `parent_id`, `active`) VALUES
(25, 'Select Preffered Airlince', 0, 1),
(26, 'Jet Airways', 0, 1),
(27, 'Indian Airlince', 0, 1),
(28, 'Kingfisher ', 0, 1),
(29, ' Air One ', 0, 1),
(30, ' Premier Airways ', 0, 1),
(31, ' Air Carnival ', 0, 1),
(32, ' Turbo Megha Airways ', 0, 1),
(33, ' Zav Airways ', 0, 1),
(34, ' Zexus Air ', 0, 1),
(35, ' Air Costa ', 0, 1),
(36, ' Vistara Airlines ', 0, 1),
(37, ' SpiceJet ', 0, 1),
(38, ' Kingfisher Red ', 0, 1),
(39, ' Jet Konnect ', 0, 1),
(40, ' GoAir ', 0, 1),
(41, ' Air India IC ', 0, 1),
(42, ' Air India Express ', 0, 1),
(43, ' Air India ', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itf_usermap`
--

CREATE TABLE IF NOT EXISTS `itf_usermap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `itf_usermap`
--

INSERT INTO `itf_usermap` (`id`, `order_id`, `delivery_id`, `user_id`, `entry_date`) VALUES
(1, 58, 26, 163, '2016-11-03 13:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `itf_users`
--

CREATE TABLE IF NOT EXISTS `itf_users` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL,
  `street` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `location` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `state` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `contact_no` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `department` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `reporting_to` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `area_of_responsibility` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `yrs_at_ey` int(11) DEFAULT NULL,
  `total_experience` int(11) DEFAULT NULL,
  `qualification` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `training_attended_in_the_past` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `previous_employer` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` enum('A','N','C','S','PM','CM') COLLATE latin1_general_ci NOT NULL DEFAULT 'N' COMMENT 'A = Administrator, N = Normal user',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=182 ;

--
-- Dumping data for table `itf_users`
--

INSERT INTO `itf_users` (`id`, `emp_id`, `profile_image`, `username`, `name`, `last_name`, `email`, `address`, `street`, `location`, `city`, `state`, `pincode`, `contact_no`, `age`, `department`, `designation`, `reporting_to`, `area_of_responsibility`, `yrs_at_ey`, `total_experience`, `qualification`, `training_attended_in_the_past`, `previous_employer`, `password`, `register_date`, `user_type`, `status`) VALUES
(1, 'ITF00000', 'ht.jpg', 'admin', 'Super Admin ', 'Sixer', 'accounts@maynardleigh.in', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '2015-05-11 19:02:14', 'A', 1),
(9, NULL, NULL, 'half_Time@gmail.com', 'full Time', NULL, 'half_Time@gmail.com', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '2016-07-03 09:07:56', 'N', 0),
(10, NULL, NULL, 'bvhgyg@gmail.com', 'ameeta', NULL, 'bvhgyg@gmail.com', 'vcguh', '', '', '', '', '', '1232454345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-07-03 09:23:45', 'N', 0),
(11, NULL, NULL, 'neetu@gmail.com', 'Neetu', NULL, 'neetu@gmail.com', 'noida', '', '', '', '', '', '1232376567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-07-03 09:27:58', 'N', 0),
(12, NULL, NULL, 'neetu@gmail.com', 'Anita Kumari1', NULL, 'neetu@gmail.com', 'noida', '', '', '', '', '', '1232376567', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-07-03 09:31:38', 'N', 0),
(114, NULL, NULL, 'rohit@maynardleigh.in', 'Rohit Parewa', NULL, 'rohit@maynardleigh.in', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '2016-09-20 04:52:24', 'S', 1),
(115, NULL, NULL, 'anamika@maynardleigh.in', 'Anamika Sengar', NULL, 'anamika@maynardleigh.in', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-09-20 04:53:32', 'PM', 1),
(116, NULL, NULL, 'nisha@maynardleigh.in', 'Nisha Sharma', NULL, 'nisha@maynardleigh.in', NULL, '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-09-20 04:53:42', 'PM', 1),
(118, NULL, NULL, 'sanah@maynardleigh.in', 'Sanah Singh Tomar', NULL, 'sanah@maynardleigh.in', NULL, '', '', '', '', '', '9811104020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-09-20 04:56:00', 'CM', 1),
(119, NULL, NULL, 'steeve@maynardleigh.in', 'Steeve Gupta', NULL, 'steeve@maynardleigh.in', NULL, '', '', '', '', '', '9810184358', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-09-20 04:58:19', 'CM', 1),
(120, NULL, NULL, 'bharat@maynardleigh.in', 'Bharat Babbar', NULL, 'bharat@maynardleigh.in', NULL, '', '', '', '', '', '9560872666', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-09-20 04:58:51', 'CM', 1),
(121, NULL, NULL, 'anand@maynardleigh.in', 'Anand Mittal', NULL, 'anand@maynardleigh.in', NULL, '', '', '', '', '', '9560586775', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-09-20 04:59:58', 'CM', 1),
(127, NULL, NULL, 'abhishek_jain@mckinsey.com', 'Mckinsey Knowledge Center', NULL, 'abhishek_jain@mckinsey.com', NULL, '3rd & 5th Floor, Block III, Vatika Business Park, Sohna Road, Park View City, Sector 49', 'Gurgaon', 'Gurgaon', 'Haryana', '122018', '+012-43331', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-10-05 04:13:52', 'C', 1),
(130, NULL, NULL, 'triansha@maynardleigh.in', 'Triansha Tandon', NULL, 'triansha@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9878786765', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-10-13 15:58:16', 'CM', 1),
(135, NULL, NULL, 'Revanasiddappa.S@IDFC.COM', 'Infrastructure Development Corporation (Karnataka) Limited ', NULL, 'Revanasiddappa.S@IDFC.COM', NULL, '9/7, K.C.N. Bhavan, Yamunabai Road', ' Madhavnagar Extension Off Race Course Road', 'Bangalore', 'Karnataka', '560 001', '+804-34480', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-10-18 03:58:17', 'C', 1),
(140, NULL, NULL, 'sudha@maynardleigh.in', 'Sudha Sudanthi', NULL, 'sudha@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9916182843', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-10-21 10:40:52', 'CM', 1),
(141, NULL, NULL, 'vrinda@maynardleigh.in', 'Vrinda Misra', NULL, 'vrinda@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9686571916', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-10-21 10:42:36', 'CM', 1),
(142, NULL, NULL, 'priyam@maynardleigh.in', 'Priyam Jain', NULL, 'priyam@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '7406618146', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-10-21 10:44:42', 'CM', 1),
(151, NULL, NULL, 'in.service@rbs.com', 'RBS', NULL, 'in.service@rbs.com', NULL, '9th Floor', 'Cyber Greens, Tower C, DLF Cyber City, Sector 25A', 'Gurgaon', 'Haryana', '122002', '+012-44111', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-03 08:51:59', 'C', 1),
(153, NULL, NULL, 'helpdesk.peoplefirst@genpact.com', 'Genpact India Private Limited', NULL, 'helpdesk.peoplefirst@genpact.com', NULL, 'DLF City - Phase V', 'Sector 53', 'Gurgaon ', 'Haryana', '122002', '+-24402200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-10 06:02:33', 'C', 1),
(155, NULL, NULL, 'raju@gmail.com', 'Test', NULL, 'raju@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '9878887787', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '2016-11-18 05:41:44', 'N', 1),
(162, NULL, NULL, 'jigyasa@maynardleigh.in', 'Jigyasa Sharma', NULL, 'jigyasa@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '2016-11-21 11:06:40', 'S', 1),
(163, NULL, NULL, 'inquiry@cognizant.com', 'Cognizant Technology Solutions India Pvt Ltd', NULL, 'inquiry@cognizant.com', NULL, '#5/535, Old Mahabalipuram Road', 'Okkiam -Thoraipakkam', 'Chennai', 'Tamil Nadu', '600 096', '+44-420960', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-21 11:31:47', 'C', 1),
(164, NULL, NULL, 'Head-Customerservicesindia@aexp.com', 'American Express India Private Limited', NULL, 'Head-Customerservicesindia@aexp.com', NULL, 'Amex Financial Centre,Wings 2-B, 3-B, 4-B, 5-B Comm. Block-3, (Zone-6)', 'GHS', 'Gurgaon ', 'Haryana', '122009', '+124-33620', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-22 04:56:23', 'C', 1),
(165, NULL, NULL, 'snigdha.tripathi@ericsson.com', 'Ericsson India Private Limited', NULL, 'snigdha.tripathi@ericsson.com', NULL, 'Ericsson Forum DLF Cybercity', 'Sector-25A', 'Gurgaon', 'Haryana', '122 002', '+124-41512', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-22 06:24:16', 'C', 1),
(166, NULL, NULL, 'NChahar@scj.com', 'S. C. Johnson Products Pvt. Ltd.', NULL, 'NChahar@scj.com', NULL, '5th Floor, Plot No. 68', 'Sector 44, ', 'Gurugram,', 'Haryana', '122003', '+417-3900', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-22 09:51:30', 'C', 1),
(169, NULL, NULL, 'mitali.chaudhuri@stryker.com', 'Stryker India', NULL, 'mitali.chaudhuri@stryker.com', NULL, 'Vatika Business Park 10th Floor', 'Sohna Road, Block Two, Sector – 49', 'Gurgaon', 'Haryana', '122002', '+124-48506', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-22 10:14:22', 'C', 1),
(170, NULL, NULL, 'geeta.bajaj@dk.com', 'Dorling Kindersley India', NULL, 'geeta.bajaj@dk.com', NULL, 'Film City', 'Sector 16A', 'Noida', 'Uttar Pradesh', '201301', '+120-46896', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-24 07:50:24', 'C', 1),
(171, NULL, NULL, 'rajender.sud@maxlifeinsurance.com', 'Max Healthcare Institute Limited', NULL, 'rajender.sud@maxlifeinsurance.com', NULL, '7th Floor, DLF Centre Court', 'DLF City phase V, Sector 42', 'Gurgaon', 'Haryana', '122002', '+911-42598', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-24 08:43:39', 'C', 1),
(172, NULL, NULL, 'nitten@maynardleigh.in', 'Nitten Mahadik', NULL, 'nitten@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9619487431', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-11-25 04:55:50', 'CM', 1),
(174, NULL, NULL, 'sanyukta@maynardleigh.in', 'Sanyukta Saha', NULL, 'sanyukta@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9873853348', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-11-25 07:46:48', 'CM', 1),
(175, NULL, NULL, 'vgonfire@gmail.com', 'Varun Gupta', NULL, 'vgonfire@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '2016-11-25 07:47:54', 'S', 1),
(176, NULL, NULL, 'varun@maynardleigh.in', 'Varun Gupta', NULL, 'varun@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9560192443', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-11-25 07:48:46', 'CM', 1),
(177, NULL, NULL, 'info@srf.com', 'SRF Ltd.', NULL, 'info@srf.com', NULL, 'Block C', 'Sector 45', 'Gugaon', 'Haryana', '122 003', '+124-43545', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-11-28 09:07:24', 'C', 1),
(178, NULL, NULL, 'vivek@maynardleigh.in', 'Vivek Arora', NULL, 'vivek@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9810811385', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-11-29 07:33:37', 'CM', 1),
(180, NULL, NULL, 'durba@maynardleigh.in', 'Durba Ghose', NULL, 'durba@maynardleigh.in', NULL, NULL, NULL, NULL, NULL, NULL, '9654396231', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e9beb19485d370c9ce194da78bef0419', '2016-11-30 05:10:32', 'CM', 1),
(181, NULL, NULL, 'shivani_issar@mckinsey.com', 'McKinsey & Company', NULL, 'shivani_issar@mckinsey.com', NULL, 'McKinsey and Company | 21 Floor, Express Towers ', 'Nariman Point', 'Mumbai', 'Maharashtra', '400021', '+976-93181', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '827ccb0eea8a706c4c34a16891f84e7b', '2016-12-01 11:11:28', 'C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itf_user_personal`
--

CREATE TABLE IF NOT EXISTS `itf_user_personal` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(25) NOT NULL,
  `licence_number` varchar(255) NOT NULL,
  `licence_expire` varchar(255) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `marital_status` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `itf_user_personal`
--

INSERT INTO `itf_user_personal` (`id`, `user_id`, `licence_number`, `licence_expire`, `gender`, `marital_status`, `nationality`, `dob`, `entry_date`) VALUES
(1, 9, 'jfkljak', 'fjklaj', 'Maler', 'UnMarried', 'Indina', '12-12-187', '2015-12-20 11:02:22'),
(2, 10, 'AFC009', '12-12-1987', 'male', 'UnMarried', 'Indian', '01-01-1987', '2015-12-20 11:12:41'),
(3, 5, '', '', 'Male', 'Single', 'Indian', '01/11/2015', '2015-12-21 07:52:31'),
(4, 11, '', '', '', '', '', '', '2015-12-21 08:00:26'),
(5, 4, '', '', '', '', '', '', '2015-12-21 15:44:07'),
(6, 3, '', '', 'femail', 'single', 'indian', '01/11/1990', '2015-12-21 15:44:36'),
(7, 4, '', '', '', '', '', '', '2015-12-21 15:45:37'),
(8, 18, '', '', '', '', '', '', '2015-12-21 15:46:54'),
(9, 12, '', '', '', '', '', '', '2015-12-22 12:19:35'),
(10, 2, '', '', '', '', '', '', '2015-12-22 12:49:54'),
(11, 14, '', '', '', '', '', '', '2015-12-22 12:50:55'),
(12, 19, '', '', '', '', '', '', '2015-12-22 13:02:20'),
(13, 17, '', '', '', '', '', '', '2015-12-22 13:03:23'),
(14, 6, '', '', '', '', '', '', '2015-12-22 13:04:05'),
(15, 15, '', '', '', '', '', '', '2015-12-22 13:07:20'),
(16, 7, '', '', '', '', '', '', '2015-12-22 13:10:27'),
(17, 16, '', '', '', '', '', '', '2015-12-22 13:11:18'),
(18, 20, '', '', 'Male', 'UnMarried', '', '', '2016-01-16 03:36:32'),
(19, 21, '', '', 'male', 'marrid', 'indian', '15/01/1990', '2016-01-16 03:43:27'),
(20, 22, '', '', '', '', '', '', '2016-01-16 04:47:15'),
(21, 23, '', '', '', '', '', '', '2016-04-28 00:24:52'),
(22, 8, '', '', 'male', 'married', '', '', '2016-05-11 08:38:03');

-- --------------------------------------------------------

--
-- Structure for view `itf_delivery_status`
--
DROP TABLE IF EXISTS `itf_delivery_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`maynardl`@`localhost` SQL SECURITY DEFINER VIEW `itf_delivery_status` AS select `itf_assign_date`.`order_id` AS `order_id`,`itf_assign_date`.`diagnose_id` AS `diagnose_id`,group_concat(distinct `itf_assign_date`.`status` separator ',') AS `status` from `itf_assign_date` where (`itf_assign_date`.`order_type` = 3) group by `itf_assign_date`.`order_id`,`itf_assign_date`.`diagnose_id`;

-- --------------------------------------------------------

--
-- Structure for view `itf_design_status`
--
DROP TABLE IF EXISTS `itf_design_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`maynardl`@`localhost` SQL SECURITY DEFINER VIEW `itf_design_status` AS select `itf_assign_date`.`order_id` AS `order_id`,`itf_assign_date`.`diagnose_id` AS `diagnose_id`,group_concat(distinct `itf_assign_date`.`status` separator ',') AS `status` from `itf_assign_date` where (`itf_assign_date`.`order_type` = 2) group by `itf_assign_date`.`order_id`,`itf_assign_date`.`diagnose_id`;

-- --------------------------------------------------------

--
-- Structure for view `itf_diagnose_status`
--
DROP TABLE IF EXISTS `itf_diagnose_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`maynardl`@`localhost` SQL SECURITY DEFINER VIEW `itf_diagnose_status` AS select `itf_assign_date`.`order_id` AS `order_id`,`itf_assign_date`.`diagnose_id` AS `diagnose_id`,group_concat(distinct `itf_assign_date`.`status` separator ',') AS `status` from `itf_assign_date` where (`itf_assign_date`.`order_type` = 1) group by `itf_assign_date`.`order_id`,`itf_assign_date`.`diagnose_id`;

-- --------------------------------------------------------

--
-- Structure for view `itf_discovery_status`
--
DROP TABLE IF EXISTS `itf_discovery_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`maynardl`@`localhost` SQL SECURITY DEFINER VIEW `itf_discovery_status` AS select `itf_assign_date`.`order_id` AS `order_id`,`itf_assign_date`.`diagnose_id` AS `diagnose_id`,group_concat(distinct `itf_assign_date`.`status` separator ',') AS `status` from `itf_assign_date` where (`itf_assign_date`.`order_type` = 4) group by `itf_assign_date`.`order_id`,`itf_assign_date`.`diagnose_id`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
