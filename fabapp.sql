-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2019 at 10:37 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `a_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(140) NOT NULL,
  `balance` decimal(6,2) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `role_access` varchar(2) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`a_id`, `name`, `description`, `balance`, `operator`, `role_access`) VALUES
(1, 'Unpaid', 'Unpaid charge, Blocked until Paid', '387.99', '1000129288', '9'),
(2, 'CSGold', 'CSGold Account', '400.52', '1000129288', '8'),
(3, 'FabLab', 'FabLab''s in-House Charge Account', '1784.66', '1000129288', '9'),
(4, 'Library', 'General Library Account', '605.29', '1000129288', '9'),
(5, 'IDT', 'Inter-Departmental Transfers', '1498.12', '1000129288', '9'),
(6, 'Bursar', 'Office of Student Accounts', '10.00', '', '10');

-- --------------------------------------------------------

--
-- Table structure for table `acct_charge`
--

CREATE TABLE IF NOT EXISTS `acct_charge` (
  `ac_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `ac_date` datetime NOT NULL,
  `operator` varchar(10) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `recon_date` datetime DEFAULT NULL,
  `recon_id` varchar(10) DEFAULT NULL,
  `ac_notes` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acct_charge`
--

INSERT INTO `acct_charge` (`ac_id`, `a_id`, `trans_id`, `ac_date`, `operator`, `staff_id`, `amount`, `recon_date`, `recon_id`, `ac_notes`) VALUES
(1, 3, 35287, '2019-09-19 17:52:30', '1000129288', '1000000010', '0.02', NULL, NULL, ''),
(2, 3, 35288, '2019-09-19 18:08:38', '1000129288', '1000000010', '0.02', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `all_good_inventory`
--

CREATE TABLE IF NOT EXISTS `all_good_inventory` (
  `inv_id` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `m_parent` int(11) DEFAULT NULL,
  `width` decimal(11,2) DEFAULT '1.00',
  `height` decimal(11,2) DEFAULT '1.00',
  `weight` decimal(11,2) DEFAULT '0.00',
  `quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `all_good_inventory`
--

INSERT INTO `all_good_inventory` (`inv_id`, `m_id`, `m_parent`, `width`, `height`, `weight`, `quantity`) VALUES
(1, 2, 123, '1.00', '5.00', '6.00', 12),
(2, 4, 123, '7.00', '5.00', '6.00', 12),
(3, 6, NULL, '2.00', '5.00', '13.00', 12),
(4, 7, NULL, '2.00', '4.00', '25.00', 12),
(5, 8, 123, '5.00', '3.00', '25.00', 12),
(6, 9, 123, '5.00', '5.00', '11.00', 12),
(7, 10, 123, '3.00', '4.00', '10.00', 12),
(8, 13, 1, '7.00', '4.00', '12.00', 12),
(9, 14, 1, '3.00', '4.00', '12.00', 12),
(10, 15, 1, '4.00', '1.00', '23.00', 12),
(11, 16, 1, '5.00', '2.00', '24.00', 12),
(12, 17, 1, '4.00', '4.00', '7.00', 12),
(13, 18, 1, '2.00', '1.00', '19.00', 12),
(14, 19, 1, '1.00', '4.00', '7.00', 12),
(15, 20, 7, '5.00', '2.00', '11.00', 12),
(16, 21, 7, '5.00', '4.00', '22.00', 12),
(17, 22, 7, '6.00', '4.00', '9.00', 12),
(18, 23, 7, '2.00', '5.00', '25.00', 12),
(19, 24, 7, '5.00', '2.00', '21.00', 12),
(20, 25, 7, '2.00', '2.00', '17.00', 12),
(21, 26, 7, '7.00', '1.00', '6.00', 12),
(22, 27, NULL, '2.00', '4.00', '13.00', 12),
(23, 28, NULL, '4.00', '2.00', '21.00', 12),
(24, 29, 1, '1.00', '4.00', '19.00', 12),
(25, 30, 7, '3.00', '5.00', '18.00', 12),
(26, 31, NULL, '6.00', '2.00', '19.00', 12),
(27, 32, NULL, '6.00', '5.00', '11.00', 12),
(28, 33, 1, '3.00', '4.00', '15.00', 12),
(29, 35, 1, '7.00', '4.00', '12.00', 12),
(30, 36, 1, '4.00', '1.00', '23.00', 12),
(31, 37, 1, '3.00', '5.00', '11.00', 12),
(32, 38, 1, '1.00', '1.00', '15.00', 12),
(33, 39, 1, '5.00', '3.00', '9.00', 12),
(35, 40, 1, '7.00', '2.00', '23.00', 12),
(36, 41, 1, '6.00', '3.00', '22.00', 12),
(37, 42, 1, '5.00', '1.00', '20.00', 12),
(38, 43, 7, '6.00', '5.00', '7.00', 12),
(39, 44, 7, '5.00', '4.00', '15.00', 12),
(40, 45, 7, '2.00', '1.00', '10.00', 12),
(41, 46, 7, '3.00', '5.00', '18.00', 12),
(42, 48, 7, '3.00', '1.00', '22.00', 12),
(43, 52, NULL, '7.00', '1.00', '24.00', 12),
(44, 54, NULL, '1.00', '4.00', '15.00', 12),
(45, 55, 54, '3.00', '5.00', '14.00', 12),
(46, 56, 54, '3.00', '1.00', '23.00', 12),
(48, 57, 7, '6.00', '5.00', '11.00', 12),
(49, 59, 1, '7.00', '3.00', '19.00', 12),
(50, 60, 1, '3.00', '3.00', '24.00', 12),
(51, 61, 1, '3.00', '4.00', '5.00', 12),
(52, 62, 1, '6.00', '4.00', '17.00', 12),
(53, 63, 1, '2.00', '4.00', '23.00', 12),
(54, 64, 1, '2.00', '1.00', '16.00', 12),
(55, 65, 7, '6.00', '3.00', '11.00', 12),
(56, 66, 7, '4.00', '4.00', '16.00', 12),
(57, 67, 7, '5.00', '5.00', '20.00', 12),
(58, 68, NULL, '2.00', '5.00', '13.00', 12),
(59, 69, 54, '1.00', '2.00', '9.00', 12),
(60, 70, 54, '5.00', '5.00', '15.00', 12),
(61, 71, 54, '4.00', '2.00', '16.00', 12),
(62, 72, 1, '5.00', '5.00', '10.00', 12),
(63, 73, 1, '7.00', '1.00', '11.00', 12),
(64, 74, 1, '7.00', '2.00', '19.00', 12),
(65, 75, 68, '5.00', '4.00', '5.00', 12),
(66, 76, 68, '6.00', '4.00', '25.00', 12),
(67, 77, 68, '7.00', '3.00', '6.00', 12),
(68, 78, 68, '1.00', '2.00', '12.00', 12),
(69, 79, 68, '3.00', '5.00', '13.00', 12),
(70, 80, NULL, '3.00', '5.00', '11.00', 12),
(71, 81, NULL, '2.00', '3.00', '12.00', 12),
(72, 82, NULL, '3.00', '2.00', '8.00', 12),
(73, 83, NULL, '7.00', '5.00', '16.00', 12),
(74, 84, NULL, '2.00', '3.00', '21.00', 12),
(75, 85, NULL, '3.00', '2.00', '25.00', 12),
(76, 86, NULL, '4.00', '4.00', '8.00', 12),
(77, 87, NULL, '1.00', '2.00', '15.00', 12),
(78, 88, NULL, '7.00', '4.00', '18.00', 12),
(79, 89, NULL, '5.00', '1.00', '18.00', 12),
(80, 90, NULL, '3.00', '2.00', '5.00', 12),
(81, 91, NULL, '7.00', '2.00', '23.00', 12),
(82, 92, NULL, '2.00', '3.00', '19.00', 12),
(83, 93, NULL, '4.00', '1.00', '22.00', 12),
(84, 94, NULL, '6.00', '3.00', '6.00', 12),
(85, 95, NULL, '2.00', '3.00', '13.00', 12),
(86, 96, NULL, '4.00', '3.00', '6.00', 12),
(87, 97, NULL, '6.00', '4.00', '14.00', 12),
(88, 98, NULL, '6.00', '3.00', '10.00', 12),
(89, 99, NULL, '6.00', '1.00', '19.00', 12),
(90, 100, 7, '5.00', '4.00', '18.00', 12),
(91, 101, 7, '7.00', '1.00', '5.00', 12),
(92, 102, 7, '5.00', '1.00', '25.00', 12),
(93, 103, 7, '4.00', '1.00', '15.00', 12),
(94, 104, 7, '5.00', '3.00', '7.00', 12),
(95, 105, 7, '5.00', '5.00', '17.00', 12),
(96, 106, 7, '7.00', '2.00', '15.00', 12),
(97, 107, 7, '6.00', '2.00', '20.00', 12),
(98, 108, 7, '4.00', '4.00', '8.00', 12),
(99, 109, 7, '1.00', '5.00', '11.00', 12),
(100, 110, 7, '1.00', '5.00', '25.00', 12),
(101, 111, 7, '1.00', '5.00', '7.00', 12),
(102, 112, 7, '6.00', '3.00', '8.00', 12),
(103, 113, 7, '7.00', '1.00', '14.00', 12),
(104, 114, 7, '1.00', '3.00', '13.00', 12),
(105, 115, 7, '6.00', '5.00', '8.00', 12),
(106, 116, 7, '1.00', '5.00', '14.00', 12),
(107, 117, 7, '4.00', '1.00', '17.00', 12),
(108, 118, 7, '3.00', '5.00', '5.00', 12),
(109, 119, 7, '2.00', '2.00', '15.00', 12),
(110, 120, 7, '5.00', '4.00', '21.00', 12),
(111, 121, NULL, '5.00', '4.00', '19.00', 12),
(112, 122, NULL, '3.00', '4.00', '21.00', 12),
(113, 124, 4, '6.00', '3.00', '19.00', 12),
(114, 125, 4, '2.00', '2.00', '13.00', 12),
(115, 126, 4, '3.00', '4.00', '12.00', 12),
(116, 127, 4, '4.00', '5.00', '16.00', 12),
(117, 128, 9, '7.00', '1.00', '11.00', 12),
(118, 129, 9, '4.00', '1.00', '17.00', 12),
(119, 130, 8, '1.00', '1.00', '5.00', 12),
(120, 131, 8, '6.00', '2.00', '21.00', 12),
(121, 132, 8, '2.00', '2.00', '21.00', 12),
(122, 133, 10, '1.00', '2.00', '12.00', 12),
(123, 134, 10, '7.00', '4.00', '15.00', 12),
(124, 135, 4, '2.00', '4.00', '5.00', 12),
(125, 136, 2, '3.00', '4.00', '16.00', 12),
(126, 137, 4, '1.00', '3.00', '8.00', 12),
(127, 138, 123, '7.00', '1.00', '22.00', 12),
(128, 139, 138, '1.00', '3.00', '7.00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `authrecipients`
--

CREATE TABLE IF NOT EXISTS `authrecipients` (
  `ar_id` int(11) NOT NULL,
  `trans_id` int(11) NOT NULL,
  `operator` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_accts`
--

CREATE TABLE IF NOT EXISTS `auth_accts` (
  `aa_id` int(11) NOT NULL,
  `a_id` int(11) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `valid` enum('Y','N') NOT NULL DEFAULT 'Y',
  `aa_date` datetime NOT NULL,
  `staff_id` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE IF NOT EXISTS `carrier` (
  `c_id` int(11) NOT NULL,
  `provider` varchar(50) NOT NULL,
  `email` varchar(110) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`c_id`, `provider`, `email`) VALUES
(1, 'AT&T', 'number@txt.att.net'),
(2, 'Verizon', 'number@vtext.com'),
(3, 'T-Mobile', 'number@tmomail.net'),
(4, 'Sprint', 'number@messaging.sprintpcs.com'),
(5, 'Virgin Mobile', 'number@vmobl.com'),
(6, 'Project Fi', 'number@msg.fi.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_parent` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`c_id`, `c_name`, `c_parent`) VALUES
(1, 'Sheet Good', NULL),
(2, 'Filament', NULL),
(3, 'Glass', NULL),
(4, 'Vinyl', NULL),
(5, 'Ink', NULL),
(6, 'Fabrics', NULL),
(7, 'Other', NULL),
(8, 'Acrylic', 1),
(9, 'Basswood', 1),
(10, 'Wood', 1),
(11, 'Plywood', 1),
(12, 'Sheet Test', 1),
(13, 'Glass Sheet', 3),
(14, 'Glass Ground', 3),
(15, 'Screen Ink', 5),
(16, 'Airbrush', 5),
(17, 'ABS', 2),
(18, 'PLA', 2),
(19, 'uPrint', 2),
(20, 'NinjaFlex', 2);

-- --------------------------------------------------------

--
-- Table structure for table `citation`
--

CREATE TABLE IF NOT EXISTS `citation` (
  `c_id` int(11) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `c_date` datetime NOT NULL,
  `c_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `d_id` int(11) NOT NULL,
  `device_id` varchar(4) NOT NULL,
  `public_view` enum('Y','N') NOT NULL DEFAULT 'N',
  `device_desc` varchar(255) NOT NULL,
  `time_limit` time DEFAULT NULL,
  `base_price` decimal(7,5) NOT NULL,
  `dg_id` int(11) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`d_id`, `device_id`, `public_view`, `device_desc`, `time_limit`, `base_price`, `dg_id`, `url`) VALUES
(1, '0001', 'Y', 'Bandsaw', '00:00:00', '0.00000', 20, NULL),
(2, '0002', 'Y', 'Bench Grinder', '00:00:00', '0.00000', 18, NULL),
(3, '0003', 'Y', 'Brother Embroider PR-655', '00:00:00', '1.00000', 11, NULL),
(4, '0004', 'Y', 'Plasma Cutter', '00:00:00', '0.00000', 3, NULL),
(6, '0006', 'Y', 'Compound Miter Saw', '00:00:00', '0.00000', 3, NULL),
(7, '0007', 'Y', 'Disc/Belt Sander Grizzly', '00:00:00', '0.00000', 18, NULL),
(9, '0009', 'Y', 'Janome Serger #1', '00:00:00', '1.00000', 10, NULL),
(10, '0010', 'Y', 'Janome Serger #2', '00:00:00', '1.00000', 10, NULL),
(11, '0011', 'Y', 'Janome Sewing #1', '00:00:00', '1.00000', 10, NULL),
(12, '0012', 'Y', 'Janome Sewing #2', '00:00:00', '1.00000', 10, NULL),
(67, '0066', 'Y', 'Heat Press', '00:00:00', '0.00000', 24, NULL),
(14, '0014', 'Y', 'Drill Press Powermatic', '00:00:00', '0.00000', 19, NULL),
(15, '0015', 'Y', 'Scroll Saw', '00:00:00', '0.00000', 20, NULL),
(16, '0016', 'Y', 'Sherline CNC Mill', '00:00:00', '0.00000', 3, NULL),
(17, '0017', 'Y', 'Sherline CNC Lathe', '00:00:00', '0.00000', 3, NULL),
(18, '0018', 'Y', 'Shopbot Handi-bot', '00:00:00', '0.00000', 3, NULL),
(19, '0019', 'Y', 'Shopbot PRS-Alpha ', '00:00:00', '0.00000', 3, NULL),
(20, '0020', 'Y', 'Sawstop Table Saw', '00:00:00', '0.00000', 3, NULL),
(21, '0021', 'Y', 'Polyprinter #1', '00:00:00', '0.00000', 2, 'polyprinter-1.uta.edu'),
(22, '0022', 'Y', 'Polyprinter #2', '00:00:00', '0.00000', 2, 'polyprinter-2.uta.edu'),
(23, '0023', 'Y', 'Polyprinter #3', '00:00:00', '0.00000', 2, 'polyprinter-3.uta.edu'),
(24, '0024', 'Y', 'Polyprinter #4', '00:00:00', '0.00000', 2, 'polyprinter-4.uta.edu'),
(25, '0025', 'Y', 'Polyprinter #5', '00:00:00', '0.00000', 2, 'polyprinter-5.uta.edu'),
(26, '0026', 'Y', 'Polyprinter #6', '00:00:00', '0.00000', 2, 'polyprinter-6.uta.edu'),
(27, '0027', 'Y', 'Polyprinter #7', '00:00:00', '0.00000', 2, 'polyprinter-7.uta.edu'),
(28, '0028', 'Y', 'Polyprinter #8', '00:00:00', '0.00000', 2, 'polyprinter-8.uta.edu'),
(29, '0029', 'Y', 'Polyprinter #9', '00:00:00', '0.00000', 2, 'polyprinter-9.uta.edu'),
(30, '0030', 'Y', 'Polyprinter #10', '00:00:00', '0.00000', 15, 'polyprinter-10.uta.edu'),
(31, '0031', 'Y', 'PrintrBot Play', '00:00:00', '0.00000', 8, 'printrbotplay.uta.edu'),
(32, '0032', 'Y', 'Prusa #1', '00:00:00', '0.00000', 8, 'prusa1.uta.edu'),
(33, '0033', 'Y', 'PrintrBot Simple Metal', '00:00:00', '0.00000', 8, 'printrbotsimplemetal.uta.edu'),
(34, '0034', 'Y', 'Epilog Laser', '01:00:00', '0.00000', 4, NULL),
(35, '0035', 'Y', 'Boss Laser', '01:00:00', '0.00000', 4, NULL),
(36, '0036', 'Y', 'Roland CNC Mill', '00:00:00', '0.00000', 12, NULL),
(37, '0037', 'Y', '3D Scanner Station', '00:00:00', '0.00000', 9, NULL),
(38, '0038', 'Y', 'Kiln Glass', '00:00:00', '0.00000', 16, NULL),
(39, '0039', 'Y', 'Kiln Ceramics', '00:00:00', '0.00000', 16, NULL),
(46, '0046', 'Y', 'Kiln Mix Use', '00:00:00', '0.00000', 16, NULL),
(41, '0041', 'Y', 'Roland Vinyl Cutter', '00:00:00', '0.00000', 5, NULL),
(42, '0042', 'Y', 'Electronics Station', '00:00:00', '0.00000', 6, NULL),
(43, '0043', 'Y', 'uPrint SEplus', '00:00:00', '0.00000', 7, NULL),
(44, '0044', 'Y', 'Oculus Rift', '00:00:00', '0.00000', 13, NULL),
(45, '0045', 'Y', 'Screeny McScreen Press', '00:00:00', '0.00000', 17, NULL),
(66, '', 'N', 'FabApp', '00:00:00', '0.00000', 23, NULL),
(48, '0048', 'Y', 'Drill Press Ryobi', '00:00:00', '0.00000', 19, NULL),
(49, '0049', 'Y', 'SandBlaster', '00:00:00', '0.00000', 3, NULL),
(50, '0050', 'Y', 'Jigsaw', '00:00:00', '0.00000', 20, NULL),
(51, '0051', 'Y', 'Brother SE-400 #1', '00:00:00', '1.00000', 11, NULL),
(52, '0052', 'Y', 'Brother SE-400 #2', '00:00:00', '1.00000', 11, NULL),
(53, '0053', 'Y', 'Silhouette Cameo Cutter', '00:00:00', '0.00000', 5, NULL),
(5, '0005', 'Y', 'Paper Making', '00:00:00', '0.00000', 21, NULL),
(54, '0054', 'Y', 'Prusa #2', '00:00:00', '0.00000', 8, 'prusa2.uta.edu'),
(55, '0055', 'Y', 'ProtoMat PCB Mill', '00:00:00', '0.00000', 22, NULL),
(56, '0056', 'Y', 'Solder Iron #1', '00:00:00', '0.00000', 6, NULL),
(57, '0057', 'Y', 'Solder Iron #2', '00:00:00', '0.00000', 6, NULL),
(58, '0058', 'Y', 'Solder Iron #3', '00:00:00', '0.00000', 6, NULL),
(59, '0059', 'Y', 'Solder Iron #4', '00:00:00', '0.00000', 6, NULL),
(60, '0060', 'Y', 'Solder Iron #5', '00:00:00', '0.00000', 6, NULL),
(61, '0061', 'Y', 'Solder Iron #6', '00:00:00', '0.00000', 6, NULL),
(62, '0062', 'Y', 'Solder Iron #7', '00:00:00', '0.00000', 6, NULL),
(63, '0063', 'Y', 'Solder Iron #8', '00:00:00', '0.00000', 6, NULL),
(64, '0064', 'Y', 'Solder Iron #9', '00:00:00', '0.00000', 6, NULL),
(65, '0065', 'Y', 'Solder Iron #10', '00:00:00', '0.00000', 6, NULL),
(68, '0068', 'N', 'Sheet Goods', '00:00:00', '0.00000', 23, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device_group`
--

CREATE TABLE IF NOT EXISTS `device_group` (
  `dg_id` int(11) NOT NULL,
  `dg_name` varchar(10) NOT NULL,
  `dg_parent` int(11) DEFAULT NULL,
  `dg_desc` varchar(50) NOT NULL,
  `payFirst` enum('Y','N') NOT NULL DEFAULT 'N',
  `selectMatsFirst` enum('Y','N') NOT NULL DEFAULT 'N',
  `storable` enum('Y','N') NOT NULL DEFAULT 'N',
  `juiceboxManaged` enum('Y','N') NOT NULL DEFAULT 'N',
  `thermalPrinterNum` int(11) NOT NULL,
  `granular_wait` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device_group`
--

INSERT INTO `device_group` (`dg_id`, `dg_name`, `dg_parent`, `dg_desc`, `payFirst`, `selectMatsFirst`, `storable`, `juiceboxManaged`, `thermalPrinterNum`, `granular_wait`) VALUES
(1, '3d', NULL, '(Generic 3D Printer)', 'N', 'Y', 'Y', 'N', 0, 'Y'),
(2, 'poly', 1, 'PolyPrinter', 'N', 'Y', 'Y', 'N', 0, 'N'),
(3, 'shop', NULL, 'Shop Room', 'N', 'N', 'N', 'Y', 0, 'Y'),
(4, 'laser', NULL, 'Laser Cutter', 'N', 'Y', 'N', 'N', 0, 'Y'),
(5, 'vinyl', NULL, 'Vinyl Cutter', 'N', 'Y', 'N', 'N', 0, 'Y'),
(6, 'e_station', NULL, 'Electronics Station', 'N', 'N', 'N', 'N', 0, 'Y'),
(7, 'uprint', 1, 'Stratus uPrint', 'Y', 'Y', 'Y', 'N', 0, 'Y'),
(8, 'pla', 1, 'PLA 3D Printers', 'N', 'Y', 'Y', 'N', 0, 'Y'),
(9, 'scan', NULL, '3D Scan', 'N', 'N', 'N', 'N', 0, 'Y'),
(10, 'sew', NULL, 'Sewing Station', 'N', 'Y', 'N', 'N', 0, 'Y'),
(11, 'embroidery', NULL, 'Embroidery Machines', 'N', 'Y', 'N', 'N', 0, 'Y'),
(12, 'mill', NULL, 'CNC Mill', 'N', 'Y', 'N', 'N', 0, 'Y'),
(13, 'vr', NULL, 'VR Equipment', 'N', 'N', 'N', 'N', 0, 'Y'),
(15, 'NFPrinter', 1, 'Ninja Flex 3D Printer', 'N', 'Y', 'Y', 'Y', 0, 'Y'),
(16, 'kiln', NULL, 'Electric Kilns', 'N', 'N', 'N', 'N', 0, 'Y'),
(17, 'screen', NULL, 'Silk Screen', 'N', 'Y', 'N', 'N', 0, 'Y'),
(18, 'sandGrind', 3, 'Sanders & Grinders', 'N', 'N', 'N', 'Y', 0, 'Y'),
(19, 'drills', 3, 'Drill Presses', 'N', 'N', 'N', 'Y', 0, 'Y'),
(20, 'linear_Saw', 3, 'Linear Saws', 'N', 'N', 'N', 'Y', 0, 'Y'),
(21, 'paperMaker', NULL, 'Paper Making', 'N', 'N', 'N', 'N', 0, 'Y'),
(22, 'pcbMill', NULL, 'PCB Mill', 'N', 'Y', 'N', 'N', 0, 'Y'),
(23, 'software', NULL, 'Applications & Software', 'N', 'N', 'N', 'N', 0, 'N'),
(24, 'heatPress', NULL, 'Heat Press Group', 'N', 'N', 'N', 'N', 0, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `device_materials`
--

CREATE TABLE IF NOT EXISTS `device_materials` (
  `dm_id` int(11) NOT NULL,
  `dg_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `required` enum('N','Y') DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device_materials`
--

INSERT INTO `device_materials` (`dm_id`, `dg_id`, `m_id`, `required`) VALUES
(1, 8, 6, 'N'),
(2, 2, 13, 'N'),
(3, 2, 14, 'N'),
(4, 2, 15, 'N'),
(6, 2, 16, 'N'),
(7, 2, 17, 'N'),
(8, 2, 18, 'N'),
(9, 2, 19, 'N'),
(10, 4, 2, 'N'),
(11, 4, 5, 'N'),
(12, 4, 8, 'N'),
(13, 4, 9, 'N'),
(14, 4, 10, 'N'),
(16, 4, 12, 'N'),
(18, 5, 20, 'N'),
(19, 5, 21, 'N'),
(20, 5, 22, 'N'),
(21, 5, 23, 'N'),
(22, 5, 24, 'N'),
(23, 5, 25, 'N'),
(24, 5, 26, 'N'),
(25, 2, 29, 'N'),
(26, 8, 28, 'N'),
(27, 10, 52, 'Y'),
(28, 11, 52, 'Y'),
(29, 7, 27, 'Y'),
(30, 7, 32, 'Y'),
(34, 12, 1, 'N'),
(35, 12, 2, 'N'),
(36, 12, 11, 'N'),
(39, 2, 33, 'N'),
(40, 2, 34, 'N'),
(41, 2, 35, 'N'),
(42, 2, 36, 'N'),
(43, 2, 37, 'N'),
(44, 2, 38, 'N'),
(45, 2, 39, 'N'),
(46, 2, 40, 'N'),
(47, 2, 41, 'N'),
(48, 2, 42, 'N'),
(49, 5, 43, 'N'),
(50, 5, 44, 'N'),
(51, 5, 45, 'N'),
(52, 5, 46, 'N'),
(53, 5, 48, 'N'),
(54, 5, 30, 'N'),
(55, 5, 31, 'N'),
(56, 4, 53, 'N'),
(58, 15, 55, 'N'),
(59, 15, 56, 'N'),
(60, 5, 57, 'N'),
(61, 5, 58, 'N'),
(62, 2, 59, 'N'),
(63, 2, 60, 'N'),
(64, 2, 61, 'N'),
(65, 2, 62, 'N'),
(66, 2, 63, 'N'),
(67, 2, 64, 'N'),
(68, 5, 65, 'N'),
(69, 5, 66, 'N'),
(70, 5, 67, 'N'),
(72, 15, 69, 'N'),
(73, 15, 70, 'N'),
(74, 15, 71, 'N'),
(75, 2, 72, 'N'),
(76, 2, 73, 'N'),
(77, 2, 74, 'N'),
(78, 17, 75, 'N'),
(79, 17, 76, 'N'),
(80, 17, 77, 'N'),
(81, 17, 78, 'N'),
(82, 17, 79, 'N'),
(83, 5, 80, 'N'),
(84, 8, 81, 'N'),
(85, 8, 82, 'N'),
(86, 8, 83, 'N'),
(87, 8, 84, 'N'),
(88, 8, 85, 'N'),
(89, 8, 86, 'N'),
(90, 8, 87, 'N'),
(91, 8, 88, 'N'),
(92, 8, 89, 'N'),
(93, 8, 90, 'N'),
(94, 8, 91, 'N'),
(95, 8, 92, 'N'),
(96, 8, 93, 'N'),
(97, 8, 94, 'N'),
(98, 8, 95, 'N'),
(99, 8, 96, 'N'),
(100, 8, 97, 'N'),
(101, 8, 98, 'N'),
(102, 8, 99, 'N'),
(103, 5, 100, 'N'),
(104, 5, 101, 'N'),
(105, 5, 102, 'N'),
(106, 5, 103, 'N'),
(107, 5, 104, 'N'),
(108, 5, 105, 'N'),
(109, 5, 106, 'N'),
(110, 5, 107, 'N'),
(111, 5, 108, 'N'),
(112, 5, 109, 'N'),
(113, 5, 110, 'N'),
(114, 5, 111, 'N'),
(115, 5, 112, 'N'),
(116, 5, 113, 'N'),
(117, 5, 114, 'N'),
(118, 5, 115, 'N'),
(119, 5, 116, 'N'),
(120, 5, 117, 'N'),
(121, 5, 118, 'N'),
(122, 5, 119, 'N'),
(123, 5, 120, 'N'),
(124, 22, 121, 'N'),
(125, 8, 122, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `error`
--

CREATE TABLE IF NOT EXISTS `error` (
  `e_id` int(11) NOT NULL,
  `e_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `staff_id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `m_parent` int(11) DEFAULT NULL,
  `price` decimal(8,4) DEFAULT NULL,
  `product_number` varchar(30) DEFAULT NULL,
  `unit` varchar(50) NOT NULL,
  `color_hex` varchar(6) DEFAULT NULL,
  `measurable` enum('Y','N') NOT NULL DEFAULT 'N',
  `current` enum('Y','N') NOT NULL DEFAULT 'Y',
  `c_id` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`m_id`, `m_name`, `m_parent`, `price`, `product_number`, `unit`, `color_hex`, `measurable`, `current`, `c_id`) VALUES
(1, 'ABS (Generic)', NULL, '0.0000', NULL, 'gram(s)', NULL, 'N', 'Y', 17),
(2, 'Acrylic', 123, '0.0200', NULL, 'sq_inch(es)', NULL, 'N', 'Y', 8),
(3, 'Cotton', NULL, '0.0000', NULL, '', NULL, 'N', 'Y', 6),
(4, 'Glass (Generic)', 123, '0.0200', NULL, 'sq_inch(es)', NULL, 'N', 'Y', 13),
(5, 'Leather', NULL, '0.0000', NULL, '', NULL, 'N', 'Y', 6),
(6, 'FabLab PLA', NULL, '0.0500', NULL, 'gram(s)', NULL, 'Y', 'Y', 18),
(7, 'Vinyl (Generic)', NULL, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(8, 'Wood', 123, '0.0200', NULL, 'sq_inch(es)', NULL, 'N', 'Y', 10),
(9, 'Basswood', 123, '0.0200', NULL, 'sq_inch(es)', NULL, 'N', 'Y', 9),
(10, 'Plywood', 123, '0.0200', NULL, 'sq_inch(es)', NULL, 'N', 'Y', 11),
(11, 'MDF', NULL, '0.0000', NULL, '', NULL, 'N', 'Y', 7),
(12, 'Other', NULL, NULL, NULL, '', NULL, 'N', 'Y', 7),
(13, 'ABS Black', 1, '0.0500', '3D ABS-1KG1.75-BLK', 'gram(s)', '000000', 'Y', 'Y', 17),
(14, 'ABS Blue', 1, '0.0500', NULL, 'gram(s)', '0047BB', 'Y', 'Y', 17),
(15, 'ABS Green', 1, '0.0500', NULL, 'gram(s)', '00BF6F', 'Y', 'Y', 17),
(16, 'ABS Orange', 1, '0.0500', NULL, 'gram(s)', 'fe5000', 'Y', 'Y', 17),
(17, 'ABS Red', 1, '0.0500', NULL, 'gram(s)', 'D22630', 'Y', 'Y', 17),
(18, 'ABS Purple', 1, '0.0500', NULL, 'gram(s)', '440099', 'Y', 'Y', 17),
(19, 'ABS Yellow', 1, '0.0500', NULL, 'gram(s)', 'FFE900', 'Y', 'Y', 17),
(20, 'Vinyl Black', 7, '0.2500', NULL, 'inch(es)', '000000', 'Y', 'Y', 4),
(21, 'Vinyl Sapphire Gloss', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(22, 'Vinyl Green', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(23, 'Vinyl Orange', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(24, 'Vinyl Cherry Red Matte', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(25, 'Vinyl Plum', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(26, 'Vinyl Yellow', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(27, 'uPrint Material', NULL, '8.1900', NULL, 'inch<sup>3</sup>', 'fdffe2', 'Y', 'Y', 19),
(28, 'BYO Hatchbox', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(29, 'ABS White', 1, '0.0500', NULL, 'gram(s)', 'ffffff', 'Y', 'Y', 17),
(30, 'Vinyl White', 7, '0.2500', NULL, 'inch(es)', 'ffffff', 'Y', 'Y', 4),
(31, 'Transfer Tape', NULL, '0.1000', NULL, 'inch(es)', NULL, 'Y', 'Y', 7),
(32, 'uPrint Support', NULL, '8.1900', NULL, 'inch<sup>3</sup>', NULL, 'Y', 'Y', 19),
(33, 'ABS Bronze', 1, '0.0500', NULL, 'gram(s)', 'A09200', 'Y', 'Y', 17),
(35, 'ABS Pink', 1, '0.0500', NULL, 'gram(s)', 'FF3EB5', 'Y', 'Y', 17),
(36, 'ABS Mint', 1, '0.0500', NULL, 'gram(s)', '88DBDF', 'Y', 'Y', 17),
(37, 'ABS Glow in the dark', 1, '0.0500', NULL, 'gram(s)', 'D0DEBB', 'Y', 'Y', 17),
(38, 'ABS Trans Orange', 1, '0.0500', NULL, 'gram(s)', 'FCC89B', 'Y', 'Y', 17),
(39, 'ABS Trans Red', 1, '0.0500', NULL, 'gram(s)', 'DF4661', 'Y', 'Y', 17),
(40, 'ABS Trans White', 1, '0.0500', NULL, 'gram(s)', 'D9D9D6', 'Y', 'Y', 17),
(41, 'ABS Trans Green', 1, '0.0500', NULL, 'gram(s)', 'A0DAB3', 'Y', 'Y', 17),
(42, 'ABS Gold', 1, '0.0500', NULL, 'gram(s)', 'CFB500', 'Y', 'Y', 17),
(43, 'Vinyl Ocean Blue', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(44, 'Vinyl Red Gloss', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(45, 'Vinyl Pink', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(46, 'Vinyl Teal Gloss', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(48, 'Vinyl Silver', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(49, 'uPrint Bed New', NULL, '0.0000', NULL, '', NULL, 'N', 'Y', 19),
(50, 'uPrint Bed Partly_Used', NULL, '0.0000', NULL, '', NULL, 'N', 'Y', 19),
(51, 'Delrin Sheet', NULL, '0.0000', NULL, '', NULL, 'N', 'Y', 7),
(52, 'Thread', NULL, '1.0000', NULL, 'hour(s)', NULL, 'Y', 'Y', 6),
(53, 'Paper-stock (chipboard)', NULL, NULL, NULL, '', NULL, 'N', 'Y', 7),
(54, 'NinjaFlex (Generic)', NULL, '0.1500', NULL, 'gram(s)', NULL, 'N', 'Y', 20),
(55, 'NinjaFlex Black', 54, '0.1500', NULL, 'gram(s)', '000000', 'Y', 'Y', 20),
(56, 'NinjaFlex White', 54, '0.1500', NULL, 'gram(s)', 'ffffff', 'Y', 'Y', 20),
(57, 'Vinyl Coral', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(58, 'Vinyl *Scraps', 7, '0.0000', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(59, 'ABS Lime', 1, '0.0500', NULL, 'gram(s)', 'c2e189', 'Y', 'Y', 17),
(60, 'ABS Copper', 1, '0.0500', NULL, 'gram(s)', '7C4D3A', 'Y', 'Y', 17),
(61, 'ABS Silver', 1, '0.0500', NULL, 'gram(s)', '9EA2A2', 'Y', 'Y', 17),
(62, 'ABS Trans Black', 1, '0.0500', NULL, 'gram(s)', '919D9D', 'Y', 'Y', 17),
(63, 'ABS Trans Blue', 1, '0.0500', NULL, 'gram(s)', 'C8D8EB', 'Y', 'Y', 17),
(64, 'ABS Trans Yellow', 1, '0.0500', NULL, 'gram(s)', 'FFFF74', 'Y', 'Y', 17),
(65, 'Vinyl Mint', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(66, 'Vinyl Lime Green', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(67, 'Vinyl Gold', 7, '0.2500', NULL, 'inch(es)', NULL, 'Y', 'Y', 4),
(68, 'Screen Ink(Generic)', NULL, '0.0500', NULL, 'gram(s)', NULL, 'Y', 'Y', 15),
(69, 'NinjaFlex Water', 54, '0.1500', NULL, 'gram(s)', NULL, 'Y', 'Y', 20),
(70, 'NinjaFlex Lava', 54, '0.1500', NULL, 'gram(s)', NULL, 'Y', 'Y', 20),
(71, 'NinjaFlex Sapphire', 54, '0.1500', NULL, 'gram(s)', NULL, 'Y', 'Y', 20),
(72, 'ABS Neon Green', 1, '0.0500', NULL, 'gram(s)', '77ff35', 'Y', 'Y', 17),
(73, 'ABS Brown', 1, '0.0500', NULL, 'gram(s)', '721c00', 'Y', 'Y', 17),
(74, 'ABS Beige', 1, '0.0500', NULL, 'gram(s)', 'f7f799', 'Y', 'Y', 17),
(75, 'Comet White', 68, '0.0500', NULL, 'gram(s)', 'ffffff', 'Y', 'Y', 15),
(76, 'Pitch Black', 68, '0.0500', NULL, 'gram(s)', '000000', 'Y', 'Y', 15),
(77, 'Neptune Blue', 68, '0.0500', NULL, 'gram(s)', '0011ff', 'Y', 'Y', 15),
(78, 'Mars Red', 68, '0.0500', NULL, 'gram(s)', 'ff0000', 'Y', 'Y', 15),
(79, 'Starburst Yellow', 68, '0.0500', NULL, 'gram(s)', 'faff00', 'Y', 'Y', 15),
(80, 'BYO Mats', NULL, '0.0000', NULL, 'inch(es)', NULL, 'Y', 'Y', 7),
(81, 'BYO 3D Prima', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(82, 'BYO 3DFuel', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(83, 'BYO 3rDment', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(84, 'BYO Alchement', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(85, 'BYO ColorFabb', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(86, 'BYO Faberdashery', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(87, 'BYO Fenner Drives/Ninja', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(88, 'BYO Filamentum', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(89, 'BYO FormFutura', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(90, 'BYO GizmoDorks', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(91, 'BYO 3D FilaPrint', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(92, 'BYO IC3D', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(93, 'BYO Inland Plastics', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(94, 'BYO Lulzbot', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(95, 'BYO MakerBot', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(96, 'BYO MatterHackers', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(97, 'BYO PolyMaker', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(98, 'BYO Proto-Pasta', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(99, 'BYO Taulmann', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 7),
(100, 'Vinyl Sky Blue', 7, '0.2500', NULL, 'inch(es)', '7cc8ff', 'Y', 'Y', 4),
(101, 'HT Hibiscous', 7, '0.3000', NULL, 'inch(es)', 'f44265', 'Y', 'Y', 4),
(102, 'HT Bright Red', 7, '0.3000', NULL, 'inch(es)', 'ff0000', 'Y', 'Y', 4),
(103, 'HT Orange', 7, '0.3000', NULL, 'inch(es)', 'ffa500', 'Y', 'Y', 4),
(104, 'HT Red', 7, '0.3000', NULL, 'inch(es)', 'ea0b0b', 'Y', 'Y', 4),
(105, 'HT Lemon Yellow', 7, '0.3000', NULL, 'inch(es)', 'fffa00', 'Y', 'Y', 4),
(106, 'HT Texas Orange', 7, '0.3000', NULL, 'inch(es)', 'ff9102', 'Y', 'Y', 4),
(107, 'HT Yellow', 7, '0.3000', NULL, 'inch(es)', 'ffc700', 'Y', 'Y', 4),
(108, 'HT Sun Yellow', 7, '0.3000', NULL, 'inch(es)', 'ffb600', 'Y', 'Y', 4),
(109, 'HT Lime', 7, '0.3000', NULL, 'inch(es)', '6bff02', 'Y', 'Y', 4),
(110, 'HT Green Apple', 7, '0.3000', NULL, 'inch(es)', '5de000', 'Y', 'Y', 4),
(111, 'HT Green', 7, '0.3000', NULL, 'inch(es)', '45a800', 'Y', 'Y', 4),
(112, 'HT Dark Green', 7, '0.3000', NULL, 'inch(es)', '327a00', 'Y', 'Y', 4),
(113, 'HT Sky Blue', 7, '0.3000', NULL, 'inch(es)', '0090ff', 'Y', 'Y', 4),
(114, 'HT Royal Blue', 7, '0.3000', NULL, 'inch(es)', '0036ad', 'Y', 'Y', 4),
(115, 'HT Lilac', 7, '0.3000', NULL, 'inch(es)', 'f27fff', 'Y', 'Y', 4),
(116, 'HT Violet', 7, '0.3000', NULL, 'inch(es)', '6b0077', 'Y', 'Y', 4),
(117, 'HT Black', 7, '0.3000', NULL, 'inch(es)', '000000', 'Y', 'Y', 4),
(118, 'HT White', 7, '0.3000', NULL, 'inch(es)', 'ffffff', 'Y', 'Y', 4),
(119, 'HT Silver', 7, '0.3000', NULL, 'inch(es)', 'adadad', 'Y', 'Y', 4),
(120, 'HT Gold', 7, '0.3000', NULL, 'inch(es)', 'c6b900', 'Y', 'Y', 4),
(121, 'BYO Copper Clad Board', NULL, '0.2500', NULL, 'in<sup>2</sup>', NULL, 'Y', 'Y', 7),
(122, 'FabLab-Approved BYO PLA', NULL, '0.0000', NULL, 'gram(s)', NULL, 'Y', 'Y', 2),
(123, 'Sheet Goods', NULL, NULL, NULL, 'inch(es)', NULL, 'N', 'N', 1),
(124, 'Clear Glass', 4, '0.0200', NULL, 'sq_inch(es)', NULL, 'Y', 'Y', 13),
(125, 'Red Glass', 4, '0.0200', NULL, 'sq_inch(es)', 'ff0a00', 'Y', 'Y', 13),
(126, 'Blue Glass', 4, '0.0200', NULL, 'sq_inch(es)', '0008ff', 'Y', 'Y', 13),
(127, 'Pink Glass', 4, '0.0200', NULL, 'sq_inch(es)', 'ff00fa', 'Y', 'Y', 13),
(128, 'Dark Basswood', 9, '0.0200', NULL, 'sq_inch(es)', '49320d', 'Y', 'Y', 9),
(129, 'Light Basswood', 9, '0.0200', NULL, 'sq_inch(es)', '8c6500', 'Y', 'Y', 9),
(130, 'Oak Wood', 8, '0.0200', NULL, 'sq_inch(es)', '805300', 'Y', 'Y', 10),
(131, 'Cherry Wood', 8, '0.0200', NULL, 'sq_inch(es)', 'ff9f94', 'Y', 'Y', 10),
(132, 'Birch Wood', 8, '0.0200', NULL, 'sq_inch(es)', 'efe0a7', 'Y', 'Y', 10),
(133, 'Softwood Plywood', 10, '0.0200', NULL, 'sq_inch(es)', 'f1ecbc', 'Y', 'Y', 11),
(134, 'Hardwood Plywood', 10, '0.0200', NULL, 'sq_inch(es)', 'cdb677', 'Y', 'Y', 11),
(135, 'Black Glass', 4, '0.0200', NULL, 'sq_inch(es)', '000000', 'Y', 'Y', 13),
(136, 'Clear Acrylic', 2, '0.0200', NULL, 'sq_inch(es)', NULL, 'Y', 'Y', 8),
(137, 'Purple Glass', 4, '0.0200', NULL, 'sq_inch(es)', 'b95aff', 'Y', 'Y', 13),
(138, 'Sheet Test', 123, '0.0200', NULL, 'sq_inch(es)', NULL, 'Y', 'Y', 12),
(139, 'Brown Sheet', 138, '0.0200', NULL, 'sq_inch(es)', '804040', 'Y', 'Y', 12);

-- --------------------------------------------------------

--
-- Table structure for table `mats_used`
--

CREATE TABLE IF NOT EXISTS `mats_used` (
  `mu_id` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `m_id` int(11) NOT NULL,
  `quantity` decimal(7,2) DEFAULT NULL,
  `status_id` int(4) NOT NULL,
  `staff_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mats_used`
--

INSERT INTO `mats_used` (`mu_id`, `trans_id`, `m_id`, `quantity`, `status_id`, `staff_id`) VALUES
(1, NULL, 18, '120.00', 6, '1000000010'),
(2, NULL, 4, '1000.00', 6, '1000000010'),
(3, NULL, 135, '1000.00', 6, '1000000010'),
(4, NULL, 135, '9999.00', 6, '1000000010');

-- --------------------------------------------------------

--
-- Table structure for table `objbox`
--

CREATE TABLE IF NOT EXISTS `objbox` (
  `o_id` int(11) NOT NULL,
  `o_start` datetime NOT NULL,
  `o_end` datetime DEFAULT NULL,
  `address` varchar(10) DEFAULT NULL,
  `operator` varchar(10) DEFAULT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `staff_id` varchar(10) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13485 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purpose`
--

CREATE TABLE IF NOT EXISTS `purpose` (
  `p_id` int(11) NOT NULL,
  `p_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purpose`
--

INSERT INTO `purpose` (`p_id`, `p_title`) VALUES
(1, 'Curricular Research'),
(2, 'Extra Curricular Research'),
(3, 'Non-Academic'),
(4, 'Service-Call');

-- --------------------------------------------------------

--
-- Table structure for table `rfid`
--

CREATE TABLE IF NOT EXISTS `rfid` (
  `rf_id` int(11) NOT NULL,
  `rfid_no` varchar(64) NOT NULL,
  `operator` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `r_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `lvl_desc` varchar(255) NOT NULL,
  `r_rate` decimal(9,2) DEFAULT NULL,
  `variable` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`r_id`, `title`, `lvl_desc`, `r_rate`, `variable`) VALUES
(1, 'Visitor', 'Non-member lvl', '0.00', 'visitor'),
(2, 'Learner', 'Student Level Membership', '0.00', 'learner'),
(3, 'Learner-RFID', 'Learner''s with RFID access', '2.00', 'learner_rfid'),
(4, 'Community Member', 'Non-Student, 4 Month Membership', '10.00', 'community'),
(7, 'Service', 'Service technicians that need to work on FabLab Equipment', '0.00', 'service'),
(8, 'FabLabian', 'Student Worker', '0.00', 'staff'),
(9, 'Lead FabLabian', 'Student Supervisor', '0.00', 'lead'),
(10, 'Admin', 'Staff with additioanal duties ', '0.00', 'admin'),
(11, 'Super', 'Administration Level of FabLab', '0.00', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `service_call`
--

CREATE TABLE IF NOT EXISTS `service_call` (
  `sc_id` int(11) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `d_id` int(11) NOT NULL,
  `sl_id` int(11) NOT NULL,
  `solved` enum('Y','N') NOT NULL DEFAULT 'N',
  `sc_notes` text NOT NULL,
  `sc_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_lvl`
--

CREATE TABLE IF NOT EXISTS `service_lvl` (
  `sl_id` int(11) NOT NULL,
  `msg` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_lvl`
--

INSERT INTO `service_lvl` (`sl_id`, `msg`) VALUES
(1, 'Maintenance'),
(5, 'Issue'),
(7, 'Out For OutReach'),
(10, 'NonOperating');

-- --------------------------------------------------------

--
-- Table structure for table `service_reply`
--

CREATE TABLE IF NOT EXISTS `service_reply` (
  `sr_id` int(11) NOT NULL,
  `sc_id` int(11) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `sr_notes` text NOT NULL,
  `sr_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sheet_good_inventory`
--

CREATE TABLE IF NOT EXISTS `sheet_good_inventory` (
  `inv_id` int(11) NOT NULL,
  `m_id` int(11) DEFAULT NULL,
  `m_parent` int(11) DEFAULT NULL,
  `width` decimal(11,2) DEFAULT NULL,
  `height` decimal(11,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sheet_good_inventory`
--

INSERT INTO `sheet_good_inventory` (`inv_id`, `m_id`, `m_parent`, `width`, `height`, `quantity`) VALUES
(1, 135, 4, '1.00', '1.00', 7),
(2, 134, 10, '5.00', '3.00', 45),
(3, 139, 138, '1.00', '1.00', 2),
(4, 124, 4, '1.20', '1.10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sheet_good_transactions`
--

CREATE TABLE IF NOT EXISTS `sheet_good_transactions` (
  `sg_trans_ID` int(11) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `inv_id` int(11) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `remove_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sheet_good_transactions`
--

INSERT INTO `sheet_good_transactions` (`sg_trans_ID`, `trans_id`, `inv_id`, `quantity`, `remove_date`) VALUES
(1, 35287, 0, 1, '2019-09-19 17:52:30'),
(2, 35288, 0, 1, '2019-09-19 18:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `site_variables`
--

CREATE TABLE IF NOT EXISTS `site_variables` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` varchar(100) NOT NULL,
  `notes` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_variables`
--

INSERT INTO `site_variables` (`id`, `name`, `value`, `notes`) VALUES
(1, 'uprint_conv', '16.387', 'inches^3 to grams'),
(2, 'minTime', '1', 'Minimum hour charge for a device'),
(3, 'box_number', '11', 'Number of Shelves used for object storage'),
(4, 'letter', '15', 'Number of Rows in each Box'),
(5, 'grace_period', '300', 'Grace period allotted to each Ticket(sec)'),
(6, 'limit', '180', '(seconds) 3 minutes before auto-logout'),
(7, 'limit_long', '800', '(seconds) 10 minutes before auto-logout'),
(8, 'maxHold', '14', '# of Days for Holding Period for 3D prints'),
(9, 'serving', '0', 'Now serving number such and such'),
(10, 'bServing', '0', 'Boss Laser Now serving number'),
(11, 'eServing', '0', 'Epilog Laser Now serving number'),
(12, 'next', '0', 'Last Number Issued for 3D Printing'),
(13, 'bNext', '0', 'Last Number Issued for Boss Laser'),
(14, 'eNext', '0', 'Last Number Issued for Epilog Laser'),
(15, 'forgotten', 'webapps.uta.edu/oit/selfservice/', 'UTA''s Password Reset'),
(16, 'check_expire', 'N', 'Do we deny users if they have an expired membership. Expected Values (Y,N)'),
(17, 'ip_range_1', '/^129\\.107\\.\\d{2,}\\.\\d{2,}/', 'Block certain abilities based upon IP. Follow Regex format.'),
(18, 'ip_range_2', '/^129\\.107\\.73\\..*/', 'Block certain abilities based upon IP. Follow Regex format.'),
(19, 'inspectPrint', 'Once a print has been picked up & paid for we can not issue a refund.', 'Disclosure for picking up a 3D Print'),
(20, 'site_name', 'FabApp', 'Name of site owner'),
(21, 'paySite', 'https://csgoldweb.uta.edu/admin/quicktran/main.php', '3rd party Pay System. (CsGold)'),
(22, 'paySite_name', 'CS Gold', '3rd party pay site'),
(23, 'currency', 'fas fa-dollar-sign', 'Icon as Defined by Font Awesome'),
(24, 'api_key', 'HDVmyqkZB5vsPQGAKwpLtPPQ8Pauy5DMVWsefcBVsbzv9AQnrJFhyAuqBhLCL9r8AFxtDAgjc7Qjf8bdL9eaAXd7VnejU7DHw', 'Temp fix to secure FLUD script'),
(25, 'dateFormat', 'M d, Y g:i a', 'format the date using Php''s date() function.'),
(26, 'timezone', 'America/Chicago', 'Set Local Time Zone'),
(27, 'timeInterval', '.25', 'Minimum time unit of an hour.'),
(28, 'LvlOfStaff', '8', 'First role level ID of staff.'),
(29, 'minRoleTrainer', '11', 'Minimum Role Level of Trainer, below this value you can not issue a training.'),
(30, 'editTrans', '9', ' Role level required to edit a Transaction'),
(31, 'editRole', '11', 'Level of Staff Required to edit RoleID'),
(32, 'editRfid', '11', 'Level of Staff Required to edit RFID'),
(33, 'lastRfid', '382094490', 'This is the last RFID that was scanned by the JuiceBox.'),
(34, 'regexUser', '^\\d{10}$', 'regular expression used to verify a user''s identification number'),
(35, 'regexPayee', '^\\d{9,10}$', 'regular expression used to verify a payee''s identification number'),
(36, 'rank_period', '3', '# of months the rank is based off of'),
(37, 'misc', 'Vinyl ', 'Miscellaneous Wait-Tab'),
(38, 'mServing', '0', 'Misc now serving'),
(39, 'mNext', '0', 'Misc Next Issuable Number'),
(40, 'backdoor_pass', 'cI94eg0cXZWL', 'General password to be used when the authentication server is not working.'),
(41, 'service', 'pearce229', 'Service Technician '),
(42, 'wait_system', 'new', 'toggle between the new system and the old. (any/new)'),
(43, 'editSV', '11', 'Role Level that allows you to edit Site Variables.  Do not set this beyond your highest assignable level. '),
(44, 'clear_queue', '9', 'Minimum Level Required to clear the Wait Queue'),
(45, 'staffTechnican', '10', 'Minimum Staff Level Required to perform Service Replies and override Gatekeeper'),
(46, 'serviceTechnican', '7', 'External Role Level Required to perform Service Replies and override Gatekeeper'),
(47, 'wait_period', '300', 'Waiting period allotted to each Wait Queue Ticket(sec)'),
(48, 'LvlOfLead', '9', 'Role of Lead for inventory editing'),
(49, 'sheet_goods_parent', '123', 'sheet good parent material id'),
(50, 'sheet_device', '68', ''),
(51, 'website_url', 'http://www.fablab.uta.edu', 'Website for FabLab organization'),
(52, 'phone_number', '(817) 272-1785', 'FabLab helpline'),
(53, 'strg_drwr_indicator', 'numer', 'numer for a numeric drawer label, alpha for an alphabetical drawer label'),
(54, 'icon', 'fa-icon.png', 'FabApp icon'),
(55, 'icon2', 'fablab2.png', 'FabApp icon');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `variable` varchar(25) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `message`, `variable`) VALUES
(1, NULL, NULL),
(2, 'Failed Material', 'failed_mat'),
(3, 'Removed', 'removed'),
(4, 'Used', 'used'),
(5, 'Unused', 'unused'),
(6, 'Updated', 'updated'),
(7, 'Received', 'received'),
(8, NULL, NULL),
(9, NULL, NULL),
(10, NULL, NULL),
(11, 'Active', 'active'),
(12, 'Offline', 'offline'),
(13, 'Moveable', 'moveable'),
(14, 'Total Fail', 'total_fail'),
(15, 'Partial', 'partial_fail'),
(16, 'Cancelled', 'cancelled'),
(17, 'Complete', 'complete'),
(18, 'Stored', 'stored'),
(19, NULL, NULL),
(20, NULL, NULL),
(21, 'Charge to Account', 'charge_to_acct'),
(22, 'Charge to FabLab', 'charge_to_fablab'),
(23, 'Charge to Library', 'charge_to_library'),
(24, 'Unprocessed Sheet Ticket', 'sheet_sale');

-- --------------------------------------------------------

--
-- Table structure for table `storage_box`
--

CREATE TABLE IF NOT EXISTS `storage_box` (
  `drawer` varchar(3) NOT NULL DEFAULT '1',
  `unit` varchar(3) NOT NULL DEFAULT 'A',
  `drawer_size` varchar(7) DEFAULT '5-3',
  `start` varchar(7) NOT NULL DEFAULT '1-1',
  `span` varchar(7) NOT NULL DEFAULT '1-1',
  `trans_id` int(11) DEFAULT NULL,
  `item_change_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `staff_id` varchar(10) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table_descriptions`
--

CREATE TABLE IF NOT EXISTS `table_descriptions` (
  `t_d_id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `description` varchar(140) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_descriptions`
--

INSERT INTO `table_descriptions` (`t_d_id`, `table_name`, `label`, `description`) VALUES
(1, 'accounts', 'Account Charge Types', 'List out the types of account charges'),
(2, 'acct_charge', 'Charges to Accounts', 'List of the transactions made'),
(3, 'authrecipients', 'Item Pickup Recipients', 'List of people who are allowed to pick up an item based on ticket'),
(4, 'auth_accts', 'Authorized Accounts', 'Unknown, Empty Table'),
(5, 'carrier', 'Phone Carriers', 'List of carriers and associated data'),
(6, 'citation', 'Citiations', 'Unknown, Empty Table'),
(7, 'devices', 'Devices', 'List of devices'),
(8, 'device_group', 'Device Groups', 'Device group names and desc. Device groups are referenced by devices'),
(9, 'device_materials', 'Device Materials', 'Connect device groups and materials'),
(10, 'error', 'Errors', 'List of errors'),
(11, 'interaction', 'Interaction', 'Unknown, Empty Table'),
(12, 'materials', 'Materials', 'List of specific materials and descriptions'),
(13, 'mats_used', 'Material Qty Tracking', 'All changes in quantity for materials'),
(14, 'objbox', 'Stored Items', 'List of items created by learners that have not yet been picked up'),
(15, 'purpose', 'Reasons for Creation', 'Set list of reasons for creating an item'),
(16, 'rfid', 'RFID Numbers', 'List of accepted RFID'),
(17, 'role', 'Privelege Role Levels', 'List of available roles'),
(18, 'service_call', 'Current Service Issue', 'Current service Issue'),
(19, 'service_lvl', 'Service Type', 'Reason for Service'),
(20, 'service_reply', 'Service Reply', 'Explanation of work done for service issue'),
(21, 'site_variables', 'Site Variables', 'Current variables used for creation of site'),
(22, 'status', 'Material Transaction Status', 'Explanation of material trasnaction'),
(23, 'table_descriptions', 'Table Descriptions', 'Table that displays this information'),
(24, 'tm_enroll', 'Certified Trainings', 'List of certified trainings'),
(25, 'trainingmodule', 'Trainings', 'List of possible trainings'),
(26, 'transactions', 'FabLab Transactions', 'List of all transactions of the FabLab'),
(27, 'users', 'Users', 'List of everyone signed into FabApp'),
(28, 'wait_queue', 'Wait Queue', 'List of people waiting for a device');

-- --------------------------------------------------------

--
-- Table structure for table `tm_enroll`
--

CREATE TABLE IF NOT EXISTS `tm_enroll` (
  `tme_key` int(11) NOT NULL,
  `tm_id` int(11) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `completed` datetime NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `current` enum('Y','N') NOT NULL,
  `altered_date` datetime DEFAULT NULL,
  `altered_notes` text,
  `altered_by` varchar(10) DEFAULT NULL,
  `expiration_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trainingmodule`
--

CREATE TABLE IF NOT EXISTS `trainingmodule` (
  `tm_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `tm_desc` text,
  `duration` time NOT NULL,
  `d_id` int(11) DEFAULT NULL,
  `dg_id` int(11) DEFAULT NULL,
  `tm_required` enum('Y','N') NOT NULL DEFAULT 'N',
  `file_name` varchar(100) DEFAULT NULL,
  `file_bin` mediumblob,
  `class_size` int(11) NOT NULL,
  `tm_stamp` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainingmodule`
--

INSERT INTO `trainingmodule` (`tm_id`, `title`, `tm_desc`, `duration`, `d_id`, `dg_id`, `tm_required`, `file_name`, `file_bin`, `class_size`, `tm_stamp`) VALUES
(22, 'Plasma Cutter Training', 'Learn how to design and cut 2D objects out of sheet metal by using the CNC plasma cutter! Successful completion of the Shop Safety Orientation training and a signed liability waiver on file are required in order to participate in this training.', '02:00:00', 4, NULL, 'Y', NULL, NULL, 5, '2018-01-22 14:57:12'),
(23, 'General Shoproom Training', 'Get an overview of all the Shop Room equipment and learn how to operate safety in this space! This training is required and a signed liability waiver must be on file before learners will be permitted to participate in any of the equipment specific trainings.', '01:00:00', NULL, 3, 'Y', NULL, NULL, 5, '2017-10-23 17:11:25'),
(24, 'Sanding and Grinding Training', 'trained on random orbital sander, both combo sanders, bench grinder', '02:00:00', NULL, 18, 'Y', NULL, NULL, 2, '2017-10-25 19:44:33'),
(25, 'ShopBot Training part 1', 'ShopBot basics, safety, and fundamental commands', '02:00:00', 19, NULL, 'Y', NULL, NULL, 3, '2017-10-30 20:11:58'),
(26, 'Drills and Drill Press Training', 'Learn how to use a hammer drill, hand drill, and our drill presses to create cylindrical holes in your workpiece.  Successful completion of the Shop Safety Orientation training and a signed liability waiver on file are required in order to participate in this training.', '02:00:00', NULL, 19, 'Y', NULL, NULL, 5, '2017-11-01 18:09:06'),
(27, 'ShopBot Part 2', 'Demonstration', '02:00:00', 19, NULL, 'Y', NULL, NULL, 3, '2017-11-06 20:19:03'),
(28, 'Compound Mitre Saw Training', 'introduction to the compound mitre saw', '02:00:00', 6, NULL, 'Y', NULL, NULL, 4, '2017-11-08 19:43:09'),
(29, 'SawStop safety training', 'Learn how to safely handle wood on a table saw to create cross cuts and rip cuts. Participants will also learn how to use a fence and an outfeed table. Successful completion of the Shop Safety Orientation training and a signed liability waiver on file are required in order to participate in this training.', '02:00:00', 20, NULL, 'Y', NULL, NULL, 4, '2018-01-13 13:54:49'),
(30, 'Jigsaw, ScrollSaw, & Bandsaw Training', 'Learn the distinction between a jig, band, and scroll saw and what type of work is most appropriate for each machine.  Participants will practice cutting scrolls (non-straight lines). Successful completion of the Shop Safety Orientation training and a signed liability waiver on file are required in order to participate in this training.', '02:00:00', NULL, 20, 'Y', NULL, NULL, 5, '2018-02-05 15:43:40'),
(32, 'Media Blaster', 'Basic operational training - air line safety, mitigating clogs, practice time\r\n(does not include blast media change out training)', '00:30:00', 49, NULL, 'Y', NULL, NULL, 5, '2018-02-05 15:43:25'),
(33, 'Sherline demo course', 'This should be deleted before we do any actual trainings', '01:30:00', 17, NULL, 'Y', NULL, NULL, 5, '2019-02-18 10:23:04');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `trans_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `operator` varchar(10) DEFAULT NULL,
  `est_time` time DEFAULT NULL,
  `t_start` datetime NOT NULL,
  `t_end` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `staff_id` varchar(10) DEFAULT NULL,
  `notes` text,
  `pickup_time` datetime DEFAULT NULL,
  `pickedup_by` varchar(10) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=35292 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`trans_id`, `d_id`, `operator`, `est_time`, `t_start`, `t_end`, `status_id`, `p_id`, `staff_id`, `notes`, `pickup_time`, `pickedup_by`) VALUES
(35286, 68, '1000129288', '00:00:00', '2019-09-19 16:16:02', '2019-09-19 16:21:08', 14, 1, '1000000010', NULL, NULL, NULL),
(35287, 68, '1000129288', '00:00:00', '2019-09-19 17:52:25', '2019-09-19 17:52:30', 17, 3, '1000000010', NULL, NULL, NULL),
(35288, 68, '1000129288', '00:00:00', '2019-09-19 18:08:10', '2019-09-19 18:08:38', 17, 3, '1000000010', NULL, NULL, NULL),
(35289, 37, '1000000010', '00:00:00', '2019-10-10 16:45:33', '2019-10-10 16:46:52', 17, 1, '1000000010', NULL, NULL, NULL),
(35290, 37, '1000000010', '00:00:00', '2019-10-10 16:47:20', NULL, 11, 2, '1000000010', NULL, NULL, NULL),
(35291, 68, '1000000010', '00:00:00', '2019-10-13 17:54:53', '2019-10-13 17:54:53', 24, 1, '1000000010', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int(11) NOT NULL,
  `operator` varchar(10) NOT NULL,
  `r_id` int(11) NOT NULL,
  `exp_date` datetime DEFAULT NULL,
  `icon` varchar(40) DEFAULT NULL,
  `adj_date` datetime DEFAULT NULL,
  `notes` text NOT NULL,
  `long_close` enum('N','Y') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `operator`, `r_id`, `exp_date`, `icon`, `adj_date`, `notes`, `long_close`) VALUES
(1, '1000129288', 11, NULL, 'fas fa-skull-crossbones', NULL, '', 'N'),
(2, '1000798167', 11, NULL, 'far fa-hand-spock', NULL, '', 'Y'),
(3, '1000000001', 1, NULL, NULL, NULL, '', 'N'),
(4, '1000000002', 2, NULL, 'far fa-hand-peace', NULL, '', 'N'),
(5, '1000000003', 3, NULL, NULL, NULL, '', 'N'),
(6, '1000000004', 4, NULL, NULL, NULL, '', 'N'),
(7, '1000000007', 7, NULL, NULL, NULL, '', 'N'),
(8, '1000000008', 8, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(9, '1000000009', 9, NULL, 'fab fa-grav fa-spin', NULL, '', 'N'),
(10, '1000000010', 11, NULL, 'fas fa-university', NULL, '', 'N'),
(11, '1000930024', 9, NULL, 'fab fa-rebel', NULL, '', 'N'),
(12, '1001235188', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(13, '1212121212', 9, NULL, NULL, '2019-05-13 17:10:09', '1000000010', 'N'),
(14, '1001240396', 8, NULL, NULL, NULL, '', 'N'),
(15, '1001097016', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(16, '1001393082', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(17, '1000511999', 9, NULL, 'fab fa-earlybirds', NULL, '', 'N'),
(18, '1001184350', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(19, '1001539166', 9, NULL, 'fab fa-d-and-d', NULL, '', 'N'),
(20, '1000996275', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(21, '1000903859', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(22, '1001139244', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(23, '1000914553', 2, NULL, 'fab fa-graduation-cap', NULL, '', 'N'),
(24, '1001059227', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(25, '1001113426', 2, NULL, NULL, NULL, '', 'N'),
(26, '1001054936', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(27, '1001193749', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(28, '1001031091', 2, NULL, NULL, NULL, '', 'N'),
(29, '1000756631', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(30, '1001014235', 2, NULL, NULL, NULL, '', 'N'),
(31, '1001102600', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(32, '1001246627', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(33, '1001113796', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(34, '1001096024', 9, NULL, 'fas fa-graduation-cap', '2018-12-20 12:18:18', '1000129288', 'N'),
(35, '1001146286', 8, NULL, 'fas fa-chess-queen', NULL, '', 'N'),
(36, '1001142661', 2, NULL, NULL, NULL, '', 'N'),
(37, '1001011858', 11, NULL, 'fas fa-rocket fa-spin', NULL, '', 'N'),
(38, '1000867102', 2, NULL, 'fas fa-graduation-cap', NULL, '', 'N'),
(39, '1000916886', 11, NULL, 'fas fa-medkit', NULL, '', 'N'),
(40, '6001123119', 11, NULL, 'far fa-gem', NULL, '', 'N'),
(41, '1000000000', 9, NULL, 'fas fa-robot', '2017-10-23 16:39:38', '1001011858', 'N'),
(42, '1001614145', 2, NULL, NULL, '2017-10-23 17:59:05', '1000798167', 'N'),
(43, '1001135040', 2, NULL, NULL, '2017-10-23 17:59:53', '1000798167', 'N'),
(44, '1001516566', 2, NULL, 'fas fa-graduation-cap', '2018-08-27 00:00:00', '1000129288', 'N'),
(45, '1001433940', 2, NULL, NULL, '2017-10-30 17:08:12', '1000916886', 'N'),
(46, '1001328959', 2, NULL, NULL, '2017-10-30 17:08:58', '1000916886', 'N'),
(47, '1001503506', 2, NULL, NULL, '2017-10-30 17:37:59', '1000129288', 'N'),
(48, '1001541257', 2, NULL, NULL, '2017-11-01 18:01:43', '1000798167', 'N'),
(49, '1001443933', 2, NULL, NULL, '2017-11-06 17:56:17', '1000916886', 'N'),
(50, '1001555062', 2, NULL, NULL, '2017-11-06 17:56:55', '1000916886', 'N'),
(51, '1000994752', 11, NULL, 'fas fa-anchor', '2019-02-25 15:16:26', '1000916886', 'N'),
(52, '1000062150', 2, NULL, NULL, '2017-11-08 18:07:23', '1000798167', 'N'),
(53, '1000090488', 2, NULL, NULL, '2017-11-08 18:09:39', '1000798167', 'N'),
(54, '1001598934', 2, NULL, NULL, '2017-11-13 17:48:20', '1000916886', 'N'),
(55, '1001118597', 2, NULL, NULL, '2017-11-13 17:50:08', '1000916886', 'N'),
(56, '1001061605', 2, NULL, NULL, '2017-11-13 17:50:53', '1000916886', 'N'),
(57, '6001156183', 2, NULL, NULL, '2017-11-13 17:51:24', '1000916886', 'N'),
(58, '1001131731', 2, NULL, NULL, '2017-11-15 18:13:07', '1000798167', 'N'),
(59, '1001236691', 2, NULL, NULL, '2017-11-15 18:13:44', '1000798167', 'N'),
(60, '1001307721', 2, NULL, NULL, '2017-11-15 18:14:15', '1000798167', 'N'),
(61, '1001569810', 2, NULL, NULL, '2017-11-15 18:14:52', '1000798167', 'N'),
(62, '6001160516', 2, NULL, NULL, '2017-12-12 13:58:15', '1000916886', 'N'),
(63, '1001039037', 2, NULL, NULL, '2018-02-05 14:00:24', '6001123119', 'N'),
(64, '1001052178', 2, NULL, NULL, '2018-02-05 14:02:57', '6001123119', 'N'),
(65, '1001144403', 2, NULL, NULL, '2018-02-05 14:03:40', '6001123119', 'N'),
(66, '1000821241', 2, NULL, NULL, '2018-02-05 14:04:26', '6001123119', 'N'),
(67, '1000763931', 2, NULL, NULL, '2018-02-05 14:05:49', '6001123119', 'N'),
(68, '6001271289', 11, NULL, 'fas fa-lemon fa-spin', '2018-02-08 00:00:00', 'New Technican', 'N'),
(69, '1000921634', 2, NULL, NULL, '2018-02-12 13:51:30', '1000916886', 'N'),
(70, '1001602588', 2, NULL, NULL, '2018-02-12 13:52:09', '1000916886', 'N'),
(71, '1001626144', 2, NULL, NULL, '2018-02-12 13:52:44', '1000916886', 'N'),
(72, '1001529357', 2, NULL, NULL, '2018-02-12 13:53:26', '1000916886', 'N'),
(73, '1001277280', 2, NULL, NULL, '2018-02-12 13:53:57', '1000916886', 'N'),
(74, '1001436674', 2, NULL, NULL, '2018-02-12 13:54:26', '1000916886', 'N'),
(75, '1001551985', 2, NULL, NULL, '2018-02-15 12:18:31', '1000916886', 'N'),
(76, '1001553378', 2, NULL, NULL, '2018-02-15 12:20:01', '1000916886', 'N'),
(77, '1001354830', 2, NULL, NULL, '2018-02-20 10:55:39', '1000916886', 'N'),
(78, '1001429616', 2, NULL, NULL, '2018-02-20 10:56:22', '1000916886', 'N'),
(79, '1001504051', 2, NULL, NULL, '2018-02-20 10:57:09', '1000916886', 'N'),
(80, '1001173266', 2, NULL, NULL, '2018-02-20 10:58:04', '1000916886', 'N'),
(81, '1001233926', 2, NULL, NULL, '2018-02-20 10:58:36', '1000916886', 'N'),
(82, '1001524816', 2, NULL, NULL, '2018-02-20 10:59:08', '1000916886', 'N'),
(83, '1001547276', 2, NULL, NULL, '2018-02-20 10:59:45', '1000916886', 'N'),
(84, '1000129708', 2, NULL, NULL, '2018-02-20 11:00:33', '1000916886', 'N'),
(85, '6001161737', 2, NULL, NULL, '2018-02-20 11:01:11', '1000916886', 'N'),
(86, '1001093848', 2, NULL, NULL, '2018-02-23 11:56:42', '1000867102', 'N'),
(87, '1001228232', 2, NULL, NULL, '2018-02-23 11:57:14', '1000867102', 'N'),
(88, '1000921973', 2, NULL, NULL, '2018-02-23 11:57:35', '1000867102', 'N'),
(89, '1001088615', 2, NULL, NULL, '2018-02-23 11:57:59', '1000867102', 'N'),
(90, '1001445859', 8, NULL, 'fas fa-barcode', '2018-02-23 16:33:00', '', 'N'),
(91, '1001496768', 9, NULL, 'fas fa-sun', '2018-02-23 16:40:00', '', 'N'),
(92, '1001028273', 9, NULL, 'fab fa-pagelines', '2018-02-23 16:47:00', '', 'N'),
(93, '1001090301', 8, NULL, 'fas fa-bath', '2018-02-23 16:53:00', '', 'N'),
(94, '1001561805', 8, NULL, NULL, '2018-02-23 16:55:00', '', 'N'),
(95, '1001079038', 2, NULL, NULL, '2018-03-02 14:14:31', '1000916886', 'N'),
(96, '1001557698', 2, NULL, NULL, '2018-03-02 14:15:54', '1000916886', 'N'),
(97, '1001459927', 2, NULL, NULL, '2018-03-02 14:16:23', '1000916886', 'N'),
(98, '1001289613', 2, NULL, NULL, '2018-03-02 14:17:08', '1000916886', 'N'),
(99, '1000809485', 2, NULL, NULL, '2018-03-02 14:17:54', '1000916886', 'N'),
(100, '1000403161', 2, NULL, NULL, '2018-03-02 14:18:55', '1000916886', 'N'),
(101, '1000167922', 2, NULL, NULL, '2018-03-02 14:23:46', '1000916886', 'N'),
(102, '1001475621', 2, NULL, NULL, '2018-03-03 14:56:40', '1000867102', 'N'),
(103, '1001231796', 2, NULL, NULL, '2018-03-07 10:58:23', '1000867102', 'N'),
(104, '1001049436', 2, NULL, NULL, '2018-03-07 10:58:56', '1000867102', 'N'),
(105, '1001555950', 2, NULL, NULL, '2018-03-07 10:59:14', '1000867102', 'N'),
(106, '1000861228', 9, NULL, 'fas fa-bicycle', '2018-11-16 15:44:55', '1000129288', 'N'),
(107, '1000869248', 2, NULL, NULL, '2018-03-19 13:04:45', '6001271289', 'N'),
(108, '1001355073', 2, NULL, NULL, '2018-03-22 17:28:28', '6001271289', 'N'),
(109, '1001483292', 9, NULL, NULL, '2019-01-14 20:03:27', '1000129288', 'N'),
(110, '1001448064', 2, NULL, NULL, '2018-04-17 11:03:25', '6001271289', 'N'),
(111, '1001511771', 2, NULL, NULL, '2018-04-17 11:03:54', '6001271289', 'N'),
(112, '1001557216', 2, NULL, NULL, '2018-04-17 11:04:32', '6001271289', 'N'),
(113, '1000870322', 9, NULL, 'fas fa-quidditch', '2018-07-30 18:13:00', '', 'N'),
(114, '1001420410', 2, NULL, NULL, '2018-04-21 14:16:47', '1000867102', 'N'),
(115, '1001518246', 2, NULL, NULL, '2018-04-24 10:48:45', '6001271289', 'N'),
(116, '1001455213', 2, NULL, NULL, '2018-04-24 10:49:28', '6001271289', 'N'),
(117, '1001572081', 2, NULL, NULL, '2018-04-24 10:50:21', '6001271289', 'N'),
(118, '1000622697', 2, NULL, NULL, '2018-05-02 10:56:02', '6001271289', 'N'),
(119, '1001501988', 2, NULL, NULL, '2018-05-02 10:57:05', '6001271289', 'N'),
(120, '1000901856', 2, NULL, NULL, '2018-05-02 10:58:45', '6001271289', 'N'),
(121, '1001073879', 2, NULL, NULL, '2018-05-10 17:47:44', '6001271289', 'N'),
(122, '1001247169', 2, NULL, NULL, '2018-05-22 12:10:57', '6001271289', 'N'),
(123, '1001030476', 8, NULL, NULL, '2018-05-29 13:31:26', '6001271289', 'N'),
(142, '1001388196', 8, NULL, 'fa fa-fighter-jet', '2019-01-31 10:15:58', '1000845009', 'N'),
(143, '1001681136', 9, NULL, 'fas fa-book', '2018-06-18 15:00:00', '1000129288', 'N'),
(144, '1001467751', 8, NULL, 'fas fa-book-dead', '2018-06-18 15:00:00', '1000129288', 'N'),
(145, '1001606253', 8, NULL, NULL, '2018-06-18 15:00:00', '1000129288', 'N'),
(146, '1001336647', 2, NULL, 'fas fa-graduation-cap', '2018-08-27 00:00:00', '1000129288', 'N'),
(147, '1001480839', 8, NULL, 'fab fa-wolf-pack-battalion', '2018-06-18 15:00:00', '1000129288', 'N'),
(148, '1001244524', 1, NULL, 'fas fa-yin-yang fa-spin', '2019-08-02 16:51:11', '1000000010', 'N'),
(149, '1001340075', 9, NULL, 'fab fa-napster', '2019-01-14 20:08:00', '1000129288', 'N'),
(150, '1000903148', 2, NULL, NULL, '2018-06-19 16:10:28', '1000916886', 'N'),
(151, '1001297262', 2, NULL, NULL, '2018-07-03 15:05:30', '1000916886', 'N'),
(152, '1001239781', 2, NULL, NULL, '2018-07-03 15:06:53', '1000916886', 'N'),
(153, '1001291173', 2, NULL, NULL, '2018-07-03 15:07:10', '1000916886', 'N'),
(154, '1001538418', 2, NULL, NULL, '2018-07-03 15:09:01', '1000916886', 'N'),
(155, '1001331924', 2, NULL, NULL, '2018-07-03 15:09:49', '1000916886', 'N'),
(156, '1000975314', 2, NULL, NULL, '2018-07-05 17:55:22', '6001271289', 'N'),
(157, '1001511172', 2, NULL, NULL, '2018-07-05 17:56:25', '6001271289', 'N'),
(158, '1001329183', 2, NULL, NULL, '2018-07-10 16:17:45', '1000916886', 'N'),
(159, '1001300667', 2, NULL, NULL, '2018-07-10 19:43:16', '1000916886', 'N'),
(160, '6001200568', 11, '2018-07-30 18:07:00', NULL, NULL, 'FL Specialist', 'N'),
(161, '1001003522', 2, NULL, NULL, '2018-07-31 14:56:30', '1000916886', 'N'),
(162, '1001241976', 2, NULL, NULL, '2018-07-31 16:46:48', '1000916886', 'N'),
(163, '1001251560', 2, NULL, NULL, '2018-07-31 16:47:22', '1000916886', 'N'),
(164, '1001119558', 2, NULL, NULL, '2018-07-31 16:50:06', '1000916886', 'N'),
(165, '1001410059', 2, NULL, NULL, '2018-07-31 18:42:19', '1000916886', 'N'),
(166, '6001236078', 2, NULL, NULL, '2018-08-08 17:05:19', '1000798167', 'N'),
(167, '1001290262', 2, NULL, NULL, '2018-08-15 17:01:10', '1000798167', 'N'),
(168, '1000507069', 2, NULL, NULL, '2018-08-16 14:58:42', '6001271289', 'N'),
(169, '1001041510', 2, NULL, NULL, '2018-08-16 14:59:45', '6001271289', 'N'),
(170, '1000421636', 2, NULL, NULL, '2018-08-16 15:00:31', '6001271289', 'N'),
(171, '7000000000', 7, NULL, 'fas fa-wrench', NULL, 'Service Technician', 'N'),
(172, '1001472464', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(173, '1001288827', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(174, '1001517562', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(175, '1001301929', 8, NULL, 'fas fa-toilet-paper fa-spin', '2019-02-25 17:38:46', '1000916886', 'N'),
(176, '1001583809', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(177, '1001291214', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(178, '1001174134', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(179, '1001639057', 8, NULL, NULL, '2018-08-27 00:00:00', '1000129288', 'N'),
(180, '1001632300', 2, NULL, NULL, '2018-08-28 18:47:05', '1000916886', 'N'),
(181, '1001638250', 2, NULL, NULL, '2018-09-07 15:44:34', '1000916886', 'N'),
(182, '1001685309', 2, NULL, NULL, '2018-09-07 15:44:54', '1000916886', 'N'),
(183, '1000955177', 2, NULL, NULL, '2018-09-10 14:48:38', '1000916886', 'N'),
(184, '1001677071', 2, NULL, NULL, '2018-09-10 14:49:38', '1000916886', 'N'),
(185, '1001302492', 2, NULL, NULL, '2018-09-10 14:50:40', '1000916886', 'N'),
(186, '1001596848', 2, NULL, NULL, '2018-09-10 14:50:55', '1000916886', 'N'),
(187, '1001637073', 2, NULL, NULL, '2018-09-12 11:23:12', '6001271289', 'N'),
(188, '1000622858', 2, NULL, NULL, '2018-09-14 17:18:03', '1000916886', 'N'),
(189, '1001505277', 2, NULL, NULL, '2018-09-14 17:19:48', '1000916886', 'N'),
(190, '6001201270', 2, NULL, NULL, '2018-09-14 17:20:30', '1000916886', 'N'),
(191, '1000907808', 2, NULL, NULL, '2018-09-14 17:22:18', '1000916886', 'N'),
(192, '1000581109', 2, NULL, NULL, '2018-09-17 14:05:26', '1000916886', 'N'),
(193, '1000826171', 2, NULL, NULL, '2018-09-18 10:58:19', '6001271289', 'N'),
(194, '1001133450', 2, NULL, NULL, '2018-09-18 10:59:04', '6001271289', 'N'),
(195, '1001679728', 11, NULL, NULL, '2019-02-25 15:13:29', '1000916886', 'N'),
(196, '1001673768', 2, NULL, NULL, '2018-09-18 11:00:18', '6001271289', 'N'),
(197, '1001611386', 2, NULL, NULL, '2018-09-18 11:01:03', '6001271289', 'N'),
(198, '6001284586', 2, NULL, NULL, '2018-09-26 10:45:28', '6001271289', 'N'),
(199, '1000975094', 2, NULL, NULL, '2018-09-26 10:46:27', '6001271289', 'N'),
(200, '1000820787', 2, NULL, NULL, '2018-09-26 10:47:03', '6001271289', 'N'),
(201, '1001571575', 2, NULL, NULL, '2018-09-26 10:47:45', '6001271289', 'N'),
(202, '1001603802', 2, NULL, NULL, '2018-09-26 10:48:19', '6001271289', 'N'),
(203, '1001631404', 2, NULL, NULL, '2018-09-26 10:50:02', '6001271289', 'N'),
(204, '1001237955', 2, NULL, NULL, '2018-10-08 15:06:52', '1000916886', 'N'),
(205, '1001327586', 2, NULL, NULL, '2018-10-11 13:06:01', '1000916886', 'N'),
(206, '1001694066', 2, NULL, NULL, '2018-10-11 13:06:41', '1000916886', 'N'),
(207, '1001607542', 2, NULL, NULL, '2018-10-11 13:07:18', '1000916886', 'N'),
(208, '1001336310', 2, NULL, NULL, '2018-10-11 13:07:38', '1000916886', 'N'),
(209, '1001669013', 2, NULL, NULL, '2018-10-11 13:08:13', '1000916886', 'N'),
(210, '1001533857', 2, NULL, NULL, '2018-10-11 13:09:09', '1000916886', 'N'),
(211, '1001506840', 2, NULL, NULL, '2018-10-23 12:04:49', '1000798167', 'N'),
(212, '1001317293', 2, NULL, NULL, '2018-10-23 12:08:43', '1000798167', 'N'),
(213, '1000683031', 2, NULL, NULL, '2018-10-23 16:41:30', '1000916886', 'N'),
(214, '1001246700', 2, NULL, NULL, '2018-10-23 16:42:29', '1000916886', 'N'),
(215, '1001650023', 2, NULL, NULL, '2018-10-24 11:02:23', '1000916886', 'N'),
(216, '1001636459', 2, NULL, NULL, '2018-10-24 11:02:35', '1000916886', 'N'),
(217, '1000147055', 2, NULL, NULL, '2018-10-24 11:03:18', '1000916886', 'N'),
(218, '1000759803', 2, NULL, NULL, '2018-10-24 11:03:32', '1000916886', 'N'),
(219, '1000932110', 2, NULL, NULL, '2018-10-24 11:04:08', '1000916886', 'N'),
(220, '1001350831', 2, NULL, NULL, '2018-10-24 11:04:31', '1000916886', 'N'),
(221, '1001651834', 2, NULL, NULL, '2018-10-24 11:05:46', '1000916886', 'N'),
(222, '1000951592', 2, NULL, NULL, '2018-10-24 11:06:35', '1000916886', 'N'),
(223, '1001019741', 2, NULL, NULL, '2018-10-24 11:07:55', '1000916886', 'N'),
(224, '1000677463', 2, NULL, NULL, '2018-10-24 11:08:34', '1000916886', 'N'),
(225, '1001687904', 2, NULL, NULL, '2018-10-24 11:09:22', '1000916886', 'N'),
(226, '1001485848', 2, NULL, NULL, '2018-10-30 11:01:28', '6001271289', 'N'),
(227, '1001650505', 2, NULL, NULL, '2018-10-30 11:02:14', '6001271289', 'N'),
(228, '1001665989', 2, NULL, NULL, '2018-10-30 11:02:53', '6001271289', 'N'),
(229, '1001267354', 2, NULL, NULL, '2018-10-30 11:04:02', '6001271289', 'N'),
(230, '1001690413', 2, NULL, NULL, '2018-10-30 11:04:42', '6001271289', 'N'),
(231, '1000642023', 2, NULL, NULL, '2018-11-01 16:08:04', '6001271289', 'N'),
(232, '0009051523', 7, NULL, 'fas fa-wrench', NULL, '', 'N'),
(233, '1001192762', 2, NULL, NULL, '2018-11-05 13:45:26', '6001271289', 'N'),
(234, '1001147329', 2, NULL, NULL, '2018-11-05 13:45:59', '6001271289', 'N'),
(235, '1000426750', 2, NULL, NULL, '2018-11-05 13:46:39', '6001271289', 'N'),
(236, '1001381801', 2, NULL, NULL, '2018-11-05 13:47:07', '6001271289', 'N'),
(237, '1001675062', 2, NULL, NULL, '2018-11-05 13:47:57', '6001271289', 'N'),
(238, '1001664074', 2, NULL, NULL, '2018-11-05 13:48:37', '6001271289', 'N'),
(239, '1001532113', 2, NULL, NULL, '2018-11-05 13:49:16', '6001271289', 'N'),
(240, '1001233822', 2, NULL, NULL, '2018-11-05 13:50:26', '6001271289', 'N'),
(241, '1001110514', 10, NULL, NULL, '2018-11-05 14:01:45', '1000129288', 'N'),
(242, '1001403273', 2, NULL, NULL, '2018-11-06 12:09:39', '1000798167', 'N'),
(243, '1001512102', 2, NULL, NULL, '2018-11-07 10:57:55', '1000916886', 'N'),
(244, '1000136124', 2, NULL, NULL, '2018-11-07 16:00:27', '1000798167', 'N'),
(245, '1001514762', 11, NULL, NULL, '2018-11-09 16:35:24', '1000129288', 'N'),
(246, '1000845009', 11, NULL, 'fas fa-space-shuttle', '2018-11-16 15:44:48', '1000129288', 'N'),
(247, '1001672454', 2, NULL, NULL, '2018-11-20 11:21:41', '6001271289', 'N'),
(248, '1001674863', 2, NULL, NULL, '2018-11-20 11:22:46', '6001271289', 'N'),
(250, '1001551529', 8, NULL, 'fab fa-acquisitions-incorporated fa-spin', '2018-12-02 13:15:15', '1000798167', 'N'),
(251, '1001572027', 2, NULL, NULL, '2019-01-28 14:01:06', '1000916886', 'N'),
(252, '1001665669', 2, NULL, NULL, '2019-01-28 14:10:11', '6001200568', 'N'),
(253, '1001441080', 2, NULL, NULL, '2019-02-04 15:27:50', '1000798167', 'N'),
(254, '1001114440', 2, NULL, NULL, '2019-02-04 15:28:41', '1000798167', 'N'),
(255, '1001564156', 2, NULL, NULL, '2019-02-05 11:55:05', '1000916886', 'N'),
(256, '1001117296', 2, NULL, NULL, '2019-02-05 11:55:25', '1000916886', 'N'),
(257, '1001609113', 2, NULL, NULL, '2019-02-07 14:02:11', '1000798167', 'N'),
(258, '1001054794', 2, NULL, NULL, '2019-02-07 14:03:13', '1000798167', 'N'),
(259, '1001048699', 2, NULL, NULL, '2019-02-07 14:04:04', '1000798167', 'N'),
(260, '1001420877', 2, NULL, NULL, '2019-02-08 15:37:21', '6001271289', 'N'),
(261, '1001486743', 2, NULL, NULL, '2019-02-12 10:58:45', '1000798167', 'N'),
(262, '1001247215', 2, NULL, NULL, '2019-02-12 11:00:23', '1000798167', 'N'),
(263, '1001672440', 2, NULL, NULL, '2019-02-12 11:01:22', '1000798167', 'N'),
(264, '1001352192', 2, NULL, NULL, '2019-02-12 11:02:23', '1000798167', 'N'),
(265, '1001278904', 2, NULL, NULL, '2019-02-12 11:03:55', '1000798167', 'N'),
(266, '1001300335', 2, NULL, NULL, '2019-02-12 11:04:50', '1000798167', 'N'),
(267, '1000624278', 2, NULL, NULL, '2019-02-14 10:48:46', '1000798167', 'N'),
(268, '1001449817', 2, NULL, NULL, '2019-02-14 10:50:00', '1000798167', 'N'),
(269, '1001244575', 2, NULL, NULL, '2019-02-14 10:50:44', '1000798167', 'N'),
(270, '1001082962', 2, NULL, NULL, '2019-02-14 10:51:42', '1000798167', 'N'),
(271, '1001189006', 2, NULL, NULL, '2019-02-14 10:52:19', '1000798167', 'N'),
(272, '1001584116', 2, NULL, NULL, '2019-02-14 10:53:06', '1000798167', 'N'),
(273, '1001439426', 2, NULL, NULL, '2019-02-14 10:53:46', '1000798167', 'N'),
(274, '1000936862', 2, NULL, NULL, '2019-02-14 10:54:28', '1000798167', 'N'),
(275, '1000943952', 2, NULL, NULL, '2019-02-14 11:44:42', '1000916886', 'N'),
(276, '1001672914', 2, NULL, NULL, '2019-02-14 11:46:27', '1000916886', 'N'),
(277, '1001112848', 2, NULL, NULL, '2019-02-18 10:16:59', '1000916886', 'N'),
(278, '1001011876', 2, NULL, NULL, '2019-02-18 10:19:07', '1000916886', 'N'),
(279, '1001241029', 2, NULL, NULL, '2019-02-18 11:59:19', '1000916886', 'N'),
(280, '1001720618', 2, NULL, NULL, '2019-02-21 12:50:53', '6001271289', 'N'),
(281, '1001090537', 2, NULL, NULL, '2019-02-21 12:51:20', '6001271289', 'N'),
(282, '1001696577', 2, NULL, NULL, '2019-02-21 12:51:41', '6001271289', 'N'),
(283, '1001229379', 2, NULL, NULL, '2019-02-21 12:52:11', '6001271289', 'N'),
(284, '1001094377', 2, NULL, NULL, '2019-02-21 12:52:29', '6001271289', 'N'),
(285, '1000563440', 2, NULL, NULL, '2019-02-21 12:52:51', '6001271289', 'N'),
(286, '1000948090', 2, NULL, NULL, '2019-02-22 15:44:02', '1000798167', 'N'),
(287, '1001725383', 2, NULL, NULL, '2019-02-25 14:44:31', '6001271289', 'N'),
(288, '1001643664', 2, NULL, NULL, '2019-02-25 14:44:53', '6001271289', 'N'),
(289, '1001669264', 2, NULL, NULL, '2019-02-25 14:45:10', '6001271289', 'N'),
(290, '1001146643', 2, NULL, NULL, '2019-02-25 14:45:30', '6001271289', 'N'),
(291, '1001238061', 2, NULL, NULL, '2019-03-01 15:33:41', '6001271289', 'N'),
(292, '1001415704', 2, NULL, NULL, '2019-03-01 15:34:02', '6001271289', 'N'),
(293, '1001719886', 2, NULL, NULL, '2019-03-07 12:57:07', '1000916886', 'N'),
(294, '1000588365', 2, NULL, NULL, '2019-03-07 12:57:25', '1000916886', 'N'),
(295, '1001533074', 2, NULL, NULL, '2019-03-07 12:58:46', '1000916886', 'N'),
(296, '1001664559', 2, NULL, NULL, '2019-03-07 12:59:03', '1000916886', 'N'),
(297, '6001161387', 2, NULL, NULL, '2019-03-07 12:59:55', '1000916886', 'N'),
(298, '6001279005', 2, NULL, NULL, '2019-03-07 13:00:09', '1000916886', 'N'),
(299, '1001111341', 2, NULL, NULL, '2019-03-08 18:51:35', '1001679728', 'N'),
(300, '1001583308', 2, NULL, NULL, '2019-03-20 11:04:19', '1000916886', 'N'),
(301, '6001216197', 2, NULL, NULL, '2019-03-20 11:04:48', '1000916886', 'N'),
(302, '1001037754', 2, NULL, NULL, '2019-03-22 12:42:34', '1001679728', 'N'),
(303, '1001726729', 2, NULL, NULL, '2019-03-26 10:36:17', '1000798167', 'N'),
(304, '1001736063', 2, NULL, NULL, '2019-03-29 12:42:13', '1001679728', 'N'),
(305, '1001561733', 2, NULL, NULL, '2019-03-29 12:42:42', '1001679728', 'N'),
(306, '1001496201', 2, NULL, NULL, '2019-03-29 12:43:06', '1001679728', 'N'),
(307, '1001488538', 2, NULL, NULL, '2019-03-29 12:43:23', '1001679728', 'N'),
(308, '1000202515', 2, NULL, NULL, '2019-03-29 12:43:43', '1001679728', 'N'),
(309, '0348453954', 1, NULL, NULL, '2019-08-02 16:51:30', '1000000010', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `wait_queue`
--

CREATE TABLE IF NOT EXISTS `wait_queue` (
  `Q_id` int(11) NOT NULL,
  `Operator` char(10) DEFAULT NULL,
  `Dev_id` int(11) DEFAULT NULL,
  `Devgr_id` int(11) DEFAULT NULL,
  `Start_date` datetime DEFAULT NULL,
  `estTime` time DEFAULT NULL,
  `End_date` datetime DEFAULT NULL,
  `last_contact` datetime DEFAULT NULL,
  `valid` enum('Y','N') DEFAULT 'Y',
  `Op_email` varchar(100) DEFAULT NULL,
  `Op_phone` char(10) DEFAULT NULL,
  `carrier` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=1564 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `acct_charge`
--
ALTER TABLE `acct_charge`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `authrecipients`
--
ALTER TABLE `authrecipients`
  ADD PRIMARY KEY (`ar_id`);

--
-- Indexes for table `auth_accts`
--
ALTER TABLE `auth_accts`
  ADD PRIMARY KEY (`aa_id`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_name` (`c_name`),
  ADD KEY `c_parent` (`c_parent`);

--
-- Indexes for table `citation`
--
ALTER TABLE `citation`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`d_id`),
  ADD KEY `devices_index_device_id` (`device_id`);

--
-- Indexes for table `device_group`
--
ALTER TABLE `device_group`
  ADD PRIMARY KEY (`dg_id`),
  ADD UNIQUE KEY `dg_name` (`dg_name`);

--
-- Indexes for table `device_materials`
--
ALTER TABLE `device_materials`
  ADD PRIMARY KEY (`dm_id`);

--
-- Indexes for table `error`
--
ALTER TABLE `error`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `mats_used`
--
ALTER TABLE `mats_used`
  ADD PRIMARY KEY (`mu_id`);

--
-- Indexes for table `objbox`
--
ALTER TABLE `objbox`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `trans_id` (`trans_id`);

--
-- Indexes for table `purpose`
--
ALTER TABLE `purpose`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `rfid`
--
ALTER TABLE `rfid`
  ADD PRIMARY KEY (`rf_id`),
  ADD UNIQUE KEY `rfid_no` (`rfid_no`),
  ADD KEY `rfid_index_operator` (`operator`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `service_call`
--
ALTER TABLE `service_call`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `service_lvl`
--
ALTER TABLE `service_lvl`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `service_reply`
--
ALTER TABLE `service_reply`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `sheet_good_inventory`
--
ALTER TABLE `sheet_good_inventory`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `sheet_good_transactions`
--
ALTER TABLE `sheet_good_transactions`
  ADD PRIMARY KEY (`sg_trans_ID`);

--
-- Indexes for table `site_variables`
--
ALTER TABLE `site_variables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `storage_box`
--
ALTER TABLE `storage_box`
  ADD PRIMARY KEY (`drawer`,`unit`);

--
-- Indexes for table `table_descriptions`
--
ALTER TABLE `table_descriptions`
  ADD PRIMARY KEY (`t_d_id`);

--
-- Indexes for table `tm_enroll`
--
ALTER TABLE `tm_enroll`
  ADD PRIMARY KEY (`tme_key`),
  ADD KEY `tm_enroll_index_operator` (`operator`);

--
-- Indexes for table `trainingmodule`
--
ALTER TABLE `trainingmodule`
  ADD PRIMARY KEY (`tm_id`),
  ADD KEY `device_id` (`d_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `device_id` (`d_id`),
  ADD KEY `transactions_index_uta_id` (`operator`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `operator` (`operator`);

--
-- Indexes for table `wait_queue`
--
ALTER TABLE `wait_queue`
  ADD PRIMARY KEY (`Q_id`),
  ADD KEY `Operator` (`Operator`),
  ADD KEY `Dev_id` (`Dev_id`),
  ADD KEY `Devgr_id` (`Devgr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `acct_charge`
--
ALTER TABLE `acct_charge`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `authrecipients`
--
ALTER TABLE `authrecipients`
  MODIFY `ar_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `auth_accts`
--
ALTER TABLE `auth_accts`
  MODIFY `aa_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `citation`
--
ALTER TABLE `citation`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `device_group`
--
ALTER TABLE `device_group`
  MODIFY `dg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `device_materials`
--
ALTER TABLE `device_materials`
  MODIFY `dm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT for table `error`
--
ALTER TABLE `error`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `mats_used`
--
ALTER TABLE `mats_used`
  MODIFY `mu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `objbox`
--
ALTER TABLE `objbox`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13485;
--
-- AUTO_INCREMENT for table `rfid`
--
ALTER TABLE `rfid`
  MODIFY `rf_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_call`
--
ALTER TABLE `service_call`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_lvl`
--
ALTER TABLE `service_lvl`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `service_reply`
--
ALTER TABLE `service_reply`
  MODIFY `sr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sheet_good_inventory`
--
ALTER TABLE `sheet_good_inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sheet_good_transactions`
--
ALTER TABLE `sheet_good_transactions`
  MODIFY `sg_trans_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `site_variables`
--
ALTER TABLE `site_variables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `table_descriptions`
--
ALTER TABLE `table_descriptions`
  MODIFY `t_d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `tm_enroll`
--
ALTER TABLE `tm_enroll`
  MODIFY `tme_key` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trainingmodule`
--
ALTER TABLE `trainingmodule`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35292;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT for table `wait_queue`
--
ALTER TABLE `wait_queue`
  MODIFY `Q_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1564;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`c_parent`) REFERENCES `categories` (`c_id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `categories` (`c_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
