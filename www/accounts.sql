-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 08:53 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fabapp-v0.9`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
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
(1, 'Unpaid', 'Unpaid charge, Blocked until Paid', 387.99, '1000129288', '9'),
(2, 'CSGold', 'CSGold Account', 400.52, '1000129288', '8'),
(3, 'FabLab', 'FabLab''s in-House Charge Account', 1784.62, '1000129288', '9'),
(4, 'Library', 'General Library Account', 605.29, '1000129288', '9'),
(5, 'IDT', 'Inter-Departmental Transfers', 1498.12, '1000129288', '9'),
(6, 'Bursar', 'Office of Student Accounts', 10.00, '', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
