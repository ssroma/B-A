-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2015 at 02:23 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stuffdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_tag` varchar(15) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `client_log` (`client_tag`),
  KEY `client_log_2` (`client_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=988 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `client_tag`, `data`, `hora`, `status`) VALUES
(972, '0072', '2015-06-18', '06:06:29', 'in'),
(973, '0131', '2015-06-18', '06:13:41', 'in'),
(974, '0081', '2015-06-18', '06:21:44', 'in'),
(975, '0153', '2015-06-18', '06:45:54', 'in'),
(976, '0095', '2015-06-18', '06:51:30', 'in'),
(977, '0070', '2015-06-18', '07:06:08', 'in'),
(978, '0160', '2015-06-17', '21:20:30', 'out'),
(979, '0081', '2015-06-17', '21:28:05', 'out'),
(980, '0072', '2015-06-18', '16:06:29', 'out'),
(981, '0131', '2015-06-18', '16:13:41', 'out'),
(982, '0081', '2015-06-18', '16:21:44', 'out'),
(983, '0153', '2015-06-19', '06:45:54', 'in'),
(984, '0160', '2015-06-18', '06:20:30', 'in'),
(985, '0081', '2015-06-19', '07:28:05', 'in'),
(986, '0095', '2015-06-20', '17:51:30', 'out'),
(987, '0070', '2015-06-21', '17:06:08', 'out');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
